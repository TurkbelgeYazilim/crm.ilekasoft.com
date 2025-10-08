<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VoipTest extends CI_Controller {

	public function __construct(){
		parent::__construct();
		echo "<h2>VoipTest Controller başarıyla yüklendi!</h2>";
	}

	public function index(){
		echo "<h3>Voip Test Sayfası</h3>";
		echo "<p>Bu sayfa çalışıyor!</p>";
		echo "<p>Tarih: " . date('Y-m-d H:i:s') . "</p>";
	}

	public function test(){
		echo "<h3>Test Metodu</h3>";
		echo "<p>Bu test metodu çalışıyor!</p>";
	}
}
?>
