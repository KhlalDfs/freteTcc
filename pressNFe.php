<?php 
    include('../inc/database.php');
    include('../protecao.php');
    
    $dados = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sqlSelect = "SELECT * from empresa where idNFe = $id";
        $result = mysqli_query($conn, $sqlSelect);
        while($row = mysqli_fetch_assoc($result)){
        $pay = $row['formaPagamento'];
        if($pay == "M"){$pay = "Dinheiro"; }
        else if($pay == "C"){$pay = "Crédito"; }
        else if($pay == "D"){$pay = "Débito"; }
        $dados .= "<h4 style='text-align: center;'>Número da Nota Fiscal:  ". $row['idNFe']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Nome do Cliente:  ". $row['nome']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Valor  R$". $row['valor'].",00</h4>";
        $dados .= "<h4 style='text-align: center;'>CNPJ ou CPF:  ".$row['cnpj']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Endereco:  ".$row['endereco']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Descrição do Produto:  ".$row['descricaoProduto']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Quantidade:  01</h4>";
        $dados .= "<h4 style='text-align: center;'>Forma de Pagamento:  ".$pay."</h4>";
    }
}
require_once 'dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
    $dompdf->loadHtml(
        '<h1 style="text-align: center;">NFe</h1><br>' . 
        $dados
    );
    $dompdf->render();
    $dompdf->stream(
        "NFe.pdf",
        array(
            "Attachment"=>true
        )
    );
?>
    
        