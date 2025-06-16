<?php

function authizi($username, $password)
{
	$ci = get_instance();

	$ws = env('IZIAUTH_URL');

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
	}
}

function generateNewSessionizi()
{
	$ci = get_instance();

	$control2 = session("r", "login_info");
	$u_id = $control2->kullanici_id;
	$anaHesap = anaHesapBilgisi();
	$modulQ = "SELECT * FROM firmaModulleri WHERE firmaModul_firmaID = '$anaHesap' AND firmaModul_moduleID = 5 ";
	$modulExe = $ci->db->query($modulQ)->row();
	if ($modulExe) {
		$faturaGirisSorgulaQ = "SELECT * FROM modulAyarlari WHERE ma_olusturanAnaHesap = '$anaHesap' AND ma_modulID = 5";
		$faturaGirisSorgula = $ci->db->query($faturaGirisSorgulaQ)->row();

		$auth = authizi($faturaGirisSorgula->ma_eirsaliyeUsername, $faturaGirisSorgula->ma_eirsaliyeSifre);

		session("w", "auth", $auth);
		$ses = session("r", "auth");
		$datak["kullanici_belgeSessionIDizi"] = $ses;

		$ci->vt->update('kullanicilar', array('kullanici_id' => $u_id), $datak);
	}
}

function getSessionIDizi()
{
	$control2 = session("r", "login_info");
	$u_id = $control2->kullanici_id;

	$ci = get_instance();

	$sorgu = "SELECT * FROM kullanicilar WHERE kullanici_id = '$u_id'";
	$result = $ci->db->query($sorgu)->row();
	$session = $result->kullanici_belgeSessionIDizi;

	return $session;
}

function isSessionKilledizi($error_short_des)
{
	$word = "Aktif session bulunamadı";
	if (strpos($error_short_des, $word) !== false) {
		return 1;//word bulunduğu için session koptu demektir, 1 döner.
	} else {
		return 0;//word bulunamadığı için session devam ediyordur.
	}
}

function UBLSettingsDespatch($information)//ubl ayarları
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
	<cbc:DespatchAdviceTypeCode>'.$information["DespatchAdviceTypeCode"].'</cbc:DespatchAdviceTypeCode>';
	if ($information["Note1"] != "")
		$Settings .= '<cbc:Note>' . $information["Note1"] . '</cbc:Note>';
	$Settings .= '<cbc:LineCountNumeric>' . $information["LineCountNumeric"] . '</cbc:LineCountNumeric>';


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

function UBLSignatureDespatch($ID){
	$ci = get_instance();
	$Signature = '<cac:Signature>
					<cbc:ID schemeID="VKN_TCKN">4840847211</cbc:ID>
					<cac:SignatoryParty>
						<cac:PartyIdentification>
							<cbc:ID schemeID="VKN">4840847211</cbc:ID>
						</cac:PartyIdentification>
						<cac:PostalAddress>
							<cbc:StreetName>Yıldız Teknik Üniversitesi Teknoloji Geliştirme Bölgesi D2 Blok Z07</cbc:StreetName>
							<cbc:BuildingName/>
							<cbc:BuildingNumber>C-1 Blok</cbc:BuildingNumber>
							<cbc:CitySubdivisionName>MALTEPE</cbc:CitySubdivisionName>
							<cbc:CityName>ISTANBUL</cbc:CityName>
							<cbc:PostalZone>34220</cbc:PostalZone>
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

function UBLAccountingSuplierPartyDespatch($gonderici, $g_il, $g_ilce, $ASP_PostalAddress_Country_Name)//Bu elemanda faturayı düzenleyen tarafın bilgileri yer alacaktır.
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

	$AccountingSuplierParty = '<cac:DespatchSupplierParty>
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
							</cac:DespatchSupplierParty>';

	return $AccountingSuplierParty;
}

function UBLAccountingCustomerPartyDespatch($alici, $a_il, $a_ilce, $ACP_PostalAddress_Country_Name)//Bu elemanda faturayı alan tarafın bilgileri yer alacaktır.
{
	$ci = get_instance();
	$AccountingCustomerParty = '<cac:DeliveryCustomerParty>
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
						</cac:DeliveryCustomerParty>';
	return $AccountingCustomerParty;
}

//SellerSupplierParty

