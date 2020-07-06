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
	<div class="col s12 m7 push-m3">
		<h3 class="light"> Olá <?php echo $dados['nome']; ?>,</h3>
		<h5 class="light">Essa é a lista de suas organizações</h5>
		<h5 class="light">Organização pode ter vários setores </h5>
		<table class="striped responsive-table">
			<!-- Imprimindo cabeçalhos -->
			<thead>
				<tr>
				<?php
					$contador = count($organizacao);
					foreach ($organizacao as $key) {
						echo "<th>$key</th>";
					}
				?>
				</tr>
			</thead>
			
			<tbody>
				<?php 
					$sql = "SELECT * FROM organizacao WHERE idUsuario = '$id'";	
					
					$resultado = mysqli_query($connect, $sql);

					while ($organizacao_dados = mysqli_fetch_array($resultado)):
				?> 
				<tr>
					<td><?php echo $organizacao_dados['nome']; ?></td>
					<td><?php echo $organizacao_dados['descricao']; ?></td>
					<td><a href="editar-organizacao.php?idOrganizacao=<?php echo $organizacao_dados['idOrganizacao']; ?>" class="btn-floating blue"><i class="material-icons">edit</i></a></td><td><a href="#modal<?php echo $organizacao_dados['idOrganizacao']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>

					<!-- Modal Structure -->
					<div id="modal<?php echo $organizacao_dados['idOrganizacao']; ?>" class="modal">
						<div class="modal-content">
						  	<h4>Opa!</h4>
						  	<p>Tem certeza que deseja excluir este registro? (Você irá perder todos os registros vinculados a este.)</p>
						</div>
						<div class="modal-footer">
						</div>
						<div>
							<form action="delete.php" method="POST">
								<input type="hidden" name="idOrganizacao" value="<?php echo $organizacao_dados['idOrganizacao']; ?>">
								<button type="submit" name="btn-deletar-organizacao" class="btn red modal-deletar-botao">Sim, quero deletar!</button>
								<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat modal-cancelar-botao">Cancelar</a>
							</form>
						</div>
					</div>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
		<br>
		<a class='btn waves-effect waves-light blue' href='adicionar-organizacao.php'>adicionar organização<i class="material-icons left">add</i></a>
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>