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
if(isset($_GET['idBase'])):
	$id = mysqli_escape_string($connect, $_GET['idBase']);

	$sql = "SELECT * FROM Base WHERE idBase = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados_base = mysqli_fetch_array($resultado);
endif;

?>

<div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Editar <?php echo $dados_base['nome']; ?></h3>
		<h5 class="light"></h5>
		<form class="form-editar" action="update.php" method="POST">
			<div class="input-field col s12">
				<div class="input-field col s12">
					<select name="idProjeto" id="idProjeto">

						<!-- Projeto atual da base aparece na tela de edição -->
						<?php
							$id = $dados_base['idProjeto'];
							$sql = "SELECT * FROM Projeto WHERE idProjeto = '$id'";
							$resultado_nome_projeto = mysqli_query($connect, $sql);
							$resultado_nome_projeto = mysqli_fetch_array($resultado_nome_projeto);
						?>
						
						<option value="<?php echo $resultado_nome_projeto['idProjeto']; ?>" disabled><?php echo $resultado_nome_projeto['nome']; ?></option>
						
						<!-- Lista os nomes das organizações -->
						<?php 
							for ($i=0; $i < count($ids_projeto); $i++):
								$id = $ids_projeto[$i];
								$sql = "SELECT * FROM Projeto WHERE idProjeto = '$id'";
								$resultado_nome_projeto = mysqli_query($connect, $sql);
								$resultado_nome_projeto = mysqli_fetch_array($resultado_nome_projeto);
								?>
								<option value="<?php echo $resultado_nome_projeto['idProjeto']; ?>"><?php echo $resultado_nome_projeto['nome']; ?></option>
							<?php
							endfor;
						?>
					</select>
				<label>Projeto</label>
				</div>
			</div>
			<input type="hidden" name= "idBase" value="<?php echo $dados_base['idBase']; ?>">
			<div class="input-field col s12">
				<input type="text" name="nome" id="nome" value="<?php echo $dados_base['nome']?>">
				<label for="nome">Nome</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="descricao" id="descricao" value="<?php echo $dados_base['descricao']?>">
				<label for="descricao">Descrição</label>
			</div>
			<button type="submit" name="btn-editar-base" class="btn blue"> <i class="material-icons left">save</i> Salvar </button>
		</form>		
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>