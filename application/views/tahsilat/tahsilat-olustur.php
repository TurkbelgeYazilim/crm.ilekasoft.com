<!DOCTYPE html>

<html lang="tr">

<head>

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

	

	/* Senet detay kartları için özel stiller */

	.senet-card {

		transition: transform 0.2s ease, box-shadow 0.2s ease;

	}

	

	.senet-card:hover {

		transform: translateY(-2px);

		box-shadow: 0 4px 8px rgba(0,0,0,0.1);

	}

	

	.senet-card .card-header {

		font-weight: 600;

		border-bottom: 2px solid rgba(255,255,255,0.2);

	}

	

	/* Kontrol alanları için grid layout */

	.senet-kontrol-alanlari {

		background: #f8f9fa;

		border-radius: 8px;

		padding: 20px;

		margin-bottom: 20px;

		border: 1px solid #e9ecef;

	}

	

	.senet-kontrol-alanlari .form-group label {

		font-weight: 600;

		color: #495057;

	}

	

	/* Senet detayları için animasyon */

	#senet_detaylari {

		animation: fadeInUp 0.3s ease;

	}

	

	/* Senet dosya upload alanları */

	.senet-dosya-alani {

		background: #f8f9fa;

		border-radius: 6px;

		padding: 15px;

		border: 1px dashed #dee2e6;

		margin-top: 10px;

	}

	

	.senet-dosya-alani:hover {

		border-color: #007bff;

		background: #e7f1ff;

	}

	

	.senet-dosya-alani label {

		margin-bottom: 8px;

		font-weight: 500;

	}

	

	.senet-dosya-alani .form-control {

		border: none;

		background: transparent;

		padding: 8px 0;

	}

		.senet-dosya-alani small.text-muted {

		font-size: 0.75rem;

		margin-top: 5px;

		display: block;

	}

	

	.senet-dosya-alani.has-error {

		border-color: #dc3545;

		background-color: #f8d7da;

	}

	

	.senet-dosya-alani .file-error {

		color: #721c24 !important;

		font-weight: 500;

	}

	

	.senet-dosya-alani .file-success {

		color: #155724 !important;

		font-weight: 500;

	}

	

	@keyframes fadeInUp {

		from {

			opacity: 0;

			transform: translateY(20px);

		}

		to {

			opacity: 1;

			transform: translateY(0);

		}	}

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

								<form id="tahsilatForm" action="<?= base_url("tahsilat/tahsilat_kaydet"); ?>" method="POST" enctype="multipart/form-data">

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

										<div class="col-md-4">											<div class="form-group">

												<label>Ödeme Türü</label>												<select class="select form-control" name="tahsilat_odemeTipi" id="odemeTipi" required="">

													<option value="">Ödeme türü seçiniz...</option>

													<option value="1">Kasa</option>

													<option value="2">Banka / POS</option>

													<option value="3">Çek</option>

													<option value="4">Senet</option>

												</select>

											</div>

										</div>



										<?php

$vaults = getVaultsofCompany();

