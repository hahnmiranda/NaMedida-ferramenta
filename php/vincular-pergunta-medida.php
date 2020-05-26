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

	$sql = "SELECT * FROM Medida WHERE idMedida = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados_medida = mysqli_fetch_array($resultado);
endif;

?>

<div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Vincular Pergunta à Medida </h3>

		<form action="create.php" method="POST">
		<input type="hidden" name= "idMedida" value="<?php echo $dados_medida['idMedida']; ?>">

			<table class="striped responsive-table">
			<thead>
				<tr>
					<th>Perguntas já vinculadas a medida "<?php echo $dados_medida['nome'];?>"</th>
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
					$perguntas_ja_vinculadas = array();
					while ($dados_pergunta_medida = mysqli_fetch_array($resultado)) {
						$id = $dados_pergunta_medida['idPergunta'];
						$perguntas_ja_vinculadas[] = $dados_pergunta_medida['idPergunta'];
						$sql = "SELECT nome FROM Pergunta WHERE idPergunta = '$id'";
						$resultado2 = mysqli_query($connect, $sql);
						$pergunta_nome = mysqli_fetch_array($resultado2);
						?> <tr><td>
							<?php echo $pergunta_nome['nome'];?>
						</td></tr><?php
					}
				?>
			</tbody>			
		</table>

		<div class="input-field col s12">
			<div class="input-field col s12">
				<select name="idPergunta" id="idPergunta">
					<option value="" disabled selected>Escolha uma pergunta para vincular </option>
					
					<!-- Lista os nomes das organizações -->
					<?php 
						for ($i=0; $i < count($ids_pergunta); $i++):
							$id = $ids_pergunta[$i];
							$sql = "SELECT * FROM Pergunta WHERE idPergunta = '$id'";
							$resultado_nome_pergunta = mysqli_query($connect, $sql);
							$resultado_nome_pergunta = mysqli_fetch_array($resultado_nome_pergunta);
							$contador = 0;
							for ($r=0; $r < count($perguntas_ja_vinculadas); $r++) { 
								if ($perguntas_ja_vinculadas[$r] == $resultado_nome_pergunta['idPergunta']) {
									$contador++;
								}
							}
							if ($contador == 0) {							
							?>
							<option value="<?php echo $resultado_nome_pergunta['idPergunta']; ?>"><?php echo $resultado_nome_pergunta['nome']; ?></option>
							
						<?php 
							}
						endfor;
					?>
				</select>
			<label>Selecione a Pergunta</label>
			</div>
		</div>
		
		<button type="submit" name="btn-vincular-pergunta-medida" class="btn waves-effect waves-light blue"><i class="material-icons left">save</i> Vincular </button>
		</form>		
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>