<?php
   include('../inc/database.php');
   include('../protecao.php');
   $alert['error'] = $_SESSION['msg_error'] ?? null;
   $id = $_SESSION['user'];
   $sqlSelect = "SELECT * from usuario where id = $id";
   $resultEdit = mysqli_query($conn, $sqlSelect);
   if($resultEdit->num_rows > 0){
    while ($row_users = mysqli_fetch_assoc($resultEdit)) {
        $nome = $row_users['nome'];
        $tipo = $row_users['tipo'];
        }
    }
   $result_users = "SELECT * from  usuario";
    $view = mysqli_query($conn, $result_users);
    $pgn = (isset($_GET['pagina']))? $_GET['pagina']:1;
    $total = mysqli_num_rows($view);
    $qtd = 10;
    $nump = ceil($total/$qtd);
    $inicio = ($qtd*$pgn)-$qtd;
    $rest = "SELECT * from  usuario limit $inicio, $qtd";
    $resultRest = mysqli_query($conn, $rest);
    $ver = mysqli_num_rows($resultRest);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleTable.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="delete.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> 
    <title>Editar Usuários</title>
</head>
<body>
    <header class="cabecalho">
        <div class="info-cab">
            Bem-Vindo
            <div class="lg">
                <h3><?php echo  $_SESSION['nome']; ?></h3>
            </div>
            <div class="icons-cab">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
        <div style="align-items: center;" class="info-cab">
            <i class="fa-solid fa-envelope"></i>
            <i class="fa-solid fa-bell"></i>
            <a href="#"><img src="../img/images.png" alt=""></a>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </header>
    <section class="principal">
        <div class="barra">
            <a href="painelA.php"><h3>Home</h3></a>
            <a href="cadastrar.php"><i class="fa-solid fa-users-gear"></i> Usuários</a>
            <a href="vendas.php"><i class="fa-solid fa-cash-register"></i> Vendas</a>
            <a href="cotacao.php"><i class="fa-solid fa-truck-fast"></i> Cotação</a>
            <a href="pedido.php"><i class="fa-solid fa-cart-shopping"></i> Pedido</a>
            <a href="viewEt.php"><i class="fa-solid fa-ticket"></i> Etiquetas</a>
            <?php if($tipo == "A" || $tipo == "E"){?>
                <a href="viewNFe.php" ><i class="fa-solid fa-file-invoice-dollar"></i> Nota Fiscal</a>
                <?php } ?>
                <?php if($tipo == "A" || $tipo == "T"){?>
                <a href="viewCTe.php"><i class="fa-solid fa-file-import"></i> Conhecimento de Transporte Eletronico</a>
            <?php } ?>
            <br/>
        </div>
        <div class="conteudo">
            <div class="titulo-secao">
                <h2>Editar e Excluir Usuários</h2>
                <br/>
                <div class="separador"></div>
                <br/>
            </div>
            <div class="table">
                <div class="container theme-showcase" role="main">
                    <div class="page-header"></div>
                    <div class="row">
                        <div >
                            <table class="table" style="width: 90%;">   
                                <thead>
                                    <tr style="font-size: 8px;">
                                        <th>ID Usuário</th>
                                        <th>Nome</th>
                                        <th>Data de Nascimento</th>
                                        <th>Tipo de Conta</th>
                                        <th>Telefone</th>
                                        <th>Endereço</th>
                                        <th>Editar</th>
                                        <th>Remover</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 13px;">
                                    <?php while($rows_users = mysqli_fetch_assoc($resultRest)){?>
                                        <tr>
                                            <td><?php echo $rows_users['id'];?></td>
                                            <td><?php echo $rows_users['nome'];?></td>
                                            <td><?php echo $rows_users['dataNascimento'];?></td>
                                            <td><?php 
                                                if ($rows_users['tipo'] == 'T') {
                                                    $rows_users['tipo'] = 'Transportadora';
                                                }else if($rows_users['tipo'] == 'A') {
                                                    $rows_users['tipo'] = 'Administrador';
                                                }else if($rows_users['tipo'] == 'E') {
                                                    $rows_users['tipo'] = 'Empresa';
                                                }else if($rows_users['tipo'] == 'C') {
                                                    $rows_users['tipo'] = 'Correios';
                                                }else {
                                                    echo 'Erro!';
                                                }
                                                echo $rows_users['tipo'];
                                            ?></td>
                                            <td><?php echo $rows_users['telefone'];?></td>
                                            <td><?php echo $rows_users['endereco'];?></td>
                                            <?php  echo "<td><a href='editForm.php?id=$rows_users[id]'>"?><i class="fa-solid fa-pen-to-square"></i></a></td>
                                            <?php  echo "<td><a href='delete.php?id=$rows_users[id]' style='color: red'>"?><i class="fa-solid fa-trash"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
</body>
</html>