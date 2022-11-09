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
	<h1>Cadastrar produto</h1>
<?php //verificar se clicou no botao
if(isset($_POST['nome']))
{
	$hash = $mysqli->real_escape_string($_POST['hash']);
	if($hash != $_SESSION['_token']){
		die("Esta requisição não pode ser feita novamente");
	}
  	$nome = $mysqli->real_escape_string($_POST['nome']);
	$descricao = $mysqli->real_escape_string($_POST['descricao']);
	$preco = $mysqli->real_escape_string($_POST['preco']);
	$categoria = $mysqli->real_escape_string($_POST['categoria']);
	//verificando se todos os campos nao estao vazios
	if(!empty($nome) && !empty($descricao) && !empty($preco)&& !empty($categoria)){
		
			$sql_code = "SELECT id_produto FROM produto_n WHERE nome_produto = '$nome'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);

			$quantidade = $sql_query->num_rows;
      		$produto = $sql_query->fetch_assoc();
      
      		$id = $produto['id_produto'];

			if($quantidade ==1) {
				?>
					<div class="msg_erro">
						Produto já cadastrado, verifique o produto. <a href="view.php?id_produto=<?php echo $id; ?>"><strong>Produto!</strong></a>
					</div>
				<?php
			} else {
				$sql_code = "INSERT INTO produto_n(nome_produto, descricao, preco_produto, categoria) VALUES ('$nome', '$descricao', '$preco', '$categoria')";
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
				mysqli_close($mysqli);
				$_SESSION['_token'] = hash('sha512',rand(100,1000));
              
              
              
				?>
					<div id='msg_sucesso'>
						Cadastrado com sucesso! <a href="index.php"><strong>Ver todos os produtos!</strong></a></br>
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
?>
	<form action="" method="POST">
      <input type="text" name="nome" placeholder="Nome do Produto" maxlength="25">
		<textarea class="textarea" name="descricao" rows="4" cols="37" maxlength="500" minlength="3" placeholder="descrição..."></textarea>
		<input type="text" name="preco" placeholder="Preço" maxlength="14"onKeyPress="MascaraGenerica(this, 'MOEDA');">
		<select name="categoria" placeholder="Categoria" class="select">
		    <option selected disabled>Escolha a categoria do produto</option>
            <option>diagnostico</option>
            <option>equipamentos</option>
            <option>procut</option>
            <option>midtronics</option>
            <option>ferramentas</option>
        </select> 
		<input type="hidden" name="hash" value="<?php echo $_SESSION['_token']; ?>">
		<input type="submit" value="CADASTRAR" class="entrar">
	</form>
	<div class="daw"></div>
</body>

</html>