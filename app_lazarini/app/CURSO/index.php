<?php
include('../conexao.php');
include('../protect.php');
header("Content-type:text/html; charset=utf8");
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
        $sql_code = "SELECT * FROM curso ORDER BY data_ini DESC";
    }else{
      $pesquisa = $mysqli->real_escape_string($_GET['busca']);
            $sql_code = "SELECT * FROM curso 
                WHERE nome_curso LIKE '%$pesquisa%' 
                OR data_ini LIKE '%$pesquisa%'";
    }
    ?>
        <div class="pesquisa">
            <form action="">
              <input name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="pesquisar" type="text">
            </form>
        </div>
        <div class="adiciona">
            <?php
                if($_SESSION['tipo'] == "S") {
             ?><a href="cadastrar.php" class="btn btn-primary">Novo Curso</a>
             <a href="pesquisa_parcela.php" class="btn btn-primary">Cursos pendentes</a><?php } ?>

        </div>
        <div class="tira">
                <h2>Lista de Cursos Disponiveis</h2>
        </div>
  <div class="mostrar">
        <table class="table table-striped">
            <?php 
            $cont_r = 0;
            $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);
            while($result = $sql_query->fetch_assoc()) {
              $cont_r++;
            } ?>
            <p>Numero total de registros: <?php echo $cont_r ?></p>
            <?php
            $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);
            if($sql_query->num_rows > 0){
                    while($curso = $sql_query->fetch_assoc()) {
                    $nome = htmlspecialchars($curso['nome_curso']);
                    $data=strtotime($curso['data_ini']);
                    $data_inicio = htmlspecialchars(date("d/m/Y",$data));
                    $preco_curso = htmlspecialchars($curso['preco_curso']);
                    $limite = htmlspecialchars($curso['limite']);
                     if($curso['data_ini']>$data_atual || $_SESSION['tipo'] == "S"){
                 ?>
            <table>
                <tr>
                  <th>nome</th>
                  <td><?php echo $nome; ?></td>
                </tr>
                <tr>
                  <th>Data de Inicio</th>
                  <td><?php echo $data_inicio; ?></td>
                </tr>
              	<tr>
                  <th>Preço do curso</th>
                  <td><?php echo $preco_curso; ?></td>
                </tr>
                <tr>
                  <th>Limite de Participantes</th>
                  <td><?php 
                  echo $limite ;?></td>
                </tr>
                <tr>
                  <th id="alter">Info</th>
                  <td id="alter"> <a href="view.php?id_curso=<?php echo $curso['id_curso']; ?>" class="btn btn-info"><span class="material-icons-outlined">info</span></a></td>
                </tr>
            
              <?php }}}else{
            ?> <tr><td colspan="3">Nenhum curso encontrado...</td></tr> <?php
          }?>
          </table>
          <div class="daw"></div>
    </div>
    
</body>

</html>