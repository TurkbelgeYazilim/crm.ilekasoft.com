<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
				<style>
	       .ui-autocomplete {
	       		z-index: 999999;
	            max-height: 200px;
	            overflow-y: auto;
	            /* prevent horizontal scrollbar */
	            overflow-x: hidden;
	            /* add padding to account for vertical scrollbar */
	            padding-right: 20px;
	        }
	        .form-group{
	        	margin-bottom: 10px!important;
	        }
	        .card{
	        	.margin-bottom:  0px!important;
	        } 
	        
	        /* Hide Stok Kodu (Stock Code) and Birim (Unit) columns */
			.table th:nth-child(3), /* Stok Kodu header */
			.table td:nth-child(3), /* Stok Kodu data cells */
			.table th:nth-child(6), /* Birim header */
			.table td:nth-child(6) { /* Birim data cells */
				display: none !important;
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
								<h3 class="page-title">Fatura</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Fatura</li>
									<li class="breadcrumb-item active">Alış Faturası Düzenle</li>
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
						$ayarlarQ = "SELECT * FROM ayarlar WHERE ayarlar_id = '$anaHesap' ";
						$ayarlarExe = $this->db->query($ayarlarQ)->row();

						$irsaliyeTarih = $alisFaturasi->alis_irsaliyeTarihi;
						$faturaTarih = $alisFaturasi->alis_faturaTarihi;

						$yeni_irsaliyeTarihi = date("d.m.Y", strtotime($irsaliyeTarih));
						$yeni_faturaTarih = date("d.m.Y", strtotime($faturaTarih));
					?>
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<form action="<?= base_url("fatura/alisFaturasiGuncelle"); ?>" method="POST">
										<input type="hidden" name="kh_id" value="<?= $alisFaturasi->alis_kasaHareketiID; ?>">
										<input type="hidden" name="bh_id" value="<?= $alisFaturasi->alis_bankaHareketiID; ?>">
										<input type="hidden" name="alis_id" value="<?= $alisFaturasi->alis_id; ?>">
										<input type="hidden" name="alis_cariID" id="cari_id" value="<?= $alisFaturasi->alis_cariID; ?>">
										<input type="hidden" name="ch_id" id="ch_id" value="<?= $alisFaturasi->alis_cariHareketiID; ?>">
										<input type="hidden" class="form-control" name="cari_kodu" id="kod_input" required="" value="<?= $cariBilgileri->cari_kodu;?>">





										<div class="row">
										
									<div class="col-md-5">

										<div class="card">
								            <div class="row no-gutters">
								                <div class="d-flex col-sm-5 justify-content-center align-items-center">
								                	<?php if($ayarlarExe->ayarlar_logoName){ ?>
								                    <img class="card-img" alt="logo" src="<?= base_url(); ?>assets/bulut/logo/<?= $ayarlarExe->ayarlar_logoName; ?>">
								                  <?php } ?>
								                </div>
								                <div class="col-sm-7">
								                    <div class="card-body">
								                        <h5 class="card-title" style="cursor:pointer;"><?= $ayarlarExe->ayarlar_firmaAd; ?></h5>
								                        <p class="card-text"><?= $ayarlarExe->ayarlar_adres; ?></p>
								                        <p class="card-text"><?= $ayarlarExe->ayarlar_vergiDairesi; ?> V.D. <?= $ayarlarExe->ayarlar_vergiNo; ?></p>
								                    </div>
								                </div>
								            </div>
								        </div>

											<!-- <h4 class="card-title">Cari Bilgileri</h4> -->

											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-sm-3 text-sm-left pt-2">Cari Adı</label>
													<div class="col-sm-9">
													<input type="text" class="form-control" name="cari_adi" id="name_input" required="" placeholder="Cari adını yazmaya başlayıp, listeden seçiniz." value="<?= $cariBilgileri->cari_ad;?>">
												</div>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-sm-3 text-sm-left pt-2">Adres</label>
													<div class="col-sm-9">
													<!-- <input type="text" class="form-control" name="" id="cari_adres_input" readonly> -->
													<textarea class="form-control" name="" id="cari_adres_input" readonly="" style="resize: none;"><?= $cariBilgileri->cari_adres;?></textarea>
												</div>
												</div>
											</div>

										<div class="col-md-12">
											<div class="form-group row">
												<label class="col-sm-3 text-sm-left pt-2">Para Birimi</label>
												<div class="col-sm-5">
													<select class="form control select" name="alis_paraBirimi" id="alis_paraBirimi">
														<option value="1" <?php if($alisFaturasi->alis_paraBirimi == 1){echo "selected";} ?>>Türk Lirası</option>
														<option value="2" <?php if($alisFaturasi->alis_paraBirimi == 2){echo "selected";} ?>>Amerikan Doları</option>
														<option value="3" <?php if($alisFaturasi->alis_paraBirimi == 3){echo "selected";} ?>>Euro</option>
														<option value="4" <?php if($alisFaturasi->alis_paraBirimi == 4){echo "selected";} ?>>İngiliz Sterlini</option>
													</select>
												</div>
												<div class="col-sm-4">
													<input type="text" name="alis_guncelKur" id="alis_guncelKur" class="form-control" placeholder="Döviz kuru" style="<?php if($alisFaturasi->alis_paraBirimi == 1){echo "display:none;";}else{echo "display:block;";} ?>" value="<?= $alisFaturasi->alis_guncelKur; ?>"/>
												</div>
											</div>
										</div>

										</div>
										<div class="col-md-2">
											
										</div>
										<div class="col-md-5">											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-sm-4 text-sm-left pt-2"><a href="<?= base_url("fatura/goruntule?tipi=alis&id=$alisFaturasi->alis_id"); ?>" target="_blank">Sözleşme No <span style="color: red;">*</span> <i class="fa fa-external-link-alt"></i></a></label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="alis_faturaNo" required="" autocomplete="off" value="<?= $alisFaturasi->alis_faturaNo; ?>">
													</div>
												</div>
											</div>

											<div class="col-md-12">
													<div class="form-group row">
														<label class="col-sm-4 text-sm-left pt-2">Düzenleme Tarihi</label>
														<div class="col-sm-8">
															<input type="text" class="datepicker form-control" name="alis_faturaTarihi" autocomplete="off" required="" value="<?= $yeni_faturaTarih; ?>"/>
														</div>
													</div>
											</div>

											<div class="col-md-12">
													<div class="form-group row">
														<label class="col-sm-4 text-sm-left pt-2">Düzenleme Saati</label>
														<div class="col-sm-8">
														<input type="text" class="form-control" name="alis_faturaSaati" autocomplete="off" required="" id="datetimepicker" value="<?= $alisFaturasi->alis_faturaSaati; ?>"/>
													</div>
													</div>
											</div>

											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-sm-4 text-sm-left pt-2">Vergi Dairesi</label>
													<div class="col-sm-8">
													<input type="text" class="form-control" name="" id="cari_vergiDairesi_input" readonly value="<?= $cariBilgileri->cari_vergiDairesi;?>">
												</div>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-sm-4 text-sm-left pt-2">Vergi Numarası</label>
													<div class="col-sm-8">
													<input type="text" class="form-control" name="" id="cari_vergiNumarasi_input" readonly value="<?= $cariBilgileri->cari_vergiNumarasi;?>">
												</div>
												</div>
											</div>

											<div class="col-md-12">
														<div class="form-group row">
															<label class="col-sm-4 text-sm-left pt-2">İrsaliye No</label>
															<div class="col-sm-8">
															<input type="text" class="form-control" name="alis_irsaliyeNo" autocomplete="off" placeholder="Bu alan opsiyoneldir." value="<?= $alisFaturasi->alis_irsaliyeNo; ?>">
														</div>
														</div>
											</div>

											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-sm-4 text-sm-left pt-2">İrsaliye Tarihi</label>
													<div class="col-sm-8">
													<input type="text" class="datepicker form-control" name="alis_irsaliyeTarihi" autocomplete="off" placeholder="Bu alan opsiyoneldir." value="<?php if($irsaliyeTarih){echo $yeni_irsaliyeTarihi;}else{echo "";} ?>"/>
												</div>
												</div>
											</div>

										</div>
									</div>





									<div class="row">
										<div class="col-md-12">
											<h4 class="card-title mt-4">Stok Bilgisi <i class="fa fa-info-circle fa-xs text-info" data-toggle="tooltip" data-placement="right" title="Tablonun istediğiniz kenarından tutup sürükleyerek ilgili alanı genişletebilir veya daraltabilirsiniz."></i> <a href="javascript:void(0)" class="btn btn-success btn-sm"  onclick="addItem();" style="float:right;" ><i class="fa fa-plus"></i> Yeni Satır Ekle</a></h4>
											<div class="row">
											    <div class="table-responsive">
													<table class="table table-bordered custom-table mb-0">
														<thead>
													        <tr>
													            <th></th>
													            <th>Stok Adı</th>
													            <th>Stok Kodu</th>
													            <th>Barkod</th>
													            <th>Miktar</th>
													            <th>Birim</th>
													            <th>Birim Fiyat <span id="birimFiyatParaBirimi"><?php if($alisFaturasi->alis_paraBirimi == 1){echo "(TL)";}elseif($alisFaturasi->alis_paraBirimi == 2){echo "(USD)";}elseif($alisFaturasi->alis_paraBirimi == 3){echo "(EUR)";}elseif($alisFaturasi->alis_paraBirimi == 4){echo "(GBP)";} ?></span></th>
													            <th>KDV (%)</th>
													            <th>Toplam (TL)</th>
													            <th></th>
													        </tr>
												   		</thead>
												        <tbody id="tbody">
<?php 
$x=1;
	foreach($alisFaturasiStok as $stok){
		$stokidsi = $stok->alisStok_stokID;

    	$stokQ = "SELECT * FROM stok WHERE stok_id = '$stokidsi'";
    	$stokexe = $this->db->query($stokQ)->row();

    	$stokBirim = $stokexe->stok_birimID;

    	$stokBirimQ = "SELECT * FROM stokBirimleri WHERE stokBirim_id = '$stokBirim'";
    	$stokbirimexe = $this->db->query($stokBirimQ)->row();

    	$toplami = $stok->alisStok_miktar * $stok->alisStok_birimFiyat;
?>
	<tr>
		<td><a href='#' class='btn btn-success btn-sm' data-toggle='modal' data-target='#edit_category' data-id='<?= $x; ?>'><i class='fa fa-hand-pointer'></i> Seç</a></td>
		<td><input type='text' class='form-control' name='stokadi[]' id='stokadi<?= $x; ?>' readonly value="<?= $stokexe->stok_ad;?>"></td>
		<td><input type='text' class='form-control' name='stokkodu[]' id='stokkodu<?= $x; ?>' readonly value="<?= $stokexe->stok_kodu;?>"></td>
		<td><input type="hidden" name="alisFaturasiStok_id[]" value="<?= $stok->alisStok_id;?>">
			<input type='hidden' name='stokid[]' id='stokid<?= $x; ?>' value="<?= $stokexe->stok_id;?>">
			<input type='text' class='form-control' name='barkod[]' id='barkod<?= $x; ?>' readonly value="<?= $stokexe->stok_barkod;?>"></td>
		<td><input type='number' step='0.01' class='form-control' autocomplete='off' name='miktar[]' id='miktar<?= $x; ?>' required='' value="<?= $stok->alisStok_miktar; ?>" style="width:175px;"></td>
		<td><input type='text' class='form-control' name='birim[]' id='birim<?= $x; ?>' readonly value="<?= $stokbirimexe->stokBirim_ad;?>"></td>
		<td><input type='number' step='0.001' class='form-control' autocomplete='off' name='birimfiyat[]' id='birimfiyat<?= $x; ?>' required='' value="<?= $stok->alisStok_birimFiyat; ?>"></td>
		<td><input type='text' class='form-control' name='kdv[]' id='kdv<?= $x; ?>' readonly value="<?= $stokexe->stok_alisKDV; ?>"></td>
		<td><input type='text' class='form-control' name='toplam[]' id='toplam<?= $x; ?>' readonly value="<?= $toplami; ?>"></td>
		<td><button type='button' onclick='deleteRow(this);' class='btn btn-danger btn-sm' id='<?= $x; ?>'><i class='fa fa-trash'></i> Sil</button></td>
	</tr>
<?php  $x++;}?>
												        </tbody>
												       <!-- <tfoot>
												        	<tr>
												        		<th></th>
												        		<th></th>
												        		<th></th>
												        		<th>Ara Toplam: <span id="aratop"><?= $alisFaturasi->alis_araToplam; ?></span></th>
												        		<th></th>
												        		<th>KDV: <span id="kdvtop"><?= $alisFaturasi->alis_kdvToplam; ?></span></th>
												        		<th></th>
												        		<th>Genel Toplam: <span id="geneltop"><?= $alisFaturasi->alis_genelToplam; ?></span></th>
												        		<th></th>
												        	</tr>
												        </tfoot>  -->
												    </table>
											 <table class="table table-stripped table-center table-hover">
												<thead></thead>
												<tbody>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-right">Ara Toplam</td>
														<td class="text-right" id="aratop"><?= $alisFaturasi->alis_araToplam ?></td>
													</tr>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-right">KDV</td>
														<td class="text-right" id="kdvtop"><?= $alisFaturasi->alis_kdvToplam ?></td>
													</tr>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td class="text-right">Genel Toplam</td>
														<td class="text-right" id="geneltop"><?= $alisFaturasi->alis_genelToplam ?></td>
													</tr>
												</tbody>
											</table>

												    <!-- <div class="float-right">
												    	Ara Toplam: <span id="aratop" style="font-weight: bold;"><?= $alisFaturasi->alis_araToplam; ?></span>
												    	<span style="margin-right:20px;"></span>
												    	KDV: <span id="kdvtop" style="font-weight: bold;"><?= $alisFaturasi->alis_kdvToplam; ?></span>
												    	<span style="margin-right:20px;"></span>
												    	Genel Toplam: <span id="geneltop" style="font-weight: bold;"><?= $alisFaturasi->alis_genelToplam; ?></span>
												    	<span style="margin-right:10px;"></span>
												    </div> -->
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
												<h4 class="card-title mt-4">Fatura Alt Bilgileri</h4>												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label>Açıklama</label>
															<textarea class="form-control" name="alis_aciklama"><?= $alisFaturasi->alis_aciklama; ?></textarea>
														</div>
													</div>
												</div>
												<!-- Dosya Yükleme Alanı -->
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label>Satış sözleşmesini lütfen buraya yükleyiniz <span style="color: red;">*</span></label>
															<input type="file" class="form-control" name="fatura_dosya[]" multiple accept="*/*" required>
															<small class="form-text text-muted">Desteklenen dosya türleri: PDF, DOC, DOCX, JPG, JPEG, PNG, GIF, TXT, XLSX, XLS (Çoklu dosya seçilebilir)</small>
														</div>
													</div>
												</div>
												<!-- /Dosya Yükleme Alanı -->
										</div>
									</div>
									<button type="submit" class="btn btn-danger" style="width:100%;">Güncelle</button>

									<input type="hidden" id="aratopHidden" name="aratopHidden" value="<?= $alisFaturasi->alis_araToplam; ?>">
									<input type="hidden" id="kdvtopHidden" name="kdvtopHidden" value="<?= $alisFaturasi->alis_kdvToplam; ?>">
									<input type="hidden" id="geneltopHidden" name="geneltopHidden" value="<?= $alisFaturasi->alis_genelToplam; ?>">
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

		<div id="edit_category" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Stok Ekle</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="#" method="POST">
							<input class="form-control" type="hidden" id="idsi" name="id">
							<input class="form-control" type="hidden" id="stokID" name="stokID">
							<div class="form-group">
								<label>Stok Adına Göre <span class="text-danger">*</span></label>
								<input class="form-control" type="text" id="stokAdi" name="stokAdi" required="">
							</div>
							
							<div class="form-group">
								<label>Stok Koduna Göre <span class="text-danger">*</span></label>
								<input class="form-control" type="text" id="stokKodu" name="stokKodu" required="">
							</div>
							
							<div class="submit-section">
								<!-- <button class="btn btn-danger submit-btn">Seç</button> -->
								<button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


		<?php if ($this->session->flashdata('fatura_ok')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "success", 
				  text: "Alış faturası eklenmiştir.",
				  confirmButtonText:'Tamam',
				  button: false,
				  timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('fatura_updt_ok')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "success", 
				  text: "Alış faturası güncellenmiştir.",
				  confirmButtonText:'Tamam',
				  button: false,
				  timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('cari_hatali')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "error", 
				  text: "Cari kodu veya cari adı kayıtlı değil, lütfen listeden seçerek devam ediniz.",
				  confirmButtonText:'Tamam',
				  button: false,
				  timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('fatura_mukerrer')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "error", 
				  text: "Aynı fatura veya irsaliye numarasına ait kayıt mevcuttur, tekrar deneyiniz.",
				  confirmButtonText:'Tamam',
				  button: false,
				  timer: 5000,
				});
			</script>
		<?php endif; ?>
		

		<?php $this->load->view("include/footer-js"); ?>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

		<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
