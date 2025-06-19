<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<title>Tahsilat Detayı | İlekaSoft CRM</title>
	<link rel="icon" type="image/x-icon" href="<?= base_url('assets/favicon.ico'); ?>" />
	
	<style>
		.detay-card {
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
			border-radius: 10px;
		}
		
		.detay-header {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			border-radius: 10px 10px 0 0;
		}
		
		.tutar-vurgu {
			font-size: 2rem;
			font-weight: bold;
			color: #28a745;
		}
		
		.durum-badge {
			font-size: 1rem;
			padding: 0.5rem 1rem;
		}
		
		.info-row {
			border-bottom: 1px solid #eee;
			padding: 1rem 0;
		}
		
		.info-row:last-child {
			border-bottom: none;
		}
		
		.info-label {
			font-weight: 600;
			color: #6c757d;
		}
		
		.info-value {
			font-weight: 500;
			color: #495057;
		}
	</style>
</head>
<body>
<div class="main-wrapper">
	<?php $this->load->view("include/header"); ?>
	<?php $this->load->view("include/sidebar"); ?>
	<div class="page-wrapper">
		<div class="content container-fluid">
			<!-- Page Header -->
			<div class="page-header">
				<div class="row">
					<div class="col-sm-10">
						<h3 class="page-title">Tahsilat Detayı</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
							<li class="breadcrumb-item"><a href="<?= base_url('muhase/onay-bekleyen-tahsilatlar'); ?>">Onay Bekleyen Tahsilatlar</a></li>
							<li class="breadcrumb-item active">Tahsilat Detayı</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="<?= base_url('muhase/onay-bekleyen-tahsilatlar'); ?>">
							<i class="fa fa-arrow-left"></i> <br>Geri Dön
						</a>
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			<div class="row">
				<div class="col-lg-8">
					<!-- Ana Detay Kartı -->
					<div class="card detay-card">
						<div class="card-header detay-header">
							<h4 class="card-title mb-0">
								<i class="fa fa-money mr-2"></i>Tahsilat Bilgileri
							</h4>
						</div>
						<div class="card-body">
							<div class="row info-row">
								<div class="col-sm-4 info-label">Tahsilat Tutarı:</div>
								<div class="col-sm-8">
									<span class="tutar-vurgu"><?= number_format($tahsilat->tahsilat_tutar, 2, ',', '.') ?> ₺</span>
								</div>
							</div>
							
							<div class="row info-row">
								<div class="col-sm-4 info-label">Tahsilat Tarihi:</div>
								<div class="col-sm-8 info-value">
									<i class="fa fa-calendar mr-2"></i>
									<?= date('d.m.Y H:i', strtotime($tahsilat->tahsilat_tarihi)) ?>
								</div>
							</div>
							
							<div class="row info-row">
								<div class="col-sm-4 info-label">Tahsilat Türü:</div>
								<div class="col-sm-8 info-value">
									<?php 
									$turler = array(
										'1' => 'Nakit',
										'2' => 'Kredi Kartı',
										'3' => 'Banka Transferi',
										'4' => 'Çek',
										'5' => 'Senet'
									);
									echo $turler[$tahsilat->tahsilat_turu] ?: 'Belirtilmemiş';
									?>
								</div>
							</div>
							
							<?php if($tahsilat->tahsilat_aciklama): ?>
							<div class="row info-row">
								<div class="col-sm-4 info-label">Açıklama:</div>
								<div class="col-sm-8 info-value">
									<?= nl2br(htmlspecialchars($tahsilat->tahsilat_aciklama)) ?>
								</div>
							</div>
							<?php endif; ?>
							
							<?php if($tahsilat->tahsilat_referans_no): ?>
							<div class="row info-row">
								<div class="col-sm-4 info-label">Referans No:</div>
								<div class="col-sm-8 info-value">
									<code><?= $tahsilat->tahsilat_referans_no ?></code>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
					
					<!-- Onay İşlemleri -->
					<?php if($tahsilat->tahsilat_onay_durumu == 0): ?>
					<div class="card mt-4">
						<div class="card-header bg-warning text-dark">
							<h5 class="card-title mb-0">
								<i class="fa fa-exclamation-triangle mr-2"></i>Onay İşlemleri
							</h5>
						</div>
						<div class="card-body text-center">
							<p class="mb-4">Bu tahsilat henüz onaylanmamış durumda. Onaylama veya reddetme işlemi yapabilirsiniz.</p>
							<div class="btn-group" role="group">
								<button type="button" 
										class="btn btn-success btn-lg mr-3"
										onclick="onayModal('<?= $tahsilat->tahsilat_id ?>', '<?= $tahsilat->cari_ad ?>', '<?= number_format($tahsilat->tahsilat_tutar, 2, ',', '.') ?>')">
									<i class="fa fa-check mr-2"></i>Onayla
								</button>
								<button type="button" 
										class="btn btn-danger btn-lg"
										onclick="redModal('<?= $tahsilat->tahsilat_id ?>', '<?= $tahsilat->cari_ad ?>', '<?= number_format($tahsilat->tahsilat_tutar, 2, ',', '.') ?>')">
									<i class="fa fa-times mr-2"></i>Reddet
								</button>
							</div>
						</div>
					</div>
					<?php endif; ?>
				</div>
				
				<div class="col-lg-4">
					<!-- Cari Bilgileri -->
					<div class="card detay-card">
						<div class="card-header bg-info text-white">
							<h5 class="card-title mb-0">
								<i class="fa fa-user mr-2"></i>Cari Bilgileri
							</h5>
						</div>
						<div class="card-body">
							<div class="info-row">
								<div class="info-label">Cari Adı:</div>
								<div class="info-value mt-1">
									<strong><?= $tahsilat->cari_ad ?></strong>
								</div>
							</div>
							
							<div class="info-row">
								<div class="info-label">Cari Kodu:</div>
								<div class="info-value mt-1">
									<code><?= $tahsilat->cari_kodu ?></code>
								</div>
							</div>
							
							<?php if($tahsilat->cari_telefon): ?>
							<div class="info-row">
								<div class="info-label">Telefon:</div>
								<div class="info-value mt-1">
									<i class="fa fa-phone mr-2"></i><?= $tahsilat->cari_telefon ?>
								</div>
							</div>
							<?php endif; ?>
							
							<div class="text-center mt-3">
								<a href="<?= base_url('cari/cari-karti-duzenle/'.$tahsilat->tahsilat_cari_id) ?>" 
								   class="btn btn-outline-info btn-sm">
									<i class="fa fa-external-link mr-2"></i>Cari Kartını Görüntüle
								</a>
							</div>
						</div>
					</div>
					
					<!-- Durum Bilgisi -->
					<div class="card mt-4">
						<div class="card-header">
							<h5 class="card-title mb-0">
								<i class="fa fa-info-circle mr-2"></i>Durum Bilgisi
							</h5>
						</div>
						<div class="card-body text-center">
							<?php if($tahsilat->tahsilat_onay_durumu == 0): ?>
								<span class="badge badge-warning durum-badge">
									<i class="fa fa-clock-o mr-2"></i>Onay Bekliyor
								</span>
							<?php elseif($tahsilat->tahsilat_onay_durumu == 1): ?>
								<span class="badge badge-success durum-badge">
									<i class="fa fa-check mr-2"></i>Onaylandı
								</span>
								<?php if($tahsilat->onaylayan_adi): ?>
								<div class="mt-3">
									<small class="text-muted">
										<strong>Onaylayan:</strong> <?= $tahsilat->onaylayan_adi ?><br>
										<strong>Onay Tarihi:</strong> <?= date('d.m.Y H:i', strtotime($tahsilat->tahsilat_onay_tarihi)) ?>
									</small>
								</div>
								<?php endif; ?>
							<?php elseif($tahsilat->tahsilat_onay_durumu == 2): ?>
								<span class="badge badge-danger durum-badge">
									<i class="fa fa-times mr-2"></i>Reddedildi
								</span>
								<?php if($tahsilat->onaylayan_adi): ?>
								<div class="mt-3">
									<small class="text-muted">
										<strong>Reddeden:</strong> <?= $tahsilat->onaylayan_adi ?><br>
										<strong>Red Tarihi:</strong> <?= date('d.m.Y H:i', strtotime($tahsilat->tahsilat_onay_tarihi)) ?>
									</small>
								</div>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
					
					<!-- Oluşturan Bilgisi -->
					<div class="card mt-4">
						<div class="card-header">
							<h5 class="card-title mb-0">
								<i class="fa fa-user-plus mr-2"></i>Oluşturan
							</h5>
						</div>
						<div class="card-body">
							<div class="text-center">
								<i class="fa fa-user-circle text-primary" style="font-size: 2rem;"></i>
								<div class="mt-2">
									<strong><?= $tahsilat->olusturan_adi ?></strong>
								</div>
								<small class="text-muted">
									<?= date('d.m.Y H:i', strtotime($tahsilat->tahsilat_olusturma_tarihi)) ?>
								</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Onay Modalı -->
