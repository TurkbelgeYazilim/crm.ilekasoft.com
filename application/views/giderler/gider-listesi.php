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
								<h3 class="page-title">Giderler</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Giderler
									</li>
									<li class="breadcrumb-item active">Gider Listesi</li>
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
											<h5 class="card-title">Gider Listesi</h5>
										</div>
										<div class="col-auto">
											<a href="<?= base_url("giderler/giderListesiExcel$qs"); ?>" class="btn btn-outline-success btn-sm" style='font-family: Arial, Helvetica, sans-serif;'><i class="fa fa-file-excel"></i> Dışa aktar</a>
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
													<th>Gider Türü</th>
													<th>Gider Kategorisi</th>
													<th>VKN / TCKN</th>
													<th>Unvan</th>
													<th>Banka</th>
													<th>Kasa</th>
													<th>KDV</th>
													<th>Tutar</th>
													<th class="text-right">İşlem</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$tumKdv=0;
												$tumTutar=0;
												foreach($giderler as $gdr){
												$tumKdv += $gdr->gider_kdv;
												$tumTutar += $gdr->gider_tutar;
												?>
													<?php 
														$gider_gkID = $gdr->gider_gkID;

														$gider_gkSubID = $gdr->gider_gkSubID;

														$bankaID = $gdr->gider_bankaID;
														$kasaID = $gdr->gider_kasaID;

														$kategoriQ = "SELECT * FROM giderKategorileri WHERE gk_id = '$gider_gkID'";
														$kategoriExe = $this->db->query($kategoriQ)->row();

														$kategoriQ2 = "SELECT * FROM giderKategorileri WHERE gk_id ='$gider_gkSubID'";
														$kategoriExe2 = $this->db->query($kategoriQ2)->row();

														if($bankaID){
															$bankaQ = "SELECT * FROM banka WHERE banka_id = '$bankaID'";
															$bankaExe = $this->db->query($bankaQ)->row();

															$bankaTxt = $bankaExe->banka_bankaAd;
															$kasaTxt = "";
														}else if($kasaID){
															$kasaQ = "SELECT * FROM kasa WHERE kasa_id = '$kasaID'";
															$kasaExe = $this->db->query($kasaQ)->row();

															$kasaTxt = $kasaExe->kasa_adi;
															$bankaTxt = "";
														}
													?>
												<tr>
													<td><?= date('d.m.Y', strtotime($gdr->gider_tarih)); ?></td>
													<td><?= $gdr->gider_tur ?></td>
													<td><b><?= $kategoriExe->gk_adi; ?></b> > <?= $kategoriExe2->gk_adi; ?></td>
													<td><?= $gdr->gider_vkn ?></td>
													<td style="white-space: normal"><?= $gdr->gider_vknInfo ?></td>
													<td><?= $bankaTxt;?></td>
													<td><?= $kasaTxt; ?></td>
													<td><?= number_format($gdr->gider_kdv,2); ?> ₺</td>
													<td><span class="badge bg-danger-light"><?= number_format($gdr->gider_tutar,2); ?> ₺</span></td>
													<td class="text-right">

														<a href="<?= base_url("giderler/gider-duzenle/$gdr->gider_id"); ?>"  class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Düzenle</a>
														<?php if($deletePermission == 1){ ?>
															<a href="<?= base_url("giderler/sil/gider/$gdr->gider_id"); ?>"  class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i> Sil</a>
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
<span style="margin-left:15px;">Toplam kayıt sayısı:</span> <b><?= $count_of_list; ?></b>

								<span style="margin-left:15px;">Toplam KDV: <b><?= number_format($tumKdv, 2); ?></b></span>
								<span style="margin-left:15px;">Toplam tutar: <b><?= number_format($tumTutar, 2); ?></b></span>

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
				$giderKategorisi = $this->input->get('giderKategorisi');
				$tarihAraligi = $this->input->get('tarihAraligi');
			$gidertur = $this->input->get('gidertur');
				$siralama = $this->input->get('siralama');
			?>
			<!-- Add Category Modal -->
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Gider Arama</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("giderler/gider-listesi"); ?>" method="GET">
										<div class="form-group">
											<label>Kayıt Tarihi Aralığına Göre </label>
											<input class="form-control" id="daterange" type="text" name="tarihAraligi" value="<?=$tarihAraligi;?>" autocomplete="off"/>
										</div>
										<div class="form-group">
											<label>Gider Türüne Göre </label>
											<select class="select form-control" name="gidertur">
												<option value="">Seçiniz...</option>
												<option value="Gider" <?php if($gidertur=="Gider") echo "selected"; ?>>Gider</option>
												<option value="Fiş" <?php if($gidertur=="Fiş") echo "selected"; ?>>Fiş</option>
												<option value="Fatura" <?php if($gidertur=="Fatura") echo "selected"; ?>>Fatura</option>
											</select>
										</div>
										<div class="form-group">
											<label>Gider Kategorisine Grubuna Göre </label>
											<select class="select form-control" name="giderKategorisi">
												<option value="">Seçiniz...</option>
												<?php 
													$giderKategorisiQ = "SELECT * FROM giderKategorileri WHERE gk_olusturanAnaHesap = '$anaHesap'";
													$giderKategorisim = $this->db->query($giderKategorisiQ)->result(); 
												?>
												<?php foreach($giderKategorisim as $gk){?>
													<option value="<?= $gk->gk_id; ?>" <?php if($gk->gk_id == $giderKategorisi){echo "selected";} ?>><?=$gk->gk_adi;?></option>
												<?php }?>
											</select>
										</div>

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
