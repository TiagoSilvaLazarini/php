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

    if (isset($_POST['busca'])) {
        
      $pesquisa = $mysqli->real_escape_string($_POST['busca']);
            
        if ($_POST['busca2'] != null) {
            $pesquisa2 = $mysqli->real_escape_string($_POST['busca2']);
            $sql_code = "SELECT * FROM cliente c 
            INNER JOIN venda v ON v.id_cliente  = c.id_cliente
            INNER JOIN administrador a ON a.id_administrador = c.id_administrador
            INNER JOIN produto_n p ON p.id_produto  = v.id_produto
            WHERE p.nome_produto LIKE '%$pesquisa%' AND(c.estado LIKE '%$pesquisa2%'
            OR c.cidade LIKE '%$pesquisa2%'
            OR c.bairro LIKE '%$pesquisa2%')
            ORDER BY c.email_cliente";
        }else{
          $sql_code = "SELECT * FROM cliente c 
            INNER JOIN venda v ON v.id_cliente  = c.id_cliente
            INNER JOIN administrador a ON a.id_administrador = c.id_administrador
            INNER JOIN produto_n p ON p.id_produto  = v.id_produto
            WHERE p.nome_produto LIKE '%$pesquisa%'
            ORDER BY c.email_cliente";
        }
    }

    ?>
        <div class="pesquisa">
            <form action=""method="POST">
              <input name="busca" value="<?php if(isset($_POST['busca'])) echo $_POST['busca']; ?>" placeholder="pesquisar produto" type="text">
              <input name="busca2" value="<?php if(isset($_POST['busca2'])) echo $_POST['busca2']; ?>" placeholder="pesquisar cidade,etc..." type="text">
              <input type="submit" value="pesquisar" class="entrar">
            </form>
        </div>
        <div class="tira">
                <h2 class="h2">Lista de Clientes</h2>
        </div>
  <div class="mostrar">
        <table class="table table-striped">
            <?php 
            $texto = array();
            $email_antigo="";
            if (isset($_POST['busca'])) {
            $cont_r = 0;
            
            $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);
            while($result = $sql_query->fetch_assoc()) {
              
              $email = htmlspecialchars($result['email_cliente']);
              if($result['id_administrador'] == $_SESSION['id'] || $_SESSION['tipo'] == "S"){
                $cont_r++;
                if($email_antigo != $email){
                  $texto[] = $email;
                  $email_antigo = $email;
                }
              }
            } ?>
            <p>Numero total de registros: <?php echo $cont_r ?></p>
        <div class="wrapper">
          <div class="collapsible">
            <input type="checkbox" id="collapsible-head">
            <label for="collapsible-head"> Email's +</label>
            <div class="collapsible-text">
              <p><?php echo strtolower(implode('; ',$texto));?></p>
            </div>
          </div>
        </div>
            <?php 
            $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);
            if($sql_query->num_rows > 0){
                
                    while($cliente = $sql_query->fetch_assoc()) {
                      $nome_admin  = htmlspecialchars($cliente['nome_admin']);
                      $nome = htmlspecialchars($cliente['nome_cliente']);
                      $nome_fantaisa = htmlspecialchars($cliente['nome_fantasia']);
                      $razao_social = htmlspecialchars($cliente['razao_social']);
                      $cnpj = htmlspecialchars($cliente['cnpj']);
                      $cpf = htmlspecialchars($cliente['cpf']);
                      $rg = htmlspecialchars($cliente['rg']);
                      $celular = htmlspecialchars($cliente['telefone_celu']);
                      $email = htmlspecialchars($cliente['email_cliente']);
                      $nome_produto = htmlspecialchars($cliente['nome_produto']);
                      
                      
                      if($cliente['id_administrador'] == $_SESSION['id'] || $_SESSION['tipo'] == "S"){
                 ?>
            <table>
                <?php
                if($_SESSION['tipo'] == "S" && $cliente['id_administrador'] != $_SESSION['id']) {
                ?>
                <tr>
                  <th>Admin</th>
                  <td><?php echo $nome_admin; ?></td>
                </tr>
                <?php }?>
                <tr>
                  <th>Nome</th>
                  <td><?php echo $nome; ?></td>
                </tr>
                <tr>
                  <th>Nome fantasia</th>
                  <td><?php echo $nome_fantaisa; ?></td>
                </tr>
              	<tr>
                  <th>Razão social</th>
                  <td><?php echo $razao_social; ?></td>
                </tr>
                <tr>
                  <th>CNPJ</th>
                  <td><?php echo $cnpj; ?></td>
                </tr>
                <tr>
                  <th>CPF</th>
                  <td><?php echo $cpf; ?></td>
                </tr>
                <tr>
                  <th>RG</th>
                  <td><?php echo $rg; ?></td>
                </tr>
                <tr>
                  <th>Celular</th>
                  <td><a href="tel:xx55555555" ><?php echo $celular; ?></a></td>
                </tr>
                <tr>
                  <th>ID Produto</th>
                  <td><?php echo $nome_produto; ?></td>
                </tr>
                <tr>
                  <th>Info</th>
                  <td> <a href="view.php?id_cliente=<?php echo $cliente['id_cliente']; ?>" class="btn btn-info"><span class="material-icons-outlined">info</span></a></td>
                </tr>

            
                <?php } 
                }
              }else{
                ?> <tr><td colspan="3">Nenhum cliente encontrado...</td></tr> <?php
              } } ?>
        </table>

        <div class="daw"></div>
    </div>
    
</body>

</html>