<?php
$action = isset($_POST['action']) ? $_POST['action'] : '';
$anio = isset($_POST['anio']) ? $_POST['anio'] : null;

switch ($action) {
    case 'getChartData1':
        $result = getDataChart1($anio);

        break;

}
function getDataChart1($anio){
    include('essentials.php');
    include('PDOconn.php');


    if (is_int($anio)) {
        if($anio >= $anioMinimo and $anio < $anioActual) {
            $query = "SELECT v.id AS id_vehiculo, v.nombre AS nombre_vehiculo, COUNT(a.id) AS total_accidentes
            FROM tbl_vehiculo v
            LEFT JOIN tbl_accidente a ON v.id = a.vehiculo
            WHERE anio = :anio
            GROUP BY v.id, v.nombre";
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
        $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>