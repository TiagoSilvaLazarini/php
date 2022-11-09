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
        $sql_code = "SELECT * FROM produto_n";
    }else{
      $pesquisa = $mysqli->real_escape_string($_GET['busca']);
            $sql_code = "SELECT * FROM produto_n 
                WHERE nome_produto LIKE '%$pesquisa%' 
                OR descricao LIKE '%$pesquisa%'
                OR preco_produto LIKE '%$pesquisa%'
                OR categoria LIKE '%$pesquisa%'";
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
             ?><a href="cadastrar.php" class="btn btn-primary">Novo Produto</a><?php } ?>

        </div>
        <div class="tira">
                <h2>Lista de Produtos</h2>
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
                    while($produto = $sql_query->fetch_assoc()) {
                      $id_produto = htmlspecialchars($produto['id_produto']);
                      $nome = htmlspecialchars($produto['nome_produto']);
                      $descricao = htmlspecialchars($produto['descricao']);
                      $preco = htmlspecialchars($produto['preco_produto']);
                      $catogoria = htmlspecialchars($produto['categoria']);
                 ?>
            <table>
                  <th>Nome</th>
                  <td><?php echo $nome; ?></td>
                </tr>
                <tr>
                  <th>Descrição</th>
                  <td><?php echo $descricao; ?></td>
                </tr>
                <tr>
                  <th>Preço</th>
                  <td><?php echo "R$ ". $preco;?></td>
                </tr>
                <tr>
                  <th>Catogoria</th>
                  <td><?php echo $catogoria;?></td>
                </tr>
                <?php
                if($_SESSION['tipo'] == "S") {
                ?>
                <tr>
                  <th id="alter">Alterar</th>
                  <td id="alter"> <a href="alterar.php?id_produto=<?php echo $id_produto; ?>" class="btn btn-alter"><span class="material-icons-outlined">settings</span></a></td>
                </tr><?php } ?>
            
                <?php } }else{
            ?> <tr><td colspan="3">Nenhum produto encontrado...</td></tr> <?php
          }?>
        </table>
        <div class="daw"></div>
    </div>
    
</body>

</html>