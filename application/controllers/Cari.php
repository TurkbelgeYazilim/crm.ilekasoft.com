<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use furkankadioglu\eFatura\InvoiceManager;

class Cari extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');

		$control = session("r", "login");


		if (gibYetki() == 1)
			redirect("home/hata");

		if (!$control) {
			redirect("check");
		}

		//sessionKontrolHelper();
	}

	public function cariGruplari()
	{
		$data["baslik"] = "Cari / Cari Grupları";
		$anaHesap = anaHesapBilgisi();

		$cariGruplariQ = "SELECT * FROM cariGruplari WHERE cariGrup_olusturanAnaHesap = '$anaHesap'";
		$data["cariGruplari"] = $this->db->query($cariGruplariQ)->result();

		$countq = "SELECT COUNT(*) as total FROM cariGruplari WHERE cariGrup_olusturanAnaHesap = '$anaHesap'";
		$countexe = $this->db->query($countq)->row();
		$count = $countexe->total;
		$data["count_of_list"] = $count;

		//logekle(4,1);
		$this->load->view('cari/cari-gruplari', $data);
	}

	public function yeniCariGrubuEkle()
	{
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');

		$anaHesap = anaHesapBilgisi();

		$cariGrup_kodu = postval("cariGrup_kodu");

		$data["cariGrup_kodu"] = $cariGrup_kodu;
		$data["cariGrup_ad"] = postval("cariGrup_ad");
		$data["cariGrup_olusturan"] = $u_id;
		$data["cariGrup_olusturanAnaHesap"] = $anaHesap;
		$data["cariGrup_olusturmaTarihi"] = $tarihi;

		$cariGrupKoduVarmiQ = "SELECT * FROM cariGruplari WHERE cariGrup_kodu = '$cariGrup_kodu' AND cariGrup_olusturanAnaHesap = '$anaHesap'";
		$cariGrupKoduVarmi = $this->db->query($cariGrupKoduVarmiQ)->row();

		if ($cariGrupKoduVarmi) {
			$this->session->set_flashdata('cari_grup_kodvar', 'OK');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->vt->insert("cariGruplari", $data);
			$this->session->set_flashdata('cari_grup_ok', 'OK');
			logekle(4, 2);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function mevcutCariGrubuDuzenle()
	{
		$id = postval("cariGrup_id");
		$cariGrup_kodu = postval("cariGrup_kodu");

		$anaHesap = anaHesapBilgisi();

		$data["cariGrup_kodu"] = $cariGrup_kodu;
		$data["cariGrup_ad"] = postval("cariGrup_ad");

		$cariGrupKoduVarmiQ = "SELECT * FROM cariGruplari WHERE cariGrup_kodu = '$cariGrup_kodu' AND cariGrup_olusturanAnaHesap = '$anaHesap' AND cariGrup_id != $id";
		$cariGrupKoduVarmi = $this->db->query($cariGrupKoduVarmiQ)->row();

		if ($cariGrupKoduVarmi) {
			$this->session->set_flashdata('cari_grup_kodvar', 'OK');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->vt->update('cariGruplari', array('cariGrup_id' => $id), $data);
			$this->session->set_flashdata('cari_grup_updt_ok', 'OK');
			logekle(4, 3);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function cariKartiOlustur()
	{
		$data["baslik"] = "Cari / Cari Kartı Oluştur";
		$iller = $this->db->get('iller');

		if ($iller->num_rows() > 0) {
			$data['_iller'] = $iller->result();
		} else {
			$data['_iller'] = false;
		}

		//logekle(1,1);
		$this->load->view("cari/cari-karti-olustur", $data);
	}	public function yeniCariKartiOlustur()
	{
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$cariTipi = postval("cari_bireysel");
		$cariKodu = postval("cari_kodu");
		$cariVergiNo = postval("cari_vergiNumarasi");
		//	$tckn = postval("cari_tckn");
		$alias_pk = postval("cari_alias_pk");

		if ($alias_pk === "") {//earşiv
			$cariEInvoiceType = 2;
		} else {
			$cariEInvoiceType = 1;
		}
		$cariKoduLen = strlen($cariKodu);
		$cariVergiNoLen = strlen($cariVergiNo);
		
		// Cari Kodu boşsa otomatik oluştur
		if (empty($cariKodu) || $cariKoduLen < 3) {
			// Son cari kodunu bul ve +1 artırarak yeni kod oluştur
			$sonCariKoduQ = "SELECT cari_kodu FROM cari WHERE cari_olusturanAnaHesap = '$anaHesap' AND cari_kodu REGEXP '^[0-9]+$' ORDER BY CAST(cari_kodu AS UNSIGNED) DESC LIMIT 1";
			$sonCariKodu = $this->db->query($sonCariKoduQ)->row();
			
			if ($sonCariKodu) {
				$yeniKodNumara = intval($sonCariKodu->cari_kodu) + 1;
			} else {
				$yeniKodNumara = 1;
			}
			
			$cariKodu = str_pad($yeniKodNumara, 3, '0', STR_PAD_LEFT);
		}
		/*
				if($cariTipi == 0) {
					if ($cariVergiNoLen < 10) {
						$this->session->set_flashdata('cari_kodu_vkn_karakter', 'OK');
						redirect("cari/cari-karti-olustur");
						die;
					}
				}

				if($cariTipi == 1) {
					if ($cariVergiNoLen < 11) {
						$this->session->set_flashdata('cari_kodu_tckn_karakter', 'OK');
						redirect("cari/cari-karti-olustur");
						die;
					}
				}*/

		$vergiKontrolQ = "SELECT * FROM cari WHERE cari_olusturanAnaHesap = '$anaHesap' AND cari_vergiNumarasi = '$cariVergiNo' AND cari_durum=true";
		$vergiKontrol = $this->db->query($vergiKontrolQ)->row();

		if ($cariTipi == 0) {
			if ($vergiKontrol) {
				$this->session->set_flashdata('cari_kodu_vergino', 'OK');
				redirect("cari/cari-karti-olustur");
				die;
			}
		}

		if ($cariVergiNoLen == 10)
			$data["cari_vergiNumarasi"] = $cariVergiNo;
		else if ($cariVergiNoLen == 11)
			$data["cari_tckn"] = $cariVergiNo;


		$data["cari_kodu"] = mb_strtoupper($cariKodu, "UTF-8");;
		$data["cari_ad"] = mb_strtoupper(postval("cari_ad"), "UTF-8");
		$data["cari_soyad"] = mb_strtoupper(postval("cari_soyad"), "UTF-8");
		$data["cari_vergiDairesi"] = mb_strtoupper(postval("cari_vergiDairesi"), "UTF-8");		/*		$data["cari_vergiNumarasi"] = $cariVergiNo;
				$data["cari_tckn"] = $tckn;*/
		$data["cari_cariGrupKoduID"] = postval("cari_cariGrupKoduID");
		$data["cari_ulke"] = postval("cari_ulke");
		$data["cari_il"] = postval("cari_il");
		$data["cari_ilce"] = postval("cari_ilce");
		$data["cari_websitesi"] = postval("cari_websitesi");
		$data["cari_firmaEPosta"] = postval("cari_firmaEPosta");
		$data["cari_firmaTelefon"] = postval("cari_firmaTelefon");
		$data["cari_adres"] = mb_strtoupper(postval("cari_adres"), "UTF-8");
		$data["cari_olusturan"] = $u_id;
		$data["cari_olusturanAnaHesap"] = $anaHesap;
		$data["cari_olusturmaTarihi"] = $tarihi;
		$data["cari_olusturmaSaati"] = $saati;		$data["cari_bireysel"] = $cariTipi;
		$data["cari_EInvoiceType"] = $cariEInvoiceType;
		$data["cari_alias_pk"] = $alias_pk;		// Handle file upload for photos
		$fotograf_dosyalar = [];
		if (!empty($_FILES['cari_fotograflar']['name'][0])) {
			$count = count($_FILES['cari_fotograflar']['name']);
			$gorsel_dir = FCPATH . 'assets/uploads/cariler/gorseller/';
			if (!is_dir($gorsel_dir)) { 
				mkdir($gorsel_dir, 0777, true); 
			}
			for ($i = 0; $i < $count; $i++) {
				if ($_FILES['cari_fotograflar']['error'][$i] == 0) {
					$tmp_name = $_FILES['cari_fotograflar']['tmp_name'][$i];
					$original_name = $_FILES['cari_fotograflar']['name'][$i];
					$name = uniqid('foto_') . '_' . basename($original_name);
					$target_path = $gorsel_dir . $name;
					if (move_uploaded_file($tmp_name, $target_path)) {
						$fotograf_dosyalar[] = 'cariler/gorseller/' . $name;
					}
				}
			}
		}
		if (count($fotograf_dosyalar) > 0) {
			$data['fotograf_dosya'] = implode(',', $fotograf_dosyalar);
		}		// Handle file upload for documents
		$evrak_dosyalar = [];
		if (!empty($_FILES['cari_dosya']['name'][0])) {
			$count = count($_FILES['cari_dosya']['name']);
			$evrak_dir = FCPATH . 'assets/uploads/cariler/evraklar/';
			if (!is_dir($evrak_dir)) { 
				mkdir($evrak_dir, 0777, true); 
			}
			for ($i = 0; $i < $count; $i++) {
				if ($_FILES['cari_dosya']['error'][$i] == 0) {
					$tmp_name = $_FILES['cari_dosya']['tmp_name'][$i];
					$original_name = $_FILES['cari_dosya']['name'][$i];
					$name = uniqid('evrak_') . '_' . basename($original_name);
					$target_path = $evrak_dir . $name;
					if (move_uploaded_file($tmp_name, $target_path)) {
						$evrak_dosyalar[] = 'cariler/evraklar/' . $name;
					}
				}
			}
		}
		if (count($evrak_dosyalar) > 0) {
			$data['evrak_dosya'] = implode(',', $evrak_dosyalar);
		}		$cariKoduVarmiQ = "SELECT * FROM cari WHERE cari_kodu = '$cariKodu' AND cari_olusturanAnaHesap = '$anaHesap' AND cari_durum=true";
		$cariKoduVarmi = $this->db->query($cariKoduVarmiQ)->row();

		$page = postval("page");
		if ($page == "satisfatura") {
			if ($cariKoduVarmi) {
				$this->session->set_flashdata('cari_kodu_mevcut', 'OK');
			} else {
				$this->vt->insert("cari", $data);
				$cari_id = $this->db->insert_id();
				$this->session->set_flashdata('cari_ok', 'OK');
				logekle(1, 2);
			}
			redirect("fatura/satis-faturasi/$cari_id/1");
		} else if ($page == "alisfatura") {
			if ($cariKoduVarmi) {
				$this->session->set_flashdata('cari_kodu_mevcut', 'OK');
			} else {
				$this->vt->insert("cari", $data);
				$cari_id = $this->db->insert_id();
				$this->session->set_flashdata('cari_ok', 'OK');
				logekle(1, 2);
			}
			redirect("fatura/alis-faturasi/$cari_id/1");
		} else if ($page == "earsivfatura") {
			if ($cariKoduVarmi) {
				$this->session->set_flashdata('cari_kodu_mevcut', 'OK');
			} else {
				$this->vt->insert("cari", $data);
				$cari_id = $this->db->insert_id();
				$this->session->set_flashdata('cari_ok', 'OK');
				logekle(1, 2);
			}
			redirect("fatura/earsiv-olustur/$cari_id/1");
		} else if ($page == "efatura") {
			if ($cariKoduVarmi) {
				$this->session->set_flashdata('cari_kodu_mevcut', 'OK');
			} else {
				$this->vt->insert("cari", $data);
				$cari_id = $this->db->insert_id();
				$this->session->set_flashdata('cari_ok', 'OK');
				logekle(1, 2);
			}
			redirect("fatura/efatura-olustur/$cari_id/1");
		} else {
			if ($cariKoduVarmi) {
				$this->session->set_flashdata('cari_kodu_mevcut', 'OK');
				redirect("cari/cari-karti-olustur");
			} else {
				$this->vt->insert("cari", $data);
				$cari_id = $this->db->insert_id();
				$this->session->set_flashdata('cari_ok', 'OK');
				logekle(1, 2);
				redirect("cari/cari-karti-duzenle/$cari_id");
			}
		}
	}	public function cariKartiDuzenle($id)
	{
		$data["baslik"] = "Cari / Cari Kartı Düzenle";
		$anaHesap = anaHesapBilgisi();
		
		// Müşteri bilgilerini getir
		$cariQ = "SELECT c.*, i.il as il_adi, il.ilce as ilce_adi 
				  FROM cari c 
				  LEFT JOIN iller i ON c.cari_il = i.id 
				  LEFT JOIN ilceler il ON c.cari_ilce = il.id 
				  WHERE c.cari_id = '$id' AND c.cari_durum = true";
		$cari = $this->db->query($cariQ)->row();
		
		if (!$cari) {
			show_error('Müşteri bulunamadı!');
			return;
		}
		
		$data["cari"] = $cari;
		
		// İller listesi
		$iller = $this->db->get('iller');
		if ($iller->num_rows() > 0) {
			$data['_iller'] = $iller->result();
		} else {
			$data['_iller'] = false;
		}
		
		// Müşteri grupları
		$cariGruplariQ = "SELECT * FROM cariGruplari WHERE cariGrup_olusturanAnaHesap = '$anaHesap'";
		$data["cariGruplari"] = $this->db->query($cariGruplariQ)->result();
		
		// Detaylı iletişim bilgileri
		$cariDetayliQ = "SELECT * FROM cariDetayliIletisim WHERE cdetay_cariID = '$id'";
		$data["detaylıIletisim"] = $this->db->query($cariDetayliQ)->result();
		
		// Detaylı banka bilgileri
		$cariDetayliBankaQ = "SELECT * FROM cariDetayliBanka WHERE cdetayBanka_cariID = '$id'";
		$data["detayliBanka"] = $this->db->query($cariDetayliBankaQ)->result();
		
		// View'ı yükle
		$this->load->view('cari/cari-karti-olustur', $data);
	}

	public function mevcutCariKartiDuzenle()
	{
		// Debug logging to track form submissions
		$debug_file = FCPATH . 'debug_form_update.log';
		$timestamp = date('Y-m-d H:i:s');
		file_put_contents($debug_file, "=== FORM DEBUG START ===\n", FILE_APPEND);
		file_put_contents($debug_file, "Timestamp: $timestamp\n", FILE_APPEND);
		file_put_contents($debug_file, "Method: mevcutCariKartiDuzenle()\n", FILE_APPEND);
		file_put_contents($debug_file, "POST Data: " . print_r($_POST, true) . "\n", FILE_APPEND);
		
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();
		
		// Get the customer ID from POST data
		$cari_id = postval("cari_id");
		
		if (!$cari_id) {
			file_put_contents($debug_file, "ERROR: No cari_id found in POST data\n", FILE_APPEND);
			$this->session->set_flashdata('cari_update_error', 'OK');
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}
		
		file_put_contents($debug_file, "Customer ID: $cari_id\n", FILE_APPEND);
		
		// Prepare update data
		$cariTipi = postval("cari_bireysel");
		$cariVergiNo = postval("cari_vergiNumarasi");
		$alias_pk = postval("cari_alias_pk");

		if ($alias_pk === "") {
			$cariEInvoiceType = 2;
		} else {
			$cariEInvoiceType = 1;
		}
		
		$cariVergiNoLen = strlen($cariVergiNo);
		
		// Build update data array
		$data = array();
		
		if ($cariVergiNoLen == 10) {
			$data["cari_vergiNumarasi"] = $cariVergiNo;
			$data["cari_tckn"] = null;
		} else if ($cariVergiNoLen == 11) {
			$data["cari_tckn"] = $cariVergiNo;
			$data["cari_vergiNumarasi"] = null;
		}

		$data["cari_kodu"] = mb_strtoupper(postval("cari_kodu"), "UTF-8");
		$data["cari_ad"] = mb_strtoupper(postval("cari_ad"), "UTF-8");
		$data["cari_soyad"] = mb_strtoupper(postval("cari_soyad"), "UTF-8");
		$data["cari_vergiDairesi"] = mb_strtoupper(postval("cari_vergiDairesi"), "UTF-8");
		$data["cari_cariGrupKoduID"] = postval("cari_cariGrupKoduID");
		$data["cari_ulke"] = postval("cari_ulke");
		$data["cari_il"] = postval("cari_il");
		$data["cari_ilce"] = postval("cari_ilce");
		$data["cari_websitesi"] = postval("cari_websitesi");
		$data["cari_firmaEPosta"] = postval("cari_firmaEPosta");
		$data["cari_firmaTelefon"] = postval("cari_firmaTelefon");
		$data["cari_adres"] = mb_strtoupper(postval("cari_adres"), "UTF-8");
		$data["cari_bireysel"] = $cariTipi;
		$data["cari_EInvoiceType"] = $cariEInvoiceType;
		$data["cari_alias_pk"] = $alias_pk;
		
		file_put_contents($debug_file, "Update data prepared: " . print_r($data, true) . "\n", FILE_APPEND);
		
		try {
			// Update the customer record
			$this->vt->update('cari', array('cari_id' => $cari_id), $data);
			
			file_put_contents($debug_file, "Database update successful\n", FILE_APPEND);
			
			// Set success message
			$this->session->set_flashdata('cari_update_ok', 'OK');
			logekle(1, 3); // Log the update action
			
			file_put_contents($debug_file, "=== FORM DEBUG END - SUCCESS ===\n\n", FILE_APPEND);
			
			// Redirect back to the edit form
			redirect("cari/cari-karti-duzenle/$cari_id");
			
		} catch (Exception $e) {
			file_put_contents($debug_file, "Database update failed: " . $e->getMessage() . "\n", FILE_APPEND);
			file_put_contents($debug_file, "=== FORM DEBUG END - ERROR ===\n\n", FILE_APPEND);
					$this->session->set_flashdata('cari_update_error', 'OK');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function cariListesi()
	{
		$data["baslik"] = "Cari / Cari Listesi";
		$anaHesap = anaHesapBilgisi();
		
		// Giriş yapan kullanıcı bilgisi
		$control = session("r", "login_info");
		$u_id = $control->kullanici_id;
		
		// Giriş yapan kullanıcı + bağlı personellerin listesi
		$kullanicilarQ = "SELECT kullanici_id FROM kullanicilar WHERE kullanici_id = '$u_id' OR kullanici_sorumluMudur = '$u_id'";
		$kullanicilar = $this->db->query($kullanicilarQ)->result();
		
		$kullanici_ids = array();
		foreach($kullanicilar as $kullanici) {
			$kullanici_ids[] = $kullanici->kullanici_id;
		}
		$kullanici_ids_str = implode(',', $kullanici_ids);
		
		$cariKodu = $this->input->get('cariKodu');
		$cariAdi = $this->input->get('cariAdi');
		$cariTipi = $this->input->get('bireysel');
		if ($cariTipi == "true") {
			$cariTipi2 = 1;
		} else if ($cariTipi == "false") {
			$cariTipi2 = 0;
		} else {
			$cariTipi2 = 2;
		}
		$cariGrubu = $this->input->get('cariGrubu');
		$bulunduguIl = $this->input->get('bulunduguIl');
		$tarihGet = $this->input->get('tarihAraligi');

		$tarihAraligi = explode(' - ', $tarihGet);
		$tarih1 = date('Y-m-d', strtotime($tarihAraligi[0]));
		$tarih2 = date('Y-m-d', strtotime($tarihAraligi[1]));

		$urim = $this->uri->segment(2);
		$segment = 2;
		$sayfa = $this->input->get("sayfa");
		$page = $sayfa ? $sayfa : 0;
		$limit = 20;
		$pagem = $sayfa ? ($page - 1) * $limit : 0;

		if ((isset($cariKodu) && !empty($cariKodu)) || (isset($cariAdi) && !empty($cariAdi)) || (isset($cariGrubu) && !empty($cariGrubu)) || (isset($bulunduguIl) && !empty($bulunduguIl)) || (isset($tarihGet) && !empty($tarihGet)) || ($cariTipi != 2)) {
			if (!empty($cariGrubu)) {
				$sorgu1 = "AND cari_cariGrupKoduID = '$cariGrubu'";
			} else {
				$sorgu1 = "";
			}
			if (!empty($bulunduguIl)) {
				$sorgu2 = "AND cari_il = '$bulunduguIl'";
			} else {
				$sorgu2 = "";
			}
			if (!empty($tarihGet)) {
				$sorgu3 = "AND cari_olusturmaTarihi BETWEEN '$tarih1' AND '$tarih2'";
			} else {
				$sorgu3 = "";
			}
			if (!empty($cariTipi)) {
				$sorgu4 = "AND cari_bireysel = '$cariTipi2'";
			} else {
				$sorgu4 = "";
			}
			
			$countq = "SELECT COUNT(*) as total FROM cari WHERE cari_durum=true AND cari_olusturan IN ($kullanici_ids_str) AND cari_kodu LIKE '%$cariKodu%' AND cari_ad LIKE '%$cariAdi%' $sorgu1 $sorgu2 $sorgu3 $sorgu4";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;
			$sorgu = "SELECT * FROM cari WHERE cari_durum=true AND cari_olusturan IN ($kullanici_ids_str) AND cari_kodu LIKE '%$cariKodu%' AND cari_ad LIKE '%$cariAdi%' $sorgu1 $sorgu2 $sorgu3 $sorgu4 ORDER BY cari_id DESC LIMIT $pagem,$limit";
		} else {
			$countq = "SELECT COUNT(*) as total FROM cari WHERE cari_durum=true AND cari_olusturan IN ($kullanici_ids_str)";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;
			$sorgu = "SELECT * FROM cari WHERE cari_durum=true AND cari_olusturan IN ($kullanici_ids_str) ORDER BY cari_id DESC LIMIT $pagem,$limit";
		}
		
		$data["count_of_list"] = $count;
		$this->load->library("pagination");
		$config = array();
		$config["base_url"] = base_url() . "/cari/$urim";
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
		$data["cari"] = $this->db->query($sorgu)->result();
		$this->load->view("cari/cari-listesi", $data);
	}

}
