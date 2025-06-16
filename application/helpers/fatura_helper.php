<?php

function auth($username, $password)
{
	$ci = get_instance();

	$ws = env('AUTH_URL');

	$req["USER_NAME"] = $username;
	$req["PASSWORD"] = $password;

	$RequestHeader["SESSION_ID"] = "-1";
	$RequestHeader["APPLICATION_NAME"] = env('APPLICATION_NAME');

	$req["REQUEST_HEADER"] = $RequestHeader;

	try {
		$client = new SoapClient($ws, array('trace' => true, 'exceptions' => true));
		$response = $client->Login($req);
		$session_ID = $response->SESSION_ID;
		return $session_ID;
	} catch (SoapFault $e) {
		$session_ID = "HATA";
		return $session_ID;
		//redirect("Hata/hata");die;
		//return $e -> getMessage ();
	}
}




function generateNewSession()
{
	$ci = get_instance();

	$control2 = session("r", "login_info");
	$u_id = $control2->kullanici_id;
	$anaHesap = anaHesapBilgisi();
	$modulQ = "SELECT * FROM firmaModulleri WHERE firmaModul_firmaID = '$anaHesap' AND firmaModul_moduleID = 1 ";
	$modulExe = $ci->db->query($modulQ)->row();
	if ($modulExe) {
		$faturaGirisSorgulaQ = "SELECT * FROM modulAyarlari WHERE ma_olusturanAnaHesap = '$anaHesap' AND ma_modulID = 1";
		$faturaGirisSorgula = $ci->db->query($faturaGirisSorgulaQ)->row();

		$auth = auth($faturaGirisSorgula->ma_efaturaUsername, $faturaGirisSorgula->ma_efaturaSifre);

		session("w", "auth", $auth);
		$ses = session("r", "auth");
		$datak["kullanici_belgeSessionID"] = $ses;

		$ci->vt->update('kullanicilar', array('kullanici_id' => $u_id), $datak);
	}

}

function login()
{
    	$ws = 'https://authenticationws.turkbelge.com.tr/AuthenticationWS?wsdl';

		$trace = true;
		$exceptions = false;
		$anaHesap = anaHesapBilgisi();
		
        $ci = get_instance();
		$faturaGirisSorgulaQ = "SELECT * FROM modulAyarlari WHERE ma_olusturanAnaHesap = '$anaHesap' AND ma_modulID = 1";
		$faturaGirisSorgula = $ci->db->query($faturaGirisSorgulaQ)->row();

		$xml_array -> REQUEST_HEADER -> SESSION_ID  = '-1';
		$xml_array -> USER_NAME = $faturaGirisSorgula->ma_efaturaUsername;
		$xml_array -> PASSWORD = $faturaGirisSorgula->ma_efaturaSifre;
		

		try{
			$client = new SoapClient($ws, array('trace' => $trace, 'exceptions' => $exceptions));

/*			var_dump($client->__getFunctions());
			var_dump($client->__getTypes());
			//print("<pre>".print_r($client->__getTypes(),true)."</pre>");
*/
			$response = $client->Login($xml_array);

	$session_ID=$response->SESSION_ID;

		return $session_ID;

			//echo $response->faultstring;
		}catch (SoapFault $e){
			/*echo "Error!";
			echo $e -> getMessage ();
			echo 'Last response: '. $client->__getLastResponse();*/
			return 0;
		}
}


function getSessionID()
{
	$control2 = session("r", "login_info");
	$u_id = $control2->kullanici_id;
	$ci = get_instance();

	$sorgu = "SELECT * FROM kullanicilar WHERE kullanici_id = '$u_id'";
	$result = $ci->db->query($sorgu)->row();
	$session = $result->kullanici_belgeSessionID;
	
	return $session;
}

function isSessionKilled($error_short_des)
{
	$word = "Aktif session bulunamadı";
	if (strpos($error_short_des, $word) !== false) {

		return 1;//word bulunduğu için session koptu demektir, 1 döner.
	} else {

		return 0;//word bulunamadığı için session devam ediyordur.
	}
}

function UBLExtensions()//efatura da bulunan xml kodları
{
	$Extensions = '<ext:UBLExtensions>
		<ext:UBLExtension>
			<ext:ExtensionContent/>
		</ext:UBLExtension>
	</ext:UBLExtensions>';

	return $Extensions;
}

