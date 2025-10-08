<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Raporlar extends CI_Controller {



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



	public function index(){

		$data["baslik"] = "Raporlar";

		$this->load->view("raporlar/raporlar",$data);

	}



	public function raporlar(){

		$data["baslik"] = "Raporlar";

		$this->load->view("raporlar/raporlar",$data);

	}



	public function stokRaporlari(){

		$data["baslik"] = "Raporlar / Stok Raporları";

		$anaHesap = anaHesapBilgisi();



		$stokKodu = $this->input->get('stokKodu');

		$stokAdi = $this->input->get('stokAdi');

		$stokGrubu = $this->input->get('stokGrubu');



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

		else{$pagem = 0;/*logekle(6,1);*/}





		if((isset($stokKodu) && !empty($stokKodu)) || (isset($stokAdi) && !empty($stokAdi)) || (isset($stokGrubu) && !empty($stokGrubu)) || (isset($tarihGet) && !empty($tarihGet))){



			if(!empty($stokGrubu)){$sorgu1 = "AND stok_stokGrupKoduID = '$stokGrubu'";}

			else{$sorgu1 = "";}



			if(!empty($tarihGet)){$sorgu2 = "AND stok_olusturmaTarihi BETWEEN '$tarih1' AND '$tarih2'";}

			else{$sorgu2 = "";}



			$countq = "SELECT COUNT(*) as total FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap' AND stok_kodu LIKE '%$stokKodu%' AND stok_ad LIKE '%$stokAdi%' ".$sorgu1." ".$sorgu2." ";

			$countexe = $this->db->query($countq)->row();

			$count = $countexe->total;



			$sorgu = "SELECT * FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap' AND stok_kodu LIKE '%$stokKodu%' AND stok_ad LIKE '%$stokAdi%' ".$sorgu1." ".$sorgu2." ORDER BY stok_id DESC LIMIT $pagem,$limit";

		}else{

			$countq = "SELECT COUNT(*) as total FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap'";

			$countexe = $this->db->query($countq)->row();

			$count = $countexe->total;

			$sorgu = "SELECT * FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap' ORDER BY stok_id DESC LIMIT $pagem,$limit";

		}

		$data["count_of_list"] = $count;



		$this->load->library("pagination");



		$config = array();

		$config["base_url"] = base_url() . "/raporlar/$urim";

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

		$data["stok"] = $this->db->query($sorgu)->result();



		$this->load->view('raporlar/stok-raporlari',$data);

	}



	public function kasaRaporlari(){

		$data["baslik"] = "Raporlar / Kasa Raporları";

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

        $config["base_url"] = base_url() . "/raporlar/$urim";

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



        $this->load->view("raporlar/kasa-raporlari", $data);

	}



	public function cariStokHareketRaporlari(){

		$data["baslik"] = "Raporlar / Cari Stok Hareket Raporları";

		$anaHesap = anaHesapBilgisi();



		$cariBilgisi = $this->input->get('cari');



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

	    else{$pagem = 0;}



	    if((isset($tarihGet) && !empty($tarihGet))){



	        if(!empty($cariBilgisi) && $cariBilgisi != "tumu"){

	    		$kasaQuery = "AND sh_cariID = '$cariBilgisi'";

	    	}



	    	if(!empty($tarihGet)){$sorgu1 = "AND sh_tarih BETWEEN '$tarih1' AND '$tarih2'";}

			else{$sorgu1 = "";}



	        $countq = "SELECT COUNT(*) as total FROM stokHareketleri WHERE sh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery."  ".$sorgu1." ";

	        $countexe = $this->db->query($countq)->row();

	        $count = $countexe->total;



	        $sorgu = "SELECT * FROM stokHareketleri WHERE sh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu1." ORDER BY sh_id DESC LIMIT $pagem,$limit";

	    }else{



	    	if(!empty($cariBilgisi) && $cariBilgisi != "tumu"){

	    		$kasaQuery = "AND sh_cariID = '$cariBilgisi'";

	    	} 



	        $countq = "SELECT COUNT(*) as total FROM stokHareketleri WHERE sh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery."";

	        $countexe = $this->db->query($countq)->row();

	        $count = $countexe->total;

	        $sorgu = "SELECT * FROM stokHareketleri WHERE sh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ORDER BY sh_id DESC LIMIT $pagem,$limit";

	    }



	    $data["count_of_list"] = $count;



	    $this->load->library("pagination");



	    $config = array();

	    $config["base_url"] = base_url() . "/raporlar/$urim";

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

	    $data["cariStokHareketleri"] = $this->db->query($sorgu)->result();

	    $data["toplamHareket"] = $count;



	    $cariQ = "SELECT * FROM cari WHERE cari_id = '$cariBilgisi'";

	    $cariExe = $this->db->query($cariQ)->row();

	    $cariOlusturanAnaHesap = $cariExe->cari_olusturanAnaHesap;



			if($cariExe){

		    if($anaHesap == $cariOlusturanAnaHesap){

		$this->load->view("raporlar/cari-stok-hareket-raporlari",$data);

		}else{

		    	redirect('hata');

		    }

	  	}else{

	  			$this->load->view("cari/cari-hareketleri", $data);

	  	}

	}



	public function giderRaporlari(){

		$data["baslik"] = "Raporlar / Gider Raporları";

		$anaHesap = anaHesapBilgisi();



		$giderTuru = $this->input->get("giderTuru");

		

		$giderKategorileriQ = "SELECT * FROM giderKategorileri WHERE gk_olusturanAnaHesap = '$anaHesap' AND gk_mainID IS NULL";

		$data["giderKategorileri"] = $this->db->query($giderKategorileriQ)->result();



		//$olusturanHesapKim = $data["giderKategorileri"]->gk_olusturanAnaHesap;



		$giderTuruQ = "SELECT * FROM giderKategorileri WHERE gk_id = '$giderTuru' AND gk_olusturanAnaHesap = '$anaHesap' ";

		$data["giderKat"] = $this->db->query($giderTuruQ)->row();



		$olusturanHesapKim = $data["giderKat"]->gk_olusturanAnaHesap;



		if($giderTuru){

			if($anaHesap == $olusturanHesapKim){

				$this->load->view("raporlar/gider-raporlari",$data);

			}else{

				redirect('hata');

			}

		}else{

			$this->load->view("raporlar/gider-raporlari",$data);

		}

	}



	public function kritikStokRaporu(){

		$data["baslik"] = "Azalan Ürünler (Kritik Stok)";



		$anaHesap = anaHesapBilgisi();



		$urim = $this->uri->segment(2);



		$segment = 2;

		$sayfa = $this->input->get("sayfa");



		$page = $sayfa ? $sayfa : 0;

		$limit = 20;



		if($sayfa){$pagem = ($page-1)*$limit;}

		else{$pagem = 0;/*logekle(6,1);*/}



		$countq = "SELECT COUNT(*) as total FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap' AND stok_kritikSeviyesi IS NOT NULL";

		$countexe = $this->db->query($countq)->row();

		$count = $countexe->total;

		$sorgu = "SELECT * FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap' AND stok_kritikSeviyesi IS NOT NULL ORDER BY stok_id DESC LIMIT $pagem,$limit";

	

		$data["count_of_list"] = $count;



		$this->load->library("pagination");



		$config = array();

		$config["base_url"] = base_url() . "/raporlar/$urim";

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

		$data["stok"] = $this->db->query($sorgu)->result();



		$this->load->view("raporlar/kritik-stok-raporu",$data);

	}



	public function bitenStoklarRaporu(){

		$data["baslik"] = "Biten Stoklar";



		$anaHesap = anaHesapBilgisi();



		$urim = $this->uri->segment(2);



		$segment = 2;

		$sayfa = $this->input->get("sayfa");



		$page = $sayfa ? $sayfa : 0;

		$limit = 20;



		if($sayfa){$pagem = ($page-1)*$limit;}

		else{$pagem = 0;/*logekle(6,1);*/}



		$countq = "SELECT COUNT(*) as total FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap'";

		$countexe = $this->db->query($countq)->row();

		$count = $countexe->total;

		$sorgu = "SELECT * FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap' ORDER BY stok_id DESC LIMIT $pagem,$limit";

	

		$data["count_of_list"] = $count;



		$this->load->library("pagination");



		$config = array();

		$config["base_url"] = base_url() . "/raporlar/$urim";

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

		$data["stok"] = $this->db->query($sorgu)->result();



		$this->load->view("raporlar/biten-stoklar-raporu",$data);

	}



	public function enCokSatanlarRaporu(){

		$data["baslik"] = "En Çok Satanlar";



		$anaHesap = anaHesapBilgisi();



		$urim = $this->uri->segment(2);



		$segment = 2;

		$sayfa = $this->input->get("sayfa");



		$page = $sayfa ? $sayfa : 0;

		$limit = 20;



		if($sayfa){$pagem = ($page-1)*$limit;}

		else{$pagem = 0;/*logekle(6,1);*/}



		$countq = "SELECT COUNT(*) as total FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap'";

		$countexe = $this->db->query($countq)->row();

		$count = $countexe->total;

		$sorgu = "SELECT * FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap' ORDER BY stok_id DESC LIMIT $pagem,$limit";

	

		$data["count_of_list"] = $count;



		$this->load->library("pagination");



		$config = array();

		$config["base_url"] = base_url() . "/raporlar/$urim";

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

		$data["stok"] = $this->db->query($sorgu)->result();



		$this->load->view("raporlar/en-cok-satanlar-raporu",$data);

	}



	public function digiturk_personel_ciro_adet(){

		// Yetki kontrolü

		if(!grup_modul_yetkisi_var(1401)){

			redirect("home/hata");

		}



		$data["baslik"] = "Digiturk Personel Ciro/Adet Raporu";

		

		// Tarih filtreleri - Daha geniş varsayılan tarih aralığı

		$baslangic_tarihi = $this->input->get('baslangic_tarihi') ? $this->input->get('baslangic_tarihi') : date('Y-01-01'); // Yılbaşından itibaren

		$bitis_tarihi = $this->input->get('bitis_tarihi') ? $this->input->get('bitis_tarihi') : date('Y-m-d');

		$personel_id = $this->input->get('personel_id') ? $this->input->get('personel_id') : '';

		

		$data['baslangic_tarihi'] = $baslangic_tarihi;

		$data['bitis_tarihi'] = $bitis_tarihi;

		$data['personel_id'] = $personel_id;

		

		// Personel listesi

		$personel_query = "SELECT kullanici_id, CONCAT(kullanici_ad, ' ', kullanici_soyad) AS personel_adi 

						   FROM kullanicilar 

						   WHERE kullanici_durum = 1 

						   ORDER BY kullanici_ad";

		$data['personel_listesi'] = $this->db->query($personel_query)->result();

		

		// Ana rapor sorgusu - Aktivasyon tablosu olmadan

		$sql = "SELECT 

				kg.kg_adi AS kullanici_grubu,

				CONCAT(k.kullanici_ad, ' ', k.kullanici_soyad) AS personel_adi,

				COUNT(sf.satis_id) AS toplam_satis_adedi,

				SUM(sf.satis_genelToplam) AS toplam_ciro

			FROM satisFaturasi sf

			JOIN kullanicilar k ON sf.satis_olusturan = k.kullanici_id

			LEFT JOIN kullanici_grubu kg ON k.grup_id = kg.kg_id

			WHERE sf.satis_olusturmaTarihi BETWEEN ? AND ?";

		

		$params = array($baslangic_tarihi, $bitis_tarihi);

		

		if (!empty($personel_id)) {

			$sql .= " AND k.kullanici_id = ?";

			$params[] = $personel_id;

		}

		

		$sql .= " GROUP BY kg.kg_adi, k.kullanici_ad, k.kullanici_soyad

				  ORDER BY toplam_ciro DESC";

		

		$rapor_verileri = $this->db->query($sql, $params)->result();

		

		$data['rapor_verileri'] = $rapor_verileri;

		

		$this->load->view("raporlar/digiturk-personel-ciro-adet", $data);

	}



	public function digiturk_bolge_muduru_ciro_adet(){

		// Yetki kontrolü

		if(!grup_modul_yetkisi_var(1402)){

			redirect("home/hata");

		}



		$data["baslik"] = "Digiturk Bölge Müdürü ve Personel Ciro/Adet Raporu";

		

		// Tarih filtreleri

		$baslangic_tarihi = $this->input->get('baslangic_tarihi') ? $this->input->get('baslangic_tarihi') : date('Y-m-01');

		$bitis_tarihi = $this->input->get('bitis_tarihi') ? $this->input->get('bitis_tarihi') : date('Y-m-d');

		$personel_id = $this->input->get('personel_id') ? $this->input->get('personel_id') : '';

		

		$data['baslangic_tarihi'] = $baslangic_tarihi;

		$data['bitis_tarihi'] = $bitis_tarihi;

		$data['personel_id'] = $personel_id;

		

		// Personel listesi - sadece grup_id = 6 olanlar (Bölge müdürleri)

		$personel_query = "SELECT kullanici_id, CONCAT(kullanici_ad, ' ', kullanici_soyad) AS personel_adi 

						   FROM kullanicilar 

						   WHERE kullanici_durum = 1 AND grup_id = 6

						   ORDER BY kullanici_ad";

		$data['personel_listesi'] = $this->db->query($personel_query)->result();

		

		// Ana rapor sorgusu - Sadece Bölge müdürleri, kendi + bağlı personellerin toplamı

		$sql = "SELECT 

				bm.kullanici_id,

				kg.kg_adi AS kullanici_grubu,

				CONCAT(bm.kullanici_ad, ' ', bm.kullanici_soyad) AS personel_adi,

				-- Bölge müdürünün kendi satışları

				COALESCE(bm_sales.kendi_satis_adedi, 0) AS kendi_satis_adedi,

				COALESCE(bm_sales.kendi_ciro, 0) AS kendi_ciro,

				-- Bağlı personellerin satışları

				COALESCE(team_sales.personel_satis_adedi, 0) AS personel_satis_adedi,

				COALESCE(team_sales.personel_ciro, 0) AS personel_ciro,

				-- Toplam (kendi + personeller)

				(COALESCE(bm_sales.kendi_satis_adedi, 0) + COALESCE(team_sales.personel_satis_adedi, 0)) AS toplam_satis_adedi,

				(COALESCE(bm_sales.kendi_ciro, 0) + COALESCE(team_sales.personel_ciro, 0)) AS toplam_ciro

			FROM kullanicilar bm

			LEFT JOIN kullanici_grubu kg ON bm.grup_id = kg.kg_id

			-- Bölge müdürünün kendi satışları

			LEFT JOIN (

				SELECT 

					k.kullanici_id,

					COUNT(sf.satis_id) AS kendi_satis_adedi,

					SUM(sf.satis_genelToplam) AS kendi_ciro

				FROM aktivasyon a

				JOIN satisFaturasi sf ON a.aktivasyon_cari_id = sf.satis_cariID

				JOIN kullanicilar k ON sf.satis_olusturan = k.kullanici_id

				WHERE sf.satis_olusturmaTarihi BETWEEN ? AND ?

				AND k.grup_id = 6

				GROUP BY k.kullanici_id

			) bm_sales ON bm.kullanici_id = bm_sales.kullanici_id

			-- Bağlı personellerin satışları

			LEFT JOIN (

				SELECT 

					k.kullanici_sorumluMudur,

					COUNT(sf.satis_id) AS personel_satis_adedi,

					SUM(sf.satis_genelToplam) AS personel_ciro

				FROM aktivasyon a

				JOIN satisFaturasi sf ON a.aktivasyon_cari_id = sf.satis_cariID

				JOIN kullanicilar k ON sf.satis_olusturan = k.kullanici_id

				WHERE sf.satis_olusturmaTarihi BETWEEN ? AND ?

				AND k.kullanici_sorumluMudur IS NOT NULL

				AND k.kullanici_sorumluMudur IN (SELECT kullanici_id FROM kullanicilar WHERE grup_id = 6)

				GROUP BY k.kullanici_sorumluMudur

			) team_sales ON bm.kullanici_id = team_sales.kullanici_sorumluMudur

			WHERE bm.grup_id = 6 AND bm.kullanici_durum = 1";

		

		$params = array($baslangic_tarihi, $bitis_tarihi, $baslangic_tarihi, $bitis_tarihi);

		

		if (!empty($personel_id)) {

			$sql .= " AND bm.kullanici_id = ?";

			$params[] = $personel_id;

		}

		

		$sql .= " ORDER BY toplam_ciro DESC";

		

		$data['rapor_verileri'] = $this->db->query($sql, $params)->result();

		

		$this->load->view("raporlar/digiturk-bolge-muduru-ciro-adet", $data);

	}



	public function digiturk_sehir_ciro_adet(){

		// Yetki kontrolü

		if(!grup_modul_yetkisi_var(1403)){

			redirect("home/hata");

		}



		$data["baslik"] = "Digiturk Şehir Ciro/Adet Raporu";

		

		// Tarih filtreleri - Daha geniş varsayılan tarih aralığı

		$baslangic_tarihi = $this->input->get('baslangic_tarihi') ? $this->input->get('baslangic_tarihi') : date('Y-01-01'); // Yılbaşından itibaren

		$bitis_tarihi = $this->input->get('bitis_tarihi') ? $this->input->get('bitis_tarihi') : date('Y-m-d');

		$sehir_id = $this->input->get('sehir_id') ? $this->input->get('sehir_id') : '';

		

		$data['baslangic_tarihi'] = $baslangic_tarihi;

		$data['bitis_tarihi'] = $bitis_tarihi;

		$data['sehir_id'] = $sehir_id;

		

		// Şehir listesi

		$sehir_query = "SELECT id, il AS sehir_adi 

						FROM iller 

						ORDER BY il";

		$data['sehir_listesi'] = $this->db->query($sehir_query)->result();

		

		// Ana rapor sorgusu - Şehirlere göre satış raporu (Digiturk, S Sport ve TABII ayrı ayrı) - DÜZELTME

		$sql = "SELECT 
			COALESCE(i.il, '(Bilinmiyor)') AS sehir_adi,
			i.id AS cari_il,
			-- Digiturk satış adedi (stok_stokGrupKoduID = 1) - DÜZELTME: COUNT(*) kullan
			COUNT(CASE 
				WHEN st.stok_stokGrupKoduID = 1
				THEN 1 
				ELSE NULL 
			END) AS digiturk_satis_adedi,
			-- Digiturk ciro (stok_stokGrupKoduID = 1)
			COALESCE(SUM(CASE 
				WHEN st.stok_stokGrupKoduID = 1
				THEN sfs.satisStok_fiyatMiktar 
				ELSE 0 
			END), 0) AS digiturk_ciro,
			-- S Sport satış adedi (stok_id = 16)
			COUNT(CASE 
				WHEN st.stok_id = 16
				THEN 1 
				ELSE NULL 
			END) AS ssport_satis_adedi,
			-- S Sport ciro (stok_id = 16)
			COALESCE(SUM(CASE 
				WHEN st.stok_id = 16
				THEN sfs.satisStok_fiyatMiktar 
				ELSE 0 
			END), 0) AS ssport_ciro,
			-- TABII satış adedi (stok_id = 13)
			COUNT(CASE 
				WHEN st.stok_id = 13
				THEN 1 
				ELSE NULL 
			END) AS tabii_satis_adedi,
			-- TABII ciro (stok_id = 13)
			COALESCE(SUM(CASE 
				WHEN st.stok_id = 13
				THEN sfs.satisStok_fiyatMiktar 
				ELSE 0 
			END), 0) AS tabii_ciro,
			-- Toplam satış adedi (Digiturk + S Sport + TABII)
			COUNT(CASE 
				WHEN st.stok_stokGrupKoduID = 1 OR st.stok_id IN (16, 13)
				THEN 1 
				ELSE NULL 
			END) AS toplam_satis_adedi,
			-- Toplam ciro (Digiturk + S Sport + TABII)
			COALESCE(SUM(CASE 
				WHEN st.stok_stokGrupKoduID = 1 OR st.stok_id IN (16, 13)
				THEN sfs.satisStok_fiyatMiktar 
				ELSE 0 
			END), 0) AS toplam_ciro,
			-- Ortak satış adedi - hesaplanacak
			0 AS ortak_satis_adedi
		FROM satisfaturasistok sfs
		JOIN stok st ON st.stok_id = sfs.satisStok_stokID
		JOIN satisfaturasi sf ON sf.satis_id = sfs.satisStok_satisFaturasiID
		JOIN cari c ON c.cari_id = sf.satis_cariID
		LEFT JOIN iller i ON i.id = c.cari_il
		WHERE sf.satis_olusturmaTarihi BETWEEN ? AND ?
		AND (st.stok_stokGrupKoduID = 1 OR st.stok_id IN (16, 13))";

		

		$params = array($baslangic_tarihi, $bitis_tarihi);

		

		if (!empty($sehir_id)) {
			$sql .= " AND i.id = ?";
			$params[] = $sehir_id;
		}

		$sql .= " GROUP BY COALESCE(i.id, 0), COALESCE(i.il, '(Bilinmiyor)')
				  ORDER BY toplam_ciro DESC, sehir_adi";

		

		$rapor_verileri = $this->db->query($sql, $params)->result();

		

		$data['rapor_verileri'] = $rapor_verileri;

		

		$this->load->view("raporlar/digiturk-sehir-ciro-adet", $data);

	}

	public function digiturk_sehir_cari_detay(){
		// AJAX isteği kontrolü - CodeIgniter 3'te $_SERVER kullanılır
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || 
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
			show_404();
		}

		// Yetki kontrolü
		if(!grup_modul_yetkisi_var(1403)){
			echo json_encode(['error' => 'Yetkiniz yok']);
			return;
		}

		$sehir_id = $this->input->post('sehir_id');
		$baslangic_tarihi = $this->input->post('baslangic_tarihi');
		$bitis_tarihi = $this->input->post('bitis_tarihi');
		$product_type = $this->input->post('product_type'); // Yeni parametre

		if (!$baslangic_tarihi || !$bitis_tarihi) {
			echo json_encode(['error' => 'Eksik parametre - baslangic: ' . $baslangic_tarihi . ', bitis: ' . $bitis_tarihi]);
			return;
		}

		try {
			// Eskişehir örneğine göre düzeltilmiş SQL query
			$sql = "SELECT 
					c.cari_ad,
					CASE 
						WHEN LENGTH(c.cari_firmaTelefon) >= 10 THEN
							CONCAT(
								SUBSTRING(c.cari_firmaTelefon, 1, 3), ' ',
								SUBSTRING(c.cari_firmaTelefon, 4, 3), ' ',
								SUBSTRING(c.cari_firmaTelefon, 7, 2), ' ',
								SUBSTRING(c.cari_firmaTelefon, 9, 2)
							)
						ELSE c.cari_firmaTelefon
					END AS cari_firmaTelefon,
					i.il AS il_adi,
					ic.ilce AS ilce_adi,
					st.stok_ad AS urun_tipi,
					CONCAT(k.kullanici_ad, ' ', k.kullanici_soyad) AS personel_adsoyad,
					sfs.satisStok_fiyatMiktar AS toplam_tutar,
					sf.satis_faturaTarihi AS fatura_tarihi
				FROM satisfaturasistok sfs
				JOIN satisfaturasi sf ON sf.satis_id = sfs.satisStok_satisFaturasiID
				JOIN stok st ON st.stok_id = sfs.satisStok_stokID
				JOIN cari c ON c.cari_id = sf.satis_cariID
				JOIN iller i ON i.id = c.cari_il
				JOIN ilceler ic ON ic.id = c.cari_ilce
				LEFT JOIN kullanicilar k ON k.kullanici_id = c.cari_olusturan
				WHERE sf.satis_olusturmaTarihi BETWEEN ? AND ?";
			
			$params = array($baslangic_tarihi, $bitis_tarihi);
			
			// Şehir filtresi varsa ekle
			if (!empty($sehir_id)) {
				$sql .= " AND i.id = ?";
				$params[] = $sehir_id;
			}
			
			// Product type filtrelemesi ekle
			if ($product_type == 'digiturk') {
				$sql .= " AND st.stok_stokGrupKoduID = 1";
			} elseif ($product_type == 'ssport') {
				$sql .= " AND st.stok_id = 16";
			} elseif ($product_type == 'tabii') {
				$sql .= " AND st.stok_id = 13";
			} elseif ($product_type == 'all') {
				$sql .= " AND (st.stok_stokGrupKoduID = 1 OR st.stok_id IN (16, 13))";
			}
			
			$sql .= " ORDER BY sf.satis_faturaTarihi DESC, sfs.satisStok_fiyatMiktar DESC";

			$result = $this->db->query($sql, $params);
			
			if (!$result) {
				echo json_encode(['error' => 'Veritabanı hatası: ' . $this->db->error()['message']]);
				return;
			}
			
			$data = $result->result();

			echo json_encode(['success' => true, 'data' => $data, 'count' => count($data), 'product_type' => $product_type]);
			
		} catch (Exception $e) {
			echo json_encode(['error' => 'Exception: ' . $e->getMessage()]);
		}
	}

}

