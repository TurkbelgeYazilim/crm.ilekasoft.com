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
									<li class="breadcrumb-item active">Kasa Devir Kartı Düzenle</li>
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
						$kasaID = $devirKarti->kh_kasaID;
						$kasaQ = "SELECT * FROM kasa WHERE kasa_id = '$kasaID' AND kasa_olusturanAnaHesap = '$anaHesap'";
						$kasaExe = $this->db->query($kasaQ)->row();
					?>
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Devir Olunacak Kasa Bilgileri</h4>
									<form action="<?= base_url("kasa/kasaDevirKartiGuncelle"); ?>" method="POST">
										<input type="hidden" name="kh_id" value="<?= $devirKarti->kh_id; ?>">
										<input type="hidden" name="kasa_id" id="kasa_id" value="<?= $kasaExe->kasa_id; ?>">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Belge No</label>
													<input type="text" class="form-control" name="devir_belgeNo" value="<?= $devirKarti->kh_belgeNumarasi; ?>" required="">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Kasa Adı</label>
													<input type="text" class="form-control" name="devir_kasaAdi" required="" id="ad_input" value="<?= $kasaExe->kasa_adi;?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Kasa Kodu</label>
													<input type="text" class="form-control" name="devir_kasaKodu" required="" id="kod_input" value="<?= $kasaExe->kasa_kodu; ?>">
												</div>
											</div>
											
										</div>
										<?php 
											$tarih = $devirKarti->kh_tarih;

											$yeni_tarih = date("d.m.Y", strtotime($tarih));
										?>
										<h4 class="card-title">İşlem Bilgileri</h4>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Tarih</label>
													<input type="text" class="datepicker form-control" name="devir_tarih" required="" value="<?= $yeni_tarih; ?>" autocomplete="off">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Tutar</label>
													<input type="number" step="0.01" class="form-control" name="devir_tutar" required="" value="<?php if(!empty($devirKarti->kh_giris)){echo $devirKarti->kh_giris;} else if(!empty($devirKarti->kh_cikis)){echo $devirKarti->kh_cikis;} ?>" >
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>İşlem Tipi</label>
													<select name="devir_islemTipi" class="select form-control" required="">
														<option value="">İşlem tipi seçiniz...</option>
														<option value="1" <?php if(!empty($devirKarti->kh_giris)){echo "selected";} ?>>Giriş işlemi</option>
														<option value="2" <?php if(!empty($devirKarti->kh_cikis)){echo "selected";} ?>>Çıkış işlemi</option>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Açıklama</label>
													<textarea class="form-control" name="devir_aciklama"><?= $devirKarti->kh_aciklama; ?></textarea>
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

<?php if ($this->session->flashdata('kasa_devir_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Kasa devir işlemi başarılı bir şekilde gerçekleştirildi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('kasa_devir_updt_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Kasa devir işlemi başarılı bir şekilde güncellendi.",
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

<?php if ($this->session->flashdata('kasa_eksi')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "error", 
  text: "Bu girişin ardından seçilen kasa eksi bakiyeye düşeceği için işlem iptal edildi, tekrar deneyiniz.",
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
