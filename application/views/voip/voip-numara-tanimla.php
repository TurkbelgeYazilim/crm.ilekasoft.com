<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<style>
	.tab-content {
		margin-top: 20px;
	}
	.table-responsive {
		margin-top: 20px;
	}
	.btn-group {
		margin-bottom: 20px;
	}
	.form-control-sm {
		height: calc(1.5em + 0.5rem + 2px);
		padding: 0.25rem 0.5rem;
		font-size: 0.875rem;
		line-height: 1.5;
		border-radius: 0.2rem;
	}
	.alert {
		margin-top: 15px;
	}
	.modal .form-group {
		margin-bottom: 1rem;
	}
	.btn-outline-primary {
		color: #007bff;
		border-color: #007bff;
	}
	.btn-outline-primary:hover {
		color: #fff;
		background-color: #007bff;
		border-color: #007bff;
	}
	
	/* Header düzeltmesi */
	.header {
		z-index: 1002 !important;
		position: fixed !important;
	}
	
	/* Page wrapper düzeltmesi */
	.page-wrapper {
		margin-left: 240px !important;
		padding-top: 60px !important;
		transition: all 0.4s ease;
	}
	
	/* Sidebar düzeltmesi */
	.sidebar {
		z-index: 1001 !important;
	}
	
	/* Tab navigation düzeltmeleri */
	#voipTabs .nav-link {
		cursor: pointer !important;
		user-select: none;
	}
	
	#voipTabs .nav-link:hover {
		background-color: #f8f9fa;
	}
	
	#voipTabs .nav-link.active {
		background-color: #007bff;
		color: #fff !important;
		border-color: #007bff;
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
				<div class="page-header">
					<div class="page-title">
						<h4><?= $baslik ?></h4>
					</div>
				</div>

				<div class="card">
					<div class="card-body">
						<!-- Alert Area -->
						<div id="alertArea"></div>
						
						<!-- Tab Navigation -->
						<ul class="nav nav-tabs" id="voipTabs" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" id="operator-tab" data-bs-toggle="tab" data-bs-target="#operator" href="#operator" role="tab" aria-controls="operator" aria-selected="true">Operatör Yönetimi</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="panel-tab" data-bs-toggle="tab" data-bs-target="#panel" href="#panel" role="tab" aria-controls="panel" aria-selected="false">Panel Yönetimi</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="numara-tab" data-bs-toggle="tab" data-bs-target="#numara" href="#numara" role="tab" aria-controls="numara" aria-selected="false">Numara Yönetimi</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="teslim-tab" data-bs-toggle="tab" data-bs-target="#teslim" href="#teslim" role="tab" aria-controls="teslim" aria-selected="false">Numara Teslim</a>
							</li>
						</ul>

						<!-- Tab Content -->
						<div class="tab-content" id="voipTabContent">
							<!-- Operatör Yönetimi -->
							<div class="tab-pane fade show active" id="operator" role="tabpanel" aria-labelledby="operator-tab" tabindex="0">
								<div class="row">
									<div class="col-md-6">
										<h5>Yeni Operatör Ekle</h5>
										<form id="operatorForm">
											<div class="form-group">
												<label for="operator_adi">Operatör Adı *</label>
												<input type="text" class="form-control" id="operator_adi" name="operator_adi" required>
											</div>
											<div class="form-group">
												<label for="aciklama">Açıklama</label>
												<textarea class="form-control" id="aciklama" name="aciklama" rows="3"></textarea>
											</div>
											<button type="submit" class="btn btn-primary">Operatör Ekle</button>
										</form>
									</div>
									<div class="col-md-6">
										<h5>Mevcut Operatörler</h5>
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th>ID</th>
														<th>Operatör Adı</th>
														<th>Açıklama</th>
														<th>İşlem</th>
													</tr>
												</thead>
												<tbody id="operatorListesi">
													<?php foreach($operatorler as $operator): ?>
													<tr>
														<td><?= $operator->operator_id ?></td>
														<td><?= htmlspecialchars($operator->operator_adi) ?></td>
														<td><?= htmlspecialchars($operator->aciklama) ?></td>
														<td>
															<button class="btn btn-sm btn-danger" onclick="operatorSil(<?= $operator->operator_id ?>)">
																<i class="fa fa-trash"></i>
															</button>
														</td>
													</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<!-- Panel Yönetimi -->
							<div class="tab-pane fade" id="panel" role="tabpanel" aria-labelledby="panel-tab" tabindex="0">
								<div class="row">
									<div class="col-md-6">
										<h5>Yeni Panel Ekle</h5>
										<form id="panelForm">
											<div class="form-group">
												<label for="panel_operator_id">Operatör *</label>
												<select class="form-control" id="panel_operator_id" name="operator_id" required>
													<option value="">Operatör Seçin</option>
													<?php foreach($operatorler as $operator): ?>
													<option value="<?= $operator->operator_id ?>"><?= htmlspecialchars($operator->operator_adi) ?></option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="form-group">
												<label for="panel_link">Panel Link *</label>
												<input type="url" class="form-control" id="panel_link" name="panel_link" required>
											</div>
											<div class="form-group">
												<label for="panel_kullanici_adi">Panel Kullanıcı Adı</label>
												<input type="text" class="form-control" id="panel_kullanici_adi" name="panel_kullanici_adi">
											</div>
											<div class="form-group">
												<label for="panel_sifre">Panel Şifre</label>
												<input type="password" class="form-control" id="panel_sifre" name="panel_sifre">
											</div>
											<button type="submit" class="btn btn-primary">Panel Ekle</button>
										</form>
									</div>
									<div class="col-md-6">
										<h5>Operatör Panelleri</h5>
										<div class="form-group">
											<label for="panelOperatorFilter">Operatör Seçin</label>
											<select class="form-control" id="panelOperatorFilter" onchange="panelleriGetir(this.value)">
												<option value="">Operatör Seçin</option>
												<?php foreach($operatorler as $operator): ?>
												<option value="<?= $operator->operator_id ?>"><?= htmlspecialchars($operator->operator_adi) ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div id="panelListesi"></div>
									</div>
								</div>
							</div>

							<!-- Numara Yönetimi -->
							<div class="tab-pane fade" id="numara" role="tabpanel" aria-labelledby="numara-tab" tabindex="0">
								<div class="row">
									<div class="col-md-6">
										<h5>Yeni Numara Ekle</h5>
										<form id="numaraForm">
											<div class="form-group">
												<label for="numara_operator_id">Operatör *</label>
												<select class="form-control" id="numara_operator_id" name="operator_id" required>
													<option value="">Operatör Seçin</option>
													<?php foreach($operatorler as $operator): ?>
													<option value="<?= $operator->operator_id ?>"><?= htmlspecialchars($operator->operator_adi) ?></option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="form-group">
												<label for="voip_numara">Voip Numara *</label>
												<input type="text" class="form-control" id="voip_numara" name="voip_numara" required>
											</div>
											<div class="form-group">
												<label for="numara_kullanici_adi">Kullanıcı Adı</label>
												<input type="text" class="form-control" id="numara_kullanici_adi" name="kullanici_adi">
											</div>
											<div class="form-group">
												<label for="numara_sifre">Şifre</label>
												<input type="password" class="form-control" id="numara_sifre" name="sifre">
											</div>
											<div class="form-group">
												<label for="ip_adresi">IP Adresi</label>
												<input type="text" class="form-control" id="ip_adresi" name="ip_adresi">
											</div>
											<button type="submit" class="btn btn-primary">Numara Ekle</button>
										</form>
									</div>
									<div class="col-md-6">
										<h5>Tanımlı Numaralar</h5>
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th>Operatör</th>
														<th>Numara</th>
														<th>Kullanıcı Adı</th>
														<th>IP</th>
														<th>İşlem</th>
													</tr>
												</thead>
												<tbody id="numaraListesi">
													<?php foreach($numaralar as $numara): ?>
													<tr>
														<td><?= htmlspecialchars($numara->operator_adi) ?></td>
														<td><?= htmlspecialchars($numara->voip_numara) ?></td>
														<td><?= htmlspecialchars($numara->kullanici_adi) ?></td>
														<td><?= htmlspecialchars($numara->ip_adresi) ?></td>
														<td>
															<button class="btn btn-sm btn-danger" onclick="numaraSil(<?= $numara->numara_id ?>)">
																<i class="fa fa-trash"></i>
															</button>
														</td>
													</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<!-- Numara Teslim -->
							<div class="tab-pane fade" id="teslim" role="tabpanel" aria-labelledby="teslim-tab" tabindex="0">
								<div class="row">
									<div class="col-md-6">
										<h5>Numara Teslim Et</h5>
										<form id="teslimForm">
											<div class="form-group">
												<label for="teslim_numara_id">Numara *</label>
												<select class="form-control" id="teslim_numara_id" name="numara_id" required>
													<option value="">Numara Seçin</option>
													<?php foreach($numaralar as $numara): ?>
													<option value="<?= $numara->numara_id ?>"><?= htmlspecialchars($numara->operator_adi) ?> - <?= htmlspecialchars($numara->voip_numara) ?></option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="form-group">
												<label for="teslim_kullanici_id">Kullanıcı *</label>
												<select class="form-control" id="teslim_kullanici_id" name="kullanici_id" required>
													<option value="">Kullanıcı Seçin</option>
													<?php foreach($kullanicilar as $kullanici): ?>
													<option value="<?= $kullanici->kullanici_id ?>"><?= htmlspecialchars($kullanici->kullanici_ad . ' ' . $kullanici->kullanici_soyad) ?></option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="form-group">
												<label for="teslim_aciklama">Açıklama</label>
												<textarea class="form-control" id="teslim_aciklama" name="aciklama" rows="3"></textarea>
											</div>
											<button type="submit" class="btn btn-primary">Teslim Et</button>
										</form>
									</div>
									<div class="col-md-6">
										<h5>Teslim Geçmişi</h5>
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th>Numara</th>
														<th>Teslim Geçmişi</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($numaralar as $numara): ?>
													<?php if(!empty($numara->teslim_gecmisi)): ?>
													<tr>
														<td><?= htmlspecialchars($numara->voip_numara) ?></td>
														<td><?= htmlspecialchars($numara->teslim_gecmisi) ?></td>
													</tr>
													<?php endif; ?>
													<?php endforeach; ?>
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

			<!-- Alert alanı -->
			<div id="alertArea"></div>
			
			<!-- jQuery Kontrol ve Yükleme -->
			<script>
			// jQuery kontrol ve alternatif yükleme
			if (typeof jQuery === 'undefined') {
			    console.warn('jQuery yüklenmemiş! Alternatif yoldan yükleniyor...');
			    var jqueryScript = document.createElement('script');
			    jqueryScript.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js';
			    jqueryScript.onload = function() {
			        console.log('jQuery alternatif yoldan yüklendi');
			        window.$ = window.jQuery;
			        initializeVoipPage();
			    };
			    jqueryScript.onerror = function() {
			        console.error('jQuery yüklenemedi!');
			    };
			    document.head.appendChild(jqueryScript);
			} else {
			    console.log('jQuery mevcut, sürüm:', jQuery.fn.jquery);
			    initializeVoipPage();
			}
			
			// Feather Icons güvenli yükleme
			function initFeatherIcons() {
			    if (typeof feather !== 'undefined' && feather.replace) {
			        try {
			            feather.replace();
			            console.log('Feather icons başarıyla yüklendi');
			        } catch (e) {
			            console.warn('Feather icons yüklenirken hata:', e);
			        }
			    } else {
			        console.warn('Feather icons bulunamadı');
			    }
			}
			
			// Sayfa yüklendikten sonra feather icons'u başlat
			window.addEventListener('load', function() {
			    setTimeout(initFeatherIcons, 100);
			});
			</script>

