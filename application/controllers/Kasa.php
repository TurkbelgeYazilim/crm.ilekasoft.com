<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Kasa extends CI_Controller {

  public function __construct(){
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');
		
		$control = session("r", "login");


	  if(gibYetki()==1)
		  redirect("home/hata");

	  if(!$control){
			redirect("check");
		}
	  //sessionKontrolHelper();
	}

	public function kasaAcilisKarti(){
		$data["baslik"] = "Kasa / Kasa Açılış Kartı";
		$this->load->view('kasa/kasa-acilis-karti', $data);
	}

	public function yeniKasaAcilisKarti(){
		$control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$kasaKodu = postval("kasa_kodu");
		$kasaAdi = postval("kasa_adi");
		$kasaBaslangic = postval("kasa_baslangic");

		$data["kasa_kodu"] = $kasaKodu;
		$data["kasa_adi"] = $kasaAdi;
		$data["kasa_baslangic"] = $kasaBaslangic;
		$data["kasa_aciklama"] = postval("kasa_aciklama");
		$data["kasa_olusturanAnaHesap"] = $anaHesap;
		$data["kasa_olusturan"] = $u_id;
		$data["kasa_olusturmaTarihi"] = $tarihi;
		$data["kasa_olusturmaSaati"] = $saati;

		$kasaVarmiQ = "SELECT * FROM kasa WHERE (kasa_kodu = '$kasaKodu' OR kasa_adi = '$kasaAdi') AND kasa_olusturanAnaHesap = '$anaHesap'";
		$kasaVarmi = $this->db->query($kasaVarmiQ)->row();

		if($kasaVarmi){
			$this->session->set_flashdata('kasa_var','OK');
			redirect("kasa/kasa-acilis-karti");
		}else{
			$this->vt->insert("kasa", $data);

			$kasa_id = $this->db->insert_id();

			$datakh["kh_kasaID"]=$kasa_id;
			$datakh["kh_turu"] = 14;
			$datakh["kh_giris"] = $kasaBaslangic;
			$datakh["kh_tarih"] = $tarihi;
			$datakh["kh_aciklama"] = "Kasa Açılış Bakiyesi";

			$datakh["kh_olusturan"] = $u_id;
			$datakh["kh_olusturanAnaHesap"] = $anaHesap;
			$datakh["kh_olusturmaTarihi"] =  $tarihi;
			$datakh["kh_olusturmaSaati"] = $saati;
			$this->vt->insert("kasaHareketleri", $datakh);



			$this->session->set_flashdata('kasa_ok','OK');
	        logekle(15,2);
	        redirect("kasa/kasa-acilis-karti-duzenle/$kasa_id");
		}
	}

	public function kasaAcilisKartiDuzenle($id){
		$data["baslik"] = "Kasa / Kasa Açılış Kartı Düzenle";
		$anaHesap = anaHesapBilgisi();
		$kasaQ = "SELECT * FROM kasa WHERE kasa_id = '$id' AND kasa_olusturanAnaHesap = '$anaHesap'";
		$data["kasa"] = $this->db->query($kasaQ)->row();

		$olusturanHesapKim = $data["kasa"]->kasa_olusturanAnaHesap;

		if($anaHesap == $olusturanHesapKim){
			$this->load->view("kasa/kasa-acilis-karti-duzenle",$data);
		}else{
			redirect('hata');
		}
	}

	public function mevcutKasaAcilisKartiGuncelle(){
		$anaHesap = anaHesapBilgisi();

		$kasa_id = postval("kasaID");

		$kasaKodu = postval("kasa_kodu");
		$kasaAdi = postval("kasa_adi");

		$data["kasa_kodu"] = $kasaKodu;
		$data["kasa_adi"] = $kasaAdi;
		$data["kasa_aciklama"] = postval("kasa_aciklama");

		$kasaVarmiQ = "SELECT * FROM kasa WHERE (kasa_kodu = '$kasaKodu' OR kasa_adi = '$kasaAdi') AND kasa_olusturanAnaHesap = '$anaHesap' AND kasa_id != $kasa_id";
		$kasaVarmi = $this->db->query($kasaVarmiQ)->row();

		if($kasaVarmi){
			$this->session->set_flashdata('kasa_updt_var','OK');
			redirect("kasa/kasa-acilis-karti-duzenle/$kasa_id");
		}else{
			$this->vt->update('kasa', array('kasa_id'=>$kasa_id), $data);

			$this->session->set_flashdata('kasa_updt_ok','OK');
	        logekle(15,3);
	        redirect("kasa/kasa-acilis-karti-duzenle/$kasa_id");
		}
	}

	public function kasaListesi(){
		$data["baslik"] = "Kasa / Kasa Listesi";
		$anaHesap = anaHesapBilgisi();

        $kasaKodu = $this->input->get('kasaKodu');
        $kasaAdi = $this->input->get('kasaAdi');
        //$cariAdi = $this->input->get('cariAdi');

        $urim = $this->uri->segment(2);
        
        $segment = 2;
        $sayfa = $this->input->get("sayfa");

        $page = $sayfa ? $sayfa : 0;
        $limit = 20;

        if($sayfa){$pagem = ($page-1)*$limit;}
        else{$pagem = 0;}

        if((isset($kasaKodu) && !empty($kasaKodu)) || (isset($kasaAdi) && !empty($kasaAdi))){

            /*if(!empty($cariGrubu)){$sorgu1 = "AND cari_cariGrupKoduID = '$cariGrubu'";}
            else{$sorgu1 = "";}*/

            $countq = "SELECT COUNT(*) as total FROM kasa WHERE kasa_olusturanAnaHesap = '$anaHesap' AND kasa_kodu LIKE '%$kasaKodu%' AND kasa_adi LIKE '%$kasaAdi%'";
            $countexe = $this->db->query($countq)->row();
            $count = $countexe->total;

            $sorgu = "SELECT * FROM kasa WHERE kasa_olusturanAnaHesap = '$anaHesap' AND kasa_kodu LIKE '%$kasaKodu%' AND kasa_adi LIKE '%$kasaAdi%' ORDER BY kasa_id DESC LIMIT $pagem,$limit";
        }else{
            $countq = "SELECT COUNT(*) as total FROM kasa WHERE kasa_olusturanAnaHesap = '$anaHesap'";
            $countexe = $this->db->query($countq)->row();
            $count = $countexe->total;
            $sorgu = "SELECT * FROM kasa WHERE kasa_olusturanAnaHesap = '$anaHesap' ORDER BY kasa_id DESC LIMIT $pagem,$limit";
        }

        $data["count_of_list"] = $count;


        $this->load->library("pagination");

        $config = array();
        $config["base_url"] = base_url() . "/kasa/$urim";
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
        $data["kasa"] = $this->db->query($sorgu)->result();

        $this->load->view("kasa/kasa-listesi", $data);
	}

	public function autocompleteDataByCode(){
		$anaHesap = anaHesapBilgisi();

		$returnData = array();
        $conditions['searchTerm'] = $this->input->get('term');
        $getData = $this->vt->getRows5($conditions,$anaHesap);
        
        if(!empty($getData)){
            foreach($getData as $row){
                $data['id'] = $row['kasa_id'];
                $data['value'] = $row['kasa_kodu'];
                $data['kasa_adi'] = $row['kasa_adi'];
                array_push($returnData, $data);
            }
        }
        echo json_encode($returnData);die;
	}

	public function autocompleteDataByName(){
		$anaHesap = anaHesapBilgisi();

		$returnData = array();
        $conditions['searchTerm'] = $this->input->get('term');
        $getData = $this->vt->getRows6($conditions,$anaHesap);
        
        if(!empty($getData)){
            foreach($getData as $row){
                $data['id'] = $row['kasa_id'];
                $data['value'] = $row['kasa_adi'];
                $data['kasa_kodu'] = $row['kasa_kodu'];
                array_push($returnData, $data);
            }
        }
        echo json_encode($returnData);die;
	}

	public function kasaVirman(){
		$data["baslik"] = "Kasa / Kasa Virman";
		$this->load->view("kasa/kasa-virman",$data);
	}

	public function yeniKasaVirman(){
		$control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$belgeNo = postval("virman_belgeNo");

		/*$kasaKodu = postval("virman_kaynakKasaKodu");
		$kasaAdi = postval("virman_kaynakKasaAdi");

		$kasaKodu2 = postval("virman_hedefKasaKodu");
		$kasaAdi2 = postval("virman_hedefKasaAdi");*/

		$virman_tarih = postval("virman_tarih");
        $yeni_virman_tarih = date("Y-m-d", strtotime($virman_tarih));

        $kaynakKasaID = postval("kasa_id");
        $hedefKasaID = postval("kasa_id2");

		$tutar = postval("virman_tutar");

		$virmanID = md5(uniqid(rand(), true));

		if($kaynakKasaID == $hedefKasaID){
            $this->session->set_flashdata('kasa_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

		$belgeNoKontrolQ = "SELECT * FROM kasaHareketleri WHERE kh_belgeNumarasi = '$belgeNo' AND kh_olusturanAnaHesap = '$anaHesap'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

		/*$kasaKontrolQ = "SELECT * FROM kasa WHERE (kasa_kodu = '$kasaKodu' AND kasa_adi = '$kasaAdi') AND kasa_olusturanAnaHesap = '$anaHesap'";
        $kasaKontrol = $this->db->query($kasaKontrolQ)->row();

        if(!$kasaKontrol){
            $this->session->set_flashdata('kasa_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $kasaKontrolQ2 = "SELECT * FROM kasa WHERE (kasa_kodu = '$kasaKodu2' AND kasa_adi = '$kasaAdi2') AND kasa_olusturanAnaHesap = '$anaHesap'";
        $kasaKontrol2 = $this->db->query($kasaKontrolQ2)->row();

        if(!$kasaKontrol2){
            $this->session->set_flashdata('kasa_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }*/

		$toplamGirisQ = "SELECT SUM(kh_giris) AS toplamGiris FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kaynakKasaID'";
		$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

		$toplamCikisQ = "SELECT SUM(kh_cikis) AS toplamCikis FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kaynakKasaID'";
		$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

		$toplamGiris = $toplamGirisExe->toplamGiris;
		$toplamCikis = $toplamCikisExe->toplamCikis;
		$kalan = $toplamGiris - $toplamCikis;

		$cikart = $kalan - $tutar;

		if($cikart < 0){
			$this->session->set_flashdata('kasa_eksi','OK');
        	redirect($_SERVER['HTTP_REFERER']);
		}

		$data_kaynak["kh_kasaID"] = $kaynakKasaID;
		$data_kaynak["kh_belgeNumarasi"] = $belgeNo;
		$data_kaynak["kh_turu"] = 7;
		$data_kaynak["kh_tarih"] = $yeni_virman_tarih;
		$data_kaynak["kh_cikis"] = $tutar;
		$data_kaynak["kh_virmanID"] = $virmanID;
		$data_kaynak["kh_aciklama"] = postval("virman_aciklama");
		$data_kaynak["kh_olusturan"] = $u_id;
		$data_kaynak["kh_olusturanAnaHesap"] = $anaHesap;
		$data_kaynak["kh_olusturmaTarihi"] =  $tarihi;
		$data_kaynak["kh_olusturmaSaati"] = $saati;
		$this->vt->insert("kasaHareketleri", $data_kaynak);

		$data_hedef["kh_kasaID"] = $hedefKasaID;
		$data_hedef["kh_belgeNumarasi"] = $belgeNo;
		$data_hedef["kh_turu"] = 7;
		$data_hedef["kh_tarih"] = $yeni_virman_tarih;
		$data_hedef["kh_giris"] = $tutar;
		$data_hedef["kh_virmanID"] = $virmanID;
		$data_hedef["kh_aciklama"] = postval("virman_aciklama");
		$data_hedef["kh_olusturan"] = $u_id;
		$data_hedef["kh_olusturanAnaHesap"] = $anaHesap;
		$data_hedef["kh_olusturmaTarihi"] =  $tarihi;
		$data_hedef["kh_olusturmaSaati"] = $saati;
		$this->vt->insert("kasaHareketleri", $data_hedef);

		$this->session->set_flashdata('kasa_virman_ok','OK');
	    logekle(61,2);
	  	redirect("kasa/kasa-hareket-kayitlari");
	}

	public function kasaVirmanDuzenle($id){
		$data["baslik"] = "Kasa / Kasa Virman Düzenle";
		$virmanQ1 = "SELECT * FROM kasaHareketleri WHERE kh_giris IS NOT NULL AND kh_virmanID = '$id'";
        $virmanQ2 = "SELECT * FROM kasaHareketleri WHERE kh_cikis IS NOT NULL AND kh_virmanID = '$id'";

        $data["kaynak"] = $this->db->query($virmanQ2)->row();
        $data["hedef"] = $this->db->query($virmanQ1)->row();

        $this->load->view("kasa/kasa-virman-duzenle",$data);
	}

	public function mevcutKasaVirmanDuzenle(){		
		$virman_id = postval("virman_id");

		$control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$belgeNo = postval("virman_belgeNo");

		/*$kasaKodu = postval("virman_kaynakKasaKodu");
		$kasaAdi = postval("virman_kaynakKasaAdi");

		$kasaKodu2 = postval("virman_hedefKasaKodu");
		$kasaAdi2 = postval("virman_hedefKasaAdi");*/

		$virman_tarih = postval("virman_tarih");
        $yeni_virman_tarih = date("Y-m-d", strtotime($virman_tarih));

        $kaynakKasaID = postval("kasa_id");
        $hedefKasaID = postval("kasa_id2");

		$tutar = postval("virman_tutar");

		$virmanID = md5(uniqid(rand(), true));

		if($kaynakKasaID == $hedefKasaID){
            $this->session->set_flashdata('kasa_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

		$belgeNoKontrolQ = "SELECT * FROM kasaHareketleri WHERE kh_belgeNumarasi = '$belgeNo' AND kh_olusturanAnaHesap = '$anaHesap' AND kh_virmanID != '$virman_id'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

		/*$kasaKontrolQ = "SELECT * FROM kasa WHERE (kasa_kodu = '$kasaKodu' AND kasa_adi = '$kasaAdi') AND kasa_olusturanAnaHesap = '$anaHesap'";
        $kasaKontrol = $this->db->query($kasaKontrolQ)->row();

        if(!$kasaKontrol){
            $this->session->set_flashdata('kasa_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $kasaKontrolQ2 = "SELECT * FROM kasa WHERE (kasa_kodu = '$kasaKodu2' AND kasa_adi = '$kasaAdi2') AND kasa_olusturanAnaHesap = '$anaHesap'";
        $kasaKontrol2 = $this->db->query($kasaKontrolQ2)->row();

        if(!$kasaKontrol2){
            $this->session->set_flashdata('kasa_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }*/

		$toplamGirisQ = "SELECT SUM(kh_giris) AS toplamGiris FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kaynakKasaID' AND (kh_virmanID != '$virman_id' OR kh_virmanID IS NULL)";
		$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

		$toplamCikisQ = "SELECT SUM(kh_cikis) AS toplamCikis FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kaynakKasaID' AND (kh_virmanID != '$virman_id' OR kh_virmanID IS NULL)";
		$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

		$toplamGiris = $toplamGirisExe->toplamGiris;
		$toplamCikis = $toplamCikisExe->toplamCikis;
		$kalan = $toplamGiris - $toplamCikis;

		$cikart = $kalan - $tutar;

	/*	print_r($toplamGirisExe);
		print_r($toplamCikisExe);
		echo "virmanid".$virman_id." kaynakKasaID".$kaynakKasaID."<br>";
		echo "a.".$toplamGiris." b.".$toplamCikis." c.".$kalan." d.".$cikart;
die;*/

		if($cikart < 0){
			$this->session->set_flashdata('kasa_eksi','OK');
        	redirect($_SERVER['HTTP_REFERER']);
		}

		$data_kaynak["kh_kasaID"] = $kaynakKasaID;
		$data_kaynak["kh_belgeNumarasi"] = $belgeNo;
		$data_kaynak["kh_turu"] = 7;
		$data_kaynak["kh_tarih"] = $yeni_virman_tarih;
		$data_kaynak["kh_cikis"] = $tutar;
		$data_kaynak["kh_virmanID"] = $virmanID;
		$data_kaynak["kh_aciklama"] = postval("virman_aciklama");
		$data_kaynak["kh_olusturan"] = $u_id;
		$data_kaynak["kh_olusturanAnaHesap"] = $anaHesap;
		$data_kaynak["kh_olusturmaTarihi"] =  $tarihi;
		$data_kaynak["kh_olusturmaSaati"] = $saati;
		$this->vt->insert("kasaHareketleri", $data_kaynak);

		$data_hedef["kh_kasaID"] = $hedefKasaID;
		$data_hedef["kh_belgeNumarasi"] = $belgeNo;
		$data_hedef["kh_turu"] = 7;
		$data_hedef["kh_tarih"] = $yeni_virman_tarih;
		$data_hedef["kh_giris"] = $tutar;
		$data_hedef["kh_virmanID"] = $virmanID;
		$data_hedef["kh_aciklama"] = postval("virman_aciklama");
		$data_hedef["kh_olusturan"] = $u_id;
		$data_hedef["kh_olusturanAnaHesap"] = $anaHesap;
		$data_hedef["kh_olusturmaTarihi"] =  $tarihi;
		$data_hedef["kh_olusturmaSaati"] = $saati;
		$this->vt->insert("kasaHareketleri", $data_hedef);

		//eğer yeni ekleme başarılı bir şekilde yapılırsa güncelleme etkisi için eski kayıt siliniyor.
        $this->vt->del("kasaHareketleri","kh_virmanID",$virman_id);

		$this->session->set_flashdata('kasa_virman_ok','OK');
	    logekle(61,2);
	  	redirect("kasa/kasa-hareket-kayitlari");
	}

	public function kasaDevirKarti(){
		$data["baslik"] = "Kasa / Kasa Devir Kartı";
		$this->load->view("kasa/kasa-devir-karti",$data);
	}

	public function yeniKasaDevirKarti(){
		$control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$belgeNo = postval("devir_belgeNo");

		$kasaKodu = postval("devir_kasaKodu");
		$kasaAdi = postval("devir_kasaAdi");

		$devir_tarih = postval("devir_tarih");
        $yeni_devir_tarih = date("Y-m-d", strtotime($devir_tarih));

		$islemTipi = postval("devir_islemTipi");

		$kasaID = postval("kasa_id");
		$tutar = postval("devir_tutar");

		$data["kh_kasaID"] = $kasaID;
		$data["kh_belgeNumarasi"] = $belgeNo;
		$data["kh_turu"] = 5;
		$data["kh_tarih"] = $yeni_devir_tarih;

		if($islemTipi == 1){ $data["kh_giris"] = $tutar; }
		else if($islemTipi == 2){ $data["kh_cikis"] = $tutar; }

		$data["kh_aciklama"] = postval("devir_aciklama");

		$data["kh_olusturan"] = $u_id;
		$data["kh_olusturanAnaHesap"] = $anaHesap;
		$data["kh_olusturmaTarihi"] =  $tarihi;
		$data["kh_olusturmaSaati"] = $saati;

		if($islemTipi == 2){//çıkış ise
			//eksiye düşüyor mu kontrol et?
			$toplamGirisQ = "SELECT SUM(kh_giris) AS toplamGiris FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID'";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(kh_cikis) AS toplamCikis FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID'";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$toplamGiris = $toplamGirisExe->toplamGiris;
			$toplamCikis = $toplamCikisExe->toplamCikis;
			$kalan = $toplamGiris - $toplamCikis;

			$cikart = $kalan - $tutar;

			if($cikart < 0){
				$this->session->set_flashdata('kasa_eksi','OK');
            	redirect($_SERVER['HTTP_REFERER']);
			}
		}

		$belgeNoKontrolQ = "SELECT * FROM kasaHareketleri WHERE kh_belgeNumarasi = '$belgeNo' AND kh_olusturanAnaHesap = '$anaHesap'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

		$kasaKontrolQ = "SELECT * FROM kasa WHERE (kasa_kodu = '$kasaKodu' AND kasa_adi = '$kasaAdi') AND kasa_olusturanAnaHesap = '$anaHesap'";
        $kasaKontrol = $this->db->query($kasaKontrolQ)->row();

        if(!$kasaKontrol){
            $this->session->set_flashdata('kasa_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

		$this->vt->insert("kasaHareketleri", $data);
		$devir_id = $this->db->insert_id();
		$this->session->set_flashdata('kasa_devir_ok','OK');
	    logekle(18,2);
	  	redirect("kasa/kasa-devir-karti-duzenle/$devir_id");
	}

	public function kasaDevirKartiDuzenle($id){
		$data["baslik"] = "Kasa / Kasa Devir Kartı Düzenle";
		$anaHesap = anaHesapBilgisi();
		$devirKartiQ = "SELECT * FROM kasaHareketleri WHERE kh_id = '$id' AND kh_olusturanAnaHesap = '$anaHesap'";
		$data["devirKarti"] = $this->db->query($devirKartiQ)->row();

		$olusturanHesapKim = $data["devirKarti"]->kh_olusturanAnaHesap;

		if($anaHesap == $olusturanHesapKim){
			$this->load->view("kasa/kasa-devir-karti-duzenle",$data);
		}else{
			redirect('hata');
		}
	}

	public function kasaDevirKartiGuncelle(){
		$anaHesap = anaHesapBilgisi();

		$kh_id = postval("kh_id");

		$belgeNo = postval("devir_belgeNo");

		$kasaKodu = postval("devir_kasaKodu");
		$kasaAdi = postval("devir_kasaAdi");

		$devir_tarih = postval("devir_tarih");
        $yeni_devir_tarih = date("Y-m-d", strtotime($devir_tarih));

        $islemTipi = postval("devir_islemTipi");

        $kasaID = postval("kasa_id");

        $tutar = postval("devir_tutar");

		$data["kh_kasaID"] = $kasaID;
		$data["kh_belgeNumarasi"] = $belgeNo;
		$data["kh_turu"] = 5;
		$data["kh_tarih"] = $yeni_devir_tarih;

		if($islemTipi == 1){ $data["kh_giris"] = $tutar; }
		else if($islemTipi == 2){ $data["kh_cikis"] = $tutar; }

		$data["kh_aciklama"] = postval("devir_aciklama");


		if($islemTipi == 2){//çıkış ise
			//eksiye düşüyor mu kontrol et?
			$toplamGirisQ = "SELECT SUM(kh_giris) AS toplamGiris FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID'";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(kh_cikis) AS toplamCikis FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID'";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$toplamGiris = $toplamGirisExe->toplamGiris;
			$toplamCikis = $toplamCikisExe->toplamCikis;
			$kalan = $toplamGiris - $toplamCikis;

			$cikart = $kalan - $tutar;

			if($cikart < 0){
				$this->session->set_flashdata('kasa_eksi','OK');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}


		$belgeNoKontrolQ = "SELECT * FROM kasaHareketleri WHERE kh_belgeNumarasi = '$belgeNo' AND kh_olusturanAnaHesap = '$anaHesap' AND kh_id != '$kh_id' ";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

		$kasaKontrolQ = "SELECT * FROM kasa WHERE (kasa_kodu = '$kasaKodu' AND kasa_adi = '$kasaAdi') AND kasa_olusturanAnaHesap = '$anaHesap'";
        $kasaKontrol = $this->db->query($kasaKontrolQ)->row();

        if(!$kasaKontrol){
            $this->session->set_flashdata('kasa_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

		$this->vt->update('kasaHareketleri', array('kh_id'=>$kh_id), $data);
		$this->session->set_flashdata('kasa_devir_updt_ok','OK');
	    logekle(18,3);
	  	redirect("kasa/kasa-devir-karti-duzenle/$kh_id");
	}

	

	public function autocompleteDataByCodeCari(){
		$anaHesap = anaHesapBilgisi();

		$returnData = array();
        $conditions['searchTerm'] = $this->input->get('term');
        $getData = $this->vt->getRows2($conditions,$anaHesap);
        
        if(!empty($getData)){
            foreach($getData as $row){
                $data['id'] = $row['cari_id'];
                $data['value'] = $row['cari_kodu'];
                $data['cari_ad'] = $row['cari_ad'];
                array_push($returnData, $data);
            }
        }
        echo json_encode($returnData);die;
	}

	public function autocompleteDataByNameCari(){
		$anaHesap = anaHesapBilgisi();

		$returnData = array();
        $conditions['searchTerm'] = $this->input->get('term');
        $getData = $this->vt->getRows($conditions,$anaHesap);
        
        if(!empty($getData)){
            foreach($getData as $row){
                $data['id'] = $row['cari_id'];
                $data['value'] = $row['cari_ad'];
                $data['cari_kodu'] = $row['cari_kodu'];
                array_push($returnData, $data);
            }
        }
        echo json_encode($returnData);die;
	}

	public function kasaTahsilat(){
		$data["baslik"] = "Kasa / Kasa Tahsilat";
		$this->load->view("kasa/kasa-tahsilat",$data);
	}

	public function yeniKasaTahsilat(){
		$control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$tahsilat_tarih = postval("tahsilat_tarih");
        $yeni_tahsilat_tarih = date("Y-m-d", strtotime($tahsilat_tarih));

        /*$kasaKodu = postval("tahsilat_kasaKodu");
        $kasaAdi = postval("tahsilat_kasaAdi");*/

        $cariKodu = postval("tahsilat_cariKodu");
        $cariAdi = postval("tahsilat_cariAdi");

        $belgeNo = postval("tahsilat_belgeNo");

		$data["kh_cariID"] = postval("cari_id");
		$data["kh_kasaID"] = postval("kasa_id");
		$data["kh_belgeNumarasi"] = $belgeNo;
		$data["kh_turu"] = 1;
		$data["kh_giris"] = postval("tahsilat_tutar");
		$data["kh_tarih"] = $yeni_tahsilat_tarih;
		$data["kh_aciklama"] = postval("tahsilat_aciklama");

		$data["kh_olusturan"] = $u_id;
		$data["kh_olusturanAnaHesap"] = $anaHesap;
		$data["kh_olusturmaTarihi"] =  $tarihi;
		$data["kh_olusturmaSaati"] = $saati;

		$belgeNoKontrolQ = "SELECT * FROM kasaHareketleri WHERE kh_belgeNumarasi = '$belgeNo' AND kh_olusturanAnaHesap = '$anaHesap'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

		/*$kasaKontrolQ = "SELECT * FROM kasa WHERE (kasa_kodu = '$kasaKodu' AND kasa_adi = '$kasaAdi') AND kasa_olusturanAnaHesap = '$anaHesap'";
        $kasaKontrol = $this->db->query($kasaKontrolQ)->row();

        if(!$kasaKontrol){
            $this->session->set_flashdata('kasa_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }*/

        $cariKontrolQ = "SELECT * FROM cari WHERE (cari_kodu = '$cariKodu' AND cari_ad = '$cariAdi') AND cari_olusturanAnaHesap = '$anaHesap'";
        $cariKontrol = $this->db->query($cariKontrolQ)->row();

        if(!$cariKontrol){
            $this->session->set_flashdata('cari_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

		$this->vt->insert("kasaHareketleri", $data);
		$kh_id = $this->db->insert_id();

		//Cari Hareketleri Ekle :begin
		$data_ch["ch_belgeNumarasi"] = $belgeNo;
        $data_ch["ch_turu"] =  5;
        $data_ch["ch_cariID"] =  postval("cari_id");
        $data_ch["ch_kasaID"] =  postval("kasa_id");
        $data_ch["ch_khID"] = $kh_id;
        $data_ch["ch_alacak"] =  postval("tahsilat_tutar");
        $data_ch["ch_tarih"] =  $yeni_tahsilat_tarih;
        
        $data_ch["ch_olusturan"] =  $u_id;
        $data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
        $data_ch["ch_olusturmaTarihi"] =  $tarihi;
        $data_ch["ch_olusturmaSaati"] =  $saati;

        $this->vt->insert("cariHareketleri", $data_ch);
        $ch_id = $this->db->insert_id();
        $datachu["kh_cariHareketiID"] = $ch_id;

        $this->vt->update('kasaHareketleri', array('kh_id'=>$kh_id), $datachu);
        //Cari Hareketleri Ekle :end

		$this->session->set_flashdata('kasa_tahsilat_ok','OK');
	    logekle(19,2);
	  	redirect("kasa/kasa-tahsilat-duzenle/$kh_id");
	}

	public function kasaTahsilatDuzenle($id){
		$data["baslik"] = "Kasa / Kasa Tahsilat Düzenle";
		$anaHesap = anaHesapBilgisi();
		$tahsilatQ = "SELECT * FROM kasaHareketleri WHERE kh_id = '$id' AND kh_olusturanAnaHesap = '$anaHesap'";
		$data["tahsilat"] = $this->db->query($tahsilatQ)->row();

		$olusturanHesapKim = $data["tahsilat"]->kh_olusturanAnaHesap;

		if($anaHesap == $olusturanHesapKim){
			$this->load->view("kasa/kasa-tahsilat-duzenle",$data);
		}else{
			redirect('hata');
		}
	}

	public function kasaTahsilatGuncelle(){
		$kh_id_post = postval("kh_id");
		$ch_id_post = postval("ch_id");

		$control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$tahsilat_tarih = postval("tahsilat_tarih");
        $yeni_tahsilat_tarih = date("Y-m-d", strtotime($tahsilat_tarih));

        /*$kasaKodu = postval("tahsilat_kasaKodu");
        $kasaAdi = postval("tahsilat_kasaAdi");*/

        $cariKodu = postval("tahsilat_cariKodu");
        $cariAdi = postval("tahsilat_cariAdi");

        $belgeNo = postval("tahsilat_belgeNo");

		$data["kh_cariID"] = postval("cari_id");
		$data["kh_kasaID"] = postval("kasa_id");
		$data["kh_belgeNumarasi"] = $belgeNo;
		$data["kh_turu"] = 1;
		$data["kh_giris"] = postval("tahsilat_tutar");
		$data["kh_tarih"] = $yeni_tahsilat_tarih;
		$data["kh_aciklama"] = postval("tahsilat_aciklama");

		$data["kh_olusturan"] = $u_id;
		$data["kh_olusturanAnaHesap"] = $anaHesap;
		$data["kh_olusturmaTarihi"] =  $tarihi;
		$data["kh_olusturmaSaati"] = $saati;

		$belgeNoKontrolQ = "SELECT * FROM kasaHareketleri WHERE kh_belgeNumarasi = '$belgeNo' AND kh_olusturanAnaHesap = '$anaHesap' AND kh_id != '$kh_id_post'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

		/*$kasaKontrolQ = "SELECT * FROM kasa WHERE (kasa_kodu = '$kasaKodu' AND kasa_adi = '$kasaAdi') AND kasa_olusturanAnaHesap = '$anaHesap'";
        $kasaKontrol = $this->db->query($kasaKontrolQ)->row();

        if(!$kasaKontrol){
            $this->session->set_flashdata('kasa_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }*/

        $cariKontrolQ = "SELECT * FROM cari WHERE (cari_kodu = '$cariKodu' AND cari_ad = '$cariAdi') AND cari_olusturanAnaHesap = '$anaHesap'";
        $cariKontrol = $this->db->query($cariKontrolQ)->row();

        if(!$cariKontrol){
            $this->session->set_flashdata('cari_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

		$this->vt->insert("kasaHareketleri", $data);
		$kh_id = $this->db->insert_id();

		//Cari Hareketleri Ekle :begin
		$data_ch["ch_belgeNumarasi"] = $belgeNo;
        $data_ch["ch_turu"] =  5;
        $data_ch["ch_cariID"] =  postval("cari_id");
        $data_ch["ch_kasaID"] =  postval("kasa_id");
        $data_ch["ch_khID"] = $kh_id;
        $data_ch["ch_alacak"] =  postval("tahsilat_tutar");
        $data_ch["ch_tarih"] =  $yeni_tahsilat_tarih;
        
        $data_ch["ch_olusturan"] =  $u_id;
        $data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
        $data_ch["ch_olusturmaTarihi"] =  $tarihi;
        $data_ch["ch_olusturmaSaati"] =  $saati;

        $this->vt->insert("cariHareketleri", $data_ch);
        $ch_id = $this->db->insert_id();
        $datachu["kh_cariHareketiID"] = $ch_id;

        $this->vt->update('kasaHareketleri', array('kh_id'=>$kh_id), $datachu);
        //Cari Hareketleri Ekle :end

        //eğer yeni ekleme başarılı bir şekilde yapılırsa güncelleme etkisi için eski kayıt siliniyor.        
		$this->vt->del("kasaHareketleri","kh_id",$kh_id_post);
		$this->vt->del("cariHareketleri","ch_id",$ch_id_post);

		$this->session->set_flashdata('kasa_tahsilat_updt_ok','OK');
	    logekle(19,3);
	  	redirect("kasa/kasa-tahsilat-duzenle/$kh_id");


		/* 
		$anaHesap = anaHesapBilgisi();

		$kh_id = postval("kh_id");

		$tahsilat_tarih = postval("tahsilat_tarih");
        $yeni_tahsilat_tarih = date("Y-m-d", strtotime($tahsilat_tarih));

        $kasaKodu = postval("tahsilat_kasaKodu");
        $kasaAdi = postval("tahsilat_kasaAdi");

        $cariKodu = postval("tahsilat_cariKodu");
        $cariAdi = postval("tahsilat_cariAdi");

        $belgeNo = postval("tahsilat_belgeNo");

		$data["kh_cariID"] = postval("cari_id");
		$data["kh_kasaID"] = postval("kasa_id");
		$data["kh_belgeNumarasi"] = $belgeNo;
		$data["kh_turu"] = 1;
		$data["kh_giris"] = postval("tahsilat_tutar");
		$data["kh_tarih"] = $yeni_tahsilat_tarih;
		$data["kh_aciklama"] = postval("tahsilat_aciklama");

		$belgeNoKontrolQ = "SELECT * FROM kasaHareketleri WHERE kh_belgeNumarasi = '$belgeNo' AND kh_olusturanAnaHesap = '$anaHesap' AND kh_id != '$kh_id'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

		$kasaKontrolQ = "SELECT * FROM kasa WHERE (kasa_kodu = '$kasaKodu' AND kasa_adi = '$kasaAdi') AND kasa_olusturanAnaHesap = '$anaHesap'";
        $kasaKontrol = $this->db->query($kasaKontrolQ)->row();

        if(!$kasaKontrol){
            $this->session->set_flashdata('kasa_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $cariKontrolQ = "SELECT * FROM cari WHERE (cari_kodu = '$cariKodu' AND cari_ad = '$cariAdi') AND cari_olusturanAnaHesap = '$anaHesap'";
        $cariKontrol = $this->db->query($cariKontrolQ)->row();

        if(!$cariKontrol){
            $this->session->set_flashdata('cari_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

		$this->vt->update('kasaHareketleri', array('kh_id'=>$kh_id), $data);

		//Cari Hareketleri Düzenle :begin
		$ch_idsi = postval("ch_id");
		$data_ch["ch_belgeNumarasi"] = $belgeNo;
        $data_ch["ch_cariID"] =  postval("cari_id");
        $data_ch["ch_kasaID"] =  postval("kasa_id");
        $data_ch["ch_khID"] = $kh_id;
        $data_ch["ch_alacak"] =  postval("tahsilat_tutar");
        $data_ch["ch_tarih"] =  $yeni_tahsilat_tarih;
        
        $data_ch["ch_olusturan"] =  $u_id;
        $data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
        $data_ch["ch_olusturmaTarihi"] =  $tarihi;
        $data_ch["ch_olusturmaSaati"] =  $saati;

        $this->vt->update('cariHareketleri', array('ch_id'=>$ch_idsi), $data_ch);
        //Cari Hareketleri Düzenle :end


		$this->session->set_flashdata('kasa_tahsilat_updt_ok','OK');
	    logekle(19,3);
	  	redirect("kasa/kasa-tahsilat-duzenle/$kh_id");
		*/
	}

	public function kasaOdeme(){
		$data["baslik"] = "Kasa / Kasa Ödeme İşlemi";
		$this->load->view("kasa/kasa-odeme-islemi",$data);
	}

	public function yeniKasaOdeme(){
		$control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$odeme_tarih = postval("odeme_tarih");
        $yeni_odeme_tarih = date("Y-m-d", strtotime($odeme_tarih));

        /*$kasaKodu = postval("odeme_kasaKodu");
        $kasaAdi = postval("odeme_kasaAdi");*/

        $cariKodu = postval("odeme_cariKodu");
        $cariAdi = postval("odeme_cariAdi");

        $belgeNo = postval("odeme_belgeNo");

        $kasaID = postval("kasa_id");

        $tutar = postval("odeme_tutar");

		$data["kh_cariID"] = postval("cari_id");
		$data["kh_kasaID"] = $kasaID;
		$data["kh_belgeNumarasi"] = $belgeNo;
		$data["kh_turu"] = 2;
		$data["kh_cikis"] = $tutar;
		$data["kh_tarih"] = $yeni_odeme_tarih;
		$data["kh_aciklama"] = postval("odeme_aciklama");

		$data["kh_olusturan"] = $u_id;
		$data["kh_olusturanAnaHesap"] = $anaHesap;
		$data["kh_olusturmaTarihi"] =  $tarihi;
		$data["kh_olusturmaSaati"] = $saati;

		//eksiye düşüyor mu kontrol et?
		$toplamGirisQ = "SELECT SUM(kh_giris) AS toplamGiris FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID'";
		$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

		$toplamCikisQ = "SELECT SUM(kh_cikis) AS toplamCikis FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID'";
		$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

		$toplamGiris = $toplamGirisExe->toplamGiris;
		$toplamCikis = $toplamCikisExe->toplamCikis;
		$kalan = $toplamGiris - $toplamCikis;

		$cikart = $kalan - $tutar;

		if($cikart < 0){
			$this->session->set_flashdata('kasa_eksi','OK');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$belgeNoKontrolQ = "SELECT * FROM kasaHareketleri WHERE kh_belgeNumarasi = '$belgeNo' AND kh_olusturanAnaHesap = '$anaHesap'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

		/*$kasaKontrolQ = "SELECT * FROM kasa WHERE (kasa_kodu = '$kasaKodu' AND kasa_adi = '$kasaAdi') AND kasa_olusturanAnaHesap = '$anaHesap'";
        $kasaKontrol = $this->db->query($kasaKontrolQ)->row();

        if(!$kasaKontrol){
            $this->session->set_flashdata('kasa_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }*/

        $cariKontrolQ = "SELECT * FROM cari WHERE (cari_kodu = '$cariKodu' AND cari_ad = '$cariAdi') AND cari_olusturanAnaHesap = '$anaHesap'";
        $cariKontrol = $this->db->query($cariKontrolQ)->row();

        if(!$cariKontrol){
            $this->session->set_flashdata('cari_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

		$this->vt->insert("kasaHareketleri", $data);
		$kh_id = $this->db->insert_id();

		//Cari Hareketleri Ekle :begin
		$data_ch["ch_belgeNumarasi"] = $belgeNo;
        $data_ch["ch_turu"] =  6;
        $data_ch["ch_cariID"] =  postval("cari_id");
        $data_ch["ch_khID"] = $kh_id;
        $data_ch["ch_kasaID"] =  $kasaID;
        $data_ch["ch_borc"] =  $tutar;
        $data_ch["ch_tarih"] =  $yeni_odeme_tarih;
        
        $data_ch["ch_olusturan"] =  $u_id;
        $data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
        $data_ch["ch_olusturmaTarihi"] =  $tarihi;
        $data_ch["ch_olusturmaSaati"] =  $saati;

        $this->vt->insert("cariHareketleri", $data_ch);
        $ch_id = $this->db->insert_id();
        $datachu["kh_cariHareketiID"] = $ch_id;

        $this->vt->update('kasaHareketleri', array('kh_id'=>$kh_id), $datachu);
        //Cari Hareketleri Ekle :end

		$this->session->set_flashdata('kasa_odeme_ok','OK');
	    logekle(20,2);
	  	redirect("kasa/kasa-odeme-islemi-duzenle/$kh_id");
	}

	public function kasaOdemeDuzenle($id){
		$data["baslik"] = "Kasa / Kasa Ödeme İşlemi Düzenle";
		$anaHesap = anaHesapBilgisi();
		$odemeQ = "SELECT * FROM kasaHareketleri WHERE kh_id = '$id' AND kh_olusturanAnaHesap = '$anaHesap'";
		$data["odeme"] = $this->db->query($odemeQ)->row();

		$olusturanHesapKim = $data["odeme"]->kh_olusturanAnaHesap;

		if($anaHesap == $olusturanHesapKim){
			$this->load->view("kasa/kasa-odeme-islemi-duzenle",$data);
		}else{
			redirect('hata');
		}
	}

	public function kasaOdemeGuncelle(){
		$kh_id_post = postval("kh_id");
		$ch_id_post = postval("ch_id");

		$control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$odeme_tarih = postval("odeme_tarih");
        $yeni_odeme_tarih = date("Y-m-d", strtotime($odeme_tarih));

        /* $kasaKodu = postval("odeme_kasaKodu");
        $kasaAdi = postval("odeme_kasaAdi"); */

        $cariKodu = postval("odeme_cariKodu");
        $cariAdi = postval("odeme_cariAdi");

        $belgeNo = postval("odeme_belgeNo");

        $kasaID = postval("kasa_id");

        $tutar = postval("odeme_tutar");

		$data["kh_cariID"] = postval("cari_id");
		$data["kh_kasaID"] = $kasaID;
		$data["kh_belgeNumarasi"] = $belgeNo;
		$data["kh_turu"] = 2;
		$data["kh_cikis"] = $tutar;
		$data["kh_tarih"] = $yeni_odeme_tarih;
		$data["kh_aciklama"] = postval("odeme_aciklama");

		$data["kh_olusturan"] = $u_id;
		$data["kh_olusturanAnaHesap"] = $anaHesap;
		$data["kh_olusturmaTarihi"] =  $tarihi;
		$data["kh_olusturmaSaati"] = $saati;

		//eksiye düşüyor mu kontrol et?
		$toplamGirisQ = "SELECT SUM(kh_giris) AS toplamGiris FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID' AND kh_id != '$kh_id_post'";
		$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

		$toplamCikisQ = "SELECT SUM(kh_cikis) AS toplamCikis FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID' AND kh_id != '$kh_id_post'";
		$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

		$toplamGiris = $toplamGirisExe->toplamGiris;
		$toplamCikis = $toplamCikisExe->toplamCikis;
		$kalan = $toplamGiris - $toplamCikis;

		$cikart = $kalan - $tutar;

		if($cikart < 0){
			$this->session->set_flashdata('kasa_eksi','OK');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$belgeNoKontrolQ = "SELECT * FROM kasaHareketleri WHERE kh_belgeNumarasi = '$belgeNo' AND kh_olusturanAnaHesap = '$anaHesap' AND kh_id != '$kh_id_post' ";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

		/* $kasaKontrolQ = "SELECT * FROM kasa WHERE (kasa_kodu = '$kasaKodu' AND kasa_adi = '$kasaAdi') AND kasa_olusturanAnaHesap = '$anaHesap'";
        $kasaKontrol = $this->db->query($kasaKontrolQ)->row();

        if(!$kasaKontrol){
            $this->session->set_flashdata('kasa_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        } */

        $cariKontrolQ = "SELECT * FROM cari WHERE (cari_kodu = '$cariKodu' AND cari_ad = '$cariAdi') AND cari_olusturanAnaHesap = '$anaHesap'";
        $cariKontrol = $this->db->query($cariKontrolQ)->row();

        if(!$cariKontrol){
            $this->session->set_flashdata('cari_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

		$this->vt->insert("kasaHareketleri", $data);
		$kh_id = $this->db->insert_id();

		//Cari Hareketleri Ekle :begin
		$data_ch["ch_belgeNumarasi"] = $belgeNo;
        $data_ch["ch_turu"] =  6;
        $data_ch["ch_cariID"] =  postval("cari_id");
        $data_ch["ch_khID"] = $kh_id;
        $data_ch["ch_kasaID"] =  $kasaID;
        $data_ch["ch_borc"] =  $tutar;
        $data_ch["ch_tarih"] =  $yeni_odeme_tarih;
        
        $data_ch["ch_olusturan"] =  $u_id;
        $data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
        $data_ch["ch_olusturmaTarihi"] =  $tarihi;
        $data_ch["ch_olusturmaSaati"] =  $saati;

        $this->vt->insert("cariHareketleri", $data_ch);
        $ch_id = $this->db->insert_id();
        $datachu["kh_cariHareketiID"] = $ch_id;

        $this->vt->update('kasaHareketleri', array('kh_id'=>$kh_id), $datachu);
        //Cari Hareketleri Ekle :end

        //eğer yeni ekleme başarılı bir şekilde yapılırsa güncelleme etkisi için eski kayıt siliniyor.        
		$this->vt->del("kasaHareketleri","kh_id",$kh_id_post);
		$this->vt->del("cariHareketleri","ch_id",$ch_id_post);

		$this->session->set_flashdata('kasa_odeme_updt_ok','OK');
	    logekle(20,3);
	  	redirect("kasa/kasa-odeme-islemi-duzenle/$kh_id");

		/*
		$anaHesap = anaHesapBilgisi();

		$kh_id = postval("kh_id");

		$odeme_tarih = postval("odeme_tarih");
        $yeni_odeme_tarih = date("Y-m-d", strtotime($odeme_tarih));

        $kasaKodu = postval("odeme_kasaKodu");
        $kasaAdi = postval("odeme_kasaAdi");

        $cariKodu = postval("odeme_cariKodu");
        $cariAdi = postval("odeme_cariAdi");

        $belgeNo = postval("odeme_belgeNo");

        $kasaID = postval("kasa_id");
        $tutar = postval("odeme_tutar");

		$data["kh_cariID"] = postval("cari_id");
		$data["kh_kasaID"] = $kasaID;
		$data["kh_belgeNumarasi"] = $belgeNo;
		$data["kh_turu"] = 2;
		$data["kh_cikis"] = $tutar;
		$data["kh_tarih"] = $yeni_odeme_tarih;
		$data["kh_aciklama"] = postval("odeme_aciklama");

		//eksiye düşüyor mu kontrol et?
		$toplamGirisQ = "SELECT SUM(kh_giris) AS toplamGiris FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID'";
		$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

		$toplamCikisQ = "SELECT SUM(kh_cikis) AS toplamCikis FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID'";
		$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

		$toplamGiris = $toplamGirisExe->toplamGiris;
		$toplamCikis = $toplamCikisExe->toplamCikis;
		$kalan = $toplamGiris - $toplamCikis;

		$cikart = $kalan - $tutar;

		if($cikart < 0){
			$this->session->set_flashdata('kasa_eksi','OK');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$belgeNoKontrolQ = "SELECT * FROM kasaHareketleri WHERE kh_belgeNumarasi = '$belgeNo' AND kh_olusturanAnaHesap = '$anaHesap' AND kh_id != '$kh_id'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

		$kasaKontrolQ = "SELECT * FROM kasa WHERE (kasa_kodu = '$kasaKodu' AND kasa_adi = '$kasaAdi') AND kasa_olusturanAnaHesap = '$anaHesap'";
        $kasaKontrol = $this->db->query($kasaKontrolQ)->row();

        if(!$kasaKontrol){
            $this->session->set_flashdata('kasa_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $cariKontrolQ = "SELECT * FROM cari WHERE (cari_kodu = '$cariKodu' AND cari_ad = '$cariAdi') AND cari_olusturanAnaHesap = '$anaHesap'";
        $cariKontrol = $this->db->query($cariKontrolQ)->row();

        if(!$cariKontrol){
            $this->session->set_flashdata('cari_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

		$this->vt->update('kasaHareketleri', array('kh_id'=>$kh_id), $data);

		//Cari Hareketleri Düzenle :begin
		$ch_idsi = postval("ch_id");
		$data_ch["ch_belgeNumarasi"] = $belgeNo;
        $data_ch["ch_cariID"] =  postval("cari_id");
        $data_ch["ch_kasaID"] =  $kasaID;
        $data_ch["ch_khID"] = $kh_id;
        $data_ch["ch_borc"] =  $tutar;
        $data_ch["ch_tarih"] =  $yeni_odeme_tarih;
        
        $data_ch["ch_olusturan"] =  $u_id;
        $data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
        $data_ch["ch_olusturmaTarihi"] =  $tarihi;
        $data_ch["ch_olusturmaSaati"] =  $saati;

        $this->vt->update('cariHareketleri', array('ch_id'=>$ch_idsi), $data_ch);
        //Cari Hareketleri Düzenle :end

		$this->session->set_flashdata('kasa_odeme_updt_ok','OK');
	    logekle(20,3);
	  	redirect("kasa/kasa-odeme-islemi-duzenle/$kh_id");*/		
	}

	public function kasaHareketKayitlari(){
		$data["baslik"] = "Kasa / Kasa Hareket Kayıtları";
		$anaHesap = anaHesapBilgisi();

		$kasaBilgisi = $this->input->get('kasa');

        $hareketTuru = $this->input->get('hareketTuru');

        $belgeNo = $this->input->get('belgeNo');

        $tarihGet = $this->input->get('tarihAraligi');

		$tarihAraligi = explode(' - ', $tarihGet);

		$tarih1 = date('Y-m-d', strtotime($tarihAraligi[0])); //küçük tarih
		$tarih2 = date('Y-m-d', strtotime($tarihAraligi[1])); //büyük tarih

		$siralama = $this->input->get('siralama');

        $urim = $this->uri->segment(2);
        
        $segment = 2;
        $sayfa = $this->input->get("sayfa");

        $page = $sayfa ? $sayfa : 0;
        $limit = 20;

        if($sayfa){$pagem = ($page-1)*$limit;}
        else{$pagem = 0;}

        if((isset($hareketTuru) && !empty($hareketTuru)) || (isset($belgeNo) && !empty($belgeNo)) || (isset($tarihGet) && !empty($tarihGet)) || (isset($siralama) && !empty($siralama)) ){

            if(!empty($hareketTuru)){$sorgu1 = "AND kh_turu = '$hareketTuru'";}
            else{$sorgu1 = "";}

            if(!empty($kasaBilgisi) && $kasaBilgisi != "tumu"){
        		$kasaQuery = "AND kh_kasaID = '$kasaBilgisi'";
        	}

        	if(!empty($tarihGet)){$sorgu2 = "AND kh_tarih BETWEEN '$tarih1' AND '$tarih2'";}
			else{$sorgu2 = "";}

			if(!empty($belgeNo)){$sorgu3 = "AND kh_belgeNumarasi LIKE '%$belgeNo%'";}
            else{$sorgu3 = "";}

            if(!empty($siralama)){
                if($siralama == 1){//Tarih büyükten küçüğe
                    $sira = "ORDER BY DATE(kh_tarih) DESC";
                }else if($siralama == 2){//Tarih küçükten büyüğe
                    $sira = "ORDER BY DATE(kh_tarih) ASC";
                }else{
                    $sira="ORDER BY kh_id DESC";
                }
            }
            else{$sira="ORDER BY kh_id DESC";}

            $countq = "SELECT COUNT(*) as total FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu3." ".$sorgu1." ".$sorgu2." ";
            $countexe = $this->db->query($countq)->row();
            $count = $countexe->total;

            $sorgu = "SELECT * FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu3." ".$sorgu1." ".$sorgu2." ".$sira." LIMIT $pagem,$limit";


            $toplamGirisQ = "SELECT SUM(kh_giris) AS toplamGiris FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu3." ".$sorgu1." ".$sorgu2." AND kh_turu != 7 ";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(kh_cikis) AS toplamCikis FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu3." ".$sorgu1." ".$sorgu2." AND kh_turu != 7 ";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$data["toplamGiris"] = $toplamGirisExe->toplamGiris;
			$data["toplamCikis"] = $toplamCikisExe->toplamCikis;
			$data["kalan"] = $data["toplamGiris"] - $data["toplamCikis"];
        }else{

        	if(!empty($kasaBilgisi) && $kasaBilgisi != "tumu"){
        		$kasaQuery = "AND kh_kasaID = '$kasaBilgisi'";
        	} 

            $countq = "SELECT COUNT(*) as total FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery."";
            $countexe = $this->db->query($countq)->row();
            $count = $countexe->total;
            $sorgu = "SELECT * FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ORDER BY kh_id DESC LIMIT $pagem,$limit";


			$toplamGirisQ = "SELECT SUM(kh_giris) AS toplamGiris FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." AND kh_turu != 7";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(kh_cikis) AS toplamCikis FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." AND kh_turu != 7";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$data["toplamGiris"] = $toplamGirisExe->toplamGiris;
			$data["toplamCikis"] = $toplamCikisExe->toplamCikis;
			$data["kalan"] = $data["toplamGiris"] - $data["toplamCikis"];
        }

        $data["count_of_list"] = $count;

        $this->load->library("pagination");

        $config = array();
        $config["base_url"] = base_url() . "/kasa/$urim";
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
        $data["kasaHareketleri"] = $this->db->query($sorgu)->result();

        $this->load->view("kasa/kasa-hareket-kayitlari", $data);
	}

	public function kasaHareketKayitlariExcel(){
		$anaHesap = anaHesapBilgisi();

		$kasaBilgisi = $this->input->get('kasa');

		$hareketTuru = $this->input->get('hareketTuru');
		$belgeNo = $this->input->get('belgeNo');

		$tarihGet = $this->input->get('tarihAraligi');

		$tarihAraligi = explode(' - ', $tarihGet);

		$tarih1 = date('Y-m-d', strtotime($tarihAraligi[0])); //küçük tarih
		$tarih2 = date('Y-m-d', strtotime($tarihAraligi[1])); //büyük tarih

		if((isset($hareketTuru) && !empty($hareketTuru)) || (isset($belgeNo) && !empty($belgeNo)) || (isset($tarihGet) && !empty($tarihGet)) || (isset($kasaBilgisi) && !empty($kasaBilgisi)) ){

            if(!empty($hareketTuru)){$sorgu1 = "AND kh_turu = '$hareketTuru'";}
            else{$sorgu1 = "";}

            if(!empty($kasaBilgisi) && $kasaBilgisi != "tumu"){
        		$kasaQuery = "AND kh_kasaID = '$kasaBilgisi'";
        	}

        	if(!empty($tarihGet)){$sorgu2 = "AND kh_tarih BETWEEN '$tarih1' AND '$tarih2'";}
			else{$sorgu2 = "";}

			if(!empty($belgeNo)){$sorgu3 = "AND kh_belgeNumarasi LIKE '%$belgeNo%'";}
            else{$sorgu3 = "";}
			
            $sorgu = "SELECT * FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu3." ".$sorgu1." ".$sorgu2." ORDER BY kh_id DESC";
        }else{
        	$sorgu = "SELECT * FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' ORDER BY kh_id DESC";
        }

        $kasaHareketleri = $this->db->query($sorgu)->result();

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = new Spreadsheet();
        
        $sheet = $spreadsheet->getActiveSheet();

        date_default_timezone_set('Europe/Istanbul');
        $tarih = (new DateTime('now'))->format('d.m.Y-His');

        $sheet->getStyle('A1:H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');
        
        $sheet->setCellValue('A1', 'Tarih');
        $sheet->setCellValue('B1', 'Kasa');
        $sheet->setCellValue('C1', 'Belge Numarası');
        $sheet->setCellValue('D1', 'Türü');
        $sheet->setCellValue('E1', 'Giriş');
        $sheet->setCellValue('F1', 'Çıkış');
        $sheet->setCellValue('G1', 'Cari');
        $sheet->setCellValue('H1', 'Açıklama');

        $rows = 2;
        foreach($kasaHareketleri as $kh){
        	$tarihYeni = date('d.m.Y', strtotime($kh->kh_tarih));

			$kasaid = $kh->kh_kasaID;

			$kasasiQ = "SELECT * FROM kasa WHERE kasa_id = '$kasaid' AND kasa_olusturanAnaHesap = '$anaHesap'";
			$kasasiExe = $this->db->query($kasasiQ)->row();

			$cari_id = $kh->kh_cariID;
			$cariQ = "SELECT * FROM cari WHERE cari_id = '$cari_id' AND cari_olusturanAnaHesap = '$anaHesap'";
			$cariExe = $this->db->query($cariQ)->row();

			$turu = $kh->kh_turu;
			if($turu == 1){
				$turuTxt = 'Kasa Tahsilat';
			}else if($turu == 2){
				$turuTxt = 'Kasa Ödeme';
			}else if($turu == 3){
				$turuTxt = 'Satış Faturası';
			}else if($turu == 4){
				$turuTxt = 'Alış Faturası';
			}else if($turu == 5){
				$turuTxt = 'Kasa Devir';
			}else if($turu == 6){
				$turuTxt = 'Giderler';
			}

			if($kh->kh_giris){
				$giris = number_format($kh->kh_giris,2);
				$cikis = '';
			}

			if($kh->kh_cikis){
				$giris = '';
				$cikis = number_format($kh->kh_cikis,2);
			}

            $sheet->setCellValue('A'.$rows, $tarihYeni);
            $sheet->setCellValue('B'.$rows, $kasasiExe->kasa_adi);
            $sheet->setCellValue('C'.$rows, $kh->kh_belgeNumarasi);
            $sheet->setCellValue('D'.$rows, $turuTxt);
            $sheet->setCellValue('E'.$rows, $giris);
            $sheet->setCellValue('F'.$rows, $cikis);
            $sheet->setCellValue('G'.$rows, $cariExe->cari_ad);
            $sheet->setCellValue('H'.$rows, $kh->kh_aciklama);
            $rows++;
        }

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);//instantiate Xlsx
            
        $filename = 'kasa-hareket-kayitlari'.$tarih;//set filename for excel file to be exported

        header('Content-Type: application/vnd.ms-excel');// generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');//download file
	}

	public function sil($type, $id){

  	$anaHesap = anaHesapBilgisi();

  		if($type == "tahsilat"){
  			$del1 = "DELETE FROM kasaHareketleri WHERE kh_id = '$id' AND kh_olusturanAnaHesap = '$anaHesap' ";
  			$del2 = "DELETE FROM cariHareketleri WHERE ch_khID = '$id' AND ch_olusturanAnaHesap = '$anaHesap'";
  			$this->db->query($del1);
  			$this->db->query($del2);
			$this->session->set_flashdata('tahsilat_sil','OK');
			logekle(19,4);
			redirect($_SERVER['HTTP_REFERER']);
		}else if($type == "odeme"){
			$del1 = "DELETE FROM kasaHareketleri WHERE kh_id = '$id' AND kh_olusturanAnaHesap = '$anaHesap'";
			$del2 = "DELETE FROM cariHareketleri WHERE ch_khID = '$id' AND ch_olusturanAnaHesap = '$anaHesap'";
			$this->db->query($del1);
			$this->db->query($del2);
			$this->session->set_flashdata('odeme_sil','OK');
			logekle(20,4);
			redirect($_SERVER['HTTP_REFERER']);
		}else if($type == "gider"){
			$del1 = "DELETE FROM kasaHareketleri WHERE kh_giderID = '$id' AND kh_olusturanAnaHesap = '$anaHesap' ";
			$del2 = "DELETE FROM giderler WHERE gider_id = '$id' AND gider_olusturanAnaHesap = '$anaHesap'";
			$this->db->query($del1);
			$this->db->query($del2);
			$this->session->set_flashdata('gider_sil','OK');
			logekle(56,4);
			redirect($_SERVER['HTTP_REFERER']);
		}else if($type == "virman"){
			$del1 = "DELETE FROM kasaHareketleri WHERE kh_virmanID = '$id' AND kh_olusturanAnaHesap = '$anaHesap' ";
			$this->db->query($del1);
			$this->session->set_flashdata('virman_sil','OK');
			logekle(61,4);
			redirect($_SERVER['HTTP_REFERER']);
		}else if($type == "transfer"){//kasa/sil/transfer/$kh->kh_transferRefID
			$del1 = "DELETE FROM kasaHareketleri WHERE kh_transferRefID = '$id' AND kh_olusturanAnaHesap = '$anaHesap'";
			$del2 = "DELETE FROM bankaHareketleri WHERE bh_transferRefID = '$id' AND bh_olusturanAnaHesap = '$anaHesap'";
			$this->db->query($del1);
			$this->db->query($del2);
			$this->session->set_flashdata('transfer_sil','OK');
			logekle(62,4);
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$this->session->set_flashdata('hata_sil','OK');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function kasadanBankayaTransfer(){
		$data["baslik"] = "Kasa / Kasadan Bankaya Transfer";
		$this->load->view("kasa/kasadan-bankaya-transfer",$data);
	}

	public function yeniKasadanBankayaTransfer(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$transferRefID = generateUniqID2();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

  		$belgeNo = postval("kasaToBankaTransfer_belgeNo");
  		$kasa_id = postval("kasa_id");
  		$banka_id = postval("banka_id");
  		$tarih = postval("kasaToBankaTransfer_tarih");
  		$tutar = postval("kasaToBankaTransfer_tutar");
  		$aciklama = postval("kasaToBankaTransfer_aciklama");

		$yeni_tarih = date("Y-m-d", strtotime($tarih));

		$data["kh_kasaID"] = $kasa_id;
		$data["kh_belgeNumarasi"] = $belgeNo;
		$data["kh_turu"] = 12;
		$data["kh_cikis"] = $tutar;
		$data["kh_tarih"] = $yeni_tarih;
		$data["kh_aciklama"] = $aciklama;
		$data["kh_transferRefID"] = $transferRefID;

		$data["kh_olusturan"] = $u_id;
		$data["kh_olusturanAnaHesap"] = $anaHesap;
		$data["kh_olusturmaTarihi"] =  $tarihi;
		$data["kh_olusturmaSaati"] = $saati;

		$data_b["bh_bankaID"] = $banka_id;
		$data_b["bh_belgeNumarasi"] = $belgeNo;
		$data_b["bh_turu"] = 13;
		$data_b["bh_giris"] = $tutar;
		$data_b["bh_tarih"] = $yeni_tarih;
		$data_b["bh_aciklama"] = $aciklama;
		$data_b["bh_transferRefID"] = $transferRefID;

		$data_b["bh_olusturan"] = $u_id;
		$data_b["bh_olusturanAnaHesap"] = $anaHesap;
		$data_b["bh_olusturmaTarihi"] =  $tarihi;
		$data_b["bh_olusturmaSaati"] = $saati;

		$belgeNoKontrolQ = "SELECT * FROM kasaHareketleri WHERE kh_belgeNumarasi = '$belgeNo' AND kh_olusturanAnaHesap = '$anaHesap'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		$belgeNoKontrolQ2 = "SELECT * FROM bankaHareketleri WHERE bh_belgeNumarasi = '$belgeNo' AND bh_olusturanAnaHesap = '$anaHesap'";
		$belgeNoKontrol2 = $this->db->query($belgeNoKontrolQ2)->row();

		if($belgeNoKontrol || $belgeNoKontrol2){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->vt->insert("kasaHareketleri", $data);
		$this->vt->insert("bankaHareketleri",$data_b);

		$this->session->set_flashdata('kasadan_bankaya_transfer_ok','OK');
		logekle(62,2);
		redirect("kasa/kasadan-bankaya-transfer-duzenle/$transferRefID");
	}

	public function kasadanBankayaTransferDuzenle($id){
		$data["baslik"] = "Kasa / Kasadan Bankaya Transfer - Düzenle";

		$transferSorgu = "SELECT * FROM kasaHareketleri WHERE kh_transferRefID = '$id'";
		$data["kasaTransfer"] = $this->db->query($transferSorgu)->row();

		$transferSorgu2 = "SELECT * FROM bankaHareketleri WHERE bh_transferRefID = '$id'";
		$data["bankaTransfer"] = $this->db->query($transferSorgu2)->row();

		$this->load->view("kasa/kasadan-bankaya-transfer-duzenle",$data);
	}

	public function kasadanBankayaTransfer_Duzenle(){
		$anaHesap = anaHesapBilgisi();

  		$transferRefID = postval("kh_transferRefID");

		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$new_transferRefID = generateUniqID2();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$belgeNo = postval("kasaToBankaTransfer_belgeNo");
		$kasa_id = postval("kasa_id");
		$banka_id = postval("banka_id");
		$tarih = postval("kasaToBankaTransfer_tarih");
		$tutar = postval("kasaToBankaTransfer_tutar");
		$aciklama = postval("kasaToBankaTransfer_aciklama");

		$yeni_tarih = date("Y-m-d", strtotime($tarih));

		$data["kh_kasaID"] = $kasa_id;
		$data["kh_belgeNumarasi"] = $belgeNo;
		$data["kh_turu"] = 12;
		$data["kh_cikis"] = $tutar;
		$data["kh_tarih"] = $yeni_tarih;
		$data["kh_aciklama"] = $aciklama;
		$data["kh_transferRefID"] = $new_transferRefID;

		$data["kh_olusturan"] = $u_id;
		$data["kh_olusturanAnaHesap"] = $anaHesap;
		$data["kh_olusturmaTarihi"] =  $tarihi;
		$data["kh_olusturmaSaati"] = $saati;

		$data_b["bh_bankaID"] = $banka_id;
		$data_b["bh_belgeNumarasi"] = $belgeNo;
		$data_b["bh_turu"] = 12;
		$data_b["bh_giris"] = $tutar;
		$data_b["bh_tarih"] = $yeni_tarih;
		$data_b["bh_aciklama"] = $aciklama;
		$data_b["bh_transferRefID"] = $new_transferRefID;

		$data_b["bh_olusturan"] = $u_id;
		$data_b["bh_olusturanAnaHesap"] = $anaHesap;
		$data_b["bh_olusturmaTarihi"] =  $tarihi;
		$data_b["bh_olusturmaSaati"] = $saati;

		$belgeNoKontrolQ = "SELECT * FROM kasaHareketleri WHERE kh_belgeNumarasi = '$belgeNo' AND kh_olusturanAnaHesap = '$anaHesap' AND kh_transferRefID != '$transferRefID' ";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		$belgeNoKontrolQ2 = "SELECT * FROM bankaHareketleri WHERE bh_belgeNumarasi = '$belgeNo' AND bh_olusturanAnaHesap = '$anaHesap' AND bh_transferRefID != '$transferRefID' ";
		$belgeNoKontrol2 = $this->db->query($belgeNoKontrolQ2)->row();

		if($belgeNoKontrol || $belgeNoKontrol2){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->vt->insert("kasaHareketleri", $data);
		$this->vt->insert("bankaHareketleri",$data_b);

		$this->vt->del("kasaHareketleri","kh_transferRefID",$transferRefID);
		$this->vt->del("bankaHareketleri","bh_transferRefID",$transferRefID);

		$this->session->set_flashdata('kasadan_bankaya_transfer_update','OK');
		logekle(62,3);
		redirect("kasa/kasadan-bankaya-transfer-duzenle/$new_transferRefID");
	}
}
