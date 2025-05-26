<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<style>
		.ui-autocomplete {
			z-index: 999999;
			max-height: 200px;
			overflow-y: auto;
			/* prevent horizontal scrollbar */
			overflow-x: hidden;
			/* add padding to account for vertical scrollbar */
			padding-right: 20px;
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
						<h3 class="page-title">Stok</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
							</li>
							<li class="breadcrumb-item">Stok
							</li>
							<li class="breadcrumb-item active">Stok Hareketleri</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i>
							<br>Önceki Sayfa</a>
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			<?php
			$anaHesap = anaHesapBilgisi();

			$stoklarQ = "SELECT * FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap'";
			$stoklar = $this->db->query($stoklarQ)->result();

			$secilenStok = $_GET["stok"];

			$stokTuru = $this->input->get('stokTuru');
			$getstok = $this->input->get('stok');
			$tarihAraligi = $this->input->get('tarihAraligi');
			$stokKodu = $this->input->get('stokKodu');


			$siralama = $this->input->get('siralama');

			if ($_SERVER['QUERY_STRING']) {
				$qs = "?" . $_SERVER['QUERY_STRING'];
			}
			?>

			<div class="row">

				<div class="col-xl-12 col-md-12">
					<div class="card card-table">
						<div class="card-header">
							<div class="row">
								<div class="col">
									<h5 class="card-title">Stok Hareketleri</h5>
								</div>
								<div class="col-auto">
									<form action="<?= base_url("stok/stok-hareketleri"); ?>" method="GET" id="stokForm">
										<select class="btn btn-outline-light" id="stoklar" name="stok">
											<option value="tumu">Seç: Tümü</option>
											<?php foreach ($stoklar as $stokk) { ?>
												<option value="<?= $stokk->stok_id ?>" <?php if ($secilenStok == $stokk->stok_id) {
													echo "selected";
												} ?>>Seç: <?= $stokk->stok_ad; ?></option>
											<?php } ?>
										</select>

										<?php
										if (isset($stokTuru)) { ?>
											<input type="hidden" name="stokTuru" value="<?= $stokTuru; ?>">
										<?php } ?>

										<?php
										if (isset($stokKodu)) { ?>
											<input type="hidden" name="stokKodu" value="<?= $stokKodu; ?>">
										<?php } ?>

										<?php
										if (isset($tarihAraligi)) { ?>
											<input type="hidden" name="tarihAraligi" value="<?= $tarihAraligi; ?>">
										<?php } ?>


									</form>
								</div>
								<div class="col-auto">
									<a href="javascript:void(0);" class="btn btn-outline-success btn-sm">Toplam
										Giriş: <?= number_format($toplamGiris, 2); ?></a>
									<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm ml-2">Toplam
										Çıkış: <?= number_format($toplamCikis, 2); ?></a>
									<a href="javascript:void(0);"
									   class="btn btn-outline-info btn-sm ml-2">Kalan: <?= number_format($kalan, 2); ?></a>
								</div>
								<?php if (isset($stokTuru) || isset($getstok) || isset($tarihAraligi)) { ?>
									<div class="col-auto">
										<a href="<?= base_url("stok/stok-hareketleri"); ?>"
										   class="btn btn-outline-primary btn-sm"><i class="fa fa-times-circle"></i>
											Filtrelemeyi Kaldır</a>
									</div>
								<?php } ?>
								<div class="col-auto">
									<div class="col-auto">
										<a href="javascript:void(0);" data-toggle="modal"
										   data-target="#anonim_stok" class="btn btn-outline-success btn-sm" onclick="document.getElementById('anonimForm').action = '<?= base_url("stok/anonimKayit") ?>';"
										   style='font-family: Arial, Helvetica, sans-serif;'><i class="fa fa-plus"></i>
											Anonim Stok Hareketi</a>
									</div>
								</div>
								<div class="col-auto">
									<a href="<?= base_url("stok/stokHareketleriExcel$qs"); ?>"
									   class="btn btn-outline-success btn-sm"
									   style='font-family: Arial, Helvetica, sans-serif;'><i
												class="fa fa-file-excel"></i> Dışa aktar</a>
								</div>
								<div class="col-auto">
									<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm"
									   data-toggle="modal" data-target="#add_category"><i class="fa fa-search"></i>
										Arama</a>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0">
									<thead>
									<tr>
										<th>Tarih</th>
										<th>Stok Adı</th>
										<th>Türü</th>
										<th>Giriş</th>
										<th>Çıkış</th>
										<th>Birim Fiyat</th>
										<th>KDV (%)</th>
										<th>KDV</th>
										<th>Toplam Fiyat</th>
										<th class="text-right">İşlem</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($stokHareketleri as $sh) { ?>
										<?php
										$stokID = $sh->sh_stokID;
										$stokQ = "SELECT * FROM stok WHERE stok_id = '$stokID' AND stok_olusturanAnaHesap = '$anaHesap'";
										$stokexe = $this->db->query($stokQ)->row();

										$turu = $sh->sh_turu;
										if ($turu == 5) {
											$turuTxt = '<span class="badge bg-success-light">Başlangıç Adedi</span>';
											$giris = '<span class="badge bg-success-light">' . number_format($sh->sh_giris, 2) . '</span>';
										} else if ($turu == 1) {
											$turuTxt = '<span class="badge bg-success-light">Alış Faturası</span>';
											$giris = '<span class="badge bg-success-light">' . number_format($sh->sh_giris, 2) . '</span>';
											$cikis = '';
										} else if ($turu == 2) {
											$turuTxt = '<span class="badge bg-danger-light">Satış Faturası</span>';
											$giris = '';
											$cikis = '<span class="badge bg-danger-light">' . number_format($sh->sh_cikis, 2) . '</span>';
										} else if ($turu == 3) {
											$turuTxt = '<span class="badge bg-info text-light">E-Fatura</span>';
											$giris = '';
											$cikis = '<span class="badge  bg-info text-light">' . number_format($sh->sh_cikis, 2) . '</span>';
										} else if ($turu == 4) {
											$turuTxt = '<span class="badge bg-danger-light">E-Arşiv</span>';
											$giris = '';
											$cikis = '<span class="badge bg-danger-light">' . number_format($sh->sh_cikis, 2) . '</span>';
										} else if ($turu == 6) {
											$turuTxt = '<span class="badge bg-primary-light">Anonim Stok</span>';
											if($sh->sh_cikis){
												$cikis = '<span class="badge bg-danger-light">' . number_format($sh->sh_cikis, 2) . '</span>';
												$giris = '';
											}else if($sh->sh_giris){
												$giris = '<span class="badge bg-success-light">' . number_format($sh->sh_giris, 2) . '</span>';
												$cikis = '';
											}
										}
										?>
										<tr>
										<td><?= date('d.m.Y', strtotime($sh->sh_tarih)); ?></td>
										<td><?= $stokexe->stok_ad; ?></td>
										<td><?= $turuTxt; ?></td>
										<td><?= $giris; ?></td>
										<td><?= $cikis; ?></td>
										<td><?= number_format($sh->sh_birimFiyat, 2); ?> <?= $sh->sh_paraBirimi ?></td>
										<td><?= $sh->sh_kdv; ?></td>
										<td><?= number_format($sh->sh_toplamKDV, 2); ?> <?= $sh->sh_paraBirimi ?></td>
										<td><?= number_format($sh->sh_toplamFiyat, 2); ?> <?= $sh->sh_paraBirimi ?></td>
										<td class="text-right">
										<?php if ($sh->sh_faturaID == -1) { ?>
											<a href="<?= base_url("Edonusum/Efatura/GetInvoiceWithType/$sh->sh_belgeNumarasi/1/efaturaGelen/IN/1") ?>"
											   class='btn btn-sm btn-white text-info mr-2' target='_blank'><i
														class='far fa-eye mr-1'></i>Göster</a>
										<?php } else {
											if ($turu == 1) { ?>
												<a href="<?= base_url("fatura/alis-faturasi-duzenle/$sh->sh_faturaID"); ?>"
												   class="btn btn-sm btn-white text-success mr-2" target="_blank"><i
															class="far fa-edit mr-1"></i> Düzenle</a>
											<?php } else if ($turu == 2) { ?>
												<a href="<?= base_url("fatura/satis-faturasi/$sh->sh_faturaID"); ?>"
												   class="btn btn-sm btn-white text-success mr-2" target="_blank"><i
															class="far fa-edit mr-1"></i> Düzenle</a>
											<?php } else if ($turu == 3) { ?>
												<a href="<?= base_url("fatura/efatura-olustur/$sh->sh_faturaID"); ?>"
												   class="btn btn-sm btn-white text-success mr-2" target="_blank"><i
															class="far fa-edit mr-1"></i> Düzenle</a>
											<?php } else if ($turu == 4) { ?>
												<a href="<?= base_url("fatura/earsiv-olustur/$sh->sh_faturaID"); ?>"
												   class="btn btn-sm btn-white text-success mr-2" target="_blank"><i
															class="far fa-edit mr-1"></i> Düzenle</a>
											<?php } else if ($turu == 6) {?>
												<a href="javascript:void(0);" onclick="document.getElementById('anonimID').value='<?= $sh->sh_id ?>';document.getElementById('anonimStokKodu').value='<?= $stokexe->stok_kodu ?>';document.getElementById('anonimStokAdi').value='<?= $stokexe->stok_ad ?>';document.getElementById('anonimStokID').value='<?= $stokexe->stok_id ?>';document.getElementById('anonimMiktar').value='<?= $sh->sh_cikis ?>';document.getElementById('anonimBirimFiyat').value='<?= $sh->sh_birimFiyat ?>';document.getElementById('anonimKdv').value='<?= $sh->sh_kdv ?>';document.getElementById('anonimParaBirimi').value='<?= $sh->sh_paraBirimi ?>';document.getElementById('anonimKdvHesap').value='<?= $sh->sh_toplamKDV ?>';document.getElementById('anonimToplam').value='<?= $sh->sh_toplamFiyat ?>';document.getElementById('anonimForm').action = '<?= base_url("stok/anonimDuzenle") ?>';"  data-toggle="modal"
												   data-target="#anonim_stok"
												   class="btn btn-sm btn-white text-success mr-2" target="_blank"><i
															class="far fa-edit mr-1"></i> Düzenle</a>
											<?php } ?>
											</td>
											</tr>
										<?php }
									} ?>
									</tbody>
								</table>
								<hr>
								<span style="margin-left:15px;">Toplam kayıt sayısı:</span>
								<b><?= $count_of_list; ?></b>
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
					<h5 class="modal-title">Stok Hareket Arama</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url("stok/stok-hareketleri"); ?>" method="GET">
						<?php
						if (isset($getstok)) { ?>
							<input type="hidden" name="stok" value="<?= $getstok; ?>">
						<?php } ?>
						<div class="form-group">
							<label>Kayıt Tarihi Aralığına Göre </label>
							<input class="form-control" id="daterange" type="text" name="tarihAraligi"
								   value="<?= $tarihAraligi; ?>" autocomplete="off"/>
						</div>

						<div class="form-group">
							<label>Stok Koduna Göre </label>
							<input class="form-control" type="text" name="stokKodu"
								   value="<?= $stokKodu; ?>" autocomplete="off"/>
						</div>
						<div class="form-group">
							<label>Stok Türüne Göre </label>
							<select class="select form-control" name="stokTuru">
								<option value="">Seçiniz...</option>
								<option value="1" <?php if ($stokTuru == 1) {
									echo "selected";
								} ?>>Alış Faturası
								</option>
								<option value="2" <?php if ($stokTuru == 2) {
									echo "selected";
								} ?>>Satış Faturası
								</option>
							</select>
						</div>

						<hr>

						<div class="form-group">
							<label>Sıralama </label>
							<select class="select form-control" name="siralama">
								<option value="">Seçiniz...</option>
								<option value="1" <?php if ($siralama == 1) {
									echo "selected";
								} ?>>Tarih büyükten küçüğe
								</option>
								<option value="2" <?php if ($siralama == 2) {
									echo "selected";
								} ?>>Tarih küçükten büyüğe
								</option>
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

	<!-- Modal Delete  -->
	<div id="anonim_stok" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Anonim Stok Hareketi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" method="POST" id="anonimForm" name="anonimForm">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" name="anonimID" id="anonimID" value="">
								<label>Stok Kodu</label>
								<input type='text' class='form-control' name='anonimStokKodu' id='anonimStokKodu'
									   required placeholder="Stok Kodu">
							</div>
							<div class="col-md-6">
								<label>Stok Adı</label>
								<input type='text' class='form-control' name='anonimStokAdi' id='anonimStokAdi' required
									   placeholder="Stok Adı">
								<input type="hidden" name="anonimStokID" id="anonimStokID">
							</div>
						</div>
						<div class="row mt-4">

							<div class="col-md-6">
								<label>Çıkış Miktarı</label>
								<input type='number' class='form-control' name='anonimMiktar' id='anonimMiktar'  step='0.1'
									   placeholder="Çıkış Miktarı" onchange="hesapla()">
							</div>

							<div class="col-md-6">
								<label>Giriş Miktarı</label>
								<input type='number' class='form-control' name='anonimMiktar2' id='anonimMiktar2'  step='0.1'
									   placeholder="Giriş Miktarı" onchange="hesapla()">
							</div>
						</div>

						<div class="row mt-4">
							<div class="col-md-4">
								<label>Birim Fiyat</label>
								<input type='number' class='form-control' name='anonimBirimFiyat' id='anonimBirimFiyat'  onchange="hesapla()"
									   required  step='0.1'
									   placeholder="Birim Fiyat">
							</div>

							<div class="col-md-4">
								<label>KDV</label>
								<select class='form-control' name='anonimKdv' id='anonimKdv'  onchange="hesapla()">
									<option>KDV Seçiniz</option>
									<option value='0'>0</option>
									<option value='1 '>1</option>
									<option value='8'>8</option>
									<option value='18'>18</option>
								</select>
							</div>
							<div class="col-md-4">
								<label>Para Birimi</label>
								<select class='form-control' name='anonimParaBirimi' id='anonimParaBirimi'>
									<option>Para Birimi Seçiniz</option>
									<option value='TL' selected>Türk Lirası</option>
									<option value='USD'>Amerikan Doları</option>
									<option value='EUR'>Euro</option>
									<option value='GBP'>İngiliz Sterlini</option>
								</select>
							</div>
						</div>

						<div class="row mt-4">
							<div class="col-md-6">
								<label>KDV Tutarı</label>
								<input type="text" name="anonimKdvHesap" class='form-control' id="anonimKdvHesap"
									   placeholder="KDV Tutarı" readonly>
							</div>
							<div class="col-md-6">
								<label>Toplam</label>
								<input type="text" name="anonimToplam" class='form-control' id="anonimToplam"
									   placeholder="Toplam" readonly>
							</div>
						</div>

						<div class="submit-section mb-4">
							<button class="btn btn-danger submit-btn">Kaydet</button>
						</div>

				</div>

				</form>
			</div>
		</div>
	</div>
</div>


</div>
<!-- /Main Wrapper -->

<?php $this->load->view("include/footer-js"); ?>
<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>


<!-- Select2 JS -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>



<?php if ($this->session->flashdata('stok_hareket_kayit')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Stok çıkışı yapıldı.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('stok_hareket_hata')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Stok hata.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('stok_hareket_duzenle')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Stok çıkışı düzenlendi.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>



<script>
	$('#stoklar').change(function () {
		$('#stokForm').submit();
	});
</script>

<script>
	$(function () {
		moment.locale('tr');
		$('#daterange').daterangepicker({
			opens: 'left',
			autoUpdateInput: false
		}, function (start, end, label) {
			$('#daterange').val(start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY'));
			//console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
		});
	});
</script>

<script>
	$(document).ready(function() {
		$("#anonimStokAdi").autocomplete({
			source: '<?= env('BASE_URL'); ?>/fatura/autocompleteDataByStockName',
			minLength: 2,
			select: function (event, ui) {
				event.preventDefault();

				$('.ui-autocomplete').modal('hide');

				$("#anonimStokID").val(ui.item.id);
				$("#anonimStokAdi").val(ui.item.value);
				$("#anonimStokKodu").val(ui.item.stok_kodu);
				$("#anonimBirimFiyat").val(ui.item.stok_satisFiyati);
				$("#anonimKdv").val(ui.item.stok_satisKDV);
				//$("#anonimMiktar").val("1");
				hesapla();
			}
		});
		$("#anonimStokKodu").autocomplete({
			source: '<?= env('BASE_URL'); ?>/fatura/autocompleteDataByStockCode',
			minLength: 2,
			select: function (event, ui) {
				event.preventDefault();
				$("#anonimStokID").val(ui.item.id);
				$("#anonimStokKodu").val(ui.item.value);
				$("#anonimStokAdi").val(ui.item.stok_ad);
				$("#anonimBirimFiyat").val(ui.item.stok_satisFiyati);
				$("#anonimKdv").val(ui.item.stok_satisKDV);
				//$("#anonimMiktar").val("1");
				hesapla();
			}
		});
	});

	function hesapla()
	{
		$('#anonimMiktar').on('input', function() {
		    document.getElementById("anonimMiktar2").value = "";

			var miktar1=document.getElementById("anonimMiktar").value;
			var birimFiyat=document.getElementById("anonimBirimFiyat").value;
			var kdv=document.getElementById("anonimKdv").value;
			var fiyat=miktar1*birimFiyat;
			var kdvTutar=fiyat*kdv/100;
			var toplam=fiyat+kdvTutar;
			$("#anonimKdvHesap").val(kdvTutar);
			$("#anonimToplam").val(toplam.toFixed(2));

		});

		$('#anonimMiktar2').on('input', function() {
		    document.getElementById("anonimMiktar").value = "";

			var miktar2=document.getElementById("anonimMiktar2").value;
			var birimFiyat2=document.getElementById("anonimBirimFiyat").value;
			var kdv2=document.getElementById("anonimKdv").value;
			var fiyat2=miktar2*birimFiyat2;
			var kdvTutar2=fiyat2*kdv2/100;
			var toplam2=fiyat2+kdvTutar2;
			$("#anonimKdvHesap").val(kdvTutar2);
			$("#anonimToplam").val(toplam2.toFixed(2));

		});

		var miktar11=document.getElementById("anonimMiktar").value;
		var miktar22=document.getElementById("anonimMiktar2").value;

		if(miktar11){

			var birimFiyat=document.getElementById("anonimBirimFiyat").value;
			var kdv=document.getElementById("anonimKdv").value;
			var fiyat=miktar11*birimFiyat;
			var kdvTutar=fiyat*kdv/100;
			var toplam=fiyat+kdvTutar;
			$("#anonimKdvHesap").val(kdvTutar);
			$("#anonimToplam").val(toplam.toFixed(2));

		}else if(miktar22){

			var birimFiyat2=document.getElementById("anonimBirimFiyat").value;
			var kdv2=document.getElementById("anonimKdv").value;
			var fiyat2=miktar22*birimFiyat2;
			var kdvTutar2=fiyat2*kdv2/100;
			var toplam2=fiyat2+kdvTutar2;
			$("#anonimKdvHesap").val(kdvTutar2);
			$("#anonimToplam").val(toplam2.toFixed(2));
		}

	}
</script>
</body>
</html>
