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

	

	.gorsel-btn {

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

	/* Mobile Card View Styles */

	.mobile-customer-card {

		background: #fff;

		border: 1px solid #e0e0e0;

		border-radius: 8px;

		margin-bottom: 15px;

		padding: 15px;

		box-shadow: 0 2px 4px rgba(0,0,0,0.1);

		cursor: pointer;

		transition: all 0.3s ease;

	}

	

	.mobile-customer-card:hover {

		box-shadow: 0 4px 8px rgba(0,0,0,0.15);

		transform: translateY(-2px);

	}

	

	.mobile-customer-card .card-header-info {

		display: flex;

		justify-content: space-between;

		align-items: center;

		margin-bottom: 10px;

		padding-bottom: 8px;

		border-bottom: 1px solid #f0f0f0;

		position: relative;

	}

		.mobile-customer-card .card-header-info::after {

		content: '\f107';

		font-family: 'Font Awesome 5 Free';

		font-weight: 900;

		position: absolute;

		right: 0;

		top: 50%;

		transform: translateY(-50%);

		color: #999;

		font-size: 14px;

		transition: transform 0.3s ease;

	}

	

	.mobile-customer-card.expanded .card-header-info::after {

		transform: translateY(-50%) rotate(180deg);

	}

	

	.mobile-customer-card .card-details {

		max-height: 0;

		overflow: hidden;

		transition: max-height 0.3s ease;

	}

	

	.mobile-customer-card.expanded .card-details {

		max-height: 1000px;

	}

	

	.mobile-customer-card .customer-name {

		font-weight: bold;

		color: #333;

		font-size: 16px;

		margin: 0;

	}

	

	.mobile-customer-card .customer-type {

		background: #007bff;

		color: white;

		padding: 4px 8px;

		border-radius: 12px;

		font-size: 11px;

		text-transform: uppercase;

	}

		.mobile-customer-card .customer-details {

		display: grid;

		grid-template-columns: 1fr 1fr;

		gap: 8px;

		font-size: 13px;

		margin-bottom: 10px;

	}

	

	.mobile-customer-card .detail-item {

		display: flex;

		flex-direction: column;

	}

	

	.mobile-customer-card .detail-label {

		font-weight: 600;

		color: #666;

		font-size: 11px;

		text-transform: uppercase;

		margin-bottom: 2px;

	}

	

	.mobile-customer-card .detail-value {

		color: #333;

		word-break: break-word;

	}

	

	.mobile-customer-card .media-section {

		display: flex;

		justify-content: space-between;

		align-items: center;

		margin-bottom: 10px;

		padding: 8px;

		background: #f8f9fa;

		border-radius: 6px;

	}

	

	.mobile-customer-card .media-item {

		display: flex;

		align-items: center;

		font-size: 12px;

	}

	

	.mobile-customer-card .media-item i {

		margin-right: 5px;

	}

	

	.mobile-customer-card .balance-section {

		text-align: center;

		margin-bottom: 10px;

	}

	

	.mobile-customer-card .action-buttons {

		display: flex;

		gap: 5px;

		flex-wrap: wrap;

	}

	

	.mobile-customer-card .action-buttons .btn {

		flex: 1;

		min-width: 80px;

		font-size: 11px;

		padding: 6px 8px;

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

		

		/* Mobilde düzenle butonunu en sola taşı */

		.mobile-edit-first {

			order: -1;

		}

				.action-buttons {

			display: flex;

			flex-wrap: wrap;

			gap: 5px;

		}

	}

	

	/* Mor renk düzenle butonu */

	.btn-purple {

		background-color: #6f42c1;

		border-color: #6f42c1;

		color: white;

	}

	

	.btn-purple:hover {

		background-color: #5a2d91;

		border-color: #5a2d91;

		color: white;

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
			
			<!-- İstatistik Kutucukları -->
			<div class="row mb-4">
				<div class="col-md-6">
					<div class="card border-left-primary shadow h-100 py-2">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
										Toplam Kayıt Sayısı</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($count_of_list, 0, ',', '.'); ?></div>
								</div>
								<div class="col-auto">
									<i class="fas fa-users fa-2x text-gray-300"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card border-left-success shadow h-100 py-2">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
										Toplam Tutar (Satış Faturaları)</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($toplamSatisTutar, 2, ',', '.'); ?> ₺</div>
								</div>
								<div class="col-auto">
									<i class="fas fa-file-invoice fa-2x text-gray-300"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /İstatistik Kutucukları -->

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

							</div>						</div>						<div class="card-body">

							<!-- Desktop Table View -->

							<div class="table-responsive d-none d-md-block">

								<table class="table table-striped custom-table mb-0">									<thead>									<tr>

										<th>Cari Adı</th>

										<th>Cari Tipi</th>

										<th>İşlemi Yapan</th>

										<th>İlçe</th>

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



										$alias_pk = $cr->cari_alias;										$grubuq = "SELECT * FROM cariGruplari WHERE cariGrup_id = '$cr->cari_cariGrupKoduID'";

										$grubuexe = $this->db->query($grubuq)->row();



										$ilq = "SELECT * FROM iller WHERE id='$cr->cari_il'";

										$ilexe = $this->db->query($ilq)->row();



										$ilceq = "SELECT * FROM ilceler WHERE id='$cr->cari_ilce'";

										$ilceexe = $this->db->query($ilceq)->row();



										// Cari oluşturan kullanıcı bilgisini çek

										$kullaniciQ = "SELECT CONCAT(kullanici_ad, ' ', kullanici_soyad) as tam_ad FROM kullanicilar WHERE kullanici_id = '$cr->cari_olusturan'";

										$kullaniciExe = $this->db->query($kullaniciQ)->row();



										$cari_idsi = $cr->cari_id;

										// Cari hareketleri sayfasındaki UNION sorgusu ile tutarlı hesaplama
										$cariHareketleriQ = "
											SELECT 
												NULL    AS Borc,
												COALESCE(bh_giris, bh_cikis) AS Alacak
											FROM bankahareketleri
											WHERE bh_cariID = '$cari_idsi'

											UNION ALL

											SELECT 
												NULL           AS Borc,
												cek_tutar      AS Alacak
											FROM cek
											WHERE cek_cariID = '$cari_idsi'

											UNION ALL

											SELECT 
												NULL    AS Borc,
												COALESCE(kh_giris, kh_cikis) AS Alacak
											FROM kasahareketleri
											WHERE kh_cariID = '$cari_idsi'

											UNION ALL

											SELECT 
												NULL     AS Borc,
												senet_tutar AS Alacak
											FROM senet
											WHERE senet_cariID = '$cari_idsi'

											UNION ALL

											SELECT
												satis_genelToplam  AS Borc,
												NULL               AS Alacak
											FROM satisfaturasi
											WHERE satis_cariID = '$cari_idsi'
										";
										
										$hareketler = $this->db->query($cariHareketleriQ)->result();
										
										// Bakiye hesaplama
										$toplamBorc = 0;
										$toplamAlacak = 0;
										foreach($hareketler as $hareket) {
											if($hareket->Borc) $toplamBorc += $hareket->Borc;
											if($hareket->Alacak) $toplamAlacak += $hareket->Alacak;
										}
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

										?>										<tr>

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

													echo "Diğer";												} ?></td>											<td><?= $kullaniciExe ? $kullaniciExe->tam_ad : 'Bilinmiyor'; ?></td>

											<td><?= $ilceexe ? $ilceexe->ilce : ''; ?></td>

											<td><?= $ilexe->il; ?></td>

											<td class="gorsel-column">

												<?php if (!empty($cr->fotograf_dosya)): ?>

													<?php 

													$fotograflar = explode(',', $cr->fotograf_dosya);

													?>

													<button type="button" 

														class="btn btn-sm btn-outline-success gorsel-btn" 

														title="<?= count($fotograflar) ?> görsel"

														onclick="window.open('<?= base_url("cari/gorselGoster/" . $cr->cari_id); ?>', 'gorselPencere', 'width=800,height=600,scrollbars=yes,resizable=yes')">

														<i class="fa fa-image"></i> <?= count($fotograflar) ?>

													</button>

												<?php else: ?>

													<i class="fa fa-image text-muted" title="Görsel yok"></i>

												<?php endif; ?>

											</td>

											<td class="evrak-column">

												<?php if (!empty($cr->evrak_dosya)): ?>

													<?php 

													$evraklar = explode(',', $cr->evrak_dosya);

													?>													<button type="button" 

															class="btn btn-sm btn-outline-primary evrak-btn" 

															title="<?= count($evraklar) ?> evrak"

															onclick="window.open('<?= base_url("cari/evrakGoster/" . $cr->cari_id); ?>', 'evrakPencere', 'width=800,height=600,scrollbars=yes,resizable=yes')">

														<i class="fa fa-file"></i> <?= count($evraklar) ?>

													</button>

												<?php else: ?>

													<i class="fa fa-file text-muted" title="Evrak yok"></i>

												<?php endif; ?>

											</td>

											<td><?= $bakiye; ?></td>											<td class="text-right">

												<div class="action-buttons">

													<?php if (grup_modul_yetkisi_var(120, 3)): ?>

													<a href="<?= base_url("cari/cari-karti-duzenle/$cr->cari_id"); ?>"

													   class="btn btn-sm btn-purple mobile-edit-first mr-2" title="Düzenle"><i

																class="far fa-edit"></i></a>

													<?php endif; ?>

													<a href="<?= base_url("cari/cari-hareketleri?cari=$cr->cari_id"); ?>"

													   class="btn btn-sm btn-white text-info mr-2"><i

																class="far fa-eye mr-1"></i>Cari Hareketleri</a>

													<?php if ($deletePermission == 1 && grup_modul_yetkisi_var(120, 4)) { ?>

														<a href="javascript:void(0);" data-toggle="modal"

														   data-target="#cari_sil"

														   onclick="document.getElementById('cari_id').value='<?= $cr->cari_id ?>';document.getElementById('cari_ad').innerHTML='Cari kodu <?= $cr->cari_kodu ?> olan cariyi pasif hale getirmek istediğinizden emin misiniz?';"

														   class="btn btn-sm btn-white text-danger mr-2"><i

																	class="far fa-trash-alt mr-1"></i> Sil</a>

													<?php } ?>

												</div>

												<!--

												<a href="#" data-toggle="modal" data-target="#edit_category" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Düzenle</a>

												<a href="#" data-toggle="modal" data-target="#delete_category" class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i>Sil</a>

												-->

											</td>

										</tr>

									<?php } ?>

									</tbody>

								</table>								<hr>

								<span style="margin-left:15px;">Toplam kayıt sayısı: <b><?= $count_of_list; ?></b></span>

								<span style="margin-left:15px;">Toplam borç: <b><?= number_format($tumBorc, 2,",","."); ?></b></span>

								<span style="margin-left:15px;">Toplam alacak: <b><?= number_format($tumAlacak, 2,",","."); ?></b></span>

								<br><br>

							</div>									<!-- Mobile Card View -->

							<div class="d-block d-md-none" id="card-view">

								<?php if(isset($cari) && count($cari) > 0): ?>

									<?php 

									    $tumBorcCard = 0;

									    $tumAlacakCard = 0;

									    foreach ($cari as $cr): 

									        $anaHesap = anaHesapBilgisi();

									        $alias_pk = $cr->cari_alias;

									        $grubuq = "SELECT * FROM cariGruplari WHERE cariGrup_id = '$cr->cari_cariGrupKoduID'";

									        $grubuexe = $this->db->query($grubuq)->row();

									        $ilq = "SELECT * FROM iller WHERE id='$cr->cari_il'";

									        $ilexe = $this->db->query($ilq)->row();

									        

									        $cari_idsi = $cr->cari_id;

									        // Cari hareketleri sayfasındaki UNION sorgusu ile tutarlı hesaplama
									        $cariHareketleriQ = "
									            SELECT 
									                NULL    AS Borc,
									                COALESCE(bh_giris, bh_cikis) AS Alacak
									            FROM bankahareketleri
									            WHERE bh_cariID = '$cari_idsi'

									            UNION ALL

									            SELECT 
									                NULL           AS Borc,
									                cek_tutar      AS Alacak
									            FROM cek
									            WHERE cek_cariID = '$cari_idsi'

									            UNION ALL

									            SELECT 
									                NULL    AS Borc,
									                COALESCE(kh_giris, kh_cikis) AS Alacak
									            FROM kasahareketleri
									            WHERE kh_cariID = '$cari_idsi'

									            UNION ALL

									            SELECT 
									                NULL     AS Borc,
									                senet_tutar AS Alacak
									            FROM senet
									            WHERE senet_cariID = '$cari_idsi'

									            UNION ALL

									            SELECT
									                satis_genelToplam  AS Borc,
									                NULL               AS Alacak
									            FROM satisfaturasi
									            WHERE satis_cariID = '$cari_idsi'
									        ";
									        
									        $hareketler = $this->db->query($cariHareketleriQ)->result();
									        
									        // Bakiye hesaplama
									        $toplamBorc = 0;
									        $toplamAlacak = 0;
									        foreach($hareketler as $hareket) {
									            if($hareket->Borc) $toplamBorc += $hareket->Borc;
									            if($hareket->Alacak) $toplamAlacak += $hareket->Alacak;
									        }
									        $kalan = $toplamBorc - $toplamAlacak;

									        $kalann = abs($kalan);

									        

									        if (filter_var($kalan, FILTER_VALIDATE_FLOAT) && $kalan > 0) {

									            $bakiye = '<span class="btn btn-outline-success btn-sm">' . number_format($kalann, 2,",",".") . ' ₺ (B)</span>';

									            $tumBorcCard += $kalann;

									        } else {

									            $bakiye = '<span class="btn btn-outline-danger btn-sm">' . number_format($kalann, 2,",",".") . ' ₺ (A)</span>';

									            $tumAlacakCard += $kalann;

									        }

									?>									<div class="mobile-customer-card" data-cari-id="<?= $cr->cari_id; ?>">

										<div class="card-header-info">

											<h6 class="customer-name">

												<?php if ($alias_pk != ""): ?>

													<i class='fa fa-file-invoice text-dark' data-toggle='tooltip' data-placement='top' title='e-Fatura'></i>

												<?php endif; ?>

												<?= strlen($cr->cari_ad) >= 30 ? mb_substr($cr->cari_ad, 0, 30) . '...' : $cr->cari_ad; ?>

											</h6>

											<span class="customer-type" style="<?php 

												if (filter_var($kalan, FILTER_VALIDATE_FLOAT) && $kalan > 0) {

													echo 'background: #28a745;'; // Yeşil (Borç)

												} else {

													echo 'background: #dc3545;'; // Kırmızı (Alacak)

												}

											?>">

												<?= number_format($kalann, 2,",",".") . ' ₺ (' . (filter_var($kalan, FILTER_VALIDATE_FLOAT) && $kalan > 0 ? 'B' : 'A') . ')'; ?>

											</span>

										</div>										

										<div class="card-details">											<div class="customer-details">

												<div class="detail-item">

													<span class="detail-label">İşlemi Yapan</span>

													<span class="detail-value"><?= $kullaniciExe ? $kullaniciExe->tam_ad : 'Bilinmiyor'; ?></span>

												</div>

												<div class="detail-item">

													<span class="detail-label">İlçe</span>

													<span class="detail-value"><?= $ilceexe ? $ilceexe->ilce : '-'; ?></span>

												</div>

												<div class="detail-item">

													<span class="detail-label">İl</span>

													<span class="detail-value"><?= $ilexe->il; ?></span>

												</div>

												<div class="detail-item">

													<span class="detail-label">Cari Tipi</span>

													<span class="detail-value">

														<?php 

														$cariTipi = $cr->cari_bireysel;

														if ($cariTipi == 1) echo "Bireysel";

														elseif ($cariTipi == 0) echo "Kurumsal";

														elseif ($cariTipi == 2) echo "Diğer";

														?>

													</span>

												</div>

											</div>

											

											<!-- Media Section -->

											<div class="media-section">

											<div class="media-item">

												<?php if (!empty($cr->fotograf_dosya)): ?>

													<?php 

													$fotograflar = explode(',', $cr->fotograf_dosya);

													?>

													<button type="button" 

														class="btn btn-sm btn-outline-success gorsel-btn" 

														style="padding: 4px 8px; font-size: 10px;"

														onclick="window.open('<?= base_url("cari/gorselGoster/" . $cr->cari_id); ?>', 'gorselPencere', 'width=800,height=600,scrollbars=yes,resizable=yes')">

														<i class="fa fa-image"></i> <?= count($fotograflar) ?>

													</button>

												<?php else: ?>

													<i class="fa fa-image text-muted"></i>

													<span class="text-muted">Görsel yok</span>

												<?php endif; ?>

											</div>

											

											<div class="media-item">

												<?php if (!empty($cr->evrak_dosya)): ?>

													<?php 

													$evraklar = explode(',', $cr->evrak_dosya);

													?>

													<button type="button" 

														class="btn btn-sm btn-outline-primary evrak-btn" 

														style="padding: 4px 8px; font-size: 10px;"

														onclick="window.open('<?= base_url("cari/evrakGoster/" . $cr->cari_id); ?>', 'evrakPencere', 'width=800,height=600,scrollbars=yes,resizable=yes')">

														<i class="fa fa-file"></i> <?= count($evraklar) ?>

													</button>

												<?php else: ?>

													<i class="fa fa-file text-muted"></i>

													<span class="text-muted">Evrak yok</span>

												<?php endif; ?>

											</div>											</div>

											

											<!-- Action Buttons -->

											<div class="action-buttons">

												<?php if (grup_modul_yetkisi_var(120, 3)): ?>

												<a href="<?= base_url("cari/cari-karti-duzenle/$cr->cari_id"); ?>"

												   class="btn btn-sm btn-purple" title="Düzenle">

												   <i class="far fa-edit"></i>

												</a>

												<?php endif; ?>

												<a href="<?= base_url("cari/cari-hareketleri?cari=$cr->cari_id"); ?>"

												   class="btn btn-sm btn-outline-info">

												   <i class="far fa-eye"></i> Hareketler

												</a>

												<?php if ($deletePermission == 1 && grup_modul_yetkisi_var(120, 4)): ?>

													<a href="javascript:void(0);" data-toggle="modal"

													   data-target="#cari_sil"

													   onclick="document.getElementById('cari_id').value='<?= $cr->cari_id ?>';document.getElementById('cari_ad').innerHTML='Cari kodu <?= $cr->cari_kodu ?> olan cariyi pasif hale getirmek istediğinizden emin misiniz?';"

													   class="btn btn-sm btn-outline-danger">

													   <i class="far fa-trash-alt"></i>

													</a>

												<?php endif; ?>

											</div>

										</div>

									</div>

									<?php endforeach; ?>

									

									<!-- Card View Summary -->

									<div class="mt-3 p-3" style="background: #f8f9fa; border-radius: 8px;">

										<div class="row text-center">

											<div class="col-4">

												<strong>Toplam Kayıt</strong><br>

												<span class="text-primary"><?= $count_of_list; ?></span>

											</div>

											<div class="col-4">

												<strong>Toplam Borç</strong><br>

												<span class="text-success"><?= number_format($tumBorcCard, 2,",","."); ?></span>

											</div>

											<div class="col-4">

												<strong>Toplam Alacak</strong><br>

												<span class="text-danger"><?= number_format($tumAlacakCard, 2,",","."); ?></span>

											</div>

										</div>

									</div>

								<?php else: ?>

									<div class="text-center text-muted p-4">

										<i class="fa fa-users fa-3x mb-3"></i>

										<p>Kayıt bulunamadı.</p>

									</div>

								<?php endif; ?>

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

	$islemYapan = $this->input->get('islemYapan');

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

						</div>						<?php

						$anaHesap = anaHesapBilgisi();

						

						// Kullanıcı grup bilgisi kontrol et

						$control = session("r", "login_info");

						$user_group_id = $control->grup_id;

						$admin_groups = [1, 2, 5, 7];

						$is_admin = in_array($user_group_id, $admin_groups);

						

						// Admin gruplar için tüm kullanıcıları göster, diğerleri için sadece kendileri ve bağlılarını

						if ($is_admin) {

							$kullanicilarQ = "SELECT kullanici_id, kullanici_ad, kullanici_soyad FROM kullanicilar WHERE kullanici_olusturanAnaHesap = '$anaHesap' ORDER BY kullanici_ad, kullanici_soyad";

						} else {

							$u_id = $control->kullanici_id;

							$kullanicilarQ = "SELECT kullanici_id, kullanici_ad, kullanici_soyad FROM kullanicilar WHERE (kullanici_id = '$u_id' OR kullanici_sorumluMudur = '$u_id') ORDER BY kullanici_ad, kullanici_soyad";

						}

						$kullanicilarE = $this->db->query($kullanicilarQ)->result();

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

							<label>İşlemi Yapana Göre </label>

							<select name="islemYapan" class="form-control">

								<option value="">İşlem yapanı seçiniz...</option>

								<?php foreach ($kullanicilarE as $kullanici) { ?>

									<option value="<?= $kullanici->kullanici_id; ?>" <?php if ($kullanici->kullanici_id == $islemYapan) {

										echo "selected";

									} ?>><?= $kullanici->kullanici_ad . ' ' . $kullanici->kullanici_soyad; ?></option>

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

				</div>				<div class="modal-body">

					<div class="list-group" id="gorselListesi">

						<!-- Görseller buraya eklenecek -->

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



<script>	$(function () {

		moment.locale('tr');

		$('#daterange').daterangepicker({

			opens: 'left',

			autoUpdateInput: false

		}, function (start, end, label) {

			$('#daterange').val(start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY'));

			//console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

		});

	});	// Base URL'yi JavaScript'e tanımlayalım

	var baseUrl = '<?= base_url(); ?>';

	

	// Manuel modal açma fonksiyonları

	function openGorselModal(images, cariAd, cariId) {

		console.log('Manuel görsel modal açılıyor:', {images: images, cariAd: cariAd, cariId: cariId});

		

		if (!cariId || cariId === undefined || cariId === null || cariId === '') {

			console.error('Manuel modal açma - Cari ID boş!');

			alert('HATA: Cari ID değeri bulunamadı!');

			return;

		}

		

		$('#gorselCariAd').text(cariAd);

		

		if (images && images !== '') {

			var imageArray = images.split(',');

			var gorselListesi = $('#gorselListesi');

			gorselListesi.empty();

			

			imageArray.forEach(function(image, index) {

				var trimmedImage = image.trim();

				var fileName = trimmedImage.split('/').pop().replace(/^[^_]*_/, '');

				var imageUrl = baseUrl + 'assets/uploads/' + trimmedImage;

				

				var imageHtml = '<div class="list-group-item d-flex align-items-center justify-content-between">' +

					'<div class="d-flex align-items-center flex-grow-1">' +

					'<a href="' + imageUrl + '" target="_blank" class="d-flex align-items-center text-decoration-none flex-grow-1">' +

					'<img src="' + imageUrl + '" alt="Görsel" class="img-thumbnail mr-2" style="width: 60px; height: 60px; object-fit: cover;">' +

					fileName +

					'</a>' +

					'</div>' +

					'<button type="button" class="btn btn-sm btn-outline-danger ml-2" ' +

					'onclick="silGorsel(\'' + cariId + '\', \'' + trimmedImage + '\', this)" ' +

					'title="Görseli sil">' +

					'<i class="fa fa-trash"></i>' +

					'</button>' +

					'</div>';

				gorselListesi.append(imageHtml);

			});

		} else {

			$('#gorselListesi').html('<div class="text-center text-muted p-4">Görsel bulunamadı</div>');

		}

		

		$('#gorselModal').modal('show');

	}

	

	function openEvrakModal(documents, cariAd, cariId) {

		console.log('Manuel evrak modal açılıyor:', {documents: documents, cariAd: cariAd, cariId: cariId});

		

		if (!cariId || cariId === undefined || cariId === null || cariId === '') {

			console.error('Manuel modal açma - Cari ID boş!');

			alert('HATA: Cari ID değeri bulunamadı!');

			return;

		}

		

		$('#evrakCariAd').text(cariAd);

		

		if (documents && documents !== '') {

			var documentArray = documents.split(',');

			var evrakListesi = $('#evrakListesi');

			evrakListesi.empty();

			

			documentArray.forEach(function(document, index) {

				var trimmedDocument = document.trim();

				var fileName = trimmedDocument.split('/').pop().replace(/^[^_]*_/, '');

				var fileExtension = fileName.split('.').pop().toLowerCase();

				var icon = 'fa-file';

				

				if (['pdf'].includes(fileExtension)) {

					icon = 'fa-file-pdf text-danger';

				} else if (['doc', 'docx'].includes(fileExtension)) {

					icon = 'fa-file-word text-primary';

				} else if (['xls', 'xlsx'].includes(fileExtension)) {

					icon = 'fa-file-excel text-success';

				} else if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {

					icon = 'fa-file-image text-info';

				}

				

				var documentUrl = baseUrl + 'assets/uploads/' + trimmedDocument;

				

				var documentHtml = '<div class="list-group-item d-flex align-items-center justify-content-between">' +

					'<div class="d-flex align-items-center flex-grow-1">' +

					'<a href="' + documentUrl + '" target="_blank" class="d-flex align-items-center text-decoration-none flex-grow-1">' +

					'<i class="fa ' + icon + ' mr-2"></i>' + fileName +

					'</a>' +

					'</div>' +

					'<button type="button" class="btn btn-sm btn-outline-danger ml-2" ' +

					'onclick="silEvrak(\'' + cariId + '\', \'' + trimmedDocument + '\', this)" ' +

					'title="Evrakı sil">' +

					'<i class="fa fa-trash"></i>' +

					'</button>' +

					'</div>';

				evrakListesi.append(documentHtml);

			});

		} else {

			$('#evrakListesi').html('<div class="text-center text-muted p-4">Evrak bulunamadı</div>');

		}

		

		$('#evrakModal').modal('show');

	}

	

	// Görsel Modal İşlevselliği

	$('#gorselModal').on('show.bs.modal', function (event) {

		console.log('=== GÖRSEL MODAL AÇILIYOR ===');

		console.log('Event:', event);

		

		var button = $(event.relatedTarget);

		console.log('Button element:', button);

		console.log('Button HTML:', button[0] ? button[0].outerHTML : 'Buton bulunamadı!');

		

		var images = button.data('images');

		var cariAd = button.data('cari');

		var cariId = button.data('cariid');

		

		console.log('Button data attributes:');

		console.log('- images:', images);

		console.log('- cari:', cariAd);

		console.log('- cariid:', cariId);

		

		// Eğer cariid data attribute'u yoksa, alternatif yoldan al

		if (!cariId || cariId === undefined || cariId === null || cariId === '') {

			console.log('cariid data attribute bulunamadı, alternatif yoldan alınıyor...');

			

			// Önce tablo satırından al

			var tableRow = button.closest('tr');

			if (tableRow.length > 0) {

				var hareketlerLink = tableRow.find('a[href*="cari-hareketleri"]');

				console.log('Hareketler link (table):', hareketlerLink);

				if (hareketlerLink.length > 0) {

					var href = hareketlerLink.attr('href');

					console.log('Href (table):', href);

					if (href && href.includes('cari=')) {

						cariId = href.split('cari=')[1];

						console.log('Alternatif yoldan alınan cariId (table):', cariId);

					}

				}

			}

			

			// Eğer hala bulunamadıysa mobil karttan al

			if (!cariId || cariId === undefined || cariId === null || cariId === '') {

				var mobileCard = button.closest('.mobile-customer-card');

				if (mobileCard.length > 0) {

					var hareketlerLinkMobile = mobileCard.find('a[href*="cari-hareketleri"]');

					console.log('Hareketler link (mobile):', hareketlerLinkMobile);

					if (hareketlerLinkMobile.length > 0) {

						var hrefMobile = hareketlerLinkMobile.attr('href');

						console.log('Href (mobile):', hrefMobile);

						if (hrefMobile && hrefMobile.includes('cari=')) {

							cariId = hrefMobile.split('cari=')[1];

							console.log('Alternatif yoldan alınan cariId (mobile):', cariId);

						}

					}

				}

			}

		}

		

		console.log('Modal açılıyor - Images RAW:', images);

		console.log('Images type:', typeof images);

		console.log('Cari Adı:', cariAd);

		console.log('Cari ID:', cariId);

		console.log('Cari ID Type:', typeof cariId);

		

		// Eğer cariId undefined/null/empty ise hata ver

		if (!cariId || cariId === undefined || cariId === null || cariId === '') {

			console.error('CARİ ID DEĞERİ BULUNAMADI!');

			console.error('Button data-cariid değeri:', button.data('cariid'));

			console.error('Button tüm data değerleri:', button.data());

			alert('HATA: Cari ID değeri bulunamadı! Konsola bakın.');

			return;

		}

		

		$('#gorselCariAd').text(cariAd);

		

		if (images && images !== '') {

			console.log('Images mevcut, işlemeye devam ediliyor...');

			var imageArray = images.split(',');

			console.log('Image Array:', imageArray);

			console.log('Array length:', imageArray.length);

			

			var gorselListesi = $('#gorselListesi');

			gorselListesi.empty();

			console.log('Görsel listesi temizlendi');

			

			imageArray.forEach(function(image, index) {

				var trimmedImage = image.trim();

				console.log('Processing image ' + index + ':', trimmedImage);

				

				var fileName = trimmedImage.split('/').pop();

				var fileExtension = fileName.split('.').pop().toLowerCase();

				var imageUrl = baseUrl + 'assets/uploads/' + trimmedImage;

				

				console.log('Final Image URL:', imageUrl);

				

				// Görsel için mini thumbnail gösterimi + silme butonu

				var imageHtml = '<div class="list-group-item d-flex align-items-center justify-content-between">' +

					'<div class="d-flex align-items-center flex-grow-1">' +

					'<img src="' + imageUrl + '" alt="Görsel" ' +

					'style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px; margin-right: 15px; cursor: pointer;" ' +

					'onclick="window.open(\'' + imageUrl + '\', \'_blank\')" ' +

					'onerror="console.log(\'Image load error: ' + imageUrl + '\')" ' +

					'onload="console.log(\'Image loaded successfully: ' + imageUrl + '\')">' +

					'<div>' +

					'<i class="fa fa-file-image text-success mr-2"></i>' + fileName +

					'<br><small class="text-muted">Görüntülemek için tıklayın</small>' +

					'</div>' +

					'</div>' +

					'<button type="button" class="btn btn-sm btn-outline-danger ml-2" ' +

					'onclick="silGorsel(\'' + cariId + '\', \'' + trimmedImage + '\', this)" ' +

					'title="Görseli sil">' +

					'<i class="fa fa-trash"></i>' +

					'</button>' +

					'</div>';

				

				console.log('Adding HTML:', imageHtml);

				gorselListesi.append(imageHtml);

			});

			

			console.log('Final görsel content:', gorselListesi.html());

		} else {

			console.log('Images verisi boş veya yok! Value:', images);

			var gorselListesi = $('#gorselListesi');

			gorselListesi.html('<div class="text-center text-muted p-4">Görsel bulunamadı</div>');

		}

		

		console.log('=== GÖRSEL MODAL İŞLEMİ TAMAMLANDI ===');

	});	// Evrak Modal İşlevselliği

	$('#evrakModal').on('show.bs.modal', function (event) {

		console.log('=== EVRAK MODAL AÇILIYOR ===');

		console.log('Event:', event);

		

		var button = $(event.relatedTarget);

		console.log('Button element:', button);

		console.log('Button HTML:', button[0] ? button[0].outerHTML : 'Buton bulunamadı!');

		

		var documents = button.data('documents');

		var cariAd = button.data('cari');

		var cariId = button.data('cariid');

		

		console.log('Button data attributes:');

		console.log('- documents:', documents);

		console.log('- cari:', cariAd);

		console.log('- cariid:', cariId);

		

		// Eğer cariid data attribute'u yoksa, alternatif yoldan al

		if (!cariId || cariId === undefined || cariId === null || cariId === '') {

			console.log('cariid data attribute bulunamadı, alternatif yoldan alınıyor...');

			

			// Önce tablo satırından al

			var tableRow = button.closest('tr');

			if (tableRow.length > 0) {

				var hareketlerLink = tableRow.find('a[href*="cari-hareketleri"]');

				console.log('Hareketler link (table):', hareketlerLink);

				if (hareketlerLink.length > 0) {

					var href = hareketlerLink.attr('href');

					console.log('Href (table):', href);

					if (href && href.includes('cari=')) {

						cariId = href.split('cari=')[1];

						console.log('Alternatif yoldan alınan cariId (table):', cariId);

					}

				}

			}

			

			// Eğer hala bulunamadıysa mobil karttan al

			if (!cariId || cariId === undefined || cariId === null || cariId === '') {

				var mobileCard = button.closest('.mobile-customer-card');

				if (mobileCard.length > 0) {

					var hareketlerLinkMobile = mobileCard.find('a[href*="cari-hareketleri"]');

					console.log('Hareketler link (mobile):', hareketlerLinkMobile);

					if (hareketlerLinkMobile.length > 0) {

						var hrefMobile = hareketlerLinkMobile.attr('href');

						console.log('Href (mobile):', hrefMobile);

						if (hrefMobile && hrefMobile.includes('cari=')) {

							cariId = hrefMobile.split('cari=')[1];

							console.log('Alternatif yoldan alınan cariId (mobile):', cariId);

						}

					}

				}

			}

		}

		

		console.log('Evrak Modal - Cari ID:', cariId, 'Cari Adı:', cariAd);

		

		// Eğer cariId undefined/null/empty ise hata ver

		if (!cariId || cariId === undefined || cariId === null || cariId === '') {

			console.error('CARİ ID DEĞERİ BULUNAMADI!');

			console.error('Button data-cariid değeri:', button.data('cariid'));

			console.error('Button tüm data değerleri:', button.data());

			alert('HATA: Cari ID değeri bulunamadı! Konsola bakın.');

			return;

		}

		

		$('#evrakCariAd').text(cariAd);

		

		if (documents) {

			var documentArray = documents.split(',');

			console.log('Document Array:', documentArray);

			

			var evrakListesi = $('#evrakListesi');

			evrakListesi.empty();

			

			documentArray.forEach(function(document, index) {

				var trimmedDocument = document.trim();

				var fileName = trimmedDocument.split('/').pop().replace(/^[^_]*_/, ''); // Prefix'i kaldır

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

				

				var documentUrl = baseUrl + 'assets/uploads/' + trimmedDocument;

				console.log('Document URL:', documentUrl);

				

				var documentHtml = '<div class="list-group-item d-flex align-items-center justify-content-between">' +

					'<div class="d-flex align-items-center flex-grow-1">' +

					'<a href="' + documentUrl + '" target="_blank" class="d-flex align-items-center text-decoration-none flex-grow-1">' +

					'<i class="fa ' + icon + ' mr-2"></i>' + fileName +

					'</a>' +

					'</div>' +

					'<button type="button" class="btn btn-sm btn-outline-danger ml-2" ' +

					'onclick="silEvrak(\'' + cariId + '\', \'' + trimmedDocument + '\', this)" ' +

					'title="Evrakı sil">' +

					'<i class="fa fa-trash"></i>' +

					'</button>' +

					'</div>';

				evrakListesi.append(documentHtml);

			});

		} else {

			console.log('Documents verisi boş veya yok!');		}

	});	// Görsel silme fonksiyonu

	function silGorsel(cariId, dosyaAdi, button) {

		console.log('Görsel silme - Cari ID:', cariId, 'Dosya:', dosyaAdi);

		

		if (confirm('Bu görseli silmek istediğinizden emin misiniz?\n\nDosya: ' + dosyaAdi.split('/').pop())) {

			// Butonu devre dışı bırak

			$(button).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

			

			$.ajax({

				url: baseUrl + 'cari/gorselSil',

				type: 'POST',

				data: {

					cari_id: cariId,

					dosya_adi: dosyaAdi

				},

				success: function(response) {

					try {

						var result = JSON.parse(response);

						if (result.success) {

							// Satırı kaldır

							$(button).closest('.list-group-item').fadeOut(300, function() {

								$(this).remove();

								

								// Eğer hiç görsel kalmadıysa

								if ($('#gorselListesi .list-group-item').length === 0) {

									$('#gorselListesi').html('<div class="text-center text-muted p-4">Görsel bulunamadı</div>');

								}

							});

							

							// Sayfayı yenile (güncel veriyi göstermek için)

							setTimeout(function() {

								location.reload();

							}, 1000);

							

							// Success alert

							swal({

								title: "Başarılı",

								text: "Görsel başarıyla silindi.",

								type: "success",

								timer: 2000,

								showConfirmButton: false

							});

						} else {

							alert('Hata: ' + (result.message || 'Görsel silinemedi'));

							$(button).prop('disabled', false).html('<i class="fa fa-trash"></i>');

						}

					} catch (e) {

						alert('Beklenmeyen bir hata oluştu');

						$(button).prop('disabled', false).html('<i class="fa fa-trash"></i>');

					}

				},

				error: function() {

					alert('Sunucu hatası oluştu');

					$(button).prop('disabled', false).html('<i class="fa fa-trash"></i>');

				}

			});

		}

	}	// Evrak silme fonksiyonu

	function silEvrak(cariId, dosyaAdi, button) {

		console.log('Evrak silme - Cari ID:', cariId, 'Dosya:', dosyaAdi);

		

		if (confirm('Bu evrakı silmek istediğinizden emin misiniz?\n\nDosya: ' + dosyaAdi.split('/').pop())) {

			// Butonu devre dışı bırak

			$(button).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

			

			$.ajax({

				url: baseUrl + 'cari/evrakSil',

				type: 'POST',

				data: {

					cari_id: cariId,

					dosya_adi: dosyaAdi

				},

				success: function(response) {

					try {

						var result = JSON.parse(response);

						if (result.success) {

							// Satırı kaldır

							$(button).closest('.list-group-item').fadeOut(300, function() {

								$(this).remove();

								

								// Eğer hiç evrak kalmadıysa

								if ($('#evrakListesi .list-group-item').length === 0) {

									$('#evrakListesi').html('<div class="text-center text-muted p-4">Evrak bulunamadı</div>');

								}

							});

							

							// Sayfayı yenile (güncel veriyi göstermek için)

							setTimeout(function() {

								location.reload();

							}, 1000);

							

							// Success alert

							swal({

								title: "Başarılı",

								text: "Evrak başarıyla silindi.",

								type: "success",

								timer: 2000,

								showConfirmButton: false

							});

						} else {

							alert('Hata: ' + (result.message || 'Evrak silinemedi'));

							$(button).prop('disabled', false).html('<i class="fa fa-trash"></i>');

						}

					} catch (e) {

						alert('Beklenmeyen bir hata oluştu');

						$(button).prop('disabled', false).html('<i class="fa fa-trash"></i>');

					}

				},

				error: function() {

					alert('Sunucu hatası oluştu');

					$(button).prop('disabled', false).html('<i class="fa fa-trash"></i>');

				}			});		}	}	// Mobile Card Collapsible özelliği

	$(document).ready(function() {

		// Sidebar menüyü yeniden başlat

		setTimeout(function() {

			if (typeof window.initSidebarMenu === 'function') {

				window.initSidebarMenu();

				console.log('Sidebar menü cari listesi sayfasında yeniden başlatıldı');

			}

		}, 100);

		

		// Sadece mobil kart işlevselliği - sidebar'a müdahale etme

		$(document).on('click', '.mobile-customer-card', function(e) {

			// Buton ve link tıklamalarını önle

			if ($(e.target).closest('a, button').length > 0) {

				return;

			}

			

			// Event bubbling'i durdur ki sidebar'ı etkilemesin

			e.stopPropagation();

			

			$(this).toggleClass('expanded');

		});

		

		// İlk yüklemede tüm kartları kapalı halde başlat

		$('.mobile-customer-card').removeClass('expanded');

		

		// Debug: Sidebar menü linklerinin var olup olmadığını kontrol et

		setTimeout(function() {

			console.log('Sidebar menü linkleri:', $('#sidebar-menu a').length);

			console.log('Submenu linkleri:', $('#sidebar-menu .submenu > a').length);

			console.log('Aktif cari menüsü:', $('#sidebar-menu .submenu.active').length);

		}, 500);

	});

</script>





</body>



</html>