<script>
$(function(){
   $('.datepicker').datepicker({
      dateFormat: 'dd.mm.yy',
      language: 'tr'
    });
});

$(function(){
   $('#datetimepicker').datetimepicker({
       format: 'HH:mm'
    });
});
</script>


		<script>
				var formatter = new Intl.NumberFormat('tr-TR');

				var items = <?=$x-1;?>;

				var counter = [];

				for(iy = 1; iy<=items; iy++){
					counter.push(1);
				}				function addItem() {
					items++;
					counter.push(items);
					var html = "<tr>";
						html += "<td><a href='#' class='btn btn-success btn-sm' data-toggle='modal' data-target='#edit_category' data-id='"+items+"'><i class='fa fa-hand-pointer'></i> Seç</a></td>";
						html += "<td><input type='text' class='form-control' name='stokadi[]' id='stokadi"+items+"' readonly></td>";
						html += "<td style='display:none'><input type='text' class='form-control' name='stokkodu[]' id='stokkodu"+items+"' readonly></td>";
					    html += "<td><input type='hidden' name='stokid[]' id='stokid"+items+"'><input type='text' class='form-control' name='barkod[]' id='barkod"+items+"' readonly></td>";
					    html += "<td><input type='number' step='0.01' class='form-control' onkeydown='event.preventDefault()' autocomplete='off' name='miktar[]' id='miktar"+items+"' required='' style='width:175px;'></td>";
					    html += "<td style='display:none'><input type='text' class='form-control' name='birim[]' id='birim"+items+"' readonly></td>";
					    html += "<td><input type='number' step='0.001' class='form-control' onkeydown='event.preventDefault()' autocomplete='off' name='birimfiyat[]' id='birimfiyat"+items+"' required=''></td>";
					    html += "<td><input type='text' class='form-control' name='kdv[]' id='kdv"+items+"' readonly></td>";
					    html += "<td><input type='text' class='form-control' name='toplam[]' id='toplam"+items+"' readonly></td>";
					    html += "<td> <button type='button' onclick='deleteRow(this);' class='btn btn-danger btn-sm' id='"+items+"'><i class='fa fa-trash'></i> Sil</button> </td>"
					html += "</tr>";

					var row = document.getElementById("tbody").insertRow();
					row.innerHTML = html;
				}

				function deleteRow(button){
					if(counter.length>=1){
						counter.pop();
					}
					if(counter.length == 0){
						counter.push(1);
						toastr.warning("En az bir kayıt olması zorunludur, bu kayıt silinemez.");
					}else{
						var btnID = button.id;

						var btnKDV = parseFloat($("#kdv"+btnID).val());
						var btnBirimFiyat = parseFloat($("#birimfiyat"+btnID).val());
						var btnToplam = parseFloat($("#toplam"+btnID).val());

						if(!isNaN(btnKDV)){
							var araTopHidden = $("#aratopHidden").val();
							var kdvtopHidden = $("#kdvtopHidden").val();
							var geneltopHidden = $("#geneltopHidden").val();

							yeniAraToplam = araTopHidden - btnToplam;

							yeniKDV = 0;

							if(btnKDV == 0){
								yeniKDV = 0;
							}else if(btnKDV == 1){
								yeniKDV = 0.01;
							}else if(btnKDV == 8){
								yeniKDV = 0.08;
							}else if(btnKDV == 10){
								yeniKDV = 0.10;
							}else if(btnKDV == 18){
								yeniKDV = 0.18;
							}else if(btnKDV == 20){
								yeniKDV = 0.20;
							}

							yeniKDVHesap = btnToplam * yeniKDV;
							yeniKdvToplam = kdvtopHidden - yeniKDVHesap;

							yeniGenelToplam = geneltopHidden-(btnToplam+yeniKDVHesap);

							$("#aratop").html(formatter.format(yeniAraToplam));
							$("#aratopHidden").val(yeniAraToplam);
							$("#kdvtop").html(formatter.format(yeniKdvToplam));
							$("#kdvtopHidden").val(yeniKdvToplam);
							$("#geneltop").html(formatter.format(yeniGenelToplam));
							$("#geneltopHidden").val(yeniGenelToplam);
						}

						button.parentElement.parentElement.remove();
					}
				} 

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

				$('#edit_category').on('show.bs.modal', function (event) {
					let idsi = $(event.relatedTarget).data('id')
					$(this).find('.modal-body #idsi').val(idsi)
				})

				$(function() {
				    $("#name_input").autocomplete({
				        source: "<?= env('BASE_URL'); ?>/fatura/autocompleteDataByName",
				        minLength: 2,
				        select: function( event, ui ) {
				            event.preventDefault();

							toastr.success(ui.item.value+" cari adlı müşteriye ait bilgiler getirildi.");

							$("#cari_id").val(ui.item.id);
			            	$("#name_input").val(ui.item.value);
			            	$("#kod_input").val(ui.item.cari_kodu);
			            	$("#cari_grubu_input").val(ui.item.cari_grubu);
			            	$("#cari_vergiDairesi_input").val(ui.item.cari_vergiDairesi);
			            	$("#cari_vergiNumarasi_input").val(ui.item.cari_vergiNumarasi);
			            	$("#cari_adres_input").val(ui.item.cari_adres);
				        }
				    });
				});

				$(function() {
				    $("#kod_input").autocomplete({
				        source: "<?= env('BASE_URL'); ?>/fatura/autocompleteDataByCode",
				        minLength: 2,
				        select: function( event, ui ) {
				            event.preventDefault();

							toastr.success(ui.item.value+" cari kodlu müşteriye ait bilgiler getirildi.");

							$("#cari_id").val(ui.item.id);
			            	$("#name_input").val(ui.item.cari_ad);
			            	$("#kod_input").val(ui.item.value);
			            	$("#cari_grubu_input").val(ui.item.cari_grubu);
			            	$("#cari_vergiDairesi_input").val(ui.item.cari_vergiDairesi);
			            	$("#cari_vergiNumarasi_input").val(ui.item.cari_vergiNumarasi);
			            	$("#cari_adres_input").val(ui.item.cari_adres);
				        }
				    });
				});

				$(function() {
				    $("#stokKodu").autocomplete({
				        source: '<?= env('BASE_URL'); ?>/fatura/autocompleteDataByStockCode2',
				        minLength: 2,
				        select: function( event, ui ) {
				            event.preventDefault();

				            $('#edit_category').modal('hide');
				            $("#stokKodu").val("");
				            $("#stokAdi").val("");

							toastr.success(ui.item.value+" stok kodlu stok bilgileri getirildi.");

							document.getElementById("miktar"+idsi.value).onkeydown = null;
							document.getElementById("birimfiyat"+idsi.value).onkeydown = null;

							$("#stokID").val(ui.item.id);
							$("#stokid"+idsi.value+"").val(ui.item.id);
							$("#stokkodu"+idsi.value+"").val(ui.item.value);
							$("#stokadi"+idsi.value+"").val(ui.item.stok_ad);
							$("#birim"+idsi.value+"").val(ui.item.stok_birimi);
							$("#barkod"+idsi.value+"").val(ui.item.stok_barkod);
							$("#birimfiyat"+idsi.value+"").val(ui.item.stok_alisFiyati);
							$("#kdv"+idsi.value+"").val(ui.item.stok_alisKDV);
							$("#miktar"+idsi.value+"").val("");
							$("#toplam"+idsi.value+"").val("");
				        }
				    });
				});

				$(function() {
				    $("#stokAdi").autocomplete({
				        source: '<?= env('BASE_URL'); ?>/fatura/autocompleteDataByStockName2',
				        minLength: 2,
				        select: function( event, ui ) {
				            event.preventDefault();

				            $('#edit_category').modal('hide');
				            $("#stokAdi").val("");
				            $("#stokKodu").val("");

							toastr.success(ui.item.value+" stok isimli stok bilgileri getirildi.");

							document.getElementById("miktar"+idsi.value).onkeydown = null;
							document.getElementById("birimfiyat"+idsi.value).onkeydown = null;

							$("#stokID").val(ui.item.id);
							$("#stokid"+idsi.value+"").val(ui.item.id);
							$("#stokadi"+idsi.value+"").val(ui.item.value);
							$("#stokkodu"+idsi.value+"").val(ui.item.stok_kodu);
							$("#birim"+idsi.value+"").val(ui.item.stok_birimi);
							$("#barkod"+idsi.value+"").val(ui.item.stok_barkod);
							$("#birimfiyat"+idsi.value+"").val(ui.item.stok_alisFiyati);
							$("#kdv"+idsi.value+"").val(ui.item.stok_alisKDV);
							$("#miktar"+idsi.value+"").val("");
							$("#toplam"+idsi.value+"").val("");
				        }
				    });
				});

				$(document).on('change','input[name^="miktar"]',function() {
					var aratop = 0;
					var kdvtop = 0;
					var geneltop = 0;

					let id = event.target.id;
					var numb = id.match(/\d/g);

					numb = numb.join("");

					var miktar = $("#miktar"+numb+"").val();
					var fiyat = $("#birimfiyat"+numb+"").val();
					var toplam = miktar*fiyat;

					$("#toplam"+numb+"").val(toplam);

					for(i=1;i<=items;i++){
						if(parseFloat($("#toplam"+i+"").val())){
							aratop = aratop + parseFloat($("#toplam"+i+"").val());

							if(parseFloat($("#kdv"+i+"").val()) == 0){
								yeniKDV = 0;
							}else if(parseFloat($("#kdv"+i+"").val()) == 1){
								yeniKDV = 0.01;
							}else if(parseFloat($("#kdv"+i+"").val()) == 8){
								yeniKDV = 0.08;
							}else if(parseFloat($("#kdv"+i+"").val()) == 10){
								yeniKDV = 0.10;
							}else if(parseFloat($("#kdv"+i+"").val()) == 18){
								yeniKDV = 0.18;
							}else if(parseFloat($("#kdv"+i+"").val()) == 20){
								yeniKDV = 0.20;
							}

							kdvtop = kdvtop + (parseFloat($("#toplam"+i+"").val()) * yeniKDV);
						}
					}
					geneltop = geneltop + (aratop + kdvtop);

					$("#aratop").html(formatter.format(aratop));
					$("#aratopHidden").val(aratop);
					$("#kdvtop").html(formatter.format(kdvtop));
					$("#kdvtopHidden").val(kdvtop);
					$("#geneltop").html(formatter.format(geneltop));
					$("#geneltopHidden").val(geneltop);
				});


				$(document).on('change','input[name^="birimfiyat"]',function() {
					var aratop = 0;
					var kdvtop = 0;
					var geneltop = 0;

					let id = event.target.id;
					var numb = id.match(/\d/g);
					numb = numb.join("");

					var miktar = $("#miktar"+numb+"").val();
					var fiyat = $("#birimfiyat"+numb+"").val();
					var toplam = miktar*fiyat;

					$("#toplam"+numb+"").val(toplam);

					for(i=1;i<=items;i++){
						if(parseFloat($("#toplam"+i+"").val())){
							aratop = aratop + parseFloat($("#toplam"+i+"").val());

							if(parseFloat($("#kdv"+i+"").val()) == 0){
								yeniKDV = 0;
							}else if(parseFloat($("#kdv"+i+"").val()) == 1){
								yeniKDV = 0.01;
							}else if(parseFloat($("#kdv"+i+"").val()) == 8){
								yeniKDV = 0.08;
							}else if(parseFloat($("#kdv"+i+"").val()) == 10){
								yeniKDV = 0.10;
							}else if(parseFloat($("#kdv"+i+"").val()) == 18){
								yeniKDV = 0.18;
							}else if(parseFloat($("#kdv"+i+"").val()) == 20){
								yeniKDV = 0.20;
							}

							kdvtop = kdvtop + (parseFloat($("#toplam"+i+"").val()) * yeniKDV);
						}
					}
					geneltop = geneltop + (aratop + kdvtop);

					$("#aratop").html(formatter.format(aratop));
					$("#aratopHidden").val(aratop);
					$("#kdvtop").html(formatter.format(kdvtop));
					$("#kdvtopHidden").val(kdvtop);
					$("#geneltop").html(formatter.format(geneltop));
					$("#geneltopHidden").val(geneltop);
				});

				//döviz kuru işlemleri buradan
				$("#alis_paraBirimi").on('change',function(){
					var paraBirimiText = $( "#alis_paraBirimi option:selected" ).text();
					var paraBirimi = $( "#alis_paraBirimi option:selected" ).val();

					if(paraBirimi == 1){
						$("#alis_guncelKur").css("display", "none");
						$("#alis_guncelKur").val("");
						$("#birimFiyatParaBirimi").html("(TL)");
					}else{
						if(paraBirimi == 2){
							$("#birimFiyatParaBirimi").html("(USD)");
						}else if(paraBirimi == 3){
							$("#birimFiyatParaBirimi").html("(EUR)");
						}else if(paraBirimi == 4){
							$("#birimFiyatParaBirimi").html("(GBP)");
						}

						$("#alis_guncelKur").css("display", "block");
						$.ajax({
							url: "<?= env('BASE_URL'); ?>/fatura/paraBirimiKontrol",
							method: "POST",
							data: { paraBirimi : paraBirimi },
							success: function(result){
								toastr.success("Para birimi "+ paraBirimiText + " olarak değiştirilmiştir. Güncel kur bilgileri ekrana yansıtılmıştır.");
								$("#alis_guncelKur").val(result);
							}
						});
					}
				});
		</script>

		<script>
