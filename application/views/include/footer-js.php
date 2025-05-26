<a href="<?= base_url("destek"); ?>?ref=footer" class="destek_btn"> <i data-feather="life-buoy" class="mr-1"></i> Destek Talep Et</a>

<?php
// MySQL bağlantısını yapalım
$mysqli = new mysqli('localhost', 'ilekasoft_crmuser', 'KaleW356!', 'ilekasoft_crmdb');

// Bağlantıyı kontrol et
if ($mysqli->connect_error) {
    die('Bağlantı hatası: ' . $mysqli->connect_error);
}

// En son destek_id değerini al
$result = $mysqli->query("SELECT MAX(destek_id) as son_destek_id FROM destek");
$row = $result->fetch_assoc();
$son_destek_id = $row['son_destek_id'] ?? 'Bilinmiyor';

$mysqli->close();
?>

<div class="footer">
	<p>&copy; ilekaSoft CRM | Versiyon: <?= $son_destek_id; ?> <!-- https://www.utctime.net/ Unix Epoch --> | <a href="<?= base_url("destek"); ?>?ref=footer" style="color:#d92637;">Destek Talep Et</a> | <a href="mailto:destek@ilekasoft.com" style="color:#d92637;">destek@ilekasoft.com</a></p>
</div>

<!-- jQuery -->
<script src="<?= base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Bootstrap Core JS -->
<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

<script src="<?= base_url(); ?>assets/plugins/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.tr.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/js/daterangepicker.js"></script>

<!-- Feather Icon JS -->
<script src="<?= base_url(); ?>assets/js/feather.min.js"></script>

<!-- Slimscroll JS -->
<script src="<?= base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Select2 JS -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>


<script src="<?= base_url(); ?>assets/js/bootstrap-session-timeout.js"></script>

<!-- Custom JS -->
<script src="<?= base_url(); ?>assets/js/script.js"></script>


<!-- 
<script>
	setInterval(function(){
		var base_url = "<?php echo base_url();?>";
		$.post(base_url + 'home/sessionKontrol', function (result) {
			if(result=="1")
				window.location.href = base_url+"home/logout";
		});
	},5000);
</script>
-->

<script>
	let slideIndex = 1;
	showSlides(slideIndex);

	function plusSlides(n) {
		showSlides(slideIndex += n);
	}

	function currentSlide(n) {
		showSlides(slideIndex = n);
	}

	function showSlides(n) {
		let i;
		let slides = document.getElementsByClassName("mySlides");
		let dots = document.getElementsByClassName("dot");
		if (n > slides.length) {slideIndex = 1}
		if (n < 1) {slideIndex = slides.length}
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		}
		for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" active", "");
		}
		slides[slideIndex-1].style.display = "block";
		dots[slideIndex-1].className += " active";
	}
	window.onload= function () {
		setInterval(function(){
			plusSlides(1);
		}, 5000);
	}

	$.sessionTimeout({
		logoutUrl: '<?= base_url('home/logout'); ?>',
		redirUrl: '<?= base_url('home/logout'); ?>',
		warnAfter: 600000, //600000    10 dakika
		redirAfter: 620000, //620000 10dakika20saniye
		ignoreUserActivity:true,
		countdownMessage: '{timer} saniye sonunda çıkışa yönlendirileceksiniz.'
	});
</script>