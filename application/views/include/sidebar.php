<?php
$uri = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);

$control2 = session("r", "login_info");
$u_id = $control2->kullanici_id;
$yetki = $control2->kullanici_yetki;

$firmaID = getirFirma();
$firma_ID = $firmaID->ayarlar_id;

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
				<?php }
				else if($modulOcrSorgula)
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

				<?php } else {

					//cari yetkileri
					$yetkiSorgula1_cari = yetkiSorgula($u_id, 1, 1);
					$yetkiSorgula2_cari = yetkiSorgula($u_id, 1, 2);
					$yetkiSorgula3_cari = yetkiSorgula($u_id, 1, 3);
					$yetkiSorgula4_cari = yetkiSorgula($u_id, 1, 4);
					$yetkiSorgula5_cari = yetkiSorgula($u_id, 1, 5);
					$yetkiSorgula6_cari = yetkiSorgula($u_id, 1, 6);
					$yetkiSorgula7_cari = yetkiSorgula($u_id, 1, 7);
					$yetkiSorgula8_cari = yetkiSorgula($u_id, 1, 8);
					$yetkiSorgula9_cari = yetkiSorgula($u_id, 1, 9);

					//stok yetkileri
					$yetkiSorgula1_stok = yetkiSorgula($u_id, 2, 1);
					$yetkiSorgula2_stok = yetkiSorgula($u_id, 2, 2);
					$yetkiSorgula3_stok = yetkiSorgula($u_id, 2, 3);
					$yetkiSorgula4_stok = yetkiSorgula($u_id, 2, 4);
					$yetkiSorgula5_stok = yetkiSorgula($u_id, 2, 5);
					$yetkiSorgula6_stok = yetkiSorgula($u_id, 2, 6);
					$yetkiSorgula7_stok = yetkiSorgula($u_id, 2, 7);
					/* $yetkiSorgula8_stok = yetkiSorgula($u_id,2,8);
					$yetkiSorgula9_stok = yetkiSorgula($u_id,2,9);
					$yetkiSorgula10_stok = yetkiSorgula($u_id,2,10); */

					//fatura yetkileri
					$yetkiSorgula1_fatura = yetkiSorgula($u_id, 3, 1);
					$yetkiSorgula2_fatura = yetkiSorgula($u_id, 3, 2);
					$yetkiSorgula3_fatura = yetkiSorgula($u_id, 3, 3);
					$yetkiSorgula4_fatura = yetkiSorgula($u_id, 3, 4);
					$yetkiSorgula5_fatura = yetkiSorgula($u_id, 3, 5);
					$yetkiSorgula6_fatura = yetkiSorgula($u_id, 3, 6);
					$yetkiSorgula7_efatura = yetkiSorgula($u_id, 3, 7); // e-Fatura
					$yetkiSorgula8_earsiv = yetkiSorgula($u_id, 3, 8); // e-Arşiv

					//kasa yetkileri
					$yetkiSorgula1_kasa = yetkiSorgula($u_id, 4, 1);
					$yetkiSorgula2_kasa = yetkiSorgula($u_id, 4, 2);
					$yetkiSorgula3_kasa = yetkiSorgula($u_id, 4, 3);
					$yetkiSorgula4_kasa = yetkiSorgula($u_id, 4, 4);
					$yetkiSorgula5_kasa = yetkiSorgula($u_id, 4, 5);
					$yetkiSorgula6_kasa = yetkiSorgula($u_id, 4, 6);
					$yetkiSorgula7_kasa = yetkiSorgula($u_id, 4, 7);
					$yetkiSorgula8_kasa = yetkiSorgula($u_id, 4, 8);
					$yetkiSorgula9_kasa = yetkiSorgula($u_id, 4, 9);
					$yetkiSorgula10_kasa = yetkiSorgula($u_id, 4, 10);
					$yetkiSorgula11_kasa = yetkiSorgula($u_id, 4, 11);
					$yetkiSorgula12_kasa = yetkiSorgula($u_id, 4, 12);

					//banka yetkileri
					$yetkiSorgula1_banka = yetkiSorgula($u_id, 5, 1);
					$yetkiSorgula2_banka = yetkiSorgula($u_id, 5, 2);
					$yetkiSorgula3_banka = yetkiSorgula($u_id, 5, 3);
					$yetkiSorgula4_banka = yetkiSorgula($u_id, 5, 4);
					$yetkiSorgula5_banka = yetkiSorgula($u_id, 5, 5);
					$yetkiSorgula6_banka = yetkiSorgula($u_id, 5, 6);
					$yetkiSorgula7_banka = yetkiSorgula($u_id, 5, 7);
					$yetkiSorgula8_banka = yetkiSorgula($u_id, 5, 8);
					$yetkiSorgula9_banka = yetkiSorgula($u_id, 5, 9);
					$yetkiSorgula10_banka = yetkiSorgula($u_id, 5, 10);
					$yetkiSorgula11_banka = yetkiSorgula($u_id, 5, 11);
					$yetkiSorgula12_banka = yetkiSorgula($u_id, 5, 12);

					//raporlar
					/*
					$yetkiSorgula1_rapor = yetkiSorgula($u_id,6,1);
					$yetkiSorgula2_rapor = yetkiSorgula($u_id,6,2);
					$yetkiSorgula3_rapor = yetkiSorgula($u_id,6,3);
					$yetkiSorgula4_rapor = yetkiSorgula($u_id,6,4);
					$yetkiSorgula5_rapor = yetkiSorgula($u_id,6,5);
					$yetkiSorgula6_rapor = yetkiSorgula($u_id,6,6);
					$yetkiSorgula7_rapor = yetkiSorgula($u_id,6,7);*/

					//giderler
					$yetkiSorgula1_giderler = yetkiSorgula($u_id, 7, 1);
					$yetkiSorgula2_giderler = yetkiSorgula($u_id, 7, 2);
					$yetkiSorgula3_giderler = yetkiSorgula($u_id, 7, 3);
					$yetkiSorgula4_giderler = yetkiSorgula($u_id, 7, 4);
					$yetkiSorgula5_giderler = yetkiSorgula($u_id, 7, 5);
					?>

					<?php if ($yetki == 1) { ?>
						<li class="submenu <?php if ($uri == 'cari') {
							echo 'active';
						} ?>">
							<a href="#"><i data-feather="user"></i> <span> Müşteri</span> <span class="menu-arrow"></span></a>
							<ul>
								<li><a href="<?= base_url("cari/cari-karti-olustur"); ?>"
									   class="<?php if ($uri2 == 'cari-karti-olustur' || $uri2 == 'cari-karti-duzenle') {
										   echo 'active';
									   } ?>">Müşteri Oluştur</a></li>
								<li><a href="<?= base_url("cari/cari-listesi"); ?>"
									   class="<?php if ($uri2 == 'cari-listesi') {
										   echo 'active';
									   } ?>">Müşteri Listesi</a></li>
								<li><a href="<?= base_url("cari/cari-hareketleri"); ?>"
									   class="<?php if ($uri2 == 'cari-hareketleri') {
										   echo 'active';
									   } ?>">Müşteri Hareketleri</a></li>
								<li><a href="<?= base_url("cari/cari-gruplari"); ?>"
									   class="<?php if ($uri2 == 'cari-gruplari') {
										   echo 'active';
									   } ?>">Müşteri Grupları</a></li>
								<li><a href="<?= base_url("cari/cari-dekont"); ?>"
									   class="<?php if ($uri2 == 'cari-dekont') {
										   echo 'active';
									   } ?>">Müşteri Dekont</a></li>
							</ul>
						</li>
					<?php } else { ?>
						<?php if ($yetkiSorgul1_cari || $yetkiSorgula2_cari || $yetkiSorgula3_cari || $yetkiSorgula4_cari || $yetkiSorgula5_cari || $yetkiSorgula6_cari || $yetkiSorgula7_cari || $yetkiSorgula8_cari || $yetkiSorgula9_cari) { ?>
							<li class="submenu <?php if ($uri == 'cari') {
								echo 'active';
							} ?>">
								<a href="#"><i data-feather="user"></i> <span> Müşteri</span> <span
											class="menu-arrow"></span></a>
								<ul>
									<?php if ($yetkiSorgula1_cari || $yetkiSorgula2_cari) { ?>
										<li><a href="<?= base_url("cari/cari-karti-olustur"); ?>"
											   class="<?php if ($uri2 == 'cari-karti-olustur' || $uri2 == 'cari-karti-duzenle') {
												   echo 'active';
											   } ?>">Müşteri Açılış Kartı</a></li>
									<?php } ?>

									<?php if ($yetkiSorgula3_cari) { ?>
										<li><a href="<?= base_url("cari/cari-listesi"); ?>"
											   class="<?php if ($uri2 == 'cari-listesi') {
												   echo 'active';
											   } ?>">Müşteri Listesi</a></li>
									<?php } ?>

									<?php if ($yetkiSorgula4_cari) { ?>
										<li><a href="<?= base_url("cari/cari-hareketleri"); ?>"
											   class="<?php if ($uri2 == 'cari-hareketleri') {
												   echo 'active';
											   } ?>">Müşteri Hareketleri</a></li>
									<?php } ?>

									<?php if ($yetkiSorgula5_cari || $yetkiSorgula6_cari || $yetkiSorgula7_cari) { ?>
										<li><a href="<?= base_url("cari/cari-gruplari"); ?>"
											   class="<?php if ($uri2 == 'cari-gruplari') {
												   echo 'active';
											   } ?>">Müşteri Grupları</a></li>
									<?php } ?>

									<?php if ($yetkiSorgula8_cari || $yetkiSorgula9_cari) { ?>
										<li><a href="<?= base_url("cari/cari-dekont"); ?>"
											   class="<?php if ($uri2 == 'cari-dekont') {
												   echo 'active';
											   } ?>">Müşteri Dekont</a></li>
									<?php } ?>
								</ul>
							</li>
						<?php }
					} ?>

					<?php if ($yetki == 1) { ?>
						<li class="submenu <?php if ($uri == 'stok') {
							echo 'active';
						} ?>">
							<a href="#"><i data-feather="inbox"></i> <span> Stok</span> <span class="menu-arrow"></span></a>
							<ul>
								<li><a href="<?= base_url("stok/stok-karti-olustur"); ?>"
									   class="<?php if ($uri2 == 'stok-karti-olustur' || $uri2 == 'stok-karti-duzenle') {
										   echo 'active';
									   } ?>">Stok Açılış Kartı</a></li>
								<li><a href="<?= base_url("stok/stok-listesi"); ?>"
									   class="<?php if ($uri2 == 'stok-listesi') {
										   echo 'active';
									   } ?>">Stok Listesi</a></li>
								<li><a href="<?= base_url("stok/stok-hareketleri"); ?>"
									   class="<?php if ($uri2 == 'stok-hareketleri') {
										   echo 'active';
									   } ?>">Stok Hareketleri</a></li>
								<li><a href="<?= base_url("stok/stok-gruplari"); ?>"
									   class="<?php if ($uri2 == 'stok-gruplari') {
										   echo 'active';
									   } ?>">Stok Grupları</a></li>
								<!-- <li><a href="<?= base_url("stok/stok-birimleri"); ?>" class="<?php if ($uri2 == 'stok-birimleri') {
									echo 'active';
								} ?>">Stok Birimleri</a></li> -->
								<!-- <li><a href="#">Çoklu Stok İşlemleri</a></li> -->
							</ul>
						</li>
					<?php } else { ?>
						<?php if ($yetkiSorgul1_stok || $yetkiSorgula2_stok || $yetkiSorgula3_stok || $yetkiSorgula4_stok || $yetkiSorgula5_stok || $yetkiSorgula6_stok || $yetkiSorgula7_stok || $yetkiSorgula8_stok || $yetkiSorgula9_stok || $yetkiSorgula10_stok) { ?>
							<li class="submenu <?php if ($uri == 'stok') {
								echo 'active';
							} ?>">
								<a href="#"><i data-feather="inbox"></i> <span> Stok</span> <span
											class="menu-arrow"></span></a>
								<ul>
									<?php if ($yetkiSorgula1_stok || $yetkiSorgula2_stok) { ?>
										<li><a href="<?= base_url("stok/stok-karti-olustur"); ?>"
											   class="<?php if ($uri2 == 'stok-karti-olustur' || $uri2 == 'stok-karti-duzenle') {
												   echo 'active';
											   } ?>">Stok Açılış Kartı</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula3_stok) { ?>
										<li><a href="<?= base_url("stok/stok-listesi"); ?>"
											   class="<?php if ($uri2 == 'stok-listesi') {
												   echo 'active';
											   } ?>">Stok Listesi</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula4_stok) { ?>
										<li><a href="<?= base_url("stok/stok-hareketleri"); ?>"
											   class="<?php if ($uri2 == 'stok-hareketleri') {
												   echo 'active';
											   } ?>">Stok Hareketleri</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula5_stok || $yetkiSorgula6_stok || $yetkiSorgula7_stok) { ?>
										<li><a href="<?= base_url("stok/stok-gruplari"); ?>"
											   class="<?php if ($uri2 == 'stok-gruplari') {
												   echo 'active';
											   } ?>">Stok Grupları</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula8_stok || $yetkiSorgula9_stok || $yetkiSorgula10_stok) { ?>
										<!-- <li><a href="<?= base_url("stok/stok-birimleri"); ?>" class="<?php if ($uri2 == 'stok-birimleri') {
											echo 'active';
										} ?>">Stok Birimleri</a></li> -->
									<?php } ?>
									<!-- <li><a href="#">Çoklu Stok İşlemleri</a></li> -->
								</ul>
							</li>
						<?php }
					} ?>

					<?php if ($yetki == 1) { ?>
						<li class="submenu <?php if ($uri == 'fatura') {
							echo 'active';
						} ?>">
							<a href="#"><i data-feather="clipboard"></i> <span> Satış</span> <span
										class="menu-arrow"></span></a>
							<ul>
								<li><a href="<?= base_url("fatura/satis-faturasi"); ?>"
									   class="<?php if ($uri2 == 'satis-faturasi' || $uri2 == 'satis-faturasi-duzenle') {
										   echo 'active';
									   } ?>">Satış Sözleşmesi</a></li>
								<li><a href="<?= base_url("fatura/satis-faturasi-listesi"); ?>"
									   class="<?php if ($uri2 == 'satis-faturasi-listesi') {
										   echo 'active';
									   } ?>">Satış Sözleşmesi Listesi</a></li>
								<li><a href="<?= base_url("fatura/alis-faturasi"); ?>"
									   class="<?php if ($uri2 == 'alis-faturasi' || $uri2 == 'alis-faturasi-duzenle') {
										   echo 'active';
									   } ?>">Alış Faturası</a></li>
								<li><a href="<?= base_url("fatura/alis-faturasi-listesi"); ?>"
									   class="<?php if ($uri2 == 'alis-faturasi-listesi') {
										   echo 'active';
									   } ?>">Alış Faturası Listesi</a></li>
								<li><a href="<?= base_url("fatura/proforma-faturasi"); ?>"
									   class="<?php if ($uri2 == 'proforma-faturasi' || $uri2 == 'proforma-faturasi-duzenle') {
										   echo 'active';
									   } ?>">Proforma Faturası</a></li>
								<li><a href="<?= base_url("fatura/proforma-listesi"); ?>"
									   class="<?php if ($uri2 == 'proforma-listesi') {
										   echo 'active';
									   } ?>">Proforma Faturası Listesi</a></li>
								<hr>
								<li><a href="<?= base_url("fatura/etiketler"); ?>"
									   class="<?php if ($uri2 == 'etiketler') {
										   echo 'active';
									   } ?>">
										Etiketler</a></li>
								<?php if ($modulSorgula) { ?>
									<hr>
									<li><a href="<?= base_url("fatura/efatura-olustur"); ?>"
										   class="<?php if ($uri2 == 'efatura-olustur') {
											   echo 'active';
										   } ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip'
													data-placement='top' title='e-Fatura'></i> e-Fatura Oluştur</a></li>
									<li><a href="<?= base_url("fatura/efatura-gelen"); ?>"
										   class="<?php if ($uri2 == 'efatura-gelen') {
											   echo 'active';
										   } ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip'
													data-placement='top' title='e-Fatura'></i> e-Fatura Gelen Kutusu</a>
									</li>
									<li><a href="<?= base_url("fatura/efatura-giden"); ?>"
										   class="<?php if ($uri2 == 'efatura-giden') {
											   echo 'active';
										   } ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip'
													data-placement='top' title='e-Fatura'></i> e-Fatura Giden Kutusu</a>
									</li>
									<hr>
									<li><a href="<?= base_url("fatura/earsiv-olustur"); ?>"
										   class="<?php if ($uri2 == 'earsiv-olustur') {
											   echo 'active';
										   } ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip'
													data-placement='top' title='e-Arşiv'></i> e-Arşiv Fatura Oluştur</a>
									</li>
									<li><a href="<?= base_url("fatura/earsiv-faturalari"); ?>"
										   class="<?php if ($uri2 == 'earsiv-faturalari') {
											   echo 'active';
										   } ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip'
													data-placement='top' title='e-Arşiv'></i> e-Arşiv Faturaları</a>
									</li>
									<hr>
									<?php
									$endDate = date("d-m-Y");
									$startDate = date("d-m-Y", strtotime('-7 day', strtotime($endDate)));
									?>
									<li><a href="<?= base_url("gib/adima-duzenlenen-belgeler?tarihAraligi=$startDate+%26+$endDate"); ?>" class="<?php if ($uri2 == 'adima-duzenlenen-belgeler') {
											echo 'active';
										} ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip'
													data-placement='top' title=''></i> GIB/IVD Gelen e-Arşiv</a>
									</li>
									<hr>
									<li><a href="<?= base_url("fatura/taslak-fatura-yukle"); ?>"
										   class="<?php if ($uri2 == 'taslak-fatura-yukle') {
											   echo 'active';
										   } ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip'
													data-placement='top' title='Taslak Fatura'></i> Taslak Fatura Yükle</a>
									</li>
								<?php } else if ($modulGibProSorgula) {
									?>
									<li class="menu-title">
										<span>Gib</span>
									</li>

									<li class="<?php if ($uri2 == 'fatura-olustur') {
										echo 'active';
									} ?>">
										<a href="<?= base_url("gib/fatura-olustur"); ?>">
											Fatura Oluştur</a>
									</li>
									<?php

									$endDate = date("d-m-Y");
									$startDate = date("d-m-Y", strtotime('-7 day', strtotime($endDate)));
									?>
									<li class="<?php if ($uri2 == 'duzenlenen-belgeler') {
										echo 'active';
									} ?>">
										<a href="<?= base_url("gib/duzenlenen-belgeler?tarihAraligi=$startDate+%26+$endDate"); ?>">Düzenlenen Belgeler</a>
									</li>

									<li class="<?php if ($uri2 == 'adima-duzenlenen-belgeler') {
										echo 'active';
									} ?>">
										<a href="<?= base_url("gib/adima-duzenlenen-belgeler?tarihAraligi=$startDate+%26+$endDate"); ?>">Adıma Düzenlenen Belgeler</a>
									</li>
									<li class="<?php if ($uri2 == 'gib-bilgi') {
										echo 'active';
									} ?>">
										<a href="<?= base_url("gib/gib-bilgi"); ?>">GİB Bilgileri</a>
									</li>
								<?php }
								if($irsaliyeModulSorgulama){?>
									<hr>
									<li><a href="<?= base_url("fatura/eirsaliye-olustur"); ?>" class="<?php if ($uri2 == 'eirsaliye-olustur') {echo 'active';} ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip' data-placement='top' title='e-İrsaliye'></i> e-İrsaliye Oluştur</a></li>

									<li><a href="<?= base_url("fatura/eirsaliye-gelen"); ?>" class="<?php if ($uri2 == 'eirsaliye-gelen') {echo 'active';} ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip' data-placement='top' title='e-İrsaliye'></i> Gelen e-İrsaliye</a></li>

									<li><a href="<?= base_url("fatura/eirsaliye-giden"); ?>" class="<?php if ($uri2 == 'eirsaliye-giden') {echo 'active';} ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip' data-placement='top' title='e-İrsaliye'></i> Giden e-İrsaliye</a></li>
								<?php } ?>

								<?php if($modulSorgula || $irsaliyeModulSorgulama){ ?>
										<hr>
									<li><a href="<?= base_url("fatura/seri-yonetimi"); ?>"
										   class="<?php if ($uri2 == 'seri-yonetimi') {
											   echo 'active';
										   } ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip'
													data-placement='top' title='e-Fatura / e-Arşiv Fatura'></i> Seri
											Yönetimi</a></li>
								<?php } ?>
							</ul>
						</li>
					<?php } else { ?>
						<?php if ($yetkiSorgula1_fatura || $yetkiSorgula2_fatura || $yetkiSorgula3_fatura || $yetkiSorgula4_fatura || $yetkiSorgula5_fatura || $yetkiSorgula6_fatura || $yetkiSorgula7_efatura || $yetkiSorgula8_earsiv) { ?>
							<li class="submenu <?php if ($uri == 'fatura') {
								echo 'active';
							} ?>">
								<a href="#"><i data-feather="clipboard"></i> <span> Satış</span> <span
											class="menu-arrow"></span></a>
								<ul>
									<?php if ($yetkiSorgula2_fatura || $yetkiSorgula3_fatura) { ?>
										<li><a href="<?= base_url("fatura/satis-faturasi"); ?>"
											   class="<?php if ($uri2 == 'satis-faturasi' || $uri2 == 'satis-faturasi-duzenle') {
												   echo 'active';
											   } ?>">Satış Sözleşmesi</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula1_fatura) { ?>
										<li><a href="<?= base_url("fatura/satis-faturasi-listesi"); ?>"
											   class="<?php if ($uri2 == 'satis-faturasi-listesi') {
												   echo 'active';
											   } ?>">Satış Sözleşmesi Listesi</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula5_fatura || $yetkiSorgula6_fatura) { ?>
										<li><a href="<?= base_url("fatura/alis-faturasi"); ?>
											   class="<?php if ($uri2 == 'alis-faturasi' || $uri2 == 'alis-faturasi-duzenle') {
												   echo 'active';
											   } ?>">Alış Faturası</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula4_fatura) { ?>
										<li><a href="<?= base_url("fatura/alis-faturasi-listesi"); ?>"
											   class="<?php if ($uri2 == 'alis-faturasi-listesi') {
												   echo 'active';
											   } ?>">Alış Faturası Listesi</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula7_efatura) { ?>
										<li><a href="<?= base_url("fatura/efatura-olustur"); ?>"
											   class="<?php if ($uri2 == 'efatura-olustur') {
												   echo 'active';
											   } ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip'
														data-placement='top' title='e-Fatura'></i> e-Fatura Oluştur</a>
									</li>
										<li><a href="<?= base_url("fatura/efatura-gelen"); ?>"
											   class="<?php if ($uri2 == 'efatura-gelen') {
												   echo 'active';
											   } ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip'
														data-placement='top' title='e-Fatura'></i> e-Fatura Gelen Kutusu</a>
									</li>
										<li><a href="<?= base_url("fatura/efatura-giden"); ?>"
											   class="<?php if ($uri2 == 'efatura-giden') {
												   echo 'active';
											   } ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip'
														data-placement='top' title='e-Fatura'></i> e-Fatura Giden Kutusu</a>
									<?php } ?>
									<?php if ($yetkiSorgula8_earsiv) { ?>
										<li><a href="<?= base_url("fatura/earsiv-olustur"); ?>"
											   class="<?php if ($uri2 == 'earsiv-olustur') {
												   echo 'active';
											   } ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip'
														data-placement='top' title='e-Arşiv'></i> e-Arşiv Fatura Oluştur</a>
										</li>
										<li><a href="<?= base_url("fatura/earsiv-faturalari"); ?>"
											   class="<?php if ($uri2 == 'earsiv-faturalari') {
												   echo 'active';
											   } ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip'
														data-placement='top' title='e-Arşiv'></i> e-Arşiv Faturaları</a>
									<?php } ?>
									<?php if ($yetkiSorgula7_efatura || $yetkiSorgula8_earsiv) { ?>
										<li><a href="<?= base_url("fatura/seri-yonetimi"); ?>"
											   class="<?php if ($uri2 == 'seri-yonetimi') {
												   echo 'active';
											   } ?>"><i class='fa fa-file-invoice text-dark' data-toggle='tooltip'
														data-placement='top' title='e-Fatura / e-Arşiv Fatura'></i> Seri
												Yönetimi</a></li>									<?php } ?>
								</ul>
							</li>						<?php }
					} ?>

					<!-- Tahsilat menüsü -->
					<li class="<?php if ($uri == 'tahsilat') {
						echo 'active';
					} ?>">
						<a href="<?= base_url("tahsilat/tahsilat-olustur"); ?>"><i data-feather="dollar-sign"></i> <span>Tahsilat</span></a>
					</li>

					<?php if ($yetki == 1) { ?>
						<li class="submenu <?php if ($uri == 'kasa') {
							echo 'active';
						} ?>">
							<a href="#"><i data-feather="server"></i> <span> Kasa</span> <span
										class="menu-arrow"></span></a>
							<ul>
								<li><a href="<?= base_url("kasa/kasa-acilis-karti"); ?>"
									   class="<?php if ($uri2 == 'kasa-acilis-karti' || $uri2 == 'kasa-acilis-karti-duzenle') {
										   echo 'active';
									   } ?>">Kasa Açılış Kartı</a></li>
								<li><a href="<?= base_url("kasa/kasa-listesi"); ?>"
									   class="<?php if ($uri2 == 'kasa-listesi') {
										   echo 'active';
									   } ?>">Kasa Listesi</a></li>
								<li><a href="<?= base_url("kasa/kasa-hareket-kayitlari"); ?>"
									   class="<?php if ($uri2 == 'kasa-hareket-kayitlari') {
										   echo 'active';
									   } ?>">Kasa Hareket Kayıtları</a></li>
								<li><a href="<?= base_url("kasa/kasa-tahsilat"); ?>"
									   class="<?php if ($uri2 == 'kasa-tahsilat' || $uri2 == 'kasa-tahsilat-duzenle') {
										   echo 'active';
									   } ?>">Kasa Tahsilat</a></li>
								<li><a href="<?= base_url("kasa/kasa-odeme-islemi"); ?>"
									   class="<?php if ($uri2 == 'kasa-odeme-islemi' || $uri2 == 'kasa-odeme-islemi-duzenle') {
										   echo 'active';
									   } ?>">Kasa Ödeme İşlemi</a></li>
								<li><a href="<?= base_url("kasa/kasa-virman"); ?>"
									   class="<?php if ($uri2 == 'kasa-virman' || $uri2 == 'kasa-virman-duzenle') {
										   echo 'active';
									   } ?>">Kasa Virman</a></li>
								<li><a href="<?= base_url("kasa/kasadan-bankaya-transfer"); ?>"
									   class="<?php if ($uri2 == 'kasadan-bankaya-transfer' || $uri2 == 'kasadan-bankaya-transfer-duzenle') {
										   echo 'active';
									   } ?>">Kasadan Bankaya Transfer</a></li>
							</ul>
						</li>
					<?php } else { ?>
						<?php if ($yetkiSorgula1_kasa || $yetkiSorgula2_kasa || $yetkiSorgula3_kasa || $yetkiSorgula4_kasa || $yetkiSorgula5_kasa || $yetkiSorgula6_kasa || $yetkiSorgula7_kasa || $yetkiSorgula8_kasa || $yetkiSorgula9_kasa || $yetkiSorgula10_kasa || $yetkiSorgula11_kasa || $yetkiSorgula12_kasa) { ?>
							<li class="submenu <?php if ($uri == 'kasa') {
								echo 'active';
							} ?>">
								<a href="#"><i data-feather="server"></i> <span> Kasa</span> <span
											class="menu-arrow"></span></a>
								<ul>
									<?php if ($yetkiSorgula1_kasa || $yetkiSorgula2_kasa) { ?>
										<li><a href="<?= base_url("kasa/kasa-acilis-karti"); ?>"
											   class="<?php if ($uri2 == 'kasa-acilis-karti' || $uri2 == 'kasa-acilis-karti-duzenle') {
												   echo 'active';
											   } ?>">Kasa Açılış Kartı</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula3_kasa) { ?>
										<li><a href="<?= base_url("kasa/kasa-listesi"); ?>"
											   class="<?php if ($uri2 == 'kasa-listesi') {
												   echo 'active';
											   } ?>">Kasa Listesi</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula4_kasa) { ?>
										<li><a href="<?= base_url("kasa/kasa-hareket-kayitlari"); ?>"
											   class="<?php if ($uri2 == 'kasa-hareket-kayitlari') {
												   echo 'active';
											   } ?>">Kasa Hareket Kayıtları</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula7_kasa || $yetkiSorgula8_kasa) { ?>
										<li><a href="<?= base_url("kasa/kasa-tahsilat"); ?>"
											   class="<?php if ($uri2 == 'kasa-tahsilat' || $uri2 == 'kasa-tahsilat-duzenle') {
												   echo 'active';
											   } ?>">Kasa Tahsilat</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula9_kasa || $yetkiSorgula10_kasa) { ?>
										<li><a href="<?= base_url("kasa/kasa-odeme-islemi"); ?>"
											   class="<?php if ($uri2 == 'kasa-odeme-islemi' || $uri2 == 'kasa-odeme-islemi-duzenle') {
												   echo 'active';
											   } ?>">Kasa Ödeme İşlemi</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula5_kasa || $yetkiSorgula6_kasa) { ?>
										<li><a href="<?= base_url("kasa/kasa-virman"); ?>"
											   class="<?php if ($uri2 == 'kasa-virman' || $uri2 == 'kasa-virman-duzenle') {
												   echo 'active';
											   } ?>">Kasa Virman</a></li>
									<?php } ?>

									<?php if ($yetkiSorgula11_kasa || $yetkiSorgula12_kasa) { ?>
										<li><a href="<?= base_url("kasa/kasadan-bankaya-transfer"); ?>"
											   class="<?php if ($uri2 == 'kasadan-bankaya-transfer' || $uri2 == 'kasadan-bankaya-transfer-duzenle') {
												   echo 'active';
											   } ?>">Kasadan Bankaya Transfer</a></li>
									<?php } ?>
								</ul>
							</li>
						<?php }
					} ?>

					<?php if ($yetki == 1) { ?>
						<li class="submenu <?php if ($uri == 'banka') {
							echo 'active';
						} ?>">
							<a href="#"><i data-feather="package"></i> <span> Banka</span> <span
										class="menu-arrow"></span></a>
							<ul>
								<li><a href="<?= base_url("banka/banka-acilis-karti"); ?>"
									   class="<?php if ($uri2 == 'banka-acilis-karti' || $uri2 == 'banka-acilis-karti-duzenle') {
										   echo 'active';
									   } ?>">Banka Açılış Kartı</a></li>
								<li><a href="<?= base_url("banka/banka-listesi"); ?>"
									   class="<?php if ($uri2 == 'banka-listesi') {
										   echo 'active';
									   } ?>">Banka Listesi</a></li>
								<li><a href="<?= base_url("banka/banka-hareket-kayitlari"); ?>"
									   class="<?php if ($uri2 == 'banka-hareket-kayitlari') {
										   echo 'active';
									   } ?>">Banka Hareket Kayıtları</a></li>
								<li><a href="<?= base_url("banka/banka-havale"); ?>"
									   class="<?php if ($uri2 == 'banka-havale' || $uri2 == 'banka-havale-duzenle') {
										   echo 'active';
									   } ?>">Banka Havale / EFT</a></li>
								<!-- <li><a href="<?= base_url("banka/banka-eft"); ?>" class="<?php if ($uri2 == 'banka-eft' || $uri2 == 'banka-eft-duzenle') {
									echo 'active';
								} ?>">Banka EFT İşlemleri</a></li> -->
								<li><a href="<?= base_url("banka/banka-virman"); ?>"
									   class="<?php if ($uri2 == 'banka-virman' || $uri2 == 'banka-virman-duzenle') {
										   echo 'active';
									   } ?>">Banka Virman</a></li>
								<li><a href="<?= base_url("banka/bankadan-kasaya-transfer"); ?>"
									   class="<?php if ($uri2 == 'bankadan-kasaya-transfer' || $uri2 == 'bankadan-kasaya-transfer-duzenle') {
										   echo 'active';
									   } ?>">Bankadan Kasaya Transfer</a></li>
							</ul>
						</li>
					<?php } else { ?>
						<?php if ($yetkiSorgula1_banka || $yetkiSorgula2_banka || $yetkiSorgula3_banka || $yetkiSorgula4_banka || $yetkiSorgula5_banka || $yetkiSorgula6_banka || $yetkiSorgula7_banka || $yetkiSorgula8_banka || $yetkiSorgula9_banka || $yetkiSorgula10_banka || $yetkisorgula11_banka || $yetkiSorgula12_banka) { ?>
							<li class="submenu <?php if ($uri == 'banka') {
								echo 'active';
							} ?>">
								<a href="#"><i data-feather="package"></i> <span> Banka</span> <span
											class="menu-arrow"></span></a>
								<ul>
									<?php if ($yetkiSorgula1_banka || $yetkiSorgula2_banka) { ?>
										<li><a href="<?= base_url("banka/banka-acilis-karti"); ?>"
											   class="<?php if ($uri2 == 'banka-acilis-karti' || $uri2 == 'banka-acilis-karti-duzenle') {
												   echo 'active';
											   } ?>">Banka Açılış Kartı</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula3_banka) { ?>
										<li><a href="<?= base_url("banka/banka-listesi"); ?>"
											   class="<?php if ($uri2 == 'banka-listesi') {
												   echo 'active';
											   } ?>">Banka Listesi</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula4_banka) { ?>
										<li><a href="<?= base_url("banka/banka-hareket-kayitlari"); ?>"
											   class="<?php if ($uri2 == 'banka-hareket-kayitlari') {
												   echo 'active';
											   } ?>">Banka Hareket Kayıtları</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula5_banka || $yetkiSorgula6_banka) { ?>
										<li><a href="<?= base_url("banka/banka-havale"); ?>"
											   class="<?php if ($uri2 == 'banka-havale' || $uri2 == 'banka-havale-duzenle') {
												   echo 'active';
											   } ?>">Banka Havale / EFT</a></li>
									<?php } ?>
									<?php /* if($yetkiSorgula7_banka || $yetkiSorgula8_banka){?>
										<li><a href="<?= base_url("banka/banka-eft"); ?>" class="<?php if($uri2 == 'banka-eft' || $uri2 == 'banka-eft-duzenle'){echo 'active';}?>">Banka EFT İşlemleri</a></li>
									<?php } */ ?>
									<?php if ($yetkiSorgula9_banka || $yetkiSorgula10_banka) { ?>
										<li><a href="<?= base_url("banka/banka-virman"); ?>"
											   class="<?php if ($uri2 == 'banka-virman' || $uri2 == 'banka-virman-duzenle') {
												   echo 'active';
											   } ?>">Banka Virman</a></li>
									<?php } ?>

									<?php if ($yetkiSorgula11_banka || $yetkiSorgula12_banka) { ?>
										<li><a href="<?= base_url("banka/bankadan-kasaya-transfer"); ?>"
											   class="<?php if ($uri2 == 'bankadan-kasaya-transfer' || $uri2 == 'bankadan-kasaya-transfer-duzenle') {
												   echo 'active';
											   } ?>">Bankadan Kasaya Transfer</a></li>
									<?php } ?>
								</ul>
							</li>
						<?php }
					} ?>

					<li class="submenu <?php if ($uri == 'cek') {
						echo 'active';
					} ?>">
						<a href="#"><i data-feather="file"></i> <span> Çek</span> <span class="menu-arrow"></span></a>
						<ul>
							<li><a href="<?= base_url("cek/cek-portfoyu"); ?>"
								   class="<?php if ($uri2 == 'cek-portfoyu') {
									   echo 'active';
								   } ?>">Çek Porföyü</a></li>
						</ul>
					</li>
					<li class="submenu <?php if ($uri == 'senet') {
						echo 'active';
					} ?>">
						<a href="#"><i data-feather="file-text"></i> <span> Senet</span> <span
									class="menu-arrow"></span></a>
						<ul>
							<li><a href="<?= base_url("senet/senet-portfoyu"); ?>"
								   class="<?php if ($uri2 == 'senet-portfoyu') {
									   echo 'active';
								   } ?>">Senet Portföyü</a></li>
						</ul>
					</li>

					<?php if ($yetki == 1) { ?>
						<li class="submenu <?php if ($uri == 'giderler') {
							echo 'active';
						} ?>">
							<a href="#"><i data-feather="percent"></i> <span> Giderler</span> <span
										class="menu-arrow"></span></a>
							<ul>
								<li><a href="<?= base_url("giderler/gider-ekle"); ?>"
									   class="<?php if ($uri2 == 'gider-ekle' || $uri2 == 'gider-duzenle') {
										   echo 'active';
									   } ?>">Gider Ekle</a></li>
								<li><a href="<?= base_url("giderler/gider-listesi"); ?>"
									   class="<?php if ($uri2 == 'gider-listesi') {
										   echo 'active';
									   } ?>">Gider Listesi</a></li>
								<li><a href="<?= base_url("giderler/gider-turleri"); ?>"
									   class="<?php if ($uri2 == 'gider-turleri') {
										   echo 'active';
									   } ?>">Gider Türleri</a></li>
								<li><a href="<?= base_url("giderler/fis-yukle"); ?>"
									   class="<?php if ($uri2 == 'fis-yukle') {
										   echo 'active';
									   } ?>">Fiş / Fatura Yükle</a></li>
							</ul>
						</li>
					<?php } else { ?>
						<?php if ($yetkiSorgula1_giderler || $yetkiSorgula2_giderler || $yetkiSorgula3_giderler || $yetkiSorgula4_giderler || $yetkiSorgula5_giderler) { ?>
							<li class="submenu <?php if ($uri == 'giderler') {
								echo 'active';
							} ?>">
								<a href="#"><i data-feather="percent"></i> <span> Giderler</span> <span
											class="menu-arrow"></span></a>
								<ul>
									<?php if ($yetkiSorgula1_giderler || $yetkiSorgula2_giderler) { ?>
										<li><a href="<?= base_url("giderler/gider-ekle"); ?>"
											   class="<?php if ($uri2 == 'gider-ekle' || $uri2 == 'gider-duzenle') {
												   echo 'active';
											   } ?>">Gider Ekle</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula3_giderler) { ?>
										<li><a href="<?= base_url("giderler/gider-listesi"); ?>"
											   class="<?php if ($uri2 == 'gider-listesi') {
												   echo 'active';
											   } ?>">Gider Listesi</a></li>
									<?php } ?>
									<?php if ($yetkiSorgula4_giderler || $yetkiSorgula5_giderler) { ?>
										<li><a href="<?= base_url("giderler/gider-turleri"); ?>"
											   class="<?php if ($uri2 == 'gider-turleri') {
												   echo 'active';
											   } ?>">Gider Kategorileri</a></li>
									<?php } ?>
								</ul>
							</li>
						<?php }
					} ?>

					<?php if ($yetki == 1 && ($u_id == 2)) { ?>
						<li class="submenu <?php if ($uri == 'admin') {
							echo 'active';
						} ?>" style="background-color:#e31a1c30!important;">
							<a href="#"><i data-feather="shield"></i> <span> Admin</span> <span
										class="menu-arrow"></span></a>
							<ul>
								<li><a href="<?= base_url("admin/firma-yonetimi"); ?>"
									   class="<?php if ($uri2 == 'firma-yonetimi') {
										   echo 'active';
									   } ?>">Firma Yönetimi</a></li>

								<li><a href="<?= base_url("admin/genel-log-kayitlari"); ?>"
									   class="<?php if ($uri2 == 'genel-log-kayitlari') {
										   echo 'active';
									   } ?>">Genel Log Kayıtları</a></li>

								<li><a href="<?= base_url("admin/destek"); ?>"
									   class="<?php if ($uri2 == 'destek') {
										   echo 'active';
									   } ?>">Destek Sistemi (<?= getirActiveTickets()->total; ?>)</a></li>

								<li><a href="<?= base_url("admin/duyurular"); ?>"
									   class="<?php if ($uri2 == 'duyurular') {
										   echo 'active';
									   } ?>">Duyurular</a></li>
							</ul>
						</li>
					<?php }
				} ?>

				<li class="menu-title">
					<span>Hızlı Erişim</span>
				</li>
				<?php
				if ($yetki == 1) {
					if(isDemoActive() != 1){
					?>
				<li class="submenu <?php if ($uri == 'yonetici') {
					echo 'active';
				} ?>">
					<a href="#"><i data-feather="settings"></i> <span> Yönetici</span> <span
								class="menu-arrow"></span></a>
					<ul>
						<li><a href="<?= base_url("yonetici/yeni-kullanici-ekle"); ?>"
							   class="<?php if ($uri2 == 'yeni-kullanici-ekle' || $uri2 == 'mevcut-kullanici-duzenle') {
								   echo 'active';
							   } ?>">Yeni Kullanıcı Ekle</a></li>
						<li><a href="<?= base_url("yonetici/kullanici-yetkileri-duzenle"); ?>"
							   class="<?php if ($uri2 == 'kullanici-yetkileri-duzenle') {
								   echo 'active';
							   } ?>">Kullanıcı Yetkileri Düzenle</a></li>
						<li><a href="<?= base_url("yonetici/kullanici-listesi"); ?>"
							   class="<?php if ($uri2 == 'kullanici-listesi') {
								   echo 'active';
							   } ?>">Kullanıcı Listesi</a></li>
						<li><a href="<?= base_url("yonetici/kullanici-loglari"); ?>"
							   class="<?php if ($uri2 == 'kullanici-loglari') {
								   echo 'active';
							   } ?>">Kullanıcı Logları</a></li>
						<!-- <li><a href="#">Fatura Dizaynı</a></li> -->
						
						<li><a href="<?= base_url("yonetici/ayarlar"); ?>"
							   class="<?php if ($uri2 == 'ayarlar') {
								   echo 'active';
							   } ?>">Ayarlar</a></li>

					</ul>
				</li>
				<?php }}
				if (!$modulGibSorgula) {
					?>
					<li>
						<a href="<?= base_url("raporlar"); ?>"><i data-feather="pie-chart"></i>
							<span>Raporlar</span></a>
					</li>
				<?php } ?>


<!--				<li>
					<a href="<?= base_url("home/dovizKur"); ?>"><i data-feather="globe" class="mr-1"></i> <span>Döviz Kuru</span></a>
				</li>-->
				<li>
					<a href="<?= base_url("modul/moduller"); ?>"><i data-feather="search" class="mr-1"></i> <span>Modüller</span></a>
				</li>
						<li>
					<a href="<?= base_url("destek"); ?>"><i data-feather="life-buoy" class="mr-1"></i> <span>Destek</span></a>
				</li>

				<li>
					<a href="<?= base_url("kullanici/sifre-degistir"); ?>"><i data-feather="key"></i> <span>Şifremi Değiştir</span></a>
				</li>
				<li>
					<a href="<?= base_url("home/logout"); ?>"><i data-feather="log-out"></i> <span>Çıkış Yap</span></a>
				</li>
			</ul>
		</div>
	</div>
</div>
