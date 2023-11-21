<?php
include("PDOconn.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['f1'])) {
        $id = $_POST['id'];
        $mes = $_POST['mes'];
        $ano = $_POST['ano'];
        $vehiculo = $_POST['vehiculo'];
        $municipio = $_POST['municipio'];
        $ml = $_POST['ml'];
        $cantidad = $_POST['cantidad'];

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
        header('Location: ../templates/update.php');
        exit();
    }

    if(isset($_POST['f2'])) {

    }
}
?>
