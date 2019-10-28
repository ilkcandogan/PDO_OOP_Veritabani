<?php 


$dizi = array(
	"username" => "admin",
	"pass" => "1234"
	);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "localhost/index.php?islem=giris");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dizi));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
$cevap = curl_exec($ch);
curl_close($ch);

echo $cevap;



 ?>