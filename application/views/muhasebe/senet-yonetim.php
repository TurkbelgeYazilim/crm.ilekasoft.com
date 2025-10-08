<!DOCTYPE html>

<html lang="tr">

<head>

	<?php $this->load->view("include/head-tags"); ?>

</head>

<body>



<?php

$firma = getirFirma();

$deletePermission = $firma->ayarlar_deletePermission;



// Yetki kontrolü - Senet Yönetimi (ID: 522)

if (!grup_modul_yetkisi_var(522)) {

	?>

	<div class="main-wrapper">

		<div class="page-wrapper">

			<div class="content container-fluid">

				<div class="alert alert-danger text-center">

					<i class="fas fa-ban fa-3x mb-3"></i>

					<h4>Erişim Engellendi</h4>

					<p>Bu sayfaya erişim yetkiniz bulunmamaktadır.</p>

					<p><strong>Gerekli Yetki:</strong> Senet Yönetimi (ID: 522)</p>

					<a href="<?= base_url(); ?>" class="btn btn-primary">

						<i class="fas fa-home"></i> Anasayfaya Dön

					</a>

				</div>

			</div>

		</div>

	</div>

	</body>

	</html>

	<?php

	return;

}



// Debug bilgisini görüntüle

if (isset($debug_info)) {

	echo $debug_info;

}

