<!DOCTYPE html>
<html lang="tr" xmlns="http://www.w3.org/1999/html">
<head>
	<?php $this->load->view("include/head-tags"); ?>

	<style>
		.scroll {
			width: 500px;
			height: 500px;
			overflow: auto !important;
		}

		#image {
			width: 500px;
			height: 500px;
		}

		#buyut, #kucult {
			border: 1px solid #aaa;
			padding: 5px;
			border-radius: 10px;
			font-size: 10px;
			margin-right: 10px;
		}
	</style>
</head>
<body>

<?php $ses = session("r", "auth");
echo $ses; ?>


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
		<div class="content container-fluid " style="padding-top:10px;">
			<div class="page-header">
				<div class="row">
					<div class="col-sm-10">
						<h3 class="page-title">OCR</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">OCR</a></li>
							<li class="breadcrumb-item active">Dosya Görüntüle</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i>
							<br>Önceki Sayfa</a>
					</div>
				</div>
			</div>
			<div id="newRow"></div>
			<?php $anahesap = anaHesapBilgisi(); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title"><?= $dosya->ocr_faturaTuru ?> Oku</h4>
							<form action="<?= base_url("ocr/dosyaGuncelle"); ?>" method="POST">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-5 text-center">
											<a onclick="buyut()" id="buyut"><i class="fa fa-plus"
																			   aria-hidden="true"></i></a>
											<a onclick="kucult()" id="kucult"><i class="fa fa-minus"
																				 aria-hidden="true"></i></a><br>
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-md-5 scroll">
											<img src="<?= base_url() ?>assets/ocr-img/<?= $anahesap . "/" . $dosya->ocr_dosyaAdi ?>"
												 id="image">
											<input type="hidden" name="ocr_id" value="<?= $dosya->ocr_id ?>">
										</div>
										<div class="col-md-7">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>VKN / TCKN</label>
														<input type="hidden" name="ocr_tur"
															   value="<?= $dosya->ocr_dosyaTuru ?>">
														<input type="text" value="<?= $dosya->ocr_vknTckn ?>"  class="form-control" name="ocr_vknTckn" onblur="vknSorgula()" id="ocr_vknTckn">
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label>Unvan</label>
														<input type="text" value="<?= $dosya->ocr_unvan ?>" class="form-control" name="ocr_unvan" id="ocr_unvan" readonly>
													</div>
												</div>
											</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Tarih</label>
															<input type="text" value="<?= $dosya->ocr_faturaTarihi ?>" class="form-control" name="ocr_faturaTarihi">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label><?= $dosya->ocr_faturaTuru ?> No</label>
															<input type="text" value="<?= $dosya->ocr_faturaNo ?>"
																   class="form-control" name="ocr_faturaNo">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>KDV</label>
															<input type="text" value="<?= $dosya->ocr_kdv ?>"
																   class="form-control" name="ocr_kdv">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Toplam</label>
															<input type="text" value="<?= $dosya->ocr_toplam ?>"
																   class="form-control" name="ocr_toplam">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">

														<button type="submit" class="btn btn-danger"
																style="width:100%;">
															Kaydet
														</button>
													</div>
												</div>

											</div>
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

<?php $this->load->view("include/footer-js"); ?>


<?php if ($this->session->flashdata('dosya-okundu')) : ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Dosya başarıyla okundu.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('mm-gonder')) : ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Dosya bilgileri mali müşavirinize gönderildi.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<script>
	function vknSorgula() {
		var vkn = $("#ocr_vknTckn").val();
		$.ajax({
			url: "<?= env('BASE_URL'); ?>/Ocr/gibVknTcknSorgula",
			method: "POST",
			data: {vknTckn: vkn},
			dataType: 'json',
			success: function (result) {
				console.log(result);
				let vknInfo = result.vknInfo;
				document.getElementById("ocr_unvan").value = vknInfo;

			}
		});
	}

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
</body>

</html>
