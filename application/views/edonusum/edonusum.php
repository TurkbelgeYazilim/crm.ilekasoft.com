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
    padding-bottom: 0.75rem;
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
								<h3 class="page-title">e-Dönüşüm</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">e-Dönüşüm
									</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->

          <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <strong>e-Dönüşüm'e Hoş geldiniz!</strong> Dijital dönüşüm <a href="https://turkbelge.com.tr" target="_blank"><span style="color:#e31a1c;">TÜRKBELGE</span></a> ile başlar, siz de dijital dönüşümün bir parçası olun.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

<!--test-->
	<div class="row">
    <div class="col-md-4 col-sm-4">
      <div class="wrimagecard wrimagecard-topimage">
          <a href="javascript:void(0);">
          <div class="wrimagecard-topimage_header" style="background-image: url('<?= env('BASE_URL'); ?>/assets/img/donusum-image-001.jpg');">
            <center><i class = "fa fa-cubes" style="color:#16A085;opacity: 0;"></i></center>
          </div>
          <div class="wrimagecard-topimage_title">
            <h4><center><i data-feather="info" class="text-info" data-toggle="tooltip" data-placement="right" title="e-Fatura"></i> e-Fatura</center> 
            <div class="pull-right badge"></div></h4>
            <hr><center>
            <li><a href="#" style="color:#000;">Gelen Kutusu</a></li>
            <li><a href="#" style="color:#000;">Giden Kutusu</a></li>
            <li><a href="#" style="color:#000;">e-Fatura Oluştur</a></li>
            <li><a href="#" style="color:#000;">Taslak Faturalar</a></li>
            <li><a href="#" style="color:#000;">Fatura Yükleme</a></li></center>
          </div>
        </a>
      </div>
  </div>

	<div class="col-md-4 col-sm-4">
      <div class="wrimagecard wrimagecard-topimage">
          <a href="javascript:void(0);">
          <div class="wrimagecard-topimage_header" style="background-image: url('<?= env('BASE_URL'); ?>/assets/img/donusum-image-002.jpg');">
             <center><i class="fa fa-table" style="color:#3369e8;opacity: 0;"> </i></center>
          </div>
          <div class="wrimagecard-topimage_title">
            <h4><center><i data-feather="info" class="text-info" data-toggle="tooltip" data-placement="right" title="e-Arşiv Fatura"></i> e-Arşiv Fatura</center>
            <div class="pull-right badge" id="WrGridSystem"></div></h4>
            <hr><center>
            <li><a href="#" style="color:#000;">e-Arşiv Faturaları</a></li>
            <li><a href="#" style="color:#000;">e-Arşiv Raporları</a></li>
            <li><a href="#" style="color:#000;">Taslak e-Arşiv</a></li>
            <li><a href="#" style="color:#000;">e-Arşiv Fatura Oluştur</a></li>
            <li><a href="#" style="color:#000;">e-Arşiv Yükle</a></li></center>
          </div>
        </a>
      </div>
	</div>

  <div class="col-md-4 col-sm-4">
      <div class="wrimagecard wrimagecard-topimage">
          <a href="javascript:void(0);">
          <div class="wrimagecard-topimage_header" style="background-image: url('<?= env('BASE_URL'); ?>/assets/img/donusum-image-004.jpg');">
             <center><i class="fa fa-table" style="color:#3369e8;opacity: 0;"> </i></center>
          </div>
          <div class="wrimagecard-topimage_title">
            <h4><center>Ayarlar</center>
            <div class="pull-right badge" id="WrGridSystem"></div></h4>
            <hr><center>
            <li><a href="#" style="color:#000;">Genel Ayarlar</a></li>
            <li><a href="#" style="color:#000;">Entegrasyon Ayarları</a></li>
            <li><a href="#" style="color:#000;">Seri Yönetimi</a></li>
            <li><a href="#" style="color:#000;">e-Posta Ayarları</a></li>
          </div>
        </a>
      </div>
  </div>

</div>
<!--test-->

				</div>
			</div>
			<!-- /Page Wrapper -->
		</div>
		<!-- /Main Wrapper -->

		
<?php $this->load->view("include/footer-js"); ?>

</body>
</html>
