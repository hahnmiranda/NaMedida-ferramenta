<?php
// conexão
require_once 'php/db_connect.php';

// sessão
session_start();

// botão enviar
if(isset($_POST['btn-entrar'])):
	$erros = array();
	// sempre deve ser feita a limpeza dos dados, pois usuários mal intencionados podem digitar comandos sql
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = mysqli_escape_string($connect, $_POST['senha']);

	if(empty($login) or empty($senha)):
		$erros[] = "<li>O campo login/senha deve ser preenchido</li>";
	else:
		$sql = "SELECT login FROM Usuario WHERE login = '$login'";
		// realizando a consulta no banco
		$resultado = mysqli_query($connect, $sql);

		if(mysqli_num_rows($resultado) > 0):
			$sql = "SELECT * FROM Usuario WHERE login = '$login' and senha = '$senha'";
			$resultado = mysqli_query($connect, $sql);

			if(mysqli_num_rows($resultado) == 1):
				// coloca todos os dados da consulta que estão na variável $resultado em um array de dados $dados
				$dados = mysqli_fetch_array($resultado);
				// encerrando a conexão
				mysqli_close($connect);
				$_SESSION['logado'] = true;
				$_SESSION['idUsuario'] = $dados['idUsuario'];
				header('Location: php/dashboard.php');
			else:
				$erros[] = "<li>Usuário ou senha inválidos!</li>";
			endif;
		else:
			$erros[] = "<li> Usuário inexistente! </li>";
		endif;
	endif;
endif;

// incluindo os estilos
include_once 'php/includes/style.php';
?>

<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
</head>
<body class="index-body">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

	<div class="row login">
		<div class="col s12 m6 offset-m3 l4 offset-l4 z-depth-6">
			<div class="card">

				<div class="card-action green white-text">
					<h3>Faça seu login</h3>
				</div>
				<div class="card-content">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="form-field">
						<label for="login">Login</label>
						<input type="text" name="login">
					</div><br>

					<div class="form-field">
						<label for="senha">Senha</label>
						<input type="password" name="senha">
					</div><br>

					<div class="form-field">
						<input type="checkbox" id="remember">
						<label for="remember">Lembrar-me</label>
					</div><br>

					<div class="form-field center-align">
						<button class="btn-large green" type="submit" name="btn-entrar">Login</button>
					</div><br>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>











