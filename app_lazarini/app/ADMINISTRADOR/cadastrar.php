<?php
include('../conexao.php');
include('../protect_s.php');
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
	<h1>Cadastrar Admin</h1>
	<?php
//verificar se clicou no botao
if(isset($_POST['email']))
{
	$hash = $mysqli->real_escape_string($_POST['hash']);
	if($hash != $_SESSION['_token']){
		die("Esta requisição não pode ser feita novamente");
	}
	$nome = $mysqli->real_escape_string($_POST['nome']);
	$telefone = $mysqli->real_escape_string($_POST['telefone']);
	$email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);
	$confirmarSenha = $mysqli->real_escape_string( $_POST['confSenha']);
	//verificando se todos os campos nao estao vazios
	if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)){
		if ($senha == $confirmarSenha){
			$sql_code = "SELECT id_administrador FROM administrador WHERE email_admin = '$email'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);

			$quantidade = $sql_query->num_rows;

			if($quantidade >0) {
				?>
					<div class="msg_erro">
						Email já cadastrado
					</div>
				<?php
			} else {
				$senha = password_hash($mysqli->real_escape_string($_POST['senha']),PASSWORD_DEFAULT);
				$sql_code = "INSERT INTO administrador(nome_admin, telefone_admin, tipo, email_admin, senha) VALUES ('$nome', '$telefone', 'C', '$email', '$senha')";
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
				mysqli_close($mysqli);
				$_SESSION['_token'] = hash('sha512',rand(100,1000));
				?>
					<div id='msg_sucesso'>
						Cadastrado com sucesso!
					</div>
				<?php
			}
		}else{
			?>
				<div class="msg_erro">
					Senhas não conferem!
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
		<input type="text" name="nome" placeholder="Nome Completo" maxlength="100">
		<input type="text" name="telefone" placeholder="Telefone" maxlength="15"onKeyPress="MascaraGenerica(this, 'CELULAR');">
		<input type="email" name="email" placeholder="Email" maxlength="100">
		<input type="password" name="senha" placeholder="Senha" maxlength="20">
		<input type="password" name="confSenha" placeholder="Confirmar senha"maxlength="20">
		<input type="hidden" name="hash" value="<?php echo $_SESSION['_token']; ?>">
		<input type="submit" value="CADASTRAR" class="entrar">
	</form>
</div>
<div class="daw"></div>
</body>
</html>
