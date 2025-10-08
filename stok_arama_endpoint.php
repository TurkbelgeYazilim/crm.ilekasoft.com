<?php
/**
 * Stok Arama Endpoint 
 * Tam Ana Rapor sayfası için stok arama işlevselliği
 */

// CodeIgniter framework yükle
require_once('index.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

try {
    // Debug için log
    error_log("Stok Arama Endpoint - Request: " . print_r($_REQUEST, true));
    
    // Get CodeIgniter instance
    $CI =& get_instance();
    $CI->load->database();

    // Get search term
    $search_term = isset($_GET['term']) ? trim($_GET['term']) : '';
    $search_term = isset($_POST['term']) ? trim($_POST['term']) : $search_term;
    
    error_log("Stok Arama Endpoint - Search term: " . $search_term);

    if (empty($search_term)) {
        echo json_encode([
            'success' => false,
            'message' => 'Arama terimi gerekli'
        ]);
        exit;
    }

    // Minimum 2 karakter kontrolü
    if (strlen($search_term) < 2) {
        echo json_encode([
            'success' => false,
            'message' => 'En az 2 karakter gerekli'
        ]);
        exit;
    }

    // Ana hesap bilgisini al
    $anaHesap = anaHesapBilgisi();
    if (!$anaHesap) {
        echo json_encode([
            'success' => false,
            'message' => 'Oturum geçersiz'
        ]);
        exit;
    }

    // SQL injection koruması
    $search_term_escaped = $CI->db->escape_like_str($search_term);

    // Stok arama sorgusu
    $query = "
        SELECT 
            stok_id,
            stok_ad,
            stok_kodu,
            stok_satisFiyati,
            stok_satisKDV
        FROM stok 
        WHERE stok_olusturanAnaHesap = ? 
        AND stok_durum = 1
        AND (
            stok_ad LIKE '%{$search_term_escaped}%' 
            OR stok_kodu LIKE '%{$search_term_escaped}%'
        )
        ORDER BY 
            CASE 
                WHEN stok_ad LIKE '{$search_term_escaped}%' THEN 1
                WHEN stok_kodu LIKE '{$search_term_escaped}%' THEN 2
                ELSE 3
            END,
            stok_ad ASC
        LIMIT 20
    ";

    $results = $CI->db->query($query, [$anaHesap])->result();

    // Sonuçları formatla
    $formatted_results = [];
    
    if (empty($results)) {
        // Boş sonuç durumunda da geçerli JSON döndür
        echo json_encode([]);
        exit;
    }
    
    foreach ($results as $row) {
        $formatted_results[] = [
            'id' => $row->stok_id,
            'text' => $row->stok_ad . (!empty($row->stok_kodu) ? ' (' . $row->stok_kodu . ')' : ''),
            'stok_id' => $row->stok_id,
            'stok_kodu' => $row->stok_kodu,
            'stok_ad' => $row->stok_ad,
            'stok_satisFiyati' => $row->stok_satisFiyati,
            'stok_satisKDV' => $row->stok_satisKDV
        ];
    }

    // JSON response döndür
    echo json_encode($formatted_results);

} catch (Exception $e) {
    // Error handling
    echo json_encode([
        'success' => false,
        'message' => 'Arama sırasında hata oluştu: ' . $e->getMessage(),
        'error' => $e->getMessage()
    ]);
}
?>
