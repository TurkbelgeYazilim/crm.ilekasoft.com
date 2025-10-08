<!DOCTYPE html>
<html lang="tr" xmlns="http://www.w3.org/1999/html">
<head>
	<?php $this->load->view("include/head-tags"); ?>

	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/c3-chart/c3.min.css">

	<script src="https://www.amcharts.com/lib/4/core.js"></script>
	<script src="https://www.amcharts.com/lib/4/charts.js"></script>
	<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
	<style>
		.table td, .table th {
			vertical-align: middle;
			white-space: normal;
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
	<div class="page-wrapper mt-4">
		<div class="content container-fluid mt-3 ">
			<div class="page-header ">
				<div class="row">
					<div class="col-sm-10">
						<h3 class="page-title">GİB</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
							<li class="breadcrumb-item">GİB</li>
							<li class="breadcrumb-item active">Uyarılar</li>
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

							<h3>Uyarı!</h3>
							<?= $message ?>

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




</body>

</html>
