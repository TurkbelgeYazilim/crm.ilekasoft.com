<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<style>
		.table-bordered td,.table-bordered th{
			width: 5%;
			white-space: normal;
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

	<?php
	$anaHesap = anaHesapBilgisi();
	$ayarlarQ = "SELECT * FROM ayarlar WHERE ayarlar_id = '$anaHesap' ";
	$ayarlarExe = $this->db->query($ayarlarQ)->row();

	$faturaTipi = $this->input->get("tipi");
	$faturaID = $this->input->get("id");
	if ($faturaTipi == "satis") {
		if ($fatura->satis_earsivfaturaTip == 1)
			$tip = "SATIŞ";
		else if ($fatura->satis_earsivfaturaTip == 2)
			$tip = "İADE";
		else if ($fatura->satis_earsivfaturaTip == 3)
			$tip = "TEVKİFAT";
		else if ($fatura->satis_earsivfaturaTip == 4)
			$tip = "İSTİSNA";
		else if ($fatura->satis_earsivfaturaTip == 5)
			$tip = "İADE İSTİSNA";
		else if ($fatura->satis_earsivfaturaTip == 6)
			$tip = "ÖZEL MATRAH";
		if ($fatura->satis_paraBirimi == 1)
			$paraBirimi = "TL";
		else if ($fatura->satis_paraBirimi == 2)
			$paraBirimi = "USD";
		else if ($fatura->satis_paraBirimi == 3)
			$paraBirimi = "EUR";
		else if ($fatura->satis_paraBirimi == 4)
			$paraBirimi = "GBP";
	} else if($faturaTipi == "alis") {
		if ($fatura->alis_faturaTipi == 1)
			$tip = "SATIŞ";
		else if ($fatura->alis_faturaTipi == 2)
			$tip = "İADE";
		else if ($fatura->alis_faturaTipi == 3)
			$tip = "TEVKİFAT";
		else if ($fatura->alis_faturaTipi == 4)
			$tip = "İSTİSNA";
		else if ($fatura->alis_faturaTipi == 5)
			$tip = "İADE İSTİSNA";
		else if ($fatura->alis_faturaTipi == 6)
			$tip = "ÖZEL MATRAH";
		if ($fatura->alis_paraBirimi == 1)
			$paraBirimi = "TL";
		else if ($fatura->alis_paraBirimi == 2)
			$paraBirimi = "USD";
		else if ($fatura->alis_paraBirimi == 3)
			$paraBirimi = "EUR";
		else if ($fatura->alis_paraBirimi == 4)
			$paraBirimi = "GBP";
	} else if($faturaTipi == "proforma") {
		if ($fatura->proforma_faturaTipi == 1)
			$tip = "SATIŞ";
		else if ($fatura->proforma_faturaTipi == 2)
			$tip = "İADE";
		else if ($fatura->proforma_faturaTipi == 3)
			$tip = "TEVKİFAT";
		else if ($fatura->proforma_faturaTipi == 4)
			$tip = "İSTİSNA";
		else if ($fatura->proforma_faturaTipi == 5)
			$tip = "İADE İSTİSNA";
		else if ($fatura->proforma_faturaTipi == 6)
			$tip = "ÖZEL MATRAH";
		if ($fatura->proforma_paraBirimi == 1)
			$paraBirimi = "TL";
		else if ($fatura->proforma_paraBirimi == 2)
			$paraBirimi = "USD";
		else if ($fatura->proforma_paraBirimi == 3)
			$paraBirimi = "EUR";
		else if ($fatura->proforma_paraBirimi == 4)
			$paraBirimi = "GBP";
	}
	?>

	<!-- Page Wrapper -->
	<div class="page-wrapper">
		 <input type="button" onclick="printDiv('printableArea')" value="Yazdır / PDF olarak Kaydet" class="btn btn-primary mt-2" style="float: right;"/>
		<div class="content container-fluid" id="printableArea">
			<div class="row justify-content-center">
				<div class="col-xl-9">
					<div class="card">
						<div class="card-body">
							<div class="invoice-item">
								<div class="row">
									<div class="col-md-6">
										<div class="invoice-logo">


											<?php if ($ayarlarExe->ayarlar_logoName) { ?>
												<img src="<?= base_url(); ?>assets/bulut/logo/<?= $ayarlarExe->ayarlar_logoName; ?>"
													 style="max-height: 102px!important;">
											<?php } ?>

										</div>
									</div>
									<div class="col-md-6">
										<p class="invoice-details">
											<?php if ($faturaTipi == "proforma") {?> <strong class="border-bottom">Proforma Fatura </strong><br><?php }  ?>
										<strong>Fatura Tipi:</strong> <?php echo $tip; ?> <br> 
											<strong>Fatura	No:</strong>  <?php 
											if($faturaTipi == "satis") echo $fatura->satis_faturaNo;
											else if($faturaTipi=="alis") echo $fatura->alis_faturaNo;
											else if($faturaTipi=="proforma") echo $fatura->proforma_faturaNo;
											?>
											<br>
											<strong>Fatura Tarihi:</strong> <?php 
											if($faturaTipi == "satis") echo dateFormatConvert($fatura->satis_faturaTarihi, 1);
											else if($faturaTipi=="alis") echo dateFormatConvert($fatura->alis_faturaTarihi, 1);
											else if($faturaTipi=="proforma") echo dateFormatConvert($fatura->proforma_faturaTarihi, 1);
											?>  
											<br>
											<strong>Düzenleme
												Saati:</strong> 
											<?php
											if($faturaTipi == "satis") echo $fatura->satis_olusturmaSaati;
											else if($faturaTipi=="alis") echo $fatura->alis_olusturmaSaati;
											else if($faturaTipi=="proforma") echo $fatura->proforma_olusturmaSaati;
											?> 
										</p>
									</div>
								</div>
							</div>

							<br>

							<!-- Invoice Item -->
							<div class="invoice-item">
								<div class="row">
									<div class="col-md-6">
										<div class="invoice-info">
											<strong class="customer-text" style="opacity:0;">.</strong>
											<p class="invoice-details invoice-details-two">
												<?= $ayarlarExe->ayarlar_firmaAd; ?> <br>
												<?= $ayarlarExe->ayarlar_adres; ?><br>
											</p> 
										</div>
									</div>
									<div class="col-md-6">
										<div class="invoice-info invoice-info2">
											<strong class="customer-text">SAYIN</strong>
											<p class="invoice-details">
												<?= $cari->cari_ad; ?> <br>
												<?= $cari->cari_adres; ?> <br>
											</p>
										</div>
									</div>
								</div>
							</div>
							<!-- /Invoice Item -->
<?php $satisExe = $this->db->query("SELECT * FROM satisFaturasi WHERE satis_id = '$faturaID'")->row();?>
							<!-- Invoice Item -->
							<div class="invoice-item">
								<div class="row">
									<div class="col-md-8">
										<div class="invoice-info">
											<strong class="customer-text">Ödeme Bilgileri</strong>
											<p class="invoice-details invoice-details-two">
												<?= $ayarlarExe->ayarlar_iban; ?> <br>
												<?= $ayarlarExe->ayarlar_sube; ?> - <?= $ayarlarExe->ayarlar_hesapno; ?>
												<br>
												<?= $ayarlarExe->ayarlar_bankaadi; ?><br>
											</p>
										</div>
									</div>

									<div class="col-md-4">
										<div class="invoice-info">
										    <!-- değişiklik yaptım -->
											<strong class="customer-text">Notlar</strong>
										<!--	<p style="font-size:13px;">·Bu belge fatura yerine geçmez.Sadece fiyat teklifidir.</p>
											     	<p style="font-size:13px;">·İşbu fiyatlar ................ tarihine kadar geçerlidir.</p>
											     	<p style="font-size:13px;">·Yukarıda beyan edilen FOB fiyatıdır.</p>
											     	<p style="font-size:13px;">·Ödeme şekli LC(akreditifli)</p> -->
											
											<p class="invoice-details invoice-details-two">
												<?= $satisExe->satis_aciklama; ?> 
											</p>
										</div>
									</div>
								</div>
							</div>
							<!-- /Invoice Item -->

							<?php
							if ($faturaTipi == "satis") {
								$satisFaturasiStokQ = "SELECT * FROM satisFaturasiStok WHERE satisStok_satisFaturasiID = '$faturaID'";
								$satisFaturasiStokExe = $this->db->query($satisFaturasiStokQ)->result();
							} else if ($faturaTipi == "alis") {
								$alisFaturasiStokQ = "SELECT * FROM alisFaturasiStok WHERE alisStok_alisFaturasiID = '$faturaID'";
								$alisFaturasiStokExe = $this->db->query($alisFaturasiStokQ)->result();
							} else if ($faturaTipi == "proforma") {
								$proformaFaturasiStokQ = "SELECT * FROM proformaFaturasiStok WHERE proformaStok_proformaFaturasiID = '$faturaID'";
								$proformaFaturasiStokExe = $this->db->query($proformaFaturasiStokQ)->result();
							} else {
								echo "hata";
							}
							?>
							<!-- Invoice Item -->
							<div class="invoice-item invoice-table-wrap">
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
											<table class="invoice-table table table-bordered">
												<thead>
												<tr>
													<th>Malzeme/Hizmet Açıklaması</th>
													<th class="text-center">Miktar</th>
													<th class="text-center">Birim Fiyat</th>
													<th class="text-center">KDV Oranı</th>
													<th class="text-center">KDV Tutarı</th>
													<?php
													if ($fatura->satis_indirimToplam != 0 || $fatura->alis_indirimToplam != 0 || $fatura->proforma_indirimToplam != 0)  { ?>
														<th class="text-center">İndirim Oranı</th>
														<th class="text-center">İndirim Tutarı</th>
													<?php }  ?>
													<?php if ($fatura->satis_earsivfaturaTip == 3 || $fatura->alis_faturaTipi == 3 || $fatura->proforma_faturaTipi == 3) { ?>
														<th class="text-center">Diğer Vergiler</th>
													<?php } ?>
													<th class="text-right">Mal Hizmet Tutarı</th>
												</tr>
												</thead>
												<tbody>
												<?php
												if ($faturaTipi == "satis") {
													foreach ($satisFaturasiStokExe as $sfsexe) {
														$stokQ = "SELECT * FROM stok WHERE stok_id = $sfsexe->satisStok_stokID";
														$stokExe = $this->db->query($stokQ)->row();

														$stokBirimQ = "SELECT * FROM stokBirimleri WHERE stokBirim_id = '$stokExe->stok_birimID'";
														$stokBirimExe = $this->db->query($stokBirimQ)->row();

														$satisFaturasiQ = "SELECT * FROM satisFaturasi WHERE satis_id = '$faturaID'";
														$satisFaturasiExe = $this->db->query($satisFaturasiQ)->row();

														$tevkifatQ = "select * from tevkifatKodlari inner join satisFaturasiStok on tevkifatKodlari.tevkifat_id=satisFaturasiStok.satisStok_tevkifat_id where satisStok_tevkifat_id=" . $sfsexe->satisStok_tevkifat_id;
														$tevkifatExe = $this->db->query($tevkifatQ)->row();


														$malHizmetTutari = $sfsexe->satisStok_miktar * $sfsexe->satisStok_birimFiyat;

														$kdv = $sfsexe->satisStok_kdv;

														if ($kdv == 0) {
															$yeniKDV = 0;
														} else if ($kdv == 1) {
															$yeniKDV = 0.01;
														} else if ($kdv == 8) {
															$yeniKDV = 0.08;
														} else if ($kdv == 18) {
															$yeniKDV = 0.18;
														}

														$kdvTutari = $malHizmetTutari * $yeniKDV;

														$araToplam = $satisFaturasiExe->satis_araToplam;
														$toplamIskonto = $satisFaturasiExe->satis_indirimToplam;
														$netTutar = $satisFaturasiExe->satis_netTutar;
														$kdvToplam = $satisFaturasiExe->satis_kdvToplam;
														$kdvTevkifatToplam = $satisFaturasiExe->satis_tevkifatToplam;
														$vergiDahil = $satisFaturasiExe->satis_vergiDahilToplam;
														$genelToplam = $satisFaturasiExe->satis_genelToplam;
														?>
														<tr>
															<td><?= $stokExe->stok_ad; ?></td>
															<td class="text-center"><?= $sfsexe->satisStok_miktar; ?> <?= $stokBirimExe->stokBirim_ad; ?></td>
															<td class="text-center"><?= $sfsexe->satisStok_birimFiyat . " " . $paraBirimi; ?> </td>
															<td class="text-right">
																% <?= number_format($kdv, 2); ?></td>
															<td class="text-right"><?= $kdvTutari . " " . $paraBirimi ?> </td>
															<?php if ($fatura->satis_indirimToplam != 0) { ?>
																<td class="text-right"><?= number_format($sfsexe->satisStok_indirimTutari, 2); ?></td>

																<td class="text-right"><?= $sfsexe->satisStok_satirIskonto . " " . $paraBirimi ?> </td>
															<?php } ?>
															<?php
															if ($fatura->satis_earsivfaturaTip == 3) {
																?>
																<td class="text-right">
																	<?php if ($tevkifatExe->tevkifat_orani != 0) { ?>
																		KDV TEVKİFAT (%<?php echo $tevkifatExe->tevkifat_orani * 100; ?>,00)=<?php echo $kdvTutari * $tevkifatExe->tevkifat_orani . " " . $paraBirimi;
																	} ?> </td>
															<?php } ?>
															<td class="text-right"><?= $malHizmetTutari . " " . $paraBirimi ?></td>
														</tr>
													<?php }
												} else if ($faturaTipi == "alis") {
													foreach ($alisFaturasiStokExe as $afse) {

														$stokQ = "SELECT * FROM stok WHERE stok_id = $afse->alisStok_stokID";
														$stokExe = $this->db->query($stokQ)->row();

														$stokBirimQ = "SELECT * FROM stokBirimleri WHERE stokBirim_id = '$stokExe->stok_birimID'";
														$stokBirimExe = $this->db->query($stokBirimQ)->row();

														$alisFaturasiQ = "SELECT * FROM alisFaturasi WHERE alis_id = '$faturaID'";
														$alisFaturasiExe = $this->db->query($alisFaturasiQ)->row();


														$tevkifatQ = "select * from tevkifatKodlari inner join alisFaturasiStok on tevkifatKodlari.tevkifat_id=alisFaturasiStok.alisStok_tevkifat_id where alisStok_tevkifat_id=" . $afse->alisStok_tevkifat_id;
														$tevkifatExe = $this->db->query($tevkifatQ)->row();

														$malHizmetTutari = $afse->alisStok_miktar * $afse->alisStok_birimFiyat;

														$kdv = $afse->alisStok_kdv;

														if ($kdv == 0) {
															$yeniKDV = 0;
														} else if ($kdv == 1) {
															$yeniKDV = 0.01;
														} else if ($kdv == 8) {
															$yeniKDV = 0.08;
														} else if ($kdv == 18) {
															$yeniKDV = 0.18;
														}

														$kdvTutari = $malHizmetTutari * $yeniKDV;

														$araToplam = $alisFaturasiExe->alis_araToplam;
														$toplamIskonto = $alisFaturasiExe->alis_indirimToplam;
														$netTutar = $alisFaturasiExe->alis_netTutar;
														$kdvToplam = $alisFaturasiExe->alis_kdvToplam;
														$kdvTevkifatToplamToplam = $alisFaturasiExe->alis_tevkifatToplam;
														$vergiDahil = $alisFaturasiExe->alis_vergiDahilToplam;
														$genelToplam = $alisFaturasiExe->alis_genelToplam;

														?>
														<tr>
															<td><?= $stokExe->stok_ad; ?></td>
															<td class="text-center"><?= $afse->alisStok_miktar; ?> <?= $stokBirimExe->stokBirim_ad; ?></td>
															<td class="text-center"><?= $afse->alisStok_birimFiyat . " " . $paraBirimi; ?></td>
															<td class="text-right">
																% <?= number_format($kdv, 2); ?></td>
															<td class="text-right"><?= $kdvTutari . " " . $paraBirimi ?></td>
															<?php if ($fatura->alis_indirimToplam != 0) { ?>
																<td class="text-right"><?= number_format($afse->alisStok_indirimTutari, 2); ?></td>

																<td class="text-right"><?= $afse->alisStok_satirIskonto . " " . $paraBirimi ?> </td>
															<?php } ?>
															<?php
															if ($fatura->satis_earsivfaturaTip == 3) {
																?>
																<td class="text-right">
																	<?php if ($tevkifatExe->tevkifat_orani != 0) { ?>
																		KDV TEVKİFAT (%<?php echo $tevkifatExe->tevkifat_orani * 100; ?>,00)=<?php echo $kdvTutari * $tevkifatExe->tevkifat_orani . " " . $paraBirimi;
																	} ?> </td>
															<?php } ?>
															<td class="text-right"><?= $malHizmetTutari . " " . $paraBirimi ?></td>
														</tr>
													<?php }
												} else if ($faturaTipi == "proforma") {
													foreach ($proformaFaturasiStokExe as $afse) {

														$stokQ = "SELECT * FROM stok WHERE stok_id = $afse->proformaStok_stokID";
														$stokExe = $this->db->query($stokQ)->row();

														$stokBirimQ = "SELECT * FROM stokBirimleri WHERE stokBirim_id = '$stokExe->stok_birimID'";
														$stokBirimExe = $this->db->query($stokBirimQ)->row();

														$alisFaturasiQ = "SELECT * FROM proformaFaturasi WHERE proforma_id = '$faturaID'";
														$alisFaturasiExe = $this->db->query($alisFaturasiQ)->row();


														$tevkifatQ = "select * from tevkifatKodlari inner join proformaFaturasiStok on tevkifatKodlari.tevkifat_id=proformaFaturasiStok.proformaStok_tevkifat_id where proformaStok_tevkifat_id=" . $afse->proformaStok_tevkifat_id;
														$tevkifatExe = $this->db->query($tevkifatQ)->row();

														$malHizmetTutari = $afse->proformaStok_miktar * $afse->proformaStok_birimFiyat;

														$kdv = $afse->proformaStok_kdv;

														if ($kdv == 0) {
															$yeniKDV = 0;
														} else if ($kdv == 1) {
															$yeniKDV = 0.01;
														} else if ($kdv == 8) {
															$yeniKDV = 0.08;
														} else if ($kdv == 18) {
															$yeniKDV = 0.18;
														}

														$kdvTutari = $malHizmetTutari * $yeniKDV;

														$araToplam = $alisFaturasiExe->proforma_araToplam;
														$toplamIskonto = $alisFaturasiExe->proforma_indirimToplam;
														$netTutar = $alisFaturasiExe->proforma_netTutar;
														$kdvToplam = $alisFaturasiExe->proforma_kdvToplam;
														$kdvTevkifatToplamToplam = $alisFaturasiExe->proforma_tevkifatToplam;
														$vergiDahil = $alisFaturasiExe->proforma_vergiDahilToplam;
														$genelToplam = $alisFaturasiExe->proforma_genelToplam;

														?>
														<tr>
															<td><?= $stokExe->stok_ad; ?></td>
															<td class="text-center"><?= $afse->proformaStok_miktar; ?> <?= $stokBirimExe->stokBirim_ad; ?></td>
															<td class="text-center"><?= $afse->proformaStok_birimFiyat . " " . $paraBirimi; ?></td>
															<td class="text-right">
																% <?= number_format($kdv, 2); ?></td>
															<td class="text-right"><?= $kdvTutari . " " . $paraBirimi ?></td>
															<?php if ($fatura->proforma_indirimToplam != 0) { ?>
																<td class="text-right"><?= number_format($afse->proformaStok_indirimTutari, 2); ?></td>

																<td class="text-right"><?= $afse->proformaStok_satirIskonto . " " . $paraBirimi ?> </td>
															<?php } ?>
															<?php
															if ($fatura->proforma_faturaTipi == 3) {
																?>
																<td class="text-right">
																	<?php if ($tevkifatExe->tevkifat_orani != 0) { ?>
																		KDV TEVKİFAT (%<?php echo $tevkifatExe->tevkifat_orani * 100; ?>,00)=<?php echo $kdvTutari * $tevkifatExe->tevkifat_orani . " " . $paraBirimi;
																	} ?> </td>
															<?php } ?>
															<td class="text-right"><?= $malHizmetTutari . " " . $paraBirimi ?></td>
														</tr>
													<?php }
												}else {
													echo "hata";
												} ?>
												</tbody>
											</table>
										</div>
									</div>

									<div class="col-md-6 col-xl-4 ml-auto mt-4">
										<div class="table-responsive">
											<table class="invoice-table-two table">
												<tbody>
												<tr>
													<th>Ara Toplam:</th>
													<td><span><?= $araToplam . " " . $paraBirimi ?></span></td>
												</tr>
												<?php if ($toplamIskonto != 0) { ?>
													<tr>
														<th>Toplam İskonto:</th>
														<td><span><?= $toplamIskonto . " " . $paraBirimi ?></span></td>
													</tr>
												<?php } ?>
												<tr>
													<th>Net Tutar:</th>
													<td><span><?= $netTutar . " " . $paraBirimi ?></span></td>
												</tr>
												<tr>
													<th>KDV:</th>
													<td><span><?= $kdvToplam . " " . $paraBirimi ?></span></td>
												</tr>
												<?php if ($kdvTevkifatToplam != 0) { ?>
													<tr>
														<th>KDV Tevkifat:</th>
														<td><span><?= $kdvTevkifatToplam . " " . $paraBirimi ?></span>
														</td>
													</tr>
												<?php } ?>
												<tr>
													<th>Vergi Dahil Ödenecek Tutar:</th>
													<td><span><?= $vergiDahil . " " . $paraBirimi ?></span></td>
												</tr>
												<tr>
													<th>Genel Toplam:</th>
													<td><span><?= $genelToplam . " " . $paraBirimi ?></span></td>
												</tr>
												</tbody>
											</table>
										</div>
									</div>


								</div>
							</div>
							<!-- /Invoice Item -->

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

<script>
	function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
	}
</script>

</body>
</html>
