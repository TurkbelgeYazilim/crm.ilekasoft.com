<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
	<style>
		.tooltip {
			pointer-events: none;
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
								<h3 class="page-title">Duyurular</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a>
									</li>
									<li class="breadcrumb-item">Admin
									</li>
									<li class="breadcrumb-item active">Duyurular</li>
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
											<h5 class="card-title">Duyurular</h5>
											Site üzerinde rasgele bir şekilde en fazla 5 adet duyuru listelenir.
										</div>

										<div class="col-auto">
											<a href="javascript:void(0);" class="btn btn-success btn-lg" data-toggle="modal" data-target="#add_category2"><i class="fa fa-plus"></i> Yeni Duyuru Oluştur</a>
										</div>

									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
											<tr>
												<th>ID</th>
												<th>Mesaj</th>
												<th>Durum</th>
												<th>İşlem</th>
											</tr>
											</thead>
											<tbody>
											<?php foreach($duyurular as $duyuru){ ?>
												<tr>
													<td><?= $duyuru->duyuru_id; ?></td>
													<td><?= $duyuru->duyuru_msg;?></td>
													<td><?php if($duyuru->duyuru_durum == 1){echo "<span class='badge bg-success-light'>Aktif</span>";}else{echo "<span class='badge bg-danger-light'>Pasif</span>";} ?></td>
													<td>
														<a href="<?= base_url("admin/duyuruPasif/$duyuru->duyuru_id"); ?>"  class="btn btn-sm btn-white text-info mr-2"><?php if($duyuru->duyuru_durum == 1){ echo '<i class="fa fa-pause"></i>';}else{echo '<i class="fa fa-play"></i>';} ?></a>

<a href="javascript:void(0);"
   data-toggle="modal"
   data-target="#add_category4"
   data-id="<?= $duyuru->duyuru_id; ?>"
   data-msg="<?= $duyuru->duyuru_msg; ?>"
   class="btn btn-sm btn-white text-success mr-2">
	<i class="far fa-edit mr-1"></i>
</a>

													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
										<hr>
<span style="margin-left:15px;">Toplam kayıt sayısı:</span> <b><?= $count_of_list; ?></b>
<br><br>
										<?php echo $links; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Wrapper -->
		</div>
		<!-- /Main Wrapper -->

		<!-- Add Category Modal -->
		<div id="add_category2" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Yeni Duyuru Oluştur</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url("admin/yeniDuyuruOlustur"); ?>" method="POST">
							<div class="form-group">
								<label>Duyuru</label>
								<textarea class="form-control" name="duyuru_msg" required=""></textarea>
							</div>
							<div class="submit-section">
								<button class="btn btn-danger submit-btn">Gönder</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Category Modal -->

		<!-- Add Category Modal -->
		<div id="add_category4" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Duyuru Düzenle</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url("admin/duyuruDuzenle"); ?>" method="POST">
							<input type="hidden" name="duyuru_id" id="duyuru_id">

							<div class="form-group">
								<label>Duyuru</label>
								<textarea class="form-control" name="duyuru_msg" id="duyuru_msg" required=""></textarea>
							</div>

							<div class="submit-section">
								<button class="btn btn-danger submit-btn">Düzenle</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Category Modal -->

		<?php if ($this->session->flashdata('ok')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "success", 
				  text: "ok.",
				  confirmButtonText:'Tamam',
				  button: false,
				  timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('no')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "no.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

<?php $this->load->view("include/footer-js"); ?>

	<script>
		$('#add_category4').on('show.bs.modal', function (event) {
			let id = $(event.relatedTarget).data('id')
			let msg = $(event.relatedTarget).data('msg')

			$(this).find('.modal-body #duyuru_id').val(id)
			$(this).find('.modal-body #duyuru_msg').val(msg)
		});
	</script>
</body>
</html>
