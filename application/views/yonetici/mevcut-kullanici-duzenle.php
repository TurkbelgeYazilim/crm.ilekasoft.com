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
								<h3 class="page-title">Yönetici</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Yönetici</li>
									<li class="breadcrumb-item active">Mevcut Kullanıcı Düzenle</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Kullanıcı Kişisel Bilgileri</h4>
									<form action="<?= base_url("yonetici/kullaniciDuzenle"); ?>" method="POST">
										<input type="hidden" name="kullanici_id" value="<?= $kullanici->kullanici_id; ?>">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Ad</label>
													<input type="text" class="form-control" value="<?= $kullanici->kullanici_ad;?>" name="kullanici_ad" required="">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Soyad</label>
													<input type="text" class="form-control" value="<?= $kullanici->kullanici_soyad;?>" name="kullanici_soyad" required="">
												</div>
											</div>
										</div>
									<h4 class="card-title mt-4">Kullanıcı Temel Bilgileri</h4>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Kullanıcı Adı</label>
													<input type="text" class="form-control" value="<?= $kullanici->kullanici_kullaniciAdi;?>" name="kullanici_kullaniciAdi" required="">
												</div>
												<div class="form-group">
													<label>Şifre</label>
													<input type="password" class="form-control" name="kullanici_sifre" >
												</div>
												<div class="form-group">
													<label>Kullanıcı Yetkisi</label>
													<select class="select form-control" name="kullanici_yetki" required="">
														<option value="">Seçiniz...</option>
														<option value="1" <?php if($kullanici->kullanici_yetki == 1){echo "selected";}?>>Yönetici</option>
														<option value="2" <?php if($kullanici->kullanici_yetki == 2){echo "selected";}?>>Kullanıcı</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Kullanıcı e-Posta</label>
													<input type="email" class="form-control" value="<?= $kullanici->kullanici_eposta;?>" name="kullanici_eposta" required="">
												</div>
												<div class="form-group">
													<label>Şifre (tekrar)</label>
													<input type="password" class="form-control"  name="kullanici_sifreTekrar" >
												</div>
												<div class="form-group">
													<label>Kullanıcı Durumu</label>
													<select class="select form-control" name="kullanici_durum" required="">
														<option value="">Seçiniz...</option>
														<option value="1" <?php if($kullanici->kullanici_durum == 1){echo "selected";}?>>Aktif</option>
														<option value="2" <?php if($kullanici->kullanici_durum == 2){echo "selected";}?>>Pasif</option>
													</select>
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
		<?php if ($this->session->flashdata('kullanici_ok')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "success", 
			  text: "Yeni kullanıcı başarılı bir şekilde eklendi.",
			  confirmButtonText:'Tamam',
			  button: false,
			  timer: 5000,
			});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('kullanici_update_ok')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "success", 
			  text: "Mevcut kullanıcı başarılı bir şekilde güncellendi.",
			  confirmButtonText:'Tamam',
			  button: false,
			  timer: 5000,
			});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('kullanici_eposta_mevcut')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "error", 
			  text: "Kullanıcı e-Postası zaten sistemde mevcut, tekrar deneyiniz.",
			  confirmButtonText:'Tamam',
			  button: false,
			  timer: 5000,
			});
			</script>
		<?php endif; ?>
			

		<?php $this->load->view("include/footer-js"); ?>
	</body>
</html>