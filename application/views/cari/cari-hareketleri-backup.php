<!DOCTYPE html>

<html lang="tr">

<head>

	<?php $this->load->view("include/head-tags"); ?>

	<style>

		/* Mobilde Önceki Sayfa butonunu gizle */

		@media (max-width: 767.98px) {

			.col-sm-2 {

				display: none !important;

			}

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



			<?php

			$anaHesap = anaHesapBilgisi();



			$hareketTuru = $this->input->get('hareketTuru');

			$belgeNo = $this->input->get('belgeNo');



			$getCari = $this->input->get('cari');



			$tarihAraligi = $this->input->get('tarihAraligi');



			$siralama = $this->input->get('siralama');			$cariQ = "SELECT * FROM cari WHERE cari_id = '$getCari'";

			$cariExe = $this->db->query($cariQ)->row();



			if ($_SERVER['QUERY_STRING']) {

				$qs = "?" . $_SERVER['QUERY_STRING'];

			}

			?>

			<!-- Page Header -->

			<div class="page-header">

				<div class="row">

					<div class="col-sm-10">

						<h3 class="page-title">Cari</h3>

						<ul class="breadcrumb">

							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>

							</li>

							<li class="breadcrumb-item">Cari

							</li>

							<li class="breadcrumb-item">Cari Hareketleri

							</li>

							<?php if ($cariExe) { ?>

								<li class="breadcrumb-item active"><?= $cariExe->cari_ad; ?></li>

							<?php } ?>

						</ul>

					</div>

					<div class="d-flex justify-content-end text-align-center col-sm-2">

						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i>

							<br>Önceki Sayfa</a>

					</div>

				</div>

			</div>

			<!-- /Page Header -->



			<?php if (!isset($getCari)) { ?>

				<section class="comp-section">

					<div class="card bg-white">

						<div class="card-body">



							<?php

							$anaHesap = anaHesapBilgisi();

							$sql = "select * from cari where cari_olusturanAnaHesap='$anaHesap'";

							$cariler = $this->db->query($sql)->result();



							?>



							<form action="<?= base_url("cari/cari-hareketleri"); ?>" method="GET" id="cariForm">

								<input type="hidden" name="cari" id="cari_id">

								<input type="text" class="form-control" name="cari_sec" id="cari_sec"

									   placeholder="Cari hareketlerini görmek için cari adını yazın.">

							</form>





						</div>

					</div>

				</section>

				<!-- /Alerts -->

			<?php } else { ?>

				<div class="row">



					<div class="col-xl-12 col-md-12">

						<div class="card card-table">

							<div class="card-header">

								<div class="row">

									<div class="col">

										<h5 class="card-title"><a

													href="<?= base_url("cari/cari-karti-duzenle/$cariExe->cari_id"); ?>"

													target="_blank"

													style="color:#d92637; text-decoration: underline;"><?= $cariExe->cari_ad; ?></a>

											- Cari Hareketleri</h5>

									</div>

									<div class="col-auto">

										<?php

										$kalann = abs($kalan);

										if (filter_var($kalan, FILTER_VALIDATE_FLOAT) && $kalan > 0) { ?>

											<a href="javascript:void(0);"

											   class="btn btn-outline-success btn-sm"><?= number_format($kalann, 2); ?>

												(B)</a>

										<?php } else { ?>

											<a href="javascript:void(0);"

											   class="btn btn-outline-danger btn-sm"><?= number_format($kalann, 2); ?>

												(A)</a>

										<?php } ?>

									</div>

									<?php if (isset($tarihAraligi)) { ?>

										<div class="col-auto">

											<a href="<?= base_url("cari/cari-hareketleri?cari=$getCari"); ?>"

											   class="btn btn-outline-primary btn-sm"><i class="fa fa-times-circle"></i>

												Filtrelemeyi Kaldır</a>

										</div>

									<?php } ?>

									<div class="col-auto">

										<a href="<?= base_url("cari/cariHareketleriExcel$qs"); ?>"

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

											<th>Tarih</a></th>

											<th>Belge Numarası</th>

											<th>Türü</th>

											<th>Borç</th>

											<th>Alacak</th>

											<th class="text-right">İşlem</th>

										</tr>

										</thead>

										<tbody>



										<?php foreach ($cariHareketleri as $ch) { ?>



											<?php

											$turu = $ch->ch_turu;

											if ($turu == 1) {

												$turuTxt = '<span class="badge bg-success-light">Alış Faturası</span>';

											} else if ($turu == 2) {

												$turuTxt = '<span class="badge bg-danger-light">Satış Faturası</span>';

											} else if ($turu == 3) {

												$turuTxt = '<span class="badge bg-primary-light">Banka Havalesi</span>';

											} else if ($turu == 4) {

												$turuTxt = '<span class="badge bg-info-light">Banka EFT</span>';

											} else if ($turu == 5) {

												$turuTxt = '<span class="badge bg-warning-light">Kasa Tahsilat</span>';

											} else if ($turu == 6) {

												$turuTxt = '<span class="badge bg-info-light">Kasa Ödeme</span>';

											} else if ($turu == 7) {

												$turuTxt = '<span class="badge bg-info text-light">Cari Dekont</span>';

											} else if ($turu == 8) {

												$turuTxt = '<span class="badge bg-info text-light">Alınan Çek</span>';

											} else if ($turu == 9) {

												$turuTxt = '<span class="badge bg-info text-light">Verilen Çek</span>';

											} else if ($turu == 10) {

												$turuTxt = '<span class="badge bg-info text-light">Alınan Senet</span>';

											} else if ($turu == 11) {

												$turuTxt = '<span class="badge bg-info text-light">Verilen Senet</span>';

											} else if ($turu == 12) {

												$turuTxt = '<span class="badge bg-info text-light">E-Fatura</span>';

											} else if ($turu == 13) {

												$turuTxt = '<span class="badge bg-info text-light">E-Arşiv</span>';

											} else if ($turu == 14) {

												$turuTxt = '<span class="badge bg-info text-light">Devir</span>';

											} else if ($turu == 15) {

												$turuTxt = '<span class="badge bg-info text-light">Evrak</span>';

											} else if ($turu == 16) {

												$turuTxt = '<span class="badge bg-info text-light">Fatura</span>';

											} else if ($turu == 17) {

												$turuTxt = '<span class="badge bg-info text-light">Fatura Kapalı</span>';

											} else if ($turu == 18) {

												$turuTxt = '<span class="badge bg-info text-light">İade</span>';

											} else if ($turu == 19) {

												$turuTxt = '<span class="badge bg-info text-light">İrsaliye</span>';

											} else if ($turu == 20) {

												$turuTxt = '<span class="badge bg-info text-light">Kasa</span>';

											} else if ($turu == 21) {

												$turuTxt = '<span class="badge bg-info text-light">Kredi Kartı</span>';

											} else if ($turu == 22) {

												$turuTxt = '<span class="badge bg-info text-light">Müşteri Çeki</span>';

											} else if ($turu == 23) {

												$turuTxt = '<span class="badge bg-info text-light">Pos</span>';

											} else if ($turu == 24) {

												$turuTxt = '<span class="badge bg-info text-light">Servis Fişi</span>';

											} else if ($turu == 25) {

												$turuTxt = '<span class="badge bg-info text-light">Servis Fişi Kapalı</span>';

											} else if ($turu == 26) {

												$turuTxt = '<span class="badge bg-info text-light">Banka</span>';

											} else{

												$turuTxt = '<span class="badge bg-dark text-light">Bulunamadı/Diğer</span>';

											}



											if ($ch->ch_borc) {

												$borc = '<span class="badge bg-success-light">' . number_format($ch->ch_borc, 2) . " " . $ch->ch_paraBirimi . ' </span>';

												$alacak = '';

											}



											if ($ch->ch_borcDoviz) {

												$borc = '<span class="badge bg-success-light">' . number_format($ch->ch_borcDoviz, 2) . " " . $ch->ch_paraBirimi . ' </span>';

												$alacak = '';

											}

											if ($ch->ch_alacak) {

												$borc = '';

												$alacak = '<span class="badge bg-danger-light">' . number_format($ch->ch_alacak, 2) . " " . $ch->ch_paraBirimi . ' </span>';

											}

											if ($ch->ch_alacakDoviz) {

												$borc = '';

												$alacak = '<span class="badge bg-danger-light">' . number_format($ch->ch_alacakDoviz, 2) . " " . $ch->ch_paraBirimi . ' </span>';

											}



											?>



											<tr>

												<td><?= date('d.m.Y', strtotime($ch->ch_tarih)); ?></td>

												<td><?= $ch->ch_belgeNumarasi; ?></td>

												<td><?= $turuTxt; ?></td>

												<td><?= $borc; ?></td>

												<td><?= $alacak; ?></td>

												<td class="text-right">

													<?php if ($ch->ch_faturaID == -1) { ?>

														<a href="<?= base_url("Edonusum/Efatura/GetInvoiceWithType/$ch->ch_belgeNumarasi/1/efaturaGelen/IN/1") ?>"

														   class='btn btn-sm btn-white text-info mr-2'

														   target='_blank'><i class='far fa-eye mr-1'></i>Göster</a>

													<?php } else {

														// Her düzenle butonu için yetki kontrolü eklendi
														if ($turu == 1) {//alış faturası düzenle
															?>
															<a href="<?= base_url("fatura/alis-faturasi/$ch->ch_faturaID"); ?>"

															   class="btn btn-sm btn-white text-success mr-2"

															   target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>

														<?php } else if ($turu == 2) {//satış faturası düzenle ?>

															<a href="<?= base_url("fatura/satis-faturasi/$ch->ch_faturaID"); ?>"

															   class="btn btn-sm btn-white text-success mr-2"

															   target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>

														<?php } else if ($turu == 3) {//banka havalesi düzenle ?>

															<a href="<?= base_url("banka/banka-havale-duzenle/$ch->ch_bhID"); ?>"

															   class="btn btn-sm btn-white text-success mr-2"

															   target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>

														<?php } else if ($turu == 4) {//banka eft düzenle ?>

															<a href="<?= base_url("banka/banka-eft-duzenle/$ch->ch_bhID"); ?>"

															   class="btn btn-sm btn-white text-success mr-2"

															   target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>

														<?php } else if ($turu == 5) {//kasa tahsilat düzenle ?>

															<a href="<?= base_url("kasa/kasa-tahsilat-duzenle/$ch->ch_khID"); ?>"

															   class="btn btn-sm btn-white text-success mr-2"

															   target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>

														<?php } else if ($turu == 6) {//kasa ödeme düzenle ?>

															<a href="<?= base_url("kasa/kasa-odeme-islemi-duzenle/$ch->ch_khID"); ?>"

															   class="btn btn-sm btn-white text-success mr-2"

															   target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>

														<?php } else if ($turu == 7) {//cari dekont düzenle?>

															<a href="<?= base_url("cari/cari-dekont-duzenle/$ch->ch_id"); ?>"

															   class="btn btn-sm btn-white text-success mr-2"

															   target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>

														<?php } else if ($turu == 8 || $turu == 9) { ?>

															<a href="<?= base_url("cek/cekDuzenle/$ch->ch_cekID"); ?>"

															   class="btn btn-sm btn-white text-success mr-2"

															   target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>

														<?php } else if ($turu == 10 || $turu == 11) { ?>

															<a href="<?= base_url("senet/senetDuzenle/$ch->ch_senetID"); ?>"

															   class="btn btn-sm btn-white text-success mr-2"

															   target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>

														<?php } else if ($turu == 12) {//e-fatura düzenle?>

															<a href="<?= base_url("fatura/efatura-olustur/$ch->ch_faturaID"); ?>"

															   class="btn btn-sm btn-white text-success mr-2"

															   target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>

														<?php } else if ($turu == 13) { ?>

															<a href="<?= base_url("fatura/earsiv-olustur/$ch->ch_faturaID"); ?>"

															   class="btn btn-sm btn-white text-success mr-2"

															   target="_blank"><i class="far fa-edit mr-1"></i> Düzenle</a>

														<?php }

													} ?>

												</td>

											</tr>

										<?php } ?>

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

			<?php } ?>

		</div>

	</div>

	<!-- /Page Wrapper -->



	<!-- Add Category Modal -->

	<div id="add_category" class="modal custom-modal fade" role="dialog">

		<div class="modal-dialog modal-dialog-centered" role="document">

			<div class="modal-content">

				<div class="modal-header">

					<h5 class="modal-title">Cari Hareket Arama</h5>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">

						<span aria-hidden="true">&times;</span>

					</button>

				</div>

				<div class="modal-body">

					<form action="<?= base_url("cari/cari-hareketleri"); ?>" method="GET">

						<?php

						if (isset($getCari)) { ?>

							<input type="hidden" name="cari" value="<?= $getCari; ?>">

						<?php } ?>



						<div class="form-group">

							<label>Kayıt Tarihi Aralığına Göre </label>

							<input class="form-control" id="daterange" type="text" name="tarihAraligi"

								   value="<?= $tarihAraligi; ?>" autocomplete="off"/>

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



</div>

<!-- /Main Wrapper -->



<script>

	$(function () {

		$('[data-toggle="tooltip"]').tooltip()

	})

</script>



<?php if ($this->session->flashdata('cari_dekont_ok')): ?>

	<script>

		swal({

			title: "Bilgilendirme",

			type: "success",

			text: "Cari dekont başarılı bir şekilde oluşturuldu.",

			confirmButtonText: 'Tamam',

			button: false,

			timer: 5000,

		});

	</script>

<?php endif; ?>



<?php if ($this->session->flashdata('cari_dekont_updt_ok')): ?>

	<script>

		swal({

			title: "Bilgilendirme",

			type: "success",

			text: "Cari dekont başarılı bir şekilde güncellendi.",

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

	$("#cari_sec").autocomplete({

		source: '<?= env('BASE_URL'); ?>/cari/autocompleteDataByCariName',

		minLength: 2,

		select: function (event, ui) {

			event.preventDefault();



			$('.ui-autocomplete').modal('hide');

			$("#cari_id").val(ui.item.id);



			$('#cariForm').submit();

		}

	});



</script>



</body>

</html>

