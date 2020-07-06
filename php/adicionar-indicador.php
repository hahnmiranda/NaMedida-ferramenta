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
		<h3 class="light"> Novo Indicador </h3>
		<form action="create.php" method="POST">
			<div class="input-field col s12">
				<div class="input-field col s12">
					<select name="idBase" id="idBase">
						<option value="" disabled selected>Escolha uma Base </option>
						
						<!-- Lista os nomes das organizações -->
						<?php 
							for ($i=0; $i < count($ids_base); $i++):
								$id = $ids_base[$i];
								$sql = "SELECT * FROM base WHERE idBase = '$id'";
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
			<div class="input-field col s12">
				<input type="text" name="nome" id="nome">
				<label for="nome">Nome</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="descricao" id="descricao">
				<label for="descricao">Descrição</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="aceitavel" id="aceitavel">
				<label for="aceitavel"> Aceitável</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="requer_atencao" id="requer_atencao">
				<label for="requer_atencao">Requer Atenção</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="tomar_providencia" id="tomar_providencia">
				<label for="tomar_providencia">Tomar Providência</label>
			</div>
			<button type="submit" name="btn-cadastrar-Indicador" class="btn waves-effect waves-light blue"><i class="material-icons left">save</i> Cadastrar </button>
			<a href="dashboard.php" class="btn green espaco-botao-dashboard-cadastrar"> <i class="material-icons left">dashboard</i>dashboard </a>
		</form>		
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>