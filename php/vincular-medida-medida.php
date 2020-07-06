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

if(isset($_GET['idMedida'])):
	$id = mysqli_escape_string($connect, $_GET['idMedida']);

	$sql = "SELECT * FROM medida WHERE idMedida = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados_medida = mysqli_fetch_array($resultado);
endif;

?>

<div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Vincular Medida </h3>

		<form action="create.php" method="POST">
		<input type="hidden" name= "idMedida" value="<?php echo $dados_medida['idMedida']; ?>">

			<table class="striped responsive-table">
			<thead>
				<tr>
					<th>Medidas já vinculadas à "<?php echo $dados_medida['nome'];?>"</th>
				</tr>
			</thead>

			<tbody>

				<?php
					// mysqli_num_rows
					$id = $dados_medida['idMedida'];
					$sql = "SELECT * FROM medida_medida_associada WHERE idMedida = '$id'";
					$resultado = mysqli_query($connect, $sql);
					if (mysqli_num_rows($resultado) == 0) {
						echo "<tr><td>Não há outras medidas vinculadas a essa. </td></tr>";
					}
					$medidas_ja_vinculadas = array();
					while ($dados_medida_medida = mysqli_fetch_array($resultado)) {
						$id = $dados_medida_medida['idMedida'];
						$medidas_ja_vinculadas[] = $dados_medida_medida['idMedida'];
						$sql = "SELECT nome FROM Medida WHERE idMedida = '$id'";
						$resultado2 = mysqli_query($connect, $sql);
						$medida_nome = mysqli_fetch_array($resultado2);
						?> <tr><td>
							<?php echo $medida_nome['nome'];?>
						</td></tr><?php
					}
				?>
			</tbody>			
		</table>

		<div class="input-field col s12">
			<div class="input-field col s12">
				<select name="idMedida_associada" id="idMedida_associada">
					<option value="" disabled selected>Escolha uma medida para vincular </option>
					
					<!-- Lista os nomes das organizações -->
					<?php 
						for ($i=0; $i < count($ids_medida); $i++):
							$id = $ids_medida[$i];
							$sql = "SELECT * FROM medida WHERE idMedida = '$id'";
							$resultado_nome_medida = mysqli_query($connect, $sql);
							$resultado_nome_medida = mysqli_fetch_array($resultado_nome_medida);
							$contador = 0;
							for ($r=0; $r < count($perguntas_ja_vinculadas); $r++) { 
								if ($perguntas_ja_vinculadas[$r] == $resultado_nome_medida['idMedida']) {
									$contador++;
								}
							}
							if ($contador == 0) {							
							?>
							<option value="<?php echo $resultado_nome_medida['idMedida']; ?>"><?php echo $resultado_nome_medida['nome']; ?></option>
							
						<?php 
							}
						endfor;
					?>
				</select>
			<label>Selecione a Medida</label>
			</div>
		</div>
		
		<button type="submit" name="btn-vincular-medida-medida" class="btn waves-effect waves-light blue"><i class="material-icons left">save</i> Vincular </button>
		</form>		
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>