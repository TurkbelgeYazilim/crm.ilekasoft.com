<?php
// Debug için basit test sayfası
// Bu dosyayı test ettikten sonra silebilirsiniz

defined('BASEPATH') OR exit('No direct script access allowed');

echo "<h1>Hakediş Bayi Hesapla - Debug Test</h1>";

// Include dosyalarının varlığını kontrol et
$includes = [
    'head-tags' => APPPATH . 'views/include/head-tags.php',
    'sidebar' => APPPATH . 'views/include/sidebar.php', 
    'header' => APPPATH . 'views/include/header.php',
    'footer-js' => APPPATH . 'views/include/footer-js.php'
];

echo "<h3>Include Dosya Kontrolleri:</h3>";
foreach($includes as $name => $path) {
    $status = file_exists($path) ? "✅ Mevcut" : "❌ Bulunamadı";
    echo "<p><strong>{$name}:</strong> {$status} - {$path}</p>";
}

// Veritabanı bağlantısını kontrol et
echo "<h3>Veritabanı Kontrolleri:</h3>";
try {
    $this->load->database();
    
    // voip_iris_rapor tablosunu kontrol et
    if ($this->db->table_exists('voip_iris_rapor')) {
        echo "<p>✅ voip_iris_rapor tablosu mevcut</p>";
        
        // Tamamlandı statüsündeki kayıt sayısını kontrol et
        $this->db->where('satis_durumu', 'Tamamlandı');
        $count = $this->db->count_all_results('voip_iris_rapor');
        echo "<p>📊 Tamamlandı statüsünde {$count} kayıt var</p>";
        
    } else {
        echo "<p>❌ voip_iris_rapor tablosu bulunamadı</p>";
    }
    
    // Yetki tablosunu kontrol et
    if ($this->db->table_exists('kullanici_grubu_yetkisi')) {
        echo "<p>✅ kullanici_grubu_yetkisi tablosu mevcut</p>";
        
        // 1907 modül yetkisini kontrol et
        $this->db->where('kgy_modul', 1907);
        $yetki_count = $this->db->count_all_results('kullanici_grubu_yetkisi');
        echo "<p>🔑 Modül 1907 için {$yetki_count} yetki kaydı var</p>";
        
    } else {
        echo "<p>❌ kullanici_grubu_yetkisi tablosu bulunamadı</p>";
    }
    
} catch(Exception $e) {
    echo "<p>❌ Veritabanı hatası: " . $e->getMessage() . "</p>";
}

// Session ve yetki kontrolü
echo "<h3>Session ve Yetki Kontrolleri:</h3>";
$control = session("r", "login_info");
if($control) {
    echo "<p>✅ Kullanıcı giriş yapmış</p>";
    echo "<p>👤 Kullanıcı ID: " . $control->kullanici_id . "</p>";
} else {
    echo "<p>❌ Kullanıcı giriş yapmamış</p>";
}

// Helper fonksiyonlarını kontrol et
if(function_exists('grup_modul_yetkisi_var')) {
    echo "<p>✅ grup_modul_yetkisi_var fonksiyonu mevcut</p>";
    
    $yetki_1900 = grup_modul_yetkisi_var(1900);
    $yetki_1907 = grup_modul_yetkisi_var(1907);
    
    echo "<p>🔐 Modül 1900 yetkisi: " . ($yetki_1900 ? "Var" : "Yok") . "</p>";
    echo "<p>🔐 Modül 1907 yetkisi: " . ($yetki_1907 ? "Var" : "Yok") . "</p>";
} else {
    echo "<p>❌ grup_modul_yetkisi_var fonksiyonu bulunamadı</p>";
}

echo "<hr>";
echo "<p><a href='" . base_url('voip/hakedis-bayi-hesapla') . "'>Hakediş Bayi Hesapla Sayfasına Git</a></p>";
echo "<p><em>Bu debug sayfasını test ettikten sonra silebilirsiniz.</em></p>";
?>
