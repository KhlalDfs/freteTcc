<?php
    include('../inc/database.php');
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if(isset($_GET['id'])){
        $id = $_GET['id'];
            $delete = "DELETE FROM postagem WHERE idPost = '$id'";
            $executar = mysqli_query($conn, $delete);
            if($executar){
                header("Location:viewPost.php");
            }
        }
?>