function UBLSettings($information, $satis_id)//ubl ayarları
{

	$ci = get_instance();
	$Settings = '<cbc:UBLVersionID>' . $information["UBLVersionID"] . '</cbc:UBLVersionID>
	<cbc:CustomizationID>' . $information["CustomizationID"] . '</cbc:CustomizationID>
	<cbc:ProfileID>' . $information["ProfileID"] . '</cbc:ProfileID>
	<cbc:ID>' . $information["ID"] . '</cbc:ID>
	<cbc:CopyIndicator>' . $information["CopyIndicator"] . '</cbc:CopyIndicator>
	<cbc:UUID>' . $information["UUID"] . '</cbc:UUID>
	<cbc:IssueDate>' . $information["IssueDate"] . '</cbc:IssueDate>
	<cbc:IssueTime>' . $information["IssueTime"] . '</cbc:IssueTime>
	<cbc:InvoiceTypeCode>' . $information["InvoiceTypeCode"] . '</cbc:InvoiceTypeCode>';
	if ($information["Note1"] != "")
		$Settings .= '<cbc:Note>' . $information["Note1"] . '</cbc:Note>';
	$Settings .= '<cbc:DocumentCurrencyCode>' . $information["DocumentCurrencyCode"] . '</cbc:DocumentCurrencyCode>
	<cbc:LineCountNumeric>' . $information["LineCountNumeric"] . '</cbc:LineCountNumeric>';

	if ($information["InvoiceTypeCode"] == "IADE")
		$Settings .= UBLBillingReference($satis_id);

	$Settings .= '<cac:AdditionalDocumentReference>
		<cbc:ID>' . $information["UUID"] . '</cbc:ID>
		<cbc:IssueDate>' . $information["IssueDate"] . '</cbc:IssueDate>
		<cbc:DocumentType>XSLT</cbc:DocumentType>
		<cac:Attachment>
			<cbc:EmbeddedDocumentBinaryObject characterSetCode="UTF-8" encodingCode="Base64" filename="DMY2018625142607.xslt" mimeCode="application/xml">' . $information["XSLT"] . '</cbc:EmbeddedDocumentBinaryObject>
		</cac:Attachment>
	</cac:AdditionalDocumentReference>';

	return $Settings;
}

function UBLAdditionalDocumentReference($gonderim_sekli)//e-arşiv gönderim şekli
{
	$AdditionalDocumentReference='<cac:AdditionalDocumentReference>
		<cbc:ID>1</cbc:ID>
		<cbc:IssueDate>'.$gonderim_sekli["IssueDate"].'</cbc:IssueDate>
		<cbc:DocumentTypeCode>'.$gonderim_sekli["DocumentTypeCode"].'</cbc:DocumentTypeCode>
		<cbc:DocumentType>'.$gonderim_sekli["DocumentType"].'</cbc:DocumentType>
	</cac:AdditionalDocumentReference>';
	return $AdditionalDocumentReference;

}

function UBLBillingReference($satis_id)//iade faturası xml kodları
{
	$ci = get_instance();
	$BillingReference = "";
	$faturanoQuery = "select * from iade_fatura_numaralari where satis_id=" . $satis_id;
	$faturanoExe = $ci->db->query($faturanoQuery)->result();

	foreach ($faturanoExe as $item) {
		$BillingReference .= '<cac:BillingReference>
						<cac:InvoiceDocumentReference>
							<cbc:ID>' . $item->fatura_numarasi . '</cbc:ID>
							<cbc:IssueDate>' . $item->tarih . '</cbc:IssueDate>
							<cbc:DocumentTypeCode>IADE</cbc:DocumentTypeCode>
						</cac:InvoiceDocumentReference>
					</cac:BillingReference>';
	}
	return $BillingReference;

}

function UBLSignature($ID)//Bu elemanda faturada kullanılan mali mühür ve/veya elektronik imza ile sertifikalara ilişkin bilgilere yer verilecektir.
{

	$ci = get_instance();
	$Signature = '<cac:Signature>
					<cbc:ID schemeID="VKN_TCKN">4710710430</cbc:ID>
					<cac:SignatoryParty>
						<cac:PartyIdentification>
							<cbc:ID schemeID="VKN">4710710430</cbc:ID>
						</cac:PartyIdentification>
						<cac:PostalAddress>
							<cbc:StreetName>Şair Eşref Bulvarı</cbc:StreetName>
							<cbc:BuildingName/>
							<cbc:BuildingNumber>31/A</cbc:BuildingNumber>
							<cbc:CitySubdivisionName>KONAK</cbc:CitySubdivisionName>
							<cbc:CityName>IZMIR</cbc:CityName>
							<cbc:PostalZone>35270</cbc:PostalZone>
							<cbc:Region>KONAK</cbc:Region>
							<cac:Country>
								<cbc:Name>TR</cbc:Name>
							</cac:Country>
						</cac:PostalAddress>
					</cac:SignatoryParty>
					<cac:DigitalSignatureAttachment>
						<cac:ExternalReference>
							<cbc:URI>#Signature_' . $ID . '</cbc:URI>
						</cac:ExternalReference>
					</cac:DigitalSignatureAttachment>
				</cac:Signature>';
	return $Signature;

}

