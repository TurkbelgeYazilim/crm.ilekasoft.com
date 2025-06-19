<?php
// Kullanıcı grubu yetkilerini çek
$control2 = session("r", "login_info");
$kullanici_grupID = $control2->grup_id; // Düzeltme: kullanici_grupID yerine grup_id kullan
$GLOBALS['kullanici_grup_yetkileri'] = array(); // Global olarak tanımla
$kullanici_grup_yetkileri = array();

// Kısıtlı grup kontrolü - Saha Satış Temsilcisi (kg_id:3) ve Bölge Müdürü (kg_id:6)
$kisitli_gruplar = [3, 6];
$is_kisitli = in_array($kullanici_grupID, $kisitli_gruplar);

// DEBUG: Geçici kontrol için
if($control2 && $control2->kullanici_id == 187) {
    echo "<!-- SIDEBAR DEBUG FIX: User=$control2->kullanici_id, Group=$kullanici_grupID -->";
}

if($kullanici_grupID){
    $yetkilerQ = "SELECT * FROM kullanici_grubu_yetkisi WHERE kgy_grupID = '$kullanici_grupID'";
    $yetkilerResult = $this->db->query($yetkilerQ)->result();
    foreach($yetkilerResult as $yetki){
        $kullanici_grup_yetkileri[$yetki->kgy_modul][] = $yetki->kgy_yetki;
        $GLOBALS['kullanici_grup_yetkileri'][$yetki->kgy_modul][] = $yetki->kgy_yetki; // Global'e de ata
    }
    
    // DEBUG: Group permissions için
    if($control2 && $control2->kullanici_id == 187) {
        $hasModule200 = isset($kullanici_grup_yetkileri[200]) ? 'TRUE' : 'FALSE';
        echo "<!-- SIDEBAR DEBUG PERMISSIONS: Module200=$hasModule200, Permissions=" . json_encode($kullanici_grup_yetkileri) . " -->";
    }
}
if (!function_exists('grup_modul_yetkisi_var')) {
    function grup_modul_yetkisi_var($modul_id, $yetki=1) {
        // Global değişkeni direkt kullan
        return isset($GLOBALS['kullanici_grup_yetkileri'][$modul_id]) && in_array($yetki, $GLOBALS['kullanici_grup_yetkileri'][$modul_id]);
    }
}
// Date range defaults for GIB links
$endDate = date("d-m-Y");
$startDate = date("d-m-Y", strtotime('-7 day', strtotime($endDate)));
?>
<?php
$uri = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);

$control2 = session("r", "login_info");
$u_id = $control2->kullanici_id;
$yetki = $control2->kullanici_yetki;

$firmaID = getirFirma();
if (!$firmaID) {
    // Handle case where firm information cannot be retrieved
    // Fallback to prevent fatal errors
    $firma_ID = 0;
} else {
    $firma_ID = $firmaID->ayarlar_id;
}

$modulSorgula = modulSorgula($firma_ID, 1);
$modulGibSorgula = modulSorgula($firma_ID, 2);
$modulGibProSorgula = modulSorgula($firma_ID, 3);
$modulOcrSorgula = modulSorgula($firma_ID, 4);
$irsaliyeModulSorgulama = modulSorgula($firma_ID, 5);
?>
<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu menu-striped">
			<ul>
				<li class="<?php if ($uri == '' or ($uri == 'gib' && $uri2 == 'index') or ($uri == 'ocr' && $uri2 == 'index')) {
					echo 'active';
				} ?>">
					<a href="<?= base_url(); ?>"><i data-feather="home"></i> <span>Anasayfa</span></a>
				</li>
				<?php
				if ($modulGibSorgula) {
					?>
					<li class="menu-title">
						<span>Gib</span>
					</li>

					<li class="<?php if ($uri2 == 'fatura-olustur') {
						echo 'active';
					} ?>">
						<a href="<?= base_url("gib/fatura-olustur"); ?>"><i data-feather="edit"></i> <span>Fatura Oluştur</span></a>
					</li>

					<?php

					$endDate = date("d-m-Y");
					$startDate = date("d-m-Y", strtotime('-7 day', strtotime($endDate)));
					?>
					<li class="<?php if ($uri2 == 'duzenlenen-belgeler') {
						echo 'active';
					} ?>">
						<a href="<?= base_url("gib/duzenlenen-belgeler?tarihAraligi=$startDate+%26+$endDate"); ?>"><i data-feather="file-minus"></i> <span>Düzenlenen Belgeler</span></a>
					</li>

					<li class="<?php if ($uri2 == 'adima-duzenlenen-belgeler') {
						echo 'active';
					} ?>">
						<a href="<?= base_url("gib/adima-duzenlenen-belgeler?tarihAraligi=$startDate+%26+$endDate"); ?>"><i data-feather="file-text"></i>
							<span>Adıma Düzenlenen Belgeler</span></a>
					</li>
					<li class="<?php if ($uri2 == 'gib-bilgi') {
						echo 'active';
					} ?>">
						<a href="<?= base_url("gib/gib-bilgi"); ?>"><i data-feather="user"></i>
							<span>GİB Bilgileri</span></a>
					</li>
				<?php } ?>
				<?php if ($modulOcrSorgula)
				{?>
					<li class="menu-title">
						<span>OCR</span>
					</li>
					<li class="<?php if ($uri2 == 'dosya-yukle') {
						echo 'active';
					} ?>">
						<a href="<?= base_url("ocr/dosya-yukle"); ?>"><i data-feather="plus"></i> <span>Dosya Yükle</span></a>
					</li>
					<li class="<?php if ($uri2 == 'yuklenen-dosyalar') {
						echo 'active';
					} ?>">
						<a href="<?= base_url("ocr/yuklenen-dosyalar"); ?>"><i data-feather="file"></i> <span>Yüklenen Dosyalar</span></a>
					</li>
				<?php } ?>
