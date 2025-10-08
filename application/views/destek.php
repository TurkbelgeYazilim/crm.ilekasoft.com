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
									<li class="breadcrumb-item">Kullanıcı
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
					?>

					<div class="row">
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Destek Sistemi</h5>
										</div>

										<div class="col-auto">
											<a href="javascript:void(0);" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#add_category2"><i class="fa fa-plus"></i> Yeni Destek Talebi Oluştur</a>
										</div>

											<!-- <div class="col-auto">
												<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#add_category"><i class="fa fa-search"></i> Arama</a>
											</div> -->
									</div>
								</div>
								
								<!-- Filtreler -->
								<div class="card-body border-bottom">
									<form method="GET" action="<?= base_url('destek'); ?>" class="row g-3">
										<div class="col-md-3">
											<label for="durum" class="form-label">Durum</label>
											<select name="durum" id="durum" class="form-control">
												<option value="">Tüm Durumlar</option>
												<?php foreach($destek_durumlari as $key => $durum_adi): ?>
													<option value="<?= $key; ?>" <?= ($durum_filtre == $key) ? 'selected' : ''; ?>>
														<?= $durum_adi; ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
										
										<?php if($isAdmin): ?>
										<div class="col-md-3">
											<label for="kullanici" class="form-label">Kullanıcı</label>
											<select name="kullanici" id="kullanici" class="form-control">
												<option value="">Tüm Kullanıcılar</option>
												<?php if(isset($kullanicilar)): ?>
													<?php foreach($kullanicilar as $kullanici): ?>
														<option value="<?= $kullanici->kullanici_id; ?>" <?= ($kullanici_filtre == $kullanici->kullanici_id) ? 'selected' : ''; ?>>
															<?= $kullanici->kullanici_adsoyad; ?>
														</option>
													<?php endforeach; ?>
												<?php endif; ?>
											</select>
										</div>
										<?php endif; ?>
										
										<div class="col-md-3 d-flex align-items-end">
											<button type="submit" class="btn btn-primary me-2">
												<i class="fa fa-search"></i> Filtrele
											</button>
											<a href="<?= base_url('destek'); ?>" class="btn btn-secondary">
												<i class="fa fa-refresh"></i> Temizle
											</a>
										</div>
									</form>
								</div>
								
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
												<tr>
													<th>ID</th>
													<th>Oluşturma Tarihi</th>
													<th>Son Güncelleme Tarihi</th>
													<th>Başlık</th>
													<th>Departman</th>
													<th>Öncelik</th>
													<th>Durum</th>
													<?php if($isAdmin): ?>
													<th>Kullanıcı</th>
													<?php endif; ?>
													<th>İşlem</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($destekler as $destek){
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
												}else if($statu == 4){
													$statu_text = "<span class='badge bg-warning-light'>Cevap bekleniyor</span>";
												}else{
													$statu_text = "<span class='badge bg-warning'>Hata...</span>";
												}

												?>
												<tr <?php if($destek->destek_isRead == 0){ echo "style='font-weight:bolder!important;'";} ?> 
													<?php if(isset($destek->destek_unreadReplies) && $destek->destek_unreadReplies > 0){ echo "class='table-warning'"; } ?>>
													<td>
														<?=$destek->destek_id;?>
														<?php if(isset($destek->destek_unreadReplies) && $destek->destek_unreadReplies > 0): ?>
															<span class="badge badge-danger badge-sm ml-1"><?=$destek->destek_unreadReplies;?></span>
														<?php endif; ?>
													</td>
													<td><?= date('d.m.Y H:i', strtotime($destek->destek_date)); ?></td>
													<td><?php if($destek->destek_lastUpdateDate){ ?><?= date('d.m.Y H:i', strtotime($destek->destek_lastUpdateDate)); ?><?php } ?></td>
													<td><?= truncateString($destek->destek_title, 25,false); ?></td>
													<td><?=$departman_text;?></td>
													<td><?=$oncelik_text;?></td>
													<td><?=$statu_text;?></td>
													<?php if($isAdmin): ?>
													<td>
														<?php if(isset($destek->kullanici_adsoyad) && $destek->kullanici_adsoyad): ?>
															<?= trim($destek->kullanici_adsoyad); ?>
														<?php else: ?>
															<span class="text-muted">Bilinmiyor</span>
														<?php endif; ?>
													</td>
													<?php endif; ?>
													<td>
														<a href="<?= base_url("destek/detay/$destek->destek_id"); ?>"  class="btn btn-sm btn-white text-info mr-2"><i class="fa fa-eye mr-1"></i></a>
														<?php if($isAdmin): ?>
														<div class="dropdown d-inline">
															<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="durumDropdown<?=$destek->destek_id;?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<i class="fa fa-cog"></i>
															</button>
															<div class="dropdown-menu" aria-labelledby="durumDropdown<?=$destek->destek_id;?>">
																<a class="dropdown-item" href="<?= base_url("home/destek_durum_degistir/".$destek->destek_id."/1"); ?>">
																	<i class="fa fa-circle text-success"></i> Açık
																</a>
																<a class="dropdown-item" href="<?= base_url("home/destek_durum_degistir/".$destek->destek_id."/2"); ?>">
																	<i class="fa fa-circle text-warning"></i> İşlemde
																</a>
																<a class="dropdown-item" href="<?= base_url("home/destek_durum_degistir/".$destek->destek_id."/3"); ?>">
																	<i class="fa fa-circle text-danger"></i> Kapalı
																</a>
																<a class="dropdown-item" href="<?= base_url("home/destek_durum_degistir/".$destek->destek_id."/4"); ?>">
																	<i class="fa fa-circle text-info"></i> Cevap bekleniyor
																</a>
															</div>
														</div>
														<?php endif; ?>
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
			<?php 
				$firmaAdi = $this->input->get('firmaAdi');
			?>
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
									<form action="<?= base_url("admin/destek-sistemi"); ?>" method="GET">
										<div class="form-group">
											<label>Firma Adına Göre </label>
											<input class="form-control" type="text" name="firmaAdi" value="<?=$firmaAdi;?>" autocomplete="off">
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

			<!-- Add Category Modal -->
			<div id="add_category2" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Yeni Destek Talebi Oluştur</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="<?= base_url("home/yeniTicket"); ?>" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label>Başlık *</label>
									<input class="form-control" type="text" name="destek_title" value="" autocomplete="off" required="">
								</div>
								<div class="form-group">
									<label>Departman *</label>
									<select class="form-control select" name="destek_department" required>
										<option value="">Seçiniz...</option>
										<option value="1">Teknik Destek</option>
										<option value="2">Muhasebe</option>
										<option value="3">Satış</option>
										<option value="4">Şikayet / İstek / Öneri</option>
									</select>
								</div>
								<div class="form-group">
									<label>Öncelik *</label>
									<select class="form-control select" name="destek_priority" required>
										<option value="">Seçiniz...</option>
										<option value="1">Düşük</option>
										<option value="2">Orta</option>
										<option value="3">Yüksek</option>
									</select>
								</div>
								<div class="form-group">
									<label>Mesaj *</label>
									<textarea class="form-control" name="destek_msg" required=""></textarea>
								</div>

								<div class="form-group">
									<label>Dosyalar</label>
									<div id="file-upload-container">
										<div class="file-input-group mb-2">
											<input type="file" class="form-control" name="destek_files[]" accept=".jpg,.jpeg,.png,.xml,.pdf">
										</div>
									</div>
									<button type="button" class="btn btn-sm btn-outline-secondary" id="add-file-btn">
										<i class="fa fa-plus"></i> Dosya Ekle
									</button>
									<small class="form-text text-muted">
										Maksimum dosya boyutu: 1MB. Desteklenen formatlar: JPG, PNG, XML, PDF
									</small>
								</div>

								<div class="submit-section">
									<button class="btn btn-danger submit-btn">Gönder</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Add Category Modal -->
		</div>
		<!-- /Main Wrapper -->

		<?php if ($this->session->flashdata('destek_ok')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "success", 
				  text: "Destek talebiniz başarılı bir şekilde bize ulaştırıldı, en kısa sürede size geri dönüş yapacağız.",
				  confirmButtonText:'Tamam',
				  button: false,
				  timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('resim_hata')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "Yüklenecek dosyalar 1MB'ın altında, JPG, PNG, XML veya PDF olabilir. Tekrar deneyiniz.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('destek_durum_ok')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "<?= $this->session->flashdata('destek_durum_ok'); ?>",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('destek_durum_hata')): ?>
			<script>
				swal({
					title: "Hata",
					type: "error",
					text: "<?= $this->session->flashdata('destek_durum_hata'); ?>",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<script>
			// Birden fazla dosya ekleme
			$(document).ready(function() {
				let fileInputCount = 1;
				const maxFiles = 5; // Maksimum 5 dosya

				$('#add-file-btn').click(function() {
					if (fileInputCount < maxFiles) {
						fileInputCount++;
						const newFileInput = `
							<div class="file-input-group mb-2">
								<div class="input-group">
									<input type="file" class="form-control" name="destek_files[]" accept=".jpg,.jpeg,.png,.xml,.pdf">
									<div class="input-group-append">
										<button type="button" class="btn btn-outline-danger remove-file-btn">
											<i class="fa fa-trash"></i>
										</button>
									</div>
								</div>
							</div>
						`;
						$('#file-upload-container').append(newFileInput);
					} else {
						swal({
							title: "Uyarı",
							type: "warning",
							text: "Maksimum " + maxFiles + " dosya ekleyebilirsiniz.",
							confirmButtonText: 'Tamam',
							timer: 3000
						});
					}
				});

				// Dosya silme
				$(document).on('click', '.remove-file-btn', function() {
					$(this).closest('.file-input-group').remove();
					fileInputCount--;
				});
			});
		</script>

<?php $this->load->view("include/footer-js"); ?>

<!-- Select2 JS -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>

<?php $ref = $this->input->get("ref");
	if($ref == "footer"){
?>

	<script type="text/javascript">
		$(window).on('load', function() {
			$('#add_category2').modal('show');
		});
	</script>

<?php } ?>
