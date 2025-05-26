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
							<li class="breadcrumb-item active">Düzenlenen Belgeler</li>
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
			if ($_SERVER['QUERY_STRING']) {
				$qs = "?" . $_SERVER['QUERY_STRING'];
			}
			$anahesap=anaHesapBilgisi();
			$sqlModul="select * from modulAyarlari where ma_olusturanAnaHesap=$anahesap and ma_modulID=3";
			$exeModul=$this->db->query($sqlModul)->row();
			$firmaID = getirFirma();
			$firma_ID = $firmaID->ayarlar_id;
			$modulGibProSorgula = modulSorgula($firma_ID, 3);

			?>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<form action="<?= base_url("gib/duzenlenenBelgeler") ?>" method="get">
								<div class="row">
									<div class="col-md-3 col-sm-12">
										<input class="form-control" id="daterange" type="text" name="tarihAraligi"
											   autocomplete="off" value="<?= $startDate . " & " . $endDate ?>"/>
									</div>
									<div class="col-md-2 col-sm-12 mt-2">
										<input type="submit" value="Sorgula" class="w-100 btn btn-danger">
									</div>

								<div class="col-md-2 col-sm-12 mt-2" >
									<a href="<?= base_url("gib/duzenlenenExcel$qs"); ?>"
									   class="btn btn-outline-success btn-sm w-100" <?php if($modulGibProSorgula){ echo 'data-toggle="tooltip" data-placement="bottom" title="'. $exeModul->ma_olusturmaTarihi.' tarihinden itibaren İLEKASOFT programından kestiğiniz faturaları dışa aktarabilirsiniz."';}?>
									   style='font-family: Arial, Helvetica, sans-serif;'><i
												class="fa fa-file-excel"></i> Dışa aktar</a>
								</div>
						</div>
							</form>
							<div class="table-responsive mt-4">
								<table class="table table-striped custom-table mb-0">
									<thead>
									<th>Tarih</th>
									<th>Belge Türü</th>
									<th>Belge Numarası</th>
									<th>Alıcı VKN/TCKN</th>
									<th>Alıcı Unvan</th>
									<th>Onay Durumu</th>
									<th>İptal/İtiraz Durumu</th>
									<th>İşlemler</th>
									</thead>
									<tr>
										<?php
										foreach ($invoice["data"] as $item) {
										?>
									<tr>
										<td><?= $item["belgeTarihi"] ?></td>
										<td><?= $item["belgeTuru"] ?></td>
										<td><?= $item["belgeNumarasi"] ?></td>
										<td><?= $item["aliciVknTckn"] ?></td>
										<td><?= $item["aliciUnvanAdSoyad"] ?></td>
										<td><?= $item["onayDurumu"] ?></td>
										<td><?php if($item["iptalItiraz"] == "0") echo "İptal Kabul Edildi";else if($item["iptalItiraz"] == "1")echo "İptal Kabul Edilmedi"; else echo "---";  ?></td>
										<td>
											<div class="dropdown show">
												<a class="dropdown-toggle" href="#" role="button"
												   id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
												   aria-expanded="false">
													<i class="fas fa-ellipsis-h"></i>
												</a>

												<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
													<?php if ($item["onayDurumu"] == "Onaylanmadı") { ?>
														<a class="dropdown-item text-info mr-2" href="<?= base_url("gib/faturaDuzenle/" . $item["ettn"]) ?>">
															Düzenle
														</a>
														<a class="dropdown-item text-info mr-2" href="javascript(0);"
														   data-toggle="modal" data-target="#fatura_onay"
														   onclick="document.getElementById('fatura_onay_ettn').value='<?= $item["ettn"] ?>';">
															Onayla
														</a>
														<a class="dropdown-item text-info mr-2" href="javascript(0);"
														   data-toggle="modal" data-target="#fatura_iptal"
														   onclick="document.getElementById('fatura_ettn').value='<?= $item["ettn"] ?>';document.getElementById('fatura_no').innerHTML='Belge numarası <?= $item["belgeNumarasi"] ?>  olan faturayı silmek istediğinizden emin misiniz?';">
															Sil
														</a>
													<?php } ?>
													<a class="dropdown-item text-info mr-2" href="<?= base_url("gib/htmlGoster/" . $item["ettn"]) ?>"
													   target="_blank">
														HTML Göster
													</a>
													<a class="dropdown-item text-info mr-2" href="<?= base_url("gib/pdfGoster/" . $item["ettn"]) ?>"
													   target="_blank" >
														PDF Göster
													</a>
													<a class="dropdown-item text-info mr-2"  href="<?= base_url("gib/indir/" . $item["ettn"]) ?>">
														İndir
													</a>
												</div>
											</div>
										</td>
									</tr>
									<?php } ?>

									</tbody>
								</table>
							</div>
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
	$(function () {
		moment.locale('tr');
		$('#daterange').daterangepicker({
			opens: 'right',
			autoUpdateInput: false
		}, function (start, end, label) {
			$('#daterange').val(start.format('DD-MM-YYYY') + ' & ' + end.format('DD-MM-YYYY'));
			//console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
		});
		/*$('#daterange2').daterangepicker({
			opens: 'left',
			autoUpdateInput: false
		}, function (start, end, label) {
			$('#daterange2').val(start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY'));
			//console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
		});*/
	});
</script>

<!-- Modal Delete  -->
<div id="fatura_onay" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Fatura Onayla</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url("gib/smsDogrula") ?>" method="POST" id="smsGonder">
					<input type="hidden" name="fatura_onay_ettn" id="fatura_onay_ettn" value="">
					<p>Fatura onayı için portalda kayıtlı numaranıza sms gidecektir.</p>
					<div class="submit-section">
						<button class="btn btn-danger submit-btn">Sms Gönder</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- Modal Delete  -->
<div id="fatura_iptal" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Fatura Sil</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url("gib/iptal"); ?>" method="POST">
					<input type="hidden" name="fatura_ettn" id="fatura_ettn" value="">
					<p id="fatura_no"></p>
					<div class="submit-section">
						<button class="btn btn-danger submit-btn">Sil</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php if ($this->session->flashdata('kod-yok')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "warning",
			text: "Sms kodu girilmedi.Fatura onaylanmadı.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('kod-hatali')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "warning",
			text: "Sms kodu hatalı.Fatura onaylanmadı.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('kod-dogru')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Sms kodu doğru.Fatura onaylandı.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>


</body>

</html>
