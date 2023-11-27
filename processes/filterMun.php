<?php
include("essentials.php");
include("PDOconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $mpio = isset($_POST["idMun"]) ? $_POST["idMun"] :"";

        if(is_numeric($mpio)){
            $query = "SELECT a.id as id, m.nombre as Mes, a.anio as Año, v.nombre as Vehiculo, c.nombre as municipio, t.nombre as ML, a.cantidad as Cantidad
            FROM tbl_accidente a
            JOIN tbl_meses m on a.mes = m.id
            JOIN tbl_vehiculo v on a.vehiculo = v.id
            JOIN tbl_municipio c on a.municipio = c.id
            JOIN tbl_tipo_accidente t on a.tipo_accidente = t.id
            WHERE a.municipio = :mun
            ORDER BY a.id DESC
            LIMIT 30;";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":mun", $mpio, PDO::PARAM_INT);
        }
        else{
            $query = "SELECT a.id as id, m.nombre as Mes, a.anio as Año, v.nombre as Vehiculo, c.nombre as municipio, t.nombre as ML, a.cantidad as Cantidad
            FROM tbl_accidente a
            JOIN tbl_meses m on a.mes = m.id
            JOIN tbl_vehiculo v on a.vehiculo = v.id
            JOIN tbl_municipio c on a.municipio = c.id
            JOIN tbl_tipo_accidente t on a.tipo_accidente = t.id
            ORDER BY a.id DESC
            LIMIT 30;";
            $stmt = $pdo->prepare($query);
        }
                    
                    
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        returnDataResponse($result);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>