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

	.stats-card {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		border-radius: 0.5rem;
		padding: 1.5rem;
		margin-bottom: 1rem;
	}

	.stats-number {
		font-size: 2rem;
		font-weight: bold;
		margin-bottom: 0.5rem;
	}

	.stats-label {
		font-size: 0.9rem;
		opacity: 0.9;
	}
	</style>
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<?php $this->load->view("include/sidebar"); ?>
			<?php $this->load->view("include/header"); ?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3><?= $h1 ?></h3>
						</div>
					</div>

					<div class="clearfix"></div>

					<div class="row">
						<div class="col-md-12 col-sm-12">
							
							<!-- Genel İstatistikler -->
							<div class="row">
								<div class="col-md-12">
									<div class="stats-card">
										<div class="stats-number"><?= number_format($genel_toplam->genel_toplam) ?></div>
										<div class="stats-label">Toplam Tamamlanan Talep (Filtreye Göre)</div>
									</div>
								</div>
							</div>

							<!-- Filtreleme Formu -->
							<div class="card filter-card">
								<div class="card-header">
									<i class="fa fa-filter"></i> Filtreleme Seçenekleri
								</div>
								<div class="card-body">
									<form method="GET" action="<?= base_url('voip/hakedis-bayi-hesapla') ?>" class="row">
										<div class="col-md-5">
											<label for="hakedis_donemi" class="form-label">Hakediş Dönemi</label>
											<select class="form-control" id="hakedis_donemi" name="hakedis_donemi">
												<option value="">Tüm Dönemler</option>
												<?php foreach($hakedis_donemleri as $donem): ?>
													<option value="<?= $donem['key'] ?>" <?= ($filters['hakedis_donemi'] == $donem['key']) ? 'selected' : '' ?>>
														<?= $donem['label'] ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-md-5">
											<label for="talebi_giren_personel_altbayi" class="form-label">Alt Bayi</label>
											<input type="text" class="form-control" id="talebi_giren_personel_altbayi" 
												   name="talebi_giren_personel_altbayi" placeholder="Alt bayi arayın..."
												   value="<?= $filters['talebi_giren_personel_altbayi'] ?>">
										</div>
										<div class="col-md-2">
											<label class="form-label">&nbsp;</label>
											<div>
												<button type="submit" class="btn btn-primary">
													<i class="fa fa-search"></i> Filtrele
												</button>
												<a href="<?= base_url('voip/hakedis-bayi-hesapla') ?>" class="btn btn-secondary">
													<i class="fa fa-refresh"></i> Temizle
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>

							<!-- Hakediş Bayi Hesaplama Tablosu -->
							<div class="card">
								<div class="card-header">
									<i class="fa fa-calculator"></i> Hakediş Bayi Hesaplama Sonuçları
									<small class="text-muted">(SATIS_DURUMU = 'Tamamlandı' olanlar)</small>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>Sıra</th>
													<th>Bayi</th>
													<th>NEO'lu ISP</th>
													<th>Uydu'lu ISP</th>
													<th>NEO</th>
													<th>UYDU</th>
													<th>Toplam Hakediş</th>
													<th>Hakediş Tarihi</th>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($bayi_hesaplama)): ?>
													<?php $sira = 1; ?>
													<?php foreach($bayi_hesaplama as $hesaplama): ?>
														<?php 
														// Ücret hesaplamaları
														$neolu_isp_toplam = (isset($hesaplama->neolu_isp) ? $hesaplama->neolu_isp : 0) * (isset($hesaplama->isp_ucret) ? $hesaplama->isp_ucret : 0);
														$uydulu_isp_toplam = (isset($hesaplama->uydulu_isp) ? $hesaplama->uydulu_isp : 0) * (isset($hesaplama->isp_ucret) ? $hesaplama->isp_ucret : 0);
														$neo_toplam = (isset($hesaplama->neo) ? $hesaplama->neo : 0) * (isset($hesaplama->neo_ucret) ? $hesaplama->neo_ucret : 0);
														$uydu_toplam = (isset($hesaplama->uydu) ? $hesaplama->uydu : 0) * (isset($hesaplama->uydu_ucret) ? $hesaplama->uydu_ucret : 0);
														$genel_toplam_hakedis = $neolu_isp_toplam + $uydulu_isp_toplam + $neo_toplam + $uydu_toplam;
														?>
														<tr>
															<td><?= $sira++ ?></td>
															<td>
																<strong><?= htmlspecialchars($hesaplama->talebi_giren_personel_altbayi) ?></strong>
																<?php if (isset($hesaplama->kullanici_ad) && $hesaplama->kullanici_ad): ?>
																	<br><small class="text-muted">(<?= htmlspecialchars($hesaplama->kullanici_ad) ?>)</small>
																<?php endif; ?>
															</td>
															<td>
																<span class="badge badge-info"><?= isset($hesaplama->neolu_isp) ? number_format($hesaplama->neolu_isp) : '0' ?> adet</span>
																<?php if (isset($hesaplama->isp_ucret) && $hesaplama->isp_ucret > 0): ?>
																	<br><span class="badge badge-success"><?= number_format($neolu_isp_toplam, 2) ?>₺</span>
																	<br><small class="text-muted">(<?= number_format($hesaplama->isp_ucret, 2) ?>₺/adet)</small>
																<?php endif; ?>
															</td>
															<td>
																<span class="badge badge-primary"><?= isset($hesaplama->uydulu_isp) ? number_format($hesaplama->uydulu_isp) : '0' ?> adet</span>
																<?php if (isset($hesaplama->isp_ucret) && $hesaplama->isp_ucret > 0): ?>
																	<br><span class="badge badge-success"><?= number_format($uydulu_isp_toplam, 2) ?>₺</span>
																	<br><small class="text-muted">(<?= number_format($hesaplama->isp_ucret, 2) ?>₺/adet)</small>
																<?php endif; ?>
															</td>
															<td>
																<span class="badge badge-warning"><?= isset($hesaplama->neo) ? number_format($hesaplama->neo) : '0' ?> adet</span>
																<?php if (isset($hesaplama->neo_ucret) && $hesaplama->neo_ucret > 0): ?>
																	<br><span class="badge badge-success"><?= number_format($neo_toplam, 2) ?>₺</span>
																	<br><small class="text-muted">(<?= number_format($hesaplama->neo_ucret, 2) ?>₺/adet)</small>
																<?php endif; ?>
															</td>
															<td>
																<span class="badge badge-secondary"><?= isset($hesaplama->uydu) ? number_format($hesaplama->uydu) : '0' ?> adet</span>
																<?php if (isset($hesaplama->uydu_ucret) && $hesaplama->uydu_ucret > 0): ?>
																	<br><span class="badge badge-success"><?= number_format($uydu_toplam, 2) ?>₺</span>
																	<br><small class="text-muted">(<?= number_format($hesaplama->uydu_ucret, 2) ?>₺/adet)</small>
																<?php endif; ?>
															</td>
															<td>
																<strong class="text-primary"><?= number_format($genel_toplam_hakedis, 2) ?>₺</strong>
															</td>
															<td>
																<?php if (isset($hesaplama->hakedis_baslangic) && isset($hesaplama->hakedis_bitis)): ?>
																	<span class="badge badge-info">
																		<?= date('d.m.Y', strtotime($hesaplama->hakedis_baslangic)) ?> - <?= date('d.m.Y', strtotime($hesaplama->hakedis_bitis)) ?>
																	</span>
																<?php else: ?>
																	<span class="text-muted">-</span>
																<?php endif; ?>
															</td>
														</tr>
													<?php endforeach; ?>
												<?php else: ?>
													<tr>
														<td colspan="8" class="text-center text-muted">
															<i class="fa fa-info-circle"></i> 
															Seçilen kriterlere uygun bayi hesaplama verisi bulunamadı.
														</td>
													</tr>
												<?php endif; ?>
											</tbody>
										</table>
									</div>

								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->

			<?php $this->load->view("include/footer-js"); ?>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			// Tablo responsive kontrolü
			if ($('.table-responsive table').width() > $('.table-responsive').width()) {
				$('.table-responsive').addClass('overflow-auto');
			}

			// Hakediş dönemi seçildiğinde form otomatik submit
			$('#hakedis_donemi').change(function() {
				if ($(this).val()) {
					$(this).closest('form').submit();
				}
			});
		});
	</script>

</body>
</html>
