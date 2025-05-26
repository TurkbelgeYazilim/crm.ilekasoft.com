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
								<h3 class="page-title">Kasa</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Kasa</li>
									<li class="breadcrumb-item active">Kasa Tahsilat Düzenle</li>
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
						$kasaID = $tahsilat->kh_kasaID;
						$kasaQ = "SELECT * FROM kasa WHERE kasa_id = '$kasaID' AND kasa_olusturanAnaHesap = '$anaHesap'";
						$kasaExe = $this->db->query($kasaQ)->row();

						$cariID = $tahsilat->kh_cariID;
						$cariQ = "SELECT * FROM cari WHERE cari_id = '$cariID' AND cari_olusturanAnaHesap = '$anaHesap'";
						$cariExe = $this->db->query($cariQ)->row();

					$vaults = getVaultsofCompany();
					?>
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Kasa ve Belge Bilgileri</h4>
									<form action="<?= base_url("kasa/kasaTahsilatGuncelle"); ?>" method="POST">
										<input type="hidden" name="kh_id" value="<?= $tahsilat->kh_id; ?>">

										<input type="hidden" name="cari_id" id="cari_id" value="<?= $cariExe->cari_id; ?>">
										<!--<input type="hidden" name="kasa_id" id="kasa_id" value="<?= $kasaExe->kasa_id; ?>"> -->
										<input type="hidden" name="ch_id" id="ch_id" value="<?= $tahsilat->kh_cariHareketiID; ?>">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Belge / Makbuz No</label>
													<input type="text" class="form-control" name="tahsilat_belgeNo" required="" value="<?=$tahsilat->kh_belgeNumarasi; ?>">
												</div>
											</div>

											<div class="col-md-8">
												<div class="form-group">
													<label>Kasa seçiniz</label>
													<select class="form-control select" name="kasa_id">
														<option value="">Seçiniz...</option>
														<?php foreach($vaults as $va){?>
															<option value="<?= $va->kasa_id; ?>" <?php if($kasaExe->kasa_id == $va->kasa_id){echo "selected";} ?>><?= $va->kasa_adi; ?></option>
														<?php }?>
													</select>
													<!-- <input type="text" class="form-control" name="virman_hedefKasaAdi" required="" id="ad_input2"> -->
												</div>
											</div>


											<!--<div class="col-md-4">
												<div class="form-group">
													<label>Kasa Adı</label>
													<input type="text" class="form-control" name="tahsilat_kasaAdi" required="" id="ad_input" value="<?= $kasaExe->kasa_adi; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Kasa Kodu</label>
													<input type="text" class="form-control" name="tahsilat_kasaKodu" required="" id="kod_input" value="<?= $kasaExe->kasa_kodu; ?>">
												</div>
											</div> -->
											<div class="col-md-6">
												<div class="form-group">
													<label>Cari Adı</label>
													<input type="text" class="form-control" name="tahsilat_cariAdi" required="" id="cariadi_input" value="<?= $cariExe->cari_ad; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Cari Kodu</label>
													<input type="text" class="form-control" name="tahsilat_cariKodu" required="" id="carikodu_input" value="<?= $cariExe->cari_kodu; ?>">
												</div>
											</div>
											
										</div>
										<?php 
											$tarih = $tahsilat->kh_tarih;

											$yeni_tarih = date("d.m.Y", strtotime($tarih));
										?>
										<h4 class="card-title">Ödeme Bilgileri</h4>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Tarih</label>
													<input type="text" class="datepicker form-control" name="tahsilat_tarih" required="" value="<?= $yeni_tarih; ?>" autocomplete="off">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Tutar</label>
													<input type="number" step="0.01" class="form-control" name="tahsilat_tutar" required="" value="<?php if(!empty($tahsilat->kh_giris)){echo $tahsilat->kh_giris;} else if(!empty($tahsilat->kh_cikis)){echo $tahsilat->kh_cikis;} ?>">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Açıklama</label>
													<textarea class="form-control" name="tahsilat_aciklama"><?= $tahsilat->kh_aciklama; ?></textarea>
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

<?php if ($this->session->flashdata('kasa_tahsilat_updt_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Kasa tahsilat işlemi başarılı bir şekilde güncellendi.",
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
