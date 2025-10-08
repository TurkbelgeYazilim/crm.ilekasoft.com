<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>
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
								<h3 class="page-title">Giderler</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Giderler
									</li>
									<li class="breadcrumb-item active">Gider Türleri</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->
					<?php 
						$anaHesap = anaHesapBilgisi();

						$giderTuru = $this->input->get("giderTuru");
						if(empty($giderTuru)){
					?>
					<div class="row">
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Gider Türleri</h5>
										</div>
										<div class="col-auto">
											<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#add_category">Yeni Gider Türü Ekle</a>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
												<tr>
													<th>Ana Gider Türü</th>
													<th class="text-right">İşlem</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($giderKategorileri as $gk){?>

													<?php 
														$altQ = "SELECT COUNT(*) as total FROM giderKategorileri WHERE gk_mainID = '$gk->gk_id' AND gk_olusturanAnaHesap = '$anaHesap'";
														$altExe = $this->db->query($altQ)->row();
													?>
												<tr>
													<td><?= $gk->gk_adi; ?></td>
													<td class="text-right">
														<a href="<?= base_url("giderler/gider-turleri?giderTuru=$gk->gk_id"); ?>"  class="btn btn-sm btn-white text-info mr-2"><i class="far fa-eye mr-1"></i> Alt Gider Türlerini Görüntüle (<?= $altExe->total; ?>)</a> 
														<a href="#" data-toggle="modal" data-target="#edit_category2" data-id="<?= $gk->gk_id; ?>" data-adi="<?= $gk->gk_adi; ?>" class="btn btn-sm btn-white text-primary mr-2"><i class="fa fa-plus-circle mr-1"></i> Alt Gider Türü Ekle</a> 
														<a href="#" data-toggle="modal" data-target="#edit_category" data-id="<?= $gk->gk_id; ?>" data-adi="<?= $gk->gk_adi; ?>" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Düzenle</a> 
													</td>
												</tr>
											<?php }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }else if($giderTuru){
						$altKategorilerQ = "SELECT * FROM giderKategorileri WHERE gk_mainID = '$giderTuru' AND gk_olusturanAnaHesap='$anaHesap'";
						$altKategoriler = $this->db->query($altKategorilerQ)->result();

						$anaKategoriQ = "SELECT * FROM giderKategorileri WHERE gk_id = '$giderTuru' AND gk_olusturanAnaHesap ='$anaHesap'";
						$anaKategoriExe = $this->db->query($anaKategoriQ)->row();
				?>
					<div class="row">
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Alt Gider Türleri</h5>
										</div>
										<div class="col-auto">
											<a href="<?= base_url("giderler/gider-turleri"); ?>" class="btn btn-outline-danger btn-sm">Gider Türleri</a>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
												<tr>
													<th>Ana Gider Türü</th>
													<th>Alt Gider Türü</th>
													<th class="text-right">İşlem</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($altKategoriler as $ak){?>
												<tr>
													<td><?= $anaKategoriExe->gk_adi; ?></td>
													<td><?= $ak->gk_adi; ?></td>
													<td class="text-right">
														<a href="#" data-toggle="modal" data-target="#edit_category" data-id="<?= $ak->gk_id; ?>" data-adi="<?= $ak->gk_adi; ?>" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Düzenle</a> 
													</td>
												</tr>
											<?php }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }?>
					<!-- Add Category Modal -->
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Yeni Gider Türü Ekle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("giderler/yeniGiderKategorisiEkle"); ?>" method="POST">
										<div class="form-group">
											<label>Gider Türü Adı <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="gk_adi" required="" autocomplete="off">
										</div>
										<div class="submit-section">
											<button class="btn btn-danger submit-btn">Ekle</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- /Add Category Modal -->

					<div id="edit_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Mevcut Gider Türü Düzenle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("giderler/mevcutGiderKategorisiDuzenle"); ?>" method="POST">
										<input type="hidden" id="gk_id" name="gk_id">
										<div class="form-group">
											<label>Gider Türü Adı <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="gk_adi" name="gk_adi" required="" autocomplete="off">
										</div>
										<div class="submit-section">
											<button class="btn btn-danger submit-btn">Güncelle</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>


					<div id="edit_category2" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Alt Gider Türü Ekle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("giderler/altGiderKategorisiEkle"); ?>" method="POST">
										<input type="hidden" id="gk_id" name="gk_id">
										<div class="form-group">
											<label>Gider Türü Adı <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="gk_adi" name="gk_adi" required="" autocomplete="off" disabled>
										</div>
										<div class="form-group">
											<label>Alt Gider Türü Adı <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="gk_alt_adi" name="gk_alt_adi" required="" autocomplete="off">
										</div>
										<div class="submit-section">
											<button class="btn btn-danger submit-btn">Ekle</button>
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

<?php if ($this->session->flashdata('gk_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Yeni gider kategorisi başarılı bir şekilde eklendi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('gk_alt_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Yeni alt gider kategorisi başarılı bir şekilde eklendi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('gk_updt_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Mevcut gider kategorisi başarılı bir şekilde güncellendi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>
		
<?php $this->load->view("include/footer-js"); ?>
<!-- Select2 JS -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>

<script>
	$('#edit_category').on('show.bs.modal', function (event) {
		  let id = $(event.relatedTarget).data('id') 
		  let adi = $(event.relatedTarget).data('adi') 

		  $(this).find('.modal-body #gk_id').val(id)
		  $(this).find('.modal-body #gk_adi').val(adi)

	});


	$('#edit_category2').on('show.bs.modal', function (event) {
		  let id = $(event.relatedTarget).data('id') 
		  let adi = $(event.relatedTarget).data('adi') 

		  $(this).find('.modal-body #gk_id').val(id)
		  $(this).find('.modal-body #gk_adi').val(adi)

	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		 $("form").submit(function() {
				$(this).submit(function() {
					return false;
				});
				return true;
			}); 
	}); 
</script>

</body>
</html>