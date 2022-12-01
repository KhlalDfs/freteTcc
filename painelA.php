<?php
   include('../inc/database.php');
   include('../protecao.php');
   $alert['error'] = $_SESSION['msg_error'] ?? null;
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Home</title>
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
            <a href="painelA.php"><h3>Home</h3></a>
            <a href="cadastrar.php"><i class="fa-solid fa-users-gear"></i> Usuários</a>
            <a href="vendas.php"><i class="fa-solid fa-cash-register"></i> Vendas</a>
            <a href="cotacao.php"><i class="fa-solid fa-truck-fast"></i> Cotação</a>
            <a href="pedido.php"><i class="fa-solid fa-cart-shopping"></i> Pedido</a>
            <a href="viewEt.php"><i class="fa-solid fa-ticket"></i> Etiquetas</a>
            <a href="viewNFe.php" ><i class="fa-solid fa-file-invoice-dollar"></i> Nota Fiscal</a>
            <a href="viewCTe.php"><i class="fa-solid fa-file-import"></i> Conhecimento de Transporte Eletronico</a>
            <br/>
        </div>
        <div class="content">
            <div class="titulo-secao">
                <h2>Dashboard</h2>
                <br/>
                <div class="separator"></div>
                <br/>
            </div>
            <div class="box-info">
                <div style="background:linear-gradient(45deg, #FF5370, #FF869a);" class="box-info-single">
                    <div class="info-text">
                        <?php 
                            $result_users = "SELECT * from venda";
                            $view = mysqli_query($conn, $result_users);
                            $total = mysqli_num_rows($view);
                        ?>
                        <h5>Total de Vendas</h5>
                        <p><?php echo $total." vendas"?></p>
                    </div>
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
                <div style="background:linear-gradient(45deg, #3f4866, #879ad8);" class="box-info-single">
                    <div class="info-text">
                        <?php 
                            $result_users = "SELECT * from pedido";
                            $view = mysqli_query($conn, $result_users);
                            $total = mysqli_num_rows($view);
                        ?>
                        <h5>Total de Pedidos</h5>
                        <p><?php echo $total." pedidos"?></p>
                    </div>
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div style="background:linear-gradient(45deg, #61a550, #a2fa8c);" class="box-info-single">
                    <div class="info-text">
                        <?php 
                            $result_users = "SELECT * from cotacao";
                            $view = mysqli_query($conn, $result_users);
                            $total = mysqli_num_rows($view);
                        ?>
                        <h5>Total de Cotações</h5>
                        <p><?php echo $total." cotações"?></p>
                    </div>
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
</body>
</html>