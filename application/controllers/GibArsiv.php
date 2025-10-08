<?php
defined('BASEPATH') or exit('No direct script access allowed');

use furkankadioglu\eFatura\InvoiceManager;
use furkankadioglu\eFatura\Models\Invoice;
use furkankadioglu\eFatura\Interaktif;


class GibArsiv extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');
	}


	public function index()
	{

		$sql = "SELECT * FROM `modulAyarlari` where ma_gibUsername is not null and ma_gibSifre is not null";
		$gibUser = $this->db->query($sql)->result();
		$endDate = date("d-m-Y");
		$startDate = date("d-m-Y", strtotime('-1 day', strtotime($endDate)));

		foreach ($gibUser as $user) {
			$client = new InvoiceManager();
			$client->setCredentials($user->ma_gibUsername, $user->ma_gibSifre);
			$client->connect();
			$invoices = $client->getInvoicesFromAPI($startDate, $endDate);
			$invoices = $invoices["data"];
			$klasorYol = "assets/gib/$user->ma_gibUsername";

			if(!file_exists($klasorYol))
				mkdir("assets/gib/".$user->ma_gibUsername);

			foreach ($invoices as $item) {
				$invoice = $item["ettn"];


				$oldInvoice = new Invoice();
				$oldInvoice->setUuid($invoice);
				$client->setInvoice($oldInvoice)->getInvoiceFromAPI();
				//header('Location:'.$client->getDownloadURL());

				$downloadUrl = $client->getDownloadURL(null, true);

				$file ="assets/gib/".$user->ma_gibUsername."/".$invoice . '.zip';
				file_put_contents($file, fopen($downloadUrl, 'r'));
				header("Content-length: " . filesize($file));
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="'. $file . '"');
				readfile("$file");
			}
			$client->logOutFromAPI();
		}


	}

}
