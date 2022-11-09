<?php

$usuario = 'u200861739_sistemalazarin';
$senha = 'j;p&(369@)9]V2+';
$database = 'u200861739_lazarinisistem';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if($mysqli->error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
    }

date_default_timezone_set('America/Sao_Paulo');
$data_atual = date("Y-m-d");


?>