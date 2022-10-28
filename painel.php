<?php 	
	
	if(!isset($_SESSION)){
		session_start();
	}
	require 'config/connect.php';

	if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
		if(isset($_GET['id']) && !empty($_GET['id'])){
		$currentId = addslashes($_GET['id']);

	 	$stmt = $conn->prepare("SELECT * FROM users.people WHERE id=?");
	 	$stmt->execute(array($currentId));
		$currentUser;
	 	if($stmt->rowCount()>0){ //existe o usuario?
	 		$currentUser = $stmt->fetch();
	 	}else{
	 		header("location:index.php");
	 	}

		if(isset($_POST['submit'])){
			$nome=addslashes($_POST['nome']);
			$email=addslashes($_POST['email']);
			$endereco=addslashes($_POST['endereco']);
			$cidade=addslashes($_POST['cidade']);

			$verifica = array($nome,$email,$endereco,$cidade);
			$erro = 0;
			foreach ($verifica as $key => $value) {
				if(empty($value)){
					$erro = 1;
				}
			}
			if($erro != 1){

				$stmt = $conn->prepare("UPDATE users.people SET name=?,email=?,address=?,city=? WHERE id=?");
				if($stmt->execute(array($nome,$email,$endereco,$cidade,$currentId))){

					$stmt = $conn->prepare("SELECT * FROM users.people WHERE id=?");
				 	$stmt->execute(array($currentId));
					$currentUser;
				 	if($stmt->rowCount()>0){ //existe o usuario?
				 		$currentUser = $stmt->fetch();
				 		$_SESSION['id'] = $currentUser;
				 	}
					header("location:index.php");
				}
			}else{
				header("location:index.php");
			}

		}



		}
	}else{
		header("location:index.php");
	}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container">

		<div class="card">
			<h2 class="text-card">Editar perfil</h2>
			<form class="form-data" action="" method="POST">
				<div class="input-register">
					Nome:<br>
					<input class="input-data" type="text" name="nome" placeholder="Nome" value="<?=$currentUser['name']?>"><br>
					<label class="form-label" for="email">Email</label><br>
					<input class="input-data" type="email" name="email" placeholder="@Email"  value="<?=$currentUser['email']?>"><br>
					<label class="form-label" for="endereco">Endereço</label><br>
					<input class="input-data" type="text" name="endereco" placeholder="Endereço"  value="<?=$currentUser['address']?>"><br>
					<label class="form-label" for="cidade">Cidade</label><br>
					<input class="input-data" type="text" name="cidade" placeholder="Cidade"  value="<?=$currentUser['city']?>"><br>
				</div>
				<div class="btn-submit">
					<input class="btn-in btn-criar" type="submit" name="submit" value="Aplicar">
				</div>
			</form>	
			 	<div class="hr"></div>
				<a class="btn-registrar" href="redefinir.php">Redefinir senha</a>
			 	

		</div>
	</div>
</body>
</html>
