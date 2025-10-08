<!DOCTYPE html>
<html lang="tr">
<head>
    <?php $this->load->view("include/head-tags"); ?>
    <style>
        .info-card {
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
        }
        .info-card h5 {
            color: #495057;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            color: white;
            font-weight: 500;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .info-label {
            font-weight: 600;
            color: #6c757d;
        }
        .info-value {
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php $this->load->view("include/header"); ?>
        <?php $this->load->view("include/sidebar"); ?>
        
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <h3 class="page-title">Talep Detayı</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('talepler/talepler-listesi'); ?>">Talepler</a></li>
                                <li class="breadcrumb-item active">Talep Detayı</li>
                            </ul>
                        </div>
                        <div class="col-sm-4 text-right">
                            <a class="btn btn-warning me-2" href="<?= base_url('talepler/talep-duzenle/' . $talep->id); ?>">
                                <i class="fa fa-edit"></i> Düzenle
                            </a>
                            <a class="btn btn-outline-light" href="<?= base_url('talepler/talepler-listesi'); ?>">
                                <i class="fa fa-arrow-left"></i> Talep Listesi
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Flash Mesajları -->
                <?php if ($this->session->flashdata('talep_basarili')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Başarılı!</strong> <?= $this->session->flashdata('talep_basarili'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('talep_hata')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Hata!</strong> <?= $this->session->flashdata('talep_hata'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('hata')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Hata!</strong> <?= $this->session->flashdata('hata'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($talep) && $talep): ?>
                <div class="row">
                    <!-- Kişi/Firma Bilgileri -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <h5><i class="fa fa-user"></i> Kişi/Firma Bilgileri</h5>
                            <div class="info-item">
                                <span class="info-label">Ad Soyad:</span>
                                <span class="info-value"><?= $talep->talep_cari_adsoyad; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Telefon:</span>
                                <span class="info-value">
                                    <?php if ($talep->talep_cari_telefon): ?>
                                        <a href="tel:<?= $talep->talep_cari_telefon; ?>" class="text-success">
                                            <i class="fa fa-phone"></i> <?= $talep->talep_cari_telefon; ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">Belirtilmemiş</span>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">E-posta:</span>
                                <span class="info-value">
                                    <?php if ($talep->talep_cari_eposta): ?>
                                        <a href="mailto:<?= $talep->talep_cari_eposta; ?>" class="text-primary">
                                            <i class="fa fa-envelope"></i> <?= $talep->talep_cari_eposta; ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">Belirtilmemiş</span>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Firma:</span>
                                <span class="info-value"><?= $talep->talep_cari_firma ?: 'Belirtilmemiş'; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Sektör:</span>
                                <span class="info-value"><?= $talep->sektor_adi ?: 'Belirtilmemiş'; ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Lokasyon Bilgileri -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <h5><i class="fa fa-map-marker"></i> Lokasyon Bilgileri</h5>
                            <div class="info-item">
                                <span class="info-label">Ülke:</span>
                                <span class="info-value"><?= $talep->ulke_adi ?: 'Belirtilmemiş'; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">İl:</span>
                                <span class="info-value"><?= $talep->il_adi ?: 'Belirtilmemiş'; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">İlçe:</span>
                                <span class="info-value"><?= $talep->ilce_adi ?: 'Belirtilmemiş'; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Mahalle:</span>
                                <span class="info-value"><?= $talep->talep_cari_mahalle ?: 'Belirtilmemiş'; ?></span>
                            </div>                            <?php if ($talep->talep_cari_adres): ?>
                            <div class="info-item">
                                <span class="info-label">Adres:</span>
                                <span class="info-value"><?= nl2br($talep->talep_cari_adres); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if ($talep->talep_cari_aciklama): ?>
                            <div class="info-item">
                                <span class="info-label">Açıklama:</span>
                                <span class="info-value"><?= nl2br($talep->talep_cari_aciklama); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Talep Bilgileri -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <h5><i class="fa fa-file-text"></i> Talep Bilgileri</h5>
                            <div class="info-item">
                                <span class="info-label">Talep ID:</span>
                                <span class="info-value"><strong>#<?= $talep->talep_cari_id; ?></strong></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Kaynak:</span>
                                <span class="info-value">
                                    <?php if ($talep->talep_kaynaklari_adi): ?>
                                        <span class="badge badge-info"><?= $talep->talep_kaynaklari_adi; ?></span>
                                    <?php else: ?>
                                        <span class="text-muted">Belirtilmemiş</span>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Durum:</span>
                                <span class="info-value">
                                    <?php if ($talep->talep_durumlari_adi): ?>
                                        <span class="status-badge" style="background-color: <?= $talep->talep_durumlari_renk ?: '#6c757d'; ?>">
                                            <?= $talep->talep_durumlari_adi; ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted">Belirtilmemiş</span>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Oluşturan:</span>
                                <span class="info-value"><?= $talep->kullanici_adsoyad ?: 'Bilinmiyor'; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Oluşturma Tarihi:</span>
                                <span class="info-value"><?= date('d.m.Y H:i:s', strtotime($talep->talep_cari_olusturma_zamani)); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Randevu Bilgileri -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <h5><i class="fa fa-calendar"></i> Randevu Bilgileri</h5>
                            <?php if ($talep->talep_cari_randevu): ?>
                                <div class="info-item">
                                    <span class="info-label">Randevu Tarihi:</span>
                                    <span class="info-value">
                                        <i class="fa fa-calendar text-warning"></i>
                                        <?= date('d.m.Y', strtotime($talep->talep_cari_randevu)); ?>
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Randevu Saati:</span>
                                    <span class="info-value">
                                        <i class="fa fa-clock-o text-warning"></i>
                                        <?= date('H:i', strtotime($talep->talep_cari_randevu)); ?>
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Randevu Durumu:</span>
                                    <span class="info-value">
                                        <?php
                                        $now = new DateTime();
                                        $randevu = new DateTime($talep->talep_cari_randevu);
                                        if ($randevu > $now) {
                                            echo '<span class="badge badge-warning">Gelecek</span>';
                                        } else {
                                            echo '<span class="badge badge-secondary">Geçmiş</span>';
                                        }
                                        ?>
                                    </span>
                                </div>
                            <?php else: ?>
                                <div class="text-center text-muted py-3">
                                    <i class="fa fa-calendar-times-o fa-2x mb-2"></i>
                                    <p>Henüz randevu planlanmamış</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- İşlem Butonları -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="btn-group" role="group">
                                    <a href="<?= base_url('talepler/talepler-listesi'); ?>" class="btn btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Talep Listesi
                                    </a>
                                    <?php if (grup_modul_yetkisi_var(1810)): ?>
                                        <button type="button" class="btn btn-warning" onclick="durumDegistir()">
                                            <i class="fa fa-edit"></i> Durum Değiştir
                                        </button>
                                        <button type="button" class="btn btn-info" onclick="randevuDuzenle()">
                                            <i class="fa fa-calendar"></i> Randevu Düzenle
                                        </button>
                                    <?php endif; ?>
                                    <?php if ($talep->talep_cari_telefon): ?>
                                        <a href="tel:<?= $talep->talep_cari_telefon; ?>" class="btn btn-success">
                                            <i class="fa fa-phone"></i> Ara
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($talep->talep_cari_eposta): ?>
                                        <a href="mailto:<?= $talep->talep_cari_eposta; ?>" class="btn btn-primary">
                                            <i class="fa fa-envelope"></i> E-posta
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php else: ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="fa fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                                <h4>Talep Bulunamadı</h4>
                                <p class="text-muted">Aradığınız talep bulunamadı veya erişim yetkiniz bulunmuyor.</p>
                                <a href="<?= base_url('talepler/talepler-listesi'); ?>" class="btn btn-primary">
                                    <i class="fa fa-arrow-left"></i> Talep Listesine Dön
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>    <!-- Scripts -->
    <script src="<?= base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/script.js"></script>
    <script src="<?= base_url(); ?>assets/js/app.js"></script>

    <!-- Sidebar Toggle Fix -->
    <script>
        $(document).ready(function() {
            // Sidebar toggle için ek kod
            $('#toggle_btn').off('click').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('Toggle button clicked');
                
                if ($('body').hasClass('mini-sidebar')) {
                    $('body').removeClass('mini-sidebar');
                    $(this).removeClass('active');
                } else {
                    $('body').addClass('mini-sidebar');
                    $(this).addClass('active');
                }
            });
            
            // Mobile toggle
            $(document).off('click', '#mobile_btn').on('click', '#mobile_btn', function(e) {
                e.preventDefault();
                console.log('Mobile button clicked');
                $('body').toggleClass('slide-nav');
                $('.sidebar-overlay').toggleClass('opened');
            });
        });
    </script>

    <script>
        function durumDegistir() {
            // Durum değiştirme işlemi için gelecekte ekleme yapılabilir
            alert('Durum değiştirme özelliği için talep düzenleme sayfasını kullanabilirsiniz.');
        }

        function randevuDuzenle() {
            // Randevu düzenleme için talep düzenleme sayfasına yönlendirme
            window.location.href = '<?= base_url('talepler/talep-duzenle/' . $talep->talep_cari_id); ?>';
        }
    </script>
</body>
</html>
