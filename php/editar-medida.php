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

	$sql = "SELECT * FROM Medida WHERE idMedida = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados_medida = mysqli_fetch_array($resultado);
endif;

?>

<div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Editar a medida: "<?php echo $dados_medida['nome']; ?>"</h3>
		<h5 class="light"></h5>
		<form class="form-editar" action="update.php" method="POST">
			<input type="hidden" name= "idMedida" value="<?php echo $dados_medida['idMedida']; ?>">
			<div class="input-field col s12">
				<input type="text" name="nome" id="nome" value="<?php echo $dados_medida['nome']?>">
				<label for="nome">Nome</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="descricao" id="descricao" value="<?php echo $dados_medida['descricao']?>">
				<label for="descricao">Descrição</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="unidade_padrao" id="unidade_padrao" value="<?php echo $dados_medida['unidade_padrao']?>">
				<label for="unidade_padrao">Unidade Padrão</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="responsavel" id="responsavel" value="<?php echo $dados_medida['responsavel']?>">
				<label for="responsavel">Responsável</label>
			</div>
			
			<div class="input-field col s12">
				<div class="input-field col s12">
					<select name="tipo" id="tipo">
						<?php 
							if($dados_medida['tipo'] == 0):
								?> <option value="0">Simples</option>
								<option value="1">Derivada</option> <?php
							else:
								?><option value="1">Derivada</option>   
								<option value="0">Simples</option>
								<?php
							endif;
						?>
					</select>
				<label>Tipo</label>
				</div>
			</div>

			<div class="input-field col s12">
				<div class="input-field col s12">
					<select name="idBase" id="idBase">

						<!-- Projeto atual da base aparece na tela de edição -->
						<?php
							$id = $dados_medida['idBase'];
							$sql = "SELECT * FROM Base WHERE idBase = '$id'";
							$resultado_nome_base = mysqli_query($connect, $sql);
							$resultado_nome_base = mysqli_fetch_array($resultado_nome_base);
						?>
						
						<option value="<?php echo $resultado_nome_base['idBase']; ?>" disabled><?php echo $resultado_nome_base['nome']; ?></option>
						
						<!-- Lista os nomes das organizações -->
						<?php 
							for ($i=0; $i < count($ids_base); $i++):
								$id = $ids_base[$i];
								$sql = "SELECT * FROM Base WHERE idBase = '$id'";
								$resultado_nome_base = mysqli_query($connect, $sql);
								$resultado_nome_base = mysqli_fetch_array($resultado_nome_base);
								?>
								<option value="<?php echo $resultado_nome_base['idBase']; ?>"><?php echo $resultado_nome_base['nome']; ?></option>
							<?php
							endfor;
						?>
					

					</select>
				<label>Base</label>
				</div>
			</div>



			<button type="submit" name="btn-editar-medida" class="btn blue"> <i class="material-icons left">save</i> Salvar </button>
		</form>		
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>