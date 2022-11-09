<?php

include('../protect_s.php');
include('../conexao.php');
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
      <button aria-label="Abrir Menu" id="btn-mobile" aria-haspopup="true" aria-controls="menu" aria-expanded="false">Menu
        <span id="hamburger"></span>
      </button>
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

<div id="corpo-form-cad">
	<h1>Troca de posse do cliente</h1>
  <?php
//verificar se clicou no botao
if(isset($_POST['id_admin']))
{
  $hash = $mysqli->real_escape_string($_POST['hash']);
	if($hash != $_SESSION['_token']){
		die("Esta requisição não pode ser feita novamente");
	}
	$id_cliente = $mysqli->real_escape_string($_POST['id_cliente']);
    $id_admin = $mysqli->real_escape_string($_POST['id_admin']);

	//verificando se todos os campos nao estao vazios
	if(!empty($id_cliente) && !empty($id_admin)){

    $sql_code = "SELECT * FROM cliente WHERE id_cliente = '$id_cliente'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
    $cliente = $sql_query->fetch_assoc();
    $quantidade_cli = $sql_query->num_rows;

    $sql_code = "SELECT * FROM administrador WHERE id_administrador = '$id_admin'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
    $cliente = $sql_query->fetch_assoc();
    $quantidade_adm = $sql_query->num_rows;

    if($quantidade_cli == 0) {
      ?>
        <div class="msg_erro">
          o cliente não existe.
        </div>
      <?php
    }else if($quantidade_adm == 0) {
      ?>
        <div class="msg_erro">
          o administrador não existe.
        </div>
      <?php
    }else {
      $sql_code = "UPDATE cliente SET id_administrador='$id_admin' WHERE id_cliente ='$id_cliente'";
     $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
    		
        mysqli_close($mysqli);
        $_SESSION['_token'] = hash('sha512',rand(100,1000));
				?>
					<div id='msg_sucesso'>
						Alterado com sucesso! <a href="../CLIENTE/view.php?id_cliente=<?php echo $id_cliente; ?>"><strong>Ver o cliente!</strong></a>
					</div>
				<?php
    }
	}else{
		?>
		<div class="msg_erro">
			Preencha todos os campos obrigatorios!
		</div>
		<?php
	}
}
include('../conexao.php');?>


	<form action="" method="POST">
		<select name="id_cliente" class="select">
     <option selected disabled>escolha o seu cliente</option>      
     <?php
        $sql_code = "SELECT * FROM cliente order by nome_cliente";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
        while($row = $sql_query->fetch_assoc()) {
          echo "<option value='".$row['id_cliente']."'>".$row['nome_cliente']." do(a) ".$row['razao_social']."</option>";
        }
      ?>
      </select>
      <select name="id_admin" class="select">
     <option selected disabled>escolha o administrador</option>      
     <?php
        $sql_code = "SELECT * FROM administrador order by nome_admin";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
        while($row = $sql_query->fetch_assoc()) {
          echo "<option value='".$row['id_administrador']."'>".$row['nome_admin']."</option>";
        }
      ?>
      </select>

    <input type="hidden" name="hash" value="<?php echo $_SESSION['_token']; ?>">
		<input type="submit" value="ALTERAR" class="entrar">
	</form>
	</div>
	<div class="daw"></div>
</body>

</html>