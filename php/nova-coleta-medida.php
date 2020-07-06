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
if(isset($_GET['idMedida'])):
	$id = mysqli_escape_string($connect, $_GET['idMedida']);

	$sql = "SELECT * FROM medida WHERE idMedida = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados_medida = mysqli_fetch_array($resultado);
endif;

date_default_timezone_set('America/Sao_Paulo'); 
?>

<div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Nova Coleta </h3>
		<form action="create.php" method="POST">
			<input type="hidden" name= "idMedida" value="<?php echo $dados_medida['idMedida']; ?>">
			<input type="hidden" name= "data_modificacao" value="<?php echo date('Y-m-d H:i:s'); ?>">
			<div class="input-field col s12">
				<input type="text" name="responsavel" id="responsavel">
				<label for="responsavel">Responsável</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="valor" id="valor">
				<label for="valor">Valor</label>
			</div>

			<button type="submit" name="btn-cadastrar-coleta-medida" class="btn waves-effect waves-light blue"><i class="material-icons left">save</i> Salvar </button>
			<a href="dashboard.php" class="btn green espaco-botao-dashboard-cadastrar"> <i class="material-icons left">dashboard</i>dashboard </a>
		</form>		
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>