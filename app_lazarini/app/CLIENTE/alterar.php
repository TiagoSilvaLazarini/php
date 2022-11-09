<?php

include('../protect.php');
include('../conexao.php');
header("Content-type:text/html; charset=utf8");
$id_admin= $mysqli->real_escape_string( $_SESSION['id']);
if(isset($_GET['id_cliente'])){
    $id =$mysqli->real_escape_string($_GET['id_cliente']);
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
	<h1>Alterar Cliente</h1>
  <?php
//verificar se clicou no botao
if(isset($_POST['nome_fantasia']))
{
  $hash = $mysqli->real_escape_string($_POST['hash']);
	if($hash != $_SESSION['_token']){
		die("Esta requisição não pode ser feita novamente");
	}
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
	  $data = $mysqli->real_escape_string($_POST['data']);
	  $cep = $mysqli->real_escape_string($_POST['cep']);
	//verificando se todos os campos nao estao vazios
	if(!empty($nome_fantasia) && !empty($nome) && !empty($cidade)){
		
    $sql_code = "SELECT * FROM cliente WHERE id_cliente = '$id'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);

      $verifi_id = $sql_query->num_rows;

    $sql_code = "SELECT * FROM cliente WHERE cpf = '$cpf' and id_cliente<>'$id'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);

      $quantidade_cpf = $sql_query->num_rows;

      $sql_code = "SELECT * FROM cliente WHERE cnpj = '$cnpj'and id_cliente<>'$id'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);

			$quantidade_cnpj = $sql_query->num_rows;

			if($quantidade_cpf == 1 && $cpf != '') {
				?>
					<div class="msg_erro">
						cpf já cadastrado, verifique com o administrador.
					</div>
				<?php
			} elseif($quantidade_cnpj == 1 && $cnpj != '') {
				?>
					<div class="msg_erro">
						cnpj já cadastrado, verifique com o administrador.
					</div>
				<?php
      }elseif($verifi_id == 0) {
      ?>
        <div class="msg_erro">
          cliente não existe.
        </div>
      <?php
      } else {
				$sql_code = "UPDATE cliente SET nome_cliente='$nome', email_cliente='$email', telefone_celu='$telefone_celu', telefone_fixo='$telefone_fixo', razao_social='$razao_social', cnpj='$cnpj',
         inscricao_estadual='$inscricao_estadual', cpf='$cpf', rg='$rg', estado='$estado', cidade='$cidade', bairro='$bairro', endereco='$endereco', cep='$cep', aniversario='$data', nome_fantasia='$nome_fantasia' WHERE id_cliente ='$id'";
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
        mysqli_close($mysqli);
        $_SESSION['_token'] = hash('sha512',rand(100,1000));
				?>
					<div id='msg_sucesso'>
						Alterado com sucesso! <a href="index.php"><strong>Ver todos os clientes!</strong></a></br>
            Ou <a href="view.php?id_cliente=<?php echo $id; ?>"><strong>Ver o cliente!</strong></a>
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
if($_SESSION['tipo'] == "S"){
  $sql_code = "SELECT * FROM cliente WHERE id_cliente = '$id'";
 }else{
    $sql_code = "SELECT * FROM cliente WHERE id_cliente = '$id' AND id_administrador='$id_admin'";
 }

 $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
 $cliente = $sql_query->fetch_assoc();
if($sql_query->num_rows > 0){?>
	<form action="" method="POST">
        <label for="razao_social">Razao social</label>
        <input type="text" name="razao_social" placeholder="Razao social" maxlength="255"value="<?php echo $cliente['razao_social']; ?>">
        <label for="nome_fantasia">Nome fantasia</label>
        <input type="text" name="nome_fantasia" placeholder="Nome fantasia" maxlength="100" value="<?php echo $cliente['nome_fantasia']; ?>">
        <label for="nome">Nome</label>
		    <input type="text" name="nome" placeholder="Nome do cliente" maxlength="255"value="<?php echo $cliente['nome_cliente']; ?>">
        <label for="email">Email</label>
		    <input type="email" name="email" placeholder="Email" maxlength="255"value="<?php echo $cliente['email_cliente']; ?>">
        <label for="telefone_celu">Telefone celular</label>
		    <input type="text" name="telefone_celu" placeholder="tTelefone celular" maxlength="15" onKeyPress="MascaraGenerica(this, 'CELULAR');"value="<?php echo $cliente['telefone_celu']; ?>">
        <label for="telefone_fixo">Telefone fixo</label>
        <input type="text" name="telefone_fixo" placeholder="Telefone fixo" maxlength="14" onKeyPress="MascaraGenerica(this, 'TELEFONE');"value="<?php echo $cliente['telefone_fixo']; ?>">
        <label for="cnpj">CNPJ</label>
        <input type="text" name="cnpj" placeholder="CNPJ" maxlength="18" onKeyPress="MascaraGenerica(this, 'CNPJ');"value="<?php echo $cliente['cnpj']; ?>">
        <label for="inscricao_estadual">Inscricao Estadual</label>
        <input type="text" name="inscricao_estadual" placeholder="Inscricao Estadual" maxlength="15" onKeyPress="MascaraGenerica(this, 'INSCRI');" value="<?php echo $cliente['inscricao_estadual']; ?>">
        <label for="cpf">CPF</label>
        <input type="text" name="cpf" placeholder="CPF" maxlength="14" onKeyPress="MascaraGenerica(this, 'CPF');"value="<?php echo $cliente['cpf']; ?>">
        <label for="rg">RG</label>
        <input type="text" name="rg" placeholder="RG" maxlength="14" value="<?php echo $cliente['rg']; ?>">
        <label for="estado">Estado</label>
        <input type="text" name="estado" placeholder="Estado" maxlength="50"value="<?php echo $cliente['estado']; ?>">
        <label for="cidade">Cidade</label>
        <input type="text" name="cidade" placeholder="Cidade" maxlength="50"value="<?php echo $cliente['cidade']; ?>">
        <label for="bairro">Bairro</label>
        <input type="text" name="bairro" placeholder="Bairro" maxlength="50"value="<?php echo $cliente['bairro']; ?>">
        <label for="endereco">Endereço</label>
        <input type="text" name="endereco" placeholder="Endereço" maxlength="150"value="<?php echo $cliente['endereco']; ?>">
        <label for="cep">CEP</label>
        <input type="text" name="cep" placeholder="CEP" maxlength="10" onKeyPress="MascaraGenerica(this, 'CEP');"value="<?php echo $cliente['cep']; ?>">
        <label for="data">dData de aniversario</label>
        <input type="date" name="data" min="1900-01-01"max="2200-12-30"value="<?php echo $cliente['aniversario']; ?>">
        <input type="hidden" name="hash" value="<?php echo $_SESSION['_token']; ?>">
		<input type="submit" value="ALTERAR" class="entrar">
	</form>
  <?php }else{
    ?>
			<div class="msg_erro">
				Você não tem autoridade para ver esse cliente</br> ou esse cliente não existe
      </div>
		<?php }?>
	</div>
	<div class="daw"></div>
</body>

</html>