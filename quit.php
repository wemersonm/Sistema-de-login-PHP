<?php 	

	if(!isset($_SESSION)){
		session_start();
	}

	$_SESSION['id'] = "";
	header("location:index.php");
	

 ?>