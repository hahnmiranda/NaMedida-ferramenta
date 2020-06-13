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
if(isset($_GET['idProjeto'])):
	$id = mysqli_escape_string($connect, $_GET['idProjeto']);

	$sql = "SELECT * FROM Projeto WHERE idProjeto = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados_projeto = mysqli_fetch_array($resultado);
endif;

?>

<div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Editar <?php echo $dados_projeto['nome']; ?></h3>
		<h5 class="light"></h5>
		<form class="form-editar" action="update.php" method="POST">
			<input type="hidden" name= "idProjeto" value="<?php echo $dados_projeto['idProjeto']; ?>">
			<div class="input-field col s12">
				<div class="input-field col s12">
					<select name="idSetor" id="idSetor">

						<!-- Organizacao atual do projeto aparece na tela de edição -->
						<?php
							$id = $dados_projeto['idSetor'];
							$sql = "SELECT * FROM Setor WHERE idSetor = '$id'";
							$resultado_nome_setor = mysqli_query($connect, $sql);
							$resultado_nome_setor = mysqli_fetch_array($resultado_nome_setor);
						?>
						
						<option value="<?php echo $resultado_nome_setor['idSetor']; ?>" disabled><?php echo $resultado_nome_setor['nome']; ?></option>
						
						<!-- Lista os nomes das organizações -->
						<?php 
							for ($i=0; $i < count($ids_setor); $i++):
								$id = $ids_setor[$i];
								$sql = "SELECT * FROM Setor WHERE idSetor = '$id'";
								$resultado_nome_setor = mysqli_query($connect, $sql);
								$resultado_nome_setor = mysqli_fetch_array($resultado_nome_setor);
								?>
								<option value="<?php echo $resultado_nome_setor['idSetor']; ?>"><?php echo $resultado_nome_setor['nome']; ?></option>
							<?php
							endfor;
						?>
					</select>
				<label>Setor</label>
				</div>
			</div>
			<div class="input-field col s12">
				<input type="text" name="nome" id="nome" value="<?php echo $dados_projeto['nome']?>">
				<label for="nome">Nome</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="descricao" id="descricao" value="<?php echo $dados_projeto['descricao']?>">
				<label for="descricao">Descrição</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="responsavel" id="responsavel" value="<?php echo $dados_projeto['responsavel']?>">
				<label for="responsavel">Responsável</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="data_inicio" id="data_inicio" value="<?php echo $dados_projeto['data_inicio']?>">
				<label for="data_inicio">Data/Horário de Início</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="data_termino" id="data_termino" value="<?php echo $dados_projeto['data_termino']?>">
				<label for="data_termino">Data/Horário de Término</label>
			</div>
			<button type="submit" name="btn-editar-projeto" class="btn blue"> <i class="material-icons left">save</i> Salvar </button>
		</form>		
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>