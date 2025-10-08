<!DOCTYPE html>
<html lang="tr">
<head>
    <?php $this->load->view("include/head-tags"); ?>
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background-color: #5c2d91;
            border-color: #5c2d91;
        }
        .btn-primary:hover {
            background-color: #4a2373;
            border-color: #4a2373;
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
                        <h3 class="page-title">Aktivasyon Yönetimi</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
                            <li class="breadcrumb-item active">Aktivasyon</li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-end text-align-center col-sm-2">
                        <a class="btn btn-outline-light" href="javascript:history.back()">
                            <i class="fa fa-history"></i><br>Önceki Sayfa
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Flash Messages -->
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title d-inline-block">Aktivasyon İşlemleri</h4>
                            <?php if(grup_modul_yetkisi_var(901)): ?>
                                <a href="<?= base_url('aktivasyon/olustur') ?>" class="btn btn-primary float-right">
                                    <i class="fa fa-plus"></i> Yeni Aktivasyon
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Aktivasyon Oluştur Card -->
                                <?php if(grup_modul_yetkisi_var(901)): ?>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card border-primary h-100">
                                        <div class="card-body text-center">
                                            <i class="fa fa-plus-circle fa-3x text-primary mb-3"></i>
                                            <h5 class="card-title">Aktivasyon Oluştur</h5>
                                            <p class="card-text">Yeni aktivasyon kaydı oluşturun ve müşteri bilgilerini yönetin.</p>
                                            <a href="<?= base_url('aktivasyon/olustur') ?>" class="btn btn-primary">
                                                <i class="fa fa-plus"></i> Oluştur
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- Aktivasyon Listesi Card -->
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card border-info h-100">
                                        <div class="card-body text-center">
                                            <i class="fa fa-list fa-3x text-info mb-3"></i>
                                            <h5 class="card-title">Aktivasyon Listesi</h5>
                                            <p class="card-text">Mevcut aktivasyonları görüntüleyin ve yönetin.</p>
                                            <a href="<?= base_url('aktivasyon/listele') ?>" class="btn btn-info">
                                                <i class="fa fa-list"></i> Listele
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- İstatistikler Card -->
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card border-success h-100">
                                        <div class="card-body text-center">
                                            <i class="fa fa-chart-bar fa-3x text-success mb-3"></i>
                                            <h5 class="card-title">İstatistikler</h5>
                                            <p class="card-text">Aktivasyon istatistiklerini ve raporları görüntüleyin.</p>
                                            <a href="<?= base_url('aktivasyon/istatistikler') ?>" class="btn btn-success">
                                                <i class="fa fa-chart-bar"></i> Görüntüle
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Son Aktivasyonlar -->
                            <div class="mt-4">
                                <h5>Son Aktivasyonlar</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Müşteri</th>
                                                <th>Üye No</th>
                                                <th>Kutu No</th>
                                                <th>Kart No</th>
                                                <th>Durum</th>
                                                <th>Tarih</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Son 10 aktivasyonu göster
                                            $anaHesap = anaHesapBilgisi();
                                            $sonAktivasyonlar = $this->db->query("
                                                SELECT a.*, c.cari_ad, ad.aktivasyon_durum_adi, ad.aktivasyon_durum_renk
                                                FROM aktivasyon a
                                                LEFT JOIN cari c ON a.aktivasyon_cari_id = c.cari_id
                                                LEFT JOIN aktivasyon_durum ad ON a.aktivasyon_durum_id = ad.aktivasyon_durum_id
                                                WHERE c.cari_olusturanAnaHesap = '$anaHesap'
                                                ORDER BY a.olusturma_tarihi DESC
                                                LIMIT 10
                                            ")->result();
                                            
                                            if(!empty($sonAktivasyonlar)):
                                                foreach($sonAktivasyonlar as $aktivasyon):
                                            ?>
                                            <tr>
                                                <td><?= $aktivasyon->aktivasyon_id ?></td>
                                                <td><?= $aktivasyon->cari_ad ?></td>
                                                <td><?= $aktivasyon->aktivasyon_uye_no ?></td>
                                                <td><?= $aktivasyon->aktivasyon_kutu_no ?></td>
                                                <td><?= $aktivasyon->aktivasyon_kart_no ?></td>
                                                <td>
                                                    <span class="badge" style="background-color: <?= $aktivasyon->aktivasyon_durum_renk ?>; color: white;">
                                                        <?= $aktivasyon->aktivasyon_durum_adi ?>
                                                    </span>
                                                </td>
                                                <td><?= date('d.m.Y H:i', strtotime($aktivasyon->olusturma_tarihi)) ?></td>
                                                <td>
                                                    <?php if(grup_modul_yetkisi_var(901)): ?>
                                                        <a href="<?= base_url('aktivasyon/olustur/'.$aktivasyon->aktivasyon_id) ?>" 
                                                           class="btn btn-sm btn-warning" title="Düzenle">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="<?= base_url('aktivasyon/sil/'.$aktivasyon->aktivasyon_id) ?>" 
                                                           class="btn btn-sm btn-danger" title="Sil"
                                                           onclick="return confirm('Bu aktivasyonu silmek istediğinizden emin misiniz?')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php 
                                                endforeach;
                                            else:
                                            ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Henüz aktivasyon kaydı bulunmamaktadır.</td>
                                            </tr>
                                            <?php endif; ?>
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

<?php $this->load->view("include/footer-js"); ?>
</body>
</html>
