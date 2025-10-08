<!DOCTYPE html>

<html lang="tr">

<head>

    <?php $this->load->view("include/head-tags"); ?>

    <style>

        .detail-card {

            background: #fff;

            border-radius: 10px;

            box-shadow: 0 2px 10px rgba(0,0,0,0.1);

            margin-bottom: 20px;

        }

        

        .detail-header {

            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

            color: white;

            padding: 20px;

            border-radius: 10px 10px 0 0;

        }

        

        .detail-body {

            padding: 20px;

        }

        

        .detail-row {

            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: 10px 0;

            border-bottom: 1px solid #eee;

        }

        

        .detail-row:last-child {

            border-bottom: none;

        }

        

        .detail-label {

            font-weight: bold;

            color: #333;

            min-width: 150px;

        }

        

        .detail-value {

            color: #666;

            text-align: right;

        }

        

        .tutar-value {

            font-size: 1.2rem;

            font-weight: bold;

            color: #28a745;

        }

        

        .odeme-tipi-badge {

            font-size: 0.9rem;

            padding: 6px 12px;

        }

        

        .action-buttons {

            margin-top: 20px;

            text-align: center;

        }

        

        .btn-action {

            margin: 5px;

            min-width: 120px;

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

                            <h3 class="page-title">Tahsilat</h3>

                            <ul class="breadcrumb">

                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>

                                <li class="breadcrumb-item"><a href="<?= base_url('tahsilat/tahsilat-listesi'); ?>">Tahsilat Listesi</a></li>

                                <li class="breadcrumb-item active">Tahsilat Detayı</li>

                            </ul>

                        </div>

                        <div class="d-flex justify-content-end text-align-center col-sm-2">

                            <a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>

                        </div>

                    </div>

                </div>

                <!-- /Page Header -->

                

                <!-- Tahsilat Detay Kartı -->

                <div class="detail-card">

                    <div class="detail-header">

                        <h4><i class="fa fa-info-circle"></i> Tahsilat Detayı - #<?= $tahsilat->tahsilat_id ?></h4>

                    </div>

                    <div class="detail-body">

                        <div class="detail-row">

                            <div class="detail-label">Tahsilat ID:</div>

                            <div class="detail-value">#<?= $tahsilat->tahsilat_id ?></div>

                        </div>

                        

                        <div class="detail-row">

                            <div class="detail-label">Tarih:</div>

                            <div class="detail-value"><?= date('d.m.Y', strtotime($tahsilat->tahsilat_tarih)) ?></div>

                        </div>

                        

                        <div class="detail-row">

                            <div class="detail-label">Cari:</div>

                            <div class="detail-value"><?= $tahsilat->cari_adi ?: 'Bilinmiyor' ?></div>

                        </div>

                        

                        <div class="detail-row">

                            <div class="detail-label">Ödeme Tipi:</div>

                            <div class="detail-value">

                                <?php

                                $odeme_tipi_text = '';

                                $odeme_tipi_class = '';

                                switch($tahsilat->tahsilat_odemeTipi) {

                                    case '1': 

                                        $odeme_tipi_text = 'Kasa';

                                        $odeme_tipi_class = 'badge-success';

                                        break;

                                    case '2': 

                                        $odeme_tipi_text = 'Banka';

                                        $odeme_tipi_class = 'badge-primary';

                                        break;

                                    case '3': 

                                        $odeme_tipi_text = 'Çek';

                                        $odeme_tipi_class = 'badge-info';

                                        break;

                                    case '4': 

                                        $odeme_tipi_text = 'Senet';

                                        $odeme_tipi_class = 'badge-warning';

                                        break;

                                    case '5': 

                                        $odeme_tipi_text = 'Pos';

                                        $odeme_tipi_class = 'badge-secondary';

                                        break;

                                    default: 

                                        $odeme_tipi_text = 'Bilinmiyor';

                                        $odeme_tipi_class = 'badge-secondary';

                                }

                                ?>

                                <span class="badge <?= $odeme_tipi_class ?> odeme-tipi-badge"><?= $odeme_tipi_text ?></span>

                            </div>

                        </div>

                        

                        <div class="detail-row">

                            <div class="detail-label">Tutar:</div>

                            <div class="detail-value tutar-value">

                                <?= number_format($tahsilat->tahsilat_tutar, 2, ',', '.') ?> ₺

                            </div>

                        </div>

                        

                        <div class="detail-row">

                            <div class="detail-label">Açıklama:</div>

                            <div class="detail-value"><?= $tahsilat->tahsilat_aciklama ?: '-' ?></div>

                        </div>

                        

                        <div class="detail-row">

                            <div class="detail-label">Oluşturan:</div>

                            <div class="detail-value"><?= $tahsilat->olusturan_kullanici_adi ?: 'Bilinmiyor' ?></div>

                        </div>

                        

                        <div class="detail-row">

                            <div class="detail-label">Oluşturma Tarihi:</div>

                            <div class="detail-value"><?= date('d.m.Y H:i', strtotime($tahsilat->tahsilat_olusturmaTarihi)) ?></div>

                        </div>

                        

                        <?php if ($tahsilat->tahsilat_odemeTipi == '1' && $tahsilat->tahsilat_kasaID): ?>

                        <div class="detail-row">

                            <div class="detail-label">Kasa ID:</div>

                            <div class="detail-value"><?= $tahsilat->tahsilat_kasaID ?></div>

                        </div>

                        <?php endif; ?>

                        

                        <?php if ($tahsilat->tahsilat_odemeTipi == '2' && $tahsilat->tahsilat_bankaID): ?>

                        <div class="detail-row">

                            <div class="detail-label">Banka ID:</div>

                            <div class="detail-value"><?= $tahsilat->tahsilat_bankaID ?></div>

                        </div>

                        <?php endif; ?>

                        

                        <?php if ($tahsilat->tahsilat_odemeTipi == '3'): ?>

                        <div class="detail-row">

                            <div class="detail-label">Çek Bankası:</div>

                            <div class="detail-value"><?= $tahsilat->cek_bankaID ?: '-' ?></div>

                        </div>

                        <div class="detail-row">

                            <div class="detail-label">Çek Şubesi:</div>

                            <div class="detail-value"><?= $tahsilat->cek_bankaSube ?: '-' ?></div>

                        </div>

                        <?php endif; ?>

                        

                        <?php if ($tahsilat->tahsilat_odemeTipi == '4'): ?>

                        <div class="detail-row">

                            <div class="detail-label">Senet Adedi:</div>

                            <div class="detail-value"><?= $tahsilat->senet_adedi ?: '-' ?></div>

                        </div>

                        <div class="detail-row">

                            <div class="detail-label">Senet Birim Tutarı:</div>

                            <div class="detail-value"><?= $tahsilat->senet_birim_tutari ? number_format($tahsilat->senet_birim_tutari, 2, ',', '.') . ' ₺' : '-' ?></div>

                        </div>

                        <?php endif; ?>

                    </div>

                </div>

                

                <!-- İşlem Butonları -->

                <div class="action-buttons">

                    <a href="<?= base_url('tahsilat/tahsilat-duzenle/' . $tahsilat->tahsilat_id) ?>" class="btn btn-primary btn-action">

                        <i class="fa fa-edit"></i> Düzenle

                    </a>

                    <a href="<?= base_url('tahsilat/tahsilat-listesi') ?>" class="btn btn-secondary btn-action">

                        <i class="fa fa-list"></i> Listeye Dön

                    </a>

                    <button type="button" class="btn btn-danger btn-action" onclick="deleteTahsilat(<?= $tahsilat->tahsilat_id ?>)">

                        <i class="fa fa-trash"></i> Sil

                    </button>

                </div>

            </div>

        </div>

        <!-- /Page Wrapper -->

    </div>

    <!-- /Main Wrapper -->

    

    <?php $this->load->view("include/footer-js"); ?>

    

    <script>

    function deleteTahsilat(id) {

        if (confirm('Bu tahsilat kaydını silmek istediğinizden emin misiniz?')) {

            $.ajax({

                url: '<?= base_url("tahsilat/tahsilat_sil/") ?>' + id,

                type: 'POST',

                dataType: 'json',

                success: function(response) {

                    if (response.status === 'success') {

                        alert('Tahsilat başarıyla silindi.');

                        window.location.href = '<?= base_url("tahsilat/tahsilat-listesi") ?>';

                    } else {

                        alert('Hata: ' + response.message);

                    }

                },

                error: function() {

                    alert('Bağlantı hatası oluştu.');

                }

            });

        }

    }

    </script>

</body>

</html> 