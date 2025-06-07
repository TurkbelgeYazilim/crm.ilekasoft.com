<!DOCTYPE html>
<html lang="tr">
<head>
    <title>Teklif Hazırla | İlekaSoft CRM</title>
    <link rel="icon" type="image/png" href="/assets/favicon.png">	<?php $this->load->view("include/head-tags"); ?>
	<title>Teklif Hazırla | İlekaSoft CRM</title>
	<link rel="icon" type="image/x-icon" href="<?= base_url('assets/favicon.ico'); ?>" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css" integrity="sha512-UVksC7mwMZ0W9Ow+r7grrHVfIzB9a7a1Vz3r9OPjCGWOYSdTt6EsWWLnJYhxO8ld7aLdyNQXcZ3hHKe2ksE5A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
		  integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
		  crossorigin="anonymous" referrerpolicy="no-referrer"/>
	<link href="<?= base_url('assets/select2.min.css') ?>" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.13.6/css/dataTables.bootstrap4.min.css"/>

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
		.btn-mor {
    background-color: #7c3aed;
    color: #fff;
    border-color: #7c3aed;
}
.btn-mor:hover, .btn-mor:focus {
    background-color: #5b21b6;
    border-color: #5b21b6;
    color: #fff;
}
.btn-mor.btn-lg {
    font-size: 1.25rem;
    padding: 0.75rem 2rem;
    border-radius: 0.5rem;
}
.btn-outline-success.potansiyel-cari-duzenle, .btn-outline-success.potansiyel-cari-duzenle:focus, .btn-outline-success.potansiyel-cari-duzenle:hover {
    color: #fff;
    background-color: #7c3aed;
    border-color: #7c3aed;
}
.btn-outline-success.potansiyel-cari-duzenle:hover, 
.btn-outline-success.potansiyel-cari-duzenle:focus {
    color: #fff;
    background-color: #7c3aed;
    border-color: #7c3aed;
}
@media (max-width: 991.98px) {
    .custom-table th.hide-mobile, .custom-table td.hide-mobile {
        display: none !important;
    }
    
    /* Mobilde düzenle butonunu gizle */
    .potansiyel-cari-duzenle {
        display: none !important;
    }
    
    /* Mobilde İşlemler sütununu en sola getir */
    .custom-table thead tr th:last-child {
        order: -1;
    }
    .custom-table tbody tr td:last-child {
        order: -1;
    }
    .custom-table thead tr,
    .custom-table tbody tr {
        display: flex;
        flex-wrap: nowrap;
    }
    .custom-table thead tr th,
    .custom-table tbody tr td {
        flex: 1;
        min-width: 80px;
    }
}
	</style>
</head>
<body>
<?php
$firmaID = getirFirma();
$firma_ID = $firmaID->ayarlar_id;
$modulSorgula = modulSorgula($firma_ID, 1);

$sezonlar = $this->db->get('sezonlar')->result();
$cariGruplar = $this->db->select('potansiyel_cari_grup')->distinct()->from('potansiyel_cari')->where('potansiyel_cari_grup IS NOT NULL')->get()->result();
$sektorler = $this->db->get('sektorler')->result();
$iller = $this->db->get('iller')->result();
$ilceler = $this->db->get('ilceler')->result();
$potansiyelDurumlar = $this->db->get('potansiyel_durumlar')->result();

