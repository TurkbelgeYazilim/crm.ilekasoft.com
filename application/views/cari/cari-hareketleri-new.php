<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<title>Müşteri Hareketleri | İlekaSoft CRM</title>
	<link rel="icon" type="image/x-icon" href="<?= base_url('assets/favicon.ico'); ?>" />
	<style>
		/* Mobilde Önceki Sayfa butonunu gizle */
		@media (max-width: 767.98px) {
			.col-sm-2 {
				display: none !important;
			}
		}
		
		.hareket-card {
			border-left: 4px solid #007bff;
			margin-bottom: 1rem;
		}
		
		.hareket-banka { border-left-color: #007bff; }
		.hareket-cek { border-left-color: #17a2b8; }
		.hareket-kasa { border-left-color: #28a745; }
		.hareket-senet { border-left-color: #ffc107; }
		.hareket-satis { border-left-color: #dc3545; }
		
		.tutar-borc {
			color: #dc3545;
			font-weight: bold;
		}
		
		.tutar-alacak {
			color: #28a745;
			font-weight: bold;
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
						<h3 class="page-title">
							<?php if(isset($cariExe)): ?>
								<a href="<?= base_url("cari/cari-karti-duzenle/$cariExe->cari_id"); ?>" target="_blank" style="color:#d92637; text-decoration: underline;">
									<?= $cariExe->cari_ad; ?>
								</a> - Müşteri Hareketleri
							<?php else: ?>
								Müşteri Hareketleri
							<?php endif; ?>
						</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
							<li class="breadcrumb-item"><a href="<?= base_url('cari/cari-listesi'); ?>">Müşteriler</a></li>
							<li class="breadcrumb-item active">Müşteri Hareketleri</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()">
							<i class="fa fa-history"></i> <br>Önceki Sayfa
						</a>
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			<!-- Bakiye Kartı -->
			<?php if(isset($cariExe)): ?>
			<div class="row mb-4">
				<div class="col-12">
					<div class="card">
						<div class="card-body text-center">
							<h4 class="card-title">Müşteri Bakiyesi</h4>
							<h2 class="<?= ($kalan > 0) ? 'text-success' : 'text-danger' ?>">
								<?php
								$kalann = abs($kalan);
								if (filter_var($kalan, FILTER_VALIDATE_FLOAT) && $kalan > 0) {
									echo number_format($kalann, 2) . ' ₺ (Borçlu)';
								} else {
									echo number_format($kalann, 2) . ' ₺ (Alacaklı)';
								}
								?>
							</h2>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<!-- Hareketler Listesi -->
			<div class="row">
				<div class="col-xl-12 col-md-12">
					<div class="card card-table">
						<div class="card-header">
							<div class="row">
								<div class="col">
									<h4 class="card-title">
										<i class="fa fa-list text-primary mr-2"></i>
										Müşteri Hareketleri
									</h4>
								</div>
								<div class="col-auto">
									<button type="button" class="btn btn-primary btn-sm" onclick="location.reload()">
										<i class="fa fa-refresh"></i> Yenile
									</button>
								</div>
							</div>
						</div>

						<?php if (isset($cariHareketleri) && count($cariHareketleri) > 0): ?>
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0">
									<thead>
										<tr>
											<th>Tarih</th>
											<th>Tür</th>
											<th>Borç</th>
											<th>Alacak</th>
											<th>Açıklama</th>
											<th>Görsel</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($cariHareketleri as $ch): ?>
										<tr>
											<td><?= date('d.m.Y', strtotime($ch->Tarih)); ?></td>
											<td>
												<?php
												$icon = '';
												$class = '';
												switch($ch->Tahsilat_Tipi) {
													case 'Banka': $icon = 'fa-university'; $class = 'text-primary'; break;
													case 'Çek': $icon = 'fa-file-text-o'; $class = 'text-info'; break;
													case 'Kasa': $icon = 'fa-money'; $class = 'text-success'; break;
													case 'Senet': $icon = 'fa-file-o'; $class = 'text-warning'; break;
													case 'Satış Faturası': $icon = 'fa-file-invoice'; $class = 'text-danger'; break;
													default: $icon = 'fa-question'; $class = 'text-muted'; break;
												}
												?>
												<i class="fa <?= $icon ?> <?= $class ?> mr-2"></i>
												<span class="<?= $class ?>"><?= $ch->Tahsilat_Tipi ?></span>
											</td>
											<td>
												<?php if($ch->Borc): ?>
													<span class="tutar-borc"><?= number_format($ch->Borc, 2, ',', '.') ?> ₺</span>
												<?php else: ?>
													-
												<?php endif; ?>
											</td>
											<td>
												<?php if($ch->Alacak): ?>
													<span class="tutar-alacak"><?= number_format($ch->Alacak, 2, ',', '.') ?> ₺</span>
												<?php else: ?>
													-
												<?php endif; ?>
											</td>
											<td>
												<?php if($ch->Aciklama): ?>
													<?= substr($ch->Aciklama, 0, 50) ?>
													<?= strlen($ch->Aciklama) > 50 ? '...' : '' ?>
												<?php else: ?>
													<span class="text-muted">-</span>
												<?php endif; ?>
											</td>
											<td>
												<?php if($ch->Gorsel): ?>
													<button type="button" class="btn btn-sm btn-outline-info gorsel-btn" 
															data-tip="<?= $ch->Tahsilat_Tipi ?>"
															data-gorsel="<?= $ch->Gorsel ?>"
															data-tablo="<?= $ch->tablo ?>">
														<i class="fa fa-image"></i> Görsel
													</button>
												<?php else: ?>
													<span class="text-muted">-</span>
												<?php endif; ?>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						<?php else: ?>
							<div class="text-center py-5">
								<i class="fa fa-list text-muted" style="font-size: 4rem; margin-bottom: 1rem;"></i>
								<h4>Henüz hareket kaydı bulunmuyor.</h4>
								<p class="text-muted">Bu müşteri için henüz hiçbir hareket kaydı bulunmamaktadır.</p>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Görsel Modal -->
<div id="gorselModal" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Hareket Görseli</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<div id="gorselIcerik">
					<!-- Görsel buraya yüklenecek -->
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view("include/footer-js"); ?>

<script>
$(document).ready(function() {
	// Görsel butonuna tıklandığında
	$('.gorsel-btn').on('click', function() {
		var tip = $(this).data('tip');
		var gorsel = $(this).data('gorsel');
		var tablo = $(this).data('tablo');
		
		// Görsel URL'sini belirle
		var gorsel_url = '';
		switch(tablo) {
			case 'banka':
				gorsel_url = '<?= base_url('assets/uploads/dekontlar/') ?>' + gorsel;
				break;
			case 'cek':
				gorsel_url = '<?= base_url('assets/uploads/cekler/') ?>' + gorsel;
				break;
			case 'senet':
				gorsel_url = '<?= base_url('assets/uploads/senetler/') ?>' + gorsel;
				break;
			case 'satis':
				gorsel_url = '<?= base_url('assets/uploads/faturalar/') ?>' + gorsel;
				break;
			default:
				gorsel_url = '<?= base_url('assets/uploads/') ?>' + gorsel;
				break;
		}
		
		// Modal içeriğini güncelle
		var noImageUrl = '<?= base_url('assets/img/no-image.png') ?>';
		$('#gorselIcerik').html('<img src="' + gorsel_url + '" class="img-fluid" style="max-width: 100%; height: auto;" onerror="this.src=\'' + noImageUrl + '\'; this.alt=\'Görsel yüklenemedi\';">');
		
		// Modal'ı göster
		$('#gorselModal').modal('show');
	});
});
</script>

</body>
</html>
