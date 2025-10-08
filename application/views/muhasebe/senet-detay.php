<!DOCTYPE html>
<html lang="tr">
<head>
	<?php $this->load->view("include/head-tags"); ?>
</head>
<body>

<?php
$firma = getirFirma();
$deletePermission = $firma->ayarlar_deletePermission;

// Debug bilgisini görüntüle
if (isset($debug_info)) {
	echo $debug_info;
}
?>

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

<style>
/* Senet Detay Özel Stilleri */
.senet-detay-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.senet-info-card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
    background: white;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: -24px;
    top: 20px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: var(--timeline-color, #007bff);
    border: 3px solid white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.timeline-item.current::before {
    width: 16px;
    height: 16px;
    left: -26px;
    top: 18px;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.konum-degistir-form {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    margin-top: 20px;
}

.durum-badge {
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: bold;
    color: white;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: bold;
    color: #6c757d;
}

.vade-warning {
    background-color: #fff3cd;
    border: 1px solid #ffeaa7;
    color: #856404;
    padding: 10px;
    border-radius: 5px;
    margin: 10px 0;
}

.vade-danger {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
    padding: 10px;
    border-radius: 5px;
    margin: 10px 0;
}

/* Responsive */
@media (max-width: 768px) {
    .timeline {
        padding-left: 20px;
    }
    
    .timeline::before {
        left: 10px;
    }
    
    .timeline-item::before {
        left: -16px;
    }
    
    .timeline-item.current::before {
        left: -18px;
    }
}
</style>

<!-- Page Header -->
<div class="page-header">
	<div class="row">
		<div class="col-sm-10">
			<h3 class="page-title">Muhasebe / Senet Detayı</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('muhasebe/senet-yonetim'); ?>">Muhasebe</a></li>
				<li class="breadcrumb-item active">Senet Detayı</li>
			</ul>
		</div>
		<div class="d-flex justify-content-end text-align-center col-sm-2">
			<a class="btn btn-outline-light" href="javascript:history.back()">
				<i class="fa fa-history"></i> <br>Önceki Sayfa
			</a>
		</div>
	</div>
</div>
<!-- /Page Header -->

<div class="container-fluid">
    <!-- Header Section -->
    <div class="senet-detay-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="mb-0">
                    <i class="fas fa-file-invoice"></i> Senet Detayı
                </h2>
                <p class="mb-0 mt-2">Senet No: <strong><?= isset($senet->senet_no) ? $senet->senet_no : $senet->senet_id ?></strong></p>
            </div>
            <div class="col-md-4 text-right">
                <?php 
                $geri_url = $this->input->get('geri') ? $this->input->get('geri') : 'eldeki';
                ?>
                <a href="<?= base_url('muhasebe/senet-yonetim?durum=' . $geri_url) ?>" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i> Geri Dön
                </a>
                <a href="<?= base_url('senet/senet-duzenle/' . $senet->senet_id) ?>" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Düzenle
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Sol Taraf - Senet Bilgileri -->
        <div class="col-md-4">
            <div class="card senet-info-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Senet Bilgileri</h5>
                </div>
                <div class="card-body">
                    <div class="info-item">
                        <span class="info-label">Senet No:</span>
                        <span><strong><?= isset($senet->senet_no) ? $senet->senet_no : $senet->senet_id ?></strong></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Cari:</span>
                        <span><?= $senet->cari_ad ?></span>
                    </div>
                    <?php if($senet->cari_telefon): ?>
                    <div class="info-item">
                        <span class="info-label">Telefon:</span>
                        <span><?= $senet->cari_telefon ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="info-item">
                        <span class="info-label">Tutar:</span>
                        <span class="font-weight-bold text-success">₺<?= number_format($senet->senet_tutar, 2) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Vade Tarihi:</span>
                        <span><?= date('d.m.Y', strtotime($senet->senet_vadeTarih)) ?></span>
                    </div>
                    
                    <?php 
                        $vade_tarihi = new DateTime($senet->senet_vadeTarih);
                        $bugun = new DateTime();
                        $fark = $bugun->diff($vade_tarihi);
                    ?>
                    
                    <?php if ($vade_tarihi < $bugun): ?>
                        <div class="vade-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Dikkat!</strong> Vade tarihi <?= $fark->days ?> gün önce geçmiş.
                        </div>
                    <?php elseif ($fark->days <= 7): ?>
                        <div class="vade-warning">
                            <i class="fas fa-clock"></i>
                            <strong>Uyarı!</strong> Vade tarihine <?= $fark->days ?> gün kaldı.
                        </div>
                    <?php endif; ?>

                    <?php if($senet->senet_aciklama): ?>
                    <div class="info-item">
                        <span class="info-label">Açıklama:</span>
                        <span><?= $senet->senet_aciklama ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Konum Değiştirme Formu -->
            <div class="konum-degistir-form">
                <h5><i class="fas fa-exchange-alt"></i> Konum Değiştir</h5>
                <form method="post" action="<?= base_url('muhasebe/senet-konum-degistir') ?>">
                    <input type="hidden" name="senet_id" value="<?= $senet->senet_id ?>">
                    
                    <div class="form-group">
                        <label>Yeni Konum:</label>
                        <select name="yeni_konum" class="form-control" required>
                            <option value="">Konum Seçin</option>
                            <?php if(isset($konum_tipleri) && !empty($konum_tipleri)): ?>
                                <?php foreach($konum_tipleri as $konum): ?>
                                    <option value="<?= $konum->skt_id ?>" 
                                            style="background-color: <?= $konum->skt_renk ?>; color: white;">
                                        <?= $konum->skt_adi ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Banka (Opsiyonel):</label>
                        <select name="banka_id" class="form-control">
                            <option value="">Banka Seçin</option>
                            <?php if(isset($bankalar) && !empty($bankalar)): ?>
                                <?php foreach($bankalar as $banka): ?>
                                    <option value="<?= $banka->banka_id ?>"><?= $banka->banka_bankaAd ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Açıklama:</label>
                        <textarea name="aciklama" class="form-control" rows="3" 
                                  placeholder="Bu işlem hakkında açıklama..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save"></i> Konumu Değiştir
                    </button>
                </form>
            </div>
        </div>

        <!-- Sağ Taraf - Hareket Geçmişi -->
        <div class="col-md-8">
            <div class="card senet-info-card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-history"></i> Hareket Geçmişi 
                        <span class="badge badge-light"><?= count($hareketler) ?> hareket</span>
                    </h5>
                </div>
                <div class="card-body">
                    <?php if(empty($hareketler)): ?>
                        <div class="text-center py-4">
                            <i class="fas fa-history fa-2x text-muted mb-3"></i>
                            <p>Henüz hareket kaydı bulunmuyor.</p>
                        </div>
                    <?php else: ?>
                        <div class="timeline">
                            <?php 
                                $son_hareket = end($hareketler);
                                foreach($hareketler as $index => $hareket): 
                                    $is_current = ($hareket->sh_id == $son_hareket->sh_id);
                            ?>
                                <div class="timeline-item <?= $is_current ? 'current' : '' ?>" 
                                     style="--timeline-color: <?= $hareket->kt_renk ?>">
                                    
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">
                                                <span class="durum-badge" style="background-color: <?= $hareket->kt_renk ?>">
                                                    <?php if($hareket->kt_ikon): ?>
                                                        <i class="<?= $hareket->kt_ikon ?>"></i>
                                                    <?php endif; ?>
                                                    <?= $hareket->konum_adi ?>
                                                </span>
                                                <?php if($is_current): ?>
                                                    <span class="badge badge-success ml-2">Mevcut Durum</span>
                                                <?php endif; ?>
                                            </h6>
                                            
                                            <?php if($hareket->sh_not): ?>
                                                <p class="mb-2 text-muted"><?= $hareket->sh_not ?></p>
                                            <?php endif; ?>

                                            <div class="small text-muted">
                                                <div><i class="fas fa-calendar"></i> <?= date('d.m.Y H:i', strtotime($hareket->sh_tarih)) ?></div>
                                                <?php if($hareket->islem_yapan): ?>
                                                    <div><i class="fas fa-user"></i> <?= $hareket->islem_yapan ?></div>
                                                <?php endif; ?>
                                                <?php if($hareket->banka_ad): ?>
                                                    <div><i class="fas fa-university"></i> <?= $hareket->banka_ad ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="text-muted small">
                                            <?= date('H:i', strtotime($hareket->sh_tarih)) ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Flash message handling
<?php if($this->session->flashdata('senet_basarili')): ?>
    toastr.success('<?= $this->session->flashdata('senet_basarili') ?>');
<?php endif; ?>

<?php if($this->session->flashdata('basarili')): ?>
    toastr.success('<?= $this->session->flashdata('basarili') ?>');
<?php endif; ?>

<?php if($this->session->flashdata('hata')): ?>
    toastr.error('<?= $this->session->flashdata('hata') ?>');
<?php endif; ?>

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const yeniKonum = document.querySelector('select[name="yeni_konum"]').value;
    const aciklama = document.querySelector('textarea[name="aciklama"]').value;
    
    if (!yeniKonum) {
        e.preventDefault();
        toastr.error('Lütfen yeni konum seçin!');
        return;
    }
    
    if (!aciklama.trim()) {
        if (!confirm('Açıklama boş bırakılmış. Devam etmek istiyor musunuz?')) {
            e.preventDefault();
            return;
        }
    }
});
</script>

		</div>
	</div>
	<!-- /Page Wrapper -->
	
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<?php $this->load->view("include/footer-js"); ?>

</body>
</html>
