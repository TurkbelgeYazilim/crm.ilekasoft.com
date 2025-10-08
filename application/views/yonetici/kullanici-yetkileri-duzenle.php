<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>
		<style>
		input[type=checkbox]
			{
				width: 20px; 
				height: 20px;
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
				
				<?php 
						$control2 = session("r", "login_info");
						$u_id = $control2->kullanici_id;

						$anaHesap = anaHesapBilgisi();

						$getUser = $this->input->get('kullanici');

						$kullaniciQ = "SELECT * FROM kullanicilar WHERE kullanici_id = '$getUser' AND kullanici_anaHesapID = '$anaHesap'";
						$kullaniciExe = $this->db->query($kullaniciQ)->row();
					?>

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-10">
								<h3 class="page-title">Yönetici</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Yönetici
									</li>
									<li class="breadcrumb-item">Kullanıcı Yetkileri Düzenle
									</li>
									<?php if($kullaniciExe){ ?>
										<li class="breadcrumb-item active"><?= $kullaniciExe->kullanici_kullaniciAdi; ?></li>
									<?php }	?>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->

					<?php if(!isset($getUser)){ ?>
						<section class="comp-section">
							<div class="card bg-white">
								<div class="card-body">
									<div class="alert alert-info fade show" role="alert">
										<strong><i class="fa fa-info-circle"></i></strong> Kullanıcı yetkilerini düzenleyebilmek için, lütfen <a href="<?= base_url("yonetici/kullanici-listesi"); ?>" class="alert-link" style="text-decoration: underline;">kullanıcı listesi</a> sayfasından bir kullanıcı seçiniz.
									</div>
								</div>
							</div>
						</section>
						<!-- /Alerts -->
					<?php }else{?>
					<div class="row">
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title"><a href="<?= base_url("yonetici/mevcut-kullanici-duzenle/$kullaniciExe->kullanici_id"); ?>" target="_blank" style="color:#d92637; text-decoration: underline;"><?= $kullaniciExe->kullanici_kullaniciAdi; ?></a> - Kullanıcı Yetkileri</h5>
										</div>
										<div class="col-auto">
											<label><input type="checkbox" name="select-all" id="select-all"/> Tümünü seç</label>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
												<tr>
													<th>Modül</th>
													<th>Yetki</th>
													<th class="text-center">Görüntüleme</th>
													<th class="text-center">Ekleme</th>
													<th class="text-center">Düzenleme</th>
												</tr>
											</thead>
											<tbody>
												<form action="<?= base_url("yonetici/kullaniciYetkileriGuncelle"); ?>" method="post" id="myForm">

													<input type="hidden" name="kullanici_id" value="<?= $getUser; ?>">

													<!-- Cari :başlangıç -->

													<tr>
														<td><span class="badge bg-success-light">Cari</span></td>
														<td>Cari Kartı</td>
														<td></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="cari[]" value="1" <?php $yetkiSorgula = yetkiSorgula($getUser,1,1); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="cari[]" value="2" <?php $yetkiSorgula = yetkiSorgula($getUser,1,2); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>


													<tr>
														<td><span class="badge bg-success-light">Cari</span></td>
														<td>Cari Listesi</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="cari[]" value="3" <?php $yetkiSorgula = yetkiSorgula($getUser,1,3); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td></td>
														<td></td>
													</tr>

													<tr>
														<td><span class="badge bg-success-light">Cari</span></td>
														<td>Cari Hareketleri</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="cari[]" value="4" <?php $yetkiSorgula = yetkiSorgula($getUser,1,4); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td></td>
														<td></td>
													</tr>

													<tr>
														<td><span class="badge bg-success-light">Cari</span></td>
														<td>Cari Grupları</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="cari[]" value="5" <?php $yetkiSorgula = yetkiSorgula($getUser,1,5); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="cari[]" value="6" <?php $yetkiSorgula = yetkiSorgula($getUser,1,6); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="cari[]" value="7" <?php $yetkiSorgula = yetkiSorgula($getUser,1,7); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>


													<tr>
														<td><span class="badge bg-success-light">Cari</span></td>
														<td>Cari Dekont</td>
														<td></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="cari[]" value="8" <?php $yetkiSorgula = yetkiSorgula($getUser,1,8); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="cari[]" value="9" <?php $yetkiSorgula = yetkiSorgula($getUser,1,9); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>

													<!-- Cari :son -->

													<!-- Stok :başlangıç -->
													<tr>
														<td><span class="badge bg-warning-light">Stok</span></td>
														<td>Stok Kartı</td>
														<td></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="stok[]" value="1" <?php $yetkiSorgula = yetkiSorgula($getUser,2,1); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="stok[]" value="2" <?php $yetkiSorgula = yetkiSorgula($getUser,2,2); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>

													<tr>
														<td><span class="badge bg-warning-light">Stok</span></td>
														<td>Stok Listesi</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="stok[]" value="3" <?php $yetkiSorgula = yetkiSorgula($getUser,2,3); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td></td>
														<td></td>
													</tr>

													<tr>
														<td><span class="badge bg-warning-light">Stok</span></td>
														<td>Stok Hareketleri</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="stok[]" value="4" <?php $yetkiSorgula = yetkiSorgula($getUser,2,4); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td></td>
														<td></td>
													</tr>

													<tr>
														<td><span class="badge bg-warning-light">Stok</span></td>
														<td>Stok Grupları</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="stok[]" value="5" <?php $yetkiSorgula = yetkiSorgula($getUser,2,5); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="stok[]" value="6" <?php $yetkiSorgula = yetkiSorgula($getUser,2,6); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="stok[]" value="7" <?php $yetkiSorgula = yetkiSorgula($getUser,2,7); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>

													<!-- <tr>
														<td><span class="badge bg-warning-light">Stok</span></td>
														<td>Stok Birimleri</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="stok[]" value="8" <?php $yetkiSorgula = yetkiSorgula($getUser,2,8); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="stok[]" value="9" <?php $yetkiSorgula = yetkiSorgula($getUser,2,9); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="stok[]" value="10" <?php $yetkiSorgula = yetkiSorgula($getUser,2,10); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr> -->

													<!-- Stok :son -->

													<!-- Fatura :başlangıç -->
													<tr>
														<td><span class="badge bg-info-light">Fatura</span></td>
														<td>Satış Faturası</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="fatura[]" value="1" <?php $yetkiSorgula = yetkiSorgula($getUser,3,1); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="fatura[]" value="2" <?php $yetkiSorgula = yetkiSorgula($getUser,3,2); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="fatura[]" value="3" <?php $yetkiSorgula = yetkiSorgula($getUser,3,3); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>

													<tr>
														<td><span class="badge bg-info-light">Fatura</span></td>
														<td>Alış Faturası</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="fatura[]" value="4" <?php $yetkiSorgula = yetkiSorgula($getUser,3,4); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="fatura[]" value="5" <?php $yetkiSorgula = yetkiSorgula($getUser,3,5); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="fatura[]" value="6" <?php $yetkiSorgula = yetkiSorgula($getUser,3,6); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>

													<!-- e-Fatura :başlangıç -->
													<tr>
														<td><span class="badge bg-info-light">Fatura</span></td>
														<td>e-Fatura</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="fatura[]" value="7" <?php $yetkiSorgula = yetkiSorgula($getUser,3,7); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"></td>
														<td class="text-center"></td>
													</tr>
													<!-- e-Fatura :son -->

													<!-- e-Arşiv :başlangıç -->
													<tr>
														<td><span class="badge bg-info-light">Fatura</span></td>
														<td>e-Arşiv</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="fatura[]" value="8" <?php $yetkiSorgula = yetkiSorgula($getUser,3,8); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"></td>
														<td class="text-center"></td>
													</tr>
													<!-- e-Arşiv :son -->

													<!-- Kasa :başlangıç -->
													<tr>
														<td><span class="badge bg-primary-light">Kasa</span></td>
														<td>Kasa Açılış Kartı</td>
														<td class="text-center"></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="kasa[]" value="1" <?php $yetkiSorgula = yetkiSorgula($getUser,4,1); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="kasa[]" value="2" <?php $yetkiSorgula = yetkiSorgula($getUser,4,2); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>

													<tr>
														<td><span class="badge bg-primary-light">Kasa</span></td>
														<td>Kasa Listesi</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="kasa[]" value="3" <?php $yetkiSorgula = yetkiSorgula($getUser,4,3); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td></td>
														<td></td>
													</tr>

													<tr>
														<td><span class="badge bg-primary-light">Kasa</span></td>
														<td>Kasa Hareket Kayıtları</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="kasa[]" value="4" <?php $yetkiSorgula = yetkiSorgula($getUser,4,4); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td></td>
														<td></td>
													</tr>

													<tr>
														<td><span class="badge bg-primary-light">Kasa</span></td>
														<td>Kasa Virman</td>
														<td class="text-center"></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="kasa[]" value="5" <?php $yetkiSorgula = yetkiSorgula($getUser,4,5); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="kasa[]" value="6" <?php $yetkiSorgula = yetkiSorgula($getUser,4,6); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>

													<tr>
														<td><span class="badge bg-primary-light">Kasa</span></td>
														<td>Kasa Tahsilat</td>
														<td class="text-center"></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="kasa[]" value="7" <?php $yetkiSorgula = yetkiSorgula($getUser,4,7); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="kasa[]" value="8" <?php $yetkiSorgula = yetkiSorgula($getUser,4,8); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>

													<tr>
														<td><span class="badge bg-primary-light">Kasa</span></td>
														<td>Kasa Ödeme İşlemi</td>
														<td class="text-center"></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="kasa[]" value="9" <?php $yetkiSorgula = yetkiSorgula($getUser,4,9); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="kasa[]" value="10" <?php $yetkiSorgula = yetkiSorgula($getUser,4,10); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>

													<tr>
														<td><span class="badge bg-primary-light">Kasa</span></td>
														<td>Kasadan Bankaya Transfer</td>
														<td class="text-center"></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="kasa[]" value="11" <?php $yetkiSorgula = yetkiSorgula($getUser,4,11); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="kasa[]" value="12" <?php $yetkiSorgula = yetkiSorgula($getUser,4,12); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>
													<!-- Kasa :son -->

													<!-- Banka :başlangıç -->
													<tr>
														<td><span class="badge bg-warning text-light">Banka</span></td>
														<td>Banka Açılış Kartı</td>
														<td class="text-center"></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="banka[]" value="1" <?php $yetkiSorgula = yetkiSorgula($getUser,5,1); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="banka[]" value="2" <?php $yetkiSorgula = yetkiSorgula($getUser,5,2); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>

													<tr>
														<td><span class="badge bg-warning text-light">Banka</span></td>
														<td>Banka Listesi</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="banka[]" value="3" <?php $yetkiSorgula = yetkiSorgula($getUser,5,3); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td></td>
														<td></td>
													</tr>

													<tr>
														<td><span class="badge bg-warning text-light">Banka</span></td>
														<td>Banka Hareket Kayıtları</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="banka[]" value="4" <?php $yetkiSorgula = yetkiSorgula($getUser,5,4); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td></td>
														<td></td>
													</tr>

													<tr>
														<td><span class="badge bg-warning text-light">Banka</span></td>
														<td>Banka Havale / EFT</td>
														<td class="text-center"></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="banka[]" value="5" <?php $yetkiSorgula = yetkiSorgula($getUser,5,5); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="banka[]" value="6" <?php $yetkiSorgula = yetkiSorgula($getUser,5,6); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>

													<!-- <tr>
														<td><span class="badge bg-warning text-light">Banka</span></td>
														<td>Banka EFT İşlemleri</td>
														<td class="text-center"></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="banka[]" value="7" <?php $yetkiSorgula = yetkiSorgula($getUser,5,7); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="banka[]" value="8" <?php $yetkiSorgula = yetkiSorgula($getUser,5,8); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr> -->

													<tr>
														<td><span class="badge bg-warning text-light">Banka</span></td>
														<td>Banka Virman</td>
														<td class="text-center"></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="banka[]" value="9" <?php $yetkiSorgula = yetkiSorgula($getUser,5,9); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="banka[]" value="10" <?php $yetkiSorgula = yetkiSorgula($getUser,5,10); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>

													<tr>
														<td><span class="badge bg-warning text-light">Banka</span></td>
														<td>Bankadan Kasaya Transfer</td>
														<td class="text-center"></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="banka[]" value="11" <?php $yetkiSorgula = yetkiSorgula($getUser,5,11); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="banka[]" value="12" <?php $yetkiSorgula = yetkiSorgula($getUser,5,12); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>

													<!-- Banka :son -->

													<!-- Giderler :başlangıç -->
													<tr>
														<td><span class="badge bg-danger text-light">Giderler</span></td>
														<td>Gider Ekle</td>
														<td class="text-center"></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="giderler[]" value="1" <?php $yetkiSorgula = yetkiSorgula($getUser,7,1); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="giderler[]" value="2" <?php $yetkiSorgula = yetkiSorgula($getUser,7,2); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>

													<tr>
														<td><span class="badge bg-danger text-light">Giderler</span></td>
														<td>Gider Listesi</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="giderler[]" value="3" <?php $yetkiSorgula = yetkiSorgula($getUser,7,3); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"></td>
														<td class="text-center"></td>
													</tr>

													<tr>
														<td><span class="badge bg-danger text-light">Giderler</span></td>
														<td>Gider Kategorileri</td>
														<td class="text-center"></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="giderler[]" value="4" <?php $yetkiSorgula = yetkiSorgula($getUser,7,4); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="giderler[]" value="5" <?php $yetkiSorgula = yetkiSorgula($getUser,7,5); if($yetkiSorgula){ echo "checked";} ?>></div></td>
													</tr>


													<!-- Giderler :son -->

													<!-- Raporlar :başlangıç -->
													<tr>
														<td><span class="badge bg-info text-light">Raporlar</span></td>
														<td>Stok Raporları</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="rapor[]" value="1" <?php $yetkiSorgula = yetkiSorgula($getUser,6,1); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"></td>
														<td class="text-center"></td>
													</tr>

													<tr>
														<td><span class="badge bg-info text-light">Raporlar</span></td>
														<td>Azalan Ürünler (Kritik Stok)</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="rapor[]" value="5" <?php $yetkiSorgula = yetkiSorgula($getUser,6,5); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"></td>
														<td class="text-center"></td>
													</tr>

													<tr>
														<td><span class="badge bg-info text-light">Raporlar</span></td>
														<td>Biten Stoklar Raporu</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="rapor[]" value="6" <?php $yetkiSorgula = yetkiSorgula($getUser,6,6); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"></td>
														<td class="text-center"></td>
													</tr>

													<tr>
														<td><span class="badge bg-info text-light">Raporlar</span></td>
														<td>En Çok Satanlar</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="rapor[]" value="7" <?php $yetkiSorgula = yetkiSorgula($getUser,6,7); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"></td>
														<td class="text-center"></td>
													</tr>

													<tr>
														<td><span class="badge bg-info text-light">Raporlar</span></td>
														<td>Kasa Raporları</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="rapor[]" value="2" <?php $yetkiSorgula = yetkiSorgula($getUser,6,2); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"></td>
														<td class="text-center"></td>
													</tr>

													<tr>
														<td><span class="badge bg-info text-light">Raporlar</span></td>
														<td>Cari Stok Hareket Raporları</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="rapor[]" value="3" <?php $yetkiSorgula = yetkiSorgula($getUser,6,3); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"></td>
														<td class="text-center"></td>
													</tr>

													<tr>
														<td><span class="badge bg-info text-light">Raporlar</span></td>
														<td>Gider Raporları</td>
														<td class="text-center"><div class="checkbox"><input type="checkbox" name="rapor[]" value="4" <?php $yetkiSorgula = yetkiSorgula($getUser,6,4); if($yetkiSorgula){ echo "checked";} ?>></div></td>
														<td class="text-center"></td>
														<td class="text-center"></td>
													</tr>
													<!-- Raporlar :son -->

													<div class="fixed-bottom d-flex justify-content-center pb-1">
														<a href="javascript:void(0);" class="btn btn-primary" onclick="document.getElementById('myForm').submit();"><i class="fa fa-edit"></i>&nbsp; Yetkileri Güncelle</a>
													</div>

												</form>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?php echo $links; ?>
						</div>
					</div>
				<?php }	?>
				</div>
			</div>
			<!-- /Page Wrapper -->

		</div>
		<!-- /Main Wrapper -->

<?php if ($this->session->flashdata('kullanici_yetkileri_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Kullanıcı yetkileri başarılı bir şekilde güncellendi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>
		
<?php $this->load->view("include/footer-js"); ?>

<script>
	$('#select-all').click(function(event) {   
	    if(this.checked) {
	        $(':checkbox').each(function() {
	            this.checked = true;                        
	        });
	    } else {
	        $(':checkbox').each(function() {
	            this.checked = false;                       
	        });
	    }
	});
</script>

</body>
</html>
