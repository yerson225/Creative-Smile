<?php
require '../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Incluir la conexión a la base de datos
include "../Models/conexion.php";

// Crear un nuevo objeto Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Establecer el encabezado de la hoja
$sheet->setCellValue('A1', 'Nombre');
$sheet->setCellValue('B1', 'Apellido');
$sheet->setCellValue('C1', 'Fecha de Nacimiento');
$sheet->setCellValue('D1', 'Dirección');
$sheet->setCellValue('E1', 'Correo');
$sheet->setCellValue('F1', 'Sexo');

// Consultar los datos de los usuarios
$sql = "SELECT * FROM usuario";
$resultado = $conexion->query($sql);

// Comenzar a llenar la hoja con datos
$row = 2; // Comenzar en la segunda fila
if ($resultado->num_rows > 0) {
    while ($usuario = $resultado->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $usuario['nombre']);
        $sheet->setCellValue('B' . $row, $usuario['apellido']);
        $sheet->setCellValue('C' . $row, $usuario['fecha_de_nacimiento']);
        $sheet->setCellValue('D' . $row, $usuario['Direccion']);
        $sheet->setCellValue('E' . $row, $usuario['correo']);
        $sheet->setCellValue('F' . $row, $usuario['sexo']);
        $row++;
    }
}

// Establecer el nombre del archivo
$filename = 'reporte_usuarios.xlsx';

// Configurar las cabeceras para la descarga del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Crear el archivo Excel
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>