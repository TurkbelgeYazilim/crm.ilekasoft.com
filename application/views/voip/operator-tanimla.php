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

	

	.panel-list {

		max-width: 300px;

	}

	

	.panel-item {

		background-color: #f8f9fa;

		font-size: 0.8rem;

	}

	

	.btn-group-vertical .btn {

		border-radius: 0.2rem;

		margin-bottom: 2px;

	}

	

	.btn-group-vertical .btn:last-child {

		margin-bottom: 0;

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

							<h3 class="page-title">Operatör Tanımla</h3>

							<ul class="breadcrumb">

								<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>

								<li class="breadcrumb-item"><a href="#">Voip & Hakediş</a></li>

								<li class="breadcrumb-item active">Operatör Tanımla</li>

							</ul>

						</div>

					</div>

				</div>

				<!-- /Page Header -->

				

				<div class="row">

					<div class="col-md-12">

						<!-- Operatör Ekleme Kartı -->

						<div class="card">

							<div class="card-header">

								<h3 class="card-title">

									<i class="fa fa-plus"></i> Yeni Operatör Ekle

								</h3>

							</div>

							<div class="card-body">

								<form id="operatorForm">

									<div class="row">

										<div class="col-md-6">

											<div class="form-group">

												<label for="operator_adi">Operatör Adı <span class="text-danger">*</span></label>

												<input type="text" class="form-control" id="operator_adi" name="operator_adi" required>

											</div>

										</div>

										<div class="col-md-6">

											<div class="form-group">

												<label for="aciklama">Açıklama</label>

												<input type="text" class="form-control" id="aciklama" name="aciklama">

											</div>

										</div>

									</div>

									<div class="row">

										<div class="col-md-12">

											<button type="submit" class="btn btn-primary">

												<i class="fa fa-save"></i> Operatör Ekle

											</button>

											<button type="reset" class="btn btn-secondary">

												<i class="fa fa-refresh"></i> Temizle

											</button>

										</div>

									</div>

								</form>

								

								<div id="alertContainer"></div>

							</div>

						</div>



						<!-- Operatörler Listesi -->

						<div class="card">

							<div class="card-header">

								<h3 class="card-title">

									<i class="fa fa-list"></i> Tanımlı Operatörler

									<span class="badge badge-primary" id="operatorSayisi"><?= count($operatorler) ?></span>

								</h3>

							</div>

							<div class="card-body">

								<?php if(empty($operatorler)): ?>

									<div class="empty-state">

										<i class="fa fa-phone"></i>

										<h4>Henüz operatör tanımlanmamış</h4>

										<p>Yukarıdaki formu kullanarak ilk operatörünüzü ekleyin.</p>

									</div>

								<?php else: ?>

									<div class="table-responsive">

										<table class="table table-striped table-hover" id="operatorlerTable">

											<thead>

												<tr>

													<th width="80">#</th>

													<th>Operatör Adı</th>

													<th>Açıklama</th>

													<th>Panel Bilgileri</th>

													<th width="180">İşlemler</th>

												</tr>

											</thead>

											<tbody>

												<?php foreach($operatorler as $operator): ?>

													<tr data-id="<?= $operator->operator_id ?>">

														<td><?= $operator->operator_id ?></td>

														<td>

															<strong><?= htmlspecialchars($operator->operator_adi) ?></strong>

														</td>

														<td>

															<span class="text-muted"><?= htmlspecialchars($operator->aciklama ?: 'Açıklama yok') ?></span>

														</td>

														<td>

															<?php if(!empty($operator->paneller)): ?>

																<div class="panel-list">

																	<?php foreach($operator->paneller as $panel): ?>

																		<div class="panel-item mb-2 p-2 border rounded">

																			<small>

																				<strong>Link:</strong> 

																				<a href="<?= htmlspecialchars($panel->panel_link) ?>" target="_blank" class="text-primary">

																					<?= htmlspecialchars($panel->panel_link) ?>

																				</a><br>

																				<?php if($panel->panel_kullanici_adi): ?>

																					<strong>Kullanıcı:</strong> <?= htmlspecialchars($panel->panel_kullanici_adi) ?><br>

																				<?php endif; ?>

																				<?php if($panel->panel_sifre): ?>

																					<strong>Şifre:</strong> <span class="text-muted"><?= htmlspecialchars($panel->panel_sifre) ?></span>

																				<?php endif; ?>

																				<div class="mt-1">

																					<button type="button" class="btn btn-sm btn-outline-warning" onclick="panelDuzenle(<?= $panel->panel_id ?>, <?= $operator->operator_id ?>, '<?= addslashes($panel->panel_link) ?>', '<?= addslashes($panel->panel_kullanici_adi) ?>', '<?= addslashes($panel->panel_sifre) ?>')">

																						<i class="fa fa-edit"></i>

																					</button>

																					<button type="button" class="btn btn-sm btn-outline-danger" onclick="panelSil(<?= $panel->panel_id ?>)">

																						<i class="fa fa-trash"></i>

																					</button>

																				</div>

																			</small>

																		</div>

																	<?php endforeach; ?>

																</div>

															<?php else: ?>

																<span class="text-muted">Panel tanımlanmamış</span>

															<?php endif; ?>

														</td>

														<td>

															<div class="btn-group-vertical btn-group-sm">

																<button type="button" class="btn btn-info btn-sm mb-1" onclick="panelEkle(<?= $operator->operator_id ?>, '<?= addslashes($operator->operator_adi) ?>')">

																	<i class="fa fa-plus"></i> Panel

																</button>

																<button type="button" class="btn btn-warning btn-sm mb-1" onclick="operatorDuzenle(<?= $operator->operator_id ?>, '<?= addslashes($operator->operator_adi) ?>', '<?= addslashes($operator->aciklama) ?>')">

																	<i class="fa fa-edit"></i> Düzenle

																</button>

																<button type="button" class="btn btn-danger btn-sm" onclick="operatorSil(<?= $operator->operator_id ?>, '<?= addslashes($operator->operator_adi) ?>')">

																	<i class="fa fa-trash"></i> Sil

																</button>

															</div>

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

			</div>

		</div>

		<!-- /Page Wrapper -->

	

	</div>

	<!-- /Main Wrapper -->



	<!-- Operatör Düzenleme Modal -->

	<div class="modal fade" id="editOperatorModal" tabindex="-1" role="dialog">

		<div class="modal-dialog" role="document">

			<div class="modal-content">

				<div class="modal-header">

					<h4 class="modal-title">

						<i class="fa fa-edit"></i> Operatör Düzenle

					</h4>

					<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<form id="editOperatorForm">

					<div class="modal-body">

						<input type="hidden" id="edit_operator_id" name="operator_id">

						<div class="form-group">

							<label for="edit_operator_adi">Operatör Adı <span class="text-danger">*</span></label>

							<input type="text" class="form-control" id="edit_operator_adi" name="operator_adi" required>

						</div>

						<div class="form-group">

							<label for="edit_aciklama">Açıklama</label>

							<input type="text" class="form-control" id="edit_aciklama" name="aciklama">

						</div>

					</div>

					<div class="modal-footer">

						<button type="submit" class="btn btn-primary">

							<i class="fa fa-save"></i> Güncelle

						</button>

						<button type="button" class="btn btn-secondary" data-dismiss="modal">

							<i class="fa fa-times"></i> İptal

						</button>

					</div>

				</form>

			</div>

		</div>

	</div>



	<!-- Panel Ekleme Modal -->

	<div class="modal fade" id="addPanelModal" tabindex="-1" role="dialog">

		<div class="modal-dialog" role="document">

			<div class="modal-content">

				<div class="modal-header">

					<h4 class="modal-title">

						<i class="fa fa-plus"></i> Panel Ekle

					</h4>

					<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<form id="addPanelForm">

					<div class="modal-body">

						<input type="hidden" id="add_panel_operator_id" name="operator_id">

						<div class="form-group">

							<label>Operatör</label>

							<input type="text" class="form-control" id="add_panel_operator_adi" readonly>

						</div>

						<div class="form-group">

							<label for="add_panel_link">Panel Linki <span class="text-danger">*</span></label>

							<input type="url" class="form-control" id="add_panel_link" name="panel_link" placeholder="https://panel.example.com" required>

						</div>

						<div class="form-group">

							<label for="add_panel_kullanici_adi">Kullanıcı Adı</label>

							<input type="text" class="form-control" id="add_panel_kullanici_adi" name="panel_kullanici_adi">

						</div>

						<div class="form-group">

							<label for="add_panel_sifre">Şifre</label>

							<input type="text" class="form-control" id="add_panel_sifre" name="panel_sifre" autocomplete="new-password">

						</div>

					</div>

					<div class="modal-footer">

						<button type="submit" class="btn btn-primary">

							<i class="fa fa-save"></i> Panel Ekle

						</button>

						<button type="button" class="btn btn-secondary" data-dismiss="modal">

							<i class="fa fa-times"></i> İptal

						</button>

					</div>

				</form>

			</div>

		</div>

	</div>



	<!-- Panel Düzenleme Modal -->

	<div class="modal fade" id="editPanelModal" tabindex="-1" role="dialog">

		<div class="modal-dialog" role="document">

			<div class="modal-content">

				<div class="modal-header">

					<h4 class="modal-title">

						<i class="fa fa-edit"></i> Panel Düzenle

					</h4>

					<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<form id="editPanelForm">

					<div class="modal-body">

						<input type="hidden" id="edit_panel_id" name="panel_id">

						<div class="form-group">

							<label for="edit_panel_link">Panel Linki <span class="text-danger">*</span></label>

							<input type="url" class="form-control" id="edit_panel_link" name="panel_link" required>

						</div>

						<div class="form-group">

							<label for="edit_panel_kullanici_adi">Kullanıcı Adı</label>

							<input type="text" class="form-control" id="edit_panel_kullanici_adi" name="panel_kullanici_adi">

						</div>

						<div class="form-group">

							<label for="edit_panel_sifre">Şifre</label>

							<input type="text" class="form-control" id="edit_panel_sifre" name="panel_sifre" autocomplete="new-password">

						</div>

					</div>

					<div class="modal-footer">

						<button type="submit" class="btn btn-primary">

							<i class="fa fa-save"></i> Panel Güncelle

						</button>

						<button type="button" class="btn btn-secondary" data-dismiss="modal">

							<i class="fa fa-times"></i> İptal

						</button>

					</div>

				</form>

			</div>

		</div>

	</div>



	<?php $this->load->view("include/footer-js"); ?>



	<script>

	$(document).ready(function() {

		// Operatör ekleme formu

		$('#operatorForm').on('submit', function(e) {

			e.preventDefault();

			

			var formData = $(this).serialize();

			

			$.ajax({

				url: '<?= base_url("voip/operator_ekle") ?>',

				type: 'POST',

				data: formData,

				dataType: 'json',

				beforeSend: function() {

					$('#operatorForm button[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Kaydediliyor...');

				},

				success: function(response) {

					if(response.success) {

						showAlert('success', response.message);

						$('#operatorForm')[0].reset();

						setTimeout(function() {

							location.reload();

						}, 1500);

					} else {

						showAlert('danger', response.message);

					}

				},

				error: function() {

					showAlert('danger', 'Bir hata oluştu. Lütfen tekrar deneyin.');

				},

				complete: function() {

					$('#operatorForm button[type="submit"]').prop('disabled', false).html('<i class="fa fa-save"></i> Operatör Ekle');

				}

			});

		});



		// Operatör düzenleme formu

		$('#editOperatorForm').on('submit', function(e) {

			e.preventDefault();

			

			var formData = $(this).serialize();

			

			$.ajax({

				url: '<?= base_url("voip/operator_guncelle") ?>',

				type: 'POST',

				data: formData,

				dataType: 'json',

				beforeSend: function() {

					$('#editOperatorForm button[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Güncelleniyor...');

				},

				success: function(response) {

					if(response.success) {

						$('#editOperatorModal').modal('hide');

						showAlert('success', response.message);

						setTimeout(function() {

							location.reload();

						}, 1500);

					} else {

						showAlert('danger', response.message);

					}

				},

				error: function() {

					showAlert('danger', 'Bir hata oluştu. Lütfen tekrar deneyin.');

				},

				complete: function() {

					$('#editOperatorForm button[type="submit"]').prop('disabled', false).html('<i class="fa fa-save"></i> Güncelle');

				}

			});

		});



		// Panel ekleme formu

		$('#addPanelForm').on('submit', function(e) {

			e.preventDefault();

			

			var formData = $(this).serialize();

			

			$.ajax({

				url: '<?= base_url("voip/panel_ekle") ?>',

				type: 'POST',

				data: formData,

				dataType: 'json',

				beforeSend: function() {

					$('#addPanelForm button[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Kaydediliyor...');

				},

				success: function(response) {

					if(response.success) {

						$('#addPanelModal').modal('hide');

						showAlert('success', response.message);

						setTimeout(function() {

							location.reload();

						}, 1500);

					} else {

						showAlert('danger', response.message);

					}

				},

				error: function() {

					showAlert('danger', 'Bir hata oluştu. Lütfen tekrar deneyin.');

				},

				complete: function() {

					$('#addPanelForm button[type="submit"]').prop('disabled', false).html('<i class="fa fa-save"></i> Panel Ekle');

				}

			});

		});



		// Panel düzenleme formu

		$('#editPanelForm').on('submit', function(e) {

			e.preventDefault();

			

			var formData = $(this).serialize();

			

			$.ajax({

				url: '<?= base_url("voip/panel_guncelle") ?>',

				type: 'POST',

				data: formData,

				dataType: 'json',

				beforeSend: function() {

					$('#editPanelForm button[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Güncelleniyor...');

				},

				success: function(response) {

					if(response.success) {

						$('#editPanelModal').modal('hide');

						showAlert('success', response.message);

						setTimeout(function() {

							location.reload();

						}, 1500);

					} else {

						showAlert('danger', response.message);

					}

				},

				error: function() {

					showAlert('danger', 'Bir hata oluştu. Lütfen tekrar deneyin.');

				},

				complete: function() {

					$('#editPanelForm button[type="submit"]').prop('disabled', false).html('<i class="fa fa-save"></i> Panel Güncelle');

				}

			});

		});

	});



	function operatorDuzenle(id, adi, aciklama) {

		$('#edit_operator_id').val(id);

		$('#edit_operator_adi').val(adi);

		$('#edit_aciklama').val(aciklama);

		$('#editOperatorModal').modal('show');

	}



	function operatorSil(id, adi) {

		if(confirm('"' + adi + '" operatörünü silmek istediğinizden emin misiniz?')) {

			$.ajax({

				url: '<?= base_url("voip/operator_sil") ?>',

				type: 'POST',

				data: { operator_id: id },

				dataType: 'json',

				success: function(response) {

					if(response.success) {

						showAlert('success', response.message);

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

		}

	}



	function panelEkle(operatorId, operatorAdi) {

		$('#add_panel_operator_id').val(operatorId);

		$('#add_panel_operator_adi').val(operatorAdi);

		$('#add_panel_link').val('');

		$('#add_panel_kullanici_adi').val('');

		$('#add_panel_sifre').val('');

		$('#addPanelModal').modal('show');

	}



	function panelDuzenle(panelId, operatorId, panelLink, kullaniciAdi, sifre) {

		$('#edit_panel_id').val(panelId);

		$('#edit_panel_link').val(panelLink);

		$('#edit_panel_kullanici_adi').val(kullaniciAdi);

		$('#edit_panel_sifre').val(sifre);

		$('#editPanelModal').modal('show');

	}



	function panelSil(panelId) {

		if(confirm('Bu paneli silmek istediğinizden emin misiniz?')) {

			$.ajax({

				url: '<?= base_url("voip/panel_sil") ?>',

				type: 'POST',

				data: { panel_id: panelId },

				dataType: 'json',

				success: function(response) {

					if(response.success) {

						showAlert('success', response.message);

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

		}

	}



	function showAlert(type, message) {

		var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';

		var alertIcon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';

		

		var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +

			'<i class="fa ' + alertIcon + '"></i> ' + message +

			'<button type="button" class="close" data-dismiss="alert">' +

				'<span>&times;</span>' +

			'</button>' +

		'</div>';

		

		$('#alertContainer').html(alertHtml);

		

		setTimeout(function() {

			$('#alertContainer .alert').fadeOut();

		}, 5000);

	}

	</script>

