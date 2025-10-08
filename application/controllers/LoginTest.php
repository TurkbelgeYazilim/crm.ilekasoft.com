<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginTest extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('vt');
	}

	public function index(){
		echo "<h1>Login Test</h1>";
		echo "<p>Check login durumu: " . (session("r","login") ? "true" : "false") . "</p>";
		echo "<p>Base URL: " . base_url() . "</p>";
		echo "<p>Current URL: " . current_url() . "</p>";
		echo "<p>URI String: " . uri_string() . "</p>";
		
		if(session("r","login")){
			$info = session("r","login_info");
			$ad_soyad = trim($info->kullanici_ad . ' ' . $info->kullanici_soyad);
			echo "<p>Kullanıcı: " . $ad_soyad . "</p>";
			echo "<p>E-posta: " . $info->kullanici_eposta . "</p>";
		}
		
		echo "<hr>";
		echo "<a href='" . base_url('giris') . "'>Giriş Sayfası</a> | ";
		echo "<a href='" . base_url() . "'>Ana Sayfa</a>";
	}
}
