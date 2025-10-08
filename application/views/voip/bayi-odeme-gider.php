<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<style>
	/* Fix font loading issues */
	@font-face {
		font-family: "Font Awesome 5 Free";
		font-style: normal;
		font-weight: 900;
		font-display: block;
		src: url("<?= base_url(); ?>assets/plugins/fontawesome/webfonts/fa-solid-900.woff") format("woff"),
			 url("<?= base_url(); ?>assets/plugins/fontawesome/webfonts/fa-solid-900.ttf") format("truetype");
	}
	
	/* Ensure proper spacing and styling */
	.form-group {
		margin-bottom: 1rem;
	}
	
	.badge-success {
		color: #fff;
		background-color: #28a745;
	}

	.badge-warning {
		color: #212529;
		background-color: #ffc107;
	}
	
	/* Custom styling for better appearance */
	.card-title {
		color: #2c3e50;
		font-weight: 600;
	}
	
	.table th {
		font-weight: 600;
		color: #495057;
		background-color: #f8f9fa;
	}
	
	.btn-outline-light {
		color: #6c757d;
		border-color: #6c757d;
	}
	
	.btn-outline-light:hover {
		background-color: #6c757d;
		border-color: #6c757d;
		color: #fff;
	}
	
	/* Select2 styling */
	.select2-container {
		width: 100% !important;
	}
	
	.select2-container--default .select2-selection--single {
		height: 38px;
		border: 1px solid #ced4da;
		border-radius: 0.25rem;
		padding: 6px 12px;
	}
	
	.select2-container--default .select2-selection--single .select2-selection__rendered {
		color: #495057;
		line-height: 24px;
	}
	
	.select2-container--default .select2-selection--single .select2-selection__arrow {
		height: 36px;
	}
	
	.select2-dropdown {
		border: 1px solid #ced4da;
		border-radius: 0.25rem;
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
							<h3 class="page-title">Voip & Hakediş</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
								<li class="breadcrumb-item">Voip & Hakediş</li>
								<li class="breadcrumb-item active">Bayi Ödeme/Gider</li>
							</ul>
						</div>
						<div class="d-flex justify-content-end text-align-center col-sm-2">
							<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<!-- Bilgilendirme Mesajları -->
				<?php if ($this->session->flashdata('basarili')): ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="fas fa-check-circle me-2"></i>
						<?= $this->session->flashdata('basarili') ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					</div>
				<?php endif; ?>

				<?php if ($this->session->flashdata('hata')): ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<i class="fas fa-exclamation-triangle me-2"></i>
						<?= $this->session->flashdata('hata') ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					</div>
				<?php endif; ?>

				<div class="row">
					<div class="col-xl-12 col-md-12">
						
						<!-- Yeni Kayıt Formu -->
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">
									<i class="fas fa-plus me-2"></i>
									Yeni Ödeme/Gider Kaydı
								</h5>
							</div>
							<div class="card-body">
								<form method="post" action="<?= base_url('voip/bayi_odeme_kaydet') ?>" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>Bayi <span class="text-danger">*</span></label>
												<select class="form-control select2-search" name="bayi_id" id="bayi_select" required>
													<option value="">Bayi Seçin</option>
													<?php if (isset($kullanicilar) && !empty($kullanicilar)): ?>
														<?php foreach ($kullanicilar as $kullanici): ?>
															<option value="<?= $kullanici->kullanici_id ?>">
																<?= $kullanici->kullanici_ad ?> <?= $kullanici->kullanici_soyad ?>
															</option>
														<?php endforeach; ?>
													<?php endif; ?>
												</select>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Tür <span class="text-danger">*</span></label>
												<select class="form-control" name="tur" required>
													<option value="">Seçin</option>
													<option value="Ödeme">Ödeme</option>
													<option value="Gider">Gider</option>
												</select>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Tutar <span class="text-danger">*</span></label>
												<input type="number" step="0.01" class="form-control" name="tutar" required>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Tarih <span class="text-danger">*</span></label>
												<input type="date" class="form-control" name="tarih" value="<?= date('Y-m-d') ?>" required>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Açıklama</label>
												<textarea class="form-control" name="aciklama" rows="1" maxlength="500"></textarea>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-6">
											<div class="form-group">
												<label>Evrak Dosyaları</label>
												<input type="file" class="form-control" name="evrak[]" multiple 
													   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.txt,.xlsx,.xls">
												<small class="form-text text-muted">
													Birden fazla dosya seçebilirsiniz. Desteklenen formatlar: PDF, DOC, DOCX, JPG, PNG, GIF, TXT, XLSX, XLS
												</small>
											</div>
										</div>
										<div class="col-md-6 d-flex align-items-end">
											<div class="form-group mb-0">
												<button type="submit" class="btn btn-primary me-2">
													<i class="fas fa-save me-1"></i> Kaydet
												</button>
												<button type="reset" class="btn btn-secondary">
													<i class="fas fa-undo me-1"></i> Temizle
												</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>

						<!-- Ödemeler Listesi -->
						<div class="card">
							<div class="card-header d-flex justify-content-between align-items-center">
								<h5 class="card-title">
									<i class="fas fa-list me-2"></i>
									Ödeme/Gider Kayıtları
								</h5>
								<span class="badge bg-info">
									Toplam: <?= isset($odemeler) ? count($odemeler) : 0 ?> kayıt
								</span>
							</div>
							<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table table-striped table-hover mb-0">
										<thead>
											<tr>
												<th style="width: 60px;">#</th>
												<th>Bayi</th>
												<th style="width: 100px;">Tür</th>
												<th style="width: 120px;">Tutar</th>
												<th style="width: 120px;">Tarih</th>
												<th>Açıklama</th>
												<th style="width: 120px;">Oluşturma</th>
												<th style="width: 120px;">Evrak</th>
												<th style="width: 100px;">İşlem</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($odemeler) && !empty($odemeler)): ?>
												<?php $sayac = 1; ?>
												<?php foreach ($odemeler as $odeme): ?>
													<tr>
														<td><?= $sayac++ ?></td>
														<td>
															<strong><?= $odeme->kullanici_ad ?> <?= $odeme->kullanici_soyad ?></strong>
														</td>
														<td>
															<?php if ($odeme->tur == 'Ödeme'): ?>
																<span class="badge badge-success">Ödeme</span>
															<?php else: ?>
																<span class="badge badge-warning">Gider</span>
															<?php endif; ?>
														</td>
														<td>
															<strong><?= number_format($odeme->tutar, 2, ',', '.') ?> ₺</strong>
														</td>
														<td><?= date('d.m.Y', strtotime($odeme->tarih)) ?></td>
														<td>
															<?php if (!empty($odeme->aciklama)): ?>
																<span title="<?= htmlspecialchars($odeme->aciklama) ?>">
																	<?= mb_substr($odeme->aciklama, 0, 50) ?><?= mb_strlen($odeme->aciklama) > 50 ? '...' : '' ?>
																</span>
															<?php else: ?>
																<em class="text-muted">-</em>
															<?php endif; ?>
														</td>
														<td>
															<small><?= date('d.m.Y H:i', strtotime($odeme->olusturma_tarihi)) ?></small>
														</td>
														<td>
															<?php if (!empty($odeme->evrak)): ?>
																<?php $dosyalar = explode(',', $odeme->evrak); ?>
																<?php foreach ($dosyalar as $dosya): ?>
																	<a href="<?= base_url('assets/uploads/' . $dosya) ?>" 
																	   target="_blank" class="btn btn-sm btn-outline-info mb-1">
																		<i class="fas fa-download"></i>
																	</a>
																<?php endforeach; ?>
															<?php else: ?>
																<em class="text-muted">-</em>
															<?php endif; ?>
														</td>
														<td>
															<a href="<?= base_url('voip/bayi_odeme_sil/' . $odeme->id) ?>" 
															   class="btn btn-sm btn-outline-danger"
															   onclick="return confirm('Bu kaydı silmek istediğinizden emin misiniz?')">
																<i class="fas fa-trash"></i>
															</a>
														</td>
													</tr>
												<?php endforeach; ?>
											<?php else: ?>
												<tr>
													<td colspan="9" class="text-center py-4">
														<em class="text-muted">
															<i class="fas fa-info-circle me-2"></i>
															Henüz kayıt bulunmamaktadır.
														</em>
													</td>
												</tr>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<!-- Sayfalama -->
						<?php if (isset($pagination) && !empty($pagination)): ?>
							<div class="d-flex justify-content-center mt-3">
								<?= $pagination ?>
							</div>
						<?php endif; ?>

					</div>
				</div>
				
			</div>
		</div>
		<!-- /Page Wrapper -->
		
	</div>
	<!-- /Main Wrapper -->

	<?php $this->load->view("include/footer-js"); ?>

	<!-- Simplified JS for this page to avoid conflicts -->
	<script>
		// Suppress console errors by providing fallbacks
		window.console = window.console || {};
		console.warn = console.warn || function() {};
		console.error = console.error || function() {};
		
		// Prevent session timeout errors
		if (typeof $ !== 'undefined' && $.fn) {
			// Override sessionTimeout if it causes issues
			$.sessionTimeout = $.sessionTimeout || function() {
				console.log('Session timeout disabled for this page');
				return false;
			};
		}
		
		// Wait for jQuery to be fully loaded
		(function() {
			function initPage() {
				if (typeof $ !== 'undefined' && $.fn) {
					// Page-specific jQuery code
					$(document).ready(function() {
						// Initialize Select2 for searchable dropdown
						if ($.fn.select2) {
							$('#bayi_select').select2({
								placeholder: 'Bayi seçin veya arayın...',
								allowClear: true,
								language: {
									noResults: function() {
										return "Sonuç bulunamadı";
									},
									searching: function() {
										return "Aranıyor...";
									}
								}
							});
						}
						
						// Form reset işlemi
						$('button[type="reset"]').click(function() {
							$(this).closest('form')[0].reset();
							// Reset Select2
							if ($.fn.select2) {
								$('#bayi_select').val(null).trigger('change');
							}
						});
						
						// Tutar formatı
						$('input[name="tutar"]').on('input', function() {
							var value = $(this).val();
							if (value < 0) {
								$(this).val(0);
							}
						});

						// Prevent multiple form submissions
						$('form').submit(function() {
							$(this).find('button[type="submit"]').prop('disabled', true);
						});

						// File upload validation
						$('input[type="file"]').change(function() {
							var files = this.files;
							var maxSize = 5 * 1024 * 1024; // 5MB
							
							for (var i = 0; i < files.length; i++) {
								if (files[i].size > maxSize) {
									alert('Dosya boyutu çok büyük: ' + files[i].name + '. Maksimum 5MB olmalıdır.');
									$(this).val('');
									return;
								}
							}
						});

						// Safely handle feather icons if available
						try {
							if (typeof feather !== 'undefined' && feather && feather.replace) {
								feather.replace();
							}
						} catch(e) {
							// Ignore feather icon errors
						}
					});
				} else {
					// Retry after 100ms if jQuery not loaded yet
					setTimeout(initPage, 100);
				}
			}
			
			// Start initialization
			initPage();
		})();
		
		// Override global error handlers to prevent console spam
		window.addEventListener('error', function(e) {
			if (e.message && (
				e.message.includes('feather') || 
				e.message.includes('sessionTimeout') ||
				e.message.includes('font')
			)) {
				e.preventDefault();
				return false;
			}
		});
	</script>
</body>
</html>
