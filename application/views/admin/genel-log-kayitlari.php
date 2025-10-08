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
								<h3 class="page-title">Admin</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Admin
									</li>
									<li class="breadcrumb-item active">Genel Log Kayıtları</li>
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
											<h5 class="card-title">Genel Log Kayıtları</h5>
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
													<th>Menü</th>
													<th>Detay</th>
													<th>İşlem</th>
													<th>Tarih</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($loglar as $log){?>
													<?php 
														$kullaniciq = "SELECT * FROM kullanicilar WHERE kullanici_id = '$log->log_userID'";
														$kullaniciexe = $this->db->query($kullaniciq)->row();
														$kullanicieposta = $kullaniciexe->kullanici_eposta;
														$kullaniciadi = $kullaniciexe->kullanici_kullaniciAdi;

														$old_date_timestamp = strtotime($log->log_islemTarih);
   														$new_date = date('d.m.Y', $old_date_timestamp);

   														$islemIDq = "SELECT * FROM logIslemleri WHERE logislem_id = '$log->log_islemID'";
   														$islemIDexe = $this->db->query($islemIDq)->row();

   														$islemTipi = $log->log_islemTipi;
   														if($islemTipi == 1){
   															$islemTipiText = '<span class="badge bg-success-light">Görüntüleme</span>';
   														}else if($islemTipi == 2){
   															$islemTipiText = '<span class="badge bg-warning-light">Ekleme</span>';
   														}else if($islemTipi == 3){
   															$islemTipiText = '<span class="badge bg-primary-light">Düzenleme</span>';
   														}else if($islemTipi == 4){
   															$islemTipiText = '<span class="badge bg-danger-light">Silme</span>';
   														}else if($islemTipi == 5){
   															$islemTipiText = '<span class="badge bg-info-light">Giriş</span>';
   														}else if($islemTipi == 6){
   															$islemTipiText = '<span class="badge bg-dark text-light">Çıkış</span>';
   														}else if($islemTipi == 7){
   															$islemTipiText = '<span class="badge bg-danger text-light">Hata</span>';
   														}
													?>
												<tr>
													<td><?= $kullanicieposta; ?></td>
													<td><?= $kullaniciadi; ?></td>
													<td><?= $islemIDexe->logislem_menu; ?></td>
													<td><?= $islemIDexe->logislem_adi; ?></td>
													<td><?= $islemTipiText; ?></td>
													<td><?= $new_date; ?> <?= $log->log_islemSaat;?></td>
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
				$islem = $this->input->get('islem');
				$tarihAraligi = $this->input->get('tarihAraligi');
				$kullanici = $this->input->get('kullanici');
			?>

			<!-- Add Category Modal -->
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Log Arama</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("admin/genel-log-kayitlari"); ?>" method="GET">
										<div class="form-group">
											<label>Kayıt Tarihi Aralığına Göre </label>
											<input class="form-control" id="daterange" type="text" name="tarihAraligi" value="<?=$tarihAraligi;?>" autocomplete="off"/>
										</div>
										<div class="form-group">
											<label>İşleme Göre </label>
											<select class="select form-control" name="islem">
												<option value="">İşlem seçiniz...</option>
												<!-- <option value="1" <?php if($islem == 1){echo "selected";}?>>Görüntüleme</option> -->
												<option value="2" <?php if($islem == 2){echo "selected";}?>>Ekleme</option>
												<option value="3" <?php if($islem == 3){echo "selected";}?>>Düzenleme</option>
												<option value="4" <?php if($islem == 4){echo "selected";}?>>Silme</option>
												<option value="5" <?php if($islem == 5){echo "selected";}?>>Giriş</option>
												<option value="6" <?php if($islem == 6){echo "selected";}?>>Çıkış</option>
												<!-- <option value="7" <?php if($islem == 7){echo "selected";}?>>Hata</option> -->
											</select>
										</div>
										<div classs="form-group">
											<label>Kullanıcı adına göre</label>
											<input class="form-control" type="text" name="kullanici" autocomplete="off">
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