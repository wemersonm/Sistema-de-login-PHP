<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrar</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container">
		<div class="card">
			<h2 class="text-card">Registro</h2>
			<form class="form-data" action="" method="POST">
				<div class="input-register">
					Nome:<br>
					<input class="input-data" type="text" name="nome" placeholder="Nome"><br>
					<label class="form-label" for="email">Email</label><br>
					<input class="input-data" type="email" name="email" placeholder="@Email"><br>
					<label class="form-label" for="senha">Senha</label><br>
					<input class="input-data" type="password" name="senha" placeholder="****"><br>
					<label class="form-label" for="rg">RG</label><br>
					<input class="input-data" type="text" name="rg" placeholder="RG"><br>
					<label class="form-label" for="endereco">Endereço</label><br>
					<input class="input-data" type="text" name="endereco" placeholder="Endereço"><br>
					<label class="form-label" for="cidade">Cidade</label><br>
					<input class="input-data" type="text" name="cidade" placeholder="Cidade"><br>
				</div>
				<div class="btn-submit">
					<input class="btn-in btn-criar" type="submit" name="submit" value="Registre-se">
				</div>
			</form>	
			<div class="down-card">
				<p>Tem uma conta?	<a class="esqueceu-senha" href="login.php">Login</a></p>
			</div>
		</div>
	</div>
</body>
</html>

<?php 	
	require 'config/connect.php';
	if(isset($_POST['submit'])){
		$nome=addslashes($_POST['nome']);
		$email=addslashes($_POST['email']);
		$senha=md5(addslashes($_POST['senha']));
		$rg=addslashes($_POST['rg']);
		$endereco=addslashes($_POST['endereco']);
		$cidade=addslashes($_POST['cidade']);

		$verifica = array($nome,$email,$senha,$rg,$endereco,$cidade);
		$erro = 0;
		foreach ($verifica as $key => $value) {
			if(empty($value)){ // verifica se os campos são vazios
				$erro = 1;
			}
		}
		if($erro != 1){ //so vai setar os dados no banco de os campos estiverem preechidos(* não entrar no foeach)
		$stmt = $conn->prepare("INSERT INTO users.people SET name=?,email=?,rg=?,address=?,city=?,senha=?");
			if($stmt->execute(array($nome,$email,$rg,$endereco,$cidade,$senha))){
				header("location:login.php");	
		}
	}else{

		// se os campos estiverem vazios !!
	}
}


 ?>