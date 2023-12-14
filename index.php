<?php
include("processes/essentials.php");
include("processes/PDOconn.php");
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

    <link rel="stylesheet" href="templates/styles/base.css">
    <link rel="stylesheet" href="templates/styles/index.css">
    <link rel="stylesheet" href="templates/styles/btn_stars.css">
    <link rel="shortcut icon" href="https://antioquia.gov.co/templates/gk_game/images/touch-device.png" type="image/x-icon">
    <script src="scripts/charts.js" defer></script>

    <title>Dashboard | GSV</title>
</head>

<body>
    <div class="div_top">
        <div class="navbar_d1">
            <img src="https://www.antioquia.gov.co/images/PDF2/Comunicaciones/imagen-de-marca/logo.svg" alt="GOV.CO" class="gov_logo">
            <div>

                <?php
                session_start();

                // Comprueba si la sesión está iniciada
                if (!isset($_SESSION['username'])) {
                ?>
                    <div class="p_info">
                        <a href="templates/login.php">
                            <i class="fa fa-sign-in" aria-hidden="true"></i>
                        </a>
                    </div>
                <?php
                } else {
                ?>
                    <div class="p_info">
                        <a href="templates/admin.php">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </a>
                        <form action="processes/logout.php" method="post">
                            <button class="b_none"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar_d2">
            <div class="container cont_top">
                <a href="https://antioquia.gov.co/gerencia-de-seguridad-vial" class="ans_logo top_logo">
                    <img src="https://www.ansv.gov.co/sites/default/files/imagenes/LOGO%20COLOMBIA%20POTENCIA%20DE%20LA%20VIDA-TRANSPORTE.png" alt="Colombia Potencia Mundial de la Vida" class="ans_logo">
                </a>
                <a href="https://antioquia.gov.co/gerencia-de-seguridad-vial" class="top_logo">
                    <img src="resources/logo.png" class="ans_logo" alt="Gobernacion Antioquia">
                </a>
            </div>
        </nav>
    </div>

    <main>
        <div class="dash-legend container">
            <h1 class="">GSV Dashboard</h1>
            <h4 class="">Dashboard de accidentalidad vial en Antioquia.</h4>
            <p class="lead">
                Aquí podrás encontrar visualizaciones interactivas que te ayudarán a entender
                la distribución y características de los accidentes en Antioquia.
                Pasa el mouse por encima de cada gráfico para obtener mayores detalles
                y datos más específicos
            </p> <br>
            <p class="lead">
                Puedes descargar los datos aquí:
            <form action="processes/downloads.php" method="POST">
                <button type="submit" name="ach1" class="btn_star">
                    Descargar <i class="fa fa-download"></i>
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
            </form>
            </p>
        </div>

        <div class="text-success">
            <hr>
        </div>

        <div class="dashboard container">
            <h2 class="display-3">Incidentalidad y consecuencias.</h2>
            <div class="row gap-3 justify-content-center text-center">
                <div class="col-sm-10 col-md-5 col-lg-3 col-xl-3 chartContainer">
                    <select name="" id="chart1Select" class="form-select form-select-lg mb-3">
                        <?php
                        echo "<option value='" . $anioMinimo . " - " . $anioActual . "'>Todos los años (" . $anioMinimo . " - " . $anioActual . ")</option>";
                        for ($i = $anioMinimo; $i <= $anioActual; $i++) {
                            echo '<option value=' . $i . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                    
                    <div id="chart1" class="chart"></div>
                    <p style="color:black;" class="text-sm-start">
                        Estos accidentes incluyen muertos y lesionados.
                    </p>
                </div>

                <div class="col-sm-10 col-md-6 col-lg-4 col-xl-4 chartContainer">
                    <select name="" id="chart5Select" class="form-select form-select-lg mb-3">
                        <option value="Todos los municipios">Todos los municipios</option>
                        <?php
                        $query = "SELECT id, nombre FROM tbl_municipio";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();

                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            echo '<option value=' . $row['id'] . '>' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <select name="" id="chart5Select2" aria-label=".form-select-lg example" class="form-select form-select-lg mb-3">
                        <?php
                        echo "<option value='" . $anioMinimo . " - " . $anioActual . "'>Todos los años (" . $anioMinimo . " - " . $anioActual . ")</option>";
                        for ($i = $anioMinimo; $i <= $anioActual; $i++) {
                            echo '<option value=' . $i . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <div class="chart" id="chart5"></div>
                </div>

                <div class="col-sm-10 col-md-10 col-lg-4 col-xl-4 chartContainer">
                    <select name="" id="chart6Select" class="form-select form-select-lg mb-3">
                        <option value="Todos los municipios">Todos los municipios</option>
                        <?php
                        $query = "SELECT id, nombre FROM tbl_municipio";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();

                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            echo '<option value=' . $row['id'] . '>' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <select name="" id="chart6Select2" aria-label=".form-select-lg example" class="form-select form-select-lg mb-3">
                        <?php
                        echo "<option value='" . $anioMinimo . " - " . $anioActual . "'>Todos los años (" . $anioMinimo . " - " . $anioActual . ")</option>";
                        for ($i = $anioMinimo; $i <= $anioActual; $i++) {
                            echo '<option value=' . $i . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <div class="chart" id="chart6"></div>
                </div>

                <h2 class="display-3 text-xl-start">Mortalidad / año</h2>

                <div class="col-sm-10 col-md-10 col-lg-8 col-xl-8 chartContainer">
                    <select name="" id="chart2Select" aria-label=".form-select-lg example" class="form-select form-select-lg mb-3">
                        <?php
                        echo "<option value='" . $anioMinimo . " - " . $anioActual . "'>Todos los años (" . $anioMinimo . " - " . $anioActual . ")</option>";
                        for ($i = $anioMinimo; $i <= $anioActual; $i++) {
                            echo '<option value=' . $i . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <div id="chart2" class="chart">

                    </div>
                </div>

                <div class="col-sm-10 col-md-10 col-lg-5 col-xl-5 chartContainer">
                    <select name="" id="chart3Select" class="form-select form-select-lg mb-3">
                        <option value="Todos los municipios">Todos los municipios</option>
                        <?php
                        $query = "SELECT id, nombre FROM tbl_municipio";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();

                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            echo '<option value=' . $row['id'] . '>' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <div id="chart3" class="chart"></div>
                </div>

                <div class="col-sm-10 col-md-10 col-lg-5 col-xl-5 chartContainer">
                    <select name="" id="chart3e1Select" class="form-select form-select-lg mb-3">
                        <option value="Todos los municipios">Todos los municipios</option>
                        <?php
                        $query = "SELECT id, nombre FROM tbl_municipio";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();

                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            echo '<option value=' . $row['id'] . '>' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <div id="chart3.1" class="chart"></div>
                </div>

                <h2 class="display-3 text-xl-start">Tasa Departamental</h2>


                <div class="col-sm-10 col-md-10 col-lg-11 col-xl-11 chartContainer">
                    <select name="" id="chart4Select" class="form-select form-select-lg mb-3">
                        <option value="Todos los municipios">Todos los municipios</option>
                        <?php
                        $query = "SELECT id, nombre FROM tbl_municipio";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();

                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            echo '<option value=' . $row['id'] . '>' . $row['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <div class="chart" id="chart4"></div>
                </div>

                <div class="col-sm-10 col-md-10 col-lg-5 col-xl-5 chartContainer">
                    <select name="" id="chart7Select" aria-label=".form-select-lg example" class="form-select form-select-lg mb-3">
                        <?php
                        for ($i = $anioMinimo; $i <= $anioActual; $i++) {
                            echo '<option value=' . $i . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <div class="chart" id="chart7">

                    </div>
                </div>

                <div class="col-sm-10 col-md-10 col-lg-5 col-xl-5 chartContainer">
                    <select name="" id="chart8Select" aria-label=".form-select-lg example" class="form-select form-select-lg mb-3">
                        <?php
                        for ($i = $anioMinimo; $i <= $anioActual; $i++) {
                            echo '<option value=' . $i . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <div class="chart" id="chart8">

                    </div>
                </div>

                <h2 class="display-3 text-xl-start">Subregion</h2>

                <div class="col-sm-10 col-md-10 col-lg-5 col-xl-5 chartContainer">
                    <select name="" id="chart9Select" aria-label=".form-select-lg example" class="form-select form-select-lg mb-3">
                        <?php
                        echo "<option value='" . $anioMinimo . " - " . $anioActual . "'>Todos los años (" . $anioMinimo . " - " . $anioActual . ")</option>";
                        for ($i = $anioMinimo; $i <= $anioActual; $i++) {
                            echo '<option value=' . $i . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <div class="chartHxl" id="chart9">

                    </div>
                </div>
                <div class="col-sm-10 col-md-10 col-lg-6 col-xl-6 chartContainer">
                    <div class="chartHxl" id="chart10">

                    </div>
                </div>
            </div>

        </div>
    </main>
    <!-- Apache Echarts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.3/echarts.min.js"></script>
</body>

</html>