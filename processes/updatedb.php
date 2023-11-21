<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];
    $vehiculo = $_POST['vehiculo'];
    $municipio = $_POST['municipio'];
    $ml = $_POST['ml'];
    $cantidad = $_POST['cantidad'];

    $query = "UPDATE tu_tabla SET mes = :mes, ano = :ano, vehiculo = :vehiculo, municipio = :municipio, ml = :ml, cantidad = :cantidad WHERE id = :id";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':mes', $mes);
    $stmt->bindParam(':ano', $ano);
    $stmt->bindParam(':vehiculo', $vehiculo);
    $stmt->bindParam(':municipio', $municipio);
    $stmt->bindParam(':ml', $ml);
    $stmt->bindParam(':cantidad', $cantidad);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo 'Actualización exitosa';
    } else {
        echo 'Error al actualizar';
    }
}
?>
