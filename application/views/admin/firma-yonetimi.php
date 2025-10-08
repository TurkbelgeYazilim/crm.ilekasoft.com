<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>
		<style>
		.tooltip { 
    pointer-events: none;
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
								<h3 class="page-title">Admin</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Admin
									</li>
									<li class="breadcrumb-item active">Firma Yönetimi</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->

					<?php 
						$anaHesap = anaHesapBilgisi();

						$firmaAdi = $this->input->get('firmaAdi');

						$control2 = session("r", "login_info");
						$u_id = $control2->kullanici_id;

						$kullanicilar = $this->input->get("kullanicilar");
					?>
					
					<?php if(empty($kullanicilar)){ ?>
					<div class="row">
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Firma Yönetimi</h5>
										</div>
										<div class="col-auto">
											<a href="javascript:void(0);" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#add_category2"><i class="fa fa-plus"></i> Firma Ekle</a>
										</div>
											<?php if(isset($firmaAdi)){ ?>
												<div class="col-auto">
													<a href="<?= base_url("admin/firma-yonetimi"); ?>" class="btn btn-outline-primary btn-sm"><i class="fa fa-times-circle"></i> Filtrelemeyi Kaldır</a>
												</div>
											<?php } ?>
											<div class="col-auto">
											<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#add_category"><i class="fa fa-search"></i> Arama</a>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
												<tr>
													<th>ID</th>
													<th>Firma Adı</th>
													<th>Firma e-Posta</th>
													<th>Firma Telefon</th>
													<th>VKN/TCKN</th>
													<th class="text-right">İşlem</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($firmalar as $firm){?>													<?php
														$firmCountr = "SELECT COUNT(*) as total FROM kullanicilar WHERE kullanici_sorumluMudur = '$firm->ayarlar_id'";
														$firmCountrExe = $this->db->query($firmCountr)->row();

														$modulCounter = "SELECT COUNT(*) as total FROM firmaModulleri WHERE firmaModul_firmaID = '$firm->ayarlar_id'";
														$modulCountrExe = $this->db->query($modulCounter)->row();
													?>
												<tr>
													<td><?=$firm->ayarlar_id;?></td>
													<td><span data-toggle="tooltip" data-placement="bottom" title="<?= $firm->ayarlar_firmaAd ?>"><?= /*truncateString($firm->ayarlar_firmaAd, 25,false);*/ cutText($firm->ayarlar_firmaAd); ?></span></td>
													<td><?= $firm->ayarlar_eposta;?></td>
													<td><?= $firm->ayarlar_telefon; ?></td>
													<td><?= $firm->ayarlar_vergiNo; ?></td>
													<td class="text-right">
<a href="<?= base_url("admin/firma-yonetimi?kullanicilar=$firm->ayarlar_id"); ?>"  class="btn btn-sm btn-white text-info mr-2"><i class="fa fa-users mr-1"></i> <b><?= $firmCountrExe->total; ?></b></a>
<a href="<?= base_url("admin/moduller?kullanici=$firm->ayarlar_id"); ?>" class="btn btn-sm btn-white text-danger"><i class="fa fa-box-open"></i> <b><?= $modulCountrExe->total;?></b></a>
<a href="#" data-toggle="modal" data-target="#edit-category1" 
data-id="<?= $firm->ayarlar_id; ?>"
data-ad="<?= $firm->ayarlar_firmaAd; ?>"
data-sektor="<?= $firm->ayarlar_firmaSektor; ?>"
data-telefon="<?= $firm->ayarlar_telefon; ?>"
data-eposta="<?= $firm->ayarlar_eposta; ?>"
data-vd="<?= $firm->ayarlar_vergiDairesi; ?>"
data-vn="<?= $firm->ayarlar_vergiNo; ?>"
data-adres="<?= $firm->ayarlar_adres; ?>"
class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i></a>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
										<hr>
<span style="margin-left:15px;">Toplam kayıt sayısı:</span> <b><?= $count_of_list; ?></b>
<br><br>
										<?php echo $links; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }else{					$kullanicilariQ = "SELECT * FROM kullanicilar WHERE kullanici_sorumluMudur = '$kullanicilar' ORDER BY kullanici_id DESC";
					$kullanicilarExe = $this->db->query($kullanicilariQ)->result();

					$firmaQ = "SELECT * FROM ayarlar WHERE ayarlar_id = '$kullanicilar'";
					$firmaExe = $this->db->query($firmaQ)->row();
				?>
					<div class="row">
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Firma Kullanıcıları (<?= $firmaExe->ayarlar_firmaAd; ?>)</h5>
										</div>
										<div class="col-auto">
											<a href="<?= base_url("admin/firma-yonetimi"); ?>" class="btn btn-outline-danger btn-sm"><i class="fa fa-arrow-left"></i> Firma Yönetimi</a>

											<a href="javascript:void(0);" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#add_category3"><i class="fa fa-plus"></i> Kullanıcı Ekle</a>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
												<tr>
													<th>ID</th>
													<th>Kullanıcı Adı</th>
													<th>e-Posta</th>
													<th>Ad Soyad</th>
													<th>Yetki</th>
													<th class="text-right">İşlem</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($kullanicilarExe as $kul){?>
													<?php 
													 $kul_yetki = $kul->kullanici_yetki;
													 $kul_durum = $kul->kullanici_durum;

														if($kul_yetki == 1){
															$kulTxt = "Yönetici";
														}else if($kul_yetki == 2){
															$kulTxt = "Kullanıcı";
														}

														if($kul_durum == 1){
															$kulDurumTxt = "Aktif";
														}else if($kul_durum == 2){
															$kulDurumTxt = "Pasif";
														}
													?>
												<tr>
													<td><?=$kul->kullanici_id;?></td>
													<td><?= $kul->kullanici_kullaniciAdi; ?></td>
													<td><?= $kul->kullanici_eposta;?></td>
													<td><?= $kul->kullanici_ad; ?> <?= $kul->kullanici_soyad; ?></td>
													<td><?= $kulTxt; ?></td>
													<td><?= $kulDurumTxt; ?></td>
													<td class="text-right">

														<a href="javascript:void(0);" data-toggle="modal" data-target="#add_category4"
														data-id="<?= $kul->kullanici_id; ?>"
														data-eposta="<?= $kul->kullanici_eposta; ?>"
														data-ad="<?= $kul->kullanici_ad; ?>"
														data-soyad="<?= $kul->kullanici_soyad; ?>"
														data-kullanici="<?= $kul->kullanici_kullaniciAdi; ?>"
														data-yetki="<?= $kul->kullanici_yetki; ?>"
														class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i></a>
														
														<a href="javascript:void(0);" data-toggle="modal" data-target="#sifre" data-id="<?= $kul->kullanici_id; ?>" class="btn btn-sm btn-white text-warning mr-2"><i class="fa fa-key ml-1"></i></a>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }	?>
				</div>
			</div>
			<!-- /Page Wrapper -->
			<?php 
				$firmaAdi = $this->input->get('firmaAdi');
			?>
			<!-- Add Category Modal -->
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Firma Arama</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("admin/firma-yonetimi"); ?>" method="GET">
										<div class="form-group">
											<label>Firma Adına Göre </label>
											<input class="form-control" type="text" name="firmaAdi" value="<?=$firmaAdi;?>" autocomplete="off">
										</div>
										<div class="submit-section">
											<button class="btn btn-danger submit-btn">Ara</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
			<!-- /Add Category Modal -->

			<!-- Add Category Modal -->
					<div id="add_category2" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Firma Ekle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("admin/firmaEkle"); ?>" method="POST">
										<div class="form-group">
											<label>Firma Adı *</label>
											<input class="form-control" type="text" name="ayarlar_firmaAd" value="" autocomplete="off" required="">
										</div>
										<div class="form-group">
											<label>Firma Sektörü</label>
											<input class="form-control" type="text" name="ayarlar_firmaSektor" value="" autocomplete="off">
										</div>
										<div class="form-group">
											<label>Firma Telefon *</label>
											<input class="form-control" type="number" name="ayarlar_telefon" value="" autocomplete="off" required="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
										</div>
										<div class="form-group">
											<label>Firma e-Posta *</label>
											<input class="form-control" type="email" name="ayarlar_eposta" value="" autocomplete="off" required="">
										</div>
										<div class="form-group">
											<label>Vergi Dairesi</label>
											<input class="form-control" type="text" name="ayarlar_vergiDairesi" value="" autocomplete="off">
										</div>
										<div class="form-group">
											<label>Vergi Numarası *</label>
											<input class="form-control" type="number" name="ayarlar_vergiNo" value="" autocomplete="off" required="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11">
										</div>

										<div class="form-group">
											<?php
											if ($_iller != false):
												echo '<div class="form-group">
												<label>İl</label>
												<select id="il" name="ayarlar_il" data-plugin-selectTwo class="select ajaxIller" required>
												<option value="">Seçiniz</option>';
												foreach ($_iller as $item) {
													echo '<option value="'. $item->id .'">'. $item->il .'</option>';
												}
												echo '</select></div>';
											else:
												echo 'Kayıtlı İl Bulunamadı..!';
											endif;
											?>
										</div>

										<div class="form-group">
											<div class="ilceler">
												<div class="form-group">
													<label>İlçe</label>
													<select id="ilce" name="ayarlar_ilce" class="select" required>
														<option value="">İl Seçiniz</option>
													</select>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label>Firma Adres</label>
											<input class="form-control" type="text" name="ayarlar_adres" value="" autocomplete="off">
										</div>

										<hr>

										<div class="form-group">
											<label>(Yönetici) e-Posta *</label>
											<input class="form-control" type="email" name="kullanici_eposta" value="" autocomplete="off" required="">
										</div>
										<div class="form-group">
											<label>(Yönetici) Ad *</label>
											<input class="form-control" type="text" name="kullanici_ad" value="" autocomplete="off" required="">
										</div>
										<div class="form-group">
											<label>(Yönetici) Soyad *</label>
											<input class="form-control" type="text" name="kullanici_soyad" value="" autocomplete="off" required="">
										</div>
										<div class="form-group">
											<label>(Yönetici) Kullanıcı Adı *</label>
											<input class="form-control" type="text" name="kullanici_kullaniciAdi" value="" autocomplete="off" required="">
										</div>
										<div class="form-group">
											<label>(Yönetici) Şifre *</label>
											<input class="form-control" type="text" name="kullanici_sifre" value="" autocomplete="off" required="">
										</div>
										<div class="submit-section">
											<button class="btn btn-danger submit-btn">Ekle</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
			<!-- /Add Category Modal -->

			<!-- Add Category Modal -->
					<div id="edit-category1" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Firma Düzenle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("admin/firmaDuzenle"); ?>" method="POST">
										<input type="hidden" name="ayarlar_id" id="ayarlar_id">
										<div class="form-group">
											<label>Firma Adı</label>
											<input class="form-control" type="text" id="ayarlar_firmaAd" name="ayarlar_firmaAd" value="" autocomplete="off" required="">
										</div>
										<div class="form-group">
											<label>Firma Sektörü</label>
											<input class="form-control" type="text" id="ayarlar_firmaSektor" name="ayarlar_firmaSektor" value="" autocomplete="off">
										</div>
										<div class="form-group">
											<label>Firma Telefon</label>
											<input class="form-control" type="text" id="ayarlar_telefon" name="ayarlar_telefon" value="" autocomplete="off" required="">
										</div>
										<div class="form-group">
											<label>Firma e-Posta</label>
											<input class="form-control" type="email" id="ayarlar_eposta" name="ayarlar_eposta" value="" autocomplete="off" required="">
										</div>
										<div class="form-group">
											<label>Vergi Dairesi</label>
											<input class="form-control" type="text" id="ayarlar_vergiDairesi" name="ayarlar_vergiDairesi" value="" autocomplete="off">
										</div>
										<div class="form-group">
											<label>Vergi Numarası</label>
											<input class="form-control" type="text" id="ayarlar_vergiNo" name="ayarlar_vergiNo" value="" autocomplete="off" required="">
										</div>
										<div class="form-group">
											<label>Firma Adres</label>
											<input class="form-control" type="text" id="ayarlar_adres" name="ayarlar_adres" value="" autocomplete="off">
										</div>
										<div class="submit-section">
											<button class="btn btn-danger submit-btn">Düzenle</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
			<!-- /Add Category Modal -->


			<!-- Add Category Modal -->
					<div id="add_category3" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Kullanıcı Ekle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("admin/kullaniciEkle"); ?>" method="POST">

										<input type="hidden" value="<?= $kullanicilar; ?>" name="anaHesap">

										<div class="form-group">
											<label>Kullanıcı e-Posta </label>
											<input class="form-control" type="email" name="kullanici_eposta" autocomplete="off" required="">
										</div>

										<div class="form-group">
											<label>Ad</label>
											<input class="form-control" type="text" name="kullanici_ad" autocomplete="off" required="">
										</div>

										<div class="form-group">
											<label>Soyad </label>
											<input class="form-control" type="text" name="kullanici_soyad" autocomplete="off" required="">
										</div>

										<div class="form-group">
											<label>Kullanıcı Adı </label>
											<input class="form-control" type="text" name="kullanici_kullaniciAdi" autocomplete="off" required="">
										</div>

										<div class="form-group">
											<label>Şifre </label>
											<input class="form-control" type="text" name="kullanici_sifre" autocomplete="off" required="">
										</div>

										<div class="form-group">
											<label>Yetki </label>
											<select name="kullanici_yetki" class="select form-control" required="">
												<option value="">Seçiniz...</option>
												<option value="1">Yönetici</option>
												<option value="2">Kullanıcı</option>
											</select>
										</div>

										<div class="submit-section">
											<button class="btn btn-danger submit-btn">Oluştur</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
			<!-- /Add Category Modal -->


			<!-- Add Category Modal -->
					<div id="add_category4" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Kullanıcı Düzenle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("admin/kullaniciDuzenle"); ?>" method="POST">
										<input type="hidden" name="kullanici_id" id="kullanici_id">
										<div class="form-group">
											<label>Kullanıcı e-Posta </label>
											<input class="form-control" type="email" name="kullanici_eposta" autocomplete="off" required="" id="kullanici_eposta">
										</div>

										<div class="form-group">
											<label>Ad</label>
											<input class="form-control" type="text" name="kullanici_ad" autocomplete="off" required="" id="kullanici_ad">
										</div>

										<div class="form-group">
											<label>Soyad </label>
											<input class="form-control" type="text" name="kullanici_soyad" autocomplete="off" required="" id="kullanici_soyad">
										</div>

										<div class="form-group">
											<label>Kullanıcı Adı </label>
											<input class="form-control" type="text" name="kullanici_kullaniciAdi" autocomplete="off" required="" id="kullanici_kullaniciAdi">
										</div>

										<div class="form-group">
											<label>Yetki </label>
											<select name="kullanici_yetki" class="form-control" required="" id="kullanici_yetki">
												<option value="">Seçiniz...</option>
												<option value="1">Yönetici</option>
												<option value="2">Kullanıcı</option>
											</select>
										</div>

										<div class="submit-section">
											<button class="btn btn-danger submit-btn">Düzenle</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
			<!-- /Add Category Modal -->
			
			
			<div id="sifre" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Şifre Düzenle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("admin/sifreDuzenle"); ?>" method="POST">
										<input type="hidden" name="kullanici_id2" id="kullanici_id2">
										<div class="form-group">
											<label>Yeni Şifre</label>
											<input class="form-control" type="text" name="sifre" autocomplete="off" required="" id="sifre">
										</div>

										<div class="submit-section">
											<button class="btn btn-danger submit-btn">Düzenle</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
		</div>
		<!-- /Main Wrapper -->

		<?php if ($this->session->flashdata('ok')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "success", 
				  text: "Şifre değiştirildi.",
				  confirmButtonText:'Tamam',
				  button: false,
				  timer: 5000,
				});
			</script>
		<?php endif; ?>
		
		<?php if ($this->session->flashdata('firma_kullanici_ok')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "success", 
				  text: "Yeni firma ve ilk yöneticisi oluşturuldu. Belirlenen e-Posta ve şifre ile kullanıcı girişi yapıp firmasını yönetebilir.",
				  confirmButtonText:'Tamam',
				  button: false,
				  timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('kullanici_ok')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "success", 
				  text: "İlgili firma için yeni kullanıcı oluşturuldu.",
				  confirmButtonText:'Tamam',
				  button: false,
				  timer: 5000,
				});
			</script>
		<?php endif; ?>
		
		<?php if ($this->session->flashdata('firma_duzenle_ok')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "success", 
				  text: "Mevcut firma bilgileri düzenlendi.",
				  confirmButtonText:'Tamam',
				  button: false,
				  timer: 5000,
				});
			</script>
		<?php endif; ?>
		
		<?php if ($this->session->flashdata('kullanici_duzenle_ok')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "success", 
				  text: "Mevcut kullanıcı bilgileri düzenlendi.",
				  confirmButtonText:'Tamam',
				  button: false,
				  timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('firma_kullanici_var')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "error", 
				  text: "Kullanıcı adı ve kullanıcı eposta adresi zaten kullanılıyor. Bilgileri kontrol edip tekrar deneyiniz.",
				  confirmButtonText:'Tamam',
				  button: false,
				  timer: 5000,
				});
			</script>
		<?php endif; ?>

