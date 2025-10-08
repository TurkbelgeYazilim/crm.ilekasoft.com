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
			margin-bottom: 0px !important;
		}
		
		/* Hide Stok Kodu (Stock Code) and Birim (Unit) columns */
		#my_table th:nth-child(2), /* Stok Kodu header */
		#my_table td:nth-child(2), /* Stok Kodu data cells */
		#my_table th:nth-child(4), /* Birim header */
		#my_table td:nth-child(4) { /* Birim data cells */
			display: none !important;
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
							<li class="breadcrumb-item active">ALlış Faturası Oluştur</li>
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
							<form action="<?= base_url("fatura/alisFaturasiGuncelle/"); ?>" method="POST" id="myForm">
								<?php }
								else{//ekle
								?>
								<form action="<?= base_url("fatura/alisFaturasiOlustur"); ?>" method="POST" id="myForm">
									<?php
 									}
									?>


									<input type="hidden" name="alis_id" value="<?= $faturaDetay->alis_id ?>">
									<input type="hidden" name="alis_cariID" id="cari_id" value="<?= $cari->cari_id ?>">
									<input type="hidden" name="ch_id" id="ch_id"
										   value="<?= $faturaDetay->alis_cariHareketiID; ?>">

									<input type="hidden" class="form-control" name="cari_kodu" id="kod_input"
										   required="" value="<?= $cari->cari_kodu ?>">

									<div class="row">
										<div class="col-md-7">
											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-sm-3 text-sm-left pt-2">Cari TCKN/VKN Veya cari
														Adı</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="cari_tcknvkn"
															   id="tcknvkn_input" required=""
															   placeholder="Cari adı yazmaya başlayıp, listeden seçiniz."
															   value="<?= $cari_value ?>" onblur="cariKontrol();">
													</div>
													<div class="col-sm-1 p-0 mt-2" id="cariEkleBtn"
														 style="display: none;">
														<a href="javascript(0);" class="col-8 border-0 p-2 text-center"
														   style="background-color: forestgreen;color:#fff;font-size:14px;border-radius: 5px;"
														   data-toggle='modal' data-target='#cariEkle'><i
																	class="fa fa-user-plus"></i></a>
													</div>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-sm-3 text-sm-left pt-2">Adres</label>
													<div class="col-sm-8">
														<!-- <input type="text" class="form-control" name="" id="cari_adres_input" readonly> -->
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
												<div class="col-md-7">													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2">Sözleşme No <span style="color: red;">*</span></label>
															<div class="col-sm-9">
																<input type="text" class="form-control"
																	   name="alis_faturaNo"
																	   required="" autocomplete="off"
																	   value="<?= $faturaDetay->alis_faturaNo ?>">
															</div>

														</div>
													</div><div class="col-md-12" style="display: none;">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2">Tip</label>
															<div class="col-sm-9" id="alis_faturaTip_div">
																<select class="form-control" name="alis_faturaTip"
																		id="alis_faturaTip" required="">
																	<option value="1" <?php if ($faturaDetay->alis_faturaTipi == 1) echo "selected"; ?>>
																		ALIŞ
																	</option>
																	<option value="2" <?php if ($faturaDetay->alis_faturaTipi == 2) echo "selected"; ?>>
																		İADE
																	</option>
																	<option value="3" <?php if ($faturaDetay->alis_faturaTipi == 3) echo "selected"; ?>>
																		TEVKİFAT
																	</option>
																	<option value="4" <?php if ($faturaDetay->alis_faturaTipi == 4) echo "selected"; ?>>
																		İSTİSNA
																	</option>
																	<option value="5" <?php if ($faturaDetay->alis_faturaTipi == 5) echo "selected"; ?>>
																		İADE-İSTİSNA
																	</option>
																	<option value="6" <?php if ($faturaDetay->alis_faturaTipi == 6) echo "selected"; ?>>
																		ÖZEL MATRAH
																	</option>
																</select>
															</div>

														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2">Para
																Birimi</label>
															<div class="col-sm-5">
																<select class="form control select"
																		name="alis_paraBirimi"
																		id="alis_paraBirimi">
																	<option value="1" <?php if ($faturaDetay->alis_paraBirimi == 1) {
																		echo "selected";
																		$paraBirimi = "TL";
																	} ?>>
																		Türk Lirası
																	</option>
																	<option value="2" <?php if ($faturaDetay->alis_paraBirimi == 2) {
																		echo "selected";
																		$paraBirimi = "USD";
																	} ?>>
																		Amerikan Doları
																	</option>
																	<option value="3" <?php if ($faturaDetay->alis_paraBirimi == 3) {
																		echo "selected";
																		$paraBirimi = "EUR";
																	} ?>>
																		Euro
																	</option>
																	<option value="4" <?php if ($faturaDetay->alis_paraBirimi == 4) {
																		echo "selected";
																		$paraBirimi = "GBP";
																	} ?>>
																		İngiliz Sterlini
																	</option>
																</select>
															</div>
															<div class="col-sm-4">
																<input type="text" name="alis_guncelKur"
																	   id="alis_guncelKur"
																	   class="form-control" placeholder="Döviz kuru"
																		<?php if ($faturaDetay->alis_guncelKur == null) echo 'style="display:none;"'; ?>
																	   value="<?= $faturaDetay->alis_guncelKur ?>"/>
															</div>
														</div>
													</div>

												</div>

												<div class="col-md-5">

													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2"><!--Düzenleme-->
																Tarihi</label>
															<div class="col-sm-9">
																<input type="text" class="datepicker form-control"
																	   id="duzenlemeTarihi"
																	   name="alis_faturaTarihi" autocomplete="off"
																	   required=""
																	   value="<?= getirBugun(); ?>"/>
															</div>
														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2"><!--Düzenleme-->
																Saati</label>
															<div class="col-sm-9">
																<input type="text" class="form-control"
																	   name="alis_faturaSaati"
																	   autocomplete="off" required=""
																	   value="<?= getirSaat(); ?>"
																	   id="datetimepicker"/>
															</div>
														</div>
													</div>													<div class="col-md-12" style="display: none;">
														<div class="form-group row">
															<label class="col-sm-3 text-sm-left pt-2">Etiket</label>
															<div class="col-sm-9">

																<input type="text" class="form-control"  id="alis_faturaEtiketID"
																	   name="alis_faturaEtiketID"
																	   autocomplete="off"     placeholder="Etiket adını yazmaya başlayıp, listeden seçiniz."
																	   value="<?= $etiket->etiket_adi ?>" onblur="etiketKontrol();"
																/>

																<input type="hidden" class="form-control" name="etiket_id" id="etiket_id"
																	   value="<?= $etiket->etiket_id ?>">
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

											<div class="col-md-4">												<input class="form-check-input" type="checkbox" value="1"
													   id="kdvCheck" onchange="kdvCheckFunc()"
													   name="kdvCheck" style="width:30px;height:20px;" checked>
												<label class="form-check-label ml-3" for="kdvCheck">
													KDV Dahil
												</label>

											</div>


											<div class="col-md-4">

												<input class="form-check-input" type="checkbox" value="1"
													   id="bankaCheck"
													   name="bankaCheck" style="width:30px;height:20px;">
												<label class="form-check-label ml-3" for="bankaCheck">
													Banka Bilgisi Ekle
												</label>

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
													<table class="table table-bordered custom-table mb-0"
														   id="my_table">
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
																	<button type='button' class='btn btn-info btn-sm'
																			onclick='addItemIade()'>
																		<i class='fa fa-plus'></i> Ekle
																	</button>
																	<button type='button' onclick='deleteRowIade(this);'
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


									<div class="row"
										 id="stokBilgisiDiv" <?php if (!$faturaDetay) echo "style='display:none;'"; ?>>
										<div class="col-md-12">
											<h4 class="card-title mt-4">Stok Bilgisi <i
														class="fa fa-info-circle fa-xs text-info" data-toggle="tooltip"
														data-placement="right"
														title="Tablonun istediğiniz kenarından tutup büyütme ve küçültme işlemi yapabilirsiniz."></i>

												<a href="javascript:void(0)" class="btn btn-success btn-sm"
												   onclick="addItem();" style="float:right;"><i class="fa fa-plus"></i>
													Yeni
													Satır Ekle</a>
												<a href="javascript:void(0)" class="btn btn-info btn-sm mr-2"
												   style="float:right;"
												   onclick="addIndirim();$('#genel_iskonto').attr('style', 'display:block;');"><i
															class="fa fa-plus"></i>
													Genel İskonto</a>
											</h4>

											<div class="row">
												<div class="table-responsive">
													<table class="table table-bordered custom-table mb-0" id="my_table">
														<thead>
														<tr>
															<th>Stok Adı</th>
															<th>Stok Kodu</th>
															<th>Barkod</th>
															<th>Birim</th>
															<th>Miktar</th>
															<th>Birim Fiyat <span id="birimFiyatParaBirimi">(TL)</span>
															</th>
															<th>KDV (%)</th>
															<th>Toplam</th>
															<th></th>
														</tr>
														</thead>
														<tbody id="tbody">
														<?php
														$items = 0;

														foreach ($stok as $item) {
															$items++;
															$tevkifatVal = 0;
															$tevkifatOran = 0;
															if ($item->alisStok_tevkifat_id != 0) {
																$sqlTevkifat = "select * from tevkifatKodlari inner join alisFaturasiStok on tevkifat_id=alisStok_tevkifat_id where alisStok_id=" . $item->alisStok_id;
																$tevkifatExe = $this->db->query($sqlTevkifat)->row();
																$tevkifatVal = $tevkifatExe->tevkifat_orani . '|' . $tevkifatExe->tevkifat_id;
																$tevkifatOran = $tevkifatExe->tevkifat_orani;
															}
															?>
															<tr>
																<td>
																	<input type="hidden" name="alisFaturasiStok_id[]"
																		   value="<?= $item->alisStok_id; ?>">

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
																	<input type='hidden' name='stokid[]'
																		   id='stokid<?= $items ?>'
																		   value="<?= $item->alisStok_stokID ?>">
																	<input type='text' class='form-control'
																		   name='barkod[]' id='barkod<?= $items ?>'
																		   readonly
																		   value="<?= $item->stok_barkod ?>">
																</td>
																<td>
																	<select class='form-control' name='birim[]'
																			id='birim<?= $items ?>'>
																		<option value='0'>Birim</option>
																		<?= $birimler ?>
																	</select>
																</td>
																<td>
																	<input type='number' step='0.1' class='form-control'
																		   name='miktar[]'
																		   id='miktar<?= $items ?>' required=''
																		   style='width:175px;'
																		   value="<?= $item->alisStok_miktar ?>">
																</td>
																<td>
																	<input type='number' step='0.1' class='form-control'
																		   name='birimfiyat[]'
																		   id='birimfiyat<?= $items ?>' required=''
																		   value="<?= $item->alisStok_birimFiyat ?>">
																</td>
																<td>
																	<select class='form-control' name='kdv[]'
																			id='kdv<?= $items ?>'>
																		<option value='0' <?php if ($item->alisStok_kdv == 0) echo "selected"; ?>>
																			0
																		</option>
																		<option value='1' <?php if ($item->alisStok_kdv == 1) echo "selected"; ?>>
																			1
																		</option>
																		<option value='8' <?php if ($item->alisStok_kdv == 8) echo "selected"; ?>>
																			8
																		</option>
																		<option value='10' <?php if ($item->alisStok_kdv == 10) echo "selected"; ?>>
																			10
																		</option>
																		<option value='18' <?php if ($item->alisStok_kdv == 18) echo "selected"; ?>>
																			18
																		</option>
																		<option value='20' <?php if ($item->alisStok_kdv == 20) echo "selected"; ?>>
																			20
																		</option>
																	</select>
																</td>
																<td>
																	<input type='hidden' name='indirimtutari[]'
																		   id='indirimtutari<?= $items ?>'>
																	<input type='text' class='form-control'
																		   name='toplam[]'
																		   id='toplam<?= $items ?>' readonly
																		   value="<?= $item->alisStok_indirimlifiyat ?>">
																	<input type='hidden' name='toplamHidden[]'
																		   id='toplamHidden<?= $items ?>'
																		   value="<?= $item->alisStok_indirimlifiyat ?>">
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
															<td id='indirimytd<?= $items ?>' <?php if ($item->alisStok_satirIskonto == 0) echo "style='display: none;'"; ?>>
																<label>İndirim (%)</label>
																<input type='number' step='0.1' class='form-control'
																	   placeholder='İndirim (%)' name='indirimyuzde[]'
																	   id='indirimyuzde<?= $items ?>'
																		<?php if ($item->alisStok_indirimTutari != 0) echo ' value="' . $item->alisStok_indirimTutari . '"'; ?>>
															</td>
															<td id='tevkifatselecttd<?= $items ?>' <?php if ($item->alisStok_tevkifat_id == 0) echo "style='display: none;'"; ?>>
																<label>Tevkifat</label>
																<select name='tevkifat[]' id='tevkifat<?= $items ?>'
																		class='form-control'
																		onchange='tevkifat(this,<?= $items ?>)'>
																	<option value='0'>Seçiniz
																	</option><?php echo $tevkifat; ?>
																</select>
																<script>
																	document.getElementById('tevkifat<?= $items ?>').value = '<?= $tevkifatVal ?>';
																</script>
															</td>
															<td id='tevkifattexttd<?= $items ?>' <?php if ($item->alisStok_tevkifat_id == 0) echo "style='display: none;'"; ?>>
																<label>Tevkifat Oranı(%)</label>
																<input type='text' class='form-control'
																	   name='tevkifat_oran[]'
																	   id='tevkifat_oran<?= $items ?>' readonly
																	   placeholder='Tevkifat Oranı(%)'
																	   value="<?= $tevkifatOran * 100 ?>">
															</td>
															<script>items++;
																counter.push(items);
																document.getElementById("birim" + items).value = <?= $item->stok_birimID ?>;
																document.getElementById("birim" + items).style.pointerEvents = "none";
																document.getElementById("birim" + items).style.backgroundColor = "#e9ecef";
															</script>

															<?
														}

														?>


														</tbody>

													</table>
												</div>
											</div>

											<div class="row"
												 id="genel_iskonto" <?php if (empty($genelIskonto)) echo 'style="display: none;"'; ?>>
												<div class="col-md-12">
													<h4 class="card-title mt-4">GENEL İNDİRİM ISKONTO </h4>
													<div class="row">
														<div class="table-responsive">
															<input type="hidden" name="indirim_count"
																   id="indirim_count">
															<table class="table table-bordered custom-table mb-0"
																   id="my_table">
																<tbody id="tbody_indirim">
																<?php
																$itemsIndirim = 0;
																foreach ($genelIskonto as $itemIskonto) {
																	$itemsIndirim++;
																	?>
																	<tr>
																		<td>Sebebi</td>
																		<td>
																			<select class='form-control select'
																					name='indirimsebep[]'
																					id='indirimsebep<?= $itemsIndirim ?>'>
																				<option value='0' <?php if ($itemIskonto->iskonto_sebep == "İskonto") echo "selected"; ?>>
																					İskonto
																				</option>
																				<option value='1' <?php if ($itemIskonto->iskonto_sebep == "Nakit İskontosu") echo "selected"; ?>>
																					Nakit İskontosu
																				</option>
																				<option value='2' <?php if ($itemIskonto->iskonto_sebep == "Diğer") echo "selected"; ?>>
																					Diğer
																				</option>
																			</select>
																		</td>
																		<td>Tutar</td>
																		<td>
																			<input type='number' class='form-control'
																				   name='indirimtutar[]'
																				   id='indirimtutar<?= $itemsIndirim ?>'
																				   placeholder='İndirim (%)'
																				   value="<?= $itemIskonto->iskonto_tutar ?>">
																		</td>
																		<td>
																			<button type='button'
																					onclick='deleteRowIndirim(this);'
																					class='btn btn-danger btn-sm'
																					id='<?= $itemsIndirim ?>'>
																				<i class='fa fa-trash'></i> Sil
																			</button>
																		</td>
																	</tr>
																	<script>items_indirim++;
																		counter_indirim.push(items_indirim);
																		document.getElementById("indirim_count").value = items_indirim;
																	</script>
																<?php }
																?>
																</tbody>
															</table>
														</div>
													</div>
												</div>

											</div>

											<div class="row"
												 id="vergiMuafiyet" <?php if ($faturaDetay->alis_vergiMuafiyetSebep == "") echo 'style="display: none;"'; ?>>
												<div class="col-md-12">
													<h4 class="card-title mt-4">VERGİ MUAFİYET </h4>
													<table class="table custom-table mb-0">
														<tr>
															<td style="width:5%;"><label>Vergi Muafiyet
																	Sebebi</label>
															</td>
															<td>
																<input type="text" name="vergiMuafiyet_sebep"
																	   id="vergiMuafiyet_sebep" class="form-control"
																	   value="<?= $faturaDetay->alis_vergiMuafiyetSebep ?>">
															</td>
														</tr>
													</table>
												</div>
											</div>

											<div class="row"
												 id="istisna_table" <?php if ($faturaDetay->alis_istisna_id == 0) echo 'style="display: none;"'; ?>>
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
																		id='istisna_sebebi'>
																	<option value="0">Seçiniz</option>
																	<?= $istisna; ?>
																</select>
															</td>
														</tr>
													</table>
												</div>
											</div>

											<div class="row"
												 id="bankabilgileri" style="display: none;">
												<div class="col-md-12">
													<h4 class="card-title mt-4">Banka Bilgileri</h4>
													<input type="hidden" name="bankaCount" id="bankaCount">
													<table class="table table-bordered custom-table mb-0"
														   id="my_table">
														<tbody id="tbody_ayarlarbanka">
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
															<td class="text-right">Ara Toplam</td>
															<td class="text-right"
																id="aratop"><?= $faturaDetay->alis_araToplam . " " . $paraBirimi ?></td>
														</tr>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td class="text-right">Toplam İskonto(İndirim)</td>
															<td class="text-right"
																id="indirimtop"><?= $faturaDetay->alis_indirimToplam . " " . $paraBirimi ?></td>
														</tr>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td class="text-right">Net Tutar(Matrah)</td>
															<td class="text-right"
																id="nettutartop"><?= $faturaDetay->alis_netTutar . " " . $paraBirimi ?></td>
														</tr>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td class="text-right">Hesaplanan KDV</td>
															<td class="text-right"
																id="kdvtop"><?= $faturaDetay->alis_kdvToplam . " " . $paraBirimi ?></td>
														</tr>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td class="text-right">Hesaplanan KDV Tevkifat</td>
															<td class="text-right"
																id="kdvtevkifat"><?= $faturaDetay->alis_tevkifatToplam . " " . $paraBirimi ?></td>
														</tr>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td class="text-right">Vergiler Dahil Ödenecek Tutar
															</td>
															<td class="text-right"
																id="vergidahil"><?= $faturaDetay->alis_vergiDahilToplam . " " . $paraBirimi ?></td>
														</tr>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td class="text-right">Genel Toplam</td>
															<td class="text-right"
																id="geneltop"><?= $faturaDetay->alis_genelToplam . " " . $paraBirimi ?></td>
														</tr>
														</tbody>
													</table>

													<!-- <div class="float-right">
														Ara Toplam: <span id="aratop"	style="font-weight: bold;"></span>
														<span style="margin-right:20px;"></span>
														KDV: <span id="kdvtop" style="font-weight: bold;"></span>
														<span style="margin-right:20px;"></span>
														Genel Toplam: <span id="geneltop" style="font-weight: bold;"></span>
														<span style="margin-right:10px;"></span>
													</div> -->

												</div>
											</div>
										</div>
									</div>

									<div class="row"
										 id="faturaAltBilgisiDiv" <?php if (!$faturaDetay) echo "style='display:none;'"; ?>>
										<div class="col-md-12">
											<h4 class="card-title mt-4">Fatura Alt Bilgileri</h4>											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>Açıklama</label>
														<textarea class="form-control"
																  name="alis_aciklama"><?= $faturaDetay->alis_aciklama ?></textarea>
													</div>
												</div>

											</div>
											<!-- Dosya Yükleme Alanı -->
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>Satış sözleşmesini lütfen buraya yükleyiniz <span style="color: red;">*</span></label>
														<input type="file" class="form-control" name="fatura_dosya[]" multiple accept="*/*" required>
													</div>
												</div>
											</div>
											<!-- /Dosya Yükleme Alanı -->
											<div class="col-md-12 p-0">
												<div class="row">
													<div class="col-md-12">
														<button type="submit" class="btn btn-danger"
																style="width:100%;"
																id="submitBtn">
															Kaydet
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>


									<input type="hidden" id="aratopHidden" name="aratopHidden"
										   value="<?= $faturaDetay->alis_araToplam ?>">
									<input type="hidden" id="kdvtopHidden" name="kdvtopHidden"
										   value="<?= $faturaDetay->alis_kdvToplam ?>">
									<input type="hidden" id="geneltopHidden" name="geneltopHidden"
										   value="<?= $faturaDetay->alis_genelToplam ?>">
									<input type="hidden" id="vergidahilHidden" name="vergidahilHidden"
										   value="<?= $faturaDetay->alis_vergiDahilToplam ?>">
									<input type="hidden" id="indirimtopHidden" name="indirimtopHidden"
										   value="<?= $faturaDetay->alis_indirimToplam ?>">
									<input type="hidden" id="tevkifattopHidden" name="tevkifattopHidden"
										   value="<?= $faturaDetay->alis_tevkifatToplam ?>">
									<input type="hidden" id="netTutarInput" name="netTutarInput"
										   value="<?= $faturaDetay->alis_netTutar ?>">
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


