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
								<h3 class="page-title">Kasa</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Kasa</li>
									<li class="breadcrumb-item active">Kasa Açılış Kartı</li>
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
									<h4 class="card-title">Temel Kasa Bilgileri</h4>
									<form action="<?= base_url("kasa/yeniKasaAcilisKarti"); ?>" method="POST">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Kasa Adı</label>
													<input type="text" class="form-control" name="kasa_adi" required="">
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<label>Kasa Kodu</label>
													<input type="text" class="form-control" name="kasa_kodu" required="">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Kasa Başlangıç Bakiyesi</label>
													<input type="text" class="form-control" name="kasa_baslangic" required="">
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label>Açıklama</label>
													<textarea name="kasa_aciklama" class="form-control"></textarea>
												</div>
											</div>
										</div>
										<button type="submit" class="btn btn-danger" style="width:100%;">Kaydet</button>
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


<?php if ($this->session->flashdata('kasa_var')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "error", 
  text: "Aynı kasa bilgilerine sahip mevcut bir kasa var, lütfen tekrar deneyiniz.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>
		
		<?php $this->load->view("include/footer-js"); ?>
<script type="text/javascript">
	$(document).ready(function(){
		 $("form").submit(function() {
				$(this).submit(function() {
					return false;
				});
				return true;
			}); 
	}); 
</script>

	</body>
</html>
