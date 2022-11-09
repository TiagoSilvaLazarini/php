<?php
include('../conexao.php');
include('../protect.php');
header("Content-type:text/html;charset=utf8");
if(isset($_GET['id_produto'])){
    $id = $mysqli->real_escape_string($_GET['id_produto']);
 }
 $sql_code = "SELECT * FROM produto_n WHERE id_produto = '$id'";
 $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
 $produto = $sql_query->fetch_assoc();
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


        <div class="tira">
                <h2>Produto:</h2>
        </div>
  <div class="mostrar">
        <table class="table table-striped">
            <?php 
            if($sql_query->num_rows > 0){
              $id_produto = htmlspecialchars($produto['id_produto']);
              $descricao = htmlspecialchars($produto['descricao']);
              $preco = htmlspecialchars($produto['preco_produto']);
              $categoria = htmlspecialchars($produto['categoria']);
              $nome = htmlspecialchars($produto['nome_produto']);
         ?>
    <table>
          <th>Nome</th>
          <td><?php echo $nome;?></td>
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
          <th>Categoria</th>
          <td><?php echo $categoria;?></td>
        </tr>
        <?php
        if($_SESSION['tipo'] == "S") {
        ?>
        <tr>
          <th id="alter">Alterar</th>
          <td id="alter"> <a href="alterar.php?id_produto=<?php echo $id_produto; ?>" class="btn btn-alter"><span class="material-icons-outlined">settings</span></a></td>
                </tr><?php } ?>
            
                <?php }else{
            ?> <tr><td colspan="3">Nenhum produto encontrado...</td></tr> <?php
          }?>
        </table>
        <div class="daw"></div>
    </div>
    
</body>

</html>