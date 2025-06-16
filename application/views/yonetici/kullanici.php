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

								<h3 class="page-title">Yönetici</h3>								<ul class="breadcrumb">

									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>

									<li class="breadcrumb-item">Yönetici</li>

									<li class="breadcrumb-item active">Kullanıcı</li>

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

									<h4 class="card-title">Kullanıcı Kişisel Bilgileri</h4>									<form id="kullaniciForm" action="<?= base_url(isset($kullanici) ? "yonetici/kullaniciDuzenle" : "yonetici/kullaniciOlustur"); ?>" method="POST">
										<?php if(isset($kullanici)): ?>
										<input type="hidden" name="kullanici_id" value="<?= $kullanici->kullanici_id; ?>">
										<?php endif; ?>
										<div class="row">

											<div class="col-md-6">

												<div class="form-group">

													<label>Ad</label>

													<input type="text" class="form-control" value="<?= isset($kullanici) ? $kullanici->kullanici_ad : '';?>" name="kullanici_ad" required="">

												</div>

											</div>

											<div class="col-md-6">												<div class="form-group">

													<label>Soyad</label>

													<input type="text" class="form-control" value="<?= isset($kullanici) ? $kullanici->kullanici_soyad : '';?>" name="kullanici_soyad" required="">

												</div>

											</div>

										</div>

									<h4 class="card-title mt-4">Kullanıcı Temel Bilgileri</h4>

										<div class="row">

											<div class="col-md-6">												<div class="form-group">

													<label>Kullanıcı Adı</label>

													<input type="text" class="form-control" value="<?= isset($kullanici) ? $kullanici->kullanici_kullaniciAdi : '';?>" name="kullanici_kullaniciAdi" required="">

												</div>

												<div class="form-group">

													<label>Şifre</label>

													<input type="password" class="form-control" name="kullanici_sifre" <?= !isset($kullanici) ? 'required' : ''; ?>>

												</div>												<div class="form-group">

													<label>Kullanıcı Yetkisi</label>

													<select class="select form-control" name="kullanici_grupID" required="">

														<option value="">Seçiniz...</option>

														<?php if(isset($kullaniciGruplari) && !empty($kullaniciGruplari)): ?>															<?php foreach($kullaniciGruplari as $grup): ?>

																<option value="<?= $grup->kg_id; ?>" <?php if(isset($kullanici) && $kullanici->grup_id == $grup->kg_id){echo "selected";}?>><?= $grup->kg_adi; ?></option>

															<?php endforeach; ?>

														<?php endif; ?>

													</select>

												</div>

											</div>

											<div class="col-md-6">												<div class="form-group">

													<label>Kullanıcı e-Posta</label>

													<input type="email" class="form-control" value="<?= isset($kullanici) ? $kullanici->kullanici_eposta : '';?>" name="kullanici_eposta" required="">

												</div>

												<div class="form-group">

													<label>Şifre (tekrar)</label>

													<input type="password" class="form-control"  name="kullanici_sifreTekrar" <?= !isset($kullanici) ? 'required' : ''; ?>>

												</div>

												<div class="form-group">

													<label>Kullanıcı Durumu</label>

													<select class="select form-control" name="kullanici_durum" required="">

														<option value="">Seçiniz...</option>

														<option value="1" <?php if(isset($kullanici) && $kullanici->kullanici_durum == 1){echo "selected";}?>>Aktif</option>

														<option value="2" <?php if(isset($kullanici) && $kullanici->kullanici_durum == 2){echo "selected";}?>>Pasif</option>

													</select>

												</div>												<div class="form-group">
													<label>Sorumlu Müdür</label>
													<select class="select form-control" name="kullanici_sorumluMudur">
														<option value="">Sorumlu müdür seçiniz...</option>
														<?php if(isset($tumKullanicilar) && !empty($tumKullanicilar)): ?>
															<?php foreach($tumKullanicilar as $mudur): ?>
																<option value="<?= $mudur->kullanici_id; ?>" 
																	<?php if(isset($kullanici) && $kullanici->kullanici_sorumluMudur == $mudur->kullanici_id){echo "selected";}?>>
																	<?= $mudur->kullanici_ad . ' ' . $mudur->kullanici_soyad; ?>
																</option>
															<?php endforeach; ?>
														<?php endif; ?>
													</select>
													<small class="form-text text-muted">
														<i class="fa fa-info-circle"></i> 
														Bu kullanıcının sorumlu müdürünü seçiniz. Boş bırakılabilir.													</small>
												</div>											</div>

										</div>
										
										<button type="submit" class="btn btn-danger" style="width:100%;"><?= isset($kullanici) ? 'Güncelle' : 'Kaydet'; ?></button>

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

		<?php if ($this->session->flashdata('kullanici_ok')): ?>

			<script>

			swal({

			  title: "Bilgilendirme",

			  type: "success", 

			  text: "Yeni kullanıcı başarılı bir şekilde eklendi.",

			  confirmButtonText:'Tamam',

			  button: false,

			  timer: 5000,

			});

			</script>

		<?php endif; ?>



		<?php if ($this->session->flashdata('kullanici_update_ok')): ?>

			<script>

			swal({

			  title: "Bilgilendirme",

			  type: "success", 

			  text: "Mevcut kullanıcı başarılı bir şekilde güncellendi.",

			  confirmButtonText:'Tamam',

			  button: false,

			  timer: 5000,

			});

			</script>

		<?php endif; ?>



		<?php if ($this->session->flashdata('kullanici_eposta_mevcut')): ?>

			<script>

			swal({

			  title: "Bilgilendirme",

			  type: "error", 

			  text: "Kullanıcı e-Postası zaten sistemde mevcut, tekrar deneyiniz.",

			  confirmButtonText:'Tamam',

			  button: false,

			  timer: 5000,

			});

			</script>
		<?php endif; ?>		<style>
		/* Basit Checkbox Listesi Stilleri */
		.simple-checkbox-container {
			background: #f8f9fa;
			border: 1px solid #dee2e6;
			border-radius: 8px;
			padding: 20px;
		}
		
		.search-section .input-group-text {
			background: #e9ecef;
			border-color: #ced4da;
		}
		
		.control-buttons {
			border-bottom: 1px solid #dee2e6;
			padding-bottom: 15px;
		}
		
		.checkbox-list-container {
			max-height: 400px;
			overflow-y: auto;
			background: white;
			border: 1px solid #dee2e6;
			border-radius: 6px;
			padding: 15px;
		}
				.checkbox-item {
			padding: 5px 10px;
			margin-bottom: 2px;
			border-radius: 4px;
			transition: background-color 0.2s;
		}
		
		.checkbox-item:hover {
			background-color: #f8f9fa;
		}
		
		.checkbox-item.hidden {
			display: none;
		}
		
		.form-check-input {
			margin-right: 8px;
		}
		
		.form-check-label {
			cursor: pointer;
			user-select: none;
		}
		#selected-count {
			font-weight: bold;
			color: #28a745;
		}
		</style><script>		// jQuery hazır olana kadar bekle
		document.addEventListener('DOMContentLoaded', function() {
			// jQuery yüklenene kadar bekle
			function waitForjQuery() {
				if (typeof $ !== 'undefined') {
					initializeProvinceList();
					setupFormSubmitHandler();
					setupFormDefaults();
					enhanceFormExperience();
				} else {
					setTimeout(waitForjQuery, 100);
				}
			}
			waitForjQuery();
		});// Form submit handler kurulumu
		function setupFormSubmitHandler() {
			$('#kullaniciForm').on('submit', function(e) {
				console.log('Form submit event yakalandı');
				
				// Debugging: Form verilerini kontrol et (ama form gönderimini engelleme)
				debugFormData();
				
				// Form submit'e devam et (return true veya hiçbir şey yapmayarak)
				return true;
			});
		}
		
		function initializeProvinceList() {
			// Arama fonksiyonu
			$('#search-provinces').on('input', function() {
				var searchTerm = $(this).val().toLowerCase();
				var visibleCount = 0;
				
				$('.checkbox-item').each(function() {
					var provinceName = $(this).find('input').data('name');
					if (provinceName.includes(searchTerm)) {
						$(this).removeClass('hidden');
						visibleCount++;
					} else {
						$(this).addClass('hidden');
					}
				});
			});
			
			// Arama temizleme
			$('#clear-search').click(function() {
				$('#search-provinces').val('');
				$('.checkbox-item').removeClass('hidden');
			});
			
			// Checkbox değişikliklerini takip et
			$('.form-check-input').change(function() {
				updateSelectedCount();
			});
			
			// Sayfa yüklendiğinde sayaç güncelle
			updateSelectedCount();
		}
		
		// Tümünü seç
		function selectAll() {
			if (typeof $ !== 'undefined') {
				$('.checkbox-item:not(.hidden) .form-check-input').prop('checked', true);
				updateSelectedCount();
			}
		}
		
		// Tümünü temizle
		function clearAll() {
			if (typeof $ !== 'undefined') {
				$('.form-check-input').prop('checked', false);
				updateSelectedCount();
			}
		}
		// Seçili sayısını güncelle
		function updateSelectedCount() {
			if (typeof $ !== 'undefined') {
				var selectedCount = $('.form-check-input:checked').length;
				$('#selected-count').text(selectedCount);		}
		// Form verilerini debug et
		function debugFormData() {
			console.log('=== FORM DEBUG BİLGİLERİ ===');
			
			// FormData API ile gerçek form verilerini kontrol et
			var form = document.getElementById('kullaniciForm');
			var formData = new FormData(form);
			
			var formEntries = [];			for(var pair of formData.entries()) {
				if(pair[0].includes('sorumluluk_bolgesi')) {
					formEntries.push(pair[0] + ': ' + pair[1]);
				}
			}
			console.log('FormData API ile Alınan Veriler:', formEntries);
			
			// Sorumluluk Bölgesi verilerini kontrol et
			var sorumlulukBolgesiData = [];
			$('input[name="sorumluluk_bolgesi[]"]:checked').each(function() {
				sorumlulukBolgesiData.push($(this).val());
			});
			console.log('Sorumluluk Bölgesi Verileri (jQuery):', sorumlulukBolgesiData);
			
			// Form içindeki tüm checkbox'ları listele
			var allCheckboxes = [];
			$('form input[type="checkbox"], input[form="kullaniciForm"][type="checkbox"]').each(function() {
				allCheckboxes.push({
					name: $(this).attr('name'),
					value: $(this).val(),
					checked: $(this).is(':checked'),
					id: $(this).attr('id'),
					form: $(this).attr('form'),
					insideForm: $(this).closest('form').length > 0
				});
			});
			
			console.log('Form İle İlişkili Tüm Checkbox\'lar:', allCheckboxes);
			
			console.log('=== DEBUG BİTİŞ ===');
		}
				// Initialize form when page loads
		$(document).ready(function() {
			// Remove duplicate initialization since it's already called in DOMContentLoaded
			setupFormDefaults();
			enhanceFormExperience();
		});
		
		// Setup default values from general settings
		function setupFormDefaults() {
			<?php if(isset($kullaniciSorumlulukBilgi) && $hasExtendedColumns): ?>
				// Auto-populate default values if available
				<?php if(!empty($kullaniciSorumlulukBilgi->baslangic_tarihi)): ?>
					$('#sorumluluk_baslangic_tarihi').val('<?= $kullaniciSorumlulukBilgi->baslangic_tarihi; ?>');
				<?php endif; ?>
				<?php if(!empty($kullaniciSorumlulukBilgi->bitis_tarihi)): ?>
					$('#sorumluluk_bitis_tarihi').val('<?= $kullaniciSorumlulukBilgi->bitis_tarihi; ?>');
				<?php endif; ?>
				<?php if(!empty($kullaniciSorumlulukBilgi->ulke_id)): ?>
					$('#sorumluluk_ulke').val('<?= $kullaniciSorumlulukBilgi->ulke_id; ?>');
				<?php endif; ?>
			<?php endif; ?>
		}
		
		// Enhanced form experience		function enhanceFormExperience() {
			// Add loading state to dropdowns when they're being populated
			$('#sorumluluk_il').on('change', function() {
				if ($(this).val()) {
					$('#sorumluluk_ilce').html('<option value="">Yükleniyor...</option>').prop('disabled', true);
				}
			});
			
			// Add tooltips for better UX
			$('[data-toggle="tooltip"]').tooltip();
			
			// Auto-format date inputs
			$('input[type="date"]').on('blur', function() {
				if ($(this).val()) {
					$(this).addClass('has-value');
				} else {
					$(this).removeClass('has-value');
				}
			});			// Real-time validation feedback
			$('.form-control').on('blur', function() {
				if ($(this).is(':required') && !$(this).val()) {
					$(this).addClass('is-invalid');
				} else {
					$(this).removeClass('is-invalid');
				}
			});
		}