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
								<h3 class="page-title">Banka</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Banka</li>
									<li class="breadcrumb-item active">Bankadan Kasaya Transfer Düzenle</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Kasa ve Banka Bilgileri</h4>
									<form action="<?= base_url("banka/bankadanKasayaTransfer_Duzenle"); ?>" method="POST">

										<input type="hidden" name="bh_transferRefID" value="<?= $bankaTransfer->bh_transferRefID;?>">

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Belge / Makbuz No</label>
													<input type="text" class="form-control" name="bankaToKasaTransfer_belgeNo" required="" value="<?= $bankaTransfer->bh_belgeNumarasi; ?>">
												</div>
											</div>

											<?php
												$vaults = getVaultsofCompany();
												$banks = getBanksofCompany();
											?>

											<div class="col-md-4">
												<div class="form-group">
													<label>Banka seçiniz... <i>(Kaynak)</i></label>
													<select class="form-control select" name="banka_id">
														<option value="">Seçiniz...</option>
														<?php foreach($banks as $ba){?>
															<option value="<?= $ba->banka_id; ?>" <?php if($ba->banka_id == $bankaTransfer->bh_bankaID){echo "selected";} ?>><?= $ba->banka_bankaAd; ?></option>
														<?php }?>
													</select>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Kasa seçiniz... <i>(Hedef)</i></label>
													<select class="form-control select" name="kasa_id">
														<option value="">Seçiniz...</option>
														<?php foreach($vaults as $va){?>
															<option value="<?= $va->kasa_id; ?>" <?php if($va->kasa_id == $kasaTransfer->kh_kasaID){echo "selected";} ?>><?= $va->kasa_adi; ?></option>
														<?php }?>
													</select>
												</div>
											</div>

										</div>

										<?php
										$tarih = $bankaTransfer->bh_tarih;

										$yeni_tarih = date("d.m.Y", strtotime($tarih));
										?>

										<h4 class="card-title">Ödeme Bilgileri</h4>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Tarih</label>
													<input type="text" class="datepicker form-control" name="bankaToKasaTransfer_tarih" required="" autocomplete="off" value="<?= $yeni_tarih; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Tutar</label>
													<input type="number" step="0.01" class="form-control" name="bankaToKasaTransfer_tutar" required="" value="<?= $bankaTransfer->bh_cikis; ?>">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Açıklama</label>
													<textarea class="form-control" name="bankaToKasaTransfer_aciklama"><?= $bankaTransfer->bh_aciklama; ?></textarea>
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


<?php if ($this->session->flashdata('kasa_tahsilat_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Kasa tahsilat işlemi başarılı bir şekilde gerçekleştirildi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('kasa_hatali')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "error", 
  text: "Kasa kodu veya kasa adı kayıtlı değil, lütfen listeden seçerek devam ediniz.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_hatali')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "error", 
  text: "Cari kodu veya cari adı kayıtlı değil, lütfen listeden seçerek devam ediniz.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('belge_no_mukerrer')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "error", 
  text: "Girilen belge numarası zaten daha önce kayıt edilmiş, tekrar deneyiniz.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

		<?php if ($this->session->flashdata('bankadan_kasaya_transfer_ok')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "Bankadan kasaya transfer işlemi başarılı bir şekilde yapıldı.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('bankadan_kasaya_transfer_update')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "Bankadan kasaya transfer işlemi güncellemesi yapıldı.",
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
	    $("#kod_input").autocomplete({
	        source: "<?= env('BASE_URL'); ?>/kasa/autocompleteDataByCode",
	        minLength: 2,
	        select: function( event, ui ) {
	            event.preventDefault();

				toastr.success(ui.item.value+" kodlu kasaya ait bilgiler getirildi.");

				$("#kasa_id").val(ui.item.id);
            	$("#kod_input").val(ui.item.value);
            	$("#ad_input").val(ui.item.kasa_adi);
	        }
	    });
	});

	$(function() {
	    $("#ad_input").autocomplete({
	        source: "<?= env('BASE_URL'); ?>/kasa/autocompleteDataByName",
	        minLength: 2,
	        select: function( event, ui ) {
	            event.preventDefault();

				toastr.success(ui.item.value+" adlı kasaya ait bilgiler getirildi.");

				$("#kasa_id").val(ui.item.id);
            	$("#ad_input").val(ui.item.value);
            	$("#kod_input").val(ui.item.kasa_kodu);
	        }
	    });
	});

	$(function() {
	    $("#carikodu_input").autocomplete({
	        source: "<?= env('BASE_URL'); ?>/kasa/autocompleteDataByCodeCari",
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
	        source: "<?= env('BASE_URL'); ?>/kasa/autocompleteDataByNameCari",
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

<script type="text/javascript">
	$(document).ready(function(){
		 $("form").submit(function() {
				$(this).submit(function() {
					return false;
				});
				return true;
			}); 
	}); 
</script>

	</body>
</html>
