<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eirsaliye extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');

		$control = session("r", "login");

		if (!$control) {
			redirect("check");
		}
	}

	public function GetDespatchAdvice($donem = null, $faturastart = null, $faturaend = null, $faturaNo = null, $vkn = null)
	{
		$dataStart = '{"data": [';
		$data = '';
		$dataEnd = ']
					}';

		$SESSION_ID = getSessionIDizi();

		$ws_despatch = env(IZIEIRSALIYE_URL);

		$compressed = 'N';
		$okuma = false;
		$trace = true;
		$exceptions = false;
		$DATE_TYPE = "ISSUE";
		if ($donem != "null") {
			if ($donem == 0) {

				$endDate = date("Y-m-d");
				$startDate = strtotime('-1 day', strtotime($endDate));
			} else if ($donem == 1) {

				$endDate = date("Y-m-d");
				$startDate = strtotime('-7 day', strtotime($endDate));
			} else if ($donem == 2) {

				$endDate = date("Y-m-d");
				$startDate = date("Y-m-d", strtotime('-30 day', strtotime($endDate)));

			} else if ($donem == 3) {

				$endDate = date("Y-m-d");
				$startDate = strtotime(date("Y") . date("m") . "01");
			} else if ($donem == 4) {

				//1 ay önceki ay
				$month = date("m", strtotime('-1 month', strtotime(date("m"))));
				$startDate = date("Y-M-d", mktime(0, 0, 0, $month, 1, date("Y")));
				$endDate = cal_days_in_month(CAL_GREGORIAN, $month, date("Y"));

			}
		} else {
			if ($faturastart != "null" && $faturaend != "null") {

				$faturastart = explode(".", $faturastart);

				$faturaend = explode(".", $faturaend);

				$endDate = $faturaend[2] . "-" . $faturaend[1] . "-" . $faturaend[0];
				$startDate = $faturastart[2] . "-" . $faturastart[1] . "-" . $faturastart[0];
			}/* else if ($alinmastart != "null" && $alinmaend != "null") {

				$alinmastart = explode(".", $alinmastart);

				$alinmaend = explode(".", $alinmaend);
				$DATE_TYPE = "CREATE";
				$endDate = $alinmaend[2] . "-" . $alinmaend[1] . "-" . $alinmaend[0];
				$startDate = $alinmastart[2] . "-" . $alinmastart[1] . "-" . $alinmastart[0];
			}*/
		}

		$limit = 200;

		$xml_array->REQUEST_HEADER->SESSION_ID = $SESSION_ID;
		$xml_array->REQUEST_HEADER->APPLICATION_NAME = env(APPLICATION_NAME);
		$xml_array->REQUEST_HEADER->COMPRESSED = 'N';

		if ($faturaNo != "" && $faturaNo != null && $faturaNo != "null")
			$xml_array->INVOICE_SEARCH_KEY->ID = $faturaNo;

		if ($startDate != null && $endDate != null) {
			$xml_array->SEARCH_KEY->START_DATE = $startDate;
			$xml_array->SEARCH_KEY->END_DATE = $endDate;
		}

		$xml_array->SEARCH_KEY->READ_INCLUDED = true;
		$xml_array->SEARCH_KEY->DIRECTION = 'IN';

		if ($vkn != "" && $vkn != null && $vkn != "null")
			$xml_array->SEARCH_KEY->SENDER = $vkn;
		$xml_array->HEADER_ONLY = 'Y';

		$client = new SoapClient($ws_despatch, array('trace' => $trace, 'exceptions' => $exceptions));
		$response = $client->GetDespatchAdvice($xml_array);

		$error_short_des = $response->ERROR_TYPE->ERROR_SHORT_DES;

		if ($error_short_des != null || $error_short_des != "") {

			if (isSessionKilled($error_short_des) != 1) {
				generateNewSession();
			} else {}
		} else {
			$link="";
			if (!is_array($response->DESPATCHADVICE)) {

				$list = $response->DESPATCHADVICE;
				$tarihl = $list->DESPATCHADVICEHEADER->ISSUE_DATE;
				$date = date_create($tarihl);
				$tarih = date_format($date, "Y/m/d");
				$tarihlA = $list->DESPATCHADVICEHEADER->CDATE;
				$dateA = date_create($tarihlA);
				$tarihA = date_format($dateA, "d-m-Y");
				$saatA = date_format($dateA, "h:m:s");
				$supplier = $list->DESPATCHADVICEHEADER->SENDER->IDENTIFIER;
				$tutars = $list->DESPATCHADVICEHEADER->AMOUNT->_;
				$tutar = number_format($tutars, 2, ',', '.');
				$birim = $list->DESPATCHADVICEHEADER->PAYABLE_AMOUNT->currencyID;
				$tip = $list->DESPATCHADVICEHEADER->PROFILEID . "-" . $list->DESPATCHADVICEHEADER->TYPE_CODE;
				$durumCode = $list->DESPATCHADVICEHEADER->STATUS_CODE;
				$durum = $list->DESPATCHADVICEHEADER->STATUS;
				$gibDurumCode = $list->DESPATCHADVICEHEADER->GIB_STATUS_CODE;
				$gibDurum = $list->DESPATCHADVICEHEADER->GIB_STATUS_DESCRIPTION;
				$faturano = $list->ID;

				$sqlBelge="select count(*) as say from cariHareketleri where ch_belgeNumarasi='$faturano'";
				$exeBelge=$this->db->query($sqlBelge)->row();

				$sendResponse=0;

				$color = "bg-info-light";
				if ($durumCode == 132) {
					$durum = "ALINDI";
					$color = "bg-success-light";
				} else if ($durumCode == 133) {
					$durum = "ALINDI";
					$color = "bg-success-light";
				} else if ($durumCode == 134) {
					$durum = "ZAMAN AŞIMI OLUŞTU";
					$color = "bg-danger-light";
				} else if ($durumCode == 122) {
					$durum = "KABUL EDİLDİ";
					$color = "bg-success-light";
					$sendResponse=1;
				} else if ($durumCode == 123) {
					$durum = "KABUL İŞLENİYOR";
					$sendResponse=1;
				} else if ($durumCode == 124) {
					$durum = "KABUL GİBDEN YANIT BEKLİYOR";
					$sendResponse=1;
				} else if ($durumCode == 125) {
					$durum = "KABUL ALICIDAN YANIT BEKLİYOR	";
					$sendResponse=1;
				} else if ($durumCode == 126) {
					$durum = "KABUL İŞLEMİ BAŞARISIZ	";
					$color = "bg-danger-light";
					$sendResponse=1;
				} else if ($durumCode == 127) {
					$durum = "RED ALICIDAN YANIT BEKLİYOR";
					$sendResponse=1;
				} else if ($durumCode == 128) {
					$durum = "RED GİBDE YANIT BEKLİYOR";
					$sendResponse=1;
				} else if ($durumCode == 129) {
					$durum = "RED İŞLENİYOR";
					$sendResponse=1;
				} else if ($durumCode == 130) {
					$durum = "REDDEDİLDİ";
					$color = "bg-danger-light";
					$sendResponse=1;
				} else if ($durumCode == 131) {
					$durum = "RED İŞLEMİ BAŞARISIZ";
					$color = "bg-danger-light";
					$sendResponse=1;
				}
				$durum = "<span class='badge " . $color . "'>" . $durumCode . ' - ' . $durum . "</span>";

				$color = "bg-success-light";
				if ($gibDurumCode == 1000) {
					$gibDurum = "ZARF KUYRUĞA EKLENDİ";
					$color = "bg-info-light";
				} else if ($gibDurumCode == 1100) {
					$gibDurum = "ZARF İŞLENİYOR";
					$color = "bg-info-light";
				} else if ($gibDurumCode == 1110) {
					$gibDurum = "ZIP DOSYASI DEĞİL";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1111) {
					$gibDurum = "ZARFZARF ID UZUNLUĞU GEÇERSİZ";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1120) {
					$gibDurum = "	ZARF ARŞİVDEN KOPYALANAMADI	";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1130) {
					$gibDurum = "ZIP AÇILAMADI";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1131) {
					$gibDurum = "ZIP BİR DOSYA İÇERMELİ";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1132) {
					$gibDurum = "XML DOSYASI DEĞİL";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1133) {
					$gibDurum = "ZARF ID VE XML DOSYASININ ADI AYNI OLMALI";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1140) {
					$gibDurum = "DOKUMAN AYRIŞTIRILAMADI";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1141) {
					$gibDurum = "ZARF ID YOK";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1142) {
					$gibDurum = "ZARF ID VE ZIP DOSYASI ADI AYNI OLMALI";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1143) {
					$gibDurum = "GEÇERSİZ VERSİYON";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1150) {
					$gibDurum = "SCHEMATRON KONTROL SONUCU HATALI";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1160) {
					$gibDurum = "	XML SEMA KONTROLÜNDEN GEÇEMEDİ";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1161) {
					$gibDurum = "İMZA SAHİBİ TCKN VKN ALINAMADI";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1162) {
					$gibDurum = "İMZA KAYDEDİLEMEDİ";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1163) {
					$gibDurum = "GÖNDERİLEN ZARF SİSTEMDE DAHA ÖNCE KAYITLI OLAN BİR FATURAYI İÇERMEKTEDİR";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1170) {
					$gibDurum = "YETKİ KONTROL EDİLEMEDİ";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1171) {
					$gibDurum = "GÖNDERİCİ BİRİM YETKİSİ YOK";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1172) {
					$gibDurum = "POSTA KUTUSU YETKİSİ YOK";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1175) {
					$gibDurum = "İMZA YETKİSİ KONTROL EDİLEMEDİ";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1176) {
					$gibDurum = "İMZA SAHİBİ YETKİSİZ";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1177) {
					$gibDurum = "GEÇERSİZ İMZA";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1180) {
					$gibDurum = "ADRES KONTROL EDİLEMEDİ";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1181) {
					$gibDurum = "ADRES BULUNAMADI";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1182) {
					$gibDurum = "KULLANICI EKLENEMEDİ";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1183) {
					$gibDurum = "KULLANICI SİLİNEMEDİ";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1190) {
					$gibDurum = "SİSTEM YANITI HAZIRLANAMADI";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1195) {
					$gibDurum = "SİSTEM HATASI";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1200)
					$gibDurum = "ZARF BAŞARIYLA İŞLENDİ";
				else if ($gibDurumCode == 1210) {
					$gibDurum = "DOKUMAN BULUNAN ADRESE GÖNDERİLEMEDİ";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1215) {
					$gibDurum = "DOKÜMAN GÖNDERİMİ BAŞARISIZ. TEKRAR GÖNDERME SONLANDI";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1220) {
					$gibDurum = "HEDEFTEN SİSTEM YANITI GELMEDİ";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1230) {
					$gibDurum = "HEDEFTEN SİSTEM YANITI BAŞARISIZ GELDİ";
					$color = "bg-danger-light";
				} else if ($gibDurumCode == 1300)
					$gibDurum = "BAŞARIYLA TAMAMLANDI";
				else if ($gibDurumCode == -1) {
					$gibDurum = "FATURA GİB'E GÖNDERİLMEDİ";
					$color = "bg-danger-light";
				}

				$gibDurum = "<span class='badge " . $color . "'>" . $gibDurumCode . ' - ' . $gibDurum . "</span>";

				if($exeBelge->say==0)
					$link ="";
					/*$link ="<a href='efaturaIceAktar/$faturano/' class='btn btn-sm btn-white text-success mr-2'>İçe Aktar</a>";*/
				else $link="";
				if($list->DESPATCHADVICEHEADER->PROFILEID=="TEMELIRSALIYE" && $sendResponse==0)
					/*$link .= "<a href='" . base_url('Edonusum/Efatura/SendInvoiceResponseWithServerSign/' . $faturano . '/KABUL') . "' class='btn btn-sm btn-white text-info mr-2' ><i class='far fa-eye mr-1'></i>Kabul</a><a href='" . base_url('Edonusum/Efatura/SendInvoiceResponseWithServerSign/' . $faturano . '/RED') . "' class='btn btn-sm btn-white text-info mr-2'><i class='far fa-eye mr-1'></i>Red</a>";
				$link .= "<a href='" . base_url('Edonusum/Efatura/GetInvoiceWithType/' . $faturaNo . '/1/efaturaGelen/IN/1') . "' class='btn btn-sm btn-white text-info mr-2' target='_blank'><i class='far fa-eye mr-1'></i>Göster</a><a href='" . base_url('Edonusum/Efatura/GetInvoiceWithType/' . $faturaNo . '/1/efaturaGelen/IN') . "' class='btn btn-sm btn-white text-info mr-2'><i class='fa fa-download mr-1'></i> HTML</a><a href='" . base_url('Edonusum/Efatura/GetInvoiceWithType/' . $faturaNo . '/2/efaturaGelen/IN') . "' class='btn btn-sm btn-white text-info mr-2'><i class='fa fa-download mr-1'></i> XML</a>";*/
					$link ="";
				$data .= '{
					      "fatura": [
					        "' . $tarih . '",
					        "' . $tarihA . '<br>' . $saatA . '",
					        "' . $faturaNo . '",
					        "' . $supplier . '",
					        "' . $tutar . ' ' . $birim . '",
					        "' . $tip . '",
					        "' . $durum . '",
					        "' . $gibDurum . '",
					        "' . $link . '"
					      ]
					      
					    },';
			} else {
				foreach ($response->DESPATCHADVICE as $list) {
					$tarihl = $list->DESPATCHADVICEHEADER->ISSUE_DATE;
					$date = date_create($tarihl);
					$tarih = date_format($date, "Y/m/d");

					$tarihlA = $list->DESPATCHADVICEHEADER->CDATE;
					$dateA = date_create($tarihlA);
					$tarihA = date_format($dateA, "d-m-Y");
					$saatA = date_format($dateA, "h:m:s");
					$faturano = $list->ID;
					$supplier = $list->DESPATCHADVICEHEADER->SENDER->IDENTIFIER;
					$tutars = $list->DESPATCHADVICEHEADER->AMOUNT->_;
					$tutar = number_format($tutars, 2, ',', '.');
					$birim = $list->DESPATCHADVICEHEADER->PAYABLE_AMOUNT->currencyID;
					$tip = $list->DESPATCHADVICEHEADER->PROFILEID . "-" . $list->DESPATCHADVICEHEADER->TYPE_CODE;
					$durumCode = $list->DESPATCHADVICEHEADER->STATUS_CODE;
					$durum = $list->DESPATCHADVICEHEADER->STATUS;
					$gibDurumCode = $list->DESPATCHADVICEHEADER->GIB_STATUS_CODE;
					$gibDurum = $list->DESPATCHADVICEHEADER->GIB_STATUS_DESCRIPTION;

					$sqlBelge="select count(*) as say from cariHareketleri where ch_belgeNumarasi='$faturano'";
					$exeBelge=$this->db->query($sqlBelge)->row();

					$sendResponse=0;

					$color = "bg-info-light";
					if ($durumCode == 132) {
						$durum = "ALINDI";
						$color = "bg-success-light";
					} else if ($durumCode == 133) {
						$durum = "ALINDI";
						$color = "bg-success-light";
					} else if ($durumCode == 134) {
						$durum = "ZAMAN AŞIMI OLUŞTU";
						$color = "bg-danger-light";
					} else if ($durumCode == 122) {
						$durum = "KABUL EDİLDİ";
						$color = "bg-success-light";
						$sendResponse=1;
					} else if ($durumCode == 123) {
						$durum = "KABUL İŞLENİYOR";
						$sendResponse=1;
					} else if ($durumCode == 124) {
						$durum = "KABUL GİBDEN YANIT BEKLİYOR";
						$sendResponse=1;
					} else if ($durumCode == 125) {
						$durum = "KABUL ALICIDAN YANIT BEKLİYOR	";
						$sendResponse=1;
					} else if ($durumCode == 126) {
						$durum = "KABUL İŞLEMİ BAŞARISIZ";
						$sendResponse=1;
						$color = "bg-danger-light";
					} else if ($durumCode == 127) {
						$durum = "RED ALICIDAN YANIT BEKLİYOR";
						$sendResponse=1;
					} else if ($durumCode == 128) {
						$durum = "RED GİBDE YANIT BEKLİYOR";
						$sendResponse=1;
					} else if ($durumCode == 129) {
						$durum = "RED İŞLENİYOR";
						$sendResponse=1;
					} else if ($durumCode == 130) {
						$durum = "REDDEDİLDİ";
						$color = "bg-danger-light";
						$sendResponse=1;
					} else if ($durumCode == 131) {
						$durum = "RED İŞLEMİ BAŞARISIZ";
						$color = "bg-danger-light";
						$sendResponse=1;
					}
					$durum = "<span class='badge " . $color . "'>" . $durumCode . ' - ' . $durum . "</span>";

					$color = "bg-success-light";
					if ($gibDurumCode == 1000) {
						$gibDurum = "ZARF KUYRUĞA EKLENDİ";
						$color = "bg-info-light";
					} else if ($gibDurumCode == 1100) {
						$gibDurum = "ZARF İŞLENİYOR";
						$color = "bg-info-light";
					} else if ($gibDurumCode == 1110) {
						$gibDurum = "ZIP DOSYASI DEĞİL";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1111) {
						$gibDurum = "ZARFZARF ID UZUNLUĞU GEÇERSİZ";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1120) {
						$gibDurum = "	ZARF ARŞİVDEN KOPYALANAMADI	";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1130) {
						$gibDurum = "ZIP AÇILAMADI";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1131) {
						$gibDurum = "ZIP BİR DOSYA İÇERMELİ";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1132) {
						$gibDurum = "XML DOSYASI DEĞİL";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1133) {
						$gibDurum = "ZARF ID VE XML DOSYASININ ADI AYNI OLMALI";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1140) {
						$gibDurum = "DOKUMAN AYRIŞTIRILAMADI";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1141) {
						$gibDurum = "ZARF ID YOK";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1142) {
						$gibDurum = "ZARF ID VE ZIP DOSYASI ADI AYNI OLMALI";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1143) {
						$gibDurum = "GEÇERSİZ VERSİYON";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1150) {
						$gibDurum = "SCHEMATRON KONTROL SONUCU HATALI";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1160) {
						$gibDurum = "	XML SEMA KONTROLÜNDEN GEÇEMEDİ";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1161) {
						$gibDurum = "İMZA SAHİBİ TCKN VKN ALINAMADI";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1162) {
						$gibDurum = "İMZA KAYDEDİLEMEDİ";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1163) {
						$gibDurum = "GÖNDERİLEN ZARF SİSTEMDE DAHA ÖNCE KAYITLI OLAN BİR FATURAYI İÇERMEKTEDİR";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1170) {
						$gibDurum = "YETKİ KONTROL EDİLEMEDİ";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1171) {
						$gibDurum = "GÖNDERİCİ BİRİM YETKİSİ YOK";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1172) {
						$gibDurum = "POSTA KUTUSU YETKİSİ YOK";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1175) {
						$gibDurum = "İMZA YETKİSİ KONTROL EDİLEMEDİ";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1176) {
						$gibDurum = "İMZA SAHİBİ YETKİSİZ";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1177) {
						$gibDurum = "GEÇERSİZ İMZA";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1180) {
						$gibDurum = "ADRES KONTROL EDİLEMEDİ";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1181) {
						$gibDurum = "ADRES BULUNAMADI";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1182) {
						$gibDurum = "KULLANICI EKLENEMEDİ";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1183) {
						$gibDurum = "KULLANICI SİLİNEMEDİ";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1190) {
						$gibDurum = "SİSTEM YANITI HAZIRLANAMADI";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1195) {
						$gibDurum = "SİSTEM HATASI";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1200)
						$gibDurum = "ZARF BAŞARIYLA İŞLENDİ";
					else if ($gibDurumCode == 1210) {
						$gibDurum = "DOKUMAN BULUNAN ADRESE GÖNDERİLEMEDİ";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1215) {
						$gibDurum = "DOKÜMAN GÖNDERİMİ BAŞARISIZ. TEKRAR GÖNDERME SONLANDI";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1220) {
						$gibDurum = "HEDEFTEN SİSTEM YANITI GELMEDİ";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1230) {
						$gibDurum = "HEDEFTEN SİSTEM YANITI BAŞARISIZ GELDİ";
						$color = "bg-danger-light";
					} else if ($gibDurumCode == 1300)
						$gibDurum = "BAŞARIYLA TAMAMLANDI";
					else if ($gibDurumCode == -1) {
						$gibDurum = "FATURA GİB'E GÖNDERİLMEDİ";
						$color = "bg-danger-light";
					}

					$gibDurum = "<span class='badge " . $color . "'>" . $gibDurumCode . ' - ' . $gibDurum . "</span>";

					if($exeBelge->say==0)
						$link ="";
						/*$link ="<a href='efaturaIceAktar/$faturano/' class='btn btn-sm btn-white text-success mr-2'>İçe Aktar</a>";*/

					else $link="";
					if($list->DESPATCHADVICEHEADER->PROFILEID=="TEMELIRSALIYE" && $sendResponse==0)
						$link .= "<a href='".base_url('Edonusum/Eirsaliye/YanitVer')."' class='btn btn-sm btn-white text-info mr-2'><i class='far fa-eye mr-1'></i> Yanıt Ver</a>";
						/*$link .= "<a href='" . base_url('Edonusum/Eirsaliye/SendInvoiceResponseWithServerSign/' . $faturano . '/KABUL') . "' class='btn btn-sm btn-white text-info mr-2' ><i class='far fa-eye mr-1'></i>Kabul</a><a href='" . base_url('Edonusum/Eirsaliye/SendInvoiceResponseWithServerSign/' . $faturano . '/RED') . "' class='btn btn-sm btn-white text-info mr-2' ><i class='far fa-eye mr-1'></i>Red</a>";
					$link .= "<a href='" . base_url('Edonusum/Eirsaliye/GetInvoiceWithType/' . $faturano . '/1/efaturaGelen/IN/1') . "' class='btn btn-sm btn-white text-info mr-2' target='_blank'><i class='far fa-eye mr-1'></i>Göster</a><a href='" . base_url('Edonusum/Eirsaliye/GetInvoiceWithType/' . $faturano . '/1/eirsaliyeGelen/IN') . "' class='btn btn-sm btn-white text-info mr-2'><i class='fa fa-download mr-1'></i> HTML</a><a href='" . base_url('Edonusum/Eirsaliye/GetInvoiceWithType/' . $faturano . '/2/eirsaliyeGelen/IN') . "' class='btn btn-sm btn-white text-info mr-2'><i class='fa fa-download mr-1'></i> XML</a>";*/
					$data .= '{
					      "fatura": [
					        "' . $tarih . '",
					        "' . $tarihA . '<br>' . $saatA . '",
					        "' . $faturano . '",
					        "' . $supplier . '",
					        "' . $tutar . ' ' . $birim . '",
					        "' . $tip . '",
					        "' . $durum . '",
					        "' . $gibDurum . '",
					        "' . $link . '"
					      ]
					    },';

				}
			}
		}
		$data = trim($data, ",");
		echo $dataStart . $data . $dataEnd;
	}

	public function GetDespatchAdviceWithType($id, $tip, $page, $direction, $view = null)
	{
		//getdespatchadvice <CONTENT_TYPE>HTML</CONTENT_TYPE> ile alınır
	}

	public function SendDespatchAdvice(){
		$anaHesap = anaHesapBilgisi();

		$satis_id = postval("satis_id");
		$seri = postval("normal");
		$guid = getGUID();

		$satisFaturasi = $this->db->query("SELECT * FROM satisFaturasi WHERE satis_id = '$satis_id' ")->row();
		$satisFaturasiStok = $this->db->query("SELECT * FROM satisFaturasiStok WHERE satisStok_satisFaturasiID = '$satis_id' ")->result();
		$irsaliyeBilgileri = $this->db->query("SELECT * FROM irsaliye_bilgileri WHERE irs_faturaID = '$satis_id'")->row();

		$seriYonetimi = $this->db->query("SELECT * FROM seriYonetimi WHERE seri_id = '$seri'")->row();

		$genelToplam = $satisFaturasi->satis_genelToplam;

		$faturaNo = $satisFaturasi->satis_faturaNo;
		$cariNo = $satisFaturasi->satis_cariID;


		$alici = $this->db->query("SELECT * FROM cari WHERE cari_id = '$cariNo'")->row();
		$cari_firmaEPosta = $alici->cari_firmaEPosta;

		$serioneki = $seriYonetimi->seri_seriOnEki;
		$seriYili = $seriYonetimi->seri_seriYili;
		$seriSiraNo = $seriYonetimi->seri_siraNo;

		$yeniFaturaNumarasi = $serioneki . "" . $seriYili . "" . sprintf('%09d', $seriSiraNo);

		header('Content-type: text/json');

		$dosya = fopen("veri.xml", "w");

		$gonderici = $this->db->query("SELECT * FROM ayarlar WHERE ayarlar_id = '$anaHesap'")->row();
		$g_il = $this->db->query("SELECT * FROM iller WHERE id = '$gonderici->ayarlar_il' ")->row();
		$g_ilce = $this->db->query("SELECT * FROM ilceler WHERE id = '$gonderici->ayarlar_ilce' ")->row();

		$a_il = $this->db->query("SELECT * FROM iller WHERE id = '$alici->cari_il' ")->row();
		$a_ilce = $this->db->query("SELECT * FROM ilceler WHERE id = '$alici->cari_ilce' ")->row();

		$LineCount = $this->db->query("SELECT COUNT(*) as total FROM satisFaturasiStok WHERE satisStok_satisFaturasiID = '$satis_id'")->row();

		if ($satisFaturasi->satis_paraBirimi == "1")
			$paraBirimi = "TRY";
		if ($satisFaturasi->satis_paraBirimi == "2")
			$paraBirimi = "USD";
		if ($satisFaturasi->satis_paraBirimi == "3")
			$paraBirimi = "EUR";
		if ($satisFaturasi->satis_paraBirimi == "4")
			$paraBirimi = "GBP";

		$ProfileID = "TEMELIRSALIYE";
		$new_eFaturaTip = "SEVK";

		$xslt = "";
		if ($gonderici->ayarlar_irsaliyeXSLT != null)
			$xslt = $gonderici->ayarlar_irsaliyeXSLT;

		if ($xslt == "")
			$this->session->set_flashdata('fatura_xslt_error', 'OK');
		else {
			$information = array(
				"UBLVersionID" => "2.1",
				"CustomizationID" => "TR1.2.1",
				"ProfileID" => $ProfileID,
				"ID" => $yeniFaturaNumarasi,
				"CopyIndicator" => "false",
				"UUID" => $guid,
				"IssueDate" => date("Y-m-d"),
				"IssueTime" => date("H:i:s"),
				"DespatchAdviceTypeCode" => $new_eFaturaTip,
				"Note1" => $satisFaturasi->satis_aciklama,
				"LineCountNumeric" => $LineCount->total,
				"XSLT" => $xslt);

			$ASP_PostalAddress_Country_Name = "Türkiye";
			$ACP_PostalAddress_Country_Name = "Türkiye";

			$veri = '<DespatchAdvice xmlns="urn:oasis:names:specification:ubl:schema:xsd:DespatchAdvice-2" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:n4="http://www.altova.com/samplexml/other-namespace" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="urn:oasis:names:specification:ubl:schema:xsd:DespatchAdvice-2 ../xsdrt/maindoc/UBL-DespatchAdvice-2.1.xsd">';
			$veri .= UBLExtensions();
			$veri .= UBLSettingsDespatch($information);
			$veri .= UBLSignatureDespatch($information["ID"]);
			$veri .= UBLAccountingSuplierPartyDespatch($gonderici, $g_il->il, $g_ilce->ilce, $ASP_PostalAddress_Country_Name);
			$veri .= UBLAccountingCustomerPartyDespatch($alici, $a_il->il, $a_ilce->ilce, $ACP_PostalAddress_Country_Name);
			$veri .= UBLShipment($irsaliyeBilgileri,$genelToplam);
			$veri .= UBLDespatchLine($satisFaturasiStok, $paraBirimi);

			$veri .= '</DespatchAdvice>';

			$yaz = fputs($dosya, $veri);
			ini_set("soap.wsdl_cache_enabled", "0");

			$SESSION_ID = getSessionIDizi();
			$ws_despatch = env(IZIEIRSALIYE_URL);

			$content = file_get_contents(env(VERI_XML));

			$Request->REQUEST_HEADER->SESSION_ID = $SESSION_ID;
			$Request->REQUEST_HEADER->COMPRESSED = "N";
			$Request->DESPATCHADVICE->DESPATCHADVICEHEADER->RECEIVER->VKN = "4840847211";
			$Request->DESPATCHADVICE->DESPATCHADVICEHEADER->RECEIVER->ALIAS = "	urn:mail:defaultpk@izibiz.com.tr";
			$Request->DESPATCHADVICE->CONTENT = $content;

			$client_despatch = new SoapClient($ws_despatch);

			$sendF = $client_despatch->SendDespatchAdvice($Request);

			$error_short_des = $sendF->ERROR_TYPE->ERROR_SHORT_DES;

			if ($error_short_des == null || $error_short_des == "") {
				$updateQ = "UPDATE satisFaturasi SET satis_faturaDurum = 2 WHERE satis_id = '$satis_id'";
				$this->db->query($updateQ);

				if ($faturaNo == "") {
					$updateQ = "UPDATE satisFaturasi SET satis_faturaNo = '$yeniFaturaNumarasi',satis_GUID='$guid' WHERE satis_id = '$satis_id'";
					$this->db->query($updateQ);

					$seriSiraNoYeni = $seriSiraNo + 1;

					$updateQ2 = "UPDATE seriYonetimi SET seri_siraNo = '$seriSiraNoYeni' WHERE seri_id = '$seri'";
					$this->db->query($updateQ2);
				}

				$this->session->set_flashdata('irsaliye_gonder_ok', 'OK');
				logekle(65, 2);

			} else {
				if (isSessionKilled($error_short_des) == 1) {
					generateNewSession();
					$this->SendDespatchAdvice();
				} else {
					$this->session->set_flashdata('fatura_liste_error', 'OK');
					$this->session->set_flashdata('error', $error_short_des);
				}

				$updateQ = "UPDATE satisFaturasi SET satis_faturaNo = null,satis_faturaDurum=1,satis_GUID=null WHERE satis_id = '$satis_id'";
				$this->db->query($updateQ);
			}
		}

		redirect('fatura/eirsaliyeGiden');
	}
}
