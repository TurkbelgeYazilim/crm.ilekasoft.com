<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckTest extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('vt');
    }

    public function index(){
        echo "CheckTest controller çalışıyor.<br>";
        echo "Tarih: " . date('Y-m-d H:i:s') . "<br>";
        
        // Session kontrolü
        $control = session("r","login");
        if($control){
            echo "Kullanıcı login durumda.<br>";
            $login_info = session("r","login_info");
            if($login_info) {
                $ad_soyad = trim($login_info->kullanici_ad . ' ' . $login_info->kullanici_soyad);
                echo "Kullanıcı: " . $ad_soyad . "<br>";
            }
        } else {
            echo "Kullanıcı login değil.<br>";
        }
        
        // POST verileri kontrol et
        if($this->input->post()) {
            echo "POST veriler:<br>";
            echo "Email: " . postval('u_email') . "<br>";
            echo "Password: " . (postval('u_password') ? 'var' : 'yok') . "<br>";
        }
    }
    
    public function login(){
        echo "Login fonksiyonu çalışıyor.<br>";
        
        // POST kontrolü
        if(!$this->input->post()) {
            echo "POST verisi yok, giris sayfasına yönlendiriliyor.<br>";
            redirect('giris');
            return;
        }
        
        $email = postval('u_email');
        $password = postval('u_password');
        
        echo "Email: " . $email . "<br>";
        echo "Password: " . (empty($password) ? 'boş' : 'var') . "<br>";
        
        // Kullanıcı sorgula
        $query1 = $this->vt->single("kullanicilar",array('kullanici_eposta'=>$email,'kullanici_sifre'=>md5($password)));
        if($query1){
            $ad_soyad = trim($query1->kullanici_ad . ' ' . $query1->kullanici_soyad);
            echo "Kullanıcı bulundu: " . $ad_soyad . "<br>";
            echo "Durum: " . $query1->kullanici_durum . "<br>";
            echo "Ana Hesap ID: " . $query1->kullanici_anaHesapID . "<br>";
        } else {
            echo "Kullanıcı bulunamadı.<br>";
        }
    }
}
