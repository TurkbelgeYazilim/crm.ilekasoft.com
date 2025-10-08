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

	

	.badge {

		font-size: 0.75em;

		padding: 0.25em 0.4em;

	}

	

	.badge-primary {

		background-color: #007bff;

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

						<h3 class="page-title">Numara Tanımla</h3>

						<ul class="breadcrumb">

							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>

							<li class="breadcrumb-item"><a href="#">Voip & Hakediş</a></li>

							<li class="breadcrumb-item active">Numara Tanımla</li>

						</ul>

					</div>

				</div>

			</div>

			<!-- /Page Header -->

			

			<div class="row">

				<div class="col-12">

						<!-- Numara Ekleme Formu -->

						<div class="card">

							<div class="card-header">

								<i class="fas fa-phone mr-2"></i> Yeni Numara Ekle

							</div>

							<div class="card-body">

								<form id="numaraForm">

									<div class="row">

										<div class="col-md-6">

											<div class="form-group">

												<label for="operator_id">Operatör <span class="text-danger">*</span></label>

												<select class="form-control" id="operator_id" name="operator_id" required>

													<option value="">Operatör Seçin</option>

													<?php foreach($operatorler as $operator): ?>

														<option value="<?= $operator->operator_id ?>"><?= $operator->operator_adi ?></option>

													<?php endforeach; ?>

												</select>

											</div>

										</div>

										<div class="col-md-6">

											<div class="form-group">

												<label for="voip_numara">VoIP Numara <span class="text-danger">*</span></label>

												<input type="text" class="form-control" id="voip_numara" name="voip_numara" placeholder="Örn: +905551234567" required maxlength="30">

											</div>

										</div>

									</div>

									

									<div class="row">

										<div class="col-md-6">

											<div class="form-group">

												<label for="kullanici_adi">Kullanıcı Adı</label>

												<input type="text" class="form-control" id="kullanici_adi" name="kullanici_adi" placeholder="SIP kullanıcı adı" maxlength="100">

											</div>

										</div>

										<div class="col-md-6">

											<div class="form-group">

												<label for="sifre">Şifre</label>

												<input type="password" class="form-control" id="sifre" name="sifre" placeholder="SIP şifresi" maxlength="100">

											</div>

										</div>

									</div>

									

									<div class="row">

										<div class="col-md-6">

											<div class="form-group">

												<label for="ip_adresi">IP Adresi</label>

												<input type="text" class="form-control" id="ip_adresi" name="ip_adresi" placeholder="Örn: 192.168.1.100" maxlength="45">

											</div>

										</div>

										<div class="col-md-6">

											<div class="form-group">

												<label for="durum">Durum</label>

												<select class="form-control" id="durum" name="durum">

													<option value="1" selected>Aktif</option>

													<option value="0">Pasif</option>

												</select>

											</div>

										</div>

									</div>

									

									<div class="row">

										<div class="col-12">

											<div class="form-group">

												<label for="aciklama">Açıklama</label>

												<textarea class="form-control" id="aciklama" name="aciklama" rows="3" placeholder="Numara hakkında açıklama..."></textarea>

											</div>

										</div>

									</div>

									

									<div class="form-group">

										<button type="submit" class="btn btn-primary">

											<i class="fas fa-plus mr-1"></i> Numara Ekle

										</button>

									</div>

								</form>

								

								<div id="mesaj"></div>

							</div>

						</div>



						<!-- Numara Listesi -->

						<div class="card">

							<div class="card-header">

								<i class="fas fa-list mr-2"></i> Kayıtlı Numaralar

								<span class="badge badge-primary ml-2"><?= count($numaralar) ?></span>

							</div>

							<div class="card-body">

								<!-- Filtreleme Formu -->

								<div class="card mb-3">

									<div class="card-header">

										<i class="fas fa-filter mr-2"></i> Filtreleme

									</div>

									<div class="card-body">

										<form method="post" action="<?= base_url('voip/numara-tanimla') ?>">

											<div class="row">

												<div class="col-md-3">

													<div class="form-group">

														<label for="filtre_numara">Numara</label>

														<input type="text" class="form-control" id="filtre_numara" name="filtre_numara" 

															   placeholder="Numara ara..." value="<?= htmlspecialchars($filtre_numara ?? '') ?>">

													</div>

												</div>

												<div class="col-md-3">

													<div class="form-group">

														<label for="filtre_operator">Operatör</label>

														<select class="form-control" id="filtre_operator" name="filtre_operator">

															<option value="">Tüm Operatörler</option>

															<?php foreach($operatorler as $operator): ?>

																<option value="<?= $operator->operator_id ?>" 

																		<?= ($filtre_operator == $operator->operator_id) ? 'selected' : '' ?>>

																	<?= $operator->operator_adi ?>

																</option>

															<?php endforeach; ?>

														</select>

													</div>

												</div>

												<div class="col-md-3">

													<div class="form-group">

														<label for="filtre_kullanici">Kullanıcı Adı</label>

														<input type="text" class="form-control" id="filtre_kullanici" name="filtre_kullanici" 

															   placeholder="Kullanıcı ara..." value="<?= htmlspecialchars($filtre_kullanici ?? '') ?>">

													</div>

												</div>

												<div class="col-md-3">

													<div class="form-group">

														<label for="filtre_durum">Durum</label>

														<select class="form-control" id="filtre_durum" name="filtre_durum">

															<option value="">Tüm Durumlar</option>

															<option value="1" <?= ($filtre_durum === '1') ? 'selected' : '' ?>>Aktif</option>

															<option value="0" <?= ($filtre_durum === '0') ? 'selected' : '' ?>>Pasif</option>

														</select>

													</div>

												</div>

											</div>

											<div class="row">

												<div class="col-md-12 d-flex align-items-end justify-content-end">

													<div class="form-group mb-0">

														<button type="submit" class="btn btn-primary mr-2">

															<i class="fas fa-search mr-1"></i> Filtrele

														</button>

														<a href="<?= base_url('voip/numara-tanimla') ?>" class="btn btn-secondary">

															<i class="fas fa-times mr-1"></i> Temizle

														</a>

													</div>

												</div>

											</div>

										</form>

									</div>

								</div>

								

								<?php if(count($numaralar) > 0): ?>

									<div class="table-responsive">

										<table class="table table-striped table-hover">

											<thead>

												<tr>

													<th>ID</th>

													<th>Operatör</th>

													<th>VoIP Numara</th>

													<th>Kullanıcı Adı</th>

													<th>IP Adresi</th>

													<th>Durum</th>

													<th>Açıklama</th>

													<th>İşlemler</th>

												</tr>

											</thead>

											<tbody>

												<?php foreach($numaralar as $numara): ?>

													<tr>

														<td><?= $numara->numara_id ?></td>

														<td>

															<span class="badge badge-primary"><?= $numara->operator_adi ?? 'Bilinmiyor' ?></span>

														</td>

														<td><strong><?= $numara->voip_numara ?></strong></td>

														<td><?= $numara->kullanici_adi ?: '-' ?></td>

														<td><?= $numara->ip_adresi ?: '-' ?></td>

														<td>

															<?php 

															$durum = isset($numara->durum) ? $numara->durum : 1;

															if($durum == 1): ?>

																<span class="badge badge-success">Aktif</span>

															<?php else: ?>

																<span class="badge badge-danger">Pasif</span>

															<?php endif; ?>

														</td>

														<td><?= isset($numara->aciklama) && $numara->aciklama ? substr($numara->aciklama, 0, 50) . (strlen($numara->aciklama) > 50 ? '...' : '') : '-' ?></td>

														<td>

															<button class="btn btn-warning btn-sm" onclick="duzenleModal(<?= $numara->numara_id ?>)">

																<i class="fas fa-edit"></i> Düzenle

															</button>

															<button class="btn btn-danger btn-sm" onclick="silOnayi(<?= $numara->numara_id ?>, '<?= $numara->voip_numara ?>')">

																<i class="fas fa-trash"></i> Sil

															</button>

														</td>

													</tr>

												<?php endforeach; ?>

											</tbody>

										</table>

									</div>

								<?php else: ?>

									<div class="empty-state">

										<i class="fas fa-phone"></i>

										<h5>Henüz numara tanımlanmamış</h5>

										<p class="text-muted">Yukarıdaki formu kullanarak ilk numaranızı ekleyin.</p>

									</div>

								<?php endif; ?>

							</div>

						</div>

				</div>

			</div>

		</div>

		<!-- /Page Wrapper -->

		

	</div>

	<!-- /Main Wrapper -->



	<!-- Düzenleme Modal -->

	<div class="modal fade" id="duzenleModal" tabindex="-1" role="dialog">

		<div class="modal-dialog" role="document">

			<div class="modal-content">

				<div class="modal-header">

					<h5 class="modal-title">

						<i class="fas fa-edit mr-2"></i> Numara Düzenle

					</h5>

					<button type="button" class="close" data-dismiss="modal">

						<span>&times;</span>

					</button>

				</div>

				<div class="modal-body">

					<form id="duzenleForm">

						<input type="hidden" id="edit_numara_id" name="numara_id">

						

						<div class="form-group">

							<label for="edit_operator_id">Operatör <span class="text-danger">*</span></label>

							<select class="form-control" id="edit_operator_id" name="operator_id" required>

								<option value="">Operatör Seçin</option>

								<?php foreach($operatorler as $operator): ?>

									<option value="<?= $operator->operator_id ?>"><?= $operator->operator_adi ?></option>

								<?php endforeach; ?>

							</select>

						</div>

						

						<div class="form-group">

							<label for="edit_voip_numara">VoIP Numara <span class="text-danger">*</span></label>

							<input type="text" class="form-control" id="edit_voip_numara" name="voip_numara" required maxlength="30">

						</div>

						

						<div class="form-group">

							<label for="edit_kullanici_adi">Kullanıcı Adı</label>

							<input type="text" class="form-control" id="edit_kullanici_adi" name="kullanici_adi" maxlength="100">

						</div>

						

						<div class="form-group">

							<label for="edit_sifre">Şifre</label>

							<input type="password" class="form-control" id="edit_sifre" name="sifre" maxlength="100">

						</div>

						

						<div class="form-group">

							<label for="edit_ip_adresi">IP Adresi</label>

							<input type="text" class="form-control" id="edit_ip_adresi" name="ip_adresi" maxlength="45">

						</div>

						

						<div class="form-group">

							<label for="edit_durum">Durum</label>

							<select class="form-control" id="edit_durum" name="durum">

								<option value="1">Aktif</option>

								<option value="0">Pasif</option>

							</select>

						</div>

						

						<div class="form-group">

							<label for="edit_aciklama">Açıklama</label>

							<textarea class="form-control" id="edit_aciklama" name="aciklama" rows="3" placeholder="Numara hakkında açıklama..."></textarea>

						</div>

					</form>

					

					<div id="duzenle_mesaj"></div>

				</div>

				<div class="modal-footer">

					<button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>

					<button type="button" class="btn btn-primary" onclick="numaraGuncelle()">

						<i class="fas fa-save mr-1"></i> Güncelle

					</button>

				</div>

			</div>

		</div>

	</div>



	<?php $this->load->view("include/footer-js"); ?>



	<script>

	$(document).ready(function() {

		console.log('VoIP Numara Tanımla sayfası hazır');

		

		// Form submit

		$('#numaraForm').on('submit', function(e) {

			e.preventDefault();

			numaraEkle();

		});

	});



	function numaraEkle() {

		var formData = $('#numaraForm').serialize();

		

		$('#mesaj').html('<div class="alert alert-info"><i class="fas fa-spinner fa-spin"></i> İşlem yapılıyor...</div>');

		

		$.ajax({

			url: '<?= base_url("voip/numara_ekle") ?>',

			type: 'POST',

			data: formData,

			dataType: 'json',

			success: function(response) {

				if(response.success) {

					$('#mesaj').html('<div class="alert alert-success"><i class="fas fa-check-circle"></i> ' + response.message + '</div>');

					$('#numaraForm')[0].reset();

					setTimeout(function() {

						location.reload();

					}, 1500);

				} else {

					$('#mesaj').html('<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> ' + response.message + '</div>');

				}

			},

			error: function(xhr, status, error) {

				console.error('AJAX Error:', error);

				$('#mesaj').html('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> Bir hata oluştu. Lütfen tekrar deneyin.</div>');

			}

		});

	}



	function duzenleModal(numara_id) {

		$('#duzenle_mesaj').html('');

		

		$.ajax({

			url: '<?= base_url("voip/numara_getir") ?>',

			type: 'POST',

			data: { numara_id: numara_id },

			dataType: 'json',

			success: function(response) {

				if(response.success) {

					$('#edit_numara_id').val(response.data.numara_id);

					$('#edit_operator_id').val(response.data.operator_id);

					$('#edit_voip_numara').val(response.data.voip_numara);

					$('#edit_kullanici_adi').val(response.data.kullanici_adi);

					$('#edit_sifre').val(response.data.sifre);

					$('#edit_ip_adresi').val(response.data.ip_adresi);

					$('#edit_durum').val(response.data.durum || 1);

					$('#edit_aciklama').val(response.data.aciklama || '');

					$('#duzenleModal').modal('show');

				} else {

					alert('Numara bilgileri alınamadı: ' + response.message);

				}

			},

			error: function() {

				alert('Bir hata oluştu. Lütfen tekrar deneyin.');

			}

		});

	}



	function numaraGuncelle() {

		var formData = $('#duzenleForm').serialize();

		

		$('#duzenle_mesaj').html('<div class="alert alert-info"><i class="fas fa-spinner fa-spin"></i> İşlem yapılıyor...</div>');

		

		$.ajax({

			url: '<?= base_url("voip/numara_guncelle") ?>',

			type: 'POST',

			data: formData,

			dataType: 'json',

			success: function(response) {

				if(response.success) {

					$('#duzenle_mesaj').html('<div class="alert alert-success"><i class="fas fa-check-circle"></i> ' + response.message + '</div>');

					setTimeout(function() {

						location.reload();

					}, 1500);

				} else {

					$('#duzenle_mesaj').html('<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> ' + response.message + '</div>');

				}

			},

			error: function() {

				$('#duzenle_mesaj').html('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> Bir hata oluştu. Lütfen tekrar deneyin.</div>');

			}

		});

	}



	function silOnayi(numara_id, voip_numara) {

		if(confirm('Bu numarayı silmek istediğinizden emin misiniz?\n\nNumara: ' + voip_numara)) {

			numaraSil(numara_id);

		}

	}



	function numaraSil(numara_id) {

		$.ajax({

			url: '<?= base_url("voip/numara_sil") ?>',

			type: 'POST',

			data: { numara_id: numara_id },

			dataType: 'json',

			success: function(response) {

				if(response.success) {

					alert('Numara başarıyla silindi');

					location.reload();

				} else {

					alert('Hata: ' + response.message);

				}

			},

			error: function() {

				alert('Bir hata oluştu. Lütfen tekrar deneyin.');

			}

		});

	}

	</script>



</body>

</html>

