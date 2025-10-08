<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
</head>
<body>

<div class="main-wrapper">

	<?php $this->load->view("include/header"); ?>

	<?php $this->load->view("include/sidebar"); ?>

	<?php
		$departman = $talep->destek_department;
		if($departman == 1){
			$departman_text = "Teknik Destek";
		}else if($departman == 2){
			$departman_text = "Muhasebe";
		}else if($departman == 3){
			$departman_text = "Satış";
		}else if($departman == 4){
			$departman_text = "Şikayet / İstek / Öneri";
		}else{$departman_text="Hata...";}

		$durum = $talep->destek_status;
		if($durum == 1){
			$durum_text = "Açık";
		}else if($durum == 2){
			$durum_text = "İşlemde";
		}else if($durum == 3){
			$durum_text = "Kapalı";
		}else{$durum_text = "Hata...";}

		$olusturanID = $talep->destek_olusturan;
		$firmaID = $talep->destek_olusturanAnaHesap;

		$firmaKim = getirFirmaById($firmaID);
		$kullaniciKim = getirKullaniciById($olusturanID);
	?>

	<div class="page-wrapper">
		<div class="content container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="chat-window">
						<div class="chat-cont-right">
							<div class="chat-header">
								<div class="media d-flex">
									<div class="media-body">
										<div class="user-name"><b>Konu:</b> <?= $talep->destek_title; ?></div>
										<div class="user-name"><b>Firma:</b> <?=$firmaKim->ayarlar_firmaAd;?></div>
										<div class="user-status"><?=$departman_text." - ".$durum_text;?></div>
									</div>
								</div>
								<div class="chat-options">
									<a href="<?= base_url("admin/destek");?>">
										<i data-feather="arrow-left" class="mr-1"></i>
									</a>
								</div>
							</div>
							<div class="chat-body">
								<div class="chat-scroll">
									<ul class="list-unstyled">

										<?php foreach($yanitlar as $yanit){ ?>
												<?php if($yanit->dyanit_isAdmin == 1){ ?>
												<li class="media sent">
													<div class="media-body">
														<div class="msg-box">
															<div>
																<p><?php if($yanit->dyanit_resim != NULL){ ?><a href="<?= base_url("assets/bulut/tickets/$yanit->dyanit_resim"); ?>" target="_blank" style="color:#AAA!important;"><i class="fas fa-paperclip"></i></a><?php }?> <?=$yanit->dyanit_mesaj;?></p>
																<ul class="chat-msg-info">
																	<li>
																		<div class="chat-time">
																			<span>destek@ilekasoft.com</span>
																			<br>
																			<span><?= date('d.m.Y H:i', strtotime($yanit->dyanit_tarih)); ?></span>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</li>
												<?php }else{?>
												<li class="media d-flex received">
													<div class="media-body">
														<div class="msg-box">
															<div>
																<p><?php if($yanit->dyanit_resim != NULL){ ?><a href="<?= base_url("assets/bulut/tickets/$yanit->dyanit_resim"); ?>" target="_blank" style="color:#AAA!important;"><i class="fas fa-paperclip"></i></a><?php }?> <?=$yanit->dyanit_mesaj;?></p>
																<ul class="chat-msg-info">
																	<li>
																		<div class="chat-time">
																			<span><?php echo $kullaniciKim->kullanici_eposta; ?></span><br>
																			<span><?= date('d.m.Y H:i', strtotime($yanit->dyanit_tarih)); ?></span>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</li>
												<?php }?>
										<?php }?>
									</ul>
								</div>
							</div>
							<form action="<?= base_url("admin/dyanit_gonder"); ?>" method="post">
								<input type="hidden" name="dyanit_destekID" value="<?= $this->uri->segment(4);?>">
							<div class="chat-footer">
								<div class="input-group">
									<!-- <div class="input-group-prepend">
										<div class="btn-file btn">
											<i class="fas fa-paperclip"></i>
											<input type="file">
										</div>
									</div> -->
									<textarea class="input-msg-send form-control" name="dyanit_mesaj"></textarea>
									<div class="input-group-append">
										<button type="submit" class="btn msg-send-btn"><i class="fas fa-paper-plane"></i></button>
									</div>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>

<?php if ($this->session->flashdata('destekyanit_ok')): ?>
	<script>
		swal({
			title: "Bilgilendirme",
			type: "success",
			text: "Yanıtınız gönderildi.",
			confirmButtonText:'Tamam',
			button: false,
			timer: 5000,
		});
	</script>
<?php endif; ?>

<?php $this->load->view("include/footer-js"); ?>
</body>
</html>