<script>
function initializeVoipPage() {
    // jQuery'nin yüklenip yüklenmediğini tekrar kontrol et
    if (typeof $ === 'undefined') {
        console.error('jQuery hala yüklü değil!');
        return;
    }
    
    console.log('VoIP sayfası başlatılıyor...');
    
    // DOM hazır olduğunda veya hemen çalıştır
    $(document).ready(function() {
        console.log('VoIP page loaded, initializing tabs...');
        
        // Manual tab switching fonksiyonu
        function switchTab(tabId) {
            console.log('Switching to tab:', tabId);
            // Tüm tab linklerinden active sınıfını kaldır
            $('#voipTabs .nav-link').removeClass('active').attr('aria-selected', 'false');
            // Tüm tab panellerini gizle
            $('.tab-pane').removeClass('show active');
            
            // Seçilen tab linkine active sınıfını ekle
            $('a[href="' + tabId + '"]').addClass('active').attr('aria-selected', 'true');
            // Seçilen tab panelini göster
            $(tabId).addClass('show active');
            console.log('Tab switched successfully to:', tabId);
        }

    // Bootstrap kontrol
    console.log('Bootstrap version check:', typeof bootstrap);
    
    // Bootstrap 5 Tab desteği (eğer mevcut ise)
    if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
        console.log('Using Bootstrap 5 tabs');
        var triggerTabList = [].slice.call(document.querySelectorAll('#voipTabs a'));
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl);
            triggerEl.addEventListener('click', function (event) {
                event.preventDefault();
                tabTrigger.show();
            });
        });
    } else {
        console.log('Bootstrap 5 not found, using manual tab switching');
    }

    // jQuery ile tab kontrolü (geri yedek)
    $('#voipTabs a').on('click', function (e) {
        e.preventDefault();
        var targetTab = $(this).attr('href');
        console.log('Tab clicked:', targetTab);
        switchTab(targetTab);
    });

    // Manuel click eventleri de ekleyelim
    $('#operator-tab').on('click', function(e) {
        e.preventDefault();
        console.log('Operator tab clicked');
        switchTab('#operator');
    });
    
    $('#panel-tab').on('click', function(e) {
        e.preventDefault();
        console.log('Panel tab clicked');
        switchTab('#panel');
    });
    
    $('#numara-tab').on('click', function(e) {
        e.preventDefault();
        console.log('Numara tab clicked');
        switchTab('#numara');
    });
    
    $('#teslim-tab').on('click', function(e) {
        e.preventDefault();
        console.log('Teslim tab clicked');
        switchTab('#teslim');
    });

    // İlk yüklemede operator tab'ının aktif olduğundan emin ol
    switchTab('#operator');

    // Operatör form submit
    $('#operatorForm').on('submit', function(e) {
        e.preventDefault();
        
        console.log('Operatör form submit başladı');
        var formData = $(this).serialize();
        console.log('Form data:', formData);
        
        // Submit butonunu devre dışı bırak
        var submitBtn = $(this).find('button[type="submit"]');
        var originalText = submitBtn.text();
        submitBtn.prop('disabled', true).text('Ekleniyor...');
        
        $.ajax({
            url: '<?= base_url("voip/operator_ekle") ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            timeout: 10000,
            beforeSend: function() {
                console.log('AJAX request başlatılıyor...');
            },
            success: function(response) {
                console.log('AJAX başarılı response:', response);
                showAlert(response.message, response.success ? 'success' : 'danger');
                if(response.success) {
                    $('#operatorForm')[0].reset();
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX hatası:', {
                    status: xhr.status,
                    statusText: xhr.statusText,
                    error: error,
                    responseText: xhr.responseText
                });
                
                var errorMsg = 'Bir hata oluştu';
                if(xhr.status === 404) {
                    errorMsg = 'Sayfa bulunamadı (404)';
                } else if(xhr.status === 500) {
                    errorMsg = 'Sunucu hatası (500)';
                } else if(xhr.status === 403) {
                    errorMsg = 'Yetki hatası (403)';
                } else if(status === 'timeout') {
                    errorMsg = 'İstek zaman aşımına uğradı';
                }
                
                showAlert(errorMsg, 'danger');
            },
            complete: function() {
                // Submit butonunu yeniden aktif et
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    });

    // Panel form submit
    $('#panelForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url("voip/panel_ekle") ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'success' : 'danger');
                if(response.success) {
                    $('#panelForm')[0].reset();
                }
            },
            error: function() {
                showAlert('Bir hata oluştu', 'danger');
            }
        });
    });

    // Numara form submit
    $('#numaraForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url("voip/numara_ekle") ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'success' : 'danger');
                if(response.success) {
                    $('#numaraForm')[0].reset();
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            },
            error: function() {
                showAlert('Bir hata oluştu', 'danger');
            }
        });
    });

    // Teslim form submit
    $('#teslimForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url("voip/numara_teslim_et") ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'success' : 'danger');
                if(response.success) {
                    $('#teslimForm')[0].reset();
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            },
            error: function() {
                showAlert('Bir hata oluştu', 'danger');
            }
        });
    });
});

