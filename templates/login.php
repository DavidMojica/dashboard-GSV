<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- fa icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../scripts/login.js" defer></script>
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" id="loginForm">
        <label for="user">Usuario</label>
        <input type="text" name="user" id="user">

        <label for="pass">Contraseña</label>
        <input type="password" name="pass" id="pass">
        <p id="msg"></p>

        <button id="send">Ingresar</button>
    </form>
    
</body>
</html>