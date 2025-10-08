<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $baslik; ?> - ilekaSoft CRM - Muhasebe Programı</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="colorlib.com">

	<!-- MATERIAL DESIGN ICONIC FONT -->
	<link rel="stylesheet" href="<?php echo base_url("assets/colorlib-wizard-1");  ?>/fonts/material-design-iconic-font/css/material-design-iconic-font.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.min.css" integrity="sha512-hpo7VUEeZfF+7lnGhAOa+8AmtBMb+VgBX8Ou4mdnN6UvMK3sVLTvTu1Yvd9ChdubSu6Dnf2UGZpe9svVIsg+hg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- STYLE CSS -->
	<link rel="stylesheet" href="<?php echo base_url("assets/colorlib-wizard-1");  ?>/css/style.css">

	<style>
		/* Chrome, Safari, Edge, Opera */
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		/* Firefox */
		input[type=number] {
			-moz-appearance: textfield;
		}
	</style>
</head>
<body>
<div class="wrapper">
	<form method="post">
		<h2></h2>
		<section>

			<div class="inner">
				<div class="image-holder">
					<img src="<?php echo base_url("assets/colorlib-wizard-1");  ?>/images/form-wizard-1.png" alt="">
				</div>
				<div class="form-content">
					<div class="form-header">
						<h3 style="border:0px!important;"></h3>
					</div>
					<div id="firt_step">
					<p>E-Posta adresinize gelen doğrulama kodunu giriniz</p>
						<div class="form-row">
							<div class="form-holder" style="width:100%!important;">
								<input type="number" placeholder="Doğrulama kodu" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="6" id="otpConfirmation" required>
							</div>
						</div>
					</div>

					<div id="second_step" style="display:none;">
						<p>Bilgilerinizi eksiksiz girerek kayıt işlemini tamamlayın.</p>
						<div class="form-row">
							<div class="form-holder">
								<input type="text" placeholder="Firma Adı *" name="firma_adi" class="form-control myClass" required autocomplete="off" id="firmaadi">
							</div>
							<div class="form-holder">
								<input type="text" placeholder="Firma Telefon *" name="firma_telefon" class="form-control myClass" required autocomplete="off" id="firmatel">
							</div>
						</div>

						<div class="form-row">
							<div class="form-holder">
								<input type="text" placeholder="Firma E-Posta *" name="firma_eposta" class="form-control myClass" required autocomplete="off" id="firmaeposta">
							</div>
							<div class="form-holder">
								<input type="text" placeholder="Firma Adres *" name="firma_adres" class="form-control myClass" required autocomplete="off" id="firmaadres">
							</div>
						</div>

						<div class="form-row">
							<div class="form-holder">
								<input type="text" placeholder="VKN/TCKN *" name="vkntckn" class="form-control myClass" required autocomplete="off" id="vkntckn">
							</div>
							<div class="form-holder">
								<input type="text" placeholder="Vergi Dairesi" name="vergidairesi" class="form-control myClass" autocomplete="off" id="vd">
							</div>
						</div>

						<div class="form-row">
							<?php
								if ($_iller != false):
									echo '
									<div class="form-holder">
									<select id="il" name="il" class="form-control myClass ajaxIller" required>
									<option value="">Seçiniz</option>';
									foreach ($_iller as $item) {
										echo '<option value="' . $item->id . '">' . $item->il . '</option>';
									}
									echo '</select></div>';
								else:
									echo 'Kayıtlı İl Bulunamadı..!';
								endif;
							?>

							<div class="ilceler">
								<div class="form-holder" style="width:100%;">
									<select id="ilce" name="ilce" class="form-control myClass" required>
										<option value="">İl Seçiniz... </option>
									</select>
								</div>
							</div>

						</div>

						<div class="form-row">
							<div class="form-holder">
								<input type="text" placeholder="Yetkili Ad *" name="yetkili_ad" class="form-control myClass" required autocomplete="off" id="yetkiliad">
							</div>
							<div class="form-holder">
								<input type="text" placeholder="Yetkili Soyad *" name="yetkili_soyad" class="form-control myClass" required autocomplete="off" id="yetkilisoyad">
							</div>
							<div class="form-holder">
								<input type="text" placeholder="Yetkili E-Posta *" name="yetkilieposta" class="form-control" required autocomplete="off" value="<?= $eposta; ?>" readonly>
							</div>
						</div>

					</div>


					<div id="finale" style="display:none;">
						<p>Ücretsiz kayıt işleminiz başarılı bir şekilde gerçekleştirildi. <br><br> Sisteme giriş bilgileriniz kayıtlı e-Posta adresinize gönderilmiştir. <br><br> 14 gün ücretsiz kullanmaya hemen başlayın.</p>
					</div>

					<img src="<?php echo base_url("assets/colorlib-wizard-1");  ?>/images/30.gif" alt="" style="display:none;" id="loading-image">
				</div>

				<div class="actions clearfix">
					<ul role="menu" aria-label="Pagination">
						<li class="" aria-disabled="false">
							<a href="javascript:void(0);" role="menuitem" id="onay" style="background: #e30a17!important;">Onayla</a>

							<a href="javascript:void(0);" role="menuitem" id="tamamla" style="background: #e30a17!important;display:none;">Tamamla</a>

							<a href="<?= base_url(); ?>" role="menuitem" id="sistemegiris" style="background: #e30a17!important;display:none;">Sisteme Giriş</a>
						</li>
					</ul>
				</div>


			</div>
		</section>
	</form>
