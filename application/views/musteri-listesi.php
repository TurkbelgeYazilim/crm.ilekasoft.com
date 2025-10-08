<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Müşteri Listesi</h4>
                <h6>Sistemdeki tüm müşteri kayıtlarını görüntüleyin</h6>
            </div>
        </div>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> <?= $error_message ?>
            </div>
        <?php endif; ?>

        <!-- Filtreler -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Tarih Aralığı</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="baslangic_tarihi" placeholder="Başlangıç">
                                <input type="date" class="form-control" id="bitis_tarihi" placeholder="Bitiş">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Müşteri Durumu</label>
                            <select class="form-control" id="durum_filtre">
                                <option value="">Tüm Durumlar</option>
                                <option value="1">Aktif</option>
                                <option value="0">Pasif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Müşteri Tipi</label>
                            <select class="form-control" id="tip_filtre">
                                <option value="">Tüm Tipler</option>
                                <option value="1">Bireysel</option>
                                <option value="0">Kurumsal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div class="d-flex">
                                <button type="button" class="btn btn-primary me-2" onclick="filtrele()">
                                    <i class="fas fa-search"></i> Filtrele
                                </button>
                                <button type="button" class="btn btn-secondary" onclick="filtreTemizle()">
                                    <i class="fas fa-times"></i> Temizle
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Müşteri Listesi -->
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="<?= base_url('assets/img/icons/filter.svg') ?>" alt="img">
                                <span><img src="<?= base_url('assets/img/icons/closes.svg') ?>" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset">
                                <img src="<?= base_url('assets/img/icons/search-white.svg') ?>" alt="img">
                            </a>
                            <input type="text" placeholder="Müşteri ara..." id="global_search">
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel" onclick="exportExcel()">
                                    <img src="<?= base_url('assets/img/icons/excel.svg') ?>" alt="img">
                                </a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print" onclick="printTable()">
                                    <img src="<?= base_url('assets/img/icons/printer.svg') ?>" alt="img">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table datanew" id="musteriTable">
                        <thead>
                            <tr>
                                <th>Müşteri Kodu</th>
                                <th>Ad Soyad</th>
                                <th>Telefon</th>
                                <th>E-posta</th>
                                <th>Durum</th>
                                <th>Tip</th>
                                <th>Kayıt Tarihi</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($musteriler) && !empty($musteriler)): ?>
                                <?php foreach ($musteriler as $musteri): ?>
                                    <tr>
                                        <td><?= isset($musteri->cari_kodu) ? htmlspecialchars($musteri->cari_kodu) : '-' ?></td>
                                        <td>
                                            <?php 
                                            $ad_soyad = '';
                                            if (isset($musteri->cari_ad)) $ad_soyad .= $musteri->cari_ad;
                                            if (isset($musteri->cari_soyad)) $ad_soyad .= ' ' . $musteri->cari_soyad;
                                            echo htmlspecialchars(trim($ad_soyad)) ?: '-';
                                            ?>
                                        </td>
                                        <td><?= isset($musteri->cari_firmaTelefon) ? htmlspecialchars($musteri->cari_firmaTelefon) : '-' ?></td>
                                        <td><?= isset($musteri->cari_firmaEPosta) ? htmlspecialchars($musteri->cari_firmaEPosta) : '-' ?></td>
                                        <td>
                                            <?php if (isset($musteri->cari_durum)): ?>
                                                <?php if ($musteri->cari_durum == 1): ?>
                                                    <span class="badges bg-lightgreen">Aktif</span>
                                                <?php else: ?>
                                                    <span class="badges bg-lightred">Pasif</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="badges bg-lightgrey">Bilinmiyor</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (isset($musteri->cari_bireysel)): ?>
                                                <?php if ($musteri->cari_bireysel == 1): ?>
                                                    <span class="badges bg-lightblue">Bireysel</span>
                                                <?php else: ?>
                                                    <span class="badges bg-lightyellow">Kurumsal</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="badges bg-lightgrey">Tanımsız</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php 
                                            if (isset($musteri->cari_olusturmaTarihi)) {
                                                echo date('d.m.Y', strtotime($musteri->cari_olusturmaTarihi));
                                            } else {
                                                echo '-';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a class="me-3" href="javascript:void(0);" onclick="musteriDetay(<?= $musteri->cari_id ?>)">
                                                <img src="<?= base_url('assets/img/icons/eye.svg') ?>" alt="img">
                                            </a>
                                            <a class="me-3" href="<?= base_url('cari/cari-karti-duzenle/' . $musteri->cari_id) ?>">
                                                <img src="<?= base_url('assets/img/icons/edit.svg') ?>" alt="img">
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">Henüz müşteri kaydı bulunmuyor.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Müşteri Detay Modal -->
<div class="modal fade" id="musteriDetayModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Müşteri Detayları</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="musteriDetayContent">
                <!-- Müşteri detayları buraya yüklenecek -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // DataTable başlat
    $('#musteriTable').DataTable({
        "responsive": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Turkish.json"
        },
        "pageLength": 25,
        "order": [[6, "desc"]] // Kayıt tarihine göre sırala
    });
});

function filtrele() {
    var table = $('#musteriTable').DataTable();
    
    // Tüm filtreleri temizle
    table.columns().search('').draw();
    
    // Tarih filtresi
    var baslangic = $('#baslangic_tarihi').val();
    var bitis = $('#bitis_tarihi').val();
    
    // Durum filtresi
    var durum = $('#durum_filtre').val();
    if (durum !== '') {
        table.column(4).search(durum == '1' ? 'Aktif' : 'Pasif').draw();
    }
    
    // Tip filtresi
    var tip = $('#tip_filtre').val();
    if (tip !== '') {
        table.column(5).search(tip == '1' ? 'Bireysel' : 'Kurumsal').draw();
    }
}

function filtreTemizle() {
    $('#baslangic_tarihi').val('');
    $('#bitis_tarihi').val('');
    $('#durum_filtre').val('');
    $('#tip_filtre').val('');
    $('#global_search').val('');
    
    var table = $('#musteriTable').DataTable();
    table.search('').columns().search('').draw();
}

function musteriDetay(musteriId) {
    // AJAX ile müşteri detaylarını getir
    $.ajax({
        url: '<?= base_url("cari/cari-detay") ?>',
        type: 'POST',
        data: { cari_id: musteriId },
        success: function(response) {
            $('#musteriDetayContent').html(response);
            $('#musteriDetayModal').modal('show');
        },
        error: function() {
            alert('Müşteri detayları yüklenirken hata oluştu.');
        }
    });
}

function exportExcel() {
    // Excel export fonksiyonu
    var table = $('#musteriTable').DataTable();
    var data = table.buttons.exportData();
    
    // Excel export kodu buraya gelecek
    alert('Excel export özelliği yakında eklenecek.');
}

function printTable() {
    // Print fonksiyonu
    window.print();
}

// Global arama
$('#global_search').on('keyup', function() {
    $('#musteriTable').DataTable().search(this.value).draw();
});
</script>
