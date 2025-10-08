<!DOCTYPE html>

<html lang="tr">

<head>

	<?php $this->load->view("include/head-tags"); ?>

	<title>Müşteri Listesi | İlekaSoft CRM</title>

	<link rel="icon" type="image/x-icon" href="<?= base_url('assets/favicon.ico'); ?>" />

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.13.6/css/dataTables.bootstrap4.min.css"/>

	

	<style>

		.musteri-aktif {

			background-color: #d4edda;

			border-left: 4px solid #28a745;

		}

		

		.musteri-pasif {

			background-color: #f8d7da;

			border-left: 4px solid #dc3545;

		}

		

		.card-stats {

			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

			color: white;

		}

		

		.card-stats.card-success {

			background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);

		}

		

		.card-stats.card-warning {

			background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);

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

		

		.musteri-bilgileri {

			background-color: #f8f9fa;

			border: 1px solid #e9ecef;

			border-radius: 4px;

			padding: 8px;

			margin: 2px 0;

		}

		

		.musteri-bilgileri small {

			margin-bottom: 2px;

			color: #495057;

		}

		

		.badge-tip {

			font-size: 0.8em;

		}

		

		.filter-card {

			background-color: #f8f9fa;

			border: 1px solid #e9ecef;

		}

		

		.filter-card .card-header {

			background-color: #e9ecef;

			border-bottom: 1px solid #dee2e6;

		}

		

		.input-group-text {

			background-color: #e9ecef;

			border: 1px solid #ced4da;

		}

		

		@media (max-width: 768px) {

			.table-responsive {

				font-size: 0.875rem;

			}

			

			.btn-group .btn {

				padding: 0.25rem 0.5rem;

				font-size: 0.8rem;

			}

			

			.row.mb-3 .col-md-6 {

				margin-bottom: 1rem;

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

						<h3 class="page-title">Müşteri Listesi</h3>

						<ul class="breadcrumb">

							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>

							<li class="breadcrumb-item">Muhasebe</li>

							<li class="breadcrumb-item active">Müşteri Listesi</li>

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



			<!-- Hata mesajı gösterimi -->

			<?php if (isset($error_message) && !empty($error_message)): ?>

				<div class="alert alert-danger">

					<i class="fa fa-exclamation-triangle"></i> <?= $error_message ?>

				</div>

			<?php endif; ?>



			<!-- Başarı mesajları -->

			<?php if ($this->session->flashdata('musteri_ok')): ?>

				<div class="alert alert-success alert-dismissible fade show" role="alert">

					<i class="fa fa-check-circle"></i> İşlem başarıyla tamamlandı.

					<button type="button" class="close" data-dismiss="alert" aria-label="Close">

						<span aria-hidden="true">&times;</span>

					</button>

				</div>

			<?php endif; ?>



			<!-- İstatistikler -->

			<div class="row mb-4">

				<div class="col-xl-4 col-sm-6 col-12">

					<div class="card card-stats">

						<div class="card-body">

							<div class="stats-number">

								<?= isset($toplam_musteri) ? $toplam_musteri : 0 ?>

							</div>

							<div class="stats-label">

								<i class="fa fa-users mr-2"></i>Toplam Müşteri Sayısı

							</div>

						</div>

					</div>

				</div>

				<div class="col-xl-4 col-sm-6 col-12">

					<div class="card card-stats card-success">

						<div class="card-body">

							<div class="stats-number">

								<?= isset($aktif_musteri) ? $aktif_musteri : 0 ?>

							</div>

							<div class="stats-label">

								<i class="fa fa-check-circle mr-2"></i>Aktif Müşteri Sayısı

							</div>

						</div>

					</div>

				</div>

				<div class="col-xl-4 col-sm-6 col-12">

					<div class="card card-stats card-danger">

						<div class="card-body">

							<div class="stats-number">

								<?= isset($pasif_musteri) ? $pasif_musteri : 0 ?>

							</div>

							<div class="stats-label">

								<i class="fa fa-times-circle mr-2"></i>Pasif Müşteri Sayısı

							</div>

						</div>

					</div>

				</div>

			</div>

			

			<!-- Yeni Müşteri Ekle Butonu ve Filtreler -->

			<div class="row mb-3">

				<div class="col-md-6">

					<a href="<?= base_url('cari/cari-karti-olustur'); ?>" class="btn btn-primary">

						<i class="fa fa-plus-circle mr-2"></i>Yeni Müşteri Ekle

					</a>

				</div>

				<div class="col-md-6 text-right">

					<button type="button" class="btn btn-secondary" onclick="location.reload();">

						<i class="fa fa-refresh mr-2"></i>Yenile

					</button>

				</div>

			</div>



			<!-- Filtreler -->

			<div class="row mb-3">

				<div class="col-12">

					<div class="card">

						<div class="card-header">

							<h5 class="card-title mb-0">

								<i class="fa fa-filter mr-2"></i>Filtreler

								<button type="button" class="btn btn-sm btn-outline-secondary float-right" id="filtreleriTemizle">

									<i class="fa fa-times mr-1"></i>Temizle

								</button>

							</h5>

						</div>

						<div class="card-body">

							<div class="row">

								<div class="col-md-6">

									<label for="kayitTarihiFiltre">Kayıt Tarihi:</label>

									<div class="input-group">

										<input type="date" class="form-control" id="kayitTarihiBaslangic" placeholder="Başlangıç Tarihi">

										<div class="input-group-append input-group-prepend">

											<span class="input-group-text">-</span>

										</div>

										<input type="date" class="form-control" id="kayitTarihiBitis" placeholder="Bitiş Tarihi">

									</div>

								</div>

								<div class="col-md-6">

									<label for="olusturanFiltre">Oluşturan:</label>

									<select class="form-control" id="olusturanFiltre">

										<option value="">Tüm Kullanıcılar</option>

										<?php if (isset($musteriler) && count($musteriler) > 0): ?>

											<?php 

											$olusturanlar = array();

											foreach($musteriler as $musteri) {

												if (!empty($musteri->olusturan_kullanici) && !in_array($musteri->olusturan_kullanici, $olusturanlar)) {

													$olusturanlar[] = $musteri->olusturan_kullanici;

												}

											}

											sort($olusturanlar);

											foreach($olusturanlar as $olusturan): ?>

												<option value="<?= $olusturan ?>"><?= $olusturan ?></option>

											<?php endforeach; ?>

										<?php endif; ?>

									</select>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>



			<!-- Müşteri Listesi Tablosu -->

			<div class="row">

				<div class="col-12">

					<div class="card">

						<div class="card-header">

							<h4 class="card-title">

								<i class="fa fa-list mr-2"></i>Müşteri Listesi

							</h4>

						</div>

						<div class="card-body">

							<?php if (isset($musteriler) && count($musteriler) > 0): ?>

								<div class="table-responsive">

									<table class="table table-striped table-hover" id="musteriListesiTable">

										<thead class="thead-dark">

											<tr>

												<th>ID</th>

												<th>Müşteri Adı</th>

												<th>Telefon</th>

												<th>E-posta</th>

												<th>Vergi/TC No</th>

												<th>Tip</th>

												<th>Durum</th>

												<th>Kayıt Tarihi</th>

												<th>Oluşturan</th>

												<th>İşlemler</th>

											</tr>

										</thead>

										<tbody>

											<?php foreach($musteriler as $musteri): ?>

												<tr class="<?= $musteri->cari_durum == 1 ? 'musteri-aktif' : 'musteri-pasif' ?>">

													<td><?= $musteri->cari_id ?></td>

													<td>

														<strong><?= $musteri->cari_ad ?> <?= $musteri->cari_soyad ?></strong>

														<?php if (!empty($musteri->cari_kodu)): ?>

															<br><small class="text-muted"><strong>Kod:</strong> <?= $musteri->cari_kodu ?></small>

														<?php endif; ?>

														<?php if (!empty($musteri->cari_adres)): ?>

															<br><small class="text-muted"><?= substr($musteri->cari_adres, 0, 50) ?>...</small>

														<?php endif; ?>

													</td>

													<td>

														<?php if (!empty($musteri->cari_firmaTelefon)): ?>

															<a href="tel:<?= $musteri->cari_firmaTelefon ?>" class="text-primary">

																<i class="fa fa-phone mr-1"></i><?= $musteri->cari_firmaTelefon ?>

															</a>

														<?php else: ?>

															<span class="text-muted">-</span>

														<?php endif; ?>

													</td>

													<td>

														<?php if (!empty($musteri->cari_firmaEPosta)): ?>

															<a href="mailto:<?= $musteri->cari_firmaEPosta ?>" class="text-primary">

																<i class="fa fa-envelope mr-1"></i><?= $musteri->cari_firmaEPosta ?>

															</a>

														<?php else: ?>

															<span class="text-muted">-</span>

														<?php endif; ?>

													</td>

													<td>

														<?php if (!empty($musteri->cari_vergiNumarasi)): ?>

															<small><strong>VN:</strong> <?= $musteri->cari_vergiNumarasi ?></small>

															<?php if (!empty($musteri->cari_vergiDairesi)): ?>

																<br><small class="text-muted"><?= $musteri->cari_vergiDairesi ?></small>

															<?php endif; ?>

														<?php endif; ?>

														<?php if (!empty($musteri->cari_tckn)): ?>

															<br><small><strong>TC:</strong> <?= $musteri->cari_tckn ?></small>

														<?php endif; ?>

														<?php if (empty($musteri->cari_vergiNumarasi) && empty($musteri->cari_tckn)): ?>

															<span class="text-muted">-</span>

														<?php endif; ?>

													</td>

													<td>

														<span class="badge badge-info badge-tip"><?= $musteri->tip_adi ?></span>

													</td>

													<td>

														<?php if ($musteri->cari_durum == 1): ?>

															<span class="badge badge-success">Aktif</span>

														<?php else: ?>

															<span class="badge badge-danger">Pasif</span>

														<?php endif; ?>

													</td>

													<td>

														<small><?= date('d.m.Y', strtotime($musteri->cari_olusturmaTarihi)) ?></small>

														<?php if (!empty($musteri->cari_olusturmaSaati)): ?>

															<br><small class="text-muted"><?= date('H:i', strtotime($musteri->cari_olusturmaSaati)) ?></small>

														<?php endif; ?>

													</td>

													<td>

														<small><?= $musteri->olusturan_kullanici ?></small>

													</td>

													<td>

														<div class="btn-group" role="group">

															<a href="<?= base_url('cari/cari-karti-duzenle/' . $musteri->cari_id); ?>" 

															   class="btn btn-sm btn-outline-primary" 

															   title="Düzenle">

																<i class="fa fa-edit"></i>

															</a>

															<button type="button" 

																	class="btn btn-sm btn-outline-danger btn-cari-sil" 

																	data-cari-id="<?= $musteri->cari_id ?>" 

																	data-cari-ad="<?= htmlspecialchars($musteri->cari_ad . ($musteri->cari_soyad ? ' ' . $musteri->cari_soyad : '')) ?>"

																	title="Sil">

																<i class="fa fa-trash"></i>

															</button>

														</div>

													</td>

												</tr>

											<?php endforeach; ?>

										</tbody>

									</table>

								</div>

							<?php else: ?>

								<div class="alert alert-info text-center">

									<i class="fa fa-info-circle fa-3x mb-3"></i>

									<h5>Henüz müşteri kaydı bulunmamaktadır.</h5>

									<p>Yeni müşteri eklemek için yukarıdaki "Yeni Müşteri Ekle" butonunu kullanabilirsiniz.</p>

									<a href="<?= base_url('cari/cari-karti-olustur'); ?>" class="btn btn-primary">

										<i class="fa fa-plus-circle mr-2"></i>İlk Müşterinizi Ekleyin

									</a>

								</div>

							<?php endif; ?>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>



<?php $this->load->view("include/footer-js"); ?>



<!-- DataTables JS -->

<script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.13.6/js/dataTables.bootstrap4.min.js"></script>



<script>

$(document).ready(function() {

	// DataTable başlat

	var table = $('#musteriListesiTable').DataTable({

		"language": {

			"url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json"

		},

		"order": [[ 7, "desc" ]], // Kayıt tarihine göre azalan sıralama

		"pageLength": 25,

		"responsive": true,

		"columnDefs": [

			{ "orderable": false, "targets": [9] } // İşlemler sütunu sıralanmasın

		]

	});



	// Kayıt tarihi filtresi

	$('#kayitTarihiBaslangic, #kayitTarihiBitis').change(function() {

		var baslangic = $('#kayitTarihiBaslangic').val();

		var bitis = $('#kayitTarihiBitis').val();

		

		// Tarih filtresi fonksiyonu

		$.fn.dataTable.ext.search.push(

			function(settings, data, dataIndex) {

				if (settings.nTable.id !== 'musteriListesiTable') {

					return true;

				}

				

				var kayitTarihi = data[7]; // Kayıt tarihi sütunu (0-based index)

				if (!kayitTarihi) return true;

				

				// Tarihi parse et (DD.MM.YYYY formatından)

				var tarihParts = kayitTarihi.split('.');

				if (tarihParts.length === 3) {

					var tarihStr = tarihParts[2] + '-' + tarihParts[1].padStart(2, '0') + '-' + tarihParts[0].padStart(2, '0');

					

					if (baslangic && tarihStr < baslangic) return false;

					if (bitis && tarihStr > bitis) return false;

				}

				

				return true;

			}

		);

		

		table.draw();

		

		// Filtre fonksiyonunu temizle (tekrar eklenmemesi için)

		$.fn.dataTable.ext.search.pop();

	});



	// Oluşturan filtresi

	$('#olusturanFiltre').change(function() {

		var olusturan = $(this).val();

		

		if (olusturan === '') {

			table.column(8).search('').draw(); // 8. sütun (Oluşturan)

		} else {

			table.column(8).search(olusturan).draw();

		}

	});



	// Filtreleri temizle butonu

	$('#filtreleriTemizle').click(function() {

		$('#kayitTarihiBaslangic').val('');

		$('#kayitTarihiBitis').val('');

		$('#olusturanFiltre').val('');

		

		// Tüm filtreleri temizle

		table.search('').columns().search('').draw();

		

		// Tarih filtre fonksiyonunu da temizle

		$.fn.dataTable.ext.search = [];

	});

	

	// Cari silme işlemi

	$(document).on('click', '.btn-cari-sil', function() {

		var cariId = $(this).data('cari-id');

		var cariAd = $(this).data('cari-ad');

		

		if (!cariId) {

			Swal.fire({

				icon: 'error',

				title: 'Hata',

				text: 'Cari ID bulunamadı!'

			});

			return;

		}

		

		// İlk kontrol: Bağımlı verileri kontrol et

		$.ajax({

			url: '<?= base_url("muhasebe/cari_sil_kontrol") ?>',

			type: 'POST',

			data: {

				cari_id: cariId

			},

			dataType: 'json',

			success: function(response) {

				if (response.status === 'error') {

					Swal.fire({

						icon: 'error',

						title: 'Hata',

						text: response.message

					});

				} else if (response.status === 'warning') {

					// Bağımlı veriler var, detaylı uyarı göster

					var bagimliVeriHtml = '<div class="alert alert-warning">';

					bagimliVeriHtml += '<strong>Uyarı:</strong> Bu işlem geri alınamaz!<br><br>';

					bagimliVeriHtml += '<strong>Silinecek veriler:</strong><br>';

					bagimliVeriHtml += '<ul class="list-unstyled">';

					

					response.data.forEach(function(veri) {

						bagimliVeriHtml += '<li><i class="fa fa-exclamation-triangle text-warning"></i> ';

						bagimliVeriHtml += '<strong>' + veri.tablo + ':</strong> ' + veri.adet + ' adet';

						bagimliVeriHtml += '<br><small class="text-muted">' + veri.aciklama + '</small></li><br>';

					});

					

					bagimliVeriHtml += '</ul></div>';

					

					Swal.fire({

						title: 'Cari Kaydı Silinecek',

						html: '<div class="text-left">' + 

							  '<p><strong>Cari:</strong> ' + response.cari_bilgi.ad + '</p>' +

							  '<p><strong>ID:</strong> ' + response.cari_bilgi.id + '</p>' +

							  (response.cari_bilgi.telefon ? '<p><strong>Telefon:</strong> ' + response.cari_bilgi.telefon + '</p>' : '') +

							  bagimliVeriHtml + 

							  '</div>',

						icon: 'warning',

						showCancelButton: true,

						confirmButtonColor: '#dc3545',

						cancelButtonColor: '#6c757d',

						confirmButtonText: '<i class="fa fa-trash"></i> Sil ve Tüm Verileri Temizle',

						cancelButtonText: '<i class="fa fa-times"></i> İptal',

						customClass: {

							confirmButton: 'btn btn-danger',

							cancelButton: 'btn btn-secondary'

						},

						buttonsStyling: false

					}).then((result) => {

						if (result.isConfirmed) {

							cariSil(cariId);

						}

					});

				} else if (response.status === 'confirm') {

					// Bağımlı veri yok, basit onay

					Swal.fire({

						title: 'Cari Kaydı Silinecek',

						html: '<div class="text-left">' + 

							  '<p><strong>Cari:</strong> ' + response.cari_bilgi.ad + '</p>' +

							  '<p><strong>ID:</strong> ' + response.cari_bilgi.id + '</p>' +

							  (response.cari_bilgi.telefon ? '<p><strong>Telefon:</strong> ' + response.cari_bilgi.telefon + '</p>' : '') +

							  '<div class="alert alert-info">' +

							  '<i class="fa fa-info-circle"></i> Bu cari kaydına ait başka veri bulunmamaktadır.' +

							  '</div>' +

							  '</div>',

						text: response.message,

						icon: 'warning',

						showCancelButton: true,

						confirmButtonColor: '#dc3545',

						cancelButtonColor: '#6c757d',

						confirmButtonText: '<i class="fa fa-trash"></i> Sil',

						cancelButtonText: '<i class="fa fa-times"></i> İptal',

						customClass: {

							confirmButton: 'btn btn-danger',

							cancelButton: 'btn btn-secondary'

						},

						buttonsStyling: false

					}).then((result) => {

						if (result.isConfirmed) {

							cariSil(cariId);

						}

					});

				}

			},

			error: function(xhr, status, error) {

				console.error('AJAX Error:', error);

				Swal.fire({

					icon: 'error',

					title: 'Hata',

					text: 'Kontrol işlemi sırasında bir hata oluştu: ' + error

				});

			}

		});

	});

	

	function cariSil(cariId) {

		// Loading göster

		Swal.fire({

			title: 'Siliniyor...',

			text: 'Lütfen bekleyin, işlem gerçekleştiriliyor.',

			icon: 'info',

			allowOutsideClick: false,

			allowEscapeKey: false,

			showConfirmButton: false,

			didOpen: () => {

				Swal.showLoading();

			}

		});

		

		$.ajax({

			url: '<?= base_url("muhasebe/cari_sil") ?>',

			type: 'POST',

			data: {

				cari_id: cariId,

				onay: 'evet'

			},

			dataType: 'json',

			success: function(response) {

				if (response.status === 'success') {

					Swal.fire({

						icon: 'success',

						title: 'Başarılı',

						text: response.message,

						timer: 2000,

						showConfirmButton: false

					}).then(() => {

						// Sayfayı yenile

						location.reload();

					});

				} else {

					Swal.fire({

						icon: 'error',

						title: 'Hata',

						text: response.message

					});

				}

			},

			error: function(xhr, status, error) {

				console.error('AJAX Error:', error);

				Swal.fire({

					icon: 'error',

					title: 'Hata',

					text: 'Silme işlemi sırasında bir hata oluştu: ' + error

				});

			}

		});

	}

});

</script>



<!-- SweetAlert2 CSS ve JS -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>



</body>

</html>

