<?php
// conexão
require_once 'php/php_action/db_connect.php';

// sessão
session_start();

// teste botão
if(isset($_POST['btn-entrar'])):
	$erros = array();
	// sempre deve ser feita a limpeza dos dados, pois usuários mal intencionados podem digitar comandos sql
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = mysqli_escape_string($connect, $_POST['senha']);

	if(empty($login) or empty($senha)):
		$erros[] = "<li>O campo login/senha deve ser preenchido</li>";
	else:
		$sql = "SELECT login FROM Usuario WHERE login = '$login'";
		$resultado = mysqli_query($connect, $sql);

		if(mysqli_num_rows($resultado) > 0):
			$sql = "SELECT * FROM Usuario WHERE login = '$login' and senha = '$senha'";
			$resultado = mysqli_query($connect, $sql);

			if(mysqli_num_rows($resultado) == 1):
				$dados = mysqli_fetch_array($resultado);
				mysqli_close($connect);
				$_SESSION['logado'] = true;
				$_SESSION['idUsuario'] = $dados['id'];
				header('Location: php/dashboard.php');
			else:
				$erros[] = "<li>Usuário ou senha inválidos!</li>";
			endif;
		else:
			$erros[] = "<li> Usuário inexistente! </li>";
		endif;
	endif;
endif;
?>

<html>
<head>
	<title>Login</title>
</head>
<body>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

	<!-- adição de estilos -->

	<style>
		body {
			background-image: url(img/PUCPR-campus3.jpg); 
			background-size: cover;
			color: #fff;
		}
		.login {
			margin-top: 100px;
		}
		.login .card {
			background: rgba(0,0,0, .8);
		}
		.login label {
			font-size: 16px;
			color: #ccc;
		}
		.login input {
			font-size: 20px;
			color: #fff;
		}
		.login button:hover {
			padding: 0px 40px;
		}
	</style>

	<div class="row login" ac>
		<div class="col s12 m4 14 offset-14">
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
						<button class="btn-large green" name="btn-entrar">Login</button>
					</div><br>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>











