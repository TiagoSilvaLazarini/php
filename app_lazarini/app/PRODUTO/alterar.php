<?php
include('../conexao.php');
include('../protect_s.php');
header("Content-type:text/html; charset=utf8");
 if(isset($_GET['id_produto'])){
    $id = $mysqli->real_escape_string($_GET['id_produto']);
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
	<h1>Alterar produto</h1>
	<?php
//verificar se clicou no botao
if(isset($_POST['nome']))
{
	$hash = $mysqli->real_escape_string($_POST['hash']);
	if($hash != $_SESSION['_token']){
		die("Esta requisição não pode ser feita novamente");
	}
	$descricao = $mysqli->real_escape_string($_POST['descricao']);
	$preco = $mysqli->real_escape_string($_POST['preco']);
	$categoria = $mysqli->real_escape_string($_POST['categoria']);
  	$nome = $mysqli->real_escape_string($_POST['nome']);
	//verificando se todos os campos nao estao vazios
	if(!empty($nome) && !empty($descricao) && !empty($preco)){
		
			$sql_code = "SELECT id_produto FROM produto_n WHERE id_produto = '$id'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);

			$quantidade = $sql_query->num_rows;

			if($quantidade == 0 ) {
				?>
					<div class="msg_erro">
						Produto não cadastrado!
					</div>
				<?php
			} else {
				$sql_code = "UPDATE produto_n SET nome_produto = '$nome', descricao='$descricao', preco_produto= '$preco', categoria='$categoria'where id_produto ='$id'";
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
				mysqli_close($mysqli);
				$_SESSION['_token'] = hash('sha512',rand(100,1000));
				?>
					<div id='msg_sucesso'>
						Alterado com sucesso!<a href="index.php"><strong>Ver produtos!</strong></a></br>
						Ou <a href="view.php?id_produto=<?php echo $id; ?>"><strong>Ver o produto!</strong></a>
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
$sql_code = "SELECT * FROM produto_n WHERE id_produto = '$id'";
$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
$produto = $sql_query->fetch_assoc();
?>
    <div class="adiciona">
        <a href="alterar.php?id_produto=<?php echo $id_ant = $id-1; ?>" class="btn btn-primary">Anterior</a>
        <a href="alterar.php?id_produto=<?php echo $id_ant = $id+1; ?>" class="btn btn-primary">Proximo</a>
    </div>
	<?php if($sql_query->num_rows > 0){?>
	<form action="" method="POST">
      <input type="text" name="nome" placeholder="Nome do produto" maxlength="100" value="<?php echo $produto['nome_produto']; ?>">
		<textarea class="textarea" name="descricao" rows="4" cols="37" maxlength="500" minlength="3"><?php echo $produto['descricao']; ?></textarea>
		<input type="text" name="preco" placeholder="Preço" maxlength="14"onKeyPress="MascaraGenerica(this, 'MOEDA');" value="<?php echo $produto['preco_produto']; ?>">
		<select name="categoria" placeholder="Categoria" class="select">
		    <option><?php echo $produto['categoria']; ?></option>
            <option>diagnostico</option>
            <option>equipamentos</option>
            <option>procut</option>
            <option>midtronics</option>
            <option>ferramentas</option>
        </select>
		<input type="hidden" name="hash" value="<?php echo $_SESSION['_token']; ?>">
		<input type="submit" value="ALTERAR" class="entrar">
	</form>
	<?php }else{
    ?>
		<div class="msg_erro">
			este produto não existe
      </div>
	<?php }?>

	<div class="daw"></div>
</body>

</html>

