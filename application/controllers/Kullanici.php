<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kullanici extends CI_Controller {

  public function __construct(){
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');
		
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

}
