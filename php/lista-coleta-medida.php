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

	$sql = "SELECT * FROM medida WHERE idMedida = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados_medida = mysqli_fetch_array($resultado);
endif;

?>

<div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Coletas da medida: "<?php echo $dados_medida['nome']; ?>"</h3>
		<h5 class="light">Coletas já realizadas</h5>

		<table class="striped responsive-table">
			<thead>
				<tr>
					<th>Data da Coleta</th>
					<th>Responsável</th>
					<th>Valor</th>
				</tr>
			</thead>

			<tbody>

				<?php
					// mysqli_num_rows
					$id = $dados_medida['idMedida'];
					$sql = "SELECT * FROM medida_modificacoes WHERE idMedida = '$id'";
					$resultado = mysqli_query($connect, $sql);
					if (mysqli_num_rows($resultado) == 0) {
						echo "<tr><td>Não foi realizada nenhuma coleta para a medida. </td><td>-</td><td>-</td></tr>";
					}
					while ($coleta_medida = mysqli_fetch_array($resultado)) {
						$id = $coleta_medida['idMedida_modificacoes'];
						$sql = "SELECT * FROM medida_modificacoes WHERE idMedida_modificacoes = '$id'";
						$resultado2 = mysqli_query($connect, $sql);
						$modificacoes_dados = mysqli_fetch_array($resultado2);
						?> <tr><td>
							<?php echo $modificacoes_dados['data_modificacao'];?>
						</td>
						<td>
							<?php echo $modificacoes_dados['responsavel'];?>
						</td>
						<td>
							<?php echo $modificacoes_dados['valor'];?>
						</td>
						<td><a href="editar-coleta-medida.php?idMedida_modificacoes=<?php echo $modificacoes_dados['idMedida_modificacoes']; ?>" class="btn-floating blue"><i class="material-icons">edit</i></a></td>
						
						<td><a  href="#modal<?php echo $modificacoes_dados['idMedida_modificacoes']; ?>" class="btn-floating red modal-trigger"><i title="desvincular" class="material-icons">delete</i></a></td>
						</tr>

						<!-- Modal Structure -->
						<div id="modal<?php echo $modificacoes_dados['idMedida_modificacoes']; ?>" class="modal">
							<div class="modal-content">
							  	<h4>Opa!</h4>
							  	<p>Tem certeza que deseja excluir esta coleta?</p>
							</div>
							<div class="modal-footer">
							</div>
							<div>
								<form action="delete.php" method="POST">
									<input type="hidden" name="idMedida_modificacoes" value="<?php echo $modificacoes_dados['idMedida_modificacoes']; ?>">
									<button type="submit" name="btn-deletar-coleta-medida" class="btn red modal-deletar-botao">Sim, quero excluir!</button>
									<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat modal-cancelar-botao">Cancelar</a>
								</form>
							</div>
						</div>
						<?php

					}
				?>
			</tbody>			
		</table>
		<a href="nova-coleta-medida.php?idMedida=<?php echo $dados_medida['idMedida']; ?>" class="waves-effect waves-light blue btn vincular-pergunta-ou-medida-botao">Coletar<i class="material-icons left">add_circle_outline</i></a>
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>