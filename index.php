<?php
include("processes/essentials.php");
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

    <link rel="stylesheet" href="templates/styles/btn_type_A.css">
    <link rel="stylesheet" href="templates/styles/btn_light.css">
    <link rel="stylesheet" href="templates/styles/base.css">
    <link rel="stylesheet" href="templates/styles/index.css">
    <script src="scripts/main.js" defer></script>

    <title>Dashboard</title>
</head>

<body>
    <div class="div_top">
        <div class="navbar_d1">
            <img src="https://www.antioquia.gov.co/images/PDF2/Comunicaciones/imagen-de-marca/logo.svg" alt="GOV.CO" class="gov_logo">
        </div>
        <nav class="navbar navbar-expand-lg navbar_d2">
            <div class="container">
                <a href="https://antioquia.gov.co/" class="ans_logo">
                    <img src="https://www.mintransporte.gov.co/info/mintransporte/media/pubInt/thumbs/thpub_700x400_10745.jpg" alt="Logo Gobernacion Antioquia" class="ans_logo">
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
                                    <button class="button-light">Iniciar Sesión <i class="fa fa-sign-in" aria-hidden="true"></i></button>
                                </a>
                            </li>

                        <?php
                        } else {
                        ?>
                            <li class="nav-item m-1"><a href="templates/admin.php"><button class="button-light">Administración</button></a></li>
                            <li class="nav-item m-1">
                                <form action="processes/logout.php" method="post">
                                    <button class="button-light">Cerrar Sesión</button>
                                </form>
                            </li>

                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <main>
        <div class="dash-legend container">
            <h1 class="">ANSV Dashboard</h1>
            <h4 class="">Dashboard de accidentalidad vial en Antioquia.</h4>
            <p class="lead">
                Aquí podrás encontrar visualizaciones interactivas que te ayudarán a entender
                la distribución y características de los accidentes en Antioquia.
                Pasa el mouse por encima de cada gráfico para obtener mayores detalles
                y datos más específicos.
            </p>
        </div>

        <div class="text-success">
            <hr>
        </div>


        <div class="dashboard container">
            <h2 class="display-3">Actores viales.</h2>
            <div class="row gap-4">
                <div class="col-sm-12 col-md-5 col-lg-5 col-xl-4  chartContainer">
                    <select name="" id="chart1Select" aria-label=".form-select-lg example" class="form-select form-select-lg mb-3">
                        <?php
                        echo "<option value='" . $anioMinimo . " - " . $anioActual . "'>Todos los años (" . $anioMinimo . " - " . $anioActual . ")</option>";
                        for ($i = $anioMinimo; $i <= $anioActual; $i++) {
                            echo '<option value=' . $i . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <div id="chart1" class="chart"></div>
                    <p style="color:black;">
                        Estos accidentes incluyen muertos o lesionados.
                    </p>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-7 chartContainer">
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

                <h2 class="display-3">Mortalidad / año</h2>
                <div class="col-sm-12 col-md-11 col-lg-11 col-xl-11 chartContainer">
                    <div id="chart3" class="chart"></div>
                </div>


                <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5 chartContainer">
                    <div class="chart" id="chart4"></div>
                </div>
            </div>
        </div>
    </main>

    <!-- Apache Echarts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.3/echarts.min.js"></script>
</body>

</html>