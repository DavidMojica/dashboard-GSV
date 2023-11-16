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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- fa icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="styles/form_loadout.css">

    <link rel="stylesheet" href="styles/bg_dotted.css">
    <link rel="stylesheet" href="styles/btn_type_A.css">
    <link rel="stylesheet" href="styles/btn_stars.css">
    <link rel="stylesheet" href="styles/btn_rainbow.css">
    <link rel="stylesheet" href="styles/select_type_A.css">
    <link rel="stylesheet" href="styles/in_bright.css">
    <link rel="stylesheet" href="styles/base.css">
    <link rel="stylesheet" href="styles/admin.css">
    <link rel="shortcut icon" href="https://www.ansv.gov.co/sites/default/files/imagenes/favicon-ansv.png" type="image/x-icon">

    <script src="../scripts/admin.js" defer></script>

    <title>Admin</title>
</head>

<body class="bg_dotted">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="https://www.mintransporte.gov.co/info/mintransporte/media/pubInt/thumbs/thpub_700x400_10745.jpg" class="logo" alt="Gobernacion Antioquia">
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
                            <a class="navbar-brand" href="../index.php">
                                <img src="https://www.mintransporte.gov.co/info/mintransporte/media/pubInt/thumbs/thpub_700x400_10745.jpg" class="logo_form" alt="Gobernacion Antioquia">
                            </a>

                            <div class="top_1">
                                <h2 class="h2-drop">Formulario de Accidentes</h2>
                            </div>

                            <h4 class="top_2">¿Dónde?</h4>
                            <div class="select top_3">
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

                            <h4 class="top_4">Tipo de víctima</h4>
                            <div class="select top_5">
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

                            <div class="blank_1">

                            </div>
                            <div class=" mid_1">
                                <h3>Cantidad y letalidad </h3>
                                <div class="input-group" id="cant_group">
                                    <input required="" type="number" name="cantidad" min="0" id="cantidad" class="input" autocomplete="off">
                                    <label class="user-label"><i class="fa fa-hashtag col-green-fosforescent backdrop-greenf" aria-hidden="true"></i> de víctimas</label>
                                </div>

                                <div class="griddle">
                                    <b class="col-red">Muerte <i class="fa fa-times" aria-hidden="true"></i></b>
                                    <label class="switch">
                                        <input type="checkbox" id="toggle">
                                        <span class="slider"></span>
                                    </label>
                                    <b class="col-orange"><i class="fa fa-heartbeat" aria-hidden="true"></i> Lesión</b>
                                </div>
                            </div>


                            <div class="mid_2">
                                <h3>¿Cuándo?</h3>

                                <div class="input-group" id="anio_group">
                                    <input required="" type="number" name="anio" id="anio" class="input" autocomplete="off" min="2001">
                                    <label class="user-label">Año (YYYY) <i class="fa fa-calendar col-blue backdrop-blue" aria-hidden="true"></i></label>
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

                            <div class="bot_2">
                                <button type="button" class="btn_rainbow senders" id="toggle_dane">Población</button>
                                <button class="btn btn_star senders" id="accidente_send" type="submit" aria-expanded="false">
                                    Guardar
                                    <i class="fa fa-diamond"></i>
                                    <div class="star-1">
                                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <defs></defs>
                                            <g id="Layer_x0020_1">
                                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                                <path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="star-2">
                                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <defs></defs>
                                            <g id="Layer_x0020_1">
                                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                                <path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="star-3">
                                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <defs></defs>
                                            <g id="Layer_x0020_1">
                                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                                <path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="star-4">
                                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <defs></defs>
                                            <g id="Layer_x0020_1">
                                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                                <path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="star-5">
                                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <defs></defs>
                                            <g id="Layer_x0020_1">
                                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                                <path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="star-6">
                                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <defs></defs>
                                            <g id="Layer_x0020_1">
                                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                                <path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </button>

                            </div>




                        </form>
                    </div>
                </div>




                <div class="front">
                    <div class="front-content">
                        <form action="" method="POST" id="formDane" class="form_loadout">

                            <a class="navbar-brand" href="../index.php">
                                <img src="https://prinza.com.co/wp-content/uploads/2021/04/logo-alcaldia-1.png" class="logo_form" alt="logo_secretaria">
                            </a>

                            <h2 class="h2-drop top_1_d">Poblacion Dane</h2>

                            <h3 class="top_2_d">Municipio</h3>

                            <div class="select top_3_d">
                                <select name="municipio_dane" id="municipio_dane">
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

                            <div class="input-group top_4_d" id="cant_group_d">
                                <input required="" type="number" name="cantidad_dane" min="0" id="cantidad_dane" class="input" autocomplete="off">
                                <label class="user-label"><i class="fa fa-hashtag col-green-fosforescent backdrop-greenf" aria-hidden="true"></i> de población</label>
                            </div>

                            <div class="input-group top_5_d" id="anio_group_d">
                                <input required="" type="number" name="anio_dane" id="anio_dane" min="2001" class="input" autocomplete="off" min="2001" pattern="\d{4}" title="Ingrese un formato válido (YYYY)">
                                <label class="user-label">Año (YYYY) <i class="fa fa-calendar col-blue backdrop-blue" aria-hidden="true"></i></label>
                            </div>

                            <p id="msg_dane" class="bot_1_d"></p>

                            <div class="bot_2_d">
                                <button id="toggle_accidentes" class="btn_rainbow">Accidentes</button>
                                <button class="btn btn_star senders" id="dane_send" type="submit" aria-expanded="false">
                                    Guardar
                                    <i class="fa fa-diamond"></i>
                                    <div class="star-1">
                                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <defs></defs>
                                            <g id="Layer_x0020_1">
                                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                                <path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="star-2">
                                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <defs></defs>
                                            <g id="Layer_x0020_1">
                                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                                <path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="star-3">
                                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <defs></defs>
                                            <g id="Layer_x0020_1">
                                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                                <path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="star-4">
                                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <defs></defs>
                                            <g id="Layer_x0020_1">
                                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                                <path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="star-5">
                                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <defs></defs>
                                            <g id="Layer_x0020_1">
                                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                                <path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="star-6">
                                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <defs></defs>
                                            <g id="Layer_x0020_1">
                                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                                <path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>