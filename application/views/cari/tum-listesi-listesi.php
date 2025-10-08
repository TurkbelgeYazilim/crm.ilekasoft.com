<!DOCTYPE html>
<html lang="tr">

<head>
	<?php $this->load->view("include/head-tags"); ?>
	<style>
	.btn.text-danger, .btn.btn-white.text-danger, .btn.btn-danger, .btn-danger {
		color: #fff !important;
	}
	
	/* Görsel ve Evrak kolonları için stil */
	.gorsel-column, .evrak-column {
		width: 80px;
		text-align: center;
	}
	</style>
</head>

<body>
	<?php $this->load->view("include/header"); ?>
	<div class="container-fluid">
		<div class="row">
			<?php $this->load->view("include/sidebar"); ?>
			<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2">Tüm Listesi Listesi</h1>
					<div class="btn-toolbar mb-2 mb-md-0">
						<a href="<?php echo base_url('cari/cari-ekle'); ?>" class="btn btn-primary">Yeni Cari Ekle</a>
					</div>
				</div>

				<div class="table-responsive">
					<table class="table table-striped table-sm">
						<thead>
							<tr>
								<th>ID</th>
								<th>Ad Soyad</th>
								<th>Telefon</th>
								<th>E-posta</th>
								<th>Adres</th>
								<th>İşlemler</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($cariler as $cari): ?>
								<tr>
									<td><?php echo $cari->id; ?></td>
									<td><?php echo $cari->ad_soyad; ?></td>
									<td><?php echo $cari->telefon; ?></td>
									<td><?php echo $cari->eposta; ?></td>
									<td><?php echo $cari->adres; ?></td>
									<td>
										<a href="<?php echo base_url('cari/cari-duzenle/' . $cari->id); ?>" class="btn btn-sm btn-info">Düzenle</a>
										<a href="<?php echo base_url('cari/cari-sil/' . $cari->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bu cariyi silmek istediğinize emin misiniz?');">Sil</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</main>
		</div>
	</div>
	<?php $this->load->view("include/footer"); ?>
</body>
</html> 