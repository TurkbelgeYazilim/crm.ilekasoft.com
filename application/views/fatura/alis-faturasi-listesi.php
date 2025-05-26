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
								<h3 class="page-title">Fatura</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Fatura
									</li>
									<li class="breadcrumb-item active">Alış Faturası Listesi</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->

					<?php
					$firma = getirFirma();
					$deletePermission = $firma->ayarlar_deletePermission;
						$anaHesap = anaHesapBilgisi();

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
											<h5 class="card-title">Alış Faturası Listesi</h5>
										</div>
										<div class="col-auto">
											<a href="<?= base_url("fatura/alisFaturasiExcel$qs"); ?>" class="btn btn-outline-success btn-sm" style='font-family: Arial, Helvetica, sans-serif;'><i class="fa fa-file-excel"></i> Dışa aktar</a>
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
													<th>Fatura Tarihi</th>
													<th>Etiket</th>
													<th>Fatura No</th>
													<!--<th>İrsaliye No</th>-->
													<!-- <th>Fatura Türü</th> -->
													<th>Cari Adı</th>
													<th>Genel Toplam</th>
													<th class="text-right">İşlem</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($alisFaturasi as $af){?>
													<?php 
														$faturaTuru = $af->alis_faturaTipi;
														if($faturaTuru == 1){
															$faturaTuruTxt = '<span class="badge bg-info-light">Açık Fatura</span>';
														}else if($faturaTuru == 2){
															$faturaTuruTxt = '<span class="badge bg-warning-light">Kapalı Fatura</span>';
														}

														$cariID = $af->alis_cariID;
														$cariQ = "SELECT cari_ad,cari_soyad FROM cari WHERE cari_id = '$cariID'";
														$carie = $this->db->query($cariQ)->row();
													$cariAd = $carie->cari_ad." ".$carie->cari_soyad;

													$paraBirimi="TL";
													if($af->alis_paraBirimi==2)
														$paraBirimi="USD";
													else if($af->alis_paraBirimi==3)
														$paraBirimi="EUR";
													else if($af->alis_paraBirimi==4)
														$paraBirimi="GBP";


													if ($af->alis_faturaEtiketID != null) {

														$sqlEtiket = "select  * from etiketler where etiket_id=" . $af->alis_faturaEtiketID . "";
														$exeEtiket = $this->db->query($sqlEtiket)->row();
														$etiketAdi=$exeEtiket->etiket_adi;
													}
													else
													{
														$etiketAdi="";
													}
													?>
												<tr>
													<td><?= date('d.m.Y', strtotime($af->alis_faturaTarihi)); ?></td>
													<td><?= $etiketAdi ?></td>
													<td><?= $af->alis_faturaNo;?></td>
													<!--<td><?= $af->alis_irsaliyeNo; ?></td>-->
													<!-- <td><?= $faturaTuruTxt; ?></td> -->
													<td><a href="<?= base_url("cari/cari-hareketleri?cari=$cariID"); ?>" target="_blank"><?= $cariAd; ?></a></td>
													<td><?= $af->alis_genelToplam." ".$paraBirimi ?></td>
													<td class="text-right">
														<div class="dropdown show">
															<a class="dropdown-toggle" href="#" role="button"
															   id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
															   aria-expanded="false">
																<i class="fas fa-ellipsis-h"></i>
															</a>

															<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
														<a href="<?= base_url("fatura/goruntule?tipi=alis&id=$af->alis_id"); ?>"  class="dropdown-item text-info mr-2"><i class="far fa-eye mr-1"></i> Görüntüle</a>
														<a href="<?= base_url("fatura/alis-faturasi/$af->alis_id"); ?>"  class="dropdown-item mr-2" style="color:green;"><i class="far fa-edit mr-1"></i> Düzenle</a>
														<?php if ($deletePermission == 1) { ?>
															<a href="javascript:void(0);" data-toggle="modal"
															   data-target="#fatura_sil"
															   onclick="document.getElementById('fatura_id').value='<?= $af->alis_id ?>';document.getElementById('fatura_no').innerHTML='Fatura numarası <?= $af->alis_faturaNo ?>  olan faturayı silmek istediğinizden emin misiniz?';"
															   class="dropdown-item text-danger mr-2"><i
																		class="far fa-trash-alt mr-1"></i> Sil</a>
														<?php } ?>
															</div>
														</div>
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
				$faturaNo = $this->input->get('faturaNo');
				//$irsaliyeNo = $this->input->get('irsaliyeNo');
			$etiket = $this->input->get('etiket');
				$tarihAraligi = $this->input->get('tarihAraligi');
				//$cariAdi = $this->input->get('cariAdi');
				$siralama = $this->input->get('siralama');
	$ayArama=$this->input->get('ayArama');
			?>
			<!-- Add Category Modal -->
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Alış Faturası Arama</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("fatura/alis-faturasi-listesi"); ?>" method="GET">
									    	    <div class="form-group">
							<label>Aya Göre (Tüm yıllarda)</label>
    						<select class="select form-control" name="ayArama">
    								<option value="">Seçiniz...</option>
    								<option value="1" <?php if ($ayArama == 1) {
    									echo "selected";
    								} ?>>Ocak
    								</option>
    								<option value="2" <?php if ($ayArama == 2) {
    									echo "selected";
    								} ?>>Şubat
    								<option value="3" <?php if ($ayArama == 3) {
    									echo "selected";
    								} ?>>Mart
    								<option value="4" <?php if ($ayArama == 4) {
    									echo "selected";
    								} ?>>Nisan
    								<option value="5" <?php if ($ayArama == 5) {
    									echo "selected";
    								} ?>>Mayıs
    								<option value="6" <?php if ($ayArama == 6) {
    									echo "selected";
    								} ?>>Haziran
    								<option value="7" <?php if ($ayArama == 7) {
    									echo "selected";
    								} ?>>Temmuz
    								<option value="8" <?php if ($ayArama == 8) {
    									echo "selected";
    								} ?>>Ağustos
    								<option value="9" <?php if ($ayArama == 9) {
    									echo "selected";
    								} ?>>Eylül
    								<option value="10" <?php if ($ayArama == 10) {
    									echo "selected";
    								} ?>>Ekim
    								<option value="11" <?php if ($ayArama == 11) {
    									echo "selected";
    								} ?>>Kasım
    								<option value="12" <?php if ($ayArama == 12) {
    									echo "selected";
    								} ?>>Aralık
    								</option>
    							</select>
						</div>
					
										<div class="form-group">
											<label>Kayıt Tarihi Aralığına Göre </label>
											<input class="form-control" id="daterange" type="text" name="tarihAraligi" value="<?=$tarihAraligi;?>" autocomplete="off"/>
										</div>
										<div class="form-group">
											<label>Fatura No'ya Göre </label>
											<input class="form-control" type="text" name="faturaNo" value="<?=$faturaNo;?>" autocomplete="off">
										</div>
										<!--
										<div class="form-group">
											<label>İrsaliye No'ya Göre </label>
											<input class="form-control" type="text" name="irsaliyeNo" value="<?=$irsaliyeNo;?>" autocomplete="off">
										</div>-->
										<?php
										$anaHesap = anaHesapBilgisi();
										$sqlEtiket = "SELECT * FROM etiketler WHERE etiket_olusturanAnaHesap = '$anaHesap'";
										$etiketler = $this->db->query($sqlEtiket)->result();
										?>
										<div class="form-group">
											<label>Etiket Adına Göre </label>
											<select name="etiket" class="form-control">
												<option value="">Etiket adı seçiniz...</option>
												<?php foreach ($etiketler as $item) { ?>
													<option value="<?= $item->etiket_id; ?>" <?php if ($item->etiket_id == $etiket) {
														echo "selected";
													} ?>><?= $item->etiket_adi; ?></option>
												<?php } ?>
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
										<!-- <div class="form-group">
											<label>Cari Adına Göre </label>
											<input class="form-control" type="text" name="cariAdi" value="<?=$cariAdi;?>" autocomplete="off">
										</div> -->
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
			<div id="fatura_sil" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Alış Faturası Silme</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="<?= base_url("fatura/alis_fatura_sil"); ?>" method="GET">
								<input type="hidden" name="fatura_id" id="fatura_id" value="">
								<p id="fatura_no"></p>
								<div class="submit-section">
									<button class="btn btn-danger submit-btn">Sil</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- /Main Wrapper -->

<?php if ($this->session->flashdata('fatura_ok')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "success", 
				  text: "Alış faturası eklenmiştir.",
				  confirmButtonText:'Tamam',
				  button: false,
				  timer: 5000,
				});
			</script>
<?php endif; ?>

		<?php if ($this->session->flashdata('fatura_sil_ok')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "Alış faturası silinmiştir.",
					confirmButtonText: 'Tamam',
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
