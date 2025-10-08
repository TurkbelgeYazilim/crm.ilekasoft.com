<!DOCTYPE html>

<html lang="tr">

<head>

    <?php $this->load->view("include/head-tags"); ?>

    <style>

        .form-card {

            background: #fff;

            border-radius: 10px;

            box-shadow: 0 2px 10px rgba(0,0,0,0.1);

            margin-bottom: 20px;

        }

        

        .form-header {

            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

            color: white;

            padding: 20px;

            border-radius: 10px 10px 0 0;

        }

        

        .form-body {

            padding: 20px;

        }

        

        .form-section {

            margin-bottom: 30px;

            padding: 20px;

            border: 1px solid #e9ecef;

            border-radius: 8px;

            background: #f8f9fa;

        }

        

        .form-section h5 {

            color: #495057;

            margin-bottom: 20px;

            border-bottom: 2px solid #dee2e6;

            padding-bottom: 10px;

        }

        

        .btn-action {

            margin: 5px;

            min-width: 120px;

        }

        

        .alert {

            border-radius: 8px;

            margin-bottom: 20px;

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

                                <li class="breadcrumb-item active">Tahsilat Düzenle</li>

                            </ul>

                        </div>

                        <div class="d-flex justify-content-end text-align-center col-sm-2">

                            <a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>

                        </div>

                    </div>

                </div>

                <!-- /Page Header -->

                

                <!-- Flash Mesajları -->

                <?php if ($this->session->flashdata('tahsilat_hata')): ?>

                    <div class="alert alert-danger">

                        <i class="fa fa-exclamation-triangle"></i> <?= $this->session->flashdata('tahsilat_hata') ?>

                    </div>

                <?php endif; ?>

                

                <?php if ($this->session->flashdata('tahsilat_ok')): ?>

                    <div class="alert alert-success">

                        <i class="fa fa-check-circle"></i> <?= $this->session->flashdata('tahsilat_ok') ?>

                    </div>

                <?php endif; ?>

                

                <!-- Tahsilat Düzenleme Formu -->

                <div class="form-card">

                    <div class="form-header">

                        <h4><i class="fa fa-edit"></i> Tahsilat Düzenle - #<?= $tahsilat->tahsilat_id ?></h4>

                    </div>

                    <div class="form-body">

                        <form action="<?= base_url('tahsilat/tahsilat_guncelle') ?>" method="POST" id="tahsilatForm">

                            <input type="hidden" name="tahsilat_id" value="<?= $tahsilat->tahsilat_id ?>">

                            

                            <!-- Temel Bilgiler -->

                            <div class="form-section">

                                <h5><i class="fa fa-info-circle"></i> Temel Bilgiler</h5>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Cari <span class="text-danger">*</span></label>

                                            <select class="form-control" name="tahsilat_cariID" required>

                                                <option value="">Cari Seçiniz</option>

                                                <?php foreach($cariler as $cari): ?>

                                                    <option value="<?= $cari->cari_id ?>" <?= ($tahsilat->tahsilat_cariID == $cari->cari_id) ? 'selected' : '' ?>>

                                                        <?= $cari->cari_adi ?>

                                                    </option>

                                                <?php endforeach; ?>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Tarih <span class="text-danger">*</span></label>

                                            <input type="date" class="form-control" name="tahsilat_tarih" value="<?= date('Y-m-d', strtotime($tahsilat->tahsilat_tarih)) ?>" required>

                                        </div>

                                    </div>

                                </div>

                                

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Ödeme Tipi <span class="text-danger">*</span></label>

                                            <select class="form-control" name="tahsilat_odemeTipi" id="odemeTipi" required>

                                                <option value="">Ödeme Tipi Seçiniz</option>

                                                <option value="1" <?= ($tahsilat->tahsilat_odemeTipi == '1') ? 'selected' : '' ?>>Kasa</option>

                                                <option value="2" <?= ($tahsilat->tahsilat_odemeTipi == '2') ? 'selected' : '' ?>>Banka</option>

                                                <option value="3" <?= ($tahsilat->tahsilat_odemeTipi == '3') ? 'selected' : '' ?>>Çek</option>

                                                <option value="4" <?= ($tahsilat->tahsilat_odemeTipi == '4') ? 'selected' : '' ?>>Senet</option>

                                                <option value="5" <?= ($tahsilat->tahsilat_odemeTipi == '5') ? 'selected' : '' ?>>Pos</option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Tutar <span class="text-danger">*</span></label>

                                            <input type="number" class="form-control" name="tahsilat_tutar" value="<?= $tahsilat->tahsilat_tutar ?>" step="0.01" min="0" required>

                                        </div>

                                    </div>

                                </div>

                                

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label>Açıklama</label>

                                            <textarea class="form-control" name="tahsilat_aciklama" rows="3"><?= $tahsilat->tahsilat_aciklama ?></textarea>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            

                            <!-- Kasa Seçimi (Ödeme tipi Kasa ise) -->

                            <div class="form-section" id="kasaSection" style="display: <?= ($tahsilat->tahsilat_odemeTipi == '1') ? 'block' : 'none' ?>;">

                                <h5><i class="fa fa-money"></i> Kasa Bilgileri</h5>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Kasa <span class="text-danger">*</span></label>

                                            <select class="form-control" name="tahsilat_kasaID" id="kasaSelect">

                                                <option value="">Kasa Seçiniz</option>

                                                <?php foreach($kasalar as $kasa): ?>

                                                    <option value="<?= $kasa->kasa_id ?>" <?= ($tahsilat->tahsilat_kasaID == $kasa->kasa_id) ? 'selected' : '' ?>>

                                                        <?= $kasa->kasa_adi ?>

                                                    </option>

                                                <?php endforeach; ?>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            

                            <!-- Banka Seçimi (Ödeme tipi Banka veya Pos ise) -->

                            <div class="form-section" id="bankaSection" style="display: <?= (in_array($tahsilat->tahsilat_odemeTipi, ['2', '5'])) ? 'block' : 'none' ?>;">

                                <h5><i class="fa fa-university"></i> Banka Bilgileri</h5>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Banka <span class="text-danger">*</span></label>

                                            <select class="form-control" name="tahsilat_bankaID" id="bankaSelect">

                                                <option value="">Banka Seçiniz</option>

                                                <?php foreach($bankalar as $banka): ?>

                                                    <option value="<?= $banka->banka_id ?>" <?= ($tahsilat->tahsilat_bankaID == $banka->banka_id) ? 'selected' : '' ?>>

                                                        <?= $banka->banka_adi ?>

                                                    </option>

                                                <?php endforeach; ?>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            

                            <!-- Çek Bilgileri (Ödeme tipi Çek ise) -->

                            <div class="form-section" id="cekSection" style="display: <?= ($tahsilat->tahsilat_odemeTipi == '3') ? 'block' : 'none' ?>;">

                                <h5><i class="fa fa-file-text"></i> Çek Bilgileri</h5>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Çek Bankası <span class="text-danger">*</span></label>

                                            <select class="form-control" name="cek_bankaID" id="cekBankaSelect">

                                                <option value="">Çek Bankası Seçiniz</option>

                                                <?php foreach($bankalar as $banka): ?>

                                                    <option value="<?= $banka->banka_id ?>" <?= ($tahsilat->cek_bankaID == $banka->banka_id) ? 'selected' : '' ?>>

                                                        <?= $banka->banka_adi ?>

                                                    </option>

                                                <?php endforeach; ?>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Çek Şubesi <span class="text-danger">*</span></label>

                                            <input type="text" class="form-control" name="cek_bankaSube" value="<?= $tahsilat->cek_bankaSube ?>" placeholder="Çek şubesi">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            

                            <!-- Senet Bilgileri (Ödeme tipi Senet ise) -->

                            <div class="form-section" id="senetSection" style="display: <?= ($tahsilat->tahsilat_odemeTipi == '4') ? 'block' : 'none' ?>;">

                                <h5><i class="fa fa-file-text"></i> Senet Bilgileri</h5>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Senet Adedi</label>

                                            <input type="number" class="form-control" name="senet_adedi" value="<?= $tahsilat->senet_adedi ?>" min="1">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Senet Birim Tutarı</label>

                                            <input type="number" class="form-control" name="senet_birim_tutari" value="<?= $tahsilat->senet_birim_tutari ?>" step="0.01" min="0">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            

                            <!-- İşlem Butonları -->

                            <div class="text-center">

                                <button type="submit" class="btn btn-primary btn-action">

                                    <i class="fa fa-save"></i> Güncelle

                                </button>

                                <a href="<?= base_url('tahsilat/tahsilat-detay/' . $tahsilat->tahsilat_id) ?>" class="btn btn-secondary btn-action">

                                    <i class="fa fa-eye"></i> Detayı Gör

                                </a>

                                <a href="<?= base_url('tahsilat/tahsilat-listesi') ?>" class="btn btn-info btn-action">

                                    <i class="fa fa-list"></i> Listeye Dön

                                </a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        <!-- /Page Wrapper -->

    </div>

    <!-- /Main Wrapper -->

    

    <?php $this->load->view("include/footer-js"); ?>

    

    <script>

    $(document).ready(function() {

        // Ödeme tipi değiştiğinde ilgili bölümleri göster/gizle

        $('#odemeTipi').change(function() {

            var selectedValue = $(this).val();

            

            // Tüm bölümleri gizle

            $('#kasaSection, #bankaSection, #cekSection, #senetSection').hide();

            

            // Seçilen ödeme tipine göre ilgili bölümü göster

            if (selectedValue == '1') {

                $('#kasaSection').show();

            } else if (selectedValue == '2' || selectedValue == '5') {

                $('#bankaSection').show();

            } else if (selectedValue == '3') {

                $('#cekSection').show();

            } else if (selectedValue == '4') {

                $('#senetSection').show();

            }

        });

        

        // Form gönderilmeden önce validasyon

        $('#tahsilatForm').submit(function(e) {

            var odemeTipi = $('#odemeTipi').val();

            var isValid = true;

            

            // Ödeme tipine göre zorunlu alanları kontrol et

            if (odemeTipi == '1') {

                if (!$('#kasaSelect').val()) {

                    alert('Kasa seçimi zorunludur.');

                    isValid = false;

                }

            } else if (odemeTipi == '2' || odemeTipi == '5') {

                if (!$('#bankaSelect').val()) {

                    alert('Banka seçimi zorunludur.');

                    isValid = false;

                }

            } else if (odemeTipi == '3') {

                if (!$('#cekBankaSelect').val() || !$('input[name="cek_bankaSube"]').val()) {

                    alert('Çek bankası ve şubesi zorunludur.');

                    isValid = false;

                }

            }

            

            if (!isValid) {

                e.preventDefault();

            }

        });

    });

    </script>

</body>

</html> 