function showAlert(message, type) {
    console.log('showAlert çağrıldı:', message, type);
    
    // Varolan alert'leri temizle
    $('#alertArea').html('');
    
    var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                    message +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>';
    
    $('#alertArea').html(alertHtml);
    
    // Alert area'yı sayfanın üstüne kaydır
    $('html, body').animate({
        scrollTop: $('#alertArea').offset().top - 100
    }, 500);
    
    // 5 saniye sonra alert'i otomatik kapat
    setTimeout(function() {
        $('#alertArea .alert').fadeOut();
    }, 5000);
}

function operatorSil(operatorId) {
    if(confirm('Bu operatörü silmek istediğinizden emin misiniz?')) {
        $.ajax({
            url: '<?= base_url("voip/operator_sil") ?>',
            type: 'POST',
            data: {operator_id: operatorId},
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'success' : 'danger');
                if(response.success) {
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            },
            error: function() {
                showAlert('Bir hata oluştu', 'danger');
            }
        });
    }
}

function numaraSil(numaraId) {
    if(confirm('Bu numarayı silmek istediğinizden emin misiniz?')) {
        $.ajax({
            url: '<?= base_url("voip/numara_sil") ?>',
            type: 'POST',
            data: {numara_id: numaraId},
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'success' : 'danger');
                if(response.success) {
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            },
            error: function() {
                showAlert('Bir hata oluştu', 'danger');
            }
        });
    }
}

