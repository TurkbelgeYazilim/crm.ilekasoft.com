<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

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
							<li class="breadcrumb-item active">e-İrsaliye Gelen Kutusu</li>
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
									<h5 class="card-title">E-İrsaliye Gelen Kutusu</h5>
								</div>
								<div class="col-auto">
									<select class="form-control select" name="donem" id="donem" onchange="donem_degistir()">
										<option value="0">1 Gün</option>
										<option value="1">7 Gün</option>
										<option value="2" selected>30 Gün</option>
										<option value="3">Bu Ay</option>
										<option value="4">Geçen Ay</option>
									</select>
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

							<div class="table-responsive p-4">

							<table width="100%" class="table table-striped table-bordered table-hover" id="datatable">
								<thead>
								<tr>
									<th>Fatura Tarihi</th>
									<th>Alınma Zamanı</th>
									<th>Fatura No</th>
									<th>Cari Adı</th>
									<th>Genel Toplam</th>
									<th>Tip</th>
									<th>Durum</th>
									<th>Fatura Zarf Durumu</th>
									<th>İşlem</th>
								</tr>
								</thead>
							</table>



							</div>
						</div>
					</div>
					<br><br>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Wrapper -->

	<!-- Add Category Modal -->
	<div id="add_category" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">E-Fatura Arama</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" method="GET">

						<div class="form-group">
							<label>Müşteri VKN'ye Göre </label>
							<input class="form-control" type="text" name="vkn"
								   autocomplete="off" id="vkn">
						</div>

						<div class="form-group">
							<label>Fatura Tarih Aralığına Göre </label>
							<input class="form-control" id="daterange" type="text" name="tarihAraligi"
								   autocomplete="off"/>
						</div>

						<!--<div class="form-group">
							<label>Alınma Tarih Aralığına Göre </label>
							<input class="form-control" id="daterange2" type="text" name="tarihAraligi2"
								   autocomplete="off"/>
						</div>-->

						<div class="form-group">
							<label>Fatura No'ya Göre </label>
							<input class="form-control" type="text" name="faturaNo"
								   autocomplete="off" id="faturaNo">
						</div>

						<!--<div class="form-group">
							<label>İrsaliye No'ya Göre </label>
							<input class="form-control" type="text" name="irsaliyeNo" value="<?= $irsaliyeNo; ?>"
								   autocomplete="off">
						</div>-->
						<hr>
						<div class="btn btn-danger submit-btn" onclick="efaturaAra()">Ara
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /Add Category Modal -->

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


<?php if ($this->session->flashdata('fatura_cevap')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "E-Faturaya cevap verilmiştir.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>
<?php if ($this->session->flashdata('ice_aktar_ok')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "E-Fatura içeri aktarılmıştır.",
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


<?php $this->load->view("include/footer-js"); ?>
<!-- Select2 JS -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>



<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		datatable_fill(2);
	} );

	function datatable_fill(donem=null,faturastart=null,faturaend=null,faturaNo=null,vkn=null)
	{
		$('#datatable').DataTable().destroy();
		$('#datatable').DataTable( {
			responsive: true,
			"searchable": true,
			"Paginate": true,
			"processing":true,
			"pageLength": 25,
			order: [[0,"desc"]],
			//"ajax": "data/objects_subarrays.txt",   bir txt veya xml dosyasından alıp pars etmek de olabilir.
			"ajax": {
				"url": "<?= env('BASE_URL'); ?>/Edonusum/Eirsaliye/GetDespatchAdvice/"+donem+"/"+faturastart+"/"+faturaend+"/"+faturaNo+"/"+vkn,
				"type": "GET"
			},

			"columns": [

				{ "data": "fatura.0" },
				{ "data": "fatura.1" },
				{ "data": "fatura.2" },
				{ "data": "fatura.3" },
				{ "data": "fatura.4" },
				{ "data": "fatura.5" },
				{ "data": "fatura.6" },
				{"data":"fatura.7"},
				{"data":"fatura.8"},
			]
		} );
	}

</script>


<script>
	$(function () {
		moment.locale('tr');
		$('#daterange').daterangepicker({
			opens: 'left',
			autoUpdateInput: false
		}, function (start, end, label) {
			$('#daterange').val(start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY'));
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
	function donem_degistir(){
		var val=$("#donem").val();
		$("#vkn").val("");
		$("#faturaNo").val("");
		$("#daterange").val("");
		//$("#daterange2").val("");
		datatable_fill(val);
	}

	function efaturaAra()
	{
		let vkn=$("#vkn").val();
		let faturaNo=$("#faturaNo").val();
		let daterange=$("#daterange").val();
		//let daterange2=$("#daterange2").val();
		var fatura1=null,fatura2=null;
		//var alinmaTarih1=null,alinmaTarih2=null;
		if(daterange!="") {
			fatura1 = daterange.split("-")[0];
			fatura2 = daterange.split("-")[1];
			fatura1 = fatura1.replace(/^\s+|\s+$/gm, '');
			fatura2 = fatura2.replace(/^\s+|\s+$/gm, '');
		}
		if(faturaNo=="")
			faturaNo=null;
		if(vkn=="")
			vkn=null;
	/*	if(daterange2!="") {
			alinmaTarih1 = daterange2.split("-")[0];
			alinmaTarih2 = daterange2.split("-")[1];
			alinmaTarih1 = alinmaTarih1.replace(/^\s+|\s+$/gm, '');
			alinmaTarih2 = alinmaTarih2.replace(/^\s+|\s+$/gm, '');
		}*/
		$('#add_category').modal('hide');
		//datatable_fill(null,fatura1,fatura2,alinmaTarih1,alinmaTarih2,faturaNo);
		datatable_fill(null,fatura1,fatura2,faturaNo,vkn);

	}

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
