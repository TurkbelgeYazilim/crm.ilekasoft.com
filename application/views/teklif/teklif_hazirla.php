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

/* Dosya görüntüleme butonları için stiller */
.btn-xs {
    padding: 0.25rem 0.5rem !important;
    font-size: 0.75rem !important;
    line-height: 1.2 !important;
    border-radius: 0.25rem !important;
}

.file-buttons-container {
    max-width: 150px;
    max-height: 100px;
    overflow-y: auto;
}

.file-buttons-container .btn {
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: block;
    width: 100%;
}
@media (max-width: 991.98px) {
    .custom-table th.hide-mobile, .custom-table td.hide-mobile {
        display: none !important;
    }
    
    /* Mobilde Teklif butonunda sadece ikon göster, yazıyı gizle */
    .potansiyel-cari-teklif {
        font-size: 0;
        padding: 0.375rem 0.5rem;
    }
    
    .potansiyel-cari-teklif i {
        font-size: 14px;
    }
    
    /* Mobilde Önceki Sayfa butonunu gizle */
    .col-sm-2 {
        display: none !important;
    }
    
    /* Mobile filter form improvements */
    .form-inline .form-row {
        flex-direction: column !important;
        width: 100% !important;
    }
    
    .form-inline .form-group {
        width: 100% !important;
        margin-bottom: 1rem !important;
        margin-right: 0 !important;
    }
    
    .form-inline .form-group label {
        display: block !important;
        margin-bottom: 0.5rem !important;
        font-weight: 600 !important;
        color: #5c2d91 !important;
        font-size: 0.9rem !important;
    }
    
    .form-inline .form-control {
        width: 100% !important;
        padding: 0.65rem 0.75rem !important;
        font-size: 0.95rem !important;
        border-radius: 0.5rem !important;
        border: 2px solid #e1e5e9 !important;
        transition: all 0.3s ease !important;
    }
    
    .form-inline .form-control:focus {
        border-color: #7c3aed !important;
        box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.25) !important;
    }
      /* Mobile filter buttons */
    .form-inline .ml-auto {
        margin-left: 0 !important;
        width: 100% !important;
        margin-top: 1rem !important;
    }
    
    .form-inline .d-flex {
        flex-direction: row !important;
        justify-content: space-between !important;
        gap: 0.75rem !important;
        align-items: stretch !important;
    }
    
    .form-inline .btn {
        flex: 1 !important;
        padding: 0.75rem 1rem !important;
        font-size: 1rem !important;
        font-weight: 600 !important;
        border-radius: 0.5rem !important;
        transition: all 0.3s ease !important;
        min-height: 50px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
    }
    
    .form-inline .btn-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3) !important;
    }
    
    .form-inline .btn-primary:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4) !important;
    }
    
    .form-inline .btn-mor {
        background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%) !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3) !important;
    }
    
    .form-inline .btn-mor:hover {
        background: linear-gradient(135deg, #5b21b6 0%, #4c1d95 100%) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4) !important;
    }
    
    /* Card header padding adjustment for mobile */
    .card-header .row {
        margin: 0 !important;
    }
    
    .card-header .col {
        padding: 0 !important;
    }
    
    /* Select2 mobile improvements */
    .select2-container {
        width: 100% !important;
    }
    
    .select2-container .select2-selection--single {
        height: 45px !important;
        padding: 0.65rem 0.75rem !important;
        border: 2px solid #e1e5e9 !important;
        border-radius: 0.5rem !important;
        font-size: 0.95rem !important;
    }
    
    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 1.5 !important;
        padding: 0 !important;
    }
    
    .select2-container .select2-selection--single .select2-selection__arrow {
        height: 43px !important;
    }
    
    /* Mobile Save button prominence - Make it larger and more prominent */
    .save-btn-mobile {
        font-size: 1.1rem !important;
        padding: 0.65rem 2rem !important;
        font-weight: bold !important;
        min-width: 140px !important;
        position: relative !important;
        background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%) !important;
        border: 2px solid #7c3aed !important;
        box-shadow: 0 4px 15px rgba(124, 58, 237, 0.4) !important;
        transition: all 0.3s ease !important;
    }
    
    .save-btn-mobile:hover, .save-btn-mobile:focus {
        background: linear-gradient(135deg, #5b21b6 0%, #4c1d95 100%) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(124, 58, 237, 0.6) !important;
    }
    
    .save-btn-mobile i {
        margin-right: 8px !important;
        font-size: 1.1em !important;
    }
}
	</style>
</head>
<body>
<?php
$firmaID = getirFirma();
if (!$firmaID) {
    // Handle case where firm information cannot be retrieved
    // Fallback to prevent fatal errors
    $firma_ID = 0;
} else {
    $firma_ID = $firmaID->ayarlar_id;
}
$modulSorgula = modulSorgula($firma_ID, 1);

