<?php
// iniciando sessão
session_start();
// conexão
require'db_connect.php';

// editar usuario
if (isset($_POST['btn-editar-usuario'])):

	$id = mysqli_escape_string($connect, $_POST['idUsuario']);
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = mysqli_escape_string($connect, $_POST['senha']);

	if (!empty($senha)) {
		$sql = "UPDATE usuario SET nome = '".$nome."', login = '".$login."', senha = '".$senha."' WHERE idUsuario = '".$id."'";	
	} else {
		$sql = "UPDATE usuario SET nome = '".$nome."', login = '".$login."' WHERE idUsuario = '".$id."'";	
	}	

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: dashboard.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar!";
		header('Location: dashboard.php?erro');
	endif;
endif;

// editar organizacao
if (isset($_POST['btn-editar-organizacao'])):

	$id = mysqli_escape_string($connect, $_POST['idOrganizacao']);
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);

	if ($descricao == "") {
		$sql = "UPDATE organizacao SET nome = '".$nome."' WHERE idOrganizacao = '".$id."'";
	} else {
		$sql = "UPDATE organizacao SET nome = '".$nome."', descricao = '".$descricao."' WHERE idOrganizacao = '".$id."'";
	}

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: organizacao.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar!";
		header('Location: organizacao.php?erro');
	endif;
endif;

// editar setor
if (isset($_POST['btn-editar-setor'])):

	$id = mysqli_escape_string($connect, $_POST['idSetor']);
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$responsavel = mysqli_escape_string($connect, $_POST['responsavel']);
	$idOrganizacao = mysqli_escape_string($connect, $_POST['idOrganizacao']);

	$sql = "UPDATE setor SET nome = '".$nome."', idOrganizacao = '".$idOrganizacao."', descricao = '".$descricao."', responsavel = '".$responsavel."' WHERE idSetor = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: setor.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar!";
		header('Location: setor.php?erro');
	endif;
endif;

// editar projeto
if (isset($_POST['btn-editar-projeto'])):

	$id = mysqli_escape_string($connect, $_POST['idProjeto']);
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$responsavel = mysqli_escape_string($connect, $_POST['responsavel']);
	$data_inicio = mysqli_escape_string($connect, $_POST['data_inicio']);
	$data_termino = mysqli_escape_string($connect, $_POST['data_termino']);
	$idSetor = mysqli_escape_string($connect, $_POST['idSetor']);

	$sql = "UPDATE projeto SET nome = '".$nome."', idSetor = '".$idSetor."', descricao = '".$descricao."', responsavel = '".$responsavel."', data_inicio = '".$data_inicio."', data_termino = '".$data_termino."' WHERE idProjeto = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: projeto.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar!";
		header('Location: projeto.php?erro');
	endif;
endif;

// editar base
if (isset($_POST['btn-editar-base'])):

	$id = mysqli_escape_string($connect, $_POST['idBase']);
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$idProjeto = mysqli_escape_string($connect, $_POST['idProjeto']);

	$sql = "UPDATE base SET nome = '".$nome."', idProjeto = '".$idProjeto."', descricao = '".$descricao."' WHERE idBase = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: base.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar!";
		header('Location: base.php?erro');
	endif;
endif;

// editar objetivo estrategico
if (isset($_POST['btn-editar-objestrategico'])):

	$id = mysqli_escape_string($connect, $_POST['idObjEstrategico']);
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$idOrganizacao = mysqli_escape_string($connect, $_POST['idOrganizacao']);

	$sql = "UPDATE objestrategico SET nome = '".$nome."', idOrganizacao = '".$idOrganizacao."', descricao = '".$descricao."' WHERE idObjEstrategico = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: objestrategico.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar!";
		header('Location: objestrategico.php?erro');
	endif;
endif;

// editar pergunta
if (isset($_POST['btn-editar-pergunta'])):

	$id = mysqli_escape_string($connect, $_POST['idPergunta']);
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$idObjEstrategico = mysqli_escape_string($connect, $_POST['idObjEstrategico']);

	$sql = "UPDATE pergunta SET nome = '".$nome."', idObjEstrategico = '".$idObjEstrategico."', descricao = '".$descricao."' WHERE idPergunta = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: pergunta.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar!";
		header('Location: pergunta.php?erro');
	endif;
endif;

// editar medida
if (isset($_POST['btn-editar-medida'])):

	$id = mysqli_escape_string($connect, $_POST['idMedida']);
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$idBase = mysqli_escape_string($connect, $_POST['idBase']);
	$unidade_padrao = mysqli_escape_string($connect, $_POST['unidade_padrao']);
	$responsavel = mysqli_escape_string($connect, $_POST['responsavel']);
	$tipo = mysqli_escape_string($connect, $_POST['tipo']);

	$sql = "UPDATE medida SET nome = '".$nome."', idBase = '".$idBase."', descricao = '".$descricao."', unidade_padrao = '".$unidade_padrao."', responsavel = '".$responsavel."', tipo = '".$tipo."' WHERE idMedida = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: medida.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar!";
		header('Location: medida.php?erro');
	endif;
endif;

// editar medida
if (isset($_POST['btn-editar-indicador'])):

	$id = mysqli_escape_string($connect, $_POST['idIndicador']);
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$idBase = mysqli_escape_string($connect, $_POST['idBase']);
	$aceitavel = mysqli_escape_string($connect, $_POST['aceitavel']);
	$requer_atencao = mysqli_escape_string($connect, $_POST['requer_atencao']);
	$tomar_providencia = mysqli_escape_string($connect, $_POST['tomar_providencia']);

	$sql = "UPDATE indicador SET nome = '".$nome."', idBase = '".$idBase."', descricao = '".$descricao."', aceitavel = '".$aceitavel."', requer_atencao = '".$requer_atencao."', tomar_providencia = '".$tomar_providencia."' WHERE idIndicador = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: indicador.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar!";
		header('Location: indicador.php?erro');
	endif;
endif;

// editar pergunta
if (isset($_POST['btn-editar-coleta-medida'])):

	$id = mysqli_escape_string($connect, $_POST['idMedida_modificacoes']);
	$data_modificacao = mysqli_escape_string($connect, $_POST['data_modificacao']);
	$responsavel = mysqli_escape_string($connect, $_POST['responsavel']);
	$valor = mysqli_escape_string($connect, $_POST['valor']);

	$sql = "UPDATE medida_modificacoes SET data_modificacao = '".$data_modificacao."', responsavel = '".$responsavel."', valor = '".$valor."' WHERE idMedida_modificacoes = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: medida.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar!";
		header('Location: medida.php?erro');
	endif;
endif;
















