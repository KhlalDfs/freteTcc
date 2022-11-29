<?php
    include('inc/database.php');
    include('inc/validar2.php');
    $alert['error'] = $_SESSION['msg_error'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="modal.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Página Inicial</title>
</head> 
<body>
    <section class="area-login">
        <div class="login">
            <div>
                <img src="img/images.png">
            </div>
            <form action="" method="POST">
                    <input type="email" name="email" placeholder="E-mail" autofocus required>
                    <input type="password" name="senha" placeholder="Senha" required>
                    <input type="submit" value="Entrar">
            </form>
        </div>
    </section>
</body>
</html>
