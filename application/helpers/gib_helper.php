<?php
function gibYetki()
{
    $firmaID = getirFirma();
    
    // Firma bilgisi alınamazsa varsayılan olarak 0 döndür
    if (!$firmaID || !isset($firmaID->ayarlar_id)) {
        return 0;
    }
    
    $firma_ID = $firmaID->ayarlar_id;
    $modulGibSorgula = modulSorgula($firma_ID, 2);
    $modulGibSorgula1 = modulSorgula($firma_ID, 3);
    
    if($modulGibSorgula)
        return 1;
    else if($modulGibSorgula1)
        return 2;
    else
        return 0;
}

function gib_giris()
{
	$ci=get_instance();
	$firmaID = getirFirma();
	$firma_ID = $firmaID->ayarlar_id;
	$sql="select ma_gibUsername,ma_gibSifre from modulAyarlari where ma_olusturanAnaHesap=$firma_ID and ma_modulID=3";
	$modul=$ci->db->query($sql)->row();
	return $modul;
}
