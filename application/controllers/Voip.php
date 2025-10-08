<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Voip extends CI_Controller {



	public function __construct(){

		parent::__construct();



		// Gerekli library ve helper'ları yükle

		$this->load->database();

		$this->load->helper(['url', 'general']);

		$this->load->library(['session', 'form_validation']);



		$control = session("r", "login_info");

		if(!$control){

			redirect("home/login");

		}

	}



	/**

	 * Operatör Tanımlama Sayfası

	 * URL: https://crm.ilekasoft.com/voip/operator-tanimla

	 */

	public function operator_tanimla(){

		// Voip & Hakediş (ID:1900) ana modül yetkisi kontrolü

		if(!grup_modul_yetkisi_var(1900)) {

			redirect("home/hata");

		}



		// Voip Operatör Tanımla (ID:1901) alt modül yetkisi kontrolü

		if(!grup_modul_yetkisi_var(1901)) {

			redirect("home/hata");

		}



		$data["baslik"] = "Voip & Hakediş / Operatör Tanımla";

		

		// Operatörleri getir

		$data["operatorler"] = $this->db->get('voip_operator')->result();

		

		// Her operatör için panel bilgilerini getir

		foreach($data["operatorler"] as $operator) {

			$operator->paneller = $this->db->get_where('voip_operator_panel', ['operator_id' => $operator->operator_id])->result();

		}



		// View yükleme

		$this->load->view('voip/operator-tanimla', $data);

	}



	/**

	 * Operatör Ekle (AJAX)

	 */

	public function operator_ekle(){

		// Content-Type header ayarla

		header('Content-Type: application/json');

		

		// Debug log

		error_log('VoIP operator_ekle çağrıldı - ' . date('Y-m-d H:i:s'));

		error_log('POST data: ' . print_r($_POST, true));

		

		// Yetki kontrolü

		try {

			$yetki_var = grup_modul_yetkisi_var(1901);

			error_log('Yetki kontrolü sonucu: ' . ($yetki_var ? 'var' : 'yok'));

			

			if(!$yetki_var) {

				echo json_encode(['success' => false, 'message' => 'Yetki yok']);

				return;

			}

		} catch (Exception $e) {

			error_log('Yetki kontrolü hatası: ' . $e->getMessage());

			echo json_encode(['success' => false, 'message' => 'Yetki kontrolü hatası: ' . $e->getMessage()]);

			return;

		}



		// POST verilerini al

		$operator_adi = $this->input->post('operator_adi');

		$aciklama = $this->input->post('aciklama');

		

		error_log('Operator adı: ' . $operator_adi);

		error_log('Açıklama: ' . $aciklama);



		// Validation

		if(empty($operator_adi)) {

			echo json_encode(['success' => false, 'message' => 'Operatör adı gereklidir']);

			return;

		}



		// Aynı isimde operatör var mı kontrol et

		try {

			$existing = $this->db->get_where('voip_operator', ['operator_adi' => $operator_adi])->row();

			if($existing) {

				echo json_encode(['success' => false, 'message' => 'Bu operatör adı zaten kullanımda']);

				return;

			}

		} catch (Exception $e) {

			error_log('Veritabanı kontrol hatası: ' . $e->getMessage());

		}



		// Veri hazırla

		$data = [

			'operator_adi' => trim($operator_adi),

			'aciklama' => trim($aciklama)

		];

		

		error_log('Kaydedilecek data: ' . print_r($data, true));



		// Veritabanına kaydet

		try {

			$result = $this->db->insert('voip_operator', $data);

			error_log('Insert sonucu: ' . ($result ? 'başarılı' : 'başarısız'));

			

			if($result) {

				$insert_id = $this->db->insert_id();

				error_log('Insert ID: ' . $insert_id);

				

				echo json_encode([

					'success' => true, 

					'message' => 'Operatör başarıyla eklendi',

					'operator_id' => $insert_id

				]);

			} else {

				$db_error = $this->db->error();

				error_log('DB Error: ' . print_r($db_error, true));

				echo json_encode(['success' => false, 'message' => 'Veritabanı kaydetme hatası']);

			}

		} catch (Exception $e) {

			error_log('Veritabanı insert hatası: ' . $e->getMessage());

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası: ' . $e->getMessage()]);

		}

	}



	/**

	 * Operatör Sil (AJAX)

	 */

	public function operator_sil(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1901)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$operator_id = $this->input->post('operator_id');



		if(empty($operator_id)) {

			echo json_encode(['success' => false, 'message' => 'Operatör ID gereklidir']);

			return;

		}



		// Operatörü sil

		if($this->db->delete('voip_operator', ['operator_id' => $operator_id])) {

			echo json_encode(['success' => true, 'message' => 'Operatör başarıyla silindi']);

		} else {

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

		}

	}



	/**

	 * Operatör Güncelle (AJAX)

	 */

	public function operator_guncelle(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1901)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$operator_id = $this->input->post('operator_id');

		$operator_adi = $this->input->post('operator_adi');

		$aciklama = $this->input->post('aciklama');



		if(empty($operator_id) || empty($operator_adi)) {

			echo json_encode(['success' => false, 'message' => 'Operatör ID ve adı gereklidir']);

			return;

		}



		// Aynı isimde başka operatör var mı kontrol et

		$existing = $this->db->query("SELECT * FROM voip_operator WHERE operator_adi = ? AND operator_id != ?", [$operator_adi, $operator_id])->row();

		if($existing) {

			echo json_encode(['success' => false, 'message' => 'Bu operatör adı zaten kullanımda']);

			return;

		}



		$data = [

			'operator_adi' => trim($operator_adi),

			'aciklama' => trim($aciklama)

		];



		if($this->db->update('voip_operator', $data, ['operator_id' => $operator_id])) {

			echo json_encode(['success' => true, 'message' => 'Operatör başarıyla güncellendi']);

		} else {

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

		}

	}



	/**

	 * Panel Ekle (AJAX)

	 */

	public function panel_ekle(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1901)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$operator_id = $this->input->post('operator_id');

		$panel_link = $this->input->post('panel_link');

		$panel_kullanici_adi = $this->input->post('panel_kullanici_adi');

		$panel_sifre = $this->input->post('panel_sifre');



		if(empty($operator_id) || empty($panel_link)) {

			echo json_encode(['success' => false, 'message' => 'Operatör ve panel linki gereklidir']);

			return;

		}



		$data = [

			'operator_id' => $operator_id,

			'panel_link' => trim($panel_link),

			'panel_kullanici_adi' => trim($panel_kullanici_adi),

			'panel_sifre' => trim($panel_sifre)

		];



		if($this->db->insert('voip_operator_panel', $data)) {

			echo json_encode(['success' => true, 'message' => 'Panel başarıyla eklendi']);

		} else {

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

		}

	}



	/**

	 * Panel Sil (AJAX)

	 */

	public function panel_sil(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1901)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$panel_id = $this->input->post('panel_id');



		if(empty($panel_id)) {

			echo json_encode(['success' => false, 'message' => 'Panel ID gereklidir']);

			return;

		}



		if($this->db->delete('voip_operator_panel', ['panel_id' => $panel_id])) {

			echo json_encode(['success' => true, 'message' => 'Panel başarıyla silindi']);

		} else {

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

		}

	}



	/**

	 * Panel Güncelle (AJAX)

	 */

	public function panel_guncelle(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1901)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$panel_id = $this->input->post('panel_id');

		$panel_link = $this->input->post('panel_link');

		$panel_kullanici_adi = $this->input->post('panel_kullanici_adi');

		$panel_sifre = $this->input->post('panel_sifre');



		if(empty($panel_id) || empty($panel_link)) {

			echo json_encode(['success' => false, 'message' => 'Panel ID ve linki gereklidir']);

			return;

		}



		$data = [

			'panel_link' => trim($panel_link),

			'panel_kullanici_adi' => trim($panel_kullanici_adi),

			'panel_sifre' => trim($panel_sifre)

		];



		if($this->db->update('voip_operator_panel', $data, ['panel_id' => $panel_id])) {

			echo json_encode(['success' => true, 'message' => 'Panel başarıyla güncellendi']);

		} else {

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

		}

	}



	/**

	 * Numara Tanımlama Sayfası

	 * URL: https://crm.ilekasoft.com/voip/numara-tanimla

	 */

	public function numara_tanimla(){

		// Voip & Hakediş (ID:1900) ana modül yetkisi kontrolü

		if(!grup_modul_yetkisi_var(1900)) {

			redirect("home/hata");

		}



		// Voip Numara Tanımla (ID:1902) alt modül yetkisi kontrolü

		if(!grup_modul_yetkisi_var(1902)) {

			redirect("home/hata");

		}



		$data["baslik"] = "Voip & Hakediş / Numara Tanımla";

		

		// Operatörleri getir

		$data["operatorler"] = $this->db->get('voip_operator')->result();

		

		// Filtreleme parametrelerini al

		$filtre_numara = $this->input->post('filtre_numara');

		$filtre_operator = $this->input->post('filtre_operator');

		$filtre_kullanici = $this->input->post('filtre_kullanici');

		$filtre_durum = $this->input->post('filtre_durum');

		

		// Filtreleri data'ya ekle

		$data["filtre_numara"] = $filtre_numara;

		$data["filtre_operator"] = $filtre_operator;

		$data["filtre_kullanici"] = $filtre_kullanici;

		$data["filtre_durum"] = $filtre_durum;

		

		// Numaraları getir - filtreleme ile

		$this->db->select('voip_numara.*, voip_operator.operator_adi');

		$this->db->from('voip_numara');

		$this->db->join('voip_operator', 'voip_numara.operator_id = voip_operator.operator_id', 'left');

		

		// Filtreler

		if(!empty($filtre_numara)) {

			$this->db->like('voip_numara.voip_numara', $filtre_numara);

		}

		if(!empty($filtre_operator)) {

			$this->db->where('voip_numara.operator_id', $filtre_operator);

		}

		if(!empty($filtre_kullanici)) {

			$this->db->like('voip_numara.kullanici_adi', $filtre_kullanici);

		}

		if($filtre_durum !== '' && $filtre_durum !== null) {

			$this->db->where('voip_numara.durum', $filtre_durum);

		}

		

		$this->db->order_by('voip_numara.numara_id', 'DESC');

		$data["numaralar"] = $this->db->get()->result();



		$this->load->view('voip/numara-tanimla', $data);

	}



	/**

	 * Numara Ekle (AJAX)

	 */

	public function numara_ekle(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1902)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$operator_id = $this->input->post('operator_id');

		$voip_numara = $this->input->post('voip_numara');

		$kullanici_adi = $this->input->post('kullanici_adi');

		$sifre = $this->input->post('sifre');

		$ip_adresi = $this->input->post('ip_adresi');

		$aciklama = $this->input->post('aciklama');

		$durum = $this->input->post('durum') ? 1 : 0;



		if(empty($operator_id) || empty($voip_numara)) {

			echo json_encode(['success' => false, 'message' => 'Operatör ve numara gereklidir']);

			return;

		}



		// Aynı numara var mı kontrol et

		$existing = $this->db->get_where('voip_numara', ['voip_numara' => $voip_numara])->row();

		if($existing) {

			echo json_encode(['success' => false, 'message' => 'Bu numara zaten kayıtlı']);

			return;

		}



		$data = [

			'operator_id' => $operator_id,

			'voip_numara' => trim($voip_numara),

			'kullanici_adi' => trim($kullanici_adi),

			'sifre' => trim($sifre),

			'ip_adresi' => trim($ip_adresi),

			'aciklama' => trim($aciklama),

			'durum' => $durum

		];



		if($this->db->insert('voip_numara', $data)) {

			echo json_encode(['success' => true, 'message' => 'Numara başarıyla eklendi']);

		} else {

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

		}

	}



	/**

	 * Numara Sil (AJAX)

	 */

	public function numara_sil(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1902)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$numara_id = $this->input->post('numara_id');



		if(empty($numara_id)) {

			echo json_encode(['success' => false, 'message' => 'Numara ID gereklidir']);

			return;

		}



		if($this->db->delete('voip_numara', ['numara_id' => $numara_id])) {

			echo json_encode(['success' => true, 'message' => 'Numara başarıyla silindi']);

		} else {

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

		}

	}



	/**

	 * Numara Güncelle (AJAX)

	 */

	public function numara_guncelle(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1902)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$numara_id = $this->input->post('numara_id');

		$operator_id = $this->input->post('operator_id');

		$voip_numara = $this->input->post('voip_numara');

		$kullanici_adi = $this->input->post('kullanici_adi');

		$sifre = $this->input->post('sifre');

		$ip_adresi = $this->input->post('ip_adresi');

		$aciklama = $this->input->post('aciklama');

		$durum = $this->input->post('durum') ? 1 : 0;



		if(empty($numara_id) || empty($operator_id) || empty($voip_numara)) {

			echo json_encode(['success' => false, 'message' => 'Numara ID, operatör ve numara gereklidir']);

			return;

		}



		// Aynı numara başka kayıtta var mı kontrol et

		$existing = $this->db->query("SELECT * FROM voip_numara WHERE voip_numara = ? AND numara_id != ?", [$voip_numara, $numara_id])->row();

		if($existing) {

			echo json_encode(['success' => false, 'message' => 'Bu numara zaten kayıtlı']);

			return;

		}



		$data = [

			'operator_id' => $operator_id,

			'voip_numara' => trim($voip_numara),

			'kullanici_adi' => trim($kullanici_adi),

			'sifre' => trim($sifre),

			'ip_adresi' => trim($ip_adresi),

			'aciklama' => trim($aciklama),

			'durum' => $durum

		];



		if($this->db->update('voip_numara', $data, ['numara_id' => $numara_id])) {

			echo json_encode(['success' => true, 'message' => 'Numara başarıyla güncellendi']);

		} else {

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

		}

	}



	/**

	 * Numara Getir (AJAX) - Düzenleme için

	 */

	public function numara_getir(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1902)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$numara_id = $this->input->post('numara_id');



		if(empty($numara_id)) {

			echo json_encode(['success' => false, 'message' => 'Numara ID gereklidir']);

			return;

		}



		$numara = $this->db->get_where('voip_numara', ['numara_id' => $numara_id])->row();



		if($numara) {

			echo json_encode(['success' => true, 'data' => $numara]);

		} else {

			echo json_encode(['success' => false, 'message' => 'Numara bulunamadı']);

		}

	}



	/**

	 * Numara Teslim Sayfası

	 * URL: https://crm.ilekasoft.com/voip/numara-teslim

	 */

	public function numara_teslim(){

		// Voip & Hakediş (ID:1900) ana modül yetkisi kontrolü

		if(!grup_modul_yetkisi_var(1900)) {

			redirect("home/hata");

		}



		// Voip Numara Teslim (ID:1903) alt modül yetkisi kontrolü

		if(!grup_modul_yetkisi_var(1903)) {

			redirect("home/hata");

		}



		$data["baslik"] = "Voip & Hakediş / Numara Teslim";

		

		// Filtreleme parametrelerini al

		$filtre_numara = $this->input->post('filtre_numara');

		$filtre_operator = $this->input->post('filtre_operator');

		$filtre_kullanici = $this->input->post('filtre_kullanici');

		$filtre_tarih_baslangic = $this->input->post('filtre_tarih_baslangic');

		$filtre_tarih_bitis = $this->input->post('filtre_tarih_bitis');

		$filtre_durum = $this->input->post('filtre_durum');

		

		// Filtreleri data'ya ekle

		$data["filtre_numara"] = $filtre_numara;

		$data["filtre_operator"] = $filtre_operator;

		$data["filtre_kullanici"] = $filtre_kullanici;

		$data["filtre_tarih_baslangic"] = $filtre_tarih_baslangic;

		$data["filtre_tarih_bitis"] = $filtre_tarih_bitis;

		$data["filtre_durum"] = $filtre_durum;

		

		// Aktif numaraları getir (operator ile birlikte)

		$this->db->select('voip_numara.*, voip_operator.operator_adi');

		$this->db->from('voip_numara');

		$this->db->join('voip_operator', 'voip_numara.operator_id = voip_operator.operator_id', 'left');

		$this->db->where('voip_numara.durum', 1); // Sadece aktif numaralar

		$this->db->order_by('voip_operator.operator_adi, voip_numara.voip_numara');

		$data["numaralar"] = $this->db->get()->result();

		

		// Aktif kullanıcıları getir

		$this->db->select('kullanici_id, kullanici_ad, kullanici_soyad');

		$this->db->from('kullanicilar');

		$this->db->where('kullanici_durum', 1);

		$this->db->order_by('kullanici_ad, kullanici_soyad');

		$data["kullanicilar"] = $this->db->get()->result();

		

		// Operatörleri getir

		$data["operatorler"] = $this->db->get('voip_operator')->result();

		

		// Teslim kayıtlarını getir - filtreleme ile

		$this->db->select('vnt.*, vn.voip_numara, vo.operator_adi, k.kullanici_ad, k.kullanici_soyad');

		$this->db->from('voip_numara_teslim vnt');

		$this->db->join('voip_numara vn', 'vnt.numara_id = vn.numara_id', 'left');

		$this->db->join('voip_operator vo', 'vn.operator_id = vo.operator_id', 'left');

		$this->db->join('kullanicilar k', 'vnt.kullanici_id = k.kullanici_id', 'left');

		

		// Filtreler

		if(!empty($filtre_numara)) {

			$this->db->like('vn.voip_numara', $filtre_numara);

		}

		if(!empty($filtre_operator)) {

			$this->db->where('vn.operator_id', $filtre_operator);

		}

		if(!empty($filtre_kullanici)) {

			$this->db->where('vnt.kullanici_id', $filtre_kullanici);

		}

		if(!empty($filtre_tarih_baslangic)) {

			$this->db->where('DATE(vnt.teslim_tarihi) >=', $filtre_tarih_baslangic);

		}

		if(!empty($filtre_tarih_bitis)) {

			$this->db->where('DATE(vnt.teslim_tarihi) <=', $filtre_tarih_bitis);

		}

		if($filtre_durum !== '' && $filtre_durum !== null) {

			if($filtre_durum == '1') {

				// Aktif (İade edilmemiş)

				$this->db->where('vnt.iade_tarihi IS NULL', null, false);

			} elseif($filtre_durum == '0') {

				// İade edilmiş

				$this->db->where('vnt.iade_tarihi IS NOT NULL', null, false);

			}

		}

		

		$this->db->order_by('vnt.teslim_tarihi', 'DESC');

		$data["teslimler"] = $this->db->get()->result();



		$this->load->view('voip/numara-teslim', $data);

	}



	/**

	 * Numara Teslim Ekle (AJAX)

	 */

	public function teslim_ekle(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1903)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$numara_id = $this->input->post('numara_id');

		$kullanici_id = $this->input->post('kullanici_id');

		$aciklama = $this->input->post('aciklama');



		if(empty($numara_id) || empty($kullanici_id)) {

			echo json_encode(['success' => false, 'message' => 'Numara ve kullanıcı seçimi gereklidir']);

			return;

		}



		// Aynı numara için aktif teslim var mı kontrol et (iade edilmemiş)

		$existing = $this->db->get_where('voip_numara_teslim', [

			'numara_id' => $numara_id,

			'iade_tarihi' => NULL

		])->row();

		if($existing) {

			echo json_encode(['success' => false, 'message' => 'Bu numara zaten teslim edilmiş ve henüz iade edilmemiş']);

			return;

		}



		$data = [

			'numara_id' => $numara_id,

			'kullanici_id' => $kullanici_id,

			'aciklama' => trim($aciklama),

			'teslim_tarihi' => date('Y-m-d H:i:s')

		];



		if($this->db->insert('voip_numara_teslim', $data)) {

			echo json_encode(['success' => true, 'message' => 'Numara başarıyla teslim edildi']);

		} else {

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

		}

	}



	/**

	 * Numara Teslim Sil (AJAX)

	 */

	public function teslim_sil(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1903)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$teslim_id = $this->input->post('teslim_id');



		if(empty($teslim_id)) {

			echo json_encode(['success' => false, 'message' => 'Teslim ID gereklidir']);

			return;

		}



		if($this->db->delete('voip_numara_teslim', ['teslim_id' => $teslim_id])) {

			echo json_encode(['success' => true, 'message' => 'Teslim kaydı başarıyla silindi']);

		} else {

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

		}

	}



	/**

	 * Numara Teslim Güncelle (AJAX)

	 */

	public function teslim_guncelle(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1903)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$teslim_id = $this->input->post('teslim_id');

		$numara_id = $this->input->post('numara_id');

		$kullanici_id = $this->input->post('kullanici_id');

		$aciklama = $this->input->post('aciklama');



		if(empty($teslim_id) || empty($numara_id) || empty($kullanici_id)) {

			echo json_encode(['success' => false, 'message' => 'Teslim ID, numara ve kullanıcı seçimi gereklidir']);

			return;

		}



		// Aynı numara için başka aktif teslim var mı kontrol et

		$existing = $this->db->query("SELECT * FROM voip_numara_teslim WHERE numara_id = ? AND teslim_id != ?", [$numara_id, $teslim_id])->row();

		if($existing) {

			echo json_encode(['success' => false, 'message' => 'Bu numara başka bir kullanıcıya teslim edilmiş']);

			return;

		}



		$data = [

			'numara_id' => $numara_id,

			'kullanici_id' => $kullanici_id,

			'aciklama' => trim($aciklama)

		];



		if($this->db->update('voip_numara_teslim', $data, ['teslim_id' => $teslim_id])) {

			echo json_encode(['success' => true, 'message' => 'Teslim kaydı başarıyla güncellendi']);

		} else {

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

		}

	}



	/**

	 * Numara Teslim Getir (AJAX) - Düzenleme için

	 */

	public function teslim_getir(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1903)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$teslim_id = $this->input->post('teslim_id');



		if(empty($teslim_id)) {

			echo json_encode(['success' => false, 'message' => 'Teslim ID gereklidir']);

			return;

		}



		$teslim = $this->db->get_where('voip_numara_teslim', ['teslim_id' => $teslim_id])->row();



		if($teslim) {

			echo json_encode(['success' => true, 'data' => $teslim]);

		} else {

			echo json_encode(['success' => false, 'message' => 'Teslim kaydı bulunamadı']);

		}

	}



	/**

	 * Numara İade Et (AJAX)

	 */

	public function numara_iade(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1903)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$teslim_id = $this->input->post('teslim_id');



		if(empty($teslim_id)) {

			echo json_encode(['success' => false, 'message' => 'Teslim ID gereklidir']);

			return;

		}



		// Teslim kaydını kontrol et

		$teslim = $this->db->get_where('voip_numara_teslim', ['teslim_id' => $teslim_id])->row();

		if(!$teslim) {

			echo json_encode(['success' => false, 'message' => 'Teslim kaydı bulunamadı']);

			return;

		}



		// Zaten iade edilmiş mi kontrol et

		if($teslim->iade_tarihi) {

			echo json_encode(['success' => false, 'message' => 'Bu numara zaten iade edilmiş']);

			return;

		}



		// İade tarihini güncelle

		$data = [

			'iade_tarihi' => date('Y-m-d H:i:s')

		];



		if($this->db->update('voip_numara_teslim', $data, ['teslim_id' => $teslim_id])) {

			echo json_encode(['success' => true, 'message' => 'Numara başarıyla iade edildi']);

		} else {

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

		}

	}



	/**

	 * Günlük Harcama Sayfası

	 * URL: https://crm.ilekasoft.com/voip/gunluk-harcama

	 */

	public function gunluk_harcama(){

		// Voip & Hakediş (ID:1900) ana modül yetkisi kontrolü

		if(!grup_modul_yetkisi_var(1900)) {

			redirect("home/hata");

		}



		// Voip Günlük Harcama (ID:1904) alt modül yetkisi kontrolü

		if(!grup_modul_yetkisi_var(1904)) {

			redirect("home/hata");

		}



		$data["baslik"] = "Voip & Hakediş / Günlük Harcama";

		

		// Aktif numaraları getir (operator ile birlikte)

		$this->db->select('voip_numara.*, voip_operator.operator_adi');

		$this->db->from('voip_numara');

		$this->db->join('voip_operator', 'voip_numara.operator_id = voip_operator.operator_id', 'left');

		$this->db->where('voip_numara.durum', 1); // Sadece aktif numaralar

		$this->db->order_by('voip_operator.operator_adi, voip_numara.voip_numara');

		$data["numaralar"] = $this->db->get()->result();

		

		// Günlük harcama kayıtlarını getir (son 30 gün)

		$this->db->select('vgh.*, vn.voip_numara, vo.operator_adi, 

			COALESCE(teslim_k.kullanici_ad, k.kullanici_ad) as kullanici_ad, 

			COALESCE(teslim_k.kullanici_soyad, k.kullanici_soyad) as kullanici_soyad');

		$this->db->from('voip_gunluk_harcama vgh');

		$this->db->join('voip_numara vn', 'vgh.numara_id = vn.numara_id', 'left');

		$this->db->join('voip_operator vo', 'vn.operator_id = vo.operator_id', 'left');

		$this->db->join('kullanicilar k', 'vgh.kaydeden_kullanici_id = k.kullanici_id', 'left');

		

		// O tarihte numaranın teslim edildiği kullanıcıyı bul

		$this->db->join('(SELECT vnt1.numara_id, vnt1.kullanici_id, vnt1.teslim_tarihi 

			FROM voip_numara_teslim vnt1 

			WHERE vnt1.iade_tarihi IS NULL 

			AND vnt1.teslim_tarihi = (

				SELECT MAX(vnt2.teslim_tarihi) 

				FROM voip_numara_teslim vnt2 

				WHERE vnt2.numara_id = vnt1.numara_id 

				AND vnt2.iade_tarihi IS NULL

			)) teslim_son', 'vgh.numara_id = teslim_son.numara_id AND DATE(teslim_son.teslim_tarihi) <= vgh.tarih', 'left');

		$this->db->join('kullanicilar teslim_k', 'teslim_son.kullanici_id = teslim_k.kullanici_id', 'left');

		$this->db->where('vgh.tarih >=', date('Y-m-d', strtotime('-30 days')));

		$this->db->order_by('vgh.tarih DESC, vo.operator_adi, vn.voip_numara');

		$data["harcamalar"] = $this->db->get()->result();



		$this->load->view('voip/gunluk-harcama', $data);

	}



	/**

	 * Günlük Harcama Ekle (AJAX)

	 */

	public function harcama_ekle(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1904)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$numara_id = $this->input->post('numara_id');

		$tarih = $this->input->post('tarih');

		$harcama_tutari = $this->input->post('harcama_tutari');

		$aciklama = $this->input->post('aciklama');



		if(empty($numara_id) || empty($tarih) || empty($harcama_tutari)) {

			echo json_encode(['success' => false, 'message' => 'Numara, tarih ve harcama tutarı gereklidir']);

			return;

		}



		// Tutar kontrolü

		if(!is_numeric($harcama_tutari) || $harcama_tutari < 0) {

			echo json_encode(['success' => false, 'message' => 'Harcama tutarı geçerli bir sayı olmalıdır']);

			return;

		}



		// Session bilgisini güvenli şekilde al

		$login_info = session("r", "login_info");

		$kullanici_id = null;

		if(is_object($login_info) && isset($login_info->kullanici_id)) {

			$kullanici_id = $login_info->kullanici_id;

		} elseif(is_array($login_info) && isset($login_info['kullanici_id'])) {

			$kullanici_id = $login_info['kullanici_id'];

		}



		// Aynı numara ve tarih için kayıt var mı kontrol et

		$existing = $this->db->get_where('voip_gunluk_harcama', [

			'numara_id' => $numara_id,

			'tarih' => $tarih

		])->row();



		$data = [

			'numara_id' => $numara_id,

			'tarih' => $tarih,

			'harcama_tutari' => number_format($harcama_tutari, 2, '.', ''),

			'aciklama' => trim($aciklama),

			'kaydeden_kullanici_id' => $kullanici_id

		];



		if($existing) {

			// Eğer kayıt varsa güncelle

			if($this->db->update('voip_gunluk_harcama', $data, ['harcama_id' => $existing->harcama_id])) {

				echo json_encode(['success' => true, 'message' => 'Harcama kaydı başarıyla güncellendi']);

			} else {

				echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

			}

		} else {

			// Eğer kayıt yoksa yeni ekle

			if($this->db->insert('voip_gunluk_harcama', $data)) {

				echo json_encode(['success' => true, 'message' => 'Harcama kaydı başarıyla eklendi']);

			} else {

				echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

			}

		}

	}



	/**

	 * Günlük Harcama Sil (AJAX)

	 */

	public function harcama_sil(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1904)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$harcama_id = $this->input->post('harcama_id');



		if(empty($harcama_id)) {

			echo json_encode(['success' => false, 'message' => 'Harcama ID gereklidir']);

			return;

		}



		if($this->db->delete('voip_gunluk_harcama', ['harcama_id' => $harcama_id])) {

			echo json_encode(['success' => true, 'message' => 'Harcama kaydı başarıyla silindi']);

		} else {

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

		}

	}



	/**

	 * Günlük Harcama Güncelle (AJAX)

	 */

	public function harcama_guncelle(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1904)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$harcama_id = $this->input->post('harcama_id');

		$numara_id = $this->input->post('numara_id');

		$tarih = $this->input->post('tarih');

		$harcama_tutari = $this->input->post('harcama_tutari');

		$aciklama = $this->input->post('aciklama');



		if(empty($harcama_id) || empty($numara_id) || empty($tarih) || empty($harcama_tutari)) {

			echo json_encode(['success' => false, 'message' => 'Harcama ID, numara, tarih ve harcama tutarı gereklidir']);

			return;

		}



		// Tutar kontrolü

		if(!is_numeric($harcama_tutari) || $harcama_tutari < 0) {

			echo json_encode(['success' => false, 'message' => 'Harcama tutarı geçerli bir sayı olmalıdır']);

			return;

		}



		// Aynı numara ve tarih için başka kayıt var mı kontrol et

		$existing = $this->db->query("SELECT * FROM voip_gunluk_harcama WHERE numara_id = ? AND tarih = ? AND harcama_id != ?", [$numara_id, $tarih, $harcama_id])->row();

		if($existing) {

			echo json_encode(['success' => false, 'message' => 'Bu numara için bu tarihte zaten başka harcama kaydı var']);

			return;

		}



		$data = [

			'numara_id' => $numara_id,

			'tarih' => $tarih,

			'harcama_tutari' => number_format($harcama_tutari, 2, '.', ''),

			'aciklama' => trim($aciklama)

		];



		if($this->db->update('voip_gunluk_harcama', $data, ['harcama_id' => $harcama_id])) {

			echo json_encode(['success' => true, 'message' => 'Harcama kaydı başarıyla güncellendi']);

		} else {

			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);

		}

	}



	/**

	 * Günlük Harcama Getir (AJAX) - Düzenleme için

	 */

	public function harcama_getir(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1904)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$harcama_id = $this->input->post('harcama_id');



		if(empty($harcama_id)) {

			echo json_encode(['success' => false, 'message' => 'Harcama ID gereklidir']);

			return;

		}



		$harcama = $this->db->get_where('voip_gunluk_harcama', ['harcama_id' => $harcama_id])->row();



		if($harcama) {

			echo json_encode(['success' => true, 'data' => $harcama]);

		} else {

			echo json_encode(['success' => false, 'message' => 'Harcama kaydı bulunamadı']);

		}

	}



	/**

	 * Harcama Raporu (AJAX) - Tarih aralığına göre filtreleme

	 */

	public function harcama_raporu(){

		// Content-Type header ayarla

		header('Content-Type: application/json');



		if(!grup_modul_yetkisi_var(1904)) {

			echo json_encode(['success' => false, 'message' => 'Yetki yok']);

			return;

		}



		$baslangic_tarihi = $this->input->post('baslangic_tarihi');

		$bitis_tarihi = $this->input->post('bitis_tarihi');

		$numara_id = $this->input->post('numara_id'); // Opsiyonel, belirli numara filtresi

		$operator_id = $this->input->post('operator_id'); // Operatör filtresi



		if(empty($baslangic_tarihi) || empty($bitis_tarihi)) {

			echo json_encode(['success' => false, 'message' => 'Başlangıç ve bitiş tarihi gereklidir']);

			return;

		}



		$this->db->select('vgh.*, vn.voip_numara, vo.operator_adi, 

			COALESCE(teslim_k.kullanici_ad, k.kullanici_ad) as kullanici_ad, 

			COALESCE(teslim_k.kullanici_soyad, k.kullanici_soyad) as kullanici_soyad');

		$this->db->from('voip_gunluk_harcama vgh');

		$this->db->join('voip_numara vn', 'vgh.numara_id = vn.numara_id', 'left');

		$this->db->join('voip_operator vo', 'vn.operator_id = vo.operator_id', 'left');

		$this->db->join('kullanicilar k', 'vgh.kaydeden_kullanici_id = k.kullanici_id', 'left');

		

		// O tarihte numaranın teslim edildiği kullanıcıyı bul

		$this->db->join('(SELECT vnt1.numara_id, vnt1.kullanici_id, vnt1.teslim_tarihi 

			FROM voip_numara_teslim vnt1 

			WHERE vnt1.iade_tarihi IS NULL 

			AND vnt1.teslim_tarihi = (

				SELECT MAX(vnt2.teslim_tarihi) 

				FROM voip_numara_teslim vnt2 

				WHERE vnt2.numara_id = vnt1.numara_id 

				AND vnt2.iade_tarihi IS NULL

			)) teslim_son', 'vgh.numara_id = teslim_son.numara_id AND DATE(teslim_son.teslim_tarihi) <= vgh.tarih', 'left');

		$this->db->join('kullanicilar teslim_k', 'teslim_son.kullanici_id = teslim_k.kullanici_id', 'left');

		$this->db->where('vgh.tarih >=', $baslangic_tarihi);

		$this->db->where('vgh.tarih <=', $bitis_tarihi);

		

		if(!empty($numara_id)) {

			$this->db->where('vgh.numara_id', $numara_id);

		}
		
		// Operatör filtresi eklendi
		if(!empty($operator_id)) {
			$this->db->where('vo.operator_adi', $operator_id);
		}
		

		$this->db->order_by('vgh.tarih DESC, vo.operator_adi, vn.voip_numara');

		$harcamalar = $this->db->get()->result();



		// Toplam harcama hesapla

		$toplam = 0;

		foreach($harcamalar as $harcama) {

			$toplam += $harcama->harcama_tutari;

		}



		echo json_encode([

			'success' => true, 

			'data' => $harcamalar,

			'toplam' => number_format($toplam, 2, '.', ''),

			'kayit_sayisi' => count($harcamalar)

		]);

	}

	/**
	 * Hakediş Tanımlama Sayfası
	 * URL: https://crm.ilekasoft.com/voip/hakedis-tanimlama
	 */
	public function hakedis_tanimlama(){
		// Voip & Hakediş (ID:1900) ana modül yetkisi kontrolü
		if(!grup_modul_yetkisi_var(1900)) {
			redirect("home/hata");
		}

		// Hakediş Tanımlama (ID:1905) alt modül yetkisi kontrolü
		if(!grup_modul_yetkisi_var(1905)) {
			redirect("home/hata");
		}

		$data["baslik"] = "Voip & Hakediş / Hakediş Tanımlama";
		
		// Kullanıcıları getir
		$this->db->select('kullanici_id, kullanici_ad, kullanici_soyad');
		$this->db->from('kullanicilar');
		$this->db->where('kullanici_durum', 1); // Sadece aktif kullanıcılar
		$this->db->order_by('kullanici_ad, kullanici_soyad');
		$data["kullanicilar"] = $this->db->get()->result();
		
		// Hakediş ücret kayıtlarını getir
		$this->db->select('vh.*, k.kullanici_ad, k.kullanici_soyad');
		$this->db->from('voip_hakedis_ucretleri vh');
		$this->db->join('kullanicilar k', 'vh.kullanici_id = k.kullanici_id', 'left');
		$this->db->order_by('vh.baslangic_tarihi DESC');
		$data["hakedis_ucretleri"] = $this->db->get()->result();

		$this->load->view('voip/hakedis-tanimlama', $data);
	}

	/**
	 * Hakediş Ekle (AJAX)
	 */
	public function hakedis_ekle(){
		// Content-Type header ayarla
		header('Content-Type: application/json');

		if(!grup_modul_yetkisi_var(1905)) {
			echo json_encode(['success' => false, 'message' => 'Yetki yok']);
			return;
		}

		$kullanici_id = $this->input->post('kullanici_id');
		$tek_neo = $this->input->post('tek_neo');
		$tek_uydu = $this->input->post('tek_uydu');
		$neolu_internet = $this->input->post('neolu_internet');
		$uydulu_internet = $this->input->post('uydulu_internet');
		$baslangic_tarihi = $this->input->post('baslangic_tarihi');
		$bitis_tarihi = $this->input->post('bitis_tarihi');
		$aciklama = $this->input->post('aciklama');

		if(empty($kullanici_id) || empty($baslangic_tarihi)) {
			echo json_encode(['success' => false, 'message' => 'Kullanıcı ve başlangıç tarihi gereklidir']);
			return;
		}

		// Tutar kontrolü
		$tutarlar = [$tek_neo, $tek_uydu, $neolu_internet, $uydulu_internet];
		foreach($tutarlar as $tutar) {
			if(!empty($tutar) && (!is_numeric($tutar) || $tutar < 0)) {
				echo json_encode(['success' => false, 'message' => 'Ücret tutarları geçerli sayı olmalıdır']);
				return;
			}
		}

		$data = [
			'kullanici_id' => $kullanici_id,
			'tek_neo' => !empty($tek_neo) ? number_format($tek_neo, 2, '.', '') : null,
			'tek_uydu' => !empty($tek_uydu) ? number_format($tek_uydu, 2, '.', '') : null,
			'neolu_internet' => !empty($neolu_internet) ? number_format($neolu_internet, 2, '.', '') : null,
			'uydulu_internet' => !empty($uydulu_internet) ? number_format($uydulu_internet, 2, '.', '') : null,
			'baslangic_tarihi' => $baslangic_tarihi,
			'bitis_tarihi' => !empty($bitis_tarihi) ? $bitis_tarihi : null,
			'aciklama' => trim($aciklama)
		];

		if($this->db->insert('voip_hakedis_ucretleri', $data)) {
			echo json_encode(['success' => true, 'message' => 'Hakediş ücreti başarıyla eklendi']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);
		}
	}

	/**
	 * Hakediş Sil (AJAX)
	 */
	public function hakedis_sil(){
		// Content-Type header ayarla
		header('Content-Type: application/json');

		if(!grup_modul_yetkisi_var(1905)) {
			echo json_encode(['success' => false, 'message' => 'Yetki yok']);
			return;
		}

		$id = $this->input->post('id');

		if(empty($id)) {
			echo json_encode(['success' => false, 'message' => 'Hakediş ID gereklidir']);
			return;
		}

		if($this->db->delete('voip_hakedis_ucretleri', ['id' => $id])) {
			echo json_encode(['success' => true, 'message' => 'Hakediş ücreti başarıyla silindi']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);
		}
	}

	/**
	 * Hakediş Güncelle (AJAX)
	 */
	public function hakedis_guncelle(){
		// Content-Type header ayarla
		header('Content-Type: application/json');

		if(!grup_modul_yetkisi_var(1905)) {
			echo json_encode(['success' => false, 'message' => 'Yetki yok']);
			return;
		}

		$id = $this->input->post('id');
		$kullanici_id = $this->input->post('kullanici_id');
		$tek_neo = $this->input->post('tek_neo');
		$tek_uydu = $this->input->post('tek_uydu');
		$neolu_internet = $this->input->post('neolu_internet');
		$uydulu_internet = $this->input->post('uydulu_internet');
		$baslangic_tarihi = $this->input->post('baslangic_tarihi');
		$bitis_tarihi = $this->input->post('bitis_tarihi');
		$aciklama = $this->input->post('aciklama');

		if(empty($id) || empty($kullanici_id) || empty($baslangic_tarihi)) {
			echo json_encode(['success' => false, 'message' => 'ID, kullanıcı ve başlangıç tarihi gereklidir']);
			return;
		}

		// Tutar kontrolü
		$tutarlar = [$tek_neo, $tek_uydu, $neolu_internet, $uydulu_internet];
		foreach($tutarlar as $tutar) {
			if(!empty($tutar) && (!is_numeric($tutar) || $tutar < 0)) {
				echo json_encode(['success' => false, 'message' => 'Ücret tutarları geçerli sayı olmalıdır']);
				return;
			}
		}

		$data = [
			'kullanici_id' => $kullanici_id,
			'tek_neo' => !empty($tek_neo) ? number_format($tek_neo, 2, '.', '') : null,
			'tek_uydu' => !empty($tek_uydu) ? number_format($tek_uydu, 2, '.', '') : null,
			'neolu_internet' => !empty($neolu_internet) ? number_format($neolu_internet, 2, '.', '') : null,
			'uydulu_internet' => !empty($uydulu_internet) ? number_format($uydulu_internet, 2, '.', '') : null,
			'baslangic_tarihi' => $baslangic_tarihi,
			'bitis_tarihi' => !empty($bitis_tarihi) ? $bitis_tarihi : null,
			'aciklama' => trim($aciklama)
		];

		if($this->db->update('voip_hakedis_ucretleri', $data, ['id' => $id])) {
			echo json_encode(['success' => true, 'message' => 'Hakediş ücreti başarıyla güncellendi']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Veritabanı hatası']);
		}
	}

	/**
	 * Hakediş Getir (AJAX) - Düzenleme için
	 */
	public function hakedis_getir(){
		// Content-Type header ayarla
		header('Content-Type: application/json');

		if(!grup_modul_yetkisi_var(1905)) {
			echo json_encode(['success' => false, 'message' => 'Yetki yok']);
			return;
		}

		$id = $this->input->post('id');

		if(empty($id)) {
			echo json_encode(['success' => false, 'message' => 'Hakediş ID gereklidir']);
			return;
		}

		$hakedis = $this->db->get_where('voip_hakedis_ucretleri', ['id' => $id])->row();

		if($hakedis) {
			echo json_encode(['success' => true, 'data' => $hakedis]);
		} else {
			echo json_encode(['success' => false, 'message' => 'Hakediş ücreti bulunamadı']);
		}
	}

	/**
	 * Hakediş Raporu (AJAX) - Kullanıcı ve tarih aralığına göre filtreleme
	 */
	public function hakedis_raporu(){
		// Content-Type header ayarla
		header('Content-Type: application/json');

		if(!grup_modul_yetkisi_var(1905)) {
			echo json_encode(['success' => false, 'message' => 'Yetki yok']);
			return;
		}

		$kullanici_id = $this->input->post('kullanici_id'); // Opsiyonel
		$baslangic_tarihi = $this->input->post('baslangic_tarihi'); // Opsiyonel
		$bitis_tarihi = $this->input->post('bitis_tarihi'); // Opsiyonel

		$this->db->select('vh.*, k.kullanici_ad, k.kullanici_soyad');
		$this->db->from('voip_hakedis_ucretleri vh');
		$this->db->join('kullanicilar k', 'vh.kullanici_id = k.kullanici_id', 'left');
		
		if(!empty($kullanici_id)) {
			$this->db->where('vh.kullanici_id', $kullanici_id);
		}
		
		if(!empty($baslangic_tarihi)) {
			$this->db->where('vh.baslangic_tarihi >=', $baslangic_tarihi);
		}
		
		if(!empty($bitis_tarihi)) {
			$this->db->where('(vh.bitis_tarihi <= ? OR vh.bitis_tarihi IS NULL)', $bitis_tarihi);
		}
		
		$this->db->order_by('vh.baslangic_tarihi DESC');
		$hakedis_ucretleri = $this->db->get()->result();

		echo json_encode([
			'success' => true, 
			'data' => $hakedis_ucretleri,
			'kayit_sayisi' => count($hakedis_ucretleri)
		]);
	}

	/**
	 * Hakediş İris Rapor Sayfası (ID:1906)
	 * URL: https://crm.ilekasoft.com/voip/hakedis-iris-rapor
	 */
	public function hakedis_iris_rapor(){
		// Voip & Hakediş (ID:1900) ana modül yetkisi kontrolü
		if(!grup_modul_yetkisi_var(1900)){
			$this->session->set_flashdata('error', 'Bu modüle erişim yetkiniz bulunmamaktadır.');
			redirect('home');
		}

		// Hakediş İris Rapor (ID:1906) yetkisi kontrolü  
		if(!grup_modul_yetkisi_var(1906)){
			$this->session->set_flashdata('error', 'Bu sayfaya erişim yetkiniz bulunmamaktadır.');
			redirect('voip/operator-tanimla');
		}

		$data['title'] = 'Hakediş İris Rapor';
		$data['h1'] = 'Hakediş İris Rapor';

		// Mevcut veriler için sayfa numarası ve limit
		$page = (int) $this->input->get('page') ?: 1;
		$limit = 50;
		$offset = ($page - 1) * $limit;

		// Filtreleme parametreleri
		$filters = [
			'baslangic_tarihi' => $this->input->get('baslangic_tarihi'),
			'bitis_tarihi' => $this->input->get('bitis_tarihi'),
			'talep_id' => $this->input->get('talep_id'),
			'memo_id' => $this->input->get('memo_id'),
			'dt_musteri_no' => $this->input->get('dt_musteri_no'),
			'satis_durumu' => $this->input->get('satis_durumu')
		];

		// Toplam kayıt sayısını al
		$this->db->from('voip_iris_rapor');
		$this->apply_iris_filters($filters);
		$total_records = $this->db->count_all_results();

		// Verileri al
		$this->db->from('voip_iris_rapor');
		$this->apply_iris_filters($filters);
		$this->db->limit($limit, $offset);
		$this->db->order_by('kayit_tarihi', 'DESC');
		$data['rapor_verileri'] = $this->db->get()->result();

		// Pagination
		$data['pagination'] = [
			'current_page' => $page,
			'total_pages' => ceil($total_records / $limit),
			'total_records' => $total_records,
			'per_page' => $limit
		];

		$data['filters'] = $filters;

		$this->load->view('voip/hakedis-iris-rapor', $data);
	}

	/**
	 * İris Rapor Filtreleme Helper
	 */
	private function apply_iris_filters($filters) {
		if (!empty($filters['baslangic_tarihi'])) {
			$this->db->where('talep_giris_tarihi >=', $filters['baslangic_tarihi']);
		}
		
		if (!empty($filters['bitis_tarihi'])) {
			$this->db->where('talep_giris_tarihi <=', $filters['bitis_tarihi'] . ' 23:59:59');
		}
		
		if (!empty($filters['talep_id'])) {
			$this->db->like('talep_id', $filters['talep_id']);
		}
		
		if (!empty($filters['memo_id'])) {
			$this->db->like('memo_id', $filters['memo_id']);
		}
		
		if (!empty($filters['dt_musteri_no'])) {
			$this->db->like('dt_musteri_no', $filters['dt_musteri_no']);
		}
		
		if (!empty($filters['satis_durumu'])) {
			$this->db->like('satis_durumu', $filters['satis_durumu']);
		}
	}

	/**
	 * İris Rapor CSV Yükleme İşlemi
	 */
	public function iris_rapor_yukle(){
		// Performans ayarları
		ini_set('max_execution_time', 600); // 10 dakika
		ini_set('memory_limit', '1024M');
		
		// Türkçe karakter desteği
		$this->db->query("SET NAMES utf8mb4");
		$this->db->query("SET CHARACTER SET utf8mb4");
		
		// Voip & Hakediş (ID:1900) ana modül yetkisi kontrolü
		if(!grup_modul_yetkisi_var(1900)){
			echo json_encode(['success' => false, 'message' => 'Bu modüle erişim yetkiniz bulunmamaktadır.']);
			return;
		}

		// Hakediş İris Rapor (ID:1906) yetkisi kontrolü  
		if(!grup_modul_yetkisi_var(1906)){
			echo json_encode(['success' => false, 'message' => 'Bu sayfaya erişim yetkiniz bulunmamaktadır.']);
			return;
		}

		if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
			$error_message = 'Dosya yüklenirken hata oluştu.';
			if (isset($_FILES['csv_file']['error'])) {
				switch ($_FILES['csv_file']['error']) {
					case UPLOAD_ERR_INI_SIZE:
						$error_message = 'Dosya boyutu php.ini upload_max_filesize limitini aşıyor.';
						break;
					case UPLOAD_ERR_FORM_SIZE:
						$error_message = 'Dosya boyutu HTML form MAX_FILE_SIZE limitini aşıyor.';
						break;
					case UPLOAD_ERR_PARTIAL:
						$error_message = 'Dosya kısmen yüklendi.';
						break;
					case UPLOAD_ERR_NO_FILE:
						$error_message = 'Hiçbir dosya yüklenmedi.';
						break;
					case UPLOAD_ERR_NO_TMP_DIR:
						$error_message = 'Geçici dizin eksik.';
						break;
					case UPLOAD_ERR_CANT_WRITE:
						$error_message = 'Disk yazma hatası.';
						break;
					case UPLOAD_ERR_EXTENSION:
						$error_message = 'PHP uzantısı dosya yüklemeyi durdurdu.';
						break;
				}
			}
			echo json_encode(['success' => false, 'message' => $error_message]);
			return;
		}

		$file_tmp = $_FILES['csv_file']['tmp_name'];
		$file_name = $_FILES['csv_file']['name'];
		$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

		// Dosya uzantısı kontrolü
		if ($file_ext !== 'csv') {
			echo json_encode(['success' => false, 'message' => 'Sadece CSV dosyaları kabul edilir.']);
			return;
		}

		// CSV dosyasını oku
		$handle = fopen($file_tmp, 'r');
		if (!$handle) {
			echo json_encode(['success' => false, 'message' => 'CSV dosyası okunamadı.']);
			return;
		}

		// Encoding kontrolü
		$first_line = fgets($handle);
		rewind($handle);
		$encoding = mb_detect_encoding($first_line, ['UTF-8', 'UTF-16', 'Windows-1254', 'ISO-8859-9'], true);

		// CSV başlığını oku
		$header = fgetcsv($handle, 0, ';');
		if (!$header) {
			fclose($handle);
			echo json_encode(['success' => false, 'message' => 'CSV dosyası boş veya hatalı format.']);
			return;
		}

		// İşlenen ve başarısız kayıt sayısı
		$processed = 0;
		$updated = 0;
		$failed = 0;
		$errors = [];
		$batch_size = 500; // Büyük dosyalar için daha küçük batch (500 kayıt)
		$batch_data = [];
		$update_data = [];

		// Transaction başlat
		$this->db->trans_start();

		while (($data = fgetcsv($handle, 0, ';')) !== FALSE) {
			if (count($data) < count($header)) {
				$failed++;
				$errors[] = "Satır " . ($processed + $failed + 1) . ": Eksik sütun";
				continue;
			}

			// Encoding dönüşümü (Türkçe karakter desteği için)
			if ($encoding !== 'UTF-8') {
				$data = array_map(function($item) use ($encoding) {
					return mb_convert_encoding($item, 'UTF-8', $encoding);
				}, $data);
			}

			// CSV verilerini array'e çevir
			$csv_data = array_combine($header, $data);

			// Tarih formatlarını düzelt
			$memo_kapanis_tarihi = null;
			if (!empty($csv_data['MEMO_KAPANIS_TARIHI'])) {
				// Tarihi parse et: "4.06.2025 10:10" formatı
				$date_str = trim($csv_data['MEMO_KAPANIS_TARIHI']);
				if (preg_match('/(\d{1,2})\.(\d{1,2})\.(\d{4})\s+(\d{1,2}):(\d{2})/', $date_str, $matches)) {
					$day = $matches[1];
					$month = $matches[2];
					$year = $matches[3];
					$hour = $matches[4];
					$minute = $matches[5];
					$memo_kapanis_tarihi = "$year-$month-$day $hour:$minute:00";
				}
			}

			$talep_giris_tarihi = null;
			if (!empty($csv_data['TALEP_GIRIS_TARIHI'])) {
				$date_str = trim($csv_data['TALEP_GIRIS_TARIHI']);
				if (preg_match('/(\d{1,2})\.(\d{1,2})\.(\d{4})\s+(\d{1,2}):(\d{2})/', $date_str, $matches)) {
					$day = $matches[1];
					$month = $matches[2];
					$year = $matches[3];
					$hour = $matches[4];
					$minute = $matches[5];
					$talep_giris_tarihi = "$year-$month-$day $hour:$minute:00";
				}
			}

			$randevu_tarihi = null;
			if (!empty($csv_data['RANDEVU_TARIHI'])) {
				$date_str = trim($csv_data['RANDEVU_TARIHI']);
				if (preg_match('/(\d{1,2})\.(\d{1,2})\.(\d{4})\s+(\d{1,2}):(\d{2})/', $date_str, $matches)) {
					$day = $matches[1];
					$month = $matches[2];
					$year = $matches[3];
					$hour = $matches[4];
					$minute = $matches[5];
					$randevu_tarihi = "$year-$month-$day $hour:$minute:00";
				}
			}

			// Veritabanına insert edilecek veriyi hazırla
			$insert_data = [
				'talep_id' => trim($csv_data['TALEP_ID'] ?? ''),
				'talep_turu' => trim($csv_data['TALEP_TURU'] ?? ''),
				'uydu_basvuru_potansiyel_no' => trim($csv_data['UYDU_BASVURU_POTANSIYEL_NO'] ?? ''),
				'uydu_basvuru_uye_no' => trim($csv_data['UYDU_BASVURU_UYE_NO'] ?? ''),
				'dt_musteri_no' => trim($csv_data['DT_MUSTERI_NO'] ?? ''),
				'memo_id' => trim($csv_data['MEMO_ID'] ?? ''),
				'memo_kayit_tipi' => trim($csv_data['MEMO_KAYIT_TIPI'] ?? ''),
				'memo_id_tip' => trim($csv_data['MEMO_ID_TIP'] ?? ''),
				'memo_kodu' => trim($csv_data['MEMO_KODU'] ?? ''),
				'memo_kapanis_tarihi' => $memo_kapanis_tarihi,
				'memo_yonlenen_bayi_kodu' => trim($csv_data['MEMO_YONLENEN_BAYI_KODU'] ?? ''),
				'memo_yonlenen_bayi_adi' => trim($csv_data['MEMO_YONLENEN_BAYI_ADI'] ?? ''),
				'memo_yonlenen_bayi_yoneticisi' => trim($csv_data['MEMO_YONLENEN_BAYI_YONETICISI'] ?? ''),
				'memo_yonlenen_bayi_bolge' => trim($csv_data['MEMO_YONLENEN_BAYI_BOLGE'] ?? ''),
				'memo_yonlenen_bayi_teknik_yntc' => trim($csv_data['MEMO_YONLENEN_BAYI_TEKNIK_YNTC'] ?? ''),
				'talep_giris_tarihi' => $talep_giris_tarihi,
				'talebi_giren_bayi_kodu' => trim($csv_data['TALEBI_GIREN_BAYI_KODU'] ?? ''),
				'talebi_giren_bayi_adi' => trim($csv_data['TALEBI_GIREN_BAYI_ADI'] ?? ''),
				'talebi_giren_personel' => trim($csv_data['TALEBI_GIREN_PERSONEL'] ?? ''),
				'talebi_giren_personelno' => trim($csv_data['TALEBI_GIREN_PERSONELNO'] ?? ''),
				'talebi_giren_personelkodu' => trim($csv_data['TALEBI_GIREN_PERSONELKODU'] ?? ''),
				'talebi_giren_personel_altbayi' => trim($csv_data['TALEBI_GIREN_PERSONEL_ALTBAYI'] ?? ''),
				'talep_kaynak' => trim($csv_data['TALEP_KAYNAK'] ?? ''),
				'satis_durumu' => trim($csv_data['SATIS_DURUMU'] ?? ''),
				'internet_surec_durumu' => trim($csv_data['INTERNET_SUREC_DURUMU'] ?? ''),
				'aktive_edilen_uyeno' => trim($csv_data['AKTIVE_EDILEN_UYENO'] ?? ''),
				'aktive_edilen_outletno' => trim($csv_data['AKTIVE_EDILEN_OUTLETNO'] ?? ''),
				'aktive_edilen_sozlesmeno' => trim($csv_data['AKTIVE_EDILEN_SOZLESMENO'] ?? ''),
				'aktive_edilen_sozlesmekmp' => trim($csv_data['AKTIVE_EDILEN_SOZLESMEKMP'] ?? ''),
				'aktive_edilen_sozlesmedurum' => trim($csv_data['AKTIVE_EDILEN_SOZLESMEDURUM'] ?? ''),
				'talep_takip_notu' => trim($csv_data['TALEP_TAKIP_NOTU'] ?? ''),
				'guncel_outlet_durum' => trim($csv_data['GUNCEL_OUTLET_DURUM'] ?? ''),
				'teyit_durum' => trim($csv_data['TEYIT_DURUM'] ?? ''),
				'teyit_arama_durum' => trim($csv_data['TEYIT_ARAMA_DURUM'] ?? ''),
				'randevu_tarihi' => $randevu_tarihi,
				'memo_son_durum' => trim($csv_data['MEMO_SON_DURUM'] ?? ''),
				'memo_son_cevap' => trim($csv_data['MEMO_SON_CEVAP'] ?? ''),
				'memo_son_aciklama' => trim($csv_data['MEMO_SON_ACIKLAMA'] ?? ''),
				'kayit_tarihi' => date('Y-m-d H:i:s')
			];

			// memo_id boş değilse kontrol et
			$memo_id = trim($csv_data['MEMO_ID'] ?? '');
			if (!empty($memo_id)) {
				// Mevcut kaydı kontrol et
				$existing = $this->db->select('id')->where('memo_id', $memo_id)->get('voip_iris_rapor')->row();
				
				if ($existing) {
					// Kayıt mevcut, güncelle
					$update_data_single = $insert_data;
					unset($update_data_single['kayit_tarihi']); // Kayit tarihi güncellenmesin
					$update_data_single['guncelleme_tarihi'] = date('Y-m-d H:i:s');
					
					if ($this->db->where('memo_id', $memo_id)->update('voip_iris_rapor', $update_data_single)) {
						$updated++;
					} else {
						$failed++;
						$errors[] = "Memo ID: $memo_id - Güncelleme hatası";
					}
				} else {
					// Yeni kayıt ekle
					$batch_data[] = $insert_data;
				}
			} else {
				// memo_id boş ise direkt ekle
				$batch_data[] = $insert_data;
			}
			
			// Batch boyutuna ulaştığında işle (sadece yeni kayıtlar için)
			if (count($batch_data) >= $batch_size) {
				if ($this->db->insert_batch('voip_iris_rapor', $batch_data)) {
					$processed += count($batch_data);
				} else {
					$failed += count($batch_data);
					$errors[] = "Batch insert hatası: " . count($batch_data) . " kayıt";
				}
				$batch_data = []; // Batch'i temizle
			}
		}

		// Kalan kayıtları işle (sadece yeni kayıtlar için)
		if (!empty($batch_data)) {
			if ($this->db->insert_batch('voip_iris_rapor', $batch_data)) {
				$processed += count($batch_data);
			} else {
				$failed += count($batch_data);
				$errors[] = "Son batch insert hatası: " . count($batch_data) . " kayıt";
			}
		}

		fclose($handle);

		// Transaction tamamla
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo json_encode(['success' => false, 'message' => 'Veritabanı işlemi başarısız oldu.']);
			return;
		}

		$total_successful = $processed + $updated;
		$message = "CSV dosyası başarıyla işlendi.";
		if ($processed > 0) {
			$message .= " {$processed} yeni kayıt eklendi.";
		}
		if ($updated > 0) {
			$message .= " {$updated} mevcut kayıt güncellendi.";
		}
		if ($failed > 0) {
			$message .= " {$failed} kayıt başarısız oldu.";
		}

		echo json_encode([
			'success' => true, 
			'message' => $message, 
			'processed' => $processed, 
			'updated' => $updated,
			'failed' => $failed,
			'total_successful' => $total_successful
		]);
	}

	/**
	 * Hakediş Bayi Hesapla Sayfası (ID:1907)
	 * URL: https://crm.ilekasoft.com/voip/hakedis-bayi-hesapla
	 */
	public function hakedis_bayi_hesapla(){
		// Voip & Hakediş (ID:1900) ana modül yetkisi kontrolü
		if(!grup_modul_yetkisi_var(1900)){
			redirect('home/hata2/2');
		}

		// Hakediş Bayi Hesapla (ID:1907) yetkisi kontrolü  
		if(!grup_modul_yetkisi_var(1907)){
			redirect('voip/operator-tanimla');
		}

		$data['title'] = 'Hakediş Bayi Hesapla';
		$data['h1'] = 'Hakediş Bayi Hesapla';
		$data['baslik'] = 'Hakediş Bayi Hesapla';

		// Hakediş dönemlerini oluştur (son 12 ay)
		$hakedis_donemleri = [];
		for ($i = 11; $i >= 0; $i--) {
			$tarih = date('Y-m-01', strtotime("-$i months"));
			$yil = date('Y', strtotime($tarih));
			$ay = date('n', strtotime($tarih));
			$ay_adi = [
				1 => 'Ocak', 2 => 'Şubat', 3 => 'Mart', 4 => 'Nisan',
				5 => 'Mayıs', 6 => 'Haziran', 7 => 'Temmuz', 8 => 'Ağustos',
				9 => 'Eylül', 10 => 'Ekim', 11 => 'Kasım', 12 => 'Aralık'
			];
			
			// Hakediş başlangıç tarihi: ayın 4'ü
			$baslangic = sprintf('%04d-%02d-04', $yil, $ay);
			
			// Hakediş bitiş tarihi: bir sonraki ayın 3'ü
			$bitis_tarih = date('Y-m-03', strtotime($baslangic . ' +1 month'));
			
			$hakedis_donemleri[] = [
				'key' => $yil . '-' . sprintf('%02d', $ay),
				'label' => $ay_adi[$ay] . ' ' . $yil . ' Hakedişi (04.' . sprintf('%02d', $ay) . '.' . $yil . ' - ' . date('d.m.Y', strtotime($bitis_tarih)) . ')',
				'baslangic' => $baslangic,
				'bitis' => $bitis_tarih
			];
		}
		$data['hakedis_donemleri'] = $hakedis_donemleri;

		// Filtreleme parametreleri
		$filters = [
			'hakedis_donemi' => $this->input->get('hakedis_donemi'),
			'talebi_giren_personel_altbayi' => $this->input->get('talebi_giren_personel_altbayi')
		];

		// Eğer hakediş dönemi seçilmemişse, mevcut hakediş dönemini default olarak ayarla
		if (empty($filters['hakedis_donemi']) && empty($this->input->get('talebi_giren_personel_altbayi'))) {
			// Bugünün tarihine göre mevcut hakediş dönemini bul
			$bugun = date('Y-m-d');
			$bugun_gun = date('j'); // Ayın kaçıncı günü
			
			// Eğer bugün ayın 4'ü veya sonrasıysa, bu ayın hakedişindeyiz
			// Eğer bugün ayın 3'ü veya öncesiyse, önceki ayın hakedişindeyiz
			if ($bugun_gun >= 4) {
				// Bu ayın hakediş dönemi
				$default_key = date('Y-m');
			} else {
				// Önceki ayın hakediş dönemi
				$default_key = date('Y-m', strtotime('-1 month'));
			}
			
			$filters['hakedis_donemi'] = $default_key;
		}

		// Seçili hakediş dönemine göre tarih aralığını belirle
		$baslangic_tarihi = null;
		$bitis_tarihi = null;
		
		if (!empty($filters['hakedis_donemi'])) {
			foreach ($hakedis_donemleri as $donem) {
				if ($donem['key'] == $filters['hakedis_donemi']) {
					$baslangic_tarihi = $donem['baslangic'];
					$bitis_tarihi = $donem['bitis'] . ' 23:59:59';
					break;
				}
			}
		}

		// Sadece SATIS_DURUMU = 'Tamamlandı' olanları getir
		$this->db->select('
			vir.talebi_giren_personel_altbayi,
			k.kullanici_ad,
			k.kullanici_id,
			vhu.neolu_internet as isp_ucret,
			vhu.tek_neo as neo_ucret,
			vhu.tek_uydu as uydu_ucret,
			COUNT(CASE WHEN vir.memo_kayit_tipi LIKE "%ISP%" AND vir.talep_turu LIKE "%ISP ve Neo Potansiyel Talep%" THEN 1 END) as neolu_isp,
			COUNT(CASE WHEN vir.memo_kayit_tipi LIKE "%ISP%" AND vir.talep_turu LIKE "%Uydu ve ISP Potansiyel Talep%" THEN 1 END) as uydulu_isp,
			COUNT(CASE WHEN vir.memo_kayit_tipi = "NEO" THEN 1 END) as neo,
			COUNT(CASE WHEN vir.memo_kayit_tipi = "UYDU" THEN 1 END) as uydu,
			vhu.baslangic_tarihi as hakedis_baslangic,
			vhu.bitis_tarihi as hakedis_bitis
		');
		$this->db->from('voip_iris_rapor vir');
		$this->db->join('kullanicilar k', 'k.kullanici_ad = vir.talebi_giren_personel_altbayi', 'left');
		
		// Hakediş döneminin tarih aralığında olduğu fiyatlandırmaları getir
		if (!empty($baslangic_tarihi)) {
			$bitis_tarih_only = date('Y-m-d', strtotime($bitis_tarihi));
			$join_condition = 'vhu.kullanici_id = k.kullanici_id AND "' . $baslangic_tarihi . '" >= vhu.baslangic_tarihi AND "' . $bitis_tarih_only . '" <= vhu.bitis_tarihi';
			$this->db->join('voip_hakedis_ucretleri vhu', $join_condition, 'left');
		} else {
			$this->db->join('voip_hakedis_ucretleri vhu', 'vhu.kullanici_id = k.kullanici_id', 'left');
		}
		
		$this->db->where('vir.satis_durumu', 'Tamamlandı');
		$this->db->where('vir.guncel_outlet_durum', 'AKTIF');
		
		// Filtreleri uygula
		if (!empty($baslangic_tarihi)) {
			$this->db->where('vir.memo_kapanis_tarihi >=', $baslangic_tarihi);
		}
		
		if (!empty($bitis_tarihi)) {
			$this->db->where('vir.memo_kapanis_tarihi <=', $bitis_tarihi);
		}
		
		if (!empty($filters['talebi_giren_personel_altbayi'])) {
			$this->db->like('vir.talebi_giren_personel_altbayi', $filters['talebi_giren_personel_altbayi']);
		}

		$this->db->group_by('vir.talebi_giren_personel_altbayi, k.kullanici_id, vhu.neolu_internet, vhu.tek_neo, vhu.tek_uydu, vhu.baslangic_tarihi, vhu.bitis_tarihi');
		$this->db->having('vir.talebi_giren_personel_altbayi IS NOT NULL');
		$this->db->having('vir.talebi_giren_personel_altbayi !=', '');
		$this->db->order_by('(COUNT(CASE WHEN vir.memo_kayit_tipi LIKE "%ISP%" AND vir.talep_turu LIKE "%ISP ve Neo Potansiyel Talep%" THEN 1 END) + COUNT(CASE WHEN vir.memo_kayit_tipi LIKE "%ISP%" AND vir.talep_turu LIKE "%Uydu ve ISP Potansiyel Talep%" THEN 1 END) + COUNT(CASE WHEN vir.memo_kayit_tipi = "NEO" THEN 1 END) + COUNT(CASE WHEN vir.memo_kayit_tipi = "UYDU" THEN 1 END))', 'DESC');

		$data['bayi_hesaplama'] = $this->db->get()->result();

		// Toplam istatistikler
		$this->db->select('COUNT(*) as genel_toplam');
		$this->db->from('voip_iris_rapor');
		$this->db->where('satis_durumu', 'Tamamlandı');
		$this->db->where('guncel_outlet_durum', 'AKTIF');
		
		if (!empty($baslangic_tarihi)) {
			$this->db->where('memo_kapanis_tarihi >=', $baslangic_tarihi);
		}
		
		if (!empty($bitis_tarihi)) {
			$this->db->where('memo_kapanis_tarihi <=', $bitis_tarihi);
		}

		$data['genel_toplam'] = $this->db->get()->row();
		$data['filters'] = $filters;

		$this->load->view('voip/hakedis-bayi-hesapla', $data);
	}

	/**
	 * Debug Test Sayfası - Geliştirme amaçlı
	 * URL: https://crm.ilekasoft.com/voip/debug-test
	 */
	public function debug_test(){
		$this->load->view('voip/debug-test');
	}

	/**
	 * Voip Hakediş Bayi Ödeme/Gider Sayfası (ID: 1908)
	 * URL: https://crm.ilekasoft.com/voip/bayi-odeme-gider
	 */
	public function bayi_odeme_gider(){
		// Modül yetkisi kontrolü (1908: Voip Hakediş Bayi Ödeme/Gider)
		if (!grup_modul_yetkisi_var(1908)) {
			redirect("home/hata2/1908");
		}

		$this->load->model('vt');
		
		// Sayfa verilerini hazırla
		$data["baslik"] = "Voip / Hakediş Bayi Ödeme/Gider";
		
		// Kullanıcı (Bayi) listesini getir - sadece aktif olanlar
		$this->db->select('kullanici_id, kullanici_ad, kullanici_soyad');
		$this->db->from('kullanicilar');
		$this->db->where('kullanici_durum', 1);
		$this->db->order_by('kullanici_ad', 'ASC');
		$kullanicilar = $this->db->get()->result();
		$data['kullanicilar'] = $kullanicilar;
		
		// Ödemeleri listele
		$this->load->library('pagination');
		
		$config['base_url'] = base_url('voip/bayi-odeme-gider');
		$config['total_rows'] = $this->db->count_all_results('voip_bayi_odemeler');
		$config['per_page'] = 20;
		$config['num_links'] = 3;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'sayfa';
		
		$this->pagination->initialize($config);
		
		$sayfa = $this->input->get('sayfa') ? $this->input->get('sayfa') : 0;
		
		// Ödemeleri kullanıcı bilgisi ile birlikte getir
		$this->db->select('bo.*, k.kullanici_ad, k.kullanici_soyad');
		$this->db->from('voip_bayi_odemeler bo');
		$this->db->join('kullanicilar k', 'k.kullanici_id = bo.bayi_id');
		$this->db->order_by('bo.olusturma_tarihi', 'DESC');
		$this->db->limit($config['per_page'], $sayfa);
		$odemeler = $this->db->get()->result();
		
		$data['odemeler'] = $odemeler;
		$data['pagination'] = $this->pagination->create_links();
		
		$this->load->view('voip/bayi-odeme-gider', $data);
	}

	/**
	 * Bayi Ödeme/Gider Kaydetme
	 */
	public function bayi_odeme_kaydet(){
		// Modül yetkisi kontrolü
		if (!grup_modul_yetkisi_var(1908)) {
			redirect("home/hata2/1908");
		}

		$this->load->model('vt');
		
		if ($this->input->post()) {
			$bayi_id = $this->input->post('bayi_id');
			$tur = $this->input->post('tur');
			$tutar = $this->input->post('tutar');
			$tarih = $this->input->post('tarih');
			$aciklama = $this->input->post('aciklama');
			
			// Form validasyonu
			if (empty($bayi_id) || empty($tur) || empty($tutar) || empty($tarih)) {
				$this->session->set_flashdata('hata', 'Lütfen tüm zorunlu alanları doldurun.');
				redirect('voip/bayi-odeme-gider');
			}
			
			// Evrak yükleme işlemi
			$evrak_dosyalar = array();
			if (!empty($_FILES['evrak']['name'][0])) {
				$config['upload_path'] = './assets/uploads/voip_bayi_odemeler/';
				$config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png|gif|txt|xlsx|xls';
				$config['max_size'] = 10240; // 10MB
				$config['encrypt_name'] = TRUE;
				
				// Klasör yoksa oluştur
				if (!is_dir($config['upload_path'])) {
					mkdir($config['upload_path'], 0755, true);
				}
				
				$this->load->library('upload', $config);
				
				$files_count = count($_FILES['evrak']['name']);
				for ($i = 0; $i < $files_count; $i++) {
					if (!empty($_FILES['evrak']['name'][$i])) {
						$_FILES['single_file']['name'] = $_FILES['evrak']['name'][$i];
						$_FILES['single_file']['type'] = $_FILES['evrak']['type'][$i];
						$_FILES['single_file']['tmp_name'] = $_FILES['evrak']['tmp_name'][$i];
						$_FILES['single_file']['error'] = $_FILES['evrak']['error'][$i];
						$_FILES['single_file']['size'] = $_FILES['evrak']['size'][$i];
						
						if ($this->upload->do_upload('single_file')) {
							$upload_data = $this->upload->data();
							$evrak_dosyalar[] = 'voip_bayi_odemeler/' . $upload_data['file_name'];
						}
					}
				}
			}
			
			// Veritabanına kaydet
			$data_insert = array(
				'bayi_id' => $bayi_id,
				'tur' => $tur,
				'tutar' => $tutar,
				'tarih' => $tarih,
				'aciklama' => $aciklama,
				'evrak' => !empty($evrak_dosyalar) ? implode(',', $evrak_dosyalar) : null
			);
			
			if ($this->vt->insert('voip_bayi_odemeler', $data_insert)) {
				$this->session->set_flashdata('basarili', 'Ödeme/Gider başarıyla kaydedildi.');
			} else {
				$this->session->set_flashdata('hata', 'Kaydetme sırasında bir hata oluştu.');
			}
			
			redirect('voip/bayi-odeme-gider');
		}
	}

	/**
	 * Bayi Ödeme/Gider Silme
	 */
	public function bayi_odeme_sil($id){
		// Modül yetkisi kontrolü
		if (!grup_modul_yetkisi_var(1908)) {
			redirect("home/hata2/1908");
		}

		$this->load->model('vt');
		
		// Önce kaydı getir (evrak dosyalarını silmek için)
		$odeme = $this->vt->single('voip_bayi_odemeler', array('id' => $id));
		
		if ($odeme) {
			// Evrak dosyalarını sil
			if (!empty($odeme->evrak)) {
				$dosyalar = explode(',', $odeme->evrak);
				foreach ($dosyalar as $dosya) {
					$dosya_yolu = './assets/uploads/' . $dosya;
					if (file_exists($dosya_yolu)) {
						unlink($dosya_yolu);
					}
				}
			}
			
			// Veritabanından sil
			if ($this->vt->del('voip_bayi_odemeler', 'id', $id)) {
				$this->session->set_flashdata('basarili', 'Kayıt başarıyla silindi.');
			} else {
				$this->session->set_flashdata('hata', 'Silme işlemi sırasında bir hata oluştu.');
			}
		} else {
			$this->session->set_flashdata('hata', 'Kayıt bulunamadı.');
		}
		
		redirect('voip/bayi-odeme-gider');
	}

}