function panelleriGetir(operatorId) {
    if(!operatorId) {
        $('#panelListesi').html('');
        return;
    }
    
    $.ajax({
        url: '<?= base_url("voip/operator_panelleri_getir/") ?>' + operatorId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if(response.success) {
                var html = '<div class="table-responsive"><table class="table table-striped"><thead><tr><th>Panel Link</th><th>Kullanıcı Adı</th><th>Şifre</th></tr></thead><tbody>';
                if(response.data.length > 0) {
                    response.data.forEach(function(panel) {
                        html += '<tr>';
                        html += '<td><a href="' + panel.panel_link + '" target="_blank">' + panel.panel_link + '</a></td>';
                        html += '<td>' + (panel.panel_kullanici_adi || '-') + '</td>';
                        html += '<td>' + (panel.panel_sifre ? '****' : '-') + '</td>';
                        html += '</tr>';
                    });
                } else {
                    html += '<tr><td colspan="3">Henüz panel tanımlanmamış</td></tr>';
                }
                html += '</tbody></table></div>';
                $('#panelListesi').html(html);
            }
        },
        error: function() {
            $('#panelListesi').html('<div class="alert alert-danger">Paneller yüklenirken hata oluştu</div>');
        }
    });
}

			</div>
			<!-- /content container-fluid -->
		</div>
		<!-- /Page Wrapper -->
	</div>
	<!-- /Main Wrapper -->

