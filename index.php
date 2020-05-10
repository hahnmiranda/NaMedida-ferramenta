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
	<h1> Login </h1>

	<?php 
		if (!empty($erros)) {
			foreach ($erros as $key) {
				echo $key."<br>";
			}
		}
	?>

	<hr>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		Login: <input type="text" name="login"><br>
		Senha: <input type="password" name="senha"><br>
		<button type="submit" name="btn-entrar">Entrar </button>
	</form>

</body>
</html>