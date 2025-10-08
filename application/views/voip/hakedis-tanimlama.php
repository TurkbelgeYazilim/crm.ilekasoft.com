<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<style>
	.card {
		margin-bottom: 20px;
		border: 1px solid #e9ecef;
		border-radius: 0.375rem;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
	}
	
	.card-header {
		background-color: #f8f9fa;
		border-bottom: 1px solid #e9ecef;
		padding: 0.75rem 1.25rem;
		font-weight: 600;
	}
	
	.card-body {
		padding: 1.25rem;
	}
	
	.table th {
		background-color: #f8f9fa;
		border-bottom: 2px solid #e9ecef;
		font-weight: 600;
		text-align: center;
		vertical-align: middle;
		padding: 12px 8px;
		color: #495057;
	}
	
	.table td {
		padding: 10px 8px;
		vertical-align: middle;
		border-bottom: 1px solid #e9ecef;
	}
	
	.table tbody tr:hover {
		background-color: #f8f9fa;
	}
	
	.btn {
		border-radius: 0.375rem;
		font-weight: 500;
		transition: all 0.2s ease-in-out;
	}
	
	.btn-sm {
		padding: 0.25rem 0.5rem;
		font-size: 0.875rem;
	}
	
	.btn-primary {
		background-color: #007bff;
		border-color: #007bff;
	}
	
	.btn-primary:hover {
		background-color: #0056b3;
		border-color: #0056b3;
		transform: translateY(-1px);
	}
	
	.btn-success {
		background-color: #28a745;
		border-color: #28a745;
	}
	
	.btn-success:hover {
		background-color: #1e7e34;
		border-color: #1e7e34;
		transform: translateY(-1px);
	}
	
	.btn-warning {
		background-color: #ffc107;
		border-color: #ffc107;
		color: #212529;
	}
	
	.btn-warning:hover {
		background-color: #e0a800;
		border-color: #e0a800;
		color: #212529;
		transform: translateY(-1px);
	}
	
	.btn-danger {
		background-color: #dc3545;
		border-color: #dc3545;
	}
	
	.btn-danger:hover {
		background-color: #c82333;
		border-color: #c82333;
		transform: translateY(-1px);
	}
	
	.stats-card {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		padding: 20px;
		border-radius: 0.375rem;
		text-align: center;
		margin-bottom: 20px;
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
	}
	
	.stats-card h3 {
		margin: 0 0 5px 0;
		font-size: 2rem;
		font-weight: 700;
	}
	
	.stats-card p {
		margin: 0;
		opacity: 0.9;
	}
	
	.filter-card {
		background-color: #f8f9fa;
		border: 1px solid #dee2e6;
		border-radius: 0.375rem;
		padding: 15px;
		margin-bottom: 20px;
	}
	
	.money-display {
		font-weight: 600;
		color: #28a745;
	}
	
	.empty-state {
		text-align: center;
		color: #6c757d;
		font-style: italic;
		padding: 40px 20px;
	}
	
	/* Bootstrap 3/4 uyumluluk */
	.mb-3 {
		margin-bottom: 1rem !important;
	}
	
	.d-flex {
		display: flex !important;
	}
	
	.justify-content-between {
		justify-content: space-between !important;
	}
	
	.align-items-center {
		align-items: center !important;
	}
	
	.align-items-end {
		align-items: flex-end !important;
	}
	
	.w-100 {
		width: 100% !important;
	}
	
	.me-1 {
		margin-right: 0.25rem !important;
	}
	
	.me-2 {
		margin-right: 0.5rem !important;
	}
	
	.form-label {
		margin-bottom: 5px;
		font-weight: 500;
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
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title">
								<i class="fas fa-calculator me-2"></i>
								Hakediş Tanımlama
							</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url() ?>">Ana Sayfa</a></li>
								<li class="breadcrumb-item"><a href="<?= base_url('voip') ?>">VoIP & Hakediş</a></li>
								<li class="breadcrumb-item active">Hakediş Tanımlama</li>
							</ul>
						</div>
						<div class="col-auto float-right ml-auto">
							<a href="#" class="btn btn-add btn-sm" data-toggle="modal" data-target="#hakedisModal">
								<i class="fas fa-plus"></i> Yeni Hakediş Ekle
							</a>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<!-- İstatistik Kartları -->
				<div class="row">
					<div class="col-md-4">
						<div class="stats-card">
							<h3><?= count($hakedis_ucretleri) ?></h3>
							<p><i class="fas fa-list me-1"></i>Toplam Kayıt</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
							<h3><?php 
								$aktif = 0;
								foreach($hakedis_ucretleri as $h) {
									if(!$h->bitis_tarihi || strtotime($h->bitis_tarihi) > time()) $aktif++;
								}
								echo $aktif;
							?></h3>
							<p><i class="fas fa-check-circle me-1"></i>Aktif Kayıt</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="stats-card" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); color: #333;">
							<h3><?php 
								$buay = 0;
								$thisMonth = date('Y-m');
								foreach($hakedis_ucretleri as $h) {
									if(substr($h->baslangic_tarihi, 0, 7) == $thisMonth) $buay++;
								}
								echo $buay;
							?></h3>
							<p><i class="fas fa-calendar-alt me-1"></i>Bu Ay</p>
						</div>
					</div>
				</div>

				<!-- Filtreleme Kartı -->
				<div class="card filter-card">
					<div class="row">
						<div class="col-md-3">
							<label for="filtreKullanici" class="form-label">
								<i class="fas fa-user me-1"></i>
								Kullanıcı
							</label>
							<select class="form-control" id="filtreKullanici">
								<option value="">Tüm kullanıcılar</option>
								<?php foreach($kullanicilar as $kullanici): ?>
									<option value="<?= $kullanici->kullanici_id ?>">
										<?= $kullanici->kullanici_ad ?> <?= $kullanici->kullanici_soyad ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-md-3">
							<label for="filtreBaslangicTarihi" class="form-label">
								<i class="fas fa-calendar me-1"></i>
								Başlangıç Tarihi
							</label>
							<input type="date" class="form-control" id="filtreBaslangicTarihi">
						</div>
						<div class="col-md-3">
							<label for="filtreBitisTarihi" class="form-label">
								<i class="fas fa-calendar me-1"></i>
								Bitiş Tarihi
							</label>
							<input type="date" class="form-control" id="filtreBitisTarihi">
						</div>
						<div class="col-md-3 d-flex align-items-end">
							<button type="button" class="btn btn-primary w-100" onclick="filtreUygula()">
								<i class="fas fa-filter me-1"></i>
								Filtrele
							</button>
						</div>
					</div>
				</div>

				<!-- Hakediş Tablosu -->
				<div class="card">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h5 class="card-title mb-0">
							<i class="fas fa-table me-2"></i>
							Hakediş Ücretleri Listesi
						</h5>
						<div>
							<button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.reload()">
								<i class="fas fa-sync-alt me-1"></i>
								Yenile
							</button>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Kullanıcı</th>
										<th>Tek NEO</th>
										<th>Tek Uydu</th>
										<th>NEO'lu İnternet</th>
										<th>Uydulu İnternet</th>
										<th>Başlangıç Tarihi</th>
										<th>Bitiş Tarihi</th>
										<th>Açıklama</th>
										<th width="120">İşlemler</th>
									</tr>
								</thead>
								<tbody id="hakedisTableBody">
									<?php if(!empty($hakedis_ucretleri)): ?>
										<?php foreach($hakedis_ucretleri as $hakedis): ?>
											<tr>
												<td>
													<strong><?= $hakedis->kullanici_ad ?> <?= $hakedis->kullanici_soyad ?></strong>
												</td>
												<td>
													<?= $hakedis->tek_neo ? '<span class="money-display">₺' . number_format($hakedis->tek_neo, 2, ',', '.') . '</span>' : '-' ?>
												</td>
												<td>
													<?= $hakedis->tek_uydu ? '<span class="money-display">₺' . number_format($hakedis->tek_uydu, 2, ',', '.') . '</span>' : '-' ?>
												</td>
												<td>
													<?= $hakedis->neolu_internet ? '<span class="money-display">₺' . number_format($hakedis->neolu_internet, 2, ',', '.') . '</span>' : '-' ?>
												</td>
												<td>
													<?= $hakedis->uydulu_internet ? '<span class="money-display">₺' . number_format($hakedis->uydulu_internet, 2, ',', '.') . '</span>' : '-' ?>
												</td>
												<td>
													<span class="badge badge-info">
														<?= date('d.m.Y', strtotime($hakedis->baslangic_tarihi)) ?>
													</span>
												</td>
												<td>
													<?= $hakedis->bitis_tarihi ? '<span class="badge badge-warning">' . date('d.m.Y', strtotime($hakedis->bitis_tarihi)) . '</span>' : '<span class="badge badge-success">Devam ediyor</span>' ?>
												</td>
												<td>
													<?= $hakedis->aciklama ? '<small>' . htmlspecialchars($hakedis->aciklama) . '</small>' : '-' ?>
												</td>
												<td>
													<div class="btn-group">
														<button type="button" class="btn btn-sm btn-outline-warning" 
																onclick="duzenleHakedis(<?= $hakedis->id ?>)" 
																title="Düzenle">
															<i class="fas fa-edit"></i>
														</button>
														<button type="button" class="btn btn-sm btn-outline-danger" 
																onclick="silHakedis(<?= $hakedis->id ?>)" 
																title="Sil">
															<i class="fas fa-trash"></i>
														</button>
													</div>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td colspan="9" class="empty-state">
												<i class="fas fa-info-circle fa-2x mb-2"></i><br>
												Henüz hakediş kaydı bulunmamaktadır.
											</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

	<!-- Hakediş Modal -->
	<div class="modal fade" id="hakedisModal" tabindex="-1" role="dialog" aria-labelledby="hakedisModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="hakedisModalLabel">
						<i class="fas fa-plus-circle me-2"></i>
						Yeni Hakediş Ekle
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="hakedisForm">
						<input type="hidden" id="hakedis_id" name="id" value="">
						
						<div class="mb-3">
							<label for="kullanici_id" class="form-label">
								<i class="fas fa-user me-1"></i>
								Kullanıcı <span class="text-danger">*</span>
							</label>
							<select class="form-control" id="kullanici_id" name="kullanici_id" required>
								<option value="">Kullanıcı seçiniz...</option>
								<?php foreach($kullanicilar as $kullanici): ?>
									<option value="<?= $kullanici->kullanici_id ?>">
										<?= $kullanici->kullanici_ad ?> <?= $kullanici->kullanici_soyad ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label for="tek_neo" class="form-label">
										<i class="fas fa-phone me-1"></i>
										Tek NEO Ücreti
									</label>
									<input type="number" class="form-control" id="tek_neo" name="tek_neo" 
										   step="0.01" min="0" placeholder="0.00">
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="tek_uydu" class="form-label">
										<i class="fas fa-satellite me-1"></i>
										Tek Uydu Ücreti
									</label>
									<input type="number" class="form-control" id="tek_uydu" name="tek_uydu" 
										   step="0.01" min="0" placeholder="0.00">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label for="neolu_internet" class="form-label">
										<i class="fas fa-wifi me-1"></i>
										NEO'lu İnternet Ücreti
									</label>
									<input type="number" class="form-control" id="neolu_internet" name="neolu_internet" 
										   step="0.01" min="0" placeholder="0.00">
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="uydulu_internet" class="form-label">
										<i class="fas fa-globe me-1"></i>
										Uydulu İnternet Ücreti
									</label>
									<input type="number" class="form-control" id="uydulu_internet" name="uydulu_internet" 
										   step="0.01" min="0" placeholder="0.00">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label for="baslangic_tarihi" class="form-label">
										<i class="fas fa-calendar me-1"></i>
										Başlangıç Tarihi <span class="text-danger">*</span>
									</label>
									<input type="date" class="form-control" id="baslangic_tarihi" name="baslangic_tarihi" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="bitis_tarihi" class="form-label">
										<i class="fas fa-calendar-times me-1"></i>
										Bitiş Tarihi
									</label>
									<input type="date" class="form-control" id="bitis_tarihi" name="bitis_tarihi">
								</div>
							</div>
						</div>
						
						<div class="mb-3">
							<label for="aciklama" class="form-label">
								<i class="fas fa-comment me-1"></i>
								Açıklama
							</label>
							<textarea class="form-control" id="aciklama" name="aciklama" rows="3" 
									  placeholder="Hakediş ile ilgili açıklama yazabilirsiniz..."></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						<i class="fas fa-times"></i> İptal
					</button>
					<button type="button" class="btn btn-success" onclick="kaydetHakedis()">
						<i class="fas fa-save"></i> Kaydet
					</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php $this->load->view("include/footer-js"); ?>
	
	<script>
		$(document).ready(function() {
			// Select2 yüklüyse kullan
			if (typeof $.fn.select2 !== 'undefined') {
				$('#kullanici_id, #filtreKullanici').select2({
					placeholder: "Kullanıcı seçiniz...",
					allowClear: true
				});
			}
		});

		function kaydetHakedis() {
			if(!$('#hakedisForm')[0].checkValidity()) {
				$('#hakedisForm')[0].reportValidity();
				return;
			}

			const formData = new FormData($('#hakedisForm')[0]);
			const isEdit = $('#hakedis_id').val() !== '';
			const url = isEdit ? '<?= base_url("voip/hakedis_guncelle") ?>' : '<?= base_url("voip/hakedis_ekle") ?>';

			$.ajax({
				url: url,
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function(response) {
					if(response.success) {
						if (typeof toastr !== 'undefined') {
							toastr.success(response.message);
						} else {
							alert(response.message);
						}
						$('#hakedisModal').modal('hide');
						setTimeout(() => {
							location.reload();
						}, 1000);
					} else {
						if (typeof toastr !== 'undefined') {
							toastr.error(response.message);
						} else {
							alert('Hata: ' + response.message);
						}
					}
				},
				error: function() {
					if (typeof toastr !== 'undefined') {
						toastr.error('Bir hata oluştu. Lütfen tekrar deneyin.');
					} else {
						alert('Bir hata oluştu. Lütfen tekrar deneyin.');
					}
				}
			});
		}

		function duzenleHakedis(id) {
			$.ajax({
				url: '<?= base_url("voip/hakedis_getir") ?>',
				type: 'POST',
				data: {id: id},
				dataType: 'json',
				success: function(response) {
					if(response.success) {
						const data = response.data;
						$('#hakedis_id').val(data.id);
						$('#kullanici_id').val(data.kullanici_id);
						if (typeof $.fn.select2 !== 'undefined') {
							$('#kullanici_id').trigger('change');
						}
						$('#tek_neo').val(data.tek_neo);
						$('#tek_uydu').val(data.tek_uydu);
						$('#neolu_internet').val(data.neolu_internet);
						$('#uydulu_internet').val(data.uydulu_internet);
						$('#baslangic_tarihi').val(data.baslangic_tarihi);
						$('#bitis_tarihi').val(data.bitis_tarihi);
						$('#aciklama').val(data.aciklama);
						
						$('#hakedisModalLabel').html('<i class="fas fa-edit me-2"></i>Hakediş Düzenle');
						$('#hakedisModal').modal('show');
					} else {
						if (typeof toastr !== 'undefined') {
							toastr.error(response.message);
						} else {
							alert('Hata: ' + response.message);
						}
					}
				},
				error: function() {
					if (typeof toastr !== 'undefined') {
						toastr.error('Hakediş bilgileri alınamadı.');
					} else {
						alert('Hakediş bilgileri alınamadı.');
					}
				}
			});
		}

		function silHakedis(id) {
			if(confirm('Bu hakediş kaydını silmek istediğinizden emin misiniz?')) {
				$.ajax({
					url: '<?= base_url("voip/hakedis_sil") ?>',
					type: 'POST',
					data: {id: id},
					dataType: 'json',
					success: function(response) {
						if(response.success) {
							if (typeof toastr !== 'undefined') {
								toastr.success(response.message);
							} else {
								alert(response.message);
							}
							setTimeout(() => {
								location.reload();
							}, 1000);
						} else {
							if (typeof toastr !== 'undefined') {
								toastr.error(response.message);
							} else {
								alert('Hata: ' + response.message);
							}
						}
					},
					error: function() {
						if (typeof toastr !== 'undefined') {
							toastr.error('Silme işlemi başarısız.');
						} else {
							alert('Silme işlemi başarısız.');
						}
					}
				});
			}
		}

		function filtreUygula() {
			const kullanici_id = $('#filtreKullanici').val();
			const baslangic_tarihi = $('#filtreBaslangicTarihi').val();
			const bitis_tarihi = $('#filtreBitisTarihi').val();

			$.ajax({
				url: '<?= base_url("voip/hakedis_raporu") ?>',
				type: 'POST',
				data: {
					kullanici_id: kullanici_id,
					baslangic_tarihi: baslangic_tarihi,
					bitis_tarihi: bitis_tarihi
				},
				dataType: 'json',
				success: function(response) {
					if(response.success) {
						let html = '';
						if(response.data.length > 0) {
							response.data.forEach(function(hakedis) {
								html += '<tr>';
								html += '<td><strong>' + hakedis.kullanici_ad + ' ' + hakedis.kullanici_soyad + '</strong></td>';
								html += '<td>' + (hakedis.tek_neo ? '<span class="money-display">₺' + parseFloat(hakedis.tek_neo).toLocaleString('tr-TR', {minimumFractionDigits: 2}) + '</span>' : '-') + '</td>';
								html += '<td>' + (hakedis.tek_uydu ? '<span class="money-display">₺' + parseFloat(hakedis.tek_uydu).toLocaleString('tr-TR', {minimumFractionDigits: 2}) + '</span>' : '-') + '</td>';
								html += '<td>' + (hakedis.neolu_internet ? '<span class="money-display">₺' + parseFloat(hakedis.neolu_internet).toLocaleString('tr-TR', {minimumFractionDigits: 2}) + '</span>' : '-') + '</td>';
								html += '<td>' + (hakedis.uydulu_internet ? '<span class="money-display">₺' + parseFloat(hakedis.uydulu_internet).toLocaleString('tr-TR', {minimumFractionDigits: 2}) + '</span>' : '-') + '</td>';
								html += '<td><span class="badge badge-info">' + new Date(hakedis.baslangic_tarihi).toLocaleDateString('tr-TR') + '</span></td>';
								html += '<td>' + (hakedis.bitis_tarihi ? '<span class="badge badge-warning">' + new Date(hakedis.bitis_tarihi).toLocaleDateString('tr-TR') + '</span>' : '<span class="badge badge-success">Devam ediyor</span>') + '</td>';
								html += '<td>' + (hakedis.aciklama ? '<small>' + hakedis.aciklama + '</small>' : '-') + '</td>';
								html += '<td>';
								html += '<div class="btn-group">';
								html += '<button type="button" class="btn btn-sm btn-outline-warning" onclick="duzenleHakedis(' + hakedis.id + ')" title="Düzenle"><i class="fas fa-edit"></i></button>';
								html += '<button type="button" class="btn btn-sm btn-outline-danger" onclick="silHakedis(' + hakedis.id + ')" title="Sil"><i class="fas fa-trash"></i></button>';
								html += '</div>';
								html += '</td>';
								html += '</tr>';
							});
						} else {
							html = '<tr><td colspan="9" class="empty-state"><i class="fas fa-info-circle fa-2x mb-2"></i><br>Filtrelenen kriterlere uygun kayıt bulunamadı.</td></tr>';
						}
						
						$('#hakedisTableBody').html(html);
						
						if (typeof toastr !== 'undefined') {
							toastr.info('Filtre uygulandı. ' + response.kayit_sayisi + ' kayıt bulundu.');
						}
					} else {
						if (typeof toastr !== 'undefined') {
							toastr.error(response.message);
						} else {
							alert('Hata: ' + response.message);
						}
					}
				},
				error: function() {
					if (typeof toastr !== 'undefined') {
						toastr.error('Filtreleme işlemi başarısız.');
					} else {
						alert('Filtreleme işlemi başarısız.');
					}
				}
			});
		}
	</script>

</body>
</html>
