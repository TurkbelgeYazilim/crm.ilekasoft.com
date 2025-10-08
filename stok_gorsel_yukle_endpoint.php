<?php
/**
 * Stok Görsel Yükleme Endpoint
 * Direkt endpoint olarak çalışır
 */

// Enable error reporting for debugging but not in output
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

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

// CodeIgniter framework yükle
define('BASEPATH', __DIR__ . '/system/');
define('ENVIRONMENT', 'production');

// Database config dosyasını dahil et
$db = [];
include(__DIR__ . '/application/config/database.php');

// Database bağlantısı oluştur
try {
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
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database bağlantı hatası: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
    exit();
}

try {
    // Debug log
    file_put_contents(__DIR__ . '/debug_file_upload.log', 
        date('Y-m-d H:i:s') . " - Upload started - POST: " . print_r($_POST, true) . " FILES: " . print_r($_FILES, true) . "\n", 
        FILE_APPEND | LOCK_EX);
    
    $satisStok_id = isset($_POST['satisStok_id']) ? trim($_POST['satisStok_id']) : '';
    $stok_adi = isset($_POST['stok_adi']) ? trim($_POST['stok_adi']) : '';
    
    if (!$satisStok_id) {
        echo json_encode(['success' => false, 'message' => 'Stok ID gerekli']);
        exit();
    }
    
    if (empty($_FILES['stok_gorseller'])) {
        echo json_encode(['success' => false, 'message' => 'Dosya seçilmedi']);
        exit();
    }
    
    // Upload klasörü oluştur
    $upload_path = __DIR__ . '/assets/uploads/stok_gorselleri/';
    if (!is_dir($upload_path)) {
        if (!mkdir($upload_path, 0777, true)) {
            throw new Exception('Upload klasörü oluşturulamadı');
        }
    }
    
    $uploaded_files = [];
    $files = $_FILES['stok_gorseller'];
    
    // Çoklu dosya kontrolü
    if (is_array($files['tmp_name'])) {
        $file_count = count($files['tmp_name']);
        for ($i = 0; $i < $file_count; $i++) {
            if ($files['error'][$i] == UPLOAD_ERR_OK) {
                $tmp_name = $files['tmp_name'][$i];
                $original_name = $files['name'][$i];
                $size = $files['size'][$i];
                
                // Dosya boyutu kontrolü (max 10MB)
                if ($size > 10 * 1024 * 1024) {
                    throw new Exception($original_name . ' dosyası çok büyük (max 10MB)');
                }
                
                // Dosya tipi kontrolü
                $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
                if (!in_array($ext, $allowed_extensions)) {
                    throw new Exception($original_name . ' dosya tipi desteklenmiyor');
                }
                
                // Dosya adını oluştur
                $filename = 'stok_' . $satisStok_id . '_' . uniqid() . '.' . $ext;
                $filepath = $upload_path . $filename;
                
                // Dosyayı yükle
                if (move_uploaded_file($tmp_name, $filepath)) {
                    $uploaded_files[] = $filename;
                    file_put_contents(__DIR__ . '/debug_file_upload.log', 
                        date('Y-m-d H:i:s') . " - File uploaded: " . $filename . "\n", 
                        FILE_APPEND | LOCK_EX);
                } else {
                    throw new Exception($original_name . ' dosyası yüklenemedi');
                }
            }
        }
    } else {
        // Tek dosya
        if ($files['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $files['tmp_name'];
            $original_name = $files['name'];
            $size = $files['size'];
            
            if ($size > 10 * 1024 * 1024) {
                throw new Exception($original_name . ' dosyası çok büyük (max 10MB)');
            }
            
            $ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
            if (!in_array($ext, $allowed_extensions)) {
                throw new Exception($original_name . ' dosya tipi desteklenmiyor');
            }
            
            $filename = 'stok_' . $satisStok_id . '_' . uniqid() . '.' . $ext;
            $filepath = $upload_path . $filename;
            
            if (move_uploaded_file($tmp_name, $filepath)) {
                $uploaded_files[] = $filename;
            } else {
                throw new Exception($original_name . ' dosyası yüklenemedi');
            }
        }
    }
    
    if (empty($uploaded_files)) {
        throw new Exception('Hiçbir dosya yüklenemedi');
    }
    
    // Mevcut görsel listesini al
    $satisStok_id_escaped = $connection->real_escape_string($satisStok_id);
    $query = "SELECT satisStok_gorsel FROM satisstok WHERE satisStok_id = '$satisStok_id_escaped'";
    $result = $connection->query($query);
    
    $current_images = [];
    if ($result && $row = $result->fetch_assoc()) {
        if (!empty($row['satisStok_gorsel'])) {
            $current_images = explode(',', $row['satisStok_gorsel']);
            $current_images = array_filter($current_images);
        }
    }
    
    // Yeni dosyaları ekle
    $all_images = array_merge($current_images, $uploaded_files);
    $image_string = implode(',', $all_images);
    $image_string_escaped = $connection->real_escape_string($image_string);
    
    // Veritabanını güncelle
    $update_query = "UPDATE satisstok SET satisStok_gorsel = '$image_string_escaped' WHERE satisStok_id = '$satisStok_id_escaped'";
    $update_result = $connection->query($update_query);
    
    if (!$update_result) {
        throw new Exception('Veritabanı güncellenemedi: ' . $connection->error);
    }
    
    // Debug log
    file_put_contents(__DIR__ . '/debug_file_upload.log', 
        date('Y-m-d H:i:s') . " - Upload successful - Files: " . print_r($uploaded_files, true) . "\n", 
        FILE_APPEND | LOCK_EX);
    
    echo json_encode([
        'success' => true, 
        'message' => count($uploaded_files) . ' dosya başarıyla yüklendi',
        'uploaded_files' => $uploaded_files
    ], JSON_UNESCAPED_UNICODE);
    
    $connection->close();
    
} catch (Exception $e) {
    if (isset($connection)) {
        $connection->close();
    }
    
    // Debug log
    file_put_contents(__DIR__ . '/debug_file_upload.log', 
        date('Y-m-d H:i:s') . " - Upload error: " . $e->getMessage() . "\n", 
        FILE_APPEND | LOCK_EX);
    
    echo json_encode([
        'success' => false, 
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>
