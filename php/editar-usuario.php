<?php
// conexao
include_once 'db_connect.php';

// header
include_once 'includes/header.php';

// message
include_once 'includes/message.php';

// sessao
session_start();

// verificando se usuario esta logado
// caso não esteja retorna para tela login
if (!isset($_SESSION['logado'])) {
	header('Location: ../index.php');
}

// dados usuario $dados[]
include_once 'includes/dados-usuario.php';

// incluindo cabecalhos
include_once 'includes/cabecalhos.php';

// incluindo navbar
include_once 'includes/navbar.php';

// incluindo os estilos
include_once 'includes/style.php';

?>

<div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Editar perfil de <?php echo $dados['nome']; ?></h3>
		<h5 class="light"> Digite uma nova senha somente se deseja alterá-la</h5>
		<form class="form-editar" action="update.php" method="POST">
			<input type="hidden" name= "idUsuario" value="<?php echo $dados['idUsuario']; ?>">
			<div class="input-field col s12">
				<input type="text" name="nome" id="nome" value="<?php echo $dados['nome']?>">
				<label for="nome">Nome</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="login" id="login" value="<?php echo $dados['login']?>">
				<label for="login">Login</label>
			</div>
			<div class="input-field col s12">
				<input type="password" name="senha" id="senha">
				<label for="senha">Senha</label>
			</div>

			<button type="submit" name="btn-editar-usuario" class="btn blue"> <i class="material-icons left">save</i> Salvar </button>

		</form>		
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>