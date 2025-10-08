<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>


	<!------ Include the above in your HEAD tag ---------->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
		  integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
		  crossorigin="anonymous" referrerpolicy="no-referrer"/>

	<style>
		.ui-autocomplete {
			z-index: 999999;
			max-height: 200px;
			overflow-y: auto;
			/* prevent horizontal scrollbar */
			overflow-x: hidden;
			/* add padding to account for vertical scrollbar */
			padding-right: 20px;
		}

		body {
			margin-top: 40px;
		}

		.stepwizard-step p {
			margin-top: 10px;
		}

		.stepwizard-row {
			display: table-row;
		}

		.stepwizard {
			display: table;
			width: 100%;
			position: relative;
		}

		.stepwizard-step button[disabled] {
			opacity: 1 !important;
			filter: alpha(opacity=100) !important;
		}

		.stepwizard-row:before {
			top: 14px;
			bottom: 0;
			position: absolute;
			content: " ";
			width: 100%;
			height: 1px;
			background-color: #ccc;
			z-order: 0;

		}

		.stepwizard-step {
			display: table-cell;
			text-align: center;
			position: relative;
		}

		.btn-circle {
			width: 30px;
			height: 30px;
			text-align: center;
			padding: 6px 0;
			font-size: 12px;
			line-height: 1.428571429;
			border-radius: 15px;
		}


		.has-success .help-block, .has-success .control-label, .has-success .radio, .has-success .checkbox, .has-success .radio-inline, .has-success .checkbox-inline {
			color: #3c763d
		}

		.has-success .form-control {
			border-color: #3c763d;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075)
		}

		.has-success .form-control:focus {
			border-color: #2b542c;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #67b168;
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #67b168
		}

		.has-success .input-group-addon {
			color: #3c763d;
			border-color: #3c763d;
			background-color: #dff0d8
		}

		.has-success .form-control-feedback {
			color: #3c763d
		}

		.has-warning .help-block, .has-warning .control-label, .has-warning .radio, .has-warning .checkbox, .has-warning .radio-inline, .has-warning .checkbox-inline {
			color: #8a6d3b
		}

		.has-warning .form-control {
			border-color: #8a6d3b;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075)
		}

		.has-warning .form-control:focus {
			border-color: #66512c;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #c0a16b;
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #c0a16b
		}

		.has-warning .input-group-addon {
			color: #8a6d3b;
			border-color: #8a6d3b;
			background-color: #fcf8e3
		}

		.has-warning .form-control-feedback {
			color: #8a6d3b
		}

		.has-error .help-block, .has-error .control-label, .has-error .radio, .has-error .checkbox, .has-error .radio-inline, .has-error .checkbox-inline {
			color: #a94442
		}

		.has-error .form-control {
			border-color: #a94442;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075)
		}

		.has-error .form-control:focus {
			border-color: #843534;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483;
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483
		}

		.has-error .input-group-addon {
			color: #a94442;
			border-color: #a94442;
			background-color: #f2dede
		}

		.has-error .form-control-feedback {
			color: #a94442
		}

		.form-control-static {
			margin-bottom: 0
		}

		.help-block {
			display: block;
			margin-top: 5px;
			margin-bottom: 10px;
			color: #737373
		}


		@media (min-width: 768px) {
			.form-horizontal .control-label {
				text-align: right
			}
		}

		.form-horizontal .has-feedback .form-control-feedback {
			top: 0;
			right: 15px
		}

		.btn {
			display: inline-block;
			margin-bottom: 0;
			font-weight: 400;
			text-align: center;
			vertical-align: middle;
			cursor: pointer;
			background-image: none;
			border: 1px solid transparent;
			white-space: nowrap;
			padding: 6px 12px;
			font-size: 14px;
			line-height: 1.428571429;
			border-radius: 4px;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			-o-user-select: none;
			user-select: none
		}

		.btn:focus {
			outline: thin dotted;
			outline: 5px auto -webkit-focus-ring-color;
			outline-offset: -2px
		}

		.btn:hover, .btn:focus {
			color: #333;
			text-decoration: none
		}

		.btn:active, .btn.active {
			outline: 0;
			background-image: none;
			-webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
			box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125)
		}

		.btn.disabled, .btn[disabled], fieldset[disabled] .btn {
			cursor: not-allowed;
			pointer-events: none;
			opacity: .65;
			filter: alpha(opacity=65);
			-webkit-box-shadow: none;
			box-shadow: none
		}

		.btn-default {
			color: #333;
			background-color: #fff;
			border-color: #ccc
		}

		.btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open .dropdown-toggle.btn-default {
			color: #333;
			background-color: #ebebeb;
			border-color: #adadad
		}

		.btn-default:active, .btn-default.active, .open .dropdown-toggle.btn-default {
			background-image: none
		}

		.btn-default.disabled, .btn-default[disabled], fieldset[disabled] .btn-default, .btn-default.disabled:hover, .btn-default[disabled]:hover, fieldset[disabled] .btn-default:hover, .btn-default.disabled:focus, .btn-default[disabled]:focus, fieldset[disabled] .btn-default:focus, .btn-default.disabled:active, .btn-default[disabled]:active, fieldset[disabled] .btn-default:active, .btn-default.disabled.active, .btn-default[disabled].active, fieldset[disabled] .btn-default.active {
			background-color: #fff;
			border-color: #ccc
		}

		.btn-default .badge {
			color: #fff;
			background-color: #333
		}

		.btn-primary {
			color: #fff;
			background-color: #428bca;
			border-color: #357ebd
		}

		.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary {
			color: #fff;
			background-color: #3276b1;
			border-color: #285e8e
		}

		.btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary {
			background-image: none
		}

	</style>
	<script>
		var formatter = new Intl.NumberFormat('tr-TR');
		var items = 0;
		var counter = [];
		var paraBirimiMetin = "TL";
		var items_indirim = 0;
		var counter_indirim = [];
		var items_iade = 0;
		var counter_iade = [];
		var items_banka = 0;
		var counter_banka = [];
		var checkboxbanka = 0;
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

	<?php
	$firmaID = getirFirma();
	$firma_ID = $firmaID->ayarlar_id;
	$modulGibProSorgula = modulSorgula($firma_ID, 3);

	$anaHesap = anaHesapBilgisi();
	?>

	<!-- Page Wrapper -->
	<div class="page-wrapper">
		<div class="content container-fluid">

			<!-- Page Header -->
			<div class="page-header">
				<div class="row">
					<div class="col-sm-10">
						<h3 class="page-title">GİB</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
							<li class="breadcrumb-item">GİB</li>
							<li class="breadcrumb-item active">Fatura Oluştur</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i>
							<br>Önceki Sayfa</a>
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			<div id="newRow"></div>

			<div class="row">

				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<?php
							if ($invoice)
								$action = "gib/faturaDuzenleKaydet";
							else
								$action = "gib/faturaOlusturKaydet";

							?>
							<div class="container">
								<div class="stepwizard mb-4">
									<div class="stepwizard-row setup-panel">
										<div class="stepwizard-step">
											<a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
											<p>Alıcı Bilgileri</p>
										</div>
										<div class="stepwizard-step">
											<a href="#step-2" type="button" class="btn btn-default btn-circle"
											   disabled="disabled">2</a>
											<p>Fatura Bilgileri</p>
										</div>
										<div class="stepwizard-step">
											<a href="#step-3" type="button" class="btn btn-default btn-circle"
											   disabled="disabled">3</a>
											<p>Fatura İçeriği</p>
										</div>
									</div>
								</div>
								<form role="form" action="<?= base_url($action) ?>" method="post" class="mt-4">

									<div class="row setup-content" id="step-1">
										<input type="hidden" name="faturaUuid" value="<?= $invoice["faturaUuid"] ?>">
										<input type="hidden" name="belgeNumarasi"
											   value="<?= $invoice["belgeNumarasi"] ?>">

										<input type="hidden" name="satis_id"
											   value="<?= $satisID ?>">
										<div class="col-12">
											<div class="row">
												<div class="col-lg-6">
													<div class="mb-3 form-group">
														<label class="text-sm-left control-label pt-2">TCKN/VKN </label>
														<input type="text" class="form-control"
															   name="tcknvkn" maxlength="11"
															   id="tcknvkn"
															   required onblur="tcknvknKontrol()"
															   value="<?= $invoice["vknTckn"] ?>"><img
																src="/assets/img/Eclipse-1s-200px.gif"
																style="position: absolute; right:20px; bottom: 18px; width:40px; display:none;"
																id="loading-image"/>
														<input type="hidden" name="cari_id" id="cari_id" value="<?= $cariID ?>">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="mb-3 form-group unvan" <?php if (!$invoice["aliciUnvan"]) echo 'style="display: none"'; ?>>
														<label class="text-sm-left pt-2 control-label ">Unvan </label>
														<input type="text" class="form-control"
															   name="unvan"
															   id="unvan"
															   value="<?= $invoice["aliciUnvan"] ?>">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="mb-3 form-group ad" <?php if (!$invoice["aliciAdi"]) echo 'style="display: none"'; ?>>
														<label class="text-sm-left pt-2 control-label">Ad </label>
														<input type="text" class="form-control"
															   name="ad"
															   id="ad"
															   value="<?= $invoice["aliciAdi"] ?>">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="mb-3 form-group soyad" <?php if (!$invoice["aliciSoyadi"]) echo 'style="display: none"'; ?>>
														<label class="text-sm-left pt-2 control-label">Soyad </label>
														<input type="text" class="form-control"
															   name="soyad"
															   id="soyad"
															   value="<?= $invoice["aliciSoyadi"] ?>">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="mb-3 form-group">
														<label class="text-sm-left pt-2 control-label">Vergi
															Dairesi </label>
														<input type="text" class="form-control"
															   name="vergiDairesi"
															   id="vergiDairesi"
															   value="<?= $invoice["vergiDairesi"] ?>">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="mb-3 form-group">
														<label class="text-sm-left control-label pt-2">Adres</label>
														<textarea class="form-control" name="adres" rows="1"
																  id="adres_input"
																  style="resize: none;"></textarea>
													</div>
												</div>
											</div>

											<button class="btn btn-primary nextBtn btn-lg pull-right" type="button">
												Sonraki
											</button>
										</div>

									</div>
									<div class="row setup-content" id="step-2">
										<div class="col-12">
											<div class="row">
												<div class="col-lg-6">
													<div class="mb-3 form-group">
														<label class="text-sm-left pt-2 control-label">Düzenleme
															Tarihi</label>
														<input type="text"
															   class="form-control"
															   name="duzenlemeTarihi" autocomplete="off"
															   required="" readonly
															   value="<?php if ($invoice) echo $invoice["faturaTarihi"]; else echo getirBugunGib(); ?>"/>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="mb-3 form-group">
														<label class="text-sm-left control-label pt-2">Düzenleme
															Saati</label>
														<input type="text" class="form-control"
															   name="duzenlemeSaati" autocomplete="off"
															   required="" readonly
															   value="<?php if ($invoice) echo $invoice["saat"]; else echo getirSaatGib(); ?>"
														/>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="mb-3 form-group">
														<label class="text-sm-left control-label pt-2">Tip</label>
														<select class="form-control" name="faturaTip"
																id="faturaTip" required="">
															<option value="SATIS" <?php if ($invoice["faturaTipi"] == "SATIS") echo "selected"; ?>>
																SATIŞ
															</option>
															<option value="IADE" <?php if ($invoice["faturaTipi"] == "IADE") echo "selected"; ?>>
																İADE
															</option>
															<option value="TEVKIFAT" <?php if ($invoice["faturaTipi"] == "TEVKIFAT") echo "selected"; ?>>
																TEVKİFAT
															</option>
															<option value="ISTISNA" <?php if ($invoice["faturaTipi"] == "ISTISNA") echo "selected"; ?>>
																İSTİSNA
															</option>
														</select>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="mb-3 form-group">
														<label class="col-sm-3 text-sm-left control-label pt-2">Para
															Birimi</label>
														<div class="row pl-3">
															<select class="form-control col-7"
																	name="paraBirimi" id="paraBirimi">
																<option value="TRY" <?php if ($invoice["paraBirimi"] == "TRY") echo "selected"; ?>>
																	Türk Lirası
																</option>
																<option value="USD" <?php if ($invoice["paraBirimi"] == "USD") echo "selected"; ?>>
																	Amerikan Doları
																</option>
																<option value="EUR" <?php if ($invoice["paraBirimi"] == "EUR") echo "selected"; ?>>
																	Euro
																</option>
																<option value="GBP" <?php if ($invoice["paraBirimi"] == "GBP") echo "selected"; ?>>
																	İngiliz Sterlini
																</option>
															</select>

															<input type="text" name="guncelKur"
																   id="guncelKur"
																   class="form-control col-4 ml-3"
																   placeholder="Döviz kuru"
																   value="<?php if ($invoice) echo $invoice["dovzTLkur"]; else echo "0"; ?>"/>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="mb-3 form-group">
														<label class="text-sm-left control-label pt-2">İrsaliye
															Numarası</label>
														<input type="text"
															   class="datepicker form-control"
															   id="irsaliyeNo"
															   name="irsaliyeNo" autocomplete="off"
															   value="<?= $invoice["irsaliyeNumarasi"] ?>"/>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="mb-3 form-group">
														<label class="col-sm-4 control-label text-sm-left pt-2">İrsaliye
															Tarihi</label>
														<input type="text"
															   class="datepicker form-control"
															   id="irsaliyeTarihi"
															   name="irsaliyeTarihi" autocomplete="off"
															   value="<?= $invoice["irsaliyeTarihi"] ?>"/>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="mb-3 ">
														<label>Fatura Notu</label>
														<textarea class="form-control"
																  name="aciklama"><?= $invoice["not"] ?></textarea>
													</div>
												</div>
											</div>
											<button class="btn btn-primary nextBtn btn-lg pull-right" type="button">
												Sonraki
											</button>
										</div>
									</div>
									<div class="row setup-content" id="step-3">
										<div class="col-12">
											<div class="row"
												 id="iade_fatura_bilgi" <?php if (empty($iadeFaturalari)) echo 'style="display: none;"'; ?>>
												<div class="col-md-12">
													<h4 class="card-title mt-4">İade Fatura Bilgisi </h4>
													<div class="row">
														<div class="table-responsive">
															<input type="hidden" name="iade_count" id="iade_count">
															<table class="table table-bordered custom-table mb-0"
																   id="my_table">
																<tbody id="tbody_iade">
																<?php
																$itemsIade = 0;

																$iadeFaturalari = $invoice["iadeTable"];
																foreach ($iadeFaturalari as $itemIade) {
																	$itemsIade++; ?>
																	<tr>
																		<td>Numarası</td>
																		<td>
																			<input type='text' class='form-control'
																				   name='iadenumara[]'
																				   id='iadenumara<?= $itemsIade ?>'
																				   value="<?= $itemIade->fatura_numarasi ?>">
																		</td>
																		<td>Tarihi</td>
																		<td>
																			<input type='date' class='form-control'
																				   name='iadetarih[]'
																				   id='iadetarih<?= $itemsIade ?>'
																				   value="<?= $itemIade->tarih ?>">
																		</td>
																		<td>
																			<button type='button'
																					class='btn btn-info btn-sm'
																					onclick='addItemIade()'>
																				<i class='fa fa-plus'></i> Ekle
																			</button>
																			<button type='button'
																					onclick='deleteRowIade(this);'
																					class='btn btn-danger btn-sm'
																					id='<?= $itemsIade ?>'>
																				<i class='fa fa-trash'></i> Sil
																			</button>
																		</td>
																	</tr>
																	<script>
																		items_iade++;
																		counter_iade.push(items_iade);
																		document.getElementById("iade_count").value = items_iade;
																	</script>
																	<?
																}
																?>


																</tbody>
															</table>
														</div>
													</div>
												</div>

											</div>
											<div class="row mb-4" id="stokBilgisiDiv">
												<div class="col-md-12">
													<div class="row mb-2">
														<div class="col-12">
															<h4 class="card-title mt-4 text-right">
																<input class="form-check-input"
																	   type="checkbox"
																	   value="1"
																	   id="kdvCheck"
																	   onchange="kdvCheckFunc()"
																	   name="kdvCheck"
																	   style="width:30px;height:20px;">
																<label class="form-check-label ml-3 mr-4"
																	   for="kdvCheck"
																	   style="font-size:14px;">
																	KDV Dahil
																</label>
																<br>
																<br>
																<a href="javascript:void(0)"
																   class=" btn btn-success btn-sm"
																   onclick="addItem();"
																   style="float:right;"><i
																			class="fa fa-plus"></i>
																	Yeni
																	Satır Ekle</a>

																<a href="javascript:void(0)"
																   class="btn btn-info btn-sm mr-2"
																   style="float:right;"
																   onclick="addIndirim();$('#genel_iskonto').attr('style', 'display:block;');"><i
																			class="fa fa-plus"></i>
																	Genel İskonto</a>
															</h4>
														</div>
													</div>

													<div class="row">
														<div class="table-responsive">
															<table class="table table-bordered custom-table mb-0"
																   id="my_table">
																<thead>
																<tr>
																	<th>Stok Adı</th>
																	<th>Birim</th>
																	<th>Miktar</th>
																	<th>Birim Fiyat <span
																				id="birimFiyatParaBirimi">(TL)</span>
																	</th>
																	<th>KDV (%)</th>
																	<th>Toplam</th>
																	<th></th>
																</tr>
																</thead>
																<tbody id="tbody">
																<script>var items = 0;</script>
																<?php
																if ($invoice) {
																	$items = 1;

																	$malhizmet = $invoice["malHizmetTable"];
																	foreach ($malhizmet as $item) {
																		$stokQ = "select * from stok where stok_ad='" . $item["malHizmet"] . "' and stok_olusturanAnaHesap = '$anaHesap'";
																		$stokExe = $this->db->query($stokQ)->row();
																		if ($stokExe)
																			$stokid = $stokExe->stok_id;
																		else $stokid = "";
																		?>
																		<script>items++;</script>
																		<tr>
																			<td>
																				<input type='hidden' name='stokid[]'
																					   id='stokid<?= $items ?>'
																					   value="<?= $stokid ?>">
																				<input type='text'
																					   class='form-control'
																					   name='stokadi[]'
																					   id='stokadi<?= $items ?>'
																					   required
																					   value="<?= $item["malHizmet"] ?>">
																			</td>
																			<td>
																				<select class='form-control'
																						name='birim[]'
																						id='birim<?= $items ?>'>
																					<?= $birimler ?>
																				</select>
																				<script>

																					document.getElementById("birim" + items).value = "<?= $item["birim"] ?>";
																				</script>
																			</td>
																			<td>
																				<input type='number'
																					   step='0.1'
																					   class='form-control'
																					   autocomplete='off'
																					   name='miktar[]'
																					   id='miktar<?= $items ?>'
																					   required=''
																					   style='width:175px;'
																					   value="<?= $item["miktar"] ?>">
																			</td>
																			<td>
																				<input type='number'
																					   step='0.1'
																					   class='form-control'
																					   autocomplete='off'
																					   name='birimfiyat[]'
																					   id='birimfiyat<?= $items ?>'
																					   required=''
																					   value="<?= $item["birimFiyat"] ?>">
																			</td>
																			<td>
																				<select class='form-control'
																						name='kdv[]'
																						id='kdv<?= $items ?>'>
																					<option value='0' <?php if ($item["kdvOrani"] == 0) echo "selected"; ?>>
																						0
																					</option>
																					<option value='1' <?php if ($item["kdvOrani"] == 1) echo "selected"; ?>>
																						1
																					</option>
																					<option value='8' <?php if ($item["kdvOrani"] == 8) echo "selected"; ?>>
																						8
																					</option>
																					<option value='18' <?php if ($item["kdvOrani"] == 18) echo "selected"; ?>>
																						18
																					</option>
																				</select>
																			</td>
																			<td>
																				<input type='hidden'
																					   name='indirimtutari[]'
																					   id='indirimtutari<?= $items ?>>'
																					   value="<?= $item["iskontoTutari"] ?>">
																				<input type='text'
																					   class='form-control'
																					   name='toplam[]'
																					   id='toplam<?= $items ?>'
																					   readonly
																					   value="<?= $item["malHizmetTutari"] ?>">
																				<input type='hidden'
																					   name='toplamHidden[]'
																					   value="<?= $item["malHizmetTutari"] ?>"
																					   id='toplamHidden<?= $items ?>'>
																			</td>
																			<td>
																				<button type='button'
																						class='btn btn-info btn-sm'
																						data-toggle='modal'
																						data-target='#add_category'
																						data-idsi='<?= $items ?>'
																						id='eklebuton<?= $items ?>'>
																					<i
																							class='fa fa-plus'></i>
																					Ekle
																				</button>
																				<button type='button'
																						onclick='deleteRow(this);'
																						class='btn btn-danger btn-sm'
																						id='<?= $items ?>>'>
																					<i
																							class='fa fa-trash'></i>
																					Sil
																				</button>
																			</td>
																		</tr>

																		<td id='indirimytd<?= $items ?>>' <?php if ($item["iskontoOrani"] == "") echo "style='display: none;'"; ?>>
																			<label>İndirim
																				(%)</label>
																			<input type='number'
																				   step='0.1'
																				   class='form-control'
																				   placeholder='İndirim (%)'
																				   name='indirimyuzde[]'
																				   id='indirimyuzde<?= $items ?>'
																				   value="<?= $item["iskontoOrani"] ?>">
																		</td>
																	<?php if ($item["tevkifatKodu"]){
																	$oran = $item["V9015Orani"] / 100;
																	?>
																		<td id='tevkifatselecttd<?= $items ?>'>
																			<label>Tevkifat</label>
																			<select name='tevkifat[]'
																					id='tevkifat<?= $items ?>'
																					class='form-control'
																					onchange='tevkifat(this,<?= $items ?>)'>
																				<option value='0'>
																					Seçiniz
																				</option>
																				<?php echo $tevkifat; ?>
																			</select>
																			<script>document.getElementById("tevkifat" + items).value = "<?php echo $item["tevkifatKodu"] . "|" . $oran?>";</script>
																		</td>
																		<td id='tevkifattexttd<?= $items ?>'>
																			<label>Tevkifat
																				Oranı(%)</label>
																			<input type='text' class='form-control'
																				   name='tevkifat_oran[]'
																				   id='tevkifat_oran<?= $items ?>'
																				   readonly
																				   placeholder='Tevkifat Oranı(%)'
																				   value="<?= $item["V9015Orani"] ?>">
																		</td>

																	<?php } ?>
																	<?php if ($item["gtip"]){ ?>
																		<td id="gtiptd<?= $items ?>">
																			<label>Gtip</label>
																			<input type='text' class='form-control'
																				   name='gtip[]' maxlength="12"
																				   id='gtip<?= $items ?>'
																				   value="<?= $item["gtip"] ?>"
																				   placeholder='Gtip'>
																		</td>
																	<?php } ?>
																		<?php
																		$items++;

																	} ?>

																<?php }
																?>
																</tbody>

															</table>
														</div>
													</div>

													<div class="row" style="display: none;"
														 id="genel_iskonto">
														<div class="col-md-12">
															<h4 class="card-title mt-4">GENEL
																İNDİRİM ISKONTO </h4>
															<div class="row">
																<div class="table-responsive">
																	<input type="hidden"
																		   name="indirim_count"
																		   id="indirim_count">
																	<table class="table table-bordered custom-table mb-0"
																		   id="my_table">
																		<tbody id="tbody_indirim">

																		</tbody>
																	</table>
																</div>
															</div>
														</div>

													</div>

													<div class="row " style="display: none;"
														 id="vergiMuafiyet">
														<div class="col-md-12">
															<h4 class="card-title mt-4">VERGİ
																MUAFİYET </h4>
															<table class="table custom-table mb-0">
																<tr>
																	<td style="width:5%;"><label>Vergi
																			Muafiyet Sebebi</label>
																	</td>
																	<td>
																		<input type="text"
																			   name="vergiMuafiyet_sebep"
																			   id="vergiMuafiyet_sebep"
																			   class="form-control"
																			   value="">
																	</td>
																</tr>
															</table>
														</div>
													</div>

												</div>
											</div>

											<div class="row">
												<div class="table-responsive">

													<table class="table table-stripped table-center table-hover">
														<thead></thead>
														<tbody>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td class="text-right">Ara Toplam</td>
															<td class="text-right"
																id="aratop"></td>
														</tr>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td class="text-right">Toplam
																İskonto(İndirim)
															</td>
															<td class="text-right"
																id="indirimtop"></td>
														</tr>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td class="text-right">Net Tutar(Matrah)
															</td>
															<td class="text-right"
																id="nettutartop"></td>
														</tr>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td class="text-right">Hesaplanan KDV</td>
															<td class="text-right"
																id="kdvtop"></td>
														</tr>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td class="text-right">Hesaplanan KDV
																Tevkifat
															</td>
															<td class="text-right"
																id="kdvtevkifat"></td>
														</tr>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td class="text-right">Vergiler Dahil
																Ödenecek Tutar
															</td>
															<td class="text-right"
																id="vergidahil"></td>
														</tr>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td class="text-right">Genel Toplam</td>
															<td class="text-right"
																id="geneltop"></td>
														</tr>
														</tbody>
													</table>
													<input type="hidden" id="aratopHidden" name="aratopHidden"
														   value="">
													<input type="hidden" id="kdvtopHidden" name="kdvtopHidden"
														   value="">
													<input type="hidden" id="geneltopHidden" name="geneltopHidden"
														   value="">
													<input type="hidden" id="vergidahilHidden" name="vergidahilHidden"
														   value="">
													<input type="hidden" id="indirimtopHidden" name="indirimtopHidden"
														   value="">
													<input type="hidden" id="tevkifattopHidden" name="tevkifattopHidden"
														   value="">
													<input type="hidden" id="netTutarInput" name="netTutarInput"
														   value="">
												</div>

											</div>

											<button class="btn btn-danger btn-lg pull-right" type="submit">
												Fatura Oluştur
											</button>
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


	<div id="add_category" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">İşlem Seçiniz</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="POST">
						<input class="form-control" type="hidden" id="add_idsi" name="id">

						<select name="add_secim[]" multiple id="add_secim" class="form-control select"
								placeholder="Seçiniz...">
							<option value="1">İndirim (%)</option>
						</select>

						<div class="submit-section">
							<a class="btn btn-danger" id="ekle_kaydet">Ekle</a>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<?php $this->load->view("include/footer-js"); ?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
			integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
			crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
	<script>
		$(function () {
			$('.datepicker').datepicker({
				dateFormat: 'dd/mm/yy',
				language: 'tr'/*,
			autoclose: true,
			todayHighlight: true,
			format: 'mm/dd/yyyy',
			startDate: new Date(new Date().setDate(new Date().getDate() -7)),
			endDate: new Date(new Date())*/
			});
		});

		$(function () {
			$('#datetimepicker').datetimepicker({
				format: 'HH:mm:ss'
			});
		});
	</script>


	<script>

		function kdvCheckFunc() {

			if (document.getElementById("kdvCheck").checked == true) {
				$('input[name^="birimfiyat"]').prop('readonly', true);
				$('input[name^="toplam"]').prop('readonly', false);
			} else {
				$('input[name^="birimfiyat"]').prop('readonly', false);
				$('input[name^="toplam"]').prop('readonly', true);
			}
			hesapla();

		}

		function stokKontrol(stok) {
			var id = stok.match(/\d/g);
			var stokID = $("#stokid" + id).val();
			if (stokID == "") {
				$("#stokadi" + id).css("background-color", "#dff1e7");
				$("#birim" + id).css("background-color", "#dff1e7");
			} else {
				$("#stokadi" + id).css("background-color", "#e9ecef");
				$("#birim" + id).css("background-color", "#e9ecef");
			}
		}

		function addItem() {

			items++;
			counter.push(items);
			var html = "<tr>";
			html += "<td><input type='hidden' name='stokid[]' id='stokid" + items + "' ><input type='text' class='form-control' name='stokadi[]' id='stokadi" + items + "'  onblur='stokKontrol(this.id)' required></td>";
			html += "<td><select class='form-control' name='birim[]' id='birim" + items + "'><?= $birimler ?></select></td>";
			html += "<td><input type='number' step='0.1' class='form-control' autocomplete='off' name='miktar[]' id='miktar" + items + "' required='' style='width:175px;' ></td>";
			html += "<td><input type='number' step='0.1' class='form-control' autocomplete='off' name='birimfiyat[]' id='birimfiyat" + items + "' required='' ></td>";
			/*html += "<td><input type='text' class='form-control' name='kdv[]' id='kdv"+items+"' readonly></td>";*/
			html += "<td><select class='form-control' name='kdv[]' id='kdv" + items + "' ><option value='0' >0</option><option value='1 '>1</option><option value='8' selected>8</option><option value='18'>18</option></select></td>";
			html += "<td><input type='hidden' name='indirimtutari[]' id='indirimtutari" + items + "'><input type='text' class='form-control' name='toplam[]' id='toplam" + items + "' readonly><input type='hidden' name='toplamHidden[]' id='toplamHidden" + items + "'></td>";
			html += "<td><button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#add_category' data-idsi='" + items + "' id='eklebuton" + items + "' ><i class='fa fa-plus'></i> Ekle</button> <button type='button' onclick='deleteRow(this);' class='btn btn-danger btn-sm' id='" + items + "'><i class='fa fa-trash'></i> Sil</button> </td>";
			html += "</tr>";
			var row = document.getElementById("tbody").insertRow();
			row.innerHTML = html;
			var secenekler = "<td id='indirimytd" + items + "' style='display: none;'><label>İndirim (%)</label><input type='number' step='0.1' class='form-control' placeholder='İndirim (%)' name='indirimyuzde[]'   id='indirimyuzde" + items + "'></td>";
			secenekler += "<td id='tevkifatselecttd" + items + "' style='display: none;' ><label>Tevkifat</label><select  name='tevkifat[]'  id='tevkifat" + items + "'class='form-control' onchange='tevkifat(this," + items + ")'><option value='0'>Seçiniz</option><?php echo $tevkifat; ?></select></td>";
			secenekler += "<td id='tevkifattexttd" + items + "' style='display: none;' ><label>Tevkifat Oranı(%)</label><input type='text' class='form-control' name='tevkifat_oran[]' id='tevkifat_oran" + items + "' readonly placeholder='Tevkifat Oranı(%)'></td><td id='gtiptd" + items + "' style='display: none;'><label>Gtip</label><input type='text' class='form-control'  name='gtip[]' id='gtip" + items + "'  placeholder='Gtip' maxlength='12'></td>";


			var row = document.getElementById("tbody").insertRow();
			row.innerHTML = secenekler;
			<?php
			if ($modulGibProSorgula) {

				echo 'function stokKontrol(stok) {
		var id = stok.match(/\d/g);
		var stokID = $("#stokid" + id).val();
		if (stokID == "") {
			$("#stokadi" + id).css("background-color", "#dff1e7");
			$("#stokkodu" + id).css("background-color", "#dff1e7");
			$("#barkod" + id).css("background-color", "#dff1e7");
			$("#birim" + id).css("background-color", "#dff1e7");
		} else {
			$("#stokadi" + id).css("background-color", "#e9ecef");
			$("#stokkodu" + id).css("background-color", "#e9ecef");
			$("#barkod" + id).css("background-color", "#e9ecef");
			$("#birim" + id).css("background-color", "#e9ecef");
		}
	}';


				echo '$("#stokadi" + items).autocomplete({
			source: "' . env('BASE_URL') . '/fatura/autocompleteDataByStockName",
			minLength: 2,
				select: function (event, ui) {
				event.preventDefault();
				$(".ui-autocomplete").modal("hide");
				toastr.success(ui.item.value + " stok isimli stok bilgileri getirildi.");
				let id = event.target.id;
				var idsi = id.match(/\d/g);
				idsi = idsi.join("");

				$("#stokid" + idsi + "").val(ui.item.id);
				$("#stokadi" + idsi + "").val(ui.item.value);
				$("#birim" + idsi + "").val(ui.item.stok_birimi);
				$("#birimfiyat" + idsi + "").val(ui.item.stok_alisFiyati);
				$("#kdv" + idsi + "").val(ui.item.stok_alisKDV);
				$("#miktar" + idsi + "").val("1");
				$("#toplam" + idsi + "").val("1");
				document.getElementById("stokadi" + idsi).readOnly = true;
				//document.getElementById("birim" + idsi).disabled = true;
				$("#birim" + idsi).css("pointer-events", "none");
				$("#birim" + idsi).css("background-color", "#e9ecef");

				$("#stokadi" + idsi).css("background-color", "#e9ecef");
				$("#birim" + idsi).css("background-color", "#e9ecef");
				var tip = $("#alis_faturaTip").val();
				if (tip != 4 && tip != 5 && tip !=6)
					vergimuafiyet();
				if (document.getElementById("kdvCheck").checked == false)
					hesapla();
			}
		});';
			}
			?>

			if (document.getElementById("kdvCheck").checked == true) {
				$('input[name^="birimfiyat"]').prop('readonly', true);
				$('input[name^="toplam"]').prop('readonly', false);
			} else {
				$('input[name^="birimfiyat"]').prop('readonly', false);
				$('input[name^="toplam"]').prop('readonly', true);
			}

		}

		<?php if (!$invoice)
			echo "addItem();";
		else
			echo "hesapla();";
		?>

		function addIndirim() {
			items_indirim++;
			counter_indirim.push(items_indirim);
			var html_indirim = "<tr>";
			html_indirim += "<td>Sebebi </td>";
			html_indirim += "<td><select class='form-control select' name='indirimsebep[]' id='indirimsebep" + items_indirim + "'><option value='0'>İskonto</option><option value='1'>Nakit İskontosu</option><option value='2'>Diğer</option></select></td>";
			html_indirim += "<td>Tutar </td>";
			html_indirim += "<td><input type='number' class='form-control' name='indirimtutar[]' id='indirimtutar" + items_indirim + "' placeholder='İndirim (%)'></td>";
			html_indirim += "<td><button type='button' onclick='deleteRowIndirim(this);' class='btn btn-danger btn-sm' id='" + items + "'><i class='fa fa-trash'></i> Sil</button> </td>";
			html_indirim += "</tr>";

			var rowIndirim = document.getElementById("tbody_indirim").insertRow();
			rowIndirim.innerHTML = html_indirim;
			$("#indirim_count").val(items_indirim);
		}

		function tevkifat(object, items) {
			var val = object.value;
			val = (val.split("|"))[1];
			val = val * 100;
			$("#tevkifat_oran" + items).val(val);
			hesapla();
		}


		function round(value, decimals) {

			if (value != "NaN") {
				//return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);/*
				var x = value;
				var array = x.toString().split(".");
				x = array[1];
				if (x) {
					var ondalik = x.substr(0, 2);
					if (parseInt(x[1]) % 2 == 0) {
						return Number(array[0] + "." + ondalik);
					} else {
						return Number(Math.ceil(value + 'e' + decimals) + 'e-' + decimals);
					}
				}
			} else return 0;

		}

		function hesapla() {
			var aratop = 0;
			var kdvtop = 0;
			var geneltop = 0;
			var nettop = 0;
			var fiyat = 0;
			var indirimtop = 0;
			var tevkifattop = 0;
			var kdvHesap = 0;
			var i = 1;
			for (i = 1; i <= items; i++) {
				var satir = $("#stokadi" + i);
				if (satir.length >= 1) {
					fiyat = 0;
					kdvHesap = 0;
					var miktar = $("#miktar" + i + "").val();
					var birimfiyat = $("#birimfiyat" + i + "").val();
					var toplam = $("#toplam" + i + "").val();
					var kdvoran = $("#kdv" + i).val();
					var indirimyuzde = $("#indirimyuzde" + i).val();
					var tevkifat = $("#tevkifat" + i).val();
					if (document.getElementById("kdvCheck").checked == true) {
						birimfiyat = miktar * kdvoran / 100;
						birimfiyat += parseFloat(miktar);
						birimfiyat = parseFloat(toplam) / birimfiyat;
						$("#birimfiyat" + i + "").val(birimfiyat);
					}
					fiyat = miktar * birimfiyat;
					aratop += fiyat;//ara toplam
					if (indirimyuzde != "") {
						var indirimtutari = fiyat * indirimyuzde / 100;
						indirimtop += parseFloat(indirimtutari); //toplam indirim
						fiyat = fiyat - parseFloat(indirimtutari);
					}
					if (items_indirim != 0) {
						var iskonto = iskontoHesapla(fiyat);
						iskonto = iskonto.toString().split("|");
						fiyat = parseFloat(iskonto[0]);
						indirimtop += parseFloat(iskonto[1]);
					}
					if (document.getElementById("kdvCheck").checked == false)
						$("#toplam" + i + "").val(fiyat);
					$("#toplamHidden" + i + "").val(fiyat);

					kdvHesap = fiyat * parseFloat(kdvoran) / 100;
					kdvtop += kdvHesap;

					if (tevkifat) {
						if (tevkifat != 0) {
							var tevkifatOran = (tevkifat.split("|"));
							var tevkifatHesap = kdvHesap * tevkifatOran[0];
							tevkifattop = tevkifattop + tevkifatHesap;
						}
					}


					nettop = aratop - indirimtop;
					geneltop = nettop + kdvtop;

					$("#vergidahil").html(formatter.format(round((geneltop).toFixed(3), 2)) + " " + paraBirimiMetin);
					$("#vergidahilHidden").val(round((geneltop).toFixed(3), 2));


					geneltop = round(geneltop.toFixed(3), 2) - round((tevkifattop).toFixed(3), 2);


					$("#aratop").html(formatter.format(round((aratop).toFixed(3), 2)) + " " + paraBirimiMetin);
					$("#aratopHidden").val(round((aratop).toFixed(3), 2));
					$("#kdvtop").html(formatter.format(round(kdvtop, 2)) + " " + paraBirimiMetin);
					$("#kdvtopHidden").val(round(kdvtop, 2));
					$("#geneltop").html(formatter.format(round((geneltop).toFixed(3), 2)) + " " + paraBirimiMetin);
					$("#geneltopHidden").val(round((geneltop).toFixed(3), 2));

					$("#netTutarInput").val(round((nettop).toFixed(3), 2));

					$("#nettutartop").html(formatter.format(round((nettop).toFixed(3), 2)) + " " + paraBirimiMetin);

					$("#indirimtop").html(formatter.format(round((indirimtop).toFixed(3), 2)) + " " + paraBirimiMetin);
					$("#indirimtopHidden").val(round((indirimtop).toFixed(3), 2));


					$("#kdvtevkifat").html(formatter.format(round((tevkifattop).toFixed(3), 2)) + " " + paraBirimiMetin);
					$("#tevkifattopHidden").val(round((tevkifattop).toFixed(3), 2));

				}
			}

		}

		function iskontoHesapla(toplamsatir) {

			var toplamindirim = 0;

			for (k = 1; k <= items_indirim; k++) {
				var iskonto = 0;
				var tutar = $("#indirimtutar" + k + "").val();
				var hesap = $.trim(tutar).length;
				if (hesap != 0) {

					iskonto = toplamsatir * tutar / 100;

					toplamindirim += iskonto;
					toplamsatir = toplamsatir - iskonto;
				}
			}


			return toplamsatir + "|" + toplamindirim;
		}

		function deleteRow(button) {
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
				$('#bos' + btnID + '').remove();
				$('#indirimytd' + btnID + '').remove();
				$('#indirimttd' + btnID + '').remove();
				$('#tevkifattd' + btnID + '').remove();
				$('#istisnatd' + btnID + '').remove();
				$('#tevkifatselecttd' + btnID + '').remove();
				$('#tevkifattexttd' + btnID + '').remove();
				$('#gtiptd' + btnID + '').remove();
				hesapla();

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


		$('#add_category').on('show.bs.modal', function (event) {
			let a_idsi = $(event.relatedTarget).data('idsi')
			$(this).find('.modal-body #add_idsi').val(a_idsi)
		})


		function vergimuafiyet() {
			$("#vergiMuafiyet").css("display", "none");
			document.getElementById("vergiMuafiyet_sebep").required = false;
			var sonuc = 0;
			for (i = 1; i <= items; i++) {
				var val = $("#kdv" + i).val();
				if (val == 0) {
					sonuc = 1;
					break;
				}
			}
			if (sonuc == 1) {
				$("#vergiMuafiyet").css("display", "block");
				document.getElementById("vergiMuafiyet_sebep").required = true;
			}
		}

		$(document).on('change', 'select[name^="kdv"]', function () {
			var tip = $("#faturaTip").val();
			if (tip != "ISTISNA")
				vergimuafiyet();
			hesapla();
		});

		$(document).on('change', 'input[name^="miktar"]', function () {
			hesapla();

		});

		$(document).on('change', 'input[name^="birimfiyat"]', function () {
			hesapla();

		});

		$(document).on('change', 'input[name^="indirimyuzde"]', function () {
			/*
					let indirimtop = 0;

					let id = event.target.id;
					var numb = id.match(/\d/g);
					numb = numb.join("");

					var indirimyuzde = $("#indirimyuzde" + numb + "").val();
					var toplam = $("#toplam" + numb + "").val();

					var indirimtutari = toplam * indirimyuzde / 100;

					$("#indirimtutari" + numb + "").val(indirimtutari);

					for (i = 1; i <= items; i++) {
						var tutar = $("#indirimtutari" + i + "").val();
						var hesap = $.trim(tutar).length;
						if (hesap != 0)
							indirimtop = indirimtop + parseFloat($("#indirimtutari" + i + "").val());
					}

					$("#indirimtop").html(formatter.format(indirimtop) + " " + paraBirimiMetin);

					$("#indirimtopHidden").val(indirimtop);*/
			let id = event.target.id;
			var numb = id.match(/\d/g);
			numb = numb.join("");

			var indirimyuzde = $("#indirimyuzde" + numb + "").val();
			if (indirimyuzde == "100") {

				$("#vergiMuafiyet").css("display", "block");
				document.getElementById("vergiMuafiyet_sebep").required = true;
				vergimuafiyet();
			} else {

				$("#vergiMuafiyet").css("display", "none");
				document.getElementById("vergiMuafiyet_sebep").required = false;
				vergimuafiyet();

			}
			hesapla();


		});

		$(document).on('change', 'input[name^="toplam"]', function () {
			hesapla();
		});

		$(document).on('change', 'input[name^="indirimtutar"]', function () {

			let id = event.target.id;
			var numb = id.match(/\d/g);
			numb = numb.join("");

			var indirimtutar = $("#indirimtutar" + numb + "").val();
			if (indirimtutar == "100") {

				$("#vergiMuafiyet").css("display", "block");
				document.getElementById("vergiMuafiyet_sebep").required = true;
			} else {

				$("#vergiMuafiyet").css("display", "none");
				document.getElementById("vergiMuafiyet_sebep").required = false;

			}
			hesapla();


		});
	</script>

	<script>


		$("#submitBtn").click(function (e) {
			let allAreFilled = true;
			document.getElementById("myForm").querySelectorAll("[required]").forEach(function (i) {
				if (!allAreFilled) return;
				if (!i.value) allAreFilled = false;
				if (i.type === "radio") {
					let radioValueCheck = false;
					document.getElementById("myForm").querySelectorAll(`[name=${i.name}]`).forEach(function (r) {
						if (r.checked) radioValueCheck = true;
					})
					allAreFilled = radioValueCheck;
				}
			})
			if (!allAreFilled) {
				toastr.error("Bütün gerekli alanları doldurup tekrar deneyiniz.");
			} else {
				$("#myForm").submit();
			}
		});

		//döviz kuru işlemleri buradan
		$("#paraBirimi").on('change', function () {
			var paraBirimiText = $("#paraBirimi option:selected").text();
			var paraBirimi = $("#paraBirimi option:selected").val();

			if (paraBirimi == 1) {
				$("#guncelKur").css("display", "none");
				$("#aguncelKur").val("");
				$("#birimFiyatParaBirimi").html("(TL)");
				paraBirimiMetin = "TL";
			} else {
				if (paraBirimi == 2) {
					$("#birimFiyatParaBirimi").html("(USD)");
					paraBirimiMetin = "USD";
				} else if (paraBirimi == 3) {
					$("#birimFiyatParaBirimi").html("(EUR)");
					paraBirimiMetin = "EUR";
				} else if (paraBirimi == 4) {
					$("#birimFiyatParaBirimi").html("(GBP)");
					paraBirimiMetin = "GBP";
				}

				$("#guncelKur").css("display", "block");
				$.ajax({
					url: "<?= env('BASE_URL'); ?>/fatura/paraBirimiKontrol",
					method: "POST",
					data: {paraBirimi: paraBirimi},
					success: function (result) {
						toastr.success("Para birimi " + paraBirimiText + " olarak değiştirilmiştir. Güncel kur bilgileri ekrana yansıtılmıştır.");
						$("#guncelKur").val(result);
					}
				});
			}
			hesapla();
		});

		$("#ekle_kaydet").click(function (e) {

			e.preventDefault();
			$('#add_category').modal('toggle');

			let idsi = $("#add_idsi").val();
			let secim = $("#add_secim").val();
			var indirimyuzde = 0, indirimtutar = 0, tevkifat = 0, istisna = 0;
			if ($("#indirimyuzde" + idsi).length != 0) {
				indirimyuzde = 1;
			}
			if ($("#indirimtutar" + idsi).length != 0) {
				indirimtutar = 1;
			}
			if ($("#tevkifat" + idsi).length != 0) {
				tevkifat = 1;
			}
			if ($("#gtip" + idsi).length != 0) {
				istisna = 1;
			}


			let html = '';

			let array = secim.toString().split(",");

			$.each(array, function (i) {

				if (array[i] == 1) {
					$("#indirimytd" + idsi).show();

				} else if (array[i] == 3) {
					$("#tevkifatselecttd" + idsi).show();
					$("#tevkifattexttd" + idsi).show();
				} else if (array[i] == 4) {
					$("#gtiptd" + idsi).show();
				}
			});

			$('#my_table > #tbody > tr').eq(idsi - 1).after(html);

			$("#add_secim").val([]).change();
		});

		$("#faturaTip").on('change', function () {

			var val = $(this).val();
			$("#add_secim option[value='3']").remove();
			$("#add_secim option[value='4']").remove();
			$('#iade_fatura_bilgi').attr('style', 'display:none;');


			var rowIade = document.getElementById("tbody_iade");
			rowIade.innerHTML = "";

			$("#iade_count").val(0);
			counter_iade = [];

			if (val != "ISTISNA")
				vergimuafiyet();
			else {
				$("#vergiMuafiyet").css("display", "none");
				document.getElementById("vergiMuafiyet_sebep").required = false;
			}

			$('.ek_satir').remove();


			if (val == "SATIS") {//satış

			} else if (val == "IADE") {//iade
				$('#iade_fatura_bilgi').attr('style', 'display:block;');

				addItemIade();
			} else if (val == "TEVKIFAT") {//tevkifat

				var x = document.getElementById("add_secim");
				var option = document.createElement("option");
				option.text = "Tevkifat";
				option.value = "3";
				x.add(option);

			} else if (val == "ISTISNA") {//istisna
				var x = document.getElementById("add_secim");
				var option = document.createElement("option");
				option.text = "Gtip";
				option.value = "4";
				x.add(option);
			}

		});

	</script>

	<script>
		//var tables = document.getElementsByClassName('flexiCol');
		var tables = document.getElementsByTagName('table');
		for (var i = 0; i < tables.length; i++) {
			resizableGrid(tables[i]);
		}

		function resizableGrid(table) {
			var row = table.getElementsByTagName('tr')[0],
				cols = row ? row.children : undefined;
			if (!cols) return;

			table.style.overflow = 'hidden';

			var tableHeight = table.offsetHeight;

			for (var i = 0; i < cols.length; i++) {
				var div = createDiv(tableHeight);
				cols[i].appendChild(div);
				cols[i].style.position = 'relative';
				setListeners(div);
			}

			function setListeners(div) {
				var pageX, curCol, nxtCol, curColWidth, nxtColWidth;

				div.addEventListener('mousedown', function (e) {
					curCol = e.target.parentElement;
					nxtCol = curCol.nextElementSibling;
					pageX = e.pageX;

					var padding = paddingDiff(curCol);

					curColWidth = curCol.offsetWidth - padding;
					if (nxtCol)
						nxtColWidth = nxtCol.offsetWidth - padding;
				});

				div.addEventListener('mouseover', function (e) {
					e.target.style.borderRight = '2px solid #d92637';
				})

				div.addEventListener('mouseout', function (e) {
					e.target.style.borderRight = '';
				})

				document.addEventListener('mousemove', function (e) {
					if (curCol) {
						var diffX = e.pageX - pageX;

						if (nxtCol)
							nxtCol.style.width = (nxtColWidth - (diffX)) + 'px';

						curCol.style.width = (curColWidth + diffX) + 'px';
					}
				});

				document.addEventListener('mouseup', function (e) {
					curCol = undefined;
					nxtCol = undefined;
					pageX = undefined;
					nxtColWidth = undefined;
					curColWidth = undefined
				});
			}

			function createDiv(height) {
				var div = document.createElement('div');
				div.style.top = 0;
				div.style.right = 0;
				div.style.width = '5px';
				div.style.position = 'absolute';
				div.style.cursor = 'col-resize';
				div.style.userSelect = 'none';
				div.style.height = height + 'px';
				return div;
			}

			function paddingDiff(col) {

				if (getStyleVal(col, 'box-sizing') == 'border-box') {
					return 0;
				}

				var padLeft = getStyleVal(col, 'padding-left');
				var padRight = getStyleVal(col, 'padding-right');
				return (parseInt(padLeft) + parseInt(padRight));

			}

			function getStyleVal(elm, css) {
				return (window.getComputedStyle(elm, null).getPropertyValue(css))
			}
		};
	</script>

	<script type="text/javascript">
		$(document).ready(function () {
			$("form").submit(function () {

				$(this).submit(function () {
					return false;
				});
				return true;
			});
		});
	</script>

	<script>

		function addItemIade() {
			items_iade++;
			counter_iade.push(items_iade);
			var html_iade = "<tr>";
			html_iade += "<td>Numarası </td>";
			html_iade += "<td><input type='text' class='form-control' name='iadenumara[]' id='iadenumara" + items_iade + "'></td>";
			html_iade += "<td>Tarihi </td>";
			html_iade += "<td><input type='date' class='form-control' name='iadetarih[]' id='iadetarih" + items_iade + "' ></td>";
			html_iade += "<td><button type='button' class='btn btn-info btn-sm' onclick='addItemIade()'><i class='fa fa-plus'></i> Ekle</button> <button type='button' onclick='deleteRowIade(this);' class='btn btn-danger btn-sm' id='" + items_iade + "'><i class='fa fa-trash'></i> Sil</button> </td>";
			html_iade += "</tr>";

			var rowIade = document.getElementById("tbody_iade").insertRow();
			rowIade.innerHTML = html_iade;
			$("#iade_count").val(items_iade);

			// iade tarihi ileri tarih olmasın
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth() + 1; //January is 0!
			var yyyy = today.getFullYear();

			if (dd < 10) {
				dd = '0' + dd;
			}

			if (mm < 10) {
				mm = '0' + mm;
			}

			today = yyyy + '-' + mm + '-' + dd;
			document.getElementById("iadetarih" + items_iade).setAttribute("max", today);
		}

		function deleteRowIade(button) {
			if (counter_iade.length >= 1) {
				counter_iade.pop();
			}
			if (counter_iade.length == 0) {
				counter_iade.push(1);
				toastr.warning("En az bir kayıt olması zorunludur, bu kayıt silinemez.");
			} else {
				var btnID = button.id;

				button.parentElement.parentElement.remove();
				var btnID = button.id;

				button.parentElement.parentElement.remove();
				$('#iadenumara' + btnID + '').remove();
				$('#iadetarih' + btnID + '').remove();
				items_iade--;

			}
			$("#iade_count").val(items_iade);
		}

		function deleteRowIndirim(button) {
			if (counter_indirim.length >= 1) {
				counter_indirim.pop();
			}
			if (counter_indirim.length == 0) {

				$('#genel_iskonto').attr('style', 'display:none;');
			}

			var btnID = button.id;

			button.parentElement.parentElement.remove();
			items_indirim--;
			$("#indirim_count").val(items_indirim);
			hesapla();

		}

		function deleteRowBanka(button) {
			if (counter_banka >= 1) {
				counter_banka.pop();
			}
			if (counter_banka == "0") {
				counter_banka.push(1);
				toastr.warning("En az bir kayıt olması zorunludur, bu kayıt silinemez.");
			} else {
				var btnID = button.id;

				button.parentElement.parentElement.remove();
				var btnID = button.id;

				button.parentElement.parentElement.remove();
				$('#ayarlar_bankaadi' + btnID + '').remove();
				$('#ayarlar_sube' + btnID + '').remove();
				$('#ayarlar_parabirimi' + btnID + '').remove();
				$('#ayarlar_hesapno' + btnID + '').remove();
				$('#ayarlar_iban' + btnID + '').remove();
				items_banka--;

			}
			$("#bankaCount").val(items_banka);
		}
	</script>

	<script>
		$(document).ready(function () {
			$('.ajaxIller').on('change', function (e) {
				var base_url = "<?php echo base_url();?>";
				var il_id = $(this).val();
				$.post(base_url + 'home/get_ilceler', {il_id: il_id}, function (result) {
					if (result && result.status != 'error') {
						var ilceler = result.data;
						var select = '<div class="ilceler"><div class="form-group"><label>İlçe</label><select id="ilce" name="cari_ilce" class="form-control select" required>';
						for (var i = 0; i < ilceler.length; i++) {
							select += '<option value="' + ilceler[i].id + '">' + ilceler[i].ilce + '</option>';
						}
						select += '</select></div></div>';
						$('div.ilceler').empty().html(select);
					} else {
						alert('Hata : ' + result.message);
					}
				});
			});
		});
	</script>


	<script>
		$(document).ready(function () {

			var navListItems = $('div.setup-panel div a'),
				allWells = $('.setup-content'),
				allNextBtn = $('.nextBtn');

			allWells.hide();

			navListItems.click(function (e) {
				e.preventDefault();
				var $target = $($(this).attr('href')),
					$item = $(this);

				if (!$item.hasClass('disabled')) {
					navListItems.removeClass('btn-primary').addClass('btn-default');
					$item.addClass('btn-primary');
					allWells.hide();
					$target.show();
					$target.find('input:eq(0)').focus();
				}
			});

			allNextBtn.click(function () {
				var curStep = $(this).closest(".setup-content"),
					curStepBtn = curStep.attr("id"),
					nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
					curInputs = curStep.find("input[type='text'],input[type='url']"),
					isValid = true;

				$(".form-group").removeClass("has-error");
				for (var i = 0; i < curInputs.length; i++) {
					if (!curInputs[i].validity.valid) {
						isValid = false;
						$(curInputs[i]).closest(".form-group").addClass("has-error");
					}
				}

				if (isValid)
					nextStepWizard.removeAttr('disabled').trigger('click');
			});

			$('div.setup-panel div a.btn-primary').trigger('click');
		});

		<?php if($modulGibProSorgula) { ?>
		$(function () {
			$("#tcknvkn").autocomplete({
				source: "<?= env('BASE_URL') ?>/fatura/autocompleteDataByCariGib",
				minLength: 2,
				select: function (event, ui) {
					console.log("aa");
					event.preventDefault();
					console.log(ui.item.cari);
					$("#cari_id").val(ui.item.id);
					$("#tcknvkn").val(ui.item.value);
					if (ui.item.value.length == 11) {
						$("#ad").val(ui.item.cari_ad);
						$("#soyad").val(ui.item.cari_soyad);
						$(".ad").attr("style", "display:block");
						$(".soyad").attr("style", "display:block");
						$(".unvan").attr("style", "display:none");
						$("#unvan").val("");
					} else if (ui.item.value.length == 10) {
						$("#ad").val("");
						$("#soyad").val("");
						$("#unvan").val(ui.item.cari_ad);
						$(".ad").attr("style", "display:none");
						$(".soyad").attr("style", "display:none");
						$(".unvan").attr("style", "display:block");
					}
					toastr.success(ui.item.value + " cari adlı müşteriye ait bilgiler getirildi.");
				}
			});
		});
		<?php }  //else { ?>
		function tcknvknKontrol() {
			var cari_id=$("#cari_id").val();
			if(cari_id=="") {
				var val = $("#tcknvkn").val();
				if (val.length == 10 || val.length == 11) {
					$.ajax({
						url: "<?= env('BASE_URL'); ?>/Gib/gibVknTcknSorgula",
						method: "POST",
						data: {vergiNumarasi: val},
						dataType: 'json',
						beforeSend: function () {
							$("#loading-image").show();
							$(':input[type="submit"]').prop('disabled', true);
						},
						success: function (result) {
							;
							if (val.length == 11) {
								let ad = result.ad;
								let soyad = result.soyad;
								$("#ad").val(ad);
								$("#soyad").val(soyad);
							} else {
								$("#unvan").val(result.unvan);
							}

							$(':input[type="submit"]').prop('disabled', false);
							$("#loading-image").hide();
						}
					});

					if (val.length == 10) {
						$(".unvan").attr("style", "display:block");
						$(".ad").attr("style", "display:none");
						$(".soyad").attr("style", "display:none");
						document.getElementById("unvan").required = true;
						document.getElementById("vergiDairesi").required = true;
						document.getElementById("ad").required = false;
						document.getElementById("soyad").required = false;
					} else if (val.length == 11) {
						$(".ad").attr("style", "display:block");
						$(".soyad").attr("style", "display:block");
						$(".unvan").attr("style", "display:none");
						document.getElementById("unvan").required = false;
						document.getElementById("vergiDairesi").required = false;
						document.getElementById("ad").required = true;
						document.getElementById("soyad").required = true;
					}
				}
			}
		}
		<?php // } ?>


	</script>


</body>
</html>


