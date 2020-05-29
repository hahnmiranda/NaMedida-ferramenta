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
		<h3 class="light"> Novo Projeto </h3>
		<form action="create.php" method="POST">
			<div class="input-field col s12">
				<div class="input-field col s12">
					<select name="idOrganizacao" id="idOrganizacao">
						<option value="" disabled selected>Escolha uma Organização</option>
						
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
				<input type="text" name="nome" id="nome">
				<label for="nome">Nome</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="descricao" id="descricao">
				<label for="descricao">Descrição</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="responsavel" id="responsavel">
				<label for="responsavel">Responsável</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="data_inicio" id="data_inicio">
				<label for="data_inicio">Data/Horário de Início</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="data_termino" id="data_termino">
				<label for="data_termino">Data/Horário do Término</label>
			</div>
			<button type="submit" name="btn-cadastrar-projeto" class="btn waves-effect waves-light blue"><i class="material-icons left">save</i> Cadastrar </button>
			<a href="dashboard.php" class="btn green espaco-botao-dashboard-cadastrar"> <i class="material-icons left">dashboard</i>dashboard </a>
		</form>		
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>