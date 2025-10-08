<!DOCTYPE html>
<html lang="tr">
<head>
		<?php $this->load->view("include/head-tags"); ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
		  integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
		  crossorigin="anonymous" referrerpolicy="no-referrer"/>
	<script>
		var formatter = new Intl.NumberFormat('tr-TR');
		var items_banka = 0;
		var counter_banka = [];
		var paraBirimiMetin = "TL";
	</script>
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
								<h3 class="page-title">Yönetici</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Yönetici</li>
									<li class="breadcrumb-item active">Ayarlar</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-7">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Firma Bilgileri</h4>
									<form action="<?= base_url("yonetici/ayarlarGuncelle"); ?>" method="POST">
										<input type="hidden" value="<?= $ayar->ayarlar_id; ?>" name="ayarlar_id">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Firma Adı/Ünvanı</label>
													<input type="text" class="form-control" value="<?= $ayar->ayarlar_firmaAd; ?>" name="ayarlar_firmaAd">
												</div>
												<div class="form-group">
													<label>Firma Sektörü</label>
													<input type="text" class="form-control" value="<?= $ayar->ayarlar_firmaSektor; ?>" name="ayarlar_firmaSektor">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Telefon</label>
													<input type="number" class="form-control" value="<?= $ayar->ayarlar_telefon; ?>" name="ayarlar_telefon" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
												</div>
												<div class="form-group">
													<label>E-Posta</label>
													<input type="email" class="form-control" value="<?= $ayar->ayarlar_eposta; ?>" name="ayarlar_eposta">
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label>Vergi Dairesi</label>
													<input type="text" class="form-control" value="<?= $ayar->ayarlar_vergiDairesi; ?>" name="ayarlar_vergiDairesi">
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label>Vergi Numarası / TC Kimlik Numarası</label>
													<input type="number" class="form-control" value="<?= $ayar->ayarlar_vergiNo; ?>" name="ayarlar_vergiNo" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11">
												</div>
											</div>
<!--
											<div class="col-md-6">
												<div class="form-group">
													<label>Banka Adı</label>
													<input type="text" class="form-control" value="<?= $ayar->ayarlar_bankaadi; ?>" name="ayarlar_bankaadi">
												</div>
												<div class="form-group">
													<label>IBAN</label>
													<input class="form-control" type="text" name="ayarlar_iban" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="26" value="<?php echo ($ayar->ayarlar_iban) ? $ayar->ayarlar_iban : "TR" ?>">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label>Şube</label>
													<input type="text" class="form-control" value="<?= $ayar->ayarlar_sube; ?>" name="ayarlar_sube">
												</div>
												<div class="form-group">
													<label>Hesap No</label>
													<input type="text" class="form-control" value="<?= $ayar->ayarlar_hesapno; ?>" name="ayarlar_hesapno">
												</div>
											</div>
