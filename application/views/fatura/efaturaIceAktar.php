<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
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

		.form-group {
			margin-bottom: 10px !important;
		}

		.card {
		. margin-bottom: 0 px !important;
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
<?php

$firmaID = getirFirma();
$firma_ID = $firmaID->ayarlar_id;

$modulSorgula = modulSorgula($firma_ID, 1);
?>
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
						<h3 class="page-title">Fatura</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
							<li class="breadcrumb-item">Fatura</li>
							<li class="breadcrumb-item active">Faturayı İçe Aktar</li>
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

			<?php
			$anaHesap = anaHesapBilgisi();
			$ayarlarQ = "SELECT * FROM ayarlar WHERE ayarlar_id = '$anaHesap' ";
			$ayarlarExe = $this->db->query($ayarlarQ)->row();
			if($faturaParaBirimi =="TRY")
				$faturaParaBirimi="TL";
			?>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<form action="<?= base_url("fatura/efaturaIceAktarKaydet"); ?>" method="POST"
								  id="myForm">

								<input type="hidden" name="cari_id" id="cari_id" value="<?= $cari->cari_id ?>">
								<input type="hidden" class="form-control" name="cari_kodu" id="kod_input"
									   required="" value="<?= $cari->cari_kodu ?>">
								<input type="hidden" name="cari_vergiDairesi" value="<?= $cari->cari_vergiDairesi ?>">
								<input type="hidden" name="cari_firmaEPosta" value="<?= $cari->cari_firmaEPosta ?>">
								<input type="hidden" name="cari_firmaTelefon" value="<?= $cari->cari_firmaTelefon ?>">
								<input type="hidden" name="cari_ad" value="<?= $cari->cari_ad ?>">

								<div class="row">
									<div class="col-md-12">
										<div class="form-group row">
											<label class="col-sm-3 text-sm-left pt-2">Cari TCKN/VKN Veya cari
												Adı</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="cari_tcknvkn"
													   id="tcknvkn_input" required=""
													   placeholder="Cari tckn/vkn veya cari adı yazmaya başlayıp, listeden seçiniz."
													   value="<?= $cari_value ?>">
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group row">
											<label class="col-sm-3 text-sm-left pt-2">Adres</label>
											<div class="col-sm-9">
												<!-- <input type="text" class="form-control" name="" id="cari_adres_input" readonly> -->
												<textarea class="form-control" name="cari_adres" id="cari_adres"
														  readonly=""
														  style="resize: none;"><?= $cari->cari_adres ?></textarea>
											</div>
										</div>
									</div>

								</div>

								<div class="row col-md-12  border-top pt-4" id="faturaBilgisiDiv">
									<div class="col-md-5">

										<div class="col-md-12">
											<div class="form-group row">
												<label class="col-sm-3 text-sm-left pt-2">Fatura No</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" name="faturaNumara"
														   id="faturaNumara"
														   value="<?= $faturano ?>" readonly>
												</div>

											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group row">
												<label class="col-sm-3 text-sm-left pt-2">Senaryo</label>
												<div class="col-sm-9" id="faturaTip_div">
													<select class="form-control" name="faturaSenaryo"
															id=faturaSenaryo" required="" disabled>
														<option value="1" <?php if ($faturaSenaryo == "TEMELFATURA") echo "selected"; ?>>
															TEMEL FATURA
														</option>
														<option value="2" <?php if ($faturaSenaryo == "TICARIFATURA") echo "selected"; ?>>
															TİCARİ FATURA
														</option>
													</select>
												</div>

											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group row">
												<label class="col-sm-3 text-sm-left pt-2">Tip</label>
												<div class="col-sm-9" id="faturaTip_div">
													<select class="form-control" name="faturaTip"
															id=faturaTip" required="" disabled>
														<option value="1" <?php if ($faturaTip == "SATIS") echo "selected"; ?>>
															SATIŞ
														</option>
														<option value="2" <?php if ($faturaTip == "IADE") echo "selected"; ?>>
															İADE
														</option>
														<option value="3" <?php if ($faturaTip == "TEVKIFAT") echo "selected"; ?>>
															TEVKİFAT
														</option>
														<option value="4" <?php if ($faturaTip == "ISTISNA") echo "selected"; ?>>
															İSTİSNA
														</option>
														<option value="5" <?php if ($faturaTip == "IADE") echo "selected"; ?>>
															İADE-İSTİSNA
														</option>
													</select>
												</div>

											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group row">
												<label class="col-sm-3 text-sm-left pt-2">Para Birimi</label>
												<div class="col-sm-5">
													<select class="form control select" name="paraBirimi"
															id="paraBirimi" disabled>
														<option value="1" <?php if ($faturaParaBirimi == "TRY") {
															echo "selected";
															$paraBirimi = "TL";
														} ?>>
															Türk Lirası
														</option>
														<option value="2" <?php if ($faturaParaBirimi == "USD") {
															echo "selected";
															$paraBirimi = "USD";
														} ?>>
															Amerikan Doları
														</option>
														<option value="3" <?php if ($faturaParaBirimi == "EUR") {
															echo "selected";
															$paraBirimi = "EUR";
														} ?>>
															Euro
														</option>
														<option value="4" <?php if ($faturaParaBirimi == "GBP") {
															echo "selected";
															$paraBirimi = "GBP";
														} ?>>
															İngiliz Sterlini
														</option>
													</select>
												</div>
												<div class="col-sm-4">
													<input type="text" name="guncelKur" id="guncelKur"
														   class="form-control" placeholder="Döviz kuru"
															<?php if ($doviz == null) echo 'style="display:none;"'; ?>
														   value="<?= $doviz ?>" disabled/>
												</div>
											</div>
										</div>

									</div>

									<div class="col-md-5">

										<div class="col-md-12">
											<div class="form-group row">
												<label class="col-sm-3 text-sm-left pt-2">Düzenleme Tarihi</label>
												<div class="col-sm-9">
													<input type="text" class="datepicker form-control"
														   name="faturaTarihi" autocomplete="off" required=""
														   value="<?php if ($faturaDetay->satis_faturaTarihi == null)
															   echo getirBugun(); else echo $faturaDetay->satis_faturaTarihi ?>"
														   disabled/>
												</div>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group row">
												<label class="col-sm-3 text-sm-left pt-2">Düzenleme Saati</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" name="faturaSaati"
														   autocomplete="off" required=""
														   value="<?= $faturaSaat; ?>"
														   id="datetimepicker" disabled/>
												</div>
											</div>
										</div>

									</div>

								</div>


								<div class="row"
									 id="iade_fatura_bilgi" <?php if (empty($iadeFaturalari)) echo 'style="display: none;"'; ?>>
									<div class="col-md-12">
										<h4 class="card-title mt-4">İade Fatura Bilgisi </h4>
										<div class="row">
											<div class="table-responsive">
												<input type="hidden" name="iade_count" id="iade_count">
												<table class="table table-bordered custom-table mb-0" id="my_table">
													<tbody id="tbody_iade">
													<?php
													$itemsIade = 0;
													foreach ($iadeFaturalari as $itemIade) {
														$itemsIade++; ?>
														<tr>
															<td>Numarası</td>
															<td>
																<input type='text' class='form-control'
																	   name='iadenumara[]'
																	   id='iadenumara<?= $itemsIade ?>'
																	   value="<?= $itemIade["faturano"] ?>" disabled>
															</td>
															<td>Tarihi</td>
															<td>
																<input type='date' class='form-control'
																	   name='iadetarih[]'
																	   id='iadetarih<?= $itemsIade ?>'
																	   value="<?= $itemIade["faturatarih"] ?>" disabled>
															</td>

														</tr>
														<script>
															debugger;
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


								<div class="row"
									 id="stokBilgisiDiv">
									<div class="col-md-12">
										<h4 class="card-title mt-4">Stok Bilgisi <i
													class="fa fa-info-circle fa-xs text-info" data-toggle="tooltip"
													data-placement="right"
													title="Tablonun istediğiniz kenarından tutup büyütme ve küçültme işlemi yapabilirsiniz."></i>
										</h4>

										<div class="row">
											<div class="table-responsive">
												<table class="table table-bordered custom-table mb-0" id="my_table">
													<thead>
													<tr>
														<th></th>
														<th>Stok Adı</th>
														<th>Stok Kodu</th>
														<th>Barkod</th>
														<th>Miktar</th>
														<th>Birim</th>
														<th>Birim Fiyat <span id="birimFiyatParaBirimi">(TL)</span>
														</th>
														<th>KDV (%)</th>
														<th>Toplam</th>
														<th></th>
													</tr>
													</thead>
													<tbody id="tbody">
													<?php $items = 1; ?>

													<?php foreach ($stok as $item) { ?>
														<tr>
															<td>

																<a href='#' class='btn btn-success btn-sm'
																   data-toggle='modal' data-target='#edit_category'
																   data-id='<?= $items ?>'>
																	<i class='fa fa-hand-pointer'></i> Seç
																</a>
															</td>
															<td>
																<input type='text' class='form-control'
																	   name='stokadi[]'
																	   id='stokadi<?= $items ?>'
																	   value="<?= $item["ad"] ?>" readonly>
															</td>
															<td>
																<input type='text' class='form-control'
																	   name='stokkodu[]' id='stokkodu<?= $items ?>'
																	   readonl value="<?= $item["kod"] ?>" readonly>
															</td>
															<td>
																<input type='hidden' name='stokid[]'
																	   id='stokid<?= $items ?>'
																	   value="<?= $item["id"] ?>">
																<input type='text' class='form-control'
																	   name='barkod[]' id='barkod<?= $items ?>'
																	   value="<?= $item["barkod"] ?>" readonly>
															</td>
															<td>
																<input type='number' step='0.1' class='form-control'
																	   name='miktar[]' readonly
																	   id='miktar<?= $items ?>' required=''
																	   style='width:175px;'
																	   value="<?= $item["miktar"] ?>">
															</td>
															<td>
																<select name="stok_birimID[]" class="form-control"
																		required="" id="stokBirim" readonly>
																	<?= $stokBirim ?>
																</select>
															</td>
															<td>
																<input type='number' step='0.1' class='form-control'
																	   name='birimfiyat[]'
																	   id='birimfiyat<?= $items ?>' required=''
																	   value="<?= $item["birimFiyat"] ?>" readonly>
															</td>
															<td>
																<select class='form-control' name='kdv[]'
																		id='kdv<?= $items ?>' readonly="">
																	<option value="<?= $item["stokKdvOran"] ?>">
																		<?= $item["stokKdvOran"] ?>
																	</option>

																</select>
															</td>
															<td>
																<input type='hidden' name='indirimtutari[]'
																	   id='indirimtutari<?= $items ?>'>
																<input type='text' class='form-control'
																	   name='toplam[]'
																	   id='toplam<?= $items ?>' readonly
																	   value="<?= $item["toplamFiyat"] ?>">
																<input type='hidden' name='toplamHidden[]'
																	   id='toplamHidden<?= $items ?>'
																	   value="<?= $item["toplamFiyat"] ?>">
															</td>
														</tr>
														<td id='indirimytd<?= $items ?>' <?php if ($item["satirIndirim"] == 0) echo "style='display: none;'"; ?>>
															<label>İndirim (%)</label>
															<input type='number' step='0.1' class='form-control'
																   placeholder='İndirim (%)' name='indirimyuzde[]'
																   id='indirimyuzde<?= $items ?>'
																   value="<?= $item["satirIndirim"] ?>" readonly>
														</td>
														<td id='tevkifatselecttd<?= $items ?>' <?php if ($item["tevkifatAd"] == "") echo "style='display: none;'"; ?>>
															<label>Tevkifat</label>
															<select name='tevkifat[]' id='tevkifat<?= $items ?>'
																	class='form-control' readonly="">
																<option value='<?= $item["tevkifatKod"] ?>>'><?= $item["tevkifatAd"] ?>
																</option>
															</select>
														</td>
														<td id='tevkifattexttd<?= $items ?>' <?php if ($item["tevkifatAd"] == "") echo "style='display: none;'"; ?>>
															<label>Tevkifat Oranı(%)</label>
															<input type='text' class='form-control'
																   name='tevkifat_oran[]'
																   id='tevkifat_oran<?= $items ?>' readonly
																   placeholder='Tevkifat Oranı(%)'
																   value="<?= $item["tevkifatOran"] ?>">
														</td>


													<?php $items++; ?>
														<script>items++;</script>
													<?php } ?>
													</tbody>

												</table>
											</div>
										</div>


										<div class="row"
											 id="vergiMuafiyet" <?php if (empty($vergiMuafiyet)) echo 'style="display: none;"'; ?>>
											<div class="col-md-12">
												<h4 class="card-title mt-4">VERGİ MUAFİYET </h4>
												<table class="table custom-table mb-0">
													<tr>
														<td style="width:5%;"><label>Vergi Muafiyet Sebebi</label>
														</td>
														<td>
															<input type="text" name="vergiMuafiyet_sebep"
																   id="vergiMuafiyet_sebep" class="form-control"
																   value="<?= $vergiMuafiyet ?>" readonly>
														</td>
													</tr>
												</table>
											</div>
										</div>

										<div class="row"
											 id="istisna_table" <?php if (empty($istisna)) echo 'style="display: none;"'; ?>>
											<div class="col-md-12">
												<h4 class="card-title mt-4">VERGİ MUAFİYET </h4>
												<p style="font-style:italic;color:red;">
													! İhracat faturasında 301 nolu kodu kullanız . .<br>
													! İhracat kayıtlı faturalarda 701 , 702 veya 703 nolu kodlar
													kullanız . .
												</p>
												<table class="table custom-table mb-0">
													<tr>
														<td style="width:5%;"><label>İstisna Sebebi</label></td>
														<td>
															<select class="form-control" name='istisna_sebebi'
																	id='istisna_sebebi' disabled>
																<?= $istisna ?>
															</select>
														</td>
													</tr>
												</table>
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
															id="aratop"><?= $araToplam ?> <?= $faturaParaBirimi ?></td>
													</tr>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-right">Toplam İskonto(İndirim)</td>
														<td class="text-right"
															id="indirimtop"><?= $indirim ?> <?= $faturaParaBirimi ?></td>
													</tr>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-right">Net Tutar(Matrah)</td>
														<td class="text-right"
															id="nettutartop"><?= $netTutar ?> <?= $faturaParaBirimi ?></td>
													</tr>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-right">Hesaplanan KDV</td>
														<td class="text-right"
															id="kdvtop"><?= $toplamKdv ?> <?= $faturaParaBirimi ?></td>
													</tr>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-right">Hesaplanan KDV Tevkifat</td>
														<td class="text-right"
															id="kdvtevkifat"><?= $toplamTevkifatKdv ?> <?= $faturaParaBirimi ?></td>
													</tr>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-right">Vergiler Dahil Ödenecek Tutar</td>
														<td class="text-right"
															id="vergidahil"><?= $vergiDahil ?> <?= $faturaParaBirimi ?></td>
													</tr>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-right">Genel Toplam</td>
														<td class="text-right"
															id="geneltop"><?= $genelToplam ?> <?= $faturaParaBirimi ?></td>
													</tr>
													</tbody>
												</table>


											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">


										<div class="col-md-12 p-0">
											<div class="row">
												<div class="col-md-12">
													<button type="submit" class="btn btn-danger" style="width:100%;"
															id="submitBtn">
														İçe Aktar
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>


								<input type="hidden" id="aratopHidden" name="aratopHidden"
									   value="<?= $araToplam ?>">
								<input type="hidden" id="kdvtopHidden" name="kdvtopHidden"
									   value="<?= $toplamKdv ?>">
								<input type="hidden" id="geneltopHidden" name="geneltopHidden"
									   value="<?= $genelToplam ?>">
								<input type="hidden" id="vergidahilHidden" name="vergidahilHidden"
									   value="<?= $vergiDahil ?>">
								<input type="hidden" id="indirimtopHidden" name="indirimtopHidden"
									   value="<?= $indirim ?>">
								<input type="hidden" id="tevkifattopHidden" name="tevkifattopHidden"
									   value="<?= $toplamTevkifatKdv ?>">
								<input type="hidden" id="netTutarInput" name="netTutarInput"
									   value="<?= $netTutar ?>">
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

<div id="edit_category" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Stok Ekle</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" method="POST">
					<input class="form-control" type="hidden" id="idsi" name="id">
					<input class="form-control" type="hidden" id="stokID" name="stokID">
					<div class="form-group">
						<label>Stok Adına Göre <span class="text-danger">*</span></label>
						<input class="form-control" type="text" id="stokAdi" name="stokAdi" required="">
					</div>

					<div class="form-group">
						<label>Stok Koduna Göre <span class="text-danger">*</span></label>
						<input class="form-control" type="text" id="stokKodu" name="stokKodu" required="">
					</div>

					<div class="submit-section">
						<!-- <button class="btn btn-danger submit-btn">Seç</button> -->
						<button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<?php if ($this->session->flashdata('fatura_mukerrer')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Aynı fatura veya irsaliye numarasına ait kayıt mevcuttur, tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_hatali')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Cari kodu veya cari adı kayıtlı değil, lütfen listeden seçerek devam ediniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php $this->load->view("include/footer-js"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
		integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
<script>
	$(function () {
		$('.datepicker').datepicker({
			dateFormat: 'dd.mm.yy',
			language: 'tr'
		});
	});

	$(function () {
		$('#datetimepicker').datetimepicker({
			format: 'HH:mm'
		});
	});
</script>


<script>
	$('#edit_category').on('show.bs.modal', function (event) {
		let idsi = $(event.relatedTarget).data('id')
		$(this).find('.modal-body #idsi').val(idsi)
	})

	$('#add_category').on('show.bs.modal', function (event) {
		let a_idsi = $(event.relatedTarget).data('idsi')
		$(this).find('.modal-body #add_idsi').val(a_idsi)
	})


/*
	document.getElementById("aratop").innerHTML += " " + paraBirimiMetin;
	document.getElementById("indirimtop").innerHTML += " " + paraBirimiMetin;
	document.getElementById("nettutartop").innerHTML += " " + paraBirimiMetin;
	document.getElementById("kdvtop").innerHTML += " " + paraBirimiMetin;
	document.getElementById("kdvtevkifat").innerHTML += " " + paraBirimiMetin;
	document.getElementById("vergidahil").innerHTML += " " + paraBirimiMetin;
	document.getElementById("geneltop").innerHTML += " " + paraBirimiMetin;
*/

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

	$(function () {
		$("#name_input").autocomplete({
			source: "<?= env('BASE_URL'); ?>/fatura/autocompleteDataByNameEArsiv",
			minLength: 2,
			select: function (event, ui) {
				event.preventDefault();
				$("#cari_id").val(ui.item.id);
				$("#tcknvkn_input").val(ui.item.value);
				$("#kod_input").val(ui.item.cari_kodu);
				$("#cari_grubu_input").val(ui.item.cari_grubu);
				$("#cari_vergiDairesi_input").val(ui.item.cari_vergiDairesi);
				$("#cari_adres_input").val(ui.item.cari_adres);
				$("#eposta_bilgi_input").val(ui.item.cari_firmaEPosta);

				toastr.success(ui.item.value + " cari adlı müşteriye ait bilgiler getirildi.");
				//$("#faturaBilgisiDiv").css("display", "block");
				$("#faturaAltBilgisiDiv").css("display", "block");
				$("#stokBilgisiDiv").css("display", "block");
				$("#checkboxDiv").css("display", "block");
				$("#submitBtn").css("display", "block");
				var element = document.getElementById("faturaBilgisiDiv");
				element.classList.remove("d-none");

			}
		});
	});

	$(function () {
		$("#tcknvkn_input").autocomplete({
			source: "<?= env('BASE_URL'); ?>/fatura/autocompleteDataByTcknVknEarsiv",
			minLength: 2,
			select: function (event, ui) {
				event.preventDefault();
				$("#cari_id").val(ui.item.id);
				$("#tcknvkn_input").val(ui.item.value);
				$("#kod_input").val(ui.item.cari_kodu);
				$("#cari_grubu_input").val(ui.item.cari_grubu);
				$("#cari_vergiDairesi_input").val(ui.item.cari_vergiDairesi);
				$("#cari_adres_input").val(ui.item.cari_adres);
				$("#eposta_bilgi_input").val(ui.item.cari_firmaEPosta);

				toastr.success(ui.item.value + " cari adlı müşteriye ait bilgiler getirildi.");
				//$("#faturaBilgisiDiv").css("display", "block");
				$("#faturaAltBilgisiDiv").css("display", "block");
				$("#stokBilgisiDiv").css("display", "block");
				$("#checkboxDiv").css("display", "block");
				$("#submitBtn").css("display", "block");
				var element = document.getElementById("faturaBilgisiDiv");
				element.classList.remove("d-none");
			}
		});
	});


	$(function () {
		$("#stokKodu").autocomplete({
			source: '<?= env('BASE_URL'); ?>/fatura/autocompleteDataByStockCode',
			minLength: 2,
			select: function (event, ui) {
				event.preventDefault();
				$('#edit_category').modal('hide');
				$("#stokID").val(ui.item.id);
				$("#stokid" + idsi.value + "").val(ui.item.id);
				$("#stokkodu" + idsi.value + "").val(ui.item.value);
				$("#stokadi" + idsi.value + "").val(ui.item.stok_ad);
				toastr.success(ui.item.value + " stok kodlu stok bilgileri getirildi.");
			}
		});
	});

	$(function () {
		$("#stokAdi").autocomplete({
			source: '<?= env('BASE_URL'); ?>/fatura/autocompleteDataByStockName',
			minLength: 2,
			select: function (event, ui) {
				event.preventDefault();
				$('#edit_category').modal('hide');
				$("#stokID").val(ui.item.id);
				$("#stokid" + idsi.value + "").val(ui.item.id);
				$("#stokadi" + idsi.value + "").val(ui.item.value);
				$("#stokkodu" + idsi.value + "").val(ui.item.stok_kodu);
				toastr.success(ui.item.value + " stok isimli stok bilgileri getirildi.");

			}
		});
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

</body>
</html>
