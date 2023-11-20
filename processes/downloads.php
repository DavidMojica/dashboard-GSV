<?php
include("essentials.php");
include("PDOconn.php");
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ach1'])) {
    $query = "SELECT m.nombre as Mes, a.anio as Año, v.nombre as Vehiculo, c.nombre as municipio, t.nombre as ML, a.cantidad as Cantidad
            FROM tbl_accidente a
            JOIN tbl_meses m on a.mes = m.id
            JOIN tbl_vehiculo v on a.vehiculo = v.id
            JOIN tbl_municipio c on a.municipio = c.id
            JOIN tbl_tipo_accidente t on a.tipo_accidente = t.id;";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);    

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Encabezados del excel
    $columns = ['Mes', 'Año','Vehiculo', 'Municipio', 'ML', 'Cantidad'];
    $columnIndex = 1;
    foreach ($columns as $column) {
        $sheet->setCellValueByColumnAndRow($columnIndex, 1, $column);
        $columnIndex++;
    }

    // Datos
    $rowIndex = 2;
    foreach ($result as $fila) {
        $columnIndex = 1;
        foreach ($fila as $valor) {
            $sheet->setCellValueByColumnAndRow($columnIndex, $rowIndex, $valor);
            $columnIndex++;
        }
        $rowIndex++;
    }

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="IncidentesViales.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}
?>