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

// select
if(isset($_GET['idOrganizacao'])):
	$id = mysqli_escape_string($connect, $_GET['idOrganizacao']);

	$sql = "SELECT * FROM organizacao WHERE idOrganizacao = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados_organizacao = mysqli_fetch_array($resultado);
endif;

?>

<div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Editar <?php echo $dados_organizacao['nome']; ?></h3>
		<h5 class="light"></h5>
		<form class="form-editar" action="update.php" method="POST">
			<input type="hidden" name= "idOrganizacao" value="<?php echo $dados_organizacao['idOrganizacao']; ?>">
			<div class="input-field col s12">
				<input type="text" name="nome" id="nome" value="<?php echo $dados_organizacao['nome']?>">
				<label for="nome">Nome</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="descricao" id="descricao" value="<?php echo $dados_organizacao['descricao']?>">
				<label for="descricao">Descrição</label>
			</div>

			<button type="submit" name="btn-editar-organizacao" class="btn blue"> <i class="material-icons left">save</i> Salvar </button>

		</form>		
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>