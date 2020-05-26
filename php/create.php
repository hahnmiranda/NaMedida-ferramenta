<?php

// iniciando sessão
session_start();

// conexão
require'db_connect.php';

// dados usuario $dados[]
include_once 'includes/dados-usuario.php';

// cadastrar organizacao
if (isset($_POST['btn-cadastrar-organizacao'])):
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$id = $dados['idUsuario'];

	$sql = "INSERT INTO Organizacao(nome, descricao, idUsuario) VALUES ('$nome', '$descricao', '$id')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: organizacao.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar!";
		header('Location: organizacao.php?erro');
	endif;
endif;

// cadastrar projeto
if (isset($_POST['btn-cadastrar-projeto'])):

	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$responsavel = mysqli_escape_string($connect, $_POST['responsavel']);
	$data_inicio = mysqli_escape_string($connect, $_POST['data_inicio']);
	$data_termino = mysqli_escape_string($connect, $_POST['data_termino']);
	$idOrganizacao = mysqli_escape_string($connect, $_POST['idOrganizacao']);

	$sql = "INSERT INTO Projeto(nome, descricao, responsavel, data_inicio, data_termino, idOrganizacao) VALUES ('$nome', '$descricao', '$responsavel', '$data_inicio', '$data_termino', '$idOrganizacao')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: projeto.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar!";
		header('Location: projeto.php?erro');
	endif;
endif;

// cadastrar base
if (isset($_POST['btn-cadastrar-base'])):

	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$idProjeto = mysqli_escape_string($connect, $_POST['idProjeto']);

	$sql = "INSERT INTO Base(nome, descricao, idProjeto) VALUES ('$nome', '$descricao', '$idProjeto')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: base.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar!";
		header('Location: base.php?erro');
	endif;
endif;

// cadastrar objetivo estrategico
if (isset($_POST['btn-cadastrar-objestrategico'])):

	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$idOrganizacao = mysqli_escape_string($connect, $_POST['idOrganizacao']);

	$sql = "INSERT INTO ObjEstrategico(nome, descricao, idOrganizacao) VALUES ('$nome', '$descricao', '$idOrganizacao')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: objestrategico.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar!";
		header('Location: objestrategico.php?erro');
	endif;
endif;

// cadastrar pergunta
if (isset($_POST['btn-cadastrar-objestrategico'])):

	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$idObjEstrategico = mysqli_escape_string($connect, $_POST['idObjEstrategico']);

	$sql = "INSERT INTO Pergunta(nome, descricao, idObjEstrategico) VALUES ('$nome', '$descricao', '$idObjEstrategico')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: pergunta.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar!";
		header('Location: pergunta.php?erro');
	endif;
endif;

// vincular pergunta a medida
if (isset($_POST['btn-vincular-pergunta-medida'])):

	$idMedida = mysqli_escape_string($connect, $_POST['idMedida']);
	$idPergunta = mysqli_escape_string($connect, $_POST['idPergunta']);

	$sql = "INSERT INTO PerguntaMedida(idMedida, idPergunta) VALUES ('$idMedida', '$idPergunta')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: medida.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar!";
		header('Location: medida.php?erro');
	endif;
endif;
// vincular medida a outra medida
if (isset($_POST['btn-vincular-medida-medida'])):

	$idMedida = mysqli_escape_string($connect, $_POST['idMedida']);
	$idMedida_associada = mysqli_escape_string($connect, $_POST['idMedida_associada']);

	$sql = "INSERT INTO Medida_medida_associada(idMedida, idMedida_associada) VALUES ('$idMedida', '$idMedida_associada')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: medida.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar!";
		header('Location: medida.php?erro');
	endif;
endif;

// cadastrar medida
if (isset($_POST['btn-cadastrar-medida'])):

	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$descricao = mysqli_escape_string($connect, $_POST['descricao']);
	$tipo = mysqli_escape_string($connect, $_POST['tipo']);
	$unidade_padrao = mysqli_escape_string($connect, $_POST['unidade_padrao']);
	$responsavel = mysqli_escape_string($connect, $_POST['responsavel']);
	$idBase = mysqli_escape_string($connect, $_POST['idBase']);

	$sql = "INSERT INTO Medida(nome, descricao, idBase, responsavel, unidade_padrao, tipo) VALUES ('$nome', '$descricao', '$idBase', '$responsavel', '$unidade_padrao', '$tipo')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: medida.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar!";
		header('Location: medida.php?erro');
	endif;
endif;

// cadastrar coleta da medida
if (isset($_POST['btn-cadastrar-coleta-medida'])):

	$idMedida = mysqli_escape_string($connect, $_POST['idMedida']);
	$data_modificacao = mysqli_escape_string($connect, $_POST['data_modificacao']);
	$responsavel = mysqli_escape_string($connect, $_POST['responsavel']);
	$valor = mysqli_escape_string($connect, $_POST['valor']);

	$sql = "INSERT INTO Medida_modificacoes(idMedida, data_modificacao, responsavel, valor) VALUES ('$idMedida', '$data_modificacao', '$responsavel', '$valor')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: medida.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar!";
		header('Location: medida.php?erro');
	endif;
endif;