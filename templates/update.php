<?php
include('../processes/PDOconn.php');
$formToDisplay = isset($_GET['f']) ? $_GET['f'] : '';
if ($formToDisplay == 1) {
    $query = "SELECT a.id as id, m.nombre as Mes, a.anio as Año, v.nombre as Vehiculo, c.nombre as municipio, t.nombre as ML, a.cantidad as Cantidad
    FROM tbl_accidente a
    JOIN tbl_meses m on a.mes = m.id
    JOIN tbl_vehiculo v on a.vehiculo = v.id
    JOIN tbl_municipio c on a.municipio = c.id
    JOIN tbl_tipo_accidente t on a.tipo_accidente = t.id
    ORDER BY a.id DESC
    LIMIT 30;";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Meses
    $query = "SELECT id, nombre FROM tbl_meses";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $meses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Vehículo
    $query = "SELECT id, nombre FROM tbl_vehiculo";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $vehiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Municipios
    $query = "SELECT id, nombre FROM tbl_municipio";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $municipio = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Tipos consecuencia
    $query = "SELECT id, nombre FROM tbl_tipo_accidente";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $ml = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else if ($formToDisplay == 2) {
    $query = "SELECT p.id, m.nombre as municipio, p.anio as anio, p.cantidad as cantidad 
    FROM tbl_poblacion p
    JOIN tbl_municipio m on p.id_municipio = m.id
    ORDER BY p.id DESC
    LIMIT 30;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    //Municipios
    $query = "SELECT id, nombre FROM tbl_municipio";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $municipio = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- fa icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Update | ANSV</title>
    <link rel="stylesheet" href="styles/base.css">
    <link rel="stylesheet" href="styles/bg_dotted.css">
    <link rel="stylesheet" href="styles/btn_type_A.css">
    <link rel="stylesheet" href="styles/update.css">
    <link rel="shortcut icon" href="https://www.ansv.gov.co/sites/default/files/imagenes/favicon-ansv.png" type="image/x-icon">



</head>

<body class="bg_dotted">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../resources/logo.png" class="logo" alt="Gobernacion Antioquia">
            </a>
            <button class="navbar-toggler tg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item m-1">
                        <a href="admin.php"><button class="btn_type_A">Volver</button></a>
                    </li>
                    <li class="nav-item m-1">
                        <form action="../processes/logout.php" method="post">
                            <input type="submit" value="Cerrar Sesión" class="btn_type_A">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?php

        if ($formToDisplay == 1) {
        ?>
            <h1 class="text-light">Accidentes - Últimos 30 registros insertados</h1>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mes</th>
                        <th scope="col">Año</th>
                        <th scope="col">Vehículo</th>
                        <th scope="col">Municipio</th>
                        <th scope="col">Tipo Consecuencia</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Actualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $row) {
                        echo '<tr>
                        <th scope="row">' . $row['id'] . '</th>
                        <td>
                            <form method="POST" action="../processes/updatedb.php">
                                <input type="hidden" name="id" value="' . $row['id'] . '">
                                <select name="mes" id="mes" class="form-select">';
                        foreach ($meses as $mes) {
                            $selected = ($mes['nombre'] == $row['Mes']) ? 'selected' : '';
                            echo '<option value="' . $mes['id'] . '" ' . $selected . '>' . $mes['nombre'] . '</option>';
                        }
                        echo '          </select>
                            </td>
                            <td><input type="number" class="form-control" name="ano" value="' . $row['Año'] . '"></td>
                            <td>
                                <select name="vehiculo" id="vehiculo" class="form-select">';
                        foreach ($vehiculos as $vehiculo) {
                            $selected = ($vehiculo['nombre'] == $row['Vehiculo']) ? 'selected' : '';
                            echo '<option value="' . $vehiculo['id'] . '" ' . $selected . '>' . $vehiculo['nombre'] . '</option>';
                        }
                        echo '          </select>
                            </td>
                            <td>
                                <select name="municipio" id="municipio" class="form-select">';
                        foreach ($municipio as $mun) {
                            $selected = ($mun['nombre'] == $row['municipio']) ? 'selected' : '';
                            echo '<option value="' . $mun['id'] . '" ' . $selected . '>' . $mun['nombre'] . '</option>';
                        }
                        echo '          </select>
                            </td>
                            <td>
                                <select name="ml" id="ml" class="form-select">';
                        foreach ($ml as $mlOption) {
                            $selected = ($mlOption['nombre'] == $row['ML']) ? 'selected' : '';
                            echo '<option value="' . $mlOption['id'] . '" ' . $selected . '>' . $mlOption['nombre'] . '</option>';
                        }
                        echo '          </select>
                            </td>
                            <td><input type="number" class="form-control" name="cantidad" value="' . $row['Cantidad'] . '"></td>
                            <td><input type="submit" class="btn btn-success" value="Guardar" name="f1"></td>
                            </form>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>

        <?php
        } else if ($formToDisplay == 2) {
        ?>
            <h1 class="text-light">Población - Últimos 30 registros insertados</h1>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Municipio</th>
                        <th scope="col">Año</th>
                        <th scope="col">Población</th>
                        <th scope="col">Actualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $row) {
                        echo '<tr>
                            <th scope="row">' . $row['id'] . '</th>
                            <td>
                                <form method="POST" action="../processes/updatedb.php">
                                <input type="hidden" name="id" value="' . $row['id'] . '">    
                                <select name="municipio" id="municipio" class="form-select">';
                                    foreach ($municipio as $mun) {
                                        $selected = ($mun['nombre'] == $row['municipio']) ? 'selected' : '';
                                        echo '<option value="' . $mun['id'] . '" ' . $selected . '>' . $mun['nombre'] . '</option>';
                                }
                                    echo '          </select>
                            </td>
                            <td><input type="number" class="form-control" name="anio" value="' . $row['anio'] . '"></td>
                            <td><input type="number" class="form-control" name="cant" value="' . $row['cantidad'] . '"></td>
                            <td><input type="submit" class="btn btn-success" value="Guardar" name="f2"></td>
                                </form>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
            <?php
        }
            ?>
    </main>

</body>

</html>