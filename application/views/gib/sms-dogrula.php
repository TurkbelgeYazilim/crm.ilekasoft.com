<!DOCTYPE html>
<html lang="tr" xmlns="http://www.w3.org/1999/html">
<head>
	<?php $this->load->view("include/head-tags"); ?>

	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/c3-chart/c3.min.css">

	<script src="https://www.amcharts.com/lib/4/core.js"></script>
	<script src="https://www.amcharts.com/lib/4/charts.js"></script>
	<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
	<style>


		.timer {
			width: 80px;
			height: 80px;

			border-radius: 50%;
			border: 1px solid #9d222d;
		}

		.timer__color-indicator {
			width: 100%;
			height: 100%;
			border-radius: 50%;
			background-color: rgba(236, 0, 0, 0);
			transition: background-color 0.3s linear;

			position: relative;
		}

		.timer__dash {
			display: block;
			width: 100%;

			position: absolute;
			top: 50%;
			transform: translateY(-50%);

			font-size: 30px;
			line-height: 30px;
			font-weight: bold;
			text-align: center;
		}

		/*************************************************/
		/* CREDIT : YEK/SASS (https://github.com/yek-org/yek-sass) */



		.verification__input {
			border: none;
			border-bottom: 1px solid #aaa;
			width: 40px;
			background-color: transparent;
			text-align: center;
			color:#9d222d;
		}
		.verification__input:focus{

			border-bottom: 1px solid #9d222d;
		}

	</style>
</head>
<body>

<?php $ses = session("r", "auth");
echo $ses; ?>


<!-- Main Wrapper -->
<div class="main-wrapper">

	<!-- Header -->
	<?php $this->load->view("include/header"); ?>
	<!-- /Header -->

	<!-- Sidebar -->
	<?php $this->load->view("include/sidebar"); ?>
	<!-- /Sidebar -->


	<!-- Page Wrapper -->
	<div class="page-wrapper mt-4">
		<div class="content container-fluid mt-3 ">

			<div class="page-header">
				<div class="row">
					<div class="col-sm-10">
						<h3 class="page-title">GİB</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
							<li class="breadcrumb-item">GİB</li>
							<li class="breadcrumb-item active">GİB Sms Doğrula</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i>
							<br>Önceki Sayfa</a>
					</div>
				</div>
			</div>
			<div id="newRow"></div>


			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">

						<form method="post" action="<?= base_url("gib/smsOnayla") ?>" class="verification" style="margin:auto;">
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-4 text-center">
										<div class="timer text-center" style="margin: auto;">
											<div class="timer__color-indicator">
												<span class="timer__dash"></span>
											</div>
										</div>

									</div>
								</div>

								<div class="row mt-3">
									<!--170 sn -->
									<div class="col-lg-4 col-md-4 col-sm-4 text-center">
										<div class="form-group">
											<label>Telefonunuza gelen şifreyi yazınız.</label>
											<section class="verification__wrap">
												<section class="verification__fields">
													<fieldset class="verification__field">

														<input type="text" name="kod[]"
															   class="verification__input verification__input--1"
															   id="verification-input-1" maxlength="1"/>
														<input type="text" name="kod[]"
															   class="verification__input verification__input--2"
															   id="verification-input-2" maxlength="1"/>
														<input type="text" name="kod[]"
															   class="verification__input verification__input--3"
															   id="verification-input-3" maxlength="1"/>
														<input type="text" name="kod[]"
															   class="verification__input verification__input--4"
															   id="verification-input-4" maxlength="1"/>
														<input type="text" name="kod[]"
															   class="verification__input verification__input--5"
															   id="verification-input-5" maxlength="1"/>
														<input type="text" name="kod[]"
															   class="verification__input verification__input--6"
															   id="verification-input-6" maxlength="1"/>
													</fieldset>
												</section>

											</section>

										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-4 text-center">
										<input type="submit" class="btn btn-danger" value="Doğrula">
									</div>
								</div>


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

