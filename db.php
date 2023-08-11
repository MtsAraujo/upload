<?php
$servernname = "localhost";
$username = "root";
$password = "";
$db = "citybox-restrict";

$con = mysqli_connect($servernname, $username, $password, $db);
if (!$con) {
    die("Erro ao acessar o Banco de Dados: " . mysqli_connect_error());
}