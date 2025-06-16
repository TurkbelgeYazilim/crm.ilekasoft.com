<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kayit extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');

		$control = session("r","login");

		if($control){
			redirect("");
		}
	}

	public function get_ilceler(){
		$il_id = $this->input->post('il_id');
		if (empty($il_id)) {
			$data = array('status' => 'error', 'message' => 'İl ID Bilgisi Alınamadı..!');
		} else {
			$ilceler = $this->db->get_where('ilceler', array('il_id' => $il_id));
			if ($ilceler->num_rows() > 0) {
				$ilceList = array();
				foreach ($ilceler->result() as $item) {
					$ilceList[] = array('id' => $item->id, 'ilce' => $item->ilce);
				}
				$data = array('status' => 'ok', 'message' => '', 'data' => $ilceList);
			} else {
				$data = array('status' => 'error', 'message' => 'İlçe Bulunamadı..!');
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function index(){
		$data["baslik"] = "Kayıt";

		$this->load->view('kayit', $data);
	}

	public function onay(){
		$data2["baslik"] = "Onay";

		$otpKodu = mt_rand(100000,999999);
		$eposta = postval("eposta");

		$kullaniciQ = "SELECT * FROM kullanicilar WHERE kullanici_eposta = '$eposta'";
		$kullaniciExe = $this->db->query($kullaniciQ)->row();


		if(!isset($eposta) || !$eposta ){
			$this->session->set_flashdata('eposta_no','OK');
			redirect('kayit');
		}

		if($kullaniciExe){
			$this->session->set_flashdata('emailvar', 'OK');
			redirect('kayit');
		}

		$mail_config = Array(
			'protocol' => 'smtp',
			'smtp_crypto' => 'ssl',
			'smtp_host' => 'mail.ilekasoft.com',
			'smtp_port' => 465,
			'smtp_user' => 'onay@ilekasoft.com',
			'smtp_pass' => 'K7e6WYkIO3',
			'charset'   => 'utf-8',
			'mailtype'  => 'html',
			'wordwrap' => TRUE
		);

		$this->load->library('email', $mail_config);
		$this->email->set_newline("\r\n");
		$this->email->to($eposta);
		$this->email->from("onay@ilekasoft.com","ilekasoft.com");
		$this->email->subject('ilekasoft.com - Doğrulama Kodu');
		$this->email->message('Doğrulama kodunuz: '.$otpKodu.'');
		if (!$this->email->send()){
			echo $this->email->print_debugger();
		}

		$data2["eposta"] =  $eposta;
		$data2["otpKodu"] =  $otpKodu;

		$this->session->set_userdata('smsbilgi',$data2);

		$iller = $this->db->get('iller');

		if ($iller->num_rows() > 0) {
			$data2['_iller'] = $iller->result();
		} else {
			$data2['_iller'] = false;
		}

		$this->load->view('kayit2',$data2);
	}

	public function CheckOTP(){
		$otpData = $this->session->userdata('smsbilgi');
		$otpSent = $otpData["otpKodu"];
		$otpConfirmation = $this->input->post("otpConfirmation");

		if(isset($otpConfirmation) && !$otpConfirmation==""){
			if($otpConfirmation == $otpSent){echo "11";}else{echo "22";}
		}else{echo "2";}
	}

	public function complete(){
		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$tarihsaat = (new DateTime('now'))->format('Y-m-d H:i:s');
		$saati = (new DateTime('now'))->format('H:i:s');

		$demoSonTarih =  date('Y-m-d H:i:s', strtotime($tarihsaat. ' + 14 days'));

		$firma_adi = postval("firma_adi");
		$firma_telefon = postval("firma_telefon");
		$firma_eposta = postval("firma_eposta");
		$firma_adres = postval("firma_adres");
		$vkntckn = postval("vkntckn");
		$vergidairesi = postval("vergidairesi");
		$il = postval("il");
		$ilce = postval("ilce");

		$yetkili_ad = postval("yetkili_ad");
		$yetkili_soyad = postval("yetkili_soyad");
		$yetkilieposta = postval("yetkilieposta");
		$sifre = randomPassword();
		$sifreMD5 = md5($sifre);

		$kullaniciQ = "SELECT * FROM kullanicilar WHERE kullanici_eposta = '$yetkilieposta' OR kullanici_kullaniciAdi = '$vkntckn'";
		$kullaniciExe = $this->db->query($kullaniciQ)->row();

		if($kullaniciExe){echo "1";die;}

		$data_a["ayarlar_uniqID"] = generateUniqID();
		$data_a["ayarlar_firmaAd"] = $firma_adi;
		$data_a["ayarlar_firmaSektor"] = "DEMO";
		$data_a["ayarlar_telefon"] = $firma_telefon;
		$data_a["ayarlar_eposta"] = $firma_eposta;
		$data_a["ayarlar_vergiDairesi"] = $vergidairesi;
		$data_a["ayarlar_vergiNo"] = $vkntckn;
		$data_a["ayarlar_il"] = $il;
		$data_a["ayarlar_ilce"] = $ilce;
		$data_a["ayarlar_adres"] = $firma_adres;
		$data_a["ayarlar_olusturmaTarihi"] = $tarihi;
		$data_a["ayarlar_olusturmaSaati"] =  $saati;

		$this->vt->insert("ayarlar", $data_a);
		$a_id = $this->db->insert_id();

		giderKategorileriOlustur($a_id);

		$data_u["kullanici_eposta"] = $yetkilieposta;
		$data_u["kullanici_ad"] = $yetkili_ad;
		$data_u["kullanici_soyad"] = $yetkili_soyad;		$data_u["kullanici_kullaniciAdi"] = $vkntckn;
		$data_u["kullanici_sifre"] = $sifreMD5;		$data_u["kullanici_yetki"] = 1; // For backward compatibility with admin system
		$data_u["kullanici_grupID"] = 1; // Tam Yetki grubu (Full Access group)
		$data_u["kullanici_durum"] = 1;
		$data_u["kullanici_sorumluMudur"] = $a_id;
		$data_u["kullanici_olusturmaTarihi"] = $tarihsaat;
		$data_u["kullanici_demo"] = 1;
		$data_u["kullanici_demoSonTarihi"] = $demoSonTarih;
		$data_u["kullanici_olusturan"] = 1;
		$data_u["kullanici_olusturanIP"] = ipadresial();

		$this->vt->insert("kullanicilar", $data_u);

		$mail_config = Array('protocol' => 'smtp','smtp_crypto' => 'ssl','smtp_host' => 'mail.ilekasoft.com','smtp_port' => 465,'smtp_user' => 'onay@ilekasoft.com','smtp_pass' => 'K7e6WYkIO3','charset'   => 'utf-8','mailtype'  => 'html','wordwrap' => TRUE);

		$this->load->library('email', $mail_config);
		$this->email->set_newline("\r\n");
		$this->email->to($yetkilieposta);
		$this->email->from("onay@ilekasoft.com","ilekasoft.com");
		$this->email->subject('ilekasoft.com - Demo Giriş Bilgileriniz');
		$this->email->message('Kullanıcı adı: '.$yetkilieposta.' Şifre: '.$sifre.'');
		if (!$this->email->send()){
			echo $this->email->print_debugger();
		}

		$mail_config2 = Array('protocol' => 'smtp','smtp_crypto' => 'ssl','smtp_host' => 'mail.ilekasoft.com','smtp_port' => 465,'smtp_user' => 'onay@ilekasoft.com','smtp_pass' => 'K7e6WYkIO3','charset'   => 'utf-8','mailtype'  => 'html','wordwrap' => TRUE);

		$this->load->library('email', $mail_config);
		$this->email->set_newline("\r\n");
		$this->email->to("destek@turkbelge.com.tr");
		$this->email->from("onay@ilekasoft.com","ilekasoft.com");
		$this->email->cc("buse.gumusboga@turkbelge.com.tr,mine.aydin@turkbelge.com.tr,harun.pinar@turkbelge.com.tr,tevfik.yilmaz@turkbelge.com.tr");
		$this->email->subject('ilekasoft.com - Demo Kayıt Bilgilendirmesi');
		$this->email->message('Yeni demo kullanıcı kaydı tamamlandı. e-Posta adresi: '.$yetkilieposta.' - Firma telefon: '.$firma_telefon.' Firma adı: '.$firma_adi.'  Yetkili ad: '.$yetkili_ad.'  Yetkili soyad: '.$yetkili_soyad.' ');
		if (!$this->email->send()){
			echo $this->email->print_debugger();
		}

		echo "2";
	}
}
