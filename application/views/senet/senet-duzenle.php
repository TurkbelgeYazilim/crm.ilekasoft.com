<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/main.min.css">
	<link rel="stylesheet" href="vendor/overlay-scroll/OverlayScrollbars.min.css">

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
								<h3 class="page-title">Senet</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Senet</li>
									<li class="breadcrumb-item active">Senet Düzenle</li>
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
									<div style="width: 100%; overflow: auto;">
										<h4 style="float: left;">Senet Düzenle</h4>
										<button class="btn btn-danger" style="float: right; margin-top: 5px;">Senet Evrağı Yükle</button>
									</div>
									        <!-- Add Modals Here -->
        <div class="modals-placeholder">

          <!-- Modal 1 -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Dosya yükle</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Kapat</button>
                  <button type="button" class="btn btn-success" data-bs-dismiss="modal">Kaydet</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
									<form action="<?= base_url("senet/senetGuncelle"); ?>" method="POST" id="myform">
										<input type="hidden" name="senet_cariID" id="cari_id" value="<?= $senet->senet_cariID ?>">
										<input type="hidden" name="senet_id"  value="<?= $senet->senet_id?>">
										<div class="col-md-offset-12">
											<div class="form-group">
												<label>Hareket Tipi</label>
												<select class="form-control select" name="senet_hareketTipi" required="" id="hareketTipi">
													<option value="">Hareket tipi seçiniz...</option>
													<option value="1" <?php if($senet->senet_hareketTipi==1) echo "selected"; ?>>Alınan senet</option>
													<option value="2" <?php if($senet->senet_hareketTipi==2) echo "selected"; ?>>Verilen senet (kendi senedimiz)</option>
												</select>
											</div>
										</div>
										<div class="row">
											<?php $carisql="select * from cari where cari_id=$senet->senet_cariID";
											$cariexe=$this->db->query($carisql)->row();

											?>
											<div class="col-md-12">
												<div class="form-group">
													<label>Cari seçiniz</label>
													<input type="text" class="form-control" name="senet_cariAd" required="" id="cariadi_input" placeholder="Lütfen cari adını yazmaya başlayıp daha sonra listeden seçiniz..." value="<?= $cariexe->cari_ad." ".$cariexe->cari_soyad ?>">
												</div>
											</div>


											<div class="col-md-12">
												<div class="form-group">
													<label>Kayıt tarihi</label>
													<input type="text" class="datepicker form-control" name="senet_kayitTarihi" required="" autocomplete="off" value="<?= $senet->senet_kayitTarihi ?>">
												</div>
											</div>
											
											<div class="col-md-12">
												<div class="form-group">
													<label>Not / açıklama</label>
													<textarea name="senet_notAciklama" class="form-control"><?= $senet->senet_notAciklama ?></textarea>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label>Portföy No</label>
													<input type="text" class="form-control" name="senet_portfoyNo" required=""  value="<?= $senet->senet_portfoyNo ?>">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label>Seri No</label>
													<input type="text" class="form-control" name="senet_seriNo" required="" value="<?= $senet->senet_seriNo ?>">
												</div>
											</div>

											<div class="col-md-12">
												<?php
												// Önce senet_borcluID değerini alın
												$borclu_id = $senet->senet_borcluID;

												// Bu ID'yi kullanarak cari tablosundan cari_ad'ı çekin
												$carisql = "SELECT cari_ad FROM cari WHERE cari_id = ?";
												$cari_query = $this->db->query($carisql, array($borclu_id));
												$cari_result = $cari_query->row();

												// Sonuçta cari_ad değeri varsa, bu değeri bir değişkene ata
												if ($cari_result) {
													$cari_ad = $cari_result->cari_ad;
												} else {
													$cari_ad = "Bilgi Bulunamadı";
												}

												// Cari adını HTML'de kullan
												?>
												<div class="form-group">
													<label>Borçlu</label>
													<input type="text" class="form-control" name="senet_borcluAd" value="<?= $cari_ad ?>" required>
												</div>
											</div>

											<input type="hidden" name="senet_borcluID" id="borcluID" value="<?= $senet->senet_borcluID ?>">

											<div class="col-md-12">
												<div class="form-group">
													<label>Vadesi</label>
													<input type="text" class="datepicker form-control" name="senet_vadeTarih" required="" autocomplete="off" value="<?= $senet->senet_vadeTarih  ?>">
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label>Tutar</label>
													<input type="number" class="form-control" name="senet_tutar" required="" value="<?= $senet->senet_tutar ?>">
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

		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
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
				$("#cariadi_input").autocomplete({
					source: "<?= env('BASE_URL'); ?>/kasa/autocompleteDataByNameCari",
					minLength: 2,
					select: function( event, ui ) {
						event.preventDefault();

						var hareketTipi = $("#hareketTipi option:selected").val();

						var firmaID = <?= $firmaID; ?>;
						var firmaAd = "<?= $firmaAd; ?>";

						if(hareketTipi == 1) {//borçlu seçilen cari
							$("#borclu").val(ui.item.value);
							$("#borcluID").val(ui.item.id);
						}else if(hareketTipi == 2){//borçlu kendi firması
							$("#borclu").val(firmaAd);
							$("#borcluID").val(firmaID);
						}

						toastr.success(ui.item.value+" isimli cariye ait bilgiler getirildi.");

						$("#cari_id").val(ui.item.id);
						$("#cariadi_input").val(ui.item.value);
					}
				});
			});

			//ID: hareketTipi değiştiği zaman ID: gizle aktif et
			$("#hareketTipi").on('change',function() {
				var hareketTipiText = $("#hareketTipi option:selected").text();
				var hareketTipi = $("#hareketTipi option:selected").val();

				if(hareketTipi == 1){
					$('#myform')[0].reset();
					$('#hareketTipi').val("1");
					$("#gizle").css("display", "block");
				}else if(hareketTipi == 2){
					$('#myform')[0].reset();
					$('#hareketTipi').val("2");
					$("#gizle").css("display", "block");
				}else{
					$('#myform')[0].reset();
					$("#gizle").css("display", "none");
				}
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