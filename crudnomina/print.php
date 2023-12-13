<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial','B',7);
        $this->Cell(0,8,'Informe General de Clientes',0,1,'C');
        $this->Ln(8);
        $this->Cell(1); 
        $this->Cell(29, 8, 'Numero de documento', 1, 0, 'C');
        $this->Cell(25, 8, 'Tipo de documento', 1, 0, 'C');
        $this->Cell(28, 8, 'Fecha de nacimiento', 1, 0, 'C');
        $this->Cell(15, 8, 'Nombre', 1, 0, 'C');
        $this->Cell(15, 8, 'Apellido', 1, 0, 'C');
        $this->Cell(15, 8, 'Correo', 1, 0, 'C');
        $this->Cell(15, 8, 'Telefono', 1, 0, 'C');
        $this->Cell(28, 8, 'Fecha de contratacion', 1, 0, 'C');
        $this->Cell(15, 8, 'Salario', 1, 0, 'C');
    

        $this->Ln();
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Página '.$this->PageNo(),0,0,'C');
    }
}

require_once 'clase.php';
$crud = new CRUD();
$usuarios = $crud->seleccionarUsuario();

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',7);

foreach ($usuarios as $usuario) {
    $pdf->Cell(1);
    $pdf->Cell(10, 20, $usuario['nro_documento '], 1, 0, 'C');
    $pdf->Cell(17, 20, $usuario['tipo_documento'], 1);
    $pdf->Cell(25, 20, $usuario['fecha_nacimiento_empleado'], 1);
    $pdf->Cell(22, 20, $usuario['nombre1_empleado'], 1);
    $pdf->Cell(22, 20, $usuario['apellido1_empleado'], 1);
    $pdf->Cell(17, 20, $usuario['correo'], 1);
    $pdf->Cell(28, 20, $usuario['telefono'], 1);
    $pdf->Cell(24, 20, $usuario['fecha_contratacion'], 1);
    $pdf->Cell(23, 20, $usuario['salario'], 1);

    $pdf->Ln();
}

$pdf->Output();
?>
