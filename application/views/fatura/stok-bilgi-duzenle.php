<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		/* Mobil uyumlu stil düzenlemeleri */
		.card {
			border: 1px solid #e0e6ed;
			border-radius: 8px;
			box-shadow: 0 2px 10px rgba(0,0,0,0.05);
		}
		
		.card-header {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			border-radius: 8px 8px 0 0;
			padding: 1rem;
		}
		
		.form-group label {
			font-weight: 600;
			color: #333;
			margin-bottom: 0.5rem;
		}
		
		.form-control {
			border: 1px solid #ddd;
			border-radius: 6px;
			padding: 0.75rem;
			transition: all 0.3s ease;
		}
		
		.form-control:focus {
			border-color: #667eea;
			box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
		}
		
		.btn-success {
			background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
			border: none;
			padding: 0.75rem 1.5rem;
			border-radius: 6px;
			font-weight: 500;
		}
		
		.btn-secondary {
			background: #6c757d;
			border: none;
			padding: 0.75rem 1.5rem;
			border-radius: 6px;
		}
		
		.alert {
			border: none;
			border-radius: 6px;
			padding: 1rem;
			margin-bottom: 1rem;
		}
		
		.alert-success {
			background-color: #d4edda;
			color: #155724;
			border-left: 4px solid #28a745;
		}
		
		.alert-danger {
			background-color: #f8d7da;
			color: #721c24;
			border-left: 4px solid #dc3545;
		}
		
		/* Mobil responsive */
		@media (max-width: 768px) {
			.container-fluid {
				padding: 0.5rem;
			}
			
			.card {
				margin-bottom: 1rem;
			}
			
			.form-group {
				margin-bottom: 1rem;
			}
			
			.btn {
				width: 100%;
				margin-bottom: 0.5rem;
			}
			
			.row .col-sm-6 {
				margin-bottom: 1rem;
			}
		}
		
		@media (max-width: 576px) {
			.page-header h3 {
				font-size: 1.25rem;
			}
			
			.breadcrumb {
				font-size: 0.875rem;
			}
			
			.card-header h4 {
				font-size: 1.1rem;
			}
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
							<h3 class="page-title">Stok Bilgi Düzenle</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
								<li class="breadcrumb-item"><a href="<?= base_url('fatura/satis-faturasi-listesi'); ?>">Satış Fatura Listesi</a></li>
								<li class="breadcrumb-item active">Stok Bilgi Düzenle</li>
							</ul>
						</div>
						<div class="d-flex justify-content-end text-align-center col-sm-2">
							<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<!-- Alert Messages -->
				<?php if ($this->session->flashdata('stok_guncelle_basarili')): ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="fa fa-check-circle"></i> Stok bilgileri başarıyla güncellendi!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif; ?>

				<?php if ($this->session->flashdata('stok_kodu_mevcut')): ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<i class="fa fa-exclamation-triangle"></i> Bu stok kodu zaten mevcut! Lütfen farklı bir stok kodu giriniz.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif; ?>

				<?php if ($this->session->flashdata('stok_guncelle_yetki_hatasi')): ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<i class="fa fa-ban"></i> Bu işlem için yetkiniz bulunmamaktadır!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif; ?>

				<!-- Stok Bilgi Form -->
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title mb-0"><i class="fa fa-edit"></i> Stok Bilgileri</h4>
							</div>
							<div class="card-body">
								<form action="<?= base_url('fatura/stok-bilgi-guncelle'); ?>" method="POST" id="stokForm">
									<input type="hidden" name="stok_id" value="<?= $stokBilgi->stok_id; ?>">
									
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="stok_ad">Stok Adı <span class="text-danger">*</span></label>
												<input type="text" class="form-control" id="stok_ad" name="stok_ad" 
													   value="<?= $stokBilgi->stok_ad; ?>" required>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="stok_kodu">Stok Kodu <span class="text-danger">*</span></label>
												<input type="text" class="form-control" id="stok_kodu" name="stok_kodu" 
													   value="<?= $stokBilgi->stok_kodu; ?>" required>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="stok_birimID">Birim <span class="text-danger">*</span></label>
												<select class="form-control" id="stok_birimID" name="stok_birimID" required>
													<option value="">Birim Seçiniz</option>
													<?php foreach ($stokBirimleri as $birim): ?>
														<option value="<?= $birim->stokBirim_id; ?>" 
																<?= ($birim->stokBirim_id == $stokBilgi->stok_birimID) ? 'selected' : ''; ?>>
															<?= $birim->stokBirim_ad; ?> (<?= $birim->stokBirim_kisaltma; ?>)
														</option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="stok_satisFiyati">Satış Fiyatı (TL)</label>
												<input type="number" step="0.01" min="0" class="form-control" 
													   id="stok_satisFiyati" name="stok_satisFiyati" 
													   value="<?= $stokBilgi->stok_satisFiyati; ?>">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="stok_satisKDV">KDV Oranı (%)</label>
												<select class="form-control" id="stok_satisKDV" name="stok_satisKDV">
													<option value="0" <?= ($stokBilgi->stok_satisKDV == 0) ? 'selected' : ''; ?>>%0</option>
													<option value="1" <?= ($stokBilgi->stok_satisKDV == 1) ? 'selected' : ''; ?>>%1</option>
													<option value="8" <?= ($stokBilgi->stok_satisKDV == 8) ? 'selected' : ''; ?>>%8</option>
													<option value="18" <?= ($stokBilgi->stok_satisKDV == 18) ? 'selected' : ''; ?>>%18</option>
													<option value="20" <?= ($stokBilgi->stok_satisKDV == 20) ? 'selected' : ''; ?>>%20</option>
												</select>
											</div>
										</div>
									</div>

									<!-- Ek Bilgiler (Sadece Görüntüleme) -->
									<div class="row mt-4">
										<div class="col-12">
											<h5><i class="fa fa-info-circle"></i> Ek Bilgiler</h5>
											<hr>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Mevcut Birim</label>
												<input type="text" class="form-control" value="<?= $stokBilgi->stokBirim_ad; ?>" readonly>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Alış Fiyatı</label>
												<input type="text" class="form-control" value="<?= number_format($stokBilgi->stok_alisFiyati, 2, ',', '.'); ?> TL" readonly>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-12">
											<div class="form-group text-center">
												<button type="submit" class="btn btn-success mr-2">
													<i class="fa fa-save"></i> Kaydet
												</button>
												<a href="<?= base_url('fatura/satis-faturasi-listesi'); ?>" class="btn btn-secondary">
													<i class="fa fa-times"></i> İptal
												</a>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php $this->load->view("include/footer-scripts"); ?>

	<script>
		$(document).ready(function() {
			// Form validation
			$('#stokForm').on('submit', function(e) {
				var stokAd = $('#stok_ad').val().trim();
				var stokKodu = $('#stok_kodu').val().trim();
				var birim = $('#stok_birimID').val();

				if (stokAd === '') {
					e.preventDefault();
					alert('Stok adı gereklidir!');
					$('#stok_ad').focus();
					return false;
				}

				if (stokKodu === '') {
					e.preventDefault();
					alert('Stok kodu gereklidir!');
					$('#stok_kodu').focus();
					return false;
				}

				if (birim === '') {
					e.preventDefault();
					alert('Lütfen bir birim seçiniz!');
					$('#stok_birimID').focus();
					return false;
				}
			});

			// Auto dismiss alerts after 5 seconds
			setTimeout(function() {
				$('.alert').fadeOut('slow');
			}, 5000);
		});
	</script>
</body>
</html>
