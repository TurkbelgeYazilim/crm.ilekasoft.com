<!DOCTYPE html>
<html lang="tr">
<head>
    <title>Teklif Ayarları | İlekaSoft CRM</title>
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
                            <h3 class="page-title">Teklif Ayarları</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
                                <li class="breadcrumb-item">Teklif</li>
                                <li class="breadcrumb-item active">Teklif Ayarları</li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-end text-align-center col-sm-2">
                            <a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header"><b>Sezonlar</b></div>
                            <div class="card-body">
                                <form id="sezonEkleForm" class="form-inline mb-2">
                                    <input type="text" class="form-control mr-2 mb-2" name="sezon_adi" placeholder="Yeni Sezon Adı" required>
                                    <button type="submit" class="btn btn-success mb-2"><i class="fa fa-plus"></i> Ekle</button>
                                </form>
                                <ul class="list-group" id="sezonListesi">
                                    <!-- Sezonlar buraya gelecek -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header"><b>Cari Gruplar</b></div>
                            <div class="card-body">
                                <form id="cariGrupEkleForm" class="form-inline mb-2">
                                    <input type="text" class="form-control mr-2 mb-2" name="cari_grup" placeholder="Yeni Cari Grup" required>
                                    <button type="submit" class="btn btn-success mb-2"><i class="fa fa-plus"></i> Ekle</button>
                                </form>
                                <ul class="list-group" id="cariGrupListesi">
                                    <!-- Cari gruplar buraya gelecek -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header"><b>Sektörler</b></div>
                            <div class="card-body">
                                <form id="sektorEkleForm" class="form-inline mb-2">
                                    <input type="text" class="form-control mr-2 mb-2" name="sektor_adi" placeholder="Yeni Sektör Adı" required>
                                    <button type="submit" class="btn btn-success mb-2"><i class="fa fa-plus"></i> Ekle</button>
                                </form>
                                <ul class="list-group" id="sektorListesi">
                                    <!-- Sektörler buraya gelecek -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                // AJAX ile sezon, cari grup, sektör işlemleri
                $(function(){
                    // Sezonları listele
                    function sezonlariGetir() {
                        $.getJSON('teklif/sezonlar-listele', function(resp){
                            var html = '';
                            $.each(resp.data, function(i, sezon){
                                html += '<li class="list-group-item d-flex justify-content-between align-items-center">'
                                    + '<span class="sezon-adi">'+sezon.sezon_adi+'</span>'
                                    + '<span>'
                                    + '<button class="btn btn-sm btn-outline-success mr-1 sezon-duzenle" data-id="'+sezon.sezon_id+'" data-ad="'+sezon.sezon_adi+'"><i class="fa fa-edit"></i></button>'
                                    + '<button class="btn btn-sm btn-outline-danger sezon-sil" data-id="'+sezon.sezon_id+'"><i class="fa fa-trash"></i></button>'
                                    + '</span></li>';
                            });
                            $('#sezonListesi').html(html);
                        });
                    }
                    // Cari grupları listele
                    function cariGruplariGetir() {
                        $.getJSON('teklif/cari-gruplar-listele', function(resp){
                            var html = '';
                            $.each(resp.data, function(i, grup){
                                html += '<li class="list-group-item d-flex justify-content-between align-items-center">'
                                    + '<span class="cari-grup-adi">'+grup.cariGrup_ad+'</span>'
                                    + '<span>'
                                    + '<button class="btn btn-sm btn-outline-success mr-1 cari-grup-duzenle" data-id="'+grup.cariGrup_id+'" data-ad="'+grup.cariGrup_ad+'"><i class="fa fa-edit"></i></button>'
                                    + '<button class="btn btn-sm btn-outline-danger cari-grup-sil" data-id="'+grup.cariGrup_id+'"><i class="fa fa-trash"></i></button>'
                                    + '</span></li>';
                            });
                            $('#cariGrupListesi').html(html);
                        });
                    }
                    // Sektörleri listele
                    function sektorleriGetir() {
                        $.getJSON('teklif/sektorler-listele', function(resp){
                            var html = '';
                            $.each(resp.data, function(i, sektor){
                                html += '<li class="list-group-item d-flex justify-content-between align-items-center">'
                                    + '<span class="sektor-adi">'+sektor.sektor_adi+'</span>'
                                    + '<span>'
                                    + '<button class="btn btn-sm btn-outline-success mr-1 sektor-duzenle" data-id="'+sektor.sektor_id+'" data-ad="'+sektor.sektor_adi+'"><i class="fa fa-edit"></i></button>'
                                    + '<button class="btn btn-sm btn-outline-danger sektor-sil" data-id="'+sektor.sektor_id+'"><i class="fa fa-trash"></i></button>'
                                    + '</span></li>';
                            });
                            $('#sektorListesi').html(html);
                        });
                    }
                    // Ekleme işlemleri
                    $('#sezonEkleForm').on('submit', function(e){
                        e.preventDefault();
                        var ad = $(this).find('[name=sezon_adi]').val();
                        $.post('teklif/sezon-ekle', {sezon_adi: ad}, function(){
                            sezonlariGetir();
                            $('#sezonEkleForm')[0].reset();
                        });
                    });
                    $('#cariGrupEkleForm').on('submit', function(e){
                        e.preventDefault();
                        var ad = $(this).find('[name=cari_grup]').val();
                        $.post('teklif/cari-grup-ekle', {cari_grup: ad}, function(){
                            cariGruplariGetir();
                            $('#cariGrupEkleForm')[0].reset();
                        });
                    });
                    $('#sektorEkleForm').on('submit', function(e){
                        e.preventDefault();
                        var ad = $(this).find('[name=sektor_adi]').val();
                        $.post('teklif/sektor-ekle', {sektor_adi: ad}, function(){
                            sektorleriGetir();
                            $('#sektorEkleForm')[0].reset();
                        });
                    });
                    // Silme işlemleri
                    $(document).on('click', '.sezon-sil', function(){
                        if(confirm('Sezon silinsin mi?')){
                            $.post('teklif/sezon-sil', {sezon_id: $(this).data('id')}, function(){ sezonlariGetir(); });
                        }
                    });
                    $(document).on('click', '.cari-grup-sil', function(){
                        if(confirm('Cari grup silinsin mi?')){
                            $.post('teklif/cari-grup-sil', {cari_grup_id: $(this).data('id')}, function(){ cariGruplariGetir(); });
                        }
                    });
                    $(document).on('click', '.sektor-sil', function(){
                        if(confirm('Sektör silinsin mi?')){
                            $.post('teklif/sektor-sil', {sektor_id: $(this).data('id')}, function(){ sektorleriGetir(); });
                        }
                    });
                    // Düzenleme işlemleri (inline prompt ile)
                    $(document).on('click', '.sezon-duzenle', function(){
                        var id = $(this).data('id');
                        var eski = $(this).data('ad');
                        var yeni = prompt('Yeni sezon adı:', eski);
                        if(yeni && yeni !== eski){
                            $.post('teklif/sezon-guncelle', {sezon_id: id, sezon_adi: yeni}, function(){ sezonlariGetir(); });
                        }
                    });
                    $(document).on('click', '.cari-grup-duzenle', function(){
                        var id = $(this).data('id');
                        var eski = $(this).data('ad');
                        var yeni = prompt('Yeni cari grup adı:', eski);
                        if(yeni && yeni !== eski){
                            $.post('teklif/cari-grup-guncelle', {cari_grup_id: id, cari_grup: yeni}, function(){ cariGruplariGetir(); });
                        }
                    });
                    $(document).on('click', '.sektor-duzenle', function(){
                        var id = $(this).data('id');
                        var eski = $(this).data('ad');
                        var yeni = prompt('Yeni sektör adı:', eski);
                        if(yeni && yeni !== eski){
                            $.post('teklif/sektor-guncelle', {sektor_id: id, sektor_adi: yeni}, function(){ sektorleriGetir(); });
                        }
                    });
                    // Sayfa açılışında otomatik listele
                    sezonlariGetir();
                    cariGruplariGetir();
                    sektorleriGetir();
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
