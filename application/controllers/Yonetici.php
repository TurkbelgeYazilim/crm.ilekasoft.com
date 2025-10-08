<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Yonetici extends CI_Controller {

  public function __construct(){
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');
		
		$control = session("r", "login");


	  if(!$control){
			redirect("check");
		}
	  //sessionKontrolHelper();
	}

	public function kullaniciLoglari(){

		$data["baslik"] = "Yönetici / Kullanıcı Logları";
		$anaHesap = anaHesapBilgisi();

		$islem = $this->input->get('islem');

		$tarihGet = $this->input->get('tarihAraligi');

		$tarihAraligi = explode(' - ', $tarihGet);

		$tarih1 = date('Y-m-d', strtotime($tarihAraligi[0])); //küçük tarih
		$tarih2 = date('Y-m-d', strtotime($tarihAraligi[1])); //büyük tarih

		$urim = $this->uri->segment(2);

		$segment = 2;
		$sayfa = $this->input->get("sayfa");

		$page = $sayfa ? $sayfa : 0;
		$limit = 20;

		if($sayfa){$pagem = ($page-1)*$limit;}
		else{$pagem = 0;/*logekle(51,1);*/}

		if((isset($islem) && !empty($islem)) || (isset($tarihGet) && !empty($tarihGet))){

			if(!empty($islem)){$sorgu1 = "AND log_islemTipi = '$islem'";}
			else{$sorgu1 = "";}


			if(!empty($tarihGet)){$sorgu3 = "AND log_islemTarih BETWEEN '$tarih1' AND '$tarih2'";}
			else{$sorgu3 = "";}

			$countq = "SELECT COUNT(*) as total FROM loglar WHERE log_anaHesap = '$anaHesap'  ".$sorgu1." ".$sorgu3." ";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;

			$sorgu = "SELECT * FROM loglar WHERE log_anaHesap = '$anaHesap'  ".$sorgu1." ".$sorgu3." ORDER BY log_id DESC LIMIT $pagem,$limit";
		}else{
			$countq = "SELECT COUNT(*) as total FROM loglar WHERE log_anaHesap = '$anaHesap'";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;
			$sorgu = "SELECT * FROM loglar WHERE log_anaHesap = '$anaHesap' ORDER BY log_id DESC LIMIT $pagem,$limit";
		}
		$data["count_of_list"] = $count;

		$this->load->library("pagination");

		$config = array();
		$config["base_url"] = base_url() . "/yonetici/$urim";
		$config["total_rows"] = $count;
		$config["per_page"] = $limit;
		$config["uri_segment"] = $segment;
		$config['use_page_numbers'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		$config['query_string_segment'] = 'sayfa';
		$config['num_links'] = 9;

		$config['full_tag_open'] = '<div class="d-flex justify-content-center"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';

		$config['num_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['num_tag_close'] = '</li></span>';

		$config['cur_tag_open'] = '<span class="page-link"><li class="page-item active">';
		$config['cur_tag_close'] = '</li></span>';

		$config['first_link'] = '&laquo;&laquo;';
		$config['first_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['first_tag_close'] = '</li></span>';

		$config['last_link'] = '&raquo;&raquo;';
		$config['last_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['last_tag_close'] = '</li></span>';

		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['prev_tag_close'] = '</li></span>';

		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['next_tag_close'] = '</li></span>';

		$this->pagination->initialize($config);

		$data["links"] = $this->pagination->create_links();
		$data["loglar"] = $this->db->query($sorgu)->result();

		$this->load->view("yonetici/kullanici-loglari",$data);
	}	public function yeniKullaniciEkle(){

		if(gibYetki()==1)
			redirect("home/hata");

		if(isDemoActive() == 1)
			redirect("home/hata");		$data["baslik"] = "Yönetici / Yeni Kullanıcı Ekle";
		$anaHesap = anaHesapBilgisi();
		
		// Kullanıcı gruplarını getir
		$kullaniciGruplariQ = "SELECT * FROM kullanici_grubu WHERE kg_olusturanAnaHesap = '$anaHesap' ORDER BY kg_adi ASC";
		$data["kullaniciGruplari"] = $this->db->query($kullaniciGruplariQ)->result();
		
		// Sorumlu müdür seçimi için tüm kullanıcıları getir
		$tumKullanicilarQ = "SELECT kullanici_id, kullanici_ad, kullanici_soyad FROM kullanicilar WHERE kullanici_sorumluMudur = '$anaHesap' AND kullanici_durum = 1 ORDER BY kullanici_ad ASC, kullanici_soyad ASC";
		$data["tumKullanicilar"] = $this->db->query($tumKullanicilarQ)->result();
		
		// İlleri getir		
		$illerQ = "SELECT * FROM iller ORDER BY il ASC";
		$data["iller"] = $this->db->query($illerQ)->result();
		
		// Ülkeleri getir - Eğer tablo yoksa boş array ata
		$data["ulkeler"] = [];
		
		// Tablo varlığını kontrol et
		if ($this->db->table_exists('ulkeler')) {
			try {
				$ulkelerQ = "SELECT ulke_kodu as country_code, ulke_adi as country_name FROM ulkeler ORDER BY ulke_adi ASC";
				$data["ulkeler"] = $this->db->query($ulkelerQ)->result();
			} catch (Exception $e) {
				// Hata durumunda boş array bırak
				$data["ulkeler"] = [];
			}
		}
				//logekle(48,1);
		$this->load->view("yonetici/kullanici", $data);
	}
	public function kullaniciOlustur(){

		if(gibYetki()==1)
			redirect("home/hata");
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		// Debug log setup
		$debug_log_file = 'debug_kullanici_olustur.log';
		$timestamp = date('Y-m-d H:i:s');
		$log_entry = $timestamp . " [START] Kullanıcı oluşturma işlemi başladı\n";
		file_put_contents($debug_log_file, $log_entry, FILE_APPEND | LOCK_EX);

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');

		$anaHesap = anaHesapBilgisi();

		$sifre = postval("kullanici_sifre");
		$sifreTekrar = postval("kullanici_sifreTekrar");

		$eposta = postval("kullanici_eposta");
		
		$log_entry = $timestamp . " [INFO] Form verileri alındı - Email: $eposta\n";
		file_put_contents($debug_log_file, $log_entry, FILE_APPEND | LOCK_EX);
		
		if($sifre == $sifreTekrar){			$data["kullanici_eposta"] = $eposta;			$data["kullanici_ad"] = postval("kullanici_ad");
			$data["kullanici_soyad"] = postval("kullanici_soyad");
			$data["kullanici_kullaniciAdi"] = postval("kullanici_kullaniciAdi");
			$data["kullanici_sifre"] = md5($sifre);
			$data["grup_id"] = postval("kullanici_grupID"); // Form field adı kullanici_grupID ama database field grup_id
			$data["kullanici_durum"] = postval("kullanici_durum");
			
			// Sorumlu müdür alanı - eğer seçilmişse kullan, yoksa mevcut ana hesabı kullan			$sorumluMudur = postval("kullanici_sorumluMudur");
			$data["kullanici_sorumluMudur"] = !empty($sorumluMudur) ? $sorumluMudur : $anaHesap;
			
			$data["kullanici_olusturmaTarihi"] = $tarihi;
			$data["kullanici_olusturan"] = $u_id;

			$kullaniciEpostaVarmiQ = "SELECT * FROM kullanicilar WHERE kullanici_eposta = '$eposta'";
			$kullaniciEpostaVarmi = $this->db->query($kullaniciEpostaVarmiQ)->row();			if($kullaniciEpostaVarmi){
				$this->session->set_flashdata('kullanici_eposta_mevcut','OK');
				redirect("yonetici/yeni-kullanici-ekle");
			}else{
				$this->vt->insert("kullanicilar",$data);
				$kullanici_idsi = $this->db->insert_id();
				
				// Debug log file setup
				$debug_log_file = 'debug_sorumluluk_bolgesi_olustur.log';
				$timestamp = date('Y-m-d H:i:s');
				
				// Sorumluluk bölgelerini güncelle - sadece checkbox işaretliyse
				$sorumluluk_aktif = postval("sorumluluk_aktif"); // Checkbox durumu
				$log_entry = $timestamp . " [CREATE] Sorumluluk aktif checkbox durumu: " . ($sorumluluk_aktif ? 'CHECKED' : 'NOT_CHECKED') . "\n";
				file_put_contents($debug_log_file, $log_entry, FILE_APPEND | LOCK_EX);
				
				if ($sorumluluk_aktif) {
					// Sorumluluk bölgelerini kaydet
					$sorumlulukBolgeleri = postval("sorumluluk_bolgesi");
					
					// Yeni sorumluluk bölgesi alanlarını al
					$sorumluluk_baslangic_tarihi = postval("sorumluluk_baslangic_tarihi");
					$sorumluluk_bitis_tarihi = postval("sorumluluk_bitis_tarihi");
					$sorumluluk_ulke_id = postval("sorumluluk_ulke_id");
					$sorumluluk_aciklama = postval("sorumluluk_aciklama");
					
					if(!empty($sorumlulukBolgeleri) && is_array($sorumlulukBolgeleri)){
					foreach($sorumlulukBolgeleri as $bolge){
						$bolgeParts = explode('_', $bolge);
						if(count($bolgeParts) == 2){
							$il_id = $bolgeParts[0];
							$ilce_id = $bolgeParts[1];
									// Tablo yapısını kontrol et
							$tableColumns = $this->db->list_fields('kullanici_sorumluluk_bolgesi');
							$hasExtendedColumns = in_array('baslangic_tarihi', $tableColumns) && 
												  in_array('bitis_tarihi', $tableColumns) && 
												  in_array('ulke_id', $tableColumns) && 
												  in_array('aciklama', $tableColumns);
							
							// Temel veriler
							$sorumlulukData = array(
								"kullanici" => $kullanici_idsi,
								"il_id" => $il_id,
								"ilce_id" => $ilce_id,
								"durum" => 1
							);
							
							// Eğer genişletilmiş alanlar varsa ekle
							if ($hasExtendedColumns) {
								$sorumlulukData["baslangic_tarihi"] = !empty($sorumluluk_baslangic_tarihi) ? $sorumluluk_baslangic_tarihi : null;
								$sorumlulukData["bitis_tarihi"] = !empty($sorumluluk_bitis_tarihi) ? $sorumluluk_bitis_tarihi : null;
								$sorumlulukData["ulke_id"] = !empty($sorumluluk_ulke_id) ? $sorumluluk_ulke_id : 'TR';
								$sorumlulukData["aciklama"] = $sorumluluk_aciklama;
								
								// Eğer islemi_yapan ve islem_tarihi alanları da varsa ekle
								if (in_array('islemi_yapan', $tableColumns)) {
									$sorumlulukData["islemi_yapan"] = $u_id;
								}
								if (in_array('islem_tarihi', $tableColumns)) {
									$sorumlulukData["islem_tarihi"] = date('Y-m-d H:i:s');
								}
							}							$this->vt->insert("kullanici_sorumluluk_bolgesi", $sorumlulukData);
							$log_entry = $timestamp . " [CREATE] Sorumluluk bölgesi eklendi: $il_id-$ilce_id\n";
							file_put_contents($debug_log_file, $log_entry, FILE_APPEND | LOCK_EX);
						}
					}
				}
				} else {
					// Checkbox işaretli değilse sorumluluk bölgesi işlemlerini atla
					$log_entry = $timestamp . " [CREATE] Sorumluluk bölgesi checkbox işaretli değil, bu işlemler atlanıyor\n";
					file_put_contents($debug_log_file, $log_entry, FILE_APPEND | LOCK_EX);
				} // Sorumluluk aktif checkbox kontrolü sonu
				
				// Kullanıcı başarıyla oluşturulduktan sonra otomatik varsayılan kasa oluştur
				$this->otomatikKasaOlustur($kullanici_idsi, $u_id, $anaHesap, $tarihi);
						$this->session->set_flashdata('kullanici_ok','OK');
				logekle(48,2);
				redirect("yonetici/mevcut-kullanici-duzenle/$kullanici_idsi");
			}
		}else{
			$log_entry = $timestamp . " [ERROR] Şifreler uyuşmuyor\n";
			file_put_contents($debug_log_file, $log_entry, FILE_APPEND | LOCK_EX);
			$this->session->set_flashdata('kullanici_sifreHata','OK');
			redirect("yonetici/yeni-kullanici-ekle");
		}
	}	public function mevcutKullaniciDuzenle($id){

		if(gibYetki()==1)
			redirect("home/hata");
		$data["baslik"] = "Yönetici / Mevcut Kullanıcı Düzenle";
		$anaHesap = anaHesapBilgisi();

		$kullaniciQ = "SELECT * FROM kullanicilar WHERE kullanici_id = '$id'";
		$data["kullanici"] = $this->db->query($kullaniciQ)->row();

		// Kullanıcı gruplarını getir (ana hesap filtresi kaldırıldı)
		$kullaniciGruplariQ = "SELECT * FROM kullanici_grubu ORDER BY kg_adi ASC";
		$data["kullaniciGruplari"] = $this->db->query($kullaniciGruplariQ)->result();
		
		// Sorumlu müdür seçimi için tüm kullanıcıları getir (ana hesap filtresi kaldırıldı)
		$tumKullanicilarQ = "SELECT kullanici_id, kullanici_ad, kullanici_soyad FROM kullanicilar WHERE kullanici_durum = 1 ORDER BY kullanici_ad ASC, kullanici_soyad ASC";
		$data["tumKullanicilar"] = $this->db->query($tumKullanicilarQ)->result();
		
		// İlleri getir
		$illerQ = "SELECT * FROM iller ORDER BY il ASC";		$data["iller"] = $this->db->query($illerQ)->result();
				// Ülkeleri getir (updated to use correct field name from database schema)
		$ulkelerQ = "SELECT ulke_kodu as country_code, ulke_adi as country_name FROM ulkeler ORDER BY ulke_adi ASC";
		$data["ulkeler"] = $this->db->query($ulkelerQ)->result();
		
		// Kullanıcının mevcut sorumluluk bölgelerini getir
		$kullaniciSorumlulukQ = "SELECT sb.*, i.il, ilc.ilce, 
								 CONCAT(k.kullanici_ad, ' ', LEFT(k.kullanici_soyad, 1), '.') as islemi_yapan_adi
								 FROM kullanici_sorumluluk_bolgesi sb
								 LEFT JOIN iller i ON sb.il_id = i.id
								 LEFT JOIN ilceler ilc ON sb.ilce_id = ilc.id
								 LEFT JOIN kullanicilar k ON sb.islemi_yapan = k.kullanici_id
								 WHERE sb.kullanici = '$id' AND sb.durum = 1";
		$data["kullaniciSorumlulukBolgeleri"] = $this->db->query($kullaniciSorumlulukQ)->result();// Kullanıcının sorumluluk bölgesi temel bilgilerini getir (ilk kayıt varsa)
		// Önce tablo yapısını kontrol et
		$tableColumns = $this->db->list_fields('kullanici_sorumluluk_bolgesi');
		$hasExtendedColumns = in_array('baslangic_tarihi', $tableColumns) && 
							  in_array('bitis_tarihi', $tableColumns) && 
							  in_array('ulke_id', $tableColumns) && 
							  in_array('aciklama', $tableColumns);
		
		if ($hasExtendedColumns) {
			$kullaniciSorumlulukBilgiQ = "SELECT baslangic_tarihi, bitis_tarihi, ulke_id, aciklama
										   FROM kullanici_sorumluluk_bolgesi 
										   WHERE kullanici = '$id' AND durum = 1 
										   LIMIT 1";
		} else {
			// Eski tablo yapısı için temel sorgu
			$kullaniciSorumlulukBilgiQ = "SELECT kullanici, durum
										   FROM kullanici_sorumluluk_bolgesi 
										   WHERE kullanici = '$id' AND durum = 1 
										   LIMIT 1";
		}		$data["kullaniciSorumlulukBilgi"] = $this->db->query($kullaniciSorumlulukBilgiQ)->row();
		$data["hasExtendedColumns"] = $hasExtendedColumns;
		
		//logekle(48,1);
		$this->load->view("yonetici/kullanici", $data);
	}

	public function kullaniciDuzenle(){

		if(gibYetki()==1)
			redirect("home/hata");
		$kullanici_id = postval("kullanici_id");

		$anaHesap = anaHesapBilgisi();

		$sifre = postval("kullanici_sifre");
		$sifreTekrar = postval("kullanici_sifreTekrar");
		$eposta = postval("kullanici_eposta");

		if(!empty($sifre) && !empty($sifreTekrar)){
			if($sifre == $sifreTekrar){
				$data["kullanici_sifre"]  = md5($sifre);
			}else{
				$this->session->set_flashdata('kullanici_sifreHata','OK');
				redirect("yonetici/mevcut-kullanici-duzenle/$kullanici_id");
			}
		}
		$data["kullanici_eposta"] = $eposta;		$data["kullanici_ad"] = postval("kullanici_ad");		$data["kullanici_soyad"] = postval("kullanici_soyad");
		$data["kullanici_kullaniciAdi"] = postval("kullanici_kullaniciAdi");
		$data["grup_id"] = postval("kullanici_grupID"); // Form field adı kullanici_grupID ama database field grup_id
		$data["kullanici_durum"] = postval("kullanici_durum");
		$data["kullanici_sorumluMudur"] = postval("kullanici_sorumluMudur"); // Sorumlu müdür alanı

		$kullaniciEpostaVarmiQ = "SELECT * FROM kullanicilar WHERE kullanici_eposta = '$eposta' AND kullanici_id != '$kullanici_id'";
		$kullaniciEpostaVarmi = $this->db->query($kullaniciEpostaVarmiQ)->row();
		if($kullaniciEpostaVarmi){
			$this->session->set_flashdata('kullanici_eposta_mevcut','OK');
			redirect("yonetici/mevcut-kullanici-duzenle/$kullanici_id");
		}else{
			$this->vt->update('kullanicilar', array('kullanici_id'=>$kullanici_id), $data);
					// Sorumluluk bölgelerini güncelle - sadece checkbox işaretliyse
		$sorumluluk_aktif = postval("sorumluluk_aktif"); // Checkbox durumu
		$sorumlulukBolgeleri = postval("sorumluluk_bolgesi");
		
		// GÜÇLENDIRILMIŞ DEBUG LOGGING
		$debug_log_file = FCPATH . 'debug_form_submission.log';
		$timestamp = date('Y-m-d H:i:s');
		
		// Detaylı debug bilgileri
		$debug_info = array(
			'timestamp' => $timestamp,
			'kullanici_id' => $kullanici_id,
			'sorumluluk_aktif' => $sorumluluk_aktif,
			'post_count' => count($_POST),
			'post_keys' => array_keys($_POST),
			'sorumluluk_bolgesi_raw' => isset($_POST['sorumluluk_bolgesi']) ? $_POST['sorumluluk_bolgesi'] : 'NOT_SET',
			'sorumluluk_bolgesi_parsed' => $sorumlulukBolgeleri,
			'is_array' => is_array($sorumlulukBolgeleri),
			'array_count' => is_array($sorumlulukBolgeleri) ? count($sorumlulukBolgeleri) : 0
		);
		
		// Log dosyasına yaz
		$log_entry = $timestamp . " [INFO] Form submission debug: " . json_encode($debug_info) . "\n";
		file_put_contents($debug_log_file, $log_entry, FILE_APPEND | LOCK_EX);
		
		// Eski error_log'ları da tut
		error_log("DEBUG - POST Verileri: " . print_r($_POST, true));
		error_log("DEBUG - Sorumluluk Bölgeleri: " . print_r($sorumlulukBolgeleri, true));
		error_log("DEBUG - Sorumluluk Aktif: " . ($sorumluluk_aktif ? 'TRUE' : 'FALSE'));
		
		// Sorumluluk bölgesi işlemleri sadece checkbox işaretliyse yapılsın
		if ($sorumluluk_aktif) {
			// Önce mevcut sorumluluk bölgelerini pasif yap
			$this->db->query("UPDATE kullanici_sorumluluk_bolgesi SET durum = 0 WHERE kullanici = '$kullanici_id'");
			
			// Yeni sorumluluk bölgesi alanlarını al
			$sorumluluk_baslangic_tarihi = postval("sorumluluk_baslangic_tarihi");
			$sorumluluk_bitis_tarihi = postval("sorumluluk_bitis_tarihi");
			$sorumluluk_ulke_id = postval("sorumluluk_ulke_id") ?: 1; // Varsayılan: Türkiye
			$sorumluluk_aciklama = postval("sorumluluk_aciklama");
			
			// Yeni sorumluluk bölgelerini ekle/aktif et
			if(!empty($sorumlulukBolgeleri) && is_array($sorumlulukBolgeleri)){
				$log_entry = $timestamp . " [SUCCESS] Sorumluluk bölgeleri işleme başlıyor. Toplam: " . count($sorumlulukBolgeleri) . "\n";
				file_put_contents($debug_log_file, $log_entry, FILE_APPEND | LOCK_EX);
				
				foreach($sorumlulukBolgeleri as $index => $bolge){
					$bolgeParts = explode('_', $bolge);
					$log_entry = $timestamp . " [INFO] İşlenen bölge #$index: '$bolge' -> Parts: " . json_encode($bolgeParts) . "\n";
					file_put_contents($debug_log_file, $log_entry, FILE_APPEND | LOCK_EX);
					
					if(count($bolgeParts) == 2){
					$il_id = $bolgeParts[0];
					$ilce_id = $bolgeParts[1];
					
					// Önce var mı kontrol et
					$mevcutSorumlulukQ = "SELECT * FROM kullanici_sorumluluk_bolgesi WHERE kullanici = '$kullanici_id' AND il_id = '$il_id' AND ilce_id = '$ilce_id'";
					$mevcutSorumluluk = $this->db->query($mevcutSorumlulukQ)->row();
					
					if($mevcutSorumluluk){
						// Var ise aktif et ve yeni alanları güncelle
						$updateData = array(
							"durum" => 1,
							"baslangic_tarihi" => $sorumluluk_baslangic_tarihi ?: null,
							"bitis_tarihi" => $sorumluluk_bitis_tarihi ?: null,
							"ulke_id" => $sorumluluk_ulke_id,
							"aciklama" => $sorumluluk_aciklama ?: null,
							"islem_tarihi" => date('Y-m-d H:i:s')
						);
						$this->db->where('kullanici', $kullanici_id);
						$this->db->where('il_id', $il_id);
						$this->db->where('ilce_id', $ilce_id);
						$update_result = $this->db->update('kullanici_sorumluluk_bolgesi', $updateData);
						$log_entry = $timestamp . " [SUCCESS] Mevcut kayıt güncellendi: $il_id-$ilce_id (Result: " . ($update_result ? 'OK' : 'FAIL') . ")\n";
						file_put_contents($debug_log_file, $log_entry, FILE_APPEND | LOCK_EX);
					}else{
						// Yok ise yeni ekle
						$sorumlulukData = array(
							"kullanici" => $kullanici_id,
							"il_id" => $il_id,
							"ilce_id" => $ilce_id,
							"baslangic_tarihi" => $sorumluluk_baslangic_tarihi ?: null,
							"bitis_tarihi" => $sorumluluk_bitis_tarihi ?: null,
							"ulke_id" => $sorumluluk_ulke_id,
							"aciklama" => $sorumluluk_aciklama ?: null,
							"durum" => 1,
							"islemi_yapan" => $kullanici_id, // Current user updating
							"islem_tarihi" => date('Y-m-d H:i:s')
						);
						$insert_result = $this->vt->insert("kullanici_sorumluluk_bolgesi", $sorumlulukData);
						$log_entry = $timestamp . " [SUCCESS] Yeni kayıt eklendi: $il_id-$ilce_id (Insert Result: " . ($insert_result ? 'OK' : 'FAIL') . ")\n";
						file_put_contents($debug_log_file, $log_entry, FILE_APPEND | LOCK_EX);
					}
				} else {
					$log_entry = $timestamp . " [ERROR] Geçersiz bölge formatı: '$bolge'\n";
					file_put_contents($debug_log_file, $log_entry, FILE_APPEND | LOCK_EX);
				}
			}		} else {
			$empty_reason = empty($sorumlulukBolgeleri) ? 'EMPTY' : 'NOT_ARRAY';
			$log_entry = $timestamp . " [WARNING] Sorumluluk bölgeleri işlenemedi. Sebep: $empty_reason\n";
			file_put_contents($debug_log_file, $log_entry, FILE_APPEND | LOCK_EX);
		}
		} else {
			// Checkbox işaretli değilse sorumluluk bölgesi işlemlerini atla
			$log_entry = $timestamp . " [INFO] Sorumluluk bölgesi checkbox işaretli değil, bu işlemler atlanıyor\n";
			file_put_contents($debug_log_file, $log_entry, FILE_APPEND | LOCK_EX);
		}
			
		$this->session->set_flashdata('kullanici_update_ok','OK');
		logekle(48,3);
			redirect("yonetici/mevcut-kullanici-duzenle/$kullanici_id");
		}
	}

	public function kullaniciListesi(){

		if(gibYetki()==1)
			redirect("home/hata");
		$data["baslik"] = "Yönetici / Kullanıcı Listesi";
		$anaHesap = anaHesapBilgisi();

		$kullaniciEposta = $this->input->get('kullaniciEposta');
		$kullaniciAdi = $this->input->get('kullaniciAdi');

		$urim = $this->uri->segment(2);
		
		$segment = 2;
		$sayfa = $this->input->get("sayfa");

		$page = $sayfa ? $sayfa : 0;
		$limit = 20;

		if($sayfa){$pagem = ($page-1)*$limit;}
		else{$pagem = 0;/*logekle(50,1);*/}		if((isset($kullaniciEposta) && !empty($kullaniciEposta)) || (isset($kullaniciAdi) && !empty($kullaniciAdi))){
			$countq = "SELECT COUNT(*) as total FROM kullanicilar WHERE kullanici_eposta LIKE '%$kullaniciEposta%' AND kullanici_kullaniciAdi LIKE '%$kullaniciAdi%'";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;			$sorgu = "SELECT k.*, kg.kg_adi, sm.kullanici_ad as sorumlu_mudur_ad, sm.kullanici_soyad as sorumlu_mudur_soyad FROM kullanicilar k LEFT JOIN kullanici_grubu kg ON k.grup_id = kg.kg_id LEFT JOIN kullanicilar sm ON k.kullanici_sorumluMudur = sm.kullanici_id WHERE k.kullanici_eposta LIKE '%$kullaniciEposta%' AND k.kullanici_kullaniciAdi LIKE '%$kullaniciAdi%' ORDER BY k.kullanici_id DESC LIMIT $pagem,$limit";		}else{
			$countq = "SELECT COUNT(*) as total FROM kullanicilar";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;
			$sorgu = "SELECT k.*, kg.kg_adi, sm.kullanici_ad as sorumlu_mudur_ad, sm.kullanici_soyad as sorumlu_mudur_soyad FROM kullanicilar k LEFT JOIN kullanici_grubu kg ON k.grup_id = kg.kg_id LEFT JOIN kullanicilar sm ON k.kullanici_sorumluMudur = sm.kullanici_id ORDER BY k.kullanici_id DESC LIMIT $pagem,$limit";
		}

		$data["count_of_list"] = $count;

		$this->load->library("pagination");

		$config = array();
		$config["base_url"] = base_url() . "/yonetici/$urim";
		$config["total_rows"] = $count;
		$config["per_page"] = $limit;
		$config["uri_segment"] = $segment;
		$config['use_page_numbers'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		$config['query_string_segment'] = 'sayfa';
		$config['num_links'] = 9;

		$config['full_tag_open'] = '<div class="d-flex justify-content-center"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';

		$config['num_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['num_tag_close'] = '</li></span>';

		$config['cur_tag_open'] = '<span class="page-link"><li class="page-item active">';
		$config['cur_tag_close'] = '</li></span>';

		$config['first_link'] = '&laquo;&laquo;';
		$config['first_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['first_tag_close'] = '</li></span>';

		$config['last_link'] = '&raquo;&raquo;';
		$config['last_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['last_tag_close'] = '</li></span>';

		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['prev_tag_close'] = '</li></span>';

		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['next_tag_close'] = '</li></span>';

		$this->pagination->initialize($config);

		$data["links"] = $this->pagination->create_links();
		$data["kullanici"] = $this->db->query($sorgu)->result();

		$this->load->view("yonetici/kullanici-listesi",$data);
	}

	public function ayarlar(){
		$data["baslik"] = "Yönetici / Ayarlar";
		$anaHesap = anaHesapBilgisi();
		$ayarlarQ = "SELECT * FROM ayarlar WHERE ayarlar_id = '$anaHesap'";
		$data["ayar"] = $this->db->query($ayarlarQ)->row();

		$iller = $this->db->get('iller');

		if($iller->num_rows() > 0){$data['_iller'] = $iller->result();
		}else{$data['_iller'] = false;}

		$ayarlarBanka="select * from ayarlar_banka where ayarlarbanka_ayarID='$anaHesap'";
		$data["ayarlarBanka"]=$this->db->query($ayarlarBanka)->result();


		//logekle(53,1);
		$this->load->view("yonetici/ayarlar",$data);
	}

	public function ayarlarGuncelle(){
		$ayarlar_id = postval("ayarlar_id");

		$data["ayarlar_firmaAd"] = postval("ayarlar_firmaAd");
		$data["ayarlar_firmaSektor"] = postval("ayarlar_firmaSektor");
		$data["ayarlar_telefon"] = postval("ayarlar_telefon");
		$data["ayarlar_eposta"] = postval("ayarlar_eposta");
		$data["ayarlar_vergiDairesi"] = postval("ayarlar_vergiDairesi");
		$data["ayarlar_vergiNo"] = postval("ayarlar_vergiNo");
		$data["ayarlar_il"] = postval("ayarlar_il");
		$data["ayarlar_ilce"] = postval("ayarlar_ilce");
		$data["ayarlar_adres"] = postval("ayarlar_adres");


		$data["ayarlar_deletePermission"] = postval("ayarlar_deletePermission");

		//$data["ayarlar_lisansAnahtari"] = postval("ayarlar_lisansAnahtari");

		$ayar=$this->vt->single('ayarlar',array('ayarlar_id'=>$ayarlar_id));

		if($ayar->ayarlar_deletePermission!=$data["ayarlar_deletePermission"])
			if($data["ayarlar_deletePermission"]==1)
				logekle(64,3);
			else
				logekle(65,3);

		$this->vt->update('ayarlar', array('ayarlar_id'=>$ayarlar_id), $data);
		logekle(53,3);


		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;
		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');
		$anaHesap = anaHesapBilgisi();

		$this->db->delete('ayarlar_banka', array('ayarlarbanka_ayarID' => $ayarlar_id));

		$dataBanka["ayarlarbanka_ayarID"]=$ayarlar_id;
		$bankaAd=postval("ayarlar_bankaadi");
		$subeAd=postval("ayarlar_sube");
		$iban=postval("ayarlar_iban");
		$hesapNo=postval("ayarlar_hesapno");
		$paraBirimi=postval("ayarlar_parabirimi");
		$bankaCount=postval("bankaCount");
		for($i=0;$i<$bankaCount;$i++) {
			$dataBanka["ayarlarbanka_ad"] =$bankaAd[$i];
			$dataBanka["ayarlarbanka_subeAd"] =$subeAd[$i];
			$dataBanka["ayarlarbanka_iban"] =$iban[$i];
			$dataBanka["ayarlarbanka_hesapNo"] =$hesapNo[$i];
			$dataBanka["ayarlarbanka_paraBirim"] =$paraBirimi[$i];

			$dataBanka["ayarlarbanka_olusturan"] = $u_id;
			$dataBanka["ayarlarbanka_olusturanAnaHesap"] = $anaHesap;
			$dataBanka["ayarlarbanka_olusturmaTarihi"] = $tarihi;
			$dataBanka["ayarlarbanka_olusturmaSaati"] = $saati;
			$this->vt->insert("ayarlar_banka",$dataBanka);
			logekle(53,2);
		}

		$this->session->set_flashdata('ayarlar_update_ok','OK');
		redirect("yonetici/ayarlar");

	}
	public function kullaniciYetkileriDuzenle(){
		$data["baslik"] = "Yönetici / Kullanıcı Yetkileri Düzenle";
		$anaHesap = anaHesapBilgisi();

		$kullanici = $this->input->get("kullanici");

		if($kullanici){
			$this->load->view("yonetici/kullanici-yetkileri-duzenle",$data);
		}else{
			$this->load->view("yonetici/kullanici-yetkileri-duzenle",$data);
		}
		
	}

	public function kullaniciYetkileriGuncelle(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$kullanici_id = postval("kullanici_id");

		$post = $this->input->post();

		//modülId = 1)Cari 2)Stok 3)Fatura 4)Kasa 5)Banka 6)Rapor 7)Giderler

		if($post["cari"]){
				$m1Array2 = [];

				foreach($post["cari"] as $ps){
					$data = array("ky_kullaniciID" => $kullanici_id, "ky_modul" => 1, "ky_yetki"=>$ps, "ky_guncelleyen"=>$u_id);

					$yetkiSorgula = yetkiSorgula($kullanici_id,1,$ps);

					if(!$yetkiSorgula){
						$this->vt->insert("kullaniciYetkileri", $data);
					}

					$m1Array2[] = $ps;
				}

				 $modul1q = "SELECT * FROM kullaniciYetkileri WHERE ky_modul = 1 AND ky_kullaniciID = '$kullanici_id'";
				 $modul1 = $this->db->query($modul1q)->result();

				 $m1Array = [];

				  foreach($modul1 as $m1exe){
				      $m1Array[] = $m1exe->ky_yetki;
				  }

				  $diff1 = array_diff($m1Array, $m1Array2);

				  if(!empty($diff1)){
				      foreach($diff1 as $key => $value){
				      	$this->db->delete('kullaniciYetkileri', array('ky_modul' => 1, 'ky_yetki' => $value, 'ky_kullaniciID' => $kullanici_id));
				      }
				  }
		}else if(empty($post["cari"])){
			$this->db->delete('kullaniciYetkileri', array('ky_modul' => 1, 'ky_kullaniciID' => $kullanici_id));
		}



		if($post["stok"]){
			$m2Array2 = [];

			foreach($post["stok"] as $ps){
				$data = array("ky_kullaniciID" => $kullanici_id, "ky_modul" => 2, "ky_yetki"=>$ps, "ky_guncelleyen"=>$u_id);
				
				$yetkiSorgula = yetkiSorgula($kullanici_id,2,$ps);

					if(!$yetkiSorgula){
						$this->vt->insert("kullaniciYetkileri", $data);
					}

				$m2Array2[] = $ps;
			}

			$modul2q = "SELECT * FROM kullaniciYetkileri WHERE ky_modul = 2 AND ky_kullaniciID = '$kullanici_id'";
				 $modul2 = $this->db->query($modul2q)->result();

				 $m2Array = [];

				  foreach($modul2 as $m2exe){
				      $m2Array[] = $m2exe->ky_yetki;
				  }

				  $diff2 = array_diff($m2Array, $m2Array2);

				  if(!empty($diff2)){
				      foreach($diff2 as $key => $value){
				      	$this->db->delete('kullaniciYetkileri', array('ky_modul' => 2, 'ky_yetki' => $value, 'ky_kullaniciID' => $kullanici_id));
				      }
				  }
		}else if(empty($post["stok"])){
			$this->db->delete('kullaniciYetkileri', array('ky_modul' => 2, 'ky_kullaniciID' => $kullanici_id));
		}

		if($post["fatura"]){
			$m3Array2 = [];
			foreach($post["fatura"] as $ps){
				$data = array("ky_kullaniciID" => $kullanici_id, "ky_modul" => 3, "ky_yetki"=>$ps, "ky_guncelleyen"=>$u_id);
				$yetkiSorgula = yetkiSorgula($kullanici_id,3,$ps);

					if(!$yetkiSorgula){
						$this->vt->insert("kullaniciYetkileri", $data);
					}

				$m3Array2[] = $ps;
			}

			$modul3q = "SELECT * FROM kullaniciYetkileri WHERE ky_modul = 3 AND ky_kullaniciID = '$kullanici_id'";
				 $modul3 = $this->db->query($modul3q)->result();

				 $m3Array = [];

				  foreach($modul3 as $m3exe){
				      $m3Array[] = $m3exe->ky_yetki;
				  }

				  $diff3 = array_diff($m3Array, $m3Array2);

				  if(!empty($diff3)){
				      foreach($diff3 as $key => $value){
				      	$this->db->delete('kullaniciYetkileri', array('ky_modul' => 3, 'ky_yetki' => $value, 'ky_kullaniciID' => $kullanici_id));
				      }
				  }
		}else if(empty($post["fatura"])){
			$this->db->delete('kullaniciYetkileri', array('ky_modul' => 3, 'ky_kullaniciID' => $kullanici_id));
		}

		if($post["kasa"]){
			$m4Array2 = [];
			foreach($post["kasa"] as $ps){
				$data = array("ky_kullaniciID" => $kullanici_id, "ky_modul" => 4, "ky_yetki"=>$ps, "ky_guncelleyen"=>$u_id);
				$yetkiSorgula = yetkiSorgula($kullanici_id,4,$ps);

					if(!$yetkiSorgula){
						$this->vt->insert("kullaniciYetkileri", $data);
					}

				$m4Array2[] = $ps;
			}

			$modul4q = "SELECT * FROM kullaniciYetkileri WHERE ky_modul = 4 AND ky_kullaniciID = '$kullanici_id'";
				 $modul4 = $this->db->query($modul4q)->result();

				 $m1Array = [];

				  foreach($modul4 as $m4exe){
				      $m4Array[] = $m4exe->ky_yetki;
				  }

				  $diff4 = array_diff($m4Array, $m4Array2);

				  if(!empty($diff4)){
				      foreach($diff4 as $key => $value){
				      	$this->db->delete('kullaniciYetkileri', array('ky_modul' => 4, 'ky_yetki' => $value, 'ky_kullaniciID' => $kullanici_id));
				      }
				  }
		}else if(empty($post["kasa"])){
			$this->db->delete('kullaniciYetkileri', array('ky_modul' => 4, 'ky_kullaniciID' => $kullanici_id));
		}

		if($post["banka"]){
			$m5Array2 = [];
			foreach($post["banka"] as $ps){
				$data = array("ky_kullaniciID" => $kullanici_id, "ky_modul" => 5, "ky_yetki"=>$ps, "ky_guncelleyen"=>$u_id);
				$yetkiSorgula = yetkiSorgula($kullanici_id,5,$ps);

					if(!$yetkiSorgula){
						$this->vt->insert("kullaniciYetkileri", $data);
					}

				$m5Array2[] = $ps;
			}

			$modul5q = "SELECT * FROM kullaniciYetkileri WHERE ky_modul = 5 AND ky_kullaniciID = '$kullanici_id'";
				 $modul5 = $this->db->query($modul5q)->result();

				 $m5Array = [];

				  foreach($modul5 as $m5exe){
				      $m5Array[] = $m5exe->ky_yetki;
				  }

				  $diff5 = array_diff($m5Array, $m5Array2);

				  if(!empty($diff5)){
				      foreach($diff5 as $key => $value){
				      	$this->db->delete('kullaniciYetkileri', array('ky_modul' => 5, 'ky_yetki' => $value, 'ky_kullaniciID' => $kullanici_id));
				      }
				  }
		}else if(empty($post["banka"])){
			$this->db->delete('kullaniciYetkileri', array('ky_modul' => 5, 'ky_kullaniciID' => $kullanici_id));
		}

		if($post["rapor"]){
			$m6Array2 = [];
			foreach($post["rapor"] as $ps){
				$data = array("ky_kullaniciID" => $kullanici_id, "ky_modul" => 6, "ky_yetki"=>$ps, "ky_guncelleyen"=>$u_id);
				$yetkiSorgula = yetkiSorgula($kullanici_id,6,$ps);

					if(!$yetkiSorgula){
						$this->vt->insert("kullaniciYetkileri", $data);
					}

				$m6Array2[] = $ps;
			}

			$modul6q = "SELECT * FROM kullaniciYetkileri WHERE ky_modul = 6 AND ky_kullaniciID = '$kullanici_id'";
				 $modul6 = $this->db->query($modul6q)->result();

				 $m6Array = [];

				  foreach($modul6 as $m6exe){
				      $m6Array[] = $m6exe->ky_yetki;
				  }

				  $diff6 = array_diff($m6Array, $m6Array2);

				  if(!empty($diff6)){
				      foreach($diff6 as $key => $value){
				      	$this->db->delete('kullaniciYetkileri', array('ky_modul' => 6, 'ky_yetki' => $value, 'ky_kullaniciID' => $kullanici_id));
				      }
				  }
		}else if(empty($post["rapor"])){
			$this->db->delete('kullaniciYetkileri', array('ky_modul' => 6, 'ky_kullaniciID' => $kullanici_id));
		}

		if($post["giderler"]){
			$m7Array2 = [];
			foreach($post["giderler"] as $ps){
				$data = array("ky_kullaniciID" => $kullanici_id, "ky_modul" => 7, "ky_yetki"=>$ps, "ky_guncelleyen"=>$u_id);
				$yetkiSorgula = yetkiSorgula($kullanici_id,7,$ps);

					if(!$yetkiSorgula){
						$this->vt->insert("kullaniciYetkileri", $data);
					}

				$m7Array2[] = $ps;
			}

			$modul7q = "SELECT * FROM kullaniciYetkileri WHERE ky_modul = 7 AND ky_kullaniciID = '$kullanici_id'";
				 $modul7 = $this->db->query($modul7q)->result();

				 $m7Array = [];

				  foreach($modul7 as $m7exe){
				      $m7Array[] = $m7exe->ky_yetki;
				  }

				  $diff7 = array_diff($m7Array, $m7Array2);

				  if(!empty($diff7)){
				      foreach($diff7 as $key => $value){
				      	$this->db->delete('kullaniciYetkileri', array('ky_modul' => 7, 'ky_yetki' => $value, 'ky_kullaniciID' => $kullanici_id));
				      }
				  }
		}else if(empty($post["giderler"])){
			$this->db->delete('kullaniciYetkileri', array('ky_modul' => 7, 'ky_kullaniciID' => $kullanici_id));
		}

		$this->session->set_flashdata('kullanici_yetkileri_ok','OK');
		logekle(49,3);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function logoGuncelle(){
		if(!empty($_FILES['file']['name'])){
            $config['upload_path'] = 'assets/bulut/logo'; 
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '100';
            $config['file_name'] = $_FILES['file']['name'];
            $config['encrypt_name'] = TRUE;
            $config['max_width'] = 250;
            $config['max_height'] = 250;

            $this->load->library('upload',$config); 

            if($this->upload->do_upload('file')){
                $fileName = $this->upload->data('file_name');
                $originalName = $this->upload->data('orig_name');

                $uploadData = $this->upload->data();

                if($uploadData){
                    $data_upload["ayarlar_logoName"] = $fileName;
                    $data_upload["ayarlar_logoOriginalFileName"] = $originalName;

                    $aid = postval("anaHesap");

                    $this->vt->update('ayarlar', array('ayarlar_id'=>$aid), $data_upload);

                    $this->session->set_flashdata('document_uploaded','ok');

                    redirect($_SERVER['HTTP_REFERER']);
                }
            }else{
            	$this->session->set_flashdata('document_uploaded_error','ok');

                    redirect($_SERVER['HTTP_REFERER']);
            }
        }
	}

	public function yukle($id){
		if($id == 1){//akınsoft
			$data["erp"] = 1;
			$data["erpBaslik"] = "Akınsoft";
			$this->load->view("yonetici/yukle",$data);
		}else{
			//diğer
		}
	}

	public function yukle_islem(){
		/* 
		
		Cari Hareketleri

		1 = Alış Faturası
		2 = Satış Faturası 
		3 = Banka Havalesi 
		4 = Banka EFT
		5 = Kasa Tahsilat
		6 = Kasa Ödeme
		7 = Cari Dekont 
		8 = Alınan Çek
		9 = Verilen Çek
		10 = Alınan Senet
		11 = Verilen Senet
		12 = E-Fatura
		13 = E-Arşiv


		Onların 

		Çek
		Dekont
		EFT
		Evrak
		Fatura
		Havale
		Nakit



		ALIŞ FATURASI = ch_alacak
		SATIŞ FATURASI = ch_borc


		ch_belgeNumarasi = 6
		ch_turu = 3
		ch_cariID = 1 (sorgulanmış hali)
		ch_paraBirimi = TL

			4 , 0 değilse
		ch_borc
			5 , 0 değilse
		ch_alacak


		ch_tarih == 2022-04-05
		ch_olusturan = 106
		ch_olusturanAnaHesap = 91

		ch_olusturmaTarihi = 2022-04-05
		ch_olusturmaSaati = 09:00:00




 

		*/
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');

		$tarih = (new DateTime('now'))->format('Y-m-d');
		$saat = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		if(!empty($_FILES['file']['name'])){
          $config['upload_path'] = 'assets/bulut'; 
          $config['allowed_types'] = 'xls|xlsx';
          $config['encrypt_name'] = TRUE;

          $this->load->library('upload',$config); 

          if($this->upload->do_upload('file')){
          	$fileName = $this->upload->data('file_name');

            $uploadData = $this->upload->data();
            if($uploadData){
            	$inputFileName = './assets/bulut/'.$fileName;

            	try {
            	$inputFileType = PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
					    $objReader = PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
					    $objPHPExcel = $objReader->load($inputFileName);
					    }catch(Exception $e) {
							    die('Hata "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
							}

							$sheet = $objPHPExcel->getSheet(0); 
							$highestRow = $sheet->getHighestRow(); 
							$highestColumn = $sheet->getHighestColumn();

							for ($row = 1; $row <= $highestRow; $row++){ 
							    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

							    $cariKod = $rowData[0][0];
							    $stokKod = $rowData[0][1];

							    $sorgu1 = $this->db->query("SELECT cari_id FROM cari WHERE cari_kodu = '".$cariKod."' ")->row();
									$cid = $sorgu1->cari_id;

									$sorgu2 = $this->db->query("SELECT stok_id FROM stok WHERE stok_kodu = '".$stokKod."' ")->row();
									$sid = $sorgu2->stok_id;

									$islemTuru = $rowData[0][4];

									$belgeNumarasi = $rowData[0][7];

									$kpbTutar = $rowData[0][6];


								/*	if($cid && $sid){
										if($islemTuru == 'Giren'){//1 alış faturası (giriş)
										$sh_turu = 1;
										$sh_giris = $rowData[0][2];

										$this->db->query("INSERT INTO stokHareketleri (sh_turu,sh_giris,sh_cariID,sh_stokID,sh_belgeNumarasi,sh_paraBirimi,sh_tarih,sh_toplamFiyat,sh_olusturan,sh_olusturanAnaHesap,sh_olusturmaTarihi,sh_olusturmaSaati) VALUES ($sh_turu, $sh_giris,$cid,$sid,'$belgeNumarasi','TL','$tarih',$kpbTutar,$u_id,$anaHesap,'$tarih','$saat')");


										}else if($islemTuru == 'Çıkan'){//2 satış faturası (çıkış)
											$sh_turu = 2;
											$sh_cikis = $rowData[0][3];

											$this->db->query("INSERT INTO stokHareketleri (sh_turu,sh_cikis,sh_cariID,sh_stokID,sh_belgeNumarasi,sh_paraBirimi,sh_tarih,sh_toplamFiyat,sh_olusturan,sh_olusturanAnaHesap,sh_olusturmaTarihi,sh_olusturmaSaati) VALUES ($sh_turu, $sh_cikis,$cid,$sid,'$belgeNumarasi','TL','$tarih',$kpbTutar,$u_id,$anaHesap,'$tarih','$saat')");
										}
									}  */


									if($cid){
										if($turu == "Fatura"){
											if($borc == 0){
												$ch_alacak = $alacak;
												$ch_turu = 1;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_alacak,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_alacak, '".$tarih."', '106','91','".$tarih."','".$saat."')");

											}else  if($alacak == 0){
												$ch_borc = $borc;
												$ch_turu = 2;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_borc,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_borc, '".$tarih."', '106','91','".$tarih."','".$saati."')");
											}
										}

										if($turu == "Çek"){

											if($borc == 0){
												$ch_turu = 8;
												$ch_alacak = $alacak;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_alacak,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_alacak, '".$tarih."', '106','91','".$tarih."','".$saati."')");
											}else if($alacak == 0){
												$ch_turu = 9;
												$ch_borc = $borc;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_borc,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_borc, '".$tarih."', '106','91','".$tarih."','".$saati."')");
											}

										}else if($turu == "Dekont"){

											if($borc == 0){
												$ch_turu = 7;
												$ch_alacak = $alacak;
												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_alacak,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_alacak, '".$tarih."', '106','91','".$tarih."','".$saati."')");
											}else if($alacak == 0){
												$ch_turu = 7;
												$ch_borc = $borc;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_borc,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_borc, '".$tarih."', '106','91','".$tarih."','".$saati."')");
											}

										}else if($turu == "EFT"){

											if($borc == 0){
												$ch_turu = 4;
												$ch_alacak = $alacak;
												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_alacak,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_alacak, '".$tarih."', '106','91','".$tarih."','".$saati."')");
											}else if($alacak == 0){
												$ch_turu = 4;
												$ch_borc = $borc;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_borc,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_borc, '".$tarih."', '106','91','".$tarih."','".$saati."')");
											}

										}else if($turu == "Evrak"){//olmayacak

											if($borc == 0){
												$ch_turu = 8;
												$ch_alacak = $alacak;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_alacak,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_alacak, '".$tarih."', '106','91','".$tarih."','".$saati."')");
											}else if($alacak == 0){
												$ch_turu = 9;
												$ch_borc = $borc;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_borc,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_borc, '".$tarih."', '106','91','".$tarih."','".$saati."')");
											}

										}else if($turu == "Havale"){

											if($borc == 0){
												$ch_turu = 3;
												$ch_alacak = $alacak;
												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_alacak,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_alacak, '".$tarih."', '106','91','".$tarih."','".$saati."')");
											}else if($alacak == 0){
												$ch_turu = 3;
												$ch_borc = $borc;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_borc,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_borc, '".$tarih."', '106','91','".$tarih."','".$saati."')");
											}

										}else if($turu == "Nakit"){//olmayacak
											/*
														5 = Kasa Tahsilat
														6 = Kasa Ödeme
											*/
											if($borc == 0){
												$ch_turu = 5;
												$ch_alacak = $alacak;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_alacak,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_alacak, '".$tarih."', '106','91','".$tarih."','".$saati."')");
											}else if($alacak == 0){
												$ch_turu = 6;
												$ch_borc = $borc;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_borc,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_borc, '".$tarih."', '106','91','".$tarih."','".$saati."')");
											}

										}
									}

									

							    /* $cariAd = $rowData[0][1];

									$sorgu1 = $this->db->query("SELECT cari_id FROM cari WHERE cari_ad = '".$cariAd."' ")->row();
									$cid = $sorgu1->cari_id;

									$vkn = $rowData[0][6];
									$vknLength = strlen($vkn);

									$vd = $rowData[0][5];

									if($vknLength == 10){//vkn
										$this->db->query("UPDATE cari SET cari_vergiNumarasi = $vkn, cari_vergiDairesi = '$vd' WHERE cari_id = $cid ");
									}else if($vknLength == 11){//tckn
										$this->db->query("UPDATE cari SET cari_vergiNumarasi = '', cari_tckn = $vkn  WHERE cari_id = $cid ");
									} */
							}
            }else{
            	echo $this->upload->display_errors();
            }
            
          }
			}		}

	/**
	 * Yeni kullanıcı oluşturulduğunda otomatik olarak varsayılan kasa oluşturur
	 *
	 * @param int $kullanici_id Oluşturulan kullanıcının ID'si
	 * @param int $olusturan_kullanici_id Kasayı oluşturan kullanıcının ID'si
	 * @param int $anaHesap Ana hesap ID'si
	 * @param string $tarih Oluşturma tarihi
	 */
	private function otomatikKasaOlustur($kullanici_id, $olusturan_kullanici_id, $anaHesap, $tarih) {
		try {
			// Kullanıcı bilgilerini al
			$kullaniciQ = "SELECT kullanici_ad, kullanici_soyad FROM kullanicilar WHERE kullanici_id = '$kullanici_id'";
			$kullanici = $this->db->query($kullaniciQ)->row();
			
			if ($kullanici) {
				$kullaniciAdSoyad = $kullanici->kullanici_ad . ' ' . $kullanici->kullanici_soyad;
				
				// Otomatik kasa bilgileri
				$kasaKodu = "KASA-" . str_pad($kullanici_id, 4, '0', STR_PAD_LEFT);
				$kasaAdi = $kullaniciAdSoyad . " - Varsayılan Kasa";
				$kasaBaslangic = 0; // Başlangıç bakiyesi 0
				
				date_default_timezone_set('Europe/Istanbul');
				$saati = (new DateTime('now'))->format('H:i:s');
				
				// Aynı kasa kodunun var olup olmadığını kontrol et
				$kasaVarmiQ = "SELECT * FROM kasa WHERE kasa_kodu = '$kasaKodu' AND kasa_olusturanAnaHesap = '$anaHesap'";
				$kasaVarmi = $this->db->query($kasaVarmiQ)->row();
				
				if (!$kasaVarmi) {
					// Kasa tablosuna kayıt ekle
				$dataKasa = array(
					"kasa_kodu" => $kasaKodu,
					"kasa_adi" => $kasaAdi,
					"kasa_baslangic" => $kasaBaslangic,
					"kasa_aciklama" => "Kullanıcı oluşturulduğunda otomatik oluşturulan varsayılan kasa",
					"kasa_sorumlusu" => $kullanici_id, // Yeni eklenen alan - kullanıcı ID'si
					"kasa_olusturanAnaHesap" => $anaHesap,
					"kasa_olusturan" => $olusturan_kullanici_id,
					"kasa_olusturmaTarihi" => $tarih,
					"kasa_olusturmaSaati" => $saati
				);
					
					$this->vt->insert("kasa", $dataKasa);
					$kasa_id = $this->db->insert_id();
					
					// Kasa hareketleri tablosuna başlangıç kaydı ekle
					$dataKasaHareket = array(
						"kh_kasaID" => $kasa_id,
						"kh_turu" => 14, // Kasa açılış bakiyesi türü
						"kh_giris" => $kasaBaslangic,
						"kh_tarih" => $tarih,
						"kh_aciklama" => "Otomatik Oluşturulan Kasa - Açılış Bakiyesi",
						"kh_olusturan" => $olusturan_kullanici_id,
						"kh_olusturanAnaHesap" => $anaHesap,
						"kh_olusturmaTarihi" => $tarih,
						"kh_olusturmaSaati" => $saati
					);
					
					$this->vt->insert("kasaHareketleri", $dataKasaHareket);
					
					// Log ekle (opsiyonel - eğer logekle fonksiyonu varsa)
					if (function_exists('logekle')) {
						logekle(50, 2); // Kasa oluşturma log kodu
					}
				}
			}
		} catch (Exception $e) {
			// Hata durumunda sessizce devam et, kullanıcı oluşturma işlemini etkilemesin
			// İsteğe bağlı olarak log kaydı yapılabilir
			log_message('error', 'Otomatik kasa oluşturma hatası: ' . $e->getMessage());
		}
	}


	/**
	 * Kullanıcı Grubu Yönetimi
	 */
	public function kullaniciGrubu(){
		if(gibYetki()==1)
			redirect("home/hata");

		if(isDemoActive() == 1)
			redirect("home/hata");

		$data["baslik"] = "Yönetici / Kullanıcı Grupları";		$anaHesap = anaHesapBilgisi();

		// Kullanıcı gruplarını getir
		$gruplarQ = "SELECT kg.*, 
					 COUNT(DISTINCT k.kullanici_id) as kullanici_sayisi,
					 COUNT(DISTINCT kgy.kgy_id) as yetki_sayisi
					 FROM kullanici_grubu kg 
					 LEFT JOIN kullanicilar k ON kg.kg_id = k.grup_id 
					 LEFT JOIN kullanici_grubu_yetkisi kgy ON kg.kg_id = kgy.kgy_grupID
					 WHERE kg.kg_olusturanAnaHesap = '$anaHesap'
					 GROUP BY kg.kg_id
					 ORDER BY kg.kg_id DESC";
		$data["gruplar"] = $this->db->query($gruplarQ)->result();

		// Modül listesi
		$data["moduller"] = [
			1 => 'Cari',
			2 => 'Stok', 
			3 => 'Fatura',
			4 => 'Kasa',
			5 => 'Banka',
			6 => 'Rapor',
			7 => 'Giderler',
			8 => 'Tahsilat'
		];

		// Yetki listesi
		$data["yetkiler"] = [
			1 => 'Görüntüleme',
			2 => 'Ekleme',
			3 => 'Düzenleme', 
			4 => 'Silme'
		];

		$this->load->view("yonetici/kullanici-grubu", $data);
	}

	public function kullaniciGrubuOlustur(){
		if(gibYetki()==1)
			redirect("home/hata");

		if(isDemoActive() == 1)
			redirect("home/hata");

		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;
		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y-m-d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$data["kg_adi"] = postval("kg_adi");
		$data["kg_aciklama"] = postval("kg_aciklama");
		$data["kg_durum"] = 1;
		$data["kg_olusturan"] = $u_id;
		$data["kg_olusturanAnaHesap"] = $anaHesap;
		$data["kg_olusturmaTarihi"] = $tarihi;
		$data["kg_olusturmaSaati"] = $saati;

		$this->vt->insert("kullanici_grubu", $data);
		$grup_id = $this->db->insert_id();

		// Seçilen yetkileri kaydet
		$yetkiler = $this->input->post();
		foreach($yetkiler as $key => $value){
			if(strpos($key, 'yetki_') === 0 && is_array($value)){
				$parts = explode('_', $key);
				$modul = $parts[1];
				
				foreach($value as $yetki){
					$dataYetki = array(
						"kgy_grupID" => $grup_id,
						"kgy_modul" => $modul,
						"kgy_yetki" => $yetki,
						"kgy_olusturan" => $u_id,
						"kgy_olusturanAnaHesap" => $anaHesap,
						"kgy_olusturmaTarihi" => $tarihi,
						"kgy_olusturmaSaati" => $saati
					);
					$this->vt->insert("kullanici_grubu_yetkisi", $dataYetki);
				}
			}
		}
		$this->session->set_flashdata('kullanici_grubu_ok','OK');
		redirect("yonetici/kullanici-grubu");
	}	/**
	 * Yeni kullanıcı grubu ekleme (POST handler)
	 */
	public function kullaniciGrubuEkle(){
		if(gibYetki()==1)
			redirect("home/hata");

		if(isDemoActive() == 1)
			redirect("home/hata");

		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;
		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y-m-d');
		$saati = (new DateTime('now'))->format('H:i:s');

		// Form verilerini al
		$kg_adi = postval("kg_adi");
		$kg_aciklama = postval("kg_aciklama");
		// Basit doğrulama
		if(empty($kg_adi)){
			$this->session->set_flashdata('kullanici_grubu_hata','Grup adı boş olamaz!');
			redirect("yonetici/kullaniciGrubu");
			return;
		}

		$data["kg_adi"] = $kg_adi;
		$data["kg_aciklama"] = $kg_aciklama;
		$data["kg_durum"] = 1;
		$data["kg_olusturan"] = $u_id;
		$data["kg_olusturanAnaHesap"] = $anaHesap;
		$data["kg_olusturmaTarihi"] = $tarihi;
		$data["kg_olusturmaSaati"] = $saati;
		try {
			$this->vt->insert("kullanici_grubu", $data);
			$this->session->set_flashdata('kullanici_grubu_ok','Kullanıcı Grubu başarıyla oluşturuldu!');
		} catch (Exception $e) {
			$this->session->set_flashdata('kullanici_grubu_hata','Grup eklenirken hata oluştu: ' . $e->getMessage());
		}

		redirect("yonetici/kullaniciGrubu");
	}

	public function kullaniciGrubuSil($id){
		if(gibYetki()==1)
			redirect("home/hata");

		if(isDemoActive() == 1)
			redirect("home/hata");

		$anaHesap = anaHesapBilgisi();

		// Grubun bu ana hesaba ait olduğunu kontrol et
		$grupQ = "SELECT * FROM kullanici_grubu WHERE kg_id = '$id' AND kg_olusturanAnaHesap = '$anaHesap'";
		$grup = $this->db->query($grupQ)->row();
		if($grup){
			// Bu gruba bağlı kullanıcıları güncelle (grup bağlantısını kaldır)
			$this->db->query("UPDATE kullanicilar SET grup_id = NULL WHERE grup_id = '$id'");
			
			// Grup yetkilerini sil
			$this->db->delete('kullanici_grubu_yetkisi', array('kgy_grupID' => $id));
			
			// Grubu sil
			$this->db->delete('kullanici_grubu', array('kg_id' => $id));

			$this->session->set_flashdata('kullanici_grubu_sil_ok','OK');
		}

		redirect("yonetici/kullanici-grubu");
	}

	public function kullaniciGrubuDuzenle($id = null){
		if(gibYetki()==1)
			redirect("home/hata");

		if(isDemoActive() == 1)
			redirect("home/hata");

		// Eğer ID verilmemişse kullanıcı grubu listesine yönlendir
		if(empty($id)) {
			redirect("yonetici/kullanici-grubu");
		}

		$data["baslik"] = "Yönetici / Kullanıcı Grubu Düzenle";
		$anaHesap = anaHesapBilgisi();

		// Grup bilgilerini getir
		$grupQ = "SELECT * FROM kullanici_grubu WHERE kg_id = '$id' AND kg_olusturanAnaHesap = '$anaHesap'";
		$data["grup"] = $this->db->query($grupQ)->row();

		if(!$data["grup"]){
			redirect("yonetici/kullanici-grubu");
		}

		// Grup yetkilerini getir
		$yetkilerQ = "SELECT * FROM kullanici_grubu_yetkisi WHERE kgy_grupID = '$id'";
		$yetkilerResult = $this->db->query($yetkilerQ)->result();
		
		$data["grup_yetkileri"] = [];
		foreach($yetkilerResult as $yetki){
			$data["grup_yetkileri"][$yetki->kgy_modul][] = $yetki->kgy_yetki;
		}

		// Modül listesi
		$data["moduller"] = [
			1 => 'Cari',
			2 => 'Stok', 
			3 => 'Fatura',
			4 => 'Kasa',
			5 => 'Banka',
			6 => 'Rapor',
			7 => 'Giderler',
			8 => 'Tahsilat',
			9 => 'Aktivasyon',
			1900 => 'Voip & Hakediş',
			1901 => 'Voip - Operatör Tanımla',
			1902 => 'Voip - Numara Tanımla',
			1903 => 'Voip - Numara Teslim',
			1904 => 'Voip - Günlük Harcama',
			1905 => 'Voip - Hakediş Tanımlama',
			1906 => 'Voip - Hakediş İris Rapor',
			1907 => 'Voip - Hakediş Bayi Hesapla'
		];

		// Yetki listesi
		$data["yetkiler"] = [
			1 => 'Görüntüleme',
			2 => 'Ekleme',
			3 => 'Düzenleme', 
			4 => 'Silme'
		];

		$this->load->view("yonetici/kullanici-grubu-duzenle", $data);
	}

	public function kullaniciGrubuGuncelle(){
		if(gibYetki()==1)
			redirect("home/hata");

		if(isDemoActive() == 1)
			redirect("home/hata");

		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;
		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y-m-d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$grup_id = postval("kg_id");

		$data["kg_adi"] = postval("kg_adi");
		$data["kg_aciklama"] = postval("kg_aciklama");
		$data["kg_guncelleyen"] = $u_id;
		$data["kg_guncellemeTarihi"] = $tarihi;
		$data["kg_guncellemeSaati"] = $saati;

		$this->vt->update('kullanici_grubu', array('kg_id' => $grup_id), $data);

		// Mevcut yetkileri sil
		$this->db->delete('kullanici_grubu_yetkisi', array('kgy_grupID' => $grup_id));
		
		// DEBUG: Confirm deletion
		if($u_id == 187) {
			log_message('debug', "PERMISSIONS DELETED for group: $grup_id");
		}

		// Yeni yetkileri kaydet
		$yetkiler = $this->input->post();
		
		// DEBUG: Log all POST data for user 187 (your test user)
		if($u_id == 187) {
			log_message('debug', 'GRUP YETKI GUNCELLEME DEBUG - User ID: ' . $u_id . ', Grup ID: ' . $grup_id);
			log_message('debug', 'POST DATA: ' . json_encode($yetkiler));
		}
		
		foreach($yetkiler as $key => $value){
			if(strpos($key, 'yetki_') === 0 && is_array($value)){
				$parts = explode('_', $key);
				$modul = $parts[1];
				
				// DEBUG: Log each permission being saved
				if($u_id == 187) {
					log_message('debug', "PERMISSION SAVE - Module: $modul, Permissions: " . json_encode($value));
				}
				
				foreach($value as $yetki){
					// Duplicate entry kontrolü
					$existingYetki = $this->vt->single('kullanici_grubu_yetkisi', array(
						'kgy_grupID' => $grup_id,
						'kgy_modul' => $modul,
						'kgy_yetki' => $yetki
					));
					
					if (!$existingYetki) {
						$dataYetki = array(
							"kgy_grupID" => $grup_id,
							"kgy_modul" => $modul,
							"kgy_yetki" => $yetki,
							"kgy_olusturan" => $u_id,
							"kgy_olusturanAnaHesap" => $anaHesap,
							"kgy_olusturmaTarihi" => $tarihi,
							"kgy_olusturmaSaati" => $saati
						);
						$this->vt->insert("kullanici_grubu_yetkisi", $dataYetki);
						
						// DEBUG: Confirm insertion
						if($u_id == 187) {
							log_message('debug', "INSERTED - Group: $grup_id, Module: $modul, Permission: $yetki");
						}
					} else {
						// DEBUG: Already exists
						if($u_id == 187) {
							log_message('debug', "DUPLICATE SKIPPED - Group: $grup_id, Module: $modul, Permission: $yetki");
						}
					}
				}
			}
		}

		$this->session->set_flashdata('kullanici_grubu_guncelle_ok','OK');
		redirect("yonetici/kullaniciGrubu");
	}
	/**
	 * AJAX endpoint to get all countries (for responsibility areas modal)
	 */	public function getCountries(){
		$ulkelerQ = "SELECT ulke_kodu as country_code, ulke_adi as country_name FROM ulkeler ORDER BY ulke_adi ASC";
		$ulkeler = $this->db->query($ulkelerQ);
		
		if ($ulkeler->num_rows() > 0) {
			$countryList = array();
			foreach ($ulkeler->result() as $item) {				$countryList[] = array(
					'code' => $item->country_code, 
					'name' => $item->country_name
				);
			}
			$data = array('status' => 'ok', 'message' => '', 'data' => $countryList);
		} else {
			$data = array('status' => 'error', 'message' => 'Ülke Bulunamadı..!');
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	/**
	 * AJAX endpoint to get all provinces (for responsibility areas modal)
	 * Enhanced to support country filtering
	 */
	public function getProvinces(){
		$ulke_kodu = $this->input->post('ulke_kodu');
		
		// Base query for provinces
		if (!empty($ulke_kodu)) {
			// If iller table has ulke_kodu column, filter by it
			// For now, assume Turkey (code 1) gets all provinces, others get none
			if ($ulke_kodu == '1') {
				$illerQ = "SELECT id, il FROM iller ORDER BY il ASC";
			} else {
				// For other countries, return empty result or handle appropriately
				$illerQ = "SELECT id, il FROM iller WHERE 1=0"; // No results for non-Turkey countries
			}
		} else {
			// Default: get all Turkish provinces
			$illerQ = "SELECT id, il FROM iller ORDER BY il ASC";
		}
		
		$iller = $this->db->query($illerQ);
		
		if ($iller->num_rows() > 0) {
			$provinceList = array();
			foreach ($iller->result() as $item) {
				$provinceList[] = array(
					'id' => $item->id, 
					'il' => $item->il
				);
			}
			$data = array('status' => 'success', 'message' => '', 'data' => $provinceList);
		} else {
			$data = array('status' => 'error', 'message' => 'Bu ülke için il bulunamadı');
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	/**
	 * AJAX endpoint to get districts for a province (for responsibility areas)
	 */	public function getDistricts(){
		$il_id = $this->input->post('il_id');
		
		if (empty($il_id)) {
			$data = array('status' => 'error', 'message' => 'İl ID Bilgisi Alınamadı');
		} else {
			$ilceler = $this->db->get_where('ilceler', array('il_id' => $il_id));
			if ($ilceler->num_rows() > 0) {
				$ilceList = array();
				foreach ($ilceler->result() as $item) {
					$ilceList[] = array('id' => $item->id, 'ilce' => $item->ilce);
				}
				$data = array('status' => 'success', 'message' => '', 'data' => $ilceList);
			} else {
				$data = array('status' => 'error', 'message' => 'Bu il için ilçe bulunamadı');
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	/**
	 * AJAX - Sorumluluk Bölgesi Ekle
	 */
	public function addResponsibilityArea(){
		$this->output->set_content_type('application/json');
		
		if(gibYetki() == 1) {
			echo json_encode(['success' => false, 'message' => 'Yetkiniz yok']);
			return;
		}

		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$kullanici_id = $this->input->post('kullanici_id');
		$il_id = $this->input->post('il_id');
		$ilce_id = $this->input->post('ilce_id');

		if(!$kullanici_id || !$il_id || !$ilce_id) {
			echo json_encode(['success' => false, 'message' => 'Eksik parametreler']);
			return;
		}

		// Önce aynı kayıt var mı kontrol et
		$existing = $this->db->get_where('kullanici_sorumluluk_bolgesi', [
			'kullanici' => $kullanici_id,
			'il_id' => $il_id,
			'ilce_id' => $ilce_id,
			'durum' => 1
		])->row();

		if($existing) {
			echo json_encode(['success' => false, 'message' => 'Bu bölge zaten mevcut']);
			return;
		}

		$data = [
			'kullanici' => $kullanici_id,
			'il_id' => $il_id,
			'ilce_id' => $ilce_id,
			'islemi_yapan' => $u_id,
			'islem_tarihi' => date('Y-m-d H:i:s'),
			'durum' => 1
		];

		$result = $this->db->insert('kullanici_sorumluluk_bolgesi', $data);
		
		if($result) {
			echo json_encode(['success' => true, 'message' => 'Sorumluluk bölgesi başarıyla eklendi']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Kayıt eklenirken hata oluştu']);
		}
	}

	/**
	 * AJAX - Sorumluluk Bölgesi Sil
	 */
	public function deleteResponsibilityArea(){
		$this->output->set_content_type('application/json');
		
		if(gibYetki() == 1) {
			echo json_encode(['success' => false, 'message' => 'Yetkiniz yok']);
			return;
		}

		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$id = $this->input->post('id');

		if(!$id) {
			echo json_encode(['success' => false, 'message' => 'ID parametresi eksik']);
			return;
		}

		// Kayıt var mı kontrol et
		$existing = $this->db->get_where('kullanici_sorumluluk_bolgesi', [
			'sorumluluk_id' => $id,
			'durum' => 1
		])->row();

		if(!$existing) {
			echo json_encode(['success' => false, 'message' => 'Kayıt bulunamadı']);
			return;
		}

		// Silmek yerine durumu pasif yap
		$data = [
			'durum' => 0,
			'islemi_yapan' => $u_id,
			'islem_tarihi' => date('Y-m-d H:i:s')
		];

		$result = $this->db->where('sorumluluk_id', $id)->update('kullanici_sorumluluk_bolgesi', $data);
		
		if($result) {
			echo json_encode(['success' => true, 'message' => 'Sorumluluk bölgesi başarıyla silindi']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Silme işlemi sırasında hata oluştu']);
		}
	}
	
	// Çoklu sorumluluk bölgesi ekleme
	public function addMultipleResponsibilityAreas(){
		if(gibYetki() == 1) {
			echo json_encode(['status' => 'error', 'message' => 'Yetkiniz yok']);
			return;
		}

		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;
		$anaHesap = anaHesapBilgisi();

		$regions = $this->input->post('regions');

		// Validation
		if(!$regions || !is_array($regions) || empty($regions)) {
			echo json_encode(['status' => 'error', 'message' => 'Eksik parametre']);
			return;
		}

		$successCount = 0;
		$duplicateCount = 0;
		$errorCount = 0;
		$addedRegions = [];
		$errors = [];
		foreach($regions as $region) {
			$kullanici_id = $region['kullanici_id'] ?? null;
			$ulke_kodu = $region['ulke_kodu'] ?? null;
			$il_id = $region['il_id'] ?? null;
			$ilce_id = $region['ilce_id'] ?? null;
			$durum = $region['durum'] ?? 1;
			$baslangic_tarihi = $region['baslangic_tarihi'] ?? null;
			$bitis_tarihi = $region['bitis_tarihi'] ?? null;
			$aciklama = $region['aciklama'] ?? null;

			// Her bölge için validation
			if(!$kullanici_id || !$il_id || !$ilce_id) {
				$errorCount++;
				$errors[] = "Eksik parametre: Kullanıcı, İl veya İlçe ID";
				continue;
			}

			// Tarih validasyonu
			if($baslangic_tarihi && $bitis_tarihi && $baslangic_tarihi > $bitis_tarihi) {
				$errorCount++;
				$errors[] = "Geçersiz tarih aralığı";
				continue;
			}			// Duplicate kontrolü
			$existing = $this->db->get_where('kullanici_sorumluluk_bolgesi', [
				'kullanici' => $kullanici_id,
				'ulke_kodu' => $ulke_kodu,
				'il_id' => $il_id,
				'ilce_id' => $ilce_id,
				'durum' => 1 // Aktif kayıtları kontrol et
			])->row();

			if($existing) {
				$duplicateCount++;
				continue;
			}			// Veritabanına ekle
			$data = [
				'kullanici' => $kullanici_id,
				'ulke_kodu' => !empty($ulke_kodu) ? $ulke_kodu : '1', // Default to Turkey
				'il_id' => $il_id,
				'ilce_id' => $ilce_id,
				'durum' => $durum,
				'islemi_yapan' => $u_id,
				'islem_tarihi' => date('Y-m-d H:i:s')
			];

			// Ek alanları ekle (eğer migration yapıldıysa)
			if($baslangic_tarihi) {
				$data['baslangic_tarihi'] = $baslangic_tarihi;
			}
			if($bitis_tarihi) {
				$data['bitis_tarihi'] = $bitis_tarihi;
			}
			if($aciklama) {
				$data['aciklama'] = $aciklama;
			}

			$result = $this->db->insert('kullanici_sorumluluk_bolgesi', $data);
			
			if($result) {
				$successCount++;
				
				// İl ve ilçe isimlerini al
				$il = $this->db->get_where('iller', ['id' => $il_id])->row();
				$ilce = $this->db->get_where('ilceler', ['id' => $ilce_id])->row();
				
				$addedRegions[] = [
					'id' => $this->db->insert_id(),
					'il_adi' => $il ? $il->il : '',
					'ilce_adi' => $ilce ? $ilce->ilce : '',
					'durum' => $durum,
					'baslangic_tarihi' => $baslangic_tarihi,
					'bitis_tarihi' => $bitis_tarihi,
					'aciklama' => $aciklama,
					'islem_tarihi' => date('Y-m-d H:i:s')
				];
			} else {
				$errorCount++;
				$errors[] = "Veritabanı hatası";
			}
		}

		// Sonuç mesajı oluştur
		$message = '';
		if($successCount > 0) {
			$message .= $successCount . ' bölge başarıyla eklendi. ';
		}
		if($duplicateCount > 0) {
			$message .= $duplicateCount . ' bölge zaten mevcut. ';
		}
		if($errorCount > 0) {
			$message .= $errorCount . ' bölgede hata oluştu. ';
		}

		if($successCount > 0) {
			echo json_encode([
				'status' => 'success', 
				'message' => trim($message),
				'data' => $addedRegions,
				'stats' => [
					'success' => $successCount,
					'duplicate' => $duplicateCount,
					'error' => $errorCount
				]
			]);
		} else {
			echo json_encode([
				'status' => 'error', 
				'message' => $errorCount > 0 ? 'Hiçbir bölge eklenemedi: ' . implode(', ', array_unique($errors)) : 'Hiçbir bölge eklenmedi'
			]);
		}
	}
	/**
	 * Backward compatibility alias for the old method name
	 */
	public function kullaniciSorumlulukEkle(){
		return $this->addResponsibilityArea();
	}

	/**
	 * Sorumluluk Bölgesi Yönetimi Sayfası
	 */
	public function sorumlulukBolgesi(){
		$data["baslik"] = "Yönetici / Sorumluluk Bölgesi Yönetimi";
		// Kullanıcıları çek
		$data["kullanicilar"] = $this->db->query("
			SELECT kullanici_id, kullanici_ad, kullanici_soyad, kullanici_kullaniciAdi as kullanici_adi 
			FROM kullanicilar 
			WHERE kullanici_durum = 1 
			ORDER BY kullanici_ad, kullanici_soyad
		")->result();
				// İlleri çek
		$data["iller"] = $this->db->query("
			SELECT DISTINCT id as il_id, il as il_adi 
			FROM iller 
			ORDER BY il
		")->result();
				// Mevcut sorumluluk bölgelerini çek
		$data["sorumluluk_bolgeler"] = $this->db->query("
			SELECT 
				ksb.*,
				k.kullanici_ad,
				k.kullanici_soyad,
				i.il as il_adi,
				ic.ilce as ilce_adi
			FROM kullanici_sorumluluk_bolgesi ksb
			LEFT JOIN kullanicilar k ON ksb.kullanici = k.kullanici_id
			LEFT JOIN iller i ON ksb.il_id = i.id
			LEFT JOIN ilceler ic ON ksb.ilce_id = ic.id
			WHERE ksb.durum = 1
			ORDER BY k.kullanici_ad, i.il, ic.ilce
		")->result();
		
		$this->load->view('include/header', $data);
		$this->load->view('yonetici/sorumluluk-bolgesi', $data);
		$this->load->view('include/footer');
	}
	/**
	 * AJAX - İlçeleri Getir
	 */
	public function ilceler(){
		$this->output->set_content_type('application/json');
		
		$il_id = $this->input->post('il_id');
		
		if(!$il_id) {
			echo json_encode([]);
			return;
		}
		
		$ilceler = $this->db->query("
			SELECT id as ilce_id, ilce as ilce_adi 
			FROM ilceler 
			WHERE il_id = ? 
			ORDER BY ilce		", [$il_id])->result();
				echo json_encode($ilceler);	}
}
