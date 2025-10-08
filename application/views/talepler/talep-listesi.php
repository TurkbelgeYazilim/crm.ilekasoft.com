<!DOCTYPE html>
<html lang="tr">
<head>
    <?php $this->load->view("include/head-tags"); ?>
    <style>
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            color: white;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .table td {
            vertical-align: middle;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .teklif-btn {
            margin-left: 0.5rem;
        }
        .id-column {
            white-space: nowrap;
        }
        .yeni-talep-row {
            background-color: #ffe6e6 !important;
            border-left: 4px solid #dc3545 !important;
        }
        .yeni-talep-row:hover {
            background-color: #ffcccc !important;
        }
        /* YENI durumu için özel stil */
        .badge.badge-danger.bg-danger {
            background-color: #dc3545 !important;
            color: white !important;
            font-weight: bold !important;
            font-size: 0.8rem !important;
            padding: 0.4rem 0.6rem !important;
            box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3) !important;
            animation: pulse-red 2s infinite;
        }
        /* Pulse animasyonu */
        @keyframes pulse-red {
            0% { box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3); }
            50% { box-shadow: 0 2px 8px rgba(220, 53, 69, 0.6); }
            100% { box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3); }
        }
        /* Diğer durumlar için daha açık renkler */
        .badge.badge-light {
            background-color: #f8f9fa !important;
            color: #6c757d !important;
            border: 1px solid #dee2e6 !important;
        }
        .badge.badge-outline-success {
            background-color: transparent !important;
            color: #28a745 !important;
            border: 1px solid #28a745 !important;
        }
        .badge.badge-outline-primary {
            background-color: transparent !important;
            color: #007bff !important;
            border: 1px solid #007bff !important;
        }
        
        /* Mobil cihazlarda Sektör sütununu gizle */
        @media (max-width: 768px) {
            .sektor-column {
                display: none !important;
            }
            
            /* Mobile modal optimizasyonları */
            .modal-dialog {
                margin: 10px !important;
                max-width: calc(100% - 20px) !important;
            }
            
            .modal-content {
                border-radius: 10px !important;
            }
            
            .modal-body {
                padding: 10px !important;
            }
            
            /* Mobile teklif kartları */
            .teklif-card {
                border: 1px solid #dee2e6;
                border-radius: 8px;
                margin-bottom: 10px;
            }
            
            .teklif-card .card-header {
                background-color: #f8f9fa;
                border-bottom: 1px solid #dee2e6;
                padding: 10px 15px;
            }
            
            .teklif-card .card-body {
                padding: 15px;
            }
            
            .teklif-card .btn-link {
                color: #495057;
                text-decoration: none;
                padding: 0;
                border: none;
                background: none;
                width: 100%;
                text-align: left;
            }
            
            .teklif-card .btn-link:hover {
                color: #007bff;
                text-decoration: none;
            }
            
            .teklif-card .btn-link:focus {
                box-shadow: none;
            }
        }
        
        /* Sidebar Toggle CSS - Forced */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9998;
            display: none;
            transition: opacity 0.3s ease;
        }
        
        .sidebar-overlay.opened {
            display: block !important;
            opacity: 1;
        }
        
        /* Mobile sidebar */
        @media (max-width: 768px) {
            .main-wrapper .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .main-wrapper.slide-nav .sidebar {
                transform: translateX(0);
            }
            
            .main-wrapper.slide-nav .page-wrapper {
                margin-left: 0;
            }
            
            html.menu-opened {
                overflow: hidden;
            }
            
            html.menu-opened body {
                overflow: hidden;
            }
        }
        
        /* Desktop mini sidebar */
        @media (min-width: 769px) {
            .mini-sidebar .sidebar {
                width: 60px;
                transition: width 0.3s ease;
            }
            
            .mini-sidebar .page-wrapper {
                margin-left: 60px;
                transition: margin-left 0.3s ease;
            }
            
            .mini-sidebar .sidebar .sidebar-inner {
                overflow: visible;
            }
            
            .mini-sidebar .sidebar .sidebar-menu > li > a {
                padding: 12px 20px;
                text-align: center;
            }
            
            .mini-sidebar .sidebar .sidebar-menu > li > a span {
                display: none;
            }
            
            .mini-sidebar .sidebar .sidebar-menu > li.submenu ul {
                display: none !important;
            }
        }
        
        /* Toggle button force visible */
        #toggle_btn, #mobile_btn {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            pointer-events: auto !important;
            cursor: pointer !important;
        }
        
        /* Sidebar debug - Force visibility */
        .sidebar {
            transition: transform 0.3s ease !important;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%) !important;
            }
            
            .main-wrapper.slide-nav .sidebar {
                transform: translateX(0) !important;
            }
            
            .sidebar-overlay {
                z-index: 9998 !important;
            }
            
            .sidebar-overlay.opened {
                display: block !important;
            }
        }
        
        /* Debug styling for button */
        #toggle_btn:hover {
            background-color: rgba(255,255,255,0.1) !important;
        }
        
        #toggle_btn:active {
            background-color: rgba(255,255,255,0.2) !important;
        }
        
        /* Sidebar menü linkleri için özel CSS */
        #sidebar-menu a {
            cursor: pointer !important;
            pointer-events: auto !important;
            transition: all 0.3s ease !important;
            color: #fff !important;
            display: block !important;
            padding: 12px 20px !important;
            text-decoration: none !important;
        }
        
        #sidebar-menu a:hover {
            background-color: rgba(255,255,255,0.1) !important;
            color: #fff !important;
        }
        
        #sidebar-menu .submenu > a {
            position: relative !important;
        }
        
        #sidebar-menu .submenu > a .menu-arrow {
            float: right !important;
            margin-top: 5px !important;
            transition: transform 0.3s ease !important;
        }
        
        #sidebar-menu .submenu > a .menu-arrow::after {
            content: "\f107" !important;
            font-family: "Font Awesome 5 Free" !important;
            font-weight: 900 !important;
        }
        
        #sidebar-menu .submenu > a.subdrop .menu-arrow::after {
            content: "\f106" !important;
        }
        
        /* Submenu stilleri */
        #sidebar-menu .submenu ul {
            display: none !important;
            padding-left: 0 !important;
            background-color: rgba(0,0,0,0.2) !important;
        }
        
        #sidebar-menu .submenu.active ul,
        #sidebar-menu .submenu > a.subdrop + ul {
            display: block !important;
        }
        
        #sidebar-menu .submenu ul li a {
            padding-left: 50px !important;
            font-size: 13px !important;
            color: rgba(255,255,255,0.8) !important;
        }
        
        #sidebar-menu .submenu ul li a:hover,
        #sidebar-menu .submenu ul li a.active {
            background-color: rgba(255,255,255,0.1) !important;
            color: #fff !important;
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
                        <div class="col-sm-10">
                            <h3 class="page-title">Talepler Listesi</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
                                <li class="breadcrumb-item active">Talepler Listesi</li>
                            </ul>
                        </div>
                        <div class="col-sm-2 text-right">
                            <?php if (grup_modul_yetkisi_var(1810)): ?>
                                <a class="btn btn-primary" href="<?= base_url('talepler/talep-olustur'); ?>">
                                    <i class="fa fa-plus"></i> Yeni Talep
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card card-table">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title">
                                            <i class="fa fa-list text-primary"></i> Talep Listesi
                                        </h5>
                                    </div>
                                    <div class="col-auto">
                                        <?php if (grup_modul_yetkisi_var(1810)): ?>
                                            <a href="<?= base_url('talepler/talep-olustur'); ?>" class="btn btn-primary btn-sm">
                                                <i class="fa fa-plus"></i> Yeni Talep
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0" id="talepTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Ad/Firma</th>
                                                <th>Telefon</th>
                                                <th class="sektor-column">Sektör</th>
                                                <th>Lokasyon</th>
                                                <th>Durum</th>
                                                <th>Oluşturan</th>
                                                <th>Tarih</th>
                                                <th class="text-center">İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($talepler)): ?>
                                                <?php foreach ($talepler as $talep): ?>
                                                    <tr class="<?= (!$talep->son_durum_adi) ? 'yeni-talep-row' : ''; ?>">
                                                        <td class="id-column">
                                                            <?= $talep->id; ?>
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-danger teklif-btn" 
                                                                    onclick="teklifIslemleri(<?= $talep->id; ?>, '<?= htmlspecialchars($talep->potansiyel_cari_ad, ENT_QUOTES); ?>')"
                                                                    title="Teklif İşlemleri">
                                                                <i class="fa fa-file-text"></i> Teklif
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <strong><?= $talep->potansiyel_cari_ad; ?></strong>
                                                        </td>
                                                        <td>
                                                            <?php if ($talep->potansiyel_cari_firmaTelefon): ?>
                                                                <a href="tel:<?= $talep->potansiyel_cari_firmaTelefon; ?>" class="text-dark">
                                                                    <i class="fa fa-phone text-success mr-1"></i><?= $talep->potansiyel_cari_firmaTelefon; ?>
                                                                </a>
                                                            <?php else: ?>
                                                                <span class="text-muted">-</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="sektor-column">
                                                            <?php if ($talep->sektor_adi): ?>
                                                                <span class="badge badge-info"><?= $talep->sektor_adi; ?></span>
                                                            <?php else: ?>
                                                                <span class="text-muted">-</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                            $lokasyon = array();
                                                            if ($talep->ilce_adi) $lokasyon[] = $talep->ilce_adi;
                                                            if ($talep->il_adi) $lokasyon[] = $talep->il_adi;
                                                            echo !empty($lokasyon) ? implode(', ', $lokasyon) : '-';
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($talep->son_durum_adi): ?>
                                                                <?php
                                                                // Durum renklerini belirle (açık renkler kullanılıyor)
                                                                $durum_renkleri = [
                                                                    'İptal - İşletme Yok' => 'light',
                                                                    'İptal - Ünvan değişmiş' => 'light', 
                                                                    'İptal - İstemiyor' => 'secondary',
                                                                    'Teklif verildi' => 'info',
                                                                    'Satıldı' => 'outline-success'
                                                                ];
                                                                $renk = isset($durum_renkleri[$talep->son_durum_adi]) ? $durum_renkleri[$talep->son_durum_adi] : 'outline-primary';
                                                                ?>
                                                                <span class="badge badge-<?= $renk; ?>"><?= $talep->son_durum_adi; ?></span>
                                                            <?php else: ?>
                                                                <span class="badge badge-danger bg-danger text-white">YENI</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <small><?= $talep->kullanici_adsoyad ?: 'Bilinmiyor'; ?></small>
                                                        </td>
                                                        <td>
                                                            <small><?= date('d.m.Y H:i', strtotime($talep->olusturma_zamani)); ?></small>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group" role="group">
                                                                <a href="<?= base_url('talepler/talep-detay/' . $talep->id); ?>" 
                                                                   class="btn btn-sm btn-outline-primary" title="Detay">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                                <?php if (grup_modul_yetkisi_var(1810)): ?>
                                                                    <a href="<?= base_url('talepler/talep-duzenle/' . $talep->id); ?>" 
                                                                       class="btn btn-sm btn-outline-success" title="Düzenle">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="9" class="text-center py-4">
                                                        <div class="text-muted">
                                                            <i class="fa fa-inbox fa-2x mb-2"></i>
                                                            <p>Henüz talep bulunmuyor.</p>
                                                            <?php if (grup_modul_yetkisi_var(1810)): ?>
                                                                <a href="<?= base_url('talepler/talep-olustur'); ?>" class="btn btn-primary">
                                                                    <i class="fa fa-plus"></i> İlk Talebi Oluştur
                                                                </a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
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

    <!-- Yeni Teklif Ekle Modal -->
    <div class="modal fade" id="yeniTeklifEkleModal" tabindex="-1" role="dialog" aria-labelledby="yeniTeklifEkleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="<?= base_url('talepler/potansiyel_satis_ekle') ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="yeniTeklifEkleModalLabel">Yeni Teklif Ekle</h5>
                        <div class="ml-auto">
                            <button type="submit" class="btn btn-primary mr-2">Kaydet</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Müşteri</label>
                            <input type="text" id="cari_autocomplete_modal" class="form-control" placeholder="Seçili müşteri burada görünecek..." readonly>
                            <input type="hidden" name="potansiyel_cari_id" id="selected_cari_id_modal" required>
                        </div>
                        <div class="form-group">
                            <label>Durum</label>
                            <select name="durum_id" id="durum_id_modal" class="form-control" required>
                                <option value="">Durum Seçiniz</option>
                                <?php foreach($potansiyelDurumlar as $durum): ?>
                                    <option value="<?= $durum->id ?>"><?= $durum->Durum_Adi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group fiyat-alani">
                            <label>Bizim teklifimiz</label>
                            <div class="input-group">
                                <input type="text" name="fiyat1" class="form-control fiyat-input" placeholder="0">
                                <div class="input-group-append">
                                    <span class="input-group-text">₺</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group fiyat-alani">
                            <label>Müşteri beklentisi</label>
                            <div class="input-group">
                                <input type="text" name="fiyat2" class="form-control fiyat-input" placeholder="0">
                                <div class="input-group-append">
                                    <span class="input-group-text">₺</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group fiyat-alani">
                            <label>Olabilir teklif</label>
                            <div class="input-group">
                                <input type="text" name="fiyat3" class="form-control fiyat-input" placeholder="0">
                                <div class="input-group-append">
                                    <span class="input-group-text">₺</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="aciklama" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Teklif İşlemleri Modal -->
    <div class="modal fade" id="teklifIslemleriModal" tabindex="-1" role="dialog" aria-labelledby="teklifIslemleriModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="teklifIslemleriModalLabel">Teklif İşlemleri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h6 class="mb-3" id="seciliMusteriAdi">Müşteri: </h6>
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-primary btn-lg btn-block" id="teklifOlusturBtn">
                                    <i class="fa fa-plus"></i><br>
                                    Teklif Oluştur
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-info btn-lg btn-block" id="teklifleriGorBtn">
                                    <i class="fa fa-list"></i><br>
                                    Teklifleri Gör
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Teklifleri Görüntüle Modal -->
    <div class="modal fade" id="tekliflerModal" tabindex="-1" role="dialog" aria-labelledby="tekliflerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tekliflerModalLabel">Mevcut Teklifler</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-2 p-md-3">
                    <div id="tekliflerContent">
                        <div class="text-center">
                            <i class="fa fa-spinner fa-spin fa-2x"></i>
                            <p class="mt-2">Teklifler yükleniyor...</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/script.js"></script>
    
    <!-- Debug Script for Toggle -->
    <script>
        $(document).ready(function() {
            console.log('Document ready, checking toggle functionality');
            
            // Toggle butonunun varlığını kontrol et
            if ($('#toggle_btn').length) {
                console.log('Toggle button found');
            } else {
                console.error('Toggle button NOT found');
            }
            
            // Eğer script.js doğru yüklenmediyse, manuel toggle işlevi ekle
            if (!window.toggleHandlerLoaded) {
                console.log('Adding manual toggle handler');
                
                $(document).off('click touchend', '#toggle_btn').on('click touchend', '#toggle_btn', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Manual toggle activated');
                    
                    var $wrapper = $('.main-wrapper');
                    var $overlay = $('.sidebar-overlay');
                    var $html = $('html');
                    var $body = $('body');
                    var isMobile = $(window).width() <= 768;
                    
                    // Overlay yoksa oluştur
                    if (!$('.sidebar-overlay').length) {
                        $('body').append('<div class="sidebar-overlay"></div>');
                        $overlay = $('.sidebar-overlay');
                    }
                    
                    if (isMobile) {
                        $wrapper.toggleClass('slide-nav');
                        $overlay.toggleClass('opened');
                        $html.toggleClass('menu-opened');
                        console.log('Mobile toggle completed');
                    } else {
                        if ($body.hasClass('mini-sidebar')) {
                            $body.removeClass('mini-sidebar');
                            $('.subdrop + ul').slideDown();
                            console.log('Desktop sidebar expanded');
                        } else {
                            $body.addClass('mini-sidebar');
                            $('.subdrop + ul').slideUp();
                            console.log('Desktop sidebar collapsed');
                        }
                    }
                    
                    return false;
                });
                
                // Overlay click handler
                $(document).off('click', '.sidebar-overlay').on('click', '.sidebar-overlay', function() {
                    $('.main-wrapper').removeClass('slide-nav');
                    $('.sidebar-overlay').removeClass('opened');
                    $('html').removeClass('menu-opened');
                    console.log('Overlay clicked, sidebar closed');
                });
            }
        });
    </script>

    <script>
        let secilenPotansiyelCariId = 0;
        
        // Teklif İşlemleri modalını aç
        function teklifIslemleri(potansiyelCariId, musteriAdi) {
            console.log('teklifIslemleri fonksiyonu çağrıldı:', potansiyelCariId, musteriAdi);
            
            secilenPotansiyelCariId = potansiyelCariId;
            
            // jQuery kullanılabilir mi kontrol et
            if (typeof jQuery !== 'undefined') {
                jQuery('#seciliMusteriAdi').text('Müşteri: ' + musteriAdi);
            } else {
                document.getElementById('seciliMusteriAdi').textContent = 'Müşteri: ' + musteriAdi;
            }
            
            // Bootstrap versiyonu kontrol et ve modal aç
            try {
                if (typeof bootstrap !== 'undefined') {
                    // Bootstrap 5
                    console.log('Bootstrap 5 kullanılıyor');
                    const modal = new bootstrap.Modal(document.getElementById('teklifIslemleriModal'));
                    modal.show();
                } else if (typeof jQuery !== 'undefined') {
                    // Bootstrap 4 ile jQuery
                    console.log('Bootstrap 4 ile jQuery kullanılıyor');
                    jQuery('#teklifIslemleriModal').modal('show');
                } else {
                    // Vanilla JS ile manuel açma
                    console.log('Manuel modal açma');
                    const modal = document.getElementById('teklifIslemleriModal');
                    modal.style.display = 'block';
                    modal.classList.add('show');
                    modal.classList.add('fade');
                    document.body.classList.add('modal-open');
                    
                    // Backdrop ekle
                    const backdrop = document.createElement('div');
                    backdrop.className = 'modal-backdrop fade show';
                    backdrop.id = 'modal-backdrop';
                    document.body.appendChild(backdrop);
                }
            } catch (error) {
                console.error('Modal açılırken hata:', error);
                // Son çare manuel açma
                const modal = document.getElementById('teklifIslemleriModal');
                modal.style.display = 'block';
                modal.classList.add('show');
                document.body.classList.add('modal-open');
            }
        }
        
        // Evrensel modal temizleme fonksiyonu
        function modalTemizle() {
            // Tüm modalleri kapat
            const allModals = document.querySelectorAll('.modal');
            allModals.forEach(modal => {
                modal.style.display = 'none';
                modal.classList.remove('show');
            });
            
            // Tüm backdrop'ları kaldır
            const allBackdrops = document.querySelectorAll('.modal-backdrop');
            allBackdrops.forEach(backdrop => backdrop.remove());
            
            // Body'den modal class'ını kaldır
            document.body.classList.remove('modal-open');
            
            // Modal CSS stillerini temizle
            document.body.style.paddingRight = '';
            document.body.style.overflow = '';
        }
        
        // Modal kapatma fonksiyonu
        function modalKapat() {
            try {
                if (typeof bootstrap !== 'undefined') {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('teklifIslemleriModal'));
                    if (modal) modal.hide();
                } else if (typeof jQuery !== 'undefined') {
                    jQuery('#teklifIslemleriModal').modal('hide');
                } else {
                    // Manuel kapatma
                    const modal = document.getElementById('teklifIslemleriModal');
                    modal.style.display = 'none';
                    modal.classList.remove('show');
                    document.body.classList.remove('modal-open');
                    
                    // Backdrop kaldır
                    const backdrop = document.getElementById('modal-backdrop');
                    if (backdrop) backdrop.remove();
                }
                
                // Tüm backdrop'ları temizle
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => backdrop.remove());
                
                // Body'den modal-open class'ını kaldır
                document.body.classList.remove('modal-open');
                
            } catch (error) {
                console.error('Modal kapatılırken hata:', error);
                // Hata durumunda evrensel temizlik
                modalTemizle();
            }
        }
        
        // jQuery hazır olduğunda veya DOM yüklendiğinde çalış
        function sayfaHazir() {
            console.log('Sayfa hazır, event listener\'lar ekleniyor');
            
            // Başarı mesajını göster
            <?php if ($this->session->flashdata('success')): ?>
                alert('<?= $this->session->flashdata('success'); ?>');
            <?php endif; ?>
            
            // Hata mesajını göster
            <?php if ($this->session->flashdata('error')): ?>
                alert('HATA: <?= $this->session->flashdata('error'); ?>');
            <?php endif; ?>
            
            // Teklif Oluştur butonu
            const teklifOlusturBtn = document.getElementById('teklifOlusturBtn');
            if (teklifOlusturBtn) {
                teklifOlusturBtn.addEventListener('click', function() {
                    if (secilenPotansiyelCariId > 0) {
                        // Mevcut modalı kapat
                        modalKapat();
                        
                        // Müşteri bilgilerini yeni modala aktar
                        const musteriAdi = document.getElementById('seciliMusteriAdi').textContent.replace('Müşteri: ', '');
                        document.getElementById('cari_autocomplete_modal').value = musteriAdi;
                        document.getElementById('selected_cari_id_modal').value = secilenPotansiyelCariId;
                        
                        // Yeni Teklif Ekle modalını aç
                        setTimeout(function() {
                            // Önce tüm modal kalıntılarını temizle
                            modalTemizle();
                            
                            // Yeni modalı aç
                            setTimeout(function() {
                                if (typeof bootstrap !== 'undefined') {
                                    const modal = new bootstrap.Modal(document.getElementById('yeniTeklifEkleModal'));
                                    modal.show();
                                } else if (typeof jQuery !== 'undefined') {
                                    jQuery('#yeniTeklifEkleModal').modal('show');
                                } else {
                                    // Manuel açma
                                    const modal = document.getElementById('yeniTeklifEkleModal');
                                    modal.style.display = 'block';
                                    modal.classList.add('show');
                                    document.body.classList.add('modal-open');
                                    
                                    // Backdrop ekle
                                    const backdrop = document.createElement('div');
                                    backdrop.className = 'modal-backdrop fade show';
                                    backdrop.id = 'modal-backdrop';
                                    document.body.appendChild(backdrop);
                                }
                            }, 100);
                        }, 400);
                    }
                });
            }
            
            // Teklifleri Gör butonu
            const teklifleriGorBtn = document.getElementById('teklifleriGorBtn');
            if (teklifleriGorBtn) {
                teklifleriGorBtn.addEventListener('click', function() {
                    if (secilenPotansiyelCariId > 0) {
                        // Modal içinde teklifleri göster
                        teklifleriModalAc(secilenPotansiyelCariId);
                    }
                });
            }
            
            // Modal kapatma butonları
            const closeButtons = document.querySelectorAll('[data-dismiss="modal"]');
            closeButtons.forEach(function(btn) {
                btn.addEventListener('click', modalKapat);
            });
            
            // Teklif modalı kapatma butonları
            const teklifModalCloseButtons = document.querySelectorAll('#tekliflerModal [data-dismiss="modal"]');
            teklifModalCloseButtons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const modal = document.getElementById('tekliflerModal');
                    
                    // Bootstrap versiyonu kontrol et
                    if (typeof bootstrap !== 'undefined') {
                        const modalInstance = bootstrap.Modal.getInstance(modal);
                        if (modalInstance) modalInstance.hide();
                    } else if (typeof jQuery !== 'undefined') {
                        jQuery('#tekliflerModal').modal('hide');
                    } else {
                        // Manuel kapatma
                        modal.style.display = 'none';
                        modal.classList.remove('show');
                    }
                    
                    // Backdrop ve modal açık state'i temizle
                    setTimeout(function() {
                        const allBackdrops = document.querySelectorAll('.modal-backdrop');
                        allBackdrops.forEach(backdrop => backdrop.remove());
                        document.body.classList.remove('modal-open');
                    }, 100);
                });
            });
        }
        
        // Teklifleri modal içinde göster
        function teklifleriModalAc(potansiyelCariId) {
            const modal = document.getElementById('tekliflerModal');
            const content = document.getElementById('tekliflerContent');
            
            // Loading göster
            content.innerHTML = `
                <div class="text-center">
                    <i class="fa fa-spinner fa-spin fa-2x"></i>
                    <p class="mt-2">Teklifler yükleniyor...</p>
                </div>
            `;
            
            // Önce ana modalı tam olarak kapat
            try {
                if (typeof bootstrap !== 'undefined') {
                    const anaModal = bootstrap.Modal.getInstance(document.getElementById('teklifIslemleriModal'));
                    if (anaModal) anaModal.hide();
                } else if (typeof jQuery !== 'undefined') {
                    jQuery('#teklifIslemleriModal').modal('hide');
                } else {
                    modalKapat();
                }
            } catch (error) {
                modalKapat();
            }
            
            // Biraz bekle ki ana modal tamamen kapansın
            setTimeout(function() {
                // Önce tüm modal kalıntılarını temizle
                modalTemizle();
                
                // Teklifler modalını aç
                setTimeout(function() {
                    try {
                        if (typeof bootstrap !== 'undefined') {
                            const teklifModal = new bootstrap.Modal(document.getElementById('tekliflerModal'));
                            teklifModal.show();
                        } else if (typeof jQuery !== 'undefined') {
                            jQuery('#tekliflerModal').modal('show');
                        } else {
                            // Manuel açma
                            modal.style.display = 'block';
                            modal.classList.add('show');
                            document.body.classList.add('modal-open');
                            
                            // Backdrop ekle
                            const backdrop = document.createElement('div');
                            backdrop.className = 'modal-backdrop fade show';
                            backdrop.id = 'teklif-modal-backdrop';
                            document.body.appendChild(backdrop);
                        }
                    } catch (error) {
                        // Manuel açma fallback
                        modal.style.display = 'block';
                        modal.classList.add('show');
                        document.body.classList.add('modal-open');
                        
                        // Backdrop ekle
                        const backdrop = document.createElement('div');
                        backdrop.className = 'modal-backdrop fade show';
                        backdrop.id = 'teklif-modal-backdrop';
                        document.body.appendChild(backdrop);
                    }
                }, 100);
            }, 400);
            
            // AJAX ile teklifleri getir
            fetch('<?= base_url("talepler/get_teklifler"); ?>?cari_id=' + potansiyelCariId)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let html = '';
                        if (data.teklifler && data.teklifler.length > 0) {
                            // Desktop için tablo
                            html = '<div class="d-none d-md-block">';
                            html += '<div class="table-responsive">';
                            html += '<table class="table table-striped">';
                            html += '<thead><tr><th>Tarih</th><th>Durum</th><th>Bizim Teklifimiz</th><th>Müşteri Beklentisi</th><th>Olabilir Teklif</th><th>Açıklama</th></tr></thead>';
                            html += '<tbody>';
                            data.teklifler.forEach(function(teklif) {
                                html += '<tr>';
                                html += '<td>' + teklif.tarih + '</td>';
                                html += '<td>' + teklif.durum + '</td>';
                                html += '<td>' + (teklif.fiyat1 || '-') + '</td>';
                                html += '<td>' + (teklif.fiyat2 || '-') + '</td>';
                                html += '<td>' + (teklif.fiyat3 || '-') + '</td>';
                                html += '<td>' + (teklif.aciklama || '-') + '</td>';
                                html += '</tr>';
                            });
                            html += '</tbody></table></div>';
                            html += '</div>';
                            
                            // Mobile için card yapısı
                            html += '<div class="d-block d-md-none">';
                            data.teklifler.forEach(function(teklif, index) {
                                html += '<div class="card teklif-card mb-3">';
                                html += '<div class="card-header" id="heading' + index + '">';
                                html += '<h6 class="mb-0">';
                                html += '<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse' + index + '" aria-expanded="' + (index === 0 ? 'true' : 'false') + '" aria-controls="collapse' + index + '">';
                                html += '<i class="fa fa-calendar mr-2 text-primary"></i>' + teklif.tarih + ' - <span class="badge badge-info">' + teklif.durum + '</span>';
                                html += '<i class="fa fa-chevron-down float-right mt-1"></i>';
                                html += '</button>';
                                html += '</h6>';
                                html += '</div>';
                                html += '<div id="collapse' + index + '" class="collapse ' + (index === 0 ? 'show' : '') + '" aria-labelledby="heading' + index + '">';
                                html += '<div class="card-body">';
                                html += '<div class="row mb-2">';
                                html += '<div class="col-6"><strong class="text-primary">Bizim Teklifimiz:</strong></div>';
                                html += '<div class="col-6 text-success font-weight-bold">' + (teklif.fiyat1 || '<span class="text-muted">-</span>') + '</div>';
                                html += '</div>';
                                html += '<div class="row mb-2">';
                                html += '<div class="col-6"><strong class="text-info">Müşteri Beklentisi:</strong></div>';
                                html += '<div class="col-6 text-warning font-weight-bold">' + (teklif.fiyat2 || '<span class="text-muted">-</span>') + '</div>';
                                html += '</div>';
                                html += '<div class="row mb-2">';
                                html += '<div class="col-6"><strong class="text-secondary">Olabilir Teklif:</strong></div>';
                                html += '<div class="col-6 text-dark font-weight-bold">' + (teklif.fiyat3 || '<span class="text-muted">-</span>') + '</div>';
                                html += '</div>';
                                if (teklif.aciklama && teklif.aciklama !== '-') {
                                    html += '<hr class="my-2">';
                                    html += '<div class="row">';
                                    html += '<div class="col-12"><strong class="text-muted">Açıklama:</strong></div>';
                                    html += '<div class="col-12"><small class="text-muted">' + teklif.aciklama + '</small></div>';
                                    html += '</div>';
                                }
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';
                            });
                            html += '</div>';
                        } else {
                            html = `
                                <div class="text-center py-4">
                                    <i class="fa fa-info-circle fa-3x text-muted mb-3"></i>
                                    <h5>Henüz Teklif Bulunmuyor</h5>
                                    <p class="text-muted">Bu müşteri için henüz teklif oluşturulmamış.</p>
                                </div>
                            `;
                        }
                        content.innerHTML = html;
                    } else {
                        content.innerHTML = `
                            <div class="text-center py-4">
                                <i class="fa fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                                <h5>Hata</h5>
                                <p class="text-muted">Teklifler yüklenirken bir hata oluştu.</p>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Teklif yükleme hatası:', error);
                    content.innerHTML = `
                        <div class="text-center py-4">
                            <i class="fa fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                            <h5>Hata</h5>
                            <p class="text-muted">Teklifler yüklenirken bir hata oluştu.</p>
                        </div>
                    `;
                });
        }
        
        // jQuery varsa kullan, yoksa DOMContentLoaded kullan
        if (typeof jQuery !== 'undefined') {
            jQuery(document).ready(sayfaHazir);
        } else {
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', sayfaHazir);
            } else {
                sayfaHazir();
            }
        }
    </script>
    
    <?php $this->load->view("include/footer-js"); ?>
    
    <!-- Sidebar Toggle Debug ve Force Fix -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded, checking sidebar toggle...');
        
        // Sidebar menü event handler'larını manuel olarak ekle
        setTimeout(function() {
            console.log('Initializing sidebar menu handlers...');
            
            // Önceki event handler'ları temizle
            $('#sidebar-menu a').off('click.sidebarMenu');
            
            // Sidebar menü linklerini yeniden initialize et
            $('#sidebar-menu a').on('click.sidebarMenu', function(e) {
                var $this = $(this);
                var $parent = $this.parent();
                var href = $this.attr('href');
                
                console.log('Sidebar menu link clicked:', href);
                console.log('Parent has submenu class:', $parent.hasClass('submenu'));
                
                // Submenu kontrolü
                if ($parent.hasClass('submenu')) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    console.log('Submenu clicked, current subdrop state:', $this.hasClass('subdrop'));
                    
                    if (!$this.hasClass('subdrop')) {
                        // Diğer açık menüleri kapat
                        $('#sidebar-menu .submenu > a').removeClass('subdrop');
                        $('#sidebar-menu .submenu ul').slideUp(350);
                        
                        // Bu menüyü aç
                        $this.addClass('subdrop');
                        $this.next('ul').slideDown(350);
                        
                        console.log('Submenu opened');
                    } else {
                        // Bu menüyü kapat
                        $this.removeClass('subdrop');
                        $this.next('ul').slideUp(350);
                        
                        console.log('Submenu closed');
                    }
                } else {
                    // Normal link - sayfaya git
                    if (href && href !== '#' && href !== 'javascript:void(0);') {
                        console.log('Navigating to:', href);
                        
                        // Mobilde sidebar'ı kapat
                        if ($(window).width() <= 768) {
                            setTimeout(function() {
                                $('.main-wrapper').removeClass('slide-nav');
                                $('.sidebar-overlay').removeClass('opened');
                                $('html').removeClass('menu-opened');
                            }, 100);
                        }
                        
                        // Sayfaya git
                        window.location.href = href;
                    }
                }
            });
            
            // Aktif menüyü başlangıçta aç
            $('#sidebar-menu .submenu.active > a').each(function() {
                $(this).addClass('subdrop');
                $(this).next('ul').show();
            });
            
            console.log('Sidebar menu handlers initialized');
            
            // Menu arrow'lar için CSS ekle
            if (!$('#sidebar-menu-arrow-css').length) {
                $('<style id="sidebar-menu-arrow-css">' +
                  '.sidebar-menu .submenu > a .menu-arrow { float: right; margin-top: 5px; } ' +
                  '.sidebar-menu .submenu > a .menu-arrow::after { content: "\\f107"; font-family: "Font Awesome 5 Free"; font-weight: 900; } ' +
                  '.sidebar-menu .submenu > a.subdrop .menu-arrow::after { content: "\\f106"; } ' +
                  '</style>').appendTo('head');
            }
        }, 500);
        
        // Toggle butonunu bul
        var toggleBtn = document.getElementById('toggle_btn');
        var mobileBtn = document.getElementById('mobile_btn');
        
        console.log('Toggle button found:', !!toggleBtn);
        console.log('Mobile button found:', !!mobileBtn);
        
        if (toggleBtn) {
            console.log('Toggle button exists, adding event listeners...');
            
            // Mevcut event listener'ları temizle
            toggleBtn.removeEventListener('click', toggleSidebar);
            toggleBtn.removeEventListener('touchend', toggleSidebar);
            
            // Yeni event listener'ları ekle
            toggleBtn.addEventListener('click', toggleSidebar);
            toggleBtn.addEventListener('touchend', toggleSidebar);
            
            console.log('Event listeners added to toggle button');
        }
        
        if (mobileBtn) {
            console.log('Mobile button exists, adding event listeners...');
            
            // Mevcut event listener'ları temizle
            mobileBtn.removeEventListener('click', toggleSidebar);
            mobileBtn.removeEventListener('touchend', toggleSidebar);
            
            // Yeni event listener'ları ekle
            mobileBtn.addEventListener('click', toggleSidebar);
            mobileBtn.addEventListener('touchend', toggleSidebar);
            
            console.log('Event listeners added to mobile button');
        }
        
        function toggleSidebar(e) {
            console.log('Toggle sidebar called, event:', e.type);
            e.preventDefault();
            e.stopPropagation();
            
            var wrapper = document.querySelector('.main-wrapper');
            var overlay = document.querySelector('.sidebar-overlay');
            var html = document.documentElement;
            var body = document.body;
            var isMobile = window.innerWidth <= 768;
            
            console.log('Is mobile:', isMobile);
            console.log('Wrapper exists:', !!wrapper);
            console.log('Overlay exists:', !!overlay);
            
            if (isMobile) {
                // Mobile behavior
                if (wrapper) {
                    wrapper.classList.toggle('slide-nav');
                    console.log('Mobile: Toggled slide-nav class');
                }
                if (overlay) {
                    overlay.classList.toggle('opened');
                    console.log('Mobile: Toggled overlay opened class');
                }
                if (html) {
                    html.classList.toggle('menu-opened');
                    console.log('Mobile: Toggled html menu-opened class');
                }
            } else {
                // Desktop behavior
                if (body.classList.contains('mini-sidebar')) {
                    body.classList.remove('mini-sidebar');
                    console.log('Desktop: Removed mini-sidebar class');
                } else {
                    body.classList.add('mini-sidebar');
                    console.log('Desktop: Added mini-sidebar class');
                }
            }
            
            console.log('Sidebar toggle completed');
            return false;
        }
        
        // Overlay'e tıklandığında sidebar'ı kapat
        var overlay = document.querySelector('.sidebar-overlay');
        if (overlay) {
            overlay.addEventListener('click', function() {
                console.log('Overlay clicked, closing sidebar');
                var wrapper = document.querySelector('.main-wrapper');
                var html = document.documentElement;
                
                if (wrapper) {
                    wrapper.classList.remove('slide-nav');
                }
                overlay.classList.remove('opened');
                if (html) {
                    html.classList.remove('menu-opened');
                }
                console.log('Sidebar closed via overlay');
            });
        }
        
        // Sidebar overlay'i body'ye ekle (yoksa)
        if (!document.querySelector('.sidebar-overlay')) {
            var sidebarOverlay = document.createElement('div');
            sidebarOverlay.className = 'sidebar-overlay';
            document.body.appendChild(sidebarOverlay);
            console.log('Sidebar overlay created and added to body');
        }
    });
    </script>
</body>
</html>
