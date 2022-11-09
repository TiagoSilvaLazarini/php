<?php
include('../conexao.php');
include('../protect.php');
header("Content-type:text/html; charset=utf8");
if(isset($_GET['id_curso'])){
    $id_curso = $mysqli->real_escape_string($_GET['id_curso']);
 }
 $id_admin =  $_SESSION['id'];
 $sql_code = "SELECT * FROM curso WHERE id_curso = '$id_curso'";
 $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
 $curso = $sql_query->fetch_assoc();
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
      <button aria-label="Abrir Menu" id="btn-mobile" aria-haspopup="true" aria-controls="menu" aria-expanded="false">Menu<span id="hamburger"></span></button>
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

  <div class="adiciona">
      <?php
          if($_SESSION['tipo'] == "S") { ?>
       <a href="pesquisa_parcela_curso.php?id_curso=<?php echo $id_curso; ?>" class="btn btn-primary">Clientes pendentes</a><?php } ?>
  </div>

  <div class="mostrar">
        <table class="table table-striped">
            <?php 
            if($sql_query->num_rows > 0){
                 ?>
                 <div class="tira">
                <h2>Curso:</h2>
            </div>
            <?php $nome = htmlspecialchars($curso['nome_curso']);
                    $data=strtotime($curso['data_ini']);
                    $data_inicio = htmlspecialchars(date("d/m/Y",$data));
                    $preco_curso = htmlspecialchars($curso['preco_curso']);
                    $limite = htmlspecialchars($curso['limite']);
                 ?>
            <table>
                <tr>
                  <th>nome</th>
                  <td><?php echo $nome; ?></td>
                </tr>
                <tr>
                  <th>Data de Inicio</th>
                  <td><?php   echo $data_inicio; ?></td>
                </tr>
                <tr>
                  <th>Limite de Participantes</th>
                  <td><?php 
                  $sql_code = "SELECT COUNT(id_cliente) as total FROM curso_cliente WHERE id_curso = $id_curso";
                  $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
                  $count = $sql_query->fetch_assoc();
                  echo  $count['total']."/".$limite;?></td>
                </tr>
              	<tr>
                  <th>Preço do curso para o cliente</th>
                  <td><?php echo $preco_curso; ?></td>
                </tr>
                <?php
                if($_SESSION['tipo'] == "S") {
                ?>
              	<tr>
                  <th>Custo total do curso</th>
                  <td><?php $sql_code = "SELECT * FROM curso_custos WHERE id_curso = '$id_curso'";
    				$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
   					$quantidade = $sql_query->num_rows;
              		while($custos = $sql_query->fetch_assoc()) {
                      	$custo = str_replace(".", "", $custos['custo']);
              			$custo = str_replace(",", ".", $custo);
                      	$custo_total += $custo;
              		}
					echo number_format($custo_total, 2, ",", ".");?></td>
                </tr>
                <tr>
                  <th id="alter">Alterar</th>
                  <td id="alter"> <a href="alterar.php?id_curso=<?php echo $id_curso; ?>" class="btn btn-alter"><span class="material-icons-outlined">settings</span></a></td>
                </tr>
                <tr>
                  <th id="alter">Controle financeiro</th>
                  <td id="alter"> <a href="controle_add.php?id_curso=<?php echo $id_curso; ?>" class="btn btn-alter"><span class="material-icons-outlined">arrow_forward</span></a></td>
                </tr><?php } ?>
            </table>
            <?php if($count['total']<$curso['limite']){?>
            <div class="adiciona_sp">
              <a href="novo_cliente_curso.php?id_curso=<?php echo $id_curso; ?>" class="btn btn-primary">Novo cliente</a> 
            </div>
            <?php }?>
            <div class="tira">
              <h2>Clientes:</h2>
            </div>
            <?php
            $sql_code = "SELECT * FROM cliente c INNER JOIN curso_cliente cc ON cc.id_cliente = c.id_cliente INNER JOIN administrador a ON c.id_administrador = a.id_administrador WHERE cc.id_curso = '$id_curso'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
             while($cliente = $sql_query->fetch_assoc()) {
               $nome_admin = htmlspecialchars($cliente['nome_admin']);
               $nome_fantasia = htmlspecialchars($cliente['nome_fantasia']);
               $razao_social = htmlspecialchars($cliente['razao_social']);
               $nome = htmlspecialchars($cliente['nome_cliente']);
               $preco_venda_curso = htmlspecialchars($cliente['preco_venda_curso']);
               $forma_pagamento = htmlspecialchars($cliente['forma_pagamento']);
               $n_parcela = htmlspecialchars($cliente['n_parcela']);
               $nome_aluno_curso = htmlspecialchars($cliente['nome_aluno_curso']);
               $email_aluno_curso = htmlspecialchars($cliente['email_aluno_curso']);
               $telefone_aluno_curso = htmlspecialchars($cliente['telefone_aluno_curso']);
               ?>
            <table>
              <?php if($id_admin != $cliente['id_administrador']){?>
              	<tr>
                  <th>Nome do administrador</th>
                  <td><?php echo $nome_admin ; ?></td>
                </tr>
                <?php } ?>
                <tr>
                  <th>Nome fantasia</th>
                  <td><?php echo $nome_fantasia ; ?></td>
                </tr>
              	<tr>
                  <th>Razão Social</th>
                  <td><?php echo $razao_social ; ?></td>
                </tr>
                <tr>
                  <th>Nome</th>
                  <td><?php echo $nome; ?></td>
                </tr>
                <?php
                if($_SESSION['tipo'] == "S"||$cliente['id_administrador'] == $id_admin) {
                ?>
              	<tr>
                  <th>Preço pago</th>
                  <td><?php echo $preco_venda_curso; ?></td>
                </tr>
              	<tr>
                  <th>Forma de pagamento</th>
                  <td><?php echo $forma_pagamento; ?></td>
                </tr>
              	<tr>
                  <th>Nº de parcelas</th>
                  <td><?php echo $n_parcela."x parcelas"; ?></td>
                </tr>
              <tr>
                  <th>Nome do aluno</th>
                  <td><?php echo $nome_aluno_curso; ?></td>
                </tr>
              <tr>
                  <th>Email do aluno</th>
                  <td><?php echo $email_aluno_curso; ?></td>
                </tr>
              <tr>
                  <th>Telefone do aluno</th>
                  <td><?php echo $telefone_aluno_curso; ?></td>
                </tr>
              	<tr>
                  <th>Cliente</th>
                  <td id="alter"> <a href="../CLIENTE/view.php?id_cliente=<?php echo $cliente['id_cliente']; ?>" class="btn btn-alter"><span class="material-icons-outlined">arrow_forward</span></a></td>
                </tr>
              	<tr>
                  <th>Alterar venda</th>
                  <td id="alter"> <a href="alterar_cliente_curso.php?id_curso_cliente=<?php echo $cliente['id_curso_cliente']; ?>" class="btn btn-alter"><span class="material-icons-outlined">settings</span></a></td>
                </tr>
                <?php }?>
              <?php
                if($_SESSION['tipo'] == "S") {
                ?>
              	<tr>
                  <th>Controle de parcelas</th>
                  <td id="alter"> <a href="controle_parcela.php?id_curso_cliente=<?php echo $cliente['id_curso_cliente']; ?>" class="btn btn-alter"><span class="material-icons-outlined">arrow_forward</span></a></td>
                </tr>
              <?php }?>
            
                <?php }}else{
            ?> <tr><td colspan="3">Nenhum curso encontrado...</td></tr> <?php
          }?>
        </table> 
         <div class="daw"></div>
    </div>
   
</body>

</html>