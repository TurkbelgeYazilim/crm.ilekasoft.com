<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');

		$control = session("r", "login");

		/*$control2 = session("r", "login_info");
		if(isDemoActive() == 1){
			if(demoDateExpireControl($control2->kullanici_id) <= -1){
				redirect('hata/hata2');
			}
		}*/

		if(!$control){
			redirect("check");
		}
	}

	public function index(){
	
		$data["baslik"] = "Anasayfa";
		$anaHesap = anaHesapBilgisi();

		$modulGibSorgula = modulSorgula($anaHesap, 2);
		$modulOcrSorgula = modulSorgula($anaHesap, 4);
		if ($modulGibSorgula) {
			redirect("gib/index");
		}else if ($modulOcrSorgula) {
			redirect("ocr/index");
		} 	 else {			// Get logged-in user ID to filter only their sales invoices
			$control2 = session("r", "login_info");
			$logged_in_user_id = $control2->kullanici_id;
			
			$satisFaturasiQ = "SELECT satis_faturaTarihi as faturaTarihi,satis_faturaNo as faturaNo,satis_genelToplam as genelToplam,satis_paraBirimi as paraBirimi,'satis' as tip,satis_id as id,cari.cari_id,concat(cari.cari_ad,' ',cari.cari_soyad) as cari_ad FROM satisFaturasi inner join cari on satisFaturasi.satis_cariID=cari.cari_id  WHERE satis_olusturanAnaHesap = '$anaHesap' and satis_InvoiceType is null and satis_olusturan = '$logged_in_user_id' ORDER BY satis_id DESC LIMIT 6";
			$alisFaturasiQ = "SELECT alis_faturaTarihi as faturaTarihi,alis_faturaNo as faturaNo,alis_genelToplam as genelToplam,alis_paraBirimi as paraBirimi,'alis' as tip,alis_id as id,cari.cari_id,concat(cari.cari_ad,' ',cari.cari_soyad) as cari_ad FROM alisFaturasi inner join cari on alisFaturasi.alis_cariID=cari.cari_id  WHERE alis_olusturanAnaHesap = '$anaHesap' and alis_olusturan = '$logged_in_user_id' ORDER BY alis_id DESC LIMIT 6";
    		
    		$af = $this->db->query($alisFaturasiQ)->result();
            $sf = $this->db->query($satisFaturasiQ)->result();
    		
    	
    	$sf=seciliAlanlarSorgu($satisFaturasiQ);
      	$af=seciliAlanlarSorgu($alisFaturasiQ);
         
    		$fatura = array_merge($sf, $af);
    		rsort($fatura);
    		$data["fatura"] = array_chunk($fatura, 6)[0];  		// Calculate sales count and total amount for the logged-in user for today only
		$control2 = session("r", "login_info");
		$satis_adedi_bugun = 0;
		$satis_toplam_bugun = 0;
		
		if ($control2 && isset($control2->kullanici_id)) {
			$logged_in_user_id = $control2->kullanici_id;
			$bugun = date('Y-m-d');
					$satis_adedi_query = "SELECT COUNT(*) as toplam_satis_faturasi 
								  FROM satisFaturasi 
								  WHERE satis_olusturan = '$logged_in_user_id' 
									AND satis_faturaTarihi = '$bugun'
									AND satis_olusturanAnaHesap = '$anaHesap'
									AND satis_InvoiceType IS NULL";
			$satis_adedi_result = $this->db->query($satis_adedi_query)->row();
			
			if ($satis_adedi_result && isset($satis_adedi_result->toplam_satis_faturasi)) {
				$satis_adedi_bugun = $satis_adedi_result->toplam_satis_faturasi;
			}
			
			// Calculate total sales amount for today
			$satis_toplam_query = "SELECT SUM(satis_genelToplam) as toplam_satis_tutari 
								   FROM satisFaturasi 
								   WHERE satis_olusturan = '$logged_in_user_id' 
									 AND satis_faturaTarihi = '$bugun'
									 AND satis_olusturanAnaHesap = '$anaHesap'
									 AND satis_InvoiceType IS NULL";
			$satis_toplam_result = $this->db->query($satis_toplam_query)->row();
			
			if ($satis_toplam_result && isset($satis_toplam_result->toplam_satis_tutari)) {
				$satis_toplam_bugun = $satis_toplam_result->toplam_satis_tutari ?: 0;
			}
		}
		
		$data["satis_adedi_bugun"] = $satis_adedi_bugun;
		$data["satis_toplam_bugun"] = $satis_toplam_bugun;
         
			$this->load->view('index', $data);
		}
		

	}


	public function istatistikDonut()
	{
		$anaHesap = anaHesapBilgisi();

		$satisFaturasiQ = "SELECT sum(satis_genelToplam) as toplam,'satis' as tip,satis_id as id FROM satisFaturasi WHERE satis_olusturanAnaHesap = '$anaHesap' and satis_InvoiceType is null ORDER BY satis_id DESC LIMIT 6";
		$sf = $this->db->query($satisFaturasiQ)->row();

		$alisFaturasiQ = "SELECT sum(alis_genelToplam) as toplam,'alis' as tip,alis_id as id FROM alisFaturasi WHERE alis_olusturanAnaHesap = '$anaHesap' ORDER BY alis_id DESC LIMIT 6";
		$af = $this->db->query($alisFaturasiQ)->row();
		$data = "$sf->toplam,$af->toplam";
		
		print ($data);
	}


	public function istatistikBar()
	{
		$anaHesap = anaHesapBilgisi();

		$bugun = date("Y-m-d");
		$once = strtotime('-6 days', strtotime($bugun));
		$dateOnce = date("Y-m-d", $once);

		$satisFaturasiQ = "SELECT satis_faturaTarihi,sum(satis_genelToplam) as satis_genelToplam FROM satisFaturasi where satis_InvoiceType is null and satis_olusturanAnaHesap=$anaHesap and satis_faturaTarihi BETWEEN '$dateOnce' and '$bugun'  GROUP by satis_faturaTarihi order by satis_faturaTarihi ASC ";
		$sf = $this->db->query($satisFaturasiQ)->result();
		$alisFaturasiQ = "SELECT alis_faturaTarihi,sum(alis_genelToplam) as alis_genelToplam FROM alisFaturasi where alis_olusturanAnaHesap=$anaHesap and alis_faturaTarihi BETWEEN '$dateOnce' and '$bugun' GROUP by alis_faturaTarihi order by alis_faturaTarihi ASC";

		$af = $this->db->query($alisFaturasiQ)->result();
		$dataSf = "";
		$dataAf = "";
		$dataGun = "";

		for ($i = $once; $i <= strtotime($bugun); $i = $i + 86400) {
			$date = date("Y-m-d", $i);

			$dataGun .= gunler(date('w', $i)) . ",";
			$j = 0;
			$k = 0;
			foreach ($sf as $satis) {
				if ($satis->satis_faturaTarihi == $date) {
					$dataSf .= "" . round($satis->satis_genelToplam, 2) . ",";
					$j = 1;
					break;
				}
			}

			if ($j == 0)
				$dataSf .= "0,";

			foreach ($af as $alis) {
				if ($alis->alis_faturaTarihi == $date) {
					$dataAf .= "" . round($alis->alis_genelToplam, 2) . ",";
					$k = 1;
					break;
				}
			}
			if ($k == 0)
				$dataAf .= "0,";
		}


		$data = trim($dataSf, ",") . "-" . trim($dataAf, ",") . "-" . trim($dataGun, ",");

		print ($data);

	}

	public function get_ilceler()
	{
		//ajaxta post ile gelen il id'si
		$il_id = $this->input->post('il_id');
		if (empty($il_id)) {
			$data = array('status' => 'error', 'message' => 'İl ID Bilgisi Alınamadı..!');
		} else {
			//ile göre ilçeler çekiliyor...
			$ilceler = $this->db->get_where('ilceler', array('il_id' => $il_id));
			if ($ilceler->num_rows() > 0) {
				$ilceList = array();
				foreach ($ilceler->result() as $item) {
					$ilceList[] = array('id' => $item->id, 'ilce' => $item->ilce);
				}
				//var olan iller data keyine aktarılıyor...
				$data = array('status' => 'ok', 'message' => '', 'data' => $ilceList);
			} else {
				$data = array('status' => 'error', 'message' => 'İlçe Bulunamadı..!');
			}
		}
		//çıktıyı jsona uygun bir yapıda set ediyoruz...
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function hata()
	{
		//logekle(54,7);
		$this->load->view('hata');
	}

	public function hata2($id)
	{
		if($id == 1){//gib modül yok
			$data["hataBaslik"] = "Modüle sahip değilsiniz!";
			$data["hataMesaji"] = "GIB/IVD'ye gelen ilekaSoft üzerinde görüntüleyebilmek, muhasebe işlemlerinize dahil edebilmek için modüle sahip olmanız gerekmektedir! <hr>Detaylı bilgi ve modülü talep etmek için lütfen arayınız: <a href='tel:0850 333 0 353' style='text-decoration: underline;color:#000!important;'>0850 333 0 353</a>";
		}else if($id == 2){//admin değil
			$data["hataBaslik"] = "Yetkiniz yok!";
			$data["hataMesaji"] = "Yetkiniz olmayan bir sayfaya girmek istediğiniz için bu sayfa sizlerle paylaşılamıyor.";
		}else if($id == 3){//demo süresi bitti
			$data["hataBaslik"] = "Demo süreniz sona erdi.";
			$data["hataMesaji"] = "Ücretsiz kullanım süreniz sona ermiş, bilgileriniz bir süre daha sunucularımızda saklanmaya devam edecektir, üyeliğinizi devam ettirmek için <a href='#'>satın alma</a> sayfasını ziyaret ediniz.";
		}
		$this->load->view('hata_d',$data);
	}

	public function logout()
	{
		logekle(54, 6);
		$this->session->sess_destroy();
		redirect('check');
	}

	public function tests2()
	{
		$ws = 'https://apiportal.turkbelge.com.tr/TurkBelgeWS.asmx?wsdl';

		$trace = true;
		$exceptions = false;

		$xml_array->request = '';

		$client = new SoapClient($ws, array('trace' => $trace, 'exceptions' => $exceptions));

		//var_dump($client->__getFunctions());die;

		$response = $client->GetGibUserListAdded($xml_array);
		print_r($response);
	}

	public function ubltest(){
		$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><Invoice/>');
		$xml->addAttribute('xmlns', 'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2');
		$xml->addAttribute('xmlns:qdt', 'urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2');
		$xml->addAttribute('xmlns:cbc', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
		$xml->addAttribute('xmlns:udt', 'urn:un:unece:uncefact:data:draft:UnqualifiedDataTypesSchemaModule:2');
		$xml->addAttribute('xmlns:cac', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
		$xml->addAttribute('xmlns:ccts', 'urn:un:unece:uncefact:data:draft:UnqualifiedDataTypesSchemaModule:2');
		$xml->addAttribute('xmlns:udt', 'urn:oasis:names:specification:ubl:schema:xsd:CoreComponentParameters-2');
		$xml->addAttribute('xmlns:stat', 'urn:oasis:names:specification:ubl:schema:xsd:DocumentStatusCode-1.0');

		$xml->addChild('cbc:UBLVersionID', '2.1');

		echo $xml->asXml();
	}

	public function sessionKontrol(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;
		$sql="select * from kullanicilar where kullanici_id=$u_id";
		$exe=$this->db->query($sql)->row();
			if ($_SESSION["kullanici_oturumDurum"] == $exe->kullanici_oturumDurum)
				$sonuc = "0";
			else {
				$sonuc = "1";
			}
		$this->output->set_content_type('application/json')->set_output(json_encode($sonuc));
	}

	public function destek(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$data["baslik"] = "Destek Sistemi";

		$urim = $this->uri->segment(1);

		$segment = 1;
		$sayfa = $this->input->get("sayfa");

		$page = $sayfa ? $sayfa : 0;
		$limit = 20;

		if($sayfa){$pagem = ($page-1)*$limit;}
		else{$pagem = 0;}

		$countq = "SELECT COUNT(*) as total FROM destek WHERE destek_olusturan = $u_id";
		$countexe = $this->db->query($countq)->row();
		$count = $countexe->total;
		$sorgu = "SELECT * FROM destek WHERE destek_olusturan = $u_id ORDER BY destek_id DESC LIMIT $pagem,$limit";

		$data["count_of_list"] = $count;

		$this->load->library("pagination");

		$config = array();
		$config["base_url"] = base_url() . "/$urim";
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

		$this->load->view("destek",$data);
	}

	public function yeniTicket(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarih = (new DateTime('now'))->format('Y.m.d H:i:s');

		$data["destek_title"] = postval("destek_title");
		$data["destek_department"] = postval("destek_department");
		$data["destek_priority"] = postval("destek_priority");
		$data["destek_status"] = 1;
		$data["destek_isRead"] = 1;
		$data["destek_date"] = $tarih;
		$data["destek_ip"] = ipadresial();
		$data["destek_olusturan"] = $u_id;
		$data["destek_olusturanAnaHesap"] = $anaHesap;

		$this->vt->insert("destek", $data);

		$destek_id = $this->db->insert_id();

		$this->load->library('upload');
		$config['upload_path'] = './assets/bulut/tickets/';
		$config['encrypt_name'] = TRUE;
		$config['allowed_types']="jpg|jpeg|png|xml|pdf";
		$config['max_size']="1024";
		$config['remove_space']=true;

		$this->upload->initialize($config);

		if(!empty($_FILES['destek_img']['name'])){
			if ($this->upload->do_upload('destek_img')){
				$datam   = $this->upload->data();
				$image  = $datam['file_name'];
			}else{
				$this->session->set_flashdata('resim_hata','OK');
				$this->vt->del("destek","destek_id",$destek_id);
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			$image=NULL;
		}

		$data_d["dyanit_destekID"] = $destek_id;
		$data_d["dyanit_yanitlayan"] = $u_id;
		$data_d["dyanit_mesaj"] = postval("destek_msg");
		$data_d["dyanit_resim"] = $image;
		$data_d["dyanit_tarih"] = $tarih;
		$data_d["dyanit_isAdmin"] = 0;
		$data_d["dyanit_yanitlayanAnaHesap"] = $anaHesap;

		$this->vt->insert("destek_yanit", $data_d);

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
		$this->email->to("destek@turkbelge.com.tr,yazilim@turkbelge.com.tr");
		$this->email->from("ticket@ilekasoft.com","ilekasoft.com");
		$this->email->cc("buse.gumusboga@turkbelge.com.tr,mine.aydin@turkbelge.com.tr");
		$this->email->subject('ilekasoft.com - Bilgilendirme');
		$this->email->message('Yeni destek talebi var, lütfen kontrol edin.');
		if (!$this->email->send()){
			echo $this->email->print_debugger();
		}

		$this->session->set_flashdata('destek_ok','OK');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function destekdetay($id){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$data["baslik"] = "Destek Sistemi - Detay";
		$data["talep"] = $this->db->query("SELECT * FROM destek WHERE destek_id = $id")->row();
		$data["yanitlar"] = $this->db->query("SELECT * FROM destek_yanit WHERE dyanit_destekID = $id")->result();

		$isRead = $data["talep"]->destek_isRead;
		$kim = $data["talep"]->destek_olusturan;

		if($kim == $u_id){
			if($isRead == 0){
				$data_a["destek_isRead"] = 1;

				$this->vt->update('destek', array('destek_id'=>$id), $data_a);
			}

			$this->load->view("destek-detay",$data);
		}else{
			redirect("home/hata2/2");
		}
	}

    public function dovizKur(){
        $this->load->view("doviz-kur");
    }

	public function dyanit_gonder(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarih = (new DateTime('now'))->format('Y.m.d H:i:s');

		$destek_id = postval("dyanit_destekID");;
		$data["dyanit_destekID"] = $destek_id;
		$data["dyanit_mesaj"] = postval("dyanit_mesaj");
		$data["dyanit_yanitlayan"] = $u_id;
		$data["dyanit_yanitlayanAnaHesap"] = $anaHesap;
		$data["dyanit_tarih"] = $tarih;
		$data["dyanit_isAdmin"] = 0;

		$this->vt->insert("destek_yanit", $data);

		$data_u["destek_lastUpdateDate"] = $tarih;
		$data_u["destek_status"] = 1;

		$this->vt->update('destek', array('destek_id'=>$destek_id), $data_u);

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
		$this->email->to("destek@turkbelge.com.tr,yazilim@turkbelge.com.tr");
		$this->email->from("ticket@ilekasoft.com","ilekasoft.com");
		$this->email->cc("buse.gumusboga@turkbelge.com.tr,mine.aydin@turkbelge.com.tr");
		$this->email->subject('ilekasoft.com - Bilgilendirme');
		$this->email->message('Destek talebine bir yanıt geldi, lütfen kontrol edin.');
		if (!$this->email->send()){
			echo $this->email->print_debugger();
		}

		$this->session->set_flashdata('destekyanit_ok','OK');
		redirect($_SERVER['HTTP_REFERER']);
	}
}
