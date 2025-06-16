<!DOCTYPE html>
<html lang="tr">
<head>
    <title>Prim Ayarları | İlekaSoft CRM</title>
    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <?php $this->load->view("include/head-tags"); ?>
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
                            <h3 class="page-title">Prim Ayarları</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
                                <li class="breadcrumb-item">Prim</li>
                                <li class="breadcrumb-item active">Prim Ayarları</li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-end text-align-center col-sm-2">
                            <a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
                        </div>
                    </div>
                </div>                <!-- /Page Header -->
                
                <!-- Prim Ekleme Formu -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h4 class="card-title mb-0"><i class="fa fa-percent"></i> Kullanıcı Grubu Prim Ayarları</h4>
                                    </div>
                                    <div class="col-sm-4 text-right">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#primEkleModal">
                                            <i class="fa fa-plus"></i> Yeni Prim Ekle
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="primTablosu">
                                        <thead class="thead-dark">                                            <tr>
                                                <th>Kullanıcı Grubu</th>
                                                <th>Stok Grubu</th>
                                                <th>Sözleşme Primi (%)</th>
                                                <th>Tahsilat Primi (%)</th>
                                                <th>Başlangıç Tarihi</th>
                                                <th>Bitiş Tarihi</th>
                                                <th>Durum</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody id="primListesi">
                                            <!-- Primler buraya gelecek -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Prim Ekleme Modal -->
                <div class="modal fade" id="primEkleModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Yeni Prim Ekle</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <form id="primEkleForm">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kullanici_grubu">Kullanıcı Grubu <span class="text-danger">*</span></label>
                                                <select class="form-control" name="kullanici_grubu" id="kullanici_grubu" required>
                                                    <option value="">Kullanıcı Grubu Seçin</option>
                                                    <!-- Kullanıcı grupları buraya gelecek -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sozlesme_primi">Sözleşme Primi (%) <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="sozlesme_primi" id="sozlesme_primi" 
                                                       min="0" max="99.99" step="0.01" placeholder="0.00" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tahsilat_primi">Tahsilat Primi (%) <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="tahsilat_primi" id="tahsilat_primi" 
                                                       min="0" max="99.99" step="0.01" placeholder="0.00" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="baslangic_tarihi">Başlangıç Tarihi <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="baslangic_tarihi" id="baslangic_tarihi" required>
                                            </div>
                                        </div>
                                    </div>                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stok_grubu">Stok Grubu</label>
                                                <select class="form-control" name="stok_grubu" id="stok_grubu">
                                                    <option value="">Stok Grubu Seçin</option>
                                                    <!-- Stok grupları buraya gelecek -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bitis_tarihi">Bitiş Tarihi</label>
                                                <input type="date" class="form-control" name="bitis_tarihi" id="bitis_tarihi">
                                                <small class="form-text text-muted">Boş bırakılırsa süresiz geçerli olur</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="durum">Durum</label>
                                                <select class="form-control" name="durum" id="durum">
                                                    <option value="1">Aktif</option>
                                                    <option value="0">Pasif</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Prim Düzenleme Modal -->
                <div class="modal fade" id="primDuzenleModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Prim Düzenle</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <form id="primDuzenleForm">
                                <input type="hidden" name="prim_id" id="duzenle_prim_id">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duzenle_kullanici_grubu">Kullanıcı Grubu <span class="text-danger">*</span></label>
                                                <select class="form-control" name="kullanici_grubu" id="duzenle_kullanici_grubu" required>
                                                    <option value="">Kullanıcı Grubu Seçin</option>
                                                    <!-- Kullanıcı grupları buraya gelecek -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duzenle_sozlesme_primi">Sözleşme Primi (%) <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="sozlesme_primi" id="duzenle_sozlesme_primi" 
                                                       min="0" max="99.99" step="0.01" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duzenle_tahsilat_primi">Tahsilat Primi (%) <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="tahsilat_primi" id="duzenle_tahsilat_primi" 
                                                       min="0" max="99.99" step="0.01" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duzenle_baslangic_tarihi">Başlangıç Tarihi <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="baslangic_tarihi" id="duzenle_baslangic_tarihi" required>
                                            </div>
                                        </div>
                                    </div>                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duzenle_stok_grubu">Stok Grubu</label>
                                                <select class="form-control" name="stok_grubu" id="duzenle_stok_grubu">
                                                    <option value="">Stok Grubu Seçin</option>
                                                    <!-- Stok grupları buraya gelecek -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duzenle_bitis_tarihi">Bitiş Tarihi</label>
                                                <input type="date" class="form-control" name="bitis_tarihi" id="duzenle_bitis_tarihi">
                                                <small class="form-text text-muted">Boş bırakılırsa süresiz geçerli olur</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="duzenle_durum">Durum</label>
                                                <select class="form-control" name="durum" id="duzenle_durum">
                                                    <option value="1">Aktif</option>
                                                    <option value="0">Pasif</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                    <button type="submit" class="btn btn-primary">Güncelle</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>                $(function(){                    // Kullanıcı gruplarını getir ve select'lere ekle
                    function kullaniciGruplariGetir() {
                        $.getJSON('prim/kullanici_gruplari_listele', function(resp){
                            if(resp.success) {
                                var options = '<option value="">Kullanıcı Grubu Seçin</option>';
                                $.each(resp.data, function(i, grup){
                                    options += '<option value="'+grup.kg_id+'">'+grup.kg_adi+'</option>';
                                });
                                $('#kullanici_grubu, #duzenle_kullanici_grubu').html(options);
                            } else {
                                console.error('Kullanıcı grupları yüklenemedi:', resp.message);
                                toastr.error('Kullanıcı grupları yüklenemedi: ' + resp.message);
                            }
                        }).fail(function(xhr, status, error) {
                            console.error('AJAX Hatası:', error);
                            toastr.error('Kullanıcı grupları yüklenirken hata oluştu');
                        });
                    }                    // Stok gruplarını getir ve select'lere ekle
                    function stokGruplariGetir() {
                        $.getJSON('prim/stok_gruplari_listele', function(resp){
                            if(resp.success) {
                                var options = '<option value="">Stok Grubu Seçin</option>';
                                $.each(resp.data, function(i, grup){
                                    options += '<option value="'+grup.sg_id+'">'+grup.sg_adi+'</option>';
                                });
                                $('#stok_grubu, #duzenle_stok_grubu').html(options);
                            } else {
                                console.error('Stok grupları yüklenemedi:', resp.message);
                                toastr.error('Stok grupları yüklenemedi: ' + resp.message);
                            }
                        }).fail(function(xhr, status, error) {
                            console.error('AJAX Hatası:', error);
                            toastr.error('Stok grupları yüklenirken hata oluştu');
                        });
                    }                    // Primleri listele
                    function primleriGetir() {
                        $.getJSON('prim/primler_listele', function(resp){
                            if(resp.success) {
                                var html = '';                            
                                $.each(resp.data, function(i, prim){
                                    var durumBadge = prim.durum == 1 ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-secondary">Pasif</span>';
                                    var bitisTarihi = prim.bitis_tarihi ? prim.bitis_tarihi : '<span class="text-muted">Süresiz</span>';
                                    var stokGrubu = prim.stok_grubu_adi ? prim.stok_grubu_adi : '<span class="text-muted">Tümü</span>';
                                    
                                    html += '<tr>'
                                        + '<td>' + prim.kullanici_grubu_adi + '</td>'
                                        + '<td>' + stokGrubu + '</td>'
                                        + '<td>' + prim.sozlesme_primi + '%</td>'
                                        + '<td>' + prim.tahsilat_primi + '%</td>'
                                        + '<td>' + prim.baslangic_tarihi + '</td>'
                                        + '<td>' + bitisTarihi + '</td>'
                                        + '<td>' + durumBadge + '</td>'
                                        + '<td>'
                                        + '<button class="btn btn-sm btn-outline-primary mr-1 prim-duzenle" data-id="'+prim.prim_id+'" title="Düzenle"><i class="fa fa-edit"></i></button>'
                                        + '<button class="btn btn-sm btn-outline-danger prim-sil" data-id="'+prim.prim_id+'" title="Sil"><i class="fa fa-trash"></i></button>'
                                        + '</td>'
                                        + '</tr>';
                                });
                                  
                                if(html === '') {
                                    html = '<tr><td colspan="8" class="text-center text-muted">Henüz prim tanımlanmamış.</td></tr>';
                                }
                                
                                $('#primListesi').html(html);
                            } else {
                                console.error('Primler yüklenemedi:', resp.message);
                                toastr.error('Primler yüklenemedi: ' + resp.message);
                            }
                        }).fail(function(xhr, status, error) {
                            console.error('AJAX Hatası:', error);
                            toastr.error('Primler yüklenirken hata oluştu');
                        });
                    }

                    // Prim ekleme
                    $('#primEkleForm').on('submit', function(e){
                        e.preventDefault();
                        var formData = $(this).serialize();
                        
                        $.post('prim/prim_ekle', formData, function(resp){
                            if(resp.success) {
                                $('#primEkleModal').modal('hide');
                                $('#primEkleForm')[0].reset();
                                primleriGetir();
                                toastr.success('Prim başarıyla eklendi.');
                            } else {
                                toastr.error('Prim eklenirken hata oluştu: ' + resp.message);
                            }
                        }, 'json');
                    });

                    // Prim düzenleme modalını aç
                    $(document).on('click', '.prim-duzenle', function(){
                        var primId = $(this).data('id');
                        
                        $.getJSON('prim/prim_detay/' + primId, function(resp){                            if(resp.success) {
                                var prim = resp.data;
                                $('#duzenle_prim_id').val(prim.prim_id);
                                $('#duzenle_kullanici_grubu').val(prim.kullanici_grubu);
                                $('#duzenle_stok_grubu').val(prim.stok_grubu);
                                $('#duzenle_sozlesme_primi').val(prim.sozlesme_primi);
                                $('#duzenle_tahsilat_primi').val(prim.tahsilat_primi);
                                $('#duzenle_baslangic_tarihi').val(prim.baslangic_tarihi);
                                $('#duzenle_bitis_tarihi').val(prim.bitis_tarihi);
                                $('#duzenle_durum').val(prim.durum);
                                $('#primDuzenleModal').modal('show');
                            }
                        });
                    });

                    // Prim güncelleme
                    $('#primDuzenleForm').on('submit', function(e){
                        e.preventDefault();
                        var formData = $(this).serialize();
                        
                        $.post('prim/prim_guncelle', formData, function(resp){
                            if(resp.success) {
                                $('#primDuzenleModal').modal('hide');
                                primleriGetir();
                                toastr.success('Prim başarıyla güncellendi.');
                            } else {
                                toastr.error('Prim güncellenirken hata oluştu: ' + resp.message);
                            }
                        }, 'json');
                    });

                    // Prim silme
                    $(document).on('click', '.prim-sil', function(){
                        var primId = $(this).data('id');
                        
                        if(confirm('Bu prim kaydını silmek istediğinizden emin misiniz?')){
                            $.post('prim/prim_sil', {prim_id: primId}, function(resp){
                                if(resp.success) {
                                    primleriGetir();
                                    toastr.success('Prim başarıyla silindi.');
                                } else {
                                    toastr.error('Prim silinirken hata oluştu: ' + resp.message);
                                }
                            }, 'json');
                        }
                    });

                    // Modal kapandığında formu temizle
                    $('#primEkleModal').on('hidden.bs.modal', function () {
                        $('#primEkleForm')[0].reset();
                    });                    // Sayfa yüklendiğinde
                    console.log('Sayfa yüklendi, AJAX çağrıları başlıyor...');
                    kullaniciGruplariGetir();
                    stokGruplariGetir();
                    primleriGetir();
                });
                </script>
            </div>
        </div>
        <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

    <?php $this->load->view("include/footer-js"); ?>
</body>
</html>