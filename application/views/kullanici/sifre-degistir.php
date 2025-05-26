<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>
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
								<h3 class="page-title">Kullanıcı</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Kullanıcı</li>
									<li class="breadcrumb-item active">Şifre Değiştir</li>
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
					?>
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<form action="<?= base_url("kullanici/mevcutSifremiDegistir"); ?>" method="POST">
										<input type="hidden" value="<?= $u_id; ?>" name="kullanici">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Mevcut Şifre</label>
													<input type="password" class="form-control" name="mevcutSifre" required="">
												</div>
												<div class="form-group">
													<label>Yeni Şifre</label>
													<input type="password" class="form-control" name="yeniSifre" required="">
												</div>
												<div class="form-group">
													<label>Yeni Şifre (tekrar)</label>
													<input type="password" class="form-control" name="yeniSifreTekrar" required="">
												</div>
											</div>
										</div>
										<button type="submit" class="btn btn-danger" style="width:100%;">Güncelle</button>
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
			<?php if ($this->session->flashdata('sifre_ok')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "success", 
			  text: "Şifre başarılı bir şekilde değiştirildi..",
			  confirmButtonText:'Tamam',
			  button: false,
			  timer: 5000,
			});
			</script>
			<?php endif; ?>

			<?php if ($this->session->flashdata('mevcut_sifre_hatali')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "error", 
			  text: "Mevcut şifrenizi hatalı girdiniz, tekrar deneyiniz.",
			  confirmButtonText:'Tamam',
			  button: false,
			  timer: 5000,
			});
			</script>
			<?php endif; ?>

			<?php if ($this->session->flashdata('sifreler_eslesmiyor')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "error", 
			  text: "Girdiğiniz yeni şifre ve tekrarı birbiri ile eşleşmiyor.",
			  confirmButtonText:'Tamam',
			  button: false,
			  timer: 5000,
			});
			</script>
			<?php endif; ?>

		<?php $this->load->view("include/footer-js"); ?>
	</body>
</html>
