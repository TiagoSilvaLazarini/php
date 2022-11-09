<?php

include('../protect.php');
include('../conexao.php');
header("Content-type:text/html; charset=utf8");
if(isset($_GET['id_cliente'])){
  $id_cliente = $mysqli->real_escape_string($_GET['id_cliente']);
}
$id_admin= $mysqli->real_escape_string( $_SESSION['id']);
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
	<h1>Cadastrar Agenda</h1>
  <?php
//verificar se clicou no botao
if(isset($_POST['comentario']))
{
  $hash = $mysqli->real_escape_string($_POST['hash']);
	if($hash != $_SESSION['_token']){
		die("Esta requisição não pode ser feita novamente");
	}
	$comentario = $mysqli->real_escape_string($_POST['comentario']);
  $data = $mysqli->real_escape_string($_POST['data']);
	//verificando se todos os campos nao estao vazios
	if(!empty($comentario) && !empty($data)){

				$sql_code = "INSERT INTO agenda(id_cliente, comentario, data, data_futura) 
                    VALUES ('$id_cliente', '$comentario','$data_atual', '$data')";
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
        mysqli_close($mysqli);
        $_SESSION['_token'] = hash('sha512',rand(100,1000));
				?>
					<div id='msg_sucesso'>
						Cadastrado com sucesso! <a href="index.php"><strong>Ver todos os clientes!</strong></a></br>
            Ou <a href="view.php?id_cliente=<?php echo $id_cliente; ?>"><strong>Ver o cliente!</strong></a>
					</div>
				<?php
			
	}else{
		?>
		<div class="msg_erro">
			Preencha todos os campos obrigatorios!
		</div>
		<?php
	}
}
include('../conexao.php');
if($_SESSION['tipo'] == "S"){
  $sql_code = "SELECT * FROM cliente WHERE id_cliente = '$id_cliente'";
 }else{
    $sql_code = "SELECT * FROM cliente WHERE id_cliente = '$id_cliente' AND id_administrador='$id_admin'";
 }

 $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
 $cliente = $sql_query->fetch_assoc();
if($sql_query->num_rows > 0){?>
	<form action="" method="POST">
    <input type="text" value="<?php echo $cliente['nome_fantasia']; ?>" disabled="true">
    <input type="text" value="<?php echo $cliente['nome_cliente']; ?>" disabled="true">
    <textarea class="textarea" name="comentario" rows="4" cols="37" maxlength="500" minlength="3" placeholder="Comentario..."></textarea>
    <input type="date" name="data" min="2020-01-01"max="2200-12-30">
    <input type="hidden" name="hash" value="<?php echo $_SESSION['_token']; ?>">
	<input type="submit" value="CADASTRAR" class="entrar">
	</form>
    <?php }else{
      ?>
			<div class="msg_erro">
				Você não tem altoridade para ver esse cliente</br> ou esse cliente não existe
      </div>
		<?php }?>
	
	</div>
	<div class="daw"></div>
</body>

</html>