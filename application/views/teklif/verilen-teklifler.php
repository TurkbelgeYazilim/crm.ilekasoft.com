<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<title><?php echo isset($baslik) ? $baslik : 'Verilen Teklifler'; ?> | İlekaSoft CRM</title>
	<link rel="icon" type="image/x-icon" href="<?= base_url('assets/favicon.ico'); ?>" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.13.6/css/dataTables.bootstrap4.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css"/>

	<style>
		.status-badge {
			font-size: 0.8rem;
			padding: 0.25rem 0.5rem;
		}
		.table-responsive {
			border-radius: 0.5rem;
			box-shadow: 0 0 0.875rem 0 rgba(33, 37, 41, 0.05);
		}
		.custom-table th {
			background-color: #f8f9fa;
			font-weight: 600;
			color: #495057;
			border-bottom: 2px solid #dee2e6;
		}
		.btn-xs {
			padding: 0.25rem 0.5rem;
			font-size: 0.75rem;
			line-height: 1.2;
			border-radius: 0.25rem;
		}
		.info-card {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			border-radius: 10px;
			padding: 20px;
			margin-bottom: 20px;
		}
		.info-card h5 {
			color: white;
			margin-bottom: 10px;
		}
		.info-card .number {
			font-size: 2rem;
			font-weight: bold;
		}
		
		/* Müşteri adı sütunu için özel stil */
		.customer-name-truncated {
			max-width: 200px;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			cursor: help;
		}
		
		/* Tooltip için Bootstrap stil */
		[title] {
			cursor: help;
		}
		
		/* Açıklama sütunu için çok satırlı metin */
		.description-multiline {
			white-space: pre-wrap;
			word-wrap: break-word;
			max-width: 300px;
			line-height: 1.3;
			font-size: 0.85rem;
		}
		
		/* Filtre butonları için stil */
		#applyFilters {
			background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
			border: none;
			padding: 8px 20px;
			font-weight: 600;
			border-radius: 6px;
			box-shadow: 0 2px 4px rgba(40, 167, 69, 0.3);
			transition: all 0.3s ease;
		}
		
		#applyFilters:hover {
			background: linear-gradient(135deg, #218838 0%, #1ea880 100%);
			box-shadow: 0 4px 8px rgba(40, 167, 69, 0.4);
			transform: translateY(-1px);
		}
		
		#applyFilters:active {
			transform: translateY(0);
			box-shadow: 0 1px 2px rgba(40, 167, 69, 0.3);
		}
		
		/* Filtre mesajları için stil */
		.filter-applied-message, .filter-cleared-message {
			border-radius: 8px;
			border: none;
			font-weight: 500;
		}
		
		.filter-applied-message {
			background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
			border-left: 4px solid #28a745;
		}
		
		.filter-cleared-message {
			background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
			border-left: 4px solid #17a2b8;
		}
		
		/* Modern Forced Colors Mode desteği (MS High Contrast yerine) */
		@media (forced-colors: active) {
			.info-card {
				background: ButtonFace;
				color: ButtonText;
				border: 1px solid ButtonText;
			}
			
			.custom-table th {
				background-color: ButtonFace;
				color: ButtonText;
				border: 1px solid ButtonText;
			}
			
			.filter-applied-message,
			.filter-cleared-message {
				background: ButtonFace;
				color: ButtonText;
				border: 1px solid ButtonText;
			}
			
			.btn {
				background: ButtonFace;
				color: ButtonText;
				border: 1px solid ButtonText;
			}
		}
		
		/* Deprecation uyarılarını bastırmak için override */
		@media screen and (-ms-high-contrast: active) {
			/* Bu media query kullanımdan kaldırılıyor ama geçiş sürecinde uyumluluk için bırakılıyor */
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
			
				<!-- Yetki Kontrolü -->
				<?php 
				// Hangi yetki kontrolü yapılacağını belirle
				$required_permission = isset($baslik) && $baslik == 'Tüm Teklifler' ? 1512 : 1511;
				$permission_name = $required_permission == 1512 ? 'Tüm Teklifler (ID: 1512)' : 'Verilen Teklif (ID: 1511)';
				?>
				<?php if (!grup_modul_yetkisi_var($required_permission)): ?>
					<div class="alert alert-danger text-center">
						<i class="fas fa-ban fa-3x mb-3"></i>
						<h4>Erişim Engellendi</h4>
						<p>Bu sayfaya erişim yetkiniz bulunmamaktadır.</p>
						<p><strong>Gerekli Yetki:</strong> <?= $permission_name; ?></p>
						<a href="<?= base_url(); ?>" class="btn btn-primary">
							<i class="fas fa-home"></i> Anasayfaya Dön
						</a>
					</div>
				<?php else: ?>
			
				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-8">
							<h3 class="page-title"><?php echo isset($baslik) ? $baslik : 'Verilen Teklifler'; ?></h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
								<li class="breadcrumb-item">Teklif</li>
								<li class="breadcrumb-item active"><?php echo isset($baslik) ? $baslik : 'Verilen Teklifler'; ?></li>
							</ul>
							<?php if (isset($kullanici_grup_id)): ?>
								<?php 
								$grup_isimleri = [
									1 => 'Admin',
									2 => 'Muhasebe',
									3 => 'Saha Satış Temsilcisi',
									4 => 'Hukuk',
									5 => 'Aktivasyon',
									6 => 'Bölge Müdürü',
									7 => 'Genel Müdür'
								];
								$grup_renkleri = [
									1 => 'danger',    // Admin - Kırmızı
									2 => 'success',   // Muhasebe - Yeşil
									3 => 'warning',   // Saha Satış Temsilcisi - Sarı
									4 => 'info',      // Hukuk - Mavi
									5 => 'primary',   // Aktivasyon - Birincil Mavi
									6 => 'secondary', // Bölge Müdürü - Gri
									7 => 'dark'       // Genel Müdür - Siyah
								];
								$kullanici_grup_adi = isset($grup_isimleri[$kullanici_grup_id]) ? $grup_isimleri[$kullanici_grup_id] : 'Bilinmeyen Grup';
								$kullanici_grup_rengi = isset($grup_renkleri[$kullanici_grup_id]) ? $grup_renkleri[$kullanici_grup_id] : 'secondary';
								?>
								<div class="mt-2">
									<span class="badge badge-<?= $kullanici_grup_rengi ?> mr-2">
										<i class="fas fa-user-tag"></i> <?= $kullanici_grup_adi ?> (ID: <?= $kullanici_grup_id ?>)
									</span>
									<?php if (in_array($kullanici_grup_id, [3, 6])): ?>
										<span class="badge badge-warning">
											<i class="fas fa-filter"></i> Sadece kendi carilerinizi görüyorsunuz
										</span>
									<?php else: ?>
										<span class="badge badge-success">
											<i class="fas fa-eye"></i> Tüm carileri görüntüleyebilirsiniz
										</span>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="d-flex justify-content-end text-align-center col-sm-4">
							<a class="btn btn-outline-light" href="javascript:history.back()">
								<i class="fa fa-history"></i> <br>Önceki Sayfa
							</a>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<!-- Filtreler -->
				<div class="row mb-3">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">
									<i class="fas fa-list"></i> <?php echo isset($baslik) ? $baslik : 'Verilen Teklifler'; ?> Listesi
									<span class="badge badge-primary ml-2"><?= isset($toplam_teklif) ? $toplam_teklif : 0; ?> Kayıt</span>
									<?php if (!isset($toplam_teklif)): ?>
										<span class="badge badge-warning ml-2">⚠️ Veri Hatası</span>
									<?php endif; ?>
								</h5>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="filterTarih">Tarih Aralığı</label>
											<div class="input-group">
												<input type="date" class="form-control" id="filterTarihBaslangic" placeholder="Başlangıç">
												<div class="input-group-prepend input-group-append">
													<span class="input-group-text">-</span>
												</div>
												<input type="date" class="form-control" id="filterTarihBitis" placeholder="Bitiş">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="filterPersonel">
												<i class="fas fa-user"></i> Personel
												<small class="text-muted">(Aranabilir)</small>
											</label>
											<select class="form-control select2-search" id="filterPersonel" data-placeholder="Personel seçin veya arayın...">
												<option value="">Tüm Personeller</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="filterLokasyon">
												<i class="fas fa-map-marker-alt"></i> Lokasyon
												<small class="text-muted">(Aranabilir)</small>
											</label>
											<select class="form-control select2-search" id="filterLokasyon" data-placeholder="Lokasyon seçin veya arayın...">
												<option value="">Tüm Lokasyonlar</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="filterDurum">
												<i class="fas fa-flag"></i> Durum
												<small class="text-muted">(Aranabilir)</small>
											</label>
											<select class="form-control select2-search" id="filterDurum" data-placeholder="Durum seçin veya arayın...">
												<option value="">Tüm Durumlar</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-md-12 text-center">
										<button type="button" class="btn btn-primary mr-2" id="applyFilters">
											<i class="fas fa-filter"></i> Filtre Uygula
										</button>
										<button type="button" class="btn btn-outline-secondary" onclick="clearFilters()">
											<i class="fas fa-times"></i> Temizle
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Teklifler Tablosu -->
				<div class="row">
					<div class="col-xl-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<?php if (!isset($toplam_teklif) || !isset($teklifler)): ?>
								<div class="alert alert-danger">
									<h5><i class="fas fa-exclamation-triangle"></i> Veri Yükleme Hatası</h5>
									<p>Veriler yüklenirken bir hata oluştu. Lütfen sayfayı yenileyin veya sistem yöneticisine başvurun.</p>
									<ul>
										<li>toplam_teklif: <?= isset($toplam_teklif) ? '✅ Mevcut' : '❌ Eksik'; ?></li>
										<li>teklifler: <?= isset($teklifler) ? '✅ Mevcut' : '❌ Eksik'; ?></li>
									</ul>
								</div>
								<?php elseif (empty($teklifler)): ?>
								<div class="alert alert-info text-center">
									<h5><i class="fas fa-info-circle"></i> Henüz Verilen Teklif Bulunmuyor</h5>
									<p>Sisteme henüz teklif eklenmemiş. <a href="<?= base_url('teklif/teklif-hazirla'); ?>">Teklif Hazırlama</a> sayfasından yeni teklif ekleyebilirsiniz.</p>
								</div>
								<?php else: ?>
								<div class="table-responsive">
									<table class="table table-striped custom-table mb-0" id="tekliflerTable">
										<thead>
											<tr>
												<th>Teklif ID</th>
												<th>Personel Adı</th>
												<th>Müşteri Adı</th>
												<th>Telefon</th>
												<th>Lokasyon</th>
												<th>Durum</th>
												<th>Bizim Teklifimiz</th>
												<th>Müşteri Beklentisi</th>
												<th>Olabilir Teklif</th>
												<th>Açıklama</th>
												<th>Tarih</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($teklifler as $teklif): ?>
											<tr data-islem-tarihi="<?= $teklif->islem_tarihi ?? ''; ?>">
												<td><strong>#<?= $teklif->id; ?></strong></td>
												<td>
													<strong><?= htmlspecialchars($teklif->kullanici_adsoyad ?? 'Bilinmiyor'); ?></strong>
												</td>
												<td>
													<strong><?= htmlspecialchars($teklif->potansiyel_cari_ad ?? 'Bilinmiyor'); ?></strong>
												</td>
												<td>
													<?php if ($teklif->potansiyel_cari_firmaTelefon): ?>
													<a href="tel:<?= $teklif->potansiyel_cari_firmaTelefon; ?>" class="text-primary">
														<i class="fas fa-phone"></i> <?= htmlspecialchars($teklif->potansiyel_cari_firmaTelefon); ?>
													</a>
													<?php else: ?>
													<span class="text-muted">-</span>
													<?php endif; ?>
												</td>
												<td>
													<small>
														<?= htmlspecialchars($teklif->il_adi ?? '-'); ?><br>
														<?= htmlspecialchars($teklif->ilce_adi ?? '-'); ?>
													</small>
												</td>
												<td>
													<span class="badge badge-<?= ($teklif->Durum_Adi == 'Satın Aldı') ? 'success' : (($teklif->Durum_Adi == 'İlgilenmiyor') ? 'danger' : 'warning'); ?>">
														<?= htmlspecialchars($teklif->Durum_Adi ?? 'Belirtilmemiş'); ?>
													</span>
												</td>
												<td>
													<?php if ($teklif->fiyat1): ?>
													<strong class="text-success"><?= number_format($teklif->fiyat1, 2); ?> ₺</strong>
													<?php else: ?>
													<span class="text-muted">-</span>
													<?php endif; ?>
												</td>
												<td>
													<?php if ($teklif->fiyat2): ?>
													<strong class="text-success"><?= number_format($teklif->fiyat2, 2); ?> ₺</strong>
													<?php else: ?>
													<span class="text-muted">-</span>
													<?php endif; ?>
												</td>
												<td>
													<?php if ($teklif->fiyat3): ?>
													<strong class="text-success"><?= number_format($teklif->fiyat3, 2); ?> ₺</strong>
													<?php else: ?>
													<span class="text-muted">-</span>
													<?php endif; ?>
												</td>
												<td>
													<?php if ($teklif->aciklama): ?>
													<small><?= htmlspecialchars($teklif->aciklama); ?></small>
													<?php else: ?>
													<span class="text-muted">-</span>
													<?php endif; ?>
												</td>
												<td>
													<small>
														<?= date('d.m.Y H:i', strtotime($teklif->islem_tarihi ?? 'now')); ?>
													</small>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>

				<?php endif; ?>

			</div>
		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script>
		// Console uyarılarını filtrele (-ms-high-contrast deprecation uyarıları için)
		(function() {
			const originalWarn = console.warn;
			console.warn = function(message, ...args) {
				// -ms-high-contrast deprecation uyarılarını filtrele
				if (typeof message === 'string' && message.includes('-ms-high-contrast')) {
					return; // Bu uyarıları gösterme
				}
				// Diğer uyarıları normal şekilde göster
				return originalWarn.apply(console, [message, ...args]);
			};
		})();
		
		// Fallback to local jQuery if CDN fails
		if (typeof jQuery === 'undefined') {
			document.write('<script src="<?= base_url("assets/js/jquery-3.5.1.min.js"); ?>"><\/script>');
		}
	</script>
	
	<!-- Bootstrap Core JS -->
	<script src="<?= base_url("assets/js/popper.min.js"); ?>"></script>
	<script src="<?= base_url("assets/js/bootstrap.min.js"); ?>"></script>
	
	<!-- Slimscroll JS -->
	<script src="<?= base_url("assets/plugins/slimscroll/jquery.slimscroll.min.js"); ?>"></script>
	
	<!-- DataTables JS -->
	<script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.13.6/js/dataTables.bootstrap4.min.js"></script>
	
	<!-- Select2 JS -->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	
	<!-- Custom JS -->
	<script src="<?= base_url("assets/js/script.js"); ?>"></script>

	<script>
		// Ensure jQuery is loaded before executing code
		function initializeDataTable() {
			if (typeof jQuery === 'undefined') {
				console.error('jQuery is not loaded. DataTable initialization failed.');
				return;
			}
			
			$(document).ready(function() {
				try {
					// DataTable başlat
					var table = $('#tekliflerTable').DataTable({
						"language": {
							"url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json"
						},
						"order": [[ 10, "desc" ]], // İşlem Tarihi sütununa göre azalan sıralama (ps.islem_tarihi)
						"pageLength": 25,
						"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tümü"]],
						"paging": true, // Sayfalama kesinlikle aktif
						"pagingType": "full_numbers", // Tam sayfa navigasyon butonları
						"lengthChange": true, // Sayfa başına kayıt sayısı değişimi aktif
						"searching": true, // Arama aktif
						"info": true, // Sayfa bilgisi göster (örn: "25 kayıttan 1-25 arası gösteriliyor")
						"responsive": true,
						"columnDefs": [
							{ 
								"targets": 0, // ID sütunu - HTML içeriği için özel işleme
								"render": function(data, type, row) {
									if (type === 'display') {
										return data; // HTML olarak göster
									}
									// Search ve sort için sadece text içeriği kullan
									return $('<div>').html(data).text();
								}
							},
							{ 
								"targets": 1, // Personel sütunu - HTML içeriği için özel işleme
								"render": function(data, type, row) {
									if (type === 'display') {
										return data; // HTML olarak göster
									}
									// Search ve sort için sadece text içeriği kullan
									return $('<div>').html(data).text();
								}
							},
							{ 
								"targets": 2, // Müşteri sütunu - HTML içeriği için özel işleme ve 30 karakter sınırı
								"render": function(data, type, row) {
									if (type === 'display') {
										// Görüntüleme için HTML içeriğini al ve 30 karakter sınırı uygula
										var textContent = $('<div>').html(data).text();
										if (textContent.length > 30) {
											var truncated = textContent.substring(0, 30) + '...';
											return '<span class="customer-name-truncated" title="' + textContent + '">' + truncated + '</span>';
										}
										return data; // 30 karakterden kısaysa orijinal HTML'i göster
									}
									// Search ve sort için sadece text içeriği kullan
									return $('<div>').html(data).text();
								}
							},
							{ 
								"targets": 9, // Açıklama sütunu - 100 karakter sınırı (50+50 karakter, iki satır)
								"render": function(data, type, row) {
									if (type === 'display') {
										// HTML içeriğini text olarak al
										var textContent = $('<div>').html(data).text();
										if (textContent && textContent.trim() !== '' && textContent !== '-') {
											var isLongText = textContent.length > 100;
											var displayText = isLongText ? textContent.substring(0, 100) : textContent;
											
											// 50 karakterde satır sonu ekle (maksimum 2 satır)
											var firstLine = displayText.substring(0, 50);
											var secondLine = displayText.substring(50, 100);
											
											var formatted = firstLine;
											if (secondLine && secondLine.trim() !== '') {
												formatted += '<br>' + secondLine;
											}
											
											// Eğer orijinal metin 100 karakterden uzunsa ... ve tooltip ekle
											if (isLongText) {
												formatted += '...';
												return '<span class="description-multiline" title="' + textContent + '">' + formatted + '</span>';
											} else {
												return '<span class="description-multiline">' + formatted + '</span>';
											}
										}
										return data; // Boş veya - ise orijinal veriyi göster
									}
									// Search ve sort için sadece text içeriği kullan
									return $('<div>').html(data).text();
								}
							},
							{ 
								"targets": 10, // İşlem Tarihi sütunu
								"type": "date",
								"render": function(data, type, row) {
									if (type === 'display' || type === 'type') {
										return data;
									}
									// Sorting ve filtering için raw tarih değerini kullan
									var rowElement = $(table.row(row).node());
									var rawDate = rowElement.data('islem-tarihi');
									return rawDate ? new Date(rawDate).getTime() : 0;
								}
							}
						]
					});

					// Select2 initializasyonu ve filtreleme
					console.log('Initializing filters...');
					initializeSelect2Filters();
					
					// Tablo verilerinden filtreleri doldur (fallback olarak)
					setTimeout(function() {
						console.log('Checking if filters need fallback population...');
						var personelHasOptions = $('#filterPersonel option').length > 1;
						var durumHasOptions = $('#filterDurum option').length > 1;
						
						if (!personelHasOptions || !durumHasOptions) {
							console.log('Some filters are empty, populating from table data');
							populateFiltersFromTable();
						} else {
							console.log('Filters already populated via AJAX');
						}
					}, 3000);

					// Debug: Tablodaki verilerle filtreleri kontrol et
					setTimeout(function() {
						console.log('=== FILTER DEBUG INFO ===');
						
						// Personel verilerini kontrol et
						var personelValues = [];
						$('#tekliflerTable tbody tr').each(function() {
							var personelText = $(this).find('td:nth-child(2)').text().trim();
							if (personelText && !personelValues.includes(personelText)) {
								personelValues.push(personelText);
							}
						});
						console.log('Personel values in table:', personelValues);
						
						// Durum verilerini kontrol et
						var durumValues = [];
						$('#tekliflerTable tbody tr').each(function() {
							var durumText = $(this).find('td:nth-child(6)').text().trim();
							if (durumText && !durumValues.includes(durumText)) {
								durumValues.push(durumText);
							}
						});
						console.log('Durum values in table:', durumValues);
						
						// Filter option sayılarını kontrol et
						console.log('Filter option counts:', {
							personel: $('#filterPersonel option').length,
							durum: $('#filterDurum option').length,
							lokasyon: $('#filterLokasyon option').length
						});
						
						console.log('=== END DEBUG INFO ===');
					}, 5000);

					// Tablodaki veri sayısı
					var tableRowCount = $('#tekliflerTable tbody tr').length;
					console.log('Table has ' + tableRowCount + ' rows');

					// Filtreleme fonksiyonları - Tarih filtreleri
					var dateFilter = null;
					
					// Filtre uygulama butonuna tıklandığında filtreleri uygula
					$('#applyFilters').on('click', function() {
						console.log('Filtre uygula butonuna tıklandı');
						applyAllFilters();
					});
					
					// Enter tuşuna basıldığında da filtreleri uygula
					$('#filterTarihBaslangic, #filterTarihBitis').on('keypress', function(e) {
						if (e.which == 13) { // Enter tuşu
							applyAllFilters();
						}
					});
					
					// Filtre uygulama fonksiyonu
					function applyAllFilters() {
						var baslangic = $('#filterTarihBaslangic').val();
						var bitis = $('#filterTarihBitis').val();
						
						// Önceki filtreyi kaldır
						if (dateFilter) {
							var index = $.fn.dataTable.ext.search.indexOf(dateFilter);
							if (index !== -1) {
								$.fn.dataTable.ext.search.splice(index, 1);
							}
						}
						
						// Yeni filtre ekle
						if (baslangic || bitis) {
							dateFilter = function(settings, data, dataIndex) {
								if (settings.nTable.id !== 'tekliflerTable') {
									return true;
								}
								
								// Önce data attribute'dan raw tarih değerini al
								var row = table.row(dataIndex).node();
								var rawDate = $(row).data('islem-tarihi');
								
								if (!rawDate) {
									// Fallback: Tablodaki formatlı tarih değerini parse et
									var tarih = data[10]; // İşlem Tarihi sütunu (ps.islem_tarihi)
									if (!tarih || tarih === '-') return true;
									
									// Tarih formatını parse et (dd.mm.yyyy hh:mm)
									var tarihText = tarih.trim();
									var tarihParts = tarihText.split(' ')[0].split('.');
									
									if (tarihParts.length !== 3) return true;
									
									var rowDate = new Date(tarihParts[2], tarihParts[1] - 1, tarihParts[0]);
								} else {
									// Raw tarih değerini kullan (yyyy-mm-dd hh:mm:ss formatında)
									var rowDate = new Date(rawDate);
								}
								
								if (baslangic && bitis) {
									var startDate = new Date(baslangic);
									var endDate = new Date(bitis);
									endDate.setHours(23, 59, 59, 999); // Bitiş günü sonuna kadar
									return rowDate >= startDate && rowDate <= endDate;
								} else if (baslangic) {
									var startDate = new Date(baslangic);
									return rowDate >= startDate;
								} else if (bitis) {
									var endDate = new Date(bitis);
									endDate.setHours(23, 59, 59, 999); // Bitiş günü sonuna kadar
									return rowDate <= endDate;
								}
								return true;
							};
							
							$.fn.dataTable.ext.search.push(dateFilter);
						}
						
						// Diğer filtreleri de uygula
						updateDataTableFilters();
						
						console.log('Tüm filtreler uygulandı');
					}

					// Dropdown filtreleri için event listener'ları kaldırdık
					// Artık sadece "Filtre Uygula" butonuna tıklandığında filtreler uygulanacak

				} catch (error) {
					console.error('DataTable initialization error:', error);
					// Fallback: Basic table functionality
					console.log('Using fallback table functionality');
				}
			});
		}

		// Tablodaki verilerden filtre seçeneklerini oluştur (fallback)
		function populateFiltersFromTable() {
			if (typeof $ === 'undefined') {
				console.error('jQuery not available for populateFiltersFromTable');
				return;
			}

			try {
				console.log('Populating filters from table data...');
				
				// Personel verilerini topla
				var personelSet = new Set();
				$('#tekliflerTable tbody tr').each(function() {
					var personelCell = $(this).find('td:nth-child(2)'); // Personel sütunu (2. sütun)
					if (personelCell.length) {
						var personelText = personelCell.text().trim();
						if (personelText && personelText !== '' && personelText !== 'Bilinmiyor') {
							personelSet.add(personelText);
						}
					}
				});
				
				// Durum verilerini topla  
				var durumSet = new Set();
				$('#tekliflerTable tbody tr').each(function() {
					var durumCell = $(this).find('td:nth-child(6)'); // Durum sütunu (6. sütun)
					if (durumCell.length) {
						var durumText = durumCell.text().trim();
						if (durumText && durumText !== '' && durumText !== 'Belirtilmemiş') {
							durumSet.add(durumText);
						}
					}
				});

				// Lokasyon verilerini topla
				var lokasyonSet = new Set();
				$('#tekliflerTable tbody tr').each(function() {
					var lokasyonCell = $(this).find('td:nth-child(5)'); // Lokasyon sütunu (5. sütun)
					if (lokasyonCell.length) {
						var lokasyonText = lokasyonCell.text().trim().replace(/\s+/g, ' ');
						if (lokasyonText && lokasyonText !== '' && lokasyonText !== '-') {
							// İl/İlçe formatında birleştir
							var lines = lokasyonText.split('\n').map(l => l.trim()).filter(l => l && l !== '-');
							if (lines.length >= 2) {
								lokasyonSet.add(lines[0] + ' / ' + lines[1]);
							}
						}
					}
				});

				console.log('Found data:', {
					personel: Array.from(personelSet),
					durum: Array.from(durumSet),
					lokasyon: Array.from(lokasyonSet)
				});

				// Personel filtresini doldur
				if (personelSet.size > 0) {
					var personelOptions = '<option value="">Tümü</option>';
					Array.from(personelSet).sort().forEach(function(personel) {
						personelOptions += '<option value="' + escapeHtml(personel) + '">' + escapeHtml(personel) + '</option>';
					});
					$('#filterPersonel').html(personelOptions);
					
					if (typeof $.fn.select2 !== 'undefined') {
						$('#filterPersonel').select2('destroy');
						$('#filterPersonel').select2({
							theme: 'bootstrap4',
							width: '100%',
							allowClear: true,
							placeholder: 'Personel seçin...'
						});
					}
					console.log('Personel filter populated with ' + personelSet.size + ' options');
				}

				// Durum filtresini doldur
				if (durumSet.size > 0) {
					var durumOptions = '<option value="">Tümü</option>';
					Array.from(durumSet).sort().forEach(function(durum) {
						durumOptions += '<option value="' + escapeHtml(durum) + '">' + escapeHtml(durum) + '</option>';
					});
					$('#filterDurum').html(durumOptions);
					
					if (typeof $.fn.select2 !== 'undefined') {
						$('#filterDurum').select2('destroy');
						$('#filterDurum').select2({
							theme: 'bootstrap4',
							width: '100%',
							allowClear: true,
							placeholder: 'Durum seçin...'
						});
					}
					console.log('Durum filter populated with ' + durumSet.size + ' options');
				}

				// Lokasyon filtresini doldur
				if (lokasyonSet.size > 0) {
					var lokasyonOptions = '<option value="">Tümü</option>';
					Array.from(lokasyonSet).sort().forEach(function(lokasyon) {
						lokasyonOptions += '<option value="' + escapeHtml(lokasyon) + '">' + escapeHtml(lokasyon) + '</option>';
					});
					$('#filterLokasyon').html(lokasyonOptions);
					
					if (typeof $.fn.select2 !== 'undefined') {
						$('#filterLokasyon').select2('destroy');
						$('#filterLokasyon').select2({
							theme: 'bootstrap4',
							width: '100%',
							allowClear: true,
							placeholder: 'Lokasyon seçin...'
						});
					}
					console.log('Lokasyon filter populated with ' + lokasyonSet.size + ' options');
				}

				// Event listener'ları yeniden ekle (sadece Select2 durumunu takip etmek için)
				$('#filterPersonel, #filterLokasyon, #filterDurum').off('change.tablefilter select2:select.tablefilter select2:clear.tablefilter');
				// Artık otomatik filtre uygulamıyoruz, sadece "Filtre Uygula" butonuna tıklandığında çalışacak

				console.log('All filters populated successfully from table data');
				return true;

			} catch (error) {
				console.error('Error populating filters from table:', error);
				return false;
			}
		}

		// HTML escape fonksiyonu
		function escapeHtml(text) {
			var map = {
				'&': '&amp;',
				'<': '&lt;',
				'>': '&gt;',
				'"': '&quot;',
				"'": '&#039;'
			};
			return text.replace(/[&<>"']/g, function(m) { return map[m]; });
		}

		// Initialize when DOM is ready
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', initializeDataTable);
		} else {
			initializeDataTable();
		}
		// Select2 filtreleri initialize et
		function initializeSelect2Filters() {
			if (typeof $ === 'undefined' || typeof $.fn.select2 === 'undefined') {
				console.warn('Select2 not available, using fallback dropdowns');
				// Select2 olmasa bile tablodaki verilerden filtreleri doldur
				setTimeout(populateFiltersFromTable, 500);
				return;
			}

			try {
				console.log('Initializing Select2 filters with AJAX...');
				
				// Select2 yapılandırması
				var select2Config = {
					theme: 'bootstrap4',
					width: '100%',
					allowClear: true,
					language: {
						noResults: function() { return "Sonuç bulunamadı"; },
						searching: function() { return "Aranıyor..."; },
						loadingMore: function() { return "Daha fazla yükleniyor..."; },
						inputTooShort: function(args) {
							return "En az " + args.minimum + " karakter girin";
						}
					}
				};

				var ajaxSuccess = 0;
				var totalAjax = 3;

				// Personel Select2
				$('#filterPersonel').select2($.extend({}, select2Config, {
					placeholder: 'Personel seçin veya arayın...',
					minimumInputLength: 0,
					ajax: {
						url: '<?= base_url("teklif/get_personel_list"); ?>',
						type: 'POST',
						dataType: 'json',
						delay: 300,
						data: function(params) {
							console.log('Personel search params:', params);
							return {
								term: params.term || ''
							};
						},
						processResults: function(data, params) {
							console.log('Personel response:', data);
							if (data && data.status === 'success') {
								ajaxSuccess++;
								return {
									results: data.data || []
								};
							}
							console.error('Personel endpoint error:', data);
							// AJAX başarısız olursa fallback kullan
							if (ajaxSuccess === 0) {
								setTimeout(function() {
									console.log('AJAX failed, using table data fallback');
									populateFiltersFromTable();
								}, 1000);
							}
							return { results: [] };
						},
						cache: true
					},
					language: {
						noResults: function() { return "Personel bulunamadı"; },
						searching: function() { return "Personel aranıyor..."; },
						errorLoading: function() { 
							console.warn('Personel AJAX failed, will try fallback');
							return "Personel listesi yüklenemedi"; 
						}
					}
				}));

				// Lokasyon Select2
				$('#filterLokasyon').select2($.extend({}, select2Config, {
					placeholder: 'Lokasyon seçin veya arayın...',
					minimumInputLength: 0,
					ajax: {
						url: '<?= base_url("teklif/get_location_list"); ?>',
						type: 'POST',
						dataType: 'json',
						delay: 300,
						data: function(params) {
							return {
								term: params.term || ''
							};
						},
						processResults: function(data) {
							if (data && data.status === 'success') {
								ajaxSuccess++;
								return {
									results: data.data || []
								};
							}
							console.error('Lokasyon endpoint error:', data);
							return { results: [] };
						},
						cache: true
					}
				}));

				// Durum Select2
				$('#filterDurum').select2($.extend({}, select2Config, {
					placeholder: 'Durum seçin veya arayın...',
					minimumInputLength: 0,
					ajax: {
						url: '<?= base_url("teklif/get_durum_list"); ?>',
						type: 'POST',
						dataType: 'json',
						delay: 300,
						data: function(params) {
							console.log('Durum search params:', params);
							return {
								term: params.term || ''
							};
						},
						processResults: function(data, params) {
							console.log('Durum response:', data);
							if (data && data.status === 'success') {
								ajaxSuccess++;
								return {
									results: data.data || []
								};
							}
							console.error('Durum endpoint error:', data);
							return { results: [] };
						},
						cache: true
					},
					language: {
						noResults: function() { return "Durum bulunamadı"; },
						searching: function() { return "Durum aranıyor..."; },
						errorLoading: function() { 
							console.warn('Durum AJAX failed, will try fallback');
							return "Durum listesi yüklenemedi"; 
						}
					}
				}));

				// AJAX başarı durumunu kontrol et ve gerekirse fallback kullan
				setTimeout(function() {
					if (ajaxSuccess === 0) {
						console.warn('All AJAX requests failed, using table data fallback');
						populateFiltersFromTable();
					} else {
						console.log('AJAX filters initialized successfully (' + ajaxSuccess + '/' + totalAjax + ')');
					}
				}, 2000);

				// Select2 değişiklik eventleri - sadece "Filtre Uygula" butonuna tıklandığında çalışacak
				// Otomatik filtre uygulamayı kaldırdık
				console.log('Select2 filtreleri başlatıldı, manuel filtre uygulaması aktif');

			} catch (error) {
				console.error('Select2 initialization error:', error);
				// Hata durumunda fallback kullan
				setTimeout(populateFiltersFromTable, 500);
			}
		}

		// DataTable filtreleri güncelle
		function updateDataTableFilters() {
			if (typeof $ === 'undefined' || typeof $.fn.dataTable === 'undefined') {
				console.error('jQuery or DataTables not available');
				return;
			}

			try {
				var table = $('#tekliflerTable').DataTable();
				
				var personel = $('#filterPersonel').val();
				var lokasyon = $('#filterLokasyon').val();
				var durum = $('#filterDurum').val();

				console.log('=== UPDATING FILTERS ===');
				console.log('Applying filters:', { personel: personel, lokasyon: lokasyon, durum: durum });

				// Personel filtresi - exact text match, escape special chars
				if (personel && personel !== '') {
					console.log('Applying personel filter:', personel);
					// Escape special regex characters for exact matching
					var escapedPersonel = personel.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
					table.column(1).search(escapedPersonel, true, false).draw(false);
				} else {
					console.log('Clearing personel filter');
					table.column(1).search('').draw(false);
				}
				
				// Lokasyon filtresi - exact text match, escape special chars
				if (lokasyon && lokasyon !== '') {
					console.log('Applying lokasyon filter:', lokasyon);
					var escapedLokasyon = lokasyon.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
					table.column(4).search(escapedLokasyon, true, false).draw(false);
				} else {
					console.log('Clearing lokasyon filter');
					table.column(4).search('').draw(false);
				}
				
				// Durum filtresi - exact text match, escape special chars
				if (durum && durum !== '') {
					console.log('Applying durum filter:', durum);
					var escapedDurum = durum.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
					table.column(5).search(escapedDurum, true, false).draw();
				} else {
					console.log('Clearing durum filter');
					table.column(5).search('').draw();
				}

				console.log('=== FILTERS APPLIED ===');
				
				// Kullanıcıya bildirim göster
				showFilterAppliedMessage();

			} catch (error) {
				console.error('Filter update error:', error);
			}
		}
		
		// Filtre uygulandığını gösteren mesaj
		function showFilterAppliedMessage() {
			// Mevcut mesajı kaldır
			$('.filter-applied-message').remove();
			
			// Yeni mesaj oluştur
			var message = $('<div class="alert alert-success alert-dismissible fade show filter-applied-message" style="margin-top: 10px;">' +
				'<i class="fas fa-check-circle"></i> Filtreler başarıyla uygulandı!' +
				'<button type="button" class="close" data-dismiss="alert">' +
				'<span>&times;</span>' +
				'</button>' +
				'</div>');
			
			// Filtre kartının altına ekle
			$('.card:first .card-body').prepend(message);
			
			// 3 saniye sonra otomatik olarak kaldır
			setTimeout(function() {
				message.fadeOut(500, function() {
					$(this).remove();
				});
			}, 3000);
		}

		// Filtreleri temizle
		function clearFilters() {
			if (typeof $ === 'undefined') {
				console.error('jQuery not available for clearFilters');
				return;
			}
			
			console.log('Clearing all filters...');
			
			// Tarih filtreleri temizle
			$('#filterTarihBaslangic').val('');
			$('#filterTarihBitis').val('');
			
			// Select2 filtreleri temizle
			if (typeof $.fn.select2 !== 'undefined') {
				try {
					$('#filterPersonel').val('').trigger('change');
					$('#filterLokasyon').val('').trigger('change');
					$('#filterDurum').val('').trigger('change');
				} catch (e) {
					console.warn('Select2 clear error, using fallback:', e);
					// Fallback: Normal select clear
					$('#filterPersonel').val('');
					$('#filterLokasyon').val('');
					$('#filterDurum').val('');
				}
			} else {
				$('#filterPersonel').val('');
				$('#filterLokasyon').val('');
				$('#filterDurum').val('');
			}
			
			// DataTable filtrelerini temizle
			if (typeof $.fn.dataTable !== 'undefined') {
				try {
					// Custom search filters temizle
					$.fn.dataTable.ext.search = [];
					
					var table = $('#tekliflerTable').DataTable();
					
					// Tüm arama ve sütun filtrelerini temizle
					table.search('').columns().search('').draw();
					
					console.log('All filters cleared successfully');
					
					// Temizlendiğini gösteren mesaj
					showFilterClearedMessage();
				} catch (error) {
					console.error('Error clearing DataTable filters:', error);
				}
			}
		}
		
		// Filtre temizlendiğini gösteren mesaj
		function showFilterClearedMessage() {
			// Mevcut mesajları kaldır
			$('.filter-applied-message, .filter-cleared-message').remove();
			
			// Yeni mesaj oluştur
			var message = $('<div class="alert alert-info alert-dismissible fade show filter-cleared-message" style="margin-top: 10px;">' +
				'<i class="fas fa-info-circle"></i> Tüm filtreler temizlendi!' +
				'<button type="button" class="close" data-dismiss="alert">' +
				'<span>&times;</span>' +
				'</button>' +
				'</div>');
			
			// Filtre kartının altına ekle
			$('.card:first .card-body').prepend(message);
			
			// 3 saniye sonra otomatik olarak kaldır
			setTimeout(function() {
				message.fadeOut(500, function() {
					$(this).remove();
				});
			}, 3000);
		}

		// Teklif detay fonksiyonu
		function teklifDetay(id) {
			// Detay sayfasına yönlendirme veya modal açma
			alert('Teklif detay sayfası henüz hazırlanmamış. ID: ' + id);
		}

		// Teklif düzenleme fonksiyonu
		function teklifDuzenle(id) {
			// Düzenleme sayfasına yönlendirme
			window.location.href = '<?= base_url("teklif/teklif-duzenle/"); ?>' + id;
		}

		// Teklif silme fonksiyonu
		function teklifSil(id) {
			if (confirm('Bu teklifi silmek istediğinizden emin misiniz?')) {
				if (typeof $ !== 'undefined') {
					// jQuery kullanarak AJAX isteği
					$.post('<?= base_url("teklif/teklif-sil"); ?>', {
						id: id
					}, function(response) {
						if (response.success) {
							alert('Teklif başarıyla silindi.');
							location.reload();
						} else {
							alert('Teklif silinirken bir hata oluştu: ' + (response.message || 'Bilinmeyen hata'));
						}
					}, 'json').fail(function() {
						alert('Sunucu hatası oluştu.');
					});
				} else {
					// Fallback: Form submit ile silme
					var form = document.createElement('form');
					form.method = 'POST';
					form.action = '<?= base_url("teklif/teklif-sil"); ?>';
					
					var idInput = document.createElement('input');
					idInput.type = 'hidden';
					idInput.name = 'id';
					idInput.value = id;
					
					form.appendChild(idInput);
					document.body.appendChild(form);
					form.submit();
				}
			}
		}
	</script>

</body>
</html>
