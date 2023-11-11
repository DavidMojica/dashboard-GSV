<?php
include("PDOconn.php");
include("essentials.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # Variables provenientes de Ajax en login.js
    $municipio = trim($_POST['municipio']);
    $cantidad = trim($_POST['cantidad']);
    $anio = trim($_POST['anio']);

    $anioActual = date('Y');

    # Variables de PHP
    $queryError = "";

    # -----------Validaciones para cada campo--------------#
    # Campos vacíos.
    # Longitud.
    # Confirmar concordancia

    if (empty($municipio) || empty($cantidad) || empty($anio)) {
        $queryError .= "Algún campo está vacío";
    }

    if ($anio <= 2000 || $anio > $anioActual) {
        $queryError .= "Error en la fecha";
    }

    if (empty($queryError)) {
        try {
            # Verificar si ya existe un registro con la misma fecha y municipio
            $queryExistencia = "SELECT * FROM `tbl_poblacion` WHERE `id_municipio` = :municipio AND `anio` = :anio";
            $stmtExistencia = $pdo->prepare($queryExistencia);
            $stmtExistencia->bindParam(":municipio", $municipio, PDO::PARAM_INT);
            $stmtExistencia->bindParam(":anio", $anio, PDO::PARAM_INT);
            $stmtExistencia->execute();
            $existeRegistro = $stmtExistencia->fetch();

            if ($existeRegistro) { #Actualizar si existe.
                $queryActualizar = "UPDATE `tbl_poblacion` SET `cantidad` = :cantidad WHERE `id_municipio` = :municipio AND `anio` = :anio";
                $stmtActualizar = $pdo->prepare($queryActualizar);
                $stmtActualizar->bindParam(":municipio", $municipio, PDO::PARAM_INT);
                $stmtActualizar->bindParam(":anio", $anio, PDO::PARAM_INT);
                $stmtActualizar->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
                $stmtActualizar->execute();
                return_response(true, "Cantidad actualizada correctamente.");
            } else { #Inserción nueva si no existe.
                $queryInsertar = "INSERT INTO `tbl_poblacion`(`id_municipio`, `anio`, `cantidad`) VALUES (:municipio, :anio, :cantidad)";
                $stmtInsertar = $pdo->prepare($queryInsertar);
                $stmtInsertar->bindParam(":municipio", $municipio, PDO::PARAM_INT);
                $stmtInsertar->bindParam(":anio", $anio, PDO::PARAM_INT);
                $stmtInsertar->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
                $stmtInsertar->execute();
                return_response(true, "Datos insertados correctamente.");
            }
        } catch (PDOException $e) {
            return_response(false, $e);
        }
    } else {
        return_response(false, "No se ha realizado la operación debido a: " . $queryError);
    }
}
?>
