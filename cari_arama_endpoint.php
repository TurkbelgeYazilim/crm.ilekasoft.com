<?php
/**
 * Cari Arama Endpoint
 * Tam Ana Rapor sayfası için cari arama işlevselliği
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
    // Get CodeIgniter instance
    $CI =& get_instance();
    $CI->load->database();

    // Get search term
    $search_term = isset($_GET['term']) ? trim($_GET['term']) : '';
    $search_term = isset($_POST['term']) ? trim($_POST['term']) : $search_term;

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

    // SQL injection koruması
    $search_term_escaped = $CI->db->escape_like_str($search_term);

    // Cari arama sorgusu - belirtilen alanlarında arama yap
    $query = "
        SELECT DISTINCT
            c.cari_id,
            c.cari_ad,
            c.cari_soyad,
            c.cari_vergiNumarasi,
            c.cari_firmaTelefon,
            c.cari_tckn,
            CASE 
                WHEN c.cari_bireysel = 0 OR c.cari_soyad IS NULL OR c.cari_soyad = '' 
                THEN c.cari_ad 
                ELSE CONCAT(c.cari_ad, ' ', c.cari_soyad)
            END as label,
            CASE 
                WHEN c.cari_bireysel = 0 OR c.cari_soyad IS NULL OR c.cari_soyad = '' 
                THEN c.cari_ad 
                ELSE CONCAT(c.cari_ad, ' ', c.cari_soyad)
            END as value
        FROM cari c
        WHERE c.cari_durum = 1 
        AND (
            c.cari_ad LIKE '%{$search_term_escaped}%' OR 
            c.cari_soyad LIKE '%{$search_term_escaped}%' OR 
            c.cari_vergiNumarasi LIKE '%{$search_term_escaped}%' OR 
            c.cari_firmaTelefon LIKE '%{$search_term_escaped}%' OR 
            c.cari_tckn LIKE '%{$search_term_escaped}%'
        )
        ORDER BY 
            CASE 
                WHEN c.cari_ad LIKE '{$search_term_escaped}%' THEN 1
                WHEN c.cari_soyad LIKE '{$search_term_escaped}%' THEN 2
                ELSE 3
            END,
            c.cari_ad, c.cari_soyad
        LIMIT 20
    ";

    $results = $CI->db->query($query)->result();

    // Sonuçları formatla
    $formatted_results = [];
    foreach ($results as $row) {
        $detail_info = [];
        
        if (!empty($row->cari_vergiNumarasi)) {
            $detail_info[] = "VN: " . $row->cari_vergiNumarasi;
        }
        
        if (!empty($row->cari_tckn)) {
            $detail_info[] = "TC: " . $row->cari_tckn;
        }
        
        if (!empty($row->cari_firmaTelefon)) {
            $detail_info[] = "Tel: " . $row->cari_firmaTelefon;
        }
        
        $detail_text = !empty($detail_info) ? " (" . implode(", ", $detail_info) . ")" : "";
        
        $formatted_results[] = [
            'id' => $row->cari_id,
            'label' => $row->label . $detail_text,
            'value' => $row->value,
            'cari_ad' => $row->cari_ad,
            'cari_soyad' => $row->cari_soyad,
            'cari_vergiNumarasi' => $row->cari_vergiNumarasi,
            'cari_firmaTelefon' => $row->cari_firmaTelefon,
            'cari_tckn' => $row->cari_tckn
        ];
    }

    // JSON response
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
