<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>
</head>
	<body>

	<?php

	$firma = getirFirma();
	$deletePermission = $firma->ayarlar_deletePermission;
	?>
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
								<h3 class="page-title">Çek</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Çek
									</li>
									<li class="breadcrumb-item active">Çek Portföyü</li>
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
					?>
				
					<div class="row">
						
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Çek Portföyü</h5>
										</div>
										<div class="col-auto">
											<a href="<?= base_url("cek/yeni-cek"); ?>" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i> Yeni Çek Giriş/Çıkış Ekle</a>
										</div>
										<!-- <div class="col-auto">
											<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#add_category"><i class="fa fa-search"></i> Arama</a>
										</div> -->
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
												<tr>
													<th>Portföy No</th>
													<th>Banka</th>
													<th>Kayıt Tarihi</th>
													<th>Vade Tarihi</th>
													<th>Tipi</th>
													<th>Cari / Borçlu</th>
													<th>Tutar</th>
													<th>Bilgi</th>
													<th>Durumu</th>
													<th class="text-right">İşlem</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($cek as $cekler){?>

													<?php
														$hareketTipi = $cekler->cek_hareketTipi;
														$durum = $cekler->cek_durum;

														$borcluID = $cekler->cek_borcluID;
														$cekCariID = $cekler->cek_cariID;

														if($hareketTipi == 1){
															$hareketTipiText = "Alınan Çek";
															$cariQ = "SELECT * FROM cari WHERE cari_id = '$borcluID' ";
															$cari = $this->db->query($cariQ)->row();
															$firmaAd = $cari->cari_ad." ".$cari->cari_soyad;
															//seçilen cari
														}else if($hareketTipi == 2){
															$hareketTipiText = "Verilen Çek";
															//kendi firmasının adı
															/*$firma = getirFirma();
															$firmaAd = $firma->ayarlar_firmaAd;*/
															$cariQ = "SELECT * FROM cari WHERE cari_id = '$cekCariID' ";
															$cari = $this->db->query($cariQ)->row();
															$firmaAd = $cari->cari_ad." ".$cari->cari_soyad;
														}

														if($durum == 0){
															$durumText = "<span class='text-danger'> Henüz ödenmedi</span>";
														}else if($durum == 1){
															$durumText = "<span class='text-success'>Ödemesi yapıldı</span>";
														}

														$bankaID = $cekler->cek_bankaID;
														$bankaQ = "SELECT * FROM turkiyeBankalarListesi WHERE trbanka_id = '$bankaID'";
														$bankalar = $this->db->query($bankaQ)->row();
													?>
												<tr>
													<td><?= $cekler->cek_portfoyNo; ?></td>
													<td><?= $bankalar->trbanka_ad;?></td>
													<td><?= date('d.m.Y', strtotime($cekler->cek_kayitTarihi)); ?></td>
													<td><?= date('d.m.Y', strtotime($cekler->cek_vadeTarih)); ?></td>
													<td><?= $hareketTipiText; ?></td>
													<td><?= $firmaAd; ?></td>
													<td><?= $cekler->cek_tutar; ?></td>
													<td><?= $cekler->cek_notAciklama; ?></td>
													<td><?= $durumText; ?></td>
													<td class="text-right">
														<?php if($durum == 0){ ?>
															<a href="javascript:void(0);" data-toggle="modal" data-target="#edit_category" data-id="<?= $cekler->cek_id; ?>" data-tutar="<?= $cekler->cek_tutar; ?>"  class="btn btn-sm btn-white text-success mr-2"><i class="fa fa-money-bill mr-1"></i> Öde</a>
															<a href="<?= base_url("cek/cekduzenle/".$cekler->cek_id) ?>" class="btn btn-sm btn-white text-success mr-2"> Düzenle</a>
														<?php if ($deletePermission == 1) { ?>
															<a href="javascript:void(0);" data-toggle="modal" data-target="#sil" onclick="document.getElementById('cek_id').value='<?= $cekler->cek_id; ?>';document.getElementById('cek_no').innerHTML='Çek portföy numarası <?= $cekler->cek_portfoyNo; ?> olan çeki silmek istiyor musunuz?';"   class="btn btn-sm btn-white text-danger mr-2">Sil</a>
														<?php } }?>

														<!-- <a href="<?= base_url("cek/cek-detaylari/$cekler->cek_id"); ?>"  class="btn btn-sm btn-white text-info mr-2" target="_blank"><i class="far fa-eye mr-1"></i> Görüntüle</a> -->

													</td>
												</tr>
											<?php }?>
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
				$irsaliyeNo = $this->input->get('irsaliyeNo');
				//$cariAdi = $this->input->get('cariAdi');
				$tarihAraligi = $this->input->get('tarihAraligi');
				$siralama = $this->input->get('siralama');
			?>
			<!-- Add Category Modal -->
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Satış Faturası Arama</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("fatura/satis-faturasi-listesi"); ?>" method="GET">
										<div class="form-group">
											<label>Kayıt Tarihi Aralığına Göre </label>
											<input class="form-control" id="daterange" type="text" name="tarihAraligi" value="<?=$tarihAraligi;?>" autocomplete="off"/>
										</div>
										<div class="form-group">
											<label>Fatura No'ya Göre </label>
											<input class="form-control" type="text" name="faturaNo" value="<?=$faturaNo;?>" autocomplete="off">
										</div>
										<div class="form-group">
											<label>İrsaliye No'ya Göre </label>
											<input class="form-control" type="text" name="irsaliyeNo" value="<?=$irsaliyeNo;?>" autocomplete="off">
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

				<?php
					$kasalarQ = "SELECT * FROM kasa WHERE kasa_olusturanAnaHesap = '$anaHesap' ";
					$bankalarQ = "SELECT * FROM banka WHERE banka_olusturanAnaHesap = '$anaHesap' ";

					$kasalarExe = $this->db->query($kasalarQ)->result();
					$bankalarExe = $this->db->query($bankalarQ)->result();
				?>

			<div id="edit_category" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Çek Ödemesi</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="<?= base_url("cek/cekOdeme"); ?>" method="POST">
								<input type="hidden" id="cekID" name="cekID">
								<div class="form-group">
									<label>Kasa</label>
									<select class="form-control " name="cekKasa" id="odemeKasa">
										<option value="">Kasa seçiniz...</option>
										<?php foreach($kasalarExe as $kasa){?>
												<option value="<?= $kasa->kasa_id;?>"><?=$kasa->kasa_adi;?></option>
										<?php }?>
									</select>
								</div>
								<div class="form-group">
									<label>Banka</label>
									<select class="form-control " name="cekBanka" id="odemeBanka">
										<option value="">Banka seçiniz...</option>
										<?php foreach($bankalarExe as $banka){?>
											<option value="<?= $banka->banka_id;?>"><?=$banka->banka_hesapAd;?></option>
										<?php }?>
									</select>
								</div>
								<div class="form-group">
									<label>Tutar <span class="text-danger">*</span></label>
									<input class="form-control" type="text" id="cekTutar" name="cekTutar" required="" readonly>
								</div>
								<div class="submit-section">
									<button class="btn btn-danger submit-btn">Ödemeyi Tamamla</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Main Wrapper -->

	<!-- Modal Delete  -->
	<div id="sil" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Çek Silme</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url("cek/cek_sil"); ?>" method="POST">
						<input type="hidden" name="cek_id" id="cek_id" value="">
						<p id="cek_no"></p>
						<div class="submit-section">
							<button class="btn btn-danger submit-btn">Evet</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<?php if ($this->session->flashdata('cek_ok')): ?>
	<script>
		swal({
		  title: "Bilgilendirme",
		  type: "success", 
		  text: "Çek başarılı bir şekilde eklendi.",
		  confirmButtonText:'Tamam',
		  button: false,
		  timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('senet_odeme_ok')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Senet başarılı bir şekilde ödendi.",
			confirmButtonText:'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

		<?php if ($this->session->flashdata('cek_odeme_sec')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "Lütfen banka veya kasa seçiniz...",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

	<?php if ($this->session->flashdata('cek_sil_ok')) : ?>
		<script>
			swal({
				title: "Bilgilendirme",
				type: "success",
				text: "Çek başarıyla silindi.",
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
			$('#edit_category').on('show.bs.modal', function (event) {
				let id = $(event.relatedTarget).data('id')
				let tutar = $(event.relatedTarget).data('tutar')

				$(this).find('.modal-body #cekID').val(id)
				$(this).find('.modal-body #cekTutar').val(tutar)
			})
		</script>

		<script>
			$("#odemeKasa").on('change',function() {
				$('#odemeBanka').val("");
			});

			$("#odemeBanka").on('change',function() {
				$('#odemeKasa').val("");
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
