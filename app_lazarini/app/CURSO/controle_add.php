<?php
include('../conexao.php');
include('../protect_s.php');
header("Content-type:text/html; charset=utf8");
if(isset($_GET['id_curso'])){
    $id_curso = $mysqli->real_escape_string($_GET['id_curso']);
 }
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
              		$preco_curso_total = htmlspecialchars($curso['preco_curso_total']);
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
                  <td><?php echo $preco_curso;?></td>
                </tr>
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
                  <th id="alter">Voltar para o curso</th>
                  <td id="alter"> <a href="view.php?id_curso=<?php echo $id_curso; ?>" class="btn btn-alter"><span class="material-icons-outlined">arrow_forward</span></a></td>
                </tr>
            </table>
            <div class="adiciona_sp">
              <a href="novo_controle_add.php?id_curso=<?php echo $id_curso; ?>" class="btn btn-primary">Novo custo</a> 
            </div>
            <div class="tira">
              <h2>Custos:</h2>
            </div>
            <?php
            $sql_code = "SELECT * FROM curso_custos cc INNER JOIN curso c ON cc.id_curso = c.id_curso WHERE cc.id_curso = '$id_curso'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
              
             while($curso_custo = $sql_query->fetch_assoc()) {
               $nome_custo = htmlspecialchars($curso_custo['nome_curso_custo']);
               $custo = htmlspecialchars($curso_custo['custo']);
				
               ?>
            <table>
                <tr>
                  <th>Nome do custo</th>
                  <td><?php echo $nome_custo ; ?></td>
                </tr>
              	<tr>
                  <th>Valor do custo</th>
                  <td><?php echo $custo ; ?></td>
                </tr>
              <tr>
                  <th>Alterar custo</th>
                  <td id="alter"> <a href="../CURSO/alterar_controle_add.php?id_curso_custos=<?php echo $curso_custo['id_curso_custos']; ?>" class="btn btn-alter"><span class="material-icons-outlined">settings</span></a></td>
                </tr>
            
                <?php }}else{
            ?> <tr><td colspan="3">Nenhum custo do curso encontrado...</td></tr> <?php
          }?>
        </table> 
         <div class="daw"></div>
    </div>
   
</body>

</html>