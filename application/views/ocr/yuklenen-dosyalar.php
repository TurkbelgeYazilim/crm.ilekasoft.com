<!DOCTYPE html>
<html lang="tr">
<head>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.2/css/select.dataTables.min.css">
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
	<?php
		$firma = getirFirma();
		$deletePermission = $firma->ayarlar_deletePermission;
	?>
	<div class="page-wrapper">
		<div class="content container-fluid">

			<!-- Page Header -->
			<div class="page-header">
				<div class="row">
					<div class="col-sm-10">
						<h3 class="page-title">OCR</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
							</li>
							<li class="breadcrumb-item">OCR
							</li>
							<li class="breadcrumb-item active">Yüklenen Dosyalar</li>
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
									<h5 class="card-title">Yüklenen Dosyalar <a href="<?= base_url("ocr/dosya-yukle"); ?>" class="btn btn-danger" style="float:right;"><i class="fa fa-camera"></i> Çek</a></h5>
								</div>

							</div>
						</div>
						<div class="card-body">

							<div class="table-responsive p-4">

								<div class="table-responsive">
									<table width="100%" class="table table-striped table-bordered table-hover"
										   id="datatable">
										<thead>
										<tr>
											<th style="width: 5%;">Fatura Türü</th>
											<th style="width: 8%;">Fatura Tarihi</th>
											<th>Fatura Numarası</th>
											<th>VKN / TCKN</th>
											<th>Unvan</th>
											<th>KDV</th>
											<th>Toplam</th>
											<th class="text-right">İşlem</th>
										</tr>
										</thead>

									</table>
									<hr>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Wrapper -->

	<div id="ocr_sil" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Fis / Fatura Silme</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url("ocr/ocr_sil"); ?>" method="GET">
						<input type="hidden" name="ocr_id" id="ocr_id" value="">
						<p id="ocr_faturaNo">Fiş/fatura silmek istediğinizden emin misiniz?</p>
						<div class="submit-section">
							<button class="btn btn-danger submit-btn">Sil</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /Main Wrapper -->


</div>

<?php $this->load->view("include/footer-js"); ?>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.js"></script>
<script type="text/javascript">
	$(document).ready(function () {

		datatable_fill();
	});
	function sil(id)
	{
		document.getElementById('ocr_id').value=id;
	}


	function datatable_fill() {
		$('#datatable').DataTable().destroy();
		var exportOptions = {
			//columns: ':visible:not(.not-exported)',
			columns:[0,1,2,3,4,5,6],
			rows: '.selected'
		}

		$('#datatable').DataTable({

			responsive: true,
			"searchable": true,
			"Paginate": true,
			"processing": true,
			"pageLength": 5,
			select: true,
			order: [[0, "desc"]],
			dom: 'Bfrtip',
			buttons: [
				{
					extend:'selectAll',
					text:"Hepsini Seç"
				},
				{
					extend: 'selectNone',
					text: "Seçimi Kaldır"
				},
				{
					extend : 'excel',
					exportOptions: exportOptions
				},{
					extend : 'pdf',
					exportOptions: exportOptions
				},

				{
					text: "MM'ye Gönder",

					action: function ( e, dt, node, config ) {

						//window.location.href="<?= base_url() ?>ocr/topluMmGonder";
						var table = $('#datatable').DataTable();

						var data=[];
						table.rows().every( function () {
							var hasSelected = $(this.node()).hasClass("selected");
							if(hasSelected==true) {
								data.push(table.row(this).data())
							}
							/*
							var row = $(this.node());

							var col1 = row.find(".selected");
							console.log(col1);*/
						});
						/*
												table.rows().every( function () {
													//debugger;
													if(this('.selected'))
													{
														console.log("select");
													}
													else console.log("no select");
													 if ( $(this).hasClass('selected') ) {
														 console.log("a");
													 }
													/*console.log(this.data());
													if ( $(this).hasClass('selected') ) {
														console.log("a");
													}
													/*if ( this.hasClass('selected') ) {
														console.log("a");
														var d = this.data();

													}*
												} );*/

						$.ajax({
							url: "<?= env('BASE_URL'); ?>/ocr/topluMmGonder",
							method: "POST",
							data:{data:data},
							success: function (result) {
								swal({
									title: "Bilgilendirme",
									type: "success",
									text: "Seçtiğiniz fiş / faturalar kayıtlı mali müşavirlerinize gönderildi.",
									confirmButtonText: 'Tamam',
									button: false,
									timer: 5000,
								});
							}

						});
					}
				}

			],
			//"ajax": "data/objects_subarrays.txt",   bir txt veya xml dosyasından alıp pars etmek de olabilir.
			"ajax": {
				"url": "<?= env('BASE_URL'); ?>/Ocr/yuklenenDosyalarAjax",
				"type": "GET"
			},
			"columns": [

				{"data": "dosya.0"},
				{"data": "dosya.1"},
				{"data": "dosya.2"},
				{"data": "dosya.3"},
				{"data": "dosya.4"},
				{"data": "dosya.5"},
				{"data": "dosya.6"},
				{"data": "dosya.7"}
			]
		});

	}

</script>



<?php if ($this->session->flashdata('dosya-guncelleme')) : ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Dosya bilgileri güncellendi.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>
</body>
</html>