function UBLAccountingSuplierParty($gonderici, $g_il, $g_ilce, $ASP_PostalAddress_Country_Name)//Bu elemanda faturayı düzenleyen tarafın bilgileri yer alacaktır.
{

	$ci = get_instance();
	$vkntckn="";
	if(strlen($gonderici->ayarlar_vergiNo)==10){
		$vkntckn='<cbc:ID schemeID="VKN">' . $gonderici->ayarlar_vergiNo . '</cbc:ID>';
		$person = '';}
	else{
		$vkntckn='<cbc:ID schemeID="TCKN">' . $gonderici->ayarlar_vergiNo . '</cbc:ID>';
		$person = '<cac:Person>
						<cbc:FirstName>' . $gonderici->ayarlar_firmaAd. '</cbc:FirstName>
						<cbc:FamilyName>.</cbc:FamilyName>
					</cac:Person>';
	}

	$AccountingSuplierParty = '<cac:AccountingSupplierParty>
								<cac:Party>
									<cbc:WebsiteURI>' . $gonderici->ayarlar_website . '</cbc:WebsiteURI>
									<cac:PartyIdentification>
										 '.$vkntckn.'
									</cac:PartyIdentification>
									<cac:PartyName>
										<cbc:Name>' . $gonderici->ayarlar_firmaAd . '</cbc:Name>
									</cac:PartyName>
									<cac:PostalAddress>
										<cbc:StreetName>' . $gonderici->ayarlar_adres . '</cbc:StreetName>
										<cbc:BuildingName/>
										<cbc:BuildingNumber/>
										<cbc:CitySubdivisionName>' . $g_ilce . '</cbc:CitySubdivisionName>
										<cbc:CityName>' . $g_il . '</cbc:CityName>
										<cbc:PostalZone/>
										<cbc:Region>' . $g_ilce . '</cbc:Region>
										<cac:Country>
											<cbc:Name>' . $ASP_PostalAddress_Country_Name . '</cbc:Name>
										</cac:Country>
									</cac:PostalAddress>
									<cac:PartyTaxScheme>
										<cac:TaxScheme>
											<cbc:Name>' . $gonderici->ayarlar_vergiDairesi . '</cbc:Name>
										</cac:TaxScheme>
									</cac:PartyTaxScheme>
									<cac:Contact>
										<cbc:Telephone>' . $gonderici->ayarlar_telefon . '</cbc:Telephone>
										<cbc:Telefax/>
										<cbc:ElectronicMail>' . $gonderici->ayarlar_eposta . '</cbc:ElectronicMail>
									</cac:Contact>
								'.$person.'
								</cac:Party>
							</cac:AccountingSupplierParty>';

	return $AccountingSuplierParty;
}

function UBLAccountingCustomerParty($alici, $a_il, $a_ilce, $ACP_PostalAddress_Country_Name)//Bu elemanda faturayı alan tarafın bilgileri yer alacaktır.
{

	$ci = get_instance();
	$AccountingCustomerParty = '<cac:AccountingCustomerParty>
								<cac:Party>';
	if ($alici->cari_tckn != null)
		$AccountingCustomerParty .= '<cac:PartyIdentification><cbc:ID schemeID="TCKN">' . $alici->cari_tckn . '</cbc:ID></cac:PartyIdentification>';
	else if ($alici->cari_vergiNumarasi != null)
		$AccountingCustomerParty .= '<cac:PartyIdentification><cbc:ID schemeID="VKN">' . $alici->cari_vergiNumarasi . '</cbc:ID></cac:PartyIdentification>';

	if($alici->cari_soyad==null){
		$soyad=".";
		$person2 = '';}
	else{
		$soyad=$alici->cari_soyad;
		$person2  = '<cac:Person>
						<cbc:FirstName>' . $alici->cari_ad . '</cbc:FirstName>
						<cbc:FamilyName>' . $soyad . '</cbc:FamilyName>
					</cac:Person>';
	}


	$AccountingCustomerParty .= '<cac:PartyName>
									<cbc:Name>' . $alici->cari_ad . ' ' . $soyad . '</cbc:Name>
								</cac:PartyName>
								<cac:PostalAddress>
									<cbc:StreetName>' . $alici->cari_adres . '</cbc:StreetName>
									<cbc:BuildingName/>
									<cbc:BuildingNumber/>
									<cbc:CitySubdivisionName>' . $a_ilce . '</cbc:CitySubdivisionName>
									<cbc:CityName>' . $a_il . '</cbc:CityName>
									<cbc:PostalZone/>
									<cbc:Region>' . $a_ilce . '</cbc:Region>
									<cac:Country>
										<cbc:Name>' . $ACP_PostalAddress_Country_Name . '</cbc:Name>
									</cac:Country>
								</cac:PostalAddress>
								<cac:PartyTaxScheme>
									<cac:TaxScheme>
										<cbc:Name>' . $alici->cari_vergiDairesi . '</cbc:Name>
									</cac:TaxScheme>
								</cac:PartyTaxScheme>
								<cac:Contact>
									<cbc:Telephone>' . $alici->cari_firmaTelefon . '</cbc:Telephone>
									<cbc:Telefax/>
									<cbc:ElectronicMail>' . $alici->cari_firmaEPosta . '</cbc:ElectronicMail>
								</cac:Contact>
								'.$person2.'
							</cac:Party>
						</cac:AccountingCustomerParty>';
	return $AccountingCustomerParty;
}

function UBLPricingExchangeRate($paraBirimi, $guncelKur)//Bu elemana fatura üzerinde yer alan mal veya hizmet bedellerinin “Belge Para Birimi” dışında başka bir para birimi ile gösterilmesi halinde ilgili döviz kuru yazılacaktır.

{
	$PricingExchangeRate = '<cac:PricingExchangeRate>
		<cbc:SourceCurrencyCode listAgencyName="United Nations Economic Commission for Europe" listID="ISO 4217 Alpha" listName="Currency" listVersionID="2001">' . $paraBirimi . '</cbc:SourceCurrencyCode>
		<cbc:TargetCurrencyCode listAgencyName="United Nations Economic Commission for Europe" listID="ISO 4217 Alpha" listName="Currency" listVersionID="2001">TRY</cbc:TargetCurrencyCode>
		<cbc:CalculationRate>' . $guncelKur . '</cbc:CalculationRate>
	</cac:PricingExchangeRate>';
	return $PricingExchangeRate;
}

