<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>
		<style>
.btn.text-danger, .btn.btn-white.text-danger, .btn.btn-danger, .btn-danger {
    color: #fff !important;
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
			<?php

			$firma = getirFirma();
			$deletePermission = $firma->ayarlar_deletePermission;
			?>
			<div class="page-wrapper">
				<div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-10">
								<h3 class="page-title">Stok</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Stok
									</li>
									<li class="breadcrumb-item active">Stok Listesi</li>
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
											<h5 class="card-title">Stok Listesi</h5>
										</div>

										<div class="col-auto">
											<a href="<?= base_url("stok/stokListesiExcel$qs"); ?>" class="btn btn-outline-success btn-sm" style='font-family: Arial, Helvetica, sans-serif;'><i class="fa fa-file-excel"></i> Dışa aktar</a>
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
													<th>Stok Kodu</th>
													<th>Stok Adı</th>
													<th>Birim</th>
													<th>Grup Adı</th>
													<th>Durum</th>
													<th class="text-right">İşlem</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($stok as $st){?>
												<?php
													$birimQ = "SELECT * FROM stokBirimleri WHERE stokBirim_id = '$st->stok_birimID'";
													$birimExe = $this->db->query($birimQ)->row();

													$grupQ = "SELECT * FROM stokGruplari WHERE stokGrup_olusturanAnaHesap='$anaHesap' AND stokGrup_id = '$st->stok_stokGrupKoduID'";
													$grupExe = $this->db->query($grupQ)->row();

													$toplamGirisQ = "SELECT SUM(sh_giris) AS toplamGiris FROM stokHareketleri WHERE sh_olusturanAnaHesap = '$anaHesap' AND sh_stokID = '$st->stok_id'";
													$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

													$toplamCikisQ = "SELECT SUM(sh_cikis) AS toplamCikis FROM stokHareketleri WHERE sh_olusturanAnaHesap = '$anaHesap' AND sh_stokID = '$st->stok_id'";
													$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

													$toplamGiris = $toplamGirisExe->toplamGiris;
													$toplamCikis = $toplamCikisExe->toplamCikis;
													$kalan = $toplamGiris - $toplamCikis;

													$stokKritik = $st->stok_kritikSeviyesi;

													$stokHareketVarmi = "SELECT * FROM stokHareketleri WHERE sh_stokID = '$st->stok_id' AND sh_olusturanAnaHesap = '$anaHesap' ";
													$stokHareketVarmiExe = $this->db->query($stokHareketVarmi)->row();

													if(!empty($stokKritik)){
														if($stokHareketVarmiExe){//eğer stok hareketlerinde bu stok ile ilgili herhangi bir işlem yapıldıysa ve kritik seviyesini kontrol et
															if($kalan < $stokKritik){
																	$stokClr = "text-danger";
															}else{
																	$stokClr = "";
															}
														}else{
															$stokClr = "";
														}
													}else{$stokClr = "";}
													

												?>

												<tr class="<?= $stokClr; ?>">
													<td><a href="<?= base_url("stok/stok-hareketleri?stok=$st->stok_id"); ?>"><?= $st->stok_kodu;?></a></td>
													<td><?= $st->stok_ad;?></td>
													<td><?php echo $birimExe->stokBirim_ad; ?></td>
													<td><?php echo $grupExe->stokGrup_ad; ?></td>
													<td><b><?= number_format($kalan,0); ?></b> <?php echo $birimExe->stokBirim_ad; ?></td>
													<td class="text-right">
														<a href="<?= base_url("stok/stok-hareketleri?stok=$st->stok_id"); ?>"  class="btn btn-sm btn-white text-info mr-2"><i class="far fa-eye mr-1"></i> Hareketleri Görüntüle</a> 
														<a href="<?= base_url("stok/stok-karti-duzenle/$st->stok_id"); ?>"  class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Düzenle</a>
														<?php if ($deletePermission == 1) { ?>
															<a href="javascript:void(0);" data-toggle="modal"
															   data-target="#stok_sil"
															   onclick="document.getElementById('stok_id').value='<?= $st->stok_id ?>';document.getElementById('stok_ad').innerHTML='Stok kodu <?= $st->stok_kodu ?> olan stoğu pasif hale getirmek istediğinizden emin misiniz?';"
															   class="btn btn-sm btn-white text-danger mr-2"><i
																		class="far fa-trash-alt mr-1"></i> Sil</a>
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
			<?php 
				$stokKodu = $this->input->get('stokKodu');
				$stokAdi = $this->input->get('stokAdi');
				$stokGrubum = $this->input->get('stokGrubu');
				$tarihAraligi = $this->input->get('tarihAraligi');
			?>
			<!-- Add Category Modal -->
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Stok Kartı Arama</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("stok/stok-listesi"); ?>" method="GET">
										<div class="form-group">
											<label>Kayıt Tarihi Aralığına Göre </label>
											<input class="form-control" id="daterange" type="text" name="tarihAraligi" value="<?=$tarihAraligi;?>" autocomplete="off"/>
										</div>

										<div class="form-group">
											<label>Stok Koduna Göre </label>
											<input class="form-control" type="text" name="stokKodu" value="<?=$stokKodu;?>" autocomplete="off">
										</div>
										<div class="form-group">
											<label>Stok Adına Göre </label>
											<input class="form-control" type="text" name="stokAdi" value="<?=$stokAdi;?>" autocomplete="off">
										</div>
										<div class="form-group">
											<label>Stok Grubuna Göre </label>
											<select class="select form-control" name="stokGrubu">
												<option value="">Seçiniz...</option>
												<?php 
													$stokGrubuQ = "SELECT * FROM stokGruplari WHERE stokGrup_olusturanAnaHesap = '$anaHesap'";
													$stokGrubu = $this->db->query($stokGrubuQ)->result(); 
												?>
												<?php foreach($stokGrubu as $sg){?>
													<option value="<?= $sg->stokGrup_id; ?>" <?php if($sg->stokGrup_id == $stokGrubum){echo "selected";} ?>><?=$sg->stokGrup_ad;?></option>
												<?php }?>
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

		<!-- Modal Delete  -->
		<div id="stok_sil" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Stok Kartı Silme</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url("stok/stok_sil"); ?>" method="GET">
							<input type="hidden" name="stok_id" id="stok_id" value="">
							<p id="stok_ad"></p>
							<div class="submit-section">
								<button class="btn btn-danger submit-btn">Evet</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


		</div>

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
<?php if ($this->session->flashdata('stok_sil_ok')) : ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Stok başarıyla pasif hale getirildi.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>
</body>
</html>
