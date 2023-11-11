<?php
    include("PDOconn.php");
    include("essentials.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        # Variables provenientes de Ajax en login.js
        $municipio = trim($_POST['municipio']);
        $fatalidad = trim($_POST['fatalidad']);
        $victima = trim($_POST['victima']);
        $cantidad = trim($_POST['cantidad']);
        $anio = trim($_POST['anio']);
        $mes = trim($_POST['mes']);
        
        $anioActual = date('Y');

        # Variables de PHP
        $errors = [];
        $queryError = "";
        $ban = false;

        # -----------Validaciones para cada campo--------------#
        # Campos vacíos.
        # Longitud.
        # Confirmar concordancia

        if (empty($municipio) || empty($anio) || empty($mes) || empty($cantidad) || empty($anio) || empty($victima)) {
            $queryError .= "Algún campo está vacío";
        }

        if ($anio <= 2000 || $anio > $anioActual || $mes <= 0 || $mes > 12) {
            $queryError .= "Error en la fecha";
        }

        if (empty($queryError)) {
            try {
                $query = "INSERT INTO `tbl_accidente`(`vehiculo`, `mes`, `anio`, `municipio`, `tipo_accidente`, `cantidad`) 
                VALUES (:vehiculo, :mes, :anio, :municipio, :tipo_accidente, :cantidad)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":vehiculo", $victima, PDO::PARAM_INT);
                $stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
                $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
                $stmt->bindParam(":municipio", $municipio, PDO::PARAM_INT);
                $stmt->bindParam(":tipo_accidente", $fatalidad, PDO::PARAM_INT);
                $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
                $stmt->execute();
                return_response(true, "Insertado Correctamente");
            } catch (PDOException $e) {
                return_response(false, $e);
            }
        } else {
            return_response(false, "No se ha insertado por: " . $queryError);
        }
    }
?>
