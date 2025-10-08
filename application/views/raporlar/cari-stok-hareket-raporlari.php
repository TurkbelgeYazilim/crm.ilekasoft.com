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
				
				<?php 
						$anaHesap = anaHesapBilgisi();

       	 		$hareketTuru = $this->input->get('hareketTuru');
						$belgeNo = $this->input->get('belgeNo');

						$getCari = $this->input->get('cari');

						$cariQ = "SELECT * FROM cari WHERE cari_id = '$getCari' AND cari_olusturanAnaHesap = '$anaHesap'";
						$cariExe = $this->db->query($cariQ)->row();

						$tarihAraligi = $this->input->get('tarihAraligi');
					?>
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-10">
								<h3 class="page-title">Raporlar</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item"><a href="<?= base_url("raporlar"); ?>">Raporlar</a>
									</li>
									<li class="breadcrumb-item">Cari Stok Hareket Raporları
									</li>
									<?php if($cariExe){ ?>
										<li class="breadcrumb-item active"><?= $cariExe->cari_ad; ?></li>
									<?php }	?>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->

					

					<?php if(!isset($getCari)){ ?>
						<section class="comp-section">
							<div class="card bg-white">
								<div class="card-body">
									<div class="alert alert-info fade show" role="alert">
										<strong><i class="fa fa-info-circle"></i></strong> Cari stok hareketlerini görebilmek için, lütfen <a href="<?= base_url("cari/cari-listesi"); ?>" class="alert-link" style="text-decoration: underline;">cari listesi</a> sayfasından bir cari kart seçiniz.
									</div>
								</div>
							</div>
						</section>
						<!-- /Alerts -->
					<?php }else{?>
					<div class="row">
						
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title"><a href="<?= base_url("cari/cari-karti-duzenle/$cariExe->cari_id"); ?>" target="_blank" style="color:#d92637; text-decoration: underline;"><?= $cariExe->cari_ad; ?></a> - Cari Stok Hareket Raporu - Toplam Hareket: <?=$toplamHareket;?></h5>
										</div>
										<?php if(isset($tarihAraligi)){ ?>
											<div class="col-auto">
												<a href="<?= base_url("raporlar/cari-stok-hareket-raporlari?cari=$getCari"); ?>" class="btn btn-outline-primary btn-sm"><i class="fa fa-times-circle"></i> Filtrelemeyi Kaldır</a>
											</div>
										<?php } ?>
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
													<th>Tarih</th>
													<th>Stok Kodu</th>
													<th>Stok Adı</th>
													<th>Birim Fiyat</th>
													<th>Giriş</th>
													<th>Çıkış</th>
													<th>Toplam Fiyat</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($cariStokHareketleri as $csh){ ?>
													<?php 
														$stokQ = "SELECT * FROM stok WHERE stok_id = '$csh->sh_stokID' AND stok_olusturanAnaHesap = '$anaHesap'";
														$stokExe = $this->db->query($stokQ)->row();

														$turu = $csh->sh_turu;

														if($turu == 1){
															$giris = '<span class="badge bg-success-light">'.number_format($csh->sh_giris,2).'</span>';
															$cikis = '';
														}else if($turu == 2 || $turu == 3 || $turu == 4){
															$giris = '';
															$cikis = '<span class="badge bg-danger-light">'.number_format($csh->sh_cikis,2).'</span>';
														}

													?>
													<tr>
														<td><?= date('d.m.Y', strtotime($csh->sh_tarih)); ?></td>
														<td><a href="<?= base_url("stok/stok-hareketleri?stok=$csh->sh_stokID"); ?>" target="_blank"><?= $stokExe->stok_kodu;?></a></td>
														<td><?= $stokExe->stok_ad;?></td>
														<td><?= number_format($csh->sh_birimFiyat,2); ?> <?= $csh->sh_paraBirimi ?></td>
														<td><?= $giris; ?></td>
														<td><?= $cikis; ?></td>
														<td><?= number_format($csh->sh_toplamFiyat,2); ?> <?= $csh->sh_paraBirimi ?></td>
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
				<?php }	?>
				</div>
			</div>
			<!-- /Page Wrapper -->
			
			<!-- Add Category Modal -->
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Cari Hareket Arama</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("raporlar/cari-stok-hareket-raporlari"); ?>" method="GET">
										<?php 
											if(isset($getCari)){ ?>
												<input type="hidden" name="cari" value="<?=$getCari;?>">
										<?php }?>
										<div class="form-group">
											<label>Kayıt Tarihi Aralığına Göre </label>
											<input class="form-control" id="daterange" type="text" name="tarihAraligi" value="<?=$tarihAraligi;?>" autocomplete="off"/>
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

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

		
<?php $this->load->view("include/footer-js"); ?>
<!-- Select2 JS -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>

<script>
$(function() {
	moment.locale('tr');
  $('#daterange').daterangepicker({
    opens: 'left',
    autoUpdateInput: false
  }, function(start, end, label) {
  	$('#daterange').val(start.format('DD.MM.YYYY')+' - '+end.format('DD.MM.YYYY'));
    //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>

</body>
</html>
