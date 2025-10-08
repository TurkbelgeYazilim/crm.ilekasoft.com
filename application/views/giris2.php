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

<?php $ses = session("r", "auth"); ?>


<!-- Main Wrapper -->
<div class="main-wrapper">

	<!-- Sidebar -->
	<?php $this->load->view("include/sidebar"); ?>
	<!-- /Sidebar -->
	<?php
	if (!empty(alacakHesapla2(30))) {
		$alacakyuzde = (alacakHesapla(30) / alacakHesapla2(30) - 1) * 100;
	}

	if (!empty(musteriHesapla2(30))) {
		$musteriyuzde = (musteriHesapla(30) / musteriHesapla2(30) - 1) * 100;
	}

	if (!empty(faturaHesapla2(30))) {
		$faturayuzde = (faturaHesapla(30) / faturaHesapla2(30) - 1) * 100;
	}

	if (!empty(stokHesapla2(30))) {
		$stokyuzde = (stokHesapla(30) / stokHesapla2(30) - 1) * 100;
	}
	?>

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
													<a href="<?= base_url("cari/cari-listesi") ?>"
													   class="text-light-warning font-weight-bold font-size-h6 mt-2 px-6 py-8 col bg-light-warning rounded mr-7 mb-7"
													   style="border-radius: 10px !important;">
														<i class="fa fa-user-plus text-light-warning"></i><br>
														Cari Listesi

													</a>
													<a href="<?= base_url("stok/stok-listesi") ?>"
													   class="text-light-primary font-weight-bold font-size-h6 mt-2 px-6 py-8 col bg-light-primary rounded mb-7"
													   style="border-radius: 10px !important;">
														<i class="fa fa-barcode text-light-primary"></i><br>
														Stok
														Listesi
													</a>
												</div>
												<div class="row m-0">
													<a href="<?= base_url("banka/banka-listesi") ?>"
													   class="text-light-success font-weight-bold font-size-h6 mt-2 px-6 py-8 col bg-light-success rounded mb-7 mr-7 "
													   style="border-radius: 10px !important;">

														<i class="fa fa-wallet text-light-success"></i><br>
														Banka
														Listesi
													</a>
													<a href="<?= base_url("kasa/kasa-listesi") ?>"
													   class="text-light-danger font-weight-bold font-size-h6 mt-2 px-6 py-8 col bg-light-danger rounded-xl  mb-7"
													   style="border-radius: 10px !important;">
														<i class="fa fa-cash-register text-light-danger"></i><br>
														Kasa
														Listesi

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
												<?php foreach ($fatura as $item) {
													$paraBirimi = "TL";
													if ($item->paraBirimi == "2")
														$paraBirimi = "USD";
													else if ($item->paraBirimi == "3")
														$paraBirimi = "EUR";
													else if ($item->paraBirimi == "4")
														$paraBirimi = "GBP";
													if ($item->tip == "alis") {
														$title = "Alış Faturası";
														$link = "fatura/alis-faturasi/"
														?><li class="feed-item feed-item2">
													<?php } else {
														$title = "Satış Faturası";
														$link = "fatura/satis-faturasi/"; ?>
														<li class="feed-item">
													<?php } ?>
													<div class="feed-date"><?= $item->faturaTarihi ?></div>
													<span class="feed-text"><a
																href="<?= base_url($link . $item->id) ?>"
																title="<?= $title ?>"><?= strtoupper($item->cari_ad) . " - " . $item->genelToplam . " " . $paraBirimi ?></a></span>
													</li>
												<?php } ?>

											</ul>
										</div>
									</div>
								</div>
								<div id="div3" class="col-md-4">
									<div class="card">
										<div class="row">
											<div id="div4" class="col-md-12 col-sm-12 mt-2">
												<div id="chart-donut" style="height:250px !important; "></div>
											</div>
											<div id="div5" class="col-md-12 col-sm-12  mt-2">
												<div id="chart-bar" style="height:250px !important; "></div>
											</div>
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
											<div class="stats-title">Stok</div>
											<div class="stats-number"><?= number_format(stokHesapla(30)); ?></div>
											<div class="stats-progress progress">
												<div class="progress-bar"
													 style="width: <?= number_format($stokyuzde, 2) ?>%;"></div>
											</div>
											<div class="stats-desc">Son 30 Gün
												(%<?= number_format($stokyuzde, 2) ?>)
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3 col-lg-3 col-sm-6">
									<div class="widget widget-stats bg-light-primary mb-7px">
										<div class="stats-icon stats-icon-lg"><i class="fas fa-users fa-fw"></i></div>
										<div class="stats-content">
											<div class="stats-title">Müşteri</div>
											<div class="stats-number"><?= number_format(musteriHesapla(30)); ?></div>
											<div class="stats-progress progress">
												<div class="progress-bar"
													 style="width: <?= number_format($musteriyuzde, 2) ?>%;"></div>
											</div>
											<div class="stats-desc">Son 30 Gün
												(%<?= number_format($musteriyuzde, 2) ?>)
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3 col-lg-3 col-sm-6">
									<div class="widget widget-stats bg-light-danger mb-7px">
										<div class="stats-icon stats-icon-lg"><i class="fas fa-file-invoice fa-fw"></i>
										</div>
										<div class="stats-content">
											<div class="stats-title">Fatura</div>
											<div class="stats-number"><?= faturaHesapla(30); ?></div>
											<div class="stats-progress progress">
												<div class="progress-bar"
													 style="width: <?= number_format($faturayuzde, 2) ?>%;"></div>
											</div>
											<div class="stats-desc">Son 30 Gün
												(%<?= number_format($faturayuzde, 2) ?>)
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3 col-lg-3 col-sm-6">
									<div class="widget widget-stats bg-light-success mb-7px">
										<div class="stats-icon stats-icon-lg"><i class="fa fa-money-bill fa-fw"></i>
										</div>
										<div class="stats-content">
											<div class="stats-title">Alacak</div>
											<div class="stats-number"><?= number_format(alacakHesapla(30), 2); ?></div>
											<div class="stats-progress progress">
												<div class="progress-bar"
													 style="width: <?= number_format($alacakyuzde, 2); ?>%;"></div>
											</div>
											<div class="stats-desc">Son 30 Gün
												(%<?= number_format($alacakyuzde, 2); ?>)
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
			var element3 = document.getElementById("div3");
			var element4 = document.getElementById("div4");
			var element5 = document.getElementById("div5");
			if (width <= 1366) {

				element1.classList.remove("col-md-4");
				element1.classList.add("col-md-6");
				element2.classList.remove("col-md-4");
				element2.classList.add("col-md-6");
				element3.classList.remove("col-md-4");
				element3.classList.add("col-md-12");
				element4.classList.remove("col-md-12");
				element4.classList.add("col-md-6");
				element5.classList.remove("col-md-12");
				element5.classList.add("col-md-6");
			} else if (width >= 1920) {

				element1.classList.remove("col-md-6");
				element1.classList.add("col-md-4");
				element2.classList.remove("col-md-6");
				element2.classList.add("col-md-4");
				element3.classList.remove("col-md-12");
				element3.classList.add("col-md-4");
				element4.classList.remove("col-md-6");
				element4.classList.add("col-md-12");
				element5.classList.remove("col-md-6");
				element5.classList.add("col-md-12");
			}
		}

	});
</script>

</body>

</html>
