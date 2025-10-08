<!DOCTYPE html>

<html lang="tr">

<head>

	<?php $this->load->view("include/head-tags"); ?>

	<title>Tahsilat Listesi | İlekaSoft CRM</title>

	<link rel="icon" type="image/x-icon" href="<?= base_url('assets/favicon.ico'); ?>" />

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.13.6/css/dataTables.bootstrap4.min.css"/>

	

	<style>

		.tahsilat-onay-bekleyen {

			background-color: #fff3cd;

			border-left: 4px solid #ffc107;

		}

		

		.tahsilat-onaylanan {

			background-color: #d4edda;

			border-left: 4px solid #28a745;

		}

		

		.tahsilat-reddedilen {

			background-color: #f8d7da;

			border-left: 4px solid #dc3545;

		}

		

		.tutar-buyuk {

			font-size: 1.2em;

			font-weight: bold;

			color: #28a745;

		}

		

		.card-stats {

			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

			color: white;

		}

		

		.card-stats.card-warning {

			background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);

		}

		

		.card-stats.card-success {

			background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);

		}

		

		.card-stats.card-danger {

			background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);

		}

		

		.card-stats .card-body {

			padding: 1.5rem;

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

		

		.cek-detaylari {

			background-color: #f8f9fa;

			border: 1px solid #e9ecef;

			border-radius: 4px;

			padding: 8px;

			margin: 2px 0;

		}

		

		.cek-detaylari small {

			margin-bottom: 2px;

			color: #495057;

		}

		

		.cek-detaylari .badge {

			font-size: 0.75em;

		}

		

		.banka-detaylari {

			background-color: #e8f4fd;

			border: 1px solid #bee5eb;

			border-radius: 4px;

			padding: 8px;

			margin: 2px 0;

		}

		

		.banka-detaylari small {

			margin-bottom: 2px;

			color: #055160;

		}

		

		.banka-detaylari .badge {

			font-size: 0.75em;

		}

		

		.kasa-detaylari {

			background-color: #fff3cd;

			border: 1px solid #ffeaa7;

			border-radius: 4px;

			padding: 8px;

			margin: 2px 0;

		}

		

		.kasa-detaylari small {

			margin-bottom: 2px;

			color: #856404;

		}

		

		.kasa-detaylari .badge {

			font-size: 0.75em;

		}

		

		.senet-detaylari {

			background-color: #e8f5e8;

			border: 1px solid #c3e6c3;

			border-radius: 4px;

			padding: 8px;

			margin: 2px 0;

		}

		

		.senet-detaylari small {

			margin-bottom: 2px;

			color: #155724;

		}

		

		.senet-detaylari .badge {

			font-size: 0.75em;

		}

		

		@media (max-width: 768px) {

			.table-responsive {

				font-size: 0.875rem;

			}

			

			.btn-group .btn {

				padding: 0.25rem 0.5rem;

				font-size: 0.8rem;

			}

			

			.cek-detaylari {

				padding: 4px;

				font-size: 0.8rem;

			}

			

			.banka-detaylari {

				padding: 4px;

				font-size: 0.8rem;

			}

			

			.kasa-detaylari {

				padding: 4px;

				font-size: 0.8rem;

			}

			

			.senet-detaylari {

				padding: 4px;

				font-size: 0.8rem;

			}

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

						<h3 class="page-title">Tahsilat Listesi</h3>

						<ul class="breadcrumb">

							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>

							<li class="breadcrumb-item">Tahsilat</li>

							<li class="breadcrumb-item active">Tahsilat Listesi</li>

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



			<!-- İstatistikler -->

			<div class="row mb-4">

				<div class="col-xl-3 col-sm-6 col-12">

					<div class="card card-stats">

						<div class="card-body">

							<div class="stats-number">

								<?= isset($toplam_adet) ? $toplam_adet : count($tahsilatlar) ?>

							</div>

							<div class="stats-label">

								<i class="fa fa-list mr-2"></i>Toplam Tahsilat Sayısı

							</div>

						</div>

					</div>

				</div>

				<div class="col-xl-3 col-sm-6 col-12">

					<div class="card card-stats card-warning">

						<div class="card-body">

							<div class="stats-number">

								<?= isset($onay_bekleyen_adet) ? $onay_bekleyen_adet : 0 ?>

							</div>

							<div class="stats-label">

								<i class="fa fa-clock-o mr-2"></i>Onay Bekleyen

							</div>

						</div>

					</div>

				</div>

				<div class="col-xl-3 col-sm-6 col-12">

					<div class="card card-stats card-success">

						<div class="card-body">

							<div class="stats-number">

								<?= isset($onaylanan_adet) ? $onaylanan_adet : 0 ?>

							</div>

							<div class="stats-label">

								<i class="fa fa-check mr-2"></i>Onaylanan

							</div>

						</div>

					</div>

				</div>

				<div class="col-xl-3 col-sm-6 col-12">

					<div class="card card-stats card-danger">

						<div class="card-body">

							<div class="stats-number">

								<?= isset($reddedilen_adet) ? $reddedilen_adet : 0 ?>

							</div>

							<div class="stats-label">

								<i class="fa fa-times mr-2"></i>Reddedilen

							</div>

						</div>

					</div>

				</div>

			</div>



			<!-- Toplam Tutar -->

			<div class="row mb-4">

				<div class="col-12">

					<div class="card">

						<div class="card-body text-center">

							<h4 class="card-title">Toplam Tahsilat Tutarı</h4>

							<h2 class="text-success">

								<i class="fa fa-money mr-2"></i>

								<?= number_format($toplam_tutar, 2, ',', '.') ?> ₺

							</h2>

						</div>

					</div>

				</div>

			</div>



			<!-- Tahsilatlar Listesi -->

			<div class="row">

				<div class="col-xl-12 col-md-12">

					<div class="card card-table">

						<div class="card-header">

							<div class="row">

								<div class="col">

									<h4 class="card-title">

										<i class="fa fa-list text-primary mr-2"></i>

										Tahsilatlarım

									</h4>

									<p class="text-muted mb-0">

										<small>Sadece sizin oluşturduğunuz tahsilatlar listelenmektedir</small>

									</p>

								</div>

								<div class="col-auto">

									<button type="button" class="btn btn-primary btn-sm" onclick="location.reload()">

										<i class="fa fa-refresh"></i> Yenile

									</button>

								</div>

							</div>

						</div>



						<?php if (isset($error_message)): ?>

							<div class="alert alert-warning">

								<div class="row">

									<div class="col-md-2 text-center">

										<i class="fa fa-database" style="font-size: 3rem; color: #ffc107;"></i>

									</div>

									<div class="col-md-10">

										<h5><i class="fa fa-exclamation-triangle mr-2"></i>Veritabanı Kurulum Gerekli</h5>

										<p><?= $error_message ?></p>

										<div class="mt-3">

											<p><strong>Kurulum Adımları:</strong></p>

											<ol>

												<li>MySQL/phpMyAdmin'e giriş yapın</li>

												<li><code>muhase_database_setup.sql</code> dosyasını çalıştırın</li>

												<li>Bu sayfayı yenileyin</li>

											</ol>

										</div>

									</div>

								</div>

							</div>

						<?php elseif (isset($tahsilatlar) && count($tahsilatlar) > 0): ?>

							<div class="table-responsive">

								<table class="table table-striped custom-table mb-0" id="tahsilatlarTable">

									<thead>

										<tr>

											<th>ID</th>

											<th>Tahsilat Tipi</th>

											<th>Müşteri Adı</th>

											<th>Tutar</th>

											<th>Detaylar</th>

											<th>İşlem Tarihi</th>

											<th>Görsel</th>

											<th>Açıklama</th>

											<th>İşlemler</th>

										</tr>

									</thead>

									<tbody>

										<?php foreach($tahsilatlar as $tahsilat): ?>

										<tr class="<?php 

											if($tahsilat->durum == 1) echo 'tahsilat-onay-bekleyen';

											elseif($tahsilat->durum == 2) echo 'tahsilat-onaylanan';

											elseif($tahsilat->durum == 3) echo 'tahsilat-reddedilen';

										?>">

											<td><strong>#<?= $tahsilat->id ?></strong></td>

											<td>

												<?php 

												$icon = '';

												$class = '';

												switch($tahsilat->tahsilat_tipi_adi) {

													case 'Banka': $icon = 'fa-university'; $class = 'text-primary'; break;

													case 'Çek': $icon = 'fa-file-text-o'; $class = 'text-info'; break;

													case 'Kasa': $icon = 'fa-money'; $class = 'text-success'; break;

													case 'Senet': $icon = 'fa-file-o'; $class = 'text-warning'; break;

													default: $icon = 'fa-question'; $class = 'text-muted'; break;

												}

												?>

												<i class="fa <?= $icon ?> <?= $class ?> mr-2"></i>

												<span class="<?= $class ?>"><?= $tahsilat->tahsilat_tipi_adi ?></span>

											</td>

											<td>

												<strong title="<?= htmlspecialchars($tahsilat->musteri_adi ?: 'Bilinmiyor') ?>">
													<?= $tahsilat->musteri_adi ? (mb_strlen($tahsilat->musteri_adi) > 30 ? mb_substr($tahsilat->musteri_adi, 0, 30) . '...' : $tahsilat->musteri_adi) : 'Bilinmiyor' ?>
												</strong>

											</td>

											<td>

												<span class="tutar-buyuk"><?= $tahsilat->tutar ? number_format($tahsilat->tutar, 2, ',', '.') . ' ₺' : '-' ?></span>

											</td>

											<td>

												<?php if($tahsilat->tahsilat_tipi_adi == 'Banka' && isset($tahsilat->banka_belge_no)): ?>

													<div class="banka-detaylari">

														<?php if($tahsilat->banka_adi): ?>

															<small class="d-block"><strong>Banka:</strong> <?= $tahsilat->banka_adi ?></small>

														<?php endif; ?>

														<?php if($tahsilat->banka_hesap_no): ?>

															<small class="d-block"><strong>Hesap No:</strong> <?= $tahsilat->banka_hesap_no ?></small>

														<?php endif; ?>

														<?php if($tahsilat->banka_belge_no): ?>

															<small class="d-block"><strong>Belge No:</strong> <?= $tahsilat->banka_belge_no ?></small>

														<?php endif; ?>

														<?php if($tahsilat->banka_tarih): ?>

															<small class="d-block"><strong>İşlem Tarihi:</strong> <?= date('d.m.Y', strtotime($tahsilat->banka_tarih)) ?></small>

														<?php endif; ?>

														<?php if($tahsilat->banka_aciklama): ?>

															<small class="d-block"><strong>Açıklama:</strong> <?= substr($tahsilat->banka_aciklama, 0, 50) ?><?= strlen($tahsilat->banka_aciklama) > 50 ? '...' : '' ?></small>

														<?php endif; ?>

													</div>

												<?php elseif($tahsilat->tahsilat_tipi_adi == 'Kasa' && isset($tahsilat->kasa_belge_no)): ?>

													<div class="kasa-detaylari">

														<?php if($tahsilat->kasa_adi): ?>

															<small class="d-block"><strong>Kasa:</strong> <?= $tahsilat->kasa_adi ?></small>

														<?php endif; ?>

														<?php if($tahsilat->kasa_kodu): ?>

															<small class="d-block"><strong>Kasa Kodu:</strong> <?= $tahsilat->kasa_kodu ?></small>

														<?php endif; ?>

														<?php if($tahsilat->kasa_belge_no): ?>

															<small class="d-block"><strong>Belge No:</strong> <?= $tahsilat->kasa_belge_no ?></small>

														<?php endif; ?>

														<?php if($tahsilat->kasa_tarih): ?>

															<small class="d-block"><strong>İşlem Tarihi:</strong> <?= date('d.m.Y', strtotime($tahsilat->kasa_tarih)) ?></small>

														<?php endif; ?>

														<?php if($tahsilat->kasa_aciklama && !strpos($tahsilat->kasa_aciklama, 'Açılış Bakiyesi')): ?>

															<small class="d-block"><strong>Açıklama:</strong> <?= substr($tahsilat->kasa_aciklama, 0, 50) ?><?= strlen($tahsilat->kasa_aciklama) > 50 ? '...' : '' ?></small>

														<?php endif; ?>

													</div>

												<?php elseif($tahsilat->tahsilat_tipi_adi == 'Çek' && isset($tahsilat->cek_seri_no)): ?>

													<div class="cek-detaylari">

														<?php if($tahsilat->cek_seri_no): ?>

															<small class="d-block"><strong>Seri No:</strong> <?= $tahsilat->cek_seri_no ?></small>

														<?php endif; ?>

														<?php if($tahsilat->cek_vade_tarih): ?>

															<small class="d-block"><strong>Vade:</strong> <?= date('d.m.Y', strtotime($tahsilat->cek_vade_tarih)) ?></small>

														<?php endif; ?>

														<?php if($tahsilat->cek_portfoy_no): ?>

															<small class="d-block"><strong>Portföy:</strong> <?= $tahsilat->cek_portfoy_no ?></small>

														<?php endif; ?>

														<?php if(isset($tahsilat->cek_durum)): ?>

															<small class="d-block">

																<strong>Çek Durumu:</strong> 

																<span class="badge badge-<?= $tahsilat->cek_durum == 1 ? 'success' : ($tahsilat->cek_durum == 0 ? 'warning' : 'danger') ?>">

																	<?= $tahsilat->cek_durum == 1 ? 'Tahsil Edildi' : ($tahsilat->cek_durum == 0 ? 'Beklemede' : 'İade') ?>

																</span>

															</small>

														<?php endif; ?>

													</div>

												<?php elseif($tahsilat->tahsilat_tipi_adi == 'Senet' && isset($tahsilat->senet_seri_no)): ?>

													<div class="senet-detaylari">

														<?php if($tahsilat->senet_seri_no): ?>

															<small class="d-block"><strong>Seri No:</strong> <?= $tahsilat->senet_seri_no ?></small>

														<?php endif; ?>

														<?php if($tahsilat->senet_vade_tarih): ?>

															<small class="d-block"><strong>Vade:</strong> <?= date('d.m.Y', strtotime($tahsilat->senet_vade_tarih)) ?></small>

														<?php endif; ?>

														<?php if($tahsilat->senet_portfoy_no): ?>

															<small class="d-block"><strong>Portföy:</strong> <?= $tahsilat->senet_portfoy_no ?></small>

														<?php endif; ?>

														<?php if(isset($tahsilat->senet_durum)): ?>

															<small class="d-block">

																<strong>Senet Durumu:</strong> 

																<span class="badge badge-<?= $tahsilat->senet_durum == 1 ? 'success' : ($tahsilat->senet_durum == 0 ? 'warning' : 'danger') ?>">

																	<?= $tahsilat->senet_durum == 1 ? 'Tahsil Edildi' : ($tahsilat->senet_durum == 0 ? 'Beklemede' : 'İade') ?>

																</span>

															</small>

														<?php endif; ?>

													</div>

												<?php else: ?>

													<span class="text-muted">-</span>

												<?php endif; ?>

											</td>

											<td>

												<?php if($tahsilat->olusturma_tarihi): ?>

													<strong><?= date('d.m.Y', strtotime($tahsilat->olusturma_tarihi)) ?></strong>

													<br><small class="text-muted"><?= date('H:i', strtotime($tahsilat->olusturma_tarihi)) ?></small>

												<?php else: ?>

													<span class="text-muted">-</span>

												<?php endif; ?>

											</td>

											<td>

												<?php if($tahsilat->gorsel): ?>

													<?php

													// Tahsilat tipine göre doğru klasör yolunu belirle

													$gorsel_url = '';

													if($tahsilat->tahsilat_tipi == 1) {

														$gorsel_url = base_url('assets/uploads/dekontlar/' . $tahsilat->gorsel);

													} elseif($tahsilat->tahsilat_tipi == 2) {

														$gorsel_url = base_url('assets/uploads/cekler/' . $tahsilat->gorsel);

													} elseif($tahsilat->tahsilat_tipi == 4) {

														$gorsel_url = base_url('assets/uploads/senetler/' . $tahsilat->gorsel);

													} else {

														$gorsel_url = base_url('assets/uploads/dekontlar/' . $tahsilat->gorsel);

													}

													?>

													<button type="button" class="btn btn-sm btn-outline-info" 

															onclick="window.open('<?= $gorsel_url ?>', '_blank')">

														<i class="fa fa-image"></i> Görsel

													</button>

												<?php else: ?>

													<span class="text-muted">-</span>

												<?php endif; ?>

											</td>

											<td>

												<?php if($tahsilat->aciklama): ?>

													<?= substr($tahsilat->aciklama, 0, 30) ?>

													<?= strlen($tahsilat->aciklama) > 30 ? '...' : '' ?>

												<?php else: ?>

													<span class="text-muted">-</span>

												<?php endif; ?>

											</td>

											<td>

												<div class="btn-group" role="group">
													<?php if (grup_modul_yetkisi_var(511, 3)): ?>
													<button type="button"

													    class="btn btn-sm btn-outline-warning tahsilat-edit-btn"

													    data-tip="<?= $tahsilat->tahsilat_tipi ?>"

													    data-id="<?= $tahsilat->kayit_id ?>"

													    data-tutar="<?= $tahsilat->tutar ?>"

													    data-aciklama="<?= htmlspecialchars($tahsilat->aciklama) ?>"

													    data-gorsel="<?= $tahsilat->gorsel ?>"

													    data-gorsel-url="<?php

														    $gorsel_url = '';

														    $gorsel_adi = '';

														    

														    // Görsel alanını kontrol et - JSON formatında olabilir

														    if(!empty($tahsilat->gorsel)) {

															    $json_decoded = json_decode($tahsilat->gorsel, true);

															    if(is_array($json_decoded) && !empty($json_decoded[0])) {

																    $gorsel_adi = $json_decoded[0];

															    } else {

																    $gorsel_adi = $tahsilat->gorsel;

															    }

														    }

														    

														    // Görsel path'ini belirle

														    if(!empty($gorsel_adi)) {

															    if($tahsilat->tahsilat_tipi == 1) {

																    $gorsel_url = base_url('assets/uploads/dekontlar/' . $gorsel_adi);

															    } elseif($tahsilat->tahsilat_tipi == 2) {

																    $gorsel_url = base_url('assets/uploads/cekler/' . $gorsel_adi);

															    } elseif($tahsilat->tahsilat_tipi == 4) {

																    $gorsel_url = base_url('assets/uploads/senetler/' . $gorsel_adi);

															    } else {

																    $gorsel_url = base_url('assets/uploads/dekontlar/' . $gorsel_adi);

															    }

														    }

														    echo $gorsel_url;

													    ?>"

													>

														<i class="fa fa-edit"></i>

													</button>
													<?php endif; ?>
												</div>

											</td>

										</tr>

										<?php endforeach; ?>

									</tbody>

								</table>

							</div>

						<?php else: ?>

							<div class="text-center py-5">

								<i class="fa fa-list text-muted" style="font-size: 4rem; margin-bottom: 1rem;"></i>

								<h4>Henüz tahsilat kaydınız bulunmuyor.</h4>

								<p class="text-muted">İlk tahsilat kaydınızı oluşturmak için aşağıdaki butonu kullanabilirsiniz.</p>

								<a href="<?= base_url('tahsilat/tahsilat-olustur') ?>" class="btn btn-primary">

									<i class="fa fa-plus"></i> Yeni Tahsilat Ekle

								</a>

							</div>

						<?php endif; ?>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>



<?php $this->load->view("include/footer-js"); ?>



<script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.13.6/js/dataTables.bootstrap4.min.js"></script>



<script>

$(document).ready(function() {

	// DataTable başlat

	$('#tahsilatlarTable').DataTable({

		"language": {

			"url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json"

		},

		"pageLength": 25,

		"order": [[ 0, "desc" ]],

		"columnDefs": [

			{ "orderable": false, "targets": [4, 6, 8] } // Detaylar, Görsel ve İşlemler sütunları sıralanamaz

		]

	});

});

</script>



<!-- Tahsilat Düzenle Modalı -->

<div class="modal fade" id="tahsilatEditModal" tabindex="-1" role="dialog" aria-labelledby="tahsilatEditModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <form id="tahsilatEditForm" enctype="multipart/form-data">

      <div class="modal-content">

        <div class="modal-header">

          <h5 class="modal-title" id="tahsilatEditModalLabel">Tahsilat Düzenle</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          <input type="hidden" name="tip" id="modal_tip">

          <input type="hidden" name="id" id="modal_id">



          <div class="form-group">

            <label for="modal_tutar">Tutar</label>

            <input type="number" class="form-control" name="tutar" id="modal_tutar" step="0.01" required>

          </div>

          <div class="form-group">

            <label for="modal_aciklama">Açıklama</label>

            <textarea class="form-control" name="aciklama" id="modal_aciklama"></textarea>

          </div>

          <div class="form-group" id="modal_gorsel_preview_group">

            <label>Mevcut Görsel</label>

            <div id="modal_gorsel_preview"></div>

          </div>

          <div class="form-group" id="modal_gorsel_upload_group">

            <label>Yeni Görsel Yükle (Sadece 1 dosya)</label>

            <input type="file" class="form-control" name="gorsel" id="modal_gorsel" accept="image/*">

            <small class="form-text text-muted">Kasa hareketleri için görsel yükleme desteklenmemektedir.</small>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>

          <button type="submit" class="btn btn-primary">Kaydet</button>

        </div>

      </div>

    </form>

  </div>

</div>



<script>

$(document).on('click', '.tahsilat-edit-btn', function() {

    var tip = $(this).data('tip');

    $('#modal_tip').val(tip);

    $('#modal_id').val($(this).data('id'));

    $('#modal_tutar').val($(this).data('tutar'));

    $('#modal_aciklama').val($(this).data('aciklama'));

    var gorsel = $(this).data('gorsel');

    var gorselUrl = $(this).data('gorsel-url');

    

    // Kasa tipi (tip=3) ise görsel alanlarını gizle

    if(tip == 3) {

        $('#modal_gorsel_preview_group').hide();

        $('#modal_gorsel_upload_group').hide();

    } else {

        $('#modal_gorsel_preview_group').show();

        $('#modal_gorsel_upload_group').show();

        

        // Görsel URL kontrolü - boş veya geçersiz URL'leri kontrol et

        if (gorsel && gorselUrl && gorselUrl.trim() !== '' && !gorselUrl.includes('[') && !gorselUrl.includes(']')) {

            $('#modal_gorsel_preview').html('<img src="'+gorselUrl+'" style="max-width:150px;" onerror="this.style.display=\'none\'; this.parentNode.innerHTML=\'<span class=\\\'text-muted\\\'>Görsel yüklenemedi</span>\';">');

        } else {

            $('#modal_gorsel_preview').html('<span class="text-muted">Görsel yok</span>');

        }

    }

    

    $('#modal_gorsel').val('');

    $('#tahsilatEditModal').modal('show');

});



$('#tahsilatEditForm').on('submit', function(e) {

    e.preventDefault();

    

    // Kasa tipi için görsel kontrolü

    var tip = $('#modal_tip').val();

    if(tip == 3 && $('#modal_gorsel')[0].files.length > 0) {

        alert('Kasa hareketleri için görsel yükleme desteklenmemektedir!');

        return false;

    }

    

    var formData = new FormData(this);

    

    // Debug: FormData içeriğini kontrol et

    console.log('Form verisi:');

    for (var pair of formData.entries()) {

        console.log(pair[0] + ': ', pair[1]);

    }

    

    // Dosya bilgilerini özel olarak kontrol et

    var fileInput = $('#modal_gorsel')[0];

    if (fileInput.files.length > 0) {

        console.log('Seçilen dosya:', fileInput.files[0]);

        console.log('Dosya adı:', fileInput.files[0].name);

        console.log('Dosya boyutu:', fileInput.files[0].size);

        console.log('Dosya tipi:', fileInput.files[0].type);

    } else {

        console.log('Hiç dosya seçilmedi');

    }

    

    $.ajax({

        url: '<?= base_url('tahsilat/tahsilat_guncelle') ?>',

        type: 'POST',

        data: formData,

        processData: false,

        contentType: false,

        success: function(resp) {

            console.log('Server response:', resp);

            if(resp == 'OK') {

                $('#tahsilatEditModal').modal('hide');

                location.reload();

            } else if(resp == 'KASA_GORSEL_HATASI') {

                alert('Kasa hareketleri için görsel yükleme desteklenmemektedir!');

            } else {

                alert('Hata: ' + resp);

            }

        },

        error: function(xhr, status, error) {

            console.log('AJAX Error:', xhr.responseText);

            alert('AJAX Hatası: ' + error);

        }

    });

});

</script>



</body>

</html>

