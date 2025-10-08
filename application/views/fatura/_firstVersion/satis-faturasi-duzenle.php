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
		</style>
		<title>ilekaSoft CRM - Fatura / Satış Faturası Düzenle - Muhasebe Programı</title>
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
							<div class="col-sm-12">
								<h3 class="page-title">Fatura</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Fatura</li>
									<li class="breadcrumb-item active">Satış Faturası Düzenle</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Cari Bilgileri</h4>
									<form action="<?= base_url("fatura/satisFaturasiGuncelle"); ?>" method="POST">
										<input type="hidden" name="kh_id" value="<?= $satisFaturasi->satis_kasaHareketiID; ?>">
										<input type="hidden" name="bh_id" value="<?= $satisFaturasi->satis_bankaHareketiID; ?>">
										<input type="hidden" name="satis_id" value="<?= $satisFaturasi->satis_id; ?>">
										<input type="hidden" name="satis_cariID" id="cari_id" value="<?= $satisFaturasi->satis_cariID; ?>">
										<input type="hidden" name="ch_id" id="ch_id" value="<?= $satisFaturasi->satis_cariHareketiID; ?>">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Cari Kodu</label>
													<input type="text" class="form-control" name="cari_kodu" id="kod_input" required="" value="<?= $cariBilgileri->cari_kodu;?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Cari Adı</label>
													<input type="text" class="form-control" name="cari_adi" id="name_input" required=""  value="<?= $cariBilgileri->cari_ad;?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Cari Grubu</label>
													<input type="text" class="form-control" name="" id="cari_grubu_input" readonly value="<?= $cariGrubuBilgileri->cariGrup_ad; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Vergi Dairesi</label>
													<input type="text" class="form-control" name="" id="cari_vergiDairesi_input" readonly  value="<?= $cariBilgileri->cari_vergiDairesi;?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Vergi Numarası</label>
													<input type="text" class="form-control" name="" id="cari_vergiNumarasi_input" readonly  value="<?= $cariBilgileri->cari_vergiNumarasi;?>">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Adres</label>
													<input type="text" class="form-control" name="" id="cari_adres_input" readonly  value="<?= $cariBilgileri->cari_adres;?>">
												</div>
											</div>
											<!--<div class="col-md-3">
												<div class="form-group">
													<label>Fatura</label>
													<select class="select form-control" name="satis_faturaTipi" required="" id="faturaTipi" disabled="">
														<option value="">Fatura tipi seçiniz...</option>
														<option value="1" <?php if($satisFaturasi->satis_faturaTipi == 1){echo "selected";} ?>>Açık Fatura</option>
														<option value="2" <?php if($satisFaturasi->satis_faturaTipi == 2){echo "selected";} ?>>Kapalı Fatura</option>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Ödeme</label>
													<select class="select form-control" name="satis_odemeTipi" id="odemeTipi">
														<option value="">Ödeme tipi seçiniz...</option>
														<option value="1" <?php if($satisFaturasi->satis_odemeTipi == 1){echo "selected";} ?>>Kasa</option>
														<option value="2" <?php if($satisFaturasi->satis_odemeTipi == 2){echo "selected";} ?>>Banka</option>
													</select>
												</div>
											</div> -->
										</div>
									<div class="row">
										<?php 
											$irsaliyeTarih = $satisFaturasi->satis_irsaliyeTarihi;
											$faturaTarih = $satisFaturasi->satis_faturaTarihi;

											$yeni_irsaliyeTarihi = date("d.m.Y", strtotime($irsaliyeTarih));
											$yeni_faturaTarih = date("d.m.Y", strtotime($faturaTarih));
										?>
										<div class="col-md-12">
												<h4 class="card-title mt-4">Fatura Bilgileri</h4>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>İrsaliye No</label>
															<input type="text" class="form-control" name="satis_irsaliyeNo" value="<?= $satisFaturasi->satis_irsaliyeNo; ?>" required="">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>İrsaliye Tarihi</label>
															<input type="text" class="datepicker form-control" name="satis_irsaliyeTarihi" autocomplete="off" value="<?= $yeni_irsaliyeTarihi; ?>" required=""/>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Fatura No</label>
															<input type="text" class="form-control" name="satis_faturaNo"  value="<?= $satisFaturasi->satis_faturaNo; ?>" required="">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Fatura Tarihi</label>
															<input type="text" class="datepicker form-control" name="satis_faturaTarihi" autocomplete="off" value="<?= $yeni_faturaTarih; ?>" required=""/>
														</div>
													</div>
												</div>
										</div>
										
										<!--<div class="col-md-6">
											<h4 class="card-title mt-4">Ödeme Bilgileri</h4>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Hesap Adı</label>
														<select class="select form-control" name="banka_id" id="banka">
															<option value="">Hesap adı seçiniz...</option>
															<?php foreach($banka as $bnk){?>
																<option value="<?= $bnk->banka_id; ?>" <?php if($bnk->banka_id == $satisFaturasi->satis_bankaID){echo "selected";} ?>> <?= $bnk->banka_bankaAd." - ".$bnk->banka_hesapAd; ?></option>
															<?php }	?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Hesap No</label>
														<input type="text" class="form-control" name="" disabled>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Kasa Adı</label>
														<select class="select form-control" name="kasa_id" id="kasa">
															<option value="">Kasa adı seçiniz...</option>
															<?php foreach($kasa as $ksa){?>
																<option value="<?= $ksa->kasa_id; ?>" <?php if($ksa->kasa_id == $satisFaturasi->satis_kasaID){echo "selected";} ?>> <?= $ksa->kasa_adi; ?></option>
															<?php }	?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Kasa Kodu</label>
														<input type="text" class="form-control" name="" disabled>
													</div>
												</div>
											</div>
										</div> -->
									</div>
									<div class="row">
										<div class="col-md-12">
											<h4 class="card-title mt-4">Stok Bilgisi <a href="javascript:void(0)" class="btn btn-success btn-sm"  onclick="addItem();" style="float:right;" ><i class="fa fa-plus"></i> Stok Bilgisi Ekle</a></h4>
											<div class="row">
											    <div class="table-responsive">
													<table class="table table-striped custom-table mb-0">
														<thead>
													        <tr>
													            <th></th>
													            <th>Stok Adı</th>
													            <th>Stok Kodu</th>
													            <th>Barkod</th>
													            <th>Miktar</th>
													            <th>Birim</th>
													            <th>Birim Fiyat (TL)</th>
													            <th>KDV (%)</th>
													            <th>Toplam (TL)</th>
													            <th></th>
													        </tr>
												   		</thead>
												        <tbody id="tbody">
