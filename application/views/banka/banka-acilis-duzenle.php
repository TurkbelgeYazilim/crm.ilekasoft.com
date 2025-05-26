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
								<h3 class="page-title">Banka</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Banka</li>
									<li class="breadcrumb-item active">Banka Açılış Kartı Düzenle</li>
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
									<h4 class="card-title">Temel Banka Bilgileri</h4>
									<form action="<?= base_url("banka/mevcutBankaAcilisKartiGuncelle"); ?>" method="POST">
										<input type="hidden" name="bankaID" value="<?= $banka->banka_id; ?>">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Hesap No</label>
													<input type="text" class="form-control" name="banka_hesapNo" required="" value="<?= $banka->banka_hesapNo; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>IBAN</label>
													<input type="text" class="form-control" name="banka_iban" required="" value="<?= $banka->banka_iban; ?>">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Hesap Adı</label>
													<input type="text" class="form-control" name="banka_hesapAd" required="" value="<?= $banka->banka_hesapAd; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Banka Adı</label>
													<input type="text" class="form-control" name="banka_bankaAd" required="" value="<?= $banka->banka_bankaAd; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Banka Şubesi</label>
													<input type="text" class="form-control" name="banka_sube" value="<?= $banka->banka_sube; ?>">
												</div>
											</div>


											<div class="col-md-4">
												<div class="form-group">
													<label>Şube Telefon No</label>
													<input type="text" class="form-control" name="banka_subeTelefon" value="<?= $banka->banka_subeTelefon; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Şube Temsilcisi</label>
													<input type="text" class="form-control" name="banka_temsilci" value="<?= $banka->banka_temsilci; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Şube Temsilcisi e-Posta</label>
													<input type="email" class="form-control" name="banka_temsilciEposta" value="<?= $banka->banka_temsilciEposta; ?>">
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label>Şube Adres</label>
													<textarea name="banka_adres" class="form-control"><?= $banka->banka_adres; ?></textarea>
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
<?php if ($this->session->flashdata('banka_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Yeni banka başarılı bir şekilde oluşturuldu.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('banka_updt_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Banka bilgileri güncellendi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>
		
<?php if ($this->session->flashdata('banka_updt_var')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Aynı banka bilgilerine sahip mevcut bir banka var, lütfen tekrar deneyiniz.",
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