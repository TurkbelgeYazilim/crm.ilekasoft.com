<!DOCTYPE html>
<html lang="tr">
<head>
    <title>İllegal Tespit Oluştur | İlekaSoft CRM</title>
    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <?php $this->load->view("include/head-tags"); ?>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/favicon.ico'); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
          integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .form-title {
            color: #2c3e50;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
            border-bottom: 2px solid #e74c3c;
            padding-bottom: 15px;
        }
        .btn-submit {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            border: none;
            padding: 12px 40px;
            color: white;
            font-weight: 600;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            background: linear-gradient(45deg, #c0392b, #a93226);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
        }
        .form-group label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }
        .form-control {
            border: 2px solid #ecf0f1;
            border-radius: 8px;
            padding: 12px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #e74c3c;
            box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
        }
        .alert-info {
            background-color: #d5f2ff;
            border-color: #bee5eb;
            color: #0c5460;
            border-radius: 10px;
        }
        .country-select {
            background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="%23666" d="M2 0L0 2h4zm0 5L0 3h4z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px;
        }
        .success-message {
            display: none;
            background: linear-gradient(45deg, #27ae60, #2ecc71);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
            font-weight: 600;
        }
    </style>
</head>
<body>
<?php
$firmaID = getirFirma();
$firma_ID = $firmaID->ayarlar_id;
?>

<div class="main-wrapper">
    <?php $this->load->view("include/header"); ?>
    <?php $this->load->view("include/sidebar"); ?>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="page-title">İllegal Tespit</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
                            <li class="breadcrumb-item">İllegal</li>
                            <li class="breadcrumb-item active">İllegal Tespit Oluştur</li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-end text-align-center col-sm-2">
                        <a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-12">
                    <div class="form-container">
                        <h2 class="form-title">
                            <i class="fa fa-plus-circle"></i> İllegal Tespit Oluştur
                        </h2>
                        
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i> 
                            <strong>Bilgi:</strong> Bu form ile yeni bir illegal cari kaydı oluşturabilirsiniz. Tüm alanları doğru şekilde doldurunuz.
                        </div>

                        <form id="illegalCariForm" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="illegal_cari_isletme_adi">
                                            <i class="fa fa-building"></i> İşletme Adı
                                        </label>
                                        <input type="text" class="form-control" id="illegal_cari_isletme_adi" 
                                               name="illegal_cari_isletme_adi" placeholder="İşletme adını giriniz...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="illegal_cari_ad">
                                            <i class="fa fa-user"></i> Adı <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="illegal_cari_ad" 
                                               name="illegal_cari_ad" placeholder="Adını giriniz..." required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="illegal_cari_soyad">
                                            <i class="fa fa-user"></i> Soyadı <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="illegal_cari_soyad" 
                                               name="illegal_cari_soyad" placeholder="Soyadını giriniz..." required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="illegal_cari_ulke">
                                            <i class="fa fa-globe"></i> Ülke
                                        </label>
                                        <select class="form-control country-select" id="illegal_cari_ulke" name="illegal_cari_ulke">
                                            <option value="">Ülke Seçiniz</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="illegal_cari_il">
                                            <i class="fa fa-map-marker"></i> İl
                                        </label>
                                        <select class="form-control" id="illegal_cari_il" name="illegal_cari_il">
                                            <option value="">İl Seçiniz</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="illegal_cari_ilce">
                                            <i class="fa fa-map-marker"></i> İlçe
                                        </label>
                                        <select class="form-control" id="illegal_cari_ilce" name="illegal_cari_ilce" disabled>
                                            <option value="">Önce il seçiniz</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="illegal_cari_durum">
                                            <i class="fa fa-toggle-on"></i> Durum
                                        </label>
                                        <select class="form-control" id="illegal_cari_durum" name="illegal_cari_durum">
                                            <option value="1" selected>Aktif</option>
                                            <option value="0">Pasif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-submit">
                                        <i class="fa fa-save"></i> İllegal Cari Kaydet
                                    </button>
                                    <button type="reset" class="btn btn-secondary ml-3">
                                        <i class="fa fa-refresh"></i> Formu Temizle
                                    </button>
                                </div>
                            </div>

                            <div class="success-message" id="successMessage">
                                <i class="fa fa-check-circle fa-2x"></i>
                                <div class="mt-2">İllegal cari başarıyla kaydedildi!</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view("include/footer-js"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" 
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$(document).ready(function() {
    // Ülkeleri yükle
    loadUlkeler();
    // İlleri yükle (sadece Türkiye için başlangıçta)
    
    function loadUlkeler() {
        $.ajax({
            url: '<?= base_url("home/get_ulkeler") ?>',
            type: 'POST',
            dataType: 'json',
            success: function(result) {
                if(result && result.status !== 'error') {
                    var options = '<option value="">Ülke Seçiniz</option>';
                    $.each(result.data, function(i, ulke) {
                        // Türkiye'yi varsayılan olarak seç
                        var selected = ulke.ulke_kodu === 'TR' ? ' selected' : '';
                        options += '<option value="'+ulke.id+'"'+selected+'>'+ulke.ulke_adi+'</option>';
                    });
                    $('#illegal_cari_ulke').html(options);
                    
                    // Türkiye seçiliyse illeri yükle
                    if ($('#illegal_cari_ulke').val()) {
                        loadIllerByUlke($('#illegal_cari_ulke').val());
                    }
                } else {
                    $('#illegal_cari_ulke').html('<option value="">Ülke yüklenemedi</option>');
                }
            },
            error: function() {
                $('#illegal_cari_ulke').html('<option value="">Hata oluştu</option>');
            }
        });
    }
    
    function loadIllerByUlke(ulke_id) {
        $.ajax({
            url: '<?= base_url("home/get_iller") ?>',
            type: 'POST',
            data: {ulke_id: ulke_id},
            dataType: 'json',
            success: function(result) {
                if(result && result.status !== 'error') {
                    var options = '<option value="">İl Seçiniz</option>';
                    $.each(result.data, function(i, il) {
                        options += '<option value="'+il.id+'">'+il.il+'</option>';
                    });
                    $('#illegal_cari_il').html(options);
                } else {
                    $('#illegal_cari_il').html('<option value="">İl bulunamadı</option>');
                }
            },
            error: function() {
                $('#illegal_cari_il').html('<option value="">Hata oluştu</option>');
            }
        });
    }

    // Ülke değişikliğinde illeri yükle
    $('#illegal_cari_ulke').on('change', function() {
        var ulke_id = $(this).val();
        if (ulke_id) {
            loadIllerByUlke(ulke_id);
            // İlçe dropdown'ını sıfırla
            $('#illegal_cari_ilce').prop('disabled', true).html('<option value="">Önce il seçiniz</option>');
        } else {
            $('#illegal_cari_il').html('<option value="">Önce ülke seçiniz</option>');
            $('#illegal_cari_ilce').prop('disabled', true).html('<option value="">Önce il seçiniz</option>');
        }
    });

    // İl değiştiğinde ilçeleri yükle
    $('#illegal_cari_il').on('change', function() {
        var il_id = $(this).val();
        if(il_id) {
            $('#illegal_cari_ilce').prop('disabled', false);
            $('#illegal_cari_ilce').html('<option>Yükleniyor...</option>');
            $.ajax({
                url: '<?= base_url("home/get_ilceler") ?>',
                type: 'POST',
                data: {il_id: il_id},
                dataType: 'json',
                success: function(result) {
                    if(result && result.status !== 'error') {
                        var options = '<option value="">İlçe Seçiniz</option>';
                        $.each(result.data, function(i, ilce) {
                            options += '<option value="'+ilce.id+'">'+ilce.ilce+'</option>';
                        });
                        $('#illegal_cari_ilce').html(options);
                    } else {
                        $('#illegal_cari_ilce').html('<option value="">İlçe bulunamadı</option>');
                    }
                },
                error: function() {
                    $('#illegal_cari_ilce').html('<option value="">Hata oluştu</option>');
                }
            });
        } else {
            $('#illegal_cari_ilce').prop('disabled', true).html('<option value="">Önce il seçiniz</option>');
        }
    });

    // Form gönderimi
    $('#illegalCariForm').on('submit', function(e) {
        e.preventDefault();
        
        // Gerekli alanları kontrol et
        var ad = $('#illegal_cari_ad').val().trim();
        var soyad = $('#illegal_cari_soyad').val().trim();
        
        if (!ad || !soyad) {
            toastr.error('Ad ve Soyad alanları zorunludur!');
            return;
        }

        // Submit butonunu devre dışı bırak
        var submitBtn = $(this).find('button[type="submit"]');
        var originalText = submitBtn.html();
        submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Kaydediliyor...');

        // AJAX ile form gönder
        $.ajax({
            url: '<?= base_url("illegal/illegal_cari_kaydet") ?>',
            type: 'POST',
            data: {
                illegal_cari_isletme_adi: $('#illegal_cari_isletme_adi').val(),
                illegal_cari_ad: $('#illegal_cari_ad').val(),
                illegal_cari_soyad: $('#illegal_cari_soyad').val(),
                illegal_cari_ulke: $('#illegal_cari_ulke').val(),
                illegal_cari_il: $('#illegal_cari_il').val(),
                illegal_cari_ilce: $('#illegal_cari_ilce').val(),
                illegal_cari_durum: $('#illegal_cari_durum').val()
            },
            dataType: 'json',
            success: function(response) {
                submitBtn.prop('disabled', false).html(originalText);
                
                if (response.status === 'success') {
                    $('#successMessage').fadeIn();
                    toastr.success('İllegal cari başarıyla kaydedildi!');
                    $('#illegalCariForm')[0].reset();
                    $('#illegal_cari_ilce').prop('disabled', true).html('<option value="">Önce il seçiniz</option>');
                    
                    setTimeout(function() {
                        $('#successMessage').fadeOut();
                    }, 3000);
                } else {
                    toastr.error(response.message || 'Kayıt sırasında hata oluştu!');
                }
            },
            error: function() {
                submitBtn.prop('disabled', false).html(originalText);
                toastr.error('Sunucu hatası oluştu!');
            }
        });
    });

    // Form temizleme
    $('button[type="reset"]').on('click', function() {
        $('#successMessage').hide();
        $('#illegal_cari_ilce').prop('disabled', true).html('<option value="">Önce il seçiniz</option>');
        toastr.info('Form temizlendi');
    });
});
</script>

</body>
</html>