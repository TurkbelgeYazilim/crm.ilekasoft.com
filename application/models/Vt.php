<?php



class Vt extends CI_Model{

	

	function insert($from,$data=array()){

		$result=$this->db->insert($from,$data);

		return $result;

	}

	

	function single($from,$where=array(),$sutun=null,$siralama=null){

		$result = $this->db->from($from)->where($where)->order_by($sutun,$siralama)->get()->row();

		return $result;

	}

	

	function multiple($from,$where=array(),$sutun=null,$siralama=null){

		$result = $this->db->from($from)->where($where)->order_by($sutun,$siralama)->get()->result();

		return $result;

	}

	

	function multiplelike($from,$where,$like=null,$sutun=null,$siralama=null){

		$result = $this->db->from($from)->like($where,$like,'both')->order_by($sutun,$siralama)->get()->result();

		return $result;

	}

	

	function groupby($from,$where=array(),$group){

		$result = $this->db->from($from)->where($where)->group_by($group)->get()->result();

		return $result;

	}

	

	function update($from,$where=array(),$data=array()){

		$result = $this->db->where($where)->update($from,$data);

		return $result;

	}

	

	function del($from,$where,$id){

		$result = $this->db->delete($from,array($where=>$id));

		return $result;

	}

	

	/* public function toplam_kayit()

	{

		return $this->db->count_all_results("products"); // Veriler adlı tablodaki kayıt sayısını döndür

	}



	public function listele($limit, $start)   

	{

		$this->db->limit($limit, $start); // Metoda gelen parametreler ile limit değerlerini gir ve sayfalamaya göre veri getir

		$veriler = $this->db->from("product_categories")->join('products','products.p_cat = product_categories.pc_id')->get(); // Veriler tablosunu çek

		return $veriler->result();  // Sonuçları döndür

	}

	

	public function listele2($limit, $start, $id)   

	{

		$this->db->limit($limit, $start); // Metoda gelen parametreler ile limit değerlerini gir ve sayfalamaya göre veri getir

		$veriler = $this->db->from("product_categories")->where("p_cat",$id)->join('products','products.p_cat = product_categories.pc_id')->get(); // Veriler tablosunu çek



		return $veriler->result();  // Sonuçları döndür

	}

	

	public function tariharaligi($from, $where, $baslangic, $bitis = null)

	{	

		// echo $this->db->from("users")->where("u_createDate BETWEEN '$baslangic' AND '$bitis'")->count_all_results(); 

		

		if($bitis == null){

			$bitis = $baslangic;

		}

		$result = $this->db->from($from)->where("$where BETWEEN '$baslangic' AND '$bitis'")->count_all_results();	

		return $result;

	}*/



	public function getRows($params = array(), $anaHesap = null){

        $this->db->select("*");

        $this->db->from("cari");

        

        // Ana hesap kısıtlaması sadece anaHesap null değilse uygulanır

        if ($anaHesap !== null) {

            $this->db->where("cari_olusturanAnaHesap", $anaHesap);

        }

        

		$this->db->where("cari_durum", true);



        if(array_key_exists("conditions",$params)){

            foreach ($params['conditions'] as $key => $value) {

                $this->db->where($key,$value);

            }

        }

        else if(!empty($params['searchTerm'])){

			//$like="(cari_tckn like '%".$params['searchTerm']."%' or cari_vergiNumarasi like '%".$params['searchTerm']."%' or cari_ad like '%".$params['searchTerm']."%')";

			/*$this->db->like('cari_tckn', $params['searchTerm']);

			$this->db->or_like('cari_vergiNumarasi', $params['searchTerm']);

            $this->db->or_like('cari_ad', $params['searchTerm']);*/

			//$this->db->like($like);

			$this->db->like("cari_ad",$params["searchTerm"]);

		//	$this->db->or_like("cari_tckn",$params["searchTerm"]);

		//	$this->db->or_like("cari_vergiNumarasi",$params["searchTerm"]);





        }

        

        $this->db->order_by('cari_ad', 'asc');

        

        if(array_key_exists("id",$params)){

            $this->db->where('cari_id',$params['id']);

            $query = $this->db->get();

            $result = $query->row_array();

        }else{

            $query = $this->db->get();

            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

        }

        return $result;

    }





