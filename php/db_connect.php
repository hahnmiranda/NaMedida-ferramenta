<?php
// conexao com banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "bd_na_medida";

$connect = mysqli_connect($servername, $username, $password, $db_name);
mysqli_set_charset($connect, "utf8");

if(mysqli_connect_error()):
	echo "Falha na conexão".mysqli_connect_error();
endif;