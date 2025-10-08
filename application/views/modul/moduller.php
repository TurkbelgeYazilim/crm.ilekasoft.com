<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>
	<style>
	@font-face {
		font-family: 'password';
		font-style: normal;
		font-weight: 400;
		src: url(https://jsbin-user-assets.s3.amazonaws.com/rafaelcastrocouto/password.ttf);
	}

	input.key {
		font-family: 'password';
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

			<?php  $anaHesap = anaHesapBilgisi(); ?>
			
			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-10">
								<h3 class="page-title">Modül</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Modül</li>
									<li class="breadcrumb-item active">Modüller</li>
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

					$moduller = $this->db->query("SELECT * FROM moduller WHERE modul_durum = 1")->result();

					$kullanicilar = $this->db->query("SELECT * FROM kullanicilar WHERE kullanici_id = '$u_id' ")->row();
					$belgeSessionID = $kullanicilar->kullanici_belgeSessionID;
					$belgeSessionID2 = $kullanicilar->kullanici_belgeSessionIDizi;
					?>

					<section class="comp-section comp-cards">
						<div class="row">
							<?php foreach($moduller as $modul){ ?>

									<?php
										$modulCheck = $this->db->query("SELECT * FROM firmaModulleri WHERE firmaModul_moduleID = $modul->modul_id AND firmaModul_firmaID = $anaHesap")->row();
									?>
							<div class="col-12 col-md-6 col-lg-4 d-flex">
								<div class="card flex-fill bg-white">
									<div class="card-header">
										<h5 class="card-title mb-0"><?= $modul->modul_ad; ?>
										<?php if($modulCheck && $modul->modul_id == 1){
											if($belgeSessionID == ""){
												echo '<i class="fa fa-times text-warning"></i>';
											}
											else if($belgeSessionID == "HATA"){
												echo '<i class="fa fa-times text-danger"></i>';
											}
											else{
												echo '<i class="fa fa-check text-success"></i>';
											}
										}else if($modulCheck && $modul->modul_id == 5){
											if($belgeSessionID2 == ""){
												echo '<i class="fa fa-times text-warning"></i>';
											}
											else if($belgeSessionID2 == "HATA"){
												echo '<i class="fa fa-times text-danger"></i>';
											}
											else{
												echo '<i class="fa fa-check text-success"></i>';
											}
										} ?></h5>
									</div>
									<div class="card-body">
										<p class="card-text"><?= $modul->modul_aciklama; ?></p>
									</div>
									<div class="container">
										<div class="row">
											<div class="col text-center">
												<div class="card-footer">
													<?php if($modulCheck){ ?>
														 <a href="<?= base_url("modul/ayarlar/$modul->modul_link"); ?>" class="btn btn-info btn-lg">Ayarlar</a> <a class="btn btn-danger btn-lg btnCancel">İptal Et</a>
													<?php }else{?>
														<a href="<?= base_url("odeme"); ?>?modulID=<?=$modul->modul_id;?>" class="btn btn-success btn-lg" style="width:100%;">Hemen Al - <?= $modul->modul_ucret; ?> ₺</a>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</section>
				</div>
			</div>
			<!-- /Page Wrapper -->
		</div>
		<!-- /Main Wrapper -->

			<?php if ($this->session->flashdata('efatura_ok')): ?>
				<script>
					swal({
					  title: "Bilgilendirme",
					  type: "success",
					  text: "Modül ayarları başarılı bir şekilde güncellendi.",
					  confirmButtonText:'Tamam',
					  button: false,
					  timer: 5000,
					});
				</script>
			<?php endif; ?>

		<?php if ($this->session->flashdata('odeme_error')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "<?=$this->session->flashdata('odeme_error')?>",
					confirmButtonText: 'Tamam',
					button: false,
					timer: 7500,
				});
			</script>
		<?php endif; ?>

		<?php $this->load->view("include/footer-js"); ?>


		<script>
			$(document).ready(function() {
				$(".btnCancel").click(function(){
					swal({
						title: "Bilgilendirme",
						type: "info",
						text: "İptal işlemi için yeni destek talebi oluşturunuz veya 0850 333 0 353 no'lu telefon ile iletişime geçiniz.",
						confirmButtonText:'Tamam',
						button: false,
						timer: 7500,
					});
				});
			});
		</script>
	</body>
</html>
