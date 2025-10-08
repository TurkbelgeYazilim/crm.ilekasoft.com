<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<title>Kullanıcı Konumları | İlekaSoft CRM</title>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
	<style>
		#map { 
			height: 500px; 
			width: 100%;
			margin-bottom: 20px;
		}
		.user-card {
			border-left: 4px solid #007bff;
			transition: all 0.3s ease;
		}
		.user-card:hover {
			transform: translateY(-2px);
			box-shadow: 0 4px 8px rgba(0,0,0,0.1);
		}
		.user-online { border-left-color: #28a745; }
		.user-offline { border-left-color: #6c757d; }
		.user-recent { border-left-color: #ffc107; }
		
		.status-online { color: #28a745; }
		.status-offline { color: #6c757d; }
		.status-recent { color: #ffc107; }
		
		.leaflet-popup-content {
			margin: 8px 12px;
			line-height: 1.4;
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
							<h3 class="page-title">Kullanıcı Konumları</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
								<li class="breadcrumb-item">Yönetici</li>
								<li class="breadcrumb-item active">Kullanıcı Konumları</li>
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

				<!-- İstatistikler -->
				<div class="row mb-4">
					<?php 
						$online_count = 0;
						$total_count = count($kullanici_konumlari);
						$recent_count = 0;
						
						foreach ($kullanici_konumlari as $user) {
							if ($user->is_online) $online_count++;
							$time_diff = time() - strtotime($user->last_update);
							if ($time_diff < 1800) $recent_count++; // 30 dakika
						}
					?>
					<div class="col-md-3">
						<div class="card bg-primary text-white">
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<div>
										<h3 class="mb-0"><?= $total_count ?></h3>
										<p class="mb-0">Toplam Kullanıcı</p>
									</div>
									<div>
										<i class="fa fa-users fa-2x"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card bg-success text-white">
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<div>
										<h3 class="mb-0"><?= $online_count ?></h3>
										<p class="mb-0">Online</p>
									</div>
									<div>
										<i class="fa fa-circle fa-2x"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card bg-warning text-white">
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<div>
										<h3 class="mb-0"><?= $recent_count ?></h3>
										<p class="mb-0">Son 30 dk</p>
									</div>
									<div>
										<i class="fa fa-clock-o fa-2x"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card bg-info text-white">
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<div>
										<h3 class="mb-0"><?= $total_count - $online_count ?></h3>
										<p class="mb-0">Offline</p>
									</div>
									<div>
										<i class="fa fa-circle-o fa-2x"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<!-- Harita -->
						<div class="card">
							<div class="card-header">
								<div class="row">
									<div class="col">
										<h5 class="card-title">
											<i class="fa fa-map"></i> Tüm Kullanıcılar Haritası
										</h5>
									</div>
									<div class="col-auto">
										<button type="button" class="btn btn-sm btn-primary" onclick="location.reload()">
											<i class="fa fa-refresh"></i> Yenile
										</button>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div id="map"></div>
							</div>
						</div>
					</div>
				</div>

				<!-- Kullanıcı Listesi -->
				<div class="row">
					<?php if (empty($kullanici_konumlari)): ?>
						<div class="col-md-12">
							<div class="card">
								<div class="card-body text-center py-5">
									<i class="fa fa-map-marker fa-3x text-muted mb-3"></i>
									<h5 class="text-muted">Henüz kullanıcı konum verisi bulunmamaktadır</h5>
									<p class="text-muted">Kullanıcılar login oldukça konum bilgileri burada görünecektir.</p>
								</div>
							</div>
						</div>
					<?php else: ?>
						<?php foreach ($kullanici_konumlari as $user): ?>
							<?php 
								$time_diff = time() - strtotime($user->last_update);
								$status_class = '';
								$status_text = '';
								$status_icon = '';
								
								if ($user->is_online) {
									$status_class = 'user-online';
									$status_text = 'Online';
									$status_icon = 'fa-circle status-online';
								} elseif ($time_diff < 1800) { // 30 dakika
									$status_class = 'user-recent';
									$status_text = 'Son aktif';
									$status_icon = 'fa-clock-o status-recent';
								} else {
									$status_class = 'user-offline';
									$status_text = 'Offline';
									$status_icon = 'fa-circle-o status-offline';
								}
								
								// Zaman hesaplama
								if ($time_diff < 60) $time_text = $time_diff . ' saniye önce';
								elseif ($time_diff < 3600) $time_text = floor($time_diff/60) . ' dakika önce';
								elseif ($time_diff < 86400) $time_text = floor($time_diff/3600) . ' saat önce';
								else $time_text = floor($time_diff/86400) . ' gün önce';
							?>
							<div class="col-md-6 mb-3">
								<div class="card user-card <?= $status_class ?>" 
									 onclick="showUserOnMap(<?= $user->latitude ?>, <?= $user->longitude ?>, '<?= addslashes($user->kullanici_ad . ' ' . $user->kullanici_soyad) ?>')"
									 style="cursor: pointer;">
									<div class="card-body">
										<div class="row align-items-center">
											<div class="col-md-8">
												<div class="d-flex align-items-center mb-2">
													<div class="avatar avatar-sm mr-3">
														<span class="avatar-title bg-primary rounded-circle">
															<?= strtoupper(substr($user->kullanici_ad, 0, 1) . substr($user->kullanici_soyad, 0, 1)) ?>
														</span>
													</div>
													<div>
														<h6 class="mb-0"><?= $user->kullanici_ad . ' ' . $user->kullanici_soyad ?></h6>
														<small class="text-muted"><?= $user->kullanici_eposta ?></small>
													</div>
												</div>
												<p class="mb-1 small">
													<i class="fa fa-map-marker text-primary"></i>
													<?= $user->address ?: $user->latitude . ', ' . $user->longitude ?>
												</p>
												<small class="text-muted">
													<i class="fa fa-clock-o"></i> 
													Son güncelleme: <?= $time_text ?>
												</small>
											</div>
											<div class="col-md-4 text-right">
												<div class="mb-2">
													<i class="fa <?= $status_icon ?>"></i>
													<small class="ml-1"><?= $status_text ?></small>
												</div>
												<?php if ($user->accuracy): ?>
													<span class="badge badge-<?= $user->accuracy <= 50 ? 'success' : ($user->accuracy <= 200 ? 'warning' : 'danger') ?>">
														<?= round($user->accuracy) ?>m
													</span>
												<?php endif; ?>
												<div class="mt-2">
													<a href="<?= base_url('kullanici/konum_gecmisi?kullanici_id=' . $user->kullanici_id) ?>" 
													   class="btn btn-sm btn-outline-primary" onclick="event.stopPropagation();">
														<i class="fa fa-history"></i> Geçmiş
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!-- /Page Wrapper -->
	</div>
	<!-- /Main Wrapper -->

	<?php $this->load->view("include/footer-js"); ?>
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
	
	<script>
		// Harita başlat
		var map = L.map('map').setView([39.9334, 32.8597], 6); // Ankara merkez

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '© OpenStreetMap contributors'
		}).addTo(map);

		var markers = [];
		var kullanicilar = <?= json_encode($kullanici_konumlari) ?>;

		// Kullanıcı ikonları
		var onlineIcon = L.divIcon({
			html: '<div style="background-color: #28a745; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 10px rgba(0,0,0,0.3);"></div>',
			iconSize: [20, 20],
			iconAnchor: [10, 10]
		});

		var recentIcon = L.divIcon({
			html: '<div style="background-color: #ffc107; width: 18px; height: 18px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 8px rgba(0,0,0,0.3);"></div>',
			iconSize: [18, 18],
			iconAnchor: [9, 9]
		});

		var offlineIcon = L.divIcon({
			html: '<div style="background-color: #6c757d; width: 15px; height: 15px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 5px rgba(0,0,0,0.3);"></div>',
			iconSize: [15, 15],
			iconAnchor: [7, 7]
		});

		if (kullanicilar.length > 0) {
			kullanicilar.forEach(function(user, index) {
				var timeDiff = Math.floor((Date.now() - new Date(user.last_update).getTime()) / 1000);
				var icon = offlineIcon;
				var statusText = 'Offline';
				
				if (user.is_online == 1) {
					icon = onlineIcon;
					statusText = 'Online';
				} else if (timeDiff < 1800) {
					icon = recentIcon;
					statusText = 'Son aktif';
				}

				var marker = L.marker([user.latitude, user.longitude], { icon: icon })
					.bindPopup(`
						<div style="min-width: 250px;">
							<div class="d-flex align-items-center mb-2">
								<strong class="mr-2">${user.kullanici_ad} ${user.kullanici_soyad}</strong>
								<span class="badge badge-${user.is_online ? 'success' : (timeDiff < 1800 ? 'warning' : 'secondary')}">${statusText}</span>
							</div>
							<small class="text-muted d-block">${user.kullanici_eposta}</small>
							<hr class="my-2">
							<div class="small">
								<i class="fa fa-map-marker text-primary"></i> 
								${user.address || user.latitude + ', ' + user.longitude}
							</div>
							<div class="small mt-1">
								<i class="fa fa-clock-o text-muted"></i> 
								${user.last_update}
							</div>
							${user.accuracy ? `<div class="small mt-1">
								<i class="fa fa-crosshairs text-info"></i> 
								Doğruluk: ${Math.round(user.accuracy)}m
							</div>` : ''}
							<div class="mt-2">
								<a href="<?= base_url('kullanici/konum_gecmisi?kullanici_id=') ?>${user.kullanici_id}" 
								   class="btn btn-sm btn-primary" style="font-size: 11px;">
									<i class="fa fa-history"></i> Geçmişi Görüntüle
								</a>
							</div>
						</div>
					`);
				
				markers.push(marker);
				marker.addTo(map);
			});

			// Haritayı tüm kullanıcıları içerecek şekilde ayarla
			var group = new L.featureGroup(markers);
			map.fitBounds(group.getBounds().pad(0.1));
		}

		// Kullanıcıyı haritada göster
		function showUserOnMap(lat, lng, name) {
			map.setView([lat, lng], 15);
			
			// İlgili marker'ı bul ve popup aç
			markers.forEach(function(marker) {
				if (Math.abs(marker.getLatLng().lat - lat) < 0.00001 && 
					Math.abs(marker.getLatLng().lng - lng) < 0.00001) {
					marker.openPopup();
				}
			});
		}

		// Otomatik yenileme (5 dakikada bir)
		setInterval(function() {
			location.reload();
		}, 300000); // 5 dakika

		console.log('Kullanıcı Konumları sayfası yüklendi. Toplam kullanıcı:', kullanicilar.length);
	</script>
</body>
</html>
