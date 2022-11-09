<?php

include('../protect.php');
include('../conexao.php');
header("Content-type:text/html; charset=utf8");
if(isset($_GET['id_curso_cliente'])){
  $id_curso_cliente = $mysqli->real_escape_string($_GET['id_curso_cliente']);
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
	<h1>Deletar cliente do curso</h1>
  <?php
//verificar se clicou no botao
if(isset($_POST['nome_cliente']))
{
  $hash = $mysqli->real_escape_string($_POST['hash']);
	if($hash != $_SESSION['_token']){
		die("Esta requisição não pode ser feita novamente");
	}


    $sql_code = "SELECT * FROM curso_cliente WHERE id_curso_cliente = '$id_curso_cliente'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
    $curso_cliente = $sql_query->fetch_assoc();
    $id_curso = $curso_cliente['id_curso'];
  	$n_parcela = $curso_cliente['n_parcela'];
  

      			$sql_code = "DELETE FROM curso_parcela WHERE id_curso_cliente = '$id_curso_cliente'";
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
     			
     			 

      $sql_code = "DELETE FROM curso_cliente WHERE id_curso_cliente = '$id_curso_cliente'";
      $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
      mysqli_close($mysqli);
     $_SESSION['_token'] = hash('sha512',rand(100,1000));
        ?>
		<div id='msg_sucesso'>
			Apagado com sucesso! <a href="index.php"><strong>Ver todos os cursos!</strong></a></br>
            Ou <a href="view.php?id_curso=<?php echo $id_curso; ?>"><strong>Ver o curso!</strong></a>
		</div>
		<?php

}
include('../conexao.php');

    $sql_code = "SELECT * FROM curso_cliente cc INNER JOIN curso c ON c.id_curso = cc.id_curso WHERE id_curso_cliente = '$id_curso_cliente'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
    $curso_cliente = $sql_query->fetch_assoc();
    $id_cliente = $curso_cliente['id_cliente'];
    
if($_SESSION['tipo'] == "S"){
    $sql_code = "SELECT * FROM cliente WHERE id_cliente = '$id_cliente'";
 }else{
    $sql_code = "SELECT * FROM cliente WHERE id_cliente = '$id_cliente' AND id_administrador='$id_admin'";
 }

 $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
 $cliente = $sql_query->fetch_assoc();
if($sql_query->num_rows > 0){?>
	<form action="" method="POST">
  <input type="text" value="<?php echo $curso_cliente['nome_curso']; ?>" disabled="true">
  <input type="text" value="<?php $data=strtotime($curso_cliente['data_ini']);  echo date("d/m/Y",$data); ?>" disabled="true">
  <input type="text" name="nome_cliente" value="<?php echo $cliente['nome_cliente']; ?>">
  <input type="text" name="nome_aluno_curso" value="<?php echo $curso_cliente['nome_aluno_curso']; ?>"disabled="true">
   

    <input type="hidden" name="hash" value="<?php echo $_SESSION['_token']; ?>">
	<input type="submit" value="DELETAR" class="entrar">
	</form>
  <script>alert("Tem certesa que quer apager esse registro? Se sim confirme novamente")</script>
    <?php }else{
      ?>
			<div class="msg_erro">
				Você não tem altoridade para ver essa venda</br> ou essa venda não existe
      </div>
		<?php }?>
	
	</div>
	<div class="daw"></div>
</body>

</html>