<?php if (grup_modul_yetkisi_var(100)): ?>
    <li class="submenu <?php if ($uri=='cari') echo 'active'; ?>">
        <a href="#"><i data-feather="user"></i> <span>Müşteri</span> <span class="menu-arrow"></span></a>
        <ul>
            <?php if (grup_modul_yetkisi_var(110)): ?>
                <li><a href="<?= base_url('cari/cari-karti-olustur'); ?>" class="<?php if (in_array($uri2,['cari-karti-olustur','cari-karti-duzenle'])) echo 'active'; ?>">Müşteri Oluştur</a></li>
            <?php endif; ?>
            <?php if (grup_modul_yetkisi_var(120)): ?>
                <li><a href="<?= base_url('cari/cari-listesi'); ?>" class="<?php if ($uri2=='cari-listesi') echo 'active'; ?>">Müşteri Listesi</a></li>
            <?php endif; ?>
            <?php if (grup_modul_yetkisi_var(130)): ?>
                <li><a href="<?= base_url('cari/cari-hareketleri'); ?>" class="<?php if ($uri2=='cari-hareketleri') echo 'active'; ?>">Müşteri Hareketleri</a></li>
            <?php endif; ?>
            <?php if (grup_modul_yetkisi_var(140)): ?>
                <li><a href="<?= base_url('cari/cari-gruplari'); ?>" class="<?php if ($uri2=='cari-gruplari') echo 'active'; ?>">Müşteri Grupları</a></li>
            <?php endif; ?>
            <?php if (grup_modul_yetkisi_var(150)): ?>
                <li><a href="<?= base_url('cari/cari-dekont'); ?>" class="<?php if ($uri2=='cari-dekont') echo 'active'; ?>">Müşteri Dekont</a></li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>
					<!-- STOK (STOCK) SECTION - permission-based -->
<?php if (grup_modul_yetkisi_var(200)): ?>
<li class="submenu <?php if ($uri == 'stok') echo 'active'; ?>">
    <a href="#"><i data-feather="inbox"></i> <span>Stok</span> <span class="menu-arrow"></span></a>
    <ul>
        <?php if (grup_modul_yetkisi_var(210)): ?>
        <li><a href="<?= base_url('stok/stok-karti-olustur'); ?>" class="<?php if(in_array($uri2,['stok-karti-olustur','stok-karti-duzenle'])) echo 'active'; ?>">Stok Açılış Kartı</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(220)): ?>
        <li><a href="<?= base_url('stok/stok-listesi'); ?>" class="<?php if($uri2=='stok-listesi') echo 'active'; ?>">Stok Listesi</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(230)): ?>
        <li><a href="<?= base_url('stok/stok-hareketleri'); ?>" class="<?php if($uri2=='stok-hareketleri') echo 'active'; ?>">Stok Hareketleri</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(240)): ?>
        <li><a href="<?= base_url('stok/stok-gruplari'); ?>" class="<?php if($uri2=='stok-gruplari') echo 'active'; ?>">Stok Grupları</a></li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>
					<!-- Fatura/Satış Bölümü - Yetki kontrolleri kaldırıldı, herkes erişebilir -->
