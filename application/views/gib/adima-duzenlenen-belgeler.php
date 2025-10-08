<!DOCTYPE html>
<html lang="tr" xmlns="http://www.w3.org/1999/html">
<head>
	<?php $this->load->view("include/head-tags"); ?>

	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/c3-chart/c3.min.css">

	<script src="https://www.amcharts.com/lib/4/core.js"></script>
	<script src="https://www.amcharts.com/lib/4/charts.js"></script>
	<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<style>
	.table td, .table th {
		vertical-align: middle;
		white-space: normal;
	}
</style>
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
							<li class="breadcrumb-item active">Adıma Düzenlenen Belgeler</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i>
							<br>Önceki Sayfa</a>
					</div>
				</div>
			</div>
			<div id="newRow"></div>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">

							<div class="alert alert-primary" role="alert">
								<b>Önemli Not:</b>
								<br>
								Yeni e-Arşiv Sorgula işlemi için Başlangıç ve Bitiş tarihi girilmezse son 1 haftayı getirir.
							</div>



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
							<form action="<?= base_url("gib/adimaDuzenlenenBelgeler") ?>" method="get">
								<div class="row">
									<div class="col-md-3 col-sm-12">
										<input type="text"
											   class="form-control"
											   id="daterange"
											   name="tarihAraligi" autocomplete="off"
											   value="<?php echo $startDate." & ".$endDate; ?>"/>

									</div>
									<div class="col-md-2 col-sm-12 mt-2">
										<input type="submit" value="Sorgula" class="w-100 btn btn-danger">
									</div>

									<div class="col-md-2 col-sm-12 mt-2" >
										<a href="<?= base_url("gib/adimaDuzenlenenExcel$qs"); ?>"
										   class="btn btn-outline-success btn-sm w-100"  <?php if($modulGibProSorgula){ echo 'data-toggle="tooltip" data-placement="bottom" title="'. $exeModul->ma_olusturmaTarihi.' tarihinden itibaren İLEKASOFT programından kestiğiniz faturaları dışa aktarabilirsiniz."';}?>
										   style='font-family: Arial, Helvetica, sans-serif;'><i
													class="fa fa-file-excel"></i> Dışa aktar</a>
									</div>
								</div>
							</form>
							<div class="table-responsive mt-4">
								<table class="table table-striped custom-table mb-0">
									<thead>
									<th>Düzenleme Tarihi</th>
									<th>Düzenleme Saati</th>
									<th>Belge Numarası</th>
									<th>Alıcı VKN/TCKN</th>
									<th>Alıcı Unvan</th>
									<th>Toplam Tutar</th>
									<th>Ödenecek Tutar</th>
									<th>Vergiler Toplamı</th>
									<th>Para Birimi</th>
									<th>Tesisat Numarası</th>
									<th>Gönderim Şekli</th>
									</thead>
									<tbody>
									<?php
										foreach ($invoice as $item)
										{?>
												<tr>
											<td><?= date("d-m-Y",strtotime($item["tarih"])) ?></td>
											<td><?= $item["zaman"] ?></td>
											<td><?= $item["faturaNo"] ?></td>
											<td><?= $item["mukVkn"] ?></td>
											<td><?= $item["unvan"] ?></td>
											<td><?= $item["toplam"] ?></td>
											<td><?= $item["odenecek"] ?></td>
											<td><?= $item["vergi"] ?></td>
											<td><?= $item["paraBirimi"] ?></td>
											<td><?= $item["tesisatNo"] ?></td>
											<td><?= $item["gonderimSekli"] ?></td>
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
		$('#daterange').daterangepicker({
			opens: 'right',
			autoUpdateInput: false,
			language: 'tr',
			"maxSpan": {
				"days": 7
			}
		},function (start, end, label) {
			$('#daterange').val(start.format('DD-MM-YYYY') + ' & ' + end.format('DD-MM-YYYY'));
		});
	});
</script>



</body>

</html>
