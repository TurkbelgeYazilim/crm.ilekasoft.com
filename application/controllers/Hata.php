<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hata extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('vt');
	}

	public function hata(){
		$this->load->view('hata2');
	}

	public function hata2(){
		$this->load->view('hata3');
	}

}
