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
    $sqlSelect = "SELECT * from venda where idSell = $id";
    $resultEdit = mysqli_query($conn, $sqlSelect);
    if($resultEdit->num_rows > 0){
    while ($row_users = mysqli_fetch_assoc($resultEdit)) {
        $nome = $row_users['nome'];
        $status = $row_users['stats'];
        }
    }
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
    if(isset($_POST['update'])){
        $nome = $_POST['nome'];
        $status = $_POST['stats']; 
        $update = "UPDATE venda SET nome = '$nome', stats = '$status' WHERE idSell = '$id'";
        $executar = mysqli_query($conn, $update);
        if($executar){
            header("Location:viewSell.php");
        } else {
            echo '<script type="text/javascript">alert("Erro!")</script>';
        }
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
            <a href=""><img src="../img/images.png" alt=""></a>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </header>
    <section class="main">
        <div class="sidebar">
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
                        <input type="text" name="nome" placeholder="Nome" value="<?php echo $nome ?>" >
                        <select name="stats" id="stats">
                            <option selected disabled>
                                <?php 
                                    if ($status == 'P') {
                                        echo "Pendente";
                                    }else if($status == 'C') {
                                        echo "Concluído";
                                    }else if($status == 'E') {
                                        echo "Cancelado";
                                    }else {
                                        echo 'Erro!';
                                    }
                                ?>
                            </option>
                            <option value="P">Pendente</option>
                            <option value="C">Concluído</option>
                            <option value="E">Cancelado</option>
                        </select>
                        <input type="submit" name="update" value="atualizar" >
                    </form>
                </div>
             </section>
            </div>
        <div class="voltar">
            <div style="background:linear-gradient(45deg, #3f4866, #879ad8);" class="box-info-single">
                    <div class="info-text">
                        <p class="back">
                            <a  href="viewSell.php">Voltar</a>
                        </p>
                    </div>
                    <a href="viewSell.php"><i class="fa-solid fa-circle-chevron-left"></i></a>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
</body>
</html>
<?php 

    
?>