<?php
    $pdo = null;
    try{
		$pdo = new PDO('mysql:localhost=localhost;dbname=noticias', 'root', '');
		$pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo "Conexión erronea" . $e->getMessage();
	}
?>