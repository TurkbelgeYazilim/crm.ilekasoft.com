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
									<li class="breadcrumb-item active">Yükle</li>
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
									<h4 class="card-title"><?= $erpBaslik; ?> İçe Aktarım</h4>
									<form action="<?= base_url("yonetici/yukle_islem"); ?>" method="POST" enctype="multipart/form-data">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Dosya türü</label>
													<select class="form-control" name="dosya_turu" required="">
														<option value="">Seçiniz...</option>
														<option value="1">Müşteri Carileri</option>
														<option value="2">Tedarikçi Carileri</option>
														<option value="3">Cari Hareketleri</option>
														<option value="4">Stok Kartları</option>
														<option value="5">Stok Hareketleri</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Dosya</label>
													<input type="file" class="form-control" name="file" required="">
												</div>
											</div>

											<input type="hidden" name="erpTip" value="<?= $erp; ?>">
										</div>
										<button type="submit" class="btn btn-danger" style="width:100%;" id="submitBtn">Aktar</button>
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
			<?php if ($this->session->flashdata('kullanici_sifreHata')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "error", 
			  text: "Girdiğiniz şifreler birbiri ile eşleşmedi, tekrar deneyiniz.",
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

		<?php 
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		?>
	</body>
</html>