<?php if (grup_modul_yetkisi_var(300)): ?>
<li class="submenu <?php if ($uri=='fatura') echo 'active'; ?>">
    <a href="#"><i data-feather="clipboard"></i> <span>Satış</span> <span class="menu-arrow"></span></a>
    <ul>
        <?php if (grup_modul_yetkisi_var(310)): ?>
        <li><a href="<?= base_url('fatura/satis-faturasi'); ?>" class="<?php if(in_array($uri2,['satis-faturasi','satis-faturasi-duzenle'])) echo 'active'; ?>">Satış Sözleşmesi</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(320)): ?>
        <li><a href="<?= base_url('fatura/satis-faturasi-listesi'); ?>" class="<?php if($uri2=='satis-faturasi-listesi') echo 'active'; ?>">Satış Sözleşmesi Listesi</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(330)): ?>
        <li><a href="<?= base_url('fatura/alis-faturasi'); ?>" class="<?php if(in_array($uri2,['alis-faturasi','alis-faturasi-duzenle'])) echo 'active'; ?>">Alış Faturası</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(340)): ?>
        <li><a href="<?= base_url('fatura/alis-faturasi-listesi'); ?>" class="<?php if($uri2=='alis-faturasi-listesi') echo 'active'; ?>">Alış Faturası Listesi</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(350)): ?>
        <li><a href="<?= base_url('fatura/proforma-faturasi'); ?>" class="<?php if(in_array($uri2,['proforma-faturasi','proforma-faturasi-duzenle'])) echo 'active'; ?>">Proforma Faturası</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(360)): ?>
        <li><a href="<?= base_url('fatura/proforma-listesi'); ?>" class="<?php if($uri2=='proforma-listesi') echo 'active'; ?>">Proforma Faturası Listesi</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(370)): ?>
        <li><a href="<?= base_url('fatura/etiketler'); ?>" class="<?php if($uri2=='etiketler') echo 'active'; ?>">Etiketler</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(380)): ?>
        <li><a href="<?= base_url('fatura/efatura-olustur'); ?>" class="<?php if($uri2=='efatura-olustur') echo 'active'; ?>">e-Fatura Oluştur</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(390)): ?>
        <li><a href="<?= base_url('fatura/efatura-gelen'); ?>" class="<?php if($uri2=='efatura-gelen') echo 'active'; ?>">e-Fatura Gelen Kutusu</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(400)): ?>
        <li><a href="<?= base_url('fatura/efatura-giden'); ?>" class="<?php if($uri2=='efatura-giden') echo 'active'; ?>">e-Fatura Giden Kutusu</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(410)): ?>
        <li><a href="<?= base_url('fatura/earsiv-olustur'); ?>" class="<?php if($uri2=='earsiv-olustur') echo 'active'; ?>">e-Arşiv Fatura Oluştur</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(420)): ?>
        <li><a href="<?= base_url('fatura/earsiv-faturalari'); ?>" class="<?php if($uri2=='earsiv-faturalari') echo 'active'; ?>">e-Arşiv Faturaları</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(430)): ?>
        <li><a href="<?= base_url('gib/adima-duzenlenen-belgeler?tarihAraligi='.$startDate.'+%26+'.$endDate); ?>" class="<?php if($uri2=='adima-duzenlenen-belgeler') echo 'active'; ?>">GIB/IVD Gelen e-Arşiv</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(440)): ?>
        <li><a href="<?= base_url('fatura/taslak-fatura-yukle'); ?>" class="<?php if($uri2=='taslak-fatura-yukle') echo 'active'; ?>">Taslak Fatura Yükle</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(450)): ?>
        <li><a href="<?= base_url('fatura/eirsaliye-olustur'); ?>" class="<?php if($uri2=='eirsaliye-olustur') echo 'active'; ?>">e-İrsaliye Oluştur</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(460)): ?>
        <li><a href="<?= base_url('fatura/eirsaliye-gelen'); ?>" class="<?php if($uri2=='eirsaliye-gelen') echo 'active'; ?>">Gelen e-İrsaliye</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(470)): ?>
        <li><a href="<?= base_url('fatura/eirsaliye-giden'); ?>" class="<?php if($uri2=='eirsaliye-giden') echo 'active'; ?>">Giden e-İrsaliye</a></li>
        <?php endif; ?>
        <?php if (grup_modul_yetkisi_var(480)): ?>
        <li><a href="<?= base_url('fatura/seri-yonetimi'); ?>" class="<?php if($uri2=='seri-yonetimi') echo 'active'; ?>">Seri Yönetimi</a></li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>

					<!-- Tahsilat menüsü -->
					<?php if (grup_modul_yetkisi_var(500)): ?>
					<li class="<?php if($uri=='tahsilat') echo 'active'; ?>">
						<a href="<?= base_url('tahsilat/tahsilat-olustur'); ?>"><i data-feather="dollar-sign"></i> <span>Tahsilat</span></a>
					</li>
					<?php endif; ?>
					
					<!-- Prim menüsü -->
					<?php if (grup_modul_yetkisi_var(1700)): ?>
					<li class="submenu <?php if($uri=='prim') echo 'active'; ?>">
						<a href="#"><i data-feather="award"></i> <span>Prim</span> <span class="menu-arrow"></span></a>
						<ul>
							<?php if (grup_modul_yetkisi_var(1710)): ?>
							<li><a href="<?= base_url('prim/prim-hazirla'); ?>" class="<?php if($uri=='prim' && $uri2=='prim-hazirla') echo 'active'; ?>">Prim Hazırla</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(1720)): ?>
							<li><a href="<?= base_url('prim/prim-listele'); ?>" class="<?php if($uri=='prim' && $uri2=='prim-listele') echo 'active'; ?>">Prim Listesi</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(1730)): ?>
							<li><a href="<?= base_url('prim/prim-ayar'); ?>" class="<?php if($uri=='prim' && $uri2=='prim-ayar') echo 'active'; ?>">Prim Ayarları</a></li>
							<?php endif; ?>
						</ul>
					</li>
					<?php endif; ?>
					
					<!-- İllegal menüsü -->
					<?php if (grup_modul_yetkisi_var(1600)): ?>
					<li class="submenu <?php if($uri=='illegal') echo 'active'; ?>">
						<a href="#"><i data-feather="alert-triangle"></i> <span>İllegal</span> <span class="menu-arrow"></span></a>
						<ul>
							<?php if (grup_modul_yetkisi_var(1610)): ?>
							<li><a href="<?= base_url('illegal/illegal-hazirla'); ?>" class="<?php if($uri=='illegal' && $uri2=='illegal-hazirla') echo 'active'; ?>">İllegal Hazırla</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(1620)): ?>
							<li><a href="<?= base_url('illegal/illegal-listele'); ?>" class="<?php if($uri=='illegal' && $uri2=='illegal-listele') echo 'active'; ?>">İllegal Listesi</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(1630)): ?>
							<li><a href="<?= base_url('illegal/illegal-ayar'); ?>" class="<?php if($uri=='illegal' && $uri2=='illegal-ayar') echo 'active'; ?>">İllegal Ayarları</a></li>
							<?php endif; ?>
						</ul>
					</li>
					<?php endif; ?>
					<!-- Kasa Bölümü - Yetki kontrolleri kaldırıldı, herkes erişebilir -->
					<?php if (grup_modul_yetkisi_var(600)): ?>
					<li class="submenu <?php if ($uri=='kasa') echo 'active'; ?>">
						<a href="#"><i data-feather="server"></i> <span>Kasa</span> <span class="menu-arrow"></span></a>
						<ul>
							<?php if (grup_modul_yetkisi_var(610)): ?>
							<li><a href="<?= base_url("kasa/kasa-acilis-karti"); ?>"
								   class="<?php if ($uri2 == 'kasa-acilis-karti' || $uri2 == 'kasa-acilis-karti-duzenle') {
									   echo 'active';
								   } ?>">Kasa Açılış Kartı</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(620)): ?>
							<li><a href="<?= base_url("kasa/kasa-listesi"); ?>"
								   class="<?php if ($uri2 == 'kasa-listesi') {
									   echo 'active';
								   } ?>">Kasa Listesi</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(630)): ?>
							<li><a href="<?= base_url("kasa/kasa-hareket-kayitlari"); ?>"
								   class="<?php if ($uri2 == 'kasa-hareket-kayitlari') {
									   echo 'active';
								   } ?>">Kasa Hareket Kayıtları</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(640)): ?>
							<li><a href="<?= base_url("kasa/kasa-tahsilat"); ?>"
								   class="<?php if ($uri2 == 'kasa-tahsilat' || $uri2 == 'kasa-tahsilat-duzenle') {
									   echo 'active';
								   } ?>">Kasa Tahsilat</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(650)): ?>
							<li><a href="<?= base_url("kasa/kasa-odeme-islemi"); ?>"
								   class="<?php if ($uri2 == 'kasa-odeme-islemi' || $uri2 == 'kasa-odeme-islemi-duzenle') {
									   echo 'active';
								   } ?>">Kasa Ödeme İşlemi</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(660)): ?>
							<li><a href="<?= base_url("kasa/kasa-virman"); ?>"
								   class="<?php if ($uri2 == 'kasa-virman' || $uri2 == 'kasa-virman-duzenle') {
									   echo 'active';
								   } ?>">Kasa Virman</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(670)): ?>
							<li><a href="<?= base_url("kasa/kasadan-bankaya-transfer"); ?>"
								   class="<?php if ($uri2 == 'kasadan-bankaya-transfer' || $uri2 == 'kasadan-bankaya-transfer-duzenle') {
									   echo 'active';
								   } ?>">Kasadan Bankaya Transfer</a></li>
							<?php endif; ?>
						</ul>
					</li>
					<?php endif; ?>
					<!-- Banka Bölümü - Yetki kontrolleri kaldırıldı, herkes erişebilir -->
					<?php if (grup_modul_yetkisi_var(700)): ?>
					<li class="submenu <?php if ($uri == 'banka') {
						echo 'active';
					} ?>">
						<a href="#"><i data-feather="package"></i> <span> Banka</span> <span
									class="menu-arrow"></span></a>
						<ul>
							<?php if (grup_modul_yetkisi_var(710)): ?>
							<li><a href="<?= base_url("banka/banka-acilis-karti"); ?>"
								   class="<?php if ($uri2 == 'banka-acilis-karti' || $uri2 == 'banka-acilis-karti-duzenle') {
									   echo 'active';
								   } ?>">Banka Açılış Kartı</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(720)): ?>
							<li><a href="<?= base_url("banka/banka-listesi"); ?>"
								   class="<?php if ($uri2 == 'banka-listesi') {
									   echo 'active';
								   } ?>">Banka Listesi</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(730)): ?>
							<li><a href="<?= base_url("banka/banka-hareket-kayitlari"); ?>"
								   class="<?php if ($uri2 == 'banka-hareket-kayitlari') {
									   echo 'active';
								   } ?>">Banka Hareket Kayıtları</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(740)): ?>
							<li><a href="<?= base_url("banka/banka-havale"); ?>"
								   class="<?php if ($uri2 == 'banka-havale' || $uri2 == 'banka-havale-duzenle') {
									   echo 'active';
								   } ?>">Banka Havale / EFT</a></li>
							<?php endif; ?>
							<!-- <li><a href="<?= base_url("banka/banka-eft"); ?>" class="<?php if ($uri2 == 'banka-eft' || $uri2 == 'banka-eft-duzenle') {
								echo 'active';
							} ?>">Banka EFT İşlemleri</a></li> -->
							<?php if (grup_modul_yetkisi_var(750)): ?>
							<li><a href="<?= base_url("banka/banka-virman"); ?>"
								   class="<?php if ($uri2 == 'banka-virman' || $uri2 == 'banka-virman-duzenle') {
									   echo 'active';
								   } ?>">Banka Virman</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(760)): ?>
							<li><a href="<?= base_url("banka/bankadan-kasaya-transfer"); ?>"
								   class="<?php if ($uri2 == 'bankadan-kasaya-transfer' || $uri2 == 'bankadan-kasaya-transfer-duzenle') {
									   echo 'active';
								   } ?>">Bankadan Kasaya Transfer</a></li>
							<?php endif; ?>
						</ul>
					</li>
					<?php endif; ?>

					<?php if (grup_modul_yetkisi_var(800)): ?>
					<li class="submenu <?php if ($uri=='cek') echo 'active'; ?>">
						<a href="#"><i data-feather="file"></i> <span>Çek</span> <span class="menu-arrow"></span></a>
						<ul>
							<?php if (grup_modul_yetkisi_var(810)): ?>
							<li><a href="<?= base_url('cek/cek-portfoyu'); ?>" class="<?php if ($uri2=='cek-portfoyu') echo 'active'; ?>">Çek Portföyü</a></li>
							<?php endif; ?>
						</ul>
					</li>
					<?php endif; ?>
					<?php if (grup_modul_yetkisi_var(900)): ?>
					<li class="submenu <?php if ($uri=='senet') echo 'active'; ?>">
						<a href="#"><i data-feather="file-text"></i> <span>Senet</span> <span class="menu-arrow"></span></a>
						<ul>
							<?php if (grup_modul_yetkisi_var(910)): ?>
							<li><a href="<?= base_url('senet/senet-portfoyu'); ?>" class="<?php if ($uri2=='senet-portfoyu') echo 'active'; ?>">Senet Portföyü</a></li>
							<?php endif; ?>
						</ul>
					</li>
					<?php endif; ?>
					<!-- Giderler Bölümü - Yetki kontrolleri kaldırıldı, herkes erişebilir -->
					<?php if (grup_modul_yetkisi_var(1000)): ?>
					<li class="submenu <?php if ($uri == 'giderler') {
						echo 'active';
					} ?>">
						<a href="#"><i data-feather="percent"></i> <span> Giderler</span> <span class="menu-arrow"></span></a>
						<ul>
							<?php if (grup_modul_yetkisi_var(1010)): ?>
							<li><a href="<?= base_url("giderler/gider-ekle"); ?>"
								   class="<?php if ($uri2 == 'gider-ekle' || $uri2 == 'gider-duzenle') {
									   echo 'active';
								   } ?>">Gider Ekle</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(1020)): ?>
							<li><a href="<?= base_url("giderler/gider-listesi"); ?>"
								   class="<?php if ($uri2 == 'gider-listesi') {
									   echo 'active';
								   } ?>">Gider Listesi</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(1030)): ?>
							<li><a href="<?= base_url("giderler/gider-turleri"); ?>"
								   class="<?php if ($uri2 == 'gider-turleri') {
									   echo 'active';
								   } ?>">Gider Türleri</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(1040)): ?>
							<li><a href="<?= base_url("giderler/fis-yukle"); ?>"
								   class="<?php if ($uri2 == 'fis-yukle') {
									   echo 'active';
								   } ?>">Fiş / Fatura Yükle</a></li>
							<?php endif; ?>						</ul>					</li>
					<?php endif; ?>
					
					<!-- Muhasebe Bölümü -->
					<?php if (grup_modul_yetkisi_var(1350)): ?>
					<li class="submenu <?php if ($uri == 'muhase') {
						echo 'active';
					} ?>">
						<a href="#"><i data-feather="calculator"></i> <span>Muhasebe</span> <span class="menu-arrow"></span></a>
						<ul>
							<?php if (grup_modul_yetkisi_var(1360)): ?>
							<li><a href="<?= base_url("muhase/onay-bekleyen-tahsilatlar"); ?>"
								   class="<?php if ($uri2 == 'onay-bekleyen-tahsilatlar') {
									   echo 'active';
								   } ?>">Onay Bekleyen Tahsilatlar</a></li>
							<?php endif; ?>
						</ul>
					</li>
					<?php endif; ?>
					
							<!-- Raporlar Bölümü -->
					<?php if(grup_modul_yetkisi_var(1400)) { ?>
					<li>
						<a href="<?= base_url("raporlar"); ?>"><i data-feather="pie-chart"></i>
							<span>Raporlar</span></a>
					</li>
					<?php } ?>
					
					<!-- Teklif menüsü -->
					<?php if (grup_modul_yetkisi_var(1500)): ?>
					<li class="submenu <?php if($uri=='teklif') echo 'active'; ?>" style="background-color:#e31a1c30!important;">
						<a href="#"><i data-feather="file-text"></i> <span>Teklif</span> <span class="menu-arrow"></span></a>
						<ul>
							<?php if (grup_modul_yetkisi_var(1510)): ?>
							<li><a href="<?= base_url('teklif/teklif-hazirla'); ?>" class="<?php if($uri=='teklif' && $uri2=='teklif-hazirla') echo 'active'; ?>">Teklif Gör</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(1520)): ?>
							<li><a href="<?= base_url('teklif/teklif-listele'); ?>" class="<?php if($uri=='teklif' && $uri2=='teklif-listele') echo 'active'; ?>">Teklif Listesi</a></li>
							<?php endif; ?>
							<?php if (grup_modul_yetkisi_var(1530)): ?>
							<li><a href="<?= base_url('teklif/teklif-ayar'); ?>" class="<?php if($uri=='teklif' && $uri2=='teklif-ayar') echo 'active'; ?>">Teklif Ayarları</a></li>
							<?php endif; ?>
						</ul>
					</li>
					<?php endif; ?>
					
					<!-- Admin Bölümü - Yetki kontrolleri kaldırıldı, sadece user_id = 2 kontrolü kaldı -->
					<?php if (grup_modul_yetkisi_var(1100)) { ?>
						<li class="submenu <?php if ($uri == 'admin') {
							echo 'active';
						} ?>" style="background-color:#e31a1c30!important;">
							<a href="#"><i data-feather="shield"></i> <span> Admin</span> <span
										class="menu-arrow"></span></a>
							<ul>
								<?php if (grup_modul_yetkisi_var(1110)): ?>
								<li><a href="<?= base_url("admin/firma-yonetimi"); ?>"
									   class="<?php if ($uri2 == 'firma-yonetimi') {
										   echo 'active';
									   } ?>">Firma Yönetimi</a></li>
								<?php endif; ?>
								<?php if (grup_modul_yetkisi_var(1120)): ?>
								<li><a href="<?= base_url("admin/genel-log-kayitlari"); ?>"
									   class="<?php if ($uri2 == 'genel-log-kayitlari') {									   echo 'active';
									   } ?>">Genel Log Kayıtları</a></li>
								<?php endif; ?>
								<?php if (grup_modul_yetkisi_var(1130) && !$is_kisitli) { ?>
								<li><a href="<?= base_url("admin/destek"); ?>"
									   class="<?php if ($uri2 == 'destek') {
										   echo 'active';
									   } ?>">Destek Sistemi (<?= getirActiveTickets()->total; ?>)</a></li>
								<?php } ?>
								<?php if (grup_modul_yetkisi_var(1140)): ?>
								<li><a href="<?= base_url("admin/duyurular"); ?>"
									   class="<?php if ($uri2 == 'duyurular') {
										   echo 'active';
									   } ?>">Duyurular</a></li>
								<?php endif; ?>
							</ul>
						</li>
					<?php } ?>
				<!-- Yönetici Bölümü - Permission Based Menu System -->
				<?php 
				// Debug kodları - Session kontrolü
				$control2 = session("r", "login_info");
				// Yönetici (Ana Menü): 1200 için yetki kontrolü
				$yetki_kontrolu = grup_modul_yetkisi_var(1200);
				$destek_yetki_kontrolu = grup_modul_yetkisi_var(1300);
				$raporlar_yetki_kontrolu = grup_modul_yetkisi_var(1400);
				$kullanici_id = $control2 ? $control2->kullanici_id : 'YOK';
				$grup_id = $control2 ? $control2->grup_id : 'YOK';
				
				// Detaylı debug bilgisi
				echo "<!-- YONETICI DEBUG DETAILED: User=$kullanici_id, Group=$grup_id, Yetki(1200)=" . ($yetki_kontrolu ? 'TRUE' : 'FALSE') . " -->";
				echo "<!-- YONETICI MODULE 1200 CHECK: " . (isset($GLOBALS['kullanici_grup_yetkileri'][1200]) ? 'VARDIR' : 'YOK') . " -->";
				echo "<!-- DESTEK MODULE 1300 CHECK: " . (isset($GLOBALS['kullanici_grup_yetkileri'][1300]) ? 'VARDIR' : 'YOK') . ", YETKI: " . ($destek_yetki_kontrolu ? 'TRUE' : 'FALSE') . " -->";
				echo "<!-- RAPORLAR MODULE 1400 CHECK: " . (isset($GLOBALS['kullanici_grup_yetkileri'][1400]) ? 'VARDIR' : 'YOK') . ", YETKI: " . ($raporlar_yetki_kontrolu ? 'TRUE' : 'FALSE') . " -->";