	public function getRowsTCKNVKN($params = array(), $anaHesap = null){

		$this->db->select("*");

		$this->db->from("cari");

		

		// Ana hesap kısıtlaması sadece anaHesap null değilse uygulanır

		if ($anaHesap !== null) {

			$this->db->where("cari_olusturanAnaHesap", $anaHesap);

		}

		

		$this->db->where("cari_durum", true);



		if(array_key_exists("conditions",$params)){

			foreach ($params['conditions'] as $key => $value) {

				$this->db->where($key,$value);

			}

		}

		else if(!empty($params['searchTerm'])){

			$this->db->group_start();

			$this->db->like("cari_tckn",$params["searchTerm"]);

			$this->db->or_like("cari_vergiNumarasi",$params["searchTerm"]);

			$this->db->group_end();

		}



		$this->db->order_by('cari_ad', 'asc');



		if(array_key_exists("id",$params)){

			$this->db->where('cari_id',$params['id']);

			$query = $this->db->get();

			$result = $query->row_array();

		}else{

			$query = $this->db->get();

			$result = ($query->num_rows() > 0)?$query->result_array():FALSE;

		}

		return $result;

	}





    public function getRows2($params = array(), $anaHesap = null){

        $this->db->select("*");

        $this->db->from("cari");

        

        // Ana hesap kısıtlaması sadece anaHesap null değilse uygulanır

        if ($anaHesap !== null) {

            $this->db->where("cari_olusturanAnaHesap", $anaHesap);

        }



        if(array_key_exists("conditions",$params)){

            foreach ($params['conditions'] as $key => $value) {

                $this->db->where($key,$value);

            }

        }

        

        if(!empty($params['searchTerm'])){

            $this->db->like('cari_kodu', $params['searchTerm']);

        }

        

        $this->db->order_by('cari_kodu', 'asc');

        

        if(array_key_exists("id",$params)){

            $this->db->where('cari_id',$params['id']);

            $query = $this->db->get();

            $result = $query->row_array();

        }else{

            $query = $this->db->get();

            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

        }

        return $result;

    }

    

    public function getRows3($params = array(), $anaHesap){

        $this->db->select("*");

        $this->db->from("stok");

        $this->db->where("stok_olusturanAnaHesap", $anaHesap);

		$this->db->where("stok_durum", 1);



        if(array_key_exists("conditions",$params)){

            foreach ($params['conditions'] as $key => $value) {

                $this->db->where($key,$value);

            }

        }

        

        if(!empty($params['searchTerm'])){

            $this->db->like('stok_kodu', $params['searchTerm']);

        }

        

        $this->db->order_by('stok_kodu', 'asc');

        

        if(array_key_exists("id",$params)){

            $this->db->where('stok_id',$params['id']);

            $query = $this->db->get();

            $result = $query->row_array();

        }else{

            $query = $this->db->get();

            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

        }

        return $result;

    }

    

    public function getRows4($params = array(), $anaHesap, $isAdmin = false){

        $this->db->select("*");

        $this->db->from("stok");

        

        // Admin grupları için ana hesap kısıtlaması kaldırılıyor

        if (!$isAdmin) {

            $this->db->where("stok_olusturanAnaHesap", $anaHesap);

        }

        

		$this->db->where("stok_durum", 1);



        if(array_key_exists("conditions",$params)){

            foreach ($params['conditions'] as $key => $value) {

                $this->db->where($key,$value);

            }

        }

        

        if(!empty($params['searchTerm'])){

            $this->db->like('stok_ad', $params['searchTerm']);

        }

        

        $this->db->order_by('stok_ad', 'asc');

        

        if(array_key_exists("id",$params)){

            $this->db->where('stok_id',$params['id']);

            $query = $this->db->get();

            $result = $query->row_array();

        }else{

            $query = $this->db->get();

            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

        }

        return $result;

    }



    public function getRows5($params = array(), $anaHesap){

        $this->db->select("*");

        $this->db->from("kasa");

        $this->db->where("kasa_olusturanAnaHesap", $anaHesap);



        if(array_key_exists("conditions",$params)){

            foreach ($params['conditions'] as $key => $value) {

                $this->db->where($key,$value);

            }

        }

        

        if(!empty($params['searchTerm'])){

            $this->db->like('kasa_kodu', $params['searchTerm']);

        }

        

        $this->db->order_by('kasa_kodu', 'asc');

        

        if(array_key_exists("id",$params)){

            $this->db->where('kasa_id',$params['id']);

            $query = $this->db->get();

            $result = $query->row_array();

        }else{

            $query = $this->db->get();

            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

        }

        return $result;

    }



