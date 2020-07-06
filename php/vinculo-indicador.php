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
if(isset($_GET['idIndicador'])):
	$id = mysqli_escape_string($connect, $_GET['idIndicador']);
	$sql = "SELECT * FROM indicador WHERE idIndicador = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados_indicador = mysqli_fetch_array($resultado);
endif;

?>

<div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Medidas vinculadas ao indicador: "<?php echo $dados_indicador['nome']; ?>"</h3>
		<h5 class="light"></h5>
		<table class="striped responsive-table">
			<thead>
				<tr>
					<th>Medidas</th>
				</tr>
			</thead>

			<tbody>

				<?php
					// mysqli_num_rows
					$id = $dados_indicador['idIndicador'];
					$sql = "SELECT * FROM indicador_medida_associada WHERE idIndicador = '$id'";
					$resultado = mysqli_query($connect, $sql);
					if (mysqli_num_rows($resultado) == 0) {
						echo "<tr><td>Não há medidas vinculadas a esse indicador. </td></tr>";
					}
					while ($dados_medida_indicador = mysqli_fetch_array($resultado)) {
						$id = $dados_medida_indicador['idMedida'];
						$sql = "SELECT * FROM medida WHERE idMedida = '$id'";
						$resultado2 = mysqli_query($connect, $sql);
						$medida_nome = mysqli_fetch_array($resultado2);
						?> <tr><td>
							<?php echo $medida_nome['nome'];?>
						</td>

						<td><a  href="#modal<?php echo $dados_medida_indicador['idIndicador_medida_associada']; ?>" class="btn-floating red modal-trigger"><i title="desvincular" class="material-icons">sync_disabled</i></a></td>
						</tr>

						<!-- Modal Structure -->
						<div id="modal<?php echo $dados_medida_indicador['idIndicador_medida_associada']; ?>" class="modal">
							<div class="modal-content">
							  	<h4>Opa!</h4>
							  	<p>Tem certeza que deseja desvincular esta medida do indicador?</p>
							</div>
							<div class="modal-footer">
							</div>
							<div>
								<form action="delete.php" method="POST">
									<input type="hidden" name="idIndicador_medida_associada" value="<?php echo $dados_medida_indicador['idIndicador_medida_associada']; ?>">
									<button type="submit" name="btn-deletar-vinculo-medida-indicador" class="btn red modal-deletar-botao">Sim, quero desvincular!</button>
									<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat modal-cancelar-botao">Cancelar</a>
								</form>
							</div>
						</div>
						<?php

					}
				?>
			</tbody>			
		</table>

		<a class='btn waves-effect waves-light blue vincular-pergunta-ou-medida-botao' href='vincular-medida-indicador.php?idIndicador=<?php echo $dados_indicador['idIndicador']; ?>'>vincular medida<i class="material-icons left">live_help</i></a>
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>