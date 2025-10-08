<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<style>
	    .badge,.btn{font-size:11px !important;}
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

	<!-- Page Wrapper -->
	<div class="page-wrapper">
		<div class="content container-fluid">

			<!-- Page Header -->
			<div class="page-header">
				<div class="row">
					<div class="col-sm-10">
						<h3 class="page-title">Fatura</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
							</li>
							<li class="breadcrumb-item">Fatura
							</li>
							<li class="breadcrumb-item active">e-İrsaliye Giden Kutusu</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i>
							<br>Önceki Sayfa</a>
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			<?php
			$anaHesap = anaHesapBilgisi();

			$modul = modulSorgula($anaHesap, 1);

			$firma = getirFirma();
			$deletePermission = $firma->ayarlar_deletePermission;

			if ($_SERVER['QUERY_STRING']) {
				$qs = "?" . $_SERVER['QUERY_STRING'];
			}
			?>

			<div class="row">

				<div class="col-xl-12 col-md-12">
					<div class="card card-table">
						<div class="card-header">
							<div class="row">
								<div class="col">
									<h5 class="card-title">E-İrsaliye Giden Kutusu</h5>
								</div>
								<div class="col-auto">
									<a href="<?= base_url("fatura/satisFaturasiExcel$qs"); ?>"
									   class="btn btn-outline-success btn-sm"
									   style='font-family: Arial, Helvetica, sans-serif;'><i
											class="fa fa-file-excel"></i> Dışa aktar</a>
								</div>
								<div class="col-auto">
									<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm"
									   data-toggle="modal" data-target="#add_category"><i class="fa fa-search"></i>
										Arama</a>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0">
									<thead>
									<tr>
										<th style="width:11%;">Fatura Tarihi</th>
										<th style="width:11%;">Fatura No</th>
										<th style="width:11%;">Cari Adı</th>
										<th style="width:11%;">Genel Toplam</th>
										<th style="width:11%;">Durum</th>
										<th style="width:11%;">Fatura Zarf Durumu</th>
										<th class="text-right" style="width:11%;">İşlem</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($satisFaturasi as $sf) { ?>
										<?php
										$faturaDurum = $sf->satis_faturaDurum;
								        $faturaTip = $sf->satis_earsivfaturaTip;										        
								        $faturaGonderim = $sf->satis_earsivGonderimSekli;
								        $gibDurum="";

										if ($faturaDurum == 1) {
											$faturaDurumTxt = '<span class="badge bg-warning-light">Taslak</span>';
											$gibDurumTxt="";
										}
										else if ($faturaDurum == 2) {
										    $durumSorgu=GidenKutusuSorgu($sf->satis_faturaNo);
										    $durumSorgu=$durumSorgu->INVOICE_STATUS;
											$gibDurum=$durumSorgu->GIB_STATUS_CODE;
											$durum=$durumSorgu->STATUS;
											$durumSorguCode=$durumSorgu->STATUS_CODE;
										    $color="bg-success-light";

											if($durumSorguCode==100)
										        {$durum ="DURUM HENÜZ GÜNCELLENMEDİ";$color="bg-info-light";}
										    else if($durumSorguCode==101)
										        {$durumSorgu ="KUYRUĞA EKLENDİ";$color="bg-info-light";}
										    else if($durumSorguCode==102)
										        {$durum ="TASLAK İŞLENİYOR";$color="bg-info-light";}
											else if($durumSorguCode==103)
										        {$durum ="PAKETLENİYOR";$color="bg-info-light";}
											else if($durumSorguCode==104)
										        $durum ="PAKETLENDİ";
											else if($durumSorguCode==105)
										        {$durum ="PAKETLEME HATASI";$color="bg-danger-light";}
											else if($durumSorguCode==106)
										        {$durum ="İMZALANIYOR";$color="bg-info-light";}
										    else if($durumSorguCode==107)
										        $durum ="İMZALANDI";
										    else if($durumSorguCode==109)
										        {$durum ="GİB'DEN YANIT BEKLİYOR";$color="bg-info-light";}
										    else if($durumSorguCode==110)
										        {$durum ="ALICIDAN YANIT BEKLİYOR";$color="bg-info-light";}
										    else if($durumSorguCode==111)
										        {$durum ="ALICIDAN ONAY BEKLİYOR";$color="bg-info-light";}
										    else if($durumSorguCode==112)
										        $durum ="KABUL EDİLDİ";
										    else if($durumSorguCode==120)
										        $durum ="RET EDİLDİ";
										    else if($durumSorguCode==134)
										        {$durum ="ZAMAN AŞIMI OLUŞTU";$color="bg-danger-light";}
										    else if($durumSorguCode==135)
										        {$durum ="GÖNDERİLİYOR";$color="bg-info-light";}
										    else if($durumSorguCode==136)
										        {$durum ="GÖNDERME İŞLEMİ BAŞARISIZ";$color="bg-danger-light";}
										    else if($durumSorguCode==138)
										        $durum ="GÖNDERİLDİ";
											else if( $durumSorguCode==137)
												$durum ="GÖNDERİLDİ";
										    else if($durumSorguCode==139)
										        {$durum ="OTOMATİK GÖNDERİM HATASI";$color="bg-danger-light";}
										    else if($durumSorguCode==140)
										        {$durum ="FATURA NUMARASI ATANDI";$color="bg-info-light";}
										    else if($durumSorguCode==141)
										        {$durum ="FATURA NUMARASI ATANMA BEKLENİYOR";$color="bg-info-light";}
									        else
									            {$color="bg-danger-light";}

											$faturaDurumTxt = '<span class="badge '.$color.'">'.$durumSorguCode."-".$durum.'</span>';
											
											$color="bg-success-light";
											if($gibDurum==1000)
											    {$gibDurum="ZARF KUYRUĞA EKLENDİ";$color="bg-info-light";}
									        else if($gibDurum==1100)
										        {$gibDurum="ZARF İŞLENİYOR";$color="bg-info-light";}
									        else if($gibDurum==1110)
										        {$gibDurum="ZIP DOSYASI DEĞİL";$color="bg-danger-light";}
									        else if($gibDurum==1111)
										        {$gibDurum="ZARFZARF ID UZUNLUĞU GEÇERSİZ";$color="bg-danger-light";}
									        else if($gibDurum==1120)
										        {$gibDurum="	ZARF ARŞİVDEN KOPYALANAMADI	";$color="bg-danger-light";}
									        else if($gibDurum==1130)
										        {$gibDurum="ZIP AÇILAMADI";$color="bg-danger-light";}
									        else if($gibDurum==1131)
										        {$gibDurum="ZIP BİR DOSYA İÇERMELİ";$color="bg-danger-light";}
									        else if($gibDurum==1132)
										        {$gibDurum="XML DOSYASI DEĞİL";$color="bg-danger-light";}
									        else if($gibDurum==1133)
										        {$gibDurum="ZARF ID VE XML DOSYASININ ADI AYNI OLMALI";$color="bg-danger-light";}
									        else if($gibDurum==1140)
										        {$gibDurum="DOKUMAN AYRIŞTIRILAMADI";$color="bg-danger-light";}
									        else if($gibDurum==1141)
										        {$gibDurum="ZARF ID YOK";$color="bg-danger-light";}
									        else if($gibDurum==1142)
										        {$gibDurum="ZARF ID VE ZIP DOSYASI ADI AYNI OLMALI";$color="bg-danger-light";}
									        else if($gibDurum==1143)
										        {$gibDurum="GEÇERSİZ VERSİYON";$color="bg-danger-light";}
									        else if($gibDurum==1150)
										        {$gibDurum="SCHEMATRON KONTROL SONUCU HATALI";$color="bg-danger-light";}
									        else if($gibDurum==1160)
										        {$gibDurum="	XML SEMA KONTROLÜNDEN GEÇEMEDİ";$color="bg-danger-light";}
									        else if($gibDurum==1161)
										        {$gibDurum="İMZA SAHİBİ TCKN VKN ALINAMADI";$color="bg-danger-light";}
									        else if($gibDurum==1162)
										        {$gibDurum="İMZA KAYDEDİLEMEDİ";$color="bg-danger-light";}
									        else if($gibDurum==1163)
										        {$gibDurum="GÖNDERİLEN ZARF SİSTEMDE DAHA ÖNCE KAYITLI OLAN BİR FATURAYI İÇERMEKTEDİR";$color="bg-danger-light";}
									        else if($gibDurum==1170)
										        {$gibDurum="YETKİ KONTROL EDİLEMEDİ";$color="bg-danger-light";}
									        else if($gibDurum==1171)
										        {$gibDurum="GÖNDERİCİ BİRİM YETKİSİ YOK";$color="bg-danger-light";}
									        else if($gibDurum==1172)
										        {$gibDurum="POSTA KUTUSU YETKİSİ YOK";$color="bg-danger-light";}
									        else if($gibDurum==1175)
										        {$gibDurum="İMZA YETKİSİ KONTROL EDİLEMEDİ";$color="bg-danger-light";}
									        else if($gibDurum==1176)
										        {$gibDurum="İMZA SAHİBİ YETKİSİZ";$color="bg-danger-light";}
									        else if($gibDurum==1177)
										        {$gibDurum="GEÇERSİZ İMZA";$color="bg-danger-light";}
									        else if($gibDurum==1180)
										        {$gibDurum="ADRES KONTROL EDİLEMEDİ";$color="bg-danger-light";}
								          else if($gibDurum==1181)
										        {$gibDurum="ADRES BULUNAMADI";$color="bg-danger-light";}
									        else if($gibDurum==1182)
										        {$gibDurum="KULLANICI EKLENEMEDİ";$color="bg-danger-light";}
									        else if($gibDurum==1183)
										        {$gibDurum="KULLANICI SİLİNEMEDİ";$color="bg-danger-light";}
									        else if($gibDurum==1190)
										        {$gibDurum="SİSTEM YANITI HAZIRLANAMADI";$color="bg-danger-light";}
									        else if($gibDurum==1195)
										        {$gibDurum="SİSTEM HATASI";$color="bg-danger-light";}
									        else if($gibDurum==1200)
										        $gibDurum="ZARF BAŞARIYLA İŞLENDİ";
									        else if($gibDurum==1210)
										        {$gibDurum="DOKUMAN BULUNAN ADRESE GÖNDERİLEMEDİ";$color="bg-danger-light";}
									        else if($gibDurum==1215)
										        {$gibDurum="DOKÜMAN GÖNDERİMİ BAŞARISIZ. TEKRAR GÖNDERME SONLANDI";$color="bg-danger-light";}
									        else if($gibDurum==1220)
										        {$gibDurum="HEDEFTEN SİSTEM YANITI GELMEDİ";$color="bg-danger-light";}
									        else if($gibDurum==1230)
										        {$gibDurum="HEDEFTEN SİSTEM YANITI BAŞARISIZ GELDİ";$color="bg-danger-light";}
									        else if($gibDurum==1300)
										        $gibDurum="BAŞARIYLA TAMAMLANDI";
									        else if($gibDurum==-1)
										        {$gibDurum="FATURA GİB'E GÖNDERİLMEDİ";$color="bg-danger-light";}
										    else
										        $gibDurum=$gibDurum->STATUS_CODE;
											
											$gibDurumTxt = '<span class="badge '.$color.'">'.$durumSorgu->GIB_STATUS_CODE."-".$gibDurum.'</span>';
											
										}

										$cariID = $sf->satis_cariID;
										$cariQ = "SELECT cari_ad FROM cari WHERE cari_id = '$cariID'";
										$carie = $this->db->query($cariQ)->row();
										$cariAd = $carie->cari_ad;
										$cariPK = $carie->cari_alias_pk;
										$paraBirimi="TL";
										if($sf->satis_paraBirimi==2)
											$paraBirimi="USD";
										else if($sf->satis_paraBirimi==3)
											$paraBirimi="EUR";
										else if($sf->satis_paraBirimi==4)
											$paraBirimi="GBP";

										?>

										<tr>
											<td><?= date('d.m.Y', strtotime($sf->satis_irsaliyeTarihi)); ?></td>

											<td><?php if($faturaDurum==2){ echo '<img src="'.base_url("assets/img/efatura.png").'" style="width:30px;height:15px;">';}
												echo $sf->satis_faturaNo; ?></td>

											<td><a href="<?= base_url("cari/cari-hareketleri?cari=$cariID"); ?>"
												   target="_blank"><?= $cariAd; ?></a></td>
											<td><?= number_format($sf->satis_genelToplam, 2); ?> <?= $paraBirimi ?></td>
											<td><?= $faturaDurumTxt; ?></td>
											<td><?= $gibDurumTxt ?></td>
											<td class="text-right">
												<div class="dropdown show">
													<a class="dropdown-toggle" href="#" role="button"
													   id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
													   aria-expanded="false">
														<i class="fas fa-ellipsis-h"></i>
													</a>

													<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
												<?php if ($modul) {

													if($faturaDurum==1){?>
														<a href="<?= base_url("fatura/eirsaliye-olustur/".$sf->satis_id); ?>"
														   class="dropdown-item mr-2" style="color:green;"><i
																	class="far fa-edit mr-1"></i> Düzenle</a>
														<a href="<?= base_url(""); ?>"
														   class="dropdown-item  mr-2"
														   data-toggle="modal" data-target="#gonder"
														   data-id="<?= $sf->satis_id; ?>" style="color:blue;"><i
																class="far fa-paper-plane mr-1"></i> Gönder</a>
														<?php if ($deletePermission == 1) { ?>
															<a href="javascript:void(0);" data-toggle="modal"
															   data-target="#fatura_sil"
															   onclick="document.getElementById('fatura_id').value='<?= $sf->satis_id ?>';document.getElementById('fatura_no').innerHTML='Seçilen faturayı silmek istediğinizden emin misiniz?';"
															   class="dropdown-item text-danger mr-2"><i
																		class="far fa-trash-alt mr-1"></i> Sil</a>
														<?php } ?>
													<?php }else {?>

														<a href="<?=  base_url('Edonusum/Efatura/GetInvoiceWithType/' . $sf->satis_faturaNo . '/1/efaturaGelen/OUT/1') ?> " class='dropdown-item text-info mr-2' target='_blank'><i
																	class="far fa-eye mr-1"></i>Göster</a>
														<a href="<?= base_url("Edonusum/Efatura/GetInvoiceWithType/".$sf->satis_faturaNo."/1/efaturaGiden/OUT"); ?>"
														   class="dropdown-item text-info mr-2"><i
																class="fa fa-download mr-1"></i> HTML</a>
														<a href="<?= base_url("Edonusum/Efatura/GetInvoiceWithType/".$sf->satis_faturaNo."/2/efaturaGiden/OUT")?>" class="dropdown-item text-info mr-2"><i
																class="fa fa-download mr-1"></i> XML</a>
													<?php }}?>
													</div>
												</div>
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
								<hr>
								<span style="margin-left:15px;">Toplam kayıt sayısı:</span>
								<b><?= $count_of_list; ?></b>
								<br><br>
							</div>
						</div>
					</div>
					<?php echo $links; ?>
					<br><br>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Wrapper -->
	<?php
	$faturaNo = $this->input->get('faturaNo');
	//$irsaliyeNo = $this->input->get('irsaliyeNo');
	$etiket = $this->input->get('etiket');
	//$cariAdi = $this->input->get('cariAdi');
	$tarihAraligi = $this->input->get('tarihAraligi');
	$siralama = $this->input->get('siralama');
	?>
	<!-- Add Category Modal -->
	<div id="add_category" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">E-İrsaliye Arama</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url("fatura/satis-faturasi-listesi"); ?>" method="GET">
						<div class="form-group">
							<label>Kayıt Tarihi Aralığına Göre </label>
							<input class="form-control" id="daterange" type="text" name="tarihAraligi"
								   value="<?= $tarihAraligi; ?>" autocomplete="off"/>
						</div>
						<div class="form-group">
							<label>Fatura No'ya Göre </label>
							<input class="form-control" type="text" name="faturaNo" value="<?= $faturaNo; ?>"
								   autocomplete="off">
						</div>
						<!--<div class="form-group">
							<label>İrsaliye No'ya Göre </label>
							<input class="form-control" type="text" name="irsaliyeNo" value="<?= $irsaliyeNo; ?>"
								   autocomplete="off">
						</div>-->
						<?php
						$anaHesap = anaHesapBilgisi();
						$sqlEtiket = "SELECT * FROM etiketler WHERE etiket_olusturanAnaHesap = '$anaHesap'";
						$etiketler = $this->db->query($sqlEtiket)->result();
						?>
						<div class="form-group">
							<label>Etiket Adına Göre </label>
							<select name="etiket" class="form-control">
								<option value="">Etiket adı seçiniz...</option>
								<?php foreach ($etiketler as $item) { ?>
									<option value="<?= $item->etiket_id; ?>" <?php if ($item->etiket_id == $etiket) {
										echo "selected";
									} ?>><?= $item->etiket_adi; ?></option>
								<?php } ?>
							</select>
						</div>
						<hr>

						<div class="form-group">
							<label>Sıralama </label>
							<select class="select form-control" name="siralama">
								<option value="">Seçiniz...</option>
								<option value="1" <?php if ($siralama == 1) {
									echo "selected";
								} ?>>Tarih büyükten küçüğe
								</option>
								<option value="2" <?php if ($siralama == 2) {
									echo "selected";
								} ?>>Tarih küçükten büyüğe
								</option>
							</select>
						</div>
						<div class="submit-section">
							<button class="btn btn-danger submit-btn">Ara</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /Add Category Modal -->

	<div id="fatura_sil" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">E-İrsaliye Silme</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url("fatura/efatura_sil"); ?>" method="GET">
						<input type="hidden" name="fatura_id" id="fatura_id" value="">
						<p id="fatura_no"></p>
						<div class="submit-section">
							<button class="btn btn-danger submit-btn">Sil</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php
		$seriFatura = $this->db->query("SELECT * FROM seriYonetimi WHERE seri_olusturanAnaHesap = '$anaHesap' AND seri_urun = 3")->result();
	?>

	<!-- Add Category Modal -->
	<div id="gonder" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Seri Ön Eki Seçimi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url("Edonusum/Eirsaliye/SendDespatchAdvice"); ?>" method="POST">

						<input type="hidden" name="satis_id" id="satis_id">

						<div class="form-group" id="normal_onek" >
							<label>Seri Ön Eki </label>
							<select class="form-control select" name="normal" id="normal">
								<option value="">Seçiniz...</option>
								<?php foreach ($seriFatura as $si) { ?>
									<option value="<?= $si->seri_id; ?>"><?= $si->seri_seriOnEki; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="submit-section">
							<button class="btn btn-danger submit-btn" style="width:100%;">Gönder</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /Add Category Modal -->

</div>
<!-- /Main Wrapper -->

<?php if ($this->session->flashdata('fatura_ok')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "E-Fatura eklenmiştir.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>


<?php if ($this->session->flashdata('fatura_donusturuldu')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Satış faturası e-faturaya dönüştürülmüştür.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>


<?php if ($this->session->flashdata('fatura-yuklendi')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "E-Fatura Yüklendi.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('fatura_gonder_ok')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "E-Fatura gönderilmiştir.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>


<?php if ($this->session->flashdata('fatura_gonder_error')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "warning",
			text: "E-Fatura gönderilememiştir. Hata: <?= $this->session->flashdata('error') ?>",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('fatura_goster_error')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "warning",
			text: "E-Fatura gösterme işlemi başarısız. Hata: <?= $this->session->flashdata('error') ?>",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('fatura_liste_error')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "warning",
			text: "E-Fatura listeleme işlemi başarısız. Hata: <?= $this->session->flashdata('error') ?>",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('fatura_xslt_error')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "warning",
			text: "E-fatura göndermek için bir şablon yükleyin.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('seri_ikibos')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Seri ön eki seçimi yapılması gerekmektedir.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('seri_ikidolu')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "E-Fatura Tipine göre sadece bir tane seri ön eki seçimi yapabilirsiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('irsaliye_gonder_ok')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "E-İrsaliye gönderilmiştir.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php $this->load->view("include/footer-js"); ?>
<!-- Select2 JS -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>

<script>
	$(function () {
		moment.locale('tr');
		$('#daterange').daterangepicker({
			opens: 'left',
			autoUpdateInput: false
		}, function (start, end, label) {
			$('#daterange').val(start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY'));
			//console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
		});
	});
</script>

<script>
	$('#gonder').on('show.bs.modal', function (event) {
		let id = $(event.relatedTarget).data('id')
		$(this).find('.modal-body #satis_id').val(id)
	})
</script>

<script>
	$(document).ready(function () {
		$('#normal').change(function () {
			let normal = $(this).val();
			if (normal) {
				$('#internet').attr('disabled', 'disabled');
			} else {
				$('#internet').removeAttr('disabled');
			}
		});

		$('#internet').change(function () {
			let internet = $(this).val();
			if (internet) {
				$('#normal').attr('disabled', 'disabled');
			} else {
				$('#normal').removeAttr('disabled');
			}
		});
	});
</script>

</body>
</html>
