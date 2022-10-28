<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container">
		<div class="card">
			<h2 class="text-card">Login</h2>
			 <form class="form-data" action="" method="POST"> 
				<div class="input-login">
					<label class="form-label" for="email">Email</label><br>
					<input class="input-data" type="text" name="email"><br>
					<label class="form-label" for="email">Senha</label><br>
					<input class="input-data" type="password" name="senha" placeholder="****">
				</div>
				<div class="submit-login">
					 <input class="btn-in btn-login" type="submit" name="login" value="Entrar">
				</div>

			 </form> 
 				
			 	<a class="esqueceu-senha" href="#">Esqueceu a senha?</a>
			 	<div class="hr"></div>
				<a class="btn-registrar" href="registrar.php">Criar nova conta</a>
			 	
		</div>	
	</div>		
</body>
</html>

<?php 
	if(!isset($_SESSION)){	
		session_start();
	}
	require 'config/connect.php';

	if(isset($_SESSION['id']) && !empty($_SESSION['id'])){	 //se existir a seção redireciona para a pagina inicial
		header("location:index.php");
	}else{ // se não, faz o login com os dados informados
		if(isset($_POST['login'])){ //se o botao de logar foi clicado

			$email = addslashes($_POST['email']);
			$senha = md5(addslashes($_POST['senha']));

			if(!$email || !$senha){
				header("location:index.php");
				
			}
			else{
				$stmt = $conn->prepare("SELECT * FROM users.people WHERE email=? AND senha=?");
				if($stmt->execute(array($email,$senha))){
					if($stmt->rowCount() > 0){
						$_SESSION['id'] = $stmt->fetch(PDO::FETCH_ASSOC);
						header("location:index.php");
						}
					}
			}
			
		}
	}

 ?>