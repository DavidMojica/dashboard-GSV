<?php

include('essentials.php');
$action = isset($_POST['action']) ? $_POST['action'] : '';
$anio = isset($_POST['anio']) ? $_POST['anio'] : null;

switch ($action) {
    case 'getDataChart1':
        returnDataResponse(getDataChart1($anio));

        break;

}
function getDataChart1($anio){
    include('PDOconn.php');

    $anioMinimo = 2016;
    $anioActual = date('Y');

    if (is_numeric($anio)) {
        if($anio >= $anioMinimo && $anio < $anioActual) {
            $query = "SELECT v.id AS id_vehiculo, v.nombre AS nombre_vehiculo, COUNT(a.id) AS total_accidentes
            FROM tbl_vehiculo v
            LEFT JOIN tbl_accidente a ON v.id = a.vehiculo
            WHERE a.anio = :anio
            GROUP BY  v.nombre";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    else{
        $query = "SELECT v.id AS id_vehiculo, v.nombre AS nombre_vehiculo, COUNT(a.id) AS total_accidentes
        FROM tbl_vehiculo v
        LEFT JOIN tbl_accidente a ON v.id = a.vehiculo
        GROUP BY v.id, v.nombre";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>