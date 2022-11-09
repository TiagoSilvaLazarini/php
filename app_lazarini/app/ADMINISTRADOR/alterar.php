<?php

include('../protect.php');
include('../conexao.php');
header("Content-type:text/html; charset=utf8");
$id_admin = $mysqli->real_escape_string($_SESSION['id']);
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
	<h1>Alterar Administrador</h1>
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
    $senha_antiga = $mysqli->real_escape_string($_POST['senha_antiga']);
	$senha = $mysqli->real_escape_string($_POST['senha']);
	$confirmarSenha = $mysqli->real_escape_string( $_POST['confSenha']);
	//verificando se todos os campos nao estao vazios
	if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)){
		$sql_code = "SELECT * FROM administrador WHERE email_admin = '$email'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);

        $usuario = $sql_query->fetch_assoc();
        if(password_verify($senha_antiga, $usuario['senha'])) {

		if ($senha == $confirmarSenha){
			$sql_code = "SELECT id_administrador FROM administrador WHERE id_administrador = '$id_admin'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);

			$quantidade = $sql_query->num_rows;

			if($quantidade == 0) {
				?>
					<div class="msg_erro">
						Administrador Não registrado
					</div>
				<?php
			} else {
				$senha = password_hash($mysqli->real_escape_string($_POST['senha']),PASSWORD_DEFAULT);
				$sql_code = "UPDATE administrador SET nome_admin='$nome', telefone_admin='$telefone', email_admin='$email', senha='$senha' WHERE id_administrador = '$id_admin'";
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
				mysqli_close($mysqli);
				$_SESSION['_token'] = hash('sha512',rand(100,1000));
				?>
					<div id='msg_sucesso'>
						Alterado com sucesso!
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
				    Email e/ou senha estão incorretos!
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
$sql_code = "SELECT * FROM administrador WHERE id_administrador = '$id_admin'";
$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
$administrador = $sql_query->fetch_assoc();
?>
	<?php if($sql_query->num_rows > 0){?>
	<form action="" method="POST">
        <label for="nome">Nome</label>
		<input type="text" name="nome" placeholder="Nome do cliente" maxlength="255"value="<?php echo $administrador['nome_admin']; ?>">
        <label for="telefone">Telefone</label>
        <input type="text" name="telefone" placeholder="Telefone" maxlength="15"onKeyPress="MascaraGenerica(this, 'CELULAR');"value="<?php echo $administrador['telefone_admin']; ?>">
        <label for="email">Email</label>
		<input type="email" name="email" placeholder="Email" maxlength="255"value="<?php echo $administrador['email_admin']; ?>">
		<label for="senha">Senha antiga</label>
		<input type="password" name="senha_antiga" placeholder="Senha antiga" maxlength="20">
        <label for="senha">Senha</label>
		<input type="password" name="senha" placeholder="Senha" maxlength="20">
        <label for="confSenha">Confirmar senha</label>
		<input type="password" name="confSenha" placeholder="Confirmar senha">
		<input type="hidden" name="hash" value="<?php echo $_SESSION['_token']; ?>">

		<input type="submit" value="ALTERAR" class="entrar">
	</form>
	<?php }else{
    ?>
		<div class="msg_erro">
			Este administrador não existe
    	</div>
	<?php }?>
	</div>
	<div class="daw"></div>
</body>

</html>