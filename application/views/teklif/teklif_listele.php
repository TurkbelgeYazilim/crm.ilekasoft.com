<!DOCTYPE html>
<html lang="tr">
<head>    <title>Potansiyel Satışlar | İlekaSoft CRM</title>
    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <?php $this->load->view("include/head-tags"); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css" integrity="sha512-UVksC7mwMZ0W9Ow+r7grrHVfIzB9a7a1Vz3r9OPjCGWOYSdTt6EsWWLnJYhxO8ld7aLdyNQXcZ3hHKe2ksE5A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <style>
        .ui-autocomplete {
            z-index: 999999;
            max-height: 200px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
            /* add padding to account for vertical scrollbar */
            padding-right: 20px;
        }
          /* Mobilde Önceki Sayfa butonunu gizle */
        @media (max-width: 767px) {
            .mobile-hide {
                display: none !important;
            }
            
            /* Mobil tablo optimizasyonları */
            .table-responsive {
                border: none;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            .custom-table {
                min-width: 800px;
                font-size: 12px;
            }
            
            .custom-table th,
            .custom-table td {
                padding: 8px 4px;
                white-space: nowrap;
                max-width: 120px;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            
            /* Açıklama kolonu için özel stil */
            .custom-table td:nth-child(7) {
                max-width: 100px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            
            /* Card padding'i azalt */
            .card-body {
                padding: 15px 10px;
            }
            
            /* Başlık font boyutu */
            .page-title {
                font-size: 1.5rem;
            }
            
            /* Alert mesajı */
            .alert {
                font-size: 13px;
                padding: 10px;
            }
            
            /* Breadcrumb gizle */
            .breadcrumb {
                display: none;
            }
            
            /* Mobil için alternatif card görünüm */
            .mobile-card-view {
                display: none;
            }
            
            .mobile-card-view.active {
                display: block;
            }
            
            .mobile-record-card {
                background: #fff;
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                margin-bottom: 15px;
                padding: 15px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            
            .mobile-record-card .record-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 10px;
                padding-bottom: 8px;
                border-bottom: 1px solid #f0f0f0;
            }
            
            .mobile-record-card .record-id {
                font-weight: bold;
                color: #007bff;
                font-size: 16px;
            }
            
            .mobile-record-card .record-status {
                background: #28a745;
                color: white;
                padding: 4px 8px;
                border-radius: 12px;
                font-size: 11px;
            }
            
            .mobile-record-card .record-details {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 8px;
                font-size: 13px;
            }
            
            .mobile-record-card .detail-item {
                display: flex;
                flex-direction: column;
            }
            
            .mobile-record-card .detail-label {
                font-weight: 600;
                color: #666;
                font-size: 11px;
                text-transform: uppercase;
                margin-bottom: 2px;
            }
            
            .mobile-record-card .detail-value {
                color: #333;
                word-break: break-word;
            }
            
            .mobile-record-card .customer-name {
                font-weight: bold;
                color: #333;
                font-size: 14px;
                margin-bottom: 8px;
            }
        }
        
        /* Tablet ve masaüstü için */
        @media (min-width: 768px) {
            .custom-table th,
            .custom-table td {
                padding: 12px 8px;
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
                <!-- Sayfa Başlıkları -->                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-10">
                            <h3 class="page-title">Potansiyel Satışlar</h3>                            <?php if(!empty($_GET['cari_ad'])): ?>
                                <div class="alert alert-info mt-2">
                                    <strong><?= urldecode($_GET['cari_ad']) ?></strong> müşterisine ait potansiyel satışlar listeleniyor.
                                </div>
                            <?php endif; ?>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
                                <li class="breadcrumb-item">Teklif</li>
                                <li class="breadcrumb-item active">Potansiyel Satışlar</li>
                            </ul>
                        </div>                        <div class="d-flex justify-content-end text-align-center col-sm-2 mobile-hide">
                            <a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
                        </div>
                    </div>
                    <div class="row mt-2">
                    </div>
                </div>
                <!-- /Sayfa Başlıkları -->                <!-- Potansiyel Satış Tablosu -->
                <div class="card card-table">
                    <div class="card-body">
                        <!-- View Toggle for Mobile -->
                        <div class="d-block d-md-none mb-3">
                            <div class="btn-group w-100" role="group">
                                <button type="button" class="btn btn-outline-primary active" id="table-view-btn">
                                    <i class="fa fa-table"></i> Tablo
                                </button>
                                <button type="button" class="btn btn-outline-primary" id="card-view-btn">
                                    <i class="fa fa-th-large"></i> Kart
                                </button>
                            </div>
                        </div>
                          <div class="table-responsive" id="table-view">
                            <table class="table table-striped custom-table mb-0" id="potansiyel-table">
                                <thead>
                                    <tr>
                                        <th data-priority="1">#</th>
                                        <th data-priority="1">Cari</th>
                                        <th data-priority="2">Durum</th>
                                        <th data-priority="3" class="d-none d-md-table-cell">Fiyat 1</th>
                                        <th data-priority="4" class="d-none d-lg-table-cell">Fiyat 2</th>
                                        <th data-priority="5" class="d-none d-lg-table-cell">Fiyat 3</th>
                                        <th data-priority="3" class="d-none d-md-table-cell">Açıklama</th>
                                        <th data-priority="2">İşlem Tarihi</th>
                                        <th data-priority="4" class="d-none d-md-table-cell">İşlemi Yapan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($potansiyel_satislar) && count($potansiyel_satislar) > 0): ?>
                                        <?php foreach($potansiyel_satislar as $s): ?>
                                            <tr>
                                                <td data-label="#"><?= $s->id ?></td>
                                                <td data-label="Cari"><?= $s->potansiyel_cari_ad ?></td>
                                                <td data-label="Durum"><?= $s->durum_adi ?></td>
                                                <td data-label="Fiyat 1" class="d-none d-md-table-cell"><?= $s->fiyat1 ?></td>
                                                <td data-label="Fiyat 2" class="d-none d-lg-table-cell"><?= $s->fiyat2 ?></td>
                                                <td data-label="Fiyat 3" class="d-none d-lg-table-cell"><?= $s->fiyat3 ?></td>
                                                <td data-label="Açıklama" class="d-none d-md-table-cell" title="<?= htmlspecialchars($s->aciklama) ?>"><?= mb_strlen($s->aciklama) > 30 ? mb_substr($s->aciklama, 0, 30) . '...' : $s->aciklama ?></td>
                                                <td data-label="İşlem Tarihi"><?= date('d.m.Y', strtotime($s->islem_tarihi)) ?></td>
                                                <td data-label="İşlemi Yapan" class="d-none d-md-table-cell"><?= $s->islemi_yapan_ad ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="9" class="text-center">Kayıt bulunamadı.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Card View for Mobile -->
                        <div class="mobile-card-view d-block d-md-none" id="card-view" style="display: none !important;">
                            <?php if(isset($potansiyel_satislar) && count($potansiyel_satislar) > 0): ?>
                                <?php foreach($potansiyel_satislar as $s): ?>
                                    <div class="mobile-record-card">
                                        <div class="record-header">
                                            <span class="record-id">#<?= $s->id ?></span>
                                            <span class="record-status"><?= $s->durum_adi ?></span>
                                        </div>
                                        <div class="customer-name"><?= $s->potansiyel_cari_ad ?></div>
                                        <div class="record-details">
                                            <div class="detail-item">
                                                <span class="detail-label">Fiyat 1</span>
                                                <span class="detail-value"><?= $s->fiyat1 ?: '-' ?></span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label">Fiyat 2</span>
                                                <span class="detail-value"><?= $s->fiyat2 ?: '-' ?></span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label">Fiyat 3</span>
                                                <span class="detail-value"><?= $s->fiyat3 ?: '-' ?></span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label">İşlem Tarihi</span>
                                                <span class="detail-value"><?= date('d.m.Y', strtotime($s->islem_tarihi)) ?></span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label">İşlemi Yapan</span>
                                                <span class="detail-value"><?= $s->islemi_yapan_ad ?></span>
                                            </div>
                                            <?php if(!empty($s->aciklama)): ?>
                                            <div class="detail-item" style="grid-column: 1 / -1;">
                                                <span class="detail-label">Açıklama</span>
                                                <span class="detail-value"><?= $s->aciklama ?></span>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-4">
                                    <p class="text-muted">Kayıt bulunamadı.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- /Potansiyel Satış Tablosu -->

                <!-- Potansiyel Satış Ekle Modal -->
                <div class="modal fade" id="potansiyelSatisEkleModal" tabindex="-1" role="dialog" aria-labelledby="potansiyelSatisEkleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form method="post" action="<?= base_url('teklif/potansiyel_satis_ekle') ?>">
                        <div class="modal-header">
                          <h5 class="modal-title" id="potansiyelSatisEkleModalLabel">Yeni Potansiyel Satış Ekle</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>                        <div class="modal-body">
                          <div class="form-group">
                            <label>Müşteri Seç</label>
                            <input type="text" id="cari_autocomplete" class="form-control" placeholder="En az 4 karakter yazın..." autocomplete="off">
                            <input type="hidden" name="potansiyel_cari_id" id="selected_cari_id" required>
                          </div>
                          <div class="form-group">
                            <label>Durum</label>
                            <input type="number" name="durum_id" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label>Fiyat 1</label>
                            <input type="number" step="0.01" name="fiyat1" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Fiyat 2</label>
                            <input type="number" step="0.01" name="fiyat2" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Fiyat 3</label>
                            <input type="number" step="0.01" name="fiyat3" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="aciklama" class="form-control"></textarea>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                          <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /Potansiyel Satış Ekle Modal -->
            </div>
        </div>
        <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->    <?php $this->load->view("include/footer-js"); ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script>
    $(document).ready(function() {
        console.log("Autocomplete script loaded");
        
        // Autocomplete for Cari selection
        $("#cari_autocomplete").autocomplete({
            source: function(request, response) {
                console.log("Autocomplete source called with term:", request.term);
                $.ajax({
                    url: "<?= base_url('teklif/potansiyel_cari_autocomplete') ?>",
                    data: {
                        term: request.term
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log("Autocomplete response:", data);
                        response(data);
                    },
                    error: function(xhr, status, error) {
                        console.error("Autocomplete error:", error);
                        console.error("Response:", xhr.responseText);
                        response([]);
                    }
                });
            },
            minLength: 4,
            select: function(event, ui) {
                event.preventDefault();
                console.log("Selected item:", ui.item);
                $("#selected_cari_id").val(ui.item.id);
                $("#cari_autocomplete").val(ui.item.value);
                
                // Show success message
                toastr.success(ui.item.cari_ad + " müşterisi seçildi.");
            },
            focus: function(event, ui) {
                event.preventDefault();
                $("#cari_autocomplete").val(ui.item.value);
            }
        });
        
        // Clear selection when input is manually changed
        $("#cari_autocomplete").on('input', function() {
            if ($(this).val().length < 4) {
                $("#selected_cari_id").val('');
            }
        });
        
        // Clear form when modal is closed
        $('#potansiyelSatisEkleModal').on('hidden.bs.modal', function() {
            $("#cari_autocomplete").val('');
            $("#selected_cari_id").val('');
            $(this).find('form')[0].reset();
        });
          // Toggle between table and card view
        $("#table-view-btn").on("click", function() {
            $(this).addClass("active");
            $("#card-view-btn").removeClass("active");
            $("#table-view").show();
            $("#card-view").hide();
        });
        
        $("#card-view-btn").on("click", function() {
            $(this).addClass("active");
            $("#table-view-btn").removeClass("active");
            $("#table-view").hide();
            $("#card-view").show();
        });
    });
    </script>
</body>
</html>
