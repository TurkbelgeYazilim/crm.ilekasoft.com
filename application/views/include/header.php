<?php 
	$control2 = session("r", "login_info");
	$u_id = $control2->kullanici_id;
	$eposta = $control2->kullanici_eposta;
	$yetki = $control2->kullanici_yetki;

	$kullanici_demo = $control2->kullanici_demo;
	$kullanici_demoSonTarihi = $control2->kullanici_demoSonTarihi;

	$bugunTarih = strtotime((new DateTime('now'))->format('Y-m-d H:i:s'));

	$your_date = strtotime($kullanici_demoSonTarihi);
	$datediff = $your_date - $bugunTarih;

	$kalan_gun = round($datediff / (60 * 60 * 24));
?>
			<div class="header">
				<!-- Logo -->
				<div class="header-left">
					<a href="<?= base_url(); ?>" class="logo">
						<img src="<?= base_url(); ?>assets/img/logo2.png" alt="Logo">
					</a>
					<a href="<?= base_url(); ?>" class="logo logo-small">
						<img src="<?= base_url(); ?>assets/img/logo2.png" alt="Logo" width="auto" style='height:15px !important;'>
					</a>
				</div>
				<!-- /Logo -->
				
				<!-- Sidebar Toggle -->
				<a href="javascript:void(0);" id="toggle_btn">
					<i class="fas fa-bars" style="color:#fff!important;"></i>
				</a>
				<!-- /Sidebar Toggle -->
				
				<!-- Search -->
				<div class="top-nav-search" style="background:none;">
    <div class="slideshow-container" style="margin-left:15px!important;margin-top:5px!important;color:#fff!important;font-size:9pt!important;background:none!important;overflow:hidden;white-space:nowrap;width:1260px;max-width:100vw;">

        <?php $duyurular = $this->db->query("SELECT * FROM duyurular WHERE duyuru_durum = 1 ORDER BY RAND() LIMIT 5")->result();
            foreach($duyurular as $duyuru){
        ?>
                <div class="mySlides marquee-slide">
                    <span><?= $duyuru->duyuru_msg; ?></span>
                </div>
        <?php }?>
    </div>
    <div class="dot-container">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
</div>
<style>
.marquee-slide span {
    display: inline-block;
    padding-left: 100%;
    animation: marquee 32s linear infinite;
    color: #fff !important;
    white-space: nowrap;
    min-width: 1200px;
}
@keyframes marquee {
    0%   { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}
</style>
				<!-- /Search -->
				
				<!-- Mobile Menu Toggle -->
				<a class="mobile_btn" id="mobile_btn">
					<i class="fas fa-bars"></i>
				</a>
				<!-- /Mobile Menu Toggle -->

					<!-- Header Menu -->
				<ul class="nav nav-tabs user-menu">

					<!-- <li class="nav-item dropdown has-arrow flag-nav">
						<a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#kur_modal">
							<i data-feather="dollar-sign" class="mr-1"></i> Döviz Kuru
						</a>
					</li> -->
					<?php if(isDemoActive() == 1 ){ ?>
						<li class="nav-item dropdown has-arrow main-drop">
							<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
								<span style="font-weight: bold;color:#ec1313!important;">Demo Üyelik</span>
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="javascript:void(0);"><b>Bitiş Tarihi: </b>&nbsp;<?= date('d.m.Y', strtotime($kullanici_demoSonTarihi)); ?></a>
								<a class="dropdown-item" href="javascript:void(0);"><b>Kalan Gün: </b>&nbsp;<?= $kalan_gun; ?></a>
								<a class="dropdown-item" href="javascript:void(0);">Hemen Satın Al</a>
							</div>
						</li>
					<?php } ?>
				
				
			</div>

			<!-- Kur Modal
					<div id="kur_modal" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Güncel Kurlar</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<center>
										DOLAR: <b><?= getPriceOfCurrency(2); ?></b> <sub>TL</sub>
										<hr>
										EURO: <b><?= getPriceOfCurrency(3); ?></b> <sub>TL</sub>
										<hr>
										GRAM ALTIN: <b><?= getPriceOfCurrency(5); ?></b> <sub>TL</sub>
										<hr>
										BITCOIN: <b><?= number_format(getPriceOfCurrency(4),4); ?></b> <sub>DOLAR</sub>
										<hr>
										BIST 100: <b><?= number_format(getPriceOfCurrency(1)); ?></b>
									</center>
								</div>
							</div>
						</div>
					</div>
			/Kur Modal -->