if($yetki_kontrolu) { ?>
	<li class="submenu <?php if ($uri == 'yonetici') {
		echo 'active';
	} ?>">
		<a href="#"><i data-feather="settings"></i> <span> Yönetici</span> <span
					class="menu-arrow"></span></a>		<ul>
			<li><a href="<?= base_url("yonetici/kullanici-listesi"); ?>"
				   class="<?php if ($uri2 == 'kullanici-listesi') {
					   echo 'active';
				   } ?>">Kullanıcı Listesi</a></li>
			<li><a href="<?= base_url("yonetici/kullaniciGrubu"); ?>"
				   class="<?php if ($uri2 == 'kullaniciGrubu' || $uri2 == 'kullaniciGrubuduzenle') {
					   echo 'active';
				   } ?>">Kullanıcı Grupları</a></li>
			<li><a href="<?= base_url("yonetici/kullanici-loglari"); ?>"
				   class="<?php if ($uri2 == 'kullanici-loglari') echo 'active'; ?>">Kullanıcı Logları</a></li>			<li><a href="<?= base_url("yonetici/sorumluluk-bolgesi"); ?>"
				   class="<?php if ($uri2 == 'sorumluluk-bolgesi') {
					   echo 'active';
				   } ?>">Sorumluluk Bölgesi</a></li>
			<li><a href="<?= base_url("yonetici/ayarlar"); ?>"
				   class="<?php if ($uri2 == 'ayarlar') {
					   echo 'active';
				   } ?>">Ayarlar</a></li>

		</ul>
	</li>
