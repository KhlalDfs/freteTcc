<?php
   include('../inc/database.php');
   include('../protecao.php');
   $id = $_SESSION['user'];
   $sqlSelect = "SELECT * from usuario where id = $id";
   $resultEdit = mysqli_query($conn, $sqlSelect);
   if($resultEdit->num_rows > 0){
    while ($row_users = mysqli_fetch_assoc($resultEdit)) {
        $nome = $row_users['nome'];
        $tipo = $row_users['tipo'];
        }
    }

   if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sqlSelect = "SELECT * from cotacao where idCot = $id";
    $resultEdit = mysqli_query($conn, $sqlSelect);
    if($resultEdit->num_rows > 0){
    while ($row_users = mysqli_fetch_assoc($resultEdit)) {
        $nome = $row_users['nome'];
        $cepIn = $row_users['cepOrigem'];
        $cepOut = $row_users['cepDestino'];
        $peso = $row_users['peso'];
        $valor = $row_users['valor'];
        $tipoFrete = $row_users['tipoFrete'];
        $altura = $row_users['altura'];
        $largura = $row_users['largura'];
        $comprimento = $row_users['comprimento'];
        $frete = $row_users['frete'];
        $prazo = $row_users['prazo'];
        }
    }
}

if(isset($_POST['salvar'])){
        $nome = $_POST['nome'];
        $cepIn = $_POST['cepOrigem'];
        $cepOut = $_POST['cepDestino'];
        $peso = $_POST['peso'];
        $valor = $_POST['valor'];
        $altura = $_POST['altura'];
        $largura = $_POST['largura'];
        $comprimento = $_POST['comprimento'];
        $frete = $_POST['frete'];
        $prazo = $_POST['prazo'];
        $descricao = $_POST['descricao'];
        $idUser = $_SESSION['user'];
        $save = mysqli_query($conn, "INSERT INTO pedido (nome, cepOrigem, cepDestino, peso, valor, comprimento, altura, largura, tipoFrete, idUser, frete, prazo, descricao) 
        values ('{$nome}', '{$cepOrigem}', '{$cepDestino}', '{$peso}', '{$valor}', '{$comprimento}', '{$altura}', '{$largura}', '{$tipoFrete}', '{$idUser}', '{$frete}', '{$prazo}', '{$descricao}')");
        $executar = mysqli_query($conn, $save);
        if($save){
            echo "Pedido salvo com sucesso";
            header("Location:viewPed.php");
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="form1.css">
    <title>Entrega</title>
</head>
<body>
    <header>
        <div class="info-header">
            Bem-Vindo 
            <div class="logo">
                <h3><?php echo  $_SESSION['nome']; ?></h3>
            </div>
            <div class="icons-header">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
        <div style="align-items: center;" class="info-header">
            <i class="fa-solid fa-envelope"></i>
            <i class="fa-solid fa-bell"></i>
            <a href="perfil.php"><img src="../img/images.png" alt=""></a>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </header>
    <section class="main">
    <div class="sidebar">
            <?php
                if($tipo == "A"){ ?>
                    <a  href="painelA.php">Home</a>
                    <a href="cadastrar.php"><i class="fa-solid fa-users-gear"></i> Usuários</a>
                    <a href="vendas.php"><i class="fa-solid fa-cash-register"></i> Vendas</a>
                     <?php }
                else if($tipo == "T"){ ?>
                    <a  href="painelT.php">Home</a> <?php }
                    else if($tipo == "E"){ ?>
                        <a  href="painelE.php">Home</a> <?php }
                        else if($tipo == "C"){ ?>
                            <a  href="painelC.php">Home</a> <?php }
                ?>
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
        <div class="content">
            <div class="titulo-secao">
                <h2>Editar Dados</h2>
                <br/>
                <div class="separator"></div>
                <br/>
            </div>
            <div class="box-info">
            <section class="area-cadastro">
                <div class="cadastro">
                    <form method="POST" action="">
                        <h6 style="color: white;">Nome do Cliente</h6>
                        <input type="text" name="nome" placeholder="Nome" value="<?php echo $nome ?>"></br>
                        <h6 style="color: white;">Cep de Origem</h6>
                        <input type="text" name="cepOrigem" placeholder="CEP de Origem" value="<?php echo $cepIn ?>"></br>
                        <h6 style="color: white;">Cep de Destino</h6>
                        <input type="text" name="cepDestino"  placeholder="CEP de Destino" value="<?php echo $cepOut ?>"></br>
                        <h6 style="color: white;">Valor Declarado</h6>
                        <input type="text" name="valor"  placeholder="Valor Declarado" value="<?php echo $valor ?>"></br>
                        <h6 style="color: white;">Peso</h6>
                        <input type="tex" name="peso" placeholder="Peso" value="<?php echo $peso ?>"></br>
                        <h6 style="color: white;">Comprimento</h6>
                        <input type="text" name="comprimento" placeholder="Comprimento" value="<?php echo $comprimento." cm" ?>"></br>
                        <h6 style="color: white;">Altura</h6>
                        <input type="text" name="altura" placeholder="Altura" value="<?php echo $altura?>"></br>
                        <h6 style="color: white;">Largura</h6>
                        <input type="text" name="largura" placeholder="Largura" value="<?php echo $largura ?>"></br>
                        <h6 style="color: white;">Valor do frete</h6>
                        <input type="text" name="frete" placeholder="Frete" value="<?php echo $frete ?>"></br>
                        <h6 style="color: white;">Prazo do frete</h6>
                        <input type="text" name="prazo" placeholder="Prazo" value="<?php echo $prazo ?>"></br>
                        <h6 style="color: white;">Descricao do Produto</h6>
                        <input type="text" name="descricao" placeholder="Decricao"></br>
                        <h6 style="color: white;">Tipo de Frete</h6>
                        <select name="tipoFrete" id="tipoFrete">
                            <option selected disabled>
                                <?php 
                                    if ($tipoFrete == '40010') {
                                        echo  "Sedex";
                                    }else if($tipoFrete == '41106') {
                                        echo "PAC";
                                    }
                                ?>
                            </option>
                        </select>
                        <input type="submit" name="salvar" value="salvar" >
                    </form>
                </div>
             </section>
            </div>
        <div class="voltar">
            <div style="background:linear-gradient(45deg, #3f4866, #879ad8);" class="box-info-single">
                    <div class="info-text">
                        <p class="back">
                            <a  href="edit.php">Voltar</a>
                        </p>
                    </div>
                    <a href="edit.php"><i class="fa-solid fa-circle-chevron-left"></i></a>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
</body>
</html>