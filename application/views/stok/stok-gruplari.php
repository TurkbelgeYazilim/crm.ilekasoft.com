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
								<h3 class="page-title">Stok</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Stok
									</li>
									<li class="breadcrumb-item active">Stok Grupları</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						
						<div class="col-xl-12 col-md-12">
							<div class="card card-table">
								<div class="card-header">
									<div class="row">
										<div class="col">
											<h5 class="card-title">Stok Grupları</h5>
										</div>
										<div class="col-auto">
											<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#add_category">Yeni Stok Grubu Ekle</a>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
												<tr>
													<th>Grup Kodu</th>
													<th>Grup Adı</th>
													<th class="text-right">İşlem</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($stokGruplari as $sg){?>
												<tr>
													<td><?= $sg->stokGrup_kodu; ?></td>
													<td><?= $sg->stokGrup_ad; ?></td>
													<td class="text-right">
														<a href="#" data-toggle="modal" data-target="#edit_category" data-id="<?= $sg->stokGrup_id; ?>" data-kodu="<?= $sg->stokGrup_kodu; ?>" data-adi="<?= $sg->stokGrup_ad; ?>" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Düzenle</a> 
														<!--
														<a href="#" data-toggle="modal" data-target="#edit_category" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Düzenle</a> 
														<a href="#" data-toggle="modal" data-target="#delete_category" class="btn btn-sm btn-white text-danger mr-2"><i class="far fa-trash-alt mr-1"></i>Sil</a>
														-->
													</td>
												</tr>
											<?php }?>
											</tbody>
										</table>
										<hr>
<span style="margin-left:15px;">Toplam kayıt sayısı:</span> <b><?= $count_of_list; ?></b>
<br><br>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Add Category Modal -->
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Yeni Stok Grubu Ekle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("stok/yeniStokGrubuEkle"); ?>" method="POST">
										<div class="form-group">
											<label>Grup Adı <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="stokGrup_ad" required="">
										</div>
										
										<div class="form-group">
											<label>Grup Kodu <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="stokGrup_kodu" required="">
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
									<h5 class="modal-title">Mevcut Stok Grubu Düzenle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("stok/mevcutStokGrubuDuzenle"); ?>" method="POST">
										<input type="hidden" id="stokGrup_id" name="stokGrup_id">
										<div class="form-group">
											<label>Grup Kodu <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="stokGrup_kodu" name="stokGrup_kodu" required="">
										</div>
										<div class="form-group">
											<label>Grup Adı <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="stokGrup_ad" name="stokGrup_ad" required="">
										</div>
										<div class="submit-section">
											<button class="btn btn-danger submit-btn">Güncelle</button>
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

<?php if ($this->session->flashdata('stok_grup_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Yeni stok grubu başarılı bir şekilde eklendi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('stok_grup_kodvar')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "error", 
  text: "Stok grup kodu zaten mevcut, tekrar deneyiniz.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('stok_grup_updt_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Mevcut stok bilgileri güncellenmiştir.",
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
		  let kodu = $(event.relatedTarget).data('kodu') 
		  let adi = $(event.relatedTarget).data('adi') 

		  $(this).find('.modal-body #stokGrup_id').val(id)
		  $(this).find('.modal-body #stokGrup_kodu').val(kodu)
		  $(this).find('.modal-body #stokGrup_ad').val(adi)
		})
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