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
			overflow-x: hidden;
			padding-right: 20px;
		}

		.form-group {
			margin-bottom: 10px !important;
		}
		.card {
			margin-bottom: 0px !important;
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
							<li class="breadcrumb-item active">E-İrsaliye Oluştur</li>
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
			?>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<?php
							if ($faturaDetay) {//düzenle?>
							<form action="<?= base_url("fatura/satisFaturasiGuncelle"); ?>" method="POST" id="myForm">
								<?php } else{//ekle ?>
								<form action="<?= base_url("fatura/satisFaturasiOlustur"); ?>" method="POST" id="myForm">
									<?php } ?>
									<input type="hidden" name="satis_InvoiceType" value="3">
									<input type="hidden" name="satis_id" value="<?= $faturaDetay->satis_id ?>">
									<input type="hidden" name="satis_cariID" id="cari_id" value="<?= $cari->cari_id ?>">
									<input type="hidden" name="ch_id" id="ch_id" value="<?= $faturaDetay->satis_cariHareketiID; ?>">
									<input type="hidden" class="form-control" name="cari_kodu" id="kod_input"
										   required="" value="<?= $cari->cari_kodu ?>">
									<div class="row">
										<div class="col-md-7">
											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-sm-3 text-sm-left pt-2">Cari TCKN/VKN veya Cari
														Adı</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="cari_tcknvkn"
															   id="tcknvkn_input" required=""
															   placeholder="Cari tckn/vkn veya cari adı yazmaya başlayıp, listeden seçiniz."
															   value="<?= $cari_value ?>" onblur="cariKontrol();">
													</div>
													<div class="col-sm-1 p-0 mt-2" id="cariEkleBtn" style="display: none;">
														<a href="javascript(0);" class="col-8 border-0 p-2 text-center" style="background-color: forestgreen;color:#fff;font-size:14px;border-radius: 5px;" data-toggle='modal' data-target='#cariEkle'><i class="fa fa-user-plus"></i></a>
													</div>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-sm-3 text-sm-left pt-2">Adres</label>
													<div class="col-sm-8">
														<textarea class="form-control" name="" id="cari_adres_input"
																  readonly=""
																  style="resize: none;"><?= $cari->cari_adres ?></textarea>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-5">

											<div class="card">
												<div class="row no-gutters">
													<div class="d-flex col-sm-5 justify-content-center align-items-center">
														<?php if ($ayarlarExe->ayarlar_logoName) { ?>
															<img class="card-img" alt="logo"
																 src="<?= base_url(); ?>assets/bulut/logo/<?= $ayarlarExe->ayarlar_logoName; ?>">
														<?php } ?>
													</div>
													<div class="col-sm-7">
														<div class="card-body">
															<h5 class="card-title"
																style="cursor:pointer;"><?= $ayarlarExe->ayarlar_firmaAd; ?></h5>
															<p class="card-text"><?= $ayarlarExe->ayarlar_adres; ?></p>
															<p class="card-text"><?= $ayarlarExe->ayarlar_vergiDairesi; ?>
																V.D. <?= $ayarlarExe->ayarlar_vergiNo; ?></p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row col-md-12 border-top pt-4"
										 id="faturaBilgisiDiv" <?php if (!$faturaDetay) echo "style='display:none;'"; ?>>
										<div class="col-12">
											<div class="row">
												<div class="col-md-7">													<div class="col-md-12" style="display: none;">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2">Tip</label>
															<div class="col-sm-9">
																<select class="form-control select"
																		name="satis_eirsaliyeTip"
																		id="satis_eirsaliyeTip" required="">
																	<option value="1" <?php if ($faturaDetay->satis_eirsaliyeTip == 1) echo "selected"; ?>>SEVK</option>
																</select>
															</div>

														</div>
													</div>


													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2"><!--Düzenleme-->
																İrsaliye Tarihi</label>
															<div class="col-sm-9">
																<input type="text" class="datepicker form-control"
																	   name="satis_irsaliyeTarihi" autocomplete="off"
																	   required=""
																	   value="<?php if ($irsaliyeDetay->satis_irsaliyeTarihi == null)
																		   echo getirBugun(); else echo $irsaliyeDetay->irs_irsaliyeTarihi ?>"/>
															</div>
														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2"><!--Düzenleme-->
																İrsaliye Saati</label>
															<div class="col-sm-9">
																<input type="text" class="form-control"
																	   name="satis_irsaliyeSaati"
																	   autocomplete="off" required=""
																	   value="<?php if ($irsaliyeDetay->irs_irsaliyeSaati == null)
																		   echo getirSaat(); else echo $irsaliyeDetay->irs_irsaliyeSaati ?>"
																	   id="datetimepicker"/>
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-5">
													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2">Para
																Birimi</label>
															<div class="col-sm-5">
																<select class="form control select"
																		name="satis_paraBirimi"
																		id="satis_paraBirimi">
																	<option value="1" <?php if ($faturaDetay->satis_paraBirimi == 1) {
																		echo "selected";
																		$paraBirimi = "TL";
																	} ?>>
																		Türk Lirası
																	</option>
																	<option value="2" <?php if ($faturaDetay->satis_paraBirimi == 2) {
																		echo "selected";
																		$paraBirimi = "USD";
																	} ?>>
																		Amerikan Doları
																	</option>
																	<option value="3" <?php if ($faturaDetay->satis_paraBirimi == 3) {
																		echo "selected";
																		$paraBirimi = "EUR";
																	} ?>>
																		Euro
																	</option>
																	<option value="4" <?php if ($faturaDetay->satis_paraBirimi == 4) {
																		echo "selected";
																		$paraBirimi = "GBP";
																	} ?>>
																		İngiliz Sterlini
																	</option>
																</select>
															</div>
															<div class="col-sm-4">
																<input type="text" name="satis_guncelKur"
																	   id="satis_guncelKur"
																	   class="form-control" placeholder="Döviz kuru"
																		<?php if ($faturaDetay->satis_guncelKur == null) echo 'style="display:none;"'; ?>
																	   value="<?= $faturaDetay->satis_guncelKur ?>"/>
															</div>
														</div>
													</div>


													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2"><!--Düzenleme-->
																Sevk Tarihi</label>
															<div class="col-sm-9">
																<input type="text" class="datepicker form-control"
																	   name="satis_irsaliyeSevkTarihi" autocomplete="off"
																	   required=""
																	   value="<?php if ($irsaliyeDetay->irs_irsaliyeSevkTarihi == null)
																		   echo getirBugun(); else echo $irsaliyeDetay->irs_irsaliyeSevkTarihi ?>"/>
															</div>
														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2"><!--Düzenleme-->
																Sevk Saati</label>
															<div class="col-sm-9">
																<input type="text" class="form-control"
																	   name="satis_irsaliyeSevkSaati"
																	   autocomplete="off" required=""
																	   value="<?php if ($irsaliyeDetay->irs_irsaliyeSevkSaati == null)
																		   echo getirSaat(); else echo $irsaliyeDetay->irs_irsaliyeSevkSaati ?>"
																	   id="datetimepicker"/>
															</div>
														</div>
													</div>


												</div>
											</div>

											<div class="row mt-4 p-4 border-top">
												<div class="col-md-6">

													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2">Sipariş No</label>
															<div class="col-sm-9">
																<input type="text" class="form-control"
																	   name="satis_irsaliyeSiparisNo"
																	   autocomplete="off" required=""
																	   value="<?php if ($irsaliyeDetay->irs_irsaliyeSiparisNo) echo $irsaliyeDetay->irs_irsaliyeSiparisNo ?>"/>
															</div>

														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2">Şöför Ad Soyad</label>
															<div class="col-sm-9">
																<input type="text" class="form-control"
																	   name="satis_irsaliyeSoforAd"
																	   autocomplete="off" required=""
																	   value="<?php if ($irsaliyeDetay->irs_irsaliyeSoforAd) echo $irsaliyeDetay->irs_irsaliyeSoforAd ?>"/>
															</div>

														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2">Dorse Plaka</label>
															<div class="col-sm-9">
																<input type="text" class="form-control"
																	   name="satis_irsaliyeDorsePlaka"
																	   autocomplete="off" required=""
																	   value="<?php if ($irsaliyeDetay->irs_irsaliyeDorsePlaka) echo $irsaliyeDetay->irs_irsaliyeDorsePlaka ?>"/>
															</div>

														</div>
													</div>

												</div>

												<div class="col-md-6">

													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2">Sipariş Tarihi</label>
															<div class="col-sm-9">
																<input type="text" class="datepicker form-control"
																	   name="satis_irsaliyeSiparisTarihi" autocomplete="off"
																	   required=""
																	   value="<?php if ($irsaliyeDetay->irs_irsaliyeSiparisTarihi == null)
																		   echo getirBugun(); else echo $irsaliyeDetay->irs_irsaliyeSiparisTarihi ?>"/>
															</div>

														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2">Şöför TCKN</label>
															<div class="col-sm-9">
																<input type="text" class="form-control"
																	   name="satis_irsaliyeSoforTCKN"
																	   autocomplete="off" required=""
																	   value="<?php if ($irsaliyeDetay->irs_irsaliyeSoforTCKN) echo $irsaliyeDetay->irs_irsaliyeSoforTCKN ?>"/>
															</div>

														</div>
													</div>

												</div>

											</div>

											<div class="row mt-4 p-4 border-top">

												<div class="col-md-4">
													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2">Taşıyıcı Unvan</label>
															<div class="col-sm-9">
																<input type="text" class="form-control"
																	   name="satis_irsaliyeTasiyiciUnvan"
																	   autocomplete="off" required=""
																	   value="<?php if ($irsaliyeDetay->irs_irsaliyeTasiyiciUnvan) echo $irsaliyeDetay->irs_irsaliyeTasiyiciUnvan ?>"/>
															</div>

														</div>
													</div>
												</div>

												<div class="col-md-4">
													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-4 text-sm-left pt-2">Taşıyıcı VKN/TCKN</label>
															<div class="col-sm-8">
																<input type="text" class="form-control"
																	   name="satis_irsaliyeTasiyiciVKNTCKN"
																	   autocomplete="off" required=""
																	   value="<?php if ($irsaliyeDetay->irs_irsaliyeTasiyiciVKNTCKN) echo $irsaliyeDetay->irs_irsaliyeTasiyiciVKNTCKN ?>"/>
															</div>

														</div>
													</div>
												</div>

												<div class="col-md-4">
													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2">Plaka</label>
															<div class="col-sm-8">
																<input type="text" class="form-control"
																	   name="satis_irsaliyePlaka"
																	   autocomplete="off" required=""
																	   value="<?php if ($irsaliyeDetay->irs_irsaliyePlaka) echo $irsaliyeDetay->irs_irsaliyePlaka ?>"/>
															</div>

														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row mt-4 mb-4 p-4 border-top border-bottom"
										 id="checkboxDiv"<?php if (!$faturaDetay) echo "style='display:none;'"; ?>>
										<div class="row pl-4">
											<div class="col-md-6">

												<input class="form-check-input" type="checkbox" value="1"
													   id="sevkiyatCheck"
													   name="sevkiyatCheck" style="width:30px;height:20px;">
												<label class="form-check-label ml-3" for="sevkiyatCheck">
													Sevkiyat Bilgisi Ekle
												</label>

											</div>
											<div class="col-md-6">
												<input class="form-check-input" type="checkbox" value="1"
													   id="asilSaticiCheck"
													   name="asilSaticiCheck" style="width:30px;height:20px;">
												<label class="form-check-label ml-3" for="asilSaticiCheck">
													Asıl Satıcı Bilgisi Ekle
												</label>

											</div>
										</div>
									</div>

									<div class="row"
										 id="stokBilgisiDiv" <?php if (!$faturaDetay) echo "style='display:none;'"; ?>>
										<div class="col-md-12">
											<h4 class="card-title mt-4">Stok Bilgisi <i
														class="fa fa-info-circle fa-xs text-info" data-toggle="tooltip"
														data-placement="right"
														title="Tablonun istediğiniz kenarından tutup büyütme ve küçültme işlemi yapabilirsiniz."></i>

												<a href="javascript:void(0)" class="btn btn-success btn-sm"
												   onclick="addItem();" style="float:right;"><i class="fa fa-plus"></i>
													Yeni Satır Ekle</a>
											</h4>

											<div class="row">
												<div class="table-responsive">
													<table class="table table-bordered custom-table mb-0" id="my_table">
														<thead>
														<tr>
															<th>Stok Adı</th>
															<th>Stok Kodu</th>
															<th>Birim</th>
															<th>Miktar</th>
															<th>Birim Fiyat <span id="birimFiyatParaBirimi">(TL)</span>
															</th>
															<th>Toplam</th>
															<th></th>
														</tr>
														</thead>
														<tbody id="tbody">
														<?php
														$items = 0;
														foreach ($stok as $item) {
															$items++;
															?>
															<tr>

																<td>
																	<input type="hidden" name="satisFaturasiStok_id[]"
																		   value="<?= $item->satisStok_id; ?>">

																	<input type='hidden' name='stokid[]'
																		   id='stokid<?= $items ?>'
																		   value="<?= $item->satisStok_stokID ?>">
																	<input type='text' class='form-control'
																		   name='stokadi[]'
																		   id='stokadi<?= $items ?>' readonly
																		   value="<?= $item->stok_ad ?>">
																</td>
																<td>
																	<input type='text' class='form-control'
																		   name='stokkodu[]' id='stokkodu<?= $items ?>'
																		   readonly value="<?= $item->stok_kodu ?>">
																</td>
																<td>
																	<select class='form-control' name='birim[]'
																			id='birim<?= $items ?>'>
																		<option value='0'>Birim</option><?= $birimler ?>
																	</select>
																</td>
																<td>
																	<input type='number' step='0.1' class='form-control'
																		   name='miktar[]'
																		   id='miktar<?= $items ?>' required=''
																		   style='width:175px;'
																		   value="<?= $item->satisStok_miktar ?>">
																</td>

																<td>
																	<input type='number' step='0.1' class='form-control'
																		   name='birimfiyat[]'
																		   id='birimfiyat<?= $items ?>' required=''
																		   value="<?= $item->satisStok_birimFiyat ?>">
																</td>
																<td>
																	<input type='hidden' name='indirimtutari[]'
																		   id='indirimtutari<?= $items ?>'>
																	<input type='text' class='form-control'
																		   name='toplam[]'
																		   id='toplam<?= $items ?>' readonly
																		   value="<?= $item->satisStok_indirimlifiyat ?>">
																	<input type='hidden' name='toplamHidden[]'
																		   id='toplamHidden<?= $items ?>'
																		   value="<?= $item->satisStok_indirimlifiyat ?>">
																</td>
																<td>
																	<button type='button' class='btn btn-info btn-sm'
																			data-toggle='modal'
																			data-target='#add_category'
																			data-idsi='<?= $items ?>'
																			id='eklebuton<?= $items ?>'>
																		<i class='fa fa-plus'></i> Ekle
																	</button>
																	<button type='button' onclick='deleteRow(this);'
																			class='btn btn-danger btn-sm'
																			id='<?= $items ?>'>
																		<i class='fa fa-trash'></i> Sil
																	</button>
																</td>
															</tr>
															<script>items++;
																counter.push(items);
																document.getElementById("birim" + items).value = <?= $item->stok_birimID ?>;
																document.getElementById("birim" + items).style.pointerEvents = "none";
																document.getElementById("birim" + items).style.backgroundColor = "#e9ecef";

															</script>
															<? } ?>
														</tbody>
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
															<td class="text-right">Genel Toplam</td>
															<td class="text-right"
																id="geneltop"><?= $faturaDetay->satis_genelToplam . " " . $paraBirimi ?></td>
														</tr>
														</tbody>
													</table>

												</div>
											</div>

											<div id="bankabilgileri" style="display:none;">
												<h2>SEVKİYAT BİLGİLERİ</h2>
												<div class="row mt-4 p-4 border-top">
													<div class="col-md-3">
														<div class="col-md-12">
															<div class="form-group row">
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="sb_ulke" value="<?php if ($irsaliyeDetay->sb_ulke) echo $irsaliyeDetay->sb_ulke ?>" placeholder="Ülke" autocomplete="off">
																</div>
															</div>
														</div>
													</div>

													<div class="col-md-3">
														<div class="col-md-12">
															<div class="form-group row">
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="sb_sehir" value="<?php if ($irsaliyeDetay->sb_sehir) echo $irsaliyeDetay->sb_sehir ?>" placeholder="Şehir" autocomplete="off">
																</div>
															</div>
														</div>
													</div>

													<div class="col-md-3">
														<div class="col-md-12">
															<div class="form-group row">
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="sb_ilce" value="<?php if ($irsaliyeDetay->sb_ilce) echo $irsaliyeDetay->sb_ilce ?>" placeholder="İlçe" autocomplete="off">
																</div>
															</div>
														</div>
													</div>

													<div class="col-md-3">
														<div class="col-md-12">
															<div class="form-group row">
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="sb_pk" value="<?php if ($irsaliyeDetay->sb_pk) echo $irsaliyeDetay->sb_pk ?>" placeholder="Posta Kutusu" autocomplete="off">
																</div>
															</div>
														</div>
													</div>

													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group row">
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="sb_adres" value="<?php if ($irsaliyeDetay->sb_adres) echo $irsaliyeDetay->sb_adres ?>" placeholder="Adres" autocomplete="off">
																</div>
															</div>
														</div>
													</div>

												</div>
											</div>

											<div id="asilsaticibilgileri" style="display:none;">
												<h2>ASIL SATICI BİLGİLERİ</h2>

												<div class="row mt-4 p-4 border-top">
													<div class="col-md-3">
														<div class="col-md-12">
															<div class="form-group row">
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="asb_vkntckn" value="<?php if ($irsaliyeDetay->asb_vkntckn) echo $irsaliyeDetay->asb_vkntckn ?>" placeholder="VKN/TCKN" autocomplete="off">
																</div>
															</div>
														</div>
													</div>

													<div class="col-md-3">
														<div class="col-md-12">
															<div class="form-group row">
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="asb_unvan" value="<?php if ($irsaliyeDetay->asb_unvan) echo $irsaliyeDetay->asb_unvan ?>" placeholder="Unvan" autocomplete="off">
																</div>
															</div>
														</div>
													</div>

													<div class="col-md-3">
														<div class="col-md-12">
															<div class="form-group row">
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="asb_mno" value="<?php if ($irsaliyeDetay->asb_mno) echo $irsaliyeDetay->asb_mno ?>" placeholder="Müşteri No" autocomplete="off">
																</div>
															</div>
														</div>
													</div>

													<div class="col-md-3">
														<div class="col-md-12">
															<div class="form-group row">
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="asb_tel" value="<?php if ($irsaliyeDetay->asb_tel) echo $irsaliyeDetay->asb_tel ?>" placeholder="Telefon No" autocomplete="off">
																</div>
															</div>
														</div>
													</div>


													<div class="col-md-3">
														<div class="col-md-12">
															<div class="form-group row">
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="asb_eposta" value="<?php if ($irsaliyeDetay->asb_eposta) echo $irsaliyeDetay->asb_eposta ?>" placeholder="Eposta" autocomplete="off">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="col-md-12">
															<div class="form-group row">
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="asb_ulke" value="<?php if ($irsaliyeDetay->asb_ulke) echo $irsaliyeDetay->asb_ulke ?>" placeholder="Ülke" autocomplete="off">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="col-md-12">
															<div class="form-group row">
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="asb_il" value="<?php if ($irsaliyeDetay->asb_il) echo $irsaliyeDetay->asb_il ?>" placeholder="İl" autocomplete="off">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="col-md-12">
															<div class="form-group row">
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="asb_ilce" value="<?php if ($irsaliyeDetay->asb_ilce) echo $irsaliyeDetay->asb_ilce ?>" placeholder="İlçe" autocomplete="off">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group row">
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="asb_adres" value="<?php if ($irsaliyeDetay->asb_adres) echo $irsaliyeDetay->asb_adres ?>" placeholder="Adres" autocomplete="off">
																</div>
															</div>
														</div>
													</div>
											</div>

										</div>
									</div>

									<div class="row"
										 id="faturaAltBilgisiDiv" <?php if (!$faturaDetay) echo "style='display:none;'"; ?>>
										<div class="col-md-12">
											<h4 class="card-title mt-4">Not Bilgileri</h4>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>Not</label>
														<textarea class="form-control"
																  name="satis_aciklama"><?= $faturaDetay->satis_aciklama ?></textarea>
													</div>
												</div>

											</div>
											<div class="col-md-12 p-0">
												<div class="row">
													<div class="col-md-12">
														<button type="submit" class="btn btn-danger" style="width:100%;"
																id="submitBtn">
															Kaydet
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>

									<input type="hidden" id="aratopHidden" name="aratopHidden"
										   value="<?= $faturaDetay->satis_araToplam ?>">
									<input type="hidden" id="kdvtopHidden" name="kdvtopHidden"
										   value="<?= $faturaDetay->satis_kdvToplam ?>">
									<input type="hidden" id="geneltopHidden" name="geneltopHidden"
										   value="<?= $faturaDetay->satis_genelToplam ?>">
									<input type="hidden" id="vergidahilHidden" name="vergidahilHidden"
										   value="<?= $faturaDetay->satis_vergiDahilToplam ?>">
									<input type="hidden" id="indirimtopHidden" name="indirimtopHidden"
										   value="<?= $faturaDetay->satis_indirimToplam ?>">
									<input type="hidden" id="tevkifattopHidden" name="tevkifattopHidden"
										   value="<?= $faturaDetay->satis_tevkifatToplam ?>">
									<input type="hidden" id="netTutarInput" name="netTutarInput"
										   value="<?= $faturaDetay->satis_netTutar ?>">
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

<div id="cariEkle" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Cari Ekle</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url("cari/yeniCariKartiOlustur"); ?>" method="POST" id="myForm">
					<div class="row">
						<div class="form-group col-md-12">
							<input type="hidden" name="page" value="earsivfatura">
							<label>Cari Tipi</label>
							<select class="select" name="cari_bireysel" required="" id="cariBireysel">
								<option value="">Seçiniz...</option>
								<option value="1">Bireysel Müşteri</option>
								<option value="0">Kurumsal Müşteri</option>
								<option value="2">Diğer</option>
							</select>

							<input type="hidden" name="cari_alias_pk" id="alias_pk">
						</div>
					</div>
					<div class="row" style="display: none;" id="cari_input">
						<div class="row p-3">
							<div class="col-md-4">
								<div class="form-group">
									<label>TCKN / VKN</label>
									<input type="number" class="form-control" required
										   name="cari_vergiNumarasi"
										   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
										   maxlength="11" id="vergiNumarasi" autocomplete="off"><img
											src="/assets/img/Eclipse-1s-200px.gif"
											style="position: absolute; right:15px; bottom: 95px; width:40px; display:none;"
											id="loading-image"/>
								</div>
								<div class="form-group">
									<label>Vergi Dairesi</label>
									<input type="text" class="form-control" name="cari_vergiDairesi"
										   id="vergiDairesi" autocomplete="off" required="">
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label>Cari Kodu</label>
									<input type="text" class="form-control" name="cari_kodu" id="cari_kodu"
										   required=""
										   autocomplete="off" required minlength="3">
								</div>
								<div class="form-group">
									<label>Cari Adı</label>
									<input type="text" class="form-control" name="cari_ad" required
										   autocomplete="off" id="cariAd">
								</div>

							</div>


							<div class="col-md-4">
								<div class="form-group">
									<label>Cari Grup</label>
									<select class="select" name="cari_cariGrupKoduID" id="cariGrupKodu">
										<option value="0">Seçiniz...</option>
										<?php foreach ($cariGruplari as $cg) { ?>
											<option value="<?= $cg->cariGrup_id ?>"><?= $cg->cariGrup_kodu; ?>
												(<?= $cg->cariGrup_ad; ?>)
											</option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group" id="c_soyad" style="display: none;">
									<label>Cari Soyadı</label>
									<input type="text" class="form-control" name="cari_soyad" id="cariSoyad"
										   autocomplete="off" >
								</div>
							</div>
						</div>
					</div>

					<h4 class="card-title mt-4">Cari İletişim Bilgileri</h4>
					<div class="row">
						<div class="col-md-6">

							<?php
							if ($_iller != false):
								echo '<div class="form-group">
												<label>İl</label>
												<select id="il" name="cari_il" data-plugin-selectTwo class="select ajaxIller" required>
												<option value="">Seçiniz</option>';
								foreach ($_iller as $item) {
									echo '<option value="' . $item->id . '">' . $item->il . '</option>';
								}
								echo '</select></div>';
							else:
								echo 'Kayıtlı İl Bulunamadı..!';
							endif;
							?>

							<div class="form-group">
								<label>Web sitesi</label>
								<input type="text" class="form-control" name="cari_websitesi"
									   autocomplete="off">
							</div>

							<div class="form-group">
								<label>Firma e-Posta</label>
								<input type="email" class="form-control" name="cari_firmaEPosta"
									   autocomplete="off"  id="cari_eposta">
							</div>

							<div class="form-group">
								<label>Firma Telefon</label>
								<input type="text" class="form-control" name="cari_firmaTelefon"
									   autocomplete="off"
									   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
									   maxlength="10" id="cari_telefon">
							</div>

						</div>
						<div class="col-md-6">
							<div class="ilceler">
								<div class="form-group">
									<label>İlçe</label>
									<select id="ilce" name="cari_ilce" class="select" required>
										<option value="">İl Seçiniz</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Adres</label>
								<textarea rows="9" cols="5" class="form-control"
										  placeholder="Adres bilgisi giriniz..."
										  name="cari_adres"></textarea>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-danger" style="width:100%;" id="kydtBTN">Kaydet
					</button>
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

<script>

	$(function () {
		$('.datepicker').datepicker({
			dateFormat: 'dd.mm.yy',
			language: 'tr',
			autoclose: true,
			todayHighlight: true,
			startDate: new Date(new Date().setDate(new Date().getDate() - 7)),
			endDate: new Date(new Date())
		});
	});

	$(function () {
		$('#datetimepicker').datetimepicker({
			format: 'HH:mm'
		});
	});
</script>

<script>
	<?php
		if (!$faturaDetay) {
			echo "addItem();";
		}
	?>

	function stokKontrol(stok) {
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
	}

	function addItem() {
		//onblur='stokKontrol(this.id)'
		items++;
		counter.push(items);
		var html = "<tr>";
		html += "<td><input type='hidden' name='stokid[]' id='stokid" + items + "'><input type='text' class='form-control' name='stokadi[]' id='stokadi" + items + "'  required></td>";
		html += "<td><input type='text' class='form-control' name='stokkodu[]' id='stokkodu" + items + "'  required></td>";
		html += "<td><select class='form-control' name='birim[]' id='birim" + items + "'><?= $birimler ?></select></td>";
		html += "<td><input type='number' step='0.1' class='form-control' autocomplete='off' name='miktar[]' id='miktar" + items + "' required='' style='width:175px;' ></td>";
		html += "<td><input type='number' step='0.1' class='form-control' autocomplete='off' name='birimfiyat[]' id='birimfiyat" + items + "' required='' ></td>";
		/*html += "<td><input type='text' class='form-control' name='kdv[]' id='kdv"+items+"' readonly></td>";*/
		html += "<td><input type='hidden' name='indirimtutari[]' id='indirimtutari" + items + "'><input type='text' class='form-control' name='toplam[]' id='toplam" + items + "' readonly><input type='hidden' name='toplamHidden[]' id='toplamHidden" + items + "'></td>";
		html += "<td> <button type='button' onclick='deleteRow(this);' class='btn btn-danger btn-sm' id='" + items + "'><i class='fa fa-trash'></i> Sil</button> </td>";
		html += "</tr>";
		var row = document.getElementById("tbody").insertRow();
		row.innerHTML = html;
		var secenekler = "<td id='indirimytd" + items + "' style='display: none;'><label>İndirim (%)</label><input type='number' step='0.1' class='form-control' placeholder='İndirim (%)' name='indirimyuzde[]'   id='indirimyuzde" + items + "'></td>";
		secenekler += "<td id='tevkifatselecttd" + items + "' style='display: none;' ><label>Tevkifat</label><select  name='tevkifat[]'  id='tevkifat" + items + "'class='form-control' onchange='tevkifat(this," + items + ")'><option value='0'>Seçiniz</option><?php echo $tevkifat; ?></select></td>";
		secenekler += "<td id='tevkifattexttd" + items + "' style='display: none;' ><label>Tevkifat Oranı(%)</label><input type='text' class='form-control' name='tevkifat_oran[]' id='tevkifat_oran" + items + "' readonly placeholder='Tevkifat Oranı(%)'></td>";

		var row = document.getElementById("tbody").insertRow();
		row.innerHTML = secenekler;
		$("#stokadi" + items).autocomplete({
			source: '<?= env('BASE_URL'); ?>/fatura/autocompleteDataByStockName',
			minLength: 2,
			select: function (event, ui) {
				event.preventDefault();

				$('.ui-autocomplete').modal('hide');

				toastr.success(ui.item.value + " stok isimli stok bilgileri getirildi.");
				let id = event.target.id;
				var idsi = id.match(/\d/g);
				idsi = idsi.join("");

				$("#stokID").val(ui.item.id);
				$("#stokid" + idsi + "").val(ui.item.id);
				$("#stokadi" + idsi + "").val(ui.item.value);
				$("#stokkodu" + idsi + "").val(ui.item.stok_kodu);
				$("#birim" + idsi + "").val(ui.item.stok_birimi);
				$("#barkod" + idsi + "").val(ui.item.stok_barkod);
				$("#birimfiyat" + idsi + "").val(ui.item.stok_satisFiyati);
				$("#kdv" + idsi + "").val(ui.item.stok_satisKDV);
				$("#miktar" + idsi + "").val("1");
				$("#toplam" + idsi + "").val("1");
				document.getElementById("stokadi" + idsi).readOnly = true;
				document.getElementById("stokkodu" + idsi).readOnly = true;
				//document.getElementById("birim" + idsi).disabled = true;
				document.getElementById("barkod" + idsi).readOnly = true;
				$("#birim" + idsi).css("pointer-events", "none");
				$("#birim" + idsi).css("background-color", "#e9ecef");
				$("#stokadi" + idsi).css("background-color", "#e9ecef");
				$("#stokkodu" + idsi).css("background-color", "#e9ecef");
				$("#barkod" + idsi).css("background-color", "#e9ecef");
				$("#birim" + idsi).css("background-color", "#e9ecef");

				var tip = $("#satis_faturaTip").val();
			}
		});
		$("#stokkodu" + items).autocomplete({
			source: '<?= env('BASE_URL'); ?>/fatura/autocompleteDataByStockCode',
			minLength: 2,
			select: function (event, ui) {
				event.preventDefault();

				$('.ui-autocomplete').modal('hide');
				toastr.success(ui.item.value + " stok kodlu stok bilgileri getirildi.");
				let id = event.target.id;
				var idsi = id.match(/\d/g);
				idsi = idsi.join("");
				$("#stokID").val(ui.item.id);
				$("#stokid" + idsi + "").val(ui.item.id);
				$("#stokkodu" + idsi + "").val(ui.item.value);
				$("#stokadi" + idsi + "").val(ui.item.stok_ad);
				$("#birim" + idsi + "").val(ui.item.stok_birimi);
				$("#barkod" + idsi + "").val(ui.item.stok_barkod);
				$("#birimfiyat" + idsi + "").val(ui.item.stok_satisFiyati);
				$("#kdv" + idsi + "").val(ui.item.stok_satisKDV);
				$("#miktar" + idsi + "").val("1");
				$("#toplam" + idsi + "").val("1");

				document.getElementById("stokadi" + idsi).readOnly = true;
				document.getElementById("stokkodu" + idsi).readOnly = true;
				document.getElementById("birim" + idsi).readOnly = true;
				document.getElementById("barkod" + idsi).readOnly = true;

				$("#birim" + idsi).css("pointer-events", "none");
				$("#birim" + idsi).css("background-color", "#e9ecef");
				$("#stokadi" + idsi).css("background-color", "#e9ecef");
				$("#stokkodu" + idsi).css("background-color", "#e9ecef");
				$("#barkod" + idsi).css("background-color", "#e9ecef");
				$("#birim" + idsi).css("background-color", "#e9ecef");

				var tip = $("#satis_faturaTip").val();

			}
		});
	}

	function round(value, decimals) {
		return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
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
				fiyat = miktar * birimfiyat;
				aratop += fiyat;//ara toplam
				$("#toplam" + i + "").val(fiyat);
				$("#toplamHidden" + i + "").val(fiyat);

				nettop = aratop - indirimtop;
				geneltop = nettop;

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

	function deleteRow(button) {
		if (counter.length >= 1) {
			counter.pop();
		}
		if (counter.length == 0) {
			counter.push(1);
			toastr.warning("En az bir kayıt olması zorunludur, bu kayıt silinemez.");
		} else {
			var btnID = button.id;

			button.parentElement.parentElement.remove();
			$('#bos' + btnID + '').remove();
			$('#indirimytd' + btnID + '').remove();
			$('#indirimttd' + btnID + '').remove();
			$('#tevkifattd' + btnID + '').remove();
			$('#istisnatd' + btnID + '').remove();
			$('#tevkifatselecttd' + btnID + '').remove();
			$('#tevkifattexttd' + btnID + '').remove();
			hesapla();
		}
		console.log("çıkarıldı son items:" + items);
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

	$('#edit_category').on('show.bs.modal', function (event) {
		let idsi = $(event.relatedTarget).data('id')
		$(this).find('.modal-body #idsi').val(idsi)
	})

	$('#add_category').on('show.bs.modal', function (event) {
		let a_idsi = $(event.relatedTarget).data('idsi')
		$(this).find('.modal-body #add_idsi').val(a_idsi)
	})

	$(function () {
		$("#name_input").autocomplete({
			source: "<?= env('BASE_URL'); ?>/fatura/autocompleteDataByNameEArsiv",
			minLength: 2,
			select: function (event, ui) {
				event.preventDefault();


				var aliaspk = ui.item.cari_aliasPK;
				if (!!(aliaspk)) {
					swal({
						title: "Bilgilendirme",
						type: "error",
						text: "Seçmiş olduğunuz cari e-fatura mükellefidir. E-arşiv düzenlenemez. E-fatura düzenleyebilizsiniz.",
						confirmButtonText: 'Tamam',
						button: false,
						timer: 5000,
					});
					$("#name_input").val("");
					$("#tcknvkn_input").val("");
					$("#kod_input").val("");
					$("#cari_grubu_input").val("");
					$("#cari_vergiDairesi_input").val("");
					$("#cari_adres_input").val("");
					$("#eposta_bilgi_input").val("");
//					$("#faturaBilgisiDiv").css("display", "none");
					$("#faturaAltBilgisiDiv").css("display", "none");
					$("#stokBilgisiDiv").css("display", "none");
					$("#checkboxDiv").css("display", "none");
					$("#submitBtn").css("display", "none");
				} else {

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
					var tables = document.getElementsByTagName('table');

					for (var i = 0; i < tables.length; i++) {
						resizableGrid(tables[i]);
					}

				}

			}
		});
	});

	$(function () {
		$("#satis_faturaEtiketID").autocomplete({
			source: "<?= env('BASE_URL'); ?>/fatura/autocompleteDataByEtiket",
			minLength: 2,
			select: function (event, ui) {
				event.preventDefault();
				$("#etiket_id").val(ui.item.id);
				$("#satis_faturaEtiketID").val(ui.item.value);
			}
		});
	});
	function etiketKontrol() {
		var etiket_adi=$("satis_faturaEtiketID").val();
		if(!etiket_adi) {
			etiket_id = "";
			$("#etiket_id").val("");
		}

		if (etiket_id == "")
			$("#satis_faturaEtiketID").css("background-color", "#dff1e7");
		else
			$("#satis_faturaEtiketID").css("background-color", "#e9ecef");
	}
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
					$("#faturaBilgisiDiv").css("display", "block");
					$("#faturaAltBilgisiDiv").css("display", "block");
					$("#stokBilgisiDiv").css("display", "block");
					$("#checkboxDiv").css("display", "block");
					$("#submitBtn").css("display", "block");
					var element = document.getElementById("faturaBilgisiDiv");
					element.classList.remove("d-none");
					var tables = document.getElementsByTagName('table');

					for (var i = 0; i < tables.length; i++) {
						resizableGrid(tables[i]);
					}
			}
		});
	});

	<?php if (!$faturaDetay) {
		echo '$("#tcknvkn_input").on("keyup", function () {
		var input=$("#tcknvkn_input").val();

		if(input=="") {
			$("#name_input").val("");
			$("#tcknvkn_input").val("");
			$("#kod_input").val("");
			$("#cari_grubu_input").val("");
			$("#cari_vergiDairesi_input").val("");
			$("#cari_adres_input").val("");
			$("#eposta_bilgi_input").val("");
			$("#faturaBilgisiDiv").css("display", "none");
			$("#faturaAltBilgisiDiv").css("display", "none");
			$("#stokBilgisiDiv").css("display", "none");
			$("#checkboxDiv").css("display", "none");
			$("#submitBtn").css("display", "none");
		}
	});';
	} else {

		echo 'var element = document.getElementById("faturaBilgisiDiv");
			element.classList.remove("d-none");
			$("#checkboxDiv").css("display", "block");';
	}
	if ($cari) {
		echo 'var element = document.getElementById("faturaBilgisiDiv");
				element.classList.remove("d-none");$("#faturaAltBilgisiDiv").css("display", "block");
				$("#stokBilgisiDiv").css("display", "block");
				$("#checkboxDiv").css("display", "block");
				$("#submitBtn").css("display", "block");';
	}
	?>


	$(function () {
		$("#stokKodu").autocomplete({
			source: '<?= env('BASE_URL'); ?>/fatura/autocompleteDataByStockCode',
			minLength: 2,
			select: function (event, ui) {
				event.preventDefault();

				$('#edit_category').modal('hide');
				$("#stokKodu").val("");
				$("#stokAdi").val("");

				toastr.success(ui.item.value + " stok kodlu stok bilgileri getirildi.");

				document.getElementById("miktar" + idsi.value).onkeydown = null;
				document.getElementById("birimfiyat" + idsi.value).onkeydown = null;

				document.getElementById("eklebuton" + idsi.value).disabled = false;

				$("#stokID").val(ui.item.id);
				$("#stokid" + idsi.value + "").val(ui.item.id);
				$("#stokkodu" + idsi.value + "").val(ui.item.value);
				$("#stokadi" + idsi.value + "").val(ui.item.stok_ad);
				$("#birim" + idsi.value + "").val(ui.item.stok_birimi);
				$("#barkod" + idsi.value + "").val(ui.item.stok_barkod);
				$("#birimfiyat" + idsi.value + "").val(ui.item.stok_satisFiyati);
				$("#kdv" + idsi.value + "").val(ui.item.stok_satisKDV);
				$("#miktar" + idsi.value + "").val("1");
				$("#toplam" + idsi.value + "").val("1");
				var tip = $("#satis_earsivfaturaTip").val();
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
				$("#stokAdi").val("");
				$("#stokKodu").val("");

				toastr.success(ui.item.value + " stok isimli stok bilgileri getirildi.");

				document.getElementById("miktar" + idsi.value).onkeydown = null;
				document.getElementById("birimfiyat" + idsi.value).onkeydown = null;

				document.getElementById("eklebuton" + idsi.value).disabled = false;

				console.log(idsi);

				$("#stokID").val(ui.item.id);
				$("#stokid" + idsi.value + "").val(ui.item.id);
				$("#stokadi" + idsi.value + "").val(ui.item.value);
				$("#stokkodu" + idsi.value + "").val(ui.item.stok_kodu);
				$("#birim" + idsi.value + "").val(ui.item.stok_birimi);
				$("#barkod" + idsi.value + "").val(ui.item.stok_barkod);
				$("#birimfiyat" + idsi.value + "").val(ui.item.stok_satisFiyati);
				$("#kdv" + idsi.value + "").val(ui.item.stok_satisKDV);
				$("#miktar" + idsi.value + "").val("1");
				$("#toplam" + idsi.value + "").val("1");
				var tip = $("#satis_earsivfaturaTip").val();
			}
		});
	});


	$(document).on('change', 'input[name^="miktar"]', function () {
		hesapla();
	});

	$(document).on('change', 'input[name^="birimfiyat"]', function () {
		hesapla();
	});

	$(document).on('change', 'input[name^="toplam"]', function () {
		hesapla();
	});
