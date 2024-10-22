<?php

$usuario = '';
$senha = '';
$database = '';
$host = '';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if($mysqli->error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
    }

date_default_timezone_set('America/Sao_Paulo');
$data_atual = date("Y-m-d");


?>
