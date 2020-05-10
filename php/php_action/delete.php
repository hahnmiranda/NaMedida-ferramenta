<?php
// iniciando sessão
session_start();
// conexão
require'db_connect.php';

if (isset($_POST['btn-deletar'])):
	$id = mysqli_escape_string($connect, $_POST['id']);

	$sql = "DELETE FROM Medidas_modificacoes WHERE id = '".$id."'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: ../dashboard.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao Deletar!";
		header('Location: ../dashboard.php?erro');
	endif;
endif;