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
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Giderler</li>
									<li class="breadcrumb-item active">Gider Düzenle</li>
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
									<h4 class="card-title">Gider Düzenle</h4>
									<form action="<?= base_url("giderler/mevcutGiderDuzenle"); ?>" method="POST">
										<input type="hidden" value="<?= $gider->gider_id; ?>" name="gider_id">


										<?php
											if($gider->gider_tur!=NULL && $gider->gider_tur!="Gider")
											{?>
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label>VKN / TCKN</label>
															<input type="hidden" name="gider_tur" value="<?= $tur?>">
															<input type="text" value="<?= $gider->gider_vkn ?>" onblur="vknSorgula()" id="vkn" class="form-control" name="gider_vkn">
															<input type="hidden" id="vknInfoHidden" name="gider_vknInfo" value="<?= $gider->gider_vknInfo ?>">
															<span  id="vknInfoSpan" style="font-size: 11px;">*<?= $gider->gider_vknInfo ?></span>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label><?= $gider->gider_tur ?> No</label>
															<input type="text" value="<?= $gider->gider_fisNo ?>" class="form-control" name="gider_fisno">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>KDV</label>
															<input type="number" value="<?= $gider->gider_kdv ?>" step="0.01" class="form-control" name="gider_kdv">
														</div>
													</div>
												</div>
											<?php }
										?>


										<div class="row">

											<div class="col-md-4">
												<div class="form-group">
													<label>Gider Türü</label>
													<select class="select form-control" name="gider_gkID" id="gkid" required="">
														<option value="">Seçiniz...</option>
														<?php foreach($giderKategorileri as $gk){ ?>
															<option value="<?= $gk->gk_id; ?>" <?php if($gider->gider_gkID == $gk->gk_id){echo "selected";}?>><?= $gk->gk_adi; ?></option>
														<?php }?>
													</select>
												</div>
											</div>

											<?php 
												$giderAltKategoriQ = "SELECT * FROM giderKategorileri WHERE gk_mainID = '$gider->gider_gkID'";
												$giderAltKategoriExe = $this->db->query($giderAltKategoriQ)->result();
											?>

											<div class="altturler col-md-4">
												<div class="form-group">
													<label>Gider Alt Türü</label>
													<select class="select form-control" name="gider_gkSubID" id="gksubid" required="">
														<option value="">Seçiniz...</option>
														<?php foreach($giderAltKategoriExe as $gksub){ ?>
															<option value="<?= $gksub->gk_id; ?>" <?php if($gider->gider_gkSubID == $gksub->gk_id){echo "selected";}?> ><?= $gksub->gk_adi; ?></option>
														<?php }?>
													</select>
												</div>
											</div>

											<?php 
												$giderTarih = $gider->gider_tarih;
												$yeni_giderTarih = date("d.m.Y", strtotime($giderTarih));
											?>

											<div class="col-md-4">
												<div class="form-group">
													<label>Tarih</label>
													<input type="text" class="datepicker form-control" name="gider_tarih" autocomplete="off" required="" value="<?= $yeni_giderTarih; ?>" />
												</div>
											</div>

											<?php 
												$bankam = $gider->gider_bankaID;
												$kasam = $gider->gider_kasaID;
											?>

											<div class="col-md-3">
												<div class="form-group">
													<label>Ödeme Türü</label>
													<select class="select form-control" id="odemeTipi" name="gider_odemeTipi">
															<option value="">Ödeme türü seçiniz...</option>
															<option value="1" <?php if($kasam){echo "selected";} ?>>Kasa</option>
															<option value="2" <?php if($bankam){echo "selected";} ?>>Banka</option>
														</select>
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label>Kasa</label>
													<select class="select form-control" name="gider_kasaID" id="kasa">
															<option value="">Kasa adı seçiniz...</option>
															<?php foreach($kasa as $ksa){?>
																<option value="<?= $ksa->kasa_id; ?>" <?php if($ksa->kasa_id == $gider->gider_kasaID){echo "selected";} ?>> <?= $ksa->kasa_adi; ?></option>
															<?php }	?>
														</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Banka</label>
													<select class="select form-control" name="gider_bankaID" id="banka">
															<option value="">Hesap adı seçiniz...</option>
															<?php foreach($banka as $bnk){?>
																<option value="<?= $bnk->banka_id; ?>" <?php if($bnk->banka_id == $gider->gider_bankaID){echo "selected";} ?>> <?= $bnk->banka_bankaAd." - ".$bnk->banka_hesapAd; ?></option>
															<?php }	?>
														</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Tutar</label>
													<input type="number" step="0.01" class="form-control" name="gider_tutar" required="" value="<?= $gider->gider_tutar; ?>">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Açıklama</label>
													<textarea name="gider_aciklama" class="form-control"><?= $gider->gider_aciklama;?></textarea>
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


	<?php if ($this->session->flashdata('gider_updt_ok')): ?>
	<script>
	swal({
	  title: "Bilgilendirme",
	  type: "success", 
	  text: "Gider kalemi başarılı bir şekilde düzenlendi.",
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
	var odemeTipi = $("#odemeTipi").val();

		if(odemeTipi == 1){
			$("#kasa").prop('disabled', false);
				$("#banka").prop('disabled', true);
		}
    
	    if(odemeTipi == 2){
	    		$("#banka").prop('disabled', false);
				$("#kasa").prop('disabled', true);
	    }
    
});

		$("#odemeTipi").on('change',function(){
				var status = $(this).val();

					if(status == 1){
						$("#kasa").prop('disabled', false);
						document.getElementById("kasa").required = true;
						document.getElementById("banka").required = false;
						$("#banka").prop('disabled', true);
						$("#banka").val('').change();
					}

					if(status == 2){
						$("#banka").prop('disabled', false);
						document.getElementById("banka").required = true;
						document.getElementById("kasa").required = false;
						$("#kasa").prop('disabled', true);
						$("#kasa").val('').change();
					}

			});


		$("#gkid").on('change', function(){
			var statusgk = $(this).val();
			$.ajax({
		        url: "<?= env('BASE_URL'); ?>/giderler/giderAltGetir",
		        method: "POST",
		        data: { gkID : statusgk }, 
		        success: function(result){
					var urunler = result.data;
					var select = '<div class="altturler"><div class="form-group"><label>Gider Alt Türü</label> <select class="form-control" name="gider_gkSubID" id="gksubid" required="">';
					for( var i = 0; i < urunler.length; i++){
						select += '<option value="'+ urunler[i].gk_id +'">'+ urunler[i].gk_adi + '</option>';
					}
					select += '</select></div></div>';
					$('div.altturler').empty().html(select);
					$("#gksubid").select2();
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

	<script>
		function vknSorgula() {
			var vkn = $("#vkn").val();
			$.ajax({
				url: "<?= env('BASE_URL'); ?>/Giderler/gibVknTcknSorgula",
				method: "POST",
				data: {vknTckn: vkn},
				dataType: 'json',
				success: function (result) {
					console.log(result);
					let vknInfo = result.vknInfo;
					document.getElementById("vknInfoHidden").value = vknInfo;
					document.getElementById("vknInfoSpan").innerHTML = "*"+vknInfo;

				}
			});
		}
	</script>
</body>
</html>
