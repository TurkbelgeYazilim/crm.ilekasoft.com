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
								<h3 class="page-title">Banka</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Banka
									</li>
									<li class="breadcrumb-item active">Banka Listesi</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Banka Listesi</h5>
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
													<th>Banka Adı</th>
													<th>IBAN</th>
													<th>Hesap Numarası</th>
													<th>Şube</th>
													<th>Hesap Adı</th>
													<th>Durum</th>
													<th class="text-right">İşlem</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($banka as $bn){?>
													<?php 
														$anaHesap = anaHesapBilgisi();

														$toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bn->banka_id'";
														$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

														$toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bn->banka_id'";
														$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

														$toplamGiris = $toplamGirisExe->toplamGiris;
														$toplamCikis = $toplamCikisExe->toplamCikis;
														$kalan = $toplamGiris - $toplamCikis;
													?>
												<tr>
													<td><?= $bn->banka_bankaAd; ?></td>
													<td><?= $bn->banka_iban; ?></td>
													<td><?= $bn->banka_hesapNo; ?></td>
													<td><?= $bn->banka_sube; ?></td>
													<td><?= $bn->banka_hesapAd; ?></td>
													<td><?= number_format($kalan,2); ?> ₺</td>
													<td class="text-right">
														<a href="<?= base_url("banka/banka-hareket-kayitlari?banka=$bn->banka_id"); ?>"  class="btn btn-sm btn-white text-info mr-2"><i class="far fa-eye mr-1"></i> Hareketleri Görüntüle</a> 

														<a href="<?= base_url("banka/banka-acilis-karti-duzenle/$bn->banka_id"); ?>"  class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Düzenle</a> 
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
				$bankaAdi = $this->input->get('bankaAdi');
			?>
			<!-- Add Category Modal -->
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Banka Arama</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("banka/banka-listesi"); ?>" method="GET">
										<div class="form-group">
											<label>Banka Adına Göre </label>
											<input class="form-control" type="text" name="bankaAdi" value="<?=$bankaAdi;?>" autocomplete="off">
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