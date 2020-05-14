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
		<h5 class="light"> Veja abaixo a quantidade de itens que você já registrou</h5>
		<table class="striped responsive-table">
			<!-- Imprimindo cabeçalhos -->
			<thead>
				<tr>
				<?php
					$contador = count($dashboard);
					foreach ($dashboard as $key) {
						echo "<th>$key</th>";
					}
				?>
				</tr>
			</thead>
			
			<tbody>
				<?php
					$sql = "SELECT * FROM `Medida`";
					$resultado = mysqli_query($connect, $sql);

					if(mysqli_num_rows($resultado) > 0):

					while($dados = mysqli_fetch_array($resultado)):
				?>
				<tr>
					<td><?php echo $dados['nome']; ?></td>
					<td><?php echo $dados['descricao']; ?></td>
					<td><?php echo $dados['unidade_padrao']; ?></td>
					<td><?php echo $dados['responsavel']; ?></td>
					<td>
						<?php 
							if($dados['tipo'] == 0):
								echo "Simples";
							else:
								echo "Derivada";
							endif;
						?>
					</td>
					<td><a href="editar.php?id=<?php echo $dados['idMedida']; ?>" class="btn-floating blue"><i class="material-icons">edit</i></a></td>
					<td><a href="#modal<?php echo $dados['idMedida']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>

					<!-- Modal Structure -->
					<div id="modal<?php echo $dados['idMedida']; ?>" class="modal">
						<div class="modal-content">
						  <h4>Opa!</h4>
						  <p>Tem certeza que deseja excluir este registro?</p>
						</div>
						<div class="modal-footer">
						  
						</div>
						<div>
							<form action="php_action/delete.php" method="POST">
								<input type="hidden" name="id" value="<?php echo $dados['idMedida']; ?>">
								<button type="submit" name="btn-deletar" class="btn red"> Sim, quero deletar! </button>

								<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
							</form>
						</div>
					</div>

				</tr>
				<?php 
				endwhile; 
				else: ?>
					<tr>
						<td> - </td>
						<td> - </td>
						<td> - </td>
						<td> - </td>
						<td> - </td>
					</tr>
				<?php
				endif;
				mysqli_close($connect);
				?>
			</tbody>
		</table>
		<br>

		<a class='dropdown-button btn waves-effect waves-light' href='#' data-target='dropdown2'>adicionar registro<i class="material-icons left">add</i></a>

		<!-- Botão dashboard -->
						  <ul id='dropdown2' class='dropdown-content'>
						    <li><a href="#!">Organizações</a></li>
						    <li><a href="#!">Objetivos Estratégicos</a></li>
						    <li><a href="#!">Perguntas</a></li>
						    <li><a href="#!">Projetos</a></li>
						    <li><a href="#!">Bases</a></li>
						    <li><a href="#!">Medidas</a></li>
						    <li><a href="#!">Indicadores</a></li>
						  </ul>
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>