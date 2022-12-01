<?php 
    include('../inc/database.php');
    include('../protecao.php');
    
    $dados = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sqlSelect = "SELECT * from etiqueta where idEt = $id";
        $result = mysqli_query($conn, $sqlSelect);
        while($row = mysqli_fetch_assoc($result)){
        $dados .= "<h4 style='text-align: center;'>Número da Etiqueta:  ". $row['idEt']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Nome do Remetente:  ". $row['nome']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Nome do Destinatário:  ". $row['nomeDestinatario']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Valor do Frete  R$". $row['frete']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Valor Desclarado do Produto:  R$". $row['valor'].",00</h4>";
        $dados .= "<h4 style='text-align: center;'>Tipo de Frete:  ".$row['tipoFrete']."</h4>";
        $dados .= "<h4 style='text-align: center;'>CEP de Origem:  ".$row['cepOrigem']."</h4>";
        $dados .= "<h4 style='text-align: center;'>CEP de Destino:  ".$row['cepDestino']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Altura do Pacote: ". $row['altura']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Largura do Pacote: ". $row['largura']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Comprimento do Pacote: ". $row['comprimento']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Descrição do Produto:  ".$row['descricao']."</h4>";
        $dados .= "<h4 style='text-align: center;'>Quantidade:  01</h4>";
    }
}
require_once 'dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
    $dompdf->loadHtml(
        '<h1 style="text-align: center;">Etiqueta de Entrega</h1><br>' . 
        $dados
    );
    $dompdf->render();
    $dompdf->stream(
        "Etiqueta.pdf",
        array(
            "Attachment"=>true
        )
    );
?>
    
        