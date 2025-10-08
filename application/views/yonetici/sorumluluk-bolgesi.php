<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<style>
		.card-header {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
		}
		.btn-primary {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			border: none;
		}
		.btn-primary:hover {
			background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
		}
		.table-responsive {
			border-radius: 8px;
			overflow: hidden;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}
		.badge-success {
			background-color: #28a745;
		}
		.badge-danger {
			background-color: #dc3545;
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
							<h3 class="page-title">Yönetici</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
								<li class="breadcrumb-item">Yönetici</li>
								<li class="breadcrumb-item active">Sorumluluk Bölgesi</li>
							</ul>
						</div>
						<div class="d-flex justify-content-end text-align-center col-sm-2">
							<a class="btn btn-outline-light" href="javascript:history.back()">
								<i class="fa fa-history"></i><br>Önceki Sayfa
							</a>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<div class="row">
					<!-- Yeni Sorumluluk Bölgesi Ekleme Formu -->
					<div class="col-lg-6">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title mb-0">
									<i class="fa fa-map-marker"></i> Yeni Sorumluluk Bölgesi Ekle
								</h4>
							</div>
							<div class="card-body">
								<form id="sorumlulukForm" method="post">
									<div class="form-group">
										<label>Kullanıcı Seçin</label>
										<select class="form-control" name="kullanici_id" id="kullanici_id" required>
											<option value="">Kullanıcı Seçiniz</option>
											<?php foreach($kullanicilar as $kullanici): ?>
												<option value="<?= $kullanici->kullanici_id ?>">
													<?= $kullanici->kullanici_ad . ' ' . $kullanici->kullanici_soyad ?>
													(<?= $kullanici->kullanici_adi ?>)
												</option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="form-group">
										<label>İl Seçin</label>
										<select class="form-control" name="il_id" id="il_id" required>
											<option value="">İl Seçiniz</option>
											<?php foreach($iller as $il): ?>
												<option value="<?= $il->il_id ?>"><?= $il->il_adi ?></option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="form-group">
										<label>İlçe Seçin</label>
										<select class="form-control" name="ilce_id" id="ilce_id" required>
											<option value="">Önce İl Seçiniz</option>
										</select>
									</div>

									<div class="form-group text-right">
										<button type="submit" class="btn btn-primary">
											<i class="fa fa-plus"></i> Sorumluluk Bölgesi Ekle
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<!-- Mevcut Sorumluluk Bölgeleri Listesi -->
					<div class="col-lg-6">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title mb-0">
									<i class="fa fa-list"></i> Mevcut Sorumluluk Bölgeleri
								</h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-striped table-hover">
										<thead class="thead-dark">
											<tr>
												<th>Kullanıcı</th>
												<th>İl</th>
												<th>İlçe</th>
												<th>Durum</th>
												<th>İşlemler</th>
											</tr>
										</thead>
										<tbody>
											<?php if(empty($sorumluluk_bolgeler)): ?>
												<tr>
													<td colspan="5" class="text-center text-muted">
														Henüz tanımlanmış sorumluluk bölgesi bulunmamaktadır.
													</td>
												</tr>
											<?php else: ?>
												<?php foreach($sorumluluk_bolgeler as $bolge): ?>
													<tr>
														<td>
															<strong><?= $bolge->kullanici_ad . ' ' . $bolge->kullanici_soyad ?></strong>
														</td>
														<td><?= $bolge->il_adi ?></td>
														<td><?= $bolge->ilce_adi ?></td>
														<td>
															<span class="badge badge-success">Aktif</span>
														</td>														<td>
															<button class="btn btn-sm btn-danger" 
																onclick="sorumlulukSil(<?= $bolge->sorumluluk_id ?>)">
																<i class="fa fa-trash"></i>
															</button>
														</td>
													</tr>
												<?php endforeach; ?>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			// İl değiştiğinde ilçeleri getir
			$('#il_id').change(function() {
				var il_id = $(this).val();
						if(il_id) {
					$.ajax({
						url: '<?= base_url("yonetici/ilceler") ?>',
						type: 'POST',
						data: {il_id: il_id},
						dataType: 'json',
						success: function(data) {
							$('#ilce_id').empty();
							$('#ilce_id').append('<option value="">İlçe Seçiniz</option>');
							
							$.each(data, function(key, value) {
								$('#ilce_id').append('<option value="'+ value.ilce_id +'">'+ value.ilce_adi +'</option>');
							});
						},
						error: function() {
							alert('İlçeler yüklenirken hata oluştu!');
						}
					});
				} else {
					$('#ilce_id').empty();
					$('#ilce_id').append('<option value="">Önce İl Seçiniz</option>');
				}
			});

			// Form submit
			$('#sorumlulukForm').submit(function(e) {
				e.preventDefault();
				
				$.ajax({
					url: '<?= base_url("yonetici/addResponsibilityArea") ?>',
					type: 'POST',
					data: $(this).serialize(),
					dataType: 'json',
					success: function(response) {
						if(response.success) {
							alert('Sorumluluk bölgesi başarıyla eklendi!');
							location.reload();
						} else {
							alert('Hata: ' + response.message);
						}
					},
					error: function() {
						alert('İşlem sırasında hata oluştu!');
					}
				});
			});
		});

		// Sorumluluk bölgesi sil
		function sorumlulukSil(id) {
			if(confirm('Bu sorumluluk bölgesini silmek istediğinizden emin misiniz?')) {
				$.ajax({
					url: '<?= base_url("yonetici/deleteResponsibilityArea") ?>',
					type: 'POST',
					data: {id: id},
					dataType: 'json',
					success: function(response) {
						if(response.success) {
							alert('Sorumluluk bölgesi başarıyla silindi!');
							location.reload();
						} else {
							alert('Hata: ' + response.message);
						}
					},
					error: function() {
						alert('Silme işlemi sırasında hata oluştu!');
					}
				});
			}
		}	</script>

	<?php $this->load->view("include/footer-js"); ?>

</body>
</html>