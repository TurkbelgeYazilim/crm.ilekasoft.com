<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>
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
								<h3 class="page-title">Yönetici</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Yönetici
									</li>
									<li class="breadcrumb-item active">Kullanici Listesi</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->

					<?php 
						$anaHesap = anaHesapBilgisi();

						$control2 = session("r", "login_info");
						$u_id = $control2->kullanici_id;
					?>
				
					<div class="row">
						
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Kullanıcı Listesi</h5>
										</div>
										<div class="col-auto">
											<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#add_category"><i class="fa fa-search"></i> Arama</a>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
												<tr>
													<th>e-Posta</th>
													<th>Kullanıcı Adı</th>
													<th>Ad Soyad</th>
													<th>Yetki</th>
													<th>Durum</th>
													<th class="text-right">İşlem</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($kullanici as $kul){?>
												<?php 
													$yetki = $kul->kullanici_yetki;
													$durum = $kul->kullanici_durum;

													if($yetki == 1){$yetkiTxt = "Yönetici";}
													else if($yetki == 2){$yetkiTxt = "Kullanıcı";}

													if($durum == 1){$durumTxt = '<span class="badge bg-success-light">Aktif</span>';}
													else if($durum == 2){$durumTxt = '<span class="badge bg-danger-light">Pasif</span>';}
												?>
												<tr>
													<td><?= $kul->kullanici_eposta; ?></td>
													<td><?= $kul->kullanici_kullaniciAdi; ?></td>
													<td><?= $kul->kullanici_ad; ?> <?= $kul->kullanici_soyad;?></td>
													<td><?= $yetkiTxt; ?></td>
													<td><?= $durumTxt; ?></td>
													<td class="text-right">
														<?php if($kul->kullanici_id != $u_id && $kul->kullanici_yetki != 1){ ?>
														<a href="<?= base_url("yonetici/kullanici-yetkileri-duzenle?kullanici=$kul->kullanici_id"); ?>"  class="btn btn-sm btn-white text-secondary mr-2"><i class="fa fa-key mr-1"></i> Kullanıcı Yetkileri</a>
														<?php } ?>
														<a href="<?= base_url("yonetici/mevcut-kullanici-duzenle/$kul->kullanici_id"); ?>"  class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Düzenle</a> 
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
<span style="margin-left:15px;">Toplam kayıt sayısı:</span> <b><?= $count_of_list; ?></b>
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
				$kullaniciEposta = $this->input->get('kullaniciEposta');
				$kullaniciAdi = $this->input->get('kullaniciAdi');
			?>
			<!-- Add Category Modal -->
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Kullanıcı Arama</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("yonetici/kullanici-listesi"); ?>" method="GET">
										<div class="form-group">
											<label>e-Posta'ya Göre </label>
											<input class="form-control" type="text" name="kullaniciEposta" value="<?=$kullaniciEposta;?>" autocomplete="off">
										</div>
										<div class="form-group">
											<label>Kullanıcı Adına Göre </label>
											<input class="form-control" type="text" name="kullaniciAdi" value="<?=$kullaniciAdi;?>" autocomplete="off">
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
		</div>
		<!-- /Main Wrapper -->

		
<?php $this->load->view("include/footer-js"); ?>
<!-- Select2 JS -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>

</body>
</html>
