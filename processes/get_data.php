<?php

include('essentials.php');
$action = isset($_POST['action']) ? $_POST['action'] : '';
$anio = isset($_POST['anio']) ? $_POST['anio'] : null;

switch ($action) {
    case 'getDataChart1':
        returnDataResponse(getDataChart1($anio));
        break;
    case 'getDataChart2':
        returnDataResponse(getDataChart2($anio));
        break;
    case'getDataChart3':
        returnDataResponse(getDataChart3($anio));
}
function getDataChart3($anio){
    include('PDOconn.php');

    $query = "SELECT m.nombre as mes, SUM(a.cantidad) as total_accidentes 
    FROM tbl_accidente a
    JOIN tbl_meses m ON a.mes = m.id
    WHERE a.tipo_accidente = 1 AND a.anio = 2021
    GROUP BY m.nombre
    ORDER BY CAST(a.mes AS SIGNED);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function getDataChart2($anio) {
    include('PDOconn.php');
    $anioMinimo = 2016;
    $anioActual = date('Y');

    if(is_numeric($anio)) {
        if($anio >= $anioMinimo && $anio <= $anioActual) {
            $query = "SELECT v.nombre as nombre_vehiculo, t.nombre as tipo_accidente, SUM(a.cantidad) as total_accidentes
            FROM tbl_accidente a
            JOIN tbl_vehiculo v ON a.vehiculo = v.id
            JOIN tbl_tipo_accidente t ON a.tipo_accidente = t.id
            WHERE a.anio = :anio
            GROUP BY v.nombre, t.nombre";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    $query = "SELECT v.nombre as nombre_vehiculo, t.nombre as tipo_accidente, SUM(a.cantidad) as total_accidentes
    FROM tbl_accidente a
    JOIN tbl_vehiculo v ON a.vehiculo = v.id
    JOIN tbl_tipo_accidente t ON a.tipo_accidente = t.id
    GROUP BY v.nombre, t.nombre";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
function getDataChart1($anio){
    include('PDOconn.php');

    $anioMinimo = 2016;
    $anioActual = date('Y');

    if (is_numeric($anio)) {
        if($anio >= $anioMinimo && $anio <= $anioActual) {
            $query = "SELECT v.nombre as nombre_vehiculo, SUM(a.cantidad) as total_accidentes
            FROM tbl_accidente a
            JOIN tbl_vehiculo v ON a.vehiculo = v.id
            WHERE a.anio = :anio
            GROUP BY v.nombre";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
     $query = "SELECT v.nombre as nombre_vehiculo, SUM(a.cantidad) as total_accidentes
        FROM tbl_accidente a
        JOIN tbl_vehiculo v ON a.vehiculo = v.id
        GROUP BY v.nombre;";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>