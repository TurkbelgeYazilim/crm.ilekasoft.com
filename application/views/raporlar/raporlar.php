<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>

<style>
li{
	list-style-type: none!important;
}
		.wrimagecard{	
		margin-top: 0;
    margin-bottom: 1.5rem;
    text-align: left;
    position: relative;
    background: #fff;
    box-shadow: 12px 15px 20px 0px rgba(46,61,73,0.15);
    border-radius: 14px;
    transition: all 0.3s ease;
}
.wrimagecard .fa{
	position: relative;
    font-size: 70px;
}
.wrimagecard-topimage_header{
padding: 20px;
}
a.wrimagecard:hover, .wrimagecard-topimage:hover {
    box-shadow: 2px 4px 8px 0px rgba(46,61,73,0.2);
}
/*.wrimagecard-topimage a {
    width: 100%;
    height: 100%;
    display: block;
}*/
.wrimagecard-topimage_title {
    padding: 20px 24px;
    height: 200px;
    padding-bottom: 13rem;
    position: relative;
}
.wrimagecard-topimage a {
    border-bottom: none;
    text-decoration: none;
    color: #525c65;
    transition: color 0.3s ease;
}


	</style>

</head>
	<body>
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
								<h3 class="page-title">Raporlar</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Raporlar
									</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->

					<?php 
    $control2 = session("r", "login_info");
    $u_id = $control2->kullanici_id;
    $yetki = $control2->kullanici_yetki;
    $anaHesap = anaHesapBilgisi();
?>

<?php if($yetki == 1){?>
<!--test-->
<div class="row">
    <div class="col-md-3 col-sm-4">
      <div class="wrimagecard wrimagecard-topimage">
          <a href="javascript:void(0);">
          <div class="wrimagecard-topimage_header" style="background-image: url('<?= env('BASE_URL'); ?>/assets/img/reports_image_1.jpg');">
            <center><i class = "fa fa-cubes" style="color:#16A085;opacity: 0;"></i></center>
          </div>
          <div class="wrimagecard-topimage_title">
            <h4><center>Operasyon</center> 
            <div class="pull-right badge" id="WrControls"></div></h4>
            <hr>
            <li><a href="<?= base_url("#"); ?>" style="color:#000;">Vadesi Geçen Senetler</a></li>
            <li><a href="<?= base_url("#"); ?>" style="color:#000;">Vadesi Geçen Açık Hesaplar</a></li>
            <li><a href="<?= base_url("#"); ?>" style="color:#000;">Yayını Kapatılacaklar</a></li>
            <li><a href="<?= base_url("#"); ?>" style="color:#000;">Hukuk İşlemi Başlatılacaklar</a></li>
            <li><a href="<?= base_url("#"); ?>" style="color:#000;">İcraya Verilenler</a></li>
            <li><a href="<?= base_url("#"); ?>" style="color:#000;">İcra Problemliler</a></li>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-3 col-sm-4">
      <div class="wrimagecard wrimagecard-topimage">
          <a href="javascript:void(0);">
          <div class="wrimagecard-topimage_header" style="background-image: url('<?= env('BASE_URL'); ?>/assets/img/reports_image_4.jpg');">
             <center><i class="fa fa-table" style="color:#3369e8;opacity: 0;"> </i></center>
          </div>
          <div class="wrimagecard-topimage_title">
            <h4><center>Kasa</center>
            <div class="pull-right badge" id="WrGridSystem"></div></h4>
            <hr>
            <li><a href="<?= base_url("raporlar/kasa-raporlari"); ?>" style="color:#000;">Kasa Raporları</a></li>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-3 col-sm-4">
      <div class="wrimagecard wrimagecard-topimage">
          <a href="javascript:void(0);">
            <div class="wrimagecard-topimage_header" style="background-image: url('<?= env('BASE_URL'); ?>/assets/img/reports_image_2.jpg');">
           <center><i class="fa fa-bars" style="color:#795a47;opacity: 0;"> </i></center> 
          </div>
          <div class="wrimagecard-topimage_title">
            <h4><center>Giderler</center>
            <div class="pull-right badge" id="WrNavigation"></div></h4>
            <hr>
            <li><a href="<?= base_url("raporlar/gider-raporlari"); ?>" style="color:#000;">Gider Raporları</a></li>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-3 col-sm-4">
      <div class="wrimagecard wrimagecard-topimage">
          <a href="javascript:void(0);">
         <div class="wrimagecard-topimage_header" style="background-image: url('<?= env('BASE_URL'); ?>/assets/img/reports_image_3.jpg');">
            <center><i class="fa fa-magic" style="color:#825d09;opacity: 0;"></i></center>
          </div>
          <div class="wrimagecard-topimage_title">
            <h4><center>Cari</center>
            <div class="pull-right badge" id="WrThemesIcons"></div></h4>
            <hr>
            <li><a href="<?= base_url("cari/cari-listesi"); ?>" style="color:#000;">Cari B/A Raporu</a></li>
          </div>
        </a>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-4">
      <div class="wrimagecard wrimagecard-topimage">
          <a href="javascript:void(0);">
          <div class="wrimagecard-topimage_header" style="background-image: url('<?= env('BASE_URL'); ?>/assets/img/reports_image_1.jpg');">
            <center><i class = "fa fa-cubes" style="color:#16A085;opacity: 0;"></i></center>
          </div>
          <div class="wrimagecard-topimage_title">
            <h4><center>Senetler</center> 
            <div class="pull-right badge" id="WrControls"></div></h4>
            <hr>
            <li><a href="<?= base_url("#"); ?>" style="color:#000;">Ödenen Senetler</a></li>
            <li><a href="<?= base_url("#"); ?>" style="color:#000;">Ödenmeyen Senetler (Elden)</a></li>
            <li><a href="<?= base_url("#"); ?>" style="color:#000;">Protesto Senetler (Banka)</a></li>
          </div>
        </a>
      </div>
    </div>
</div>
<?php } ?>
				</div>
			</div>
			<!-- /Page Wrapper -->
		</div>
		<!-- /Main Wrapper -->

		
<?php $this->load->view("include/footer-js"); ?>
<!-- Select2 JS -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>

<script>
$(function() {
	moment.locale('tr');
  $('#daterange').daterangepicker({
    opens: 'left',
    autoUpdateInput: false
  }, function(start, end, label) {
  	$('#daterange').val(start.format('DD.MM.YYYY')+' - '+end.format('DD.MM.YYYY'));
    //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>

</body>
</html>
