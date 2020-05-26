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
		<h3 class="light"> Perguntas e medidas vinculadas a medida: "<?php echo $dados_medida['nome']; ?>"</h3>
		<h5 class="light"></h5>
		<table class="striped responsive-table">
			<thead>
				<tr>
					<th>Perguntas</th>
				</tr>
			</thead>

			<tbody>

				<?php
					// mysqli_num_rows
					$id = $dados_medida['idMedida'];
					$sql = "SELECT * FROM PerguntaMedida WHERE idMedida = '$id'";
					$resultado = mysqli_query($connect, $sql);
					if (mysqli_num_rows($resultado) == 0) {
						echo "<tr><td>Não há perguntas vinculadas a essa medida. </td></tr>";
					}
					while ($dados_pergunta_medida = mysqli_fetch_array($resultado)) {
						$id = $dados_pergunta_medida['idPergunta'];
						$sql = "SELECT nome FROM Pergunta WHERE idPergunta = '$id'";
						$resultado2 = mysqli_query($connect, $sql);
						$pergunta_nome = mysqli_fetch_array($resultado2);
						?> <tr><td>
							<?php echo $pergunta_nome['nome'];?>
						</td>

						<td><a  href="#modal<?php echo $dados_pergunta_medida['idPerguntaMedida']; ?>" class="btn-floating red modal-trigger"><i title="desvincular" class="material-icons">sync_disabled</i></a></td>
						</tr>

						<!-- Modal Structure -->
						<div id="modal<?php echo $dados_pergunta_medida['idPerguntaMedida']; ?>" class="modal">
							<div class="modal-content">
							  	<h4>Opa!</h4>
							  	<p>Tem certeza que deseja desvincular esta pergunta da medida?</p>
							</div>
							<div class="modal-footer">
							</div>
							<div>
								<form action="delete.php" method="POST">
									<input type="hidden" name="idPerguntaMedida" value="<?php echo $dados_pergunta_medida['idPerguntaMedida']; ?>">
									<button type="submit" name="btn-deletar-vinculo-pergunta-medida" class="btn red modal-deletar-botao">Sim, quero desvincular!</button>
									<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat modal-cancelar-botao">Cancelar</a>
								</form>
							</div>
						</div>
						<?php

					}
				?>
			</tbody>			
		</table>

		<a class='btn waves-effect waves-light blue vincular-pergunta-ou-medida-botao' href='vincular-pergunta-medida.php?idMedida=<?php echo $dados_medida['idMedida']; ?>'>vincular pergunta<i class="material-icons left">live_help</i></a>

		<?php if($dados_medida['tipo'] == 1): ?>
		<table class="striped responsive-table">
			<thead>
				<tr>
					<th>Medidas</th>
				</tr>
			</thead>

			<tbody>

				<?php
					// mysqli_num_rows
					$id = $dados_medida['idMedida'];
					$sql = "SELECT * FROM Medida_medida_associada WHERE idMedida = '$id'";
					$resultado = mysqli_query($connect, $sql);
					
					if (mysqli_num_rows($resultado) == 0) {
						echo "<tr><td>Não há outras medidas vinculadas a essa. </td></tr>";
					}

					while ($dados_medida_medida = mysqli_fetch_array($resultado)) {
						$id = $dados_medida_medida['idMedida_associada'];
						$sql = "SELECT nome FROM Medida WHERE idMedida = '$id'";
						$resultado2 = mysqli_query($connect, $sql);
						$pergunta_nome = mysqli_fetch_array($resultado2);
						?> <tr><td>
							<?php echo $pergunta_nome['nome'];?>
						</td>

						<td><a  href="#modal<?php echo $dados_medida_medida['idMedida_derivada']; ?>" class="btn-floating red modal-trigger"><i title="desvincular" class="material-icons">sync_disabled</i></a></td>
						</tr>

						<!-- Modal Structure -->
						<div id="modal<?php echo $dados_medida_medida['idMedida_derivada'];; ?>" class="modal">
							<div class="modal-content">
							  	<h4>Opa!</h4>
							  	<p>Tem certeza que deseja desvincular esta medida?</p>
							</div>
							<div class="modal-footer">
							</div>
							<div>
								<form action="delete.php" method="POST">
									<input type="hidden" name="idMedida_derivada" value="<?php echo $dados_medida_medida['idMedida_derivada']; ?>">
									<button type="submit" name="btn-deletar-vinculo-medida-medida" class="btn red modal-deletar-botao">Sim, quero desvincular!</button>
									<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat modal-cancelar-botao">Cancelar</a>
								</form>
							</div>
						</div>
						<?php
					}
				?>
			</tbody>			
		</table>

		<a class='btn waves-effect waves-light blue vincular-pergunta-ou-medida-botao' href='vincular-medida-medida.php?idMedida=<?php echo $dados_medida['idMedida']; ?>'>vincular medida<i class="material-icons left">dvr</i></a>

	<?php endif; ?>
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>