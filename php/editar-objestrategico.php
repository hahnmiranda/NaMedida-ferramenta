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
if(isset($_GET['idObjEstrategico'])):
	$id = mysqli_escape_string($connect, $_GET['idObjEstrategico']);

	$sql = "SELECT * FROM ObjEstrategico WHERE idObjEstrategico = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados_objestrategico = mysqli_fetch_array($resultado);
endif;

?>

<div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Editar <?php echo $dados_objestrategico['nome']; ?></h3>
		<h5 class="light"></h5>
		<form class="form-editar" action="update.php" method="POST">
			<input type="hidden" name= "idObjEstrategico" value="<?php echo $dados_objestrategico['idObjEstrategico']; ?>">
			<div class="input-field col s12">
				<div class="input-field col s12">
					<select name="idOrganizacao" id="idOrganizacao">

						<!-- Organizacao atual do projeto aparece na tela de edição -->
						<?php
							$id = $dados_objestrategico['idOrganizacao'];
							$sql = "SELECT * FROM Organizacao WHERE idOrganizacao = '$id'";
							$resultado_nome_organizacao = mysqli_query($connect, $sql);
							$resultado_nome_organizacao = mysqli_fetch_array($resultado_nome_organizacao);
						?>
						
						<option value="<?php echo $resultado_nome_organizacao['idOrganizacao']; ?>" disabled><?php echo $resultado_nome_organizacao['nome']; ?></option>
						
						<!-- Lista os nomes das organizações -->
						<?php 
							for ($i=0; $i < count($ids_organizacao); $i++):
								$id = $ids_organizacao[$i];
								$sql = "SELECT * FROM Organizacao WHERE idOrganizacao = '$id'";
								$resultado_nome_organizacao = mysqli_query($connect, $sql);
								$resultado_nome_organizacao = mysqli_fetch_array($resultado_nome_organizacao);
								?>
								<option value="<?php echo $resultado_nome_organizacao['idOrganizacao']; ?>"><?php echo $resultado_nome_organizacao['nome']; ?></option>
							<?php
							endfor;
						?>
					

					</select>
				<label>Organização</label>
				</div>
			</div>
			<div class="input-field col s12">
				<input type="text" name="nome" id="nome" value="<?php echo $dados_objestrategico['nome']?>">
				<label for="nome">Nome</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="descricao" id="descricao" value="<?php echo $dados_objestrategico['descricao']?>">
				<label for="descricao">Descrição</label>
			</div>
			<button type="submit" name="btn-editar-objestrategico" class="btn blue"> <i class="material-icons left">save</i> Salvar </button>
		</form>		
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>