<!-- VoIP JavaScript Kodu -->
<script>
// Sayfa yüklendikten sonra çalışacak ana fonksiyon
function initVoipPage() {
    console.log('VoIP sayfası başlatılıyor...');
    
    // Tab switching fonksiyonu
    function switchTab(tabId) {
        console.log('Switching to tab:', tabId);
        
        // Tüm tab linklerinden active sınıfını kaldır
        $('.nav-link').removeClass('active').attr('aria-selected', 'false');
        // Tüm tab panellerini gizle
        $('.tab-pane').removeClass('show active');
        
        // Seçilen tab linkine active sınıfını ekle
        $('a[href="' + tabId + '"]').addClass('active').attr('aria-selected', 'true');
        // Seçilen tab panelini göster
        $(tabId).addClass('show active');
    }

    // Tab click eventleri
    $('#voipTabs a').on('click', function (e) {
        e.preventDefault();
        var targetTab = $(this).attr('href');
        switchTab(targetTab);
    });

    // İlk yüklemede operator tab'ını aktif et
    switchTab('#operator');

    // Alert gösterme fonksiyonu
    function showAlert(message, type) {
        console.log('Alert:', message, type);
        
        var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                        message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                        '</div>';
        
        $('#alertArea').html(alertHtml);
        
        // 5 saniye sonra kapat
        setTimeout(function() {
            $('#alertArea .alert').fadeOut();
        }, 5000);
    }

    // Operatör form submit
    $('#operatorForm').on('submit', function(e) {
        e.preventDefault();
        console.log('Operatör form submit edildi');
        
        var formData = $(this).serialize();
        var submitBtn = $(this).find('button[type="submit"]');
        var originalText = submitBtn.text();
        
        submitBtn.prop('disabled', true).text('Ekleniyor...');
        
        $.ajax({
            url: '<?= base_url("voip/operator_ekle") ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            timeout: 10000,
            success: function(response) {
                console.log('Operatör ekleme response:', response);
                showAlert(response.message, response.success ? 'success' : 'danger');
                
                if(response.success) {
                    $('#operatorForm')[0].reset();
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            },
            error: function(xhr, status, error) {
                console.error('Operatör ekleme hatası:', xhr.responseText);
                showAlert('Operatör eklenirken hata oluştu: ' + error, 'danger');
            },
            complete: function() {
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    });

    // Panel form submit
    $('#panelForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        
        $.ajax({
            url: '<?= base_url("voip/panel_ekle") ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'success' : 'danger');
                if(response.success) {
                    $('#panelForm')[0].reset();
                }
            },
            error: function(xhr, status, error) {
                showAlert('Panel eklenirken hata oluştu', 'danger');
            }
        });
    });

    // Numara form submit
    $('#numaraForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        
        $.ajax({
            url: '<?= base_url("voip/numara_ekle") ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'success' : 'danger');
                if(response.success) {
                    $('#numaraForm')[0].reset();
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            },
            error: function(xhr, status, error) {
                showAlert('Numara eklenirken hata oluştu', 'danger');
            }
        });
    });

    // Teslim form submit
    $('#teslimForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        
        $.ajax({
            url: '<?= base_url("voip/numara_teslim_et") ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'success' : 'danger');
                if(response.success) {
                    $('#teslimForm')[0].reset();
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            },
            error: function(xhr, status, error) {
                showAlert('Teslim işlemi sırasında hata oluştu', 'danger');
            }
        });
    });
    
    console.log('VoIP sayfası başlatma tamamlandı');
}

