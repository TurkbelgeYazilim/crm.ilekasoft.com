<?php $this->load->view("include/head-tags"); ?>
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
							<h3 class="page-title">Tahsilat</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
								<li class="breadcrumb-item">Tahsilat</li>
								<li class="breadcrumb-item active">Tahsilat Oluştur</li>
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
							<div class="card-body">								<h4 class="card-title">Cari Bilgileri</h4>
								<form action="<?= base_url("tahsilat/tahsilat_kaydet"); ?>" method="POST">
									<input type="hidden" name="cari_id" id="cari_id">
									<input type="hidden" name="tahsilat_cariKodu" id="kod_input">									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label>Cari TCKN/VKN Veya Cari Adı</label>
												<input type="text" class="form-control" name="tahsilat_cariAdi" required="" 
													   id="tcknvkn_input" 
													   placeholder="Cari tckn/vkn veya cari adı yazmaya başlayıp, listeden seçiniz.">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>B/A (Bakiye)</label>
												<div id="cari_bakiye_display" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; background-color: #f8f9fa; min-height: 38px; display: flex; align-items: center;">
													<span class="text-muted">Cari seçildikten sonra bakiye görünecek</span>
												</div>
											</div>
										</div>
									</div>
											<h4 class="card-title">Ödeme Yöntemi</h4>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Ödeme Türü</label>												<select class="select form-control" name="tahsilat_odemeTipi" id="odemeTipi" required="">
													<option value="">Ödeme türü seçiniz...</option>
													<option value="1">Kasa</option>
													<option value="2">Banka</option>
													<option value="3">Çek</option>
													<option value="4">Senet</option>
												</select>
											</div>
										</div>

										<?php
										$vaults = getVaultsofCompany();
										$banks = getBanksofCompany();
										?>										<div class="col-md-4" style="display: none;">
											<div class="form-group">
												<label>Kasa</label>
												<select class="select form-control" name="tahsilat_kasaID" id="kasa" disabled>
													<option value="">Kasa seçiniz...</option>
													<?php foreach($vaults as $va){?>
														<option value="<?= $va->kasa_id; ?>"><?= $va->kasa_adi; ?></option>
													<?php }?>
												</select>
											</div>
										</div><div class="col-md-4">
											<div class="form-group">
												<label>Banka</label>
												<select class="select form-control" name="tahsilat_bankaID" id="banka" disabled>
													<option value="">Banka seçiniz...</option>
													<?php foreach($banks as $ba){?>
														<option value="<?= $ba->banka_id; ?>"><?= $ba->banka_bankaAd." - ".$ba->banka_hesapAd; ?></option>
													<?php }?>
												</select>
											</div>
										</div>
									</div>									<!-- Çek Bilgileri -->
									<div id="cek_alanlari" style="display: none;">
										<h4 class="card-title">Çek Bilgileri</h4>
										<div class="row">
											<?php $bankalarq = "SELECT * FROM turkiyeBankalarListesi";
											$bankalarExe = $this->db->query($bankalarq)->result();
											?>
											<div class="col-md-6">
												<div class="form-group">
													<label>Çek Bankası</label>
													<select class="form-control select" name="cek_bankaID" id="cek_bankaID">
														<option value="">Banka seçiniz...</option>
														<?php foreach($bankalarExe as $banka){?>
															<option value="<?= $banka->trbanka_id?>"><?= $banka->trbanka_ad;?></option>
														<?php }?>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Banka Şubesi</label>
													<input type="text" class="form-control" name="cek_bankaSube" id="cek_bankaSube">
												</div>
											</div>
										</div>
									</div>

									<!-- Senet Bilgileri -->
									<div id="senet_alanlari" style="display: none;">
										<h4 class="card-title">Senet Bilgileri</h4>
										<div class="row">
											<div class="col-md-12">
												<p class="text-muted"><small>Birden fazla senet girebilirsiniz. En az bir senet bilgisi doldurulmalıdır.</small></p>
											</div>
										</div>
										
										<!-- Senet 1 -->
										<div class="row senet-row">
											<div class="col-md-12">
												<h6 class="text-primary">Senet 1</h6>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Tutar</label>
													<input type="number" step="0.01" class="form-control senet-tutar" name="senet_tutar[]" id="senet_tutar_1">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Vade Tarihi</label>
													<input type="text" class="datepicker form-control senet-vade" name="senet_vade[]" id="senet_vade_1" autocomplete="off">
												</div>
											</div>
										</div>

										<!-- Senet 2 -->
										<div class="row senet-row">
											<div class="col-md-12">
												<h6 class="text-primary">Senet 2</h6>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Tutar</label>
													<input type="number" step="0.01" class="form-control senet-tutar" name="senet_tutar[]" id="senet_tutar_2">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Vade Tarihi</label>
													<input type="text" class="datepicker form-control senet-vade" name="senet_vade[]" id="senet_vade_2" autocomplete="off">
												</div>
											</div>
										</div>

										<!-- Senet 3 -->
										<div class="row senet-row">
											<div class="col-md-12">
												<h6 class="text-primary">Senet 3</h6>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Tutar</label>
													<input type="number" step="0.01" class="form-control senet-tutar" name="senet_tutar[]" id="senet_tutar_3">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Vade Tarihi</label>
													<input type="text" class="datepicker form-control senet-vade" name="senet_vade[]" id="senet_vade_3" autocomplete="off">
												</div>
											</div>
										</div>

										<!-- Senet 4 -->
										<div class="row senet-row">
											<div class="col-md-12">
												<h6 class="text-primary">Senet 4</h6>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Tutar</label>
													<input type="number" step="0.01" class="form-control senet-tutar" name="senet_tutar[]" id="senet_tutar_4">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Vade Tarihi</label>
													<input type="text" class="datepicker form-control senet-vade" name="senet_vade[]" id="senet_vade_4" autocomplete="off">
												</div>
											</div>
										</div>

										<!-- Senet 5 -->
										<div class="row senet-row">
											<div class="col-md-12">
												<h6 class="text-primary">Senet 5</h6>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Tutar</label>
													<input type="number" step="0.01" class="form-control senet-tutar" name="senet_tutar[]" id="senet_tutar_5">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Vade Tarihi</label>
													<input type="text" class="datepicker form-control senet-vade" name="senet_vade[]" id="senet_vade_5" autocomplete="off">
												</div>
											</div>
										</div>

										<!-- Senet 6 -->
										<div class="row senet-row">
											<div class="col-md-12">
												<h6 class="text-primary">Senet 6</h6>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Tutar</label>
													<input type="number" step="0.01" class="form-control senet-tutar" name="senet_tutar[]" id="senet_tutar_6">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Vade Tarihi</label>
													<input type="text" class="datepicker form-control senet-vade" name="senet_vade[]" id="senet_vade_6" autocomplete="off">
												</div>
											</div>
										</div>
									</div>

									<h4 class="card-title">Ödeme Bilgileri</h4>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Tarih</label>
												<input type="text" class="datepicker form-control" name="tahsilat_tarih" required="" autocomplete="off" value="<?= getirBugun(); ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Tutar</label>
												<input type="number" step="0.01" class="form-control" name="tahsilat_tutar" required="">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Açıklama</label>
												<textarea class="form-control" name="tahsilat_aciklama"></textarea>
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
	<?php if ($this->session->flashdata('tahsilat_ok')): ?>
	<script>
	swal({
	  title: "Bilgilendirme",
	  type: "success",
	  text: "<?= $this->session->flashdata('tahsilat_ok'); ?>",
	  confirmButtonText:'Tamam',
	  button: false,
	  timer: 5000,
	});
	</script>
	<?php endif; ?>

	<?php if ($this->session->flashdata('tahsilat_hata')): ?>
	<script>
	swal({
	  title: "Bilgilendirme",
	  type: "error", 
	  text: "<?= $this->session->flashdata('tahsilat_hata'); ?>",
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

<script>	$(function() {
	    $("#tcknvkn_input").autocomplete({
	        source: "<?= base_url(); ?>fatura/autocompleteDataByTcknVknEarsiv",
	        minLength: 4,
	        select: function( event, ui ) {
	            event.preventDefault();

				$("#cari_id").val(ui.item.id);
            	$("#tcknvkn_input").val(ui.item.value);
            	$("#kod_input").val(ui.item.cari_kodu);
            	
            	// Bakiye bilgisini getir
            	cariBakiyeGetir(ui.item.id);
	        }
	    });
	});

	// Clear fields when input is empty
	$("#tcknvkn_input").on("keyup", function () {
		var input = $("#tcknvkn_input").val();

		if(input == "") {
			$("#cari_id").val("");
			$("#kod_input").val("");
			$("#cari_bakiye_display").html('<span class="text-muted">Cari seçildikten sonra bakiye görünecek</span>');
		}
	});
	// Cari bakiye getir fonksiyonu
	function cariBakiyeGetir(cari_id) {
		$.ajax({
			url: "<?= base_url(); ?>cari/cariBakiyeGetir",
			type: "POST",
			data: {
				cari_id: cari_id
			},
			dataType: "json",
			success: function(response) {
				if(response.success) {
					$("#cari_bakiye_display").html(response.bakiye);
				} else {
					$("#cari_bakiye_display").html('<span class="text-danger">Bakiye alınamadı</span>');
				}
			},
			error: function() {
				$("#cari_bakiye_display").html('<span class="text-danger">Bakiye alınamadı</span>');
			}
		});
	}	// Payment method selection logic
	$("#odemeTipi").on('change',function(){
		var status = $(this).val();

		if(status == 1){
			$("#kasa").prop('disabled', false);
			$("#banka").prop('disabled', true);
			$("#banka").val('').change();
			$("#cek_alanlari").hide();
			clearCekFields();
			
			// Auto-select user's default kasa if available
			<?php if (isset($user_default_kasa_id) && $user_default_kasa_id): ?>
			$("#kasa").val('<?php echo $user_default_kasa_id; ?>').change();
			<?php endif; ?>
		}

		if(status == 2){
			$("#banka").prop('disabled', false);
			$("#kasa").prop('disabled', true);
			$("#kasa").val('').change();
			$("#cek_alanlari").hide();
			clearCekFields();
		}
		if(status == 3){
			$("#kasa").prop('disabled', true);
			$("#banka").prop('disabled', true);
			$("#kasa").val('').change();
			$("#banka").val('').change();
			$("#cek_alanlari").show();
			$("#senet_alanlari").hide();
			// Çek alanlarını zorunlu yap
			makeCekFieldsRequired(true);
			clearSenetFields();
		}

		if(status == 4){
			$("#kasa").prop('disabled', true);
			$("#banka").prop('disabled', true);
			$("#kasa").val('').change();
			$("#banka").val('').change();
			$("#cek_alanlari").hide();
			$("#senet_alanlari").show();
			clearCekFields();
			// Senet alanlarını zorunlu yap
			makeSenetFieldsRequired(true);
		}

		if(status == ''){
			$("#kasa").prop('disabled', true);
			$("#banka").prop('disabled', true);
			$("#kasa").val('').change();
			$("#banka").val('').change();
			$("#cek_alanlari").hide();
			$("#senet_alanlari").hide();
			clearCekFields();
			clearSenetFields();
		}
	});
	// Çek alanlarını temizle
	function clearCekFields() {
		$("#cek_bankaID").val('').change();
		$("#cek_bankaSube").val('');
		makeCekFieldsRequired(false);
	}	// Çek alanlarını zorunlu/opsiyonel yap
	function makeCekFieldsRequired(required) {
		$("#cek_bankaID").prop('required', required);
		$("#cek_bankaSube").prop('required', required);
	}

	// Senet alanlarını temizle
	function clearSenetFields() {
		$('.senet-tutar').val('');
		$('.senet-vade').val('');
		makeSenetFieldsRequired(false);
	}

	// Senet alanlarını zorunlu/opsiyonel yap
	function makeSenetFieldsRequired(required) {
		// En az bir senet tutarı zorunlu olsun
		if(required) {
			$('#senet_tutar_1').prop('required', true);
			$('#senet_vade_1').prop('required', true);
		} else {
			$('.senet-tutar').prop('required', false);
			$('.senet-vade').prop('required', false);
		}
	}
</script>

</body>
</html>