// --- İL LİSTESİ YETKİ FİLTRESİ ---
$control2 = session("r", "login_info");
$u_id = $control2->kullanici_id;
$yetkiliIlIds = array();
$kullaniciIlYetkileri = $this->db->query("SELECT il_id FROM il_yetkisi WHERE kullanici = '$u_id' AND durum = 1")->result();
if (count($kullaniciIlYetkileri) > 0) {
    foreach ($kullaniciIlYetkileri as $yetki) {
        $yetkiliIlIds[] = $yetki->il_id;
    }
    $iller = $this->db->where_in('id', $yetkiliIlIds)->get('iller')->result();
}
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
						<h3 class="page-title">Teklif</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Anasayfa</a></li>
							<li class="breadcrumb-item">Teklif</li>
							<li class="breadcrumb-item active">Teklif Hazırla</li>
						</ul>
					</div>
					<div class="d-flex justify-content-end text-align-center col-sm-2">
						<a class="btn btn-outline-light" href="javascript:history.back()"><i class="fa fa-history"></i> <br>Önceki Sayfa</a>
					</div>
				</div>			</div>			<!-- /Page Header -->

			<!-- Ürün/Hizmet Tablosu -->
			<div class="row">
				<div class="col-xl-12 col-md-12">
					<div class="card card-table">
						<div class="card-header">
							<div class="row">
								<div class="col">
									<form class="form-inline" id="potansiyelCariFiltreForm">
										<div class="form-row align-items-end">
    <div class="form-group mr-2 mb-2">
        <label for="il" class="mr-2">İl</label>
        <select class="form-control" id="il" name="il">
            <option value="">Tümü</option>
            <?php foreach($iller as $il): ?>
                <option value="<?= $il->id ?>"><?= $il->il ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group mr-2 mb-2">
        <label for="ilce" class="mr-2">İlçe</label>
        <select class="form-control" id="ilce" name="ilce" disabled>
            <option value="">Önce il seçiniz</option>
        </select>
    </div>
    <div class="form-group mr-2 mb-2">
        <label for="mahalle" class="mr-2">Mahalle</label>
        <select class="form-control" id="mahalle" name="mahalle" disabled>
            <option value="">Önce ilçe seçiniz</option>
        </select>
    </div>
    <div class="form-group mr-2 mb-2">
        <label for="potansiyel_cari_firmaTelefon" class="mr-2">Telefon/Cari Ad</label>
        <select class="form-control" id="potansiyel_cari_firmaTelefon" name="potansiyel_cari_firmaTelefon" style="width:200px;" data-live-search="true">
            <option value="">Tümü</option>
        </select>
    </div>
    <div class="form-group mr-2 mb-2">
        <label for="sezon" class="mr-2">Sezon</label>
        <select class="form-control" id="sezon" name="sezon">
            <option value="">Tümü</option>
            <?php foreach($sezonlar as $s): ?>
                <option value="<?= $s->sezon_id ?>"><?= $s->sezon_adi ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <!-- <div class="form-group mr-2 mb-2"> ... Cari Grup ... </div> -->
    <div class="form-group mr-2 mb-2">
        <label for="sektor" class="mr-2">Sektör</label>
        <select class="form-control" id="sektor" name="sektor">
            <option value="">Tümü</option>
            <?php foreach($sektorler as $sk): ?>
                <option value="<?= $sk->sektor_id ?>"><?= $sk->sektor_adi ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="ml-auto d-flex align-items-end">
        <button type="submit" class="btn btn-primary mb-2 mr-2">Filtrele</button>
    </div>
</div>
									</form>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0">									<thead>
									<tr>
										<th class="hide-mobile no-sort" style="width:32px;"><input type="checkbox" id="tumunuSec"></th>
										<th class="hide-mobile">Sezon</th>
										<th class="hide-mobile">Potansiyel Üye No</th>
										<th>Telefon</th>
										<th>Cari Adı</th>
										<th>Aktivasyon Tarihi</th>
										<th class="hide-mobile">Cari Grup</th>
										<th class="hide-mobile">Sektör</th>
										<th>İl</th>
										<th>İlçe</th>
										<th>Mahalle</th>
										<th>Adres</th>
										<th class="text-right no-sort">İşlem</th>
									</tr>
									</thead>
									<tbody id="potansiyelCariTableBody">
									<!-- Potansiyel cari kayıtları buraya eklenecek -->
									</tbody>
								</table>
								<hr>
								<span style="margin-left:15px;">Toplam kayıt sayısı: <b>0</b></span>
							</div>
						</div>
					</div>
				</div>
			</div>		</div>
	</div>
