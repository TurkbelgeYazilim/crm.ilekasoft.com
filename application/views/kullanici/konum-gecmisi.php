<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<title>Konum Geçmişi | İlekaSoft CRM</title>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
	<style>
		#map { 
			height: 400px; 
			width: 100%;
			margin-bottom: 20px;
		}
		.konum-item {
			border-left: 4px solid #007bff;
			background-color: #f8f9fa;
		}
		.konum-item:hover {
			background-color: #e9ecef;
		}
		.accuracy-good { border-left-color: #28a745; }
		.accuracy-medium { border-left-color: #ffc107; }
		.accuracy-poor { border-left-color: #dc3545; }
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
							<h3 class="page-title">Konum Geçmişi</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
								<li class="breadcrumb-item">Kullanıcı</li>
								<li class="breadcrumb-item active">Konum Geçmişi</li>
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
					<div class="col-md-12">
						<!-- Harita -->
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">
									<i class="fa fa-map-marker"></i> Konum Haritası
								</h5>
							</div>
							<div class="card-body">
								<div id="map"></div>
							</div>
						</div>

						<!-- Konum Listesi -->
						<div class="card">
							<div class="card-header">
								<div class="row">
									<div class="col">
										<h5 class="card-title">
											<i class="fa fa-list"></i> Konum Geçmişi 
											<span class="badge badge-primary"><?= count($konum_gecmisi) ?></span>
										</h5>
									</div>
									<div class="col-auto">
										<button type="button" class="btn btn-sm btn-primary" onclick="konumTakibi.updateLocation()">
											<i class="fa fa-refresh"></i> Konumu Güncelle
										</button>
									</div>
								</div>
							</div>
							<div class="card-body">
								<?php if (empty($konum_gecmisi)): ?>
									<div class="text-center py-5">
										<i class="fa fa-map-marker fa-3x text-muted mb-3"></i>
										<h5 class="text-muted">Henüz konum kaydı bulunmamaktadır</h5>
										<p class="text-muted">Konum takibi otomatik olarak başlayacaktır.</p>
									</div>
								<?php else: ?>
									<div class="timeline">
										<?php foreach ($konum_gecmisi as $index => $konum): ?>
											<?php 
												$accuracy_class = '';
												if ($konum->accuracy <= 50) $accuracy_class = 'accuracy-good';
												elseif ($konum->accuracy <= 200) $accuracy_class = 'accuracy-medium';
												else $accuracy_class = 'accuracy-poor';
												
												$time_ago = time() - strtotime($konum->created_at);
												$time_text = '';
												if ($time_ago < 60) $time_text = $time_ago . ' saniye önce';
												elseif ($time_ago < 3600) $time_text = floor($time_ago/60) . ' dakika önce';
												elseif ($time_ago < 86400) $time_text = floor($time_ago/3600) . ' saat önce';
												else $time_text = floor($time_ago/86400) . ' gün önce';
											?>
											<div class="card mb-3 konum-item <?= $accuracy_class ?>" 
												 onclick="showOnMap(<?= $konum->latitude ?>, <?= $konum->longitude ?>, '<?= addslashes($konum->address) ?>')">
												<div class="card-body">
													<div class="row align-items-center">
														<div class="col-md-8">
															<h6 class="mb-1">
																<i class="fa fa-clock-o text-primary"></i>
																<?= date('d.m.Y H:i:s', strtotime($konum->created_at)) ?>
																<small class="text-muted ml-2">(<?= $time_text ?>)</small>
															</h6>
															<p class="mb-1">
																<i class="fa fa-map-marker text-success"></i>
																<?= $konum->address ?: $konum->latitude . ', ' . $konum->longitude ?>
															</p>
															<?php if ($konum->device_info): ?>
																<small class="text-muted">
																	<i class="fa fa-mobile"></i> <?= $konum->device_info ?>
																</small>
															<?php endif; ?>
														</div>
														<div class="col-md-4 text-right">
															<div class="row">
																<div class="col-6">
																	<small class="text-muted d-block">Koordinat</small>
																	<strong class="small">
																		<?= round($konum->latitude, 6) ?>,<br>
																		<?= round($konum->longitude, 6) ?>
																	</strong>
																</div>
																<div class="col-6">
																	<small class="text-muted d-block">Doğruluk</small>
																	<span class="badge badge-<?= $konum->accuracy <= 50 ? 'success' : ($konum->accuracy <= 200 ? 'warning' : 'danger') ?>">
																		<?= round($konum->accuracy) ?>m
																	</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
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
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
	<script src="<?= base_url('assets/js/konum-takibi.js') ?>"></script>
	
	<script>
		// Harita başlat
		var map = L.map('map').setView([39.9334, 32.8597], 6); // Ankara merkez

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '© OpenStreetMap contributors'
		}).addTo(map);

		var markers = [];
		var konumlar = <?= json_encode($konum_gecmisi) ?>;

		if (konumlar.length > 0) {
			// Tüm konumları haritaya ekle
			konumlar.forEach(function(konum, index) {
				var marker = L.marker([konum.latitude, konum.longitude])
					.bindPopup(`
						<div style="min-width: 200px;">
							<strong>${konum.address || konum.latitude + ', ' + konum.longitude}</strong><br>
							<small class="text-muted">${konum.created_at}</small><br>
							<small>Doğruluk: ${Math.round(konum.accuracy)}m</small>
						</div>
					`);
				
				markers.push(marker);
				marker.addTo(map);
			});

			// Haritayı tüm konumları içerecek şekilde ayarla
			var group = new L.featureGroup(markers);
			map.fitBounds(group.getBounds().pad(0.1));
		}

		// Haritada konumu göster
		function showOnMap(lat, lng, address) {
			map.setView([lat, lng], 15);
			
			// Popup aç
			markers.forEach(function(marker) {
				if (marker.getLatLng().lat === lat && marker.getLatLng().lng === lng) {
					marker.openPopup();
				}
			});
		}

		// Sayfa yüklendiğinde en son konum takibi durumunu göster
		document.addEventListener('DOMContentLoaded', function() {
			console.log('Konum Geçmişi sayfası yüklendi');
		});
	</script>
</body>
</html>
