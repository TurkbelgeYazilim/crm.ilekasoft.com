<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title><?= $baslik; ?> - ilekaSoft CRM - Muhasebe Programı</title>

	<link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicon.png">

	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">

	<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome/css/all.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.min.css" integrity="sha512-hpo7VUEeZfF+7lnGhAOa+8AmtBMb+VgBX8Ou4mdnN6UvMK3sVLTvTu1Yvd9ChdubSu6Dnf2UGZpe9svVIsg+hg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
</head>
<body>

<div class="main-wrapper login-body">
	<div class="login-wrapper">
		<div class="container">
			<img class="img-fluid logo-dark mb-2" src="<?= base_url(); ?>assets/img/logo.png" alt="Logo">
			<div class="loginbox">
				<div class="login-right">
					<div class="login-right-wrap">
						<h1>Ücretsiz Kayıt Ol!</h1>
						<p class="account-subtitle" style="font-size:10pt!important;">Hesabınızı ücretsiz oluşturun, 14 gün deneme süresi boyunca kullanın. <u>Üstelik kredi kartı gerektirmez!</u></p>

						<form action="<?= base_url("kayit/onay"); ?>" method="post">
							<div class="form-group">
								<input class="form-control" type="email" name="eposta" placeholder="E-Posta adresinizi giriniz" autocomplete="off" required>
								<span style="font-size:8pt!important;">Doğrulama kodu gönderilecektir, <u>lütfen aktif kullandığınız mail adresinizi giriniz.</u></span>
							</div>
							<div class="form-group mb-0">
								<button class="btn btn-lg btn-block btn-primary w-100" type="submit">Devam Et</button>
							</div>
						</form>

						<div class="text-center dont-have"> <a href="https://ilekasoft.com" style="text-decoration: underline;">ilekaSoft.com</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if ($this->session->flashdata('eposta_no')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Bir hata oluştur, tekrar deneyiniz.",
			confirmButtonText:'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('emailvar')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "E-Posta adresi sistemde mevcut, tekrar deneyiniz.",
			confirmButtonText:'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<script src="<?= base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>

<script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url(); ?>assets/js/feather.min.js"></script>

<script src="<?= base_url(); ?>assets/js/script.js"></script>
</body>
</html>