<?php $this->load->view("include/footer-js"); ?>

<!-- Select2 JS -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>

		<script>
			$(document).ready(function(){
				$('.ajaxIller').on('change', function(e){
					var base_url = "<?php echo base_url();?>";
					var il_id = $(this).val();
					$.post(base_url+'home/get_ilceler', {il_id : il_id}, function(result){
						if ( result && result.status != 'error' )
						{
							var ilceler = result.data;
							var select = '<div class="ilceler"><div class="form-group"><label>İlçe</label><select id="ilce" name="ayarlar_ilce" class="form-control select" required>';
							for( var i = 0; i < ilceler.length; i++)
							{
								select += '<option value="'+ ilceler[i].id +'">'+ ilceler[i].ilce +'</option>';
							}
							select += '</select></div></div>';
							$('div.ilceler').empty().html(select);
						}
						else{
							alert('Hata : ' + result.message );
						}
					});
				});
			});
		</script>

<script>
	$('#edit-category1').on('show.bs.modal', function (event) {
		  let id = $(event.relatedTarget).data('id') 
		  let ad = $(event.relatedTarget).data('ad') 
		  let sektor = $(event.relatedTarget).data('sektor') 
		  let telefon = $(event.relatedTarget).data('telefon') 
		  let eposta = $(event.relatedTarget).data('eposta') 
		  let vd = $(event.relatedTarget).data('vd') 
		  let vn = $(event.relatedTarget).data('vn') 
		  let adres = $(event.relatedTarget).data('adres') 

		  $(this).find('.modal-body #ayarlar_id').val(id)
		  $(this).find('.modal-body #ayarlar_firmaAd').val(ad)
		  $(this).find('.modal-body #ayarlar_firmaSektor').val(sektor)
		  $(this).find('.modal-body #ayarlar_telefon').val(telefon)
		  $(this).find('.modal-body #ayarlar_eposta').val(eposta)
		  $(this).find('.modal-body #ayarlar_vergiDairesi').val(vd)
		  $(this).find('.modal-body #ayarlar_vergiNo').val(vn)
		  $(this).find('.modal-body #ayarlar_adres').val(adres)
	});

	$('#add_category4').on('show.bs.modal', function (event) {
		  let id = $(event.relatedTarget).data('id') 
		  let eposta = $(event.relatedTarget).data('eposta') 
		  let ad = $(event.relatedTarget).data('ad') 
		  let soyad = $(event.relatedTarget).data('soyad') 
		  let kullanici = $(event.relatedTarget).data('kullanici') 
		  let yetki = $(event.relatedTarget).data('yetki') 

		  $(this).find('.modal-body #kullanici_id').val(id)
		  $(this).find('.modal-body #kullanici_eposta').val(eposta)
		  $(this).find('.modal-body #kullanici_ad').val(ad)
		  $(this).find('.modal-body #kullanici_soyad').val(soyad)
		  $(this).find('.modal-body #kullanici_kullaniciAdi').val(kullanici)
		  $(this).find('.modal-body #kullanici_yetki').val(yetki)
	});
	
	
	$('#sifre').on('show.bs.modal', function (event) {
		  let id = $(event.relatedTarget).data('id') 

		  $(this).find('.modal-body #kullanici_id2').val(id)
	});
</script>

		<script type="text/javascript">
			$(document).ready(function(){
				$("#il").select2({
					width: '100%'
				});
			});
		</script>

</body>
</html>