//var tables = document.getElementsByClassName('flexiCol');
var tables = document.getElementsByTagName('table');
for (var i=0; i<tables.length;i++){
 resizableGrid(tables[i]);
}

function resizableGrid(table) {
 var row = table.getElementsByTagName('tr')[0],
 cols = row ? row.children : undefined;
 if (!cols) return;
 
 table.style.overflow = 'hidden';
 
 var tableHeight = table.offsetHeight;
 
 for (var i=0;i<cols.length;i++){
  var div = createDiv(tableHeight);
  cols[i].appendChild(div);
  cols[i].style.position = 'relative';
  setListeners(div);
 }

 function setListeners(div){
  var pageX,curCol,nxtCol,curColWidth,nxtColWidth;

  div.addEventListener('mousedown', function (e) {
   curCol = e.target.parentElement;
   nxtCol = curCol.nextElementSibling;
   pageX = e.pageX; 
 
   var padding = paddingDiff(curCol);
 
   curColWidth = curCol.offsetWidth - padding;
   if (nxtCol)
    nxtColWidth = nxtCol.offsetWidth - padding;
  });

  div.addEventListener('mouseover', function (e) {
   e.target.style.borderRight = '2px solid #d92637';
  })

  div.addEventListener('mouseout', function (e) {
   e.target.style.borderRight = '';
  })

  document.addEventListener('mousemove', function (e) {
   if (curCol) {
    var diffX = e.pageX - pageX;
 
    if (nxtCol)
     nxtCol.style.width = (nxtColWidth - (diffX))+'px';

    curCol.style.width = (curColWidth + diffX)+'px';
   }
  });

  document.addEventListener('mouseup', function (e) { 
   curCol = undefined;
   nxtCol = undefined;
   pageX = undefined;
   nxtColWidth = undefined;
   curColWidth = undefined
  });
 }
 
 function createDiv(height){
  var div = document.createElement('div');
  div.style.top = 0;
  div.style.right = 0;
  div.style.width = '5px';
  div.style.position = 'absolute';
  div.style.cursor = 'col-resize';
  div.style.userSelect = 'none';
  div.style.height = height + 'px';
  return div;
 }
 
 function paddingDiff(col){
 
  if (getStyleVal(col,'box-sizing') == 'border-box'){
   return 0;
  }
 
  var padLeft = getStyleVal(col,'padding-left');
  var padRight = getStyleVal(col,'padding-right');
  return (parseInt(padLeft) + parseInt(padRight));

 }

 function getStyleVal(elm,css){
  return (window.getComputedStyle(elm, null).getPropertyValue(css))
 }
};
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
