<!DOCTYPE html>
<html lang="tr" xmlns="http://www.w3.org/1999/html">
<head>
	<?php $this->load->view("include/head-tags"); ?>

	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/c3-chart/c3.min.css">

	<script src="https://www.amcharts.com/lib/4/core.js"></script>
	<script src="https://www.amcharts.com/lib/4/charts.js"></script>
	<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

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
							<li class="breadcrumb-item active">Dosya Yükle</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i>
							<br>Önceki Sayfa</a>
					</div>
				</div>
			</div>
			<div id="newRow"></div>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">

							<form action="<?= base_url() ?>ocr/dosyaOku" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-4 col-sm-12">
										<input type="file" class="form-control" name="file" id="file">
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-12">
										<input type="submit" value="Yükle" class="btn btn-danger mt-4 w-100">
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

<?php if ($this->session->flashdata('document_uploaded_error')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Görsel en fazla 100 KB boyutunda ve 250x250 olabilir, kabul edilen uzantılar sadece jpg ve png.",
			confirmButtonText:'Tamam',
			button: false,
			timer: 7000,
		});
	</script>
<?php endif; ?>


<?php if ($this->session->flashdata('dosya_secilmedi ')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Bir dosya seçin.",
			confirmButtonText:'Tamam',
			button: false,
			timer: 7000,
		});
	</script>
<?php endif; ?>

</body>

</html>