function UBLShipment($irsaliyeBilgileri,$genelToplam){
	$ci = get_instance();

	$tarih = date("Y-m-d");
	$saat = date("H:i:s");

	$ad = explode(' ', $irsaliyeBilgileri->irs_irsaliyeSoforAd);

	$Shipment = '<cac:Shipment>
		<cbc:ID/>
		<cac:GoodsItem>
			<cbc:ValueAmount currencyID="TRY">'.$genelToplam.'</cbc:ValueAmount>
		</cac:GoodsItem>
		<cac:ShipmentStage>
			<cac:TransportMeans>
				<cac:RoadTransport>
					<cbc:LicensePlateID schemeID="PLAKA">'.$irsaliyeBilgileri->irs_irsaliyePlaka.'</cbc:LicensePlateID>
				</cac:RoadTransport>
			</cac:TransportMeans>
			<cac:DriverPerson>
				<cbc:FirstName>'.$ad[0].'</cbc:FirstName>
				<cbc:FamilyName>'.$ad[1].'</cbc:FamilyName>
				<cbc:Title>Şoför</cbc:Title>
				<cbc:NationalityID>'.$irsaliyeBilgileri->irs_irsaliyeSoforTCKN.'</cbc:NationalityID>
			</cac:DriverPerson>
		</cac:ShipmentStage>
		<cac:Delivery>
			<cac:DeliveryAddress>
				<cbc:StreetName>'.$irsaliyeBilgileri->sb_adres.'</cbc:StreetName>
				<cbc:CitySubdivisionName>'.$irsaliyeBilgileri->sb_ilce.'</cbc:CitySubdivisionName>
				<cbc:CityName>'.$irsaliyeBilgileri->sb_sehir.'</cbc:CityName>
				<cbc:PostalZone>'.$irsaliyeBilgileri->sb_pk.'</cbc:PostalZone>
				<cac:Country>
					<cbc:Name>'.$irsaliyeBilgileri->sb_ulke.'</cbc:Name>
				</cac:Country>
			</cac:DeliveryAddress>
			<cac:CarrierParty>
				<cac:PartyIdentification>
					<cbc:ID schemeID="TCKN">'.$irsaliyeBilgileri->irs_irsaliyeTasiyiciVKNTCKN.'</cbc:ID>
				</cac:PartyIdentification>
				<cac:PartyName>
					<cbc:Name>'.$irsaliyeBilgileri->irs_irsaliyeTasiyiciUnvan.'</cbc:Name>
				</cac:PartyName>
				<cac:PostalAddress>
					<cbc:CitySubdivisionName/>
					<cbc:CityName/>
					<cbc:PostalZone/>
					<cbc:District/>
					<cac:Country>
						<cbc:Name/>
					</cac:Country>
				</cac:PostalAddress>
			</cac:CarrierParty>
			<cac:Despatch>
				<cbc:ActualDespatchDate>'.$tarih.'</cbc:ActualDespatchDate>
				<cbc:ActualDespatchTime>'.$saat.'</cbc:ActualDespatchTime>
			</cac:Despatch>
		</cac:Delivery>
		<cac:TransportHandlingUnit>
			<cac:TransportEquipment>
				<cbc:ID schemeID="DORSEPLAKA">'.$irsaliyeBilgileri->irs_irsaliyeDorsePlaka.'</cbc:ID>
			</cac:TransportEquipment>
		</cac:TransportHandlingUnit>
	</cac:Shipment>';

	return $Shipment;
}

function UBLDespatchLine($satisFaturasiStok, $paraBirimi){
	$InvoiceLineSayac = 1;
	$InvoiceLine = "";
	$ci = get_instance();
	foreach ($satisFaturasiStok as $item) {
		$kdv_tutar = $item->satisStok_indirimlifiyat * $item->satisStok_kdv / 100;

		$stokQ = "select * from stok inner join stokBirimleri on stok_birimID=stokBirim_id where stok_id=" . $item->satisStok_stokID;
		$stokExe = $ci->db->query($stokQ)->row();

		$InvoiceLine .= '<cac:DespatchLine>
							<cbc:ID>' . $InvoiceLineSayac . '</cbc:ID>
							<cbc:DeliveredQuantity unitCode="' . $stokExe->stokBirim_kodu . '">' . $item->satisStok_miktar . '</cbc:DeliveredQuantity>
							<cac:OrderLineReference>
								<cbc:LineID>' . $InvoiceLineSayac . '</cbc:LineID>
							</cac:OrderLineReference>
							<cac:Item>
								<cbc:Name>' . $stokExe->stok_ad . '</cbc:Name>
								<cac:SellersItemIdentification>
									<cbc:ID>'.$stokExe->stok_kodu.'</cbc:ID>
								</cac:SellersItemIdentification>
							</cac:Item>
							<cac:Shipment>
								<cbc:ID/>
								<cac:GoodsItem>
									<cac:InvoiceLine>
										<cbc:ID/>
										<cbc:InvoicedQuantity unitCode="' . $stokExe->stokBirim_kodu . '">' . $item->satisStok_miktar . '</cbc:InvoicedQuantity>
										<cbc:LineExtensionAmount currencyID="' . $paraBirimi . '">' . $item->satisStok_birimFiyat . '</cbc:LineExtensionAmount>
										<cac:Item>
											<cbc:Name/>
										</cac:Item>
										<cac:Price>
											<cbc:PriceAmount currencyID="' . $paraBirimi . '">' . $item->satisStok_birimFiyat . '</cbc:PriceAmount>
										</cac:Price>
									</cac:InvoiceLine>
								</cac:GoodsItem>
							</cac:Shipment>
						</cac:DespatchLine>';
		$InvoiceLineSayac++;
	}

	return $InvoiceLine;
}
