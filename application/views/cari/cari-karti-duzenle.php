<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<?php

$firmaID = getirFirma();
$firma_ID = $firmaID->ayarlar_id;

$modulSorgula = modulSorgula($firma_ID, 1);
?>
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
								<h3 class="page-title">Cari</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Cari</li>
									<li class="breadcrumb-item active">Cari Kartı Düzenle</li>
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
						$cariGruplariQ = "SELECT * FROM cariGruplari WHERE cariGrup_olusturanAnaHesap = '$anaHesap'";
						$cariGruplari = $this->db->query($cariGruplariQ)->result();

						$bireysel = $cari->cari_bireysel;
					?>
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Temel Cari Bilgileri<span style="float:right;<?php if($cari->cari_alias_pk){echo "display:block;";}else{echo "display:none;";} ?>" id="mukellef_mark">e-Fatura Mükellefidir <i class="fa fa-check-circle text-success"></i></span></h4>
									<form action="<?= base_url("cari/mevcutCariKartiDuzenle"); ?>" method="POST">
										<input type="hidden" value="<?= $cari->cari_id; ?>" name="cari_id">
<?php
	if($cari->cari_vergiNumarasi!=null)
		$cari_vergiNumarasi=$cari->cari_vergiNumarasi;
	else
		$cari_vergiNumarasi=$cari->cari_tckn;
