<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Kullanici extends CI_Controller {



  public function __construct(){

		parent::__construct();

		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

		$this->load->model('vt');
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('url');

		

		$control = session("r", "login");



		

		if(!$control){

			redirect("check");

		}

	  //sessionKontrolHelper();

	}



	public function sifreDegistir(){

		$data["baslik"] = "Kullanıcı / Şifre Değiştir";

		$this->load->view("kullanici/sifre-degistir",$data);

	}



	public function mevcutSifremiDegistir(){

		$kullanici = postval("kullanici");



		$kullaniciQ = "SELECT * FROM kullanicilar WHERE kullanici_id = '$kullanici'";

		$kullaniciExe = $this->db->query($kullaniciQ)->row();

		$kullaniciSifre = $kullaniciExe->kullanici_sifre;



		$mevcutSifre = postval("mevcutSifre");

		$yeniSifre = postval("yeniSifre");

		$yeniSifreTekrar = postval("yeniSifreTekrar");



		$mevcutSifreMD5 = md5($mevcutSifre);

		$yeniSifreMD5 = md5($yeniSifre);



		if($yeniSifre == $yeniSifreTekrar){

			if($mevcutSifreMD5 == $kullaniciSifre){

				$data["kullanici_sifre"] = $yeniSifreMD5;

				$this->vt->update('kullanicilar', array('kullanici_id'=>$kullanici), $data);

				$this->session->set_flashdata('sifre_ok','OK');

    			redirect($_SERVER['HTTP_REFERER']);

			}else{

				$this->session->set_flashdata('mevcut_sifre_hatali','OK');

    			redirect($_SERVER['HTTP_REFERER']);

			}

		}else{

			$this->session->set_flashdata('sifreler_eslesmiyor','OK');

    		redirect($_SERVER['HTTP_REFERER']);

		}



	}



	/**
	 * Kullanıcı konum bilgisini güncelle
	 */
	public function konum_guncelle()
	{
		// JSON veri al
		$json = file_get_contents('php://input');
		$data = json_decode($json, true);
		
		if (!$data) {
			echo json_encode(['status' => 'error', 'message' => 'Geçersiz veri']);
			return;
		}

		// Session kontrolü
		$control = session("r", "login_info");
		if (!$control) {
			echo json_encode(['status' => 'error', 'message' => 'Oturum bulunamadı']);
			return;
		}

		$kullanici_id = $control->kullanici_id;
		
		// Konum verilerini validate et
		$latitude = isset($data['latitude']) ? floatval($data['latitude']) : null;
		$longitude = isset($data['longitude']) ? floatval($data['longitude']) : null;
		
		if (!$latitude || !$longitude) {
			echo json_encode(['status' => 'error', 'message' => 'Geçersiz konum verisi']);
			return;
		}

		// Konum geçmişine ekle
		$konum_data = [
			'kullanici_id' => $kullanici_id,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'accuracy' => isset($data['accuracy']) ? floatval($data['accuracy']) : null,
			'address' => isset($data['address']) ? $data['address'] : null,
			'ip_address' => $this->input->ip_address(),
			'user_agent' => $this->input->user_agent(),
			'device_info' => isset($data['device_info']) ? $data['device_info'] : null,
			'created_at' => date('Y-m-d H:i:s')
		];

		try {
			// Konum geçmişine kaydet
			$this->db->insert('kullanici_konum_takibi', $konum_data);
			
			// Son konum tablosunu güncelle
			$son_konum_data = [
				'kullanici_id' => $kullanici_id,
				'latitude' => $latitude,
				'longitude' => $longitude,
				'accuracy' => $konum_data['accuracy'],
				'address' => $konum_data['address'],
				'last_update' => date('Y-m-d H:i:s'),
				'is_online' => 1
			];

			// UPSERT (var ise güncelle, yok ise ekle)
			$existing = $this->db->get_where('kullanici_son_konum', ['kullanici_id' => $kullanici_id])->row();
			if ($existing) {
				$this->db->where('kullanici_id', $kullanici_id);
				$this->db->update('kullanici_son_konum', $son_konum_data);
			} else {
				$this->db->insert('kullanici_son_konum', $son_konum_data);
			}

			echo json_encode([
				'status' => 'success', 
				'message' => 'Konum başarıyla güncellendi',
				'data' => [
					'latitude' => $latitude,
					'longitude' => $longitude,
					'timestamp' => date('Y-m-d H:i:s')
				]
			]);

		} catch (Exception $e) {
			error_log('Konum güncelleme hatası: ' . $e->getMessage());
			echo json_encode(['status' => 'error', 'message' => 'Veritabanı hatası']);
		}
	}

	/**
	 * Konum hatalarını logla
	 */
	public function konum_hata()
	{
		$json = file_get_contents('php://input');
		$data = json_decode($json, true);
		
		$control = session("r", "login_info");
		if (!$control) {
			return;
		}

		$kullanici_id = $control->kullanici_id;
		
		// Hata logunu kaydet
		$error_log = sprintf(
			"[%s] Kullanıcı ID: %d, Konum Hatası: %s (%d) - %s",
			date('Y-m-d H:i:s'),
			$kullanici_id,
			isset($data['error_message']) ? $data['error_message'] : 'Bilinmeyen hata',
			isset($data['error_code']) ? $data['error_code'] : 0,
			$this->input->ip_address()
		);
		
		error_log($error_log);
		echo json_encode(['status' => 'logged']);
	}

	/**
	 * Kullanıcının konum geçmişini getir
	 */
	public function konum_gecmisi($limit = 50)
	{
		$control = session("r", "login_info");
		if (!$control) {
			redirect("check");
			return;
		}

		$kullanici_id = $control->kullanici_id;
		
		// Yetki kontrolü (sadece admin veya kendisi görebilir)
		$user_group_id = $control->grup_id;
		$admin_groups = [1, 2, 5, 7];
		$is_admin = in_array($user_group_id, $admin_groups);
		
		// URL'den kullanici_id parametresi alınmışsa ve admin ise
		$target_user_id = $this->input->get('kullanici_id');
		if ($target_user_id && $is_admin) {
			$kullanici_id = $target_user_id;
		}

		$this->db->select('*');
		$this->db->from('kullanici_konum_takibi');
		$this->db->where('kullanici_id', $kullanici_id);
		$this->db->order_by('created_at', 'DESC');
		$this->db->limit($limit);
		
		$data['konum_gecmisi'] = $this->db->get()->result();
		$data['baslik'] = 'Konum Geçmişi';
		
		$this->load->view('kullanici/konum-gecmisi', $data);
	}

	/**
	 * Tüm kullanıcıların son konumları (Admin only)
	 */
	public function kullanici_konumlari()
	{
		$control = session("r", "login_info");
		if (!$control) {
			redirect("check");
			return;
		}

		// Yetki kontrolü - sadece adminler
		$user_group_id = $control->grup_id;
		$admin_groups = [1, 2, 5, 7];
		if (!in_array($user_group_id, $admin_groups)) {
			redirect("home/hata");
			return;
		}

		// Son konumları kullanıcı bilgileriyle birlikte getir
		$query = "
			SELECT 
				usk.*,
				k.kullanici_ad,
				k.kullanici_soyad,
				k.kullanici_eposta,
				k.kullanici_durum
			FROM kullanici_son_konum usk
			LEFT JOIN kullanicilar k ON usk.kullanici_id = k.kullanici_id
			WHERE usk.last_update >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
			ORDER BY usk.is_online DESC, usk.last_update DESC
		";
		
		$data['kullanici_konumlari'] = $this->db->query($query)->result();
		$data['baslik'] = 'Kullanıcı Konumları';
		
		$this->load->view('kullanici/kullanici-konumlari', $data);
	}
}

