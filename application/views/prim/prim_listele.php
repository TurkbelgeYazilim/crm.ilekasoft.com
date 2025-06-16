<!DOCTYPE html>
<html lang="tr">
<head>    <title>Potansiyel Satışlar | İlekaSoft CRM</title>
    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <?php $this->load->view("include/head-tags"); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css" integrity="sha512-UVksC7mwMZ0W9Ow+r7grrHVfIzB9a7a1Vz3r9OPjCGWOYSdTt6EsWWLnJYhxO8ld7aLdyNQXcZ3hHKe2ksE5A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .ui-autocomplete {
            z-index: 999999;
            max-height: 200px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
            /* add padding to account for vertical scrollbar */
            padding-right: 20px;
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
                <!-- Sayfa Başlıkları -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-10">
                            <h3 class="page-title">Potansiyel Satışlar</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
                                <li class="breadcrumb-item">Prim</li>
                                <li class="breadcrumb-item active">Potansiyel Satışlar</li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-end text-align-center col-sm-2">
                            <a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <h5 class="text-muted">Potansiyel satış kayıtlarını görüntüleyebilir ve yeni kayıt ekleyebilirsiniz.</h5>
                        </div>
                    </div>
                </div>
                <!-- /Sayfa Başlıkları -->

                <!-- Potansiyel Satış Tablosu -->
                <div class="card card-table">
                    <div class="card-body">
                        <div class="mb-3">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#potansiyelSatisEkleModal">Yeni Potansiyel Satış Ekle</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cari</th>
                                        <th>Durum</th>
                                        <th>Fiyat 1</th>
                                        <th>Fiyat 2</th>
                                        <th>Fiyat 3</th>
                                        <th>Açıklama</th>
                                        <th>İşlem Tarihi</th>
                                        <th>İşlemi Yapan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($potansiyel_satislar) && count($potansiyel_satislar) > 0): ?>
                                        <?php foreach($potansiyel_satislar as $s): ?>
                                            <tr>
                                                <td><?= $s->id ?></td>
                                                <td><?= $s->potansiyel_cari_ad ?></td>
                                                <td><?= $s->durum_adi ?></td>
                                                <td><?= $s->fiyat1 ?></td>
                                                <td><?= $s->fiyat2 ?></td>
                                                <td><?= $s->fiyat3 ?></td>
                                                <td><?= $s->aciklama ?></td>
                                                <td><?= $s->islem_tarihi ?></td>
                                                <td><?= $s->islemi_yapan_ad ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="9" class="text-center">Kayıt bulunamadı.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /Potansiyel Satış Tablosu -->

                <!-- Potansiyel Satış Ekle Modal -->
                <div class="modal fade" id="potansiyelSatisEkleModal" tabindex="-1" role="dialog" aria-labelledby="potansiyelSatisEkleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form method="post" action="<?= base_url('prim/potansiyel_satis_ekle') ?>">
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
                    url: "<?= base_url('prim/potansiyel_cari_autocomplete') ?>",
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
    });
    </script>
</body>
</html>