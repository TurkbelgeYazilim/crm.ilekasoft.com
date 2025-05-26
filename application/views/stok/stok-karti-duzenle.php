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
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Stok</li>
									<li class="breadcrumb-item active">Stok Kartı</li>
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
									<h4 class="card-title">Temel Stok Bilgileri</h4>
									<form action="<?= base_url("stok/mevcutStokKartiDuzenle"); ?>" method="POST">
										<input type="hidden" name="stok_id" value="<?=$stok->stok_id;?>">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Stok Kodu</label>
													<input type="text" class="form-control" value="<?= $stok->stok_kodu; ?>" name="stok_kodu" required="">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Stok Adı</label>
													<input type="text" class="form-control" value="<?= $stok->stok_ad; ?>" name="stok_ad" required="" autocomplete="off">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Stok Barkodu</label>
													<input type="text" class="form-control" value="<?= $stok->stok_barkod; ?>" name="stok_barkod">
												</div>
											</div>
										</div>
									<h4 class="card-title mt-4">Stok Bilgileri</h4>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Grup Kodu</label>
													<select name="stok_stokGrupKoduID" class="select form-control" required="">
														<option value="">Grup Kodu seçiniz...</option>
														<?php foreach($stokGruplari as $sg){?>
															<option value="<?= $sg->stokGrup_id?>" <?php if($sg->stokGrup_id == $stok->stok_stokGrupKoduID){echo "selected";}?>><?=$sg->stokGrup_kodu;?> (<?= $sg->stokGrup_ad; ?>)</option>
														<?php }?>
													</select>
												</div>
												<div class="form-group">
													<label>Alış Fiyatı</label>
													<input type="number" step="0.01" class="form-control" value="<?= $stok->stok_alisFiyati; ?>" name="stok_alisFiyati">
												</div>
												<div class="form-group">
													<label>Satış Fiyatı</label>
													<input type="number" step="0.01" class="form-control" value="<?= $stok->stok_satisFiyati; ?>" name="stok_satisFiyati">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Birim</label>
													<select name="stok_birimID" class="select form-control" required="" id="stokBirim">
														<option value="">Stok Birimi seçiniz...</option>
														<?php foreach($stokBirimleri as $sb){?>
															<option value="<?= $sb->stokBirim_id?>" <?php if($sb->stokBirim_id == $stok->stok_birimID){echo "selected";}?>><?=$sb->stokBirim_ad;?></option>
														<?php }?>
													</select>
												</div>
												<div class="form-group">
													<label>Alış KDV</label>
													<select name="stok_alisKDV" class="select form-control" required="">
														<option value="">Alış KDV seçiniz...</option>
														<option value="20" <?php if($stok->stok_alisKDV == 20){echo "selected";} ?>>%20</option>
														<option value="10" <?php if($stok->stok_alisKDV == 10){echo "selected";} ?>>%10</option>
														<option value="1" <?php if($stok->stok_alisKDV == 1){echo "selected";} ?>>%1</option>
														<option value="0" <?php if($stok->stok_alisKDV == 0){echo "selected";} ?>>0 (KDV Yok)</option>
													</select>
												</div>
												<div class="form-group">
													<label>Satış KDV</label>
													<select name="stok_satisKDV" class="select form-control" required="">
														<option value="">Alış KDV seçiniz...</option>
														<option value="20" <?php if($stok->stok_satisKDV == 20){echo "selected";} ?>>%20</option>
														<option value="10" <?php if($stok->stok_satisKDV == 10){echo "selected";} ?>>%10</option>
														<option value="1" <?php if($stok->stok_satisKDV == 1){echo "selected";} ?>>%1</option>
														<option value="0" <?php if($stok->stok_satisKDV == 0){echo "selected";} ?>>0 (KDV Yok)</option>
													</select>
												</div>
											</div>



											<div class="col-md-12">
												<div class="form-group">
													<label>Kritik Stok Uyarısı Limiti</label>
													<input type="number" class="form-control" name="stok_kritikSeviyesi" placeholder="Belirtilen rakamın altına düşmesi halinde uyarı mesajı iletişim bilgilerinize gönderilir. Boş bırakılabilir." value="<?= $stok->stok_kritikSeviyesi; ?>">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Stok Açıklama</label>
													<textarea rows="5" cols="5" class="form-control" placeholder="Açıklama bilgisi giriniz..." name="stok_aciklama"><?= $stok->stok_aciklama; ?></textarea>
												</div>
											</div>
										</div>
										<button type="submit" class="btn btn-danger" style="width:100%;">Güncelle</button>
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
		<?php if ($this->session->flashdata('stok_ok')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "success", 
			  text: "Yeni stok kartı başarılı bir şekilde eklendi.",
			  confirmButtonText:'Tamam',
			  button: false,
			  timer: 5000,
			});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('stok_update_ok')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "success", 
			  text: "Mevcut stok kartı başarılı bir şekilde güncellendi.",
			  confirmButtonText:'Tamam',
			  button: false,
			  timer: 5000,
			});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('stok_update_stokkoduvar')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "error", 
			  text: "Güncellemek istediğiniz stok kodu zaten mevcut, tekrar deneyiniz.",
			  confirmButtonText:'Tamam',
			  button: false,
			  timer: 5000,
			});
			</script>
		<?php endif; ?>
		
		<?php $this->load->view("include/footer-js"); ?>

		<script type="text/javascript">
	$(document).ready(function(){
		$("#stokBirim").select2({
			width: '100%'
		});
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
