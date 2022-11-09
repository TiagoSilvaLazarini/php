<?php
include('../conexao.php');
include('../protect_s.php');
header("Content-type:text/html; charset=utf8");
if(isset($_GET['id_curso'])){
    $id = $mysqli->real_escape_string($_GET['id_curso']);
 }
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
	<h1>Alterar curso</h1>
	<?php
//verificar se clicou no botao
if(isset($_POST['nome']))
{
	$hash = $mysqli->real_escape_string($_POST['hash']);
	if($hash != $_SESSION['_token']){
		die("Esta requisição não pode ser feita novamente");
	}
	$nome = $mysqli->real_escape_string($_POST['nome']);
	$data = $mysqli->real_escape_string($_POST['data']);
	$limite = $mysqli->real_escape_string($_POST['limite']);
  	$preco_curso = $mysqli->real_escape_string($_POST['preco_curso']);
	//verificando se todos os campos nao estao vazios
	if(!empty($nome) && !empty($data) && !empty($limite) && !empty($preco_curso)){
		
			$sql_code = "SELECT id_curso FROM curso WHERE id_curso = '$id'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);

			$quantidade = $sql_query->num_rows;

			if($quantidade == 0 ) {
				?>
					<div class="msg_erro">
						Curso não cadastrado!
					</div>
				<?php
			} else {
				$sql_code = "UPDATE curso SET data_ini ='$data', limite='$limite', nome_curso= '$nome', preco_curso='$preco_curso' where id_curso ='$id'";
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
				mysqli_close($mysqli);
				$_SESSION['_token'] = hash('sha512',rand(100,1000));
				
				?>
					<div id='msg_sucesso'>
					
						Alterado com sucesso!<a href="index.php"><strong>Ver cursos!</strong></a></br>
						Ou <a href="view.php?id_curso=<?php echo $id; ?>"><strong>Ver o curso!</strong></a>

					</div>
				<?php
			}
	}else{
		?>
		<div class="msg_erro">
			Preencha todos os campos!
		</div>
		<?php
	}
}
include('../conexao.php');
$sql_code = "SELECT * FROM curso WHERE id_curso = '$id'";
 $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
 $curso = $sql_query->fetch_assoc();
?>
	<?php if($sql_query->num_rows > 0){?>
	<form action="" method="POST">
      	<label for="preco">Nome do curso</label>
		<input type="text" name="nome" placeholder="Nome do curso" maxlength="255" value="<?php echo $curso['nome_curso']; ?>">
      	<label for="preco">Data de inicio</label>
		<input type="date" name="data" placeholder="Data de inicio" min="2020-01-01"max="3000-12-30" value="<?php echo $curso['data_ini']; ?>">
      	<label for="preco">Preço para o cliente</label>
    	<input type="text" name="preco_curso" placeholder="Preço para o cliente" value="<?php echo $curso['preco_curso']; ?>" maxlength="14"onKeyPress="MascaraGenerica(this, 'MOEDA');">
      	<label for="preco">Limite de participantes</label>
		<input type="text" name="limite" placeholder="Limite de participantes" maxlength="4" onKeyPress="MascaraGenerica(this, 'INTEIRO');"value="<?php echo $curso['limite']; ?>">
		<input type="hidden" name="hash" value="<?php echo $_SESSION['_token']; ?>">
		<input type="submit" value="ALTERAR" class="entrar">
	</form>
	<?php }else{
    ?>
		<div class="msg_erro">
			Este curso não existe
      </div>
	<?php }?>
	</div>
	<div class="daw"></div>
</body>

</html>

