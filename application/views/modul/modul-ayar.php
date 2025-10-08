<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
		  integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
		  crossorigin="anonymous" referrerpolicy="no-referrer"/>

	<style>
		@font-face {
			font-family: 'password';
			font-style: normal;
			font-weight: 400;
			src: url(https://jsbin-user-assets.s3.amazonaws.com/rafaelcastrocouto/password.ttf);
		}

		.form-group a {color:#4e4e4e;}

		input.key {
			font-family: 'password';
		}
	</style>
	<script>
		var items = 0;
		var counter = [];
	</script>
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

	<?php $anaHesap = anaHesapBilgisi(); ?>

	<!-- Page Wrapper -->
	<div class="page-wrapper">
		<div class="content container-fluid">

			<!-- Page Header -->
			<div class="page-header">
				<div class="row">
					<div class="col-sm-10">
						<h3 class="page-title">Modül</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
							<li class="breadcrumb-item">Modül</li>
							<li class="breadcrumb-item active"><?= $modul->modul_ad; ?></li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i>
							<br>Önceki Sayfa</a>
					</div>
				</div>
			</div>
			<!-- /Page Header -->
			<?php


			$bilgiQ = "SELECT * FROM modulAyarlari WHERE ma_olusturanAnaHesap = '$anaHesap' ";
			$bilgiExe = $this->db->query($bilgiQ)->row();

			if ($modul->modul_id == 1) { // efatura modülü ayarları

				$bilgiQ = "SELECT * FROM modulAyarlari WHERE ma_olusturanAnaHesap = '$anaHesap' AND ma_modulID = 1 ";
				$bilgiExe = $this->db->query($bilgiQ)->row();

				$ayarlarSql = "select ayarlar_faturaXSLT,ayarlar_arsivXSLT,ayarlar_irsaliyeXSLT,ayarlar_ortakXSLT from ayarlar where ayarlar_id=$anaHesap";
				$ayarlarExe = $this->db->query($ayarlarSql)->row();

				?>

				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Modül Entegrasyon Ayarları</h4>
								<form action="<?= base_url("modul/efaturaModulGuncelle"); ?>" method="POST"
									  enctype="multipart/form-data">
									<div class="row">
										<input type="hidden" name="ma_modulID" value="<?= $modul->modul_id ?>">
										<div class="col-md-12">
											<div class="form-group">
												<label>E-Fatura Entegratörü</label>
												<select class="form-control select" name="efatura_entegrator">
													<option value="1">TÜRKBELGE</option>
												</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Portal Kullanıcı Adı</label>
												<input type="text" class="form-control" name="efatura_kullaniciadi"
													   autocomplete="off" value="<?php if ($bilgiExe) {
													echo $bilgiExe->ma_efaturaUsername;
												} else {
													echo "";
												} ?>">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Portal Şifre</label>
												<input type="text" class="key form-control"
													   value="<?php if ($bilgiExe) {
														   echo $bilgiExe->ma_efaturaSifre;
													   } else {
														   echo "";
													   } ?>" name="efatura_sifre" autocomplete="off">
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>E-Fatura Şablon</label>
												<?php if ($ayarlarExe->ayarlar_faturaXSLT != null) { ?>
													- <a href="<?= base_url("modul/sablonIndir/1"); ?>"><i
																class="fa fa-download"></i> <b><u>Şablon Mevcut - İndir</u></b></a>
												<?php } ?>
												<input class="form-control" type="file" id="efaturaXSLT"
													   name="efaturaXSLT">

											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>E-Arşiv Şablon</label>
												<?php if ($ayarlarExe->ayarlar_arsivXSLT != null) { ?>
													- <a href="<?= base_url("modul/sablonIndir/2"); ?>"><i
																class="fa fa-download"></i> <b><u>Şablon Mevcut - İndir</u></b></a>
												<?php } ?>
												<input class="form-control" type="file" id="earsivXSLT"
													   name="earsivXSLT">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>E-Fatura ve E-Arşiv Ortak Şablon</label>
												<?php if ($ayarlarExe->ayarlar_ortakXSLT != null) { ?>
													- <a href="<?= base_url("modul/sablonIndir/4"); ?>"><i
																class="fa fa-download"></i> <b><u>Şablon Mevcut - İndir</u></b></a>
												<?php } ?>
												<input class="form-control" type="file" id="ortakXSLT" name="ortakXSLT">
											</div>
										</div>
									</div>
									<button type="submit" class="btn btn-danger" style="width:100%;">Güncelle</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php } else if ($modul->modul_id == 2 || $modul->modul_id == 3) {

				$bilgiQ = "SELECT * FROM modulAyarlari WHERE ma_olusturanAnaHesap = '$anaHesap' AND ma_modulID = 3  ";
				$bilgiExe = $this->db->query($bilgiQ)->row();

			?>

				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Modül Entegrasyon Ayarları</h4>
								<form action="<?= base_url("modul/gibModulGuncelle"); ?>" method="POST"
									  enctype="multipart/form-data">
									<input type="hidden" name="ma_modulID" value="<?= $modul->modul_id ?>">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>GİB Kullanıcı Adı</label>
												<input type="text" class="form-control" name="gib_kullaniciadi"
													   autocomplete="off" value="<?php if ($bilgiExe) {
													echo $bilgiExe->ma_gibUsername;
												} else {
													echo "";
												} ?>">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>GİB Şifre</label>
												<input type="text" class="key form-control"
													   value="<?php if ($bilgiExe) {
														   echo $bilgiExe->ma_gibSifre;
													   } else {
														   echo "";
													   } ?>" name="gib_sifre" autocomplete="off">
											</div>
										</div>

									</div>

									<button type="submit" class="btn btn-danger" style="width:100%;">Güncelle</button>
								</form>
							</div>
						</div>
					</div>
				</div>

			<?php } else if ($modul->modul_id == 4) { ?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Mali Müşavir E-Posta Bilgileri</h4>
								<form action="<?= base_url("modul/ocrModulGuncelle"); ?>" method="POST"
									  enctype="multipart/form-data">
									<input type="hidden" name="ma_modulID" value="<?= $modul->modul_id ?>">
									<div class="row">
										<div class="col-md-6">
											<a href="javascript:void(0)" class="btn btn-success btn-sm"onclick="addItem();" ><i class="fa fa-plus"></i> Mali Müşavir Ekle</a>
											<div class="table-responsive">
												<table class="table custom-table mb-0" id="my_table">
													<tbody id="tbody">
													<?php $anaHesap=anaHesapBilgisi();
													$sql="select * from ocrMm where ocrMm_olusturanAnaHesap=$anaHesap";
													$exe=$this->db->query($sql)->row();
													$items=1;
													$eposta=explode(",",$exe->ocrMm_eposta);
													foreach ($eposta as $item) {?>
														<tr>
															<td>
																<input type='text' class='form-control' name='mmEposta[]' id='mmEposta<?= $items ?>' onblur='epostaKontrol(this.value,this.id)' required value="<?= $item ?>">
															</td>
															<td>
																<button type='button' onclick='deleteItem(this);' class='btn btn-danger btn-sm' id='<?= $items ?>'><i class='fa fa-trash'></i> Sil</button>
															</td>
														</tr>
														<script>items++;
															counter.push(items);
														</script>
												<?php $items++;	}
													?>

													</tbody>
												</table>
												<button type="submit" class="btn btn-danger" style="width:100%;" id="kydtBTN" <?php if($items==1) echo "disabled";?>>Kaydet
												</button>
											</div>

										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php }else if ($modul->modul_id == 5) {
				$bilgiQ = "SELECT * FROM modulAyarlari WHERE ma_olusturanAnaHesap = '$anaHesap' AND ma_modulID = 5  ";
				$bilgiExe = $this->db->query($bilgiQ)->row();

				$ayarlarSql = "select ayarlar_irsaliyeXSLT,ayarlar_irsaliyeYanitXSLT from ayarlar where ayarlar_id=$anaHesap";
				$ayarlarExe = $this->db->query($ayarlarSql)->row();
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Modül Entegrasyon Ayarları</h4>
								<form action="<?= base_url("modul/eirsaliyeModulGuncelle"); ?>" method="POST"
									  enctype="multipart/form-data">
									<div class="row">
										<input type="hidden" name="ma_modulID" value="<?= $modul->modul_id ?>">
										<div class="col-md-12">
											<div class="form-group">
												<label>E-İrsaliye Entegratörü</label>
												<select class="form-control select" name="eirsaliye_entegrator">
													<option value="2">PORTAL</option>
												</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Portal Kullanıcı Adı</label>
												<input type="text" class="form-control" name="eirsaliye_kullaniciadi"
													   autocomplete="off" value="<?php if ($bilgiExe) {
													echo $bilgiExe->ma_eirsaliyeUsername;
												} else {
													echo "";
												} ?>">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Portal Şifre</label>
												<input type="text" class="key form-control"
													   value="<?php if ($bilgiExe) {
														   echo $bilgiExe->ma_eirsaliyeSifre;
													   } else {
														   echo "";
													   } ?>" name="eirsaliye_sifre" autocomplete="off">
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>E-İrsaliye Şablon</label>
												<?php if ($ayarlarExe->ayarlar_irsaliyeXSLT != null) { ?>
													- <a href="<?= base_url("modul/sablonIndir/3"); ?>"><i
																class="fa fa-download"></i> <b><u>Şablon Mevcut - İndir</u></b></a>
												<?php } ?>
												<input class="form-control" type="file" id="eirsaliyeXSLT"
													   name="eirsaliyeXSLT">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>E-İrsaliye Yanıt Şablon</label>
												<?php if ($ayarlarExe->ayarlar_irsaliyeYanitXSLT != null) { ?>
													- <a href="<?= base_url("modul/sablonIndir/5"); ?>"><i
																class="fa fa-download"></i> <b><u>Şablon Mevcut - İndir</u></b></a>
												<?php } ?>
												<input class="form-control" type="file" id="eirsaliyeYanitXSLT"
													   name="eirsaliyeYanitXSLT">
											</div>
										</div>
									</div>

									<button type="submit" class="btn btn-danger" style="width:100%;">Güncelle</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

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
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>