$cariGruplar = $this->db->select('potansiyel_cari_grup')->distinct()->from('potansiyel_cari')->where('potansiyel_cari_grup IS NOT NULL')->get()->result();
$potansiyelDurumlar = $this->db->get('potansiyel_durumlar')->result();

// --- kullanici_sorumluluk_bolgesi tablosuna göre yetki kontrolü ---
$control2 = session("r", "login_info");
$u_id = $control2->kullanici_id;
$bugun = date('Y-m-d');

// Kullanıcının sorumlu olduğu ülkeleri çek
$sorumluUlkelerQ = "SELECT DISTINCT ulke_kodu 
                   FROM kullanici_sorumluluk_bolgesi 
                   WHERE kullanici = '$u_id' 
                   AND durum = 1 
                   AND ulke_kodu IS NOT NULL
                   AND (baslangic_tarihi IS NULL OR baslangic_tarihi <= '$bugun') 
                   AND (bitis_tarihi IS NULL OR bitis_tarihi >= '$bugun')";
$sorumluUlkeler = $this->db->query($sorumluUlkelerQ)->result();

if (count($sorumluUlkeler) > 0) {
    $yetkiliUlkeKodlari = array();
    foreach ($sorumluUlkeler as $ulke) {
        $yetkiliUlkeKodlari[] = $ulke->ulke_kodu;
    }
    $ulkeler = $this->db->where_in('ulke_kodu', $yetkiliUlkeKodlari)->get('ulkeler')->result();
} else {
    $ulkeler = array();
}

// Kullanıcının sorumlu olduğu illeri çek
$sorumluIllerQ = "SELECT DISTINCT il_id 
                 FROM kullanici_sorumluluk_bolgesi 
                 WHERE kullanici = '$u_id' 
                 AND durum = 1 
                 AND il_id IS NOT NULL
                 AND (baslangic_tarihi IS NULL OR baslangic_tarihi <= '$bugun') 
                 AND (bitis_tarihi IS NULL OR bitis_tarihi >= '$bugun')";
$sorumluIller = $this->db->query($sorumluIllerQ)->result();

if (count($sorumluIller) > 0) {
    $yetkiliIlIds = array();
    foreach ($sorumluIller as $il) {
        $yetkiliIlIds[] = $il->il_id;
    }
    $iller = $this->db->where_in('id', $yetkiliIlIds)->get('iller')->result();
} else {
    $iller = array();
}

// Kullanıcının sorumlu olduğu ilçeleri çek - artık dinamik olarak AJAX ile yüklenecek
// get_ilceler_by_sorumluluk metodunda il bazında kontrol yapılacak
$ilceler = array(); // Boş array - AJAX ile doldurulacak
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
								<div class="col">									<form class="form-inline" id="potansiyelCariFiltreForm">
										<div class="form-row align-items-end">
    <div class="form-group mr-2 mb-2">
        <label for="ulke" class="mr-2">Ülke</label>
        <select class="form-control" id="ulke" name="ulke">
            <option value="">Tümü</option>
            <?php foreach($ulkeler as $ulke): ?>
                <option value="<?= $ulke->ulke_kodu ?>"><?= $ulke->ulke_adi ?></option>
            <?php endforeach; ?>
        </select>
    </div>
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
    </div>    <div class="form-group mr-2 mb-2">
        <label for="mahalle" class="mr-2">Mahalle</label>
        <select class="form-control" id="mahalle" name="mahalle" disabled>
            <option value="">Önce ilçe seçiniz</option>
        </select>
    </div>
    <div class="form-group mr-2 mb-2">
        <label for="cari_grup" class="mr-2">Grup</label>
        <select class="form-control" id="cari_grup" name="cari_grup">
            <option value="">Tümü</option>
            <?php foreach($cariGruplar as $grup): ?>
                <option value="<?= $grup->potansiyel_cari_grup ?>"><?= $grup->potansiyel_cari_grup ?></option>
            <?php endforeach; ?>
        </select>
    </div>    <div class="form-group mr-2 mb-2">
        <label for="potansiyel_cari_firmaTelefon" class="mr-2">Telefon/Cari Ad ile Arama</label>
        <select class="form-control" id="potansiyel_cari_firmaTelefon" name="potansiyel_cari_firmaTelefon" style="width:200px;" data-live-search="true">
            <option value="">Tümü</option>
        </select>
    </div><div class="ml-auto d-flex align-items-end">
        <button type="submit" class="btn btn-primary mb-2 mr-2">Filtrele</button>
        <button type="button" class="btn btn-mor mb-2" data-toggle="modal" data-target="#catkapi_modal"><i class="fa fa-plus"></i> ÇatKapı</button>
    </div>
