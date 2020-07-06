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

if(isset($_GET['idIndicador'])):
	$id = mysqli_escape_string($connect, $_GET['idIndicador']);

	$sql = "SELECT * FROM indicador WHERE idIndicador = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados_indicador = mysqli_fetch_array($resultado);
endif;

?>

<div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Vincular Medida </h3>

		<form action="create.php" method="POST">
		<input type="hidden" name= "idIndicador" value="<?php echo $dados_indicador['idIndicador']; ?>">

		<div class="input-field col s12">
			<div class="input-field col s12">
				<select name="idIndicador_medida_associada" id="idIndicador_medida_associada">
					<option value="" disabled selected>Escolha uma medida para vincular </option>
					
					<?php 
						$id = $dados_indicador['idBase'];
						$sql = "SELECT * FROM medida WHERE idBase = '$id'";
						$resultado = mysqli_query($connect, $sql);

						while($nome_medidas = mysqli_fetch_array($resultado)):
							?>
							<option value="<?php echo $nome_medidas['idMedida']; ?>"><?php echo $nome_medidas['nome']; ?></option>
							<?php
						endwhile;
					?>
				</select>
			<label>Selecione a Medida</label>
			</div>
		</div>
		
		<button type="submit" name="btn-vincular-medida-indicador" class="btn waves-effect waves-light blue"><i class="material-icons left">save</i> Vincular </button>
		</form>		
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>