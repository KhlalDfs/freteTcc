<?php
    include('../inc/database.php');
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if(isset($_GET['id'])){
        $id = $_GET['id'];
            $delete = "DELETE FROM usuario WHERE id = '$id'";
            $executar = mysqli_query($conn, $delete);
            if($executar){
                header("Location:edit.php");
                echo '<script type="text/javascript">alert("Erro!")</script>';
            } else {
                echo '<script type="text/javascript">alert("Erro!")</script>';
            }
        }
?>