</div>
									</form>
								</div>
							</div>
						</div>
						<div class="card-body">							<div class="table-responsive">								<table class="table table-striped custom-table mb-0">									<thead>									<tr>
										<th class="text-left no-sort">İşlem</th>
										<th>Telefon</th>
										<th>Cari Adı</th>
										<th class="hide-mobile">Cari Grup</th>
										<th>İl</th>
										<th>İlçe</th>
										<th>Mahalle</th>
										<th>Adres</th>
										<th class="hide-mobile text-center">Görsel</th>
										<th class="hide-mobile text-center">Döküman</th>
									</tr>
									</thead>
									<tbody id="potansiyelCariTableBody">
									<!-- Potansiyel cari kayıtları buraya eklenecek -->
									</tbody>
								</table>								<hr>
								<span style="margin-left:15px;">Sorumlu olduğunuz bölgedeki kayıt sayısı: <b>0</b></span>
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
    </div>  </div>
</div>

<!-- ÇatKapı Modal -->
<div class="modal fade" id="catkapi_modal" tabindex="-1" role="dialog" aria-labelledby="catkapiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <form id="catkapiForm" method="post" action="<?= base_url('teklif/catkapi_kaydet') ?>" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="catkapiModalLabel">Yeni Teklif Ekle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <!-- Sol Kolon -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Sezon <span class="text-danger">*</span></label>
                <select class="form-control" name="sezon_id" id="catkapi_sezon" required>
                  <option value="">Sezon Seçiniz</option>
                  <!-- Sezonlar AJAX ile yüklenecek -->
                </select>
              </div>
              
              <div class="form-group">
                <label>Cari Ünvan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="potansiyel_cari_ad" required placeholder="Cari ünvanını giriniz">
              </div>
              
              <div class="form-group">
                <label>Telefon <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="potansiyel_cari_firmaTelefon" required placeholder="Telefon numarasını giriniz" maxlength="15">
              </div>
              
              <div class="form-group">
                <label>Sektör <span class="text-danger">*</span></label>
                <select class="form-control" name="sektor_id" id="catkapi_sektor" required>
                  <option value="">Sektör Seçiniz</option>
                  <!-- Sektörler AJAX ile yüklenecek -->
                </select>
              </div>
              
              <div class="form-group">
                <label>Ülke <span class="text-danger">*</span></label>
                <select class="form-control" name="potansiyel_ulke_id" id="catkapi_ulke" required>
                  <option value="">Ülke Seçiniz</option>
                  <?php foreach($ulkeler as $ulke): ?>
                    <option value="<?= $ulke->ulke_kodu ?>"><?= $ulke->ulke_adi ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              
              <div class="form-group">
                <label>İl <span class="text-danger">*</span></label>
                <select class="form-control" name="potansiyel_il_id" id="catkapi_il" required>
                  <option value="">Önce ülke seçiniz</option>
                  <?php foreach($iller as $il): ?>
                    <option value="<?= $il->id ?>"><?= $il->il ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            
            <!-- Sağ Kolon -->
            <div class="col-md-6">
              <div class="form-group">
                <label>İlçe <span class="text-danger">*</span></label>
                <select class="form-control" name="potansiyel_ilce_id" id="catkapi_ilce" required disabled>
                  <option value="">Önce il seçiniz</option>
                </select>
              </div>
              
              <div class="form-group">
                <label>Mahalle</label>
                <input type="text" class="form-control" name="potansiyel_mahalle" placeholder="Mahalle bilgisini giriniz">
              </div>
              
              <div class="form-group">
                <label>Adres <span class="text-danger">*</span></label>
                <textarea class="form-control" name="potansiyel_cari_adres" rows="3" required placeholder="Adres bilgisini giriniz"></textarea>
              </div>
              
              <div class="form-group">
                <label>Görsel <small class="text-muted">(İsteğe bağlı - JPG, PNG, GIF - Max: 5MB)</small></label>
                <input type="file" class="form-control" name="potansiyel_gorsel" id="catkapi_gorsel" accept=".jpg,.jpeg,.png,.gif">
                <small class="text-muted">İşletme görseli yükleyebilirsiniz</small>
              </div>
              
              <div class="form-group">
                <label>Dökümanlar <small class="text-muted">(İsteğe bağlı - PDF, DOC, DOCX - Max: 10MB)</small></label>
                <input type="file" class="form-control" name="potansiyel_dokumanlar[]" id="catkapi_dokumanlar" accept=".pdf,.doc,.docx" multiple>
                <small class="text-muted">İlgili dökümanları yükleyebilirsiniz (Çoklu seçim yapabilirsiniz)</small>
              </div>
            </div>
          </div>
        </div>        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
          <button type="submit" class="btn btn-mor save-btn-mobile">
            <i class="fa fa-save"></i> Kaydet
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Potansiyel Satış Ekle Modal -->
<div class="modal fade" id="potansiyelSatisEkleModal" tabindex="-1" role="dialog" aria-labelledby="potansiyelSatisEkleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="<?= base_url('teklif/potansiyel_satis_ekle') ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="potansiyelSatisEkleModalLabel">Yeni Teklif Ekle</h5>
          <div class="ml-auto">
            <button type="submit" class="btn btn-primary mr-2">Kaydet</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
          </div>
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
          </div>
          <div class="form-group">
            <label>Açıklama</label>            <textarea name="aciklama" class="form-control"></textarea>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Teklifleri Gör Modal - Artık kullanılmıyor (sayfa yönlendirmesi yapılıyor) -->