?>
										<div class="row">
    								    	<div class="col-md-12">
    											<div class="form-group">
    												<label>Cari Tipi</label>
    												<select class="form-control select" name="cari_bireysel" required="" id="cariBireysel">
    													<option value="">Seçiniz...</option>
    													<option value="1" <?php if($bireysel == 1){echo "selected";} ?>>Bireysel Müşteri</option>
    													<option value="0" <?php if($bireysel != 1){echo "selected";} ?>>Kurumsal Müşteri</option>
    													<option value="2" <?php if($bireysel == 2){echo "selected";} ?>>Diğer</option>
    												</select>
    											</div>
											</div>
										</div>
										<div class="row" id="cari_input">
								            	<div class="col-md-4">
        											<div class="form-group">
        												<label>TC Kimlik Numarası / Vergi Numarası</label>
        												<input type="number" class="form-control" required
        													   name="cari_vergiNumarasi"
        													   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
        													   maxlength="11" id="vergiNumarasi" autocomplete="off" value="<?= $cari_vergiNumarasi ?>" <?php if($bireysel == 2) echo "readonly";?>>
														<img
        														src="/assets/img/Eclipse-1s-200px.gif"
        														style="position: absolute; right:15px; bottom: 113px; width:40px; display:none;"
        														id="loading-image"/>
        											</div>
											        <div class="form-group">
												        <label>Vergi Dairesi</label>
											            <input type="text" class="form-control" name="cari_vergiDairesi" id="vergiDairesi" autocomplete="off"  value="<?= $cari->cari_vergiDairesi;?>">
											        </div>
										        </div>
									        	<div class="col-md-4">
									        	    <div class="form-group">
        												<label>Cari Kodu</label>
        												<input type="text" class="form-control" name="cari_kodu" id="cari_kodu"
        													   required="" value="<?= $cari->cari_kodu;?>"
        													   autocomplete="off" required>
        											</div>
        											<div class="form-group">
        												<label>Cari Adı</label>
        												<input type="text" class="form-control" name="cari_ad" required
        													   autocomplete="off" id="cariAd" value="<?= $cari->cari_ad;?>">
        											</div>
								        	    </div>
        										<div class="col-md-4">
        										    <div class="form-group">
        												<label>Cari Grup</label>
        												<select class="select" name="cari_cariGrupKoduID" id="cariGrupKodu">
        													<option value="0">Seçiniz...</option>
        														<?php foreach($cariGruplari as $cg){ ?>
        															<option value="<?= $cg->cariGrup_id?>" <?php if($cg->cariGrup_id == $cari->cari_cariGrupKoduID){echo "selected";} ?>><?= $cg->cariGrup_kodu; ?> (<?= $cg->cariGrup_ad; ?>)</option>
        														<?php }?>
        												</select>
        											</div>
        											<div class="form-group" id="c_soyad" <?php if($cari->cari_soyad==null) echo 'style="display: none;"';?>>
        												<label>Cari Soyadı</label>
        												<input type="text" class="form-control" name="cari_soyad" id="cariSoyad" value="<?= $cari->cari_soyad;?>"
        													   autocomplete="off"  >
        											</div>
        										</div>
									    </div>
								<!--
									<div class="row">
											<div class="col-md-4">
												<input type="hidden" name="cari_alias_pk" id="alias_pk" value="<?= $cari->cari_alias_pk;?>">
												<div class="form-group">
													<label>Cari Adı</label>
													<input type="text" class="form-control" name="cari_ad" value="<?= $cari->cari_ad;?>" required="" autocomplete="off" id="cariAd">
												</div>
												<div class="form-group" id="c_vkn">
													<label>Vergi Numarası</label>
													<input type="number" class="form-control" name="cari_vergiNumarasi" value="<?= $cari->cari_vergiNumarasi;?>"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" id="vergiNumarasi" autocomplete="off"><img src="/assets/img/Eclipse-1s-200px.gif" style="position: absolute; right:15px; bottom:20px; width:40px; display:none;" id="loading-image"/>
												</div>
												<div class="form-group" style="display:none;" id="c_soyad">
													<label>Cari Soyadı</label>
													<input type="text" class="form-control" name="cari_soyad" id="cariSoyad" value="<?= $cari->cari_soyad;?>" autocomplete="off">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Cari Kodu</label>
													<input type="text" class="form-control" name="cari_kodu" value="<?= $cari->cari_kodu;?>" required="" autocomplete="off">
												</div>
												<div class="form-group" id="c_vd">
													<label>Vergi Dairesi</label>
													<input type="text" class="form-control" name="cari_vergiDairesi" value="<?= $cari->cari_vergiDairesi;?>" autocomplete="off">
												</div>
												<div class="form-group" style="display:none;" id="c_tckn">
													<label>TC Kimlik Numarası</label>
													<input type="number" class="form-control" name="cari_tckn" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" id="tckn" value="<?= $cari->cari_tckn;?>" autocomplete="off">
												</div>


											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Cari Tipi</label>
													<select class="select" name="cari_bireysel" required="" id="cariBireysel">
														<option value="">Seçiniz...</option>
														<option value="1" <?php if($bireysel == 1){echo "selected";} ?>>Bireysel Müşteri</option>
														<option value="0" <?php if($bireysel != 1){echo "selected";} ?>>Kurumsal Müşteri</option>
														<option value="2" <?php if($bireysel == 2){echo "selected";} ?>>Diğer</option>
													</select>
												</div>

												<div class="form-group">
													<label>Cari Grup Kodu</label>
													<select class="select" name="cari_cariGrupKoduID" required="">
														<option value="">Seçiniz...</option>
														<?php foreach($cariGruplari as $cg){ ?>
															<option value="<?= $cg->cariGrup_id?>" <?php if($cg->cariGrup_id == $cari->cari_cariGrupKoduID){echo "selected";} ?>><?= $cg->cariGrup_kodu; ?> (<?= $cg->cariGrup_ad; ?>)</option>
														<?php }?>
													</select>
												</div>
											</div>
										</div>-->

									<h4 class="card-title mt-4">Cari İletişim Bilgileri</h4>
										<div class="row">
											<div class="col-md-6">

									<?php 					
											if ($_iller != false):
											echo '<div class="form-group">
												<label>İl</label>
												<select id="il" name="cari_il" data-plugin-selectTwo class="select ajaxIller" required>
												<option value="">Seçiniz</option>';


											foreach ($_iller as $item) {
												echo $item->id;
														if($item->id == $cari->cari_il) {$degisken = "selected";}else{$degisken ="";}
														echo '<option value="'. $item->id .'" '.$degisken.'>'. $item->il .'</option>';
													}

												
											echo '</select></div>';
											else:
												echo 'Kayıtlı İl Bulunamadı..!';
											endif;
									?>

												<div class="form-group">
													<label>Web sitesi</label>
													<input type="text" class="form-control" name="cari_websitesi" value="<?= $cari->cari_websitesi;?>" autocomplete="off">
												</div>

												<div class="form-group">
													<label>Şirket e-Posta</label>
													<input type="email" class="form-control" <?php if($modulSorgula) echo "required";?> name="cari_firmaEPosta" value="<?= $cari->cari_firmaEPosta;?>" autocomplete="off" id="cari_eposta">
												</div>

												<div class="form-group">
													<label>Firma Telefon</label>
													<input type="text" class="form-control" name="cari_firmaTelefon"
												   autocomplete="off"
												   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
												   maxlength="10" <?php if($modulSorgula) echo "required";?> value="<?= $cari->cari_firmaTelefon;?>">

												</div>
											</div>
											<div class="col-md-6">
												<div class="ilceler">
														<div class="form-group">
															<label>İlçe</label>
																<select id="ilce" name="cari_ilce" class="select" required>
																	<option value="">İl Seçiniz</option>
																</select>
														</div>
												</div>	
												<div class="form-group">
													<label>Adres</label>
													<textarea rows="9" cols="5" class="form-control" placeholder="Adres bilgisi giriniz..." name="cari_adres"><?= $cari->cari_adres;?></textarea>
												</div>
											</div>
										</div>
										
										<button type="submit" class="btn btn-danger" style="width:100%;" id="duzenleBtn">Düzenle</button>
									</form>

									<hr>

									<div class="row">
										<div class="col">
											<h5 class="card-title">Detaylı İletişim Bilgileri</h5>
										</div>
										<div class="col-auto">
											<a href="javascript:void(0);" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#add_category">Yeni İletişim Bilgisi Ekle</a>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
												
											<div class="table-responsive">
												<table class="table table-striped custom-table mb-0">
													<thead>
														<tr>
															<th>Ad Soyad</th>
															<th>Görevi</th>
															<th>e-Posta</th>
															<th>Telefon</th>
															<th class="text-right">İşlem</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach($detaylıIletisim as $detayli){?>
															<tr>
																<td><?php echo $detayli->cdetay_ad." ".$detayli->cdetay_soyad; ?></td>
																<td><?= $detayli->cdetay_gorevi; ?></td>
																<td><?= $detayli->cdetay_eposta; ?></td>
																<td><?= $detayli->cdetay_telefon; ?></td>
																<td class="text-right">
																	<a href="#" data-toggle="modal" data-target="#edit_category" data-id="<?=$detayli->cdetay_id; ?>" data-isim="<?=$detayli->cdetay_ad; ?>" data-soyad="<?=$detayli->cdetay_soyad; ?>" data-gorev="<?=$detayli->cdetay_gorevi; ?>" data-eposta="<?=$detayli->cdetay_eposta; ?>" data-telefon="<?=$detayli->cdetay_telefon; ?>" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Düzenle</a> 

																	<a href="<?= base_url("cari/cariDetayliIletisimSil/$detayli->cdetay_id"); ?>" class="btn btn-sm btn-white text-danger mr-2" onclick="return confirm('Silmek istediğiniz emin misiniz?')"><i class="far fa-trash-alt mr-1"></i>Sil</a>
																</td>
															</tr>
														<?php }	?>
													</tbody>
												</table>
											</div>


										</div>
									</div>

									<hr>

									<div class="row">
										<div class="col">
											<h5 class="card-title">Detaylı Banka Bilgileri</h5>
										</div>
										<div class="col-auto">
											<a href="javascript:void(0);" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#add_category2">Yeni Banka Bilgisi Ekle</a>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
												
											<div class="table-responsive">
												<table class="table table-striped custom-table mb-0">
													<thead>
														<tr>
															<th>Banka Adı</th>
															<th>Hesap Adı</th>
															<th>Hesap No</th>
															<th>IBAN</th>
															<th class="text-right">İşlem</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach($detayliBanka as $detayliBnk){?>
															<tr>
																<td><?= $detayliBnk->cdetayBanka_bankaAdi; ?></td>
																<td><?= $detayliBnk->cdetayBanka_hesapAdi; ?></td>
																<td><?= $detayliBnk->cdetayBanka_hesapNo; ?></td>
																<td><?= $detayliBnk->cdetayBanka_iban; ?></td>
																<td class="text-right">
																	<a href="#" data-toggle="modal" data-target="#edit_category2" data-id="<?=$detayliBnk->cdetayBanka_id; ?>" data-banka="<?=$detayliBnk->cdetayBanka_bankaAdi; ?>" data-hesap="<?=$detayliBnk->cdetayBanka_hesapAdi; ?>" data-no="<?=$detayliBnk->cdetayBanka_hesapNo; ?>" data-iban="<?=$detayliBnk->cdetayBanka_iban; ?>" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i> Düzenle</a> 

																	<a href="<?= base_url("cari/cariDetayliBankaSil/$detayliBnk->cdetayBanka_id"); ?>" class="btn btn-sm btn-white text-danger mr-2" onclick="return confirm('Silmek istediğiniz emin misiniz?')"><i class="far fa-trash-alt mr-1"></i>Sil</a>
																</td>
															</tr>
														<?php }	?>
													</tbody>
												</table>
											</div>


										</div>
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
					<div id="add_category" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Yeni İletişim Bilgisi Ekle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("cari/cariDetayliIletisimEkle"); ?>" method="POST">
										<div class="form-group">
											<label>Ad:</label>
											<input class="form-control" type="text" name="cdetay_ad">
										</div>
										<div class="form-group">
											<label>Soyad:</label>
											<input class="form-control" type="text" name="cdetay_soyad">
										</div>
										<div class="form-group">
											<label>Görevi:</label>
											<input class="form-control" type="text" name="cdetay_gorevi">
										</div>
										<div class="form-group">
											<label>e-Posta:</label>
											<input class="form-control" type="email" name="cdetay_eposta">
										</div>
										<div class="form-group">
											<label>Telefon:</label>
											<input class="form-control" type="number" name="cdetay_telefon" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
										</div>
										<?php 
											$urisi = $this->uri->segment(3);
										?>
										<input type="hidden" name="cdetay_cariID" value="<?=$urisi;?>">
										<div class="submit-section">
											<button class="btn btn-danger submit-btn">Ekle</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- /Add Category Modal -->

				<!-- Add Category Modal -->
					<div id="add_category2" class="modal custom-modal fade" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Yeni Banka Bilgisi Ekle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("cari/cariDetayliBankaEkle"); ?>" method="POST">
										<div class="form-group">
											<label>Banka Adı:</label>
											<input class="form-control" type="text" name="cdetayBanka_bankaAdi">
										</div>
										<div class="form-group">
											<label>Hesap Adı:</label>
											<input class="form-control" type="text" name="cdetayBanka_hesapAdi">
										</div>
										<div class="form-group">
											<label>Hesap No:</label>
											<input class="form-control" type="text" name="cdetayBanka_hesapNo">
										</div>
										<div class="form-group">
											<label>IBAN:</label>
											<input class="form-control" type="text" name="cdetayBanka_iban" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="26" value="TR">
										</div>
										<?php 
											$urisi = $this->uri->segment(3);
										?>
										<input type="hidden" name="cdetayBanka_cariID" value="<?=$urisi;?>">
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
									<h5 class="modal-title">Mevcut İletişim Bilgisini Düzenle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("cari/cariDetayliIletisimDuzenle"); ?>" method="POST">
										<input type="hidden" name="cdetay_id" id="cdetay_id">
										<div class="form-group">
											<label>Ad:</label>
											<input class="form-control" type="text" id="cdetay_ad" name="cdetay_ad">
										</div>
										<div class="form-group">
											<label>Soyad:</label>
											<input class="form-control" type="text" id="cdetay_soyad" name="cdetay_soyad">
										</div>
										<div class="form-group">
											<label>Görevi:</label>
											<input class="form-control" type="text" id="cdetay_gorevi" name="cdetay_gorevi">
										</div>
										<div class="form-group">
											<label>e-Posta:</label>
											<input class="form-control" type="email" id="cdetay_eposta" name="cdetay_eposta">
										</div>
										<div class="form-group">
											<label>Telefon:</label>
											<input class="form-control" type="number" id="cdetay_telefon" name="cdetay_telefon" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11">
										</div>
										<div class="submit-section">
											<button class="btn btn-danger submit-btn" id="gnclBTN">Güncelle</button>
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
									<h5 class="modal-title">Mevcut Banka Bilgisini Düzenle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url("cari/cariDetayliBankaDuzenle"); ?>" method="POST">
										<input type="hidden" name="cdetayBanka_id" id="cdetayBanka_id">
										<div class="form-group">
											<label>Banka Adı:</label>
											<input class="form-control" type="text" id="cdetayBanka_bankaAdi" name="cdetayBanka_bankaAdi">
										</div>
										<div class="form-group">
											<label>Hesap Adı:</label>
											<input class="form-control" type="text" id="cdetayBanka_hesapAdi" name="cdetayBanka_hesapAdi">
										</div>
										<div class="form-group">
											<label>Hesap No:</label>
											<input class="form-control" type="text" id="cdetayBanka_hesapNo" name="cdetayBanka_hesapNo">
										</div>
										<div class="form-group">
											<label>IBAN:</label>
											<input class="form-control" type="text" id="cdetayBanka_iban" name="cdetayBanka_iban">
										</div>
										<div class="submit-section">
											<button class="btn btn-danger submit-btn">Güncelle</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					
