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
		
		<?php
			$id = $dados['idUsuario'];
			$sql = "SELECT * FROM organizacao WHERE idUsuario = '$id'";	
			
			$resultado = mysqli_query($connect, $sql);
			
			if (mysqli_num_rows($resultado) > 0):
		?>
		
		<h5 class="light"> Você pode filtrar seus indicadores e medidas pelas entidades abaixo: </h5>
		<h5 class="titulo-filtro-dashboard"> Organizações </h5>

		<table class="striped responsive-table table-filtrar-dashboard">
			<!-- Imprimindo cabeçalhos -->
			<thead>
				<tr>
				<?php
					$contador = count($organizacao);
					foreach ($organizacao as $key) {
						echo "<th>$key</th>";
					}
				?>
				<th>Filtrar medidas</th>
				<th>Filtrar indicadores</th>
				</tr>
			</thead>
			
			<tbody>
				<?php 

					while ($organizacao_dados = mysqli_fetch_array($resultado)):
				?> 
				<tr>
					<td><?php echo $organizacao_dados['nome']; ?></td>
					<td><?php echo $organizacao_dados['descricao']; ?></td>
					<td><a title="Filtrar medidas" href="filtrar-organizacao.php?idOrganizacao=<?php echo $organizacao_dados['idOrganizacao']; ?>" class="btn-floating green"><i class="material-icons">filter_list</i></a></td>
					<td><a title="Filtrar indicadores" href="filtrar-organizacao-indicador.php?idOrganizacao=<?php echo $organizacao_dados['idOrganizacao']; ?>" class="btn-floating blue"><i class="material-icons">filter_list</i></a></td>
				</tr>
				<?php 
				
				endwhile; 
				
				endif;
				?>
			</tbody>
		</table>
		
		<?php
		if (count($ids_setor) > 0):
			$sql = "SELECT * FROM setor WHERE ";	
			
			for($r=0; $r < count($ids_setor); $r++):
				$id = $ids_setor[$r];
				if($r == 0):
					$sql = $sql."idSetor = '$id'";
				else:
					$sql = $sql." OR idSetor = '$id'";
				endif;
			endfor;
			
			$resultado = mysqli_query($connect, $sql);
		?>
		
		<h5 class="titulo-filtro-dashboard"> Setores </h5>

		<table class="striped responsive-table table-filtrar-dashboard">
			<!-- Imprimindo cabeçalhos -->
			<thead>
				<tr>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Filtrar medidas</th>
				<th>Filtrar indicadores</th>
				</tr>
			</thead>
			
			<tbody>
				<?php 

					while ($setor_dados = mysqli_fetch_array($resultado)):
				?> 
				<tr>
					<td><?php echo $setor_dados['nome']; ?></td>
					<td><?php echo $setor_dados['descricao']; ?></td>
					<td><a title="Filtrar medidas" href="filtrar-setor.php?idSetor=<?php echo $setor_dados['idSetor']; ?>" class="btn-floating green"><i class="material-icons">filter_list</i></a></td>
					<td><a title="Filtrar indicadores" href="filtrar-setor-indicador.php?idSetor=<?php echo $setor_dados['idSetor']; ?>" class="btn-floating blue"><i class="material-icons">filter_list</i></a></td>
				</tr>
				<?php 
				
				endwhile; 
				
				endif;
				?>
			</tbody>
		</table>

		<?php
		if (count($ids_setor) > 0):
			$sql = "SELECT * FROM projeto WHERE ";	
			
			for($r=0; $r < count($ids_projeto); $r++):
				$id = $ids_projeto[$r];
				if($r == 0):
					$sql = $sql."idProjeto = '$id'";
				else:
					$sql = $sql." OR idProjeto = '$id'";
				endif;
			endfor;
			
			$resultado = mysqli_query($connect, $sql);
		?>
		
		<h5 class="titulo-filtro-dashboard"> Projetos </h5>

		<table class="striped responsive-table table-filtrar-dashboard">
			<!-- Imprimindo cabeçalhos -->
			<thead>
				<tr>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Filtrar medidas</th>
				<th>Filtrar indicadores</th>
				</tr>
			</thead>
			
			<tbody>
				<?php 

					while ($projeto_dados = mysqli_fetch_array($resultado)):
				?> 
				<tr>
					<td><?php echo $projeto_dados['nome']; ?></td>
					<td><?php echo $projeto_dados['descricao']; ?></td>
					<td><a title="Filtrar medidas" href="filtrar-projeto.php?idProjeto=<?php echo $projeto_dados['idProjeto']; ?>" class="btn-floating green"><i class="material-icons">filter_list</i></a></td>
					<td><a title="Filtrar indicadores" href="filtrar-projeto-indicador.php?idProjeto=<?php echo $projeto_dados['idProjeto']; ?>" class="btn-floating blue"><i class="material-icons">filter_list</i></a></td>
				</tr>
				<?php 
				
				endwhile; 
				
				endif;
				?>
			</tbody>
		</table>
		
		<a class='dropdown-button btn waves-effect waves-light blue botao-tela-dashboard' href='#' data-target='dropdown2'>adicionar registro<i class="material-icons left">add</i></a>

		<a class="waves-effect right blue btn botao-tela-dashboard" href="perfil.php"><i class="material-icons left">person_outline</i>perfil</a>

		<!-- Botão dashboard -->
		  <ul id='dropdown2' class='dropdown-content'>
		    <li><a href="adicionar-organizacao.php">Organizações</a></li>
			<li><a href="adicionar-setor.php">Setor</a></li>
		    <li><a href="adicionar-objestrategico.php">Objetivos Estratégicos</a></li>
		    <li><a href="adicionar-pergunta.php">Perguntas</a></li>
		    <li><a href="adicionar-projeto.php">Projetos</a></li>
		    <li><a href="adicionar-base.php">Bases</a></li>
		    <li><a href="adicionar-medida.php">Medidas</a></li>
		    <li><a href="adicionar-indicador.php">Indicadores</a></li>
		  </ul>
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>