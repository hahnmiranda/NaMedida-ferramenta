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
		<h3 class="light"> Olá <?php echo $dados['nome']; ?></h3>
		<h5 class="light"></h5>
		<table class="striped responsive-table">
			<!-- Imprimindo cabeçalhos -->
			<thead>
				<tr>
				<?php
					$contador = count($usuario);
					foreach ($usuario as $key) {
						echo "<th>$key</th>";
					}
				?>
				</tr>
			</thead>
			
			<tbody>
				<?php 
					$sql = "SELECT * FROM Usuario WHERE idUsuario = '$id'";
					$resultado = mysqli_query($connect, $sql);
					while ($usuario_dados = mysqli_fetch_array($resultado)) {
				?> 
				<td><?php echo $usuario_dados['nome']; ?> </td>
				<td> <?php echo $usuario_dados['login']; }?>  </td>
			</tbody>
		</table>
		<br>

		<a href="editar-usuario.php" class="waves-effect waves-light blue btn">Alterar informações<i class="material-icons left">dialpad</i></a>
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>