</div>

<!-- JQUERY -->
<script src="<?php echo base_url("assets/colorlib-wizard-1");  ?>/js/jquery-3.3.1.min.js"></script>

<script>
	$(document).ready(function(){
		$('.ajaxIller').on('change', function(e){
			var base_url = "<?php echo base_url();?>";
			var il_id = $(this).val();
			$.post(base_url+'kayit/get_ilceler', {il_id : il_id}, function(result){
				if ( result && result.status != 'error' )
				{
					var ilceler = result.data;
					var select = '<div class="ilceler"><div class="holder"><select id="ilce" name="ilce" class="form-control myClass" required>';
					for( var i = 0; i < ilceler.length; i++)
					{
						select += '<option value="'+ ilceler[i].id +'">'+ ilceler[i].ilce +'</option>';
					}
					select += '</select></div></div>';
					$('div.ilceler').empty().html(select);
				}
				else{
					alert('Hata : ' + result.message );
				}
			});
		});
	});

	$("#onay").click(function(e) {
		let otpConfirmation = $("#otpConfirmation").val();
		let otpLength = otpConfirmation.length;

		if(otpLength == 6){
			$.ajax({
				url: "<?= env('BASE_URL'); ?>/Kayit/CheckOTP",
				method: "POST",
				data: {otpConfirmation: otpConfirmation},
				dataType: 'json',
				beforeSend: function () {
					$("#loading-image").show();
				},
				success: function (res) {
					$("#loading-image").hide();

					if(res == 11){
						$("#firt_step").hide();
						$("#second_step").show();
						$("#tamamla").show();
						$("#onay").hide();
					}else if(res == 22) {
						swal({title: "Bilgilendirme",type: "error",text: "Doğrulama kodu eşleşmedi, lütfen tekrar deneyiniz...",confirmButtonText:'Tamam',button: false,timer: 5000});
					}else if(res == 2){
						swal({title: "Bilgilendirme",type: "error",text: "6 haneli doğrulama kodunu eksiksiz giriniz...",confirmButtonText:'Tamam',button: false,timer: 5000});
					}
				}
			});
		}else{
			swal({title: "Bilgilendirme",type: "error",text: "6 haneli doğrulama kodunu eksiksiz giriniz.",confirmButtonText:'Tamam',button: false,timer: 5000,
			});
		}
	});

	$("#tamamla").click(function(e) {

		let firmaadi = $('#firmaadi').val();
		let firmatel = $('#firmatel').val();
		let firmaeposta = $('#firmaeposta').val();
		let firmaadres = $('#firmaadres').val();
		let vkntckn = $('#vkntckn').val();
		let yetkiliad = $('#yetkiliad').val();
		let yetkilisoyad = $('#yetkilisoyad').val();

		if(firmaadi != '' && firmatel != '' && firmaeposta != '' && firmaadres != '' && vkntckn != '' && yetkiliad != '' && yetkilisoyad != ''){
			$.ajax({
				url: "<?= env('BASE_URL'); ?>/Kayit/complete",
				method: "POST",
				data: $('form').serialize(),
				dataType: 'json',
				beforeSend: function () {
					$("#loading-image").show();
				},
				success: function (res) {
					$("#loading-image").hide();
					if (res == 1) {
						swal({title: "Bilgilendirme",type: "error",text: "Bu e-Posta adresi zaten kullanılıyor.",confirmButtonText: 'Tamam',timer: 5000});
					} else if (res == 2) {
						$("#finale").show();
						$("#second_step").hide();
						$("#tamamla").hide();
						$("#sistemegiris").show();
					}
				}
			});
		}else{
			swal({title: "Bilgilendirme",type: "error",text: "Gerekli alanları doldurunuz.",confirmButtonText: 'Tamam',timer: 5000});
		}


			/* $('.myClass').each(function(i,el){
				let data = $(el).val();
				let len = data.length;
				if(len<1){
					swal({title: "Bilgilendirme",type: "error",text: "Formu tamamen doldurunuz.",confirmButtonText:'Tamam', timer: 5000});
				}
			}); */
		});



</script>

</body>
</html>