<?php if ($this->session->flashdata('document_uploaded')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Firma logosu güncellendi.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('document_uploaded_error')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Görsel en fazla 100 KB boyutunda ve 250x250 olabilir, kabul edilen uzantılar sadece jpg ve png.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 7000,
		});
	</script>
<?php endif; ?>

<?php $this->load->view("include/footer-js"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
		integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	<?php if($items==1)
	echo "addItem();"; ?>
	function addItem(){
		items++;
		counter.push(items);
		var html = "<tr>";
		html += "<td><input type='text' class='form-control' name='mmEposta[]' id='mmEposta" + items + "' onblur='epostaKontrol(this.value,this.id)' required></td>";
		html += "<td><button type='button' onclick='deleteItem(this);' class='btn btn-danger btn-sm' id='" + items + "'><i class='fa fa-trash'></i> Sil</button> </td>";
		html +="</tr>";
		var row = document.getElementById("tbody").insertRow();
		row.innerHTML = html;
	}
	function deleteItem(button) {

		if (counter.length >= 1) {
			counter.pop();
		}
		if (counter.length == 0) {
			counter.push(1);
			toastr.warning("En az bir kayıt olması zorunludur, bu kayıt silinemez.");
		} else {

			var btnID = button.id;

			//items--;


			var btnID = button.id;

			button.parentElement.parentElement.remove();
			$('#mmEposta' + btnID + '').remove();

		}

	}
	function epostaKontrol(val,id){
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!regex.test(val)) {
			toastr.warning("Geçerli bir e-posta giriniz.");
			if (document.getElementById(id).required == true)
				$("#kydtBTN").prop("disabled", true);
		} else {
			$("#kydtBTN").prop('disabled', false);
		}
	}



	toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": false,
		"progressBar": true,
		"positionClass": "toast-top-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};

</script>
</body>
</html>
