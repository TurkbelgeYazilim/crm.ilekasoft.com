<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
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
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
							</li>
							<li class="breadcrumb-item">Fatura
							</li>
							<li class="breadcrumb-item active">Proforma Fatura Listesi</li>
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
			$firma = getirFirma();
			$deletePermission = $firma->ayarlar_deletePermission;
			$anaHesap = anaHesapBilgisi();

			$modul = modulSorgula($anaHesap, 1);

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
									<h5 class="card-title">Proforma Fatura Listesi</h5>
								</div>
								<div class="col-auto">
									<a href="<?= base_url("fatura/proformaFaturasiExcel$qs"); ?>"
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
										<th class="text-right">İşlem</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($proformaFaturasi as $sf) { ?>
										<?php

										$cariID = $sf->proforma_cariID;
										$cariQ = "SELECT cari_ad,cari_alias_pk FROM cari WHERE cari_id = '$cariID'";
										$carie = $this->db->query($cariQ)->row();
										$cariAd = $carie->cari_ad;

										if($sf->proforma_durum==1) {
											$background = "background-success";
											$text="Proforma fatura onaylandı";
										}

										else if($sf->proforma_durum==2) {
											$background = "background-danger";
											$text="Proforma fatura reddedildi";
										}
										else if($sf->proforma_durum==3) {
											$background = "text-info";
											$text="Proforma fatura faturalaştırıldı";
										}
										else {
											$background = "";
											$text="";
										}


										if ($sf->proforma_faturaEtiketID != null) {

											$sqlEtiket = "select  * from etiketler where etiket_id=" . $sf->proforma_faturaEtiketID . "";
											$exeEtiket = $this->db->query($sqlEtiket)->row();
											$etiketAdi=$exeEtiket->etiket_adi;
										}
										else
										{
											$etiketAdi="";
										}
										?>

										<tr>
											<td>
												<?php if($text != "") { ?>
												<i class="fa fa-info-circle fa-xs <?= $background ?>"
														data-toggle="tooltip" style="font-size:12px;"
														data-placement="right"
														title="<?= $text ?>"></i>
												<?php } ?>
												<?= date('d.m.Y', strtotime($sf->proforma_faturaTarihi)); ?></td>
											<td><?= $etiketAdi ?></td>
											<td><?= $sf->proforma_faturaNo; ?></td>
											<td><?= $cariAd; ?></td>
											<td><?= $sf->proforma_genelToplam ?>₺</td>
											<td class="text-right">
												<div class="dropdown show">
													<a class="dropdown-toggle" href="#" role="button"
													   id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
													   aria-expanded="false">
														<i class="fas fa-ellipsis-h"></i>
													</a>

													<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

														<a href="javascript:void(0);" data-toggle="modal"
														   data-target="#fatura_onayRed"
														   onclick="document.getElementById('fatura_onayRed_secenek').value=1;document.getElementById('fatura_onayRed_id').value='<?= $sf->proforma_id ?>';document.getElementById('fatura_onayRed_no').innerHTML='Fatura numarası <?= $sf->proforma_faturaNo ?>  olan faturayı onaylamak istediğinizden emin misiniz?';"
														   class="dropdown-item text-success mr-2"><i
																	class="far fa-edit mr-1"></i> Onayla</a>

														<a href="javascript:void(0);" data-toggle="modal"
														   data-target="#fatura_onayRed"
														   onclick="document.getElementById('fatura_onayRed_secenek').value=2;document.getElementById('fatura_onayRed_id').value='<?= $sf->proforma_id ?>';document.getElementById('fatura_onayRed_no').innerHTML='Fatura numarası <?= $sf->proforma_faturaNo ?>  olan faturayı reddetmek istediğinizden emin misiniz?';"
														   class="dropdown-item text-danger mr-2"><i
																	class="far fa-times-circle mr-1"></i> Red</a>

														<a href="<?= base_url("fatura/goruntule?tipi=proforma&id=$sf->proforma_id"); ?>"
														   class="dropdown-item text-info mr-2"><i
																	class="far fa-eye mr-1"></i> Görüntüle</a>
														<a href="<?= base_url("fatura/proforma-faturasi/$sf->proforma_id"); ?>"  class="dropdown-item mr-2" style="color:green;"><i
																	class="far fa-edit mr-1"></i> Düzenle</a>
														<a href="javascript:void(0);" data-toggle="modal"
														   data-target="#faturalastir"
														   onclick="document.getElementById('faturalastir_id').value='<?= $sf->proforma_id ?>';document.getElementById('faturalastir_no').innerHTML='Fatura numarası <?= $sf->proforma_faturaNo ?>  olan faturayı faturalaştırmak istediğinizden emin misiniz?';"
														   class="dropdown-item text-info mr-2"><i
																	class="far fa-edit mr-1"></i> Faturalaştır</a>

														<?php if ($deletePermission == 1) { ?>
															<a href="javascript:void(0);" data-toggle="modal"
															   data-target="#fatura_sil"
															   onclick="document.getElementById('fatura_id').value='<?= $sf->proforma_id ?>';document.getElementById('fatura_no').innerHTML='Fatura numarası <?= $sf->proforma_faturaNo ?>  olan faturayı silmek istediğinizden emin misiniz?';"
															   class="dropdown-item text-danger mr-2"><i
																		class="far fa-trash-alt mr-1"></i> Sil</a>
														<?php } ?>
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
	$etiket = $this->input->get('etiket');
	$tarihAraligi = $this->input->get('tarihAraligi');
	$siralama = $this->input->get('siralama');
	?>
	<!-- Add Category Modal -->
	<div id="add_category" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Proforma Faturası Arama</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url("fatura/proforma-listesi"); ?>" method="GET">
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
						<hr>
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

	<!-- Modal Delete  -->
	<div id="fatura_sil" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Proforma Faturası Silme</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url("fatura/proforma_fatura_sil"); ?>" method="GET">
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

	<div id="fatura_onayRed" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Proforma Faturası Onayla/Reddet</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url("fatura/proformaOnayRed"); ?>" method="Post">
						<input type="hidden" name="fatura_onayRed_id" id="fatura_onayRed_id" value="">
						<input type="hidden" name="fatura_onayRed_secenek" id="fatura_onayRed_secenek" value="">
						<p id="fatura_onayRed_no"></p>
						<div class="submit-section">
							<button class="btn btn-danger submit-btn">Durum Güncelle</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div id="faturalastir" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Proforma Faturasını Faturalaştır</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url("fatura/proforma-faturalastir"); ?>" method="GET">
						<input type="hidden" name="faturalastir_id" id="faturalastir_id" value="">
						<p id="faturalastir_no"></p>
						<div class="submit-section">
							<button class="btn btn-danger submit-btn">Faturalaştır</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /Main Wrapper -->

<?php if ($this->session->flashdata('fatura_ok')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Proforma faturası eklenmiştir.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>
<?php if ($this->session->flashdata('fatura_sil_ok')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Proforma faturası silinmiştir.",
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

</body>
</html>