</div>

<!-- Teklif Seçim Modal -->
<div class="modal fade" id="teklifSecimModal" tabindex="-1" role="dialog" aria-labelledby="teklifSecimModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="teklifSecimModalLabel">Teklif İşlemleri</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <h6 class="mb-3" id="seciliMusteriAdi">Müşteri: </h6>
          <div class="row">
            <div class="col-6">
              <button type="button" class="btn btn-primary btn-lg btn-block teklif-olustur-btn">
                <i class="fa fa-plus"></i><br>
                Teklif Oluştur
              </button>
            </div>
            <div class="col-6">
              <button type="button" class="btn btn-info btn-lg btn-block teklifleri-gor-btn">
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

<!-- Potansiyel Satış Ekle Modal -->
<div class="modal fade" id="potansiyelSatisEkleModal" tabindex="-1" role="dialog" aria-labelledby="potansiyelSatisEkleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="<?= base_url('teklif/potansiyel_satis_ekle') ?>" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="potansiyelSatisEkleModalLabel">Yeni Potansiyel Satış Ekle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Müşteri</label>
            <input type="text" id="cari_autocomplete" class="form-control" placeholder="Seçili müşteri burada görünecek..." readonly>
            <input type="hidden" name="potansiyel_cari_id" id="selected_cari_id" required>
          </div>          <div class="form-group">
            <label>Durum</label>
            <select name="durum_id" id="durum_id" class="form-control" required>
              <option value="">Durum Seçiniz</option>
              <?php foreach($potansiyelDurumlar as $durum): ?>
                <option value="<?= $durum->id ?>"><?= $durum->Durum_Adi ?></option>
              <?php endforeach; ?>
            </select>
          </div>          <div class="form-group fiyat-alani" id="fiyat1-group">
            <label>Bizim teklifimiz</label>
            <div class="input-group">
              <input type="text" name="fiyat1" class="form-control fiyat-input" placeholder="0,00">
              <div class="input-group-append">
                <span class="input-group-text">₺</span>
              </div>
            </div>
          </div>
          <div class="form-group fiyat-alani" id="fiyat2-group">
            <label>Müşteri beklentisi</label>
            <div class="input-group">
              <input type="text" name="fiyat2" class="form-control fiyat-input" placeholder="0,00">
              <div class="input-group-append">
                <span class="input-group-text">₺</span>
              </div>
            </div>
          </div>
          <div class="form-group fiyat-alani" id="fiyat3-group">
            <label>Olabilir teklif</label>
            <div class="input-group">
              <input type="text" name="fiyat3" class="form-control fiyat-input" placeholder="0,00">
              <div class="input-group-append">
                <span class="input-group-text">₺</span>
              </div>
            </div>
          </div>          <div class="form-group">
            <label>Açıklama</label>
            <textarea name="aciklama" class="form-control"></textarea>
          </div>
          
          <!-- Multi-file Upload Section -->
          <div class="form-group">
            <label>Dosyalar <small class="text-muted">(Çoklu dosya seçimi yapabilirsiniz)</small></label>
            <input type="file" name="dosyalar[]" id="dosyalar" class="form-control-file" multiple accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">
            <small class="form-text text-muted">
              Desteklenen formatlar: Resim dosyaları (JPG, PNG, GIF), PDF, Word, Excel. Maksimum dosya boyutu: 5MB
            </small>
            <div id="dosya-preview" class="mt-2"></div>
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

