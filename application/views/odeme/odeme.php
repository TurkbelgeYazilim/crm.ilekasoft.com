<!doctype html>
<html>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<title>Ödeme</title>
	<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
	<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
	<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.min.css" integrity="sha512-hpo7VUEeZfF+7lnGhAOa+8AmtBMb+VgBX8Ou4mdnN6UvMK3sVLTvTu1Yvd9ChdubSu6Dnf2UGZpe9svVIsg+hg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<style>::-webkit-scrollbar {
			width: 8px;
		}
		/* Track */
		::-webkit-scrollbar-track {
			background: #f1f1f1;
		}

		/* Handle */
		::-webkit-scrollbar-thumb {
			background: #888;
		}

		/* Handle on hover */
		::-webkit-scrollbar-thumb:hover {
			background: #555;
		} @import url("https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap");


		body{
			background-color:#f7f8f9;
			font-family: "Poppins", sans-serif;
			font-weight: 300;
		}

		.container{

			height: 100vh;

		}

		.card{

			border: none;
		}

		.card-header {
			padding: .5rem 1rem;
			margin-bottom: 0;
			background-color: rgba(0,0,0,.03);
			border-bottom: none;
		}

		.btn-light:focus {
			color: #212529;
			background-color: #e2e6ea;
			border-color: #dae0e5;
			box-shadow: 0 0 0 0.2rem rgba(216,217,219,.5);
		}

		.form-control{

			height: 50px;
			border: 2px solid #eee;
			border-radius: 6px;
			font-size: 14px;
		}

		.form-control:focus {
			color: #495057;
			background-color: #fff;
			border-color: #039be5;
			outline: 0;
			box-shadow: none;

		}

		.input{

			position: relative;
		}

		.input i{

			position: absolute;
			top: 16px;
			left: 11px;
			color: #989898;
		}

		.input input{

			text-indent: 25px;
		}

		.card-text{

			font-size: 13px;
			margin-left: 6px;
		}

		.certificate-text{

			font-size: 12px;
		}


		.billing{
			font-size: 11px;
		}

		.super-price{

			top: 0px;
			font-size: 22px;
		}

		.super-month{

			font-size: 11px;
		}


		.line{
			color: #bfbdbd;
		}

		.free-button{

			background: #1565c0;
			height: 52px;
			font-size: 15px;
			border-radius: 8px;
		}


		.payment-card-body{

			flex: 1 1 auto;
			padding: 24px 1rem !important;

		}</style>
