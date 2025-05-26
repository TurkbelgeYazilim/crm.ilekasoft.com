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
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">


							<div class="row">

								<div id="div1" class="col-md-4 ">
									<!--begin::Mixed Widget 1-->
									<div class="card card-custom bg-gray-100 card-stretch gutter-b pb-4">

										<div class="card-header border-0 bg-danger py-5 ">
											<h3 class="card-title font-weight-bolder text-white"></h3>

										</div>
										<div class="card-body p-0 position-relative overflow-hidden">
											<div id="kt_mixed_widget_1_chart" class="card-rounded-bottom bg-danger"
												 style="height: 100px; min-height: 100px;"></div>

											<div class="card-spacer">

												<div class="row m-0">
													<a href="<?= base_url("gib/fatura-olustur") ?>"
													   class="text-light-warning font-weight-bold font-size-h6 px-6 py-8 col bg-light-warning rounded mr-7 mb-7"
													   style="border-radius: 10px !important;">
														<i class="fa fa-file text-light-warning"></i><br>
														Fatura Oluştur

													</a>
													<a href="<?= base_url("gib/duzenlenen-belgeler") ?>"
													   class="text-light-primary font-weight-bold font-size-h6 mt-2 px-6 py-8 col bg-light-primary rounded mb-7"
													   style="border-radius: 10px !important;">
														<i class="fa fa-file-invoice text-light-primary"></i><br>
														Düzenlenen Belgeler
													</a>
												</div>
												<div class="row m-0">
													<a href="<?= base_url("gib/adima-duzenlenen-belgeler") ?>"
													   class="text-light-success font-weight-bold font-size-h6 mt-2 px-6 py-8 col bg-light-success rounded mb-7 mr-7 "
													   style="border-radius: 10px !important;">

														<i class="fa fa-file-invoice text-light-success"></i><br>
														Adıma Düzenlenen Belgeler
													</a>
													<a href="<?= base_url("gib/gib-bilgi") ?>"
													   class="text-light-danger font-weight-bold font-size-h6 mt-2 px-6 py-8 col bg-light-danger rounded-xl  mb-7"
													   style="border-radius: 10px !important;">
														<i class="fa fa-user text-light-danger"></i><br>
														Gib Bilgileri
													</a>

												</div>
											</div>

										</div>
									</div>

								</div>
								<div id="div2" class="col-md-4">
									<div class="card pb-3">
										<div class="card-header">
											<h5 class="card-title">Son Faturalar</h5>
										</div>
										<div class="card-body card-body-height">
											<ul class="activity-feed">
												<?php $sayac=1; foreach ($invoice as $item) { if($sayac<6){?>
													<li class="feed-item feed-item">

													<div class="feed-date">
														<?= $item["belgeTarihi"] ?>
													</div>
													<span class="feed-text">
													<a class="dropdown-item text-info mr-2" href="<?= base_url("gib/htmlGoster/" . $item["ettn"]) ?>"
													   target="_blank">
														<?= $item["belgeNumarasi"] ?>
													</a>
													</span>
													</li>
												<?php } else break; $sayac++;} ?>

											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-md-3 col-lg-3 col-sm-6">
									<div class="widget widget-stats bg-light-warning mb-7px">
										<div class="stats-icon stats-icon-lg"><i class="fas fa-industry fa-fw"></i>
										</div>
										<div class="stats-content">
											<div class="stats-title">Vadesi Geçmiş Borçlar</div>
											<div class="stats-number"></div>
											<div class="stats-progress progress">
												<div class="progress-bar"
													 style="width:10%;"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3 col-lg-3 col-sm-6">
									<div class="widget widget-stats bg-light-primary mb-7px">
										<div class="stats-icon stats-icon-lg"><i class="fas fa-users fa-fw"></i></div>
										<div class="stats-content">
											<div class="stats-title">Vadesi Geçmemiş Borçlar</div>
											<div class="stats-number"></div>
											<div class="stats-progress progress">
												<div class="progress-bar"
													 style="width:20%;"></div>
											</div>
										</div>
									</div>
								</div>

							</div>
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

<script src="<?= base_url() ?>assets/plugins/c3-chart/d3.v5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/c3-chart/c3.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/c3-chart/chart-data.js"></script>
<!-- Chart JS
<script src="<?= base_url(); ?>assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/apexchart/chart-data.js"></script>
-->

<script>
	$(document).ready(function () {

		$(window).resize(function () {
			resize();
		});
		resize();

		function resize() {
			let width = screen.width;
			var element1 = document.getElementById("div1");
			var element2 = document.getElementById("div2");
			if (width <= 1366) {

				element1.classList.remove("col-md-4");
				element1.classList.add("col-md-6");
				element2.classList.remove("col-md-4");
				element2.classList.add("col-md-6");

			} else if (width >= 1920) {

				element1.classList.remove("col-md-6");
				element1.classList.add("col-md-4");
				element2.classList.remove("col-md-6");
				element2.classList.add("col-md-4");

			}
		}

	});
</script>

</body>

</html>
