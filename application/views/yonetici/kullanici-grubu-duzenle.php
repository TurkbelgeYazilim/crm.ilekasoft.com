<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>		<style>
		input[type=checkbox]
			{
				width: 20px; 
				height: 20px;
			}
		
		/* Sticky table header */
		.sticky-header-table {
			position: relative;
		}
		
		.sticky-header-table thead th {
			position: sticky;
			top: 0;
			background-color: #fff;
			z-index: 10;
			border-bottom: 2px solid #dee2e6;
			box-shadow: 0 2px 4px rgba(0,0,0,0.1);
		}
		
		/* Tablo container'ı için max-height belirle */
		.table-container {
			max-height: 70vh;
			overflow-y: auto;
		}
		</style>
</head>
	<body>
	
		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			<?php $this->load->view("include/header"); ?>
			<!-- /Header -->
			
			<!-- Sidebar -->
			<?php $this->load->view("include/sidebar"); ?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-10">
								<h3 class="page-title">Yönetici</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Yönetici</li>
									<li class="breadcrumb-item"><a href="<?= base_url('yonetici/kullanici-grubu'); ?>">Kullanıcı Grupları</a></li>
									<li class="breadcrumb-item active"><?= $grup->kg_adi; ?> - Düzenle</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
								<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					<?php 
						$control2 = session("r", "login_info");
						$u_id = $control2->kullanici_id;
						$anaHesap = anaHesapBilgisi();
					?>
				
					<div class="row">
						<div class="col-xl-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title"><?= $grup->kg_adi; ?> Grubu Düzenle</h5>
								</div>
								<div class="card-body">
									<form action="<?= base_url("yonetici/kullaniciGrubuGuncelle"); ?>" method="POST" id="grupForm">
										<input type="hidden" name="kg_id" value="<?= $grup->kg_id; ?>">
										
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Grup Adı <span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="kg_adi" value="<?= $grup->kg_adi; ?>" required="">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Açıklama</label>
													<input type="text" class="form-control" name="kg_aciklama" value="<?= $grup->kg_aciklama; ?>">
												</div>
											</div>
										</div>
										
										<hr>
										<div class="row">
											<div class="col">
												<h6>Grup Yetkileri</h6>
											</div>
											<div class="col-auto">
												<label><input type="checkbox" id="select-all"/> Tümünü seç</label>
											</div>
										</div>
												<div class="table-responsive table-container">
											<table class="table table-striped custom-table mb-0 sticky-header-table">
												<thead>
													<tr>
														<th>Modül</th>
														<th>Yetki</th>
														<th class="text-center">Görüntüleme</th>
														<th class="text-center">Ekleme Yetkisi</th>
														<th class="text-center">Düzenleme Yetkisi</th>
														<th class="text-center">Silme Yetkisi</th>
													</tr>
												</thead>
												<tbody>
													<!-- Ana Menü Modülleri -->
													<!-- Anasayfa modülü kaldırıldı -->
													<!-- Müşteri, Stok, Satış, Tahsilat, Kasa, Banka, Çek, Senet, Giderler ana menüleri zaten mevcut, tekrar etmeye gerek yok -->													<!-- Admin Modülü -->
													<tr>
														<td rowspan="4"><span class="badge bg-dark text-light">Admin</span></td>
														<td>Admin Paneli (ID: 1100)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1100[]" value="1" <?php if(isset($grup_yetkileri[1100]) && in_array(1, $grup_yetkileri[1100])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Firma Yönetimi (ID: 1110)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1110[]" value="1" <?php if(isset($grup_yetkileri[1110]) && in_array(1, $grup_yetkileri[1110])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Genel Log Kayıtları (ID: 1120)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1120[]" value="1" <?php if(isset($grup_yetkileri[1120]) && in_array(1, $grup_yetkileri[1120])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Destek Sistemi (ID: 1130)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1130[]" value="1" <?php if(isset($grup_yetkileri[1130]) && in_array(1, $grup_yetkileri[1130])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td><span class="badge bg-dark text-light">Admin</span></td>
														<td>Duyurular (ID: 1140)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1140[]" value="1" <?php if(isset($grup_yetkileri[1140]) && in_array(1, $grup_yetkileri[1140])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>													<!-- Yönetici Modülü -->
													<tr>
														<td rowspan="4"><span class="badge bg-secondary text-light">Yönetici</span></td>
														<td>Yönetici Paneli (ID: 1200)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1200[]" value="1" <?php if(isset($grup_yetkileri[1200]) && in_array(1, $grup_yetkileri[1200])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Kullanıcı Listesi (ID: 1210)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1210[]" value="1" <?php if(isset($grup_yetkileri[1210]) && in_array(1, $grup_yetkileri[1210])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Kullanıcı Grupları (ID: 1220)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1220[]" value="1" <?php if(isset($grup_yetkileri[1220]) && in_array(1, $grup_yetkileri[1220])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Kullanıcı Logları (ID: 1230)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1230[]" value="1" <?php if(isset($grup_yetkileri[1230]) && in_array(1, $grup_yetkileri[1230])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td><span class="badge bg-secondary text-light">Yönetici</span></td>
														<td>Ayarlar (ID: 1240)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1240[]" value="1" <?php if(isset($grup_yetkileri[1240]) && in_array(1, $grup_yetkileri[1240])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>													<!-- Destek Modülü -->
													<tr>
														<td><span class="badge bg-warning text-dark">Destek</span></td>
														<td>Destek (ID: 1300)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1300[]" value="1" <?php if(isset($grup_yetkileri[1300]) && in_array(1, $grup_yetkileri[1300])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<!-- Raporlar Modülü -->
													<tr>
														<td><span class="badge bg-info text-light">Raporlar</span></td>
														<td>Raporlar (ID: 1400)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1400[]" value="1" <?php if(isset($grup_yetkileri[1400]) && in_array(1, $grup_yetkileri[1400])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>													<!-- Müşteri Modülü -->
													<tr>
														<td rowspan="5"><span class="badge bg-success-light">Müşteri</span></td>
														<td>Müşteri Ana Menü (ID: 100)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_100[]" value="1" <?php if(isset($grup_yetkileri[100]) && in_array(1, $grup_yetkileri[100])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Müşteri Oluştur (ID: 110)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_110[]" value="1" <?php if(isset($grup_yetkileri[110]) && in_array(1, $grup_yetkileri[110])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_110[]" value="2" <?php if(isset($grup_yetkileri[110]) && in_array(2, $grup_yetkileri[110])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_110[]" value="3" <?php if(isset($grup_yetkileri[110]) && in_array(3, $grup_yetkileri[110])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_110[]" value="4" <?php if(isset($grup_yetkileri[110]) && in_array(4, $grup_yetkileri[110])) echo "checked"; ?>></div></td>
													</tr>
													<tr>
														<td>Müşteri Listesi (ID: 120)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_120[]" value="1" <?php if(isset($grup_yetkileri[120]) && in_array(1, $grup_yetkileri[120])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Müşteri Hareketleri (ID: 130)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_130[]" value="1" <?php if(isset($grup_yetkileri[130]) && in_array(1, $grup_yetkileri[130])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Müşteri Grupları (ID: 140)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_140[]" value="1" <?php if(isset($grup_yetkileri[140]) && in_array(1, $grup_yetkileri[140])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td><span class="badge bg-success-light">Müşteri</span></td>
														<td>Müşteri Dekont (ID: 150)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_150[]" value="1" <?php if(isset($grup_yetkileri[150]) && in_array(1, $grup_yetkileri[150])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>													<!-- Stok Modülü -->
													<tr>
														<td rowspan="5"><span class="badge bg-warning-light">Stok</span></td>
														<td>Stok Ana Menü (ID: 200)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_200[]" value="1" <?php if(isset($grup_yetkileri[200]) && in_array(1, $grup_yetkileri[200])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Stok Açılış Kartı (ID: 210)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_210[]" value="1" <?php if(isset($grup_yetkileri[210]) && in_array(1, $grup_yetkileri[210])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_210[]" value="2" <?php if(isset($grup_yetkileri[210]) && in_array(2, $grup_yetkileri[210])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_210[]" value="3" <?php if(isset($grup_yetkileri[210]) && in_array(3, $grup_yetkileri[210])) echo "checked"; ?>></div></td>
														<td></td>
													</tr>
													<tr>
														<td>Stok Listesi (ID: 220)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_220[]" value="1" <?php if(isset($grup_yetkileri[220]) && in_array(1, $grup_yetkileri[220])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Stok Hareketleri (ID: 230)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_230[]" value="1" <?php if(isset($grup_yetkileri[230]) && in_array(1, $grup_yetkileri[230])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Stok Grupları (ID: 240)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_240[]" value="1" <?php if(isset($grup_yetkileri[240]) && in_array(1, $grup_yetkileri[240])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>													<!-- Satış/Fatura Modülü -->
													<tr>
														<td rowspan="19"><span class="badge bg-danger-light">Satış</span></td>
														<td>Satış Ana Menü (ID: 300)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_300[]" value="1" <?php if(isset($grup_yetkileri[300]) && in_array(1, $grup_yetkileri[300])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Satış Sözleşmesi (ID: 310)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_310[]" value="1" <?php if(isset($grup_yetkileri[310]) && in_array(1, $grup_yetkileri[310])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_310[]" value="2" <?php if(isset($grup_yetkileri[310]) && in_array(2, $grup_yetkileri[310])) echo "checked"; ?>></div></td>
														<td></td><td></td>
													</tr>
													<tr>
														<td>Satış Sözleşmesi Listesi (ID: 320)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_320[]" value="1" <?php if(isset($grup_yetkileri[320]) && in_array(1, $grup_yetkileri[320])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Alış Faturası (ID: 330)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_330[]" value="1" <?php if(isset($grup_yetkileri[330]) && in_array(1, $grup_yetkileri[330])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Alış Faturası Listesi (ID: 340)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_340[]" value="1" <?php if(isset($grup_yetkileri[340]) && in_array(1, $grup_yetkileri[340])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Proforma Faturası (ID: 350)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_350[]" value="1" <?php if(isset($grup_yetkileri[350]) && in_array(1, $grup_yetkileri[350])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Proforma Faturası Listesi (ID: 360)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_360[]" value="1" <?php if(isset($grup_yetkileri[360]) && in_array(1, $grup_yetkileri[360])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Etiketler (ID: 370)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_370[]" value="1" <?php if(isset($grup_yetkileri[370]) && in_array(1, $grup_yetkileri[370])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>													<tr>
														<td>e-Fatura Oluştur (ID: 380)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_380[]" value="1" <?php if(isset($grup_yetkileri[380]) && in_array(1, $grup_yetkileri[380])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>e-Fatura Gelen Kutusu (ID: 390)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_390[]" value="1" <?php if(isset($grup_yetkileri[390]) && in_array(1, $grup_yetkileri[390])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>e-Fatura Giden Kutusu (ID: 400)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_400[]" value="1" <?php if(isset($grup_yetkileri[400]) && in_array(1, $grup_yetkileri[400])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>e-Arşiv Fatura Oluştur (ID: 410)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_410[]" value="1" <?php if(isset($grup_yetkileri[410]) && in_array(1, $grup_yetkileri[410])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>e-Arşiv Faturaları (ID: 420)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_420[]" value="1" <?php if(isset($grup_yetkileri[420]) && in_array(1, $grup_yetkileri[420])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>GIB/IVD Gelen e-Arşiv (ID: 430)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_430[]" value="1" <?php if(isset($grup_yetkileri[430]) && in_array(1, $grup_yetkileri[430])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Taslak Fatura Yükle (ID: 440)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_440[]" value="1" <?php if(isset($grup_yetkileri[440]) && in_array(1, $grup_yetkileri[440])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>e-İrsaliye Oluştur (ID: 450)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_450[]" value="1" <?php if(isset($grup_yetkileri[450]) && in_array(1, $grup_yetkileri[450])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>													<tr>
														<td>Gelen e-İrsaliye (ID: 460)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_460[]" value="1" <?php if(isset($grup_yetkileri[460]) && in_array(1, $grup_yetkileri[460])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Giden e-İrsaliye (ID: 470)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_470[]" value="1" <?php if(isset($grup_yetkileri[470]) && in_array(1, $grup_yetkileri[470])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Seri Yönetimi (ID: 480)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_480[]" value="1" <?php if(isset($grup_yetkileri[480]) && in_array(1, $grup_yetkileri[480])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>													<!-- Tahsilat Modülü -->
													<tr>
														<td rowspan="2"><span class="badge bg-primary-light">Tahsilat</span></td>
														<td>Tahsilat Ana Menü (ID: 500)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_500[]" value="1" <?php if(isset($grup_yetkileri[500]) && in_array(1, $grup_yetkileri[500])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Tahsilat Oluştur (ID: 510)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_510[]" value="1" <?php if(isset($grup_yetkileri[510]) && in_array(1, $grup_yetkileri[510])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>													<!-- Kasa Modülü -->
													<tr>
														<td rowspan="8"><span class="badge bg-primary-light">Kasa</span></td>
														<td>Kasa Ana Menü (ID: 600)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_600[]" value="1" <?php if(isset($grup_yetkileri[600]) && in_array(1, $grup_yetkileri[600])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Kasa Açılış Kartı (ID: 610)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_610[]" value="1" <?php if(isset($grup_yetkileri[610]) && in_array(1, $grup_yetkileri[610])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Kasa Listesi (ID: 620)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_620[]" value="1" <?php if(isset($grup_yetkileri[620]) && in_array(1, $grup_yetkileri[620])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Kasa Hareket Kayıtları (ID: 630)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_630[]" value="1" <?php if(isset($grup_yetkileri[630]) && in_array(1, $grup_yetkileri[630])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Kasa Tahsilat (ID: 640)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_640[]" value="1" <?php if(isset($grup_yetkileri[640]) && in_array(1, $grup_yetkileri[640])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Kasa Ödeme İşlemi (ID: 650)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_650[]" value="1" <?php if(isset($grup_yetkileri[650]) && in_array(1, $grup_yetkileri[650])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Kasa Virman (ID: 660)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_660[]" value="1" <?php if(isset($grup_yetkileri[660]) && in_array(1, $grup_yetkileri[660])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Kasadan Bankaya Transfer (ID: 670)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_670[]" value="1" <?php if(isset($grup_yetkileri[670]) && in_array(1, $grup_yetkileri[670])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>													<!-- Banka Modülü -->
													<tr>
														<td rowspan="7"><span class="badge bg-secondary-light">Banka</span></td>
														<td>Banka Ana Menü (ID: 700)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_700[]" value="1" <?php if(isset($grup_yetkileri[700]) && in_array(1, $grup_yetkileri[700])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Banka Açılış Kartı (ID: 710)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_710[]" value="1" <?php if(isset($grup_yetkileri[710]) && in_array(1, $grup_yetkileri[710])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Banka Listesi (ID: 720)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_720[]" value="1" <?php if(isset($grup_yetkileri[720]) && in_array(1, $grup_yetkileri[720])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Banka Hareket Kayıtları (ID: 730)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_730[]" value="1" <?php if(isset($grup_yetkileri[730]) && in_array(1, $grup_yetkileri[730])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Banka Havale / EFT (ID: 740)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_740[]" value="1" <?php if(isset($grup_yetkileri[740]) && in_array(1, $grup_yetkileri[740])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Banka Virman (ID: 750)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_750[]" value="1" <?php if(isset($grup_yetkileri[750]) && in_array(1, $grup_yetkileri[750])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Bankadan Kasaya Transfer (ID: 760)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_760[]" value="1" <?php if(isset($grup_yetkileri[760]) && in_array(1, $grup_yetkileri[760])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>													<!-- Çek Modülü -->
													<tr>
														<td rowspan="2"><span class="badge bg-info-light">Çek</span></td>
														<td>Çek Ana Menü (ID: 800)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_800[]" value="1" <?php if(isset($grup_yetkileri[800]) && in_array(1, $grup_yetkileri[800])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Çek Portföyü (ID: 810)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_810[]" value="1" <?php if(isset($grup_yetkileri[810]) && in_array(1, $grup_yetkileri[810])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<!-- Senet Modülü -->
													<tr>
														<td rowspan="2"><span class="badge bg-info-light">Senet</span></td>
														<td>Senet Ana Menü (ID: 900)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_900[]" value="1" <?php if(isset($grup_yetkileri[900]) && in_array(1, $grup_yetkileri[900])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Senet Portföyü (ID: 910)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_910[]" value="1" <?php if(isset($grup_yetkileri[910]) && in_array(1, $grup_yetkileri[910])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>													<!-- Giderler Modülü -->
													<tr>
														<td><span class="badge bg-primary text-light">Giderler</span></td>
														<td>Giderler Ana Menü (ID: 1000)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1000[]" value="1" <?php if(isset($grup_yetkileri[1000]) && in_array(1, $grup_yetkileri[1000])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>													<!-- Teklif Modülü -->
													<tr>
														<td rowspan="4"><span class="badge bg-info text-light">Teklif</span></td>
														<td>Teklif Ana Menü (ID: 1500)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1500[]" value="1" <?php if(isset($grup_yetkileri[1500]) && in_array(1, $grup_yetkileri[1500])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Teklif Hazırla (ID: 1510)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1510[]" value="1" <?php if(isset($grup_yetkileri[1510]) && in_array(1, $grup_yetkileri[1510])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1510[]" value="2" <?php if(isset($grup_yetkileri[1510]) && in_array(2, $grup_yetkileri[1510])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1510[]" value="3" <?php if(isset($grup_yetkileri[1510]) && in_array(3, $grup_yetkileri[1510])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1510[]" value="4" <?php if(isset($grup_yetkileri[1510]) && in_array(4, $grup_yetkileri[1510])) echo "checked"; ?>></div></td>
													</tr>
													<tr>
														<td>Teklif Listesi (ID: 1520)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1520[]" value="1" <?php if(isset($grup_yetkileri[1520]) && in_array(1, $grup_yetkileri[1520])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Teklif Ayarları (ID: 1530)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1530[]" value="1" <?php if(isset($grup_yetkileri[1530]) && in_array(1, $grup_yetkileri[1530])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>													</tr>													<!-- Prim Modülü -->
													<tr>
														<td rowspan="4"><span class="badge bg-success text-light">Prim</span></td>
														<td>Prim Ana Menü (ID: 1700)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1700[]" value="1" <?php if(isset($grup_yetkileri[1700]) && in_array(1, $grup_yetkileri[1700])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Prim Hazırla (ID: 1710)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1710[]" value="1" <?php if(isset($grup_yetkileri[1710]) && in_array(1, $grup_yetkileri[1710])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1710[]" value="2" <?php if(isset($grup_yetkileri[1710]) && in_array(2, $grup_yetkileri[1710])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1710[]" value="3" <?php if(isset($grup_yetkileri[1710]) && in_array(3, $grup_yetkileri[1710])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1710[]" value="4" <?php if(isset($grup_yetkileri[1710]) && in_array(4, $grup_yetkileri[1710])) echo "checked"; ?>></div></td>
													</tr>
													<tr>
														<td>Prim Listesi (ID: 1720)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1720[]" value="1" <?php if(isset($grup_yetkileri[1720]) && in_array(1, $grup_yetkileri[1720])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>Prim Ayarları (ID: 1730)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1730[]" value="1" <?php if(isset($grup_yetkileri[1730]) && in_array(1, $grup_yetkileri[1730])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>													<tr>
														<td rowspan="4"><span class="badge bg-danger text-light">İllegal</span></td>
														<td>İllegal Ana Menü (ID: 1600)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1600[]" value="1" <?php if(isset($grup_yetkileri[1600]) && in_array(1, $grup_yetkileri[1600])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>İllegal Hazırla (ID: 1610)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1610[]" value="1" <?php if(isset($grup_yetkileri[1610]) && in_array(1, $grup_yetkileri[1610])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1610[]" value="2" <?php if(isset($grup_yetkileri[1610]) && in_array(2, $grup_yetkileri[1610])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1610[]" value="3" <?php if(isset($grup_yetkileri[1610]) && in_array(3, $grup_yetkileri[1610])) echo "checked"; ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1610[]" value="4" <?php if(isset($grup_yetkileri[1610]) && in_array(4, $grup_yetkileri[1610])) echo "checked"; ?>></div></td>
													</tr>
													<tr>
														<td>İllegal Listesi (ID: 1620)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1620[]" value="1" <?php if(isset($grup_yetkileri[1620]) && in_array(1, $grup_yetkileri[1620])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>
													<tr>
														<td>İllegal Ayarları (ID: 1630)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="yetki_1630[]" value="1" <?php if(isset($grup_yetkileri[1630]) && in_array(1, $grup_yetkileri[1630])) echo "checked"; ?>></div></td>
														<td></td><td></td><td></td>
													</tr>

													<tr>
														<td colspan="6">
															<div class="fixed-bottom d-flex justify-content-center pb-1">
																<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Grubu Güncelle</button>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Wrapper -->

		</div>
		<!-- /Main Wrapper -->

		<script>
		// Tüm yetkileri seç/kaldır
		document.addEventListener('DOMContentLoaded', function() {
			const selectAll = document.getElementById('select-all');
			selectAll.addEventListener('change', function() {
				const yetkiCheckboxes = document.querySelectorAll('input[type="checkbox"][name^="yetki_"]');
				yetkiCheckboxes.forEach(cb => cb.checked = selectAll.checked);
			});
		});
		</script>

		<?php if ($this->session->flashdata('kullanici_grubu_guncelle_ok')): ?>
			<script>
			swal({
				title: "Bilgilendirme",
				type: "success", 
				text: "Kullanıcı grubu başarılı bir şekilde güncellendi.",
				confirmButtonText:'Tamam',
				button: false,
				timer: 5000,
			});
			</script>
		<?php endif; ?>

	</body>
</html>
