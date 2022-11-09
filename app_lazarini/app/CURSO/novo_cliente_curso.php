<?php

include('../protect.php');
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
	<h1>Cadastrar cliente no curso</h1>
  <?php
//verificar se clicou no botao
if(isset($_POST['preco_venda_curso']))
{
  $hash = $mysqli->real_escape_string($_POST['hash']);
	if($hash != $_SESSION['_token']){
		die("Esta requisição não pode ser feita novamente");
	}
	$id_cliente = $mysqli->real_escape_string($_POST['id_cliente']);
  $preco_venda_curso = $mysqli->real_escape_string($_POST['preco_venda_curso']);
  $n_parcela = $mysqli->real_escape_string($_POST['n_parcelas']);
  $forma_pagamento = $mysqli->real_escape_string($_POST['forma_pagamento']);
  $nome_aluno_curso = $mysqli->real_escape_string($_POST['nome_aluno_curso']);
  $email_aluno_curso = $mysqli->real_escape_string($_POST['email_aluno_curso']);
  $telefone_aluno_curso = $mysqli->real_escape_string($_POST['telefone_aluno_curso']);
	//verificando se todos os campos nao estao vazios
	if(!empty($id_cliente) && !empty($preco_venda_curso) && !empty($n_parcela) && !empty($forma_pagamento) && !empty($nome_aluno_curso) && !empty($email_aluno_curso) && !empty($telefone_aluno_curso)){
    $sql_code = "SELECT * FROM curso WHERE id_curso = '$id_curso'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
    $curso = $sql_query->fetch_assoc();

    $sql_code = "SELECT COUNT(id_cliente) as total FROM curso_cliente WHERE id_curso = $id_curso";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
    $count = $sql_query->fetch_assoc();

    if($count['total']>=$curso['limite']) {
      ?>
        <div class="msg_erro">
          o curso ja está cheio, verifique o curso. <a href="view.php?id_curso=<?php echo $id_curso; ?>"><strong>Curso!</strong></a>
        </div>
      <?php
    } else {
				$sql_code = "INSERT INTO curso_cliente(id_curso, id_cliente, preco_venda_curso, forma_pagamento, n_parcela,nome_aluno_curso,email_aluno_curso,telefone_aluno_curso) VALUES ('$id_curso', '$id_cliente', '$preco_venda_curso', '$forma_pagamento','$n_parcela','$nome_aluno_curso','$email_aluno_curso','$telefone_aluno_curso')";
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
      
      			$sql_code = "SELECT * FROM curso_cliente WHERE id_cliente = '$id_cliente' and id_curso = '$id_curso' and nome_aluno_curso = '$nome_aluno_curso'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
    $curso_cliente = $sql_query->fetch_assoc();
    $id_curso_cliente = $curso_cliente['id_curso_cliente'];
      
      for ($parcela = 1; $parcela <= $n_parcela; $parcela++) {

      			$sql_code = "INSERT INTO curso_parcela(id_curso_cliente, parcela, pago) VALUES ('$id_curso_cliente', '$parcela', 'pendente')";
				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
     			} 
      
      		
      mysqli_close($mysqli);
        $_SESSION['_token'] = hash('sha512',rand(100,1000));
				?>
					<div id='msg_sucesso'>
						Cadastrado com sucesso! <a href="index.php"><strong>Ver todos os cursos!</strong></a></br>
            Ou <a href="view.php?id_curso=<?php echo $id_curso; ?>"><strong>Ver o curso!</strong></a>
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

  $sql_code = "SELECT COUNT(id_cliente) as total FROM curso_cliente WHERE id_curso = $id_curso";
  $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
  $count = $sql_query->fetch_assoc();
  if($count['total']<$curso['limite']){?>

	<form action="" method="POST">
  <input type="text" value="<?php echo $curso['nome_curso']; ?>" disabled="true">
  <input type="text" value="<?php $data=strtotime($curso['data_ini']);  echo date("d/m/Y",$data); ?>" disabled="true">

		<select name="id_cliente" class="select">
     <option selected disabled>escolha o seu cliente</option>      
     <?php
        if($_SESSION['tipo'] == "S"){
          $sql_code = "SELECT * FROM cliente order by nome_cliente";
       }else{
          $sql_code = "SELECT * FROM cliente WHERE id_administrador='$id_admin' order by nome_cliente";
       }
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
        while($row = $sql_query->fetch_assoc()) {
          echo "<option value='".$row['id_cliente']."'>".$row['nome_cliente']." do(a) ".$row['razao_social']."</option>";
        }
      ?>
      </select>
      	<input type="text" name="preco_venda_curso" placeholder="Preço pago pelo cliente" maxlength="14"onKeyPress="MascaraGenerica(this, 'MOEDA');">
      	<label for="forma_pagamento">Forma de pagamento</label>
    	<select name="forma_pagamento" placeholder="Boleto" class="select">
    	<option selected disabled>Escolha a forma de pagamento</option>
    	<option>Dinheiro</option>
    	<option>Cartão</option>
        <option>Boleto</option>
        <option>Deposito</option>
        <option>pendente</option>
        <option>pendente</option>
        <option>pendente</option>
    	</select>
      	<label for="n_parcelas">Nº de parcelas</label>
    	<select name="n_parcelas" placeholder="Numero de parcelas" class="select">
    	<option selected disabled>Escolha as parcelas</option>
    	<option value="1">1x parcela</option>
    	<option value="2">2x parcelas</option>
        <option value="3">3x parcelas</option>
        <option value="4">4x parcelas</option>
        <option value="5">5x parcelas</option>
        <option value="6">6x parcelas</option>
    	</select>
      <label for="nome_aluno_curso">Dados do aluno</label>
      <input type="text" name="nome_aluno_curso" placeholder="Nome do aluno do curso" maxlength="150">
      <input type="text" name="email_aluno_curso" placeholder="Email do aluno do curso" maxlength="150">
      <input type="text" name="telefone_aluno_curso" placeholder="celular do aluno do curso" maxlength="15"onKeyPress="MascaraGenerica(this, 'CELULAR');">

    <input type="hidden" name="hash" value="<?php echo $_SESSION['_token']; ?>">
		<input type="submit" value="CADASTRAR" class="entrar">
	</form>
    <?php }else{
      ?>
			<div class="msg_erro">
				Este curso já atingiu o limite de participantes</br>
      </div>
		<?php }}else{
      ?>
			<div class="msg_erro">
				Este curso não existe</br>
        ou já terminaram as inscrições
      </div>
		<?php }?>
	
	</div>
	<div class="daw"></div>
</body>

</html>