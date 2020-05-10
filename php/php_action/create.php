<?php
// iniciando sessão
session_start();
// conexão
require'db_connect.php';
// clear
function clear($input){
	global $connect;
	// sql
	$var = mysqli_escape_string($connect, $input);
	// xss
	$var = htmlspecialchars($var);
	return $var;
}

if (isset($_POST['btn-cadastrar'])):
	$nome = clear($_POST['nome']);
	$sobrenome = clear($_POST['sobrenome']);
	$email = clear($_POST['email']);
	$idade = clear($_POST['idade']);

	$sql = "INSERT INTO clientes(nome, sobrenome, email, idade) VALUES ('$nome', '$sobrenome', '$email', '$idade')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: ../index.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar!";
		header('Location: ../index.php?erro');
	endif;
endif;