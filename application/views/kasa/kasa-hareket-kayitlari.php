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
								<h3 class="page-title">Kasa</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Kasa
									</li>
									<li class="breadcrumb-item active">Kasa Hareket Kayıtları</li>
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

						$firma = getirFirma();
						$deletePermission = $firma->ayarlar_deletePermission;

						$kasaQ = "SELECT * FROM kasa WHERE kasa_olusturanAnaHesap = '$anaHesap'";
       	 		$kasalar = $this->db->query($kasaQ)->result();

       	 		$secilenKasa = $_GET["kasa"];

       	 		$hareketTuru = $this->input->get('hareketTuru');
						$belgeNo = $this->input->get('belgeNo');
						$getkasa = $this->input->get('kasa');
						$tarihAraligi = $this->input->get('tarihAraligi');

						$siralama = $this->input->get('siralama');

						if($_SERVER['QUERY_STRING']){
							$qs = "?".$_SERVER['QUERY_STRING'];
						}
					?>
				
					<div class="row">
						
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Kasa Hareket Kayıtları</h5>
										</div>
										<div class="col-auto">
											<form action="<?= base_url("kasa/kasa-hareket-kayitlari"); ?>" method="GET" id="kasaForm">
												<select class="btn btn-outline-light" id="kasalar" name="kasa">
													<option value="tumu">Seç: Tümü</option>
													<?php foreach($kasalar as $kasa){?>
														<option value="<?= $kasa->kasa_id?>" <?php if($secilenKasa == $kasa->kasa_id){echo "selected"; }?>>Seç: <?= $kasa->kasa_adi;?></option>
													<?php } ?>
												</select>

												<?php 
													if(isset($hareketTuru)){ ?>
														<input type="hidden" name="hareketTuru" value="<?=$hareketTuru;?>">
												<?php }?>

												<?php 
													if(isset($belgeNo)){ ?>
														<input type="hidden" name="belgeNo" value="<?=$belgeNo;?>">
												<?php }?>

													<?php 
													if(isset($tarihAraligi)){ ?>
														<input type="hidden" name="tarihAraligi" value="<?=$tarihAraligi;?>">
												<?php }?>


											</form>
										</div>
										<div class="col-auto">
											<a href="javascript:void(0);" class="btn btn-outline-success btn-sm" >Toplam Giriş: <?= number_format($toplamGiris,2); ?> ₺</a>
											<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm ml-2" >Toplam Çıkış: <?= number_format($toplamCikis,2); ?> ₺</a>
											<a href="javascript:void(0);" class="btn btn-outline-info btn-sm ml-2" >Kalan: <?= number_format($kalan,2); ?> ₺</a>
										</div>
										<?php if(isset($hareketTuru) || isset($belgeNo) || isset($getkasa) || isset($tarihAraligi) ){ ?>
											<div class="col-auto">
												<a href="<?= base_url("kasa/kasa-hareket-kayitlari"); ?>" class="btn btn-outline-primary btn-sm"><i class="fa fa-times-circle"></i> Filtrelemeyi Kaldır</a>
											</div>
										<?php } ?>
										<div class="col-auto">
											<a href="<?= base_url("kasa/kasaHareketKayitlariExcel$qs"); ?>" class="btn btn-outline-success btn-sm" style='font-family: Arial, Helvetica, sans-serif;'><i class="fa fa-file-excel"></i> Dışa aktar</a>
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
													<th>Tarih</th>
													<th>Kasa</th>
													<th>Belge Numarası</th>
													<th>Türü</th>
													<th>Giriş</th>
													<th>Çıkış</th>
													<th>Cari</th>
													<th>Açıklama</th>
													<th class="text-right">İşlem</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($kasaHareketleri as $kh){ ?>
													<?php 
														$anaHesap = anaHesapBilgisi();

														$turu = $kh->kh_turu;
														if($turu == 14) {
															$turuTxt = '<span class="badge bg-success-light">Kasa Açılış</span>';
														}else if($turu == 1){
															$turuTxt = '<span class="badge bg-info-light">Kasa Tahsilat</span>';
														}else if($turu == 2){
															$turuTxt = '<span class="badge bg-primary-light">Kasa Ödeme</span>';
														}else if($turu == 3){
															$turuTxt = '<span class="badge bg-danger-light">Satış Faturası</span>';
														}else if($turu == 4){
															$turuTxt = '<span class="badge bg-success-light">Alış Faturası</span>';
														}else if($turu == 5){
															$turuTxt = '<span class="badge bg-warning-light">Kasa Devir</span>';
														}else if($turu == 6){
															$turuTxt = '<span class="badge bg-danger text-light">Giderler</span>';
														}else if($turu == 7){
															$turuTxt = '<span class="badge bg-info text-light">Kasa Virman</span>';
														}else if($turu == 8){
															$turuTxt = '<span class="badge bg-info text-light">Alınan Çek</span>';
														}else if($turu == 9){
															$turuTxt = '<span class="badge bg-info text-light">Verilen Çek</span>';
														}else if($turu == 10){
															$turuTxt = '<span class="badge bg-info text-light">Alınan Senet</span>';
														}else if($turu == 11){
															$turuTxt = '<span class="badge bg-info text-light">Verilen Senet</span>';
														}else if($turu == 12){
															$turuTxt = '<span class="badge bg-warning text-light">Kasadan Bankaya Transfer</span>';
														}else if($turu == 13){
															$turuTxt = '<span class="badge bg-warning text-light">Bankadan Kasaya Transfer</span>';
														}

														if($kh->kh_giris){
															$giris = '<span class="badge bg-success-light">'.number_format($kh->kh_giris,2).' ₺</span>';
															$cikis = '';
														}

														if($kh->kh_cikis){
															$giris = '';
															$cikis = '<span class="badge bg-danger-light">'.number_format($kh->kh_cikis,2).' ₺</span>';
														}


														$cari_id = $kh->kh_cariID;
														$cariQ = "SELECT * FROM cari WHERE cari_id = '$cari_id' AND cari_olusturanAnaHesap = '$anaHesap'";
														$cariExe = $this->db->query($cariQ)->row();

														$kasaid = $kh->kh_kasaID;

														$kasasiQ = "SELECT * FROM kasa WHERE kasa_id = '$kasaid' AND kasa_olusturanAnaHesap = '$anaHesap'";
														$kasasiExe = $this->db->query($kasasiQ)->row();

													?>
													<tr>
														<td><?= date('d.m.Y', strtotime($kh->kh_tarih)); ?></td>
														<td><?= $kasasiExe->kasa_adi;?></td>
														<td><?= $kh->kh_belgeNumarasi; ?></td>
														<td><?= $turuTxt; ?></td>
														<td><?= $giris; ?></td>
														<td><?= $cikis; ?></td>
														<td><a href="<?= base_url("cari/cari-hareketleri?cari=$cariExe->cari_id"); ?>" target="_blank"><?= $cariExe->cari_ad; ?></a></td>
														<td><span data-toggle="tooltip" data-placement="top" title="<?= $kh->kh_aciklama; ?>"><?= truncateString($kh->kh_aciklama, 15,false); ?></span></td>
														<td class="text-right">
															<?php if($turu == 1){//kasa tahsilat düzenle ?>
																<a href="<?= base_url("kasa/kasa-tahsilat-duzenle/$kh->kh_id"); ?>"  class="btn btn-sm btn-white text-success mr-2" target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>

																<?php if($deletePermission == 1){ ?>
																<a href="<?= base_url("kasa/sil/tahsilat/$kh->kh_id"); ?>"  class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i> Sil</a>
																	<?php }?>
															<?php }else if($turu == 2){//kasa ödeme düzenle ?>
																<a href="<?= base_url("kasa/kasa-odeme-islemi-duzenle/$kh->kh_id"); ?>"  class="btn btn-sm btn-white text-success mr-2" target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>
															<?php if($deletePermission == 1){ ?>
																<a href="<?= base_url("kasa/sil/odeme/$kh->kh_id"); ?>"  class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i> Sil</a>
																<?php } ?>
															<?php }else if($turu == 3){//satış faturası düzenle ?>
																<a href="<?= base_url("fatura/satis-faturasi-duzenle/$kh->kh_faturaID"); ?>"  class="btn btn-sm btn-white text-success mr-2" target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>
															<?php }else if($turu == 4){//alış faturası düzenle ?>
																<a href="<?= base_url("fatura/alis-faturasi-duzenle/$kh->kh_faturaID"); ?>"  class="btn btn-sm btn-white text-success mr-2" target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>
															<?php }else if($turu == 5){//kasa devir düzenle ?>
																<a href="<?= base_url("kasa/kasa-devir-karti-duzenle/$kh->kh_id"); ?>"  class="btn btn-sm btn-white text-success mr-2" target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>
															<?php }else if($turu == 6){//gider düzenle ?>
																<a href="<?= base_url("giderler/gider-duzenle/$kh->kh_giderID"); ?>"  class="btn btn-sm btn-white text-success mr-2" target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>
															<?php if($deletePermission == 1){ ?>
																<a href="<?= base_url("kasa/sil/gider/$kh->kh_giderID"); ?>"  class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i> Sil</a>
																<?php }?>
															<?php }else if($turu == 7){//kasa virman düzenle ?>
																<a href="<?= base_url("kasa/kasa-virman-duzenle/$kh->kh_virmanID"); ?>"  class="btn btn-sm btn-white text-success mr-2" target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>
															<?php if($deletePermission == 1){ ?>
																<a href="<?= base_url("kasa/sil/virman/$kh->kh_virmanID"); ?>"  class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i> Sil</a>
																<?php }?>
															<?php }else if($turu == 12){//kasadan bankaya transfer düzenle ?>
																<a href="<?= base_url("kasa/kasadan-bankaya-transfer-duzenle/$kh->kh_transferRefID"); ?>"  class="btn btn-sm btn-white text-success mr-2" target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>
																<?php if($deletePermission == 1){ ?>
																	<a href="<?= base_url("kasa/sil/transfer/$kh->kh_transferRefID"); ?>"  class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i> Sil</a>
																<?php }?>
															<?php }else if($turu == 13){//bankadan kasaya transfer düzenle ?>
																<a href="<?= base_url("banka/bankadan-kasaya-transfer-duzenle/$kh->kh_transferRefID"); ?>"  class="btn btn-sm btn-white text-success mr-2" target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>
																<?php if($deletePermission == 1){ ?>
																	<a href="<?= base_url("banka/sil/transfer/$kh->kh_transferRefID"); ?>"  class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i> Sil</a>
																<?php }?>
															<?php } ?>
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
			
			<!-- Add Category Modal -->
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Kasa Hareket Arama</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("kasa/kasa-hareket-kayitlari"); ?>" method="GET">
										<?php 
											if(isset($getkasa)){ ?>
												<input type="hidden" name="kasa" value="<?=$getkasa;?>">
										<?php }?>
										<div class="form-group">
											<label>Kayıt Tarihi Aralığına Göre </label>
											<input class="form-control" id="daterange" type="text" name="tarihAraligi" value="<?=$tarihAraligi;?>" autocomplete="off"/>
										</div>
										<div class="form-group">
											<label>Belge Numarasına Göre </label>
											<input class="form-control" type="text" name="belgeNo" value="<?=$belgeNo;?>" autocomplete="off">
										</div>
										<div class="form-group">
											<label>Hareket Türüne Göre </label>
											<select class="select form-control" name="hareketTuru">
												<option value="">Seçiniz...</option>
												<option value="14" <?php if($hareketTuru == 014){echo "selected";} ?>>Kasa açılış</option>
												<option value="1" <?php if($hareketTuru == 1){echo "selected";} ?>>Kasa tahsilat</option>
												<option value="2" <?php if($hareketTuru == 2){echo "selected";} ?>>Kasa Ödeme</option>
												<option value="3" <?php if($hareketTuru == 3){echo "selected";} ?>>Satış Faturası</option>
												<option value="4" <?php if($hareketTuru == 4){echo "selected";} ?>>Alış Faturası</option>
												<!-- <option value="5" <?php if($hareketTuru == 5){echo "selected";} ?>>Kasa Devir</option> -->
												<option value="6" <?php if($hareketTuru == 6){echo "selected";} ?>>Giderler</option>
												<option value="7" <?php if($hareketTuru == 7){echo "selected";} ?>>Kasa Virman</option>
												<option value="12" <?php if($hareketTuru == 12){echo "selected";} ?>>Kasadan Bankaya Transfer</option>
											</select>
										</div>
										<hr>

										<div class="form-group">
												<label>Sıralama </label>
												<select class="select form-control" name="siralama">
													<option value="">Seçiniz...</option>
													<option value="1" <?php if($siralama == 1){echo "selected"; }?>>Tarih büyükten küçüğe</option>
													<option value="2" <?php if($siralama == 2){echo "selected"; }?>>Tarih küçükten büyüğe</option>
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

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<?php if ($this->session->flashdata('kasa_virman_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Kasa virman işlemi başarılı bir şekilde gerçekleştirildi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

		<?php if ($this->session->flashdata('tahsilat_sil')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "Kasa tahsilatı başarılı bir şekilde silindi.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('odeme_sil')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "Kasa ödemesi başarılı bir şekilde silindi.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('gider_sil')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "Kasa gideri başarılı bir şekilde silindi.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('virman_sil')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "Kasa virman başarılı bir şekilde silindi.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('hata_sil')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "Beklenmedik bir hata oluştu.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('transfer_sil')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "Kasadan bankaya transfer silindi.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('kasadan_bankaya_transfer_ok')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "Kasadan bankaya transfer başarılı bir şekilde gerçekleştirildi.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>
		
<?php $this->load->view("include/footer-js"); ?>
<!-- Select2 JS -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>

<script>
	$('#kasalar').change(function(){
    $('#kasaForm').submit();
});
</script>

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
