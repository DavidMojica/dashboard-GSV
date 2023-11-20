
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
    <link rel="shortcut icon" href="https://www.ansv.gov.co/sites/default/files/imagenes/favicon-ansv.png" type="image/x-icon">
    <script src="scripts/charts.js" defer></script>

    <title>Dashboard | ANSV</title>
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
            <div class="container">
                <a href="https://antioquia.gov.co/" class="ans_logo">
                    <img src="https://www.ansv.gov.co/sites/default/files/imagenes/LOGO%20COLOMBIA%20POTENCIA%20DE%20LA%20VIDA-TRANSPORTE.png" alt="Colombia Potencia Mundial de la Vida" class="ans_logo">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item m-1">
                            <a href="https://www.ansv.gov.co/">
                                <img src="https://www.mintransporte.gov.co/info/mintransporte/media/pubInt/thumbs/thpub_700x400_10745.jpg" class="ans_logo" alt="Gobernacion Antioquia">
                            </a>
                        </li>
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
            <h2 class="display-3">Incidentalidad y consecuencias.</h2>
            <div class="row gap-3 justify-content-center">
                <div class="col-10 col-md-3 col-lg-3 col-xl-3 chartContainer">
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
                        Estos accidentes incluyen muertos o lesionados.
                    </p>
                </div>

                <div class="col-10 col-md-4 col-lg-4 col-xl-4 chartContainer">
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
                    <div class="chart" id="chart5"></div>
                </div>

                <div class="col-10 col-md-4 col-lg-4 col-xl-4 chartContainer">
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
                    <div class="chart" id="chart6"></div>
                </div>

                <h2 class="display-3 text-xl-start">Mortalidad / año</h2>

                <div class="col-sm-11 col-md-8 col-lg-8 col-xl-8 chartContainer">
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

                <div class="col-sm-11 col-md-5 col-lg-5 col-xl-5 chartContainer">
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

                <div class="col-sm-11 col-md-5 col-lg-5 col-xl-5 chartContainer">
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


                <div class="col-sm-12 col-md-11 col-lg-11 col-xl-11 chartContainer">
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

                <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5 chartContainer">
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

                <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5 chartContainer">
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

                <h2>Regiones</h2>

                <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5 chartContainer">
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
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 chartContainer">
                    <div class="chartHxl" id="chart10">

                    </div>
                </div>
            </div>

        </div>
    </main>


    <footer id="footer-gov">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-lg-3"><a href="https://www.gov.co/" rel="noreferrer" target="_blank"><img alt="gov.co" class="gov_logo" src="https://www.antioquia.gov.co/images/PDF2/Comunicaciones/imagen-de-marca/logo.svg"> </a>

                    <div class="row">
                        <div class="col-5"><img alt="icono colombia oficial" class="img-responsive " id="govco" src="https://www.mintransporte.gov.co/info/mintransporte/media/bloque2387.png"></div>

                        <div class="col-3">

                            <a class="section enl-fb" rel="noreferrer" target="_blank" href="https://www.facebook.com/agencianacionaldeseguridadvial/?fref=ts" title="Enlace a Facebook"><svg class="svg-inline--fa fa-facebook-f fa-w-10" style="width: 100%;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                                </svg><!-- <i class="fab fa-facebook-f" style="width:100%" aria-hidden="true"></i> --></a>
                            <a class="section enl-tw" href="https://twitter.com/ansvcol" rel="noreferrer" target="_blank" title="Enlace a Twitter"><svg class="svg-inline--fa fa-twitter fa-w-16" style="width: 100%;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
                                </svg><!-- <i class="fab fa-twitter" style="width:100%" aria-hidden="true"></i> --></a>
                            <a class="section enl-yt" href="https://www.youtube.com/channel/UCynojn_g9TbcdPR6w1FMBDA" rel="noreferrer" target="_blank" title="Enlace a Youtube"><svg class="svg-inline--fa fa-youtube fa-w-18" style="width: 100%;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="youtube" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path>
                                </svg><!-- <i class="fab fa-youtube" style="width:100%" aria-hidden="true"></i> --></a>
                            <a class="section enl-in" href="https://www.instagram.com/ansvcolombia/" rel="noreferrer" target="_blank" title="Enlace a Instagram"><svg class="svg-inline--fa fa-instagram fa-w-14" style="width: 100%;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
                                </svg><!-- <i class="fab fa-instagram" style="width:100%" aria-hidden="true"></i> --></a>
                            <a class="section" href="mailto:atencionalciudadano@ansv.gov.co" rel="noreferrer" target="_blank" title="Contacto correo"><svg class="svg-inline--fa fa-envelope fa-w-16" style="width: 100%;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path>
                                </svg><!-- <i class="fas fa-envelope" style="width:100%" aria-hidden="true"></i> --></a>
                            <a class="section enl-fb" href="https://www.linkedin.com/company/agencia-nacional-de-seguridad-vial-de-colombia" title="Enlace a Linkedin" target="_blank"><svg class="svg-inline--fa fa-linkedin-in fa-w-14" aria-hidden="true" style="width: 100%;" focusable="false" data-prefix="fab" data-icon="linkedin-in" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path>
                                </svg><!-- <i class="fa fa-linkedin" aria-hidden="true" style="width:100%"></i> --></a>

                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-3 col-md-5  text-left text-md-center agency-footer">
                    <div class="text-left" style="width: 170px;">
                        <p class="smallTitles">Agencia Nacional de Seguridad Vial</p>

                        <p class="m-0">Calle 24 # 60 - 50 Piso 9<br>
                            Centro Comercial Gran Estación II<br>
                            Bogotá, D.C - Colombia<br>
                            Código Postal 111321</p>
                        &nbsp;

                        <p class="smallTitles">Teléfono conmutador</p>

                        <p>+57 601 7399080 Ext. 1100&nbsp;Atención al ciudadano</p>

                        <p>&nbsp;</p>

                        <p>Línea Anticorrupción:</p>

                        <p>+57 601 7399080 Ext. 1240</p>

                        <p class="smallTitles"><a href="https://ansv.gov.co/atencion_ciudadania/terminos" title="Términos y condiciones">Términos y condiciones</a></p>

                        <p class="smallTitles"><a href="https://ansv.gov.co/es/agencia/mipg/documentos/3760" title="Política de tratamientos de datos">Política de tratamientos de datos</a></p>

                        <p class="smallTitles"><a href="https://www.ansv.gov.co/es/agencia/mipg/documentos/10141" title="Política de seguridad y privacidad de la información">Política de seguridad y privacidad de la información</a></p>

                        <p class="smallTitles"><a href="https://ansv.gov.co/es/agencia/mipg/documentos?documento=Politicas-de-la-ANSV" title="Otras políticas que correspondan conforme con la normativa vigente">Otras políticas que correspondan conforme con la normativa vigente</a></p>
                    </div>
                </div>

                <div class="col-sm-4 col-lg-3 col-md-4 no-padding text-left text-md-center info">
                    <div class="text-left" style="width:180px">
                        <p class="smallTitles">Correo institucional</p>

                        <p class="email-p">atencionalciudadano@ansv.gov.co</p>

                        <p class="email-p">Canal anticorrupción:</p>

                        <p class="email-p">soytransparente@ansv.gov.co</p>

                        <p class="smallTitles">Correo de notificaciones judiciales</p>

                        <p class="email-p">notificacionesjuridicas@ansv.gov.co</p>

                        <p class="smallTitles">Última actualización:</p>

                        <p class="last-date">16/11/2023 | 8:30 pm</p>
                    </div>
                </div>

                <div class="col-sm-4 col-md-4 col-lg-3  no-padding text-md-left ">
                    <p class="smallTitles">Horario de atención canal virtual (PQRSD)</p>

                    <p>Lunes a viernes<br>
                        de 8:00 a.m. - 5:00 p.m.<br>
                        Jornada Continua</p>

                    <p class="smallTitles">Recepción de Correspondencia</p>

                    <p>Lunes a viernes<br>
                        de 8:00 a.m. - 4:00 p.m.<br>
                        Jornada Continua</p>

                    <p><a href="https://www.ansv.gov.co/atencion_ciudadania/contactenos/puntos">Canales virtuales</a><br>
                        <a href="https://www.ansv.gov.co/atencion_ciudadania/contactenos/puntos">Canales físicos</a>
                    </p>

                    <p><a href="https://www.ansv.gov.co/sites/default/files/Documentos/Normativa/Decretos/CERTIFICACI%C3%93N%20ANEXO%201%20-%20ITA_2482023.pdf">Certificado de accesibilidad</a></p>

                    <p><a href="https://www.ansv.gov.co/mapa_sitio">Mapa del sitio</a></p>

                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Apache Echarts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.3/echarts.min.js"></script>
</body>

</html>