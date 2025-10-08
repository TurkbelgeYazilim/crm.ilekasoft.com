<?php 
$this->load->view('include/header'); 
$this->load->view('include/sidebar'); 
?>

<style>
	.card {
		border: none;
		border-radius: 0.5rem;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		margin-bottom: 20px;
	}
	
	.card-header {
		background-color: #f8f9fa;
		border-bottom: 1px solid #dee2e6;
		font-weight: 600;
		color: #495057;
		padding: 1rem 1.25rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.card-body {
		padding: 1.25rem;
	}
	
	.btn {
		border-radius: 0.375rem;
		font-weight: 500;
	}
	
	.btn-primary {
		background-color: #007bff;
		border-color: #007bff;
	}
	
	.btn-success {
		background-color: #28a745;
		border-color: #28a745;
	}
	
	.btn-warning {
		background-color: #ffc107;
		border-color: #ffc107;
		color: #212529;
	}
	
	.btn-danger {
		background-color: #dc3545;
		border-color: #dc3545;
	}
	
	.table {
		margin-bottom: 0;
	}
	
	.table th {
		border-top: none;
		font-weight: 600;
		color: #495057;
		background-color: #f8f9fa;
	}
	
	.table td {
		vertical-align: middle;
	}
	
	.form-control {
		border-radius: 0.375rem;
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
	
	.badge-info {
		background-color: #17a2b8;
	}
	
	.text-truncate {
		max-width: 200px;
	}
	
	.action-buttons {
		white-space: nowrap;
	}
	
	.modal-header {
		background-color: #f8f9fa;
		border-bottom: 1px solid #dee2e6;
	}
	
	.modal-title {
		font-weight: 600;
		color: #495057;
	}
	
	.form-group {
		margin-bottom: 1rem;
	}
	
	.form-group label {
		font-weight: 500;
		color: #495057;
		margin-bottom: 0.5rem;
	}
	
	.text-muted {
		color: #6c757d !important;
	}
	
	.text-primary {
		color: #007bff !important;
	}
</style>

<div class="page-wrapper">
	<div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title"><?= $baslik; ?></h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('voip/operator-tanimla'); ?>">VoIP & Hakediş</a></li>
						<li class="breadcrumb-item active">Numara Tanımla</li>
					</ul>
				</div>
				<div class="col-auto">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#numaraEkleModal">
						<i class="fas fa-plus"></i> Yeni Numara Ekle
					</button>
				</div>
			</div>
		</div>

		<!-- İstatistikler -->
		<div class="row">
			<div class="col-xl-3 col-sm-6 col-12">
				<div class="card">
					<div class="card-body">
						<div class="dash-widget-header">
							<span class="dash-widget-icon text-primary">
								<i class="fas fa-phone"></i>
							</span>
							<div class="dash-count">
								<h3><?= count($numaralar); ?></h3>
							</div>
						</div>
						<div class="dash-widget-info">
							<h6 class="text-muted">Toplam Numara</h6>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 col-12">
				<div class="card">
					<div class="card-body">
						<div class="dash-widget-header">
							<span class="dash-widget-icon text-success">
								<i class="fas fa-user-tie"></i>
							</span>
							<div class="dash-count">
								<h3><?= count($operatorler); ?></h3>
							</div>
						</div>
						<div class="dash-widget-info">
							<h6 class="text-muted">Toplam Operatör</h6>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 col-12">
				<div class="card">
					<div class="card-body">
						<div class="dash-widget-header">
							<span class="dash-widget-icon text-warning">
								<i class="fas fa-network-wired"></i>
							</span>
							<div class="dash-count">
								<h3><?= count(array_filter($numaralar, function($n) { return !empty($n->ip_adresi); })); ?></h3>
							</div>
						</div>
						<div class="dash-widget-info">
							<h6 class="text-muted">IP Tanımlı</h6>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 col-12">
				<div class="card">
					<div class="card-body">
						<div class="dash-widget-header">
							<span class="dash-widget-icon text-info">
								<i class="fas fa-key"></i>
							</span>
							<div class="dash-count">
								<h3><?= count(array_filter($numaralar, function($n) { return !empty($n->kullanici_adi); })); ?></h3>
							</div>
						</div>
						<div class="dash-widget-info">
							<h6 class="text-muted">Kimlik Tanımlı</h6>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Numara Listesi -->
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5 class="card-title mb-0">
					<i class="fas fa-list"></i> Numara Listesi
				</h5>
				<span class="badge badge-primary"><?= count($numaralar); ?> Numara</span>
			</div>
			<div class="card-body">
				<div id="mesaj"></div>
				
				<?php if(empty($numaralar)): ?>
				<div class="text-center py-5">
					<i class="fas fa-phone fa-3x text-muted mb-3"></i>
					<h5 class="text-muted">Henüz numara tanımlanmamış</h5>
					<p class="text-muted">İlk numaranızı eklemek için "Yeni Numara Ekle" butonunu kullanın.</p>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#numaraEkleModal">
						<i class="fas fa-plus"></i> İlk Numarayı Ekle
					</button>
				</div>
				<?php else: ?>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Numara</th>
								<th>Operatör</th>
								<th>Kullanıcı Adı</th>
								<th>IP Adresi</th>
								<th>İşlemler</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($numaralar as $index => $numara): ?>
							<tr>
								<td><?= $index + 1; ?></td>
								<td>
									<strong class="text-primary"><?= htmlspecialchars($numara->voip_numara); ?></strong>
								</td>
								<td>
									<span class="badge badge-info">
										<?= htmlspecialchars($numara->operator_adi ?: 'Belirtilmemiş'); ?>
									</span>
								</td>
								<td>
									<?php if(!empty($numara->kullanici_adi)): ?>
										<span class="text-success"><?= htmlspecialchars($numara->kullanici_adi); ?></span>
									<?php else: ?>
										<span class="text-muted">-</span>
									<?php endif; ?>
								</td>
								<td>
									<?php if(!empty($numara->ip_adresi)): ?>
										<code><?= htmlspecialchars($numara->ip_adresi); ?></code>
									<?php else: ?>
										<span class="text-muted">-</span>
									<?php endif; ?>
								</td>
								<td class="action-buttons">
									<button type="button" class="btn btn-sm btn-warning" onclick="numaraDuzenle(<?= $numara->numara_id; ?>)">
										<i class="fas fa-edit"></i>
									</button>
									<button type="button" class="btn btn-sm btn-danger" onclick="numaraSil(<?= $numara->numara_id; ?>, '<?= htmlspecialchars($numara->voip_numara); ?>')">
										<i class="fas fa-trash"></i>
									</button>
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

<!-- Numara Ekle Modal -->
<div class="modal fade" id="numaraEkleModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					<i class="fas fa-plus"></i> Yeni Numara Ekle
				</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
			</div>
			<form id="numaraEkleForm">
				<div class="modal-body">
					<div class="form-group">
						<label>Operatör <span class="text-danger">*</span></label>
						<select name="operator_id" class="form-control" required>
							<option value="">Operatör Seçin</option>
							<?php foreach($operatorler as $operator): ?>
							<option value="<?= $operator->operator_id; ?>">
								<?= htmlspecialchars($operator->operator_adi); ?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label>VoIP Numara <span class="text-danger">*</span></label>
						<input type="text" name="voip_numara" class="form-control" placeholder="Örn: +905551234567" required>
						<small class="form-text text-muted">Numarayı tam format olarak girin</small>
					</div>
					<div class="form-group">
						<label>Kullanıcı Adı</label>
						<input type="text" name="kullanici_adi" class="form-control" placeholder="Panel kullanıcı adı" autocomplete="username">
					</div>
					<div class="form-group">
						<label>Şifre</label>
						<input type="password" name="sifre" class="form-control" placeholder="Panel şifresi" autocomplete="new-password">
					</div>
					<div class="form-group">
						<label>IP Adresi</label>
						<input type="text" name="ip_adresi" class="form-control" placeholder="Örn: 192.168.1.100">
						<small class="form-text text-muted">Opsiyonel: VoIP cihazının IP adresi</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
					<button type="submit" class="btn btn-primary">
						<i class="fas fa-save"></i> Kaydet
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Numara Düzenle Modal -->
<div class="modal fade" id="numaraDuzenleModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					<i class="fas fa-edit"></i> Numara Düzenle
				</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
			</div>
			<form id="numaraDuzenleForm">
				<input type="hidden" name="numara_id" id="edit_numara_id">
				<div class="modal-body">
					<div class="form-group">
						<label>Operatör <span class="text-danger">*</span></label>
						<select name="operator_id" id="edit_operator_id" class="form-control" required>
							<option value="">Operatör Seçin</option>
							<?php foreach($operatorler as $operator): ?>
							<option value="<?= $operator->operator_id; ?>">
								<?= htmlspecialchars($operator->operator_adi); ?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label>VoIP Numara <span class="text-danger">*</span></label>
						<input type="text" name="voip_numara" id="edit_voip_numara" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Kullanıcı Adı</label>
						<input type="text" name="kullanici_adi" id="edit_kullanici_adi" class="form-control" autocomplete="username">
					</div>
					<div class="form-group">
						<label>Şifre</label>
						<input type="password" name="sifre" id="edit_sifre" class="form-control" autocomplete="new-password">
						<small class="form-text text-muted">Boş bırakırsanız mevcut şifre korunur</small>
					</div>
					<div class="form-group">
						<label>IP Adresi</label>
						<input type="text" name="ip_adresi" id="edit_ip_adresi" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
					<button type="submit" class="btn btn-warning">
						<i class="fas fa-save"></i> Güncelle
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $this->load->view('include/footer-js'); ?>

<script>
// Footer-js yüklendikten sonra çalışacak
$(document).ready(function() {
    console.log('Numara tanımla sayfası hazır, jQuery yüklendi');
    
    // Numara Ekle Form Submit
    $('#numaraEkleForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '<?= base_url("voip/numara_ekle"); ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    $('#mesaj').html('<div class="alert alert-success">' + response.message + '</div>');
                    $('#numaraEkleModal').modal('hide');
                    $('#numaraEkleForm')[0].reset();
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    $('#mesaj').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function() {
                $('#mesaj').html('<div class="alert alert-danger">Bir hata oluştu. Lütfen tekrar deneyin.</div>');
            }
        });
    });

    // Numara Düzenle Form Submit
    $('#numaraDuzenleForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '<?= base_url("voip/numara_guncelle"); ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    $('#mesaj').html('<div class="alert alert-success">' + response.message + '</div>');
                    $('#numaraDuzenleModal').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    $('#mesaj').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function() {
                $('#mesaj').html('<div class="alert alert-danger">Bir hata oluştu. Lütfen tekrar deneyin.</div>');
            }
        });
    });
});