<?php $this->load->view("include/footer-js"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" 
		integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" 
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= base_url('assets/select2.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {    $('#il').on('change', function() {
        var il_id = $(this).val();
        console.log('İl seçildi:', il_id);
        
        // İlçe dropdown'ını resetle
        $('#ilce').prop('disabled', true).html('<option value="">Önce il seçiniz</option>');
        $('#mahalle').prop('disabled', true).html('<option value="">Önce ilçe seçiniz</option>');
        
        if(il_id) {
            $('#ilce').prop('disabled', false);
            $('#ilce').html('<option value="">Yükleniyor...</option>');
            
            $.ajax({
                url: '<?= base_url("teklif/get_ilceler_by_sorumluluk") ?>',
                type: 'POST',
                data: {il_id: il_id},
                dataType: 'json',
                timeout: 10000, // 10 saniye timeout
                success: function(result) {
                    console.log('İlçe AJAX response:', result);
                    
                    if(result && result.status === 'success') {
                        var options = '<option value="">Tümü</option>';
                        if(result.data && result.data.length > 0) {
                            $.each(result.data, function(i, ilce) {
                                options += '<option value="'+ilce.id+'">'+ilce.ilce+'</option>';
                            });
                            $('#ilce').html(options);
                            toastr.success('İlçeler başarıyla yüklendi.');
                        } else {
                            $('#ilce').html('<option value="">Bu ilde sorumlu olduğunuz ilçe bulunmuyor</option>');
                            toastr.warning('Bu ilde sorumlu olduğunuz ilçe bulunmuyor.');
                        }
                    } else {
                        var errorMsg = result && result.message ? result.message : 'İlçe bulunamadı';
                        $('#ilce').html('<option value="">'+errorMsg+'</option>');
                        toastr.error('İlçe yüklenirken hata: ' + errorMsg);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('İlçe AJAX error:', {xhr: xhr, status: status, error: error});
                    var errorMsg = 'Sunucu hatası oluştu';
                    
                    if(status === 'timeout') {
                        errorMsg = 'İstek zaman aşımına uğradı';
                    } else if(xhr.status === 404) {
                        errorMsg = 'Endpoint bulunamadı';
                    } else if(xhr.status === 500) {
                        errorMsg = 'Sunucu hatası';
                    }
                    
                    $('#ilce').html('<option value="">'+errorMsg+'</option>');
                    toastr.error('İlçe yüklenirken hata: ' + errorMsg);
                }
            });
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
    });    // Telefon/Cari Ad search dropdown (select2 ile)
    $('#potansiyel_cari_firmaTelefon').select2({
        placeholder: 'Telefon veya Cari Ad ara...',
        allowClear: true,
        minimumInputLength: 2,
        ajax: {
            url: '<?= base_url("teklif/telefon_cari_search") ?>',
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {q: params.term};
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            id: item.value, 
                            text: item.label
                        };
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
        console.log('Form submitted, fetching data...');
        
        var table = $('.custom-table').DataTable();
        table.clear().draw();
        
        $.ajax({
            url: '<?= base_url("teklif/potansiyelCariFiltrele") ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(result) {
                console.log('AJAX Success:', result);
                
                if(result && result.status === 'success' && result.data && result.data.length > 0) {
                    var rows = [];
                    
                    $.each(result.data, function(i, item) {
                        // Görsel dosyası kontrolü
                        var gorselHtml = '';
                        if (item.potansiyel_gorsel && item.potansiyel_gorsel.trim() !== '') {
                            gorselHtml = '<a href="<?= base_url("assets/uploads/potansiyeller/gorseller/") ?>' + item.potansiyel_gorsel + '" target="_blank" class="btn btn-sm btn-info" title="Görseli Görüntüle"><i class="fa fa-image"></i></a>';
                        } else {
                            gorselHtml = '<span class="text-muted">-</span>';
                        }
                        
                        // Döküman dosyaları kontrolü
                        var dokumanHtml = '';
                        if (item.potansiyel_dokumanlar && item.potansiyel_dokumanlar.trim() !== '') {
                            var dokumanlar = item.potansiyel_dokumanlar.split(',');
                            var dokumanButtons = [];
                            $.each(dokumanlar, function(j, dokuman) {
                                if (dokuman.trim() !== '') {
                                    var fileName = dokuman.trim();
                                    var displayName = fileName.length > 20 ? fileName.substring(0, 17) + '...' : fileName;
                                    dokumanButtons.push('<a href="<?= base_url("assets/uploads/potansiyeller/dokumanlar/") ?>' + fileName + '" target="_blank" class="btn btn-xs btn-success mb-1" title="' + fileName + '"><i class="fa fa-file"></i> ' + displayName + '</a>');
                                }
                            });
                            dokumanHtml = dokumanButtons.length > 0 ? dokumanButtons.join('<br>') : '<span class="text-muted">-</span>';
                        } else {
                            dokumanHtml = '<span class="text-muted">-</span>';
                        }
                        
                        rows.push([
                            '<button class="btn btn-sm btn-outline-primary potansiyel-cari-teklif" data-id="'+(item.id||'')+'" data-ad="'+(item.potansiyel_cari_ad||'')+'" data-tel="'+(item.potansiyel_cari_firmaTelefon||'')+'"><i class="fa fa-file-text"></i> Teklif</button>',
                            (item.potansiyel_cari_firmaTelefon || ''),
                            (item.potansiyel_cari_ad || ''),
                            (item.potansiyel_cari_grup || ''),
                            (item.il_adi || ''),
                            (item.ilce_adi || ''),
                            (item.potansiyel_mahalle || ''),
                            (item.potansiyel_cari_adres || ''),
                            gorselHtml,
                            dokumanHtml
                        ]);
                    });
                    
                    table.rows.add(rows).draw();
                    $('.card-body span').find('b').text(result.data.length);
                    console.log('Added ' + rows.length + ' rows to DataTable');
                } else {
                    table.clear().draw();
                    $('.card-body span').find('b').text('0');
                    console.log('No data found or invalid response');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                console.error('Response:', xhr.responseText);
                var table = $('.custom-table').DataTable();
                table.clear().draw();
                $('.card-body span').find('b').text('0');
                toastr.error('Veri yüklenirken hata oluştu: ' + error);
            }
        });    });    // Sayfa ilk açıldığında sorumluluk bölgesi verilerini yükle
    var table = $('.custom-table').DataTable();
    table.clear().draw();
    
    // Sayfa açıldığında otomatik olarak sorumluluk bölgesi verilerini getir
    $.ajax({
        url: '<?= base_url("teklif/potansiyelCariFiltrele") ?>',
        type: 'POST',
        data: {}, // Boş data gönder, backend sorumluluk kontrolü yapacak
        dataType: 'json',
        success: function(result) {
            console.log('Sayfa açılış AJAX Success:', result);
            
            if(result && result.status === 'success' && result.data && result.data.length > 0) {
                var rows = [];
                
                $.each(result.data, function(i, item) {
                    // Görsel dosyası kontrolü
                    var gorselHtml = '';
                    if (item.potansiyel_gorsel && item.potansiyel_gorsel.trim() !== '') {
                        gorselHtml = '<a href="<?= base_url("assets/uploads/potansiyeller/gorseller/") ?>' + item.potansiyel_gorsel + '" target="_blank" class="btn btn-sm btn-info" title="Görseli Görüntüle"><i class="fa fa-image"></i></a>';
                    } else {
                        gorselHtml = '<span class="text-muted">-</span>';
                    }
                    
                    // Döküman dosyaları kontrolü
                    var dokumanHtml = '';
                    if (item.potansiyel_dokumanlar && item.potansiyel_dokumanlar.trim() !== '') {
                        var dokumanlar = item.potansiyel_dokumanlar.split(',');
                        var dokumanButtons = [];
                        $.each(dokumanlar, function(j, dokuman) {
                            if (dokuman.trim() !== '') {
                                var fileName = dokuman.trim();
                                var displayName = fileName.length > 20 ? fileName.substring(0, 17) + '...' : fileName;
                                dokumanButtons.push('<a href="<?= base_url("assets/uploads/potansiyeller/dokumanlar/") ?>' + fileName + '" target="_blank" class="btn btn-xs btn-success mb-1" title="' + fileName + '"><i class="fa fa-file"></i> ' + displayName + '</a>');
                            }
                        });
                        dokumanHtml = dokumanButtons.length > 0 ? dokumanButtons.join('<br>') : '<span class="text-muted">-</span>';
                    } else {
                        dokumanHtml = '<span class="text-muted">-</span>';
                    }
                    
                    rows.push([
                        '<button class="btn btn-sm btn-outline-primary potansiyel-cari-teklif" data-id="'+(item.id||'')+'" data-ad="'+(item.potansiyel_cari_ad||'')+'" data-tel="'+(item.potansiyel_cari_firmaTelefon||'')+'"><i class="fa fa-file-text"></i> Teklif</button>',
                        (item.potansiyel_cari_firmaTelefon || ''),
                        (item.potansiyel_cari_ad || ''),
                        (item.potansiyel_cari_grup || ''),
                        (item.il_adi || ''),
                        (item.ilce_adi || ''),
                        (item.potansiyel_mahalle || ''),
                        (item.potansiyel_cari_adres || ''),
                        gorselHtml,
                        dokumanHtml
                    ]);
                });
                
                table.rows.add(rows).draw();
                $('.card-body span').find('b').text(result.data.length);
                console.log('Sayfa açılışında ' + rows.length + ' kayıt yüklendi');
                toastr.success(rows.length + ' adet sorumlu olduğunuz bölgedeki kayıt listelendi.');
            } else {
                table.clear().draw();
                $('.card-body span').find('b').text('0');
                console.log('Sorumlu olduğunuz bölgede veri bulunamadı');
                toastr.info('Sorumlu olduğunuz bölgede henüz kayıt bulunmuyor.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Sayfa açılış AJAX Error:', error);
            console.error('Response:', xhr.responseText);
            table.clear().draw();
            $('.card-body span').find('b').text('0');
            toastr.warning('Veriler yüklenemedi. Lütfen sayfayı yenileyin.');
        }
    });

    // Tümünü seç kutusu - Artık kullanılmıyor (kutucuklar kaldırıldı)
    /*
    $('#tumunuSec').on('change', function() {
        var checked = $(this).is(':checked');
        $('.potansiyel-cari-sec').prop('checked', checked);
    });
    */

    // Satır düzenleme işlemi - Artık kullanılmıyor (düzenle butonu kaldırıldı)
    /*
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
    });
    */// Teklif hazırlama işlemi - T butonuna tıklayınca seçim modalı aç
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
    });    // Teklifleri Gör butonuna tıklayınca - teklif-listele sayfasına yönlendir
    $(document).on('click', '.teklifleri-gor-btn', function() {
        var modal = $('#teklifSecimModal');
        var id = modal.data('cari-id');
        var ad = modal.data('cari-ad');
        
        // Seçim modalını kapat
        $('#teklifSecimModal').modal('hide');
        
        // teklif-listele sayfasına müşteri ID'si ile filtrelenmiş halde yönlendir
        setTimeout(function() {
            window.location.href = '<?= base_url("teklif/teklif-listele") ?>?cari_id=' + id + '&cari_ad=' + encodeURIComponent(ad);
        }, 300);
    });    // Modal kapandığında formu temizle
    $('#potansiyelSatisEkleModal').on('hidden.bs.modal', function() {
        $("#cari_autocomplete").val('');
        $("#selected_cari_id").val('');
        $(this).find('form')[0].reset();
    });

    // Teklifler modal - Artık kullanılmıyor (sayfa yönlendirmesi yapılıyor)
    /*
    $('#tekliflerGorModal').on('hidden.bs.modal', function() {
        $('#tekliflerListesi').html('');
    });
    */

    // Durum seçimi değiştiğinde fiyat alanlarını gizle/göster
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
    });

    // Fiyat alanları için Türk Lirası formatı
    function formatTurkishCurrency(value) {
        // Sayıyı string'e çevir ve sadece rakamları al
        let numStr = value.toString().replace(/[^\d]/g, '');
        
        if (numStr === '') return '';
        
        // Sayıyı integer'a çevir
        let num = parseInt(numStr);
        
        // Kuruş için son 2 basamağı ayır
        let kurus = num % 100;
        let lira = Math.floor(num / 100);
        
        // Binlik ayırıcıları ekle
        let liraStr = lira.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        
        // Kuruşu 2 basamaklı yap
        let kurusStr = kurus.toString().padStart(2, '0');
        
        return liraStr + ',' + kurusStr;
    }

    function parseTurkishCurrency(value) {
        // Nokta ve virgülü kaldır, sadece rakamları al
        let numStr = value.replace(/[^\d]/g, '');
        if (numStr === '') return 0;
        return parseInt(numStr) / 100;
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
        }
    });
});
</script>