<?php if ($this->session->flashdata('cari_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Yeni cari kartı başarılı bir şekilde oluşturuldu.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_detayli_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "İletişim bilgileri başarılı bir şekilde eklendi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_detayli_banka_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Banka bilgileri başarılı bir şekilde eklendi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_update_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Cari Kartı başarılı bir şekilde güncellendi.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_update_carikoduvar')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "error", 
  text: "Güncellemeye çalıştığınız cari kodu mevcut, lütfen farklı bir cari kodu ile tekrar deneyiniz",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_detayli_sil')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "İletişim bilgisi başarılı olarak silinmiştir.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_detayli_banka_sil')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Banka bilgisi başarılı olarak silinmiştir.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_detay_update_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Detaylı iletişim bilgileri güncellenmiştir.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('cari_detay_banka_update_ok')): ?>
<script>
swal({
  title: "Bilgilendirme",
  type: "success", 
  text: "Detaylı banka bilgileri güncellenmiştir.",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

		<?php if ($this->session->flashdata('cari_kodu_3_karakter')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "Cari kodu en az 3 karakter olmalıdır. Tekrar deneyiniz.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('cari_kodu_vergino')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "Aynı vergi numarasına ait cari kayıt edilemez. Tekrar deneyiniz.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('cari_kodu_vkn_karakter')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "VKN 10 haneli olmalıdır. Tekrar deneyiniz.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>
		<?php if ($this->session->flashdata('cari_kodu_tckn_karakter')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "TCKN 11 haneli olmalıdır. Tekrar deneyiniz.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

<?php 
	$ilceid = $cari->cari_ilce;
	$array1 = array($ilceid);
	$res1 = json_encode($array1);

	$cariTipi = $bireysel;
?>

<?php $this->load->view("include/footer-js"); ?>

		<script>
			$(document).ready(function() {
				var cariTipi = <?php echo $cariTipi; ?>;
					var vkn=$("#vergiNumarasi").val();
					if(vkn.length==11 && cariTipi!=2)
					{
						$("#vergiDairesi").prop('required',false);
						$("#vergiNumarasi").prop('required',false);
						$("#c_vd").css("display", "none");
						$("#c_vkn").css("display", "none");
						$("#c_soyad").css("display", "block");
						$("#c_tckn").css("display", "block");
						$("#cariSoyad").prop('required',true);
					}
					else if(vkn.length==10 && cariTipi!=2)
					{
						$("#cariSoyad").prop('required',false);
						$("#tckn").prop('required',false);
						$("#c_soyad").css("display", "none");
						$("#c_tckn").css("display", "none");
						$("#c_vd").css("display", "block");
						$("#c_vkn").css("display", "block");
						$("#vergiDairesi").prop('required',true);
						$("#vergiNumarasi").prop('required',true);
					}
					else {

						$("#vergiDairesi").prop('required',false);
						$("#cariSoyad").prop('required',false);
						$("#c_soyad").css("display", "none");
					}
			});

			/*	if(cariTipi == 1){
					//bireysel müşteri soyad ve tc kimlik açılacak
					$("#vergiDairesi").prop('required',false);
					$("#vergiNumarasi").prop('required',false);
					$("#c_vd").css("display", "none");
					$("#c_vkn").css("display", "none");
					$("#c_soyad").css("display", "block");
					$("#c_tckn").css("display", "block");
					$("#cariSoyad").prop('required',true);
					$("#tckn").prop('required',true);
				}else if(cariTipi == 0){
					//kurumsal müşteri vergi dairesi ve vergi numarası
					$("#cariSoyad").prop('required',false);
					$("#tckn").prop('required',false);
					$("#c_soyad").css("display", "none");
					$("#c_tckn").css("display", "none");
					$("#c_vd").css("display", "block");
					$("#c_vkn").css("display", "block");
					$("#vergiDairesi").prop('required',true);
					$("#vergiNumarasi").prop('required',true);
				}else if(cariTipi == 2){
					//kurumsal müşteri vergi dairesi ve vergi numarası
					$("#vergiDairesi").prop('required',false);
					$("#vergiNumarasi").prop('required',false);
					$("#c_vd").css("display", "none");
					$("#c_vkn").css("display", "none");
					$("#c_soyad").css("display", "block");
					$("#c_tckn").css("display", "block");
				}
			});
*/
			$("#cariBireysel").on('change',function(){
				var status = $( "#cariBireysel option:selected" ).text();

				if(status == "Bireysel Müşteri"){
					$("#vergiDairesi").prop('required',false);
					$("#vergiNumarasi").prop('required',false);

					//$("#vergiDairesi").val("");
					//$("#vergiNumarasi").val("");

					$("#c_vd").css("display", "none");
					$("#c_vkn").css("display", "none");

					$("#c_soyad").css("display", "block");
					$("#c_tckn").css("display", "block");

					$("#cariSoyad").prop('required',true);
					$("#tckn").prop('required',true);
					$("#vergiNumarasi").prop('readonly', false);
				}else if(status == "Kurumsal Müşteri"){
					$("#cariSoyad").prop('required',false);
					$("#tckn").prop('required',false);

					//$("#cariSoyad").val("");
					//$("#tckn").val("");

					$("#c_soyad").css("display", "none");
					$("#c_tckn").css("display", "none");

					$("#c_vd").css("display", "block");
					$("#c_vkn").css("display", "block");

					$("#vergiDairesi").prop('required',true);
					$("#vergiNumarasi").prop('required',true);
					$("#vergiNumarasi").prop('readonly', false);
				}else if(status == "Diğer"){
					$("#vergiDairesi").prop('required',false);
					$("#vergiNumarasi").prop('required',false);

					$("#vergiNumarasi").prop('readonly', true);
					$("#vergiNumarasi").val("11111111111");


					$("#cariSoyad").prop('required',false);

					$("#c_soyad").css("display", "block");
				}

			});
		</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script>
			toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": false,
		"progressBar": true,
		"positionClass": "toast-top-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};


	/*$("#vergiNumarasi").on('blur', function () {
		let str = $("#vergiNumarasi").val();
		if (str.length == 11) {
			$("#c_soyad").css("display", "block");
			$("#cariSoyad").prop('required', true);
			$("#vergiDairesi").prop('required', false);
		} else {

			$("#vergiDairesi").prop('required', true);
			$("#c_soyad").css("display", "none");
			$("#cariSoyad").prop('required', false);
		}

		if (str.length == 10 || str.length == 11) {
			$.ajax({
				url: "<?= env('BASE_URL'); ?>/Edonusum/Auth/CheckUser",
				method: "POST",
				data: {vergiNumarasi: str},
				dataType: 'json',
				beforeSend: function () {
					$("#loading-image").show();
					$(':input[type="submit"]').prop('disabled', true);
				},
				success: function (result) {
					console.log(result);
					let alias = result.alias;
					//let identifier = result.identifier;
					let title = result.title;
					if (alias != null) {
						if(str.length == 11)
						{
							$("#c_soyad").css("display", "block");
							var titleSplit=title.trim().split(' ');
							$("#cariSoyad").val(titleSplit[titleSplit.length-1]);
							var ad="";
							for(var i=0;i<titleSplit.length-1;i++)
							{
								ad+=titleSplit[i]+ " ";
							}
							$("#cariAd").val(ad.trim());
							$('#cariSoyad').prop('disabled', true);
							$('#cariAd').prop('disabled', true);
						}
						else
							$("#cariAd").val(title);
						$("#alias_pk").val(alias);
						$("#mukellef_mark").css("display", "block");

					} else {
						//$("#cariAd").val("");
						$("#alias_pk").val("");
						//$('#myForm').trigger("reset");
						$("#mukellef_mark").css("display", "none");
					}
					$(':input[type="submit"]').prop('disabled', false);
					$("#loading-image").hide();
				}
			});
		}
	});*/

			$("#vergiNumarasi").on('blur', function () {

				let str = $("#vergiNumarasi").val();

				$("#cariSoyad").val("");
				$("#cariAd").val("")
				if (str.length == 11) {
					$("#c_soyad").css("display", "block");
					$("#cariSoyad").prop('required', true);
					$("#vergiDairesi").prop('required', false);
				} else {

					$("#vergiDairesi").prop('required', true);
					$("#c_soyad").css("display", "none");
					$("#cariSoyad").prop('required', false);
				}

				if (str.length == 10 || str.length == 11) {
					$.ajax({
						url: "<?= env('BASE_URL'); ?>/Cari/gibVknTcknSorgula",
						method: "POST",
						data: {vergiNumarasi: str},
						dataType: 'json',
						beforeSend: function () {
							$("#loading-image").show();
							$(':input[type="submit"]').prop('disabled', true);
						},
						success: function (result) {
							;
							if (str.length == 11) {
								let ad = result.ad;
								let soyad = result.soyad;
								$("#c_soyad").css("display", "block");
								$("#cariAd").val(ad);
								$("#cariSoyad").val(soyad);
							} else {
								$("#c_soyad").css("display", "none");
								$("#cariAd").val(result.unvan);
							}

							$(':input[type="submit"]').prop('disabled', false);
							$("#loading-image").hide();
						}
					});

					<?php if($modulSorgula) { ?>
					$.ajax({
						url: "<?= env('BASE_URL'); ?>/Edonusum/Auth/CheckUser",
						method: "POST",
						data: {vergiNumarasi: str},
						dataType: 'json',
						beforeSend: function () {
							$("#loading-image").show();
							$(':input[type="submit"]').prop('disabled', true);
						},
						success: function (result) {
							let alias = result.alias;
							if (alias != null) {
								$("#alias_pk").val(alias);
								$("#mukellef_mark").css("display", "block");

							} else {
								$("#alias_pk").val("");
								$("#mukellef_mark").css("display", "none");
							}
							$(':input[type="submit"]').prop('disabled', false);
							$("#loading-image").hide();
						}
					});
					<?php } ?>



				}
			});



			$("#cari_eposta").on('blur', function () {
		var eposta= $("#cari_eposta").val();
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(!regex.test(eposta)) {

			toastr.warning("Geçerli bir e-posta giriniz.");

			if(document.getElementById("cari_eposta").required == true)
			$("#duzenleBtn").prop('disabled', true);
		}
		else {

			$("#duzenleBtn").prop('disabled', false);
		}
	});
		</script>

	<script>
		$(document).ready(function(){
				
				var il_id = $('.ajaxIller').val();
				var ilce_id = <?php echo $res1; ?>;
                var base_url = "<?php echo base_url();?>";
				
				$.post(base_url+'home/get_ilceler', {il_id : il_id}, function(result){
					if ( result && result.status != 'error' )
					{
						var ilceler = result.data;
						var select = '<div class="ilceler"><div class="form-group"><label>İlçe</label><select id="ilce" name="cari_ilce" class="form-control select" required>';
						for( var i = 0; i < ilceler.length; i++)
						{
							if(ilceler[i].id == ilce_id){
								var sec = "selected";
							}else { var sec = "";}
							
							select += '<option value="'+ ilceler[i].id +'" '+sec+'>'+ ilceler[i].ilce +'</option>';
						}
						select += '</select></div></div>';
						$('div.ilceler').empty().html(select);
					}
					else
					{
						alert('Hata : ' + result.message );
					}					
				});
		});
	</script>
	<script>
		$(document).ready(function(){
			$('.ajaxIller').on('change', function(e){
                var base_url = "<?php echo base_url();?>";
				var il_id = $(this).val();
				$.post(base_url+'home/get_ilceler', {il_id : il_id}, function(result){
					if ( result && result.status != 'error' )
					{
						var ilceler = result.data;
						var select = '<div class="ilceler"><div class="form-group"><label>İlçe</label><select id="ilce" name="cari_ilce" class="form-control select" required>';
						for( var i = 0; i < ilceler.length; i++)
						{
							select += '<option value="'+ ilceler[i].id +'">'+ ilceler[i].ilce +'</option>';
						}
						select += '</select></div></div>';
						$('div.ilceler').empty().html(select);
					}
					else{
						alert('Hata : ' + result.message );
					}					
				});
			});
		});
	</script>

	<script>
	$('#edit_category').on('show.bs.modal', function (event) {
		  let id = $(event.relatedTarget).data('id') 
		  let isim = $(event.relatedTarget).data('isim') 
		  let soyad = $(event.relatedTarget).data('soyad') 
		  let gorev = $(event.relatedTarget).data('gorev') 
		  let eposta = $(event.relatedTarget).data('eposta') 
		  let telefon = $(event.relatedTarget).data('telefon') 
		  
		  $(this).find('.modal-body #cdetay_id').val(id)
		  $(this).find('.modal-body #cdetay_ad').val(isim)
		  $(this).find('.modal-body #cdetay_soyad').val(soyad)
		  $(this).find('.modal-body #cdetay_gorevi').val(gorev)
		  $(this).find('.modal-body #cdetay_eposta').val(eposta)
		  $(this).find('.modal-body #cdetay_telefon').val(telefon)
		})
	</script>

	<script>
	$('#edit_category2').on('show.bs.modal', function (event) {
		  let id = $(event.relatedTarget).data('id') 
		  let banka = $(event.relatedTarget).data('banka') 
		  let hesap = $(event.relatedTarget).data('hesap') 
		  let no = $(event.relatedTarget).data('no') 
		  let iban = $(event.relatedTarget).data('iban') 
		  
		  $(this).find('.modal-body #cdetayBanka_id').val(id)
		  $(this).find('.modal-body #cdetayBanka_bankaAdi').val(banka)
		  $(this).find('.modal-body #cdetayBanka_hesapAdi').val(hesap)
		  $(this).find('.modal-body #cdetayBanka_hesapNo').val(no)
		  $(this).find('.modal-body #cdetayBanka_iban').val(iban)
		})
	</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#il").select2({
			width: '100%'
		});

		$("#cariGrupKodu").select2({
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

