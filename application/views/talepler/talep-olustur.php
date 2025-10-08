<!DOCTYPE html>
<html lang="tr">
<head>
    <?php $this->load->view("include/head-tags"); ?>    <style>
        .form-section {
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
                                                                                                   <textarea class="form-control" name="talep_cari_aciklama" rows="4" 
                                                          placeholder="Talep ile ilgili açıklamalar..."><?= isset($talep) ? '' : '' ?></textarea><textarea class="form-control" name="talep_cari_adres" rows="3" 
                                                          placeholder="Adres detayları..."><?= isset($talep) ? $talep->potansiyel_cari_adres : '' ?></textarea>     background-color: #f8f9fa;
        }
        .form-section h6 {
            color: #495057;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .required { color: #dc3545; }
        .form-control {
            font-size: 14px;
            max-width: 100%;
        }
        .card {
            max-width: 100%;
            overflow-x: auto;
        }
        
        /* Container için maksimum genişlik */
        .page-wrapper {
            max-width: 100vw;
            overflow-x: hidden;
        }
        
        .content.container-fluid {
            max-width: 100%;
            padding-left: 15px;
            padding-right: 15px;
        }
        
        /* Form elemanları için responsive genişlik */
        .form-control, .form-select {
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box;
        }
        
        textarea.form-control {
            min-height: 80px;
            resize: vertical;
        }
        
        /* Mobil uyumluluk */
        @media (max-width: 768px) {
            .form-section {
                padding: 10px;
                margin-bottom: 10px;
            }
            
            .page-wrapper {
                padding: 0;
            }
            
            .content.container-fluid {
                padding: 10px;
            }
            
            .card-body {
                padding: 15px;
            }
            
            .col-md-6, .col-md-4 {
                padding-left: 7px;
                padding-right: 7px;
            }
        }
        
        @media (max-width: 576px) {
            .card-body {
                padding: 10px;
            }
            
            .form-section {
                padding: 8px;
            }
            
            .btn {
                font-size: 14px;
                padding: 8px 12px;
            }
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php $this->load->view("include/header"); ?>
        <?php $this->load->view("include/sidebar"); ?>
        
        <div class="page-wrapper">
            <div class="content container-fluid">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">
                                <?= isset($edit_mode) && $edit_mode ? 'Talep Düzenle' : 'Talep Oluştur' ?>
                            </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('talepler'); ?>">Talepler</a></li>
                                <?php if (isset($edit_mode) && $edit_mode): ?>
                                    <li class="breadcrumb-item"><a href="<?= base_url('talepler/talep-detay/' . $talep_id); ?>">Talep Detayı</a></li>
                                    <li class="breadcrumb-item active">Düzenle</li>
                                <?php else: ?>
                                    <li class="breadcrumb-item active">Talep Oluştur</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-outline-primary" href="<?= base_url('talepler'); ?>">
                                <i class="fa fa-arrow-left me-1"></i> Talep Listesi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">
                                    <?php if (isset($edit_mode) && $edit_mode): ?>
                                        <i class="fa fa-edit text-warning"></i> Talep Düzenleme Formu
                                    <?php else: ?>
                                        <i class="fa fa-plus-circle text-primary"></i> Yeni Talep Formu
                                    <?php endif; ?>
                                </h4>
                            </div>
                            <div class="card-body">
                                <!-- Flash Messages -->
                                <?php if ($this->session->flashdata('talep_basarili')): ?>
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <i class="fa fa-check-circle me-2"></i>
                                        <?= $this->session->flashdata('talep_basarili'); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($this->session->flashdata('talep_hata')): ?>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <i class="fa fa-exclamation-circle me-2"></i>
                                        <?= $this->session->flashdata('talep_hata'); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                <?php endif; ?>

                                <form action="<?= base_url('talepler/talep-kaydet'); ?>" method="POST" id="talepForm">
                                    <?php if (isset($edit_mode) && $edit_mode): ?>
                                        <input type="hidden" name="talep_id" value="<?= $talep_id ?>">
                                    <?php endif; ?>
                                    
                                    <!-- Kişi/Firma Bilgileri -->
                                    <div class="form-section">
                                        <h6><i class="fa fa-user text-primary"></i> Kişi/Firma Bilgileri</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Ad Soyad <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="talep_cari_adsoyad" 
                                                       value="<?= isset($talep) ? $talep->potansiyel_cari_ad : '' ?>" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Telefon</label>
                                                <input type="text" class="form-control" name="talep_cari_telefon" 
                                                       value="<?= isset($talep) ? $talep->potansiyel_cari_firmaTelefon : '' ?>" 
                                                       placeholder="+90 5XX XXX XX XX">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">E-posta</label>
                                                <input type="email" class="form-control" name="talep_cari_eposta" 
                                                       value="<?= isset($talep) ? '' : '' ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Firma</label>
                                                <input type="text" class="form-control" name="talep_cari_firma" 
                                                       value="<?= isset($talep) ? '' : '' ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Sektör</label>
                                                <select class="form-control" name="talep_cari_sektor_id">
                                                    <option value="">Sektör Seçiniz</option>
                                                    <?php if (isset($sektorler)): ?>
                                                        <?php foreach ($sektorler as $sektor): ?>
                                                            <option value="<?= $sektor->sektor_id; ?>" 
                                                                    <?= (isset($talep) && $talep->sektor_id == $sektor->sektor_id) ? 'selected' : '' ?>>
                                                                <?= $sektor->sektor_adi; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Lokasyon Bilgileri -->
                                    <div class="form-section">
                                        <h6><i class="fa fa-map-marker text-primary"></i> Lokasyon Bilgileri</h6>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Ülke</label>
                                                <select class="form-control" name="talep_cari_ulke_id" id="ulke_select">
                                                    <option value="">Ülke Seçiniz</option>
                                                    <?php if (isset($ulkeler)): ?>
                                                        <?php foreach ($ulkeler as $ulke): ?>
                                                            <option value="<?= $ulke->id; ?>" 
                                                                    <?php 
                                                                    if (isset($talep) && $talep->potansiyel_ulke_id == $ulke->id) {
                                                                        echo 'selected';
                                                                    } elseif (!isset($talep) && $ulke->id == 3) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>
                                                                <?= $ulke->ulke_adi; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">İl</label>
                                                <select class="form-control" id="il_select" name="talep_cari_il_id" 
                                                        data-selected="<?= isset($talep) ? $talep->potansiyel_il_id : '' ?>">
                                                    <option value="">İl Seçiniz</option>
                                                    <?php if (isset($iller)): ?>
                                                        <?php foreach ($iller as $il): ?>
                                                            <option value="<?= $il->id; ?>" 
                                                                    <?= (isset($talep) && $talep->potansiyel_il_id == $il->id) ? 'selected' : '' ?>>
                                                                <?= $il->il; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">İlçe</label>
                                                <select class="form-control" id="ilce_select" name="talep_cari_ilce_id"
                                                        data-selected="<?= isset($talep) ? $talep->potansiyel_ilce_id : '' ?>">
                                                    <?php if (isset($ilceler) && !empty($ilceler)): ?>
                                                        <option value="">İlçe Seçiniz</option>
                                                        <?php foreach ($ilceler as $ilce): ?>
                                                            <option value="<?= $ilce->id; ?>" 
                                                                    <?= (isset($talep) && $talep->potansiyel_ilce_id == $ilce->id) ? 'selected' : '' ?>>
                                                                <?= $ilce->ilce; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <option value="">Önce İl Seçiniz</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Mahalle</label>
                                                <input type="text" class="form-control" name="talep_cari_mahalle" 
                                                       value="<?= isset($talep) ? $talep->potansiyel_mahalle : '' ?>">
                                            </div>
                                            <div class="col-md-8 mb-3">
                                                <label class="form-label">Adres</label>
                                                <textarea class="form-control" name="talep_cari_adres" rows="2" 
                                                          placeholder="Adres detayları..."><?= isset($talep) ? $talep->talep_cari_adres : '' ?></textarea>
                                            </div>
                                        </div>
                                    </div>                                    <!-- Talep Bilgileri -->
                                    <div class="form-section">
                                        <h6><i class="fa fa-file-text text-primary"></i> Talep Bilgileri</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Talep Kaynağı</label>
                                                <select class="form-control" name="talep_cari_talep_kaynaklari_id">
                                                    <option value="">Kaynak Seçiniz</option>
                                                    <?php if (isset($talep_kaynaklari)): ?>
                                                        <?php foreach ($talep_kaynaklari as $kaynak): ?>
                                                            <option value="<?= $kaynak->talep_kaynaklari_id; ?>" 
                                                                    <?= (isset($talep) && false) ? 'selected' : '' ?>>
                                                                <?= $kaynak->talep_kaynaklari_adi; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Talep Durumu</label>
                                                <select class="form-control" name="talep_cari_talep_durumlari_id">
                                                    <?php if (isset($talep_durumlari)): ?>
                                                        <?php foreach ($talep_durumlari as $durum): ?>
                                                            <option value="<?= $durum->talep_durumlari_id; ?>" 
                                                                    <?php 
                                                                    if (isset($talep) && false) {
                                                                        echo 'selected';
                                                                    } elseif (!isset($talep) && $durum->talep_durumlari_id == 1) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>
                                                                <?= $durum->talep_durumlari_adi; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Açıklama</label>
                                                <textarea class="form-control" name="talep_cari_aciklama" rows="3" 
                                                          placeholder="Talep ile ilgili açıklamalar..."><?= isset($talep) ? $talep->talep_cari_aciklama : '' ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Randevu Bilgileri -->
                                    <div class="form-section">
                                        <h6><i class="fa fa-calendar text-primary"></i> Randevu Bilgileri (Opsiyonel)</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Randevu Tarihi</label>
                                                <input type="date" class="form-control" name="talep_cari_randevu_tarih" 
                                                       value="<?= isset($talep) && false ? '' : '' ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Randevu Saati</label>
                                                <input type="time" class="form-control" name="talep_cari_randevu_saat" 
                                                       value="<?= isset($talep) && false ? '' : '' ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Butonları -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="submit-section text-center">
                                                <button class="btn btn-primary me-2" type="submit">
                                                    <?php if (isset($edit_mode) && $edit_mode): ?>
                                                        <i class="fa fa-save me-1"></i> Talep Güncelle
                                                    <?php else: ?>
                                                        <i class="fa fa-save me-1"></i> Talep Oluştur
                                                    <?php endif; ?>
                                                </button>
                                                <a href="<?= base_url('talepler'); ?>" class="btn btn-secondary">
                                                    <i class="fa fa-times me-1"></i> İptal
                                                </a>
                                            </div>
                                        </div>
                                    </div>                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- jQuery CDN with Local Fallback -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" 
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" 
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        if (typeof jQuery === 'undefined') {
            document.write('<script src="<?= base_url(); ?>assets/js/jquery.min.js"><\/script>');
        }
    </script>
    
    <!-- Bootstrap Bundle -->
    <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
    
    <!-- Local Scripts -->
    <script src="<?= base_url(); ?>assets/js/script.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    
    <!-- Talep Form Specific Scripts -->
    <script src="<?= base_url(); ?>assets/js/talep-form-new.js"></script>
</body>
</html>
