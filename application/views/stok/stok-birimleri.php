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
									<li class="breadcrumb-item active">Stok Birimleri</li>
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
											<h5 class="card-title">Stok Birimleri</h5>
										</div>
										<!-- <div class="col-auto">
											<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#add_category">Yeni Stok Birimi Ekle</a>
										</div> -->
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
												<tr>
													<th>Birim Adı</th>
													<th>Birim Kısaltması</th>
													<th>Birim Kodu</th>
													<!-- <th class="text-right">İşlem</th> -->
												</tr>
											</thead>
											<tbody>
												<?php foreach($stokBirimleri as $sb){?>
												<tr>
													<td><?= $sb->stokBirim_ad; ?></td>
													<td><?= $sb->stokBirim_kisaltma; ?></td>
													<td><?= $sb->stokBirim_kodu; ?></td>
													<!-- <td class="text-right">
														<a href="#" data-toggle="modal" data-target="#edit_category" data-id="<?= $sb->stokBirim_id; ?>" data-ad="<?= $sb->stokBirim_ad; ?>" data-kisaltma="<?= $sb->stokBirim_kisaltma; ?>" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Düzenle</a>
													</td> -->
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
									<form action="<?= base_url("stok/yeniStokBirimiEkle"); ?>" method="POST">
										<div class="form-group">
											<label>Birim Adı <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="stokBirim_ad" required="">
										</div>
										<div class="form-group">
											<label>Kısaltma <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="stokBirim_kisaltma" required="">
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
									<form action="<?= base_url("stok/mevcutStokBirimiDuzenle"); ?>" method="POST">
										<input type="hidden" id="stokBirim_id" name="stokBirim_id">
										<div class="form-group">
											<label>Birim Adı <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="stokBirim_ad" name="stokBirim_ad" required="">
										</div>
										<div class="form-group">
											<label>Kısaltma <span class="text-danger">*</span></label>
											<input class="form-control" type="text" id="stokBirim_kisaltma" name="stokBirim_kisaltma" required="">
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

<?php if ($this->session->flashdata('stok_birim_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Yeni stok birimi başarılı bir şekilde eklendi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('stok_birim_updt_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Mevcut stok birimi bilgileri güncellenmiştir.",
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
		  let ad = $(event.relatedTarget).data('ad') 
		  let kisaltma = $(event.relatedTarget).data('kisaltma') 

		  $(this).find('.modal-body #stokBirim_id').val(id)
		  $(this).find('.modal-body #stokBirim_ad').val(ad)
		  $(this).find('.modal-body #stokBirim_kisaltma').val(kisaltma)
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
