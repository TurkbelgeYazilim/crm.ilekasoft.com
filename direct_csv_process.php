<?php
// Direkt sunucu dosyası işleme metodu - İyileştirilmiş Versiyon
define('BASEPATH', '');
require_once 'application/config/database.php';

// Database bağlantısı
$mysqli = new mysqli($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Türkçe karakter desteği için charset ayarlama
$mysqli->set_charset("utf8mb4");

// Dinamik CSV dosya yolu - kullanıcının yüklediği dosya
$csv_file = "";
$available_files = [];

// Yüklenen dosyaları kontrol et
$uploads_dir = "uploads/iris_rapor/";
if (is_dir($uploads_dir)) {
    $files = glob($uploads_dir . "*.csv");
    if (!empty($files)) {
        foreach ($files as $file) {
            $available_files[] = [
                'path' => $file,
                'name' => basename($file),
                'size' => filesize($file),
                'date' => filemtime($file)
            ];
        }
        // En son yüklenen dosyayı varsayılan olarak seç
        usort($available_files, function($a, $b) {
            return $b['date'] - $a['date'];
        });
        if (!empty($available_files)) {
            $csv_file = $available_files[0]['path'];
        }
    }
}

// 1OrnekData klasöründeki dosyaları da ekle
if (is_dir("1OrnekData/")) {
    $sample_files = glob("1OrnekData/*.csv");
    foreach ($sample_files as $file) {
        $available_files[] = [
            'path' => $file,
            'name' => "📁 " . basename($file),
            'size' => filesize($file),
            'date' => filemtime($file)
        ];
    }
}

// Kullanıcı dosya seçtiyse
if (isset($_GET['selected_file']) && !empty($_GET['selected_file'])) {
    $selected = $_GET['selected_file'];
    if (file_exists($selected)) {
        $csv_file = $selected;
    }
}

// Eğer hiç dosya yoksa, varsayılan örnek dosyayı kullan
if (empty($csv_file) || !file_exists($csv_file)) {
    $csv_file = "1OrnekData/Talep Raporu - Tüm Kayıtlar-09.08.2025 09_21.csv";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['process_file'])) {
    echo "<h3>Dosya İşleniyor...</h3>";
    
    if (!file_exists($csv_file)) {
        echo "<div style='color: red;'>HATA: CSV dosyası bulunamadı: $csv_file</div>";
        exit;
    }
    
    // Performance ayarları
    ini_set('max_execution_time', 600);
    ini_set('memory_limit', '1024M');
    
    $handle = fopen($csv_file, 'r');
    if (!$handle) {
        echo "<div style='color: red;'>HATA: CSV dosyası açılamadı</div>";
        exit;
    }
    
    // CSV dosyasının encoding'ini kontrol et ve UTF-8'e dönüştür
    $first_line = fgets($handle);
    rewind($handle);
    
    $encoding = mb_detect_encoding($first_line, ['UTF-8', 'UTF-16', 'Windows-1254', 'ISO-8859-9'], true);
    echo "Dosya encoding algılandı: <strong>$encoding</strong><br>";
    
    // CSV başlığını oku
    $header = fgetcsv($handle, 0, ';');
    echo "Başlık okundu: " . count($header) . " sütun<br>";
    
    $processed = 0;
    $updated = 0;
    $failed = 0;
    $batch_size = 500;
    $batch_data = [];
    
    echo "<div id='progress'>İşlem başlatılıyor...</div>";
    echo "<script>
    function updateProgress(text) {
        document.getElementById('progress').innerHTML = text;
    }
    </script>";
    
    while (($data = fgetcsv($handle, 0, ';')) !== FALSE) {
        if (count($data) < count($header)) {
            $failed++;
            continue;
        }
        
        // Encoding dönüşümü (Türkçe karakter desteği için)
        if ($encoding !== 'UTF-8') {
            $data = array_map(function($item) use ($encoding) {
                return mb_convert_encoding($item, 'UTF-8', $encoding);
            }, $data);
        }
        
        $csv_data = array_combine($header, $data);
        
        // Tarih formatlarını düzelt
        $memo_kapanis_tarihi = null;
        if (!empty($csv_data['MEMO_KAPANIS_TARIHI'])) {
            $date_str = trim($csv_data['MEMO_KAPANIS_TARIHI']);
            if (preg_match('/(\d{1,2})\.(\d{1,2})\.(\d{4})\s+(\d{1,2}):(\d{2})/', $date_str, $matches)) {
                $memo_kapanis_tarihi = "{$matches[3]}-{$matches[2]}-{$matches[1]} {$matches[4]}:{$matches[5]}:00";
            }
        }
        
        $talep_giris_tarihi = null;
        if (!empty($csv_data['TALEP_GIRIS_TARIHI'])) {
            $date_str = trim($csv_data['TALEP_GIRIS_TARIHI']);
            if (preg_match('/(\d{1,2})\.(\d{1,2})\.(\d{4})\s+(\d{1,2}):(\d{2})/', $date_str, $matches)) {
                $talep_giris_tarihi = "{$matches[3]}-{$matches[2]}-{$matches[1]} {$matches[4]}:{$matches[5]}:00";
            }
        }
        
        $randevu_tarihi = null;
        if (!empty($csv_data['RANDEVU_TARIHI'])) {
            $date_str = trim($csv_data['RANDEVU_TARIHI']);
            if (preg_match('/(\d{1,2})\.(\d{1,2})\.(\d{4})\s+(\d{1,2}):(\d{2})/', $date_str, $matches)) {
                $randevu_tarihi = "{$matches[3]}-{$matches[2]}-{$matches[1]} {$matches[4]}:{$matches[5]}:00";
            }
        }
        
        // Insert verisi hazırla
        $insert_values = "('" . 
            $mysqli->real_escape_string(trim($csv_data['TALEP_ID'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['TALEP_TURU'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['UYDU_BASVURU_POTANSIYEL_NO'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['UYDU_BASVURU_UYE_NO'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['DT_MUSTERI_NO'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['MEMO_ID'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['MEMO_KAYIT_TIPI'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['MEMO_ID_TIP'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['MEMO_KODU'] ?? '')) . "'," .
            ($memo_kapanis_tarihi ? "'$memo_kapanis_tarihi'" : "NULL") . ",'" .
            $mysqli->real_escape_string(trim($csv_data['MEMO_YONLENEN_BAYI_KODU'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['MEMO_YONLENEN_BAYI_ADI'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['MEMO_YONLENEN_BAYI_YONETICISI'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['MEMO_YONLENEN_BAYI_BOLGE'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['MEMO_YONLENEN_BAYI_TEKNIK_YNTC'] ?? '')) . "'," .
            ($talep_giris_tarihi ? "'$talep_giris_tarihi'" : "NULL") . ",'" .
            $mysqli->real_escape_string(trim($csv_data['TALEBI_GIREN_BAYI_KODU'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['TALEBI_GIREN_BAYI_ADI'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['TALEBI_GIREN_PERSONEL'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['TALEBI_GIREN_PERSONELNO'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['TALEBI_GIREN_PERSONELKODU'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['TALEBI_GIREN_PERSONEL_ALTBAYI'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['TALEP_KAYNAK'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['SATIS_DURUMU'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['INTERNET_SUREC_DURUMU'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['AKTIVE_EDILEN_UYENO'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['AKTIVE_EDILEN_OUTLETNO'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['AKTIVE_EDILEN_SOZLESMENO'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['AKTIVE_EDILEN_SOZLESMEKMP'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['AKTIVE_EDILEN_SOZLESMEDURUM'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['TALEP_TAKIP_NOTU'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['GUNCEL_OUTLET_DURUM'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['TEYIT_DURUM'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['TEYIT_ARAMA_DURUM'] ?? '')) . "'," .
            ($randevu_tarihi ? "'$randevu_tarihi'" : "NULL") . ",'" .
            $mysqli->real_escape_string(trim($csv_data['MEMO_SON_DURUM'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['MEMO_SON_CEVAP'] ?? '')) . "','" .
            $mysqli->real_escape_string(trim($csv_data['MEMO_SON_ACIKLAMA'] ?? '')) . "',NOW())";
        
        // memo_id kontrolü yap
        $memo_id = trim($csv_data['MEMO_ID'] ?? '');
        if (!empty($memo_id)) {
            // Mevcut kaydı kontrol et
            $check_sql = "SELECT id FROM voip_iris_rapor WHERE memo_id = '" . $mysqli->real_escape_string($memo_id) . "'";
            $check_result = $mysqli->query($check_sql);
            
            if ($check_result && $check_result->num_rows > 0) {
                // Kayıt mevcut, güncelle
                $update_sql = "UPDATE voip_iris_rapor SET 
                    talep_id = '" . $mysqli->real_escape_string(trim($csv_data['TALEP_ID'] ?? '')) . "',
                    talep_turu = '" . $mysqli->real_escape_string(trim($csv_data['TALEP_TURU'] ?? '')) . "',
                    uydu_basvuru_potansiyel_no = '" . $mysqli->real_escape_string(trim($csv_data['UYDU_BASVURU_POTANSIYEL_NO'] ?? '')) . "',
                    uydu_basvuru_uye_no = '" . $mysqli->real_escape_string(trim($csv_data['UYDU_BASVURU_UYE_NO'] ?? '')) . "',
                    dt_musteri_no = '" . $mysqli->real_escape_string(trim($csv_data['DT_MUSTERI_NO'] ?? '')) . "',
                    memo_kayit_tipi = '" . $mysqli->real_escape_string(trim($csv_data['MEMO_KAYIT_TIPI'] ?? '')) . "',
                    memo_id_tip = '" . $mysqli->real_escape_string(trim($csv_data['MEMO_ID_TIP'] ?? '')) . "',
                    memo_kodu = '" . $mysqli->real_escape_string(trim($csv_data['MEMO_KODU'] ?? '')) . "',
                    memo_kapanis_tarihi = " . ($memo_kapanis_tarihi ? "'$memo_kapanis_tarihi'" : "NULL") . ",
                    memo_yonlenen_bayi_kodu = '" . $mysqli->real_escape_string(trim($csv_data['MEMO_YONLENEN_BAYI_KODU'] ?? '')) . "',
                    memo_yonlenen_bayi_adi = '" . $mysqli->real_escape_string(trim($csv_data['MEMO_YONLENEN_BAYI_ADI'] ?? '')) . "',
                    memo_yonlenen_bayi_yoneticisi = '" . $mysqli->real_escape_string(trim($csv_data['MEMO_YONLENEN_BAYI_YONETICISI'] ?? '')) . "',
                    memo_yonlenen_bayi_bolge = '" . $mysqli->real_escape_string(trim($csv_data['MEMO_YONLENEN_BAYI_BOLGE'] ?? '')) . "',
                    memo_yonlenen_bayi_teknik_yntc = '" . $mysqli->real_escape_string(trim($csv_data['MEMO_YONLENEN_BAYI_TEKNIK_YNTC'] ?? '')) . "',
                    talep_giris_tarihi = " . ($talep_giris_tarihi ? "'$talep_giris_tarihi'" : "NULL") . ",
                    talebi_giren_bayi_kodu = '" . $mysqli->real_escape_string(trim($csv_data['TALEBI_GIREN_BAYI_KODU'] ?? '')) . "',
                    talebi_giren_bayi_adi = '" . $mysqli->real_escape_string(trim($csv_data['TALEBI_GIREN_BAYI_ADI'] ?? '')) . "',
                    talebi_giren_personel = '" . $mysqli->real_escape_string(trim($csv_data['TALEBI_GIREN_PERSONEL'] ?? '')) . "',
                    talebi_giren_personelno = '" . $mysqli->real_escape_string(trim($csv_data['TALEBI_GIREN_PERSONELNO'] ?? '')) . "',
                    talebi_giren_personelkodu = '" . $mysqli->real_escape_string(trim($csv_data['TALEBI_GIREN_PERSONELKODU'] ?? '')) . "',
                    talebi_giren_personel_altbayi = '" . $mysqli->real_escape_string(trim($csv_data['TALEBI_GIREN_PERSONEL_ALTBAYI'] ?? '')) . "',
                    talep_kaynak = '" . $mysqli->real_escape_string(trim($csv_data['TALEP_KAYNAK'] ?? '')) . "',
                    satis_durumu = '" . $mysqli->real_escape_string(trim($csv_data['SATIS_DURUMU'] ?? '')) . "',
                    internet_surec_durumu = '" . $mysqli->real_escape_string(trim($csv_data['INTERNET_SUREC_DURUMU'] ?? '')) . "',
                    aktive_edilen_uyeno = '" . $mysqli->real_escape_string(trim($csv_data['AKTIVE_EDILEN_UYENO'] ?? '')) . "',
                    aktive_edilen_outletno = '" . $mysqli->real_escape_string(trim($csv_data['AKTIVE_EDILEN_OUTLETNO'] ?? '')) . "',
                    aktive_edilen_sozlesmeno = '" . $mysqli->real_escape_string(trim($csv_data['AKTIVE_EDILEN_SOZLESMENO'] ?? '')) . "',
                    aktive_edilen_sozlesmekmp = '" . $mysqli->real_escape_string(trim($csv_data['AKTIVE_EDILEN_SOZLESMEKMP'] ?? '')) . "',
                    aktive_edilen_sozlesmedurum = '" . $mysqli->real_escape_string(trim($csv_data['AKTIVE_EDILEN_SOZLESMEDURUM'] ?? '')) . "',
                    talep_takip_notu = '" . $mysqli->real_escape_string(trim($csv_data['TALEP_TAKIP_NOTU'] ?? '')) . "',
                    guncel_outlet_durum = '" . $mysqli->real_escape_string(trim($csv_data['GUNCEL_OUTLET_DURUM'] ?? '')) . "',
                    teyit_durum = '" . $mysqli->real_escape_string(trim($csv_data['TEYIT_DURUM'] ?? '')) . "',
                    teyit_arama_durum = '" . $mysqli->real_escape_string(trim($csv_data['TEYIT_ARAMA_DURUM'] ?? '')) . "',
                    randevu_tarihi = " . ($randevu_tarihi ? "'$randevu_tarihi'" : "NULL") . ",
                    memo_son_durum = '" . $mysqli->real_escape_string(trim($csv_data['MEMO_SON_DURUM'] ?? '')) . "',
                    memo_son_cevap = '" . $mysqli->real_escape_string(trim($csv_data['MEMO_SON_CEVAP'] ?? '')) . "',
                    memo_son_aciklama = '" . $mysqli->real_escape_string(trim($csv_data['MEMO_SON_ACIKLAMA'] ?? '')) . "',
                    guncelleme_tarihi = NOW()
                    WHERE memo_id = '" . $mysqli->real_escape_string($memo_id) . "'";
                
                if ($mysqli->query($update_sql)) {
                    $updated++;
                } else {
                    $failed++;
                }
            } else {
                // Yeni kayıt ekle
                $batch_data[] = $insert_values;
            }
        } else {
            // memo_id boş ise direkt ekle
            $batch_data[] = $insert_values;
        }
        
        // Batch boyutuna ulaştığında işle
        if (count($batch_data) >= $batch_size) {
            $sql = "INSERT INTO voip_iris_rapor (talep_id, talep_turu, uydu_basvuru_potansiyel_no, uydu_basvuru_uye_no, dt_musteri_no, memo_id, memo_kayit_tipi, memo_id_tip, memo_kodu, memo_kapanis_tarihi, memo_yonlenen_bayi_kodu, memo_yonlenen_bayi_adi, memo_yonlenen_bayi_yoneticisi, memo_yonlenen_bayi_bolge, memo_yonlenen_bayi_teknik_yntc, talep_giris_tarihi, talebi_giren_bayi_kodu, talebi_giren_bayi_adi, talebi_giren_personel, talebi_giren_personelno, talebi_giren_personelkodu, talebi_giren_personel_altbayi, talep_kaynak, satis_durumu, internet_surec_durumu, aktive_edilen_uyeno, aktive_edilen_outletno, aktive_edilen_sozlesmeno, aktive_edilen_sozlesmekmp, aktive_edilen_sozlesmedurum, talep_takip_notu, guncel_outlet_durum, teyit_durum, teyit_arama_durum, randevu_tarihi, memo_son_durum, memo_son_cevap, memo_son_aciklama, kayit_tarihi) VALUES " . implode(',', $batch_data);
            
            if ($mysqli->query($sql)) {
                $processed += count($batch_data);
            } else {
                $failed += count($batch_data);
            }
            
            $batch_data = [];
            
            echo "<script>updateProgress('İşlendi: " . number_format($processed) . " yeni, " . number_format($updated) . " güncelleme');</script>";
            flush();
        }
    }
    
    // Kalan kayıtları işle
    if (!empty($batch_data)) {
        $sql = "INSERT INTO voip_iris_rapor (talep_id, talep_turu, uydu_basvuru_potansiyel_no, uydu_basvuru_uye_no, dt_musteri_no, memo_id, memo_kayit_tipi, memo_id_tip, memo_kodu, memo_kapanis_tarihi, memo_yonlenen_bayi_kodu, memo_yonlenen_bayi_adi, memo_yonlenen_bayi_yoneticisi, memo_yonlenen_bayi_bolge, memo_yonlenen_bayi_teknik_yntc, talep_giris_tarihi, talebi_giren_bayi_kodu, talebi_giren_bayi_adi, talebi_giren_personel, talebi_giren_personelno, talebi_giren_personelkodu, talebi_giren_personel_altbayi, talep_kaynak, satis_durumu, internet_surec_durumu, aktive_edilen_uyeno, aktive_edilen_outletno, aktive_edilen_sozlesmeno, aktive_edilen_sozlesmekmp, aktive_edilen_sozlesmedurum, talep_takip_notu, guncel_outlet_durum, teyit_durum, teyit_arama_durum, randevu_tarihi, memo_son_durum, memo_son_cevap, memo_son_aciklama, kayit_tarihi) VALUES " . implode(',', $batch_data);
        
        if ($mysqli->query($sql)) {
            $processed += count($batch_data);
        } else {
            $failed += count($batch_data);
        }
    }
    
    fclose($handle);
    
    echo "<script>updateProgress('Tamamlandı!');</script>";
    echo "<div style='color: green; font-size: 18px; margin-top: 20px;'>";
    echo "✅ İşlem tamamlandı!<br>";
    if ($processed > 0) {
        echo "📊 Yeni eklenen: " . number_format($processed) . " kayıt<br>";
    }
    if ($updated > 0) {
        echo "🔄 Güncellenen: " . number_format($updated) . " kayıt<br>";
    }
    $total_successful = $processed + $updated;
    echo "📈 Toplam başarılı: " . number_format($total_successful) . " kayıt<br>";
    if ($failed > 0) {
        echo "❌ Başarısız: " . number_format($failed) . " kayıt<br>";
    }
    echo "</div>";
    
    echo "<div style='margin-top: 20px;'>";
    echo "<a href='/voip/hakedis-iris-rapor' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Raporu Görüntüle</a>";
    echo "</div>";
    
    $mysqli->close();
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Direkt CSV İşleme</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .info { background: #e7f3ff; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .warning { background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .btn { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h2>🚀 Direkt CSV İşleme (Alternatif Yöntem)</h2>
    
    <div class="info">
        <strong>ℹ️ Bu yöntem hakkında:</strong><br>
        • CSV dosyasını upload etmek yerine direkt sunucuda işler<br>
        • Büyük dosyalar için ideal (25MB+ dosyalar)<br>
        • Upload limitleri problemi yaşanmaz<br>
        • <strong>Türkçe karakter desteği otomatik</strong><br>
        • <strong>🎯 Akıllı Güncelleme:</strong> MEMO_ID değeri tabloda mevcutsa günceller, yoksa yeni kayıt ekler
    </div>
    
    <?php if (!empty($available_files)): ?>
        <div class="info">
            <h3>📋 Mevcut CSV Dosyaları</h3>
            <form method="get" style="margin: 10px 0;">
                <select name="selected_file" onchange="this.form.submit()" style="padding: 8px; width: 100%; max-width: 500px;">
                    <?php foreach ($available_files as $file): ?>
                        <option value="<?= htmlspecialchars($file['path']) ?>" <?= ($file['path'] == $csv_file) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($file['name']) ?> 
                            (<?= round($file['size']/1024/1024, 2) ?> MB - <?= date('d.m.Y H:i', $file['date']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
    <?php endif; ?>
    
    <?php if (file_exists($csv_file)): ?>
        <div class="info">
            ✅ Seçili dosya: <strong><?= basename($csv_file) ?></strong><br>
            📁 Boyut: <strong><?= round(filesize($csv_file)/1024/1024, 2) ?> MB</strong><br>
            📊 Tahmini süre: <strong><?= round(filesize($csv_file)/1024/1024*0.15, 1) ?> dakika</strong>
        </div>
        
        <form method="post">
            <button type="submit" name="process_file" class="btn" onclick="this.style.display='none'; document.getElementById('warning').style.display='block';">
                🚀 Seçili CSV Dosyasını İşle
            </button>
        </form>
        
        <div id="warning" class="warning" style="display: none;">
            ⚠️ <strong>İşlem başlatıldı!</strong> Lütfen sayfayı kapatmayın ve bekleyin...
        </div>
        
    <?php else: ?>
        <div class="warning">
            ❌ CSV dosyası bulunamadı: <strong><?= $csv_file ?></strong><br>
            Dosyayı doğru konuma yerleştirin ve tekrar deneyin.
        </div>
    <?php endif; ?>
    
    <hr>
    <div style="margin-top: 20px;">
        <a href="/voip/hakedis-iris-rapor" style="color: #007bff;">← Ana Upload Sayfasına Dön</a>
    </div>
</body>
</html>
