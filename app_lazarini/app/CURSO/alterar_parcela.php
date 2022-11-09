<?php

include('../protect_s.php');
include('../conexao.php');
header("Content-type:text/html; charset=utf8");
if(isset($_GET['id_curso_parcela'])){
  $id_curso_parcela = $mysqli->real_escape_string($_GET['id_curso_parcela']);
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
	<h1>Alterar parcela</h1>
  <?php
//verificar se clicou no botao
if(isset($_POST['pago']))
{
  $hash = $mysqli->real_escape_string($_POST['hash']);
	if($hash != $_SESSION['_token']){
		die("Esta requisição não pode ser feita novamente");
	}
  $pago = $mysqli->real_escape_string($_POST['pago']);
	//verificando se todos os campos nao estao vazios
	if(!empty($pago)){

    $sql_code = "SELECT * FROM curso_parcela cp INNER JOIN curso_cliente cc ON cc.id_curso_cliente = cp.id_curso_cliente INNER JOIN curso c ON cc.id_curso = c.id_curso WHERE cp.id_curso_parcela = '$id_curso_parcela'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
    $curso_parcela = $sql_query->fetch_assoc();
    $id_curso = $curso_parcela['id_curso'];
    $id_curso_cliente = $curso_parcela['id_curso_cliente'];

      $sql_code = "UPDATE curso_parcela SET  pago='$pago' WHERE id_curso_parcela = '$id_curso_parcela'";
      $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
      mysqli_close($mysqli);
     $_SESSION['_token'] = hash('sha512',rand(100,1000));
        ?>
		<div id='msg_sucesso'>
			Alterado com sucesso! <a href="index.php"><strong>Ver todos os cursos!</strong></a></br>
            Ou <a href="view.php?id_curso=<?php echo $id_curso; ?>"><strong>Ver o curso!</strong></a></br>
            Ou <a href="controle_parcela.php?id_curso_cliente=<?php echo $id_curso_cliente; ?>"><strong>Ver o controle de parcelas do cliente!</strong></a>
		</div>
		<?php
	}else{
		?>
		<div class="msg_erro">
			Preencha todos os campos!
		</div>
		<?php
	}
}
include('../conexao.php');

    $sql_code = "SELECT * FROM curso_parcela cp INNER JOIN curso_cliente cc ON cc.id_curso_cliente = cp.id_curso_cliente INNER JOIN curso c ON cc.id_curso = c.id_curso INNER JOIN cliente cl ON cc.id_cliente = cl.id_cliente WHERE cp.id_curso_parcela = '$id_curso_parcela'";
 $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
 $curso_custos = $sql_query->fetch_assoc();
if($sql_query->num_rows > 0){?>
	<form action="" method="POST">
  <input type="text" value="<?php echo $curso_custos['nome_curso']; ?>" disabled="true">
  		<input type="text" value="<?php $data=strtotime($curso_custos['data_ini']);  echo date("d/m/Y",$data); ?>" disabled="true">
      <input type="text" value="<?php echo $curso_custos['nome_cliente']; ?>" disabled="true">
      <input type="text" value="<?php echo $curso_custos['razao_social']; ?>" disabled="true">
      <input type="text" name="nome_aluno_curso" value="<?php echo $curso_custos['nome_aluno_curso']; ?>"disabled="true">
      <input type="text" value="<?php echo $curso_custos['preco_venda_curso']; ?>" disabled="true">
      <input type="text" value="<?php echo $curso_custos['forma_pagamento']; ?>" disabled="true">
      <input type="text" value="<?php echo $curso_custos['parcela']."x parcela"; ?>" disabled="true">
    <label for="pago">Estado do pagamento</label>
    <select name="pago" placeholder="Pago" class="select">
    <option><?php echo $curso_custos['pago']; ?></option>
    <option>pendente</option>
    <option>em ordem</option>
    </select>

    <input type="hidden" name="hash" value="<?php echo $_SESSION['_token']; ?>">
	<input type="submit" value="ALTERAR" class="entrar">
	</form>
    <?php }else{
      ?>
			<div class="msg_erro">
				Você não tem altoridade para ver essa parcela</br> ou essa parcela não existe
      </div>
		<?php }?>
	
	</div>
	<div class="daw"></div>
</body>

</html>