// Operatör silme fonksiyonu
function operatorSil(operatorId) {
    if(confirm('Bu operatörü silmek istediğinizden emin misiniz?')) {
        $.ajax({
            url: '<?= base_url("voip/operator_sil") ?>',
            type: 'POST',
            data: {operator_id: operatorId},
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    location.reload();
                } else {
                    alert('Hata: ' + response.message);
                }
            },
            error: function() {
                alert('Silme işlemi sırasında hata oluştu');
            }
        });
    }
}

// Numara silme fonksiyonu
function numaraSil(numaraId) {
    if(confirm('Bu numarayı silmek istediğinizden emin misiniz?')) {
        $.ajax({
            url: '<?= base_url("voip/numara_sil") ?>',
            type: 'POST',
            data: {numara_id: numaraId},
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    location.reload();
                } else {
                    alert('Hata: ' + response.message);
                }
            },
            error: function() {
                alert('Silme işlemi sırasında hata oluştu');
            }
        });
    }
}

// Panel getirme fonksiyonu
function panelleriGetir(operatorId) {
    if(!operatorId) {
        $('#panelListesi').html('');
        return;
    }
    
    $.ajax({
        url: '<?= base_url("voip/operator_panelleri_getir/") ?>' + operatorId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if(response.success) {
                var html = '<div class="table-responsive"><table class="table table-striped"><thead><tr><th>Panel Link</th><th>Kullanıcı Adı</th><th>Şifre</th></tr></thead><tbody>';
                if(response.data.length > 0) {
                    response.data.forEach(function(panel) {
                        html += '<tr>';
                        html += '<td><a href="' + panel.panel_link + '" target="_blank">' + panel.panel_link + '</a></td>';
                        html += '<td>' + (panel.panel_kullanici_adi || '-') + '</td>';
                        html += '<td>' + (panel.panel_sifre ? '****' : '-') + '</td>';
                        html += '</tr>';
                    });
                } else {
                    html += '<tr><td colspan="3">Henüz panel tanımlanmamış</td></tr>';
                }
                html += '</tbody></table></div>';
                $('#panelListesi').html(html);
            }
        },
        error: function() {
            $('#panelListesi').html('<div class="alert alert-danger">Paneller yüklenirken hata oluştu</div>');
        }
    });
}

// jQuery yükleme kontrolü ve başlatma
if (typeof jQuery !== 'undefined') {
    console.log('jQuery mevcut:', jQuery.fn.jquery);
    $(document).ready(function() {
        initVoipPage();
    });
} else {
    console.log('jQuery yüklenmemiş, alternatif yoldan yükleniyor...');
    var script = document.createElement('script');
    script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js';
    script.onload = function() {
        console.log('jQuery yüklendi');
        $(document).ready(function() {
            initVoipPage();
        });
    };
    document.head.appendChild(script);
}
</script>

<?php $this->load->view("include/footer-js");?>
</body>
</html>
