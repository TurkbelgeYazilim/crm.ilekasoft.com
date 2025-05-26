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
								<h3 class="page-title">Raporlar</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item"><a href="<?= base_url("raporlar"); ?>">Raporlar</a>
									</li>
									<li class="breadcrumb-item active">Gider Raporları</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->
					<?php 
						$giderTuru = $this->input->get("giderTuru");
						if(empty($giderTuru)){
					?>
					<div class="row">
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Gider Raporları</h5>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
												<tr>
													<th>Gider Kategorisi</th>
													<th>Durum</th>
													<th class="text-right">İşlem</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($giderKategorileri as $gk){?>
													<?php 
														$giderRaporQ = "SELECT SUM(gider_tutar) as toplam FROM giderler WHERE gider_gkID = '$gk->gk_id'";
														$giderRaporExe = $this->db->query($giderRaporQ)->row();
													?>

													<?php 
														$altQ = "SELECT COUNT(*) as total FROM giderKategorileri WHERE gk_mainID = '$gk->gk_id'";
														$altExe = $this->db->query($altQ)->row();
													?>
												<tr>
													<td><?= $gk->gk_adi; ?></td>
													<td><?= number_format($giderRaporExe->toplam,2); ?> ₺</td>
													<td class="text-right">
														<a href="<?= base_url("raporlar/gider-raporlari?giderTuru=$gk->gk_id"); ?>"  class="btn btn-sm btn-white text-success mr-2"><i class="far fa-eye mr-1"></i> Alt Gider Türlerini Görüntüle (<?= $altExe->total; ?>)</a> 

														<a href="<?= base_url("giderler/gider-listesi?giderKategorisi=$gk->gk_id"); ?>"  class="btn btn-sm btn-white text-info mr-2"><i class="far fa-eye mr-1"></i> Detayları Görüntüle</a> 
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?php echo $links; ?>
							<br><br>
						</div>
					</div>
				<?php }else if($giderTuru){ 
					$altKategorilerQ = "SELECT * FROM giderKategorileri WHERE gk_mainID = '$giderTuru'";
						$altKategoriler = $this->db->query($altKategorilerQ)->result();
				?>
					<div class="row">
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Gider Raporları</h5>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
												<tr>
													<th>Gider Kategorisi</th>
													<th>Durum</th>
													<th class="text-right">İşlem</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($altKategoriler as $gk){?>
													<?php 
														$giderRaporQ = "SELECT SUM(gider_tutar) as toplam FROM giderler WHERE gider_gkSubID = '$gk->gk_id'";
														$giderRaporExe = $this->db->query($giderRaporQ)->row();
													?>
												<tr>
													<td><?= $gk->gk_adi; ?></td>
													<td><?= number_format($giderRaporExe->toplam,2); ?> ₺</td>
													<td class="text-right">
														<a href="<?= base_url("giderler/gider-listesi?giderKategorisi=$gk->gk_mainID"); ?>"  class="btn btn-sm btn-white text-info mr-2"><i class="far fa-eye mr-1"></i> Detayları Görüntüle</a> 
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?php echo $links; ?>
							<br><br>
						</div>
					</div>
				<?php }?>
				</div>
			</div>
			<!-- /Page Wrapper -->
		</div>
		<!-- /Main Wrapper -->

		
<?php $this->load->view("include/footer-js"); ?>
<!-- Select2 JS -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>

</body>
</html>