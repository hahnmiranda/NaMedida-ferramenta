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
		<h5 class="light"> Veja abaixo a quantidade de registros que você possui</h5>
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
				<td> <?php echo count($ids_organizacao) ?></td>
				<td> <?php echo count($ids_objestrategico) ?> </td>
				<td> <?php echo count($ids_pergunta) ?> </td>
				<td> <?php echo count($ids_projeto) ?> </td>
				<td> <?php echo count($ids_base) ?> </td>
				<td> <?php echo count($ids_medida) ?> </td>
				<td>  <?php echo count($ids_indicador) ?></td>
			</tbody>
		</table>
		<br>

		<a class='dropdown-button btn waves-effect waves-light blue' href='#' data-target='dropdown2'>adicionar registro<i class="material-icons left">add</i></a>

		<a class="waves-effect right blue btn" href="perfil.php"><i class="material-icons left">person_outline</i>perfil</a>

		<!-- Botão dashboard -->
		  <ul id='dropdown2' class='dropdown-content'>
		    <li><a href="adicionar-organizacao.php">Organizações</a></li>
		    <li><a href="adicionar-objestrategico.php">Objetivos Estratégicos</a></li>
		    <li><a href="#!">Perguntas</a></li>
		    <li><a href="adicionar-projeto.php">Projetos</a></li>
		    <li><a href="adicionar-base.php">Bases</a></li>
		    <li><a href="#!">Medidas</a></li>
		    <li><a href="#!">Indicadores</a></li>
		  </ul>
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>