function UBLAllowanceCharge($satis_id, $satis_araToplam, $paraBirimi, $satisFaturasiStok)//Bu eleman fatura bütünü üzerinden iskonto veya artırım yapılması halinde kullanılacaktır
{
	$ci = get_instance();

	$genelIskontoQ = "select * from genel_iskonto where iskonto_satis_id=" . $satis_id;
	$genelIskontoExe = $ci->db->query($genelIskontoQ)->result();

	$AllowanceCharge = '';
	$iskontoSayac = 1;
	$araToplam = 0;
	/*
	$fiyatQ = "SELECT sum(satisStok_indirimTutari) as satisStok_indirimTutari,sum(satisStok_fiyatMiktar) as fiyatToplam FROM satisFaturasiStok where satisStok_satisFaturasiID=".$satis_id." " ;
	$fiyatExe=$ci->db->query($fiyatQ)->row();
	$fiyat=$fiyatExe->fiyatToplam;
	if($fiyatExe->satisStok_indirimTutari!=0)
		$fiyat=$fiyat-$fiyatExe->satisStok_indirimTutari;*/


	$fiyatQ = "SELECT   sum(satisStok_indirimTutari) as satisStok_indirimTutari,sum(satisStok_fiyatMiktar) as fiyatToplam,sum(satisStok_satirIskonto) as AllowanceTotalAmount FROM `satisFaturasiStok` where satisStok_satisFaturasiID=" . $satis_id;
	$fiyatExe = $ci->db->query($fiyatQ)->row();
	$fiyat = $fiyatExe->fiyatToplam-$fiyatExe->AllowanceTotalAmount;

	foreach ($genelIskontoExe as $item) {
		$oran=$fiyat*$item->iskonto_tutar/100;
		$AllowanceCharge.='<cac:AllowanceCharge>
							<cbc:ChargeIndicator>false</cbc:ChargeIndicator>
							<cbc:AllowanceChargeReason>'.$item->iskonto_sebep.'</cbc:AllowanceChargeReason>
							<cbc:MultiplierFactorNumeric>'.$item->iskonto_tutar.'</cbc:MultiplierFactorNumeric>
							<cbc:SequenceNumeric>'.$iskontoSayac.'</cbc:SequenceNumeric>
							<cbc:Amount currencyID="'.$paraBirimi.'">'.round($oran,2).'</cbc:Amount>
							<cbc:BaseAmount currencyID="'.$paraBirimi.'">'.round($fiyat,2).'</cbc:BaseAmount>
						</cac:AllowanceCharge>';
		$iskontoSayac++;
		$fiyat=$fiyat-$oran;
	}

	return $AllowanceCharge;
}

function UBLDelivery($internetTip)
{
	$DELIVERY = '<cac:Delivery>
						<cac:CarrierParty>
							<cac:PartyIdentification>';
	if ($internetTip["TasiyanTip"] == "vkn") {
		$DELIVERY .= '<cbc:ID schemeID="VKN">' . $internetTip["Tasiyan_VKN_TCKN"] . '</cbc:ID>';
		$DELIVERY .= '</cac:PartyIdentification><cac:PartyName>
				<cbc:Name>' . $internetTip["Tasiyan_Unvan"] . '</cbc:Name>
			</cac:PartyName>';
	} else
		$DELIVERY .= '<cbc:ID schemeID="TCKN">' . $internetTip["Tasiyan_VKN_TCKN"] . '</cbc:ID>
		</cac:PartyIdentification><cac:PartyName>
				<cbc:Name>'. $internetTip["Tasiyan_Unvan"] .'</cbc:Name>
			</cac:PartyName>';
	$DELIVERY .= '
							<cac:PostalAddress>
								<cbc:StreetName> </cbc:StreetName>
								<cbc:CitySubdivisionName> </cbc:CitySubdivisionName>
								<cbc:CityName> </cbc:CityName>
								<cbc:PostalZone> </cbc:PostalZone>
								<cbc:Region> </cbc:Region>
								<cac:Country>
									<cbc:Name> </cbc:Name>
								</cac:Country>
							</cac:PostalAddress>
							
						</cac:CarrierParty>
						<cac:Despatch>
							<cbc:ActualDespatchDate>' . $internetTip["Tasiyan_Tarih"] . '</cbc:ActualDespatchDate>
						</cac:Despatch>
					</cac:Delivery>
					<cac:PaymentMeans>
						<cbc:PaymentMeansCode>' . $internetTip["Odeme_Sekli"] . '</cbc:PaymentMeansCode>
						<cbc:PaymentDueDate>' . $internetTip["Odeme_Tarih"] . '</cbc:PaymentDueDate>
						<cbc:InstructionNote>' . $internetTip["Araci"] . '</cbc:InstructionNote>
					</cac:PaymentMeans>';
	return $DELIVERY;
}

function UBLPaymentMeans($faturaBanka,$paraBirimi)//banka bilgileri
{
	$PaymentMeans="";
	foreach ($faturaBanka as $item) {
		$PaymentMeans .= "<cac:PaymentMeans>
		<cbc:PaymentMeansCode>46</cbc:PaymentMeansCode>
		<cac:PayeeFinancialAccount>
			<cbc:ID>".$item->ayarlarbanka_iban."</cbc:ID>
			<cbc:CurrencyCode>$paraBirimi</cbc:CurrencyCode>
			<cac:FinancialInstitutionBranch>
				<cbc:Name>".$item->ayarlarbanka_subeAd."</cbc:Name>
				<cac:FinancialInstitution>
					<cbc:Name>".$item->ayarlarbanka_ad."</cbc:Name>
				</cac:FinancialInstitution>
			</cac:FinancialInstitutionBranch>
		</cac:PayeeFinancialAccount>
	</cac:PaymentMeans>";
	}
	return $PaymentMeans;
}

