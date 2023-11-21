<?php
include("PDOconn.php");
include("essentials.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['f1'])) {
        $id = $_POST['id'];
        $mes = $_POST['mes'];
        $ano = $_POST['ano'];
        $vehiculo = $_POST['vehiculo'];
        $municipio = $_POST['municipio'];
        $ml = $_POST['ml'];
        $cantidad = $_POST['cantidad'];

        if($ano >= $anioMinimo && $ano <= $anioActual){
            $query = "UPDATE tbl_accidente SET mes = :mes, anio = :ano, vehiculo = :vehiculo, municipio = :municipio, tipo_accidente = :ml, cantidad = :cantidad WHERE id = :id";
        
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':mes', $mes);
            $stmt->bindParam(':ano', $ano);
            $stmt->bindParam(':vehiculo', $vehiculo);
            $stmt->bindParam(':municipio', $municipio);
            $stmt->bindParam(':ml', $ml);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
        header('Location: ../templates/update.php?f=1');
        exit();
    }

    if(isset($_POST['f2'])) {
        $id = $_POST['id'];
        $municipio = $_POST['municipio'];
        $anio = $_POST['anio'];
        $cantidad = $_POST['cant'];
        
        $query = "UPDATE tbl_poblacion SET id_municipio = :mun, anio = :anio, cantidad = :cantidad WHERE id = :id" ;
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":mun", $municipio, PDO::PARAM_INT);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
        $stmt->execute();
        header('Location: ../templates/update.php?f=2');
        exit();
    
    }
}
?>