$banks = getBanksofCompany();

										?>										<div class="col-md-4" id="kasa_dropdown_container" style="display: none;">

											<div class="form-group">

												<label>Kasa</label>

												<?php if (isset($user_assigned_kasa) && $user_assigned_kasa): ?>

													<select class="select form-control" name="tahsilat_kasaID" id="kasa" disabled>

														<option value="<?= $user_assigned_kasa->kasa_id; ?>" selected><?= $user_assigned_kasa->kasa_adi; ?></option>

													</select>

													<small class="text-success">Size atanmış kasa otomatik seçilmiştir.</small>

												<?php else: ?>

													<select class="select form-control" name="tahsilat_kasaID" id="kasa" disabled>

														<option value="">Kasa bulunamadı</option>

													</select>

													<small class="text-danger">Size atanmış bir kasa bulunmuyor. Lütfen sistem yöneticisi ile iletişime geçin.</small>

												<?php endif; ?>

											</div>

										</div>



										<div class="col-md-4" id="banka_dropdown_container">

											<div class="form-group">

												<label>Banka</label>

												<select class="select form-control" name="tahsilat_bankaID" id="banka" disabled>

													<option value="">Banka seçiniz...</option>

													<?php foreach($banks as $ba){?>

														<option value="<?= $ba->banka_id; ?>"><?= $ba->banka_bankaAd." - ".$ba->banka_hesapAd; ?></option>

													<?php }?>

												</select>

											</div>

										</div>										<div class="col-md-12" id="banka_dosya_alani" style="display: none;">

											<div class="form-group">

												<label>Dekont/Banka Belgesi <small class="text-muted">(İsteğe bağlı - JPG, PNG, GIF, PDF - Max: 5MB)</small></label>

												<input type="file" class="form-control" name="banka_gorsel" id="banka_gorsel" accept=".jpg,.jpeg,.png,.gif,.pdf">

												<small class="text-muted">Mobilde: Dosya seçtikten sonra başka uygulama açmayın</small>

												<small class="text-muted">Dekont ya da banka belgesini yükleyebilirsiniz</small>

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

											</div>											<div class="col-md-6">

												<div class="form-group">

													<label>Banka Şubesi</label>

													<input type="text" class="form-control" name="cek_bankaSube" id="cek_bankaSube">

												</div>

											</div>

											<div class="col-md-12">

												<div class="form-group">

													<label>Çek Görseli <small class="text-muted">(İsteğe bağlı - JPG, PNG, GIF, PDF - Max: 5MB)</small></label>

													<input type="file" class="form-control" name="cek_gorsel" id="cek_gorsel" accept=".jpg,.jpeg,.png,.gif,.pdf">

													<small class="text-muted">Mobilde: Dosya seçtikten sonra başka uygulama açmayın</small>

													<small class="text-muted">Çek görselini yükleyebilirsiniz</small>

												</div>

											</div>

										</div>

									</div>



									<!-- Senet Bilgileri -->

									<div id="senet_alanlari" style="display: none;">

										<h4 class="card-title">Senet Bilgileri</h4>

												<!-- Senet Kontrol Alanları -->

										<div class="senet-kontrol-alanlari">

											<div class="row">

												<div class="col-md-4">

													<div class="form-group">

														<label>Senet Birim Tutarı</label>

														<input type="number" step="0.01" class="form-control" name="senet_tutari" id="senet_tutari" placeholder="Örn: 1000">

														<small class="text-muted">Her bir senedin tutarı</small>

													</div>

												</div>

												<div class="col-md-4">

													<div class="form-group">

														<label>Senet Adedi</label>

														<input type="number" min="1" max="10" class="form-control" name="senet_adedi" id="senet_adedi" placeholder="Örn: 3">

														<small class="text-muted">Kaç adet senet (1-10)</small>

													</div>

												</div>

												<div class="col-md-4">

													<div class="form-group">

														<label>İlk Vade Tarihi</label>

														<input type="text" class="datepicker form-control" name="senet_vade_tarihi" id="senet_vade_tarihi" autocomplete="off" placeholder="gg.aa.yyyy">

														<small class="text-muted">İlk senedin vade tarihi</small>

													</div>

												</div>

											</div>

										</div>

										

										<!-- Dinamik Senet Detay Alanları -->

										<div id="senet_detaylari" style="display: none;">

											<hr>

											<h5 class="text-primary">Senet Detayları</h5>

											<div id="senet_detay_container">

												<!-- Dinamik senet kutucukları buraya gelecek -->

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

										</div>										<div class="col-md-6">

											<div class="form-group">

												<label>Tutar</label>

												<input type="number" step="0.01" class="form-control" name="tahsilat_tutar" id="tahsilat_tutar" required="">

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



	$(function() {

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

	});	// Cari bakiye getir fonksiyonu

	function cariBakiyeGetir(cari_id) {

		console.log('Bakiye getiriliyor, cari_id:', cari_id);

		$.ajax({

			url: "<?= base_url(); ?>cari/cariBakiyeGetir",

			type: "POST",

			data: {

				cari_id: cari_id

			},

			dataType: "json",

			success: function(response) {

				console.log('Bakiye response:', response);

				if(response.success) {

					$("#cari_bakiye_display").html(response.bakiye);

				} else {

					$("#cari_bakiye_display").html('<span class="text-danger">Bakiye alınamadı: ' + (response.message || 'Bilinmeyen hata') + '</span>');

				}

			},

			error: function(xhr, status, error) {

				console.error('Bakiye Ajax hatası:', error);

				console.error('Status:', status);

				console.error('Response:', xhr.responseText);

				$("#cari_bakiye_display").html('<span class="text-danger">Bakiye alınamadı (bağlantı hatası)</span>');

			}

		});

	}	// Payment method selection logic

	$("#odemeTipi").on('change',function(){

		var status = $(this).val();

		

		if(status == 1){

			// Show kasa dropdown, hide banka dropdown

			$("#kasa_dropdown_container").show();

			$("#banka_dropdown_container").hide();

			

			$("#kasa").prop('disabled', false);

			$("#banka").prop('disabled', true);

			$("#banka").val('').change();

			$("#cek_alanlari").hide();

			$("#senet_alanlari").hide();

			$("#banka_dosya_alani").hide();

			clearCekFields();

			clearSenetFields();

			// Tutar alanını aktif yap

			$("#tahsilat_tutar").prop('disabled', false).prop('required', true);

			

			// Auto-select and disable user's assigned kasa if available

			<?php if (isset($user_assigned_kasa) && $user_assigned_kasa): ?>

			$("#kasa").val('<?php echo $user_assigned_kasa->kasa_id; ?>').change();

			$("#kasa").prop('disabled', true); // Disable so user cannot change it

			

			// Disabled alanın değerini göndermek için hidden input ekle

			var hiddenKasaInput = $('input[name="tahsilat_kasaID_hidden"]');

			if (hiddenKasaInput.length === 0) {

				$('#tahsilatForm').append('<input type="hidden" name="tahsilat_kasaID_hidden" value="<?php echo $user_assigned_kasa->kasa_id; ?>">');

			} else {

				hiddenKasaInput.val('<?php echo $user_assigned_kasa->kasa_id; ?>');

			}

			<?php else: ?>

			// If user has no assigned kasa, show warning and disable form submission

			$("#kasa").prop('disabled', true);

			// Hidden input'u kaldır

			$('input[name="tahsilat_kasaID_hidden"]').remove();

			alert('Size atanmış bir kasa bulunmuyor. Kasa ödemesi yapabilmek için lütfen sistem yöneticisi ile iletişime geçin.');

			<?php endif; ?>

		}

		

		if(status == 2){

			// Show banka dropdown, hide kasa dropdown

			$("#banka_dropdown_container").show();

			$("#kasa_dropdown_container").hide();

			

			$("#banka").prop('disabled', false);

			$("#kasa").prop('disabled', true);

			$("#kasa").val('').change();

			$("#cek_alanlari").hide();

			$("#senet_alanlari").hide();

			$("#banka_dosya_alani").show();

			clearCekFields();

			clearSenetFields();

			// Tutar alanını aktif yap

			$("#tahsilat_tutar").prop('disabled', false).prop('required', true);

			// Dosya yükleme event'lerini bağla

			bindFileUploadEvents();

			

			// Kasa hidden input'unu temizle

			$('input[name="tahsilat_kasaID_hidden"]').remove();

		}

		

		if(status == 3){

			// Hide both dropdowns for check payment

			$("#kasa_dropdown_container").hide();

			$("#banka_dropdown_container").hide();

			

			$("#kasa").prop('disabled', true);

			$("#banka").prop('disabled', true);

			$("#kasa").val('').change();

			$("#banka").val('').change();

			$("#cek_alanlari").show();

			$("#senet_alanlari").hide();

			$("#banka_dosya_alani").hide();

			// Çek alanlarını zorunlu yap

			makeCekFieldsRequired(true);

			

			// Kasa hidden input'unu temizle

			$('input[name="tahsilat_kasaID_hidden"]').remove();

			clearSenetFields();

			// Tutar alanını aktif yap

			$("#tahsilat_tutar").prop('disabled', false).prop('required', true);

			// Dosya yükleme event'lerini bağla

			bindFileUploadEvents();

		}

		

		if(status == 4){

			// Hide both dropdowns for promissory note payment

			$("#kasa_dropdown_container").hide();

			$("#banka_dropdown_container").hide();

			

			$("#kasa").prop('disabled', true);

			$("#banka").prop('disabled', true);

			$("#kasa").val('').change();

			$("#banka").val('').change();

			$("#cek_alanlari").hide();

			$("#senet_alanlari").show();

			$("#banka_dosya_alani").hide();

			clearCekFields();

			// Senet alanlarını zorunlu yap

			makeSenetFieldsRequired(true);

			// Tutar alanını pasif yap ve zorunlu olmaktan çıkar

			$("#tahsilat_tutar").prop('disabled', true).prop('required', false).val('');

			// Dosya yükleme event'lerini bağla

			bindFileUploadEvents();

			

			// Kasa hidden input'unu temizle

			$('input[name="tahsilat_kasaID_hidden"]').remove();

			

			// Mobil kullanıcılar için özel uyarı

			if (isMobile()) {

				swal({

					title: "Mobil Senet Ödeme",

					type: "info",

					text: "Mobil cihazınızdan senet ödemesi yapıyorsunuz. Dosya yüklemeleri isteğe bağlıdır ve sorunsuz işlenecek.",

					confirmButtonText: 'Anladım',

					timer: 3000

				});

			}

		}

		

		if(status == ''){

			// Hide both dropdowns when no payment method selected

			$("#kasa_dropdown_container").hide();

			$("#banka_dropdown_container").hide();

			

			$("#kasa").prop('disabled', true);

			$("#banka").prop('disabled', true);

			$("#kasa").val('').change();

			$("#banka").val('').change();

			$("#cek_alanlari").hide();

			$("#senet_alanlari").hide();

			$("#banka_dosya_alani").hide();

			clearCekFields();

			clearSenetFields();

			// Tutar alanını aktif yap

			$("#tahsilat_tutar").prop('disabled', false).prop('required', true);

			

			// Kasa hidden input'unu temizle

			$('input[name="tahsilat_kasaID_hidden"]').remove();

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

		// Kontrol alanlarını temizle

		$("#senet_tutari").val('');

		$("#senet_adedi").val('');

		$("#senet_vade_tarihi").val('');

		

		// Dinamik alanları temizle

		$("#senet_detay_container").html('');

		$("#senet_detaylari").hide();

		

		makeSenetFieldsRequired(false);

	}



	// Senet alanlarını zorunlu/opsiyonel yap

	function makeSenetFieldsRequired(required) {

		// Kontrol alanlarını zorunlu yap

		$("#senet_tutari").prop('required', required);

		$("#senet_adedi").prop('required', required);

		$("#senet_vade_tarihi").prop('required', required);

		

		// Dinamik alanları da zorunlu yap

		if(required) {

			$('.senet-tutar').prop('required', true);

			$('.senet-vade').prop('required', true);

		} else {

			$('.senet-tutar').prop('required', false);

			$('.senet-vade').prop('required', false);

		}

	}

	

	// Senet detayları üret

	function generateSenetDetails() {

		var senetTutari = parseFloat($("#senet_tutari").val()) || 0;

		var senetAdedi = parseInt($("#senet_adedi").val()) || 0;

		var ilkVadeTarihi = $("#senet_vade_tarihi").val();

		

		// Validasyon

		if (senetTutari <= 0 || senetAdedi <= 0 || ilkVadeTarihi == '') {

			$("#senet_detaylari").hide();

			$("#senet_detay_container").html('');

			updateTahsilatTutar();

			return;

		}

		

		// Maksimum 10 senet kontrolü

		if (senetAdedi > 10) {

			swal({

				title: "Uyarı",

				type: "warning",

				text: "Maksimum 10 adet senet oluşturabilirsiniz.",

				confirmButtonText: 'Tamam'

			});

			$("#senet_adedi").val(10);

			senetAdedi = 10;

		}

		

		var html = '';

		var toplamTutar = 0;

		

		// İlk vade tarihini parse et

		var vadeTarihi = parseDate(ilkVadeTarihi);

		if (!vadeTarihi) {

			$("#senet_detaylari").hide();

			$("#senet_detay_container").html('');

			return;

		}

		

		// Senet kutucuklarını oluştur

		for (var i = 1; i <= senetAdedi; i++) {

			var currentVadeTarihi = new Date(vadeTarihi);

			currentVadeTarihi.setMonth(currentVadeTarihi.getMonth() + (i - 1));

			var vadeTarihiFormatted = formatDate(currentVadeTarihi);

			

			toplamTutar += senetTutari;

					html += '<div class="col-md-6 mb-3">';

			html += '  <div class="card border-primary senet-card">';

			html += '    <div class="card-header bg-primary text-white">';

			html += '      <h6 class="mb-0"><i class="fa fa-file-text-o mr-2"></i>Senet ' + i + '</h6>';

			html += '    </div>';

			html += '    <div class="card-body">';			html += '      <div class="row">';

			html += '        <div class="col-md-6">';

			html += '          <div class="form-group">';

			html += '            <label><i class="fa fa-lira mr-1"></i>Tutar</label>';

			html += '            <input type="number" step="0.01" class="form-control senet-tutar" name="senet_tutar[]" value="' + senetTutari + '" required>';

			html += '          </div>';

			html += '        </div>';

			html += '        <div class="col-md-6">';

			html += '          <div class="form-group">';

			html += '            <label><i class="fa fa-calendar mr-1"></i>Vade Tarihi</label>';

			html += '            <input type="text" class="datepicker form-control senet-vade" name="senet_vade[]" value="' + vadeTarihiFormatted + '" autocomplete="off" required>';

			html += '          </div>';

			html += '        </div>';

			html += '      </div>';

			html += '      <div class="row">';

			html += '        <div class="col-md-12">';

			html += '          <div class="form-group senet-dosya-alani">';

			html += '            <label><i class="fa fa-upload mr-1"></i>Senet Görseli <small class="text-muted">(İsteğe bağlı - JPG, PNG, GIF - Max: 5MB)</small></label>';

			html += '            <input type="file" class="form-control senet-gorsel" name="senet_gorsel[]" accept=".jpg,.jpeg,.png,.gif">';

			html += '            <small class="text-muted">Mobilde: Dosya seçtikten sonra başka uygulama açmayın</small>';

			html += '            <small class="text-muted">Senet görselini yükleyebilirsiniz</small>';

			html += '          </div>';

			html += '        </div>';

			html += '      </div>';

			html += '    </div>';

			html += '  </div>';

			html += '</div>';

		}

				// HTML'i ekle

		$("#senet_detay_container").html('<div class="row">' + html + '</div>');

		$("#senet_detaylari").show();

		

		// Datepicker'ları yeniden başlat

		$('.datepicker').datepicker({

			dateFormat: 'dd.mm.yy',

			language: 'tr'

		});

		

		// Toplam tutarı güncelle

		updateTahsilatTutar();

		

		// Senet detay değişikliklerini dinle

		bindSenetDetailEvents();

		

		// Dosya yükleme event'lerini bağla

		bindFileUploadEvents();

	}

	

	// Tarih parse fonksiyonu (dd.mm.yyyy formatından Date objesine)

	function parseDate(dateString) {

		var parts = dateString.split('.');

		if (parts.length !== 3) return null;

		

		var day = parseInt(parts[0], 10);

		var month = parseInt(parts[1], 10) - 1; // JavaScript ayları 0-11 arası

		var year = parseInt(parts[2], 10);

		

		return new Date(year, month, day);

	}

	

	// Tarih formatla fonksiyonu (Date objesinden dd.mm.yyyy formatına)

	function formatDate(date) {

		var day = date.getDate().toString().padStart(2, '0');

		var month = (date.getMonth() + 1).toString().padStart(2, '0');

		var year = date.getFullYear();

		

		return day + '.' + month + '.' + year;

	}

	

	// Tahsilat tutarını güncelle

	function updateTahsilatTutar() {

		var toplamTutar = 0;

		$('.senet-tutar').each(function() {

			var tutar = parseFloat($(this).val()) || 0;

			toplamTutar += tutar;

		});

		

		$("#tahsilat_tutar").val(toplamTutar.toFixed(2));

	}

	

	// Senet detay event'lerini bağla

	function bindSenetDetailEvents() {

		// Senet tutarı değiştiğinde toplam tutarı güncelle

		$(document).off('input', '.senet-tutar').on('input', '.senet-tutar', function() {

			updateTahsilatTutar();

		});

	}

		// Kontrol alanları değiştiğinde senet detaylarını yeniden üret

	$("#senet_tutari, #senet_adedi, #senet_vade_tarihi").on('input change', function() {

		generateSenetDetails();

	});

		// Dosya yükleme event'lerini bağla

	function bindFileUploadEvents() {

		// Dinamik olarak eklenen dosya input'ları için event delegation

		$(document).off('change', '.senet-gorsel').on('change', '.senet-gorsel', function() {

			// Mobilde senet dosya validasyonunu çok basit tut

			if (isMobile()) {

				var $container = $(this).closest('.senet-dosya-alani');

				$container.find('.file-error, .file-success').remove();

				$container.removeClass('has-error');

				

				if (this.files && this.files[0]) {

					showFileSuccess($container, 'Mobil: Dosya kabul edildi - ' + this.files[0].name);

				}

				return true; // Mobilde her zaman geçerli

			} else {

				validateFileUpload(this);

			}

		});

				// Banka ve çek dosya upload'ları için

		$(document).off('change', '#banka_gorsel').on('change', '#banka_gorsel', function() {

			validateBankaCekFileUpload(this, 'dekont');

		});

		

		$(document).off('change', '#cek_gorsel').on('change', '#cek_gorsel', function() {

			validateBankaCekFileUpload(this, 'çek');

		});

	}

	

	// Mobil-friendly dosya yükleme validasyonu

	function validateFileUpload(input) {

		var file = input.files[0];

		var $input = $(input);

		var $container = $input.closest('.senet-dosya-alani');

		

		// Önceki hata mesajlarını temizle

		$container.find('.file-error, .file-success').remove();

		$container.removeClass('has-error');

		

		if (!file) {

			return true; // Dosya seçilmemişse geçerli (isteğe bağlı)

		}

		

		// Mobil cihazlarda çok daha toleranslı ol

		if (isMobile()) {

			try {

				// Basit kontrol - sadece dosya var mı?

				if (file && file.name) {

					showFileSuccess($container, 'Mobil: Dosya hazır - ' + file.name);

					return true;

				}

			} catch (e) {

				// Mobilde herhangi bir hata varsa yok say

				console.log('Mobil dosya hatası yok sayıldı:', e);

				showFileSuccess($container, 'Mobil: Dosya kabul edildi');

				return true;

			}

		}

		

		// Masaüstü için detaylı kontrol

		try {

			var fileSize = file.size;

			var fileName = file.name;

			var fileType = file.type;

			

			// Dosya özelliklerine erişilemiyorsa geçersiz

			if (!fileName || fileSize === undefined) {

				showFileError($container, 'Dosya erişilemez durumda. Lütfen tekrar seçin.');

				input.value = '';

				return false;

			}

		} catch (e) {

			showFileError($container, 'Dosya okuma hatası. Lütfen tekrar seçin.');

			input.value = '';

			return false;

		}

		

		// Dosya boyutu kontrolü (5MB = 5 * 1024 * 1024 bytes)

		var maxSize = 5 * 1024 * 1024;

		if (file.size > maxSize) {

			showFileError($container, 'Dosya boyutu 5MB\'dan büyük olamaz.');

			input.value = '';

			return false;

		}

		

		// Dosya tipi kontrolü

		var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

		if (!allowedTypes.includes(file.type)) {

			showFileError($container, 'Sadece JPG, PNG ve GIF dosyaları kabul edilir.');

			input.value = '';

			return false;

		}

		

		// Başarılı yükleme göstergesi

		showFileSuccess($container, 'Dosya hazır: ' + file.name);

		return true;

	}

		// Banka ve çek dosya yükleme validasyonu

	function validateBankaCekFileUpload(input, fileType) {

		var file = input.files[0];

		var $input = $(input);

		var $container = $input.closest('.form-group');

		

		// Önceki hata mesajlarını temizle

		$container.find('.file-error, .file-success').remove();

		$container.removeClass('has-error');

		

		if (!file) {

			return true; // Dosya seçilmemişse geçerli (isteğe bağlı)

		}

		

		// Mobil dosya erişim kontrolü

		try {

			var fileSize = file.size;

			var fileName = file.name;

			var fileType = file.type;

			

			// Dosya özelliklerine erişilemiyorsa geçersiz

			if (!fileName || fileSize === undefined) {

				showBankaCekFileError($container, 'Dosya erişilemez durumda. Lütfen tekrar seçin.');

				input.value = '';

				return false;

			}

		} catch (e) {

			showBankaCekFileError($container, 'Dosya okuma hatası. Lütfen tekrar seçin.');

			input.value = '';

			return false;

		}

		

		// Dosya boyutu kontrolü (5MB = 5 * 1024 * 1024 bytes)

		var maxSize = 5 * 1024 * 1024;

		if (file.size > maxSize) {

			showBankaCekFileError($container, 'Dosya boyutu 5MB\'dan büyük olamaz.');

			input.value = '';

			return false;

		}

		

		// Dosya tipi kontrolü (banka ve çek için PDF de kabul ediliyor)

		var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'application/pdf'];

		if (!allowedTypes.includes(file.type)) {

			showBankaCekFileError($container, 'Sadece JPG, PNG, GIF ve PDF dosyaları kabul edilir.');

			input.value = '';

			return false;

		}

		

		// Başarılı yükleme göstergesi

		showBankaCekFileSuccess($container, fileType + ' dosyası hazır: ' + file.name);

		return true;

	}

	

	// Banka/çek dosya hatası göster

	function showBankaCekFileError($container, message) {

		$container.addClass('has-error');

		$container.append('<div class="file-error text-danger small mt-1"><i class="fa fa-exclamation-triangle"></i> ' + message + '</div>');

	}

	

	// Banka/çek dosya başarı göster

	function showBankaCekFileSuccess($container, message) {

		$container.removeClass('has-error');

		$container.append('<div class="file-success text-success small mt-1"><i class="fa fa-check"></i> ' + message + '</div>');

	}

	

	// Dosya başarı göster

	function showFileSuccess($container, message) {

		$container.removeClass('has-error');

		$container.append('<div class="file-success text-success small mt-1"><i class="fa fa-check"></i> ' + message + '</div>');

	}

	// Form submit validasyonu

	$("#tahsilatForm").on('submit', function(e) {

		var odemeTipi = $("#odemeTipi").val();

		var hasError = false;

		

		// Mobil cihazlarda dosya kontrollerini atla
		if (isMobile()) {
			console.log('Mobil cihaz tespit edildi - dosya kontrolleri atlanıyor');
			// Mobil kullanıcılar için bilgilendirme
			swal({
				title: "Mobil İşlem",
				type: "info",
				text: "Mobil cihazınızdan işlem yapıyorsunuz. Dosya yüklemeleri otomatik olarak işlenecek.",
				timer: 2000,
				showConfirmButton: false
			});
			return true; // Form gönderimini devam ettir
		}

		// Kasa ödeme tipinde kullanıcının atanmış kasası olup olmadığını kontrol et

		if (odemeTipi == 1) {

			<?php if (!isset($user_assigned_kasa) || !$user_assigned_kasa): ?>

			hasError = true;

			swal({

				title: "Hata",

				type: "error",

				text: "Size atanmış bir kasa bulunmuyor. Kasa ödemesi yapabilmek için lütfen sistem yöneticisi ile iletişime geçin.",

				confirmButtonText: 'Tamam'

			});

			e.preventDefault();

			return false;

			<?php endif; ?>

		}

		

		// Senet ödeme tipinde dosya validasyonu

		if (odemeTipi == 4 && !isMobile()) {

			$('.senet-gorsel').each(function() {

				if (this.files.length > 0) {

					if (!checkFileStillExistsImproved(this)) {

						hasError = true;

						showMobileFileError('Senet dosyalarından biri yüklenirken sorun oluştu. Lütfen dosyaları tekrar seçin.');

					} else if (!validateFileUpload(this)) {

						hasError = true;

					}

				}

			});

		}

		

		// Banka ödeme tipinde dosya validasyonu

		if (odemeTipi == 2 && !isMobile()) {

			var bankaFile = document.getElementById('banka_gorsel');

			if (bankaFile && bankaFile.files.length > 0) {

				if (!checkFileStillExistsImproved(bankaFile)) {

					hasError = true;

					showMobileFileError('Banka dekont dosyası yüklenirken sorun oluştu. Lütfen dosyayı tekrar seçin.');

				} else if (!validateBankaCekFileUpload(bankaFile, 'dekont')) {

					hasError = true;

				}

			}

		}

				// Çek ödeme tipinde dosya validasyonu

		if (odemeTipi == 3 && !isMobile()) {

			var cekFile = document.getElementById('cek_gorsel');

			if (cekFile && cekFile.files.length > 0) {

				if (!checkFileStillExistsImproved(cekFile)) {

					hasError = true;

					showMobileFileError('Çek dosyası yüklenirken sorun oluştu. Lütfen dosyayı tekrar seçin.');

				} else if (!validateBankaCekFileUpload(cekFile, 'çek')) {

					hasError = true;

				}

			}

		}

		

		if (hasError) {

			e.preventDefault();

			return false;

		}

		

		// Show progress for mobile users

		if (isMobile()) {

			showUploadProgress();

		}

	});

	

	// Dosya hata göster

	function showFileError($container, message) {

		$container.addClass('has-error');

		$container.append('<div class="file-error text-danger small mt-1"><i class="fa fa-exclamation-triangle"></i> ' + message + '</div>');

		

		// Eğer dosya erişim hatası ise otomatik destek talebi oluştur

		if (message.includes('erişilemez') || message.includes('okuma hatası')) {

			createAutoSupportTicketForUploadError('ERR_FILE_ACCESS', message);

		}

	}

	

	// Otomatik destek talebi oluştur

	function createAutoSupportTicketForUploadError(errorType, errorMessage) {

		var ticketData = {

			error_type: errorType,

			user_agent: navigator.userAgent,

			screen_resolution: screen.width + 'x' + screen.height,

			viewport_size: window.innerWidth + 'x' + window.innerHeight,

			url: window.location.href,

			timestamp: new Date().toISOString(),

			browser_info: getBrowserInfo(),

			device_info: JSON.stringify(getDeviceInfo()),

			error_details: errorMessage,

			auto_generated: true

		};

		

		// AJAX ile otomatik destek talebi oluştur

		$.ajax({

			url: '<?= base_url('talepler/otomatik-talep-olustur') ?>',

			type: 'POST',

			data: ticketData,

			dataType: 'json',

			success: function(response) {

				if (response.success) {

					showAutoTicketCreatedMessage(response.ticket_id);

				} else {

					showManualSupportInfo();

				}

			},

			error: function() {

				// Fallback: Manual destek bilgisi göster

				showManualSupportInfo();

			}

		});

	}

	

	// Tarayıcı bilgilerini al

	function getBrowserInfo() {

		var ua = navigator.userAgent;

		var browser = 'Unknown';

		var version = 'Unknown';

		

		if (ua.indexOf('Chrome') > -1) {

			browser = 'Chrome';

			version = ua.match(/Chrome\/(\d+)/)[1];

		} else if (ua.indexOf('Firefox') > -1) {

			browser = 'Firefox';

			version = ua.match(/Firefox\/(\d+)/)[1];

		} else if (ua.indexOf('Safari') > -1) {

			browser = 'Safari';

			version = ua.match(/Safari\/(\d+)/)[1];

		} else if (ua.indexOf('Edge') > -1) {

			browser = 'Edge';

			version = ua.match(/Edge\/(\d+)/)[1];

		}

		

		return browser + ' ' + version;

	}

	

	// Cihaz bilgilerini al

	function getDeviceInfo() {

		var isMobile = /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

		var isTablet = /(iPad|Android(?!.*Mobile))/i.test(navigator.userAgent);

		var deviceType = isMobile ? (isTablet ? 'Tablet' : 'Mobile') : 'Desktop';

		

		return {

			type: deviceType,

			platform: navigator.platform,

			connection: navigator.connection ? navigator.connection.effectiveType : 'Unknown',

			language: navigator.language,

			memory: navigator.deviceMemory || 'Unknown',

			cores: navigator.hardwareConcurrency || 'Unknown'

		};

	}

	

	// Otomatik talep oluşturuldu mesajı göster

	function showAutoTicketCreatedMessage(ticketId) {

		swal({

			title: "Destek Talebi Oluşturuldu",

			type: "info",

			html: true,

			text: `

				<div style="text-align: left;">

					<p><strong>Teknik bir sorun tespit edildi ve sizin adınıza otomatik olarak destek talebi oluşturuldu.</strong></p>

					<br>

					<p><strong>Talep Numarası:</strong> #${ticketId}</p>

					<p><strong>Sorun:</strong> Mobil dosya yükleme hatası</p>

					<p><strong>Durum:</strong> İnceleme altında</p>

					<br>

					<p>Teknik ekibimiz sorunu inceleyip size geri dönüş yapacak. Bu sırada:</p>

					<ul>

						<li>Dosyayı tekrar seçmeyi deneyebilirsiniz</li>

						<li>Tarayıcınızı yeniden başlatabilirsiniz</li>

						<li>Farklı bir dosya formatı deneyebilirsiniz</li>

					</ul>

				</div>

			`,

			confirmButtonText: 'Anladım',

			showCancelButton: true,

			cancelButtonText: 'Sayfayı Yenile'

		}, function(isConfirm) {

			if (!isConfirm) {

				// Kullanıcı sayfayı yenilemeyi seçti

				location.reload();

			}

		});

	}

	

	// Manuel destek bilgisi göster (otomatik sistem çalışmazsa)

	function showManualSupportInfo() {

		swal({

			title: "Teknik Destek",

			type: "info",

			html: true,

			text: `

				<div style="text-align: left;">

					<p><strong>Dosya yükleme sorunu yaşıyorsunuz.</strong></p>

					<br>

					<p>Hemen çözüm için:</p>

					<ul>

						<li>📞 <strong>Telefon:</strong> 0212 xxx xx xx</li>

						<li>📧 <strong>E-posta:</strong> destek@ilekasoft.com</li>

						<li>💬 <strong>WhatsApp:</strong> 0532 xxx xx xx</li>

					</ul>

					<br>

					<p>Veya aşağıdaki adımları deneyebilirsiniz:</p>

					<ol>

						<li>Dosyayı tekrar seçin</li>

						<li>Tarayıcınızı yeniden başlatın</li>

						<li>Farklı bir dosya formatı deneyin</li>

					</ol>

				</div>

			`,

			confirmButtonText: 'Anladım',

			showCancelButton: true,

			cancelButtonText: 'Sayfayı Yenile'

		}, function(isConfirm) {

			if (!isConfirm) {

				location.reload();

			}

		});

	}

	

	// Dosya hala erişilebilir mi kontrol et (mobil için)

	function checkFileStillExists(input) {

		if (!input.files || input.files.length === 0) {

			return true; // Dosya seçilmemişse OK

		}

		

		try {

			var file = input.files[0];

			// Dosya özelliklerine erişmeye çalış

			var size = file.size;

			var name = file.name;

			var type = file.type;

			

			// Erişilebiliyorsa dosya hala geçerli

			return (name && size !== undefined);

		} catch (e) {

			return false;

		}

	}

	

	// Mobil dosya hatası göster

	function showMobileFileError(message) {

		swal({

			title: "Dosya Hatası",

			type: "error",

			text: message,

			confirmButtonText: 'Tamam'

		});

	}

	

	// Mobil cihaz kontrolü
	function isMobile() {
		return window.innerWidth <= 768 || /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
	}
	
	// Geliştirilmiş dosya erişim kontrolü
	function checkFileStillExistsImproved(input) {
		if (!input.files || input.files.length === 0) {
			return true; // Dosya seçilmemişse OK
		}
		
		// Mobil cihazlarda dosya erişim sorunlarını tolere et
		if (isMobile()) {
			try {
				var file = input.files[0];
				// Basit dosya varlık kontrolü - mobilde detaylı kontrol yapmayalım
				return file && file.name;
			} catch (e) {
				// Mobilde dosya erişim hatalarını yok say, form gönderilmeye devam etsin
				console.log('Mobil dosya erişim hatası (yok sayıldı):', e);
				return true;
			}
		}
		
		// Masaüstü için normal kontrol
		try {
			var file = input.files[0];
			var size = file.size;
			var name = file.name;
			var type = file.type;
			return (name && size !== undefined);
		} catch (e) {
			return false;
		}
	}

	// Mobil cihaz kontrolü

	function isMobile() {
		// Gelişmiş mobil cihaz tespit sistemi
		var userAgent = navigator.userAgent.toLowerCase();
		var isMobileDevice = /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini|mobile/i.test(userAgent);
		var isSmallScreen = window.innerWidth <= 768;
		var isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
		
		// Birden fazla kriter kullanarak mobil tespit et
		var isMobileResult = isMobileDevice || (isSmallScreen && isTouchDevice);
		
		// Debug için console'a yazdır
		console.log('Mobil kontrol sonucu:', {
			userAgent: userAgent,
			isMobileDevice: isMobileDevice,
			isSmallScreen: isSmallScreen,
			isTouchDevice: isTouchDevice,
			finalResult: isMobileResult
		});
		
		return isMobileResult;
	}

	

	// Yükleme progress göster

	function showUploadProgress() {

		return swal({

			title: 'Dosya Yükleniyor',

			text: 'Lütfen bekleyin...',

			type: 'info',

			showConfirmButton: false,

			allowOutsideClick: false

		});

	}

</script>



</body>

</html>

