<?php
// conexao
include_once 'php_action/db_connect.php';

// header
include_once '../includes/header.php';

// message
include_once '../includes/message.php';

// sessao
session_start();

// verificacao
if (!isset($_SESSION['logado'])) {
	header('Location: ../index.php');
}

//dados
// selecionando o usuário da sessão
$id = $_SESSION['idUsuario'];
// buscando os dados do usuário com a id
$sql = "SELECT * FROM Usuario WHERE idUsuario = '$id'";
// conectando com o banco
$resultado = mysqli_query($connect, $sql);
// salvando os dados em um array
$dados = mysqli_fetch_array($resultado);

?>

<div class="row">
	<div class="col s12 m7 push-m3">
		<h3 class="light"> Olá <?php echo$dados['nome']; ?></h3>
		<table class="striped responsive-table">
			<thead>
				<tr>
					<th>Nome:</th>
					<th>Unidade Padrão:</th>
					<th>Descricao:</th>
					<th>Valor:</th>
					<th>Responsável:</th>
					<th>Tipo:</th>
					<th>Data Modificação:</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
					$sql = "SELECT * FROM `Medida_modificacoes`";
					$resultado = mysqli_query($connect, $sql);

					if(mysqli_num_rows($resultado) > 0):

					while($dados = mysqli_fetch_array($resultado)):
				?>
				<tr>
					<td><?php echo $dados['nome']; ?></td>
					<td><?php echo $dados['unidade_padrao']; ?></td>
					<td><?php echo $dados['descricao']; ?></td>
					<td><?php echo $dados['valor']; ?></td>
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
					<td><?php echo $dados['data_modificacao']; ?></td>
					<td><a href="editar.php?id=<?php echo $dados['idMedida_modificacoes']; ?>" class="btn-floating blue"><i class="material-icons">edit</i></a></td>
					<td><a href="#modal<?php echo $dados['idMedida_modificacoes']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>

					<!-- Modal Structure -->
					<div id="modal<?php echo $dados['idMedida_modificacoes']; ?>" class="modal">
						<div class="modal-content">
						  <h4>Opa!</h4>
						  <p>Tem certeza que deseja excluir este registro?</p>
						</div>
						<div class="modal-footer">
						  
						</div>
						<div>
							<form action="php_action/delete.php" method="POST">
								<input type="hidden" name="id" value="<?php echo $dados['idMedida_modificacoes']; ?>">
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
					</tr>
				<?php
				endif;
				mysqli_close($connect);
				?>
			</tbody>
		</table>
		<br>
		<a href="adicionar.php" class="btn">Adicionar cliente</a>
	</div>
</div>

<?php
// footer
include_once '../includes/footer.php';
?>