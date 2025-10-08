<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<style>
		.tooltip {
			pointer-events: none;
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
					<div class="page-header">
						<div class="row">
							<div class="col-sm-10">
								<h3 class="page-title">Destek Sistemi</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Admin
									</li>
									<li class="breadcrumb-item active">Destek Sistemi</li>
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


						$durum = $this->input->get('durum');
					?>

					<div class="row">
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Destek Sistemi</h5>
										</div>

										<?php if (isset($durum)) { ?>
											<div class="col-auto">
												<a href="<?= base_url("admin/destek"); ?>"
												   class="btn btn-outline-primary btn-sm"><i class="fa fa-times-circle"></i>
													Filtrelemeyi Kaldır</a>
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
												<th>ID</th>
												<th>Oluşturma Tarihi</th>
												<th>Son Güncelleme Tarihi</th>
												<th>Firma</th>
												<th>Oluşturan</th>
												<th>Başlık</th>
												<th>Departman</th>
												<th>Öncelik</th>
												<th>Durum</th>
												<th>İşlem</th>
											</tr>
											</thead>
											<tbody>
											<?php foreach($destekler as $destek){

												$olusturanID = $destek->destek_olusturan;
												$firmaID = $destek->destek_olusturanAnaHesap;

												$firmaKim = getirFirmaById($firmaID);
												$kullaniciKim = getirKullaniciById($olusturanID);


												$oncelik = $destek->destek_priority;
												$departman = $destek->destek_department;
												$statu = $destek->destek_status;

												if($oncelik == 1){
													$oncelik_text = "<span class='badge bg-primary-light'>Düşük</span>";
												}else if($oncelik == 2){
													$oncelik_text = "<span class='badge bg-warning-light'>Orta</span>";
												}else if($oncelik == 3){
													$oncelik_text = "<span class='badge bg-danger-light'>Yüksek</span>";
												}else{$oncelik_text = "<span class='badge bg-dark' style='color:#FFF!important;'>Hata...</span>";}

												if($departman == 1){
													$departman_text = "Teknik Destek";
												}else if($departman == 2){
													$departman_text = "Muhasebe";
												}else if($departman == 3){
													$departman_text = "Satış";
												}else if($departman == 4){
													$departman_text = "Şikayet / İstek / Öneri";
												}else{$departman_text="Hata...";}

												if($statu == 1){
													$statu_text = "<span class='badge bg-success-light'>Açık</span>";
												}else if($statu == 2){
													$statu_text = "<span class='badge bg-dark' style='color:#FFF!important;'>İşlemde</span>";
												}else if($statu == 3){
													$statu_text = "<span class='badge bg-danger-light'>Kapalı</span>";
												}else{
													$statu_text = "<span class='badge bg-warning'>Hata...</span>";
												}

												?>
												<tr>
													<td><?=$destek->destek_id;?></td>
													<td><?= date('d.m.Y H:i', strtotime($destek->destek_date)); ?></td>
													<td><?php if($destek->destek_lastUpdateDate){ ?><?= date('d.m.Y H:i', strtotime($destek->destek_lastUpdateDate)); ?><?php } ?></td>
													<td data-toggle="tooltip" data-placement="bottom" title="<?= $firmaKim->ayarlar_firmaAd;?>"><?= cutText($firmaKim->ayarlar_firmaAd,); ?></td>
													<td data-toggle="tooltip" data-placement="bottom" title="<?= $kullaniciKim->kullanici_eposta;?>"><?= cutText($kullaniciKim->kullanici_eposta); ?></td>
													<td data-toggle="tooltip" data-placement="bottom" title="<?= $destek->destek_title;?>"><?= cutText($destek->destek_title); ?></td>
													<td><?=$departman_text;?></td>
													<td><?=$oncelik_text;?></td>
													<td><?=$statu_text;?></td>
													<td>
														<a href="<?= base_url("admin/destek/detay/$destek->destek_id"); ?>"  class="btn btn-sm btn-white text-info mr-2"><i class="fa fa-eye mr-1"></i></a>

														<?php if($statu == 1){ ?>
															<a href="<?= base_url("admin/destekIslem/$destek->destek_id"); ?>"  class="btn btn-sm btn-white text-success mr-2" data-toggle="tooltip" data-placement="bottom" title="İşlemde olarak işaretle"><i class="fa fa-play mr-1"></i></a>
														<?php } ?>

													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
										<hr>
<span style="margin-left:15px;">Toplam kayıt sayısı:</span> <b><?= $count_of_list; ?></b>
<br><br>
										<?php echo $links; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Wrapper -->
			<!-- Add Category Modal -->
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Destek Talebi Arama</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("admin/destek"); ?>" method="GET">
										<div class="form-group">
											<label>Duruma göre </label>
											<select class="form-control select" name="durum">
												<option value="1" <?php if($durum == 1){echo "selected";} ?>>Açık</option>
												<option value="2" <?php if($durum == 2){echo "selected";} ?>>İşlemde</option>
												<option value="3" <?php if($durum == 3){echo "selected";} ?>>Kapalı</option>
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
		</div>
		<!-- /Main Wrapper -->

		<?php if ($this->session->flashdata('ok')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "success", 
				  text: "ok.",
				  confirmButtonText:'Tamam',
				  button: false,
				  timer: 5000,
				});
			</script>
		<?php endif; ?>

<?php $this->load->view("include/footer-js"); ?>

<!-- Select2 JS -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>


</body>
</html>
