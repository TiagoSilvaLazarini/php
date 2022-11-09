<?php
include('../conexao.php');
include('../protect.php');
header("Content-type:text/html; charset=utf8");
$id_admin = $mysqli->real_escape_string($_SESSION['id']);
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

    if (!isset($_GET['busca'])) {
      $sql_code = "SELECT * FROM agenda a INNER JOIN cliente c ON c.id_cliente = a.id_cliente where a.data_futura = '$data_atual' and c.id_administrador = '$id_admin'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
    }else{
      $pesquisa = $mysqli->real_escape_string($_GET['busca']);
            $sql_code = "SELECT * FROM agenda a INNER JOIN cliente c ON c.id_cliente = a.id_cliente
                WHERE a.data LIKE '%$pesquisa%' 
                OR a.data_futura LIKE '%$pesquisa%'
                order by a.data";
            $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
    }

    ?>
        <div class="pesquisa">
            <form action="">
              <input name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="pesquisar" type="date"min="2020-01-01"max="2200-12-30">
              <input type="submit" value="pesquisar" class="entrar">
            </form>
        </div>
        <div class="tira">
                <h2>Agenda</h2>
        </div>
  <div class="mostrar">
        <table class="table table-striped">
            <?php 
            if($sql_query->num_rows > 0){
                    while($agenda = $sql_query->fetch_assoc()) {
                      $nome= htmlspecialchars($agenda['nome_cliente']);
                      $comentario = htmlspecialchars($agenda['comentario']);
                      $data=strtotime($agenda['data']);
                      $data_realizada = htmlspecialchars(date("d/m/Y",$data));
                      $data=strtotime($agenda['data_futura']);
                      $data_marcada = htmlspecialchars(date("d/m/Y",$data));
                      $nome_fantasia = htmlspecialchars($agenda['nome_fantasia']);
                 ?>
            <table>
                <tr>
                  <th>Nome fantasia</th>
                  <td><?php echo $nome_fantasia; ?></td>
                </tr>
                <tr>
                  <th>Cliente</th>
                  <td><?php echo $nome; ?></td>
                </tr>
                <tr>
                  <th>Comentario</th>
                  <td><?php echo $comentario?></td>
                </tr>
                <tr>
                  <th>realizada</th>
                  <td><?php echo $data_realizada;?></td>
                </tr>
                <tr>
                  <th>marcada</th>
                  <td><?php echo $data_marcada;?></td>
                </tr>
                <tr>
                  <th>Cliente</th>
                  <td id="alter"> <a href="../CLIENTE/view.php?id_cliente=<?php echo $agenda['id_cliente']; ?>" class="btn btn-alter"><span class="material-icons-outlined">arrow_forward</span></a></td>
                </tr>
            
                <?php } }else{
            ?> <tr><td colspan="3">Nenhuma agenda encontrada...</td></tr> <?php
          }?>
        </table>
        <div class="daw"></div>
    </div>
    
</body>

</html>