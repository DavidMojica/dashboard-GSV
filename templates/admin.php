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
    <link rel="stylesheet" href="styles/btn_type_A.css">
    <link rel="stylesheet" href="styles/select_type_A.css">
    <link rel="stylesheet" href="styles/in_bright.css">
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
                            <input type="submit" value="Cerrar Sesión" class="btn_type_A">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="card">
            <div class="content" id="form_card">
                <div class="back">
                    <div class="back-content">
                        <form action="" method="POST" id="formAccidentes">
                            <div class="top_1">
                                <h2>Formulario de Accidentes</h2>
                            </div>

                            <h3>¿Dónde?</h3>
                            <div class="select">
                                <select name="municipio" id="municipio" class="select_A">
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
                            </div>

                            <h3>Tipo de víctima</h3>
                            <div class="select">
                                <select name="victima" id="victima">
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
                            </div>

                            <div class=" mid_1">
                                <div class="input-group">
                                    <input required="" type="number" name="cantidad" min="0" id="cantidad" class="input" autocomplete="off">
                                    <label class="user-label"><i class="fa fa-hashtag" aria-hidden="true"></i> de víctimas</label>
                                </div>

                                <div>
                                    <label for="toggle">Muerte</label>
                                    <label class="switch">
                                        <input type="checkbox" id="toggle">
                                        <span class="slider"></span>
                                    </label>
                                    <label for="toggle">Lesión</label>
                                </div>
                            </div>


                            <div class="mid_2">
                                <h4>¿Cuándo?</h4>

                                <div class="input-group">
                                    <input required="" type="number" name="cantidad" id="cantidad" class="input" autocomplete="off">
                                    <label class="user-label">Año (YYYY)</label>
                                </div>

                                <div class="select">
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
                                </div>
                            </div>

                            <div class="bot_1">
                                <p id="msg_error" class="msg_error"></p>
                            </div>

                            <div>
                                <button type="button" class="btn_type_A" id="toggle_dane">Formulario DANE</button>
                            </div>

                            <div>
                                <button class="button">Ingresar</button>
                            </div>
                            
                        </form>
                    </div>
                </div>




                <div class="front">
                    <div class="front-content">
                        <form action="" method="POST" id="formDane" class="form_loadout">
                            <h2>Poblacion Dane</h2>

                            <div class="interior_grid">
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

                                <label for="cantidad_dane">Cantidad</label>
                                <input type="number" class="input_loadout" name="cantidad_dane" id="cantidad_dane" min="0">

                                <label for="anio_dane">Año</label>
                                <input type="number" class="input_loadout" id="anio_dane" min="0" name="anio_dane" placeholder="YYYY" pattern="\d{4}" title="Ingrese un formato válido (YYYY)">
                            </div>

                            <p id="msg_dane"></p>
                            <button>Ingresar</button>

                        </form>
                        <button id="toggle_accidentes">Accidentes</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>