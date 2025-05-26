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
								<h3 class="page-title">Fatura</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Fatura</li>
									<li class="breadcrumb-item active">Etiket Yönetimi</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->


					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
										<h4 class="card-title">Etiketler <a href="" class="btn btn-success btn-sm" style="float:right;" data-toggle='modal' data-target='#yeni_etiket'><i class="fa fa-plus"></i> Yeni Etiket</a></h4>
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
											<tr>
												<th>Etiket Adı</th>
												<th class="text-right">İşlem</th>
											</tr>
											</thead>
											<tbody>
											<?php

											$firma = getirFirma();
											$deletePermission = $firma->ayarlar_deletePermission;

											?>
											<?php foreach($etiketler as $etiket){?>
											<tr>
												<td><?php echo $etiket->etiket_adi; ?></td>
												<td class="text-right">
													<a href="" data-toggle='modal' data-target='#etiket_Guncelle' class="btn btn-success btn-sm text-light" onclick="$('#etiket_id').val('<?= $etiket->etiket_id ?>');$('#etiket_adi').val('<?= $etiket->etiket_adi ?>');"><i class="fa fa-edit"></i></a>
													<?php if ($deletePermission == 1) { ?>
													<a href="" data-toggle='modal' data-target='#etiket_Sil' class="btn btn-danger btn-sm text-light" onclick="$('#etiketSil_id').val('<?= $etiket->etiket_id ?>');document.getElementById('etiketSilP').innerHTML='Etiket adı <?= $etiket->etiket_adi ?> olan etiketi silmek istediğinize emin misiniz? Bu etiket ile etiketlenmiş faturalarınız artık etiketsiz olacaktır.';"><i class="fa fa-trash-alt"></i></a>
													<?php } ?>
												</td>
											</tr>
											<?php } ?>
											</tbody>
										</table>
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

		<div id="yeni_etiket" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Yeni Etiket</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url("fatura/etiketEkle"); ?>" method="POST">
							<div class="form-group">
								<label>Etiket Adı <span class="text-danger">*</span> </label>
								<input class="form-control" type="text"  name="etiket_adi" required=""  autocomplete="off" onkeydown="upperCaseF(this)">
							</div>

							<div class="submit-section">
								<button class="btn btn-danger submit-btn">Kaydet</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


		<div id="etiket_Guncelle" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Etiket Güncelle</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url("fatura/etiketGuncelle"); ?>" method="POST">

							<input class="form-control" type="hidden" value="" name="etiket_id" required="" id="etiket_id">

							<div class="form-group">
								<label>Etiket Adı <span class="text-danger">*</span></label>
								<input class="form-control" type="text"  name="etiket_adi" required=""  autocomplete="off" onkeydown="upperCaseF(this)" id="etiket_adi">
							</div>

							<div class="submit-section">
								<button class="btn btn-danger submit-btn">Kaydet</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div id="etiket_Sil" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Etiket Sil</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url("fatura/etiketSil"); ?>" method="POST">

							<input class="form-control" type="hidden" value="" name="etiket_id" required="" id="etiketSil_id">

							<p id="etiketSilP"></p>
							<div class="submit-section">
								<button class="btn btn-danger submit-btn">Kaydet</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>



<?php if ($this->session->flashdata('etiket_ekle_basarili')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success",
  text: "Etiket ekleme işlemi başarılı.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

		<?php if ($this->session->flashdata('etiket_guncelle_basarili')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "Etiket güncelleme işlemi başarılı.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('etiket_silme_basarili')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "Etiket silme işlemi başarılı.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>
		<?php if ($this->session->flashdata('etiket_mevcut')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "Etiket mevcuttur.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php $this->load->view("include/footer-js"); ?>
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

	<script>
		function upperCaseF(a){
			setTimeout(function(){
				a.value = a.value.toUpperCase();
			}, 1);
		}
	</script>

	</body>
</html>