<!-- Teklifleri Gör Modal -->
<div class="modal fade" id="tekliflerGorModal" tabindex="-1" role="dialog" aria-labelledby="tekliflerGorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tekliflerGorModalLabel">Müşteri Teklifleri</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="tekliflerListesi">
          <!-- Teklifler buraya yüklenecek -->
          <div class="text-center">
            <i class="fa fa-spinner fa-spin"></i> Yükleniyor...
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view("include/footer-js"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" 
		integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" 
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= base_url('assets/select2.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#il').on('change', function() {
        var il_id = $(this).val();
        if(il_id) {
            $('#ilce').prop('disabled', false);
            $('#ilce').html('<option>Yükleniyor...</option>');
            $.ajax({
                url: '<?= base_url("home/get_ilceler") ?>',
                type: 'POST',
                data: {il_id: il_id},
                dataType: 'json',
                success: function(result) {
                    if(result && result.status !== 'error') {
                        var options = '<option value="">Tümü</option>';
                        $.each(result.data, function(i, ilce) {
                            options += '<option value="'+ilce.id+'">'+ilce.ilce+'</option>';
                        });
                        $('#ilce').html(options);
                    } else {
                        $('#ilce').html('<option value="">İlçe bulunamadı</option>');
                    }
                },
                error: function() {
                    $('#ilce').html('<option value="">Hata oluştu</option>');
                }
            });
        } else {
            $('#ilce').prop('disabled', true).html('<option value="">Önce il seçiniz</option>');
        }
    });

    $('#ilce').on('change', function() {
        var il_id = $('#il').val();
        var ilce_id = $(this).val();
        if(ilce_id) {
            $('#mahalle').prop('disabled', false);
            $('#mahalle').html('<option>Yükleniyor...</option>');
            $.ajax({
                url: '<?= base_url("teklif/get_potansiyel_mahalleler") ?>',
                type: 'POST',
                data: {il_id: il_id, ilce_id: ilce_id},
                dataType: 'json',
                success: function(result) {
                    if(result && result.status === 'success') {
                        var options = '<option value="">Tümü</option>';
                        $.each(result.data, function(i, mahalle) {
                            options += '<option value="'+mahalle+'">'+mahalle+'</option>';
                        });
                        $('#mahalle').html(options);
                    } else {
                        $('#mahalle').html('<option value="">Mahalle bulunamadı</option>');
                    }
                },
                error: function() {
                    $('#mahalle').html('<option value="">Hata oluştu</option>');
                }
            });
        } else {
            $('#mahalle').prop('disabled', true).html('<option value="">Önce ilçe seçiniz</option>');
        }
    });

    // Telefon search dropdown (select2 veya benzeri ile)
    $('#potansiyel_cari_firmaTelefon').select2({
        placeholder: 'Telefon ve Cari ara...',
        allowClear: true,
        minimumInputLength: 2,
        ajax: {
            url: '<?= base_url("teklif/telefon_search") ?>',
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {q: params.term};
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {id: item, text: item};
                    })
                };
            },
            cache: true
        }
    });

    // DataTable ile sıralama aktif et
    var table = $('.custom-table').DataTable({
        paging: false,
        info: false,
        searching: false,
        ordering: true,
        order: [],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json'
        },
        columnDefs: [
            { targets: 'hide-mobile', visible: window.innerWidth > 991 },
            { targets: 'no-sort', orderable: false }
        ]
    });
    // Mobilde kolon gizleme için responsive ayar
    $(window).on('resize', function() {
        var isMobile = window.innerWidth <= 991;
        table.columns('.hide-mobile').visible(!isMobile);
    });    // Filtrele butonuna basınca tabloyu doldur
    $('#potansiyelCariFiltreForm').on('submit', function(e) {
        e.preventDefault();
        $('#potansiyelCariTableBody').html('<tr><td colspan="14" class="text-center">Yükleniyor...</td></tr>');
        
        // Form verilerini al ve telefon alanını düzenle
        var formData = $(this).serializeArray();
        var processedData = {};
        
        $.each(formData, function(i, field) {
            if (field.name === 'potansiyel_cari_firmaTelefon' && field.value) {
                // "Müşteri Adı (Telefon)" formatından sadece telefon numarasını çıkar
                var phoneMatch = field.value.match(/\(([^)]+)\)$/);
                if (phoneMatch) {
                    processedData[field.name] = phoneMatch[1]; // Parantez içindeki telefon numarası
                } else {
                    processedData[field.name] = field.value; // Eğer format farklıysa olduğu gibi kullan
                }
            } else {
                processedData[field.name] = field.value;
            }
        });
        
        $.ajax({
            url: '<?= base_url("teklif/potansiyel-cari-filtrele") ?>', // Controller'da bu endpoint olmalı
            type: 'POST',
            data: processedData,
            dataType: 'json',
            success: function(result) {
                if(result && result.status === 'success' && result.data.length > 0) {
                    // DataTables ile tabloyu güncelle
                    var table = $('.custom-table').DataTable();
                    table.clear();
                    var rows = [];                    $.each(result.data, function(i, item) {
                        rows.push([
                            '<input type="checkbox" class="potansiyel-cari-sec" value="' + (item.id || '') + '">',
                            (item.sezon_adi || ''),
                            (item.potansiyel_uye_no || ''),
                            (item.potansiyel_cari_firmaTelefon || ''),
                            (item.potansiyel_cari_ad || ''),
                            (item.potansiyel_aktivasyon_tarihi || ''),
                            (item.potansiyel_cari_grup || ''),
                            (item.sektor_adi || ''),
                            (item.il_adi || ''),
                            (item.ilce_adi || ''),
                            (item.potansiyel_mahalle || ''),
                            (item.potansiyel_cari_adres || ''),                            '<button class="btn btn-sm btn-outline-success potansiyel-cari-duzenle" data-id="'+(item.id||'')+'" data-ad="'+(item.potansiyel_cari_ad||'')+'" data-tel="'+(item.potansiyel_cari_firmaTelefon||'')+'"><i class="fa fa-edit"></i></button> ' +
                            '<button class="btn btn-sm btn-outline-primary potansiyel-cari-teklif" data-id="'+(item.id||'')+'" data-ad="'+(item.potansiyel_cari_ad||'')+'" data-tel="'+(item.potansiyel_cari_firmaTelefon||'')+'"><i class="fa fa-edit"></i></button>'
                        ]);
                    });
                    table.rows.add(rows).draw();
                    // Toplam kayıt sayısını güncelle
                    $("span:contains('Toplam kayıt sayısı') b").text(result.data.length);
                } else {
                    var table = $('.custom-table').DataTable();
                    table.clear().draw();
                    $('#potansiyelCariTableBody').html('<tr><td colspan="14" class="text-center">Kayıt bulunamadı.</td></tr>');
                    $("span:contains('Toplam kayıt sayısı') b").text('0');
                }
            },
            error: function() {
                var table = $('.custom-table').DataTable();
                table.clear().draw();
                $('#potansiyelCariTableBody').html('<tr><td colspan="14" class="text-center">Hata oluştu.</td></tr>');
            }
        });
    });
    // Sayfa ilk açıldığında tabloyu boş bırak
    $('#potansiyelCariTableBody').html('');

    // Tümünü seç kutusu
    $('#tumunuSec').on('change', function() {
        var checked = $(this).is(':checked');
        $('.potansiyel-cari-sec').prop('checked', checked);
    });    // Satır düzenleme işlemi (prompt ile örnek)
    $(document).on('click', '.potansiyel-cari-duzenle', function() {
        var id = $(this).data('id');
        var eskiAd = $(this).data('ad');
        var eskiTel = $(this).data('tel');
        var yeniAd = prompt('Yeni Cari Adı:', eskiAd);
        if(yeniAd !== null && yeniAd !== eskiAd) {
            $.post('teklif/potansiyel-cari-guncelle', {id: id, potansiyel_cari_ad: yeniAd}, function(resp) {
                toastr.success('Cari adı güncellendi');
                $('#potansiyelCariFiltreForm').submit();
            });
        }
        // Benzer şekilde diğer alanlar için de prompt ekleyebilirsiniz
    });    // Teklif hazırlama işlemi - T butonuna tıklayınca seçim modalı aç
    $(document).on('click', '.potansiyel-cari-teklif', function() {
        var id = $(this).data('id');
        var ad = $(this).data('ad');
        var tel = $(this).data('tel');
        
        // Seçili müşteri bilgilerini sakla
        $('#teklifSecimModal').data('cari-id', id);
        $('#teklifSecimModal').data('cari-ad', ad);
        $('#teklifSecimModal').data('cari-tel', tel);
        
        // Modal başlığını güncelle
        $('#seciliMusteriAdi').text('Müşteri: ' + ad);
        
        // Seçim modalını aç
        $('#teklifSecimModal').modal('show');
    });

    // Teklif Oluştur butonuna tıklayınca
    $(document).on('click', '.teklif-olustur-btn', function() {
        var modal = $('#teklifSecimModal');
        var id = modal.data('cari-id');
        var ad = modal.data('cari-ad');
        var tel = modal.data('cari-tel');
        
        // Seçim modalını kapat
        $('#teklifSecimModal').modal('hide');
        
        // Biraz bekle ve teklif oluştur modalını aç
        setTimeout(function() {
            $('#selected_cari_id').val(id);
            $('#cari_autocomplete').val(ad + ' (' + tel + ')');
            $('#potansiyelSatisEkleModal').modal('show');
        }, 300);
    });    // Teklifleri Gör butonuna tıklayınca
    $(document).on('click', '.teklifleri-gor-btn', function() {
        var modal = $('#teklifSecimModal');
        var id = modal.data('cari-id');
        var ad = modal.data('cari-ad');
        var telefon = modal.data('cari-tel');
        
        // Seçim modalını kapat
        $('#teklifSecimModal').modal('hide');
        
        // Teklif listele sayfasına yönlendir
        // Müşteri adı veya telefon ile filtreleme için parametreler ekle
        var baseUrl = '<?= base_url("teklif/teklif-listele") ?>';
        var params = [];
        
        if (ad && ad.trim() !== '') {
            params.push('cari_ad=' + encodeURIComponent(ad.trim()));
        }
        if (telefon && telefon.trim() !== '') {
            params.push('telefon=' + encodeURIComponent(telefon.trim()));
        }
        
        var redirectUrl = baseUrl;
        if (params.length > 0) {
            redirectUrl += '?' + params.join('&');
        }
        
        // Yönlendirme
        window.location.href = redirectUrl;
    });

    // Modal kapandığında formu temizle
    $('#potansiyelSatisEkleModal').on('hidden.bs.modal', function() {
        $("#cari_autocomplete").val('');
        $("#selected_cari_id").val('');
        $(this).find('form')[0].reset();
    });    // Teklifler modal kapandığında içeriği temizle
    $('#tekliflerGorModal').on('hidden.bs.modal', function() {
        $('#tekliflerListesi').html('');
    });    // Durum seçimi değiştiğinde fiyat alanlarını gizle/göster
    $('#durum_id').on('change', function() {
        var selectedDurum = $(this).val();
        var fiyatAlanlari = $('.fiyat-alani');
        var fiyat1 = $('#fiyat1-group');
        var fiyat2 = $('#fiyat2-group');
        var fiyat3 = $('#fiyat3-group');
          // ID'si 1, 2 veya 3 olan durumlar seçildiğinde tüm fiyat alanlarını gizle
        if (selectedDurum == '1' || selectedDurum == '2' || selectedDurum == '3') {
            fiyatAlanlari.hide();
            // Fiyat alanlarındaki değerleri temizle
            fiyatAlanlari.find('input').val('');
        } 
        // ID'si 5 olan durum seçildiğinde sadece Fiyat 1 göster, Fiyat 2 ve 3'ü gizle
        else if (selectedDurum == '5') {
            fiyat1.show();
            fiyat2.hide();
            fiyat3.hide();
            // Gizlenen fiyat alanlarındaki değerleri temizle
            fiyat2.find('input').val('');
            fiyat3.find('input').val('');
        }
        // Diğer durumlar için tüm fiyat alanlarını göster
        else {
            fiyatAlanlari.show();
        }
    });    // Modal açıldığında fiyat alanlarını göster (başlangıç durumu)
    $('#potansiyelSatisEkleModal').on('shown.bs.modal', function() {
        $('.fiyat-alani').show();
        $('#durum_id').val(''); // Durum seçimini sıfırla
    });    // Fiyat alanları için Türk Lirası formatı (kuruş olmadan)
    function formatTurkishCurrency(value) {
        // Sayıyı string'e çevir ve sadece rakamları al
        let numStr = value.toString().replace(/[^\d]/g, '');
        
        if (numStr === '') return '';
        
        // Sayıyı integer'a çevir
        let num = parseInt(numStr);
        
        // Binlik ayırıcıları ekle
        let liraStr = num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        
        return liraStr;
    }    function parseTurkishCurrency(value) {
        // Nokta ayırıcılarını kaldır, sadece rakamları al
        let numStr = value.replace(/[^\d]/g, '');
        if (numStr === '') return 0;
        return parseInt(numStr);
    }

    // Fiyat input alanlarına format uygula
    $(document).on('input', '.fiyat-input', function() {
        let cursorPos = this.selectionStart;
        let oldValue = $(this).val();
        let newValue = formatTurkishCurrency(oldValue);
        
        $(this).val(newValue);
        
        // Cursor pozisyonunu ayarla
        let newCursorPos = cursorPos + (newValue.length - oldValue.length);
        this.setSelectionRange(newCursorPos, newCursorPos);
    });

    // Form submit edilirken fiyatları doğru formata çevir
    $('#potansiyelSatisEkleModal form').on('submit', function() {
        $('.fiyat-input').each(function() {
            let turkishValue = $(this).val();
            let numericValue = parseTurkishCurrency(turkishValue);
            $(this).val(numericValue);
        });
    });

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
        }    });

    // File upload preview functionality
    $('#dosyalar').on('change', function() {
        var files = this.files;
        var previewContainer = $('#dosya-preview');
        previewContainer.empty();
        
        if (files.length > 0) {
            var previewHtml = '<div class="mt-3"><h6>Seçilen Dosyalar:</h6><div class="row">';
            
            Array.from(files).forEach(function(file, index) {
                var fileName = file.name;
                var fileSize = (file.size / 1024 / 1024).toFixed(2); // MB
                var fileType = file.type;
                
                // Check file size (max 5MB)
                var sizeClass = fileSize > 5 ? 'text-danger' : 'text-success';
                var sizeText = fileSize > 5 ? fileSize + ' MB (Çok büyük!)' : fileSize + ' MB';
                
                previewHtml += '<div class="col-md-6 col-lg-4 mb-2">';
                previewHtml += '<div class="card">';
                previewHtml += '<div class="card-body p-2">';
                previewHtml += '<small class="text-muted d-block">' + fileName + '</small>';
                previewHtml += '<small class="' + sizeClass + '">' + sizeText + '</small>';
                
                // Show preview for images
                if (fileType.startsWith('image/')) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview-img-' + index).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                    previewHtml += '<div class="mt-1"><img id="preview-img-' + index + '" src="" class="img-thumbnail" style="max-height: 60px;"></div>';
                } else {
                    // Show file type icon for non-images
                    var iconClass = 'fa-file';
                    if (fileType.includes('pdf')) iconClass = 'fa-file-pdf-o';
                    else if (fileType.includes('word')) iconClass = 'fa-file-word-o';
                    else if (fileType.includes('excel') || fileType.includes('spreadsheet')) iconClass = 'fa-file-excel-o';
                    
                    previewHtml += '<div class="mt-1 text-center"><i class="fa ' + iconClass + ' fa-2x text-muted"></i></div>';
                }
                
                previewHtml += '</div></div></div>';
            });
            
            previewHtml += '</div></div>';
            previewContainer.html(previewHtml);
        }
    });
});
</script>

<script>
	// Teklif hazırlama sayfası için JavaScript kodları buraya eklenebilir
</script>
</body>
</html>
