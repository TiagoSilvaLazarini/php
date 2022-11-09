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


    <?php
        $id_admin = $mysqli->real_escape_string($_SESSION['id']);

        $sql_code = "SELECT * FROM administrador WHERE id_administrador = '$id_admin'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);

        $quantidade = $sql_query->num_rows;
        $admin = $sql_query->fetch_assoc();
    ?>
    
        <div class="adiciona">
          <?php
              if($_SESSION['tipo'] == "S") {?>
             <a href="cadastrar.php" class="btn btn-primary">Novo Administrador</a>
             <a href="lista_admin.php" class="btn btn-primary">Lista de Administradores</a>
             <a href="troca.php" class="btn btn-primary">Troca de posse de cliente</a>
          <?php } ?>
        </div>
        <div class="tira">
          <h2>Administrador</h2>
        </div>
  <div class="mostrar">
        <table class="table table-striped">
            <?php 
            if($sql_query->num_rows > 0){
                      if($admin['id_administrador'] == $_SESSION['id'] || $_SESSION['tipo'] == "S"){
                        $nome = htmlspecialchars($admin['nome_admin']);
                        $email = htmlspecialchars($admin['email_admin']);
                        $celular = htmlspecialchars($admin['telefone_admin']);
                 ?>
            <table>
                <tr>
                  <th>Nome</th>
                  <td><?php echo $nome ; ?></td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td><?php echo $email; ?></td>
                </tr>
                <tr>
                  <th>Celular</th>
                  <td><a href="tel:xx55555555" ><?php echo $celular;?></a></td>
                </tr>
                <tr>
                  <th>Alterar</th>
                  <td> <a href="alterar.php" class="btn btn-info"><span class="material-icons-outlined">settings</span></a></td>
                </tr>
                <tr>
                  <th>Sair</th>
                  <td> <a href="../logout.php" class="btn btn-info"><span class="material-icons-outlined">logout</span></a></td>
                </tr>

            
                <?php } 
                
              }else{
                ?> <tr><td colspan="3">Nenhum administrador encontrado...</td></tr> <?php
              } ?>
        </table>
        <div class="daw"></div>
    </div>
    
</body>

</html>