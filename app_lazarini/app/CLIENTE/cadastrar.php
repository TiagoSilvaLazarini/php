<?php

include('../protect.php');
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
	<h1>Cadastrar cliente</h1>
  <?php
//verificar se clicou no botao
if(isset($_POST['razao_social']))
{
  $hash = $mysqli->real_escape_string($_POST['hash']);
	if($hash != $_SESSION['_token']){
		die("Esta requisição não pode ser feita novamente");
	}
    $id = $mysqli->real_escape_string( $_SESSION['id']);
	$razao_social = $mysqli->real_escape_string($_POST['razao_social']);
	$nome_fantasia = $mysqli->real_escape_string($_POST['nome_fantasia']);
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $telefone_celu = $mysqli->real_escape_string($_POST['telefone_celu']);
    $telefone_fixo = $mysqli->real_escape_string($_POST['telefone_fixo']);
    $cnpj = $mysqli->real_escape_string($_POST['cnpj']);
    $inscricao_estadual = $mysqli->real_escape_string($_POST['inscricao_estadual']);
    $cpf = $mysqli->real_escape_string($_POST['cpf']);
    $rg = $mysqli->real_escape_string($_POST['rg']);
    $estado = $mysqli->real_escape_string($_POST['estado']);
    $cidade = $mysqli->real_escape_string($_POST['cidade']);
    $bairro = $mysqli->real_escape_string($_POST['bairro']);
	$endereco = $mysqli->real_escape_string($_POST['endereco']);
	$cep = $mysqli->real_escape_string($_POST['cep']);
	$data = $mysqli->real_escape_string($_POST['data']);
	//verificando se todos os campos nao estao vazios
	if(!empty($nome_fantasia) && !empty($nome) && !empty($cidade)){
		
			$sql_code = "SELECT * FROM cliente WHERE cpf = '$cpf'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);

      $quantidade_cpf = $sql_query->num_rows;

      $sql_code = "SELECT * FROM cliente WHERE cnpj = '$cnpj'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);

			$quantidade_cnpj = $sql_query->num_rows;

			if($quantidade_cnpj == 1 && $cnpj != '') {
				?> 
					<div class="msg_erro">
						cnpj já cadastrado, verifique com o administrador.
					</div>
				<?php $erro="T";
			} elseif($quantidade_cpf == 1 && $cpf != '') {
				?>
					<div class="msg_erro">
						cpf já cadastrado, verifique com o administrador.
					</div>
				<?php $erro="T";
			} else {
				$sql_code = "INSERT INTO cliente(id_administrador, nome_cliente, email_cliente, telefone_celu, telefone_fixo, razao_social, cnpj, inscricao_estadual, cpf, rg, estado, cidade, bairro, endereco, cep, aniversario, nome_fantasia) 
                VALUES ('$id', '$nome', '$email', '$telefone_celu', '$telefone_fixo', '$razao_social', '$cnpj', '$inscricao_estadual', '$cpf', '$rg', '$estado', '$cidade', '$bairro', '$endereco', '$cep', '$data', '$nome_fantasia')";
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
        
        $_SESSION['_token'] = hash('sha512',rand(100,1000));
        
        $sql_code = "SELECT id_cliente FROM cliente WHERE nome_fantasia = '$nome_fantasia' AND nome_cliente = '$nome' AND cidade = '$cidade'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
			$cliente = $sql_query->fetch_assoc();
			$id_cliente = $cliente['id_cliente'];
        
        	mysqli_close($mysqli);
				?>
					<div id='msg_sucesso'>
						Cadastrado com sucesso! <a href="index.php"><strong>Ver todos os clientes!</strong></a></br>
						Ou <a href="view.php?id_cliente=<?php echo $id_cliente; ?>"><strong>Ver o cliente!</strong></a>
					</div>
				<?php $erro="F";
			}
	}else{
		?>
		<div class="msg_erro">
			Preencha todos os campos obrigatorios!
		</div>
		<?php $erro="T";
	}
}
?>
	<form action="" method="POST">
    <input type="text" name="razao_social" value="<?php if($erro=="T") echo $_POST['razao_social']; ?>" placeholder="Razao social" maxlength="255">
    <input type="text" name="nome_fantasia" value="<?php if($erro=="T") echo $_POST['nome_fantasia']; ?>" placeholder="Nome fantasia" maxlength="100">
		<input type="text" name="nome" value="<?php if($erro=="T") echo $_POST['nome']; ?>" placeholder="Nome do cliente" maxlength="255">
		<input type="email" name="email" value="<?php if($erro=="T") echo $_POST['email']; ?>" placeholder="Email" maxlength="255">
		<input type="text" name="telefone_celu" value="<?php if($erro=="T") echo $_POST['telefone_celu']; ?>" placeholder="Telefone celular" maxlength="15" onKeyPress="MascaraGenerica(this, 'CELULAR');">
    <input type="text" name="telefone_fixo" value="<?php if($erro=="T") echo $_POST['telefone_fixo']; ?>" placeholder="Telefone fixo" maxlength="14" onKeyPress="MascaraGenerica(this, 'TELEFONE');">
    <input type="text" name="cnpj" value="<?php if($erro=="T") echo $_POST['cnpj']; ?>" placeholder="CNPJ" maxlength="18" onKeyPress="MascaraGenerica(this, 'CNPJ');">
    <input type="text" name="inscricao_estadual" value="<?php if($erro=="T") echo $_POST['inscricao_estadual']; ?>" placeholder="Inscricao estadual" maxlength="15"onKeyPress="MascaraGenerica(this, 'INSCRI');">
    <input type="text" name="cpf" value="<?php if($erro=="T") echo $_POST['cpf']; ?>" placeholder="CPF" maxlength="14" onKeyPress="MascaraGenerica(this, 'CPF');">
    <input type="text" name="rg" value="<?php if($erro=="T") echo $_POST['rg']; ?>" placeholder="RG" maxlength="14" onKeyPress="MascaraGenerica(this, 'RG');">
    <input type="text" name="estado" value="<?php if($erro=="T") echo $_POST['estado']; ?>" placeholder="Estado" maxlength="50">
    <input type="text" name="cidade" value="<?php if($erro=="T") echo $_POST['cidade']; ?>" placeholder="Cidade" maxlength="50">
    <input type="text" name="bairro" value="<?php if($erro=="T") echo $_POST['bairro']; ?>" placeholder="Bairro" maxlength="50">
    <input type="text" name="endereco" value="<?php if($erro=="T") echo $_POST['endereco']; ?>" placeholder="Endereço" maxlength="150">
    <input type="text" name="cep" value="<?php if($erro=="T") echo $_POST['cep']; ?>" placeholder="CEP" maxlength="10" onKeyPress="MascaraGenerica(this, 'CEP');">
    <label for="data">data de aniversario</label>
    <input type="date" name="data" value="<?php if($erro=="T") echo $_POST['data']; ?>" min="1900-01-01"max="2200-12-30">
    <input type="hidden" name="hash" value="<?php echo $_SESSION['_token']; ?>">
		<input type="submit" value="CADASTRAR" class="entrar">
	</form>
	</div>
	<div class="daw"></div>
</body>

</html>