<?php 
	$control2 = session("r", "login_info");
	if (!$control2) {
		// Kullanıcı oturumu yoksa, login sayfasına yönlendir veya hata göster
		header("Location: /giris");
		exit;
	}
	$u_id = $control2->kullanici_id;
	$eposta = $control2->kullanici_eposta;
	$yetki = $control2->kullanici_yetki;

	$kullanici_demo = $control2->kullanici_demo;
	$kullanici_demoSonTarihi = $control2->kullanici_demoSonTarihi;
	// Kullanıcının grup bilgisini çek
	$grup_id = $control2->grup_id;
	$grup_sorgu = $this->db->query("SELECT kg_adi FROM kullanici_grubu WHERE kg_id = ?", array($grup_id));
	$grup_adi = ($grup_sorgu->num_rows() > 0) ? $grup_sorgu->row()->kg_adi : 'Tanımsız Grup';

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
				<!-- /Logo -->				<!-- Sidebar Toggle -->
				<a href="javascript:void(0);" id="toggle_btn" class="toggle-btn-header" role="button" 
				   aria-label="Toggle Navigation Menu" 
				   style="display: block !important; 
				          position: relative; 
				          z-index: 9999; 
				          pointer-events: auto !important;
				          cursor: pointer !important;
				          touch-action: manipulation; 
				          -webkit-tap-highlight-color: rgba(0,0,0,0.1);
				          padding: 10px;
				          min-height: 40px;
				          min-width: 40px;
				          background: rgba(0,0,0,0.1);
				          border-radius: 4px;
				          transition: background-color 0.3s ease;">
					<i class="fas fa-bars" style="color:#fff!important; pointer-events: none; font-size: 18px;"></i>
				</a>
				<!-- /Sidebar Toggle -->
						<!-- Search -->
				<div class="top-nav-search" style="background:none;">
    <div class="slideshow-container duyuru-container" style="margin-left:15px!important;margin-top:5px!important;color:#fff!important;font-size:9pt!important;background:none!important;overflow:hidden;white-space:nowrap;width:1260px;max-width:100vw;">

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

/* Desktop stilleri */
.top-nav-search {
    display: block !important;
    position: relative;
    z-index: 1;
}

/* Mobil cihazlarda responsive duyuru */
@media (max-width: 768px) {
    .header-left .logo {
        display: none !important;
    }
    
    /* Mobilde duyuru alanını tamamen yeniden düzenle */
    .top-nav-search {
        display: block !important;
        position: absolute !important;
        left: 45px !important;
        right: 50px !important;
        top: 10px !important;
        margin: 0 !important;
        width: auto !important;
        max-width: none !important;
        background: none !important;
        z-index: 10 !important;
    }
    
    .duyuru-container {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        height: 30px !important;
        overflow: hidden !important;
    }
    
    .marquee-slide {
        height: 30px !important;
        display: flex !important;
        align-items: center !important;
    }
      .marquee-slide span {
        min-width: 200px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        color: #ffeb3b !important;
        animation: marquee 15s linear infinite !important;
        padding-left: 50% !important;
        line-height: 30px !important;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.8) !important;
    }
      .dot-container {
        display: none !important;
    }
      /* Mobil'de sidebar simgeleri beyaz yap */
    #toggle_btn i {
        color: #fff !important;
    }
}

/* Mobil cihazlarda ekstra düzeltmeler */
@media (max-width: 480px) {
    .top-nav-search {
        left: 40px !important;
        right: 40px !important;
    }
      .marquee-slide span {
        font-size: 13px !important;
        font-weight: 600 !important;
        color: #ffeb3b !important;
        animation: marquee 12s linear infinite !important;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.8) !important;
    }
}
</style>

<script>
// Duyuru slideshow için JavaScript - Header namespace ile çakışma önlendi
let headerSlideIndex = 1;
let headerSlideInterval;

function showHeaderSlides(n) {
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {headerSlideIndex = 1}
    if (n < 1) {headerSlideIndex = slides.length}
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    if (slides[headerSlideIndex-1]) {
        slides[headerSlideIndex-1].style.display = "block";
    }
    if (dots[headerSlideIndex-1]) {
        dots[headerSlideIndex-1].className += " active";
    }
}

function currentSlide(n) {
    showHeaderSlides(headerSlideIndex = n);
}

function autoHeaderSlide() {
    headerSlideIndex++;
    showHeaderSlides(headerSlideIndex);
}

// Sayfa yüklendiğinde başlat
document.addEventListener('DOMContentLoaded', function() {
    showHeaderSlides(headerSlideIndex);
    headerSlideInterval = setInterval(autoHeaderSlide, 5000); // 5 saniyede bir değiş
});

// Mobil cihazlarda duyuru görünürlüğünü kontrol et
function checkMobileAnnouncement() {
    const topNavSearch = document.querySelector('.top-nav-search');
    if (topNavSearch && window.innerWidth <= 768) {
        topNavSearch.style.display = 'block';
        topNavSearch.style.visibility = 'visible';
    }
}

// Sayfa yüklendiğinde ve pencere boyutu değiştiğinde kontrol et
window.addEventListener('load', checkMobileAnnouncement);
window.addEventListener('resize', checkMobileAnnouncement);
</script>
				<!-- /Search -->
		

					<!-- Header Menu -->
				<ul class="nav nav-tabs user-menu">
					<!-- Bildirim İkonu -->
					<li class="nav-item dropdown has-arrow notification-nav">
						<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
							<i data-feather="bell"></i> 
							<span class="notification-count" id="notification-count" style="display: none;"></span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Bildirimler</span>
								<a href="javascript:void(0);" class="clear-noti" onclick="tumBildirimleriTemizle()">Tümünü Temizle</a>
							</div>
							<div class="noti-content" id="notification-content">
								<div class="notification-message text-center">
									<i data-feather="bell" class="text-muted"></i>
									<p>Yeni bildirim bulunmuyor</p>
								</div>
							</div>
						</div>
					</li>

					<!-- <li class="nav-item dropdown has-arrow flag-nav">
						<a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#kur_modal">
							<i data-feather="dollar-sign" class="mr-1"></i> Döviz Kuru
						</a>
					</li> -->					<?php if(isDemoActive() == 1 ){ ?>
						<li class="nav-item dropdown has-arrow main-drop">
							<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
								<span style="font-weight: bold;color:#ec1313!important;">Demo Üyelik</span>
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="javascript:void(0);"><b>Bitiş Tarihi: </b>&nbsp;<?= date('d.m.Y', strtotime($kullanici_demoSonTarihi)); ?></a>
								<a class="dropdown-item" href="javascript:void(0);"><b>Kalan Gün: </b>&nbsp;<?= $kalan_gun; ?></a>
								<a class="dropdown-item" href="javascript:void(0);">Hemen Satın Al</a>
							</div>
						</li>					<?php } ?>					
					<!-- User menu moved to sidebar bottom for all platforms -->
				
				
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
