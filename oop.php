<?php

error_reporting(0);

class veritabani{
	public static $db;
	function __construct($host,$db_adi,$db_k_adi,$db_sifre){
		try {
			self::$db = new PDO("mysql:host=$host;dbname=$db_adi;charset=utf8",$db_k_adi,$db_sifre);

		} catch (PDOException $hata) {
			echo "Bağlantı Hatası!";
		}
	}

	function SQL($sorgu,$data,$kip = false){
		$s = self::$db->prepare($sorgu);
		$s->execute($data);

		if ($s->rowCount() > 0) {
			if ($kip == false) {
				return $s->fetchAll();
			}
			else{
				return true;
			}
		}
		self::$db= null;
		
	}
}


$veritabani = new veritabani("127.0.0.1","db_ornek","root","");

$data = $veritabani->SQL("SELECT * FROM tb_konu",array(""));
foreach ($data as $eleman) {
	echo $eleman["ICERIK"]."<br>";
}

$data2 = $veritabani->SQL("INSERT INTO tb_konu(BASLIK,ICERIK) VALUES(?,?)",array("FFFFF", "XXXX"),true); //True verilince Boolean
if ($data2) {
	echo "Kayıt İşlemi Yapıldı";
}


$data3 = $veritabani->SQL("UPDATE tb_site SET USERNAME = ? WHERE ID = ?",array("ahmet",5),true);
if ($data3) {
	echo "Güncelleme Yapıldı!";
}

$data4 = $veritabani->SQL("DELETE FROM tb_konu WHERE ID = ?",array("17"),true);
if ($data4) {
	echo "Veri Silindi!";
}


$veritabani2 = new veritabani("127.0.0.1","db_site","root","");

$fx = $veritabani2->SQL("SELECT * FROM tb_urun",array(""));
foreach ($fx as $eleman) {
	echo $eleman["BILGI"];
}

?>