<div id="cariEkle" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
	 aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
							<input type="hidden" name="page" value="alisfatura">
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
										   autocomplete="off">
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
									   autocomplete="off" id="cari_eposta">
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

<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
<script>
	$(function () {
		$('.datepicker').datepicker({
			dateFormat: 'dd.mm.yy',
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
			format: 'HH:mm'
		});
	});
</script>


<script>


	<?php
	if ($faturaDetay) {
		echo "document.getElementById('istisna_sebebi').value='" . $faturaDetay->alis_istisna_id . "';";
	}


	if ($faturaDetay->alis_faturaTipi == 3)
		echo 'var x = document.getElementById("add_secim");
			var option = document.createElement("option");
			option.text = "Tevkifat";
			option.value = "3";
			x.add(option);';


	if ($faturabankaDuzenle) {
		echo "checkboxbanka=1;";
		echo 'document.getElementById("bankaCheck").checked = true;var row="";$("#bankabilgileri").css("display", "block");';
		$items_banka = 0;
		foreach ($faturabankaDuzenle as $item) {
			$items_banka++;
			$html = "<tr>";
			$html .= '<td><label>Banka Adı</label><input type="hidden" name="ayarlarbanka_id[]" id="ayarlarbanka_id' . $items_banka . '" value="' . $item->ayarlarbanka_id . '"><input type="text" class="form-control" name="ayarlar_bankaadi[]" id="ayarlar_bankaadi' . $items_banka . '" value="' . $item->ayarlarbanka_ad . '"></td>';
			$html .= '<td><label>Şube</label><input type="text" class="form-control" name="ayarlar_sube[]" id="ayarlar_sube' . $items_banka . '" value="' . $item->ayarlarbanka_subeAd . '"></td>';

			$html .= '<td><label>Para Birimi</label><select class="form-control" name="ayarlar_parabirimi" id="ayarlar_parabirimi' . $items_banka . '"><option value="1"';
			if ($item->ayarlarbanka_paraBirim == 1) $html .= " selected ";
			$html .= '>Türk Lirası</option><option value="2"';
			if ($item->ayarlarbanka_paraBirim == 2) $html .= " selected ";
			$html .= '>Amerikan Doları </option><option value="3"';
			if ($item->ayarlarbanka_paraBirim == 3) $html .= " selected ";
			$html .= '>Euro</option><option value="4"';
			if ($item->ayarlarbanka_paraBirim == 4) $html .= " selected ";
			$html .= '> İngiliz Sterlini </option> </select> </td>"';

			$html .= '<td><label>Hesap No</label><input type="text" class="form-control" name="ayarlar_hesapno[]" id="ayarlar_hesapno' . $items_banka . '" value="' . $item->ayarlarbanka_hesapNo . '"></td>"';
			$html .= '<td><label>IBAN</label><input type="text" class="form-control" name="ayarlar_iban[]" id="ayarlar_iban' . $items_banka . '" value="' . $item->ayarlarbanka_iban . '"></td>';
			$html .= '<td><button type="button" onclick="deleteRowBanka(this);" class="btn btn-danger btn-sm" id="' . $items_banka . '"><i class="fa fa-trash"></i> Sil</button></td>';
			$html .= "</tr>";
			echo 'row=document.getElementById("tbody_ayarlarbanka").insertRow();row.innerHTML=\'' . $html . '\';';
			echo "items_banka=" . $items_banka . "; counter_banka.push(" . $items_banka . ");document.getElementById('bankaCount').value=" . $items_banka . ";";
		}
	}


	?>


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

	$(document).on('change', 'input[id="bankaCheck"]', function () {
		//function bankaCheckFunc(){
		if (document.getElementById("bankaCheck").checked == true) {
			$("#bankabilgileri").css("display", "block");

			var row = document.getElementById("tbody_ayarlarbanka");
			row.innerHTML = "";
			if (checkboxbanka == 1) {
				<?php  $items_banka = 0;foreach ($faturabankaDuzenle as $item) {
				$items_banka++;
				/*echo "items_banka++; counter_banka.push(items_banka); document.getElementById('bankaCount').value =items_banka;";*/
				$html = "<tr>";
				$html .= '<td><label>Banka Adı</label><input type="hidden" name="ayarlarbanka_id[]" id="ayarlarbanka_id' . $items_banka . '" value="' . $item->ayarlarbanka_id . '"><input type="text" class="form-control" name="ayarlar_bankaadi[]" id="ayarlar_bankaadi' . $items_banka . '" value="' . $item->ayarlarbanka_ad . '"></td>';
				$html .= '<td><label>Şube</label><input type="text" class="form-control" name="ayarlar_sube[]" id="ayarlar_sube' . $items_banka . '" value="' . $item->ayarlarbanka_subeAd . '"></td>';

				$html .= '<td><label>Para Birimi</label><select class="form-control" name="ayarlar_parabirimi" id="ayarlar_parabirimi' . $items_banka . '"><option value="1"';
				if ($item->ayarlarbanka_paraBirim == 1) $html .= " selected ";
				$html .= '>Türk Lirası</option><option value="2"';
				if ($item->ayarlarbanka_paraBirim == 2) $html .= " selected ";
				$html .= '>Amerikan Doları </option><option value="3"';
				if ($item->ayarlarbanka_paraBirim == 3) $html .= " selected ";
				$html .= '>Euro</option><option value="4"';
				if ($item->ayarlarbanka_paraBirim == 4) $html .= " selected ";
				$html .= '> İngiliz Sterlini </option> </select> </td>"';

				$html .= '<td><label>Hesap No</label><input type="text" class="form-control" name="ayarlar_hesapno[]" id="ayarlar_hesapno' . $items_banka . '"  value="' . $item->ayarlarbanka_hesapNo . '"></td>';
				$html .= '<td><label>IBAN</label><input type="text" class="form-control" name="ayarlar_iban[]" id="ayarlar_iban' . $items_banka . '"  value="' . $item->ayarlarbanka_iban . '"></td>';

				$html .= '<td><button type="button" onclick="deleteRowBanka(this);" class="btn btn-danger btn-sm" id="' . $items_banka . '"><i class="fa fa-trash"></i> Sil</button></td>';
				$html .= "</tr>";
				echo 'row=document.getElementById("tbody_ayarlarbanka").insertRow();row.innerHTML=\'' . $html . '\';';
				echo "items_banka=" . $items_banka . "; counter_banka.push(" . $items_banka . ");document.getElementById('bankaCount').value=" . $items_banka . ";";
			}?>
			} else {
				<?php  foreach ($faturabanka as $itemx) {
				$items_banka++;
				$html = "<tr>";
				$html .= '<td><label>Banka Adı</label><input type="hidden" name="ayarlarbanka_id[]" id="ayarlarbanka_id' . $items_banka . '" value="' . $itemx->ayarlarbanka_id . '"><input type="text" class="form-control" name="ayarlar_bankaadi[]" id="ayarlar_bankaadi' . $items_banka . '" value="' . $itemx->ayarlarbanka_ad . '"></td>';
				$html .= '<td><label>Şube</label><input type="text" class="form-control" name="ayarlar_sube[]" id="ayarlar_sube' . $items_banka . '" value="' . $itemx->ayarlarbanka_subeAd . '"></td>';

				$html .= '<td><label>Para Birimi</label><select class="form-control" name="ayarlar_parabirimi" id="ayarlar_parabirimi' . $items_banka . '"><option value="1"';
				if ($itemx->ayarlarbanka_paraBirim == 1) $html .= " selected ";
				$html .= '>Türk Lirası</option><option value="2"';
				if ($itemx->ayarlarbanka_paraBirim == 2) $html .= " selected ";
				$html .= '>Amerikan Doları </option><option value="3"';
				if ($itemx->ayarlarbanka_paraBirim == 3) $html .= " selected ";
				$html .= '>Euro</option><option value="4"';
				if ($itemx->ayarlarbanka_paraBirim == 4) $html .= " selected ";
				$html .= '> İngiliz Sterlini </option> </select> </td>"';

				$html .= '<td><label>Hesap No</label><input type="text" class="form-control" name="ayarlar_hesapno[]" id="ayarlar_hesapno' . $items_banka . '"  value="' . $itemx->ayarlarbanka_hesapNo . '"></td>';
				$html .= '<td><label>IBAN</label><input type="text" class="form-control" name="ayarlar_iban[]" id="ayarlar_iban' . $items_banka . '"  value="' . $itemx->ayarlarbanka_iban . '"></td>';

				$html .= '<td><button type="button" onclick="deleteRowBanka(this);" class="btn btn-danger btn-sm" id="' . $items_banka . '"><i class="fa fa-trash"></i> Sil</button></td>';
				$html .= "</tr>";
				echo 'row=document.getElementById("tbody_ayarlarbanka").insertRow();row.innerHTML=\'' . $html . '\';';
			}

				echo "items_banka=" . $items_banka . "; counter_banka.push(" . $items_banka . ");document.getElementById('bankaCount').value=" . $items_banka . ";";
				?>


			}
		} else {
			$("#bankabilgileri").css("display", "none");
			checkboxbanka = 0;
		}


	});


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

		items++;
		counter.push(items);
		var html = "<tr>";
		//html += "<td><a href='#' class='btn btn-success btn-sm' data-toggle='modal' data-target='#edit_category' data-id='" + items + "'><i class='fa fa-hand-pointer'></i> Seç</a>  </td>";

		html += "<td><input type='text' class='form-control' name='stokadi[]' id='stokadi" + items + "' onblur='stokKontrol(this.id)' required></td>";
		html += "<td style='display:none'><input type='text' class='form-control' name='stokkodu[]' id='stokkodu" + items + "' onblur='stokKontrol(this.id)' required></td>";
		html += "<td><input type='hidden' name='stokid[]' id='stokid" + items + "'><input type='text' class='form-control' name='barkod[]' id='barkod" + items + "'  ></td>";
		html += "<td style='display:none'><select class='form-control' name='birim[]' id='birim" + items + "'><?= $birimler ?></select></td>";
		html += "<td><input type='number' step='0.1' class='form-control' autocomplete='off' name='miktar[]' id='miktar" + items + "' required='' style='width:175px;' ></td>";
		html += "<td><input type='number' step='0.1' class='form-control' autocomplete='off' name='birimfiyat[]' id='birimfiyat" + items + "' required='' ></td>";
		/*html += "<td><input type='text' class='form-control' name='kdv[]' id='kdv"+items+"' readonly></td>";*/
		html += "<td><select class='form-control' name='kdv[]' id='kdv" + items + "' ><option value='0' >0</option><option value='1 '>1</option><option value='8' selected>8</option><option value='10' selected>10</option><option value='18'>18</option><option value='20'>20</option></select></td>";
		html += "<td><input type='hidden' name='indirimtutari[]' id='indirimtutari" + items + "'><input type='text' class='form-control' name='toplam[]' id='toplam" + items + "' readonly><input type='hidden' name='toplamHidden[]' id='toplamHidden" + items + "'></td>";
		html += "<td><button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#add_category' data-idsi='" + items + "' id='eklebuton" + items + "' ><i class='fa fa-plus'></i> Ekle</button> <button type='button' onclick='deleteRow(this);' class='btn btn-danger btn-sm' id='" + items + "'><i class='fa fa-trash'></i> Sil</button> </td>";
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
				$("#birimfiyat" + idsi + "").val(ui.item.stok_alisFiyati);
				$("#kdv" + idsi + "").val(ui.item.stok_alisKDV);
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
				var tip = $("#alis_faturaTip").val();
				if (tip != 4 && tip != 5 && tip != 6)
					vergimuafiyet();
				if (document.getElementById("kdvCheck").checked == false)
					hesapla();
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
				$("#birimfiyat" + idsi + "").val(ui.item.stok_alisFiyati);
				$("#kdv" + idsi + "").val(ui.item.stok_alisKDV);
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
				var tip = $("#alis_faturaTip").val();
				if (tip != 4 && tip != 5 && tip != 6)
					vergimuafiyet();
				if (document.getElementById("kdvCheck").checked == false)
					hesapla();

			}
		});


		if (document.getElementById("kdvCheck").checked == true) {
			$('input[name^="birimfiyat"]').prop('readonly', true);
			$('input[name^="toplam"]').prop('readonly', false);
		} else {
			$('input[name^="birimfiyat"]').prop('readonly', false);
			$('input[name^="toplam"]').prop('readonly', true);
		}

	}

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
		val = (val.split("|"))[0];
		val = val * 100;
		$("#tevkifat_oran" + items).val(val);
		hesapla();
	}


	function round(value, decimals) {
		return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
		/*debugger;
		if(value!=0){
		if (value != "NaN") {
			//return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);/*
			var x = (value);
			var array = x.toString().split(".");
			x = array[1];
			var ondalik = x.toString().substr(0, 2);
			if (parseInt(x[1]) % 2 == 0) {
				return Number(array[0] + "." + ondalik);
			} else {
				return Number(Math.ceil(value + 'e' + decimals) + 'e-' + decimals);
			}
		} else return 0;
	} else return 0;*/
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
				var miktar = $("#miktar" + i + "").val();
				var birimfiyat = $("#birimfiyat" + i + "").val();
				var toplam = $("#toplam" + i + "").val();
				fiyat = 0;
				kdvHesap = 0;
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


				if (tevkifat != 0) {
					var tevkifatOran = (tevkifat.split("|"));
					var tevkifatHesap = kdvHesap * tevkifatOran[0];
					tevkifattop = tevkifattop + tevkifatHesap;
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
				$("#faturaAltBilgisiDiv").css("display", "block");
				$("#faturaBilgisiDiv").css("display", "block");
				$("#checkboxDiv").css("display", "block");
				$("#stokBilgisiDiv").css("display", "block");
				$("#submitDiv").css("display", "block");
				addItem();
				var tables = document.getElementsByTagName('table');
				for (var i = 0; i < tables.length; i++) {
					resizableGrid(tables[i]);
				}
			}
		});
	});


	$(function () {
		$("#alis_faturaEtiketID").autocomplete({
			source: "<?= env('BASE_URL'); ?>/fatura/autocompleteDataByEtiket",
			minLength: 2,
			select: function (event, ui) {
				event.preventDefault();
				$("#etiket_id").val(ui.item.id);
				$("#alis_faturaEtiketID").val(ui.item.value);
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
				element.classList.remove("d-none");';
	}
	if ($cari) {
		echo 'var element = document.getElementById("faturaBilgisiDiv");
				element.classList.remove("d-none");$("#faturaAltBilgisiDiv").css("display", "block");
				$("#stokBilgisiDiv").css("display", "block");
				$("#checkboxDiv").css("display", "block");
				$("#submitBtn").css("display", "block");';
	}
	?>


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
		var tip = $("#alis_faturaTip").val();
		if (tip != 4 && tip != 5 && tip != 6)
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


		/*
				debugger;
				var geneltopHidden=parseFloat($("#geneltopHidden").val());
				var genelindirimtop=0;
				var indirimHidden=parseFloat($("#indirimtopHidden").val());

				for (i = 1; i <= items_indirim; i++) {
					var tutar = $("#indirimtutar" + i + "").val();
					var hesap = $.trim(tutar).length;
					if (hesap != 0)
					{
						genelindirimtop= geneltopHidden*tutar/100;
						indirimHidden = indirimHidden + genelindirimtop;
						geneltopHidden = geneltopHidden-genelindirimtop;
					}
				}



				$("#indirimtopHidden").val(indirimHidden);
				$("#indirimtop").html(formatter.format(Number(indirimHidden.toFixed(2))) + " " + paraBirimiMetin);

				$("#geneltopHidden").val(geneltopHidden);
				$("#geneltop").html(formatter.format(Number(geneltopHidden.toFixed(2))) + " " + paraBirimiMetin);
		*/


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
			e.preventDefault();

			var stokID = $("input[name='stokid[]']").map(function () {
				return $(this).val();
			}).get();
			var stokMiktar = $("input[name='miktar[]']").map(function () {
				return $(this).val();
			}).get();

			$.ajax({
				url: "<?= env('BASE_URL'); ?>/fatura/alisFaturasiStokKontrol ",
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
		}
	});

	//döviz kuru işlemleri buradan
	$("#alis_paraBirimi").on('change', function () {
		var paraBirimiText = $("#alis_paraBirimi option:selected").text();
		var paraBirimi = $("#alis_paraBirimi option:selected").val();

		if (paraBirimi == 1) {
			$("#alis_guncelKur").css("display", "none");
			$("#alis_guncelKur").val("");
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

			$("#alis_guncelKur").css("display", "block");
			$.ajax({
				url: "<?= env('BASE_URL'); ?>/fatura/paraBirimiKontrol",
				method: "POST",
				data: {paraBirimi: paraBirimi},
				success: function (result) {
					toastr.success("Para birimi " + paraBirimiText + " olarak değiştirilmiştir. Güncel kur bilgileri ekrana yansıtılmıştır.");
					$("#alis_guncelKur").val(result);
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
		if ($("#istisna" + idsi).length != 0) {
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
			}
		});

		$('#my_table > #tbody > tr').eq(idsi - 1).after(html);

		$("#add_secim").val([]).change();
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


	$("#alis_faturaTip").on('change', function () {
		var val = $(this).val();
		$("#add_secim option[value='3']").remove();
		$('#iade_fatura_bilgi').attr('style', 'display:none;');
		$('#istisna_table').attr('style', 'display:none;');
		document.getElementById("istisna_sebebi").value = "0";
		document.getElementById("istisna_sebebi").required = false;


		var rowIade = document.getElementById("tbody_iade");
		rowIade.innerHTML = "";


		$("#iade_count").val(0);
		counter_iade = [];

		if (val != 4 && val != 5 && val != 6)
			vergimuafiyet();
		else {
			$("#vergiMuafiyet").css("display", "none");
			document.getElementById("vergiMuafiyet_sebep").required = false;
		}

		$('.ek_satir').remove();


		if (val == 1) {//satış

		} else if (val == 2) {//iade
			$('#iade_fatura_bilgi').attr('style', 'display:block;');

			addItemIade();
		} else if (val == 3) {//tevkifat

			var x = document.getElementById("add_secim");
			var option = document.createElement("option");
			option.text = "Tevkifat";
			option.value = "3";
			x.add(option);

		} else if (val == 4 || val == 6) {//istisna

			$('#istisna_table').attr('style', 'display:block;');

			document.getElementById("istisna_sebebi").required = true;
		} else if (val == 5) {//iade istisna


			$('#iade_fatura_bilgi').attr('style', 'display:block;');
			addItemIade();
			$('#istisna_table').attr('style', 'display:block;');

			document.getElementById("istisna_sebebi").required = true;
		}

	});


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
	function cariKontrol() {
		var kod_input = $("#kod_input").val();

		if (kod_input == "")
			$("#cariEkleBtn").attr('style', 'display:block;');
		else
			$("#cariEkleBtn").attr('style', 'display:none;');
	}

	function etiketKontrol() {
		var etiket_id = $("#etiket_id").val();
		var etiket_adi=$("alis_faturaEtiketID").val();
		if(!etiket_adi) {
			etiket_id = "";
			$("#etiket_id").val("");
		}


		if (etiket_id == "")
			$("#alis_faturaEtiketID").css("background-color", "#dff1e7");
		else
			$("#alis_faturaEtiketID").css("background-color", "#e9ecef");
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
/*
	$("#vergiNumarasi").on('blur', function () {
		let str = $("#vergiNumarasi").val();
		if (str.length == 11) {
			$("#c_soyad").css("display", "block");
			$("#cariSoyad").prop('required', true);
			$("#vergiDairesi").prop('required', false);
			$("#cari_eposta").prop('required', false);
			$("#cari_telefon").prop('required', false);
		} else {

			$("#vergiDairesi").prop('required', true);
			$("#c_soyad").css("display", "none");
			$("#cariSoyad").prop('required', false);
			$("#cari_eposta").prop('required', true);
			$("#cari_telefon").prop('required', true);
		}

		if (str.length == 10 || str.length == 11) {
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
					//let identifier = result.identifier;
					let title = result.title;
					if (alias != null) {
						if (str.length == 11) {
							$("#c_soyad").css("display", "block");
							var titleSplit = title.trim().split(' ');
							$("#cariSoyad").val(titleSplit[titleSplit.length - 1]);
							var ad = "";
							for (var i = 0; i < titleSplit.length - 1; i++) {
								ad += titleSplit[i] + " ";
							}
							$("#cariAd").val(ad.trim());
							$('#cariSoyad').prop('disabled', true);
						} else
							$("#cariAd").val(title);
						$("#alias_pk").val(alias);
						$("#mukellef_mark").css("display", "block");
						$('#cariAd').prop('disabled', true);

					} else {
						$("#cariAd").val("");
						$("#alias_pk").val("");
						//$('#myForm').trigger("reset");
						$("#mukellef_mark").css("display", "none");
						$('#cariAd').prop('disabled', false);
					}
					$(':input[type="submit"]').prop('disabled', false);
					$("#loading-image").hide();
				}
			});
		}

	});
*/


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