function UBLTaxTotal($satisFaturasi, $paraBirimi, $kdv)//Bu elemana faturada yer alan vergi ve diğer yasal yükümlülükler ile ilgili bilgiler yazılacaktır
{

	$ci = get_instance();

	$kdv0 = "";
	$kdv1 = "";
	$kdv8 = "";
	$kdv18 = "";

	$taxtotalQ = "SELECT satisStok_indirimTutari,sum(satisStok_satirIskonto) as satisStok_satirIskonto,satisStok_kdv as kdvoran,sum(satisStok_indirimlifiyat) as fiyatToplam,satisStok_indirimliFiyat,satisStok_tevkifat_id FROM satisFaturasiStok where satisStok_satisFaturasiID=" . $satisFaturasi->satis_id . " GROUP by satisStok_kdv";
	$taxtotalExe = $ci->db->query($taxtotalQ)->result();

	$TaxTotal = "";
	$istisna="";
	$tevkifatKdvToplam=0;
	$satisStok_satirIskonto=0;

	$istisnaQ="select * from istisnaKodlari inner join satisFaturasi on istisna_id=satis_istisna_id where istisna_id=".$satisFaturasi->satis_istisna_id;
	$istisnaExe=$ci->db->query($istisnaQ)->row();

	if($satisFaturasi->satis_istisna_id!=0)
		$istisna = '<cbc:TaxExemptionReasonCode>'.$istisnaExe->istisna_kodu.'</cbc:TaxExemptionReasonCode>
					<cbc:TaxExemptionReason>'.$istisnaExe->istisna_adi.'</cbc:TaxExemptionReason>';

	//taxtotal
	foreach ($taxtotalExe as $item) {
		//taxableamount = fiyat*miktar
		//taxamount = fiyat*miktar * kdvoran/100
		//percent = kdvoran
		$satisStok_satirIskonto=$satisStok_satirIskonto+$item->satisStok_satirIskonto;
		$sonuc = $item->fiyatToplam * $item->kdvoran / 100;
		$muafiyet = "";

		if ($item->fiyatToplam == 0) {
			$muafiyet .= '<cbc:TaxExemptionReasonCode>351</cbc:TaxExemptionReasonCode>
				<cbc:TaxExemptionReason>' . $satisFaturasi->satis_vergiMuafiyetSebep . '</cbc:TaxExemptionReason>';
		}

		if($item->kdvoran == 0){
			$muafiyet .= '<cbc:TaxExemptionReasonCode>351</cbc:TaxExemptionReasonCode>
				<cbc:TaxExemptionReason>' . $satisFaturasi->satis_vergiMuafiyetSebep . '</cbc:TaxExemptionReason>';
		}

		if($item->satisStok_tevkifat_id!=0)
		{
			$tevkifatQ="select * from satisFaturasiStok inner join tevkifatKodlari on satisStok_tevkifat_id=tevkifat_id where tevkifat_id=".$item->satisStok_tevkifat_id;
			$tevkifatExe=$ci->db->query($tevkifatQ)->row();

			$kdvHesap=$item->satisStok_indirimliFiyat*$item->kdvoran/100;

			$tevkifatKdvToplam += $kdvHesap * $tevkifatExe->tevkifat_orani;
		}


		if ($item->kdvoran == 8) {
			$kdv8 = '<cac:TaxSubtotal>
						<cbc:TaxableAmount currencyID="' . $paraBirimi . '">' . $item->fiyatToplam . '</cbc:TaxableAmount>
						<cbc:TaxAmount currencyID="' . $paraBirimi . '">' . $sonuc . '</cbc:TaxAmount>
						<cbc:CalculationSequenceNumeric>1</cbc:CalculationSequenceNumeric>
						<cbc:Percent>' . $item->kdvoran . '</cbc:Percent>
							<cac:TaxCategory>' . $muafiyet .' '.$istisna. '<cac:TaxScheme>
								<cbc:Name>' . $kdv["TaxTotal_TaxScheme_Name"] . '</cbc:Name>
								<cbc:TaxTypeCode>' . $kdv["TaxTotal_TaxScheme_TaxTypeCode"] . '</cbc:TaxTypeCode>
							</cac:TaxScheme>
						</cac:TaxCategory>
					</cac:TaxSubtotal>';
		} else if ($item->kdvoran == 0) {
			$kdv0 = '<cac:TaxSubtotal>
						<cbc:TaxableAmount currencyID="' . $paraBirimi . '">' . $item->fiyatToplam . '</cbc:TaxableAmount>
						<cbc:TaxAmount currencyID="' . $paraBirimi . '">' . $sonuc . '</cbc:TaxAmount>
						<cbc:CalculationSequenceNumeric>1</cbc:CalculationSequenceNumeric>
						<cbc:Percent>' . $item->kdvoran . '</cbc:Percent>
						<cac:TaxCategory>' . $muafiyet .' '.$istisna. '<cac:TaxScheme>
								<cbc:Name>' . $kdv["TaxTotal_TaxScheme_Name"] . '</cbc:Name>
								<cbc:TaxTypeCode>' . $kdv["TaxTotal_TaxScheme_TaxTypeCode"] . '</cbc:TaxTypeCode>
							</cac:TaxScheme>
						</cac:TaxCategory>
					</cac:TaxSubtotal>';
		} else if ($item->kdvoran == 1) {
			$kdv1 = '<cac:TaxSubtotal>
						<cbc:TaxableAmount currencyID="' . $paraBirimi . '">' . $item->fiyatToplam . '</cbc:TaxableAmount>
						<cbc:TaxAmount currencyID="' . $paraBirimi . '">' . $sonuc . '</cbc:TaxAmount>
						<cbc:CalculationSequenceNumeric>1</cbc:CalculationSequenceNumeric>
						<cbc:Percent>' . $item->kdvoran . '</cbc:Percent>
						<cac:TaxCategory>' . $muafiyet .' '.$istisna. '<cac:TaxScheme>
								<cbc:Name>' . $kdv["TaxTotal_TaxScheme_Name"] . '</cbc:Name>
								<cbc:TaxTypeCode>' . $kdv["TaxTotal_TaxScheme_TaxTypeCode"] . '</cbc:TaxTypeCode>
							</cac:TaxScheme>
						</cac:TaxCategory>
					</cac:TaxSubtotal>';
		} else if ($item->kdvoran == 18) {
			$kdv18 = '<cac:TaxSubtotal>
						<cbc:TaxableAmount currencyID="' . $paraBirimi . '">' . $item->fiyatToplam . '</cbc:TaxableAmount>
						<cbc:TaxAmount currencyID="' . $paraBirimi . '">' . $sonuc . '</cbc:TaxAmount>
						<cbc:CalculationSequenceNumeric>1</cbc:CalculationSequenceNumeric>
						<cbc:Percent>' . $item->kdvoran . '</cbc:Percent>
						<cac:TaxCategory>' . $muafiyet .' '.$istisna. '<cac:TaxScheme>
								<cbc:Name>' . $kdv["TaxTotal_TaxScheme_Name"] . '</cbc:Name>
								<cbc:TaxTypeCode>' . $kdv["TaxTotal_TaxScheme_TaxTypeCode"] . '</cbc:TaxTypeCode>
							</cac:TaxScheme>
						</cac:TaxCategory>
					</cac:TaxSubtotal>';
		}

	}

	//allowancecharge(satir iskonto)
	if ($satisStok_satirIskonto != 0) {
		$TaxTotal .= '<cac:AllowanceCharge>
								<cbc:ChargeIndicator>false</cbc:ChargeIndicator>
								<cbc:AllowanceChargeReason>Satır İskonto</cbc:AllowanceChargeReason>
								<cbc:Amount currencyID="' . $paraBirimi . '">' . round($satisStok_satirIskonto,2) . '</cbc:Amount>
							</cac:AllowanceCharge>';
	}

	$kdvToplam=$satisFaturasi->satis_kdvToplam-$tevkifatKdvToplam;
$kdvToplam=number_format($kdvToplam, 2, '.', '');
	$TaxTotal .= '<cac:TaxTotal>
					<cbc:TaxAmount currencyID="' . $paraBirimi . '">' . $kdvToplam . '</cbc:TaxAmount>';//Tax amount toplam kdv tutarı
	if ($kdv8 != "")
		$TaxTotal .= $kdv8;
	if ($kdv0 != "")
		$TaxTotal .= $kdv0;
	if ($kdv1 != "")
		$TaxTotal .= $kdv1;
	if ($kdv18 != "")
		$TaxTotal .= $kdv18;
	$TaxTotal .= "</cac:TaxTotal>";
	return $TaxTotal;
}