?>

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

							<h3 class="page-title">Muhasebe</h3>

							<ul class="breadcrumb">

								<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>

								<li class="breadcrumb-item">Muhasebe</li>

								<li class="breadcrumb-item active"><?= $durum_basliklar[$durum_filter] ?></li>

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

				

				<?php if (isset($error_message)): ?>

				<!-- Hata Mesajı -->

				<div class="row mb-4">

					<div class="col-12">

						<div class="alert alert-danger" role="alert">

							<i class="fas fa-exclamation-triangle"></i>

							<strong>Hata:</strong> <?= $error_message ?>

						</div>

					</div>

				</div>

				<?php endif; ?>



				<!-- Durum Filtreleri -->

				<div class="row mb-4">

					<div class="col-12">

						<div class="card">

							<div class="card-body">

								<div class="d-flex justify-content-between align-items-center">

									<div>

										<h5 class="card-title">Senet Durumu</h5>

									</div>

									<div>

										<div class="btn-group" role="group">

											<a href="<?= base_url('muhasebe/senet-yonetim-excel?durum=eldeki') ?>" 

											   class="btn btn-outline-success btn-sm" title="Eldeki Senetleri Excel İndir">

												<i class="fas fa-file-excel"></i> Eldeki

											</a>

											<a href="<?= base_url('muhasebe/senet-yonetim-excel?durum=bankaya-verilen') ?>" 

											   class="btn btn-outline-primary btn-sm" title="Bankaya Verilen Senetleri Excel İndir">

												<i class="fas fa-file-excel"></i> Bankaya Verilen

											</a>

											<a href="<?= base_url('muhasebe/senet-yonetim-excel?durum=tahsil-edilen') ?>" 

											   class="btn btn-outline-success btn-sm" title="Tahsil Edilen Senetleri Excel İndir">

												<i class="fas fa-file-excel"></i> Tahsil Edilen

											</a>

											<a href="<?= base_url('muhasebe/senet-yonetim-excel?durum=protesto') ?>" 

											   class="btn btn-outline-danger btn-sm" title="Protesto Olan Senetleri Excel İndir">

												<i class="fas fa-file-excel"></i> Protesto

											</a>

											<a href="<?= base_url('muhasebe/senet-yonetim-excel?durum=vadesi-gecen') ?>" 

											   class="btn btn-outline-warning btn-sm" title="Vadesi Geçen Senetleri Excel İndir">

												<i class="fas fa-file-excel"></i> Vadesi Geçen

											</a>

										</div>

									</div>

								</div>

								<hr>

								<div class="btn-group" role="group">

									<a href="<?= base_url('muhasebe/senet-yonetim?durum=eldeki') ?>" 

									   class="btn <?= $durum_filter == 'eldeki' ? 'btn-success' : 'btn-outline-success' ?>">

										<i class="fas fa-hand-holding"></i> Eldeki Bekleyen

									</a>

									<a href="<?= base_url('muhasebe/senet-yonetim?durum=bankaya-verilen') ?>" 

									   class="btn <?= $durum_filter == 'bankaya-verilen' ? 'btn-primary' : 'btn-outline-primary' ?>">

										<i class="fas fa-university"></i> Bankaya Verilen

									</a>

									<a href="<?= base_url('muhasebe/senet-yonetim?durum=tahsil-edilen') ?>" 

									   class="btn <?= $durum_filter == 'tahsil-edilen' ? 'btn-success' : 'btn-outline-success' ?>">

										<i class="fas fa-check-circle"></i> Tahsil Edilen

									</a>

									<a href="<?= base_url('muhasebe/senet-yonetim?durum=protesto') ?>" 

									   class="btn <?= $durum_filter == 'protesto' ? 'btn-danger' : 'btn-outline-danger' ?>">

										<i class="fas fa-exclamation-triangle"></i> Protesto Olan

									</a>

									<a href="<?= base_url('muhasebe/senet-yonetim?durum=vadesi-gecen') ?>" 

									   class="btn <?= $durum_filter == 'vadesi-gecen' ? 'btn-warning' : 'btn-outline-warning' ?>">

										<i class="fas fa-clock"></i> Vadesi Geçen

									</a>

								</div>

							</div>

						</div>

					</div>

				</div>



				<!-- İstatistikler -->

				<?php if (isset($istatistikler)): ?>

				<div class="row mb-4">

					<div class="col-md-3">

						<div class="card bg-primary text-white">

							<div class="card-body">

								<div class="d-flex justify-content-between align-items-center">

									<div>

										<h5>Toplam Senet</h5>

										<h3><?= number_format($istatistikler->toplam_senet) ?></h3>

									</div>

									<div>

										<a href="<?= base_url('muhasebe/senet-yonetim?durum=eldeki') ?>" class="btn btn-light btn-sm">

											<i class="fas fa-eye"></i>

										</a>

									</div>

								</div>

							</div>

						</div>

					</div>

					<div class="col-md-3">

						<div class="card bg-success text-white">

							<div class="card-body">

								<div class="d-flex justify-content-between align-items-center">

									<div>

										<h5>Toplam Tutar</h5>

										<h3><?= number_format($istatistikler->toplam_tutar, 2) ?> ₺</h3>

									</div>

									<div>

										<a href="<?= base_url('muhasebe/senet-yonetim-excel?durum=tahsil-edilen') ?>" class="btn btn-light btn-sm" title="Excel İndir">

											<i class="fas fa-file-excel"></i>

										</a>

									</div>

								</div>

							</div>

						</div>

					</div>

					<div class="col-md-3">

						<div class="card bg-warning text-white">

							<div class="card-body">

								<div class="d-flex justify-content-between align-items-center">

									<div>

										<h5>Vadesi Yaklaşan</h5>

										<h3><?= number_format($istatistikler->vadesi_yaklasan) ?></h3>

									</div>

									<div>

										<a href="<?= base_url('muhasebe/senet-yonetim?durum=eldeki') ?>" class="btn btn-light btn-sm">

											<i class="fas fa-eye"></i>

										</a>

									</div>

								</div>

							</div>

						</div>

					</div>

					<div class="col-md-3">

						<div class="card bg-danger text-white">

							<div class="card-body">

								<div class="d-flex justify-content-between align-items-center">

									<div>

										<h5>Vadesi Geçen</h5>

										<h3><?= number_format($istatistikler->vadesi_gecen) ?></h3>

									</div>

									<div>

										<a href="<?= base_url('muhasebe/senet-yonetim-excel?durum=vadesi-gecen') ?>" class="btn btn-light btn-sm" title="Excel İndir">

											<i class="fas fa-file-excel"></i>

										</a>

									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

				<?php endif; ?>



				<!-- Senet Listesi -->

				<div class="row">

					<div class="col-12">

						<div class="card">

							<div class="card-header">

								<div class="d-flex justify-content-between align-items-center">

									<div>

										<h4 class="card-title"><?= $durum_basliklar[$durum_filter] ?></h4>

										<p class="text-muted">Toplam <?= $total_count ?> senet bulundu</p>

									</div>

									<div>

										<a href="<?= base_url('muhasebe/senet-yonetim-excel?durum=' . $durum_filter . (!empty($search_param) ? '&search=' . urlencode($search_param) : '')) ?>" 

										   class="btn btn-success">

											<i class="fas fa-file-excel"></i> Excel İndir

										</a>

									</div>

								</div>

							</div>

							<div class="card-body">

															<div class="card-body">
								
								<!-- Arama Formu -->
								<div class="mb-3">
									<form method="GET" action="<?= current_url() ?>" class="d-flex">
										<input type="hidden" name="durum" value="<?= $durum_filter ?>">
										<div class="input-group">
											<input type="text" 
												   class="form-control" 
												   name="search" 
												   placeholder="TC Kimlik / Vergi No / Cari Adı / Telefon ile ara..." 
												   value="<?= isset($search_param) ? htmlspecialchars($search_param) : '' ?>">
											<div class="input-group-append">
												<button class="btn btn-primary" type="submit">
													<i class="fas fa-search"></i> Ara
												</button>
												<?php if (!empty($search_param)): ?>
												<a href="<?= base_url("muhasebe/senet-yonetim?durum={$durum_filter}") ?>" 
												   class="btn btn-secondary ml-1">
													<i class="fas fa-times"></i> Temizle
												</a>
												<?php endif; ?>
											</div>
										</div>
									</form>
								</div>
								
								<?php if (!empty($senetler)): ?>

								<div class="table-responsive">

									<table class="table table-striped">

										<thead>

											<tr>

												<th>Senet Görsel</th>

												<th>Cari</th>

												<th>Tutar</th>

												<th>Vade Tarihi</th>

												<th>Durum</th>

												<th>Kalan Gün</th>

												<th>Personel</th>

												<th>Banka</th>

												<th>İşlemler</th>

											</tr>

										</thead>

										<tbody>

											<?php foreach ($senetler as $senet): ?>

											<tr>

												<td>

													<?php if ($senet->senet_gorsel): ?>

														<?php 

														// Önce JSON decode deneyelim, başarısız olursa düz string olarak kabul edelim

														$gorseller = json_decode($senet->senet_gorsel, true);

														

														// Eğer JSON decode başarısız olduysa (null döndü), düz string olarak işle

														if ($gorseller === null) {

															// Tek görsel dosyası olarak kabul et

															$gorsel_dosya = trim($senet->senet_gorsel);

															if (!empty($gorsel_dosya)) {

																$gorsel_url = base_url('assets/uploads/senetler/' . $gorsel_dosya);

																?>

																<button type="button" class="btn btn-sm btn-outline-primary" 

																   onclick="showImageModal('<?= $gorsel_url ?>', 'Senet Görseli')" 

																   title="Senet Görseli - <?= $gorsel_dosya ?>">

																	<i class="fas fa-image"></i> Görüntüle

																</button>

																<?php

															} else {

																?>

																<span class="text-muted">Görsel yok</span>

																<?php

															}

														} elseif (is_array($gorseller) && !empty($gorseller)) { 

															// JSON array formatında görseller var

															?>

															<div class="d-flex flex-wrap gap-1">

																<?php foreach ($gorseller as $index => $gorsel): ?>

																	<?php if ($index < 3): // İlk 3 görseli göster ?>

																		<a href="<?= $gorsel ?>" target="_blank" class="btn btn-sm btn-outline-primary" 

																		   title="Senet Görseli <?= $index + 1 ?>">

																			<i class="fas fa-image"></i>

																		</a>

																	<?php endif; ?>

																<?php endforeach; ?>

																<?php if (count($gorseller) > 3): ?>

																	<span class="badge badge-secondary">+<?= count($gorseller) - 3 ?></span>

																<?php endif; ?>

															</div>

															<?php 

														} else {

															?>

															<span class="text-muted">Görsel yok</span>

															<?php

														}

														?>

													<?php else: ?>

														<span class="text-muted">Görsel yok</span>

													<?php endif; ?>

												</td>

												<td>

													<?php 

													// Debug: Cari bilgilerini kontrol et

													if (isset($debug_info)) {

														echo "<!-- CARI DEBUG: cari_ad='{$senet->cari_ad}', senet_cariID='{$senet->senet_cariID}' -->";

													}

													?>

													<?php if ($senet->senet_cariID): ?>

														<a href="<?= base_url('cari/cari-karti-duzenle/' . $senet->senet_cariID) ?>" 

														   class="text-primary" target="_blank">

															<?= $senet->cari_ad ?: 'Cari bilgisi bulunamadı' ?>

														</a>

													<?php else: ?>

														<?= $senet->cari_ad ?: 'Cari bilgisi bulunamadı' ?>

													<?php endif; ?>

													<?php if ($senet->cari_telefon): ?>

													<br><small class="text-muted"><?= $senet->cari_telefon ?></small>

													<?php endif; ?>

												</td>

												<td><strong><?= number_format($senet->senet_tutar, 2) ?> ₺</strong></td>

												<td><?= date('d.m.Y', strtotime($senet->senet_vadeTarih)) ?></td>

												<td>

													<?php if ($senet->son_durum): ?>

													<span class="badge" style="background-color: <?= $senet->durum_rengi ?>; color: white;">

														<?php if ($senet->durum_ikonu): ?>

														<i class="<?= $senet->durum_ikonu ?>"></i>

														<?php endif; ?>

														<?= $senet->son_durum ?>

													</span>

													<?php else: ?>

													<span class="badge badge-info">Personel'in Kendisinde</span>

													<?php endif; ?>

												</td>

												<td>

													<?php if ($senet->vade_gun_kalan > 0): ?>

													<span class="text-success"><?= $senet->vade_gun_kalan ?> gün</span>

													<?php elseif ($senet->vade_gun_kalan == 0): ?>

													<span class="text-warning">Bugün</span>

													<?php else: ?>

													<span class="text-danger"><?= abs($senet->vade_gun_kalan) ?> gün geçmiş</span>

													<?php endif; ?>

												</td>

												<td>

													<?php if ($senet->personel_adi): ?>

														<span class="text-primary"><?= $senet->personel_adi ?></span>

													<?php else: ?>

														<span class="text-muted">-</span>

													<?php endif; ?>

												</td>

												<td>

													<?php if ($senet->banka_hesap_adi): ?>

														<span class="text-info"><?= $senet->banka_hesap_adi ?></span>

													<?php else: ?>

														<span class="text-muted">-</span>

													<?php endif; ?>

												</td>

												<td>

													<a href="<?= base_url('muhasebe/senet-detay/' . $senet->senet_id) ?>" 

													   class="btn btn-sm btn-info">

														<i class="fas fa-eye"></i> Detay

													</a>

												</td>

											</tr>

											<?php endforeach; ?>

										</tbody>

									</table>

								</div>



								<!-- Sayfalama -->

								<?php if ($pagination): ?>

								<div class="row mt-3">

									<div class="col-12">

										<?= $pagination ?>

									</div>

								</div>

								<?php endif; ?>



								<?php else: ?>

								<div class="text-center py-5">

									<i class="fas fa-file-invoice fa-3x text-muted mb-3"></i>

									<h5>Bu durumda senet bulunamadı</h5>

									<p class="text-muted">Şu anda <?= strtolower($durum_basliklar[$durum_filter]) ?> bulunmuyor.</p>

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



	<!-- jQuery -->

	<?php $this->load->view("include/footer-js"); ?>

	

	<!-- Görsel Önizleme Modalı -->

	<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">

		<div class="modal-dialog modal-lg" role="document">

			<div class="modal-content">

				<div class="modal-header">

					<h5 class="modal-title" id="imageModalLabel">Senet Görseli</h5>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">&times;</span>

					</button>

				</div>

				<div class="modal-body text-center">

					<img id="modalImage" src="" alt="Senet Görseli" class="img-fluid" style="max-height: 500px;">

				</div>

				<div class="modal-footer">

					<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>

					<a id="downloadLink" href="" class="btn btn-primary" target="_blank">

						<i class="fa fa-external-link-alt"></i> Yeni Pencerede Aç

					</a>

				</div>

			</div>

		</div>

	</div>



	<script>

	// Görsel modal fonksiyonu

	function showImageModal(imageSrc, title) {

		$('#imageModalLabel').text(title);

		$('#modalImage').attr('src', imageSrc);

		$('#downloadLink').attr('href', imageSrc);

		$('#imageModal').modal('show');

	}

	</script>

</body>

</html>

