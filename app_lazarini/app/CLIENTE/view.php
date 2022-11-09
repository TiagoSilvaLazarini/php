<?php
include('../conexao.php');
include('../protect.php');
header("Content-type:text/html; charset=utf8");

if(isset($_GET['id_cliente'])){
    $id = $mysqli->real_escape_string($_GET['id_cliente']);
 }
 $sql_code = "SELECT * FROM cliente c INNER JOIN administrador a ON a.id_administrador = c.id_administrador WHERE c.id_cliente = '$id' ";
 $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
 $cliente = $sql_query->fetch_assoc();
 $quantidade_cli = $sql_query->num_rows;

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
          <div class="tira">
                <h2>Cliente:</h2>
        </div>
            <?php 
            if($quantidade_cli > 0){
                if($cliente['id_administrador'] == $_SESSION['id'] || $_SESSION['tipo'] == "S"){
                  $nome_admin = htmlspecialchars($cliente['nome_admin']);
                  $nome = htmlspecialchars($cliente['nome_cliente']);
                  $nome_fantasia = htmlspecialchars($cliente['nome_fantasia']);
                  $razao_soial = htmlspecialchars($cliente['razao_social']);
                  $email = htmlspecialchars($cliente['email_cliente']);
                  $celular = htmlspecialchars($cliente['telefone_celu']);
                  $telefone = htmlspecialchars($cliente['telefone_fixo']);
                  $cnpj = htmlspecialchars($cliente['cnpj']);
                  $inscricão_esta = htmlspecialchars($cliente['inscricao_estadual']);
                  $cpf = htmlspecialchars($cliente['cpf']);
                  $rg = htmlspecialchars($cliente['rg']);
                  $estado = htmlspecialchars($cliente['estado']);
                  $cidade = htmlspecialchars($cliente['cidade']);
                  $bairro = htmlspecialchars($cliente['bairro']);
                  $endereco = htmlspecialchars($cliente['endereco']);
                  $cep = htmlspecialchars($cliente['cep']);
                  if($cliente['aniversario'] == null){
                    $data_niver = "";
                  }else{
                    $data=strtotime($cliente['aniversario']);
                    $data_niver = htmlspecialchars(date("d/m/Y",$data));
                  }
                 ?>
            <table>
                <?php
                if($_SESSION['tipo'] == "S" && $cliente['id_administrador'] != $_SESSION['id']) {
                ?>
                <tr>
                  <th>Admin</th>
                  <td><?php echo $nome_admin; ?></td>
                </tr>
                <?php }?>
                <tr>
                  <th>Nome</th>
                  <td><?php echo $nome; ?></td>
                </tr>
                <tr>
                  <th>Nome fantasia</th>
                  <td><?php echo $nome_fantasia; ?></td>
                </tr>
                <tr>
                  <th>Razão Social</th>
                  <td><?php echo $razao_soial; ?></td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td><?php echo $email; ?></td>
                </tr>
                <tr>
                  <th>Celular</th>
                  <td><a href="tel:xx55555555" ><?php echo $celular;?></a></td>
                </tr>
                <tr>
                  <th>Telefone</th>
                  <td><a href="tel:xx55555555" ><?php echo $telefone;?></a></td>
                </tr>
                <tr>
                  <th>CNPJ</th>
                  <td><?php echo $cnpj;?></td>
                </tr>
                <tr>
                  <th>Inscrição Estadual</th>
                  <td><?php echo $inscricão_esta;?></td>
                </tr>
                <tr>
                  <th>CPF</th>
                  <td><?php echo $cpf;?></td>
                </tr>
                <tr>
                  <th>RG</th>
                  <td><?php echo $rg;?></td>
                </tr>
                <tr>
                  <th>Endereço</th>
                  <td><?php echo $estado.', '.$cidade.', '.$bairro.', '.$endereco;?></td>
                </tr>
                <tr>
                  <th>CEP</th>
                  <td><?php echo $cep;?></td>
                </tr>
                <tr>
                  <th>Data de aniversario</th>
                  <td><?php echo $data_niver; ?></td>
                </tr>
                
                <tr>
                  <th id="alter">Alterar</th>
                  <td id="alter"> <a href="alterar.php?id_cliente=<?php echo $cliente['id_cliente']; ?>" class="btn btn-alter"><span class="material-icons-outlined">settings</span></a></td>
                </tr>
            </table>
            <div class="adiciona_sp">
              <a href="nova_venda.php?id_cliente=<?php echo $cliente['id_cliente']; ?>" class="btn btn-primary">Nova venda</a>
            </div>
            <div class="tira">
              <h2>produto:</h2>
            </div>
            <?php 
            $sql_code = "SELECT * FROM produto_n p INNER JOIN venda v ON v.id_produto = p.id_produto
            WHERE v.id_cliente = '$id' ORDER BY v.data DESC";
              $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
            while($produto = $sql_query->fetch_assoc()) {
              $nome = htmlspecialchars($produto['nome_produto']);
              $descricao = htmlspecialchars($produto['descricao']);
              $preco = htmlspecialchars($produto['preco']);
              $entrega = htmlspecialchars($produto['entrega_tecnica']);
              $boleto = htmlspecialchars($produto['nota_fiscal']);
              $data=strtotime($produto['data']);
              $data_venda = htmlspecialchars(date("d/m/Y",$data));
              ?>
            <table>
                <tr>
                  <th>ID</th>
                  <td><?php echo $nome; ?></td>
                </tr>
                <tr>
                  <th>Descrição</th>
                  <td><?php echo $descricao; ?></td>
                </tr>
                <tr>
                  <th>Preço</th>
                  <td><?php echo $preco; ?></td>
                </tr>
                <tr>
                  <th>Data da venda</th>
                  <td><?php echo $data_venda; ?></td>
                </tr>
                <tr>
                  <th>Entrega tecnica</th>
                  <td><?php echo $entrega; ?></td>
                </tr>
                <tr>
                  <th>Boleto</th>
                  <td><?php echo $boleto; ?></td>
                </tr>
                <tr>
                  <th id="alter">Alterar</th>
                  <td id="alter"> <a href="alterar_venda.php?id_venda=<?php echo $produto['id_venda']; ?>" class="btn btn-alter"><span class="material-icons-outlined">settings</span></a></td>
                </tr>
            </table>
            <?php }?>
            <div class="adiciona_sp">
              <a href="nova_agenda.php?id_cliente=<?php echo $cliente['id_cliente']; ?>" class="btn btn-primary">Nova agenda</a>
            </div>
            <div class="tira">
            <h2>Agenda:</h2>
            </div>
            <?php 
            $sql_code = "SELECT * FROM agenda WHERE id_cliente = '$id' order by data_futura DESC";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);
             while($agenda = $sql_query->fetch_assoc()) {
              $data=strtotime($agenda['data']);
              $data_realizada = htmlspecialchars(date("d/m/Y",$data));
              $comentario = htmlspecialchars($agenda['comentario']);
              $data=strtotime($agenda['data_futura']);
              $data_marcada = htmlspecialchars(date("d/m/Y",$data));
               ?>
            <table>
                <tr>
                  <th>Realizada</th>
                  <td><?php   echo $data_realizada; ?></td>
                </tr>
                <tr>
                  <th>Marcada</th>
                  <td><?php   echo $data_marcada; ?></td>
                </tr>
                <tr>
                  <th>Comentario</th>
                  <td><?php echo $comentario; ?></td>
                </tr>
                <tr>
                  <th id="alter">Alterar</th>
                  <td id="alter"> <a href="alterar_agenda.php?id_venda=<?php echo $produto['id_venda']; ?>" class="btn btn-alter"><span class="material-icons-outlined">settings</span></a></td>
                </tr>
            
                <?php }} else{
                    ?> <tr><td colspan="3">Nenhum cliente encontrado...</td></tr> <?php
            } }else{
            ?> <tr><td colspan="3">Nenhum cliente encontrado...</td></tr> <?php
          }?>
        </table> 
        <div class="daw"></div>
    </div>
    
</body>

</html>