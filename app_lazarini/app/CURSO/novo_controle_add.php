<?php

include('../protect_s.php');
include('../conexao.php');
header("Content-type:text/html; charset=utf8");
if(isset($_GET['id_curso'])){
  $id_curso = $mysqli->real_escape_string($_GET['id_curso']);
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
	<h1>Cadastrar custo no curso</h1>
  <?php
//verificar se clicou no botao
if(isset($_POST['nome_curso_custo']))
{
  $hash = $mysqli->real_escape_string($_POST['hash']);
	if($hash != $_SESSION['_token']){
		die("Esta requisição não pode ser feita novamente");
	}
	$nome_curso_custo = $mysqli->real_escape_string($_POST['nome_curso_custo']);
  $custo = $mysqli->real_escape_string($_POST['custo']);
	//verificando se todos os campos nao estao vazios
	if(!empty($nome_curso_custo) && !empty($custo)){
      
    $sql_code = "SELECT * FROM curso_custos WHERE id_curso = '$id_curso' and nome_curso_custo = '$nome_curso_custo'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
    $quantidade = $sql_query->num_rows;



    if($quantidade == 1) {
      ?>
        <div class="msg_erro">
          custo já cadastrado, verifique os custos do curso. <a href="controle_add.php?id_curso=<?php echo $id_curso; ?>"><strong>Curso!</strong></a>
        </div>
      <?php
    } else {
				$sql_code = "INSERT INTO curso_custos(id_curso, nome_curso_custo, custo) VALUES ('$id_curso', '$nome_curso_custo', '$custo')";
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
        mysqli_close($mysqli);
        $_SESSION['_token'] = hash('sha512',rand(100,1000));
				?>
					<div id='msg_sucesso'>
						Cadastrado com sucesso! <a href="index.php"><strong>Ver todos os cursos!</strong></a></br>
            Ou <a href="controle_add.php?id_curso=<?php echo $id_curso; ?>"><strong>Ver os custos do curso!</strong></a>
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
include('../conexao.php');

 $sql_code = "SELECT * FROM curso WHERE id_curso = '$id_curso'";
 $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
 $curso = $sql_query->fetch_assoc();

if($sql_query->num_rows > 0){
  ?>

	<form action="" method="POST">
    <input type="text" value="<?php echo $curso['nome_curso']; ?>" disabled="true">
  	<input type="text" value="<?php $data=strtotime($curso['data_ini']);  echo date("d/m/Y",$data); ?>" disabled="true">
  	<input type="text" name="nome_curso_custo" placeholder="Nome do custo">
    <input type="text" name="custo" placeholder="Valor do custo" maxlength="14"onKeyPress="MascaraGenerica(this, 'MOEDA');">

    <input type="hidden" name="hash" value="<?php echo $_SESSION['_token']; ?>">
		<input type="submit" value="CADASTRAR" class="entrar">
	</form>
    <?php }else{
      ?>
			<div class="msg_erro">
				Este curso não existe</br>
      </div>
		<?php }?>
	
	</div>
	<div class="daw"></div>
</body>

</html>