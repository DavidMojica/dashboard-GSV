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
    
    <script src="../scripts/admin.js" defer></script>
    
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

    <form action="" method="POST" id="formAccidentes">
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
            <input type="checkbox" id="toggle">
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
        <label for="anio">Ingrese el año</label>
        <input type="number" id="anio" min="0" name="anio" placeholder="YYYY" pattern="\d{4}" title="Ingrese un formato válido (YYYY)">
        
        <select name="mes" id="mes">
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
        </select>
        
        <p id="msg_error"></p>
        <br>
        <button>Ingresar</button>

    </form>

    <form action="" method="POST" id="formDane">
        <h2>Dane</h2>
        <label for="municipio_dane">Municipio</label>
        <select name="municipio_dane" id="municipio_dane">
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

        <label for="cantidad_dane">cantidad</label>
        <input type="number" name="cantidad_dane" id="cantidad_dane" min="0">

        <label for="anio_dane">Año</label>
        <input type="number" id="anio_dane" min="0" name="anio_dane" placeholder="YYYY" pattern="\d{4}" title="Ingrese un formato válido (YYYY)">
        
        <p id="msg_dane"></p>
        <button>Ingresar</button>
    </form>

</body>

</html>