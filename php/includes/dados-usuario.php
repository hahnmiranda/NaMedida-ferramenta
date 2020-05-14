<?php
//dados
// selecionando o usuário da sessão
$id = $_SESSION['idUsuario'];
// buscando os dados do usuário com a id
$sql = "SELECT * FROM Usuario WHERE idUsuario = '$id'";
// conectando com o banco
$resultado = mysqli_query($connect, $sql);
// salvando os dados em um array
$dados = mysqli_fetch_array($resultado);

// Abaixo estão em arrays todos os ids dos dados
// do usuário para cada tipo de registro

// organizacao
$id = $dados['idUsuario'];
$sql = "SELECT * FROM Organizacao";
$resultado = mysqli_query($connect, $sql);
$contador_organizacao = mysqli_num_rows($resultado);
$organizacao_array = array();
while ($organizacao_dados = mysqli_fetch_array($resultado)) {
	array_push($organizacao_array, $organizacao_dados);
}
print_r($organizacao_array);