function UBLWithholdingTaxTotal($satisFaturasiStok,$paraBirimi)//Bu elemana tevkifatlı faturalarda yer alan tevkifat ile ilgili bilgiler yazılacaktır.
{
	$ci=get_instance();
	$WithholdingTaxTotal="";
	foreach ($satisFaturasiStok as $item)
	{
		if($item->satisStok_tevkifat_id!=0)
		{
			$tevkifatQ="select * from satisFaturasiStok inner join tevkifatKodlari on satisStok_tevkifat_id=tevkifat_id where tevkifat_id=".$item->satisStok_tevkifat_id;
			$tevkifatExe=$ci->db->query($tevkifatQ)->row();

			$kdvHesap=$item->satisStok_indirimlifiyat*$item->satisStok_kdv/100;
			$tevkifatKdv = $kdvHesap * $tevkifatExe->tevkifat_orani;
			$tevkifatOran=$tevkifatExe->tevkifat_orani*100;

			$WithholdingTaxTotal .= '<cac:WithholdingTaxTotal>
										<cbc:TaxAmount currencyID="'.$paraBirimi.'">'.$tevkifatKdv.'</cbc:TaxAmount>
										<cac:TaxSubtotal>
											<cbc:TaxableAmount currencyID="'.$paraBirimi.'">'.$kdvHesap.'</cbc:TaxableAmount>
											<cbc:TaxAmount currencyID="'.$paraBirimi.'">'.$tevkifatKdv.'</cbc:TaxAmount>
											<cbc:Percent>'.$tevkifatOran.'</cbc:Percent>
											<cac:TaxCategory>
												<cac:TaxScheme>
													<cbc:Name>'.$tevkifatExe->tevkifat_kodu.' - '.$tevkifatExe->tevkifat_adi.'</cbc:Name>
													<cbc:TaxTypeCode>'.$tevkifatExe->tevkifat_kodu.'</cbc:TaxTypeCode>
												</cac:TaxScheme>
											</cac:TaxCategory>
										</cac:TaxSubtotal>
									</cac:WithholdingTaxTotal>';

		}
	}
	return $WithholdingTaxTotal;
}

