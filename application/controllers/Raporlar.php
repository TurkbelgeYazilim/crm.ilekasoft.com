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
}
