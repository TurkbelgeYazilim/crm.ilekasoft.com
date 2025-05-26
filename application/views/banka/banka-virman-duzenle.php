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
									<li class="breadcrumb-item active">Banka Virman Düzenle</li>
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
						$kaynakBankaQ = "SELECT * FROM banka WHERE banka_id = '$kaynak->bh_bankaID' AND banka_olusturanAnaHesap ='$anaHesap' ";
						$hedefBankaQ = "SELECT * FROM banka WHERE banka_id = '$hedef->bh_bankaID' AND banka_olusturanAnaHesap ='$anaHesap' ";

						$kaynakBanka = $this->db->query($kaynakBankaQ)->row();
						$hedefBanka = $this->db->query($hedefBankaQ)->row();
					?>
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">İşlem Yapılacak Hesap Bilgileri</h4>
									<form action="<?= base_url("banka/mevcutVirmanDuzenle"); ?>" method="POST">

										<input type="hidden" name="virman_id" value="<?= $kaynak->bh_virmanID; ?>">

										<!-- <input type="hidden" name="banka_id" id="banka_id" value="<?= $kaynak->bh_bankaID; ?>">
										<input type="hidden" name="banka_id2" id="banka_id2" value="<?= $hedef->bh_bankaID; ?> "> -->

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Belge No</label>
													<input type="text" class="form-control" name="virman_belgeNo" required="" value="<?= $kaynak->bh_belgeNumarasi; ?>">
												</div>
											</div>
											<?php
											$banks = getBanksofCompany();
											?>

											<div class="col-md-8">
												<div class="form-group">
													<label>Kaynak Banka seçiniz...</label>
													<select class="form-control select" name="banka_id">
														<option value="">Seçiniz...</option>
														<?php foreach($banks as $ba){?>
															<option value="<?= $ba->banka_id; ?>" <?php if($kaynak->bh_bankaID == $ba->banka_id){echo "selected";} ?>><?= $ba->banka_bankaAd; ?></option>
														<?php }?>
													</select>
												</div>
											</div>
											<!--<div class="col-md-4">
												<div class="form-group">
													<label>Kaynak Banka Adı</label>
													<input type="text" class="form-control" name="virman_kaynakBankaAdi" required="" id="ad_input" value="<?= $kaynakBanka->banka_bankaAd;?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Kaynak Hesap No</label>
													<input type="text" class="form-control" name="virman_kaynakHesapNo" required="" id="no_input" value="<?= $kaynakBanka->banka_hesapNo; ?>">
												</div>
											</div> -->
										</div>

										<div class="row">
											<div class="col-md-4">
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<label>Hedef Banka seçiniz...</label>
													<select class="form-control select" name="banka_id2">
														<option value="">Seçiniz...</option>
														<?php foreach($banks as $ba){?>
															<option value="<?= $ba->banka_id; ?>" <?php if($hedef->bh_bankaID == $ba->banka_id){echo "selected";} ?>><?= $ba->banka_bankaAd; ?></option>
														<?php }?>
													</select>
												</div>
											</div>
											<!--<div class="col-md-4">
												<div class="form-group">
													<label>Hedef Banka Adı</label>
													<input type="text" class="form-control" name="virman_hedefBankaAdi" required="" id="ad_input2" value="<?= $hedefBanka->banka_bankaAd;?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Hedef Hesap No</label>
													<input type="text" class="form-control" name="virman_hedefHesapNo" required="" id="no_input2"  value="<?= $hedefBanka->banka_hesapNo; ?>">
												</div>
											</div> -->
										</div>

										<?php 
											$tarih = $kaynak->bh_tarih;

											$yeni_tarih = date("d.m.Y", strtotime($tarih));
										?>

										<h4 class="card-title">İşlem Bilgileri</h4>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Tarih</label>
													<input type="text" class="datepicker form-control" name="virman_tarih" required="" autocomplete="off" value="<?= $yeni_tarih; ?>">
												</div>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<label>Tutar</label>
													<input type="number" step="0.01" class="form-control" name="virman_tutar" required="" value="<?= $kaynak->bh_cikis; ?>">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Açıklama</label>
													<textarea class="form-control" name="virman_aciklama" ><?= $kaynak->bh_aciklama; ?></textarea>
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

<?php if ($this->session->flashdata('banka_mukerrer')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "error", 
  text: "Aynı bankaya virman işlemi yapamazsınız, hedef ve kaynak bankaları farklı olarak seçip tekrar deneyiniz.",
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
  text: "Bu girişin ardından seçilen kaynak banka eksi bakiyeye düşeceği için işlem iptal edildi, tekrar deneyiniz.",
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
	    $("#no_input2").autocomplete({
	        source: "<?= env('BASE_URL'); ?>/banka/autocompleteDataByNumber",
	        minLength: 2,
	        select: function( event, ui ) {
	            event.preventDefault();

				toastr.success(ui.item.value+" hesap numaralı bankaya ait bilgiler getirildi.");

							$("#banka_id2").val(ui.item.id);
            	$("#no_input2").val(ui.item.value);
            	$("#ad_input2").val(ui.item.banka_bankaAd);
	        }
	    });
	});

	$(function() {
	    $("#ad_input2").autocomplete({
	        source: "<?= env('BASE_URL'); ?>/banka/autocompleteDataByName",
	        minLength: 2,
	        select: function( event, ui ) {
	            event.preventDefault();

				toastr.success(ui.item.value+" adlı bankaya ait bilgiler getirildi.");

							$("#banka_id2").val(ui.item.id);
            	$("#ad_input2").val(ui.item.value);
            	$("#no_input2").val(ui.item.banka_hesapNo);
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