function UBLLegalMonetaryTotal( $paraBirimi, $satisFaturasi, $satisFaturasiStok) //Bu elemanda faturadaki çeşitli tutarların toplamları yer alacaktır.
{

	//LineExtensionAmount = ara toplam
	//TaxExclusiveAmount = net tutar(aratoplam-indirimtoplam)
	//TaxInclusiveAmount = TaxExclusiveAmount + kdvToplam
	//AllowanceTotalAmount ->satır iskonto

	$ci = get_instance();
	$satirIskontoQ = "SELECT   sum(satisStok_indirimTutari) as satisStok_indirimTutari,sum(satisStok_fiyatMiktar) as fiyatToplam,sum(satisStok_satirIskonto) as AllowanceTotalAmount FROM `satisFaturasiStok` where satisStok_satisFaturasiID=" . $satisFaturasi->satis_id;
	$satirIskontoExe = $ci->db->query($satirIskontoQ)->row();

	$AllowanceTotal = $satirIskontoExe->fiyatToplam-$satirIskontoExe->AllowanceTotalAmount;

	$AllowanceTotalAmount=$satirIskontoExe->AllowanceTotalAmount;

	$genelIskontoQ = "SELECT * FROM `genel_iskonto` where iskonto_satis_id=" . $satisFaturasi->satis_id." ";
	$genelIskontoExe = $ci->db->query($genelIskontoQ)->result();
	foreach ($genelIskontoExe as $item) {
		$oran=$AllowanceTotal*$item->iskonto_tutar/100;
		$AllowanceTotalAmount += $oran;

		$AllowanceTotal=$AllowanceTotal-$oran;
	}


	$LegalMonetaryTotal = '<cac:LegalMonetaryTotal>
		<cbc:LineExtensionAmount currencyID="' . $paraBirimi . '">' . $satisFaturasi->satis_araToplam . '</cbc:LineExtensionAmount>
		<cbc:TaxExclusiveAmount currencyID="' . $paraBirimi . '">' . $satisFaturasi->satis_netTutar . '</cbc:TaxExclusiveAmount>
		<cbc:TaxInclusiveAmount currencyID="' . $paraBirimi . '">' . $satisFaturasi->satis_vergiDahilToplam . '</cbc:TaxInclusiveAmount>
		<cbc:AllowanceTotalAmount currencyID="' . $paraBirimi . '">' . round($AllowanceTotalAmount,2) . '</cbc:AllowanceTotalAmount>
		<cbc:ChargeTotalAmount currencyID="' . $paraBirimi . '">0.00</cbc:ChargeTotalAmount>
		<cbc:PayableAmount currencyID="' . $paraBirimi . '">' . $satisFaturasi->satis_genelToplam . '</cbc:PayableAmount>
	</cac:LegalMonetaryTotal>';

	return $LegalMonetaryTotal;
}

