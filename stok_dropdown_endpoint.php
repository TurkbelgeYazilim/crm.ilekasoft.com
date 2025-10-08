<?php
/**
 * Stok Dropdown Endpoint 
 * Stok adlarını dropdown için listeler
 */

// Enable error reporting for debugging but not in output
error_reporting(E_ALL);
ini_set('display_errors', 0); // Don't display errors in JSON response
ini_set('log_errors', 1); // Log errors to file instead

// CORS headers
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// OPTIONS request handling
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// CodeIgniter framework yükle - daha güvenli yöntem
define('BASEPATH', __DIR__ . '/system/');
define('ENVIRONMENT', 'production'); // Define ENVIRONMENT constant

// Database config dosyasını dahil et
$db = [];
include(__DIR__ . '/application/config/database.php');

// Database bağlantısı oluştur
try {
    // Debug: Database bilgilerini logla
    file_put_contents(__DIR__ . '/debug_stok_dropdown.log', 
        date('Y-m-d H:i:s') . " - Database config: " . print_r($db['default'], true) . "\n", 
        FILE_APPEND | LOCK_EX);
    
    $connection = new mysqli(
        $db['default']['hostname'],
        $db['default']['username'], 
        $db['default']['password'],
        $db['default']['database']
    );
    
    if ($connection->connect_error) {
        throw new Exception("Database connection failed: " . $connection->connect_error);
    }
    
    $connection->set_charset('utf8');
    
    // Debug: Bağlantı başarılı
    file_put_contents(__DIR__ . '/debug_stok_dropdown.log', 
        date('Y-m-d H:i:s') . " - Database connection successful\n", 
        FILE_APPEND | LOCK_EX);
        
} catch (Exception $e) {
    // Debug: Bağlantı hatası
    file_put_contents(__DIR__ . '/debug_stok_dropdown.log', 
        date('Y-m-d H:i:s') . " - Database connection error: " . $e->getMessage() . "\n", 
        FILE_APPEND | LOCK_EX);
        
    echo json_encode([
        'results' => [
            [
                'id' => '',
                'text' => 'Database bağlantı hatası: ' . $e->getMessage(),
                'disabled' => true
            ]
        ],
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
    exit();
}

try {
    // Debug: İstek başladı
    file_put_contents(__DIR__ . '/debug_stok_dropdown.log', 
        date('Y-m-d H:i:s') . " - Request started - GET: " . print_r($_GET, true) . " POST: " . print_r($_POST, true) . "\n", 
        FILE_APPEND | LOCK_EX);
    
    // Arama terimi al
    $search_term = isset($_GET['q']) ? trim($_GET['q']) : '';
    $search_term = isset($_POST['q']) ? trim($_POST['q']) : $search_term;
    
    // SQL injection koruması için escape
    $search_term = $connection->real_escape_string($search_term);
    
    // Debug: Arama terimi
    file_put_contents(__DIR__ . '/debug_stok_dropdown.log', 
        date('Y-m-d H:i:s') . " - Search term: '{$search_term}'\n", 
        FILE_APPEND | LOCK_EX);

    // Önce stok tablosunun var olup olmadığını kontrol et
    $table_check = $connection->query("SHOW TABLES LIKE 'stok'");
    if ($table_check->num_rows == 0) {
        throw new Exception("Stok tablosu bulunamadı");
    }
    
    // Debug: Tablo kontrolü
    file_put_contents(__DIR__ . '/debug_stok_dropdown.log', 
        date('Y-m-d H:i:s') . " - Stok table exists\n", 
        FILE_APPEND | LOCK_EX);

    // Basit stok sorgusu - tüm aktif stokları getir
    $query = "
        SELECT 
            stok_id,
            stok_ad,
            stok_kodu,
            stok_satisFiyati,
            stok_satisKDV
        FROM stok 
        WHERE stok_durum = 1
        AND (stok_ad IS NOT NULL AND stok_ad != '')
        " . (!empty($search_term) ? "AND (stok_ad LIKE '%{$search_term}%' OR stok_kodu LIKE '%{$search_term}%')" : "") . "
        ORDER BY stok_ad ASC
        LIMIT 50
    ";

    $result = $connection->query($query);
    
    if (!$result) {
        throw new Exception("Query failed: " . $connection->error);
    }
    
    // Debug: Query sonucu
    file_put_contents(__DIR__ . '/debug_stok_dropdown.log', 
        date('Y-m-d H:i:s') . " - Query executed successfully. Rows found: " . $result->num_rows . "\n", 
        FILE_APPEND | LOCK_EX);
    
    $results = [];
    while ($row = $result->fetch_object()) {
        $results[] = $row;
    }
    
    // Debug: Results
    file_put_contents(__DIR__ . '/debug_stok_dropdown.log', 
        date('Y-m-d H:i:s') . " - Results count: " . count($results) . "\n", 
        FILE_APPEND | LOCK_EX);

    // Select2 formatına uygun sonuçları hazırla
    $formatted_results = [];
    
    // Boş seçenek ekle (sadece arama terimi yoksa)
    if (empty($search_term)) {
        $formatted_results[] = [
            'id' => '',
            'text' => 'Stok seçiniz...',
            'stok_data' => null
        ];
    }

    foreach ($results as $row) {
        // Stok adı boşsa atla
        if (empty($row->stok_ad)) {
            continue;
        }
        
        $display_text = $row->stok_ad;
        if (!empty($row->stok_kodu)) {
            $display_text .= " (Kod: {$row->stok_kodu})";
        }
        if (!empty($row->stok_satisFiyati) && $row->stok_satisFiyati > 0) {
            $display_text .= " - " . number_format($row->stok_satisFiyati, 2) . " ₺";
        }
        
        $formatted_results[] = [
            'id' => $row->stok_id,
            'text' => $display_text,
            'stok_data' => [
                'stok_id' => $row->stok_id,
                'stok_kodu' => $row->stok_kodu ?? '',
                'stok_ad' => $row->stok_ad,
                'stok_satisFiyati' => floatval($row->stok_satisFiyati ?? 0),
                'stok_satisKDV' => floatval($row->stok_satisKDV ?? 20)
            ]
        ];
    }

    // Hiç sonuç yoksa mesaj göster
    if (count($formatted_results) <= 1) { // 1 çünkü boş seçenek var
        if (!empty($search_term)) {
            $formatted_results = [
                [
                    'id' => '',
                    'text' => "'{$search_term}' için sonuç bulunamadı",
                    'disabled' => true
                ]
            ];
        } else {
            $formatted_results = [
                [
                    'id' => '',
                    'text' => 'Aktif stok bulunamadı',
                    'disabled' => true
                ]
            ];
        }
    }

    // Select2 yanıt formatı
    $response = [
        'results' => $formatted_results,
        'pagination' => [
            'more' => count($results) >= 50
        ]
    ];
    
    // Debug: Final response
    file_put_contents(__DIR__ . '/debug_stok_dropdown.log', 
        date('Y-m-d H:i:s') . " - Final response: " . json_encode($response, JSON_UNESCAPED_UNICODE) . "\n", 
        FILE_APPEND | LOCK_EX);
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
    // Connection kapat
    $connection->close();

} catch (Exception $e) {
    // Connection kapat (hata durumunda da)
    if (isset($connection)) {
        $connection->close();
    }
    
    // Hata işleme
    echo json_encode([
        'results' => [
            [
                'id' => '',
                'text' => 'Hata: ' . $e->getMessage(),
                'disabled' => true
            ]
        ],
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>
