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


    <link rel="stylesheet" href="styles/form_loadout.css">
    <link rel="stylesheet" href="styles/base.css">
    <link rel="stylesheet" href="styles/bg_dotted.css">
    <script src="../scripts/admin.js" defer></script>

    <title>Admin</title>
</head>

<body class="bg_dotted">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://prinza.com.co/wp-content/uploads/2021/04/logo-alcaldia-1.png" class="logo" alt="logo_secretaria">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item m-1">
                        <form action="../processes/logout.php" method="post">
                            <input type="submit" value="Cerrar Sesión" class="button hbt">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="card">
            <div class="content">
                <div class="back">
                    <div class="back-content">

                        <form action="" method="POST" id="formAccidentes">

                            <label for="municipio" aria-hidden="true">Municipio</label>
                            <select name="municipio" id="municipio">
                                <option value="-1">Seleccione...</option>
                                <?php
                                $query = "SELECT * FROM tbl_municipio";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($result as $row) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
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

                            <label for="victima">Tipo de víctima</label>
                            <select name="victima" id="victima">
                                <option value="-1">Seleccione...</option>
                                <?php
                                $query = "SELECT * FROM tbl_vehiculo";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($result as $row) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                                }
                                ?>
                            </select>

                            <br>
                            <label for="cantidad">cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" class="input">

                            <br>
                            <label for="anio">Ingrese el año</label>
                            <input type="number" class="input" id="anio" min="0" name="anio" placeholder="YYYY" pattern="\d{4}" title="Ingrese un formato válido (YYYY)">

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
                            <button class="button">Ingresar</button>

                        </form>
                        <button type="button">Población DANE</button>
                    </div>
                </div>


                <div class="front">
                    <div class="front-content">
                        <form action="" method="POST" id="formDane" class="form_loadout">
                            <label for="chk" aria-hidden="true">Poblacion Dane</label>

                            <label for="municipio_dane">Municipio</label>
                            <select name="municipio_dane" id="municipio_dane">
                                <option value="-1">Seleccione...</option>
                                <?php
                                $query = "SELECT * FROM tbl_municipio";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($result as $row) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                                }
                                ?>
                            </select>

                            <label for="cantidad_dane">cantidad</label>
                            <input type="number" class="input_loadout" name="cantidad_dane" id="cantidad_dane" min="0">

                            <label for="anio_dane">Año</label>
                            <input type="number" class="input_loadout" id="anio_dane" min="0" name="anio_dane" placeholder="YYYY" pattern="\d{4}" title="Ingrese un formato válido (YYYY)">

                            <p id="msg_dane"></p>
                            <button>Ingresar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- <main class="main_loadout">
        <div class="login_loadout">
            <form action="" method="POST" id="formAccidentes">
                <label for="chk_loadout" aria-hidden="true">Accidentes</label>


                <label for="municipio" aria-hidden="true">Municipio</label>
                <select name="municipio" id="municipio">
                    <option value="-1">Seleccione...</option>
                    <?php
                    $query = "SELECT * FROM tbl_municipio";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
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

                <label for="victima">Tipo de víctima</label>
                <select name="victima" id="victima">
                    <option value="-1">Seleccione...</option>
                    <?php
                    $query = "SELECT * FROM tbl_vehiculo";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                    }
                    ?>
                </select>

                <br>
                <label for="cantidad">cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="input_loadout">

                <br>
                <label for="anio">Ingrese el año</label>
                <input type="number" class="input_loadout" id="anio" min="0" name="anio" placeholder="YYYY" pattern="\d{4}" title="Ingrese un formato válido (YYYY)">

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
                <button class="button_loadout">Ingresar</button>

            </form>
        </div>

        <div class="register_loadout">
            <form action="" method="POST" id="formDane" class="form_loadout">
                <label for="chk" aria-hidden="true">Poblacion Dane</label>

                <label for="municipio_dane">Municipio</label>
                <select name="municipio_dane" id="municipio_dane">
                    <option value="-1">Seleccione...</option>
                    <?php
                    $query = "SELECT * FROM tbl_municipio";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                    }
                    ?>
                </select>

                <label for="cantidad_dane">cantidad</label>
                <input type="number" class="input_loadout" name="cantidad_dane" id="cantidad_dane" min="0">

                <label for="anio_dane">Año</label>
                <input type="number" class="input_loadout" id="anio_dane" min="0" name="anio_dane" placeholder="YYYY" pattern="\d{4}" title="Ingrese un formato válido (YYYY)">

                <p id="msg_dane"></p>
                <button>Ingresar</button>
            </form>
        </div>
    </main> -->

</body>

</html>