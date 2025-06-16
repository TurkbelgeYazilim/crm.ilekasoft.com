<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct(){
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');
		
		$control = session("r", "login");

		// YETKİ KONTROLÜ KALDIRILDI
		// if (adminYetki() == 0)
		//   redirect("home/hata2/2");
	
		if(!$control){
			redirect("check");
		}
	}

	public function firmaYonetimi(){
		$data["baslik"] = "Admin / Firma Yönetimi";
		$anaHesap = anaHesapBilgisi();

		$iller = $this->db->get('iller');

		if($iller->num_rows() > 0){$data['_iller'] = $iller->result();
		}else{$data['_iller'] = false;}

		$firmaAdi = $this->input->get('firmaAdi');

		$urim = $this->uri->segment(2);

		$segment = 2;
		$sayfa = $this->input->get("sayfa");

		$page = $sayfa ? $sayfa : 0;
		$limit = 20;

		if($sayfa){$pagem = ($page-1)*$limit;}
		else{$pagem = 0;}

		if( (isset($firmaAdi) && !empty($firmaAdi)) ){

			if(!empty($firmaAdi)){$sorgu1 = "ayarlar_firmaAd LIKE '%$firmaAdi%'";}
			else{$sorgu1 = "";}

			$countq = "SELECT COUNT(*) as total FROM ayarlar WHERE ".$sorgu1." ";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;

			$sorgu = "SELECT * FROM ayarlar WHERE ".$sorgu1." ORDER BY ayarlar_id DESC LIMIT $pagem,$limit";
		}else{
			$countq = "SELECT COUNT(*) as total FROM ayarlar";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;
			$sorgu = "SELECT * FROM ayarlar ORDER BY ayarlar_id DESC LIMIT $pagem,$limit";
		}

		$data["count_of_list"] = $count;

		$this->load->library("pagination");

		$config = array();
		$config["base_url"] = base_url() . "/admin/$urim";
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
		$data["firmalar"] = $this->db->query($sorgu)->result();

		$this->load->view("admin/firma-yonetimi",$data);
	}

	public function firmaEkle(){
		$control2 = session("r", "login_info");
    $u_id = $control2->kullanici_id;

	 	date_default_timezone_set('Europe/Istanbul');
	 	$tarih = (new DateTime('now'))->format('Y.m.d H:i:s');
    $tarihi = (new DateTime('now'))->format('Y.m.d');
    $saati = (new DateTime('now'))->format('H:i:s');

    $kullaniciEposta = postval("kullanici_eposta");
    $kullaniciAdi = postval("kullanici_kullaniciAdi");

    $kullaniciQ = "SELECT * FROM kullanicilar WHERE kullanici_eposta = '$kullaniciEposta' OR kullanici_kullaniciAdi = '$kullaniciAdi'";
    $kullaniciExe = $this->db->query($kullaniciQ)->row();

    if($kullaniciExe){
    	$this->session->set_flashdata('firma_kullanici_var','OK');
   		redirect($_SERVER['HTTP_REFERER']);
    }

    $data_a["ayarlar_uniqID"] = generateUniqID();
		$data_a["ayarlar_firmaAd"] = postval("ayarlar_firmaAd");
		$data_a["ayarlar_firmaSektor"] = postval("ayarlar_firmaSektor");
		$data_a["ayarlar_telefon"] = postval("ayarlar_telefon");
		$data_a["ayarlar_eposta"] = postval("ayarlar_eposta");
		$data_a["ayarlar_vergiDairesi"] = postval("ayarlar_vergiDairesi");
		$data_a["ayarlar_vergiNo"] = postval("ayarlar_vergiNo");
		$data_a["ayarlar_il"] = postval("ayarlar_il");
		$data_a["ayarlar_ilce"] = postval("ayarlar_ilce");
		$data_a["ayarlar_adres"] = postval("ayarlar_adres");
		$data_a["ayarlar_olusturmaTarihi"] = $tarihi;
		$data_a["ayarlar_olusturmaSaati"] =  $saati;

		$this->vt->insert("ayarlar", $data_a);
    $a_id = $this->db->insert_id();

    giderKategorileriOlustur($a_id);
    //cariGruplariOlustur($a_id);
    //stokBirimleriOlustur($a_id);

		$data_u["kullanici_eposta"] = $kullaniciEposta;
		$data_u["kullanici_ad"] = postval("kullanici_ad");
		$data_u["kullanici_soyad"] = postval("kullanici_soyad");		$data_u["kullanici_kullaniciAdi"] = $kullaniciAdi;
		$data_u["kullanici_sifre"] = md5(postval("kullanici_sifre"));
		$data_u["kullanici_yetki"] = 1;
		$data_u["kullanici_durum"] = 1;
		$data_u["kullanici_sorumluMudur"] = $a_id;
		$data_u["kullanici_olusturmaTarihi"] = $tarihi;
		$data_u["kullanici_olusturan"] = $u_id;

		$this->vt->insert("kullanicilar", $data_u);

		$this->session->set_flashdata('firma_kullanici_ok','OK');
    redirect($_SERVER['HTTP_REFERER']);
	}

	public function firmaDuzenle(){
		$ayarlar_id = postval("ayarlar_id");

		$data_a["ayarlar_firmaAd"] = postval("ayarlar_firmaAd");
		$data_a["ayarlar_firmaSektor"] = postval("ayarlar_firmaSektor");
		$data_a["ayarlar_telefon"] = postval("ayarlar_telefon");
		$data_a["ayarlar_eposta"] = postval("ayarlar_eposta");
		$data_a["ayarlar_vergiDairesi"] = postval("ayarlar_vergiDairesi");
		$data_a["ayarlar_vergiNo"] = postval("ayarlar_vergiNo");
		$data_a["ayarlar_adres"] = postval("ayarlar_adres");

		$this->vt->update('ayarlar', array('ayarlar_id'=>$ayarlar_id), $data_a);

		$this->session->set_flashdata('firma_duzenle_ok','OK');
    redirect($_SERVER['HTTP_REFERER']);
	}

	public function kullaniciEkle(){
		$control2 = session("r", "login_info");
    $u_id = $control2->kullanici_id;

	 	date_default_timezone_set('Europe/Istanbul');
	 	$tarih = (new DateTime('now'))->format('Y.m.d H:i:s');

	 	$data["kullanici_eposta"] = postval("kullanici_eposta");
	 	$data["kullanici_ad"] = postval("kullanici_ad");
	 	$data["kullanici_soyad"] = postval("kullanici_soyad");
	 	$data["kullanici_kullaniciAdi"] = postval("kullanici_kullaniciAdi");
	 	$data["kullanici_sifre"] = md5(postval("kullanici_sifre"));
	 	$data["kullanici_yetki"] = postval("kullanici_yetki");	 	$data["kullanici_durum"] = 1;
	 	$data["kullanici_sorumluMudur"] = postval("anaHesap");
	 	$data["kullanici_olusturmaTarihi"] = $tarih;
	 	$data["kullanici_olusturan"] = $u_id;

	 	$this->vt->insert("kullanicilar", $data);
	 	$this->session->set_flashdata('kullanici_ok','OK');
    redirect($_SERVER['HTTP_REFERER']);
	}

	public function kullaniciDuzenle(){
		$kullanici_id = postval("kullanici_id");

		$data["kullanici_eposta"] = postval("kullanici_eposta");
	 	$data["kullanici_ad"] = postval("kullanici_ad");
	 	$data["kullanici_soyad"] = postval("kullanici_soyad");
	 	$data["kullanici_kullaniciAdi"] = postval("kullanici_kullaniciAdi");
	 	$data["kullanici_yetki"] = postval("kullanici_yetki");

	 	$this->vt->update('kullanicilar', array('kullanici_id'=>$kullanici_id), $data);

		$this->session->set_flashdata('kullanici_duzenle_ok','OK');
    redirect($_SERVER['HTTP_REFERER']);
	}

	public function genelLogKayitlari(){
		$data["baslik"] = "Admin / Genel Log Kayıtları";
		$anaHesap = anaHesapBilgisi();

		$islem = $this->input->get('islem');
		$kullanici = $this->input->get('kullanici');

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

		if( (isset($islem) && !empty($islem)) || (isset($tarihGet) && !empty($tarihGet)) || (isset($kullanici) && !empty($kullanici)) ){

			if(!empty($islem)){$sorgu1 = "AND log_islemTipi = '$islem'";}
			else{$sorgu1 = "";}

			if(!empty($tarihGet)){$sorgu2 = "AND log_islemTarih BETWEEN '$tarih1' AND '$tarih2'";}
			else{$sorgu2 = "";}

			if(!empty($kullanici)){

				$kullaniciQ = "SELECT kullanici_id FROM kullanicilar WHERE kullanici_kullaniciAdi = '$kullanici'";
				$kullaniciExe = $this->db->query($kullaniciQ)->row();
				$kullaniciIDsi = $kullaniciExe->kullanici_id;

				$sorgu3 = "AND log_userID = '$kullaniciIDsi'";

			}
			else{$sorgu3 = "";}


			$countq = "SELECT COUNT(*) as total FROM loglar WHERE log_anaHesap >= 1 ".$sorgu2." ".$sorgu1." ".$sorgu3."";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;

			$sorgu = "SELECT * FROM loglar WHERE log_anaHesap >= 1 ".$sorgu2." ".$sorgu1." ".$sorgu3." ORDER BY log_id DESC LIMIT $pagem,$limit";
		}else{
			$countq = "SELECT COUNT(*) as total FROM loglar";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;
			$sorgu = "SELECT * FROM loglar ORDER BY log_id DESC LIMIT $pagem,$limit";
		}

		$data["count_of_list"] = $count;

		$this->load->library("pagination");

		$config = array();
		$config["base_url"] = base_url() . "/admin/$urim";
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

		$this->load->view("admin/genel-log-kayitlari",$data);
	}

	public function moduller(){
  		$data["baslik"] = "Modül Yönetimi";

		$modullerq = "SELECT * FROM moduller WHERE modul_durum = 1";
		$data["moduller"] = $this->db->query($modullerq)->result();

		$this->load->view("admin/moduller", $data);
	}

	public function modul_olustur(){
		date_default_timezone_set('Europe/Istanbul');

		$firmaID = postval("firma");
		$modulID = postval("module");

  		$data["firmaModul_firmaID"] = $firmaID;
  		$data["firmaModul_moduleID"] = $modulID;
  		$data["firmaModul_durum"] = 1;
  		$data["firmaModul_tarih"] = (new DateTime('now'))->format('Y-m-d');

  		$sorgu = "SELECT * FROM firmaModulleri WHERE firmaModul_firmaID = '$firmaID' AND firmaModul_moduleID = '$modulID'";
  		$sorguExe = $this->db->query($sorgu)->row();

  		if(empty($sorguExe)){//kayıt et
			$this->vt->insert("firmaModulleri", $data);
			$this->session->set_flashdata('firma_modul_ok','OK');
		}else{//kayıt etme
			$this->session->set_flashdata('firma_modul_already_existed','OK');
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function modul_sil(){
  		$modul = $this->input->get("modul");

		$this->vt->del("firmaModulleri","firmaModul_id",$modul);

		$this->session->set_flashdata('firma_modul_sil','OK');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function desteksistemi(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$durum = $this->input->get('durum');

		$data["baslik"] = "Destek Sistemi";

		$urim = $this->uri->segment(2);

		$segment = 1;
		$sayfa = $this->input->get("sayfa");

		$page = $sayfa ? $sayfa : 0;
		$limit = 20;

		if($sayfa){$pagem = ($page-1)*$limit;}
		else{$pagem = 0;}

		if( (isset($durum) && !empty($durum)) ){

			if(!empty($durum)){$sorgu1 = "destek_status = '$durum'";}
			else{$sorgu1 = "";}

			$countq = "SELECT COUNT(*) as total FROM destek WHERE ".$sorgu1."";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;

			$sorgu = "SELECT * FROM destek WHERE ".$sorgu1." ORDER BY destek_id DESC LIMIT $pagem,$limit";
		}else {
			$countq = "SELECT COUNT(*) as total FROM destek";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;
			$sorgu = "SELECT * FROM destek ORDER BY destek_id DESC LIMIT $pagem,$limit";
		}

		$data["count_of_list"] = $count;

		$this->load->library("pagination");

		$config = array();
		$config["base_url"] = base_url() . "admin/$urim";
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
		$data["destekler"] = $this->db->query($sorgu)->result();

		$this->load->view("admin/destek",$data);
	}

	public function destekdetay($id){
		$data["baslik"] = "Destek Sistemi - Detay";
		$data["talep"] = $this->db->query("SELECT * FROM destek WHERE destek_id = $id")->row();
		$data["yanitlar"] = $this->db->query("SELECT * FROM destek_yanit WHERE dyanit_destekID = $id")->result();

		$this->load->view("admin/destek-detay",$data);
	}

	public function dyanit_gonder(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarih = (new DateTime('now'))->format('Y.m.d H:i:s');

		$destek_id = postval("dyanit_destekID");
		$data["dyanit_destekID"] = $destek_id;
		$data["dyanit_mesaj"] = postval("dyanit_mesaj");
		$data["dyanit_yanitlayan"] = $u_id;
		$data["dyanit_yanitlayanAnaHesap"] = $anaHesap;
		$data["dyanit_tarih"] = $tarih;
		$data["dyanit_isAdmin"] = 1;

		$this->vt->insert("destek_yanit", $data);

		$data_u["destek_lastUpdateDate"] = $tarih;
		$data_u["destek_isRead"] = 0;
		$data_u["destek_status"] = 3;

		$this->vt->update('destek', array('destek_id'=>$destek_id), $data_u);

		$destekQ = $this->db->query("SELECT * FROM destek WHERE destek_id = $destek_id")->row();
		$destekOlusturanID = $destekQ->destek_olusturan;
		$kullaniciKim = getirKullaniciById($destekOlusturanID);
		$kullaniciMail = $kullaniciKim->kullanici_eposta;

		$mail_config = Array(
			'protocol' => 'smtp',
			'smtp_crypto' => 'ssl',
			'smtp_host' => 'mail.ilekasoft.com',
			'smtp_port' => 465,
			'smtp_user' => 'ticket@ilekasoft.com',
			'smtp_pass' => '0oqZknrfOw',
			'charset'   => 'utf-8',
			'mailtype'  => 'html',
			'wordwrap' => TRUE
		);

		$this->load->library('email', $mail_config);
		$this->email->set_newline("\r\n");
		$this->email->to($kullaniciMail);
		$this->email->from("ticket@ilekasoft.com","ilekasoft.com");
		$this->email->subject('ilekasoft.com - Bilgilendirme');
		$this->email->message('Destek talebinize bir yanıt geldi, lütfen site üzerinden kontrol ediniz.');
		if (!$this->email->send()){
			echo $this->email->print_debugger();
		}

		$this->session->set_flashdata('destekyanit_ok','OK');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function destekIslem($id){
		date_default_timezone_set('Europe/Istanbul');
		$tarih = (new DateTime('now'))->format('Y.m.d H:i:s');

		$data_u["destek_lastUpdateDate"] = $tarih;
		$data_u["destek_isRead"] = 0;

	  $data_u["destek_status"] = 2;
	  $this->vt->update('destek', array('destek_id'=>$id), $data_u);

		$this->session->set_flashdata('ok','OK');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function duyurular(){
		$data["baslik"] = "Duyurular";

		$urim = $this->uri->segment(2);

		$segment = 1;
		$sayfa = $this->input->get("sayfa");

		$page = $sayfa ? $sayfa : 0;
		$limit = 20;

		if($sayfa){$pagem = ($page-1)*$limit;}
		else{$pagem = 0;}

		$countq = "SELECT COUNT(*) as total FROM duyurular";
		$countexe = $this->db->query($countq)->row();
		$count = $countexe->total;
		$sorgu = "SELECT * FROM duyurular ORDER BY duyuru_id DESC LIMIT $pagem,$limit";

		$data["count_of_list"] = $count;

		$this->load->library("pagination");

		$config = array();
		$config["base_url"] = base_url() . "admin/$urim";
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
		$data["duyurular"] = $this->db->query($sorgu)->result();

		$this->load->view("admin/duyurular",$data);
	}

	public function yeniDuyuruOlustur(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarih = (new DateTime('now'))->format('Y.m.d H:i:s');

		$data["duyuru_msg"] = postval("duyuru_msg");
		$data["duyuru_olusturan"] = $u_id;
		$data["duyuru_durum"] = 1;
		$data["duyuru_tarih"] = $tarih;

		$this->vt->insert("duyurular", $data);
		$this->session->set_flashdata('ok','OK');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function duyuruPasif($id){
	  $sorgu = "SELECT * FROM duyurular WHERE duyuru_id = $id";
	  $duyuru = $this->db->query($sorgu)->row();
	  $duyuruDurum = $duyuru->duyuru_durum;

	  if($duyuruDurum == 1){
		  $data_u["duyuru_durum"] = 2;
		  $this->vt->update('duyurular', array('duyuru_id'=>$id), $data_u);
	  }else if($duyuruDurum == 2){
		  $data_u["duyuru_durum"] = 1;
		  $this->vt->update('duyurular', array('duyuru_id'=>$id), $data_u);
	  }else{
		  $this->session->set_flashdata('no','OK');
		  redirect($_SERVER['HTTP_REFERER']);
	  }
		$this->session->set_flashdata('ok','OK');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function duyuruDuzenle(){
		$duyuru_id = postval("duyuru_id");

		$data["duyuru_msg"] = postval("duyuru_msg");

		$this->vt->update('duyurular', array('duyuru_id'=>$duyuru_id), $data);

		$this->session->set_flashdata('ok','OK');
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function sifreDuzenle(){
		$id = postval("kullanici_id2");
		$sifre = postval("sifre");
		
		$sifreMD5 = md5($sifre);
		$data["kullanici_sifre"] = $sifreMD5;
		
		$this->vt->update('kullanicilar', array('kullanici_id'=>$id), $data);

		$this->session->set_flashdata('ok','OK');
		redirect($_SERVER['HTTP_REFERER']);
	}

}
