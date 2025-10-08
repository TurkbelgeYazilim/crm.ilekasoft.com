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
									<li class="breadcrumb-item active">Banka Havale / EFT Düzenle</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->

					<?php
						$anaHesap = anaHesapBilgisi();

						$bankaID = $havale->bh_bankaID;
						$bankaQ = "SELECT * FROM banka WHERE banka_id = '$bankaID' AND banka_olusturanAnaHesap ='$anaHesap'";
						$bankaExe = $this->db->query($bankaQ)->row();

						$cariID = $havale->bh_cariID;
						$cariQ = "SELECT * FROM cari WHERE cari_id = '$cariID' AND cari_olusturanAnaHesap = '$anaHesap'";
						$cariExe = $this->db->query($cariQ)->row();
					?>
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Havale / EFT Bilgileri</h4>
									<form action="<?= base_url("banka/bankaHavaleGuncelle"); ?>" method="POST">

										<input type="hidden" name="cari_id" id="cari_id" value="<?= $havale->bh_cariID; ?>">
										<!--<input type="hidden" name="banka_id" id="banka_id" value="<?= $havale->bh_bankaID; ?>"> -->
										<input type="hidden" name="bh_id" id="bh_id" value="<?= $havale->bh_id; ?>">
										<input type="hidden" name="ch_id" id="ch_id" value="<?= $havale->bh_cariHareketiID; ?>">
										
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Belge / Havale No</label>
													<input type="text" class="form-control" name="havale_belgeNo" required="" value="<?= $havale->bh_belgeNumarasi; ?>">
												</div>
											</div>
											<?php
											$banks = getBanksofCompany();
											?>

											<div class="col-md-8">
												<div class="form-group">
													<label>Banka seçiniz...</label>
													<select class="form-control select" name="banka_id">
														<option value="">Seçiniz...</option>
														<?php foreach($banks as $ba){?>
															<option value="<?= $ba->banka_id; ?>" <?php if($havale->bh_bankaID == $ba->banka_id){echo "selected";} ?>><?= $ba->banka_bankaAd; ?></option>
														<?php }?>
													</select>
												</div>
											</div>
											<!-- <div class="col-md-4">
												<div class="form-group">
													<label>Banka Adı</label>
													<input type="text" class="form-control" name="havale_bankaAdi" required="" id="ad_input" value="<?= $bankaExe->banka_bankaAd; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Hesap No</label>
													<input type="text" class="form-control" name="havale_hesapNo" required="" id="no_input" value="<?= $bankaExe->banka_hesapNo; ?>">
												</div>
											</div> -->
											<div class="col-md-6">
												<div class="form-group">
													<label>Cari Adı</label>
													<input type="text" class="form-control" name="havale_cariAdi" required="" id="cariadi_input" value="<?= $cariExe->cari_ad; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Cari Kodu</label>
													<input type="text" class="form-control" name="havale_cariKodu" required="" id="carikodu_input" value="<?= $cariExe->cari_kodu; ?>">
												</div>
											</div>
											
										</div>
										<?php 
											$tarih = $havale->bh_tarih;

											$yeni_tarih = date("d.m.Y", strtotime($tarih));
										?>
										<h4 class="card-title">İşlem Bilgileri</h4>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Tarih</label>
													<input type="text" class="datepicker form-control" name="havale_tarih" required="" autocomplete="off" value="<?= $yeni_tarih; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Tutar</label>
													<input type="number" step="0.01" class="form-control" name="havale_tutar" required="" value="<?php if(!empty($havale->bh_giris)){echo $havale->bh_giris;} else if(!empty($havale->bh_cikis)){echo $havale->bh_cikis;} ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>İşlem Tipi</label>
													<select name="havale_islemTipi" class="select form-control" required="">
														<option value="">İşlem tipi seçiniz...</option>
														<option value="1" <?php if(!empty($havale->bh_giris)){echo "selected";} ?>>Gelen Havale / EFT</option>
														<option value="2" <?php if(!empty($havale->bh_cikis)){echo "selected";} ?>>Giden Havale / EFT</option>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Açıklama</label>
													<textarea class="form-control" name="havale_aciklama"><?= $havale->bh_aciklama; ?></textarea>
												</div>
											</div>
										</div>
										<button type="submit" class="btn btn-danger" style="width:100%;">Güncelle</button>
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


<?php if ($this->session->flashdata('banka_havale_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Banka havale işlemi başarılı bir şekilde işlendi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('banka_havale_updt_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Banka havale işlemi başarılı bir şekilde güncellendi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('banka_hatali')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "error", 
  text: "Banka hesap no veya banka adı kayıtlı değil, lütfen listeden seçerek devam ediniz.",
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

<?php if ($this->session->flashdata('banka_eksi')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "error", 
  text: "Bu girişin ardından seçilen banka eksi bakiyeye düşeceği için işlem iptal edildi, tekrar deneyiniz.",
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
	    $("#no_input").autocomplete({
	        source: "<?= env('BASE_URL'); ?>/banka/autocompleteDataByNumber",
	        minLength: 2,
	        select: function( event, ui ) {
	            event.preventDefault();

				toastr.success(ui.item.value+" hesap numaralı bankaya ait bilgiler getirildi.");

				$("#banka_id").val(ui.item.id);
            	$("#no_input").val(ui.item.value);
            	$("#ad_input").val(ui.item.banka_bankaAd);
	        }
	    });
	});

	$(function() {
	    $("#ad_input").autocomplete({
	        source: "<?= env('BASE_URL'); ?>/banka/autocompleteDataByName",
	        minLength: 2,
	        select: function( event, ui ) {
	            event.preventDefault();

				toastr.success(ui.item.value+" adlı bankaya ait bilgiler getirildi.");

				$("#banka_id").val(ui.item.id);
            	$("#ad_input").val(ui.item.value);
            	$("#no_input").val(ui.item.banka_hesapNo);
	        }
	    });
	});

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