<?php } ?>				<?php if($destek_yetki_kontrolu) { ?>
<li>
	<a href="<?= base_url("destek"); ?>"><i data-feather="life-buoy" class="mr-1"></i> <span>Destek</span></a>
</li>
<?php } ?>				<!-- Şifremi Değiştir ve Çıkış Yap menüleri gizlendi
				<li>
					<a href="<?= base_url("kullanici/sifre-degistir"); ?>"><i data-feather="key"></i> <span>Şifremi Değiştir</span></a>
				</li>
				<li>
					<a href="<?= base_url("home/logout"); ?>"><i data-feather="log-out"></i> <span>Çıkış Yap</span></a>
				</li>
				-->
			</ul>
		</div>
		
		<!-- Kullanıcı Menüsü -->
		<?php
		// Kullanıcı bilgilerini al
		$kullanici_ad = $control2->kullanici_ad ?? 'Kullanıcı';
		$kullanici_soyad = $control2->kullanici_soyad ?? '';
		$tam_ad = trim($kullanici_ad . ' ' . $kullanici_soyad);
		
		// Kullanıcı grup adını al
		$grup_adi = 'Grup Atanmamış';
		if(isset($control2->grup_id) && $control2->grup_id) {
			$grup_sorgu = $this->db->query("SELECT kg_adi FROM kullanici_grubu WHERE kg_id = ?", array($control2->grup_id));
			if($grup_sorgu->num_rows() > 0) {
				$grup_result = $grup_sorgu->row();
				$grup_adi = $grup_result->kg_adi;
			}
		}
		?>
		<div class="user-menu-section">
			<div class="user-info-card">
				<div class="user-avatar">
					<i class="fas fa-user-circle"></i>
				</div>
				<div class="user-details">
					<div class="user-name"><?= htmlspecialchars($tam_ad) ?></div>
					<div class="user-group"><?= htmlspecialchars($grup_adi) ?></div>
				</div>
			</div>
			<div class="user-actions">
				<a href="<?= base_url("kullanici/sifre-degistir"); ?>" class="user-action-btn">
					<i class="fas fa-key"></i>
					<span>Şifre Değiştir</span>
				</a>
				<a href="<?= base_url("home/logout"); ?>" class="user-action-btn logout-btn">
					<i class="fas fa-sign-out-alt"></i>
					<span>Çıkış Yap</span>
				</a>
			</div>
		</div>
	</div>
