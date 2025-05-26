<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>ilekaSoft CRM - Giriş Ekranı</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicon.png">

	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome/css/all.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">

	<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
	<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />

	<!--[if lt IE 9]>
	<script src="<?= base_url(); ?>assets/js/html5shiv.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/respond.min.js"></script>
	<![endif]-->
	<style>
		/* * * * * General CSS * * * * */
		*,
		*::before,
		*::after {
			box-sizing: border-box;
		}
		.background-image {
			position: fixed;
			left: 0;
			right: 0;

			display: block;
			background-image: url("<?= base_url(); ?>assets/img/BG-IMAGE.png");
			background-size:cover ;
			width: 100%;
			height: 100vh;
		}

	</style>
</head>
<body >
<div class="background-image">
	<div class="h-100 d-flex align-items-center justify-content-center" >
		<p class="card-text"><center><a href="<?= base_url() ?>" class="btn btn-primary btn-lg">Sisteme git</a></center></p>
	</div>
</div>

<?php if ($this->session->flashdata('odeme_ok')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "<?=$this->session->flashdata('odeme_ok')?>",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 7500,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('odeme_error')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "<?=$this->session->flashdata('odeme_error')?>",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 7500,
		});
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('login_error')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "error",
			text: "Lütfen giriş yapınız.",
			confirmButtonText: 'Tamam',
			button: false,
			timer: 7500,
		});
	</script>
<?php endif; ?>
<!-- jQuery -->
<script src="<?= base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

<!-- Feather Icon JS -->
<script src="<?= base_url(); ?>assets/js/feather.min.js"></script>

<!-- Custom JS -->
<script src="<?= base_url(); ?>assets/js/script.js"></script>

</body>
</html>
