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
	<div class="page-wrapper mt-4">
		<div class="content container-fluid mt-3 ">

			<div class="page-header">
				<div class="row">
					<div class="col-sm-10">
						<h3 class="page-title">GİB</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
							<li class="breadcrumb-item">GİB</li>
							<li class="breadcrumb-item active">GİB Bilgileri</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i>
							<br>Önceki Sayfa</a>
					</div>
				</div>
			</div>
			<div id="newRow"></div>

			<?php
			$anaHesap = anaHesapBilgisi();
			$ayarlarQ = "SELECT * FROM ayarlar WHERE ayarlar_id = '$anaHesap' ";
			$ayarlarExe = $this->db->query($ayarlarQ)->row();
			?>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<form method="post" action="<?= base_url("gib/gibBilgiGuncelle") ?>">
								<div class="row form-group">
									<label for="vkntckn" class="col-sm-3 col-form-label input-label">VKN / TCKN</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="vkntckn"
											   value="<?= $data->vknTckn ?>" readonly name="vkntckn">
									</div>
								</div>
								<div class="row form-group">
									<label for="vergiDairesi" class="col-sm-3 col-form-label input-label">Vergi Dairesi</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="vergiDairesi"
											   value="<?= $data->vergiDairesi ?>" name="vergiDairesi">
									</div>
								</div>
								<div class="row form-group">
									<label for="sicilNo" class="col-sm-3 col-form-label input-label">Sicil No</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="sicilNo"
											   value="<?= $data->sicilNo ?>" name="sicilNo">
									</div>
								</div>
								<div class="row form-group">
									<label for="mersisNo" class="col-sm-3 col-form-label input-label">Mersis No</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="mersisNo"
											   value="<?= $data->mersisNo ?>" name="mersisNo">
									</div>
								</div>
								<?php if(strlen($data->vknTckn)==10){?>
								<div class="row form-group">
									<label for="unvan" class="col-sm-3 col-form-label input-label">Unvan</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="unvan"
											   value="<?= $data->unvan ?>" name="unvan">
									</div>
								</div>
								<?php } else { ?>
								<div class="row form-group">
									<label for="ad" class="col-sm-3 col-form-label input-label">Ad</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="ad"
											   value="<?= $data->ad ?>" name="ad">
									</div>
								</div>
								<div class="row form-group">
									<label for="soyad" class="col-sm-3 col-form-label input-label">Soyad</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="soyad"
											   value="<?= $data->soyad ?>" name="soyad">
									</div>
								</div>
								<?php } ?>
								<div class="row form-group">
									<label for="ulke" class="col-sm-3 col-form-label input-label">Ülke</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="ulke"
											   value="<?= $data->ulke ?>" name="ulke">
									</div>
								</div>
								<div class="row form-group">
									<label for="il" class="col-sm-3 col-form-label input-label">İl</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="il"
											   value="<?= $data->il ?>" name="il">
									</div>
								</div>
								<div class="row form-group">
									<label for="ilce" class="col-sm-3 col-form-label input-label">İlçe</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="ilce"
											   value="<?= $data->ilce ?>" name="ilce">
									</div>
								</div>
								<div class="row form-group">
									<label for="cadde" class="col-sm-3 col-form-label input-label">Cadde</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="cadde"
											   value="<?= $data->cadde ?>" name="cadde">
									</div>
								</div>
								<div class="row form-group">
									<label for="isMerkezi" class="col-sm-3 col-form-label input-label">İş Merkezi</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="isMerkezi"
											   value="<?= $data->isMerkezi ?>" name="isMerkezi">
									</div>
								</div>
								<div class="row form-group">
									<label for="apartmanAdi" class="col-sm-3 col-form-label input-label">Apartman Adı</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="apartmanAdi"
											   value="<?= $data->apartmanAdi ?>" name="apartmanAdi">
									</div>
								</div>
								<div class="row form-group">
									<label for="apartmanNo" class="col-sm-3 col-form-label input-label">Apartman No</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="apartmanNo"
											   value="<?= $data->apartmanNo ?>" name="apartmanNo">
									</div>
								</div>
								<div class="row form-group">
									<label for="Mahalle" class="col-sm-3 col-form-label input-label">Mahalle</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="mahalle"
											   value="<?= $data->kasaba ?>" name="mahalle">
									</div>
								</div>
								<div class="row form-group">
									<label for="kapıNo" class="col-sm-3 col-form-label input-label">Kapı No</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="kapıNo"
											   value="<?= $data->kapıNo ?>" name="kapıNo">
									</div>
								</div>
								<div class="row form-group">
									<label for="postaKodu" class="col-sm-3 col-form-label input-label">Posta Kodu</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="postaKodu"
											   value="<?= $data->postaKodu ?>" name="postaKodu">
									</div>
								</div>
								<div class="row form-group">
									<label for="telefonNo" class="col-sm-3 col-form-label input-label">Telefon Numarası</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="telefonNo"
											   value="<?= $data->telefonNo ?>" name="telefonNo">
									</div>
								</div>
								<div class="row form-group">
									<label for="faxNo" class="col-sm-3 col-form-label input-label">Fax Numarası</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="faxNo"
											   value="<?= $data->faxNo ?>" name="faxNo">
									</div>
								</div>
								<div class="row form-group">
									<label for="eposta" class="col-sm-3 col-form-label input-label">E-posta</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="eposta"
											   value="<?= $data->eposta ?>" name="eposta">
									</div>
								</div>
								<div class="row form-group">
										<input type="submit" class="btn btn-danger col-12" value="Güncelle">
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

</body>

</html>
