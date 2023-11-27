<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}
?>

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

    <link rel="stylesheet" href="../templates/styles/base.css">
    <link rel="stylesheet" href="../templates/styles/btn_type_A.css">
    <link rel="stylesheet" href="../templates/styles/bg_dotted.css">
    <link rel="stylesheet" href="../templates/styles/form_slashing.css">
    <link rel="stylesheet" href="../templates/styles/login.css">
    <link rel="shortcut icon" href="https://antioquia.gov.co/templates/gk_game/images/touch-device.png" type="image/x-icon">
    <script src="../scripts/login.js" defer></script>
    <title>Login | ANSV</title>
</head>
<body class="bg_dotted">
<nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../resources/logo.png" class="logo" alt="Gobernacion Antioquia">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li>
                        <a href="../index.php">
                            <button class="btn_type_A">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Regresar
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    
    <main>
        <div class="form-container">
            <form action="" class="form" method="POST" id="loginForm">
                <a class="navbar-brand logo_form" href="../index.php">
                <img src="../resources/logo.png" class="ans_logo" alt="Gobernacion Antioquia">
                </a>
                <h2>Iniciar Sesión</h2>
                <div class="form-group">
                    <label for="user">Usuario</label>
                    <input type="text" name="user" id="user">
                </div>
                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <input type="password" name="pass" id="pass">
                </div>
                <p id="msg"></p>
                <button class="form-submit-btn">Ingresar</button>
            </form>
        </div>
    </main>
    
</body>
</html>