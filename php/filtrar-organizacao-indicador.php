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
if(isset($_GET['idOrganizacao'])):
	$id = mysqli_escape_string($connect, $_GET['idOrganizacao']);
	
	$sql = "SELECT * FROM setor WHERE idOrganizacao = '$id'";
	$resultado = mysqli_query($connect, $sql);
	
	$ids_setores = array();
	$ids_projetos = array();
	$ids_bases = array();
	$ids_indicadores = array();
	
	if(mysqli_num_rows($resultado) > 0):
		
		while($setores_dados = mysqli_fetch_array($resultado)):
			$ids_setores[] = $setores_dados['idSetor'];
		endwhile;
		
		$sql = "SELECT * FROM projeto WHERE ";
		for($i = 0; $i < count($ids_setores); $i++):
			if($i == 0):
				$id = $ids_setores[$i];
				$sql = $sql."idSetor = '$id'";
			else:
				$id = $ids_setores[$i];
				$sql = $sql." OR idSetor = '$id'";
			endif;
		endfor;
	
		$resultado = mysqli_query($connect, $sql);
	
		if (mysqli_num_rows($resultado) > 0):
			
			while ($projetos_dados = mysqli_fetch_array($resultado)):
				$ids_projetos[] = $projetos_dados['idProjeto'];
			endwhile;
			
			
			$sql = "SELECT * FROM base WHERE ";
			for($i = 0; $i < count($ids_projetos); $i++):
				if($i == 0):
					$id = $ids_projetos[$i];
					$sql = $sql."idProjeto = '$id'";
				else:
					$id = $ids_projetos[$i];
					$sql = $sql." OR idProjeto = '$id'";
				endif;
			endfor;
			
			$resultado = mysqli_query($connect, $sql);
			
			if (mysqli_num_rows($resultado) > 0):
				
				while ($bases_dados = mysqli_fetch_array($resultado)):
					$ids_bases[] = $bases_dados['idBase'];
				endwhile;

				$sql = "SELECT * FROM indicador WHERE ";
				for($i = 0; $i < count($ids_bases); $i++):
					if($i == 0):
						$id = $ids_bases[$i];
						$sql = $sql."idBase = '$id'";
					else:
						$id = $ids_bases[$i];
						$sql = $sql." OR idBase = '$id'";
					endif;
				endfor;
				
				$resultado = mysqli_query($connect, $sql);
				
				if (mysqli_num_rows($resultado) > 0):
					
					while($indicadores_dados = mysqli_fetch_array($resultado)):
						$ids_indicadores[] = $indicadores_dados['idIndicador'];
					endwhile;

				endif;
				
			endif;

		endif;
	endif;
	
endif;
?>

<div class="row">
	<div class="col s12 m9 push-m2">
	<?php if(count($ids_indicadores) > 0): ?>
		<h3 class="light"> Esta é sua lista de indicador(es) filtrada pela organização</h3>
		<h5 class="light"></h5>
		<table class="striped responsive-table">
			<!-- Imprimindo cabeçalhos -->
			<thead>
				<tr>
				<!-- Buscando dados da base no arquivo cabecalhos.php -->
				<?php
					
					$contador = count($indicador);
					foreach ($indicador as $key) {
						echo "<th>$key</th>";
					}
				?>
				</tr>
			</thead>
			
			<tbody>
				<!-- Criando a variável sql para buscar no bd -->
				<?php
					$sql = "SELECT * FROM indicador WHERE ";
					
					for ($i=0; $i < count($ids_bases); $i++) {
						if ($i == 0):
							// buscando as bases que tenham os ids de objetivo estrategicos
							// pertencentes ao usuário
							$sql = $sql."idBase = '$ids_bases[$i]'";
						else:
							$sql = $sql." or idBase = '$ids_bases[$i]'";
						endif;
					}
					$resultado = mysqli_query($connect, $sql);
					
					if (mysqli_num_rows($resultado) > 0):
					
					while ($indicadores_dados = mysqli_fetch_array($resultado)):
				?> 
				<tr> 
					<!-- Imprimindo os dados da base -->
					<td><?php
					// buscando nome dos projetos aos quais a base pertence
						$id = $indicadores_dados['idBase'];
						$sql = "SELECT nome FROM base WHERE idBase = '$id'";
						$base_nome = mysqli_query($connect, $sql);
						$base_nome = mysqli_fetch_array($base_nome);
						echo $base_nome['nome'];
					?></td>
					<td><?php echo $indicadores_dados['nome']; ?></td>
					<td><?php echo $indicadores_dados['descricao']; ?></td>
					<td><?php echo $indicadores_dados['aceitavel']; ?></td>
					<td><?php echo $indicadores_dados['requer_atencao']; ?></td>
					<td><?php echo $indicadores_dados['tomar_providencia']; ?></td>

					<td><a href="vinculo-indicador.php?idIndicador=<?php echo $indicadores_dados['idIndicador']; ?>" class="btn-floating green"><i class="material-icons">sync</i></a></td>
					
					<td><a href="editar-indicador.php?idIndicador=<?php echo $indicadores_dados['idIndicador']; ?>" class="btn-floating blue"><i class="material-icons">edit</i></a></td>
					<td><a href="#modal<?php echo $indicadores_dados['idIndicador']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>

					<!-- Modal Structure -->
					<div id="modal<?php echo $indicadores_dados['idIndicador']; ?>" class="modal">
						<div class="modal-content">
						  	<h4>Opa!</h4>
						  	<p>Tem certeza que deseja excluir este registro? (Você irá perder todos os registros vinculados a este.)</p>
						</div>
						<div class="modal-footer">
						</div>
						<div>
							<form action="delete.php" method="POST">
								<input type="hidden" name="idIndicador" value="<?php echo $indicadores_dados['idIndicador']; ?>">
								<button type="submit" name="btn-deletar-indicador" class="btn red modal-deletar-botao">Sim, quero deletar!</button>
								<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat modal-cancelar-botao">Cancelar</a>
							</form>
						</div>
					</div>
				</tr>
				<?php 
				endwhile; 
				endif;
				else:
				?>
				<h3 class="light"> Nenhum indicador encontrado para esta organização</h3>
				<?php
				endif;
				?>
			</tbody>
		</table>	
	</div>
</div>

<?php
// footer
include_once 'includes/footer.php';
?>