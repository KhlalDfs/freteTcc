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
        $cpf = $row_users['cpf'];
        $email = $row_users['email'];
        $senha = $row_users['senha'];
        $telefone = $row_users['telefone'];
        $cep = $row_users['cep'];
        $endereco = $row_users['endereco'];
        $tipo = $row_users['tipo'];
        $dataNascimento = $row_users['dataNascimento'];
        }
    }

if(isset($_SESSION['user'])){
    $id = $_SESSION['user'];
    if(isset($_POST['update'])){
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf']; 
        $email = $_POST['email']; 
        $senha = $_POST['senha']; 
        $telefone = $_POST['telefone']; 
        $cep = $_POST['cep']; 
        $endereco = $_POST['endereco']; 
        $dataNascimento = $_POST['dataNascimento']; 
        $tipo = $_POST['tipo'];
        $update = "UPDATE usuario SET nome = '$nome', cpf = '$cpf', email = '$email', senha = '$senha', telefone = '$telefone', cep = '$cep', endereco = '$endereco', tipo = '$tipo', dataNascimento = '$dataNascimento' WHERE id = '$id'";
        $executar = mysqli_query($conn, $update);
        if($executar){
            echo '<script type="text/javascript">alert("Usuário Atualizado com Sucesso")</script>';
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
    <script type="text/javascript">
        $(document).ready(function(){
            $("#cpf").mask("999.999.999-99");
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#telefone").mask("(99) 99999-9999")
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#cep").mask("99999-999")
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#data").mask("99/99/9999")
        });
    </script>
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
                <h2>Editar Dados do Perfil</h2>
                <br/>
                <div class="separator"></div>
                <br/>
            </div>
            <div class="box-info">
            <section class="area-cadastro">
                <div class="cadastro">
                    <form method="POST" action="">
                        <input type="text" name="nome" placeholder="Nome" value="<?php echo $nome; ?>" >
                        <input type="text" name="cpf"  placeholder="CPF" id="cpf" value="<?php echo $cpf; ?>" >
                        <input type="email" name="email" placeholder="E-Mail" value="<?php echo $email; ?>" >
                        <input type="text" name="dataNascimento" placeholder="Data de Nascimento" id="data" value="<?php echo $dataNascimento ?>" >
                        <input type="text" name="senha" placeholder="Senha" value="<?php echo $senha; ?>" >
                        <input type="text" name="telefone" placeholder="Telefone" id="telefone" value="<?php echo $telefone ?>">
                        <input type="text" name="cep" placeholder="CEP" id="cep" value="<?php echo $cep ?>">
                        <input type="text" name="endereco" placeholder="Endereço" value="<?php echo $endereco ?>">
                        <?php if($tipo == "A"){ ?>
                        <select name="tipo" id="tipo">
                            <option selected disabled>
                                <?php 
                                    if ($tipo == 'T') {
                                        echo "Trasportadora";
                                    }else if($tipo == 'A') {
                                        echo "Administrador";
                                    }else if($tipo == 'E') {
                                        echo "Empresa";
                                    }else if($tipo == 'C') {
                                        echo "Correios";
                                    }else {
                                        echo 'Erro!';
                                    }
                                ?>
                            </option>
                            <option value="A">Adminstrador</option>
                            <option value="T">Transportadora</option>
                            <option value="E">Empresa</option>
                            <option value="C">Correios</option>
                        </select>
                        <?php } ?>
                        <input type="submit" name="update" value="atualizar" >
                    </form>
                </div>
             </section>
            </div>
        <div class="voltar">
            <div style="background:linear-gradient(45deg, #3f4866, #879ad8);" class="box-info-single">
                    <div class="info-text">
                        <p class="back">
                            <?php
                            if($tipo == "A"){ ?>
                               <a  href="edit.php">Voltar</a> <?php }
                               else if($tipo == "T"){ ?>
                               <a  href="painelT.php">Voltar</a> <?php }
                            ?>
                        </p>
                    </div>
                        <?php
                            if($tipo == "A"){ ?>
                                <a href="edit.php"><i class="fa-solid fa-circle-chevron-left"></i></a> <?php }
                               else if($tipo == "T"){ ?>
                                <a href="painelT.php"><i class="fa-solid fa-circle-chevron-left"></i></a> <?php }
                        ?>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
</body>
</html>