</div>

<style>
.user-menu-section {
	/* Desktop: sidebar içinde relative position */
	position: relative;
	bottom: auto;
	left: auto;
	width: 100%;
	background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
	color: white;
	border-top: 1px solid rgba(255,255,255,0.1);
	margin-top: 20px;
}

.user-info-card {
	padding: 15px;
	display: flex;
	align-items: center;
	border-bottom: 1px solid rgba(255,255,255,0.1);
}

.user-avatar {
	margin-right: 12px;
}

.user-avatar i {
	font-size: 35px;
	color: rgba(255,255,255,0.9);
}

.user-details {
	flex: 1;
	min-width: 0;
}

.user-name {
	font-size: 14px;
	font-weight: 600;
	margin-bottom: 2px;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}

.user-group {
	font-size: 11px;
	opacity: 0.8;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}

.user-actions {
	padding: 8px;
}

.user-action-btn {
	display: flex;
	align-items: center;
	padding: 8px 12px;
	color: white;
	text-decoration: none;
	border-radius: 6px;
	transition: all 0.2s ease;
	font-size: 13px;
	margin-bottom: 4px;
}

.user-action-btn:hover {
	background: rgba(255,255,255,0.1);
	color: white;
	text-decoration: none;
	transform: translateX(2px);
}