<?php $this->load->view("include/footer-js"); ?>
<script>
	const COLOR_MAX_OPACITY = 1;
	const ONE_SECOND = 1000;

	class Timer {
		constructor(countdown = 170) {
			this._countdown = countdown;
			this._timerDash = document.querySelector(`.timer__dash`);
			this._timerColorIndicator = document.querySelector(`.timer__color-indicator`);

			if (typeof this._countdown !== `number` || this._countdown < 1) {
				throw new Error(`Wrong countdown value`);
			} else if (!this._timerDash || !this._timerColorIndicator) {
				throw new Error(`Required DOM node(s) not found`);
			}

		}

		start() {
			this._tick = setInterval(() => {
				if (this._countdown < 0) {
					this.stop();
					this._timerDash.textContent = `0`;
					<?php
					$this->session->set_flashdata('kod-yok', 'OK'); ?>
					window.location.href = "<?= base_url("gib/duzenlenenBelgeler")?>";
					return;
				}

				this._timerDash.textContent = this._countdown;
				this._countdown--;
			}, ONE_SECOND);
		}

		stop() {
			if (this._tick) {
				clearInterval(this._tick);
			}
		}
	}


	new Timer().start();


	class FormVerification {
		static inputs = [];

		static handleInput(target) {
			let nextInput = target.nextElementSibling;

			if (nextInput && target.value) {
				nextInput.focus();
				nextInput.value && nextInput.select();
			}
		}

		static handleBackspace(target) {
			if(target.previousElementSibling) {
				return target.value
					? (target.value = "")
					: target.previousElementSibling.focus();
			}
		}

		static handleArrowLeft(target) {
			const previousInput = target.previousElementSibling;
			return !previousInput ? undefined : previousInput.focus();
		}

		static handleArrowRight(target) {
			const nextInput = target.nextElementSibling;
			return !nextInput ? undefined : nextInput.focus();
		}

		static handlePaste(event, inputs) {
			// NOTE : get last text saved on clipboard
			let pasteText = (event.clipboardData || window.clipboardData).getData(
				"text"
			);

			// NOTE : change inputs value with clipboard text
			inputs.forEach((input, index) => {
				input.value = pasteText[index] || ``;
			});
			event.preventDefault();
		}
	}

	function shortcut(element, key, handle, params) {
		element.addEventListener(`keydown`, (e) => {
			return e.key.toString().toLowerCase() == key && handle(element);
		});
	}

	(function () {
		const verification = document.querySelector(`.verification`);
		const inputs = document.querySelectorAll(`.verification__input`);


		verification.addEventListener("input", ({target}) =>
			FormVerification.handleInput(target)
		);
		verification.addEventListener("paste", (e) =>
			FormVerification.handlePaste(e, inputs)
		);

		inputs[0].onfocus = () => inputs[0].select();
		inputs[1].onfocus = () => inputs[1].select();
		inputs[2].onfocus = () => inputs[2].select();
		inputs[3].onfocus = () => inputs[3].select();
		inputs[4].onfocus = () => inputs[4].select();
		inputs[5].onfocus = () => inputs[5].select();

		shortcut(inputs[0], `backspace`, FormVerification.handleBackspace);
		shortcut(inputs[1], `backspace`, FormVerification.handleBackspace);
		shortcut(inputs[2], `backspace`, FormVerification.handleBackspace);
		shortcut(inputs[3], `backspace`, FormVerification.handleBackspace);
		shortcut(inputs[4], `backspace`, FormVerification.handleBackspace);
		shortcut(inputs[5], `backspace`, FormVerification.handleBackspace);

		shortcut(inputs[0], `arrowleft`, FormVerification.handleArrowLeft);
		shortcut(inputs[1], `arrowleft`, FormVerification.handleArrowLeft);
		shortcut(inputs[2], `arrowleft`, FormVerification.handleArrowLeft);
		shortcut(inputs[3], `arrowleft`, FormVerification.handleArrowLeft);
		shortcut(inputs[4], `arrowleft`, FormVerification.handleArrowLeft);
		shortcut(inputs[5], `arrowleft`, FormVerification.handleArrowLeft);

		shortcut(inputs[0], `arrowright`, FormVerification.handleArrowRight);
		shortcut(inputs[1], `arrowright`, FormVerification.handleArrowRight);
		shortcut(inputs[2], `arrowright`, FormVerification.handleArrowRight);
		shortcut(inputs[3], `arrowright`, FormVerification.handleArrowRight);
		shortcut(inputs[4], `arrowright`, FormVerification.handleArrowRight);
		shortcut(inputs[5], `arrowright`, FormVerification.handleArrowRight);

	})();


</script>
</body>

</html>
