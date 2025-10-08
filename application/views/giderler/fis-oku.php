<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<style>
		.scroll{
			width: 500px;
			height: 500px;
			overflow:auto !important;
		}
		 #image {
			 width: 500px;
			 height: 500px;
		 }
		 #buyut,#kucult{
			 border:1px solid #aaa;
			 padding: 5px;
			 border-radius: 10px;
			 font-size: 10px;
			 margin-right: 10px;
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
						<h3 class="page-title">Giderler</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
							<li class="breadcrumb-item">Giderler</li>
							<li class="breadcrumb-item active">Fiş Oku</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i>
							<br>Önceki Sayfa</a>
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title"><?= $tur ?> Oku</h4>
							<form action="<?= base_url("giderler/fisKaydet"); ?>" method="POST">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-5 text-center">
										<a onclick="buyut()" id="buyut"><i class="fa fa-plus" aria-hidden="true"></i></a>
										<a onclick="kucult()" id="kucult"><i class="fa fa-minus" aria-hidden="true"></i></a><br>
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-md-5 scroll">
											<img src="<?= $image ?>"  id="image">

											<input type="hidden" name="img" value="<?= $imgTemp ?>">
										</div>
										<div class="col-md-7">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>VKN / TCKN</label>
														<input type="hidden" name="gider_tur" value="<?= $tur?>">
														<input type="text" value="<?= $vkn ?>" class="form-control" name="gider_vkn" onblur="vknSorgula()" id="vkn" >
														<input type="hidden" name="gider_vknInfo" value="<?= $vknInfo ?>" id="vknInfoHidden">
														<span style="font-size: 11px;" id="vknInfoSpan">*<?= $vknInfo ?></span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Tarih</label>
														<input type="text" value="<?= $tarih ?>" class="form-control" name="gider_tarih">

													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label><?= $tur ?> No</label>
														<input type="text" value="<?= $fisno ?>" class="form-control" name="gider_fisno">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>KDV</label>
														<input type="text" value="<?= $kdv ?>" class="form-control" name="gider_kdv">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Toplam</label>
														<input type="text" value="<?= $toplam ?>" class="form-control"  name="gider_tutar" >
													</div>
												</div>
											</div>
											<div class="row">

												<div class="col-md-6">
													<div class="form-group">
														<label>Gider Türü</label>
														<select class="select form-control" name="gider_gkID" id="gkid"
																required="">
															<option value="">Seçiniz...</option>
															<?php foreach ($giderKategorileri as $gk) { ?>
																<option value="<?= $gk->gk_id; ?>"><?= $gk->gk_adi; ?></option>
															<?php } ?>
														</select>
													</div>
												</div>

												<div class="altturler col-md-6">
													<div class="form-group">
														<label>Gider Alt Türü</label>
														<select class="select form-control" name="gider_gkSubID"
																id="gksubid" required="">
															<option value="">Seçiniz...</option>
														</select>
													</div>
												</div>

											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Ödeme Türü</label>
														<select class="select form-control" name="gider_odemeTipi"
																id="odemeTipi">
															<option value="">Ödeme türü seçiniz...</option>
															<option value="1">Kasa</option>
															<option value="2">Banka</option>
														</select>
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label>Kasa</label>
														<select class="select form-control" name="gider_kasaID"
																id="kasa" disabled>
															<option value="">Kasa adı seçiniz...</option>
															<?php foreach ($kasa as $ksa) { ?>
																<option value="<?= $ksa->kasa_id; ?>"> <?= $ksa->kasa_adi; ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Banka</label>
														<select class="select form-control" name="gider_bankaID"
																id="banka" disabled>
															<option value="">Hesap adı seçiniz...</option>
															<?php foreach ($banka as $bnk) { ?>
																<option value="<?= $bnk->banka_id; ?>"> <?= $bnk->banka_bankaAd . " - " . $bnk->banka_hesapAd; ?></option>
															<?php } ?>
														</select>
													</div>
												</div>


											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>Açıklama</label>
														<textarea name="gider_aciklama" class="form-control"></textarea>
													</div>
												</div>
											</div>
										</div>
										<button type="submit" class="btn btn-danger" style="width:100%;">Kaydet</button>
									</div>
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


<?php if ($this->session->flashdata('gider_ok')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Gider kalemi başarılı bir şekilde eklendi.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('kasa_eksi')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Bu girişin ardından seçilen kasa eksi bakiyeye düşeceği için işlem iptal edildi, tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('banka_eksi')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Bu girişin ardından seçilen banka eksi bakiyeye düşeceği için işlem iptal edildi, tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php $this->load->view("include/footer-js"); ?>

<script>
	$(function () {
		$('.datepicker').datepicker({
			dateFormat: 'dd.mm.yy',
			language: 'tr'
		});
	});
</script>

<script>
	$("#odemeTipi").on('change', function () {
		var status = $(this).val();

		if (status == 1) {
			$("#kasa").prop('disabled', false);
			document.getElementById("kasa").required = true;
			document.getElementById("banka").required = false;
			$("#banka").prop('disabled', true);
			$("#banka").val('').change();
		}

		if (status == 2) {
			$("#banka").prop('disabled', false);
			document.getElementById("banka").required = true;
			document.getElementById("kasa").required = false;
			$("#kasa").prop('disabled', true);
			$("#kasa").val('').change();
		}
	});

	$("#gkid").on('change', function () {
		var statusgk = $(this).val();
		$.ajax({
			url: "<?= env('BASE_URL'); ?>/giderler/giderAltGetir",
			method: "POST",
			data: {gkID: statusgk},
			success: function (result) {
				var urunler = result.data;
				var select = '<div class="altturler"><div class="form-group"><label>Gider Alt Türü</label> <select class="form-control" name="gider_gkSubID" id="gksubid" required="">';
				for (var i = 0; i < urunler.length; i++) {
					select += '<option value="' + urunler[i].gk_id + '">' + urunler[i].gk_adi + '</option>';
				}
				select += '</select></div></div>';
				$('div.altturler').empty().html(select);
				$("#gksubid").select2();
			}
		});
	});

</script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#gkid").select2();
		$("form").submit(function () {
			$(this).submit(function () {
				return false;
			});
			return true;
		});
	});

	function buyut(){
		var myImg = document.getElementById("image");
		var currWidth = myImg.clientWidth;
		var currHeight = myImg.clientHeight;
		myImg.style.width = (currWidth + 50) + "px";
		myImg.style.height = (currHeight + 50) + "px";
	}
	function kucult(){
		var myImg = document.getElementById("image");
		var currWidth = myImg.clientWidth;
		var currHeight = myImg.clientHeight;
		myImg.style.width = (currWidth - 50) + "px";
		myImg.style.height = (currHeight - 50) + "px";
	}


</script>

<script>
	function vknSorgula() {
		var vkn = $("#vkn").val();
		$.ajax({
			url: "<?= env('BASE_URL'); ?>/Giderler/gibVknTcknSorgula",
			method: "POST",
			data: {vknTckn: vkn},
			dataType: 'json',
			success: function (result) {
				console.log(result);
				let vknInfo = result.vknInfo;
				document.getElementById("vknInfoHidden").value = vknInfo;
				document.getElementById("vknInfoSpan").innerHTML = "*"+vknInfo;

			}
		});
	}
</script>


<?php if ($this->session->flashdata('kasa_eksi')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Bu girişin ardından seçilen kasa eksi bakiyeye düşeceği için işlem iptal edildi, tekrar deneyiniz.",
			confirmButtonText:'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('banka_eksi')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Bu girişin ardından seçilen banka eksi bakiyeye düşeceği için işlem iptal edildi, tekrar deneyiniz.",
			confirmButtonText:'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>
</body>
</html>