    public function getRows6($params = array(), $anaHesap){

        $this->db->select("*");

        $this->db->from("kasa");

        $this->db->where("kasa_olusturanAnaHesap", $anaHesap);



        if(array_key_exists("conditions",$params)){

            foreach ($params['conditions'] as $key => $value) {

                $this->db->where($key,$value);

            }

        }

        

        if(!empty($params['searchTerm'])){

            $this->db->like('kasa_adi', $params['searchTerm']);

        }

        

        $this->db->order_by('kasa_adi', 'asc');

        

        if(array_key_exists("id",$params)){

            $this->db->where('kasa_id',$params['id']);

            $query = $this->db->get();

            $result = $query->row_array();

        }else{

            $query = $this->db->get();

            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

        }

        return $result;

    }



    public function getRows7($params = array(), $anaHesap){

        $this->db->select("*");

        $this->db->from("banka");

        $this->db->where("banka_olusturanAnaHesap", $anaHesap);



        if(array_key_exists("conditions",$params)){

            foreach ($params['conditions'] as $key => $value) {

                $this->db->where($key,$value);

            }

        }

        

        if(!empty($params['searchTerm'])){

            $this->db->like('banka_hesapNo', $params['searchTerm']);

        }

        

        $this->db->order_by('banka_hesapNo', 'asc');

        

        if(array_key_exists("id",$params)){

            $this->db->where('banka_id',$params['id']);

            $query = $this->db->get();

            $result = $query->row_array();

        }else{

            $query = $this->db->get();

            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

        }

        return $result;

    }



    public function getRows8($params = array(), $anaHesap){

        $this->db->select("*");

        $this->db->from("banka");

        $this->db->where("banka_olusturanAnaHesap", $anaHesap);



        if(array_key_exists("conditions",$params)){

            foreach ($params['conditions'] as $key => $value) {

                $this->db->where($key,$value);

            }

        }

        

        if(!empty($params['searchTerm'])){

            $this->db->like('banka_bankaAd', $params['searchTerm']);

        }

        

        $this->db->order_by('banka_bankaAd', 'asc');

        

        if(array_key_exists("id",$params)){

            $this->db->where('banka_id',$params['id']);

            $query = $this->db->get();

            $result = $query->row_array();

        }else{

            $query = $this->db->get();

            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

        }

        return $result;

    }



	public function getRows9($params = array(), $anaHesap){

		$this->db->select("*");

		$this->db->from("cari");

		$this->db->where("cari_olusturanAnaHesap", $anaHesap);

		$this->db->where("cari_EInvoiceType", 2);



		if(array_key_exists("conditions",$params)){

			foreach ($params['conditions'] as $key => $value) {

				$this->db->where($key,$value);

			}

		}



		if(!empty($params['searchTerm'])){

			$this->db->like('cari_ad', $params['searchTerm']);

		}



		$this->db->order_by('cari_ad', 'asc');



		if(array_key_exists("id",$params)){

			$this->db->where('cari_id',$params['id']);

			$query = $this->db->get();

			$result = $query->row_array();

		}else{

			$query = $this->db->get();

			$result = ($query->num_rows() > 0)?$query->result_array():FALSE;

		}

		return $result;

	}





	public function getRowsEtiket($params = array(), $anaHesap){

		$this->db->select("*");

		$this->db->from("etiketler");

		$this->db->where("etiket_olusturanAnaHesap", $anaHesap);



		if(array_key_exists("conditions",$params)){

			foreach ($params['conditions'] as $key => $value) {

				$this->db->where($key,$value);

			}

		}

		else if(!empty($params['searchTerm'])){

			$this->db->group_start();

			$this->db->like("etiket_adi",$params["searchTerm"]);

			$this->db->group_end();

		}



		$this->db->order_by('etiket_adi', 'asc');



		if(array_key_exists("id",$params)){

			$this->db->where('etiket_id',$params['id']);

			$query = $this->db->get();

			$result = $query->row_array();

		}else{

			$query = $this->db->get();

			$result = ($query->num_rows() > 0)?$query->result_array():FALSE;

		}

		return $result;

	}

}







