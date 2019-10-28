<?php 

include "oop.php";



$vt = new veritabani("127.0.0.1","db_ornek","root","");
$user["bilgi"] = array();



function j($dizi){
	return json_encode($dizi, JSON_UNESCAPED_UNICODE);
}

function sifrele($pass){
	$salt = "1234567890";
	return md5($pass.$salt);
}


if ($_GET["islem"] == "giris") {
	

	$username = $_GET["username"];
	$pass = sifrele($_GET["pass"]);

	$data = $vt->SQL("SELECT ID, USERNAME FROM tb_site WHERE USERNAME = ? and PASSWORD = ?", array($username,$pass));
	foreach ($data as $satir) {
		$bilgi = array(
			"id" => $satir["ID"],
			"username" => $satir["USERNAME"]
		);
		array_push($user["bilgi"], $bilgi);

	}

	$user["hata"] = "0";
	echo j($user);

}
else if($_GET["islem"] == "kayit"){
	$username = $_GET["username"];
	$pass = sifrele($_GET["pass"]);

	$data = $vt->SQL("INSERT INTO tb_site(USERNAME,PASSWORD) VALUES(?,?)", array($username,$pass),true);
	if ($data) {
		$user["bilgi"] = "Kayıt Edildi";
		$user["hata"] = "0";
		echo j($user);
	}
}
else if($_GET["islem"] == "guncelle"){
	$id = $_GET["id"];
	$yeniUsername = $_GET["yeniUsername"];
	$data = $vt->SQL("UPDATE tb_site SET USERNAME = ? WHERE ID = ?", array($yeniUsername,$id),true);

	if ($data) {
		$user["bilgi"] = "Güncelleme Yapıldı";
		$user["hata"] = "0";
		echo j($user);
	}
}
else if($_GET["islem"] == "sil"){
	$id = $_GET["id"];
	$data = $vt->SQL("DELETE FROM tb_site WHERE ID = ?", array($id), true);
	if ($data) {
		$user["bilgi"] = "Silindi";
		$user["hata"] = "0";

		echo j($user);
	}
}
else{
	echo "İşlem Bulunamadı!";
}




 ?>