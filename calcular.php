<?php
   include('../inc/database.php');
   include('../protecao.php');
   include('transp.php');
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
    if(isset($_POST['calc'])){
        function calcular($cepIn, $cepOut, $peso, $valor, $tipoFrete, $altura, $largura, $comprimento){
            $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?";
            $url .= "nCdEmpresa=";
            $url .= "&sDsSenha=";
            $url .= "&sCepOrigem=" . $cepIn;
            $url .= "&sCepDestino=" . $cepOut;
            $url .= "&nVlPeso=" . $peso;
            $url .= "&nVlLargura=" . $largura;
            $url .= "&nVlAltura=" . $altura;
            $url .= "&nCdFormato=1";
            $url .= "&nVlComprimento=" . $comprimento;
            $url .= "&sCdMaoPropria=n";
            $url .= "&nVlValorDeclarado=" . $valor;
            $url .= "&sCdAvisoRecebimento=n";
            $url .= "&nCdServico=" . $tipoFrete;
            $url .= "&nVlDiametro=0";
            $url .= "&StrRetorno=xml";
    
            $xml = simplexml_load_file($url);
            return $xml->cServico;
        }
        $nome = $_SESSION['nome'];
        $cepIn = $_POST['cepOrigem'];
        $cepOut = $_POST['cepDestino'];
        $peso = $_POST['peso'];
        $valor = $_POST['valor'];
        $tipoFrete = $_POST['tipoFrete'];
        $altura = $_POST['altura'];
        $largura = $_POST['largura'];
        $comprimento = $_POST['comprimento'];
$val = calcular($cepIn,
$cepOut,
$peso,
$valor,
$tipoFrete,
$altura,
$largura,
$comprimento
);
$frete = $val->Valor;
$prazo = $val->PrazoEntrega;
$cotacao = mysqli_query($conn, "INSERT INTO cotacao (cepOrigem, cepDestino, peso, valor, comprimento, altura, largura, tipoFrete, idUser, frete, prazo, nome) 
values ('{$cepOrigem}', '{$cepDestino}', '{$peso}', '{$valor}', '{$comprimento}', '{$altura}', '{$largura}', '{$tipoFrete}', '{$id}', '{$frete}', '{$prazo}', '{$nome}')");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://data.jsdelivr.com/v1/package/npm/JSON/badge">
    <link rel="stylesheet" href="https://www.jsdelivr.com/package/npm/JSON">
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
            $("#cep").mask("99999-999")
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
                <h2>Realizar Cotação</h2>
                <br/>
                <div class="separator"></div>
                <br/>
            </div>
            <div class="box-info">
            <section class="area-cadastro">
                <div class="cadastro">
                    <form method="POST" action="">
                        <input type="text" name="cepOrigem" placeholder="CEP de Origem" required>
                        <input type="text" name="cepDestino"  placeholder="CEP de Destino" required>
                        <input type="text" name="valor"  placeholder="Valor Declarado" required>
                        <input type="tex" name="peso" placeholder="Peso" required>
                        <input type="text" name="comprimento" placeholder="Comprimento" required>
                        <input type="text" name="altura" placeholder="Altura" required>
                        <input type="text" name="largura" placeholder="Largura" required>
                        <select name="tipoFrete" id="tipoFrete">
                            <option selected disabled>Selecione o Tipo de Cotação</option>
                            <option value="40010"> Sedex</option>
                            <option value="41106"> PAC</option>
                        </select>
                        <input type="submit" name="calc" value="calcular" >
                    </form>
                </div>
             </section>
            </div>
            <div>
            <?php 
                if(isset($_POST['calc'])){ ?>
                    <div class="box-info">
                        <div style="background:linear-gradient(45deg, #FF5370, #FF869a);" class="box-info-single">
                            <div class="info-text">
                                <h5>
                                    <?php 
                                        if($tipoFrete == '41106'){
                                            $tipoFrete = "SEDEX";
                                        }else {
                                            $tipoFrete = "PAC";
                                        }
                                        echo $tipoFrete;
                                    ?>
                                </h5>
                                    <p>
                                        <?php 
                                            echo "R$ ".$frete;
                                            echo '</br>'.$prazo." Dias";
                                        ?>
                                    </p>
                                </div>
                            <a href="#" name><i class="fa-solid fa-floppy-disk"></i></a>
                        </div>
                        <div style="background:linear-gradient(45deg, #FF5370, #FF869a);" class="box-info-single">
                            <div class="info-text">
                                <h5>
                                    <?php 
                                    echo  "Transportadora ". $nomeT1;
                                    ?>
                                </h5>
                                    <p>
                                        <?php 
                                            $fr = (78 * $frete)/100;
                                            $frete = $fr + $frete;
                                            echo "R$ ".$frete;
                                            echo '</br>'.$prazo." Dias";
                                        ?>
                                    </p>
                                </div>
                            <a href="#" name><i class="fa-solid fa-floppy-disk"></i></a>
                        </div>
                        <div style="background:linear-gradient(45deg, #ff53ff70, #ff53ff);" class="box-info-single">
                            <div class="info-text">
                                <h5>
                                <?php 
                                    echo  "Transportadora ". $nomeT3;
                                    ?>
                                </h5>
                                    <p>
                                        <?php 
                                            $fr = (5 * $frete)/100;
                                            $frete = $fr + $frete;
                                            echo "R$ ".$frete;
                                            $prazo = $prazo + 2;
                                            echo '</br>'.$prazo." Dias";
                                        ?>
                                    </p>
                                </div>
                            <a href="#"><i class="fa-solid fa-floppy-disk"></i></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <div class="voltar">
            <div style="background:linear-gradient(45deg, #3f4866, #879ad8);" class="box-info-single">
                    <div class="info-text">
                        <p class="back">
                               <a  href="cotacao.php">Voltar</a> </p>
                         
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
</body>
</html>