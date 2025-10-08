<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

<title><?= $baslik; ?> - <?php  $firma = getirFirma(); echo $firma->ayarlar_firmaAd; ?> - ilekaSoft CRM - Muhasebe Programı</title>

<meta name="robots" content="noindex, nofollow">
<meta name="robots" content="noimageindex">
<meta name="googlebot" content="noindex, nofollow">

<!-- Favicon -->
<link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicon.png">

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="<?php echo base_url("assets/css/"); ?>jquery-ui.min.css">		

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/"); ?>/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker3.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet"/>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- Fontawesome CSS -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome/css/all.min.css">

<!-- Select2 CSS -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/select2/css/select2.min.css">
		
<!-- Main CSS -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">

<!-- <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" />
<!-- <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" /> -->

<!--[if lt IE 9]><
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->

<style>
<?php

$firmaID = getirFirma();
$firma_ID = $firmaID->ayarlar_id;

$modulGibSorgula = modulSorgula($firma_ID, 2);
	if($modulGibSorgula)
{?>
		.menu-title{
			color: #5c2d91;

		}
.sidebar-menu > ul > li > a:hover {
	background-color: rgba(92, 45, 145, 0.08) !important;
	color: #5c2d91 !important;
}
.sidebar-menu li.active > a{
	background-color: rgba(92, 45, 145, 0.08) !important;
	color: #5c2d91 !important;
	position: relative;
}
.sidebar-menu li.active > a::before{
	background: #5c2d91 !important;
}
<?php }?>
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

.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: #f5f3fa;
  color: #5c2d91;
  text-align: center;
  font-size: 9pt;
  border-top: 1px solid #5c2d91;
}

.destek_btn{
  position: fixed;
  bottom: 24px;
  right: 24px;
  display: inline-block;
  font-size: 10px;
  font-weight: bold;
  background: #5c2d91;
  border-radius: 50px;
  border: 0;
  box-shadow: 1px 1px 1px #a084ca;
  z-index: 999;
  padding: 9px;
  color:#fff;
  opacity: 0.9;
}

.destek_btn:hover{
	color:#fff;
	background: #7c4dff;
}

