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
   $cadastro = mysqli_query($conn, "INSERT INTO usuario (cpf, email, nome, senha, tipo, telefone, cep, endereco, dataNascimento) 
   values ('{$cpf}', '{$email}', '{$nome}', '{$senha}', '{$tipo}', '{$telefone}', '{$cep}', '{$endereco}', '{$dataNascimento}') ");
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
    <title>Cadastrar Usuário</title>
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
                <h2>Formulário de Cadastro</h2>
                <br/>
                <div class="separator"></div>
                <br/>
            </div>
            <div class="box-info">
            <section class="area-cadastro">
                <div class="cadastro">
                    <form action="" method="POST">
                        <input type="text" name="nome" placeholder="Nome">
                        <input type="text" name="cpf"  placeholder="CPF"  id="cpf" required>
                        <input type="email" name="email" placeholder="E-mail"  required>
                        <input type="text" placeholder="Dia/Mes/Ano" name="dataNascimento" id="data">
                        <input type="text" name="senha" placeholder="Senha" required>
                        <input type="text" name="telefone" placeholder="Telefone" id="telefone">
                        <input type="text" name="cep" placeholder="Cep de Origem"  id="cep">
                        <input type="text" name="endereco" placeholder="Endereço">
                        <select name="tipo" id="tipo">
                            <option selected disabled>Selecione o Tipo de conta a ser aberta</option>
                            <option value="A">Adminstrador</option>
                            <option value="T">Transportadora</option>
                            <option value="E">Empresa</option>
                            <option value="C">Correios</option>
                        </select>
                        <input type="submit" name="enviar">
                    </form>
                </div>
             </section>
            </div>
        <div class="voltar">
            <div style="background:linear-gradient(45deg, #3f4866, #879ad8);" class="box-info-single">
                    <div class="info-text">
                        <p class="back">
                            <a  href="cadastrar.php">Voltar</a>
                        </p>
                    </div>
                    <a href="cadastrar.php"><i class="fa-solid fa-circle-chevron-left"></i></a>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
</body>
</html>