// Global fonksiyonlar
function numaraDuzenle(numaraId) {
    $.ajax({
        url: '<?= base_url("voip/numara_getir"); ?>',
        type: 'POST',
        data: { numara_id: numaraId },
        dataType: 'json',
        success: function(numara) {
            if(numara) {
                $('#edit_numara_id').val(numara.numara_id);
                $('#edit_operator_id').val(numara.operator_id);
                $('#edit_voip_numara').val(numara.voip_numara);
                $('#edit_kullanici_adi').val(numara.kullanici_adi);
                $('#edit_sifre').val(''); // Şifreyi boş bırak
                $('#edit_ip_adresi').val(numara.ip_adresi);
                $('#numaraDuzenleModal').modal('show');
            }
        },
        error: function() {
            alert('Numara bilgileri alınamadı.');
        }
    });
}

function numaraSil(numaraId, numaraAdi) {
    if(confirm('Bu numarayı silmek istediğinizden emin misiniz?\n\nNumara: ' + numaraAdi)) {
        $.ajax({
            url: '<?= base_url("voip/numara_sil"); ?>',
            type: 'POST',
            data: { numara_id: numaraId },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    $('#mesaj').html('<div class="alert alert-success">' + response.message + '</div>');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    $('#mesaj').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function() {
                $('#mesaj').html('<div class="alert alert-danger">Bir hata oluştu. Lütfen tekrar deneyin.</div>');
            }
        });
    }
}
</script>
