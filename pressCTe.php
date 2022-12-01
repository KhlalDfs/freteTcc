<?php 
    include('../inc/database.php');
    include('../protecao.php');
    
    $dados = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sqlSelect = "SELECT * from transportadora where idCTe = $id";
        $result = mysqli_query($conn, $sqlSelect);
        while($row = mysqli_fetch_assoc($result)){
        $dados .= "<h4 style='text-align: center;'>Número da CTe:  ". $row['idCTe']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Nome do Cliente:  ". $row['nome']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Valor do Documento  R$". $row['valor'].",00</h4>";
        $dados .= "<h4 style='text-align: center;'>CNPJ:  ".$row['cnpj']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Endereco do Destinatário:  ".$row['enderecoDestino']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Descrição do Produto:  ".$row['descricao']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Quantidade:  01</h4>";
    }
}
require_once 'dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
    $dompdf->loadHtml(
        '<h1 style="text-align: center;">CTe</h1><br>' . 
        $dados
    );
    $dompdf->render();
    $dompdf->stream(
        "CTe.pdf",
        array(
            "Attachment"=>true
        )
    );
?>
    
        