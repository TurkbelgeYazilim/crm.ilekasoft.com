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

					<?php 
						$anaHesap = anaHesapBilgisi();
						$stokCountQ = "SELECT COUNT(*) as total FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap'";
						$stokCountE = $this->db->query($stokCountQ)->row();
						$stokKacTane = $stokCountE->total+1;
						$stok = str_pad($stokKacTane, 8, '0', STR_PAD_LEFT);
					?>
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Temel Stok Bilgileri</h4>
									<form action="<?= base_url("stok/yeniStokKartiOlustur"); ?>" method="POST">
										<div class="row">

											<div class="col-md-3">
												<div class="form-group">
													<label>Stok Kodu</label>
													<input type="text" class="form-control" value="<?=$stok;?>" name="stok_kodu" required="">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label>Stok Adı</label>
													<input type="text" class="form-control" name="stok_ad" required="" autocomplete="off">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label>Stok Barkodu</label>
													<input type="text" class="form-control" name="stok_barkod">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label>Stok Başlangıç Adedi</label>
													<input type="text" class="form-control" name="stok_baslangic" value="0">
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
															<option value="<?= $sg->stokGrup_id?>"><?=$sg->stokGrup_kodu;?> (<?= $sg->stokGrup_ad; ?>)</option>
														<?php }?>
													</select>
												</div>
												<div class="form-group">
													<label>Alış Fiyatı</label>
													<input type="number" step="0.01" class="form-control" name="stok_alisFiyati">
												</div>
												<div class="form-group">
													<label>Satış Fiyatı</label>
													<input type="number" step="0.01" class="form-control" name="stok_satisFiyati">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Birim</label>
													<select name="stok_birimID" class="select form-control" required="" id="stokBirim">
														<option value="">Stok Birimi seçiniz...</option>
														<?php foreach($stokBirimleri as $sb){?>
															<option value="<?= $sb->stokBirim_id?>"><?=$sb->stokBirim_ad;?> (<?= $sb->stokBirim_kisaltma; ?>)</option>
														<?php }?>
													</select>
												</div>
												<div class="form-group">
													<label>Alış KDV</label>
													<select name="stok_alisKDV" class="select form-control" required="">
														<option value="">Alış KDV seçiniz...</option>
														<option value="20">%20</option>
														<option value="10">%10</option>
														<option value="1">%1</option>
														<option value="0">0 (KDV Yok)</option>
													</select>
												</div>
												<div class="form-group">
													<label>KDV Dahil</label>
													<select name="stok_kdv_dahil" class="select form-control" required>
														<option value="1" selected>KDV Dahil</option>
														<option value="0">KDV Hariç</option>
													</select>
												</div>
												<div class="form-group">
													<label>Satış KDV</label>
													<select name="stok_satisKDV" class="select form-control" required="">
														<option value="">Satış KDV seçiniz...</option>
														<option value="20">%20</option>
														<option value="10">%10</option>
														<option value="1">%1</option>
														<option value="0">0 (KDV Yok)</option>
													</select>
												</div>
											</div>


											<div class="col-md-12">
												<div class="form-group">
													<label>Kritik Stok Uyarısı Limiti</label>
													<input type="number" class="form-control" name="stok_kritikSeviyesi" placeholder="Belirtilen rakamın altına düşmesi halinde uyarı mesajı iletişim bilgilerinize gönderilir. Boş bırakılabilir.">
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label>Stok Açıklama</label>
													<textarea rows="5" cols="5" class="form-control" placeholder="Açıklama bilgisi giriniz..." name="stok_aciklama"></textarea>
												</div>
											</div>
										</div>
										<button type="submit" class="btn btn-danger" style="width:100%;">Kaydet</button>
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
		<?php if ($this->session->flashdata('stok_kodu_mevcut')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "success", 
			  text: "Eklemek istediğiniz stok kodu mevcuttur, tekrar deneyiniz.",
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
