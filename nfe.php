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
    $sqlSelect = "SELECT * from pedido where idPed = $id";
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
        $descricao = $row_users['descricao'];
        }
    }
}

if(isset($_POST['salvar'])){
        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $descricao = $_POST['descricao'];
        $idUser = $_SESSION['user'];
        $pay = $_POST['formaPagamento'];
        $cnpj = $_POST['cnpj'];
        $endereco = $_POST['endereco'];
        $save = mysqli_query($conn, "INSERT INTO empresa (nome, valor, descricaoProduto, idUser, formaPagamento, cnpj, endereco) 
        values ('{$nome}', '{$valor}', '{$descricao}', '{$idUser}', '{$pay}', '{$cnpj}', '{$endereco}')");
        
        if($save){
            echo "NFe salva com sucesso";
            header("Location:viewNFe.php");
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
    <title>NF-e</title>
</head>
<body>
    <header>
        <div class="info-header">
            Bem-Vindo
            <div class="logo">
                <h3> <?php echo  $_SESSION['nome']; ?></h3>
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
                <h2>Criar NFe</h2>
                <br/>
                <div class="separator"></div>
                <br/>
            </div>
            <div class="box-info">
            <section class="area-cadastro">
                <div class="cadastro">
                    <form method="POST" action="">
                        <h6 style="color: white;">Nome do Cliente ou Razão Social</h6>
                        <input type="text" name="nome"  placeholder="Nome do Cliente" value="<?php echo $nome ?>"></br>
                        <h6 style="color: white;">Valor do Frete</h6>
                        <input type="text" name="valor"  placeholder="Valor do Frete" value="<?php echo $valor ?>"></br>
                        <h6 style="color: white;">CNPJ ou CPF</h6>
                        <input type="text" name="cnpj" placeholder="CNPJ"></br>
                        <h6 style="color: white;">Endereço</h6>
                        <input type="text" name="endereco" placeholder="Endereco" value="<?php echo $endereco ?>">></br>
                        <h6 style="color: white;">Descricao do Produto</h6>
                        <input type="text" name="descricao" placeholder="Decricao" value="<?php echo $descricao ?>">></br>
                        <h6 style="color: white;">Forma de Pagamento</h6>
                        <select name="formaPagamento" id="formaPagamento">
                            <option selected disabled>
                                <?php 
                                    if ($pay == 'M') {
                                        echo  "Dinheiro";
                                    }else if($pay == 'C') {
                                        echo "Crédito";
                                    }else if($pay == 'D') {
                                        echo "Débito";
                                    } else{
                                        echo "Forma de Pagamento não Selecionada";
                                    }
                                ?>
                            </option>
                            <option value="M">Dinheiro</option>
                            <option value="C">Crédito</option>
                            <option value="D">Débito</option>
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
                            <a  href="viewPed.php">Voltar</a>
                        </p>
                    </div>
                    <a href="viewPed.php"><i class="fa-solid fa-circle-chevron-left"></i></a>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
</body>
</html>