/* HEADER RENKLERİ */
.header {
    background: linear-gradient(90deg, #5c2d91 0%, #7c4dff 100%);
    color: #fff;
    border-bottom: 2px solid #5c2d91;
}
.header .header-left .logo img,
.header .header-left .logo.logo-small img {
    filter: brightness(0) invert(1) drop-shadow(0 0 2px #5c2d91);
}
.header .top-nav-search {
    background: #f5f3fa;
    border-radius: 8px;
}
.header .nav-tabs.user-menu > li > a,
.header .nav-tabs.user-menu > li > a span {
    color: #5c2d91 !important;
    font-weight: bold;
}
.header .nav-tabs.user-menu > li > a:hover,
.header .nav-tabs.user-menu > li > a:focus {
    color: #7c4dff !important;
}
.header .dropdown-menu {
    border-color: #5c2d91;
}

/* SIDEBAR RENKLERİ */
.sidebar {
    background: #f5f3fa;
    border-right: 2px solid #5c2d91;
}
.sidebar .sidebar-menu > ul > li > a {
    color: #5c2d91;
    font-weight: 500;
}
.sidebar .sidebar-menu > ul > li.active > a,
.sidebar .sidebar-menu > ul > li > a:hover {
    background: rgba(92, 45, 145, 0.12) !important;
    color: #7c4dff !important;
}
.sidebar .menu-title {
    color: #5c2d91;
    font-weight: bold;
}
.sidebar .submenu > a {
    color: #5c2d91;
}
.sidebar .submenu > ul > li > a.active {
    color: #fff !important;
    background: #5c2d91 !important;
}

/* DASHBOARD KARTLARI */
.bg-light-warning, .bg-light-primary, .bg-light-danger, .bg-light-success {
    background: #f5f3fa !important;
    border: 1px solid #5c2d91 !important;
    color: #5c2d91 !important;
}
.text-light-warning, .text-light-primary, .text-light-danger, .text-light-success {
    color: #5c2d91 !important;
}
.card-header, .card-title, .widget-stats .stats-title {
    color: #5c2d91 !important;
}

/* DİĞER */
::-webkit-scrollbar-thumb {
    background: #5c2d91;
}
::-webkit-scrollbar-thumb:hover {
    background: #7c4dff;
}

/* Tüm kırmızı butonları mor yap */
.btn-danger, .btn.btn-danger, .btn-outline-danger, .btn.btn-outline-danger, .bg-danger, .bg-danger-light, .text-danger, .btn-danger:active, .btn-danger:focus, .btn-danger:hover {
    background: #5c2d91 !important;
    border-color: #5c2d91 !important;
    color: #fff !important;
}
.btn-danger:hover, .btn.btn-danger:hover, .btn-outline-danger:hover, .btn.btn-outline-danger:hover {
    background: #7c4dff !important;
    border-color: #7c4dff !important;
    color: #fff !important;
}
.bg-danger, .bg-danger-light {
    background: #5c2d91 !important;
    color: #fff !important;
}
.text-danger {
    color: #fff !important;
    background: #5c2d91 !important;
    padding: 2px 6px;
    border-radius: 3px;
}

/* Beyaz buton + kırmızı yazı kombinasyonu için mor arka plan ve beyaz yazı */
.btn-white.text-danger, .btn.btn-white.text-danger {
    background: #5c2d91 !important;
    border-color: #5c2d91 !important;
    color: #fff !important;
}
.btn-white.text-danger:hover, .btn.btn-white.text-danger:hover {
    background: #7c4dff !important;
    border-color: #7c4dff !important;
    color: #fff !important;
}

/* Mobil Sidebar CSS */
@media (max-width: 768px) {
    /* Toggle button mobil stilleri */
    #toggle_btn {
        display: block !important;
        color: #fff !important;
        font-size: 18px;
        padding: 10px;
        cursor: pointer;
        text-decoration: none;
        position: relative;
        z-index: 1002;
        min-width: 44px;
        min-height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        touch-action: manipulation;
    }
    
    #toggle_btn:hover, #toggle_btn:focus, #toggle_btn:active {
        color: #fff !important;
        text-decoration: none;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
    }
    
    /* Sidebar mobil pozisyon */
    .sidebar {
        position: fixed !important;
        top: 60px !important;
        left: 0 !important;
        width: 250px !important;
        height: calc(100vh - 60px) !important;
        margin-left: -250px !important;
        transition: margin-left 0.3s ease, transform 0.3s ease !important;
        z-index: 1001 !important;
        overflow-y: auto !important;
        background: #fff !important;
    }
    
    /* Sidebar açık durumu */
    .main-wrapper.slide-nav .sidebar,
    body.sidebar-opened .sidebar {
        margin-left: 0 !important;
        transform: translateX(0) !important;
    }
    
    /* Overlay */
    .sidebar-overlay {
        position: fixed !important;
        top: 60px !important;
        left: 0 !important;
        width: 100% !important;
        height: calc(100vh - 60px) !important;
        background: rgba(0, 0, 0, 0.6) !important;
        z-index: 1000 !important;
        display: none !important;
        transition: opacity 0.3s ease !important;
    }
    
    .sidebar-overlay.opened {
        display: block !important;
        opacity: 1 !important;
    }
    
    /* Body scroll kilidi */
    html.menu-opened,
    body.sidebar-opened {
        overflow: hidden !important;
    }
    
    /* Page wrapper mobil */
    .page-wrapper {
        margin-left: 0 !important;
        transition: none !important;
    }
}

/* Desktop sidebar toggle gizle */
@media (min-width: 769px) {
    .sidebar-overlay {
        display: none !important;
    }
}
</style>
