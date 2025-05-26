<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
								<h3 class="page-title">Cari</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Cari</li>
									<li class="breadcrumb-item active">Cari Dekont Düzenle</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<?php 
						$cariID = $cariDekont->ch_cariID;
						$cariQ = "SELECT * FROM cari WHERE cari_id = '$cariID'";
						$cariExe = $this->db->query($cariQ)->row();

						$tarih = $cariDekont->ch_tarih;

						$yeni_tarih = date("d.m.Y", strtotime($tarih));
					?>

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Cari Dekont</h4>
									<form action="<?= base_url("cari/mevcutCariDekontDuzenle"); ?>" method="POST">
										<input type="hidden" name="cari_id" id="cari_id" value="<?= $cariID; ?>">
										<input type="hidden" name="ch_id" value="<?= $cariDekont->ch_id; ?>">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Cari Kodu</label>
													<input type="text" class="form-control" name="cariDekont_cariKodu" required="" id="carikodu_input" value="<?= $cariExe->cari_kodu;?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Cari Adı</label>
													<input type="text" class="form-control" name="cariDekont_cariAdi" required="" id="cariadi_input" value="<?= $cariExe->cari_ad; ?>">
												</div>
											</div>
										</div>
										<h4 class="card-title">İşlem Bilgileri</h4>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Tarih</label>
													<input type="text" class="datepicker form-control" name="cariDekont_tarih" required="" autocomplete="off" value="<?= $yeni_tarih; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Tutar</label>
													<input type="number" step="0.01" class="form-control" name="cariDekont_tutar" required="" value="<?php if(!empty($cariDekont->ch_borc)){echo $cariDekont->ch_borc;} else if(!empty($cariDekont->ch_alacak)){echo $cariDekont->ch_alacak;} ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>İşlem Tipi</label>
													<select name="cariDekont_islemTipi" class="select form-control" required="">
														<option value="">İşlem tipi seçiniz...</option>
														<option value="1" <?php if(!empty($cariDekont->ch_alacak)){echo "selected";} ?>>Alacak</option>
														<option value="2" <?php if(!empty($cariDekont->ch_borc)){echo "selected";} ?>>Borç</option>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Açıklama</label>
													<textarea class="form-control" name="cariDekont_aciklama"><?= $cariDekont->ch_aciklama; ?></textarea>
												</div>
											</div>
										</div>
										<button type="submit" class="btn btn-danger" style="width:100%;">Düzenle</button>
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


<?php if ($this->session->flashdata('cari_dekont_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "error", 
  text: "Cari dekont başarılı bir şekilde oluşturuldu.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>
		
		<?php $this->load->view("include/footer-js"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$(function(){
   $('.datepicker').datepicker({
      dateFormat: 'dd.mm.yy',
      language: 'tr'
    });
});
</script>

<script>
	$(function() {
	    $("#carikodu_input").autocomplete({
	        source: "<?= env('BASE_URL'); ?>/banka/autocompleteDataByCodeCari",
	        minLength: 2,
	        select: function( event, ui ) {
	            event.preventDefault();

				toastr.success(ui.item.value+" kodlu cariye ait bilgiler getirildi.");

				$("#cari_id").val(ui.item.id);
            	$("#carikodu_input").val(ui.item.value);
            	$("#cariadi_input").val(ui.item.cari_ad);
	        }
	    });
	});

	$(function() {
	    $("#cariadi_input").autocomplete({
	        source: "<?= env('BASE_URL'); ?>/banka/autocompleteDataByNameCari",
	        minLength: 2,
	        select: function( event, ui ) {
	            event.preventDefault();

				toastr.success(ui.item.value+" isimli cariye ait bilgiler getirildi.");

				$("#cari_id").val(ui.item.id);
            	$("#cariadi_input").val(ui.item.value);
            	$("#carikodu_input").val(ui.item.cari_kodu);
	        }
	    });
	});
</script>

	</body>
</html>
