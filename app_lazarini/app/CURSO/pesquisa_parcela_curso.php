<?php
include('../conexao.php');
include('../protect_s.php');
header("Content-type:text/html; charset=utf8");
if(isset($_GET['id_curso'])){
    $id_curso = $mysqli->real_escape_string($_GET['id_curso']);
 }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <link rel="stylesheet"  href="../CSS/style.css?v=<?php echo uniqid(); ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
  <title>Lazarini Equipamentos</title>
</head>

<body>
  <header id="header">
    <a id="logo" href="../menu.php"><img src="../IMAGENS/logo.png"></a>
    <nav id="nav">
      <button aria-label="Abrir Menu" id="btn-mobile" aria-haspopup="true" aria-controls="menu" aria-expanded="false">Menu<span id="hamburger"></span></button>
      <ul id="menu" role="menu">
        <li><a href="../CLIENTE/index.php">Clientes</a></li>
        <li><a href="../PRODUTO/index.php">Produtos</a></li>
        <li><a href="../CURSO/index.php">Cursos</a></li>
        <li><a href="../AGENDA/index.php">Agenda</a></li>
        <li><a href="../ADMINISTRADOR/index.php">Perfil</a></li>
      </ul>
    </nav>
  </header>
  <div id="faixa"></div>
  <script src="../CSS/script.js"></script>
  <script src="../CSS/mask.js"></script>

    <?php
        $sql_code = "SELECT * FROM curso c 
        INNER JOIN curso_cliente cc ON cc.id_curso = c.id_curso
        INNER JOIN cliente cl ON cl.id_cliente = cc.id_cliente
        INNER JOIN curso_parcela cp ON cp.id_curso_cliente = cc.id_curso_cliente
        WHERE cp.pago LIKE '%pendente%' AND c.id_curso = '$id_curso'
        ORDER BY cp.id_curso_cliente";

    ?>
        <div class="tira">
                <h2>Lista de pendencia de parcela - Clientes</h2>
        </div>
  <div class="mostrar">
        <table class="table table-striped"> 
            <?php 
            $cont_r = 0;
            $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);
            $ant = 0;
            while($result = $sql_query->fetch_assoc()) {
              if($result['id_curso_cliente'] != $ant){
                $ant = $result['id_curso_cliente'];
              $cont_r++;}
            } ?>
            <p>Numero total de registros: <?php echo $cont_r ?></p>
            <?php
            $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);
            if($sql_query->num_rows > 0){
                $ant = 0;
                
                    while($curso = $sql_query->fetch_assoc()) {
                        $nome = htmlspecialchars($curso['nome_cliente']);
                        $preco_venda_curso = htmlspecialchars($curso['preco_venda_curso']);
                        $forma_pagamento = htmlspecialchars($curso['forma_pagamento']);
                        $n_parcela = htmlspecialchars($curso['n_parcela']);
                        $nome_aluno_curso = htmlspecialchars($curso['nome_aluno_curso']);
                    
                    if($curso['id_curso_cliente'] != $ant){
                        $ant = $curso['id_curso_cliente'];
                 ?>
            <table>
            <tr>
                  <th>nome</th>
                  <td><?php echo $nome; ?></td>
                </tr>
                <tr>
                  <th>Preço pago</th>
                  <td><?php echo $preco_venda_curso; ?></td>
                </tr>
              	<tr>
                  <th>Forma de pagamento</th>
                  <td><?php echo $forma_pagamento; ?></td>
                </tr>
              	<tr>
                  <th>Nº de parcelas</th>
                  <td><?php echo $n_parcela."x parcelas"; ?></td>
                </tr>
                <tr>
                  <th>Nome do aluno</th>
                  <td><?php echo $nome_aluno_curso; ?></td>
                </tr>
                <tr>
                  <th>Controle de parcelas</th>
                  <td id="alter"> <a href="controle_parcela.php?id_curso_cliente=<?php echo $curso['id_curso_cliente']; ?>" class="btn btn-alter"><span class="material-icons-outlined">arrow_forward</span></a></td>
                </tr>
        
            <?php }else{

            }}}else{
                ?> <tr><td colspan="3">Nenhum curso encontrado...</td></tr> <?php
              }  ?>
        </table>
        <div class="daw"></div>
    </div>
    
</body>

</html>