<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION['id'])) {
        die("Voce nao pode acessar esta pagina. <p><a href=\"index.php\">Entrar</p>");
    }
?>