<?php 
$x=1;
	foreach($satisFaturasiStok as $stok){
		$stokidsi = $stok->satisStok_stokID;

    	$stokQ = "SELECT * FROM stok WHERE stok_id = '$stokidsi'";
    	$stokexe = $this->db->query($stokQ)->row();

    	$stokBirim = $stokexe->stok_birimID;

    	$stokBirimQ = "SELECT * FROM stokBirimleri WHERE stokBirim_id = '$stokBirim'";
    	$stokbirimexe = $this->db->query($stokBirimQ)->row();

    	$toplami = $stok->satisStok_miktar * $stok->satisStok_birimFiyat;
?>
	<tr>
		<td><a href='#' class='btn btn-success btn-sm' data-toggle='modal' data-target='#edit_category' data-id='<?= $x; ?>'><i class='fa fa-hand-pointer'></i> Seç</a></td>
		<td><input type='text' class='form-control' name='stokadi[]' id='stokadi<?= $x; ?>' readonly value="<?= $stokexe->stok_ad;?>"></td>
		<td><input type='text' class='form-control' name='stokkodu[]' id='stokkodu<?= $x; ?>' readonly value="<?= $stokexe->stok_kodu;?>"></td>
		<td><input type="hidden" name="satisFaturasiStok_id[]" value="<?= $stok->satisStok_id;?>">
			<input type='hidden' name='stokid[]' id='stokid<?= $x; ?>' value="<?= $stokexe->stok_id;?>">
			<input type='text' class='form-control' name='barkod[]' id='barkod<?= $x; ?>' readonly value="<?= $stokexe->stok_barkod;?>"></td>
		
		
		<td><input type='number' step='0.01' class='form-control' autocomplete='off' name='miktar[]' id='miktar<?= $x; ?>' required='' value="<?= $stok->satisStok_miktar; ?>"></td>
		<td><input type='text' class='form-control' name='birim[]' id='birim<?= $x; ?>' readonly value="<?= $stokbirimexe->stokBirim_ad;?>"></td>
		<td><input type='number' step='0.01' class='form-control' autocomplete='off' name='birimfiyat[]' id='birimfiyat<?= $x; ?>' required='' value="<?= $stok->satisStok_birimFiyat; ?>"></td>
		<td><input type='text' class='form-control' name='kdv[]' id='kdv<?= $x; ?>' readonly value="<?= $stokexe->stok_satisKDV; ?>"></td>
		<td><input type='text' class='form-control' name='toplam[]' id='toplam<?= $x; ?>' readonly value="<?= $toplami; ?>"></td>
		<td><button type='button' onclick='deleteRow(this);' class='btn btn-danger btn-sm' id='<?= $x; ?>'><i class='fa fa-trash'></i> Sil</button></td>
	</tr>
<?php  $x++;}?>
												        </tbody>
												        <tfoot>
												        	<tr>
												        		<th></th>
												        		<th></th>
												        		<th></th>
												        		<th>Ara Toplam: <span id="aratop"><?= $satisFaturasi->satis_araToplam; ?></span></th>
												        		<th></th>
												        		<th>KDV: <span id="kdvtop"><?= $satisFaturasi->satis_kdvToplam; ?></span></th>
												        		<th></th>
												        		<th>Genel Toplam: <span id="geneltop"><?= $satisFaturasi->satis_genelToplam; ?></span></th>
												        		<th></th>
												        	</tr>
												        </tfoot>
												    </table>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
												<h4 class="card-title mt-4">Fatura Alt Bilgileri</h4>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label>Açıklama</label>
															<textarea class="form-control" name="satis_aciklama"><?= $satisFaturasi->satis_aciklama; ?></textarea>
														</div>
													</div>
												</div>
										</div>
									</div>
									<button type="submit" class="btn btn-danger" style="width:100%;">Güncelle</button>

									<input type="hidden" id="aratopHidden" name="aratopHidden" value="<?= $satisFaturasi->satis_araToplam; ?>">
									<input type="hidden" id="kdvtopHidden" name="kdvtopHidden" value="<?= $satisFaturasi->satis_kdvToplam; ?>">
									<input type="hidden" id="geneltopHidden" name="geneltopHidden" value="<?= $satisFaturasi->satis_genelToplam; ?>">
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
								<label>Stok Koduna Göre <span class="text-danger">*</span></label>
								<input class="form-control" type="text" id="stokKodu" name="stokKodu" required="">
							</div>
							<div class="form-group">
								<label>Stok Adına Göre <span class="text-danger">*</span></label>
								<input class="form-control" type="text" id="stokAdi" name="stokAdi" required="">
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

		<?php if ($this->session->flashdata('fatura_ok')): ?>
			<script>
				swal({
				  title: "Bilgilendirme",
				  type: "success", 
				  text: "Satış faturası eklenmiştir.",
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
				  text: "Satış faturası güncellenmiştir.",
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
</script>


		<script>
				var formatter = new Intl.NumberFormat('tr-TR', {
				  style: 'currency',
				  currency: 'TRY',
				});

				var items = <?=$x-1;?>;

				var counter = [];

				for(iy = 1; iy<=items; iy++){
					counter.push(1);
				}

				function addItem() {
					items++;
					counter.push(items);
					var html = "<tr>";
						html += "<td><a href='#' class='btn btn-success btn-sm' data-toggle='modal' data-target='#edit_category' data-id='"+items+"'><i class='fa fa-hand-pointer'></i> Seç</a> </td>";
						html += "<td><input type='text' class='form-control' name='stokadi[]' id='stokadi"+items+"' readonly></td>";
						html += "<td><input type='text' class='form-control' name='stokkodu[]' id='stokkodu"+items+"' readonly></td>";
					    html += "<td><input type='hidden' name='stokid[]' id='stokid"+items+"'><input type='text' class='form-control' name='barkod[]' id='barkod"+items+"' readonly></td>";
					    
					    
					    html += "<td><input type='number' step='0.01' class='form-control' onkeydown='event.preventDefault()' autocomplete='off' name='miktar[]' id='miktar"+items+"' required=''></td>";
					    html += "<td><input type='text' class='form-control' name='birim[]' id='birim"+items+"' readonly></td>";
					    html += "<td><input type='number' step='0.01' class='form-control' onkeydown='event.preventDefault()' autocomplete='off' name='birimfiyat[]' id='birimfiyat"+items+"' required=''></td>";
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
							}else if(btnKDV == 18){
								yeniKDV = 0.18;
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
				        source: "https://crm.ilekasoft.com/fatura/autocompleteDataByName",
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
				        source: "https://crm.ilekasoft.com/fatura/autocompleteDataByCode",
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
				        source: 'https://crm.ilekasoft.com/fatura/autocompleteDataByStockCode/<?=$idsi?>',
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
							$("#birimfiyat"+idsi.value+"").val(ui.item.stok_satisFiyati);
							$("#kdv"+idsi.value+"").val(ui.item.stok_satisKDV);
							$("#miktar"+idsi.value+"").val("");
							$("#toplam"+idsi.value+"").val("");
				        }
				    });
				});

				$(function() {
				    $("#stokAdi").autocomplete({
				        source: 'https://crm.ilekasoft.com/fatura/autocompleteDataByStockName/<?=$idsi?>',
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
							$("#birimfiyat"+idsi.value+"").val(ui.item.stok_satisFiyati);
							$("#kdv"+idsi.value+"").val(ui.item.stok_satisKDV);
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
							}else if(parseFloat($("#kdv"+i+"").val()) == 18){
								yeniKDV = 0.18;
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
							}else if(parseFloat($("#kdv"+i+"").val()) == 18){
								yeniKDV = 0.18;
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

$(function() {
	var faturaTipi = $("#faturaTipi").val();

		if(faturaTipi == 1){
			$("#banka").prop('disabled', true);
			$("#kasa").prop('disabled', true);
		}
    
	    if(faturaTipi == 2){
	    	var odemeTipi = $("#odemeTipi").val();

	    	if(odemeTipi == 1){
	    		$("#kasa").prop('disabled', false);
				$("#banka").prop('disabled', true);
	    	}

	    	if(odemeTipi == 2){
	    		$("#banka").prop('disabled', false);
				$("#kasa").prop('disabled', true);
	    	}

	    }
    
});

$("#odemeTipi").on('change',function(){
	var status = $(this).val();

	if(status == 1){
		$("#kasa").prop('disabled', false);
		$("#banka").prop('disabled', true);
		$("#banka").val('').change();
	}

	if(status == 2){
		$("#banka").prop('disabled', false);
		$("#kasa").prop('disabled', true);
		$("#kasa").val('').change();
	}
});
		</script>
	</body>
</html>