</head>
<body className='snippet-body'>
<div class="container d-flex justify-content-center mt-5 mb-5">

	<div class="row g-3">

		<div class="col-md-6">

			<div class="card">

				<div class="accordion" id="accordionExample">

					<div class="card">
						<div class="card-header p-0">
							<h2 class="mb-0">
								<button class="btn btn-light btn-block text-left p-3 rounded-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<div class="d-flex align-items-center justify-content-between">

										<span>Kredi / Banka Kartı</span>
										<div class="icons">
											<img src="https://i.imgur.com/2ISgYja.png" width="30">
											<img src="https://i.imgur.com/W1vtnOV.png" width="30">
										</div>

									</div>
								</button>
							</h2>
						</div>

						<form method="post" action="<?= $getFormUrl ?>">
							<input type="hidden" name="ThreeDSessionId" value="<?= $ThreeDSessionId?>">
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
								<div class="card-body payment-card-body">

									<span class="font-weight-normal card-text">Ad Soyad</span>
									<div class="input mb-3">

										<i class="fa fa-id-card"></i>
										<input type="text" class="form-control" name="CardHolderName" placeholder="" autocomplete="off" required>

									</div>

									<span class="font-weight-normal card-text">Kart Numarası</span>
									<div class="input">

										<i class="fa fa-credit-card"></i>
										<input type="text" class="form-control" name="CardNo" placeholder="0000 0000 0000 0000" id="ccNumber" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16" autocomplete="off" required>

									</div>

									<div class="row mt-3 mb-3">

										<div class="col-md-6">

											<span class="font-weight-normal card-text">Son Kullanma Tarihi</span>
											<div class="input">

												<i class="fa fa-calendar"></i>
												<input type="text" class="form-control" name="ExpireDate" placeholder="Ay/Yıl" required>

											</div>

										</div>


										<div class="col-md-6">

											<span class="font-weight-normal card-text">Güvenlik Kodu</span>
											<div class="input">

												<i class="fa fa-lock"></i>
												<input type="text" class="form-control" name="Cvv" placeholder="000" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" autocomplete="off" required>

											</div>

										</div>


									</div>

									<!-- <span class="text-muted certificate-text"><i class="fa fa-lock"></i> Your transaction is secured with ssl certificate</span> -->

								</div>
							</div>

					</div>

				</div>

			</div>

		</div>

		<?php
			$ucret = $modul->modul_ucret;
			$kdv = $ucret*0.18;
			$toplam = $ucret*1.18;
		?>

		<div class="col-md-6">
			<div class="card">

				<div class="d-flex justify-content-between p-3">

					<div class="d-flex flex-column">

						<span>Modül Adı (<?= $modul->modul_ad ?>)</span>
						<i  class="billing"><?= $modul->modul_aciklama ?></i>

					</div>

					<div class="mt-1">
						<sup class="super-price"><?=$ucret; ?> TL</sup>
						<!-- <span class="super-month">/yıl</span> -->
					</div>
				</div>
				<hr class="mt-0 line">
				<div class="p-3">

					<!-- <div class="d-flex justify-content-between mb-2">

						<span>Refferal Bonouses</span>
						<span>-$2.00</span>

					</div> -->

					<div class="d-flex justify-content-between">

						<span>KDV 18.00%</span>
						<span><?=$kdv;?>  TL</span>

					</div>
				</div>

				<hr class="mt-0 line">
				<div class="p-3 d-flex justify-content-between">

					<div class="d-flex flex-column">

						<span>Bugün ödemeniz gereken</span>

					</div>
					<span><?=$toplam;?> TL</span>
				</div>
				<div class="p-3">

					<button class="btn btn-primary btn-block free-button">Satın Al</button>
					<div class="text-center mt-3">
						<a href="<?= base_url("modul/moduller"); ?>" style="color:#000!important;"><i class="fa fa-arrow-left fa-sm"></i> <b>ilekaSoft</b> Modüller Sayfasına Geri Dön</a>
					</div>
					<div class="text-center mt-3">
						<a href="tel:08503330353" style="color:#000!important;"><i class="fa fa-life-ring fa-sm"></i> <b>Teknik Destek:</b> 0 850 333 0 353</a>
					</div>

				</div>

			</div>
		</div>
	</div>
	</form>

</div>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
<script type='text/javascript'>
	/* var myLink = document.querySelector('a[href="#"]');
	myLink.addEventListener('click', function(e) {
		e.preventDefault();
	});*/


	function validateCardNumber(number) {
		var regex = new RegExp("^[0-9]{15,16}$");
		if (!regex.test(number))
			return false;

		return luhnCheck(number);
	}

	function luhnCheck(val) {
		var sum = 0;
		for (var i = 0; i < val.length; i++) {
			var intVal = parseInt(val.substr(i, 1));
			if (i % 2 == 0) {
				intVal *= 2;
				if (intVal > 9) {
					intVal = 1 + (intVal % 10);
				}
			}
			sum += intVal;
		}
		return (sum % 10) == 0;
	}

	$("#ccNumber").blur(function(){
		let cc = $("#ccNumber").val();

		if(validateCardNumber(cc)){
			console.log(validateCardNumber(cc));
			//buton deaktif ise aktif et
		}else{
			console.log(validateCardNumber(cc));
			//satın alma butonu pasif et
			swal({toast:true,position: 'top-start',title: "Lütfen ödeme işlemine devam etmek için kart numaranızı kontrol ediniz.",type: "error",showConfirmButton: false, timer: 7500});
		}

	});
</script>

</body>
</html>
