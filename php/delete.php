<?php
// iniciando sessão
session_start();
// conexão
require'db_connect.php';

// deletar organização
if (isset($_POST['btn-deletar-organizacao'])):
	$id = mysqli_escape_string($connect, $_POST['idOrganizacao']);

	// deletando as chaves estrangeiras das organizacoes
	$sql = "UPDATE projeto SET idOrganizacao = NULL WHERE idOrganizacao =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "UPDATE objestrategico SET idOrganizacao = NULL WHERE idOrganizacao =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "DELETE FROM organizacao WHERE idOrganizacao = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: organizacao.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: organizacao.php?erro');
	endif;
endif;

// deletar setor
if (isset($_POST['btn-deletar-setor'])):
	$id = mysqli_escape_string($connect, $_POST['idSetor']);

	// deletando as chaves estrangeiras das bases
	$sql = "UPDATE projeto SET idSetor = NULL WHERE idSetor =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "DELETE FROM setor WHERE idSetor = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: setor.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: setor.php?erro');
	endif;
endif;

// deletar projeto
if (isset($_POST['btn-deletar-projeto'])):
	$id = mysqli_escape_string($connect, $_POST['idProjeto']);

	// deletando as chaves estrangeiras das bases
	$sql = "UPDATE base SET idProjeto = NULL WHERE idProjeto =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "DELETE FROM projeto WHERE idProjeto = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: projeto.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: projeto.php?erro');
	endif;
endif;

// deletar base
if (isset($_POST['btn-deletar-base'])):
	$id = mysqli_escape_string($connect, $_POST['idBase']);

	// deletando as chaves estrangeiras das bases
	$sql = "UPDATE medida SET idBase = NULL WHERE idBase =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "UPDATE indicador SET idBase = NULL WHERE idBase =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "DELETE FROM base WHERE idBase = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: base.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: base.php?erro');
	endif;
endif;

// deletar objetivo estrategico
if (isset($_POST['btn-deletar-objestrategico'])):
	$id = mysqli_escape_string($connect, $_POST['idObjEstrategico']);

	// deletando as chaves estrangeiras das bases
	$sql = "UPDATE pergunta SET idObjEstrategico = NULL WHERE idObjEstrategico =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "DELETE FROM objestrategico WHERE idObjEstrategico = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: objestrategico.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: objestrategico.php?erro');
	endif;
endif;

// deletar pergunta
if (isset($_POST['btn-deletar-pergunta'])):
	$id = mysqli_escape_string($connect, $_POST['idPergunta']);

	// deletando as chaves estrangeiras das bases
	$sql = "UPDATE perguntamedida SET idPergunta = NULL WHERE idPergunta =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "DELETE FROM pergunta WHERE idPergunta = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: pergunta.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: pergunta.php?erro');
	endif;
endif;

// deletar vinculo pergunta medida
if (isset($_POST['btn-deletar-vinculo-pergunta-medida'])):
	$id = mysqli_escape_string($connect, $_POST['idPerguntaMedida']);

	$sql = "DELETE FROM perguntamedida WHERE idPerguntaMedida = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: medida.php?sucesso');
		
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: medida.php?erro');
	endif;
endif;

// deletar vinculo medida medida
if (isset($_POST['btn-deletar-vinculo-medida-medida'])):
	$id = mysqli_escape_string($connect, $_POST['idMedida_derivada']);

	$sql = "DELETE FROM medida_medida_associada WHERE idMedida_derivada = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: medida.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: medida.php?erro');
	endif;
endif;

// deletar vinculo medida indicador
if (isset($_POST['btn-deletar-vinculo-medida-indicador'])):
	$id = mysqli_escape_string($connect, $_POST['idIndicador_medida_associada']);

	$sql = "DELETE FROM indicador_medida_associada WHERE idIndicador_medida_associada = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: indicador.php?sucesso');
		
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: indicador.php?erro');
	endif;
endif;

// deletar medida
if (isset($_POST['btn-deletar-medida'])):
	$id = mysqli_escape_string($connect, $_POST['idMedida']);

	// deletando as chaves estrangeiras das bases
	$sql = "UPDATE perguntamedida SET idMedida = NULL WHERE idMedida =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	// deletando as chaves estrangeiras das bases
	$sql = "UPDATE medida_medida_associada SET idMedida = NULL WHERE idMedida =  '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "DELETE FROM medida WHERE idMedida = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: medida.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: medida.php?erro');
	endif;
endif;

// deletar indicador
if (isset($_POST['btn-deletar-indicador'])):
	$id = mysqli_escape_string($connect, $_POST['idIndicador']);

	// deletando as chaves estrangeiras das bases
	$sql = "DELETE FROM indicador_medida_associada WHERE idIndicador = '".$id."'";
	$resultado = mysqli_query($connect, $sql);

	$sql = "DELETE FROM indicador WHERE idIndicador = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: indicador.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: indicador.php?erro');
	endif;
endif;

// deletar coleta da medida
if (isset($_POST['btn-deletar-coleta-medida'])):
	$id = mysqli_escape_string($connect, $_POST['idMedida_modificacoes']);

	$sql = "DELETE FROM medida_modificacoes WHERE idMedida_modificacoes = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: medida.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: medida.php?erro');
	endif;
endif;

































