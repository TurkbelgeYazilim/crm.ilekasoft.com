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

					<div class="page-header">
						<div class="row">
							<div class="col-sm-10">
								<h3 class="page-title">Fatura</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url();?>">Anasayfa</a></li>
									<li class="breadcrumb-item">Fatura</li>
									<li class="breadcrumb-item active">Seri Yönetimi</li>
								</ul>
							</div>
							<div class="d-flex justify-content-end text-align-center col-sm-2">
		<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
	</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">e-Fatura Seri Yönetimi <a href="" class="btn btn-success btn-sm" style="float:right;" data-toggle='modal' data-target='#efatura_Yeni_Seri'><i class="fa fa-plus"></i> Yeni Seri</a></h4>
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
											<tr>
												<th>Seri Ön Eki</th>
												<th>Seri Yılı</th>
												<th>Sıra Numarası</th>
												<th class="text-right">Varsayılan / İşlem</th>
											</tr>
											</thead>
											<tbody>
											<?php foreach($eFaturaSeri as $fatseri){?>
											<tr>
												<td><?php echo $fatseri->seri_seriOnEki; ?></td>
												<td><?php echo $fatseri->seri_seriYili; ?></td>
												<td><?php echo $fatseri->seri_siraNo; ?></td>
												<td class="text-right"><a href="<?= base_url("fatura/seriVarsayilan/$fatseri->seri_id/$fatseri->seri_urun"); ?>" class="btn <?php if($fatseri->seri_varsayilan == 1){echo "btn-success";}else{echo "btn-dark";} ?> btn-sm"><i class="fa fa-check"></i></a>
													<a href="" data-toggle='modal' data-target='#efatura_Seri_Guncelle' class="btn btn-success btn-sm text-light" onclick="$('#fatura_id').val('<?= $fatseri->seri_id ?>');$('#fatura_onek').val('<?= $fatseri->seri_seriOnEki ?>');$('#fatura_yil').val('<?= $fatseri->seri_seriYili ?>');$('#fatura_sirano').val('<?= $fatseri->seri_siraNo ?>');$('#fatura_aciklama').val('<?= $fatseri->seri_aciklama ?>');<?php if($fatseri->seri_varsayilan == 1) { echo "document.getElementById('fatura_varsayilan').checked=true;"; } ?>"><i class="fa fa-edit"></i></a></td>
											</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>


						<div class="col-md-6">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">e-Arşiv Fatura Seri Yönetimi <a href="" class="btn btn-success btn-sm" style="float:right;" data-toggle='modal' data-target='#eArsiv_Yeni_Seri'><i class="fa fa-plus"></i> Yeni Seri</a></h4>
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
											<tr>
												<th>Seri Ön Eki</th>
												<th>Tip</th>
												<th>Seri Yılı</th>
												<th>Sıra Numarası</th>
												<th class="text-right">Varsayılan / İşlem</th>
											</tr>
											</thead>
											<tbody>
											<?php foreach($eArsivSeri as $arsvseri){?>
												<tr>
													<td><?php echo $arsvseri->seri_seriOnEki; ?></td>
													<td><?php if($arsvseri->seri_eArsivTipi == 1){
														echo "Normal";
														}elseif($arsvseri->seri_eArsivTipi == 2) {
														echo "İnternet";
														}?></td>
													<td><?php echo $arsvseri->seri_seriYili; ?></td>
													<td><?php echo $arsvseri->seri_siraNo; ?></td>
													<td class="text-right"><a href="<?= base_url("fatura/seriVarsayilan/$arsvseri->seri_id/$arsvseri->seri_urun/$arsvseri->seri_eArsivTipi"); ?>" class="btn <?php if($arsvseri->seri_varsayilan == 1){echo "btn-success";}else{echo "btn-dark";} ?> btn-sm"><i class="fa fa-check"></i></a>
														<a href="" data-toggle='modal' data-target='#eArsiv_Seri_Guncelle' class="btn btn-success btn-sm text-light" onclick="$('#arsiv_id').val('<?= $arsvseri->seri_id ?>');$('#arsiv_onek').val('<?= $arsvseri->seri_seriOnEki ?>');$('#arsiv_yil').val('<?= $arsvseri->seri_seriYili ?>');$('#arsiv_sirano').val('<?= $arsvseri->seri_siraNo ?>');$('#arsiv_aciklama').val('<?= $arsvseri->seri_aciklama ?>');$('#arsiv_tip').val('<?= $arsvseri->seri_eArsivTipi ?>');<?php if($arsvseri->seri_varsayilan == 1) { echo "document.getElementById('arsiv_varsayilan').checked=true;"; } ?>"><i class="fa fa-edit"></i></a></td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>


						<div class="col-md-6">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">e-İrsaliye Seri Yönetimi <a href="" class="btn btn-success btn-sm" style="float:right;" data-toggle='modal' data-target='#eirsaliye_Yeni_Seri'><i class="fa fa-plus"></i> Yeni Seri</a></h4>
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
											<tr>
												<th>Seri Ön Eki</th>
												<th>Seri Yılı</th>
												<th>Sıra Numarası</th>
												<th class="text-right">Varsayılan / İşlem</th>
											</tr>
											</thead>
											<tbody>
											<?php foreach($eirsaliyeSeri as $eirsseri){?>
												<tr>
													<td><?php echo $eirsseri->seri_seriOnEki; ?></td>
													<td><?php echo $eirsseri->seri_seriYili; ?></td>
													<td><?php echo $eirsseri->seri_siraNo; ?></td>
													<td class="text-right"><a href="<?= base_url("fatura/seriVarsayilan/$eirsseri->seri_id/$eirsseri->seri_urun"); ?>" class="btn <?php if($eirsseri->seri_varsayilan == 1){echo "btn-success";}else{echo "btn-dark";} ?> btn-sm"><i class="fa fa-check"></i></a>
														<a href="" data-toggle='modal' data-target='#eirsaliye_Seri_Guncelle' class="btn btn-success btn-sm text-light" onclick="$('#irs_id').val('<?= $eirsseri->seri_id ?>');$('#irs_onek').val('<?= $eirsseri->seri_seriOnEki ?>');$('#irs_yil').val('<?= $eirsseri->seri_seriYili ?>');$('#irs_sirano').val('<?= $eirsseri->seri_siraNo ?>');$('#irs_aciklama').val('<?= $eirsseri->seri_aciklama ?>');<?php if($eirsseri->seri_varsayilan == 1) { echo "document.getElementById('irs_varsayilan').checked=true;"; } ?>"><i class="fa fa-edit"></i></a></td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>



						<div class="col-md-6">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">e-İrsaliye Yanıt Seri Yönetimi <a href="" class="btn btn-success btn-sm" style="float:right;" data-toggle='modal' data-target='#eirsaliyeYanit_Yeni_Seri'><i class="fa fa-plus"></i> Yeni Seri</a></h4>
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
											<tr>
												<th>Seri Ön Eki</th>
												<th>Seri Yılı</th>
												<th>Sıra Numarası</th>
												<th class="text-right">Varsayılan / İşlem</th>
											</tr>
											</thead>
											<tbody>
											<?php foreach($eirsaliyeYanitSeri as $eirsyanitseri){?>
												<tr>
													<td><?php echo $eirsyanitseri->seri_seriOnEki; ?></td>
													<td><?php echo $eirsyanitseri->seri_seriYili; ?></td>
													<td><?php echo $eirsyanitseri->seri_siraNo; ?></td>
													<td class="text-right"><a href="<?= base_url("fatura/seriVarsayilan/$eirsyanitseri->seri_id/$eirsyanitseri->seri_urun"); ?>" class="btn <?php if($eirsyanitseri->seri_varsayilan == 1){echo "btn-success";}else{echo "btn-dark";} ?> btn-sm"><i class="fa fa-check"></i></a>
														<a href="" data-toggle='modal' data-target='#eirsaliyeYanit_Seri_Guncelle' class="btn btn-success btn-sm text-light" onclick="$('#irsYanit_id').val('<?= $eirsyanitseri->seri_id ?>');$('#irsYanit_onek').val('<?= $eirsyanitseri->seri_seriOnEki ?>');$('#irsYanit_yil').val('<?= $eirsyanitseri->seri_seriYili ?>');$('#irsYanit_sirano').val('<?= $eirsyanitseri->seri_siraNo ?>');$('#irsYanit_aciklama').val('<?= $eirsyanitseri->seri_aciklama ?>');<?php if($eirsyanitseri->seri_varsayilan == 1) { echo "document.getElementById('irsYanit_varsayilan').checked=true;"; } ?>"><i class="fa fa-edit"></i></a></td>
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
		</div>

		<div id="efatura_Yeni_Seri" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">e-Fatura Numarası Üret</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url("fatura/seriEkle"); ?>" method="POST">

							<input class="form-control" type="hidden" value="1" name="seri_urun" required="">

							<div class="form-group">
								<label>Seri Ön Eki <span class="text-danger">*</span> (Örn: ILE)</label>
								<input class="form-control" type="text"  name="seri_seriOnEki" required=""  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" autocomplete="off" onkeydown="upperCaseF(this)">
							</div>

							<div class="form-group">
								<label>Sıra Numarası <span class="text-danger">*</span> (Örn: 1.......9)</label>
								<input class="form-control" type="number" name="seri_siraNo" required="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" autocomplete="off">
							</div>

							<div class="form-group">
								<label>Seri Yılı <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="seri_seriYili" required="" value="<?php echo date("Y"); ?>" readonly>
							</div>

							<div class="form-group">
								<label>Açıklama</label>
								<input class="form-control" type="text" name="seri_aciklama" placeholder="Sıra numarası ile ilgili hatırlatıcı bir açıklama, zorunlu değildir.">
							</div>

							<div class="form-group">
								<label>Varsayılan</label>
								<input type="checkbox" value="1" name="seri_varsayilan">
							</div>

							<div class="submit-section">
								<button class="btn btn-danger submit-btn">Kaydet</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div id="eArsiv_Yeni_Seri" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">e-Arşiv Numarası Üret</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url("fatura/seriEkle"); ?>" method="POST">

							<input class="form-control" type="hidden" value="2" name="seri_urun" required="">

							<div class="form-group">
								<label>e-Arşiv Tipi <span class="text-danger">*</span></label>
								<select class="form-control" name="seri_eArsivTipi" required="">
									<option value="1">Normal</option>
									<option value="2">İnternet</option>
								</select>
							</div>

							<div class="form-group">
								<label>Seri Ön Eki <span class="text-danger">*</span> (Örn: ILE)</label>
								<input class="form-control" type="text"  name="seri_seriOnEki" required=""  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" autocomplete="off" onkeydown="upperCaseF(this)">
							</div>

							<div class="form-group">
								<label>Sıra Numarası <span class="text-danger">*</span> (Örn: 1.......9)</label>
								<input class="form-control" type="number" name="seri_siraNo" required="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" autocomplete="off">
							</div>

							<div class="form-group">
								<label>Seri Yılı <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="seri_seriYili" required="" value="<?php echo date("Y"); ?>" readonly>
							</div>

							<div class="form-group">
								<label>Açıklama</label>
								<input class="form-control" type="text" name="seri_aciklama" placeholder="Sıra numarası ile ilgili hatırlatıcı bir açıklama, zorunlu değildir." autocomplete="off">
							</div>

							<div class="form-group">
								<label>Varsayılan</label>
								<input type="checkbox" value="1" name="seri_varsayilan">
							</div>

							<div class="submit-section">
								<button class="btn btn-danger submit-btn">Kaydet</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div id="eirsaliye_Yeni_Seri" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">e-İrsaliye Numarası Üret</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url("fatura/seriEkle"); ?>" method="POST">

							<input class="form-control" type="hidden" value="3" name="seri_urun" required="">

							<div class="form-group">
								<label>Seri Ön Eki <span class="text-danger">*</span> (Örn: ILE)</label>
								<input class="form-control" type="text"  name="seri_seriOnEki" required=""  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" autocomplete="off" onkeydown="upperCaseF(this)">
							</div>

							<div class="form-group">
								<label>Sıra Numarası <span class="text-danger">*</span> (Örn: 1.......9)</label>
								<input class="form-control" type="number" name="seri_siraNo" required="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" autocomplete="off">
							</div>

							<div class="form-group">
								<label>Seri Yılı <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="seri_seriYili" required="" value="<?php echo date("Y"); ?>" readonly>
							</div>

							<div class="form-group">
								<label>Açıklama</label>
								<input class="form-control" type="text" name="seri_aciklama" placeholder="Sıra numarası ile ilgili hatırlatıcı bir açıklama, zorunlu değildir.">
							</div>

							<div class="form-group">
								<label>Varsayılan</label>
								<input type="checkbox" value="1" name="seri_varsayilan">
							</div>

							<div class="submit-section">
								<button class="btn btn-danger submit-btn">Kaydet</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div id="eirsaliyeYanit_Yeni_Seri" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">e-İrsaliye Numarası Üret</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url("fatura/seriEkle"); ?>" method="POST">

							<input class="form-control" type="hidden" value="4" name="seri_urun" required="">

							<div class="form-group">
								<label>Seri Ön Eki <span class="text-danger">*</span> (Örn: ILE)</label>
								<input class="form-control" type="text"  name="seri_seriOnEki" required=""  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" autocomplete="off" onkeydown="upperCaseF(this)">
							</div>

							<div class="form-group">
								<label>Sıra Numarası <span class="text-danger">*</span> (Örn: 1.......9)</label>
								<input class="form-control" type="number" name="seri_siraNo" required="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" autocomplete="off">
							</div>

							<div class="form-group">
								<label>Seri Yılı <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="seri_seriYili" required="" value="<?php echo date("Y"); ?>" readonly>
							</div>

							<div class="form-group">
								<label>Açıklama</label>
								<input class="form-control" type="text" name="seri_aciklama" placeholder="Sıra numarası ile ilgili hatırlatıcı bir açıklama, zorunlu değildir.">
							</div>

							<div class="form-group">
								<label>Varsayılan</label>
								<input type="checkbox" value="1" name="seri_varsayilan">
							</div>

							<div class="submit-section">
								<button class="btn btn-danger submit-btn">Kaydet</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div id="efatura_Seri_Guncelle" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">e-Fatura Numarası Güncelle</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url("fatura/seriGuncelle"); ?>" method="POST">

							<input class="form-control" type="hidden" value="1" name="seri_urun" required="">
							<input class="form-control" type="hidden" value="" name="seri_id" required="" id="fatura_id">

							<div class="form-group">
								<label>Seri Ön Eki <span class="text-danger">*</span> (Örn: ILE)</label>
								<input class="form-control" type="text"  name="seri_seriOnEki" required=""  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" autocomplete="off" onkeydown="upperCaseF(this)" id="fatura_onek">
							</div>

							<div class="form-group">
								<label>Sıra Numarası <span class="text-danger">*</span> (Örn: 1.......9)</label>
								<input class="form-control" type="number" name="seri_siraNo" required="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" autocomplete="off" id="fatura_sirano">
							</div>

							<div class="form-group">
								<label>Seri Yılı <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="seri_seriYili" required="" value="<?php echo date("Y"); ?>" readonly id="fatura_yil">
							</div>

							<div class="form-group">
								<label>Açıklama</label>
								<input class="form-control" type="text" name="seri_aciklama" placeholder="Sıra numarası ile ilgili hatırlatıcı bir açıklama, zorunlu değildir." id="fatura_aciklama">
							</div>

							<div class="form-group">
								<label>Varsayılan</label>
								<input type="checkbox" value="1" name="seri_varsayilan" id="fatura_varsayilan">
							</div>

							<div class="submit-section">
								<button class="btn btn-danger submit-btn">Kaydet</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div id="eArsiv_Seri_Guncelle" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">e-Arşiv Numarası Güncelle</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url("fatura/seriGuncelle"); ?>" method="POST">

							<input class="form-control" type="hidden" value="2" name="seri_urun" required="">
							<input class="form-control" type="hidden" value="" name="seri_id" required="" id="arsiv_id">

							<div class="form-group">
								<label>e-Arşiv Tipi <span class="text-danger">*</span></label>
								<select class="form-control" name="seri_eArsivTipi" required="" id="arsiv_tip">
									<option value="1">Normal</option>
									<option value="2">İnternet</option>
								</select>
							</div>

							<div class="form-group">
								<label>Seri Ön Eki <span class="text-danger">*</span> (Örn: ILE)</label>
								<input class="form-control" type="text"  name="seri_seriOnEki" required=""  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" autocomplete="off" onkeydown="upperCaseF(this)" id="arsiv_onek">
							</div>

							<div class="form-group">
								<label>Sıra Numarası <span class="text-danger">*</span> (Örn: 1.......9)</label>
								<input class="form-control" type="number" name="seri_siraNo" required="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" autocomplete="off" id="arsiv_sirano">
							</div>

							<div class="form-group">
								<label>Seri Yılı <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="seri_seriYili" required="" value="<?php echo date("Y"); ?>" readonly id="arsiv_yil">
							</div>

							<div class="form-group">
								<label>Açıklama</label>
								<input class="form-control" type="text" name="seri_aciklama" placeholder="Sıra numarası ile ilgili hatırlatıcı bir açıklama, zorunlu değildir." autocomplete="off" id="arsiv_aciklama">
							</div>

							<div class="form-group">
								<label>Varsayılan</label>
								<input type="checkbox" value="1" name="seri_varsayilan" id="arsiv_varsayilan">
							</div>

							<div class="submit-section">
								<button class="btn btn-danger submit-btn">Kaydet</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


		<div id="eirsaliye_Seri_Guncelle" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">e-İrsaliye Numarası Güncelle</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url("fatura/seriGuncelle"); ?>" method="POST">

							<input class="form-control" type="hidden" value="3" name="seri_urun" required="">
							<input class="form-control" type="hidden" value="" name="seri_id" required="" id="irs_id">

							<div class="form-group">
								<label>Seri Ön Eki <span class="text-danger">*</span> (Örn: ILE)</label>
								<input class="form-control" type="text"  name="seri_seriOnEki" required=""  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" autocomplete="off" onkeydown="upperCaseF(this)" id="irs_onek">
							</div>

							<div class="form-group">
								<label>Sıra Numarası <span class="text-danger">*</span> (Örn: 1.......9)</label>
								<input class="form-control" type="number" name="seri_siraNo" required="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" autocomplete="off" id="irs_sirano">
							</div>

							<div class="form-group">
								<label>Seri Yılı <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="seri_seriYili" required="" value="<?php echo date("Y"); ?>" readonly id="irs_yil">
							</div>

							<div class="form-group">
								<label>Açıklama</label>
								<input class="form-control" type="text" name="seri_aciklama" placeholder="Sıra numarası ile ilgili hatırlatıcı bir açıklama, zorunlu değildir." id="irs_aciklama">
							</div>

							<div class="form-group">
								<label>Varsayılan</label>
								<input type="checkbox" value="1" name="seri_varsayilan" id="irs_varsayilan">
							</div>

							<div class="submit-section">
								<button class="btn btn-danger submit-btn">Kaydet</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div id="eirsaliyeYanit_Seri_Guncelle" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">e-İrsaliye Yanıt Numarası Güncelle</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url("fatura/seriGuncelle"); ?>" method="POST">

							<input class="form-control" type="hidden" value="4" name="seri_urun" required="">
							<input class="form-control" type="hidden" value="" name="seri_id" required="" id="irsYanit_id">

							<div class="form-group">
								<label>Seri Ön Eki <span class="text-danger">*</span> (Örn: ILE)</label>
								<input class="form-control" type="text"  name="seri_seriOnEki" required=""  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" autocomplete="off" onkeydown="upperCaseF(this)" id="irsYanit_onek">
							</div>

							<div class="form-group">
								<label>Sıra Numarası <span class="text-danger">*</span> (Örn: 1.......9)</label>
								<input class="form-control" type="number" name="seri_siraNo" required="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9" autocomplete="off" id="irsYanit_sirano">
							</div>

							<div class="form-group">
								<label>Seri Yılı <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="seri_seriYili" required="" value="<?php echo date("Y"); ?>" readonly id="irsYanit_yil">
							</div>

							<div class="form-group">
								<label>Açıklama</label>
								<input class="form-control" type="text" name="seri_aciklama" placeholder="Sıra numarası ile ilgili hatırlatıcı bir açıklama, zorunlu değildir." id="irsYanit_aciklama">
							</div>

							<div class="form-group">
								<label>Varsayılan</label>
								<input type="checkbox" value="1" name="seri_varsayilan" id="irsYanit_varsayilan">
							</div>

							<div class="submit-section">
								<button class="btn btn-danger submit-btn">Kaydet</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php if ($this->session->flashdata('seri_fatura_basarili')): ?>
		<script>
		swal({
		  title: "Bilgilendirme",
		  type: "success",
		  text: "Seri tanımlama işlemi başarılı.",
		  confirmButtonText:'Tamam',
		  button: false,
		  timer: 5000,
		});
		</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('seri_arsiv_basarili')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "E-Arşiv Fatura seri tanımlama işlemi başarılı.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('seri_arsiv_guncelle_basarili')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "Seri güncelleme işlemi başarılı.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('seri_ozel_karakter')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "E-Fatura seri ön eki özel karakter içeremez.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('seri_fatura_mevcut')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "E-Fatura için aynı seri ön eki mevcuttur.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>
		<?php if ($this->session->flashdata('seri_arsiv_mevcut')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "E-Arşiv Fatura için aynı seri ön eki mevcuttur.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('seri_karakter_siniri')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "E-Fatura seri ön eki 3 haneli olmalıdır.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('varsayilan_ok')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "success",
					text: "Varsayılan seri değiştirildi.",
					confirmButtonText:'Tamam',
					button: false,
					timer: 5000,
				});
			</script>
		<?php endif; ?>

		<?php if ($this->session->flashdata('seri_var')): ?>
			<script>
				swal({
					title: "Bilgilendirme",
					type: "error",
					text: "Seri ön eki farklı bir seri için mevcut, tekrar deneyiniz.",
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