<div class="modal fade" id="onayModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-success text-white">
				<h5 class="modal-title">
					<i class="fa fa-check-circle mr-2"></i>Tahsilat Onayı
				</h5>
				<button type="button" class="close text-white" data-dismiss="modal">
					<span>&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="text-center">
					<i class="fa fa-question-circle text-warning" style="font-size: 3rem; margin-bottom: 1rem;"></i>
					<h5>Bu tahsilatı onaylamak istediğinizden emin misiniz?</h5>
					<div class="alert alert-info mt-3">
						<strong>Cari:</strong> <span id="onay-cari-ad"></span><br>
						<strong>Tutar:</strong> <span id="onay-tutar"></span> ₺
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
				<a href="#" id="onay-link" class="btn btn-success">
					<i class="fa fa-check mr-2"></i>Evet, Onayla
				</a>
			</div>
		</div>
	</div>
</div>

<!-- Red Modalı -->
<div class="modal fade" id="redModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h5 class="modal-title">
					<i class="fa fa-times-circle mr-2"></i>Tahsilat Reddi
				</h5>
				<button type="button" class="close text-white" data-dismiss="modal">
					<span>&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="text-center">
					<i class="fa fa-exclamation-triangle text-danger" style="font-size: 3rem; margin-bottom: 1rem;"></i>
					<h5>Bu tahsilatı reddetmek istediğinizden emin misiniz?</h5>
					<div class="alert alert-warning mt-3">
						<strong>Cari:</strong> <span id="red-cari-ad"></span><br>
						<strong>Tutar:</strong> <span id="red-tutar"></span> ₺
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
				<a href="#" id="red-link" class="btn btn-danger">
					<i class="fa fa-times mr-2"></i>Evet, Reddet
				</a>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view("include/footer-js"); ?>

<script>
function onayModal(tahsilat_id, cari_ad, tutar) {
	$('#onay-cari-ad').text(cari_ad);
	$('#onay-tutar').text(tutar);
	$('#onay-link').attr('href', '<?= base_url("muhase/tahsilat-onay/") ?>' + tahsilat_id);
	$('#onayModal').modal('show');
}

function redModal(tahsilat_id, cari_ad, tutar) {
	$('#red-cari-ad').text(cari_ad);
	$('#red-tutar').text(tutar);
	$('#red-link').attr('href', '<?= base_url("muhase/tahsilat-red/") ?>' + tahsilat_id);
	$('#redModal').modal('show');
}
</script>

</body>
</html>
