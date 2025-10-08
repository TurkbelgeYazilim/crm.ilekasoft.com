<?php
/**
 * CRM Günlük Rapor Cron Job
 * Bu dosya cPanel'de cron job olarak her gün saat 09:00'da çalıştırılacak
 * Önceki günün verilerini içeren raporu gönderir
 * 
 * CRON JOB KURULUM TALİMATLARI:
 * 1. cPanel > Cron Jobs bölümüne gidin
 * 2. Yeni cron job ekleyin:
 *    - Dakika: 0
 *    - Saat: 9  
 *    - Gün: *
 *    - Ay: *
 *    - Haftanın günü: *
 *    - Komut: /usr/local/bin/php /home/turkbelg/public_html/crm/gunluk_rapor_cron.php
 * 
 * YA DA tek satırda:
 * 0 9 * * * /usr/local/bin/php /home/turkbelg/public_html/crm/gunluk_rapor_cron.php
 */

// Hata raporlamasını aç
error_reporting(E_ALL);
ini_set('display_errors', 1);

// OpCache temizleme
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "OpCache temizlendi" . PHP_EOL;
}

// Zaman damgası
echo "=== CRM Günlük Rapor Cron Job ===" . PHP_EOL;
echo "Başlangıç: " . date('Y-m-d H:i:s') . PHP_EOL;
$_SERVER['SCRIPT_NAME'] = '/index.php';

// CodeIgniter'ı yükle
try {    // CRM sistemine HTTP çağrısı yap
    $url = 'https://crm.ilekasoft.com/rapor/gunluk_rapor';
    
    echo "URL çağrılıyor: $url" . PHP_EOL;
    
    // cURL ile rapor endpoint'ini çağır
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 300); // 5 dakika timeout
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'CRM Cron Job 1.0');
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        throw new Exception("cURL hatası: $error");
    }
    
    if ($http_code !== 200) {
        throw new Exception("HTTP hatası: $http_code");
    }
    echo "✓ HTTP çağrısı başarılı (HTTP $http_code)" . PHP_EOL;
    echo "Yanıt uzunluğu: " . strlen($response) . " karakter" . PHP_EOL;
    echo "Yanıt içeriği (tamamı):" . PHP_EOL;
    echo "=================" . PHP_EOL;
    echo $response . PHP_EOL;
    echo "=================" . PHP_EOL;
    
} catch (Exception $e) {
    echo "✗ HATA: " . $e->getMessage() . PHP_EOL;
    error_log("CRM Günlük Rapor Cron Hatası: " . $e->getMessage());
}

echo "Bitiş zamanı: " . date('Y-m-d H:i:s') . PHP_EOL;
echo "=================================" . PHP_EOL;
?>