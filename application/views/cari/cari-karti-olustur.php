<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		/* Select2 dropdown hover rengini mor yap */
		.select2-container--default .select2-results__option--highlighted[aria-selected] {
			background-color: #5c2d91 !important;
			color: #fff !important;
		}
		.form-group {
    margin-bottom: 0.56rem !important; /* 0.75rem'in %25'i kadar daha azaltıldı */
}
	</style>
</head>
<body>
<?php

$firmaID = getirFirma();
$firma_ID = $firmaID->ayarlar_id;

$modulSorgula = modulSorgula($firma_ID, 1);
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
						<h3 class="page-title">Cari</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
							<li class="breadcrumb-item">Cari</li>
							<li class="breadcrumb-item active">Cari Kartı</li>
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
			$cariGruplariQ = "SELECT * FROM cariGruplari WHERE cariGrup_olusturanAnaHesap = '$anaHesap'";
			$cariGruplari = $this->db->query($cariGruplariQ)->result();
			?>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Temel Cari Bilgileri<span style="float:right;display:none;"
																			 id="mukellef_mark">e-Fatura Mükellefidir <i
											class="fa fa-check-circle text-success"></i></span></h4>
							<form action="<?= base_url("cari/yeniCariKartiOlustur"); ?>" method="POST" id="myForm" enctype="multipart/form-data">
								<div class="row">
									<div class="form-group col-md-12">
										<label>Cari Tipi</label>
										<select class="select" name="cari_bireysel" required="" id="cariBireysel">
											<option value="">Seçiniz...</option>
											<option value="1">Bireysel Müşteri</option>
											<option value="0" selected>Kurumsal Müşteri</option>
											<option value="2">Diğer</option>
										</select>

										<input type="hidden" name="cari_alias_pk" id="alias_pk">
									</div>
								</div>
								<div class="row" style="display: none;" id="cari_input">
									<div class="row p-3">
										<div class="col-md-4">
											<div class="form-group">
												<label>TC Kimlik Numarası / Vergi Numarası</label>
												<input type="number" class="form-control" required
													   name="cari_vergiNumarasi"
													   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
													   maxlength="11" id="vergiNumarasi" autocomplete="off"><img
														src="/assets/img/Eclipse-1s-200px.gif"
														style="position: absolute; right:15px; bottom: 113px; width:40px; display:none;"
														id="loading-image"/>
											</div>
											<div class="form-group">
												<label>Vergi Dairesi</label>
												<input type="text" class="form-control" name="cari_vergiDairesi"
													   id="vergiDairesi" autocomplete="off" required="">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>Cari Kodu</label>
												<input type="text" class="form-control" name="cari_kodu" id="cari_kodu"
													   required=""
													   autocomplete="off" required>
											</div>
											<div class="form-group">
												<label>Cari Adı</label>
												<input type="text" class="form-control" name="cari_ad" required
													   autocomplete="off" id="cariAd">
											</div>
										</div>


										<div class="col-md-4">
											<div class="form-group">
												<label>Cari Grup</label>
												<select class="select" name="cari_cariGrupKoduID" id="cariGrupKodu">
													<option value="0">Seçiniz...</option>
													<?php foreach ($cariGruplari as $cg) { ?>
														<option value="<?= $cg->cariGrup_id ?>" <?= $cg->cariGrup_id == 1 ? 'selected' : '' ?>><?= $cg->cariGrup_kodu; ?>
															(<?= $cg->cariGrup_ad; ?>)
														</option>
													<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<label>Yetkili Adı</label>
												<input type="text" class="form-control" name="yetki_adi" id="yetkiAdi">
											</div>
										</div>
									</div>
								</div>

								<!--
										<hr class="mt-4">
										<div class="row">
											<div class="col-md-4>

												<input type="hidden" name="cari_alias_pk" id="alias_pk">

												<div class="form-group">
													<label>Cari Adı</label>
													<input type="text" class="form-control" name="cari_ad" required="" autocomplete="off" id="cariAd">
												</div>

												 <div class="form-group" id="c_vkn">
													<label>Vergi Numarası</label>
													<input type="number" class="form-control" name="cari_vergiNumarasi"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" id="vergiNumarasi" disabled autocomplete="off"><img src="/assets/img/Eclipse-1s-200px.gif" style="position: absolute; right:15px; bottom:20px; width:40px; display:none;" id="loading-image"/>
												</div>


												<div class="form-group" style="display:none;" id="c_soyad">
													<label>Cari Soyadı</label>
													<input type="text" class="form-control" name="cari_soyad" id="cariSoyad" autocomplete="off">
												</div>

											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Cari Kodu</label>
													<input type="text" class="form-control" name="cari_kodu" required="" autocomplete="off">
												</div>
												<div class="form-group" id="c_vd">
													<label>Vergi Dairesi</label>
													<input type="text" class="form-control" name="cari_vergiDairesi" id="vergiDairesi" disabled autocomplete="off">
												</div>
												<div class="form-group" style="display:none;" id="c_tckn">
													<label>TC Kimlik Numarası</label>
													<input type="number" class="form-control" name="cari_tckn" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" id="tckn" autocomplete="off">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Cari Tipi</label>
													<select class="select" name="cari_bireysel" required="" id="cariBireysel">
														<option value="">Seçiniz...</option>
															<option value="1">Bireysel Müşteri</option>
															<option value="0">Kurumsal Müşteri</option>
															<option value="2">Diğer</option>
													</select>
												</div>

												<div class="form-group">
													<label>Cari Grup</label>
													<select class="select" name="cari_cariGrupKoduID" id="cariGrupKodu">
														<option value="">Seçiniz...</option>
														<?php foreach ($cariGruplari as $cg) { ?>
															<option value="<?= $cg->cariGrup_id ?>"><?= $cg->cariGrup_kodu; ?> (<?= $cg->cariGrup_ad; ?>)</option>
														<?php } ?>
													</select>
												</div>

												!-- <div class="form-group">
													<label>TC Kimlik Numarası</label>
													<input type="number" class="form-control" name="cari_tckn" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" id="tckn" disabled>
												</div>--

											</div>

										</div>
-->
								<h4 class="card-title mt-4">Cari İletişim Bilgileri</h4>
								<div class="row">
									<div class="col-md-6">

										<?php
										if ($_iller != false):
											echo '<div class="form-group">
												<label>İl</label>
												<select id="il" name="cari_il" data-plugin-selectTwo class="select ajaxIller" required>
												<option value="">Seçiniz</option>';
											foreach ($_iller as $item) {
												echo '<option value="' . $item->id . '">' . $item->il . '</option>';
											}
											echo '</select></div>';
										else:
											echo 'Kayıtlı İl Bulunamadı..!';
										endif;
										?>


										<div class="form-group">
											<label>Instagram Hesabı</label>
											<input type="text" class="form-control" name="cari_websitesi"
												   autocomplete="off">
										</div>

										<div class="form-group">
											<label>Firma e-Posta</label>
											<input type="email" class="form-control" name="cari_firmaEPosta"
												   autocomplete="off" <?php if($modulSorgula) echo "required";?> id="cari_eposta">
										</div>

										<div class="form-group">
											<label>Firma Telefon</label>
											<input type="text" class="form-control" name="cari_firmaTelefon"
												   autocomplete="off"
												   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
												   maxlength="10"  <?php if($modulSorgula) echo "required";?>>
										</div>
										<!-- Fotoğraflar Yükleme Alanı -->
										<div class="form-group">
											<label>İşletmeye ait en az 3 fotoğraf yükleyiniz</label>
											<input type="file" class="form-control" name="cari_fotograflar[]" multiple accept="image/*">
										</div>
										<!-- /Fotoğraflar Yükleme Alanı -->
									</div>
									<div class="col-md-6">
										<div class="ilceler">
											<div class="form-group">
												<label>İlçe</label>
												<select id="ilce" name="cari_ilce" class="select" required>
													<option value="">İl Seçiniz</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label>Adres</label>
											<textarea rows="9" cols="5" class="form-control"
													  placeholder="Adres bilgisi giriniz..."
													  name="cari_adres"></textarea>
										</div>
										<!-- Dosya Yükleme Alanı -->
										<div class="form-group">
											<label>Vergi levhası, imza sirküsü, kimlik fotokopisi yükleyiniz</label>
											<input type="file" class="form-control" name="cari_dosya[]" multiple accept="*/*">
										</div>
										<!-- /Dosya Yükleme Alanı -->
									</div>
								</div>
								<button type="submit" class="btn btn-danger" style="width:100%;" id="kydtBTN">Kaydet
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->


<?php if ($this->session->flashdata('cari_kodu_mevcut')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Eklemeye çalıştığınız cari kodu mevcut, lütfen farklı bir cari kodu ile tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_kodu_3_karakter')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
		 type: "error",
			text: "Cari kodu en az 3 karakter olmalıdır. Tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_kodu_vergino')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Aynı vergi numarasına ait cari kayıt edilemez. Tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_kodu_vkn_karakter')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "VKN 10 haneli olmalıdır. Tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>
<?php if ($this->session->flashdata('cari_kodu_tckn_karakter')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "TCKN 11 haneli olmalıdır. Tekrar deneyiniz.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>





<?php $this->load->view("include/footer-js"); ?>

<script>
	$(document).ready(function () {
		$('.ajaxIller').on('change', function (e) {
			var base_url = "<?php echo base_url();?>";
			var il_id = $(this).val();
			$.post(base_url + 'home/get_ilceler', {il_id: il_id}, function (result) {
				if (result && result.status != 'error') {
					var ilceler = result.data;
					var select = '<div class="ilceler"><div class="form-group"><label>İlçe</label><select id="ilce" name="cari_ilce" class="form-control select" required>';
					for (var i = 0; i < ilceler.length; i++) {
						select += '<option value="' + ilceler[i].id + '">' + ilceler[i].ilce + '</option>';
					}
					select += '</select></div></div>';
					$('div.ilceler').empty().html(select);
				} else {
			alert('Hata : ' + result.message);
		}
	});
	});
	});
</script>

<script>
	$("#cariBireysel").on('change', function () {
		var status = $("#cariBireysel option:selected").text();

		$("#cari_input").css("display", "block");
		$("#c_soyad").css("display", "none");

		if (status == "Bireysel Müşteri") {

			$("#vergiDairesi").prop('required', false);
			$("#cariSoyad").prop('required', false);
			$("#vergiNumarasi").prop('readonly', false);

			$("#vergiDairesi").val("");
			$("#vergiNumarasi").val("");
			$("#alias_pk").val("");
			$("#cari_kodu").val("");
			$("#cariAd").val("");

		} else if (status == "Kurumsal Müşteri") {

			$("#vergiDairesi").prop('required', false);

			$("#vergiNumarasi").prop('readonly', false);
			$("#vergiDairesi").val("");
			$("#vergiNumarasi").val("");
			$("#alias_pk").val("");
			$("#cari_kodu").val("");
			$("#cariAd").val("");

		} else if (status == "Diğer") {

			$("#vergiDairesi").prop('required', false);

			$("#vergiNumarasi").prop('readonly', true);
			$("#vergiDairesi").val("");
			$("#vergiNumarasi").val("11111111111");
			$("#alias_pk").val("");
			$("#cari_kodu").val("");
			$("#cariAd").val("");

		}
	});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": false,
		"progressBar": true,
		"positionClass": "toast-top-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};
	/*$("#vergiNumarasi").on('blur', function () {
		let str = $("#vergiNumarasi").val();
		if (str.length == 11) {
			$("#c_soyad").css("display", "block");
			$("#cariSoyad").prop('required', true);
			$("#vergiDairesi").prop('required', false);
		} else {

			$("#vergiDairesi").prop('required', true);
			$("#c_soyad").css("display", "none");
			$("#cariSoyad").prop('required', false);
		}

		if (str.length == 10 || str.length == 11) {
			$.ajax({
				url: "<?= env('BASE_URL'); ?>/Edonusum/Auth/CheckUser",
				method: "POST",
				data: {vergiNumarasi: str},
				dataType: 'json',
				beforeSend: function () {
					$("#loading-image").show();
					$(':input[type="submit"]').prop('disabled', true);
				},
				success: function (result) {
					console.log(result);
					let alias = result.alias;
					//let identifier = result.identifier;
					let title = result.title;
					if (alias != null) {
						if(str.length == 11)
						{
							$("#c_soyad").css("display", "block");
							var titleSplit=title.trim().split(' ');
							$("#cariSoyad").val(titleSplit[titleSplit.length-1]);
							var ad="";
							for(var i=0;i<titleSplit.length-1;i++)
							{
								ad+=titleSplit[i]+ " ";
							}
							$("#cariAd").val(ad.trim());
							$('#cariSoyad').prop('disabled', true);
						}
						else
							$("#cariAd").val(title);
						$("#alias_pk").val(alias);
						$("#mukellef_mark").css("display", "block");
						$('#cariAd').prop('disabled', true);

					} else {
						$("#cariAd").val("");
						$("#alias_pk").val("");
						//$('#myForm').trigger("reset");
						$("#mukellef_mark").css("display", "none");
						$('#cariAd').prop('disabled', false);
					}
					$(':input[type="submit"]').prop('disabled', false);
					$("#loading-image").hide();
				}
			});
		}

	});*/


	$("#vergiNumarasi").on('blur', function () {

		let str = $("#vergiNumarasi").val();

		$("#cariSoyad").val("");
		$("#cariAd").val("")
		if (str.length == 11) {
			$("#c_soyad").css("display", "block");
			$("#cariSoyad").prop('required', true);
			$("#vergiDairesi").prop('required', false);
		} else {

			$("#vergiDairesi").prop('required', true);
			$("#c_soyad").css("display", "none");
			$("#cariSoyad").prop('required', false);
		}

		if (str.length == 10 || str.length == 11) {
			$.ajax({
				url: "<?= env('BASE_URL'); ?>/Cari/gibVknTcknSorgula",
				method: "POST",
				data: {vergiNumarasi: str},
				dataType: 'json',
				beforeSend: function () {
					$("#loading-image").show();
					$(':input[type="submit"]').prop('disabled', true);
				},
				success: function (result) {
;
					if (str.length == 11) {
						let ad = result.ad;
						let soyad = result.soyad;
						$("#c_soyad").css("display", "block");
						$("#cariAd").val(ad);
						$("#cariSoyad").val(soyad);
					} else {
						$("#c_soyad").css("display", "none");
						$("#cariAd").val(result.unvan);
					}

					$(':input[type="submit"]').prop('disabled', false);
					$("#loading-image").hide();
				}
			});

			<?php if($modulSorgula) { ?>
			$.ajax({
				url: "<?= env('BASE_URL'); ?>/Edonusum/Auth/CheckUser",
				method: "POST",
				data: {vergiNumarasi: str},
				dataType: 'json',
				beforeSend: function () {
					$("#loading-image").show();
					$(':input[type="submit"]').prop('disabled', true);
				},
				success: function (result) {
					let alias = result.alias;
					if (alias != null) {
						$("#alias_pk").val(alias);
						$("#mukellef_mark").css("display", "block");

					} else {
						$("#alias_pk").val("");
						$("#mukellef_mark").css("display", "none");
					}
					$(':input[type="submit"]').prop('disabled', false);
					$("#loading-image").hide();
				}
			});
			<?php } ?>



		}
	});


	$("#cari_eposta").on('blur', function () {
		var eposta= $("#cari_eposta").val();
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(!regex.test(eposta)) {
			toastr.warning("Geçerli bir e-posta giriniz.");
			if(document.getElementById("cari_eposta").required == true)
				$("#kydtBTN").prop("disabled", true);
		}
		else {
			$("#kydtBTN").prop('disabled', false);
		}
	});
</script>

<script type="text/javascript">
	$(document).ready(function () {
		$("#il").select2({
			width: '100%'
		});
		$("#cariGrupKodu").select2({
			width: '100%'
		});


		$("form").submit(function () {
			$(this).submit(function () {
				return false;
			});
			return true;
		});
	});
</script>

<script>
$(document).ready(function () {
	// Varsayılan olarak Kurumsal Müşteri seçili gelsin ve alanlar açık olsun
	$('#cariBireysel').val('0').trigger('change');
	$('#cari_input').show();
});
</script>

</body>
</html>
