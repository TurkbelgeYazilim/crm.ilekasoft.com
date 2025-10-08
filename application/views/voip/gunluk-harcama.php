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

		border-top: none;

		font-weight: 600;

		font-size: 0.875rem;

		text-transform: uppercase;

		letter-spacing: 0.05em;

	}

	

	.btn-sm {

		padding: 0.25rem 0.5rem;

		font-size: 0.875rem;

		line-height: 1.5;

		border-radius: 0.2rem;

	}

	

	.form-group {

		margin-bottom: 1rem;

	}

	

	.modal-header {

		background-color: #007bff;

		color: white;

		border-bottom: none;

	}

	

	.modal-header .close {

		color: white;

		opacity: 0.8;

	}

	

	.modal-header .close:hover {

		opacity: 1;

	}

	

	.alert {

		margin-top: 15px;

		border: none;

		border-radius: 0.375rem;

	}

	

	.alert-success {

		background-color: #d4edda;

		color: #155724;

	}

	

	.alert-danger {

		background-color: #f8d7da;

		color: #721c24;

	}

	

	.alert-info {

		background-color: #d1ecf1;

		color: #0c5460;

	}

	

	.badge {

		font-size: 0.75em;

		padding: 0.25em 0.4em;

	}

	

	.badge-success {

		background-color: #28a745;

	}

	

	.badge-primary {

		background-color: #007bff;

	}

	

	.badge-warning {

		background-color: #ffc107;

		color: #212529;

	}

	

	.text-muted {

		color: #6c757d !important;

	}

	

	.empty-state {

		text-align: center;

		padding: 3rem 1rem;

		color: #6c757d;

	}

	

	.empty-state i {

		font-size: 3rem;

		margin-bottom: 1rem;

		opacity: 0.5;

	}

	

	.money-display {

		font-weight: 600;

		color: #28a745;

	}

	

	.stats-card {

		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

		color: white;

		border-radius: 10px;

		padding: 20px;

		margin-bottom: 20px;

	}

	

	.stats-card h3 {

		margin: 0;

		font-size: 2rem;

		font-weight: 700;

	}

	

	.stats-card p {

		margin: 5px 0 0 0;

		opacity: 0.9;

	}

	

	/* Select2 Özelleştirmeleri */

	.select2-container--default .select2-selection--single {

		height: 38px;

		border: 1px solid #ced4da;

		border-radius: 0.375rem;

	}

	

	.select2-container--default .select2-selection--single .select2-selection__rendered {

		line-height: 36px;

		padding-left: 12px;

		color: #495057;

	}

	

	.select2-container--default .select2-selection--single .select2-selection__arrow {

		height: 36px;

		right: 10px;

	}

	

	.select2-dropdown {

		border: 1px solid #ced4da;

		border-radius: 0.375rem;

	}

	

	.select2-container--default .select2-search--dropdown .select2-search__field {

		border: 1px solid #ced4da;

		border-radius: 0.375rem;

		padding: 8px;

	}

	

	.select2-container--default .select2-results__option[aria-selected=true] {

		background-color: #007bff;

	}

	

	.select2-container--default .select2-results__option--highlighted[aria-selected] {

		background-color: #0056b3;

		color: white;

	}

	

	.filter-card {

		background-color: #f8f9fa;

		border: 1px solid #dee2e6;

		border-radius: 0.375rem;

		padding: 15px;

		margin-bottom: 20px;

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

						<h3 class="page-title">Günlük Harcama</h3>

						<ul class="breadcrumb">

							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>

							<li class="breadcrumb-item"><a href="#">Voip & Hakediş</a></li>

							<li class="breadcrumb-item active">Günlük Harcama</li>

						</ul>

					</div>

				</div>

			</div>

			<!-- /Page Header -->

			

			<div class="row">

				<div class="col-12">

					<!-- İstatistik Kartları -->

					<div class="row">

						<div class="col-md-4">

							<div class="stats-card">

								<div class="d-flex justify-content-between align-items-center">

									<div>

										<h3 id="toplamHarcama">0,00 ₺</h3>

										<p>Son 30 Gün Toplam</p>

									</div>

									<i class="fas fa-chart-line fa-2x" style="opacity: 0.7;"></i>

								</div>

							</div>

						</div>

						<div class="col-md-4">

							<div class="stats-card">

								<div class="d-flex justify-content-between align-items-center">

									<div>

										<h3 id="kayitSayisi"><?= count($harcamalar) ?></h3>

										<p>Toplam Kayıt Sayısı</p>

									</div>

									<i class="fas fa-list fa-2x" style="opacity: 0.7;"></i>

								</div>

							</div>

						</div>

						<div class="col-md-4">

							<div class="stats-card">

								<div class="d-flex justify-content-between align-items-center">

									<div>

										<h3 id="ortalamaHarcama">0,00 ₺</h3>

										<p>Günlük Ortalama</p>

									</div>

									<i class="fas fa-calculator fa-2x" style="opacity: 0.7;"></i>

								</div>

							</div>

						</div>

					</div>



					<!-- Harcama Ekleme Formu -->

					<div class="card">

						<div class="card-header">

							<i class="fas fa-plus mr-2"></i> Yeni Harcama Kaydı

						</div>

						<div class="card-body">

							<form id="harcamaForm">

								<div class="row">

									<div class="col-md-3">

										<div class="form-group">

											<label for="numara_id">Voip Numara <span class="text-danger">*</span></label>

											<select class="form-control select2-search" id="numara_id" name="numara_id" required>

												<option value="">Numara Seçin</option>

												<?php foreach($numaralar as $numara): ?>

													<option value="<?= $numara->numara_id ?>">

														<?= $numara->voip_numara ?> - <?= $numara->operator_adi ?>

													</option>

												<?php endforeach; ?>

											</select>

										</div>

									</div>

									<div class="col-md-3">

										<div class="form-group">

											<label for="tarih">Tarih <span class="text-danger">*</span></label>

											<input type="date" class="form-control" id="tarih" name="tarih" value="<?= date('Y-m-d') ?>" required>

										</div>

									</div>

									<div class="col-md-3">

										<div class="form-group">

											<label for="harcama_tutari">Harcama Tutarı (₺) <span class="text-danger">*</span></label>

											<input type="number" class="form-control" id="harcama_tutari" name="harcama_tutari" step="0.01" min="0" placeholder="0,00" required>

										</div>

									</div>

									<div class="col-md-3">

										<div class="form-group">

											<label for="aciklama">Açıklama</label>

											<input type="text" class="form-control" id="aciklama" name="aciklama" placeholder="Harcama açıklaması...">

										</div>

									</div>

								</div>

								<div class="row">

									<div class="col-12">

										<button type="submit" class="btn btn-primary">

											<i class="fas fa-plus mr-1"></i> Kaydet

										</button>

										<button type="reset" class="btn btn-secondary ml-2">

											<i class="fas fa-undo mr-1"></i> Temizle

										</button>

									</div>

								</div>

							</form>

							

							<!-- Alert alanı -->

							<div id="alertContainer"></div>

						</div>

					</div>



					<!-- Filtreleme -->

					<div class="filter-card">

						<h6><i class="fas fa-filter mr-2"></i> Filtreleme ve Rapor</h6>

						<form id="filterForm">

							<div class="row">

								<div class="col-md-2">

									<div class="form-group">

										<label for="filter_baslangic">Başlangıç Tarihi</label>

										<input type="date" class="form-control" id="filter_baslangic" name="baslangic_tarihi" value="<?= date('Y-m-01') ?>">

									</div>

								</div>

								<div class="col-md-2">

									<div class="form-group">

										<label for="filter_bitis">Bitiş Tarihi</label>

										<input type="date" class="form-control" id="filter_bitis" name="bitis_tarihi" value="<?= date('Y-m-d') ?>">

									</div>

								</div>

								<div class="col-md-3">

									<div class="form-group">

										<label for="filter_numara">Numara Filtresi</label>

										<select class="form-control select2-search" id="filter_numara" name="numara_id">

											<option value="">Tüm Numaralar</option>

											<?php foreach($numaralar as $numara): ?>

												<option value="<?= $numara->numara_id ?>">

													<?= $numara->voip_numara ?> - <?= $numara->operator_adi ?>

												</option>

											<?php endforeach; ?>

										</select>

									</div>

								</div>

								<div class="col-md-3">

									<div class="form-group">

										<label for="filter_operator">Operatör Filtresi</label>

										<select class="form-control select2-search" id="filter_operator" name="operator_id">

											<option value="">Tüm Operatörler</option>

											<?php 

											$operators = array();

											foreach($numaralar as $numara): 

												if($numara->operator_adi && !in_array($numara->operator_adi, $operators)):

													$operators[] = $numara->operator_adi;

											?>

												<option value="<?= $numara->operator_adi ?>">

													<?= $numara->operator_adi ?>

												</option>

											<?php endif; endforeach; ?>

										</select>

									</div>

								</div>

								<div class="col-md-2">

									<div class="form-group">

										<label>&nbsp;</label>

										<div>

											<button type="submit" class="btn btn-info btn-block">

												<i class="fas fa-search mr-1"></i> Filtrele

											</button>

										</div>

									</div>

								</div>

							</div>

						</form>

					</div>



					<!-- Harcama Kayıtları Listesi -->

					<div class="card">

						<div class="card-header d-flex justify-content-between align-items-center">

							<span>

								<i class="fas fa-list mr-2"></i> Harcama Kayıtları

								<span class="badge badge-primary ml-2" id="listeBadge"><?= count($harcamalar) ?></span>

							</span>

							<div>

								<span class="money-display" id="listeToplamTutar">

									Toplam: <?php 

										$toplam = 0;

										foreach($harcamalar as $harcama) {

											$toplam += $harcama->harcama_tutari;

										}

										echo number_format($toplam, 2, ',', '.') . ' ₺';

									?>

								</span>

							</div>

						</div>

						<div class="card-body">

							<div id="harcamaListesi">

								<?php if(!empty($harcamalar)): ?>

									<div class="table-responsive">

										<table class="table table-striped table-hover">

											<thead>

												<tr>

													<th>Tarih</th>

													<th>Numara</th>

													<th>Operatör</th>

													<th>Tutar</th>

													<th>Açıklama</th>

													<th>Teslim Edilen Kullanıcı</th>

													<th>Kayıt Tarihi</th>

													<th>İşlemler</th>

												</tr>

											</thead>

											<tbody>

												<?php foreach($harcamalar as $harcama): ?>

													<tr>

														<td>

															<span class="badge badge-primary"><?= date('d.m.Y', strtotime($harcama->tarih)) ?></span>

														</td>

														<td>

															<span class="badge badge-success"><?= $harcama->voip_numara ?></span>

														</td>

														<td><?= $harcama->operator_adi ?: '<span class="text-muted">-</span>' ?></td>

														<td>

															<span class="money-display"><?= number_format($harcama->harcama_tutari, 2, ',', '.') ?> ₺</span>

														</td>

														<td>

															<?= $harcama->aciklama ? mb_substr($harcama->aciklama, 0, 30) . (mb_strlen($harcama->aciklama) > 30 ? '...' : '') : '<span class="text-muted">-</span>' ?>

														</td>

														<td><?= $harcama->kullanici_ad ?> <?= $harcama->kullanici_soyad ?></td>

														<td><?= date('d.m.Y H:i', strtotime($harcama->kayit_tarihi)) ?></td>

														<td>

															<button type="button" class="btn btn-warning btn-sm" onclick="editHarcama(<?= $harcama->harcama_id ?>)" title="Düzenle">

																<i class="fas fa-edit"></i>

															</button>

															<button type="button" class="btn btn-danger btn-sm ml-1" onclick="deleteHarcama(<?= $harcama->harcama_id ?>)" title="Sil">

																<i class="fas fa-trash"></i>

															</button>

														</td>

													</tr>

												<?php endforeach; ?>

											</tbody>

										</table>

									</div>

								<?php else: ?>

									<div class="empty-state">

										<i class="fas fa-chart-line"></i>

										<h5>Henüz harcama kaydı yok</h5>

										<p class="text-muted">Yukarıdaki formu kullanarak yeni harcama kaydı ekleyebilirsiniz.</p>

									</div>

								<?php endif; ?>

							</div>

						</div>

					</div>

				</div>

			</div>

			

			</div>

		</div>

		<!-- /Page Wrapper -->

	</div>

	<!-- /Main Wrapper -->



	<!-- Harcama Düzenleme Modal -->

	<div class="modal fade" id="editHarcamaModal" tabindex="-1" role="dialog">

		<div class="modal-dialog" role="document">

			<div class="modal-content">

				<div class="modal-header">

					<h5 class="modal-title">

						<i class="fas fa-edit mr-2"></i> Harcama Kaydını Düzenle

					</h5>

					<button type="button" class="close" data-dismiss="modal">

						<span>&times;</span>

					</button>

				</div>

				<div class="modal-body">

					<form id="editHarcamaForm">

						<input type="hidden" id="edit_harcama_id" name="harcama_id">

						<div class="form-group">

							<label for="edit_numara_id">Voip Numara <span class="text-danger">*</span></label>

							<select class="form-control select2-search-modal" id="edit_numara_id" name="numara_id" required>

								<option value="">Numara Seçin</option>

								<?php foreach($numaralar as $numara): ?>

									<option value="<?= $numara->numara_id ?>">

										<?= $numara->voip_numara ?> - <?= $numara->operator_adi ?>

									</option>

								<?php endforeach; ?>

							</select>

						</div>

						<div class="form-group">

							<label for="edit_tarih">Tarih <span class="text-danger">*</span></label>

							<input type="date" class="form-control" id="edit_tarih" name="tarih" required>

						</div>

						<div class="form-group">

							<label for="edit_harcama_tutari">Harcama Tutarı (₺) <span class="text-danger">*</span></label>

							<input type="number" class="form-control" id="edit_harcama_tutari" name="harcama_tutari" step="0.01" min="0" required>

						</div>

						<div class="form-group">

							<label for="edit_aciklama">Açıklama</label>

							<input type="text" class="form-control" id="edit_aciklama" name="aciklama">

						</div>

					</form>

				</div>

				<div class="modal-footer">

					<button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>

					<button type="button" class="btn btn-primary" onclick="updateHarcama()">

						<i class="fas fa-save mr-1"></i> Güncelle

					</button>

				</div>

			</div>

		</div>

	</div>



	<!-- Footer -->

	<?php $this->load->view("include/footer-js"); ?>

	<!-- /Footer -->



	<!-- JavaScript -->

	<script>

		$(document).ready(function() {

			// Select2 başlatma

			$('.select2-search').select2({

				placeholder: "Arama yapın veya seçin...",

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

			

			// Modal içindeki select2'ler

			$('.select2-search-modal').select2({

				placeholder: "Arama yapın veya seçin...",

				allowClear: true,

				dropdownParent: $('#editHarcamaModal'),

				language: {

					noResults: function() {

						return "Sonuç bulunamadı";

					},

					searching: function() {

						return "Aranıyor...";

					}

				}

			});

			

			// İstatistikleri hesapla ve göster

			hesaplaIstatistikler();

			

			// Harcama formu submit

			$('#harcamaForm').on('submit', function(e) {

				e.preventDefault();

				

				var formData = $(this).serialize();

				

				$.ajax({

					url: '<?= base_url("voip/harcama_ekle") ?>',

					type: 'POST',

					data: formData,

					dataType: 'json',

					success: function(response) {

						if(response.success) {

							showAlert('success', response.message);

							$('#harcamaForm')[0].reset();

							$('#tarih').val('<?= date('Y-m-d') ?>'); // Tarihi bugüne çevir

							$('.select2-search').val(null).trigger('change'); // Select2 temizle

							// Sayfayı yenile

							setTimeout(function() {

								location.reload();

							}, 1500);

						} else {

							showAlert('danger', response.message);

						}

					},

					error: function() {

						showAlert('danger', 'Bir hata oluştu. Lütfen tekrar deneyin.');

					}

				});

			});

			

			// Filter formu submit

			$('#filterForm').on('submit', function(e) {

				e.preventDefault();

				

				var formData = $(this).serialize();

				

				$.ajax({

					url: '<?= base_url("voip/harcama_raporu") ?>',

					type: 'POST',

					data: formData,

					dataType: 'json',

					success: function(response) {

						if(response.success) {

							updateHarcamaListesi(response.data, response.toplam, response.kayit_sayisi);

							showAlert('info', 'Filtre uygulandı. ' + response.kayit_sayisi + ' kayıt bulundu.');

						} else {

							showAlert('danger', response.message);

						}

					},

					error: function() {

						showAlert('danger', 'Filtreleme sırasında bir hata oluştu.');

					}

				});

			});

		});



		// İstatistikleri hesaplama

		function hesaplaIstatistikler() {

			<?php

			$toplam = 0;

			$gunler = [];

			foreach($harcamalar as $harcama) {

				$toplam += $harcama->harcama_tutari;

				$gunler[$harcama->tarih] = true;

			}

			$gun_sayisi = count($gunler);

			$ortalama = $gun_sayisi > 0 ? $toplam / $gun_sayisi : 0;

			?>

			

			$('#toplamHarcama').text('<?= number_format($toplam, 2, ',', '.') ?> ₺');

			$('#ortalamaHarcama').text('<?= number_format($ortalama, 2, ',', '.') ?> ₺');

		}



		// Alert gösterme fonksiyonu

		function showAlert(type, message) {

			var alertClass = type === 'success' ? 'alert-success' : (type === 'info' ? 'alert-info' : 'alert-danger');

			var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +

				message +

				'<button type="button" class="close" data-dismiss="alert">' +

				'<span>&times;</span>' +

				'</button>' +

				'</div>';

			

			$('#alertContainer').html(alertHtml);

			

			// 5 saniye sonra alert'i kaldır

			setTimeout(function() {

				$('.alert').alert('close');

			}, 5000);

		}



		// Harcama listesini güncelleme

		function updateHarcamaListesi(harcamalar, toplam, kayitSayisi) {

			$('#listeBadge').text(kayitSayisi);

			$('#listeToplamTutar').text('Toplam: ' + parseFloat(toplam).toLocaleString('tr-TR', {minimumFractionDigits: 2}) + ' ₺');

			

			if(harcamalar.length === 0) {

				$('#harcamaListesi').html(

					'<div class="empty-state">' +

					'<i class="fas fa-search"></i>' +

					'<h5>Filtreye uygun kayıt bulunamadı</h5>' +

					'<p class="text-muted">Farklı filtre kriterleri deneyebilirsiniz.</p>' +

					'</div>'

				);

				return;

			}

			

			var tableHtml = '<div class="table-responsive"><table class="table table-striped table-hover">' +

				'<thead><tr>' +

				'<th>Tarih</th><th>Numara</th><th>Operatör</th><th>Tutar</th>' +

				'<th>Açıklama</th><th>Teslim Edilen Kullanıcı</th><th>Kayıt Tarihi</th><th>İşlemler</th>' +

				'</tr></thead><tbody>';

			

			harcamalar.forEach(function(harcama) {

				var tarih = new Date(harcama.tarih);

				var kayitTarihi = new Date(harcama.kayit_tarihi);

				

				tableHtml += '<tr>' +

					'<td><span class="badge badge-primary">' + tarih.toLocaleDateString('tr-TR') + '</span></td>' +

					'<td><span class="badge badge-success">' + harcama.voip_numara + '</span></td>' +

					'<td>' + (harcama.operator_adi || '<span class="text-muted">-</span>') + '</td>' +

					'<td><span class="money-display">' + parseFloat(harcama.harcama_tutari).toLocaleString('tr-TR', {minimumFractionDigits: 2}) + ' ₺</span></td>' +

					'<td>' + (harcama.aciklama ? (harcama.aciklama.length > 30 ? harcama.aciklama.substring(0, 30) + '...' : harcama.aciklama) : '<span class="text-muted">-</span>') + '</td>' +

					'<td>' + harcama.kullanici_ad + ' ' + harcama.kullanici_soyad + '</td>' +

					'<td>' + kayitTarihi.toLocaleDateString('tr-TR') + ' ' + kayitTarihi.toLocaleTimeString('tr-TR', {hour: '2-digit', minute: '2-digit'}) + '</td>' +

					'<td>' +

					'<button type="button" class="btn btn-warning btn-sm" onclick="editHarcama(' + harcama.harcama_id + ')" title="Düzenle">' +

					'<i class="fas fa-edit"></i></button> ' +

					'<button type="button" class="btn btn-danger btn-sm ml-1" onclick="deleteHarcama(' + harcama.harcama_id + ')" title="Sil">' +

					'<i class="fas fa-trash"></i></button>' +

					'</td></tr>';

			});

			

			tableHtml += '</tbody></table></div>';

			$('#harcamaListesi').html(tableHtml);

		}



		// Harcama düzenleme

		function editHarcama(harcamaId) {

			$.ajax({

				url: '<?= base_url("voip/harcama_getir") ?>',

				type: 'POST',

				data: { harcama_id: harcamaId },

				dataType: 'json',

				success: function(response) {

					if(response.success) {

						var data = response.data;

						$('#edit_harcama_id').val(data.harcama_id);

						$('#edit_numara_id').val(data.numara_id).trigger('change');

						$('#edit_tarih').val(data.tarih);

						$('#edit_harcama_tutari').val(data.harcama_tutari);

						$('#edit_aciklama').val(data.aciklama);

						$('#editHarcamaModal').modal('show');

					} else {

						showAlert('danger', response.message);

					}

				},

				error: function() {

					showAlert('danger', 'Harcama bilgileri alınırken bir hata oluştu.');

				}

			});

		}



		// Harcama güncelleme

		function updateHarcama() {

			var formData = $('#editHarcamaForm').serialize();

			

			$.ajax({

				url: '<?= base_url("voip/harcama_guncelle") ?>',

				type: 'POST',

				data: formData,

				dataType: 'json',

				success: function(response) {

					if(response.success) {

						showAlert('success', response.message);

						$('#editHarcamaModal').modal('hide');

						// Sayfayı yenile

						setTimeout(function() {

							location.reload();

						}, 1500);

					} else {

						showAlert('danger', response.message);

					}

				},

				error: function() {

					showAlert('danger', 'Güncelleme sırasında bir hata oluştu.');

				}

			});

		}



		// Harcama silme

		function deleteHarcama(harcamaId) {

			if(confirm('Bu harcama kaydını silmek istediğinizden emin misiniz?')) {

				$.ajax({

					url: '<?= base_url("voip/harcama_sil") ?>',

					type: 'POST',

					data: { harcama_id: harcamaId },

					dataType: 'json',

					success: function(response) {

						if(response.success) {

							showAlert('success', response.message);

							// Sayfayı yenile

							setTimeout(function() {

								location.reload();

							}, 1500);

						} else {

							showAlert('danger', response.message);

						}

					},

					error: function() {

						showAlert('danger', 'Silme işlemi sırasında bir hata oluştu.');

					}

				});

			}

		}

	</script>

</body>

</html>

