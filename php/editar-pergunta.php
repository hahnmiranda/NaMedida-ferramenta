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
if(isset($_GET['idPergunta'])):
	$id = mysqli_escape_string($connect, $_GET['idPergunta']);

	$sql = "SELECT * FROM Pergunta WHERE idPergunta = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados_pergunta = mysqli_fetch_array($resultado);
endif;

?>

<div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Editar a pergunta: "<?php echo $dados_pergunta['nome']; ?>"</h3>
		<h5 class="light"></h5>
		<form class="form-editar" action="update.php" method="POST">
			<input type="hidden" name= "idPergunta" value="<?php echo $dados_pergunta['idPergunta']; ?>">
			<div class="input-field col s12">
				<input type="text" name="nome" id="nome" value="<?php echo $dados_pergunta['nome']?>">
				<label for="nome">Nome</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="descricao" id="descricao" value="<?php echo $dados_pergunta['descricao']?>">
				<label for="descricao">Descrição</label>
			</div>


			<div class="input-field col s12">
				<div class="input-field col s12">
					<select name="idObjEstrategico" id="idObjEstrategico">

						<!-- Projeto atual da base aparece na tela de edição -->
						<?php
							$id = $dados_pergunta['idObjEstrategico'];
							$sql = "SELECT * FROM ObjEstrategico WHERE idObjEstrategico = '$id'";
							$resultado_nome_objestrategico = mysqli_query($connect, $sql);
							$resultado_nome_objestrategico = mysqli_fetch_array($resultado_nome_objestrategico);
						?>
						
						<option value="<?php echo $resultado_nome_objestrategico['idObjEstrategico']; ?>" disabled><?php echo $resultado_nome_objestrategico['nome']; ?></option>
						
						<!-- Lista os nomes das organizações -->
						<?php 
							for ($i=0; $i < count($ids_objestrategico); $i++):
								$id = $ids_objestrategico[$i];
								$sql = "SELECT * FROM ObjEstrategico WHERE idObjEstrategico = '$id'";
								$resultado_nome_objestrategico = mysqli_query($connect, $sql);
								$resultado_nome_objestrategico = mysqli_fetch_array($resultado_nome_objestrategico);
								?>
								<option value="<?php echo $resultado_nome_objestrategico['idObjEstrategico']; ?>"><?php echo $resultado_nome_objestrategico['nome']; ?></option>
							<?php
							endfor;
						?>
					

					</select>
				<label>Objetivo Estratégico</label>
				</div>
			</div>



			<button type="submit" name="btn-editar-pergunta" class="btn blue"> <i class="material-icons left">save</i> Salvar </button>
		</form>		
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>