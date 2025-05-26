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
								<h3 class="page-title">Admin</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Admin</li>
									<li class="breadcrumb-item active">Modül Yönetimi</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->

					<?php
						$firma = $this->input->get("kullanici");

						$firmaQ = "SELECT * from ayarlar WHERE ayarlar_id = '$firma'";
						$firmaexe = $this->db->query($firmaQ)->row();

						$firmaAdi = $firmaexe->ayarlar_firmaAd;

						$firmaModulleriQ = "SELECT * FROM firmaModulleri INNER JOIN moduller ON firmaModulleri.firmaModul_moduleID = moduller.modul_id WHERE firmaModulleri.firmaModul_firmaID = '$firma'";
						$firmaModulleri = $this->db->query($firmaModulleriQ)->result();
					?>

					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Modül Yönetimi (<?= $firmaAdi;?>)</h4>
									<b>Aktif modülleri:</b> <?php
										foreach($firmaModulleri as $fm){
											echo $fm->modul_ad." <a href='modul_sil?modul=$fm->firmaModul_id'>x</a> ";

										}
									?>
									<hr>
									<form action="<?= base_url("admin/modul_olustur"); ?>" method="POST" id="frm">
										<input type="hidden" name="firma" value="<?= $firma; ?>">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Modül listesi</label>
													<select class="form-control select" name="module" required>
														<option value="">Modül seçiniz...</option>
														<?php foreach($moduller as $modul){?>
														<option value="<?= $modul->modul_id; ?>"><?= $modul->modul_ad;?></option>
														<?php }?>
													</select>
												</div>
											</div>
										</div>
										<button type="submit" class="btn btn-danger" style="width:100%;" id="submitBtn">Kaydet</button>
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
			<?php if ($this->session->flashdata('firma_modul_ok')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "success",
			  text: "Modül başarılı bir şekilde eklendi.",
			  confirmButtonText:'Tamam',
			  button: false,
			  timer: 5000,
			});
			</script>
			<?php endif; ?>

			<?php if ($this->session->flashdata('firma_modul_already_existed')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "Modül zaten bu firma için eklenmiş.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
			<?php endif; ?>

		<?php if ($this->session->flashdata('firma_modul_sil')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "Firma için ilgili modül silindi.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>




		<?php $this->load->view("include/footer-js"); ?>

	</body>
</html>
