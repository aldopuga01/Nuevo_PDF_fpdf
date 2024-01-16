<?php
require('libs/fpdf181/fpdf.php');

class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        // Logo
        $this->Image('logo.png',10,6,20); // Asumiendo que tienes un logo.png para la imagen del logotipo de empresa
        // Arial bold 15
        $this->SetFont('Arial','B',10);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30,10,'ORDEN DE COMPRA',0,0,'C');
        // Salto de línea
        $this->Ln(10);
        // Número de orden de compra
        $this->Cell(0,10,'ORDEN NUM.',0,0,'R');
        // Salto de línea
        $this->Ln(10);
    }

    // Pie de página
    function Footer() {
        // Posición a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,10,'Nombre de la empresa SA DE CV',0,1,'L'); // Nombre de la empresa en negrita y alineado a la izquierda

$pdf->SetFont('Arial','',10);
// Texto con 'CALLE xxxx No xxxxx' a la izquierda y 'FECHA' a la derecha
$pdf->Cell(120,5,'CALLE xxxx No xxxxx',0,0,'L'); // Alineado a la izquierda
$pdf->Cell(60,5,'FECHA:',0,1,'R'); // Alineado a la derecha y luego salto de línea

// Texto con 'FRACC. COLINASccccc' a la izquierda y 'HORA' a la derecha
$pdf->Cell(120,5,'FRACC. COLINASccccc',0,0,'L'); // Alineado a la izquierda
$pdf->Cell(60,5,'HORA: ',0,1,'R'); // Alineado a la derecha y luego salto de línea

// Texto con 'CD. VICTORIA, TAMAULIPAS' a la izquierda y 'OFICINA' a la derecha
$pdf->Cell(120,5,'CD. VICTORIA, TAMAULIPAS',0,0,'L'); // Alineado a la izquierda
$pdf->Cell(60,5,'OFICINA:',0,1,'R'); // Alineado a la derecha y luego salto de línea

// Texto vacio a la izquierda y 'SOLICITO' a la derecha
$pdf->Cell(120,5,'',0,0,'L'); // Alineado a la izquierda
$pdf->Cell(60,5,'SOLICITO:',0,1,'R'); // Alineado a la derecha y luego salto de línea


// Datos del proveedor
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,10,'DATOS DEL PROVEDOR',0,1,'L'); // Nombre de la empresa en negrita y alineado a la izquierda

$pdf->SetFont('Arial','',10);
// Texto con 'CALLE xxxx No xxxxx' a la izquierda y 'FECHA' a la derecha
$pdf->Cell(120,5,'NOMBRE',0,0,'L'); // Alineado a la izquierda
$pdf->Cell(60,5,'CUENTA:',0,1,'R'); // Alineado a la derecha y luego salto de línea

// Texto con 'FRACC. COLINASccccc' a la izquierda y 'HORA' a la derecha
$pdf->Cell(120,5,'TELEFONO',0,0,'L'); // Alineado a la izquierda
$pdf->Cell(60,5,'CLABE:',0,1,'R'); // Alineado a la derecha y luego salto de línea

// Texto con 'CD. VICTORIA, TAMAULIPAS' a la izquierda y 'OFICINA' a la derecha
$pdf->Cell(120,5,'CORREO',0,0,'L'); // Alineado a la izquierda
$pdf->Cell(60,5,'BANCO',0,1,'R'); // Alineado a la derecha y luego salto de línea

// Texto vacio a la izquierda y 'SOLICITO' a la derecha
$pdf->Cell(120,5,'DIRECCION',0,0,'L'); // Alineado a la izquierda
$pdf->Cell(60,5,'',0,1,'R'); // Alineado a la derecha y luego salto de línea

// Texto vacio a la izquierda y 'SOLICITO' a la derecha
$pdf->Cell(120,5,'CONTACTO',0,0,'L'); // Alineado a la izquierda
$pdf->Cell(60,5,'CREDITO:',0,1,'R'); // Alineado a la derecha y luego salto de línea

// Tabla con las líneas que necesitas
// Cantidad - Concepto - U.M. - Importe
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,7,'CANTIDAD',1,0,'C');
$pdf->Cell(100,7,'CONCEPTO',1,0,'C');
$pdf->Cell(25,7,'U.M.',1,0,'C');
$pdf->Cell(30,7,'IMPORTE',1,0,'C');
$pdf->Ln();

// Luego, para cada fila de productos o servicios que tienes:
$pdf->SetFont('Arial','',10);
for($i=0; $i<3; $i++) { // Asumimos 10 líneas de productos/servicios
    $pdf->Cell(40,6,'',1);
    $pdf->Cell(100,6,'',1);
    $pdf->Cell(25,6,'',1);
    $pdf->Cell(30,6,'',1);
    $pdf->Ln();
}

// Asumiendo que la altura de una celda es 6
$altura_celda = 6;

// Celda para 'AUTORIZO' que abarca dos filas de altura
$pdf->Cell(40, $altura_celda * 2, 'AUTORIZO', 1, 0, 'L');

// Celda para el espacio vacío junto a 'AUTORIZO', sin bordes
$pdf->Cell(100, $altura_celda, '', 0, 0);
// Celda para 'SUBTOTAL' con borde, alineado a la derecha
$pdf->Cell(25, $altura_celda, 'SUBTOTAL', 1, 0, 'R');
// Celda para el importe del 'SUBTOTAL', con borde
$pdf->Cell(30, $altura_celda, '', 1, 1);

// Celda para el espacio vacío debajo de 'AUTORIZO', sin bordes
$pdf->Cell(140, $altura_celda, '', 0, 0);
// Celda para 'IVA' con borde, alineado a la derecha
$pdf->Cell(25, $altura_celda, 'IVA', 1, 0, 'R');
// Celda para el importe del 'IVA', con borde
$pdf->Cell(30, $altura_celda, '', 1, 1);

// Celda para el espacio vacío debajo de 'AUTORIZO', sin bordes
$pdf->Cell(140, $altura_celda, '', 0, 0);
// Celda para 'TOTAL' con borde, alineado a la derecha
$pdf->Cell(25, $altura_celda, 'TOTAL', 1, 0, 'R');
// Celda para el importe del 'TOTAL', con borde
$pdf->Cell(30, $altura_celda, '', 1, 1);


$pdf->Output();
?>
...
