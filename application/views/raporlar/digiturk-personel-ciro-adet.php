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
                                <li class="breadcrumb-item active">Digiturk Personel Ciro/Adet</li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-end text-align-center col-sm-2">
                            <a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

            <!-- Filtreler -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Filtreler</h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="<?= base_url('raporlar/digiturk-personel-ciro-adet') ?>">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="baslangic_tarihi">Başlangıç Tarihi</label>
                                            <input type="date" class="form-control" id="baslangic_tarihi" name="baslangic_tarihi" value="<?= $baslangic_tarihi ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="bitis_tarihi">Bitiş Tarihi</label>
                                            <input type="date" class="form-control" id="bitis_tarihi" name="bitis_tarihi" value="<?= $bitis_tarihi ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="personel_id">Personel</label>
                                            <select class="form-control" id="personel_id" name="personel_id">
                                                <option value="">Tüm Personeller</option>
                                                <?php foreach($personel_listesi as $personel): ?>
                                                    <option value="<?= $personel->kullanici_id ?>" <?= ($personel_id == $personel->kullanici_id) ? 'selected' : '' ?>>
                                                        <?= $personel->personel_adi ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div>
                                                <button type="submit" class="btn btn-primary w-100">
                                                    <i class="fas fa-filter"></i> Filtrele
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

            <!-- Debug Bilgileri - Geçici olarak gizlendi (sorun çözüldü) -->
            <?php if(false && isset($debug_info)): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-warning">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="card-title mb-0">🔍 Debug Bilgileri</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="alert alert-info">
                                        <strong>Aktivasyon Kayıtları:</strong><br>
                                        <span class="h4"><?= $debug_info['aktivasyon_count'] ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="alert alert-primary">
                                        <strong>Satış Kayıtları (Tarih Aralığı):</strong><br>
                                        <span class="h4"><?= $debug_info['satis_count'] ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="alert alert-success">
                                        <strong>Aktif Personel:</strong><br>
                                        <span class="h4"><?= $debug_info['personel_count'] ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="alert alert-warning">
                                        <strong>JOIN Sonucu:</strong><br>
                                        <span class="h4"><?= $debug_info['join_test_count'] ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php if(isset($debug_info['alternative_query'])): ?>
                            <div class="alert alert-danger">
                                <strong>Not:</strong> <?= $debug_info['alternative_query'] ?><br>
                                <strong>Alternatif sorgu kullanıldı mı:</strong> <?= $debug_info['used_alternative'] ? 'Evet' : 'Hayır' ?>
                            </div>
                            <?php endif; ?>
                            <div class="alert alert-secondary">
                                <strong>Tarih Aralığı:</strong> <?= $baslangic_tarihi ?> - <?= $bitis_tarihi ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Rapor Tablosu -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Digiturk Personel Ciro/Adet Raporu
                                <span class="badge badge-info ml-2"><?= count($rapor_verileri) ?> kayıt</span>
                            </h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-sm btn-success" onclick="exportToExcel()">
                                    <i class="fas fa-file-excel"></i> Excel'e Aktar
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if(empty($rapor_verileri)): ?>
                            <div class="alert alert-warning text-center">
                                <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                                <h5>Veri Bulunamadı</h5>
                                <p>Seçilen tarih aralığında personel raporu verisi bulunamadı.</p>
                                <small class="text-muted">Lütfen farklı bir tarih aralığı deneyin veya debug bilgilerini kontrol edin.</small>
                            </div>
                            <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="raporTablosu">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Kullanıcı Grubu</th>
                                            <th>Personel Adı</th>
                                            <th>Toplam Satış Adedi</th>
                                            <th>Toplam Ciro (₺)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $toplam_adet = 0;
                                        $toplam_ciro = 0;
                                        $sira = 1;
                                        foreach($rapor_verileri as $veri): 
                                            $toplam_adet += $veri->toplam_satis_adedi;
                                            $toplam_ciro += $veri->toplam_ciro;
                                        ?>
                                        <tr>
                                            <td><?= $sira++ ?></td>
                                            <td><?= $veri->kullanici_grubu ?? 'Belirtilmemiş' ?></td>
                                            <td><?= $veri->personel_adi ?></td>
                                            <td class="text-center">
                                                <span class="badge badge-primary"><?= number_format($veri->toplam_satis_adedi) ?></span>
                                            </td>
                                            <td class="text-right">
                                                <strong><?= number_format($veri->toplam_ciro, 2) ?> ₺</strong>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot class="thead-light">
                                        <tr>
                                            <th colspan="3" class="text-right">TOPLAM:</th>
                                            <th class="text-center">
                                                <span class="badge badge-success"><?= number_format($toplam_adet) ?></span>
                                            </th>
                                            <th class="text-right">
                                                <strong><?= number_format($toplam_ciro, 2) ?> ₺</strong>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
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

        <?php $this->load->view("include/footer-js"); ?>

        <script>
        $(document).ready(function() {
            // DataTable başlatma
            $('#raporTablosu').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/tr.json"
                },
                "pageLength": 25,
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tümü"]],
                "order": [[ 4, "desc" ]], // Toplam ciro'ya göre sırala
                "columnDefs": [
                    {
                        "targets": [3, 4], // Sayısal sütunlar
                        "className": "text-right"
                    }
                ],
                "dom": 'Bfrtip',
                "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

        // Excel'e aktarma fonksiyonu
        function exportToExcel() {
            var table = $('#raporTablosu').DataTable();
            var data = [];
            
            // Başlık satırı
            var headers = [];
            $('#raporTablosu thead th').each(function() {
                headers.push($(this).text());
            });
            data.push(headers);
            
            // Veri satırları
            table.rows().every(function() {
                var rowData = [];
                var row = this.data();
                $(this.node()).find('td').each(function() {
                    rowData.push($(this).text().replace('₺', '').trim());
                });
                data.push(rowData);
            });
            
            // Excel dosyası oluştur
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet(data);
            XLSX.utils.book_append_sheet(wb, ws, "Digiturk Personel Raporu");
            XLSX.writeFile(wb, "digiturk_personel_ciro_adet_raporu_" + new Date().toISOString().slice(0,10) + ".xlsx");
        }
        </script>

    </body>
</html>
