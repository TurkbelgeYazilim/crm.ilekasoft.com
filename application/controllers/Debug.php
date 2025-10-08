<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debug extends CI_Controller {
	
	public function index(){
		// Basit test sayfası
		echo "<!DOCTYPE html>";
		echo "<html>";
		echo "<head><title>Debug Test</title></head>";
		echo "<body>";
		echo "<h1>Site Çalışıyor</h1>";
		echo "<p>Tarih: " . date('Y-m-d H:i:s') . "</p>";
		echo "<p>PHP Version: " . phpversion() . "</p>";
		echo "<p>CodeIgniter Version: " . CI_VERSION . "</p>";
		echo "<p>Base URL: " . base_url() . "</p>";
		echo "<p>Current URL: " . current_url() . "</p>";
		echo "<h2>Server Info:</h2>";
		echo "<pre>";
		print_r($_SERVER);
		echo "</pre>";
		echo "</body>";
		echo "</html>";
	}
	
	public function test(){
		echo json_encode(array(
			'status' => 'OK',
			'timestamp' => date('Y-m-d H:i:s'),
			'message' => 'API Endpoint Çalışıyor'
		));
	}
	
	public function phpinfo(){
		phpinfo();
	}
	
	/**
	 * VoIP Debug Sayfası
	 */
	public function voip(){
		$data["baslik"] = "VoIP Debug";
		
		echo "<!DOCTYPE html>";
		echo "<html><head><title>VoIP Debug</title></head><body>";
		echo "<h1>VoIP Debug Bilgileri</h1>";
		
		echo "<h2>1. Base URL Test</h2>";
		echo "<p>Base URL: " . base_url() . "</p>";
		echo "<p>VoIP Operator Ekle URL: " . base_url("voip/operator_ekle") . "</p>";
		
		echo "<h2>2. Session Kontrol</h2>";
		$control = session("r", "login_info");
		if($control) {
			echo "<p style='color: green;'>✓ Session aktif</p>";
			echo "<p>Kullanıcı ID: " . session("kullanici_id") . "</p>";
			echo "<p>Kullanıcı Grup: " . session("kullanici_grubu_id") . "</p>";
		} else {
			echo "<p style='color: red;'>✗ Session bulunamadı</p>";
		}
		
		echo "<h2>3. Yetki Kontrol</h2>";
		$this->load->helper('genel');
		if(function_exists('grup_modul_yetkisi_var')) {
			$yetki1900 = grup_modul_yetkisi_var(1900);
			$yetki1901 = grup_modul_yetkisi_var(1901);
			echo "<p>Modül 1900 (VoIP & Hakediş): " . ($yetki1900 ? '✓' : '✗') . "</p>";
			echo "<p>Modül 1901 (VoIP Numara Tanımla): " . ($yetki1901 ? '✓' : '✗') . "</p>";
		} else {
			echo "<p style='color: red;'>✗ grup_modul_yetkisi_var fonksiyonu bulunamadı</p>";
		}
		
		echo "<h2>4. Veritabanı Tabloları</h2>";
		$tables = ['voip_operator', 'voip_operator_panel', 'voip_numara', 'voip_numara_teslim'];
		foreach($tables as $table) {
			$exists = $this->db->table_exists($table);
			echo "<p>Tablo {$table}: " . ($exists ? '✓' : '✗') . "</p>";
			
			if($exists) {
				$count = $this->db->count_all($table);
				echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;Kayıt sayısı: {$count}</p>";
			}
		}
		
		echo "<h2>5. Controller Method Test</h2>";
		if(method_exists('Voip', 'operator_ekle')) {
			echo "<p>✓ Voip::operator_ekle method mevcut</p>";
		} else {
			echo "<p>✗ Voip::operator_ekle method bulunamadı</p>";
		}
		
		echo "<h2>6. Route Kontrol</h2>";
		$routes = $this->router->routes;
		$voip_routes = array_filter($routes, function($key) {
			return strpos($key, 'voip') !== false;
		}, ARRAY_FILTER_USE_KEY);
		
		if(!empty($voip_routes)) {
			echo "<p>✓ VoIP route'ları bulundu:</p>";
			foreach($voip_routes as $route => $target) {
				echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;{$route} => {$target}</p>";
			}
		} else {
			echo "<p>✗ VoIP route'ları bulunamadı</p>";
		}
		
		echo "<h2>7. AJAX Test</h2>";
		echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>";
		echo "<button onclick='testAjax()'>AJAX Test Et</button>";
		echo "<div id='ajax-result'></div>";
		
		echo "<script>";
		echo "function testAjax() {";
		echo "  $.ajax({";
		echo "    url: '" . base_url("voip/operator_ekle") . "',";
		echo "    type: 'POST',";
		echo "    data: {operator_adi: 'Test Operatör', aciklama: 'Test'},";
		echo "    dataType: 'json',";
		echo "    success: function(response) {";
		echo "      $('#ajax-result').html('<p style=\"color: green;\">AJAX Başarılı: ' + JSON.stringify(response) + '</p>');";
		echo "    },";
		echo "    error: function(xhr, status, error) {";
		echo "      $('#ajax-result').html('<p style=\"color: red;\">AJAX Hata: ' + xhr.status + ' - ' + error + '</p><pre>' + xhr.responseText + '</pre>');";
		echo "    }";
		echo "  });";
		echo "}";
		echo "</script>";
		
		echo "</body></html>";
	}
	
	public function tables() {
		echo "<!DOCTYPE html>";
		echo "<html>";
		echo "<head><title>Tablo Debug Bilgileri</title></head>";
		echo "<body>";
		echo "<h2>Tablo Debug Bilgileri</h2>";
		
		// 1. Aktivasyon tablosu var mı?
		echo "<h3>1. Aktivasyon Tablosu</h3>";
		try {
			$query = $this->db->query("SHOW TABLES LIKE 'aktivasyon'");
			if($query->num_rows() > 0) {
				echo "✅ aktivasyon tablosu mevcut<br>";
				
				// Kayıt sayısı
				$count_query = $this->db->query("SELECT COUNT(*) as count FROM aktivasyon");
				$count = $count_query->row();
				echo "<strong>Toplam kayıt:</strong> " . $count->count . "<br>";
				
				// Sütunları göster
				$desc_query = $this->db->query("DESCRIBE aktivasyon");
				echo "<strong>Sütunlar:</strong><br>";
				foreach($desc_query->result() as $column) {
					echo "- " . $column->Field . " (" . $column->Type . ")<br>";
				}
				
			} else {
				echo "❌ aktivasyon tablosu bulunamadı<br>";
			}
		} catch(Exception $e) {
			echo "❌ Aktivasyon tablosu hatası: " . $e->getMessage() . "<br>";
		}
		
		// 2. SatisFaturasi tablosu
		echo "<h3>2. SatisFaturasi Tablosu</h3>";
		try {
			$count_query = $this->db->query("SELECT COUNT(*) as count FROM satisFaturasi");
			$count = $count_query->row();
			echo "✅ Toplam satış kaydı: " . $count->count . "<br>";
			
			// 2025 yılında kayıt var mı?
			$count2025_query = $this->db->query("SELECT COUNT(*) as count FROM satisFaturasi WHERE satis_olusturmaTarihi >= '2025-01-01'");
			$count2025 = $count2025_query->row();
			echo "📅 2025 yılında kayıt: " . $count2025->count . "<br>";
			
			// En son kayıt tarihi
			$max_date_query = $this->db->query("SELECT MAX(satis_olusturmaTarihi) as max_date FROM satisFaturasi");
			$max_date = $max_date_query->row();
			echo "📆 En son kayıt tarihi: " . ($max_date->max_date ?? 'N/A') . "<br>";
			
			// En eski kayıt tarihi
			$min_date_query = $this->db->query("SELECT MIN(satis_olusturmaTarihi) as min_date FROM satisFaturasi");
			$min_date = $min_date_query->row();
			echo "📆 En eski kayıt tarihi: " . ($min_date->min_date ?? 'N/A') . "<br>";
			
		} catch(Exception $e) {
			echo "❌ SatisFaturasi tablosu hatası: " . $e->getMessage() . "<br>";
		}
		
		// 3. Kullanicilar tablosu
		echo "<h3>3. Kullanicilar Tablosu</h3>";
		try {
			$count_query = $this->db->query("SELECT COUNT(*) as count FROM kullanicilar WHERE kullanici_durum = 1");
			$count = $count_query->row();
			echo "✅ Aktif kullanıcı: " . $count->count . "<br>";
			
		} catch(Exception $e) {
			echo "❌ Kullanicilar tablosu hatası: " . $e->getMessage() . "<br>";
		}
		
		// 4. JOIN testleri
		echo "<h3>4. JOIN Testleri</h3>";
		
		// Aktivasyonlu JOIN
		try {
			$join_query = $this->db->query("
				SELECT COUNT(*) as count 
				FROM aktivasyon a
				JOIN satisFaturasi sf ON a.aktivasyon_cari_id = sf.satis_cariID
				JOIN kullanicilar k ON sf.satis_olusturan = k.kullanici_id
				WHERE sf.satis_olusturmaTarihi >= '2024-01-01'
			");
			$join_count = $join_query->row();
			echo "🔗 Aktivasyon JOIN sonucu (2024+): " . $join_count->count . "<br>";
			
		} catch(Exception $e) {
			echo "❌ Aktivasyon JOIN hatası: " . $e->getMessage() . "<br>";
		}
		
		// Aktivasyonsuz JOIN
		try {
			$join2_query = $this->db->query("
				SELECT COUNT(*) as count 
				FROM satisFaturasi sf
				JOIN kullanicilar k ON sf.satis_olusturan = k.kullanici_id
				WHERE sf.satis_olusturmaTarihi >= '2024-01-01'
			");
			$join2_count = $join2_query->row();
			echo "🔗 Aktivasyonsuz JOIN sonucu (2024+): " . $join2_count->count . "<br>";
			
		} catch(Exception $e) {
			echo "❌ Aktivasyonsuz JOIN hatası: " . $e->getMessage() . "<br>";
		}
		
		// 5. Cari-şehir bilgisi
		echo "<h3>5. Cari-Şehir Bilgisi</h3>";
		try {
			$count_query = $this->db->query("SELECT COUNT(*) as count FROM cari WHERE cari_il IS NOT NULL AND cari_il != 0");
			$count = $count_query->row();
			echo "🏙️ Şehir bilgisi olan cari: " . $count->count . "<br>";
			
			// Şehirli cari JOIN testi
			$sehir_join_query = $this->db->query("
				SELECT COUNT(*) as count 
				FROM satisFaturasi sf
				JOIN cari c ON sf.satis_cariID = c.cari_id
				LEFT JOIN iller i ON c.cari_il = i.id
				WHERE sf.satis_olusturmaTarihi >= '2024-01-01'
				AND c.cari_il IS NOT NULL AND c.cari_il != 0
			");
			$sehir_join_count = $sehir_join_query->row();
			echo "🏙️ Şehir JOIN sonucu (2024+): " . $sehir_join_count->count . "<br>";
			
		} catch(Exception $e) {
			echo "❌ Cari-Şehir hatası: " . $e->getMessage() . "<br>";
		}
		
		echo "</body>";
		echo "</html>";
	}
}
?>
