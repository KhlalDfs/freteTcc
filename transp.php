<?php 
include('../inc/database.php');
include('../protecao.php');
$alert['error'] = $_SESSION['msg_error'] ?? null;
$sqlNome = "SELECT nome from usuario where tipo = 'T' and id = 288";
$resultNome = mysqli_query($conn, $sqlNome);
if($resultNome->num_rows > 0){
while ($name = mysqli_fetch_assoc($resultNome)) {
    $nomeT1 = $name['nome'];
    }
}
/*$sqlNome = "SELECT * from usuario where tipo = 'T' and id = ";
$resultNome = mysqli_query($conn, $sqlNome);
if($resultNome->num_rows > 0){
while ($row_users = mysqli_fetch_assoc($resultNome)) {
    $nomeT2 = $row_users['nome'];
    }
}*/
$sqlNome = "SELECT nome from usuario where tipo = 'T' and id = 290";
$resultNome2 = mysqli_query($conn, $sqlNome);
if($resultNome2->num_rows > 0){
    while ($name = mysqli_fetch_assoc($resultNome2)) {
        $nomeT3 = $name['nome'];
        }
    }
?>