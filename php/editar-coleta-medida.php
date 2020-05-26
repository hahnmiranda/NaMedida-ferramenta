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
if(isset($_GET['idMedida_modificacoes'])):
	$id = mysqli_escape_string($connect, $_GET['idMedida_modificacoes']);

	$sql = "SELECT * FROM Medida_modificacoes WHERE idMedida_modificacoes = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados_modificacoes = mysqli_fetch_array($resultado);
endif;

date_default_timezone_set('America/Sao_Paulo'); 
?>

<div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Editar coleta:</h3>
		<h5 class="light"></h5>
		<form class="form-editar" action="update.php" method="POST">
			<input type="hidden" name= "idMedida_modificacoes" value="<?php echo $dados_modificacoes['idMedida_modificacoes']; ?>">
			<input type="hidden" name= "data_modificacao" value="<?php echo date('Y-m-d H:i:s'); ?>">
			<div class="input-field col s12">
				<input type="text" name="responsavel" id="responsavel" value="<?php echo $dados_modificacoes['responsavel']?>">
				<label for="responsavel">Responsável</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="valor" id="valor" value="<?php echo $dados_modificacoes['valor']?>">
				<label for="valor">Valor</label>
			</div>

			<button type="submit" name="btn-editar-coleta-medida" class="btn blue"> <i class="material-icons left">save</i> Salvar </button>
		</form>		
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>