<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>
	<style>
	@font-face {
		font-family: 'password';
		font-style: normal;
		font-weight: 400;
		src: url(https://jsbin-user-assets.s3.amazonaws.com/rafaelcastrocouto/password.ttf);
	}

	input.key {
		font-family: 'password';
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

			<?php  $anaHesap = anaHesapBilgisi(); ?>
			
			<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-10">
								<h3 class="page-title">Modül</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item active">Döviz Kuru</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->


					

					<section class="comp-section comp-cards">
						<div class="row">
						
							<div class="col-12 col-md-6 col-lg-4 d-flex">
								<div class="card flex-fill bg-white">
								
									<div class="container">
										<div class="row">
											<div class="col text-center">
												<div class="card-footer">
												<a class="dropdown-item" href="javascript:void(0);"><b>Dolar: </b> <?= getPriceOfCurrency_TCMB(2); ?></a>
							<a class="dropdown-item" href="javascript:void(0);"><b>Euro: </b> <?= getPriceOfCurrency_TCMB(3); ?></a>
							<a class="dropdown-item" href="javascript:void(0);"><b>Gram Altın: </b> <?= getPriceOfCurrency(5); ?></a>
							<a class="dropdown-item" href="javascript:void(0);"><b>Bitcoin: </b> <?= number_format(getPriceOfCurrency(4),4); ?></a>
							<a class="dropdown-item" href="javascript:void(0);"><b>BIST 100: </b> <?= number_format(getPriceOfCurrency(1)); ?></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</section>
				</div>
			</div>
			<!-- /Page Wrapper -->
		</div>
		<!-- /Main Wrapper -->

	</body>
</html>
