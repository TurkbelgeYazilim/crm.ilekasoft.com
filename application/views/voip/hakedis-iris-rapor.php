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
		border-top: 1px solid #dee2e6;
		font-weight: 600;
		font-size: 0.9rem;
		white-space: nowrap;
	}
	
	.table td {
		font-size: 0.85rem;
		vertical-align: middle;
		border-top: 1px solid #dee2e6;
	}

	.file-upload-area {
		border: 2px dashed #ddd;
		border-radius: 5px;
		padding: 30px;
		text-align: center;
		margin-bottom: 20px;
		background-color: #f9f9f9;
		transition: border-color 0.3s ease;
	}

	.file-upload-area:hover {
		border-color: #007bff;
	}

	.file-upload-area.dragover {
		border-color: #007bff;
		background-color: #e7f3ff;
	}

	.btn-upload {
		background-color: #28a745;
		border-color: #28a745;
		color: white;
		padding: 10px 20px;
		border-radius: 5px;
		font-size: 16px;
	}

	.btn-upload:hover {
		background-color: #218838;
		border-color: #1e7e34;
	}

	.upload-progress {
		display: none;
		margin-top: 10px;
	}

	.filter-card {
		background-color: #fff;
		border: 1px solid #dee2e6;
		border-radius: 0.25rem;
		margin-bottom: 1rem;
	}

	.table-responsive {
		border: 1px solid #dee2e6;
		border-radius: 0.25rem;
	}

	.pagination-info {
		color: #6c757d;
		font-size: 0.9rem;
	}
	</style>
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<?php $this->load->view("include/sidebar"); ?>
			<?php $this->load->view("include/header"); ?>

			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3><?= $h1 ?></h3>
						</div>
					</div>

					<div class="clearfix"></div>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">

							<!-- CSV Yükleme Kartı -->
							<div class="card">
								<div class="card-header">
									<i class="fa fa-upload"></i> CSV Dosyası Yükle
								</div>
								<div class="card-body">
									<form id="csvUploadForm" enctype="multipart/form-data">
										<div class="file-upload-area" id="fileUploadArea">
											<i class="fa fa-cloud-upload" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
											<h4>CSV dosyasını buraya sürükleyip bırakın</h4>
											<p class="text-muted">veya dosya seçmek için tıklayın</p>
											<input type="file" id="csv_file" name="csv_file" accept=".csv" style="display: none;">
											<button type="button" class="btn btn-primary" onclick="document.getElementById('csv_file').click();">
												<i class="fa fa-file-o"></i> Dosya Seç
											</button>
										</div>
										
										<div id="selectedFile" style="display: none; margin-top: 15px;">
											<div class="alert alert-info">
												<i class="fa fa-file-text-o"></i> <span id="fileName"></span>
												<button type="button" class="btn btn-sm btn-danger pull-right" onclick="clearSelectedFile()">
													<i class="fa fa-times"></i>
												</button>
											</div>
										</div>

										<div class="upload-progress" id="uploadProgress">
											<div class="progress">
												<div class="progress-bar progress-bar-striped active" style="width: 0%"></div>
											</div>
											<small class="text-muted" id="progressText">Dosya yükleniyor...</small>
											<div id="processingInfo" style="display: none; margin-top: 10px;">
												<div class="alert alert-info">
													<i class="fa fa-info-circle"></i> 
													<strong>Büyük dosya işleniyor...</strong><br>
													Bu işlem birkaç dakika sürebilir. Lütfen sayfayı kapatmayın.
												</div>
											</div>
										</div>

										<div style="margin-top: 15px;">
											<button type="submit" class="btn btn-upload" id="uploadBtn" disabled>
												<i class="fa fa-upload"></i> CSV'yi Yükle ve İçe Aktar
											</button>
											<div class="text-muted" style="margin-top: 10px; font-size: 12px;">
												<strong>Not:</strong> CSV dosyasının başlık satırı aşağıdaki sütunları içermelidir:<br>
												TALEP_ID, TALEP_TURU, DT_MUSTERI_NO, MEMO_ID, SATIS_DURUMU, vb.<br>
												<div style="margin-top: 8px; padding: 8px; background-color: #e8f5e8; border-left: 4px solid #28a745; border-radius: 4px;">
													<i class="fa fa-info-circle" style="color: #28a745;"></i> <strong>Akıllı Güncelleme:</strong><br>
													• Yüklenen CSV'deki MEMO_ID değeri tabloda mevcutsa → <strong>Kayıt güncellenir</strong><br>
													• MEMO_ID değeri yoksa veya tabloda bulunamazsa → <strong>Yeni kayıt eklenir</strong>
												</div>
												<span style="color: #28a745;"><strong>Maksimum dosya boyutu: 100 MB</strong></span> | 
												<span style="color: #17a2b8;"><strong>İşlem süresi: ~10 dakika</strong></span><br>
												<div style="margin-top: 10px; padding: 8px; background-color: #f8f9fa; border-radius: 4px;">
													⚠️ <strong>Upload problemi yaşıyorsanız:</strong> 
													<a href="/direct_csv_process.php" target="_blank" style="color: #007bff; font-weight: bold;">
														Alternatif İşleme Yöntemi
													</a> kullanabilirsiniz<br>
													🔧 <strong>Türkçe karakter sorunu için:</strong> 
													<a href="/fix_charset.php" target="_blank" style="color: #dc3545; font-weight: bold;">
														Charset Düzeltme Aracı
													</a>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>

							<!-- Filtreleme Kartı -->
							<div class="filter-card">
								<div class="card-header">
									<i class="fa fa-filter"></i> Filtreler
								</div>
								<div class="card-body">
									<form method="GET" id="filterForm">
										<div class="row">
											<div class="col-md-3">
												<label for="baslangic_tarihi">Başlangıç Tarihi</label>
												<input type="date" class="form-control" id="baslangic_tarihi" name="baslangic_tarihi" 
													   value="<?= htmlspecialchars($filters['baslangic_tarihi']) ?>">
											</div>
											<div class="col-md-3">
												<label for="bitis_tarihi">Bitiş Tarihi</label>
												<input type="date" class="form-control" id="bitis_tarihi" name="bitis_tarihi" 
													   value="<?= htmlspecialchars($filters['bitis_tarihi']) ?>">
											</div>
											<div class="col-md-2">
												<label for="talep_id">Talep ID</label>
												<input type="text" class="form-control" id="talep_id" name="talep_id" 
													   value="<?= htmlspecialchars($filters['talep_id']) ?>" placeholder="Talep ID">
											</div>
											<div class="col-md-2">
												<label for="memo_id">Memo ID</label>
												<input type="text" class="form-control" id="memo_id" name="memo_id" 
													   value="<?= htmlspecialchars($filters['memo_id']) ?>" placeholder="Memo ID">
											</div>
											<div class="col-md-2">
												<label for="dt_musteri_no">DT Müşteri No</label>
												<input type="text" class="form-control" id="dt_musteri_no" name="dt_musteri_no" 
													   value="<?= htmlspecialchars($filters['dt_musteri_no']) ?>" placeholder="Müşteri No">
											</div>
										</div>
										<div class="row" style="margin-top: 15px;">
											<div class="col-md-3">
												<label for="satis_durumu">Satış Durumu</label>
												<input type="text" class="form-control" id="satis_durumu" name="satis_durumu" 
													   value="<?= htmlspecialchars($filters['satis_durumu']) ?>" placeholder="Satış Durumu">
											</div>
											<div class="col-md-3">
												<label>&nbsp;</label><br>
												<button type="submit" class="btn btn-primary">
													<i class="fa fa-search"></i> Filtrele
												</button>
												<a href="<?= base_url('voip/hakedis-iris-rapor') ?>" class="btn btn-default">
													<i class="fa fa-refresh"></i> Temizle
												</a>
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
	</div>

	<?php $this->load->view("include/footer-js"); ?>

	<script>
	$(document).ready(function() {
		// Dosya seçimi
		$('#csv_file').change(function() {
			var file = this.files[0];
			if (file) {
				$('#fileName').text(file.name);
				$('#selectedFile').show();
				$('#uploadBtn').prop('disabled', false);
			}
		});

		// Drag & Drop işlemleri
		var $fileUploadArea = $('#fileUploadArea');
		
		$fileUploadArea.on('dragover', function(e) {
			e.preventDefault();
			e.stopPropagation();
			$(this).addClass('dragover');
		});

		$fileUploadArea.on('dragleave', function(e) {
			e.preventDefault();
			e.stopPropagation();
			$(this).removeClass('dragover');
		});

		$fileUploadArea.on('drop', function(e) {
			e.preventDefault();
			e.stopPropagation();
			$(this).removeClass('dragover');
			
			var files = e.originalEvent.dataTransfer.files;
			if (files.length > 0) {
				var file = files[0];
				if (file.type === 'text/csv' || file.name.endsWith('.csv')) {
					$('#csv_file')[0].files = files;
					$('#fileName').text(file.name);
					$('#selectedFile').show();
					$('#uploadBtn').prop('disabled', false);
				} else {
					showNotification('Sadece CSV dosyaları kabul edilir.', 'error');
				}
			}
		});

		// CSV Upload Form
		$('#csvUploadForm').submit(function(e) {
			e.preventDefault();
			
			var formData = new FormData();
			var fileInput = $('#csv_file')[0];
			
			if (!fileInput.files.length) {
				showNotification('Lütfen bir CSV dosyası seçin.', 'error');
				return;
			}

			var file = fileInput.files[0];
			
			// Dosya boyutu kontrolü (100MB = 100 * 1024 * 1024)
			if (file.size > 100 * 1024 * 1024) {
				showNotification('Dosya boyutu 100MB\'dan büyük olamaz. Dosya boyutu: ' + (file.size / 1024 / 1024).toFixed(2) + ' MB', 'error');
				return;
			}

			formData.append('csv_file', file);

			// Progress göster
			$('#uploadProgress').show();
			$('#uploadBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Yükleniyor...');
			
			// Büyük dosya için ek bilgilendirme
			if (file.size > 50 * 1024 * 1024) { // 50MB'dan büyükse
				$('#processingInfo').show();
				$('#progressText').text('Büyük dosya yükleniyor... (' + (file.size / 1024 / 1024).toFixed(1) + ' MB)');
			}

			$.ajax({
				url: '<?= base_url("voip/iris-rapor-yukle") ?>',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				timeout: 600000, // 10 dakika timeout
				xhr: function() {
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", function(evt) {
						if (evt.lengthComputable) {
							var percentComplete = evt.loaded / evt.total * 100;
							$('#uploadProgress .progress-bar').css('width', percentComplete + '%');
							
							if (percentComplete < 100) {
								$('#progressText').text('Yükleniyor... ' + percentComplete.toFixed(1) + '%');
							} else {
								$('#progressText').text('Dosya yüklendi, işleniyor...');
								$('#uploadBtn').html('<i class="fa fa-cogs fa-spin"></i> İşleniyor...');
							}
						}
					}, false);
					return xhr;
				},
				success: function(response) {
					try {
						var data = typeof response === 'string' ? JSON.parse(response) : response;
						
						if (data.success) {
							showNotification(data.message, 'success');
							setTimeout(function() {
								window.location.reload();
							}, 2000);
						} else {
							showNotification(data.message, 'error');
						}
					} catch (e) {
						console.error('Response parse error:', e);
						console.log('Raw response:', response);
						showNotification('Sunucu yanıtı işlenirken hata oluştu. Detaylar konsola yazıldı.', 'error');
					}
				},
				error: function(xhr, status, error) {
					console.error('AJAX Error:', {xhr: xhr, status: status, error: error});
					var errorMsg = 'Dosya yüklenirken hata oluştu: ';
					
					if (xhr.status === 413) {
						errorMsg += 'Dosya boyutu çok büyük (413 Payload Too Large)';
					} else if (xhr.status === 500) {
						errorMsg += 'Sunucu hatası (500 Internal Server Error)';
					} else if (xhr.status === 0) {
						errorMsg += 'İnternet bağlantısı problemi veya timeout';
					} else {
						errorMsg += status + ' - ' + error;
					}
					
					showNotification(errorMsg, 'error');
				},
				complete: function() {
					$('#uploadProgress').hide();
					$('#processingInfo').hide();
					$('#uploadBtn').prop('disabled', false).html('<i class="fa fa-upload"></i> CSV\'yi Yükle ve İçe Aktar');
					$('#uploadProgress .progress-bar').css('width', '0%');
					$('#progressText').text('Dosya yükleniyor...');
				}
			});
		});
	});

	// Seçili dosyayı temizle
	function clearSelectedFile() {
		$('#csv_file').val('');
		$('#selectedFile').hide();
		$('#uploadBtn').prop('disabled', true);
	}

	// Notification fonksiyonu
	function showNotification(message, type) {
		var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
		var icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
		
		var notification = $('<div class="alert ' + alertClass + ' alert-dismissible" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">' +
			'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
			'<span aria-hidden="true">&times;</span>' +
			'</button>' +
			'<i class="fa ' + icon + '"></i> ' + message +
			'</div>');

		$('body').append(notification);
		
		setTimeout(function() {
			notification.fadeOut(500, function() {
				$(this).remove();
			});
		}, 5000);
	}
	</script>
</body>
</html>
