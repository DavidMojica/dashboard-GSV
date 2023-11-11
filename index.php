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

    <link rel="stylesheet" href="templates/styles/btn_type_A.css">
    <title>Dashboard</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-secondary bg-gradient">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="resources/imgs/logo.jpg" class="logo" width="150" alt="logo_secretaria">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php
                    session_start();

                    // Comprueba si la sesión está iniciada
                    if (!isset($_SESSION['username'])) {
                    ?>
                        <li class="nav-item m-1">
                            <a href="templates/login.php">  
                                <button class="btn_type_A">Iniciar Sesión</button>
                            </a>
                        </li>'
                    <?php
                    } else {
                        echo '<li class="nav-item m-1">
                                <form action="processes/logout.php" method="post">
                                <input type="submit" value="Cerrar Sesión" class="button hbt">
                                </form></li>';
                    }
                    ?>

                    <li class="nav-item m-1"><a href="templates/admin.php">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="dashboard">

    </main>
</body>

</html>