<?php 	
	
	$host = "localhost";
	$db = "users";
	$user = "root";
	$pass= "123456";

	try {
	$conn = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
		
	} catch (PDOException $e) {
		echo 'Erro ao conectar '.$e->getMessage();
	}

 ?>