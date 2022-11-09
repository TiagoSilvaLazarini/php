<?php
include('conexao.php');
header("Content-type:text/html; charset=utf8");
include('protect_menu.php');
$id_admin = $mysqli->real_escape_string($_SESSION['id']);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet"  href="CSS/style.css?v=<?php echo uniqid(); ?>">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
  <title>Lazarini Equipamentos</title>
</head>

<body>
  <header id="header">
    <a id="logo" href="menu.php"><img src="./IMAGENS/logo.png"></a>
    <nav id="nav">
      <button aria-label="Abrir Menu" id="btn-mobile" aria-haspopup="true" aria-controls="menu" aria-expanded="false">Menu
        <span id="hamburger"></span>
      </button>
      <ul id="menu" role="menu">
        <li><a href="CLIENTE/index.php">Clientes</a></li>
        <li><a href="PRODUTO/index.php">Produtos</a></li>
        <li><a href="CURSO/index.php">Cursos</a></li>
        <li><a href="AGENDA/index.php">Agenda</a></li>
        <li><a href="ADMINISTRADOR/index.php">Perfil</a></li>
      </ul>
    </nav>
  </header>
  <div id="faixa"></div>
  <script src="CSS/script.js"></script>
 <script src="../CSS/mask.js"></script>


<div class="mostrar">
    <div class="tira">
        <h2>Aniversariantes</h2>
    </div>
    <?php
        $sql_code = "SELECT * FROM cliente WHERE aniversario = '$data_atual' and id_administrador = '$id_admin' order by nome_cliente DESC";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
    ?>
    <table class="table table-striped">
        <?php 
        if($sql_query->num_rows > 0){
                while($cliente = $sql_query->fetch_assoc()) {
                  $nome= htmlspecialchars($cliente['nome_cliente']);
                  $razao_social = htmlspecialchars($cliente['razao_social']);
                  $data=strtotime($cliente['aniversario']);
                  $data_niver = htmlspecialchars(date("d/m/Y",$data));
             ?>
        <table>
            <tr>
              <th>Cliente</th>
              <td><?php echo $nome; ?></td>
            </tr>
            <tr>
              <th>Razão social</th>
              <td><?php echo $razao_social; ?></td>
            </tr>
            <tr>
              <th>Aniversario</th>
              <td><?php echo $data_niver;?></td>
            </tr>
            <tr>
              <th>Cliente</th>
              <td id="alter"> <a href="CLIENTE/view.php?id_cliente=<?php echo $cliente['id_cliente']; ?>" class="btn btn-alter"><span class="material-icons-outlined">arrow_forward</span></a></td>
            </tr>
        
            <?php } }else{
        ?> <tr><td colspan="3">Nenhum aniversariante encontrado...</td></tr> <?php
      }?>
    </table>
    <?php
        $sql_code = "SELECT * FROM agenda a INNER JOIN cliente c ON c.id_cliente = a.id_cliente WHERE a.data_futura = '$data_atual' and c.id_administrador = '$id_admin' order by a.data DESC";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
    ?>
    <div class="tira">
        <h2>Agenda</h2>
    </div>
    <table class="table table-striped">
        <?php 
        if($sql_query->num_rows > 0){
                while($agenda = $sql_query->fetch_assoc()) {
                  $nome= htmlspecialchars($agenda['nome_cliente']);
                  $comentario = htmlspecialchars($agenda['comentario']);
                  $data=strtotime($agenda['data']);
                  $data_realizada = htmlspecialchars(date("d/m/Y",$data));
             ?>
        <table>
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
              <th>Cliente</th>
              <td id="alter"> <a href="CLIENTE/view.php?id_cliente=<?php echo $agenda['id_cliente']; ?>" class="btn btn-alter"><span class="material-icons-outlined">arrow_forward</span></a></td>
            </tr>
        
            <?php } }else{
        ?> <tr><td colspan="3">Nenhuma agenda encontrada...</td></tr> <?php
      }?>
      
      </table>
      <div class="daw"></div>
</div>

</body>
</html>
</html>