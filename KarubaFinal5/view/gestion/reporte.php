<?php

require('../../public/librerias/pdf/fpdf.php');
require('../../controller/pedido_controller.php');

   

class PDF extends FPDF 
{
// Cabecera de página
function Header() 
{
    // Logo
    $this->Image('../../public/img/logo.jpg',87,25,35);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(65);
    // Título
    $this->Cell(60,10,'Licorera Karuba',0,0,'C');
    // Salto de línea
    $this->Ln(70);
    $control= new Pedido_Controller();
      $re=$control->Reporte($_GET['id']);
      $reP=$control->ReporteP($_GET['id']);
    
      $this->Cell(60, 10, 'Nombre', 1, 0, 'C', 0);
      $this->Cell(40, 10, 'Precio', 1, 0, 'C', 0);
      $this->Cell(30, 10, 'Cantidad', 1, 0, 'C', 0);
      $this->Cell(60, 10,'Acumulado', 1, 1, 'C', 0);
    
      while ($fila=$reP->fetch(PDO::FETCH_ASSOC)) {
                     
      $this->Cell(60, 10, $fila['nombre'], 1, 0, 'C', 0);
      $this->Cell(40, 10, $fila['precio'], 1, 0, 'C', 0);
      $this->Cell(30, 10, $fila['cantidad'], 1, 0, 'C', 0);
      $this->Cell(60, 10, $fila['precioAcumulado'], 1, 1, 'C', 0);
                        }
    
          while ($fila=$re->fetch(PDO::FETCH_ASSOC)) {
      $this->Cell(130, 10, 'Subtotal:', 1, 0, 'C', 0);
      $this->Cell(60, 10, $fila['subtotal'], 1, 1, 'C', 0);
         $this->Ln(10);
      $this->Cell(33, 10, 'Responsable:', 0, 0, 'C', 0);
      $this->Cell(18, 10, $fila['nombre'], 0, 0, 'C', 0);
      $this->Cell(10, 10, $fila['apellido'], 0, 1, 'C', 0);
      $this->Cell(25, 10, 'Pedido en:', 0, 0, 'C', 0);
      $this->Cell(25, 10, $fila['mesa'], 0, 1, 'C', 0);
      $this->Cell(54, 10, 'Con un descuento de:', 0, 0, 'C', 0);
      $this->Cell(10, 10, $fila['descuento'], 0, 0, 'C', 0);
      $this->Cell(1, 10, '%', 0, 1, 'D', 0);
      $this->Cell(130, 10, 'Total:  ', 0, 0, 'R', 0);
      $this->Cell(60, 10, $fila['total'], 1, 1, 'C', 0);
                        }
    

     
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}


$pdf = new PDF();
$pdf -> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);




$pdf->Output();
?>