.user-action-btn.logout-btn:hover {
	background: rgba(220, 53, 69, 0.2);
}

.user-action-btn i {
	margin-right: 8px;
	font-size: 12px;
	width: 14px;
	text-align: center;
}

.user-action-btn span {
	flex: 1;
}

/* Sidebar kapatıldığında gizle */
.sidebar.sidebar-collapse .user-menu-section {
	display: none;
}

/* Mobil responsive - sidebar içinde kalır */
@media (max-width: 768px) {
	.user-menu-section {
		position: relative !important;
		bottom: auto !important;
		left: auto !important;
		width: 100% !important;
		z-index: auto !important;
		margin-top: 20px !important;
		margin-bottom: 0 !important;
	}
	
	.user-info-card {
		padding: 12px 15px;
	}
	
	.user-avatar i {
		font-size: 30px;
	}
	
	.user-name {
		font-size: 13px;
	}
	
	.user-group {
		font-size: 10px;
	}
	
	.user-action-btn {
		padding: 10px 15px;
		font-size: 14px;
	}
	
	/* Mobilde sidebar açıkken body'ye padding gerekmez */
	body {
		padding-bottom: 0 !important;
	}
}

/* Dark mode uyumu */
@media (prefers-color-scheme: dark) {
	.user-menu-section {
		background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
	}
}
</style>