-->
											<div class="col-md-12">
												<div class="form-group">
													<label>Adres</label>
													<textarea class="form-control" name="ayarlar_adres"><?= $ayar->ayarlar_adres; ?></textarea>
												</div>
											</div>

											<div class="col-md-6">
												<?php
												if ($_iller != false):
													echo '<div class="form-group">
												<label>İl</label>
												<select id="il" name="ayarlar_il" data-plugin-selectTwo class="select ajaxIller" required>
												<option value="">Seçiniz</option>';


													foreach ($_iller as $item) {
														echo $item->id;
														if($item->id == $ayar->ayarlar_il) {$degisken = "selected";}else{$degisken ="";}
														echo '<option value="'. $item->id .'" '.$degisken.'>'. $item->il .'</option>';
													}


													echo '</select></div>';
												else:
													echo 'Kayıtlı İl Bulunamadı..!';
												endif;
												?>
											</div>

											<div class="col-md-6">
												<div class="ilceler">
													<div class="form-group">
														<label>İlçe</label>
														<select id="ilce" name="ayarlar_ilce" class="select" required>
															<option value="">İl Seçiniz</option>
														</select>
													</div>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-form-label col-md-3">Kayıt silme onayı</label>
													<div class="col-md-9">
														<div class="checkbox">
															<label style="font-size: 0.7575rem!important;">
																<input type="checkbox" name="ayarlar_deletePermission" value="1" <?php if($ayar->ayarlar_deletePermission == 1){echo "checked";} ?>> Silme işlemi yapabilmek için işaretleyiniz, bu işaretlemeyi yapıp güncelle butonuna bastığınız zaman hesabınız altında yapılacak tüm silme işlemlerinizden sadece siz sorumlu olursunuz, ilekaSoft muhasebe programı silme işlemlerini geri döndüremez ve bunları yedeklemek ile yükümlü değildir. <b>Mevcut Durum:</b> <?php if($ayar->ayarlar_deletePermission == 1){echo "<span class='text-success'>Kayıt silme yetkisi açık.</span>";}else{echo "<span class='text-danger'>Kayıt silme yetkisi kapalı.</span>";} ?>
															</label>
														</div>
													</div>
												</div>
											</div>

										</div>

									<h4 class="card-title mt-4">Banka Bilgileri</h4>
										<div class="row">
											<div class="table-responsive">
												<input type="hidden" name="bankaCount" id="bankaCount">
												<table class="table table-bordered custom-table mb-0" id="my_table">
													<tbody id="tbody_ayarlarbanka">
													<?php
													$itemsAyarlarBanka = 0;
													foreach ($ayarlarBanka as $itemBanka) {
														$itemsAyarlarBanka++; ?>
														<tr>
															<td><label>Banka Adı</label>
																<input type='text' class='form-control'
																	   name='ayarlar_bankaadi[]'
																	   id='ayarlar_bankaadi<?= $itemsAyarlarBanka ?>'
																	   value="<?= $itemBanka->ayarlarbanka_ad ?>">
															</td>
															<td><label>Şube</label>
																<input type='text' class='form-control'
																	   name='ayarlar_sube[]'
																	   id='ayarlar_sube<?= $itemsAyarlarBanka ?>'
																	   value="<?= $itemBanka->ayarlarbanka_subeAd ?>">
															</td>
															<td><label>Para Birimi</label>
																<select class="form-control" name="ayarlar_parabirimi"
																		id="ayarlar_parabirimi">
																	<option value="1" <?php if ($itemBanka->paraBirim == 1) {
																		echo "selected";
																		$paraBirimi = "TL";
																	} ?>>
																		Türk Lirası
																	</option>
																	<option value="2" <?php if ($itemBanka->paraBirim == 2) {
																		echo "selected";
																		$paraBirimi = "USD";
																	} ?>>
																		Amerikan Doları
																	</option>
																	<option value="3" <?php if ($itemBanka->paraBirim == 3) {
																		echo "selected";
																		$paraBirimi = "EUR";
																	} ?>>
																		Euro
																	</option>
																	<option value="4" <?php if ($itemBanka->paraBirim == 4) {
																		echo "selected";
																		$paraBirimi = "GBP";
																	} ?>>
																		İngiliz Sterlini
																	</option>
																</select>
															</td>
															<td><label>Hesap No</label>
																<input type='text' class='form-control'
																	   name='ayarlar_hesapno[]'
																	   id='ayarlar_hesapno<?= $itemsAyarlarBanka ?>'
																	   value="<?= $itemBanka->ayarlarbanka_hesapNo ?>">
															</td>
															<td>
																<label>IBAN</label>
																<input type='text' class='form-control'
																	   name='ayarlar_iban[]'
																	   id='ayarlar_iban<?= $itemsAyarlarBanka ?>'
																	   value="<?= $itemBanka->ayarlarbanka_iban ?>">
															</td>
															<td>
																<button type='button' class='btn btn-info btn-sm'
																		onclick='addItemBanka()'>
																	<i class='fa fa-plus'></i> Ekle
																</button>
																<button type='button' onclick='deleteRowBanka(this);'
																		class='btn btn-danger btn-sm'
																		id='<?= $itemsAyarlarBanka ?>'>
																	<i class='fa fa-trash'></i> Sil
																</button>
															</td>
														</tr>
														<script>
															items_banka++;
															counter_banka.push(items_banka);
															document.getElementById("bankaCount").value = items_banka;
														</script>
														<?
													}
													?>


													</tbody>
												</table>
											</div>
										</div>


										<h4 class="card-title mt-4">Lisans ve Üyelik Bilgisi</h4>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>ilekaSoft Üye No</label>
													<input type="text" class="form-control" value="<?= $ayar->ayarlar_uniqID; ?>" readonly>
												</div>
											</div>

											<!-- <div class="col-md-12">
												<div class="form-group">
													<label>Lisans Anahtarı</label>
													<input type="text" class="form-control" name="ayarlar_lisansAnahtari" value="<?= $ayar->ayarlar_lisansAnahtari; ?>" readonly>
												</div>
											</div> -->
										</div>
										<button type="submit" class="btn btn-danger" style="width:100%;">Güncelle</button>
									</form>
								</div>
							</div>
						</div>

						<div class="col-md-5">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Logo</h4>
									<form action="<?= base_url("yonetici/logoGuncelle"); ?>" method="POST" enctype="multipart/form-data">
										<?php $anaHesap = anaHesapBilgisi(); ?>
										<input type="hidden" name="anaHesap" value="<?= $anaHesap; ?>">
										<div class="row">
											<div class="col-md-12">
												<?php if($ayar->ayarlar_logoName){ ?>
													<center><img src="<?= base_url("assets/bulut/logo/$ayar->ayarlar_logoName");?>" style="width: 250px; height: auto;"/></center>
												<?php }else{ echo "<center>Logo önizlemesi</center>";}	?>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label>Firma Logosu</label>
													<input class="form-control" name="file" type="file" required="" accept="image/png, image/jpeg, image/jpg">
												</div>
											</div>
											<span style="font-size:8pt;"><i class="fa fa-info-circle text-info"></i>&nbsp;Görsel en fazla 100 KB boyutunda ve 250x250 olabilir, kabul edilen uzantılar sadece jpg ve png.</span>
											<hr>
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
			<?php if ($this->session->flashdata('ayarlar_update_ok')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "success", 
			  text: "Firma ayarları güncellendi.",
			  confirmButtonText:'Tamam',
			  button: false,
			  timer: 5000,
			});
			</script>
			<?php endif; ?>


			<?php if ($this->session->flashdata('document_uploaded')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "success", 
			  text: "Firma logosu güncellendi.",
			  confirmButtonText:'Tamam',
			  button: false,
			  timer: 5000,
			});
			</script>
			<?php endif; ?>
			
			<?php if ($this->session->flashdata('document_uploaded_error')): ?>
			<script>
			swal({
			  title: "Bilgilendirme",
			  type: "error", 
			  text: "Görsel en fazla 100 KB boyutunda ve 250x250 olabilir, kabul edilen uzantılar sadece jpg ve png.",
			  confirmButtonText:'Tamam',
			  button: false,
			  timer: 7000,
			});
			</script>
			<?php endif; ?>

		<?php $this->load->view("include/footer-js"); ?>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
				integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
				crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<?php
			$ilceid = $ayar->ayarlar_ilce;
			$array1 = array($ilceid);
			$res1 = json_encode($array1);
		?>

		<script>
			$(document).ready(function(){

				var il_id = $('.ajaxIller').val();
				var ilce_id = <?php echo $res1; ?>;
				var base_url = "<?php echo base_url();?>";

				$.post(base_url+'home/get_ilceler', {il_id : il_id}, function(result){
					if ( result && result.status != 'error' )
					{
						var ilceler = result.data;
						var select = '<div class="ilceler"><div class="form-group"><label>İlçe</label><select id="ilce" name="ayarlar_ilce" class="form-control select" required>';
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
							var select = '<div class="ilceler"><div class="form-group"><label>İlçe</label><select id="ilce" name="ayarlar_ilce" class="form-control select" required>';
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

		<script type="text/javascript">
			$(document).ready(function(){
				$("#il").select2({
					width: '100%'
				});
			});
		</script>
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

		<?php if(!$ayarlarBanka) echo "addItemBanka();"; ?>
		function addItemBanka() {
			items_banka++;
			counter_banka.push(items_banka);
			document.getElementById("bankaCount").value = items_banka;
			var html = "<tr>";
			html += "<td><label>Banka Adı</label><input type='text' class='form-control' name='ayarlar_bankaadi[]' id='ayarlar_bankaadi"+items_banka+"'></td>";
			html += "<td><label>Şube</label><input type='text' class='form-control' name='ayarlar_sube[]' id='ayarlar_sube"+items_banka+"'></td>";
			html += "<td><label>Para Birimi</label><select class='form-control' name='ayarlar_parabirimi' id='ayarlar_parabirimi"+items_banka+"'><option value='1'>Türk Lirası</option><option value='2'>Amerikan Doları </option> <option value='3'>Euro</option><option value='4'> İngiliz Sterlini </option> </select> </td>";
			html +="<td><label>Hesap No</label><input type='text' class='form-control' name='ayarlar_hesapno[]' id='ayarlar_hesapno"+items_banka+"'></td>";
			html += "<td><label>IBAN</label><input type='text' class='form-control'name='ayarlar_iban[]' id='ayarlar_iban"+items_banka+"' ></td>"
			html += "<td><button type='button' class='btn btn-info btn-sm' onclick='addItemBanka()'> <i class='fa fa-plus'></i> Ekle </button> <button type='button' onclick='deleteRowBanka(this);' class='btn btn-danger btn-sm' id='"+items_banka+"'><i class='fa fa-trash'></i> Sil</button></td>";
			html += "</tr>";

			var row = document.getElementById("tbody_ayarlarbanka").insertRow();
			row.innerHTML = html;


		}

		function deleteRowBanka(button) {
			if (counter_banka.length >= 1) {
				counter_banka.pop();
			}
			if (counter_banka.length == 0) {
				counter_banka.push(1);
				toastr.warning("En az bir kayıt olması zorunludur, bu kayıt silinemez.");
			} else {
				var btnID = button.id;

				button.parentElement.parentElement.remove();
				var btnID = button.id;

				button.parentElement.parentElement.remove();
				$('#ayarlar_bankaadi' + btnID + '').remove();
				$('#ayarlar_sube' + btnID + '').remove();
				$('#ayarlar_parabirimi' + btnID + '').remove();
				$('#ayarlar_hesapno' + btnID + '').remove();
				$('#ayarlar_iban' + btnID + '').remove();
				items_banka--;

			}
			$("#bankaCount").val(items_banka);
		}
	</script>
	</body>
</html>