<script>
	// ÇatKapı Modal JavaScript kodları
	$(document).ready(function() {
		// ÇatKapı modal açıldığında sezon ve sektör verilerini yükle
		$('#catkapi_modal').on('shown.bs.modal', function() {
			catkapiSezonlariYukle();
			catkapiSektorleriYukle();
		});
				// Sezonları yükle
		function catkapiSezonlariYukle() {
			$.getJSON('<?= base_url("teklif/sezonlar-listele") ?>', function(resp) {
				var options = '<option value="">Sezon Seçiniz</option>';
				if (resp.data && resp.data.length > 0) {
					$.each(resp.data, function(i, sezon) {
						// Sezon_id 5 (25-26 sezonu) varsayılan olarak seçili olacak
						var selected = (sezon.sezon_id == 5) ? ' selected' : '';
						options += '<option value="' + sezon.sezon_id + '"' + selected + '>' + sezon.sezon_adi + '</option>';
					});
				}
				$('#catkapi_sezon').html(options);
			}).fail(function() {
				console.error('Sezonlar yüklenemedi');
			});
		}
		
		// Sektörleri yükle
		function catkapiSektorleriYukle() {
			$.getJSON('<?= base_url("teklif/sektorler-listele") ?>', function(resp) {
				var options = '<option value="">Sektör Seçiniz</option>';
				if (resp.data && resp.data.length > 0) {
					$.each(resp.data, function(i, sektor) {
						options += '<option value="' + sektor.sektor_id + '">' + sektor.sektor_adi + '</option>';
					});
				}
				$('#catkapi_sektor').html(options);
			}).fail(function() {
				console.error('Sektörler yüklenemedi');
			});
		}
				// ÇatKapı İl değiştiğinde ilçeleri yükle
		$('#catkapi_il').on('change', function() {
			var il_id = $(this).val();
			console.log('Modal İl seçildi:', il_id);
			
			// İlçe dropdown'ını resetle
			$('#catkapi_ilce').prop('disabled', true).html('<option value="">Önce il seçiniz</option>');
			
			if(il_id) {
				$('#catkapi_ilce').prop('disabled', false);
				$('#catkapi_ilce').html('<option value="">Yükleniyor...</option>');
				
				$.ajax({
					url: '<?= base_url("teklif/get_ilceler_by_sorumluluk") ?>',
					type: 'POST',
					data: {il_id: il_id},
					dataType: 'json',
					timeout: 10000, // 10 saniye timeout
					success: function(result) {
						console.log('Modal İlçe AJAX response:', result);
						
						if(result && result.status === 'success') {
							var options = '<option value="">İlçe Seçiniz</option>';
							if(result.data && result.data.length > 0) {
								$.each(result.data, function(i, ilce) {
									options += '<option value="'+ilce.id+'">'+ilce.ilce+'</option>';
								});
								$('#catkapi_ilce').html(options);
								toastr.success('İlçeler başarıyla yüklendi.');
							} else {
								$('#catkapi_ilce').html('<option value="">Bu ilde sorumlu olduğunuz ilçe bulunmuyor</option>');
								toastr.warning('Bu ilde sorumlu olduğunuz ilçe bulunmuyor.');
							}
						} else {
							var errorMsg = result && result.message ? result.message : 'İlçe bulunamadı';
							$('#catkapi_ilce').html('<option value="">'+errorMsg+'</option>');
							toastr.error('İlçe yüklenirken hata: ' + errorMsg);
						}
					},
					error: function(xhr, status, error) {
						console.error('Modal İlçe AJAX error:', {xhr: xhr, status: status, error: error});
						var errorMsg = 'Sunucu hatası oluştu';
						
						if(status === 'timeout') {
							errorMsg = 'İstek zaman aşımına uğradı';
						} else if(xhr.status === 404) {
							errorMsg = 'Endpoint bulunamadı';
						} else if(xhr.status === 500) {
							errorMsg = 'Sunucu hatası';
						}
								$('#catkapi_ilce').html('<option value="">'+errorMsg+'</option>');
						toastr.error('İlçe yüklenirken hata: ' + errorMsg);
					}
				});
			} else {
				$('#catkapi_ilce').prop('disabled', true).html('<option value="">Önce il seçiniz</option>');
			}
		});
		
		// Dosya yükleme validasyonu - Görsel
		$('#catkapi_gorsel').on('change', function() {
			validateCatkapiFileUpload(this, 'görsel', 5);
		});
		
		// Dosya yükleme validasyonu - Dökümanlar
		$('#catkapi_dokumanlar').on('change', function() {
			validateCatkapiMultipleFileUpload(this, 'döküman', 10);
		});
		
		// Tek dosya validasyonu
		function validateCatkapiFileUpload(input, fileType, maxSizeMB) {
			var file = input.files[0];
			var $input = $(input);
			var $container = $input.closest('.form-group');
			
			// Önceki hata mesajlarını temizle
			$container.find('.file-error').remove();
			$container.find('.file-success').remove();
			$container.removeClass('has-error');
			
			if (!file) {
				return true; // Dosya seçilmemişse geçerli (isteğe bağlı)
			}
			
			// Dosya boyutu kontrolü
			var maxSize = maxSizeMB * 1024 * 1024;
			if (file.size > maxSize) {
				showCatkapiFileError($container, 'Dosya boyutu ' + maxSizeMB + 'MB\'dan büyük olamaz.');
				input.value = '';
				return false;
			}
			
			// Dosya tipi kontrolü
			var allowedTypes = [];
			if (fileType === 'görsel') {
				allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
			} else if (fileType === 'döküman') {
				allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
			}
			
			if (!allowedTypes.includes(file.type)) {
				if (fileType === 'görsel') {
					showCatkapiFileError($container, 'Sadece JPG, PNG ve GIF dosyaları kabul edilir.');
				} else {
					showCatkapiFileError($container, 'Sadece PDF, DOC ve DOCX dosyaları kabul edilir.');
				}
				input.value = '';
				return false;
			}
			
			// Başarılı yükleme göstergesi
			showCatkapiFileSuccess($container, fileType.charAt(0).toUpperCase() + fileType.slice(1) + ' dosyası seçildi: ' + file.name);
			return true;
		}
		
		// Çoklu dosya validasyonu
		function validateCatkapiMultipleFileUpload(input, fileType, maxSizeMB) {
			var files = input.files;
			var $input = $(input);
			var $container = $input.closest('.form-group');
			
			// Önceki hata mesajlarını temizle
			$container.find('.file-error').remove();
			$container.find('.file-success').remove();
			$container.removeClass('has-error');
			
			if (!files || files.length === 0) {
				return true; // Dosya seçilmemişse geçerli (isteğe bağlı)
			}
			
			var maxSize = maxSizeMB * 1024 * 1024;
			var allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
			
			for (var i = 0; i < files.length; i++) {
				var file = files[i];
				
				// Dosya boyutu kontrolü
				if (file.size > maxSize) {
					showCatkapiFileError($container, file.name + ' dosyası ' + maxSizeMB + 'MB\'dan büyük.');
					input.value = '';
					return false;
				}
				
				// Dosya tipi kontrolü
				if (!allowedTypes.includes(file.type)) {
					showCatkapiFileError($container, file.name + ' dosyası için sadece PDF, DOC ve DOCX dosyaları kabul edilir.');
					input.value = '';
					return false;
				}
			}
			
			// Başarılı yükleme göstergesi
			showCatkapiFileSuccess($container, files.length + ' adet ' + fileType + ' dosyası seçildi.');
			return true;
		}
		
		// Dosya hatası göster
		function showCatkapiFileError($container, message) {
			$container.addClass('has-error');
			$container.append('<div class="file-error text-danger small mt-1"><i class="fa fa-exclamation-triangle"></i> ' + message + '</div>');
		}
		
		// Dosya başarı göster
		function showCatkapiFileSuccess($container, message) {
			$container.removeClass('has-error');
			$container.append('<div class="file-success text-success small mt-1"><i class="fa fa-check"></i> ' + message + '</div>');
		}
		
		// Form submit validasyonu
		$("#catkapiForm").on('submit', function(e) {
			var hasError = false;
			
			// Dosya validasyonları
			var gorselFile = document.getElementById('catkapi_gorsel');
			if (gorselFile && gorselFile.files.length > 0) {
				if (!validateCatkapiFileUpload(gorselFile, 'görsel', 5)) {
					hasError = true;
				}
			}
			
			var dokumanFiles = document.getElementById('catkapi_dokumanlar');
			if (dokumanFiles && dokumanFiles.files.length > 0) {
				if (!validateCatkapiMultipleFileUpload(dokumanFiles, 'döküman', 10)) {
					hasError = true;
				}
			}
			
			if (hasError) {
				e.preventDefault();
				swal({
					title: "Hata",
					type: "error",
					text: "Lütfen dosya yükleme hatalarını düzeltin.",
					confirmButtonText: 'Tamam'
				});
				return false;
			}
			
			// Form gönderilirken submit butonunu devre dışı bırak
			$(this).find('button[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Kaydediliyor...');
		});
	});
</script>

<script>
	// Teklif hazırlama sayfası için JavaScript kodları buraya eklenebilir
</script>

<?php if ($this->session->flashdata('catkapi_success')): ?>
<script>
swal({
  title: "Başarılı",
  type: "success", 
  text: "<?= $this->session->flashdata('catkapi_success') ?>",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('catkapi_error')): ?>
<script>
swal({
  title: "Hata",
  type: "error", 
  text: "<?= $this->session->flashdata('catkapi_error') ?>",
  confirmButtonText:'Tamam',
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

</body>
</html>
