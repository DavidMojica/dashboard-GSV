<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['username']) || !$_SESSION['username']) {
    header('Location: login.php');
    exit();
}
include('../processes/PDOconn.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- fa icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-success bg-gradient">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="" class="logo" width="250" alt="logo_secretaria">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item m-1"><a href="templates/admin.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>





    <form action="" method="POST">
        <h2>Accidentes</h2>
        <label for="municipio">Municipio</label>
        <select name="municipio" id="municipio">
            <option value="-1">Seleccione...</option>
            <?php
                $query = "SELECT * FROM tbl_municipio";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row) {
                    echo "<option value='". $row['id'] ."'>". $row['nombre'] ."</option>";
                } 
            ?>
        </select>

        <br>
        <label for="toggle">Muerte</label>
        <label class="switch">
            <input type="checkbox" id="toggle" onchange="updateValue()">
            <span class="slider"></span>
        </label>
        <label for="toggle">Lesión</label>
        <br>

        <br>
        <label for="victima">Tipo de víctima</label>

        <select name="victima" id="victima">
            <option value="-1">Seleccione...</option>
            <?php
                $query = "SELECT * FROM tbl_vehiculo";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row) {
                    echo "<option value='". $row['id'] ."'>". $row['nombre'] ."</option>";
                } 
            ?>

        </select>
        <br>
        <label for="cantidad">cantidad</label>
        <input type="number" name="cantidad" id="cantidad">

        <br>
        <label for="fecha">Seleccionar Año y Mes:</label>
        <input type="text" id="fecha" name="fecha" placeholder="YYYY-MM" pattern="\d{4}-\d{2}" title="Ingrese un formato válido (YYYY-MM)" oninput="validarFecha()">

        <br>
        <button>Ingresar</button>

    </form>

</body>

</html>