function UBLInvoiceLine($satisFaturasiStok, $paraBirimi, $kdv)//Bu elemanda faturada yer alan mal ve/veya hizmetlere ait bilgiler yer alacaktır.
{
	$InvoiceLineSayac = 1;
	$InvoiceLine = "";
	$ci = get_instance();
	foreach ($satisFaturasiStok as $item) {

		//InvoicedQuantity unitCode=stok birim kodu. etiket içeriği stok miktarı
		//LineExtensionAmount indirimli fiyat
		//TaxAmount kdv tutar

		$kdv_tutar = $item->satisStok_indirimlifiyat * $item->satisStok_kdv / 100;

		$stokQ = "select * from stok inner join stokBirimleri on stok_birimID=stokBirim_id where stok_id=" . $item->satisStok_stokID;
		$stokExe = $ci->db->query($stokQ)->row();

		$InvoiceLine .= '<cac:InvoiceLine>
							<cbc:ID>' . $InvoiceLineSayac . '</cbc:ID>
							<cbc:Note/>
							<cbc:InvoicedQuantity unitCode="' . $stokExe->stokBirim_kodu . '">' . $item->satisStok_miktar . '</cbc:InvoicedQuantity>
							<cbc:LineExtensionAmount currencyID="' . $paraBirimi . '">' . $item->satisStok_indirimlifiyat . '</cbc:LineExtensionAmount>';

		if ($item->satisStok_indirimTutari != 0) {
			$indirim = $item->satisStok_indirimTutari / 100;
			$InvoiceLine .= '<cac:AllowanceCharge>
									<cbc:ChargeIndicator>false</cbc:ChargeIndicator>
									<cbc:AllowanceChargeReason>İndirim 1</cbc:AllowanceChargeReason>
									<cbc:MultiplierFactorNumeric>' . $indirim . '</cbc:MultiplierFactorNumeric>
									<cbc:Amount currencyID="' . $paraBirimi . '">' .$item->satisStok_satirIskonto . '</cbc:Amount>
									<cbc:BaseAmount currencyID="' . $paraBirimi . '">' . $item->satisStok_fiyatMiktar . '</cbc:BaseAmount>
								</cac:AllowanceCharge>';
		}

		$InvoiceLine .= '<cac:TaxTotal>
							<cbc:TaxAmount currencyID="' . $paraBirimi . '">' . $kdv_tutar . '</cbc:TaxAmount>
								<cac:TaxSubtotal>
									<cbc:TaxableAmount currencyID="' . $paraBirimi . '">' . $item->satisStok_indirimlifiyat . '</cbc:TaxableAmount>
									<cbc:TaxAmount currencyID="' . $paraBirimi . '">' . $kdv_tutar. '</cbc:TaxAmount>
									<cbc:CalculationSequenceNumeric>1</cbc:CalculationSequenceNumeric>
								<cbc:Percent>' . $item->satisStok_kdv . '</cbc:Percent>
								<cac:TaxCategory>
									<cac:TaxScheme>
										<cbc:Name>' . $kdv["TaxTotal_TaxScheme_Name"] . '</cbc:Name>
										<cbc:TaxTypeCode>' . $kdv["TaxTotal_TaxScheme_TaxTypeCode"] . '</cbc:TaxTypeCode>
									</cac:TaxScheme>
								</cac:TaxCategory>
							</cac:TaxSubtotal>
						</cac:TaxTotal>';
		if($item->satisStok_tevkifat_id!=0)
		{
			$tevkifatQ="select * from satisFaturasiStok inner join tevkifatKodlari on satisStok_tevkifat_id=tevkifat_id where tevkifat_id=".$item->satisStok_tevkifat_id;
			$tevkifatExe=$ci->db->query($tevkifatQ)->row();

			$kdvHesap=$item->satisStok_indirimlifiyat*$item->satisStok_kdv/100;
			$tevkifatKdv = $kdvHesap * $tevkifatExe->tevkifat_orani;
			$tevkifatOran=$tevkifatExe->tevkifat_orani*100;

			$InvoiceLine .= '<cac:WithholdingTaxTotal>
										<cbc:TaxAmount currencyID="'.$paraBirimi.'">'.$tevkifatKdv.'</cbc:TaxAmount>
										<cac:TaxSubtotal>
											<cbc:TaxableAmount currencyID="'.$paraBirimi.'">'.$kdvHesap.'</cbc:TaxableAmount>
											<cbc:TaxAmount currencyID="'.$paraBirimi.'">'.$tevkifatKdv.'</cbc:TaxAmount>
											<cbc:Percent>'.$tevkifatOran.'</cbc:Percent>
											<cac:TaxCategory>
												<cac:TaxScheme>
													<cbc:Name>'.$tevkifatExe->tevkifat_kodu.' - '.$tevkifatExe->tevkifat_adi.'</cbc:Name>
													<cbc:TaxTypeCode>'.$tevkifatExe->tevkifat_kodu.'</cbc:TaxTypeCode>
												</cac:TaxScheme>
											</cac:TaxCategory>
										</cac:TaxSubtotal>
									</cac:WithholdingTaxTotal>';
		}
		$InvoiceLine.='<cac:Item>
						<cbc:Name>' . $stokExe->stok_ad . '</cbc:Name>
						<cac:SellersItemIdentification>
							<cbc:ID>'.$stokExe->stok_kodu.'</cbc:ID>
						</cac:SellersItemIdentification>
					</cac:Item>
					<cac:Price>
						<cbc:PriceAmount currencyID="' . $paraBirimi . '">' . $item->satisStok_birimFiyat . '</cbc:PriceAmount>
					</cac:Price>
				</cac:InvoiceLine>';
		$InvoiceLineSayac++;
	}

	return $InvoiceLine;
}




function GidenKutusuSorgu($faturaNo)
{
    
	$ci = get_instance();
    //fatura durumu sorgula
	$ws_archive = env(EFATURA_URL);
	//$SESSION_ID = getSessionID();

	$session=login();

	$trace = true;
	$exceptions = false;
	
	$xml_array->REQUEST_HEADER->SESSION_ID = $session;
	$xml_array->REQUEST_HEADER->APPLICATION_NAME = env(APPLICATION_NAME);
	
	$xml_array->INVOICE->ID = $faturaNo; //Evrensel Tekil Tanımlama Numarası (ETTN) ile fatura okumak için kullanılabilir. GUID formatında//	IN değeri gönderilecek.
	
		$xml_array->INVOICE_SEARCH_KEY->TYPE ="XML";
	$client = new SoapClient($ws_archive, array('trace' => $trace, 'exceptions' => $exceptions));

	$response = $client->GetInvoiceStatus($xml_array);

	$error_short_des = $response->ERROR_TYPE->ERROR_SHORT_DES;
	
	

	if ($error_short_des == null || $error_short_des == "") {
	    
        return $response;   
	} else {
		if (isSessionKilled($error_short_des) != 1) {//session koptu anlamına gelir, yeni session üretilip yazılmalı ve tekrar denenmelidir.
			generateNewSession();
			GidenKutusuSorgu($faturaNo);
		} else {
			$ci->session->set_flashdata('fatura_liste_error', 'OK');

			$ci->session->set_flashdata('error', $error_short_des);
		}
		//redirect('fatura/' . $page);
	}
	
}
