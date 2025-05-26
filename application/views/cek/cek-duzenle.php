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
	</style>
</head>
<body>

<?php $firma = getirFirma();
$firmaID = $firma->ayarlar_id;
$firmaAd = $firma->ayarlar_firmaAd;
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
						<h3 class="page-title">Çek</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
							<li class="breadcrumb-item">Çek</li>
							<li class="breadcrumb-item active">Çek Düzenle</li>
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
							<h4 class="card-title">Çek Düzenle</h4>
							<form action="<?= base_url("cek/cekGuncelle"); ?>" method="POST" id="myform">
								<input type="hidden" name="cek_cariID" id="cari_id" value="<?= $cek->cek_cariID?>">

								<input type="hidden" name="cek_id"  value="<?= $cek->cek_id?>">

								<div class="col-md-offset-12">
									<div class="form-group">
										<label>Hareket Tipi</label>
										<select class="form-control select" name="cek_hareketTipi" required=""
												id="hareketTipi">
											<option value="">Hareket tipi seçiniz...</option>
											<option value="1" <?php if ($cek->cek_hareketTipi == 1) echo "selected"; ?>>
												Alınan çek
											</option>
											<option value="2" <?php if ($cek->cek_hareketTipi == 2) echo "selected"; ?>>
												Verilen çek (kendi çekimiz)
											</option>
										</select>
									</div>


								</div>


								<div class="row">
									<?php
										$cariSql="select  * from cari where cari_id=".$cek->cek_cariID;
										$cariExe=$this->db->query($cariSql)->row();

									?>
									<div class="col-md-12">
										<div class="form-group">
											<label>Cari seçiniz</label>

											<input type="text" class="form-control" name="cek_cariAd" required=""
												   id="cariadi_input"
												   placeholder="Lütfen cari adını yazmaya başlayıp daha sonra listeden seçiniz..." value="<?= $cariExe->cari_ad." ".$cariExe->cari_soyad ?>">
										</div>
									</div>


									<div class="col-md-12">
										<div class="form-group">
											<label>Kayıt tarihi</label>
											<input type="text" class="datepicker form-control" name="cek_kayitTarihi"
												   required="" autocomplete="off" value="<?= $cek->cek_kayitTarihi ?>">
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>Not / açıklama</label>
											<textarea name="cek_notAciklama" class="form-control"><?= $cek->cek_notAciklama ?></textarea>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Portföy No</label>
											<input type="text" class="form-control" name="cek_portfoyNo" required="" value="<?= $cek->cek_portfoyNo ?>">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Seri No</label>
											<input type="text" class="form-control" name="cek_seriNo" required="" value="<?= $cek->cek_seriNo ?>">
										</div>
									</div>
<?php
if ($cek->cek_hareketTipi == 1)
{
	$borcluSql="select * from cari where cari_id=$cek->cek_borcluID";
	$borcluExe=$this->db->query($borcluSql)->row();

	$ad=$borcluExe->cari_ad." ".$borcluExe->cari_soyad ;
}
else if ($cek->cek_hareketTipi == 2)
{
	$ad=$firmaAd;
}
?>
									<div class="col-md-12">
										<div class="form-group">
											<label>Borçlu</label>
											<input type="text" class="form-control" name="cek_borcluAd" required=""
												   id="borclu" readonly value="<?= $ad?>" >
										</div>
									</div>

									<input type="hidden" name="cek_borcluID" id="borcluID" value="<?= $cek->cek_borcluID ?>">

									<div class="col-md-12">
										<div class="form-group">
											<label>Vadesi</label>
											<input type="text" class="datepicker form-control" name="cek_vadeTarih"
												   required="" autocomplete="off" value="<?= $cek->cek_vadeTarih ?>">
										</div>
									</div>

									<?php $bankalarq = "SELECT * FROM turkiyeBankalarListesi";
									$bankalarExe = $this->db->query($bankalarq)->result();
									?>

									<div class="col-md-6">
										<div class="form-group">
											<label>Banka Adı</label>
											<select class="form-control select" name="cek_bankaID" required=""
													id="bankaad">
												<option value="">Banka seçiniz...</option>
												<?php foreach ($bankalarExe as $banka) { ?>
													<option value="<?= $banka->trbanka_id ?>" <?php if($cek->cek_bankaID==$banka->trbanka_id) echo "selected"; ?>><?= $banka->trbanka_ad; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Banka Şubesi</label>
											<input type="text" class="form-control" name="cek_bankaSube" required="" value="<?= $cek->cek_bankaSube ?>">
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>Tutar</label>
											<input type="number" class="form-control" name="cek_tutar" required="" value="<?= $cek->cek_tutar ?>">
										</div>
									</div>

								</div>

								<button type="submit" class="btn btn-danger" style="width:100%;">Kaydet</button>
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


<?php $this->load->view("include/footer-js"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
		integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
	$(function () {
		$('.datepicker').datepicker({
			dateFormat: 'dd.mm.yy',
			language: 'tr'
		});
	});
</script>

<script>
	$(function () {
		$("#cariadi_input").autocomplete({
			source: "<?= env('BASE_URL'); ?>/kasa/autocompleteDataByNameCari",
			minLength: 2,
			select: function (event, ui) {
				event.preventDefault();

				var hareketTipi = $("#hareketTipi option:selected").val();

				var firmaID = <?= $firmaID; ?>;
				var firmaAd = "<?= $firmaAd; ?>";

				if (hareketTipi == 1) {//borçlu seçilen cari
					$("#borclu").val(ui.item.value);
					$("#borcluID").val(ui.item.id);
				} else if (hareketTipi == 2) {//borçlu kendi firması
					$("#borclu").val(firmaAd);
					$("#borcluID").val(firmaID);
				}

				toastr.success(ui.item.value + " isimli cariye ait bilgiler getirildi.");

				$("#cari_id").val(ui.item.id);
				$("#cariadi_input").val(ui.item.value);
			}
		});
	});
	//ID: hareketTipi değiştiği zaman ID: gizle aktif et
	$("#hareketTipi").on('change', function () {
		var hareketTipiText = $("#hareketTipi option:selected").text();
		var hareketTipi = $("#hareketTipi option:selected").val();

		if (hareketTipi == 1) {
			$('#myform')[0].reset();
			$('#hareketTipi').val("1");
			$("#gizle").css("display", "block");
		} else if (hareketTipi == 2) {
			$('#myform')[0].reset();
			$('#hareketTipi').val("2");
			$("#gizle").css("display", "block");
		} else {
			$('#myform')[0].reset();
			$("#gizle").css("display", "none");
		}
	});

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

<script type="text/javascript">
	$(document).ready(function () {
		$("#bankaad").select2({
			width: '100%'
		});
	});
</script>

</body>
</html>
