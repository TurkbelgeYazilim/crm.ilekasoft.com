<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RaporTest extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        echo "Constructor çalıştı<br>";
    }

    public function index()
    {
        echo "Rapor Controller - Index method çalışıyor";
    }

    public function basit_test()
    {
        echo "Basit test method'u çalışıyor - " . date('Y-m-d H:i:s');
    }

    public function gunluk_rapor()
    {
        echo "gunluk_rapor method'u çalışıyor - " . date('Y-m-d H:i:s');
    }
}
