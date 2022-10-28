<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sitema de login</title>
	<link rel="stylesheet" type="text/css" href="css/style2.css">
</head>
<body>
	<div class="container">
		<?php 	
		if(!isset($_SESSION)){	
			session_start();
		}
		if(isset($_SESSION['id']) && !empty($_SESSION['id'])): 
		$userData = $_SESSION['id'];
		echo '<h3>Bem vindo <span class="span-name">'.$userData['name'].'</span></h2>'; ?>
	  	<ul>
	  		<li><a href="painel.php?id=<?=$userData['id']?>">Editar perfil</a></li>
	  		<li><a href="#">?</a></li>
	  		<li><a href="quit.php">Sair</a></li>
	  	</ul>
		<?php 
		else: 

		header("location:login.php");
		 
		endif; ?>
 	</div>
</body>
</html>
