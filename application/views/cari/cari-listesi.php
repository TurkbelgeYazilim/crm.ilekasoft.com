<!DOCTYPE html>
<html lang="tr">

<head>
	<?php $this->load->view("include/head-tags"); ?>	<style>
	.btn.text-danger, .btn.btn-white.text-danger, .btn.btn-danger, .btn-danger {
		color: #fff !important;
	}
	
	/* Görsel ve Evrak kolonları için stil */
	.gorsel-column, .evrak-column {
		width: 80px;
		text-align: center;
	}
	
	.gorsel-thumbnail {
		width: 50px;
		height: 50px;
		object-fit: cover;
		border-radius: 5px;
		cursor: pointer;
		border: 2px solid #e0e0e0;
		transition: all 0.3s ease;
	}
	
	.gorsel-thumbnail:hover {
		border-color: #007bff;
		transform: scale(1.1);
	}
	
	.badge-overlay {
		position: relative;
		display: inline-block;
	}
	
	.badge-overlay .badge {
		position: absolute;
		top: -5px;
		right: -5px;
		font-size: 10px;
		min-width: 18px;
		height: 18px;
		line-height: 18px;
		border-radius: 9px;
	}
	
	.evrak-btn {
		min-width: 50px;
	}
	
	/* Modal için stil */
	.carousel-item img {
		max-height: 400px;
		object-fit: contain;
		width: 100%;
	}
	
	.list-group-item:hover {
		background-color: #f8f9fa;
	}
	
	/* Mobilde Önceki Sayfa butonunu gizle */
	@media (max-width: 767.98px) {
		.col-sm-2 {
			display: none !important;
		}
		
		/* Mobilde görsel ve evrak kolonu boyutlarını ayarla */
		.gorsel-column, .evrak-column {
			width: 60px;
		}
		
		.gorsel-thumbnail {
			width: 40px;
			height: 40px;
		}
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

			<?php

			$firma = getirFirma();
			$deletePermission = $firma->ayarlar_deletePermission;
			?>
			<div class="page-header">
				<div class="row">
					<div class="col-sm-10">
						<h3 class="page-title">Müşteri Listesi</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
							</li>
							<li class="breadcrumb-item">Müşteri
							</li>
							<li class="breadcrumb-item active">Müşteri Listesi</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i>
							<br>Önceki Sayfa</a>
					</div>
				</div>
			</div>
			<!-- /Page Header -->
			<?php
			if ($_SERVER['QUERY_STRING']) {
				$qs = "?" . $_SERVER['QUERY_STRING'];
			}
			?>
			<div class="row">

				<div class="col-xl-12 col-md-12">
					<div class="card card-table">
						<div class="card-header">
							<div class="row">
								<div class="col">
									<h5 class="card-title">Müşteri Listesi</h5>
								</div>
								<div class="col-auto">
									<a href="<?= base_url("cari/cariListesiExcel$qs"); ?>"
									   class="btn btn-outline-success btn-sm"
									   style='font-family: Arial, Helvetica, sans-serif;'><i
												class="fa fa-file-excel"></i> Dışa aktar</a>
								</div>
								<div class="col-auto">
									<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm"
									   data-toggle="modal" data-target="#add_category"><i class="fa fa-search"></i>
										Arama</a>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0">									<thead>
									<tr>
										<th>Cari Kodu</th>
										<th>Cari Adı</th>
										<th>Cari Tipi</th>
										<th>Cari Grubu</th>
										<th>Vergi Dairesi</th>
										<th>İl</th>
										<th class="gorsel-column">İşletme Görsel</th>
										<th class="evrak-column">Evrak</th>
										<th>B/A</th>
										<th class="text-right">İşlem</th>
									</tr>
									</thead>
									<tbody>
									<?php 
									    $tumBorc=0;
									    $tumAlacak=0;
									    foreach ($cari as $cr) {

										$anaHesap = anaHesapBilgisi();

										$alias_pk = $cr->cari_alias_pk;

										$grubuq = "SELECT * FROM cariGruplari WHERE cariGrup_id = '$cr->cari_cariGrupKoduID'";
										$grubuexe = $this->db->query($grubuq)->row();

										$ilq = "SELECT * FROM iller WHERE id='$cr->cari_il'";
										$ilexe = $this->db->query($ilq)->row();

										/*$ilceq = "SELECT * FROM ilceler WHERE id='$cr->cari_ilce'";
											$ilceexe = $this->db->query($ilceq)->row();*/

										$cari_idsi = $cr->cari_id;

										$toplamBorcQ = "SELECT SUM(ch_borc) AS toplamBorc FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' AND ch_cariID = '$cari_idsi'";
										$toplamBorcExe = $this->db->query($toplamBorcQ)->row();

										$toplamAlacakQ = "SELECT SUM(ch_alacak) AS toplamAlacak FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' AND ch_cariID = '$cari_idsi'";
										$toplamAlacakExe = $this->db->query($toplamAlacakQ)->row();

										$toplamBorc = $toplamBorcExe->toplamBorc;
										$toplamAlacak = $toplamAlacakExe->toplamAlacak;
										$kalan = $toplamBorc - $toplamAlacak;

										$kalann = abs($kalan);
										

										if (filter_var($kalan, FILTER_VALIDATE_FLOAT) && $kalan > 0) {
											$bakiye = '<a href="javascript:void(0);" class="btn btn-outline-success btn-sm">' . number_format($kalann, 2,",",".") . ' ₺ (B)</a>';
										$tumBorc += $kalann;
										} else {
											$bakiye = '<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm">' . number_format($kalann, 2,",",".") . ' ₺ (A)</a>';
											
										$tumAlacak += $kalann;
										}
                                        $toplamBakiye += $kalann;
										?>
										<tr>
											<td>
												<a href="<?= base_url("cari/cari-hareketleri?cari=$cr->cari_id"); ?>"><?= $cr->cari_kodu; ?></a>
											</td>
											<td>
												<?php

												if ($alias_pk != "") {
													echo "<i class='fa fa-file-invoice text-dark' data-toggle='tooltip' data-placement='top' title='e-Fatura'></i>";
												}

												$lengthOfCariAd = strlen($cr->cari_ad);
												if ($lengthOfCariAd >= 24) { ?>
													<span data-toggle="tooltip" data-placement="top"
														  title="<?= $cr->cari_ad; ?>"
														  style="cursor:help;"><?php echo mb_substr($cr->cari_ad, 0, 24) . '...'; ?></span>
												<?php } else {
													echo $cr->cari_ad;
												} ?>
											</td>
											<td><?php $cariTipi = $cr->cari_bireysel;
												if ($cariTipi == 1) {
													echo "Bireysel";
												} elseif ($cariTipi == 0) {
													echo "Kurumsal";
												} elseif ($cariTipi == 2) {
													echo "Diğer";
												} ?></td>											<td><?= $grubuexe->cariGrup_ad; ?></td>
											<td><?= $cr->cari_vergiDairesi; ?></td>
											<td><?= $ilexe->il; ?></td>
											<td class="gorsel-column">
												<?php if (!empty($cr->fotograf_dosya)): ?>
													<?php 
													$fotograflar = explode(',', $cr->fotograf_dosya);
													$ilk_fotograf = $fotograflar[0];
													?>
													<div class="badge-overlay">
														<img src="<?= base_url('assets/uploads/' . $ilk_fotograf); ?>" 
															 alt="İşletme Görseli" 
															 class="gorsel-thumbnail"
															 data-toggle="modal" 
															 data-target="#gorselModal" 
															 data-images="<?= htmlspecialchars($cr->fotograf_dosya); ?>"
															 data-cari="<?= htmlspecialchars($cr->cari_ad); ?>">
														<?php if (count($fotograflar) > 1): ?>
															<span class="badge badge-primary">+<?= count($fotograflar) - 1 ?></span>
														<?php endif; ?>
													</div>
												<?php else: ?>
													<i class="fa fa-image text-muted" title="Görsel yok"></i>
												<?php endif; ?>
											</td>
											<td class="evrak-column">
												<?php if (!empty($cr->evrak_dosya)): ?>
													<?php 
													$evraklar = explode(',', $cr->evrak_dosya);
													?>
													<button type="button" 
															class="btn btn-sm btn-outline-primary evrak-btn" 
															data-toggle="modal" 
															data-target="#evrakModal"
															data-documents="<?= htmlspecialchars($cr->evrak_dosya); ?>"
															data-cari="<?= htmlspecialchars($cr->cari_ad); ?>"
															title="<?= count($evraklar) ?> evrak">
														<i class="fa fa-file"></i> <?= count($evraklar) ?>
													</button>
												<?php else: ?>
													<i class="fa fa-file text-muted" title="Evrak yok"></i>
												<?php endif; ?>
											</td>
											<td><?= $bakiye; ?></td>
											<td class="text-right">
												<a href="<?= base_url("cari/cari-hareketleri?cari=$cr->cari_id"); ?>"
												   class="btn btn-sm btn-white text-info mr-2"><i
															class="far fa-eye mr-1"></i>Cari Hareketleri</a>
												<a href="<?= base_url("raporlar/cari-stok-hareket-raporlari?cari=$cr->cari_id"); ?>"
												   class="btn btn-sm btn-white text-dark mr-2"><i
															class="fa fa-inbox mr-1"></i>Stok Hareketleri</a>
												<a href="<?= base_url("cari/cari-karti-duzenle/$cr->cari_id"); ?>"
												   class="btn btn-sm btn-white text-success mr-2"><i
															class="far fa-edit mr-1"></i> Düzenle</a>
												<?php if ($deletePermission == 1) { ?>
													<a href="javascript:void(0);" data-toggle="modal"
													   data-target="#cari_sil"
													   onclick="document.getElementById('cari_id').value='<?= $cr->cari_id ?>';document.getElementById('cari_ad').innerHTML='Cari kodu <?= $cr->cari_kodu ?> olan cariyi pasif hale getirmek istediğinizden emin misiniz?';"
													   class="btn btn-sm btn-white text-danger mr-2"><i
																class="far fa-trash-alt mr-1"></i> Sil</a>
												<?php } ?>
												<!--
												<a href="#" data-toggle="modal" data-target="#edit_category" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Düzenle</a>
												<a href="#" data-toggle="modal" data-target="#delete_category" class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i>Sil</a>
												-->
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
								<hr>
								<span style="margin-left:15px;">Toplam kayıt sayısı: <b><?= $count_of_list; ?></b></span>
								<span style="margin-left:15px;">Toplam borç: <b><?= number_format($tumBorc, 2,",","."); ?></b></span>
								<span style="margin-left:15px;">Toplam alacak: <b><?= number_format($tumAlacak, 2,",","."); ?></b></span>
								<br><br>
							</div>
						</div>
					</div>
					<?php echo $links; ?>
					<br><br>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Wrapper -->
	<?php
	$cariKodu = $this->input->get('cariKodu');
	$cariAdi = $this->input->get('cariAdi');
	$cariTipi = $this->input->get('bireysel');
	$cariGrubu = $this->input->get('cariGrubu');
	$bulunduguIl = $this->input->get('bulunduguIl');
	$tarihAraligi = $this->input->get('tarihAraligi');
	?>
	<!-- Add Category Modal -->
	<div id="add_category" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Cari Kartı Arama</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url("cari/cari-listesi"); ?>" method="GET">
						<div class="form-group">
							<label>Kayıt Tarihi Aralığına Göre </label>
							<input class="form-control" id="daterange" type="text" name="tarihAraligi"
								   value="<?= $tarihAraligi; ?>" autocomplete="off"/>
						</div>
						<div class="form-group">
							<label>Cari Koduna Göre </label>
							<input class="form-control" type="text" name="cariKodu" value="<?= $cariKodu; ?>"
								   autocomplete="off">
						</div>
						<div class="form-group">
							<label>Cari Adına Göre </label>
							<input class="form-control" type="text" name="cariAdi" value="<?= $cariAdi; ?>"
								   autocomplete="off">
						</div>
						<?php
						$anaHesap = anaHesapBilgisi();
						$cariGruplarq = "SELECT * FROM cariGruplari WHERE cariGrup_olusturanAnaHesap = '$anaHesap'";
						$cariGruplare = $this->db->query($cariGruplarq)->result();
						?>
						<div class="form-group">
							<label>Cari Tipine Göre</label>
							<select name="bireysel" class="form-control">
								<option value="">Cari tipi seçiniz...</option>
								<option value="true" <?php if ($cariTipi == "true") {
									echo "selected";
								} ?>>Bireysel Müşteri
								</option>
								<option value="false" <?php if ($cariTipi == "false") {
									echo "selected";
								} ?>>Kurumsal Müşteri
								</option>
							</select>
						</div>
						<div class="form-group">
							<label>Cari Grubuna Göre </label>
							<select name="cariGrubu" class="form-control">
								<option value="">Cari grup seçiniz...</option>
								<?php foreach ($cariGruplare as $cg) { ?>
									<option value="<?= $cg->cariGrup_id; ?>" <?php if ($cg->cariGrup_id == $cariGrubu) {
										echo "selected";
									} ?>><?= $cg->cariGrup_ad; ?></option>
								<?php } ?>
							</select>
						</div>
						<?php $iller = $this->vt->multiple("iller"); ?>
						<div class="form-group">
							<label>Bulunduğu İle Göre </label>
							<select name="bulunduguIl" class="form-control">
								<option value="">İl seçiniz...</option>
								<?php foreach ($iller as $il) { ?>
									<option value="<?= $il->id; ?>" <?php if ($il->id == $bulunduguIl) {
										echo "selected";
									} ?>><?= $il->il; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="submit-section">
							<button class="btn btn-danger submit-btn">Ara</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /Add Category Modal -->


	<!-- Modal Delete  -->
	<div id="cari_sil" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Cari Kartı Silme</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url("cari/cari_sil"); ?>" method="GET">
						<input type="hidden" name="cari_id" id="cari_id" value="">
						<p id="cari_ad"></p>
						<div class="submit-section">
							<button class="btn btn-danger submit-btn">Evet</button>
						</div>
					</form>
				</div>
			</div>
		</div>	</div>

	<!-- Görsel Modal -->
	<div id="gorselModal" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">İşletme Görselleri - <span id="gorselCariAd"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="gorselCarousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner" id="gorselCarouselInner">
							<!-- Görseller buraya eklenecek -->
						</div>
						<a class="carousel-control-prev" href="#gorselCarousel" role="button" data-slide="prev" style="display: none;" id="prevControl">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Önceki</span>
						</a>
						<a class="carousel-control-next" href="#gorselCarousel" role="button" data-slide="next" style="display: none;" id="nextControl">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Sonraki</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Evrak Modal -->
	<div id="evrakModal" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Evraklar - <span id="evrakCariAd"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="list-group" id="evrakListesi">
						<!-- Evraklar buraya eklenecek -->
					</div>
				</div>
			</div>
		</div>
	</div>


</div>
<!-- /Main Wrapper -->

<?php if ($this->session->flashdata('excel_ok')) : ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Excel dışa aktarma işlemi gerçekleştiriliyor.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>
<?php if ($this->session->flashdata('cari_sil_ok')) : ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Cari başarıyla pasif hale getirildi.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>
<?php $this->load->view("include/footer-js"); ?>
<!-- Select2 JS -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>

<script>
	$(function () {
		moment.locale('tr');
		$('#daterange').daterangepicker({
			opens: 'left',
			autoUpdateInput: false
		}, function (start, end, label) {
			$('#daterange').val(start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY'));
			//console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));		});
	});

	// Görsel Modal İşlevselliği
	$('#gorselModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var images = button.data('images');
		var cariAd = button.data('cari');
		
		$('#gorselCariAd').text(cariAd);
		
		if (images) {
			var imageArray = images.split(',');
			var carouselInner = $('#gorselCarouselInner');
			carouselInner.empty();
			
			imageArray.forEach(function(image, index) {
				var activeClass = index === 0 ? 'active' : '';
				var imageHtml = '<div class="carousel-item ' + activeClass + '">' +
					'<img class="d-block w-100" src="<?= base_url("assets/uploads/"); ?>' + image.trim() + '" ' +
					'alt="İşletme Görseli" style="max-height: 400px; object-fit: contain;">' +
					'</div>';
				carouselInner.append(imageHtml);
			});
			
			// Kontrol butonlarını göster/gizle
			if (imageArray.length > 1) {
				$('#prevControl, #nextControl').show();
			} else {
				$('#prevControl, #nextControl').hide();
			}
		}
	});

	// Evrak Modal İşlevselliği
	$('#evrakModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var documents = button.data('documents');
		var cariAd = button.data('cari');
		
		$('#evrakCariAd').text(cariAd);
		
		if (documents) {
			var documentArray = documents.split(',');
			var evrakListesi = $('#evrakListesi');
			evrakListesi.empty();
			
			documentArray.forEach(function(document, index) {
				var fileName = document.trim().split('/').pop().replace(/^[^_]*_/, ''); // Prefix'i kaldır
				var fileExtension = fileName.split('.').pop().toLowerCase();
				var icon = 'fa-file';
				
				// Dosya tipine göre ikon belirle
				if (['pdf'].includes(fileExtension)) {
					icon = 'fa-file-pdf text-danger';
				} else if (['doc', 'docx'].includes(fileExtension)) {
					icon = 'fa-file-word text-primary';
				} else if (['xls', 'xlsx'].includes(fileExtension)) {
					icon = 'fa-file-excel text-success';
				} else if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
					icon = 'fa-file-image text-info';
				}
				
				var documentHtml = '<a href="<?= base_url("assets/uploads/"); ?>' + document.trim() + '" ' +
					'class="list-group-item list-group-item-action" target="_blank">' +
					'<i class="fa ' + icon + ' mr-2"></i>' + fileName +
					'</a>';
				evrakListesi.append(documentHtml);
			});
		}
	});
</script>


</body>

</html>
