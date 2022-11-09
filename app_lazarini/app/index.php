<?php 
include('conexao.php');
if(!isset($_SESSION)) {
   session_start();
    }

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        ?>
            <div class="msg_erro">
            	Preencha o email!
            </div>
        <?php
    } else if(strlen($_POST['senha']) == 0) {
        ?>
            <div class="msg_erro">
                Preencha a senha!
            </div>
           <?php
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM administrador WHERE email_admin = '$email'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);

        $usuario = $sql_query->fetch_assoc();


        if(password_verify($senha, $usuario['senha'])) {

            

            $_SESSION['id'] = $usuario['id_administrador'];
            $_SESSION['nome'] = $usuario['nome_admin'];
            $_SESSION['tipo'] = $usuario['tipo'];

            header("Location: menu.php");

        } else {
            ?>
			    <div class="msg_erro">
				    Email e/ou senha estão incorretos!
			    </div>
			<?php
        }

    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet"  href="CSS/style.css?v=<?php echo uniqid(); ?>">
	<title>Lazarini Equipamentos</title>
</head>
<body>
<div id="corpo-form">
	<h1>Entrar</h1>
	<form action="" method="POST">
		<input type="email" placeholder="Email" name='email'>
		<input type="password" placeholder="Senha" name='senha'>
		<input type="submit" value="ACESSAR" class="entrar">
	</form>
</div>

<div class="daw"></div>
</body>
</html>