</script>

<script>
	$("#submitBtn").click(function (e) {
		let allAreFilled = true;
		let errorCount = 0;

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
			e.preventDefault();

			var stokID = $("input[name='stokid[]']").map(function () {
				return $(this).val();
			}).get();
			var stokMiktar = $("input[name='miktar[]']").map(function () {
				return $(this).val();
			}).get();

			stokID.forEach(checkifEmpty);

			function checkifEmpty(item,index){
				if(item == ""){
					errorCount++;
				}
			}
		if(errorCount==0){
			$.ajax({
				url: "<?= env('BASE_URL'); ?>/fatura/satisFaturasiStokKontrol",
				method: "POST",
				data: {stokID: stokID, stokMiktar: stokMiktar},
				success: function (result) {
					if (result == 1) {
						Swal.fire({
							title: "Emin misiniz?",
							text: "Yapacağınız işlem sonucunda eklediğiniz stoklardan eksiye düşenler olacak, onaylıyor musunuz?",
							icon: "warning",
							showCancelButton: true,
							confirmButtonText: "Evet, onaylıyorum.",
							cancelButtonText: "İptal"
						}).then(function (result) {
							if (result.value) {
								$("#myForm").submit();
							}
						});
					} else {
						$("#myForm").submit();
					}
				}
			});
		}else{
			toastr.error("Önce stok kartı oluşturun ardından listeden seçerek ekleme yapın.");
		}
		}
	});

	//döviz kuru işlemleri buradan
	$("#satis_paraBirimi").on('change', function () {
		var paraBirimiText = $("#satis_paraBirimi option:selected").text();
		var paraBirimi = $("#satis_paraBirimi option:selected").val();

		if (paraBirimi == 1) {
			$("#satis_guncelKur").css("display", "none");
			$("#satis_guncelKur").val("");
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

			$("#satis_guncelKur").css("display", "block");
			$.ajax({
				url: "<?= env('BASE_URL'); ?>/fatura/paraBirimiKontrol",
				method: "POST",
				data: {paraBirimi: paraBirimi},
				success: function (result) {
					toastr.success("Para birimi " + paraBirimiText + " olarak değiştirilmiştir. Güncel kur bilgileri ekrana yansıtılmıştır.");
					$("#satis_guncelKur").val(result);
				}
			});
		}
		hesapla();
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
	function cariKontrol() {
		var kod_input = $("#kod_input").val();

		if (kod_input == "")
			$("#cariEkleBtn").attr('style', 'display:block;');
		else
			$("#cariEkleBtn").attr('style', 'display:none;');
	}
</script>


<?php if ($this->session->flashdata('cari_kodu_mevcut')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Eklemeye çalıştığınız cari kodu mevcut, lütfen farklı bir cari kodu ile tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_kodu_3_karakter')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Cari kodu en az 3 karakter olmalıdır. Tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_kodu_vergino')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Aynı vergi numarasına ait cari kayıt edilemez. Tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_kodu_vkn_karakter')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "VKN 10 haneli olmalıdır. Tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>
<?php if ($this->session->flashdata('cari_kodu_tckn_karakter')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "TCKN 11 haneli olmalıdır. Tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<script>
	$(document).on('change', 'input[id="sevkiyatCheck"]', function () {
		if (document.getElementById("sevkiyatCheck").checked == true) {
			//Adres üzerinde yapmış olduğunuz değişiklikler belge bazlıdır. Adres üzerinde yapmak istediğiniz kalıcı değişiklikleri Cari Hizmetler - Adres Defteri ekranından yapmanız gerekmektedir.
			//Adres alanı inputları göster
			//Ülke, Şehir, İlçe, Posta Kodu, Adres
			$("#bankabilgileri").css("display", "block");
		}else{
			$("#bankabilgileri").css("display", "none");
		}
	});

	$(document).on('change', 'input[id="asilSaticiCheck"]', function () {
		if (document.getElementById("asilSaticiCheck").checked == true) {
			$("#asilsaticibilgileri").css("display", "block");
		}else{
			$("#asilsaticibilgileri").css("display", "none");
		}
	});
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
	$("#cariBireysel").on('change', function () {
		var status = $("#cariBireysel option:selected").text();

		$("#cari_input").css("display", "block");
		$("#c_soyad").css("display", "none");

		if (status == "Bireysel Müşteri") {

			$("#vergiDairesi").prop('required', false);
			$("#cariSoyad").prop('required', false);
			$("#vergiNumarasi").prop('readonly', false);

			$("#vergiDairesi").val("");
			$("#vergiNumarasi").val("");
			$("#alias_pk").val("");
			$("#cari_kodu").val("");
			$("#cariAd").val("");

		} else if (status == "Kurumsal Müşteri") {

			$("#vergiDairesi").prop('required', false);

			$("#vergiNumarasi").prop('readonly', false);
			$("#vergiDairesi").val("");
			$("#vergiNumarasi").val("");
			$("#alias_pk").val("");
			$("#cari_kodu").val("");
			$("#cariAd").val("");

		} else if (status == "Diğer") {

			$("#vergiDairesi").prop('required', false);

			$("#vergiNumarasi").prop('readonly', true);
			$("#vergiDairesi").val("");
			$("#vergiNumarasi").val("11111111111");
			$("#alias_pk").val("");
			$("#cari_kodu").val("");
			$("#cariAd").val("");

		}
	});

	$("#vergiNumarasi").on('blur', function () {

		let str = $("#vergiNumarasi").val();

		$("#cariSoyad").val("");
		$("#cariAd").val("")
		if (str.length == 11) {
			$("#c_soyad").css("display", "block");
			$("#cariSoyad").prop('required', true);
			$("#vergiDairesi").prop('required', false);
		} else {

			$("#vergiDairesi").prop('required', true);
			$("#c_soyad").css("display", "none");
			$("#cariSoyad").prop('required', false);
		}

		if (str.length == 10 || str.length == 11) {
			$.ajax({
				url: "<?= env('BASE_URL'); ?>/Cari/gibVknTcknSorgula",
				method: "POST",
				data: {vergiNumarasi: str},
				dataType: 'json',
				beforeSend: function () {
					$("#loading-image").show();
					$(':input[type="submit"]').prop('disabled', true);
				},
				success: function (result) {
					;
					if (str.length == 11) {
						let ad = result.ad;
						let soyad = result.soyad;
						$("#c_soyad").css("display", "block");
						$("#cariAd").val(ad);
						$("#cariSoyad").val(soyad);
					} else {
						$("#c_soyad").css("display", "none");
						$("#cariAd").val(result.unvan);
					}

					$(':input[type="submit"]').prop('disabled', false);
					$("#loading-image").hide();
				}
			});

			<?php if($modulSorgula) { ?>
			$.ajax({
				url: "<?= env('BASE_URL'); ?>/Edonusum/Auth/CheckUser",
				method: "POST",
				data: {vergiNumarasi: str},
				dataType: 'json',
				beforeSend: function () {
					$("#loading-image").show();
					$(':input[type="submit"]').prop('disabled', true);
				},
				success: function (result) {
					let alias = result.alias;
					if (alias != null) {
						$("#alias_pk").val(alias);
						$("#mukellef_mark").css("display", "block");

					} else {
						$("#alias_pk").val("");
						$("#mukellef_mark").css("display", "none");
					}
					$(':input[type="submit"]').prop('disabled', false);
					$("#loading-image").hide();
				}
			});
			<?php } ?>
		}
	});


	$("#cari_eposta").on('blur', function () {
		var eposta = $("#cari_eposta").val();
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!regex.test(eposta)) {
			toastr.warning("Geçerli bir e-posta giriniz.");
			if (document.getElementById("cari_eposta").required == true)
				$("#kydtBTN").prop("disabled", true);
		} else {
			$("#kydtBTN").prop('disabled', false);
		}
	});

	$(document).ready(function () {
		$("#il").select2({
			width: '100%'
		});
		$("#cariGrupKodu").select2({
			width: '100%'
		});

		$("form").submit(function () {
			$(this).submit(function () {
				return false;
			});
			return true;
		});
	});
</script>
</body>
</html>
