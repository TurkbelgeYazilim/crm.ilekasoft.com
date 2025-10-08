<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
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
							<li class="breadcrumb-item active">e-Arşiv Faturaları</li>
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
									<h5 class="card-title">E-Arşiv Fatura Listesi</h5>
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
										<th>Fatura Tarihi</th>
										<th>Etiket</th>
										<th>Fatura No</th>
										<th>Cari Adı</th>
										<th>Genel Toplam</th>
										<th>Tip</th>
										<th>Durum</th>
										<th class="text-right">İşlem</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($satisFaturasi as $sf) { ?>
										<?php
										$faturaDurum = $sf->satis_faturaDurum;
										$faturaTip = $sf->satis_earsivfaturaTip;
										$faturaTur = $sf->satis_earsivTipi;
										$faturaGonderim = $sf->satis_earsivGonderimSekli;


										if ($faturaTur == 1) {
											$faturaTurTxt = '<span class="badge ">NORMAL</span>';
											$onclick="$('#normal_onek').attr('style', 'display:block;');$('#internet_onek').attr('style', 'display:none;');";
										} else if ($faturaTur == 2) {
											$faturaTurTxt = '<span class="badge ">İNTERNET </span>';
											$onclick="$('#internet_onek').attr('style', 'display:block;');$('#normal_onek').attr('style', 'display:none;');";
										}

										if ($faturaTip == 1) {
											$faturaTipTxt = '<span class="badge ">Satış</span>';
										} else if ($faturaTip == 2) {
											$faturaTipTxt = '<span class="badge ">İade</span>';
										} else if ($faturaTip == 3) {
											$faturaTipTxt = '<span class="badge ">Tevkifat</span>';
										}else if ($faturaTip == 4) {
											$faturaTipTxt = '<span class="badge ">İstisna</span>';
										}else if ($faturaTip == 5) {
											$faturaTipTxt = '<span class="badge ">İade İstisna</span>';
										}

										if ($faturaDurum == 1) {
											$faturaDurumTxt = '<span class="badge bg-warning-light">Taslak</span>';
										}
										else if ($faturaDurum == 2) {
										$faturaDurumTxt = '<span class="badge bg-success-light">Gönderildi</span>';
									}

										$cariID = $sf->satis_cariID;
										$cariQ = "SELECT cari_ad,cari_soyad FROM cari WHERE cari_id = '$cariID'";
										$carie = $this->db->query($cariQ)->row();
										$cariAd = $carie->cari_ad." ".$carie->cari_soyad;
										$cariPK = $carie->cari_alias_pk;
										$paraBirimi="TL";
										if($sf->satis_paraBirimi==2)
											$paraBirimi="USD";
										else if($sf->satis_paraBirimi==3)
											$paraBirimi="EUR";
										else if($sf->satis_paraBirimi==4)
											$paraBirimi="GBP";


										if ($sf->satis_faturaEtiketID != null) {

											$sqlEtiket = "select  * from etiketler where etiket_id=" . $sf->satis_faturaEtiketID . "";
											$exeEtiket = $this->db->query($sqlEtiket)->row();
											$etiketAdi=$exeEtiket->etiket_adi;
										}
										else
										{
											$etiketAdi="";
										}
										?>

										<tr>
											<td><?= date('d.m.Y', strtotime($sf->satis_faturaTarihi)); ?></td>
											<td><?= $etiketAdi ?></td>
											<td><?= $sf->satis_faturaNo; ?></td>

											<td><a href="<?= base_url("cari/cari-hareketleri?cari=$cariID"); ?>"
												   target="_blank"><?= $cariAd; ?></a></td>
											<td><?= number_format($sf->satis_genelToplam, 2); ?> <?= $paraBirimi ?></td>
											<td><?= $faturaTipTxt; ?></td>
											<td><?= $faturaDurumTxt; ?></td>
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
														<a href="<?= base_url("fatura/earsiv-olustur/".$sf->satis_id); ?>"
														   class="dropdown-item mr-2" style="color:green;"><i
																	class="far fa-edit mr-1"></i> Düzenle</a>
													<a href="<?= base_url(""); ?>"
													   class="dropdown-item mr-2"
													   data-toggle="modal" data-target="#gonder"
													   data-id="<?= $sf->satis_id; ?>" onclick=" <?= $onclick?>" style="color:blue;"><i
																class="far fa-paper-plane mr-1"></i> Gönder</a>
														<?php if ($deletePermission == 1) { ?>
															<a href="javascript:void(0);" data-toggle="modal"
															   data-target="#fatura_sil"
															   onclick="document.getElementById('fatura_id').value='<?= $sf->satis_id ?>';document.getElementById('fatura_no').innerHTML='Seçilen faturayı silmek istediğinizden emin misiniz?';"
															   class="dropdown-item text-danger mr-2"><i
																		class="far fa-trash-alt mr-1"></i> Sil</a>
														<?php } ?>
												<?php }else {?>
														<a href="<?= base_url("fatura/goruntule?tipi=satis&id=$sf->satis_id"); ?>"
														   class="dropdown-item text-info mr-2"><i
																	class="far fa-eye mr-1"></i> Görüntüle</a>
														<a href="<?= base_url("Edonusum/Earsiv/ReadFromArchive/".$sf->satis_GUID."/1"); ?>" target="_blank"
														   class="dropdown-item text-info mr-2"><i
																class="far fa-eye mr-1"></i> HTML</a>
														<a href="<?= base_url("Edonusum/Earsiv/ReadFromArchive/".$sf->satis_GUID."/2")?>" class="dropdown-item text-info mr-2"><i
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
					<h5 class="modal-title">E-Arşiv Fatura Arama</h5>
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
						<!-- <div class="form-group">
											<label>Cari Adına Göre </label>
											<input class="form-control" type="text" name="cariAdi" value="<?= $cariAdi; ?>" autocomplete="off">
										</div> -->
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
					<h5 class="modal-title">E-Arşiv Silme</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url("fatura/earsiv_sil"); ?>" method="GET">
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
	$seriNormal = $this->db->query("SELECT * FROM seriYonetimi WHERE seri_olusturanAnaHesap = '$anaHesap' AND seri_eArsivTipi = 1")->result();
	$seriInternet = $this->db->query("SELECT * FROM seriYonetimi WHERE seri_olusturanAnaHesap = '$anaHesap' AND seri_eArsivTipi = 2")->result();
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
					<form action="<?= base_url("Edonusum/Earsiv/WriteToArchiveExtended"); ?>" method="POST">

						<input type="hidden" name="satis_id" id="satis_id">

						<div class="form-group" id="internet_onek" style="display: none;">
							<label>İnternet Seri Ön Eki </label>
							<select class="form-control select" name="normal" id="normal">
								<option value="">Seçiniz...</option>
								<?php foreach ($seriInternet as $sn) { ?>
									<option value="<?= $sn->seri_id; ?>"><?= $sn->seri_seriOnEki; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group" id="normal_onek" style="display: none;" >
							<label>Normal Seri Ön Eki </label>
							<select class="form-control select" name="internet" id="internet">
								<option value="">Seçiniz...</option>
								<?php foreach ($seriNormal as $si) { ?>
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
			text: "E-Arşiv Fatura eklenmiştir.",
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
			text: "E-Arşiv Yüklendi.",
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
			text: "E-Arşiv Faturası gönderilmiştir.",
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
			text: "E-Arşiv Faturası gönderilememiştir. Hata: <?= $this->session->flashdata('error') ?>",
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


<?php if ($this->session->flashdata('fatura_xslt_error')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "warning",
			text: "E-arşiv göndermek için bir şablon yükleyin.",
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
			text: "E-Arşiv Tipine göre sadece bir tane seri ön eki seçimi yapabilirsiniz.",
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
