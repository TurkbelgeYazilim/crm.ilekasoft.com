<!DOCTYPE html>

<html lang="tr">

<head>

    <?php $this->load->view("include/head-tags"); ?>

    <!-- DataTables CSS -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css">

    <style>

        /* Mobil cihazlarda destek butonu ile çakışmayı önlemek için */

        @media (max-width: 768px) {

            .content {

                padding-bottom: 80px !important;

            }

            .card:last-child {

                margin-bottom: 80px !important;

            }

        }

        

        /* Tablo genel optimizasyonları */

        #raporTablosu {

            font-size: 12px;

            white-space: nowrap;

        }

        

        #raporTablosu th,

        #raporTablosu td {

            padding: 6px 4px !important;

            vertical-align: middle;

            text-align: center !important;

        }

        

        /* Şehir sütunu sol hizalı */

        #raporTablosu th:nth-child(2),

        #raporTablosu td:nth-child(2) {

            text-align: left !important;

        }

        

        /* Sıra numarası sütunu dar */

        #raporTablosu th:nth-child(1),

        #raporTablosu td:nth-child(1) {

            width: 35px !important;

            min-width: 35px !important;

            max-width: 35px !important;

            text-align: center !important;

        }

        

        /* Şehir sütunu sol hizalı */

        #raporTablosu th:nth-child(2),

        #raporTablosu td:nth-child(2) {

            width: 120px !important;

            min-width: 120px !important;

            max-width: 120px !important;

            text-align: left !important;

        }

        

        /* Digiturk sütunları (mor) */

        #raporTablosu th:nth-child(3),

        #raporTablosu th:nth-child(4),

        #raporTablosu th:nth-child(5),

        #raporTablosu td:nth-child(3),

        #raporTablosu td:nth-child(4),

        #raporTablosu td:nth-child(5) {

            width: 80px !important;

            min-width: 80px !important;

            max-width: 80px !important;

        }

        

        /* S Sport sütunları (mavi) */

        #raporTablosu th:nth-child(6),

        #raporTablosu th:nth-child(7),

        #raporTablosu th:nth-child(8),

        #raporTablosu td:nth-child(6),

        #raporTablosu td:nth-child(7),

        #raporTablosu td:nth-child(8) {

            width: 80px !important;

            min-width: 80px !important;

            max-width: 80px !important;

        }

        

        /* TABII sütunları (yeşil) */

        #raporTablosu th:nth-child(9),

        #raporTablosu th:nth-child(10),

        #raporTablosu th:nth-child(11),

        #raporTablosu td:nth-child(9),

        #raporTablosu td:nth-child(10),

        #raporTablosu td:nth-child(11) {

            width: 80px !important;

            min-width: 80px !important;

            max-width: 80px !important;

        }

        

        /* Ortak ve Genel sütunları */

        #raporTablosu th:nth-child(12),

        #raporTablosu th:nth-child(13),

        #raporTablosu td:nth-child(12),

        #raporTablosu td:nth-child(13) {

            width: 80px !important;

            min-width: 80px !important;

            max-width: 80px !important;

        }

        

        /* Renk sınıfları - DIGITURK (MOR) */

        .bg-purple {

            background-color: #6f42c1 !important;

        }

        

        .bg-purple-light {

            background-color: rgba(111, 66, 193, 0.1) !important;

        }

        

        .text-purple {

            color: #6f42c1 !important;

        }

        

        .badge-purple {

            background-color: #6f42c1 !important;

            color: white !important;

        }

        

        /* Renk sınıfları - S SPORT (MAVİ) */

        .bg-blue {

            background-color: #007bff !important;

        }

        

        .bg-blue-light {

            background-color: rgba(0, 123, 255, 0.1) !important;

        }

        

        .text-blue {

            color: #007bff !important;

        }

        

        .badge-blue {

            background-color: #007bff !important;

            color: white !important;

        }

        

        /* Renk sınıfları - TABII (YEŞİL) */

        .bg-green {

            background-color: #28a745 !important;

        }

        

        .bg-green-light {

            background-color: rgba(40, 167, 69, 0.1) !important;

        }

        

        .text-green {

            color: #28a745 !important;

        }

        

        .badge-green {

            background-color: #28a745 !important;

            color: white !important;

        }

        

        /* Renk sınıfları - ORTAK (TURKUAZ) */

        .bg-info-light {

            background-color: rgba(23, 162, 184, 0.1) !important;

        }

        

        /* Renk sınıfları - GENEL TOPLAM (GRİ) */

        .bg-dark-light {

            background-color: rgba(52, 58, 64, 0.1) !important;

        }

        

        .badge-dark {

            background-color: #343a40 !important;

            color: white !important;

        }
        
        /* Modal içindeki badge stilleri */
        .badge-purple {
            background-color: #6f42c1 !important;
            color: white !important;
        }
        
        .badge-primary {
            background-color: #007bff !important;
            color: white !important;
        }
        
        .badge-secondary {
            background-color: #6c757d !important;
            color: white !important;
        }
        
        .badge-info {
            background-color: #17a2b8 !important;
            color: white !important;
        }

        

        /* Tablo responsive container */

        .table-responsive {

            margin: 0 -15px;

            padding: 0 15px;

            overflow-x: auto;

        }

        

        /* Sayfa başlığı kompakt */

        .page-header {

            margin-bottom: 15px;

        }

        

        /* Kart padding azalt */

        .card-body {

            padding: 1rem;

        }

        

        /* Filtreleme alanını vurgula */

        .form-control-lg {

            box-shadow: 0 0 10px rgba(0,123,255,0.25);

        }

        

        /* Select2 Styling */

        .select2-container--default .select2-selection--single {

            height: calc(2.75rem + 2px);

            border: 2px solid #007bff;

            background-color: #f8f9fa;

            border-radius: 0.375rem;

        }

        

        .select2-container--default .select2-selection--single .select2-selection__rendered {

            line-height: calc(2.75rem - 2px);

            padding-left: 12px;

            font-weight: bold;

            color: #495057;

        }

        

        .select2-container--default .select2-selection--single .select2-selection__arrow {

            height: calc(2.75rem - 2px);

        }

        

        /* Mobil responsive iyileştirmeler */

        @media (max-width: 992px) {

            #raporTablosu {

                font-size: 11px;

            }

            

            #raporTablosu th,

            #raporTablosu td {

                padding: 4px 2px !important;

            }

            

            /* Mobilde sütun genişliklerini daha da daralt */

            #raporTablosu th:nth-child(1),

            #raporTablosu td:nth-child(1) {

                width: 25px !important;

                min-width: 25px !important;

            }

            

            #raporTablosu th:nth-child(2),

            #raporTablosu td:nth-child(2) {

                width: 80px !important;

                min-width: 80px !important;

            }

            

            #raporTablosu th:nth-child(3),

            #raporTablosu th:nth-child(5),

            #raporTablosu th:nth-child(7),

            #raporTablosu td:nth-child(3),

            #raporTablosu td:nth-child(5),

            #raporTablosu td:nth-child(7) {

                width: 50px !important;

                min-width: 50px !important;

            }

            

            #raporTablosu th:nth-child(4),

            #raporTablosu th:nth-child(6),

            #raporTablosu th:nth-child(8),

            #raporTablosu th:nth-child(9),

            #raporTablosu td:nth-child(4),

            #raporTablosu td:nth-child(6),

            #raporTablosu td:nth-child(8),

            #raporTablosu td:nth-child(9) {

                width: 60px !important;

                min-width: 60px !important;

            }

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

                            <h3 class="page-title"><?= $baslik ?></h3>

                            <ul class="breadcrumb">

                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Anasayfa</a></li>

                                <li class="breadcrumb-item"><a href="<?= base_url('raporlar') ?>">Raporlar</a></li>

                                <li class="breadcrumb-item active">Digiturk Şehir Ciro/Adet</li>

                            </ul>

                        </div>

                        <div class="d-flex justify-content-end text-align-center col-sm-2">

                            <a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>

                        </div>

                    </div>

                </div>

                <!-- /Page Header -->



            <!-- Aktif Filtre Bildirimi -->

            <?php if (!empty($sehir_id)): ?>

            <div class="row mb-3">

                <div class="col-md-12">

                    <div class="alert alert-info alert-dismissible fade show" role="alert">

                        <i class="fas fa-info-circle"></i>

                        <strong>Filtre Aktif:</strong> Sadece 

                        <strong>

                        <?php 

                        $secili_sehir_adi = 'Bilinmeyen Şehir';

                        foreach($sehir_listesi as $sehir) {

                            if($sehir->id == $sehir_id) {

                                $secili_sehir_adi = $sehir->sehir_adi;

                                break;

                            }

                        }

                        echo $secili_sehir_adi;

                        ?>

                        </strong> 

                        şehrindeki veriler gösteriliyor. 

                        <a href="<?= base_url('raporlar/digiturk-sehir-ciro-adet?baslangic_tarihi='.$baslangic_tarihi.'&bitis_tarihi='.$bitis_tarihi) ?>" 

                           class="btn btn-sm btn-outline-primary ml-2">

                            <i class="fas fa-times"></i> Filtreyi Kaldır

                        </a>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                        </button>

                    </div>

                </div>

            </div>

            <?php endif; ?>

            <!-- Filtreler -->

            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-header">

                            <h5 class="card-title">Filtreler</h5>

                        </div>

                        <div class="card-body">

                            <form method="GET" action="<?= base_url('raporlar/digiturk-sehir-ciro-adet') ?>">

                                <div class="row">

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label for="sehir_id"><i class="fas fa-map-marker-alt"></i> <strong>Şehir Seç</strong></label>

                                            <select class="form-control form-control-lg" id="sehir_id" name="sehir_id" style="border: 2px solid #007bff; background-color: #f8f9fa;">

                                                <option value="">🏙️ Tüm Şehirler</option>

                                                <?php foreach($sehir_listesi as $sehir): ?>

                                                    <option value="<?= $sehir->id ?>" <?= ($sehir_id == $sehir->id) ? 'selected' : '' ?>>

                                                        <?= $sehir->sehir_adi ?>

                                                    </option>

                                                <?php endforeach; ?>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <label for="baslangic_tarihi">Başlangıç Tarihi</label>

                                            <input type="date" class="form-control" id="baslangic_tarihi" name="baslangic_tarihi" value="<?= $baslangic_tarihi ?>">

                                        </div>

                                    </div>

                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <label for="bitis_tarihi">Bitiş Tarihi</label>

                                            <input type="date" class="form-control" id="bitis_tarihi" name="bitis_tarihi" value="<?= $bitis_tarihi ?>">

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label>&nbsp;</label>

                                            <div class="d-flex">

                                                <button type="submit" class="btn btn-primary btn-lg mr-2">

                                                    <i class="fas fa-filter"></i> Filtrele

                                                </button>

                                                <button type="button" class="btn btn-secondary btn-lg" onclick="resetFilters()">

                                                    <i class="fas fa-undo"></i> Temizle

                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <label>&nbsp;</label>

                                            <div>

                                                <button type="button" class="btn btn-success btn-lg w-100" onclick="exportToExcel()">

                                                    <i class="fas fa-file-excel"></i> Excel

                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>



            <!-- Rapor Tablosu -->

            <div class="row">

                <div class="col-md-12">

                    <!-- Debug Bilgileri - Geçici olarak gizlendi (sorun çözüldü) -->

                    <?php if(false && isset($debug_info)): ?>

                    <div class="card mb-3">

                        <div class="card-header bg-warning">

                            <h5 class="card-title text-dark">

                                <i class="fas fa-bug"></i> Debug Bilgileri (Geliştirme Amaçlı)

                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-2">

                                    <strong>Aktivasyon Kayıtları:</strong> <?= $debug_info['aktivasyon_count'] ?>

                                </div>

                                <div class="col-md-3">

                                    <strong>Satış Kayıtları (<?= $baslangic_tarihi ?> - <?= $bitis_tarihi ?>):</strong> <?= $debug_info['satis_count'] ?>

                                </div>

                                <div class="col-md-2">

                                    <strong>Şehir Bilgisi Olan Cariler:</strong> <?= $debug_info['cari_sehir_count'] ?>

                                </div>

                                <div class="col-md-2">

                                    <strong>JOIN Sonucu:</strong> <?= $debug_info['join_test_count'] ?>

                                </div>

                                <div class="col-md-3">

                                    <strong>Alternatif Sorgu Kullanıldı:</strong> 

                                    <?= isset($debug_info['used_alternative']) ? ($debug_info['used_alternative'] ? 'Evet' : 'Hayır') : 'Bilinmiyor' ?>

                                    <br>

                                    <strong>Bulunan Kayıt:</strong> <?= count($rapor_verileri) ?>

                                </div>

                            </div>

                        </div>

                    </div>

                    <?php endif; ?>

                    

                    <div class="card">

                        <div class="card-header">

                            <h5 class="card-title">

                                Digiturk Şehir Ciro/Adet Raporu

                                <span class="badge badge-info ml-2"><?= count($rapor_verileri) ?> şehir</span>

                            </h5>

                            <div class="card-tools">

                                <button type="button" class="btn btn-sm btn-success" onclick="exportToExcel()">

                                    <i class="fas fa-file-excel"></i> Excel'e Aktar

                                </button>

                            </div>

                        </div>

                        <div class="card-body">

                            <!-- Legend -->

                            <div class="table-responsive">

                                <table class="table table-striped table-hover table-sm" id="raporTablosu">

                                    <thead class="thead-dark">

                                        <tr>

                                            <th rowspan="2" class="align-middle">#</th>

                                            <th rowspan="2" class="align-middle"><i class="fas fa-map-marker-alt"></i> Şehir</th>

                                            <th colspan="3" class="text-center bg-purple text-white">

                                                <i class="fas fa-tv"></i> DIGITURK

                                            </th>

                                            <th colspan="3" class="text-center bg-blue text-white">

                                                <i class="fas fa-futbol"></i> S SPORT

                                            </th>

                                            <th colspan="3" class="text-center bg-green text-white">

                                                <i class="fas fa-play-circle"></i> TABII

                                            </th>

                                            <th colspan="2" class="text-center bg-dark text-white">

                                                <i class="fas fa-chart-bar"></i> GENEL TOPLAM

                                            </th>

                                        </tr>

                                        <tr>

                                            <th class="bg-purple text-white">Adet</th>

                                            <th class="bg-purple text-white">Ciro</th>

                                            <th class="bg-purple text-white">Ortalama</th>

                                            <th class="bg-blue text-white">Adet</th>

                                            <th class="bg-blue text-white">Ciro</th>

                                            <th class="bg-blue text-white">Ortalama</th>

                                            <th class="bg-green text-white">Adet</th>

                                            <th class="bg-green text-white">Ciro</th>

                                            <th class="bg-green text-white">Ortalama</th>

                                            <th class="bg-dark text-white">Toplam Adet</th>

                                            <th class="bg-dark text-white">Toplam Ciro</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php 

                                        $toplam_adet = 0;

                                        $toplam_digiturk = 0;

                                        $toplam_digiturk_ciro = 0;

                                        $toplam_ssport = 0;

                                        $toplam_ssport_ciro = 0;

                                        $toplam_tabii = 0;

                                        $toplam_tabii_ciro = 0;

                                        $toplam_ortak = 0;

                                        $toplam_ciro = 0;

                                        $sira = 1;

                                        foreach($rapor_verileri as $veri): 

                                            $toplam_adet += $veri->toplam_satis_adedi;

                                            $toplam_digiturk += $veri->digiturk_satis_adedi;

                                            $toplam_digiturk_ciro += isset($veri->digiturk_ciro) ? $veri->digiturk_ciro : 0;

                                            $toplam_ssport += $veri->ssport_satis_adedi;

                                            $toplam_ssport_ciro += isset($veri->ssport_ciro) ? $veri->ssport_ciro : 0;

                                            $toplam_tabii += isset($veri->tabii_satis_adedi) ? $veri->tabii_satis_adedi : 0;

                                            $toplam_tabii_ciro += isset($veri->tabii_ciro) ? $veri->tabii_ciro : 0;

                                            $toplam_ortak += isset($veri->ortak_satis_adedi) ? $veri->ortak_satis_adedi : 0;

                                            $toplam_ciro += $veri->toplam_ciro;

                                            

                                            // Ortalama hesaplamaları

                                            $digiturk_ciro_val = isset($veri->digiturk_ciro) ? $veri->digiturk_ciro : 0;

                                            $ssport_ciro_val = isset($veri->ssport_ciro) ? $veri->ssport_ciro : 0;

                                            $tabii_ciro_val = isset($veri->tabii_ciro) ? $veri->tabii_ciro : 0;

                                            $digiturk_ortalama = $veri->digiturk_satis_adedi > 0 ? ($digiturk_ciro_val / $veri->digiturk_satis_adedi) : 0;

                                            $ssport_ortalama = $veri->ssport_satis_adedi > 0 ? ($ssport_ciro_val / $veri->ssport_satis_adedi) : 0;

                                            $tabii_satis_adedi = isset($veri->tabii_satis_adedi) ? $veri->tabii_satis_adedi : 0;

                                            $tabii_ortalama = $tabii_satis_adedi > 0 ? ($tabii_ciro_val / $tabii_satis_adedi) : 0;

                                        ?>

                                        <tr>

                                            <td><?= $sira++ ?></td>

                                            <td>

                                                <strong><?= $veri->sehir_adi ?? 'Belirtilmemiş' ?></strong>

                                            </td>

                                            <!-- DIGITURK GRUBU -->

                                            <td class="bg-purple-light">

                                                <button type="button" 

                                                        class="btn btn-link p-0 digiturk-detay-btn" 

                                                        data-sehir-id="<?= $veri->cari_il ?>" 

                                                        data-sehir-adi="<?= $veri->sehir_adi ?? 'Belirtilmemiş' ?>"

                                                        data-baslangic="<?= $baslangic_tarihi ?>"

                                                        data-bitis="<?= $bitis_tarihi ?>"

                                                        title="Digiturk müşteri detaylarını görüntüle">

                                                    <span class="badge badge-purple"><?= number_format($veri->digiturk_satis_adedi) ?></span>

                                                </button>

                                            </td>

                                            <td class="bg-purple-light">

                                                <strong class="text-purple"><?= number_format($digiturk_ciro_val, 2) ?> ₺</strong>

                                            </td>

                                            <td class="bg-purple-light">

                                                <span class="text-purple"><?= number_format($digiturk_ortalama, 2) ?> ₺</span>

                                            </td>

                                            

                                            <!-- S SPORT GRUBU -->

                                            <td class="bg-blue-light">

                                                <button type="button" 

                                                        class="btn btn-link p-0 ssport-detay-btn" 

                                                        data-sehir-id="<?= $veri->cari_il ?>" 

                                                        data-sehir-adi="<?= $veri->sehir_adi ?? 'Belirtilmemiş' ?>"

                                                        data-baslangic="<?= $baslangic_tarihi ?>"

                                                        data-bitis="<?= $bitis_tarihi ?>"

                                                        title="S Sport müşteri detaylarını görüntüle">

                                                    <span class="badge badge-blue"><?= number_format($veri->ssport_satis_adedi) ?></span>

                                                </button>

                                            </td>

                                            <td class="bg-blue-light">

                                                <strong class="text-blue"><?= number_format($ssport_ciro_val, 2) ?> ₺</strong>

                                            </td>

                                            <td class="bg-blue-light">

                                                <span class="text-blue"><?= number_format($ssport_ortalama, 2) ?> ₺</span>

                                            </td>

                                            

                                            <!-- TABII GRUBU -->

                                            <td class="bg-green-light">

                                                <button type="button" 

                                                        class="btn btn-link p-0 tabii-detay-btn" 

                                                        data-sehir-id="<?= $veri->cari_il ?>" 

                                                        data-sehir-adi="<?= $veri->sehir_adi ?? 'Belirtilmemiş' ?>"

                                                        data-baslangic="<?= $baslangic_tarihi ?>"

                                                        data-bitis="<?= $bitis_tarihi ?>"

                                                        title="TABII müşteri detaylarını görüntüle">

                                                    <span class="badge badge-green"><?= number_format($tabii_satis_adedi) ?></span>

                                                </button>

                                            </td>

                                            <td class="bg-green-light">

                                                <strong class="text-green"><?= number_format($tabii_ciro_val, 2) ?> ₺</strong>

                                            </td>

                                            <td class="bg-green-light">

                                                <span class="text-green"><?= number_format($tabii_ortalama, 2) ?> ₺</span>

                                            </td>

                                            

                                            <!-- GENEL TOPLAM GRUBU -->

                                            <td class="bg-dark-light">

                                                <button type="button" 

                                                        class="btn btn-link p-0 satis-detay-btn" 

                                                        data-sehir-id="<?= $veri->cari_il ?>" 

                                                        data-sehir-adi="<?= $veri->sehir_adi ?? 'Belirtilmemiş' ?>"

                                                        data-baslangic="<?= $baslangic_tarihi ?>"

                                                        data-bitis="<?= $bitis_tarihi ?>"

                                                        title="Müşteri detaylarını görüntüle">

                                                    <span class="badge badge-dark"><?= number_format($veri->toplam_satis_adedi) ?></span>

                                                </button>

                                            </td>

                                            <td class="bg-dark-light">

                                                <strong class="text-dark"><?= number_format($veri->toplam_ciro, 2) ?> ₺</strong>

                                            </td>

                                        </tr>

                                        <?php endforeach; ?>

                                        

                                        <?php if(empty($rapor_verileri)): ?>

                                        <tr>

                                            <td colspan="13" class="text-center text-muted">

                                                <i class="fas fa-info-circle"></i>

                                                Seçilen tarih aralığında veri bulunamadı.

                                            </td>

                                        </tr>

                                        <?php endif; ?>

                                    </tbody>

                                    <?php if(!empty($rapor_verileri)): ?>

                                    <tfoot class="thead-light">

                                        <tr>

                                            <th class="text-center">TOPLAM:</th>
                                            <th></th>

                                            

                                            <!-- DIGITURK TOPLAM -->

                                            <th class="bg-purple-light">

                                                <button type="button" 

                                                        class="btn btn-link p-0 digiturk-detay-btn" 

                                                        data-sehir-id="" 

                                                        data-sehir-adi="Tüm Şehirler"

                                                        data-baslangic="<?= $baslangic_tarihi ?>"

                                                        data-bitis="<?= $bitis_tarihi ?>"

                                                        title="Tüm şehirler için Digiturk müşteri detaylarını görüntüle">

                                                    <span class="badge badge-purple"><?= number_format($toplam_digiturk) ?></span>

                                                </button>

                                            </th>

                                            <th class="bg-purple-light">

                                                <strong class="text-purple"><?= number_format($toplam_digiturk_ciro, 2) ?> ₺</strong>

                                            </th>

                                            <th class="bg-purple-light">

                                                <strong class="text-purple"><?= $toplam_digiturk > 0 ? number_format($toplam_digiturk_ciro / $toplam_digiturk, 2) : '0.00' ?> ₺</strong>

                                            </th>

                                            

                                            <!-- S SPORT TOPLAM -->

                                            <th class="bg-blue-light">

                                                <button type="button" 

                                                        class="btn btn-link p-0 ssport-detay-btn" 

                                                        data-sehir-id="" 

                                                        data-sehir-adi="Tüm Şehirler"

                                                        data-baslangic="<?= $baslangic_tarihi ?>"

                                                        data-bitis="<?= $bitis_tarihi ?>"

                                                        title="Tüm şehirler için S Sport müşteri detaylarını görüntüle">

                                                    <span class="badge badge-blue"><?= number_format($toplam_ssport) ?></span>

                                                </button>

                                            </th>

                                            <th class="bg-blue-light">

                                                <strong class="text-blue"><?= number_format($toplam_ssport_ciro, 2) ?> ₺</strong>

                                            </th>

                                            <th class="bg-blue-light">

                                                <strong class="text-blue"><?= $toplam_ssport > 0 ? number_format($toplam_ssport_ciro / $toplam_ssport, 2) : '0.00' ?> ₺</strong>

                                            </th>

                                            

                                            <!-- TABII TOPLAM -->

                                            <th class="bg-green-light">

                                                <button type="button" 

                                                        class="btn btn-link p-0 tabii-detay-btn" 

                                                        data-sehir-id="" 

                                                        data-sehir-adi="Tüm Şehirler"

                                                        data-baslangic="<?= $baslangic_tarihi ?>"

                                                        data-bitis="<?= $bitis_tarihi ?>"

                                                        title="Tüm şehirler için TABII müşteri detaylarını görüntüle">

                                                    <span class="badge badge-green"><?= number_format($toplam_tabii) ?></span>

                                                </button>

                                            </th>

                                            <th class="bg-green-light">

                                                <strong class="text-green"><?= number_format($toplam_tabii_ciro, 2) ?> ₺</strong>

                                            </th>

                                            <th class="bg-green-light">

                                                <strong class="text-green"><?= $toplam_tabii > 0 ? number_format($toplam_tabii_ciro / $toplam_tabii, 2) : '0.00' ?> ₺</strong>

                                            </th>

                                            

                                            <!-- GENEL TOPLAM -->

                                            <th class="bg-dark-light">

                                                <button type="button" 

                                                        class="btn btn-link p-0 satis-detay-btn" 

                                                        data-sehir-id="" 

                                                        data-sehir-adi="Tüm Şehirler"

                                                        data-baslangic="<?= $baslangic_tarihi ?>"

                                                        data-bitis="<?= $bitis_tarihi ?>"

                                                        title="Tüm şehirler için müşteri detaylarını görüntüle">

                                                    <span class="badge badge-dark"><?= number_format($toplam_adet) ?></span>

                                                </button>

                                            </th>

                                            <th class="bg-dark-light">

                                                <strong class="text-dark"><?= number_format($toplam_ciro, 2) ?> ₺</strong>

                                            </th>

                                        </tr>

                                    </tfoot>

                                    <?php endif; ?>

                                </table>

                            </div>

                        </div>

                    </div>

                    

                    <!-- Şehir Performans Özeti -->

                    <?php if(!empty($rapor_verileri)): ?>

                    <div class="card mt-3">

                        <div class="card-header">

                            <h5 class="card-title">

                                <i class="fas fa-chart-bar"></i> Şehir Performans Özeti

                            </h5>

                        </div>

                        <div class="card-body">

                            <!-- İlk Satır - Genel Bilgiler -->

                            <div class="row mb-3">

                                <div class="col-md-3">

                                    <div class="info-box bg-primary">

                                        <span class="info-box-icon"><i class="fas fa-city"></i></span>

                                        <div class="info-box-content">

                                            <span class="info-box-text">Toplam Şehir</span>

                                            <span class="info-box-number"><?= count($rapor_verileri) ?></span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="info-box bg-success">

                                        <span class="info-box-icon"><i class="fas fa-trophy"></i></span>

                                        <div class="info-box-content">

                                            <span class="info-box-text">En Yüksek Toplam Ciro</span>

                                            <span class="info-box-number">

                                                <?php 

                                                $en_yuksek = !empty($rapor_verileri) ? $rapor_verileri[0] : null;

                                                echo $en_yuksek ? number_format($en_yuksek->toplam_ciro, 0) . ' ₺' : '0 ₺';

                                                ?>

                                            </span>

                                            <span class="info-box-more">

                                                <?= $en_yuksek ? $en_yuksek->sehir_adi : '' ?>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="info-box" style="background-color: #495057; color: white;">

                                        <span class="info-box-icon"><i class="fas fa-calculator"></i></span>

                                        <div class="info-box-content">

                                            <span class="info-box-text">Toplam Adet</span>

                                            <span class="info-box-number"><?= number_format($toplam_adet) ?></span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="info-box" style="background-color: #6c757d; color: white;">

                                        <span class="info-box-icon"><i class="fas fa-coins"></i></span>

                                        <div class="info-box-content">

                                            <span class="info-box-text">Toplam Ciro</span>

                                            <span class="info-box-number"><?= number_format($toplam_ciro, 0) ?> ₺</span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            

                            <!-- İkinci Satır - Digiturk ve S Sport Karşılaştırması -->

                            <div class="row">

                                <div class="col-md-3">

                                    <div class="info-box" style="background-color: #6f42c1; color: white;">

                                        <span class="info-box-icon"><i class="fas fa-tv"></i></span>

                                        <div class="info-box-content">

                                            <span class="info-box-text">Digiturk Adet</span>

                                            <span class="info-box-number"><?= number_format($toplam_digiturk) ?></span>

                                            <span class="info-box-more">

                                                <?= $toplam_adet > 0 ? number_format(($toplam_digiturk / $toplam_adet) * 100, 1) . '% oranı' : '0% oranı' ?>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="info-box" style="background-color: #6f42c1; color: white;">

                                        <span class="info-box-icon"><i class="fas fa-lira-sign"></i></span>

                                        <div class="info-box-content">

                                            <span class="info-box-text">Digiturk Ciro</span>

                                            <span class="info-box-number"><?= number_format($toplam_digiturk_ciro, 0) ?> ₺</span>

                                            <span class="info-box-more">

                                                Ort: <?= $toplam_digiturk > 0 ? number_format($toplam_digiturk_ciro / $toplam_digiturk, 0) . ' ₺' : '0 ₺' ?>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="info-box bg-info">

                                        <span class="info-box-icon"><i class="fas fa-futbol"></i></span>

                                        <div class="info-box-content">

                                            <span class="info-box-text">S Sport Adet</span>

                                            <span class="info-box-number"><?= number_format($toplam_ssport) ?></span>

                                            <span class="info-box-more">

                                                <?= $toplam_adet > 0 ? number_format(($toplam_ssport / $toplam_adet) * 100, 1) . '% oranı' : '0% oranı' ?>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="info-box bg-info">

                                        <span class="info-box-icon"><i class="fas fa-lira-sign"></i></span>

                                        <div class="info-box-content">

                                            <span class="info-box-text">S Sport Ciro</span>

                                            <span class="info-box-number"><?= number_format($toplam_ssport_ciro, 0) ?> ₺</span>

                                            <span class="info-box-more">

                                                Ort: <?= $toplam_ssport > 0 ? number_format($toplam_ssport_ciro / $toplam_ssport, 0) . ' ₺' : '0 ₺' ?>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <?php endif; ?>

                </div>

            </div>

            </div>

            <!-- /Page Wrapper -->

        </div>

        <!-- /Main Wrapper -->



        <!-- DataTables JS -->

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>

        <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

        <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

        <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>



        <!-- SheetJS için Excel Export -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

        

        <!-- Select2 for better city selection -->

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



        <?php $this->load->view("include/footer-js"); ?>



        <script>

        $(document).ready(function() {

            // Select2 başlatma - Şehir seçimi için arama özelliği

            $('#sehir_id').select2({

                placeholder: '🔍 Şehir arayın veya seçin...',

                allowClear: true,

                language: {

                    noResults: function() {

                        return "Sonuç bulunamadı";

                    },

                    searching: function() {

                        return "Aranıyor...";

                    }

                }

            });



            // DataTable başlatma - Gruplandırılmış görünüm için optimize edildi

            $('#raporTablosu').DataTable({

                "language": {

                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/tr.json"

                },

                "pageLength": 50,

                "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Tümü"]],

                "order": [[ 9, "desc" ]], // Toplam ciro'ya göre sırala (10. sütun, index 9)

                "columnDefs": [

                    {

                        "targets": [0], // Sıra numarası

                        "className": "text-center",

                        "width": "35px"

                    },

                    {

                        "targets": [1], // Şehir adı - sol hizalı

                        "className": "text-left",

                        "width": "120px"

                    },

                    {

                        "targets": [2, 3, 4, 5, 6, 7, 8, 9], // Tüm diğer sütunlar - ortalı

                        "className": "text-center",

                        "width": "80px"

                    }

                ],

                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',

                "scrollX": true,

                "autoWidth": false,

                "responsive": false, // Responsive kapatıldı çünkü gruplandırma var

                "buttons": [

                    'copy', 'csv', 'excel', 'pdf', 'print'

                ]

            });

        });



        // Filtreleri temizle fonksiyonu

        function resetFilters() {

            document.getElementById('sehir_id').value = '';

            document.getElementById('baslangic_tarihi').value = '<?= date('Y-01-01') ?>';

            document.getElementById('bitis_tarihi').value = '<?= date('Y-m-d') ?>';

        }



        // Excel'e aktarma fonksiyonu

        function exportToExcel() {

            // DataTable kontrolü
            if (typeof $.fn.DataTable === 'undefined' || !$.fn.DataTable.isDataTable('#raporTablosu')) {
                console.log('DataTable yüklenmemiş, manuel export yapılıyor');
                manualExportToExcel();
                return;
            }
            
            var table = $('#raporTablosu').DataTable();

            var data = [];

            

            // Başlık satırı - gruplandırılmış header için

            data.push(['#', 'Şehir', 'DG Adet', 'DG Ciro', 'DG Ortalama', 'SS Adet', 'SS Ciro', 'SS Ortalama', 'Toplam Adet', 'Toplam Ciro']);

            

            // Veri satırları

            table.rows().every(function() {

                var rowData = [];

                $(this.node()).find('td').each(function() {

                    var cellText = $(this).text().replace('₺', '').replace(/,/g, '').trim();

                    rowData.push(cellText);

                });

                if (rowData.length > 0) {
                    data.push(rowData);
                }

            });

            

            // Excel dosyası oluştur

            var wb = XLSX.utils.book_new();

            var ws = XLSX.utils.aoa_to_sheet(data);
            
            // Sütun genişliklerini ayarla
            var colWidths = [
                {wch: 5}, {wch: 20}, {wch: 10}, {wch: 15}, {wch: 12},
                {wch: 10}, {wch: 15}, {wch: 12}, {wch: 12}, {wch: 15}
            ];
            ws['!cols'] = colWidths;

            XLSX.utils.book_append_sheet(wb, ws, "DG SS Sehir Raporu"); // 31 karakter altında

            XLSX.writeFile(wb, "digiturk_ssport_sehir_raporu_" + new Date().toISOString().slice(0,10) + ".xlsx");

        }
        
        // Manuel export fonksiyonu (DataTable yoksa)
        function manualExportToExcel() {
            var data = [];
            
            // Başlık satırı
            data.push(['#', 'Şehir', 'DG Adet', 'DG Ciro', 'DG Ortalama', 'SS Adet', 'SS Ciro', 'SS Ortalama', 'Toplam Adet', 'Toplam Ciro']);
            
            // Veri satırları
            $('#raporTablosu tbody tr').each(function() {
                var rowData = [];
                $(this).find('td').each(function() {
                    var cellText = $(this).text().replace('₺', '').replace(/,/g, '').trim();
                    rowData.push(cellText);
                });
                if (rowData.length > 0) {
                    data.push(rowData);
                }
            });
            
            // Toplam satırı
            $('#raporTablosu tfoot tr').each(function() {
                var footerData = [];
                $(this).find('th').each(function() {
                    var cellText = $(this).text().replace('₺', '').replace(/,/g, '').trim();
                    footerData.push(cellText);
                });
                if (footerData.length > 0) {
                    data.push(footerData);
                }
            });
            
            // Excel dosyası oluştur
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet(data);
            
            // Sütun genişliklerini ayarla
            var colWidths = [
                {wch: 5}, {wch: 20}, {wch: 10}, {wch: 15}, {wch: 12},
                {wch: 10}, {wch: 15}, {wch: 12}, {wch: 12}, {wch: 15}
            ];
            ws['!cols'] = colWidths;
            
            XLSX.utils.book_append_sheet(wb, ws, "DG SS Sehir Raporu");
            XLSX.writeFile(wb, "digiturk_ssport_sehir_raporu_" + new Date().toISOString().slice(0,10) + ".xlsx");

        }

        </script>



        <style>

        .info-box {

            display: block;

            min-height: 90px;

            background: #fff;

            width: 100%;

            box-shadow: 0 1px 1px rgba(0,0,0,0.1);

            border-radius: 2px;

            margin-bottom: 15px;

        }

        

        .info-box.bg-primary {

            background-color: #007bff !important;

            color: #fff;

        }

        

        .info-box.bg-success {

            background-color: #28a745 !important;

            color: #fff;

        }

        

        .info-box.bg-warning {

            background-color: #ffc107 !important;

            color: #212529;

        }

        

        .info-box.bg-info {

            background-color: #17a2b8 !important;

            color: #fff;

        }

        

        .info-box-icon {

            border-top-left-radius: 2px;

            border-top-right-radius: 0;

            border-bottom-right-radius: 0;

            border-bottom-left-radius: 2px;

            display: block;

            float: left;

            height: 90px;

            width: 90px;

            text-align: center;

            font-size: 45px;

            line-height: 90px;

            background: rgba(0,0,0,0.2);

        }

        

        .info-box-content {

            padding: 5px 10px;

            margin-left: 90px;

        }

        

        .info-box-text {

            text-transform: uppercase;

            font-weight: bold;

            font-size: 13px;

        }

        

        .info-box-number {

            display: block;

            font-weight: bold;

            font-size: 18px;

        }

        

        .info-box-more {

            display: block;

            font-size: 13px;

        }

        
        /* Modal düzenlemeleri */
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header-buttons {
            display: flex;
            align-items: center;
        }

        .badge-sm {
            font-size: 0.75em;
            padding: 0.25em 0.5em;
        }

        /* Modal tablo stil düzenlemeleri */
        .table-container {
            overflow-x: hidden;
            max-width: 100%;
        }

        .table-container .table {
            margin-bottom: 0;
            table-layout: fixed;
            width: 100%;
        }

        .table-container .table th,
        .table-container .table td {
            padding: 8px 6px;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .table-container .table th {
            font-size: 11px;
            font-weight: 600;
        }

        </style>

        <!-- Müşteri Detay Modal -->
        <div class="modal fade" id="musteriDetayModal" tabindex="-1" role="dialog" aria-labelledby="musteriDetayModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="musteriDetayModalLabel">Müşteri Detayları</h5>
                        <div class="modal-header-buttons">
                            <button type="button" class="btn btn-success btn-sm mr-2" id="excelIndir" onclick="exportModalToExcel()">
                                <i class="fas fa-file-excel"></i> Excel'e İndir
                            </button>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div id="musteriDetayIcerik">
                            <div class="text-center">
                                <i class="fas fa-spinner fa-spin"></i> Yükleniyor...
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        $(document).ready(function() {
            // Genel Toplam - Satış detay butonlarına tıklama olayı
            $('.satis-detay-btn').on('click', function() {
                var sehirId = $(this).data('sehir-id');
                var sehirAdi = $(this).data('sehir-adi');
                var baslangic = $(this).data('baslangic');
                var bitis = $(this).data('bitis');
                
                openModal(sehirAdi + ' - Tüm Müşteri Detayları', sehirId, baslangic, bitis, 'all');
            });

            // Digiturk detay butonlarına tıklama olayı
            $('.digiturk-detay-btn').on('click', function() {
                var sehirId = $(this).data('sehir-id');
                var sehirAdi = $(this).data('sehir-adi');
                var baslangic = $(this).data('baslangic');
                var bitis = $(this).data('bitis');
                
                openModal(sehirAdi + ' - Digiturk Müşteri Detayları', sehirId, baslangic, bitis, 'digiturk');
            });

            // S Sport detay butonlarına tıklama olayı
            $('.ssport-detay-btn').on('click', function() {
                var sehirId = $(this).data('sehir-id');
                var sehirAdi = $(this).data('sehir-adi');
                var baslangic = $(this).data('baslangic');
                var bitis = $(this).data('bitis');
                
                openModal(sehirAdi + ' - S Sport Müşteri Detayları', sehirId, baslangic, bitis, 'ssport');
            });

            // TABII detay butonlarına tıklama olayı
            $('.tabii-detay-btn').on('click', function() {
                var sehirId = $(this).data('sehir-id');
                var sehirAdi = $(this).data('sehir-adi');
                var baslangic = $(this).data('baslangic');
                var bitis = $(this).data('bitis');
                
                openModal(sehirAdi + ' - TABII Müşteri Detayları', sehirId, baslangic, bitis, 'tabii');
            });
        });

        // Modal açma fonksiyonu
        function openModal(title, sehirId, baslangic, bitis, type) {
            // Modal başlığını güncelle
            $('#musteriDetayModalLabel').text(title);
            
            // Modal içeriğini temizle ve loading göster
            $('#musteriDetayIcerik').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Yükleniyor...</div>');
            
            // Modal'ı aç
            $('#musteriDetayModal').modal('show');
            
            // AJAX ile müşteri detaylarını getir
            $.ajax({
                url: '<?= base_url("raporlar/digiturk_sehir_cari_detay") ?>',
                type: 'POST',
                data: {
                    sehir_id: sehirId,
                    baslangic_tarihi: baslangic,
                    bitis_tarihi: bitis,
                    product_type: type
                },
                dataType: 'json',
                success: function(response) {
                    console.log('AJAX Response:', response);
                    
                    if (response.error) {
                        $('#musteriDetayIcerik').html('<div class="alert alert-danger">' + response.error + '</div>');
                        return;
                    }
                    
                    if (response.success && response.data && response.data.length > 0) {
                        var html = '<div class="table-container">';
                        html += '<table class="table table-striped table-hover table-sm" style="font-size: 12px;">';
                        html += '<thead class="thead-dark">';
                        html += '<tr>';
                        html += '<th style="width: 10%;">Fatura Tarihi</th>';
                        html += '<th style="width: 22%;">Cari Ad</th>';
                        html += '<th style="width: 11%;">Telefon</th>';
                        html += '<th style="width: 9%;">Şehir</th>';
                        html += '<th style="width: 11%;">İlçe</th>';
                        html += '<th style="width: 13%;">Ürün Tipi</th>';
                        html += '<th style="width: 13%;">Personel</th>';
                        html += '<th style="width: 14%; text-align: right;">Toplam Tutar</th>';
                        html += '</tr>';
                        html += '</thead>';
                        html += '<tbody>';
                        
                        var toplamTutar = 0;
                        
                        response.data.forEach(function(item) {
                            toplamTutar += parseFloat(item.toplam_tutar);
                            
                            html += '<tr>';
                            // Fatura tarihi - formatla
                            var faturaTarihi = '-';
                            if (item.fatura_tarihi) {
                                var tarihObj = new Date(item.fatura_tarihi);
                                faturaTarihi = tarihObj.toLocaleDateString('tr-TR');
                            }
                            html += '<td style="font-size: 11px;">' + faturaTarihi + '</td>';
                            html += '<td style="word-wrap: break-word; max-width: 130px;">' + (item.cari_ad || '-') + '</td>';
                            html += '<td>' + (item.cari_firmaTelefon || '-') + '</td>';
                            html += '<td>' + (item.il_adi || '-') + '</td>';
                            html += '<td>' + (item.ilce_adi || '-') + '</td>';
                            html += '<td style="text-align: center;">';
                            // Ürün tipi gösterimi - stok_ad kullanılıyor artık
                            if (item.urun_tipi) {
                                // Digiturk ürünleri için mor badge
                                if (item.urun_tipi.toLowerCase().includes('digiturk') || 
                                    item.urun_tipi.toLowerCase().includes('digi')) {
                                    html += '<span class="badge badge-purple badge-sm">' + item.urun_tipi + '</span>';
                                }
                                // S Sport ürünleri için mavi badge
                                else if (item.urun_tipi.toLowerCase().includes('sport') || 
                                         item.urun_tipi.toLowerCase().includes('ss')) {
                                    html += '<span class="badge badge-primary badge-sm">' + item.urun_tipi + '</span>';
                                }
                                // TABII ürünleri için yeşil badge
                                else if (item.urun_tipi.toLowerCase().includes('tabii') || 
                                         item.urun_tipi.toLowerCase().includes('tab')) {
                                    html += '<span class="badge badge-success badge-sm">' + item.urun_tipi + '</span>';
                                }
                                // Diğer ürünler için gri badge
                                else {
                                    html += '<span class="badge badge-secondary badge-sm">' + item.urun_tipi + '</span>';
                                }
                            } else if (response.product_type) {
                                // Fallback - product_type parametresinden çıkart
                                if (response.product_type === 'digiturk') {
                                    html += '<span class="badge badge-purple badge-sm">Digiturk</span>';
                                } else if (response.product_type === 'ssport') {
                                    html += '<span class="badge badge-primary badge-sm">S Sport</span>';
                                } else if (response.product_type === 'tabii') {
                                    html += '<span class="badge badge-success badge-sm">TABII</span>';
                                } else if (response.product_type === 'all') {
                                    html += '<span class="badge badge-success badge-sm">DG + SS + TABII</span>';
                                } else {
                                    html += '<span class="badge badge-secondary badge-sm">' + response.product_type + '</span>';
                                }
                            } else {
                                html += '<span class="badge badge-success badge-sm">Belirtilmemiş</span>';
                            }
                            html += '</td>';
                            html += '<td style="font-size: 11px;">' + (item.personel_adsoyad || '-') + '</td>';
                            html += '<td class="text-right"><strong>' + parseFloat(item.toplam_tutar).toLocaleString('tr-TR', {minimumFractionDigits: 2}) + ' ₺</strong></td>';
                            html += '</tr>';
                        });
                        
                        html += '</tbody>';
                        html += '<tfoot class="thead-light">';
                        html += '<tr>';
                        html += '<th colspan="7" class="text-right"><strong>TOPLAM:</strong></th>';
                        html += '<th class="text-right"><strong class="text-primary">' + toplamTutar.toLocaleString('tr-TR', {minimumFractionDigits: 2}) + ' ₺</strong></th>';
                        html += '</tr>';
                        html += '</tfoot>';
                        html += '</table>';
                        html += '</div>';
                        
                        $('#musteriDetayIcerik').html(html);
                    } else {
                        $('#musteriDetayIcerik').html('<div class="alert alert-info">Bu şehir için müşteri bulunamadı.</div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', error);
                    console.log('Response:', xhr.responseText);
                    $('#musteriDetayIcerik').html('<div class="alert alert-danger">Veriler yüklenirken bir hata oluştu: ' + error + '</div>');
                }
            });
        }

        // Modal içindeki tabloyu Excel'e aktarma fonksiyonu
        function exportModalToExcel() {
            var modalTable = $('#musteriDetayIcerik table');
            
            if (modalTable.length === 0) {
                alert('İndirmek için önce veri yüklenmelidir!');
                return;
            }
            
            var data = [];
            var sehirAdi = $('#musteriDetayModalLabel').text().replace(' - Müşteri Detayları', '');
            
            // Başlık satırı
            var headers = [];
            modalTable.find('thead th').each(function() {
                headers.push($(this).text());
            });
            data.push(headers);
            
            // Veri satırları
            modalTable.find('tbody tr').each(function() {
                var rowData = [];
                $(this).find('td').each(function() {
                    var cellText = $(this).text().replace('₺', '').replace(/\s+/g, ' ').trim();
                    rowData.push(cellText);
                });
                if (rowData.length > 0) {
                    data.push(rowData);
                }
            });
            
            // Toplam satırı (varsa)
            modalTable.find('tfoot tr').each(function() {
                var rowData = [];
                $(this).find('th').each(function() {
                    var cellText = $(this).text().replace('₺', '').replace(/\s+/g, ' ').trim();
                    rowData.push(cellText);
                });
                if (rowData.length > 0) {
                    data.push(rowData);
                }
            });
            
            // Excel dosyası oluştur
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet(data);
            
            // Sütun genişliklerini ayarla
            var colWidths = [
                {wch: 12}, // Fatura Tarihi
                {wch: 22}, // Cari Ad
                {wch: 13}, // Telefon
                {wch: 10}, // Şehir
                {wch: 13}, // İlçe
                {wch: 13}, // Ürün Tipi
                {wch: 18}, // Personel
                {wch: 13}  // Toplam Tutar
            ];
            ws['!cols'] = colWidths;
            
            // Şehir adını kısaltarak sheet adı oluştur (31 karakter sınırı)
            var sheetName = (sehirAdi + " Detay").substring(0, 31);
            XLSX.utils.book_append_sheet(wb, ws, sheetName);
            
            // Dosya adını oluştur
            var fileName = sehirAdi.replace(/[^a-zA-Z0-9]/g, '_') + "_musteri_detaylari_" + new Date().toISOString().slice(0,10) + ".xlsx";
            
            XLSX.writeFile(wb, fileName);
        }
        </script>

    </body>

</html>

