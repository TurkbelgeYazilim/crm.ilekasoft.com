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
						<h3 class="page-title">Giderler</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
							<li class="breadcrumb-item">Giderler</li>
							<li class="breadcrumb-item active">Fiş Yükle</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i>
							<br>Önceki Sayfa</a>
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Fiş / Fatura Yükle</h4>
							<form action="<?= base_url() ?>giderler/fisOku" method="post" enctype="multipart/form-data">
								<div class="col-md-4 mt-4">
									<input type="file" name="file" id="file" class="form-control">
									<br>
									<input type="submit" value="Yükle" class="btn btn-danger w-100">
								</div>
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


<?php if ($this->session->flashdata('gider_ok')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Gider kalemi başarılı bir şekilde eklendi.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('kasa_eksi')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Bu girişin ardından seçilen kasa eksi bakiyeye düşeceği için işlem iptal edildi, tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('banka_eksi')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Bu girişin ardından seçilen banka eksi bakiyeye düşeceği için işlem iptal edildi, tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php $this->load->view("include/footer-js"); ?>

<script>
	$(function () {
		$('.datepicker').datepicker({
			dateFormat: 'dd.mm.yy',
			language: 'tr'
		});
	});
</script>

<script>
	$("#odemeTipi").on('change', function () {
		var status = $(this).val();

		if (status == 1) {
			$("#kasa").prop('disabled', false);
			document.getElementById("kasa").required = true;
			document.getElementById("banka").required = false;
			$("#banka").prop('disabled', true);
			$("#banka").val('').change();
		}

		if (status == 2) {
			$("#banka").prop('disabled', false);
			document.getElementById("banka").required = true;
			document.getElementById("kasa").required = false;
			$("#kasa").prop('disabled', true);
			$("#kasa").val('').change();
		}
	});

	$("#gkid").on('change', function () {
		var statusgk = $(this).val();
		$.ajax({
			url: "<?= env('BASE_URL'); ?>/giderler/giderAltGetir",
			method: "POST",
			data: {gkID: statusgk},
			success: function (result) {
				var urunler = result.data;
				var select = '<div class="altturler"><div class="form-group"><label>Gider Alt Türü</label> <select class="form-control" name="gider_gkSubID" id="gksubid" required="">';
				for (var i = 0; i < urunler.length; i++) {
					select += '<option value="' + urunler[i].gk_id + '">' + urunler[i].gk_adi + '</option>';
				}
				select += '</select></div></div>';
				$('div.altturler').empty().html(select);
				$("#gksubid").select2();
			}
		});
	});

</script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#gkid").select2();
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
