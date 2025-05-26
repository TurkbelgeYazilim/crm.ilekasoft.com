<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Banka extends CI_Controller {

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

	public function bankaAcilisKarti(){
        $data["baslik"] = "Banka / Banka Açılış Kartı";
		$this->load->view('banka/banka-acilis-karti',$data);
	}

	public function yeniBankaAcilisKarti(){
		$control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$hesapNo = postval("banka_hesapNo");
		$iban = postval("banka_iban");
		$banka_baslangic=postval("banka_baslangic");
		$data["banka_hesapNo"] = $hesapNo;
		$data["banka_iban"] = $iban;
		$data["banka_baslangic"] = $banka_baslangic;
		$data["banka_hesapAd"] = postval("banka_hesapAd");
		$data["banka_bankaAd"] = postval("banka_bankaAd");
		$data["banka_sube"] = postval("banka_sube");
		$data["banka_subeTelefon"] = postval("banka_subeTelefon");
		$data["banka_temsilci"] = postval("banka_temsilci");
		$data["banka_temsilciEposta"] = postval("banka_temsilciEposta");
		$data["banka_adres"] = postval("banka_adres");
		$data["banka_olusturan"] = $u_id;
		$data["banka_olusturanAnaHesap"] = $anaHesap;
		$data["banka_olusturmaTarihi"] = $tarihi;
		$data["banka_olusturmaSaati"] = $saati;

		$bankaVarmiQ = "SELECT * FROM banka WHERE (banka_hesapNo = '$hesapNo' OR banka_iban = '$iban') AND banka_olusturanAnaHesap = '$anaHesap'";
		$bankaVarmi = $this->db->query($bankaVarmiQ)->row();

		if($bankaVarmi){
			$this->session->set_flashdata('banka_var','OK');
			redirect("banka/banka-acilis-karti");
		}else{
			$this->vt->insert("banka", $data);
			$banka_id = $this->db->insert_id();

			$data_b["bh_bankaID"] = $banka_id;
			$data_b["bh_turu"] = 14;
			$data_b["bh_giris"] = $banka_baslangic;
			$data_b["bh_tarih"] = $tarihi;
			$data_b["bh_aciklama"] = "Banka Açılış Bakiyesi";

			$data_b["bh_olusturan"] = $u_id;
			$data_b["bh_olusturanAnaHesap"] = $anaHesap;
			$data_b["bh_olusturmaTarihi"] =  $tarihi;
			$data_b["bh_olusturmaSaati"] = $saati;
			$this->vt->insert("bankaHareketleri", $data_b);


			$this->session->set_flashdata('banka_ok','OK');
	        logekle(21,2);
	        redirect("banka/banka-acilis-karti-duzenle/$banka_id");
		}
	}

	public function bankaAcilisKartiDuzenle($id){
        $data["baslik"] = "Banka / Banka Açılış Kartı Düzenle";
		$anaHesap = anaHesapBilgisi();
		$bankaQ = "SELECT * FROM banka WHERE banka_id = '$id' AND banka_olusturanAnaHesap = '$anaHesap'";
		$data["banka"] = $this->db->query($bankaQ)->row();

        $olusturanHesapKim = $data["banka"]->banka_olusturanAnaHesap;

        if($anaHesap == $olusturanHesapKim){
		  $this->load->view("banka/banka-acilis-duzenle",$data);
        }else{
            redirect('hata');
        }
	}

	public function mevcutBankaAcilisKartiGuncelle(){
		$anaHesap = anaHesapBilgisi();

		$banka_id = postval("bankaID");

		$hesapNo = postval("banka_hesapNo");
		$iban = postval("banka_iban");

		$data["banka_hesapNo"] = $hesapNo;
		$data["banka_iban"] = $iban;
		$data["banka_hesapAd"] = postval("banka_hesapAd");
		$data["banka_bankaAd"] = postval("banka_bankaAd");
		$data["banka_sube"] = postval("banka_sube");
		$data["banka_subeTelefon"] = postval("banka_subeTelefon");
		$data["banka_temsilci"] = postval("banka_temsilci");
		$data["banka_temsilciEposta"] = postval("banka_temsilciEposta");
		$data["banka_adres"] = postval("banka_adres");

		$bankaVarmiQ = "SELECT * FROM banka WHERE (banka_hesapNo = '$hesapNo' OR banka_iban = '$iban') AND banka_olusturanAnaHesap = '$anaHesap' AND banka_id != $banka_id";
		$bankaVarmi = $this->db->query($bankaVarmiQ)->row();

		if($bankaVarmi){
			$this->session->set_flashdata('banka_updt_var','OK');
			redirect("banka/banka-acilis-karti-duzenle/$banka_id");
		}else{
			$this->vt->update('banka', array('banka_id'=>$banka_id), $data);

			$this->session->set_flashdata('banka_updt_ok','OK');
	        logekle(15,3);
	        redirect("banka/banka-acilis-karti-duzenle/$banka_id");
		}
	}

	public function bankaListesi(){
        $data["baslik"] = "Banka / Banka Listesi";
		$anaHesap = anaHesapBilgisi();

        $bankaAdi = $this->input->get('bankaAdi');
        //$cariAdi = $this->input->get('cariAdi');

        $urim = $this->uri->segment(2);
        
        $segment = 2;
        $sayfa = $this->input->get("sayfa");

        $page = $sayfa ? $sayfa : 0;
        $limit = 20;

        if($sayfa){$pagem = ($page-1)*$limit;}
        else{$pagem = 0;}

        if((isset($bankaAdi) && !empty($bankaAdi))){

            /*if(!empty($cariGrubu)){$sorgu1 = "AND cari_cariGrupKoduID = '$cariGrubu'";}
            else{$sorgu1 = "";}*/

            $countq = "SELECT COUNT(*) as total FROM banka WHERE banka_olusturanAnaHesap = '$anaHesap' AND banka_bankaAd LIKE '%$bankaAdi%'";
            $countexe = $this->db->query($countq)->row();
            $count = $countexe->total;

            $sorgu = "SELECT * FROM banka WHERE banka_olusturanAnaHesap = '$anaHesap' AND banka_bankaAd LIKE '%$bankaAdi%' ORDER BY kasa_id DESC LIMIT $pagem,$limit";
        }else{
            $countq = "SELECT COUNT(*) as total FROM banka WHERE banka_olusturanAnaHesap = '$anaHesap'";
            $countexe = $this->db->query($countq)->row();
            $count = $countexe->total;
            $sorgu = "SELECT * FROM banka WHERE banka_olusturanAnaHesap = '$anaHesap' ORDER BY banka_id DESC LIMIT $pagem,$limit";
        }
        $data["count_of_list"] = $count;

        $this->load->library("pagination");

        $config = array();
        $config["base_url"] = base_url() . "/banka/$urim";
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
        $data["banka"] = $this->db->query($sorgu)->result();

        $this->load->view("banka/banka-listesi", $data);
	}

	public function bankaHareketKayitlari(){
        $data["baslik"] = "Banka / Banka Hareket Kayıtları";
		$anaHesap = anaHesapBilgisi();

		$bankaBilgisi = $this->input->get('banka');

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

            if(!empty($hareketTuru)){$sorgu1 = "AND bh_turu = '$hareketTuru'";}
            else{$sorgu1 = "";}

            if(!empty($bankaBilgisi) && $bankaBilgisi != "tumu"){
        		$kasaQuery = "AND bh_bankaID = '$bankaBilgisi'";
        	}

        	if(!empty($tarihGet)){$sorgu2 = "AND bh_tarih BETWEEN '$tarih1' AND '$tarih2'";}
			else{$sorgu2 = "";}

			if(!empty($belgeNo)){$sorgu3 = "AND bh_belgeNumarasi LIKE '%$belgeNo%'";}
            else{$sorgu3 = "";}

            if(!empty($siralama)){
                if($siralama == 1){//Tarih büyükten küçüğe
                    $sira = "ORDER BY DATE(bh_tarih) DESC";
                }else if($siralama == 2){//Tarih küçükten büyüğe
                    $sira = "ORDER BY DATE(bh_tarih) ASC";
                }else{
                    $sira="ORDER BY bh_id DESC";
                }
            }
            else{$sira="ORDER BY bh_id DESC";}

            $countq = "SELECT COUNT(*) as total FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu3." ".$sorgu1." ".$sorgu2." ";
            $countexe = $this->db->query($countq)->row();
            $count = $countexe->total;

            $sorgu = "SELECT * FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu3." ".$sorgu1." ".$sorgu2." ".$sira." LIMIT $pagem,$limit";

            $toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu3." ".$sorgu1." ".$sorgu2." AND bh_turu != 7";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu3." ".$sorgu1." ".$sorgu2." AND bh_turu != 7";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$data["toplamGiris"] = $toplamGirisExe->toplamGiris;
			$data["toplamCikis"] = $toplamCikisExe->toplamCikis;
			$data["kalan"] = $data["toplamGiris"] - $data["toplamCikis"];
        }else{

        	if(!empty($bankaBilgisi) && $bankaBilgisi != "tumu"){
        		$kasaQuery = "AND bh_bankaID = '$bankaBilgisi'";
        	} 

            $countq = "SELECT COUNT(*) as total FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery."";
            $countexe = $this->db->query($countq)->row();
            $count = $countexe->total;
            $sorgu = "SELECT * FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ORDER BY bh_id DESC LIMIT $pagem,$limit";


			$toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." AND bh_turu != 7";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." AND bh_turu != 7";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$data["toplamGiris"] = $toplamGirisExe->toplamGiris;
			$data["toplamCikis"] = $toplamCikisExe->toplamCikis;
			$data["kalan"] = $data["toplamGiris"] - $data["toplamCikis"];
        }

        $data["count_of_list"] = $count;

        $this->load->library("pagination");

        $config = array();
        $config["base_url"] = base_url() . "/banka/$urim";
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
        $data["bankaHareketleri"] = $this->db->query($sorgu)->result();

        $this->load->view("banka/banka-hareket-kayitlari", $data);
	}

	public function autocompleteDataByCodeCari(){
		$anaHesap = anaHesapBilgisi();

		$returnData = array();
        $conditions['searchTerm'] = $this->input->get('term');
        $getData = $this->vt->getRows2($conditions, $anaHesap);
        
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

	public function autocompleteDataByNumber(){
		$anaHesap = anaHesapBilgisi();

		$returnData = array();
        $conditions['searchTerm'] = $this->input->get('term');
        $getData = $this->vt->getRows7($conditions,$anaHesap);
        
        if(!empty($getData)){
            foreach($getData as $row){
                $data['id'] = $row['banka_id'];
                $data['value'] = $row['banka_hesapNo'];
                $data['banka_bankaAd'] = $row['banka_bankaAd'];
                array_push($returnData, $data);
            }
        }
        echo json_encode($returnData);die;
	}

	public function autocompleteDataByName(){
		$anaHesap = anaHesapBilgisi();

		$returnData = array();
        $conditions['searchTerm'] = $this->input->get('term');
        $getData = $this->vt->getRows8($conditions,$anaHesap);
        
        if(!empty($getData)){
            foreach($getData as $row){
                $data['id'] = $row['banka_id'];
                $data['value'] = $row['banka_bankaAd'];
                $data['banka_hesapNo'] = $row['banka_hesapNo'];
                array_push($returnData, $data);
            }
        }
        echo json_encode($returnData);die;
	}
	
	public function bankaHavale(){
        $data["baslik"] = "Banka / Banka Havale - EFT";
		$this->load->view("banka/banka-havale",$data);
	}

	public function yeniBankaHavale(){
		$control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$belgeNo = postval("havale_belgeNo");

		/*$hesapNo = postval("havale_hesapNo");
		$bankaAdi = postval("havale_bankaAdi");*/

		$cariKodu = postval("havale_cariKodu");
		$cariAdi = postval("havale_cariAdi");

		$havale_tarih = postval("havale_tarih");
        $yeni_havale_tarih = date("Y-m-d", strtotime($havale_tarih));

        $islemTipi = postval("havale_islemTipi");

        $bankaID = postval("banka_id");
        $tutar = postval("havale_tutar");

		$data["bh_turu"] = 1;
		$data["bh_cariID"] = postval("cari_id");
		$data["bh_bankaID"] = $bankaID;
		$data["bh_belgeNumarasi"] = $belgeNo;
		$data["bh_tarih"] = $yeni_havale_tarih;

		if($islemTipi == 1){ $data["bh_giris"] = $tutar;  }
		else if($islemTipi == 2){ $data["bh_cikis"] = $tutar; }

		$data["bh_aciklama"] = postval("havale_aciklama");

		$data["bh_olusturan"] = $u_id;
		$data["bh_olusturanAnaHesap"] = $anaHesap;
		$data["bh_olusturmaTarihi"] =  $tarihi;
		$data["bh_olusturmaSaati"] = $saati;

		if($islemTipi == 2){//çıkış ise
			//eksiye düşüyor mu kontrol et?
			$toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$toplamGiris = $toplamGirisExe->toplamGiris;
			$toplamCikis = $toplamCikisExe->toplamCikis;
			$kalan = $toplamGiris - $toplamCikis;

			$cikart = $kalan - $tutar;

			if($cikart < 0){
				$this->session->set_flashdata('banka_eksi','OK');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}

		$belgeNoKontrolQ = "SELECT * FROM bankaHareketleri WHERE bh_belgeNumarasi = '$belgeNo' AND bh_olusturanAnaHesap = '$anaHesap'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

		$cariKontrolQ = "SELECT * FROM cari WHERE (cari_kodu = '$cariKodu' AND cari_ad = '$cariAdi') AND cari_olusturanAnaHesap = '$anaHesap'";
        $cariKontrol = $this->db->query($cariKontrolQ)->row();

        if(!$cariKontrol){
            $this->session->set_flashdata('cari_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        /*$bankaKontrolQ = "SELECT * FROM banka WHERE (banka_hesapNo = '$hesapNo' AND banka_bankaAd = '$bankaAdi') AND banka_olusturanAnaHesap = '$anaHesap'";
        $bankaKontrol = $this->db->query($bankaKontrolQ)->row();

        if(!$bankaKontrol){
            $this->session->set_flashdata('banka_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }*/

		$this->vt->insert("bankaHareketleri", $data);
		$havale_id = $this->db->insert_id();

		//Cari Hareketleri Ekle :begin
		$data_ch["ch_belgeNumarasi"] = $belgeNo;
        $data_ch["ch_turu"] =  3;
        $data_ch["ch_cariID"] =  postval("cari_id");
        $data_ch["ch_bankaID"] =  postval("banka_id");
        $data_ch["ch_bhID"] = $havale_id;
        if($islemTipi == 2){ $data_ch["ch_borc"] = postval("havale_tutar");  }
		else if($islemTipi == 1){ $data_ch["ch_alacak"] = postval("havale_tutar"); }
        $data_ch["ch_tarih"] =  $yeni_havale_tarih;
        
        $data_ch["ch_olusturan"] =  $u_id;
        $data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
        $data_ch["ch_olusturmaTarihi"] =  $tarihi;
        $data_ch["ch_olusturmaSaati"] =  $saati;

        $this->vt->insert("cariHareketleri", $data_ch);
        $ch_id = $this->db->insert_id();
        $datachu["bh_cariHareketiID"] = $ch_id;

        $this->vt->update('bankaHareketleri', array('bh_id'=>$havale_id), $datachu);
        //Cari Hareketleri Ekle :end

		$this->session->set_flashdata('banka_havale_ok','OK');
	    logekle(24,2);
	  	redirect("banka/banka-havale-duzenle/$havale_id");
	}

	public function bankaHavaleDuzenle($id){
        $data["baslik"]  = "Banka / Banka Havale - EFT Düzenle";
		$anaHesap = anaHesapBilgisi();
		$havaleQ = "SELECT * FROM bankaHareketleri WHERE bh_id = '$id' AND bh_olusturanAnaHesap = '$anaHesap'";
		$data["havale"] = $this->db->query($havaleQ)->row();

        $olusturanHesapKim = $data["havale"]->bh_olusturanAnaHesap;

        if($anaHesap == $olusturanHesapKim){
		  $this->load->view("banka/banka-havale-duzenle",$data);
        }else{
            redirect('hata');
        }
	}

	public function bankaHavaleGuncelle(){
        $bh_id = postval("bh_id");
        $ch_id_post = postval("ch_id");

        $control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

        $anaHesap = anaHesapBilgisi();

        $belgeNo = postval("havale_belgeNo");

        /*$hesapNo = postval("havale_hesapNo");
        $bankaAdi = postval("havale_bankaAdi");*/

        $cariKodu = postval("havale_cariKodu");
        $cariAdi = postval("havale_cariAdi");

        $havale_tarih = postval("havale_tarih");
        $yeni_havale_tarih = date("Y-m-d", strtotime($havale_tarih));

        $islemTipi = postval("havale_islemTipi");

        $bankaID = postval("banka_id");
        $tutar = postval("havale_tutar");

        $data["bh_turu"] = 1;
        $data["bh_cariID"] = postval("cari_id");
        $data["bh_bankaID"] = $bankaID;
        $data["bh_belgeNumarasi"] = $belgeNo;
        $data["bh_tarih"] = $yeni_havale_tarih;

        if($islemTipi == 1){ $data["bh_giris"] = $tutar;  }
        else if($islemTipi == 2){ $data["bh_cikis"] = $tutar; }

        $data["bh_aciklama"] = postval("havale_aciklama");

        $data["bh_olusturan"] = $u_id;
        $data["bh_olusturanAnaHesap"] = $anaHesap;
        $data["bh_olusturmaTarihi"] =  $tarihi;
        $data["bh_olusturmaSaati"] = $saati;

        if($islemTipi == 2){//çıkış ise
            //eksiye düşüyor mu kontrol et?
            $toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID' AND bh_id != '$bh_id'";
            $toplamGirisExe = $this->db->query($toplamGirisQ)->row();

            $toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID' AND bh_id != '$bh_id'";
            $toplamCikisExe = $this->db->query($toplamCikisQ)->row();

            $toplamGiris = $toplamGirisExe->toplamGiris;
            $toplamCikis = $toplamCikisExe->toplamCikis;
            $kalan = $toplamGiris - $toplamCikis;

            $cikart = $kalan - $tutar;

            if($cikart < 0){
                $this->session->set_flashdata('banka_eksi','OK');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $belgeNoKontrolQ = "SELECT * FROM bankaHareketleri WHERE bh_belgeNumarasi = '$belgeNo' AND bh_olusturanAnaHesap = '$anaHesap' AND bh_id != '$bh_id'";
        $belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

        if($belgeNoKontrol){
            $this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $cariKontrolQ = "SELECT * FROM cari WHERE (cari_kodu = '$cariKodu' AND cari_ad = '$cariAdi') AND cari_olusturanAnaHesap = '$anaHesap'";
        $cariKontrol = $this->db->query($cariKontrolQ)->row();

        if(!$cariKontrol){
            $this->session->set_flashdata('cari_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        /*$bankaKontrolQ = "SELECT * FROM banka WHERE (banka_hesapNo = '$hesapNo' AND banka_bankaAd = '$bankaAdi') AND banka_olusturanAnaHesap = '$anaHesap'";
        $bankaKontrol = $this->db->query($bankaKontrolQ)->row();

        if(!$bankaKontrol){
            $this->session->set_flashdata('banka_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }*/

        $this->vt->insert("bankaHareketleri", $data);
        $havale_id = $this->db->insert_id();

        //Cari Hareketleri Ekle :begin
        $data_ch["ch_belgeNumarasi"] = $belgeNo;
        $data_ch["ch_turu"] =  3;
        $data_ch["ch_cariID"] =  postval("cari_id");
        $data_ch["ch_bankaID"] =  postval("banka_id");
        $data_ch["ch_bhID"] = $havale_id;
        if($islemTipi == 2){ $data_ch["ch_borc"] = postval("havale_tutar");  }
        else if($islemTipi == 1){ $data_ch["ch_alacak"] = postval("havale_tutar"); }
        $data_ch["ch_tarih"] =  $yeni_havale_tarih;
        
        $data_ch["ch_olusturan"] =  $u_id;
        $data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
        $data_ch["ch_olusturmaTarihi"] =  $tarihi;
        $data_ch["ch_olusturmaSaati"] =  $saati;

        $this->vt->insert("cariHareketleri", $data_ch);
        $ch_id = $this->db->insert_id();
        $datachu["bh_cariHareketiID"] = $ch_id;

        $this->vt->update('bankaHareketleri', array('bh_id'=>$havale_id), $datachu);
        //Cari Hareketleri Ekle :end



        //eğer yeni ekleme başarılı bir şekilde yapılırsa güncelleme etkisi için eski kayıt siliniyor.        
        $this->vt->del("bankaHareketleri","bh_id",$bh_id);
        $this->vt->del("cariHareketleri","ch_id",$ch_id_post);

        $this->session->set_flashdata('banka_havale_updt_ok','OK');
        logekle(24,3);
        redirect("banka/banka-havale-duzenle/$havale_id");



		/* $control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

		$anaHesap = anaHesapBilgisi();

		$bh_id = postval("bh_id");

		$belgeNo = postval("havale_belgeNo");

		$hesapNo = postval("havale_hesapNo");
		$bankaAdi = postval("havale_bankaAdi");

		$cariKodu = postval("havale_cariKodu");
		$cariAdi = postval("havale_cariAdi");

		$havale_tarih = postval("havale_tarih");
        $yeni_havale_tarih = date("Y-m-d", strtotime($havale_tarih));

        $islemTipi = postval("havale_islemTipi");

        $bankaID = postval("banka_id");
        $tutar = postval("havale_tutar");

		$data["bh_cariID"] = postval("cari_id");
		$data["bh_bankaID"] = $bankaID;
		$data["bh_belgeNumarasi"] = $belgeNo;
		$data["bh_tarih"] = $yeni_havale_tarih;

		if($islemTipi == 1){ $data["bh_giris"] =  $tutar; }
		else if($islemTipi == 2){ $data["bh_cikis"] = $tutar; }

		$data["bh_aciklama"] = postval("havale_aciklama");

		if($islemTipi == 2){//çıkış ise
			//eksiye düşüyor mu kontrol et?
			$toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$toplamGiris = $toplamGirisExe->toplamGiris;
			$toplamCikis = $toplamCikisExe->toplamCikis;
			$kalan = $toplamGiris - $toplamCikis;

			$cikart = $kalan - $tutar;

			if($cikart < 0){
				$this->session->set_flashdata('banka_eksi','OK');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}

		$belgeNoKontrolQ = "SELECT * FROM bankaHareketleri WHERE bh_belgeNumarasi = '$belgeNo' AND bh_olusturanAnaHesap = '$anaHesap' AND bh_id != '$bh_id'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

		$cariKontrolQ = "SELECT * FROM cari WHERE (cari_kodu = '$cariKodu' AND cari_ad = '$cariAdi') AND cari_olusturanAnaHesap = '$anaHesap'";
        $cariKontrol = $this->db->query($cariKontrolQ)->row();

        if(!$cariKontrol){
            $this->session->set_flashdata('cari_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $bankaKontrolQ = "SELECT * FROM banka WHERE (banka_hesapNo = '$hesapNo' AND banka_bankaAd = '$bankaAdi') AND banka_olusturanAnaHesap = '$anaHesap'";
        $bankaKontrol = $this->db->query($bankaKontrolQ)->row();

        if(!$bankaKontrol){
            $this->session->set_flashdata('banka_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

		$this->vt->update('bankaHareketleri', array('bh_id'=>$bh_id), $data);

		//Cari Hareketleri Düzenle :begin
		$ch_idsi = postval("ch_id");
		$data_ch["ch_belgeNumarasi"] = $belgeNo;
        $data_ch["ch_cariID"] =  postval("cari_id");
        $data_ch["ch_bankaID"] =  postval("banka_id");
        $data_ch["ch_bhID"] = $bh_id;
       	if($islemTipi == 1){ $data_ch["ch_alacak"] = postval("havale_tutar");  }
		else if($islemTipi == 2){ $data_ch["ch_borc"] = postval("havale_tutar"); }
        $data_ch["ch_tarih"] =  $yeni_havale_tarih;
        
        $data_ch["ch_olusturan"] =  $u_id;
        $data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
        $data_ch["ch_olusturmaTarihi"] =  $tarihi;
        $data_ch["ch_olusturmaSaati"] =  $saati;

        $this->vt->update('cariHareketleri', array('ch_id'=>$ch_idsi), $data_ch);
        //Cari Hareketleri Düzenle :end

		$this->session->set_flashdata('banka_havale_updt_ok','OK');
	    logekle(24,3);
	  	redirect("banka/banka-havale-duzenle/$bh_id");*/
	}

	public function bankaEFT(){
        $data["baslik"] = "Banka / Banka EFT";
		$this->load->view("banka/banka-eft",$data);
	}

	public function yeniBankaEFT(){
		$control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$belgeNo = postval("eft_belgeNo");

		/*$hesapNo = postval("eft_hesapNo");
		$bankaAdi = postval("eft_bankaAdi");*/

		$cariKodu = postval("eft_cariKodu");
		$cariAdi = postval("eft_cariAdi");

		$eft_tarih = postval("eft_tarih");
        $yeni_eft_tarih = date("Y-m-d", strtotime($eft_tarih));

        $islemTipi = postval("eft_islemTipi");

        $bankaID = postval("banka_id");
        $tutar = postval("eft_tutar");

		$data["bh_turu"] = 2;
		$data["bh_cariID"] = postval("cari_id");
		$data["bh_bankaID"] = $bankaID;
		$data["bh_belgeNumarasi"] = $belgeNo;
		$data["bh_tarih"] = $yeni_eft_tarih;

		if($islemTipi == 1){ $data["bh_giris"] = $tutar;  }
		else if($islemTipi == 2){ $data["bh_cikis"] = $tutar; }

		$data["bh_aciklama"] = postval("eft_aciklama");

		$data["bh_olusturan"] = $u_id;
		$data["bh_olusturanAnaHesap"] = $anaHesap;
		$data["bh_olusturmaTarihi"] =  $tarihi;
		$data["bh_olusturmaSaati"] = $saati;

		if($islemTipi == 2){//çıkış ise
			//eksiye düşüyor mu kontrol et?
			$toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$toplamGiris = $toplamGirisExe->toplamGiris;
			$toplamCikis = $toplamCikisExe->toplamCikis;
			$kalan = $toplamGiris - $toplamCikis;

			$cikart = $kalan - $tutar;

			if($cikart < 0){
				$this->session->set_flashdata('banka_eksi','OK');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}

		$belgeNoKontrolQ = "SELECT * FROM bankaHareketleri WHERE bh_belgeNumarasi = '$belgeNo' AND bh_olusturanAnaHesap = '$anaHesap'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

		$cariKontrolQ = "SELECT * FROM cari WHERE (cari_kodu = '$cariKodu' AND cari_ad = '$cariAdi') AND cari_olusturanAnaHesap = '$anaHesap'";
        $cariKontrol = $this->db->query($cariKontrolQ)->row();

        if(!$cariKontrol){
            $this->session->set_flashdata('cari_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        /*$bankaKontrolQ = "SELECT * FROM banka WHERE (banka_hesapNo = '$hesapNo' AND banka_bankaAd = '$bankaAdi') AND banka_olusturanAnaHesap = '$anaHesap'";
        $bankaKontrol = $this->db->query($bankaKontrolQ)->row();

        if(!$bankaKontrol){
            $this->session->set_flashdata('banka_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }*/

		$this->vt->insert("bankaHareketleri", $data);
		$eft_id = $this->db->insert_id();

		//Cari Hareketleri Ekle :begin
		$data_ch["ch_belgeNumarasi"] = $belgeNo;
        $data_ch["ch_turu"] =  4;
        $data_ch["ch_cariID"] =  postval("cari_id");
        $data_ch["ch_bankaID"] =  postval("banka_id");
       	$data_ch["ch_bhID"] = $eft_id;
        if($islemTipi == 2){ $data_ch["ch_borc"] = postval("eft_tutar");  }
		else if($islemTipi == 1){ $data_ch["ch_alacak"] = postval("eft_tutar"); }
        $data_ch["ch_tarih"] =  $yeni_eft_tarih;
        
        $data_ch["ch_olusturan"] =  $u_id;
        $data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
        $data_ch["ch_olusturmaTarihi"] =  $tarihi;
        $data_ch["ch_olusturmaSaati"] =  $saati;

        $this->vt->insert("cariHareketleri", $data_ch);
        $ch_id = $this->db->insert_id();
        $datachu["bh_cariHareketiID"] = $ch_id;

        $this->vt->update('bankaHareketleri', array('bh_id'=>$eft_id), $datachu);
        //Cari Hareketleri Ekle :end

		$this->session->set_flashdata('banka_eft_ok','OK');
	    logekle(25,2);
	  	redirect("banka/banka-eft-duzenle/$eft_id");
	}

	public function bankaEFTDuzenle($id){
        $data["baslik"] = "Banka / Banka EFT Düzenle";
		$anaHesap = anaHesapBilgisi();
		$eftQ = "SELECT * FROM bankaHareketleri WHERE bh_id = '$id' AND bh_olusturanAnaHesap = '$anaHesap'";
		$data["eft"] = $this->db->query($eftQ)->row();

        $olusturanHesapKim = $data["eft"]->bh_olusturanAnaHesap;

        if($anaHesap == $olusturanHesapKim){
		  $this->load->view("banka/banka-eft-duzenle",$data);
        }else{
            redirect('hata');
        }
	}

	public function bankaEFTGuncelle(){
        $bh_id = postval("bh_id");
        $ch_id_post = postval("ch_id");

        $control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

        $anaHesap = anaHesapBilgisi();

        $belgeNo = postval("eft_belgeNo");

        /* $hesapNo = postval("eft_hesapNo");
        $bankaAdi = postval("eft_bankaAdi"); */

        $cariKodu = postval("eft_cariKodu");
        $cariAdi = postval("eft_cariAdi");

        $eft_tarih = postval("eft_tarih");
        $yeni_eft_tarih = date("Y-m-d", strtotime($eft_tarih));

        $islemTipi = postval("eft_islemTipi");

        $bankaID = postval("banka_id");
        $tutar = postval("eft_tutar");

        $data["bh_turu"] = 2;
        $data["bh_cariID"] = postval("cari_id");
        $data["bh_bankaID"] = $bankaID;
        $data["bh_belgeNumarasi"] = $belgeNo;
        $data["bh_tarih"] = $yeni_eft_tarih;

        if($islemTipi == 1){ $data["bh_giris"] = $tutar;  }
        else if($islemTipi == 2){ $data["bh_cikis"] = $tutar; }

        $data["bh_aciklama"] = postval("eft_aciklama");

        $data["bh_olusturan"] = $u_id;
        $data["bh_olusturanAnaHesap"] = $anaHesap;
        $data["bh_olusturmaTarihi"] =  $tarihi;
        $data["bh_olusturmaSaati"] = $saati;

        if($islemTipi == 2){//çıkış ise
            //eksiye düşüyor mu kontrol et?
            $toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID' AND bh_id != '$bh_id'";
            $toplamGirisExe = $this->db->query($toplamGirisQ)->row();

            $toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID' AND bh_id != '$bh_id'";
            $toplamCikisExe = $this->db->query($toplamCikisQ)->row();

            $toplamGiris = $toplamGirisExe->toplamGiris;
            $toplamCikis = $toplamCikisExe->toplamCikis;
            $kalan = $toplamGiris - $toplamCikis;

            $cikart = $kalan - $tutar;

            if($cikart < 0){
                $this->session->set_flashdata('banka_eksi','OK');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $belgeNoKontrolQ = "SELECT * FROM bankaHareketleri WHERE bh_belgeNumarasi = '$belgeNo' AND bh_olusturanAnaHesap = '$anaHesap' AND bh_id != '$bh_id'";
        $belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

        if($belgeNoKontrol){
            $this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $cariKontrolQ = "SELECT * FROM cari WHERE (cari_kodu = '$cariKodu' AND cari_ad = '$cariAdi') AND cari_olusturanAnaHesap = '$anaHesap'";
        $cariKontrol = $this->db->query($cariKontrolQ)->row();

        if(!$cariKontrol){
            $this->session->set_flashdata('cari_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        /*$bankaKontrolQ = "SELECT * FROM banka WHERE (banka_hesapNo = '$hesapNo' AND banka_bankaAd = '$bankaAdi') AND banka_olusturanAnaHesap = '$anaHesap'";
        $bankaKontrol = $this->db->query($bankaKontrolQ)->row();

        if(!$bankaKontrol){
            $this->session->set_flashdata('banka_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }*/

        $this->vt->insert("bankaHareketleri", $data);
        $eft_id = $this->db->insert_id();

        //Cari Hareketleri Ekle :begin
        $data_ch["ch_belgeNumarasi"] = $belgeNo;
        $data_ch["ch_turu"] =  4;
        $data_ch["ch_cariID"] =  postval("cari_id");
        $data_ch["ch_bankaID"] =  postval("banka_id");
        $data_ch["ch_bhID"] = $eft_id;
        if($islemTipi == 2){ $data_ch["ch_borc"] = postval("eft_tutar");  }
        else if($islemTipi == 1){ $data_ch["ch_alacak"] = postval("eft_tutar"); }
        $data_ch["ch_tarih"] =  $yeni_eft_tarih;
        
        $data_ch["ch_olusturan"] =  $u_id;
        $data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
        $data_ch["ch_olusturmaTarihi"] =  $tarihi;
        $data_ch["ch_olusturmaSaati"] =  $saati;

        $this->vt->insert("cariHareketleri", $data_ch);
        $ch_id = $this->db->insert_id();
        $datachu["bh_cariHareketiID"] = $ch_id;

        $this->vt->update('bankaHareketleri', array('bh_id'=>$eft_id), $datachu);
        //Cari Hareketleri Ekle :end

        //eğer yeni ekleme başarılı bir şekilde yapılırsa güncelleme etkisi için eski kayıt siliniyor.        
        $this->vt->del("bankaHareketleri","bh_id",$bh_id);
        $this->vt->del("cariHareketleri","ch_id",$ch_id_post);

        $this->session->set_flashdata('banka_eft_updt_ok','OK');
        logekle(25,3);
        redirect("banka/banka-eft-duzenle/$eft_id");

        /*
		$control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;
        
		$anaHesap = anaHesapBilgisi();

		$bh_id = postval("bh_id");

		$belgeNo = postval("eft_belgeNo");

		$hesapNo = postval("eft_hesapNo");
		$bankaAdi = postval("eft_bankaAdi");

		$cariKodu = postval("eft_cariKodu");
		$cariAdi = postval("eft_cariAdi");

		$eft_tarih = postval("eft_tarih");
        $yeni_eft_tarih = date("Y-m-d", strtotime($eft_tarih));

        $islemTipi = postval("eft_islemTipi");

        $bankaID = postval("banka_id");
        $tutar = postval("eft_tutar");

		$data["bh_cariID"] = postval("cari_id");
		$data["bh_bankaID"] = $bankaID;
		$data["bh_belgeNumarasi"] = $belgeNo;
		$data["bh_tarih"] = $yeni_eft_tarih;

		if($islemTipi == 1){ $data["bh_giris"] = $tutar;  }
		else if($islemTipi == 2){ $data["bh_cikis"] = $tutar; }

		$data["bh_aciklama"] = postval("eft_aciklama");

		if($islemTipi == 2){//çıkış ise
			//eksiye düşüyor mu kontrol et?
			$toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$toplamGiris = $toplamGirisExe->toplamGiris;
			$toplamCikis = $toplamCikisExe->toplamCikis;
			$kalan = $toplamGiris - $toplamCikis;

			$cikart = $kalan - $tutar;

			if($cikart < 0){
				$this->session->set_flashdata('banka_eksi','OK');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}

		$belgeNoKontrolQ = "SELECT * FROM bankaHareketleri WHERE bh_belgeNumarasi = '$belgeNo' AND bh_olusturanAnaHesap = '$anaHesap' AND bh_id != '$bh_id'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

		$cariKontrolQ = "SELECT * FROM cari WHERE (cari_kodu = '$cariKodu' AND cari_ad = '$cariAdi') AND cari_olusturanAnaHesap = '$anaHesap'";
        $cariKontrol = $this->db->query($cariKontrolQ)->row();

        if(!$cariKontrol){
            $this->session->set_flashdata('cari_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $bankaKontrolQ = "SELECT * FROM banka WHERE (banka_hesapNo = '$hesapNo' AND banka_bankaAd = '$bankaAdi') AND banka_olusturanAnaHesap = '$anaHesap'";
        $bankaKontrol = $this->db->query($bankaKontrolQ)->row();

        if(!$bankaKontrol){
            $this->session->set_flashdata('banka_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

		$this->vt->update('bankaHareketleri', array('bh_id'=>$bh_id), $data);

		//Cari Hareketleri Düzenle :begin
		$ch_idsi = postval("ch_id");
		$data_ch["ch_belgeNumarasi"] = $belgeNo;
        $data_ch["ch_cariID"] =  postval("cari_id");
        $data_ch["ch_bankaID"] =  postval("banka_id");
        $data_ch["ch_bhID"] = $bh_id;
       	if($islemTipi == 1){ $data_ch["ch_alacak"] = postval("eft_tutar");  }
		else if($islemTipi == 2){ $data_ch["ch_borc"] = postval("eft_tutar"); }
        $data_ch["ch_tarih"] =  $yeni_eft_tarih;
        
        $data_ch["ch_olusturan"] =  $u_id;
        $data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
        $data_ch["ch_olusturmaTarihi"] =  $tarihi;
        $data_ch["ch_olusturmaSaati"] =  $saati;

        $this->vt->update('cariHareketleri', array('ch_id'=>$ch_idsi), $data_ch);
        //Cari Hareketleri Düzenle :end

		$this->session->set_flashdata('banka_eft_updt_ok','OK');
	    logekle(25,3);
	  	redirect("banka/banka-eft-duzenle/$bh_id");
        */
	}

    public function bankaVirman(){
        $data["baslik"] = "Banka / Banka Virman";
        $this->load->view("banka/banka-virman",$data);
    }

    public function yeniVirmanIslemi(){
        $control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

        $anaHesap = anaHesapBilgisi();

        $kaynakBankaID = postval("banka_id");
        $hedefBankaID = postval("banka_id2");

        $belgeNo = postval("virman_belgeNo");

        $virman_tarih = postval("virman_tarih");
        $yeni_virman_tarih = date("Y-m-d", strtotime($virman_tarih));

        $tutar = postval("virman_tutar");

        $virmanID = md5(uniqid(rand(), true));

        /*$hesapNo = postval("virman_kaynakHesapNo");
        $bankaAdi = postval("virman_kaynakBankaAdi");

        $hesapNo2 = postval("virman_hedefHesapNo");
        $bankaAdi2 = postval("virman_hedefBankaAdi");*/

        if($kaynakBankaID == $hedefBankaID){
            $this->session->set_flashdata('banka_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $belgeNoKontrolQ = "SELECT * FROM bankaHareketleri WHERE bh_belgeNumarasi = '$belgeNo' AND bh_olusturanAnaHesap = '$anaHesap'";
        $belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

        if($belgeNoKontrol){
            $this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        /*$bankaKontrolQ = "SELECT * FROM banka WHERE (banka_hesapNo = '$hesapNo' AND banka_bankaAd = '$bankaAdi') AND banka_olusturanAnaHesap = '$anaHesap'";
        $bankaKontrol = $this->db->query($bankaKontrolQ)->row();

        if(!$bankaKontrol){
            $this->session->set_flashdata('banka_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $bankaKontrolQ2 = "SELECT * FROM banka WHERE (banka_hesapNo = '$hesapNo2' AND banka_bankaAd = '$bankaAdi2') AND banka_olusturanAnaHesap = '$anaHesap'";
        $bankaKontrol2 = $this->db->query($bankaKontrolQ2)->row();

        if(!$bankaKontrol2){
            $this->session->set_flashdata('banka_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }*/

        $toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$kaynakBankaID'";
        $toplamGirisExe = $this->db->query($toplamGirisQ)->row();

        $toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$kaynakBankaID'";
        $toplamCikisExe = $this->db->query($toplamCikisQ)->row();

        $toplamGiris = $toplamGirisExe->toplamGiris;
        $toplamCikis = $toplamCikisExe->toplamCikis;
        $kalan = $toplamGiris - $toplamCikis;

        $cikart = $kalan - $tutar;

        if($cikart < 0){
            $this->session->set_flashdata('banka_eksi','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        //kaynak banka bilgileri
        $data_kaynak["bh_turu"] = 7;
        $data_kaynak["bh_bankaID"] = $kaynakBankaID;
        $data_kaynak["bh_virmanID"] = $virmanID;
        $data_kaynak["bh_belgeNumarasi"] = $belgeNo;
        $data_kaynak["bh_tarih"] = $yeni_virman_tarih;
        $data_kaynak["bh_cikis"] =  $tutar;
        $data_kaynak["bh_aciklama"] = postval("virman_aciklama");
        $data_kaynak["bh_olusturan"] = $u_id;
        $data_kaynak["bh_olusturanAnaHesap"] = $anaHesap;
        $data_kaynak["bh_olusturmaTarihi"] =  $tarihi;
        $data_kaynak["bh_olusturmaSaati"] = $saati;
        $this->vt->insert("bankaHareketleri", $data_kaynak);

        //hedef banka bilgileri
        $daha_hedef["bh_turu"] = 7;
        $daha_hedef["bh_bankaID"] = $hedefBankaID;
        $daha_hedef["bh_virmanID"] = $virmanID;
        $daha_hedef["bh_belgeNumarasi"] = $belgeNo;
        $daha_hedef["bh_tarih"] = $yeni_virman_tarih;
        $daha_hedef["bh_giris"] =  $tutar;
        $daha_hedef["bh_aciklama"] = postval("virman_aciklama");
        $daha_hedef["bh_olusturan"] = $u_id;
        $daha_hedef["bh_olusturanAnaHesap"] = $anaHesap;
        $daha_hedef["bh_olusturmaTarihi"] =  $tarihi;
        $daha_hedef["bh_olusturmaSaati"] = $saati;
        $this->vt->insert("bankaHareketleri", $daha_hedef);

        $this->session->set_flashdata('banka_virman_ok','OK');
        logekle(60,2);
        redirect("banka/banka-hareket-kayitlari");
    }

    public function bankaVirmanDuzenle($id){
        $data["baslik"] = "Banka / Banka Virman Düzenle";
        
        $virmanQ1 = "SELECT * FROM bankaHareketleri WHERE bh_giris IS NOT NULL AND bh_virmanID = '$id'";
        $virmanQ2 = "SELECT * FROM bankaHareketleri WHERE bh_cikis IS NOT NULL AND bh_virmanID = '$id'";

        $data["kaynak"] = $this->db->query($virmanQ2)->row();
        $data["hedef"] = $this->db->query($virmanQ1)->row();

        $this->load->view("banka/banka-virman-duzenle",$data);
    }

    public function mevcutVirmanDuzenle(){
        $virman_id = postval("virman_id");

        $control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

        $anaHesap = anaHesapBilgisi();

        $kaynakBankaID = postval("banka_id");
        $hedefBankaID = postval("banka_id2");

        $belgeNo = postval("virman_belgeNo");

        $virman_tarih = postval("virman_tarih");
        $yeni_virman_tarih = date("Y-m-d", strtotime($virman_tarih));

        $tutar = postval("virman_tutar");

        $virmanID = md5(uniqid(rand(), true));

        /*$hesapNo = postval("virman_kaynakHesapNo");
        $bankaAdi = postval("virman_kaynakBankaAdi");

        $hesapNo2 = postval("virman_hedefHesapNo");
        $bankaAdi2 = postval("virman_hedefBankaAdi");*/

        if($kaynakBankaID == $hedefBankaID){
            $this->session->set_flashdata('banka_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $belgeNoKontrolQ = "SELECT * FROM bankaHareketleri WHERE bh_belgeNumarasi = '$belgeNo' AND bh_olusturanAnaHesap = '$anaHesap' AND bh_virmanID != '$virman_id' ";
        $belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

        if($belgeNoKontrol){
            $this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        /*$bankaKontrolQ = "SELECT * FROM banka WHERE (banka_hesapNo = '$hesapNo' AND banka_bankaAd = '$bankaAdi') AND banka_olusturanAnaHesap = '$anaHesap'";
        $bankaKontrol = $this->db->query($bankaKontrolQ)->row();

        if(!$bankaKontrol){
            $this->session->set_flashdata('banka_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $bankaKontrolQ2 = "SELECT * FROM banka WHERE (banka_hesapNo = '$hesapNo2' AND banka_bankaAd = '$bankaAdi2') AND banka_olusturanAnaHesap = '$anaHesap'";
        $bankaKontrol2 = $this->db->query($bankaKontrolQ2)->row();

        if(!$bankaKontrol2){
            $this->session->set_flashdata('banka_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }*/

        $toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$kaynakBankaID' AND (bh_virmanID != '$virman_id' OR bh_virmanID IS NULL)";
        $toplamGirisExe = $this->db->query($toplamGirisQ)->row();

        $toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$kaynakBankaID' AND (bh_virmanID != '$virman_id' OR bh_virmanID IS NULL)";
        $toplamCikisExe = $this->db->query($toplamCikisQ)->row();


        $toplamGiris = $toplamGirisExe->toplamGiris;
        $toplamCikis = $toplamCikisExe->toplamCikis;
        $kalan = $toplamGiris - $toplamCikis;

        $cikart = $kalan - $tutar;

        if($cikart < 0){
            $this->session->set_flashdata('banka_eksi','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

        //kaynak banka bilgileri
        $data_kaynak["bh_turu"] = 7;
        $data_kaynak["bh_bankaID"] = $kaynakBankaID;
        $data_kaynak["bh_virmanID"] = $virmanID;
        $data_kaynak["bh_belgeNumarasi"] = $belgeNo;
        $data_kaynak["bh_tarih"] = $yeni_virman_tarih;
        $data_kaynak["bh_cikis"] =  $tutar;
        $data_kaynak["bh_aciklama"] = postval("virman_aciklama");
        $data_kaynak["bh_olusturan"] = $u_id;
        $data_kaynak["bh_olusturanAnaHesap"] = $anaHesap;
        $data_kaynak["bh_olusturmaTarihi"] =  $tarihi;
        $data_kaynak["bh_olusturmaSaati"] = $saati;
        $this->vt->insert("bankaHareketleri", $data_kaynak);

        //hedef banka bilgileri
        $daha_hedef["bh_turu"] = 7;
        $daha_hedef["bh_bankaID"] = $hedefBankaID;
        $daha_hedef["bh_virmanID"] = $virmanID;
        $daha_hedef["bh_belgeNumarasi"] = $belgeNo;
        $daha_hedef["bh_tarih"] = $yeni_virman_tarih;
        $daha_hedef["bh_giris"] =  $tutar;
        $daha_hedef["bh_aciklama"] = postval("virman_aciklama");
        $daha_hedef["bh_olusturan"] = $u_id;
        $daha_hedef["bh_olusturanAnaHesap"] = $anaHesap;
        $daha_hedef["bh_olusturmaTarihi"] =  $tarihi;
        $daha_hedef["bh_olusturmaSaati"] = $saati;
        $this->vt->insert("bankaHareketleri", $daha_hedef);

        //eğer yeni ekleme başarılı bir şekilde yapılırsa güncelleme etkisi için eski kayıt siliniyor.        
        $this->vt->del("bankaHareketleri","bh_virmanID",$virman_id);

        $this->session->set_flashdata('banka_virman_ok','OK');
        logekle(60,3);
        redirect("banka/banka-hareket-kayitlari");
    }

	public function bankaIslemi(){
        $data["baslik"] = "Banka / Banka İşlemi";
		$this->load->view("banka/banka-islemi",$data);
	}

	public function yeniBankaIslemi(){
		$control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;

        date_default_timezone_set('Europe/Istanbul');
        $tarihi = (new DateTime('now'))->format('Y.m.d');
        $saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$belgeNo = postval("islem_belgeNo");

		$hesapNo = postval("islem_hesapNo");
		$bankaAdi = postval("islem_bankaAdi");

		$islem_tarih = postval("islem_tarih");
        $yeni_islem_tarih = date("Y-m-d", strtotime($islem_tarih));

        $islemTipi = postval("islem_islemTipi");

        $bankaID = postval("banka_id");
        $tutar = postval("islem_tutar");

		$data["bh_turu"] = 3;
		$data["bh_bankaID"] = $bankaID;
		$data["bh_belgeNumarasi"] = $belgeNo;
		$data["bh_tarih"] = $yeni_islem_tarih;

		if($islemTipi == 1){ $data["bh_giris"] =  $tutar; }
		else if($islemTipi == 2){ $data["bh_cikis"] = $tutar; }

		$data["bh_aciklama"] = postval("islem_aciklama");

		$data["bh_olusturan"] = $u_id;
		$data["bh_olusturanAnaHesap"] = $anaHesap;
		$data["bh_olusturmaTarihi"] =  $tarihi;
		$data["bh_olusturmaSaati"] = $saati;

		if($islemTipi == 2){//çıkış ise
			//eksiye düşüyor mu kontrol et?
			$toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$toplamGiris = $toplamGirisExe->toplamGiris;
			$toplamCikis = $toplamCikisExe->toplamCikis;
			$kalan = $toplamGiris - $toplamCikis;

			$cikart = $kalan - $tutar;

			if($cikart < 0){
				$this->session->set_flashdata('banka_eksi','OK');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}

		$belgeNoKontrolQ = "SELECT * FROM bankaHareketleri WHERE bh_belgeNumarasi = '$belgeNo' AND bh_olusturanAnaHesap = '$anaHesap'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

        $bankaKontrolQ = "SELECT * FROM banka WHERE (banka_hesapNo = '$hesapNo' AND banka_bankaAd = '$bankaAdi') AND banka_olusturanAnaHesap = '$anaHesap'";
        $bankaKontrol = $this->db->query($bankaKontrolQ)->row();

        if(!$bankaKontrol){
            $this->session->set_flashdata('banka_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

		$this->vt->insert("bankaHareketleri", $data);
		$bankaIslemi_id = $this->db->insert_id();
		$this->session->set_flashdata('banka_islemi_ok','OK');
	    logekle(26,2);
	  	redirect("banka/banka-islemi-duzenle/$bankaIslemi_id");
	}

	public function bankaIslemiDuzenle($id){
        $data["baslik"] = "Banka / Banka İşlemi Düzenle";
		$anaHesap = anaHesapBilgisi();
		$islemQ = "SELECT * FROM bankaHareketleri WHERE bh_id = '$id' AND bh_olusturanAnaHesap = '$anaHesap'";
		$data["bislem"] = $this->db->query($islemQ)->row();

        $olusturanHesapKim = $data["bislem"]->bh_olusturanAnaHesap;

        if($anaHesap == $olusturanHesapKim){
		  $this->load->view("banka/banka-islemi-duzenle",$data);
        }else{
            redirect('hata');
        }
	}

	public function bankaIslemiGuncelle(){
		$anaHesap = anaHesapBilgisi();

		$bh_id = postval("bh_id");

		$belgeNo = postval("islem_belgeNo");

		$hesapNo = postval("islem_hesapNo");
		$bankaAdi = postval("islem_bankaAdi");

		$islem_tarih = postval("islem_tarih");
        $yeni_islem_tarih = date("Y-m-d", strtotime($islem_tarih));

        $islemTipi = postval("islem_islemTipi");

        $bankaID = postval("banka_id");
        $tutar = postval("islem_tutar");

		$data["bh_bankaID"] = $bankaID;
		$data["bh_belgeNumarasi"] = $belgeNo;
		$data["bh_tarih"] = $yeni_islem_tarih;

		if($islemTipi == 1){ $data["bh_giris"] = $tutar;  }
		else if($islemTipi == 2){ $data["bh_cikis"] = $tutar; }

		$data["bh_aciklama"] = postval("islem_aciklama");

		if($islemTipi == 2){//çıkış ise
			//eksiye düşüyor mu kontrol et?
			$toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$toplamGiris = $toplamGirisExe->toplamGiris;
			$toplamCikis = $toplamCikisExe->toplamCikis;
			$kalan = $toplamGiris - $toplamCikis;

			$cikart = $kalan - $tutar;

			if($cikart < 0){
				$this->session->set_flashdata('banka_eksi','OK');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}

		$belgeNoKontrolQ = "SELECT * FROM bankaHareketleri WHERE bh_belgeNumarasi = '$belgeNo' AND bh_olusturanAnaHesap = '$anaHesap' AND bh_id != '$bh_id'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		if($belgeNoKontrol){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
            redirect($_SERVER['HTTP_REFERER']);
		}

        $bankaKontrolQ = "SELECT * FROM banka WHERE (banka_hesapNo = '$hesapNo' AND banka_bankaAd = '$bankaAdi') AND banka_olusturanAnaHesap = '$anaHesap'";
        $bankaKontrol = $this->db->query($bankaKontrolQ)->row();

        if(!$bankaKontrol){
            $this->session->set_flashdata('banka_hatali','OK');
            redirect($_SERVER['HTTP_REFERER']);
        }

		$this->vt->update('bankaHareketleri', array('bh_id'=>$bh_id), $data);
		$this->session->set_flashdata('banka_islem_updt_ok','OK');
	    logekle(26,3);
	  	redirect("banka/banka-islemi-duzenle/$bh_id");
	}

	public function bankaHareketKayitlariExcel(){
		$anaHesap = anaHesapBilgisi();

		$bankaBilgisi = $this->input->get('banka');

		$hareketTuru = $this->input->get('hareketTuru');
		$belgeNo = $this->input->get('belgeNo');

		$tarihGet = $this->input->get('tarihAraligi');

		$tarihAraligi = explode(' - ', $tarihGet);

		$tarih1 = date('Y-m-d', strtotime($tarihAraligi[0])); //küçük tarih
		$tarih2 = date('Y-m-d', strtotime($tarihAraligi[1])); //büyük tarih

		if((isset($hareketTuru) && !empty($hareketTuru)) || (isset($belgeNo) && !empty($belgeNo)) || (isset($tarihGet) && !empty($tarihGet))  || (isset($bankaBilgisi) && !empty($bankaBilgisi)) ){

            if(!empty($hareketTuru)){$sorgu1 = "AND bh_turu = '$hareketTuru'";}
            else{$sorgu1 = "";}

            if(!empty($bankaBilgisi) && $bankaBilgisi != "tumu"){
        		$kasaQuery = "AND bh_bankaID = '$bankaBilgisi'";
        	}

        	if(!empty($belgeNo)){$sorgu3 = "AND bh_belgeNumarasi LIKE '%$belgeNo%'";}
            else{$sorgu3 = "";}

        	if(!empty($tarihGet)){$sorgu2 = "AND bh_tarih BETWEEN '$tarih1' AND '$tarih2'";}
			else{$sorgu2 = "";}

            $sorgu = "SELECT * FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu3." ".$sorgu1." ".$sorgu2." ORDER BY bh_id DESC";

        }else{
        	$sorgu = "SELECT * FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap'  ORDER BY bh_id DESC";
        }

        $bankaHareketleri = $this->db->query($sorgu)->result();

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = new Spreadsheet();
        
        $sheet = $spreadsheet->getActiveSheet();

        date_default_timezone_set('Europe/Istanbul');
        $tarih = (new DateTime('now'))->format('d.m.Y-His');

        $sheet->getStyle('A1:H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');
        
        $sheet->setCellValue('A1', 'Tarih');
        $sheet->setCellValue('B1', 'Banka');
        $sheet->setCellValue('C1', 'Belge Numarası');
        $sheet->setCellValue('D1', 'Türü');
        $sheet->setCellValue('E1', 'Giriş');
        $sheet->setCellValue('F1', 'Çıkış');
        $sheet->setCellValue('G1', 'Cari');
        $sheet->setCellValue('H1', 'Açıklama');

        $rows = 2;
        foreach($bankaHareketleri as $bh){
        	$tarihYeni = date('d.m.Y', strtotime($bh->bh_tarih));

        	$cari_id = $bh->bh_cariID;
			$cariQ = "SELECT * FROM cari WHERE cari_id = '$cari_id' AND cari_olusturanAnaHesap = '$anaHesap'";
			$cariExe = $this->db->query($cariQ)->row();

			$bankaid = $bh->bh_bankaID;

			$bankasiQ = "SELECT * FROM banka WHERE banka_id = '$bankaid' AND banka_olusturanAnaHesap = '$anaHesap'";
			$bankasiExe = $this->db->query($bankasiQ)->row();

			$turu = $bh->bh_turu;
			if($turu == 1){
				$turuTxt = 'Havale';
			}else if($turu == 2){
				$turuTxt = 'EFT';
			}else if($turu == 3){
				$turuTxt = 'Banka İşlem';
			}else if($turu == 4){
				$turuTxt = 'Alış Faturası';
			}else if($turu == 5){
				$turuTxt = 'Satış Faturası';
			}else if($turu == 6){
				$turuTxt = 'Giderler';
			}

			if($bh->bh_giris){
				$giris = number_format($bh->bh_giris,2);
				$cikis = '';
			}

			if($bh->bh_cikis){
				$giris = '';
				$cikis = number_format($bh->bh_cikis,2);
			}

            $sheet->setCellValue('A'.$rows, $tarihYeni);
            $sheet->setCellValue('B'.$rows, $bankasiExe->banka_bankaAd);
            $sheet->setCellValue('C'.$rows, $bh->bh_belgeNumarasi);
            $sheet->setCellValue('D'.$rows, $turuTxt);
            $sheet->setCellValue('E'.$rows, $giris);
            $sheet->setCellValue('F'.$rows, $cikis);
            $sheet->setCellValue('G'.$rows, $cariExe->cari_ad);
            $sheet->setCellValue('H'.$rows, $bh->bh_aciklama);
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
            
        $filename = 'banka-hareket-kayitlari'.$tarih;//set filename for excel file to be exported

        header('Content-Type: application/vnd.ms-excel');// generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');//download file
	}

	public function sil($type, $id){

		$anaHesap = anaHesapBilgisi();

		if($type == "havale"){
			$del1 = "DELETE FROM bankaHareketleri WHERE bh_id = '$id' AND bh_olusturanAnaHesap = '$anaHesap' ";
			$del2 = "DELETE FROM cariHareketleri WHERE ch_bhID = '$id' AND ch_olusturanAnaHesap = '$anaHesap'";
			$this->db->query($del1);
			$this->db->query($del2);
			$this->session->set_flashdata('havale_sil','OK');
			logekle(24,4);
			redirect($_SERVER['HTTP_REFERER']);
		}else if($type == "eft"){
			$del1 = "DELETE FROM bankaHareketleri WHERE bh_id = '$id' AND bh_olusturanAnaHesap = '$anaHesap' ";
			$del2 = "DELETE FROM cariHareketleri WHERE ch_bhID = '$id' AND ch_olusturanAnaHesap = '$anaHesap'";
			$this->db->query($del1);
			$this->db->query($del2);
			$this->session->set_flashdata('eft_sil','OK');
			logekle(25,4);
			redirect($_SERVER['HTTP_REFERER']);
		}else if($type == "gider"){
			$del1 = "DELETE FROM bankaHareketleri WHERE bh_giderID = '$id' AND bh_olusturanAnaHesap = '$anaHesap' ";
			$del2 = "DELETE FROM giderler WHERE gider_id = '$id' AND gider_olusturanAnaHesap = '$anaHesap'";
			$this->db->query($del1);
			$this->db->query($del2);
			$this->session->set_flashdata('gider_sil','OK');
			logekle(56,4);
			redirect($_SERVER['HTTP_REFERER']);
		}else if($type == "virman"){
			$del1 = "DELETE FROM bankaHareketleri WHERE bh_virmanID = '$id' AND bh_olusturanAnaHesap = '$anaHesap' ";
			$this->db->query($del1);
			$this->session->set_flashdata('virman_sil','OK');
			logekle(60,4);
			redirect($_SERVER['HTTP_REFERER']);
		}else if($type == "transfer"){//kasa/sil/transfer/$kh->kh_transferRefID
			$del1 = "DELETE FROM kasaHareketleri WHERE kh_transferRefID = '$id' AND kh_olusturanAnaHesap = '$anaHesap'";
			$del2 = "DELETE FROM bankaHareketleri WHERE bh_transferRefID = '$id' AND bh_olusturanAnaHesap = '$anaHesap'";
			$this->db->query($del1);
			$this->db->query($del2);
			$this->session->set_flashdata('transfer_sil','OK');
			logekle(63,4);
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$this->session->set_flashdata('hata_sil','OK');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function bankadanKasayaTransfer(){
		$data["baslik"] = "Banka / Bankadan Kasaya Transfer";
		$this->load->view("banka/bankadan-kasaya-transfer",$data);
	}

	public function yeniBankadanKasayaTransfer(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$transferRefID = generateUniqID2();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$belgeNo = postval("bankaToKasaTransfer_belgeNo");
		$kasa_id = postval("kasa_id");
		$banka_id = postval("banka_id");
		$tarih = postval("bankaToKasaTransfer_tarih");
		$tutar = postval("bankaToKasaTransfer_tutar");
		$aciklama = postval("bankaToKasaTransfer_aciklama");

		$yeni_tarih = date("Y-m-d", strtotime($tarih));

		$data["kh_kasaID"] = $kasa_id;
		$data["kh_belgeNumarasi"] = $belgeNo;
		$data["kh_turu"] = 13;
		$data["kh_giris"] = $tutar;
		$data["kh_tarih"] = $yeni_tarih;
		$data["kh_aciklama"] = $aciklama;
		$data["kh_transferRefID"] = $transferRefID;

		$data["kh_olusturan"] = $u_id;
		$data["kh_olusturanAnaHesap"] = $anaHesap;
		$data["kh_olusturmaTarihi"] =  $tarihi;
		$data["kh_olusturmaSaati"] = $saati;

		$data_b["bh_bankaID"] = $banka_id;
		$data_b["bh_belgeNumarasi"] = $belgeNo;
		$data_b["bh_turu"] = 12;
		$data_b["bh_cikis"] = $tutar;
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

		$this->session->set_flashdata('bankadan_kasaya_transfer_ok','OK');
		logekle(63,2);
		redirect("banka/bankadan-kasaya-transfer-duzenle/$transferRefID");
	}

	public function bankadanKasayaTransferDuzenle($id){
		$data["baslik"] = "Banka / Bankadan Kasaya Transfer - Düzenle";

		$transferSorgu = "SELECT * FROM kasaHareketleri WHERE kh_transferRefID = '$id'";
		$data["kasaTransfer"] = $this->db->query($transferSorgu)->row();

		$transferSorgu2 = "SELECT * FROM bankaHareketleri WHERE bh_transferRefID = '$id'";
		$data["bankaTransfer"] = $this->db->query($transferSorgu2)->row();

		$this->load->view("banka/bankadan-kasaya-transfer-duzenle",$data);
	}

	public function bankadanKasayaTransfer_Duzenle(){
		$anaHesap = anaHesapBilgisi();

		$transferRefID = postval("bh_transferRefID");

		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$new_transferRefID = generateUniqID2();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$belgeNo = postval("bankaToKasaTransfer_belgeNo");
		$kasa_id = postval("kasa_id");
		$banka_id = postval("banka_id");
		$tarih = postval("bankaToKasaTransfer_tarih");
		$tutar = postval("bankaToKasaTransfer_tutar");
		$aciklama = postval("bankaToKasaTransfer_aciklama");

		$yeni_tarih = date("Y-m-d", strtotime($tarih));

		$data["kh_kasaID"] = $kasa_id;
		$data["kh_belgeNumarasi"] = $belgeNo;
		$data["kh_turu"] = 13;
		$data["kh_giris"] = $tutar;
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
		$data_b["bh_cikis"] = $tutar;
		$data_b["bh_tarih"] = $yeni_tarih;
		$data_b["bh_aciklama"] = $aciklama;
		$data_b["bh_transferRefID"] = $new_transferRefID;

		$data_b["bh_olusturan"] = $u_id;
		$data_b["bh_olusturanAnaHesap"] = $anaHesap;
		$data_b["bh_olusturmaTarihi"] =  $tarihi;
		$data_b["bh_olusturmaSaati"] = $saati;

		$belgeNoKontrolQ = "SELECT * FROM kasaHareketleri WHERE kh_belgeNumarasi = '$belgeNo' AND kh_olusturanAnaHesap = '$anaHesap' AND kh_transferRefID != '$transferRefID'";
		$belgeNoKontrol = $this->db->query($belgeNoKontrolQ)->row();

		$belgeNoKontrolQ2 = "SELECT * FROM bankaHareketleri WHERE bh_belgeNumarasi = '$belgeNo' AND bh_olusturanAnaHesap = '$anaHesap' AND bh_transferRefID != '$transferRefID'";
		$belgeNoKontrol2 = $this->db->query($belgeNoKontrolQ2)->row();

		if($belgeNoKontrol || $belgeNoKontrol2){
			$this->session->set_flashdata('belge_no_mukerrer','OK');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->vt->insert("kasaHareketleri", $data);
		$this->vt->insert("bankaHareketleri",$data_b);

		$this->vt->del("kasaHareketleri","kh_transferRefID",$transferRefID);
		$this->vt->del("bankaHareketleri","bh_transferRefID",$transferRefID);

		$this->session->set_flashdata('bankadan_kasaya_transfer_update','OK');
		logekle(63,3);
		redirect("banka/bankadan-kasaya-transfer-duzenle/$new_transferRefID");
	}
}
