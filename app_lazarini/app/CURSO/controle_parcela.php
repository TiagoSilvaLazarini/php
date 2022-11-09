<?php

include('../protect_s.php');
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
	<h1>Controle de parcelas</h1>

<?php

    $sql_code = "SELECT * FROM curso_cliente cc INNER JOIN curso c ON cc.id_curso = c.id_curso INNER JOIN cliente cl ON cc.id_cliente = cl.id_cliente WHERE cc.id_curso_cliente = '$id_curso_cliente'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
    $curso_custos = $sql_query->fetch_assoc();
    
if($sql_query->num_rows > 0){?>
	<form action="" method="POST">
  		<input type="text" value="<?php echo $curso_custos['nome_curso']; ?>" disabled="true">
  		<input type="text" value="<?php $data=strtotime($curso_custos['data_ini']);  echo date("d/m/Y",$data); ?>" disabled="true">
      <input type="text" value="<?php echo $curso_custos['nome_cliente']; ?>" disabled="true">
      <input type="text" name="nome_aluno_curso" value="<?php echo $curso_custos['nome_aluno_curso']; ?>"disabled="true">
      <input type="text" value="<?php echo $curso_custos['razao_social']; ?>" disabled="true">
      <input type="text" value="<?php echo $curso_custos['preco_venda_curso']; ?>" disabled="true">
      <input type="text" value="<?php echo $curso_custos['forma_pagamento']; ?>" disabled="true">
      
      
	</form>
  	<?php 	$sql_code = "SELECT * FROM curso_parcela WHERE id_curso_cliente = '$id_curso_cliente' ORDER BY parcela";
    			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
                while($parcela = $sql_query->fetch_assoc()) {
      ?>
  		<a href="alterar_parcela.php?id_curso_parcela=<?php echo $parcela['id_curso_parcela']; ?>"><input type="submit" value="<?php echo $parcela['parcela']."x parcela: ".$parcela['pago']; ?>" class="entrar"></a>
      <?php } ?>
  		<a href="view.php?id_curso=<?php echo $curso_custos['id_curso']; ?>"><input type="submit" value="Voltar para o curso" class="entrar"></a>
    <?php }else{
      ?>
			<div class="msg_erro">
				Você não tem altoridade para ver esse custo</br> ou esse custo não existe
      </div>
		<?php }?>
	
	</div>
	<div class="daw"></div>
</body>

</html>