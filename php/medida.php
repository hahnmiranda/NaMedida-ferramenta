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
	<div class="col s12 m9 push-m2">
		<h3 class="light"> Olá <?php echo $dados['nome']; ?>,</h3>
		<h5 class="light">Essa é a sua lista de medidas </h5>
		
		<table class="striped responsive-table">
			<!-- Imprimindo cabeçalhos -->
			<thead>
				<tr>
				<!-- Buscando dados da base no arquivo cabecalhos.php -->
				<?php
					$contador = count($medida);
					foreach ($medida as $key) {
						echo "<th>$key</th>";
					}
				?>
				</tr>
			</thead>
			
			<tbody>
				<!-- Criando a variável sql para buscar no bd -->
				<?php
					$sql = "SELECT * FROM Medida WHERE ";
					for ($i=0; $i < count($ids_base); $i++) {
						if ($i == 0):
							// buscando as bases que tenham os ids de objetivo estrategicos
							// pertencentes ao usuário
							$sql = $sql."idBase = '$ids_base[$i]'";
						else:
							$sql = $sql." or idBase = '$ids_base[$i]'";
						endif;
					}
					$resultado = mysqli_query($connect, $sql);

					while ($medida_dados = mysqli_fetch_array($resultado)):
				?> 
				<tr> 
					<!-- Imprimindo os dados da base -->
					<td><?php echo $medida_dados['nome']; ?></td>
					<td><?php echo $medida_dados['descricao']; ?></td>
					<td><?php echo $medida_dados['unidade_padrao']; ?></td>
					<td><?php echo $medida_dados['responsavel']; ?></td>
					<td><?php 
						if($medida_dados['tipo'] == 0):
							echo "Simples";
						else:
							echo "Derivada";
						endif;
					?></td>
					<td><?php
					// buscando nome dos projetos aos quais a base pertence
						$id = $medida_dados['idBase'];
						$sql = "SELECT nome FROM Base WHERE idBase = '$id'";
						$base_nome = mysqli_query($connect, $sql);
						$base_nome = mysqli_fetch_array($base_nome);
						echo $base_nome['nome'];
					?></td>
					<td><a href="vinculo-medida.php?idMedida=<?php echo $medida_dados['idMedida']; ?>" class="btn-floating green"><i class="material-icons">sync</i></a></td>
					
					<td><a href="lista-coleta-medida.php?idMedida=<?php echo $medida_dados['idMedida']; ?>" class="btn-floating orange"><i class="material-icons">remove_red_eye</i></a></td>
					<td><a href="editar-medida.php?idMedida=<?php echo $medida_dados['idMedida']; ?>" class="btn-floating blue"><i class="material-icons">edit</i></a></td>
					<td><a href="#modal<?php echo $medida_dados['idMedida']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>

					<!-- Modal Structure -->
					<div id="modal<?php echo $medida_dados['idMedida']; ?>" class="modal">
						<div class="modal-content">
						  	<h4>Opa!</h4>
						  	<p>Tem certeza que deseja excluir este registro? (Você irá perder todos os registros vinculados a este.)</p>
						</div>
						<div class="modal-footer">
						</div>
						<div>
							<form action="delete.php" method="POST">
								<input type="hidden" name="idMedida" value="<?php echo $medida_dados['idMedida']; ?>">
								<button type="submit" name="btn-deletar-medida" class="btn red modal-deletar-botao">Sim, quero deletar!</button>
								<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat modal-cancelar-botao">Cancelar</a>
							</form>
						</div>
					</div>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
		<br>
		<a class='btn waves-effect waves-light blue' href='adicionar-medida.php'>adicionar medida<i class="material-icons left">add</i></a>
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>