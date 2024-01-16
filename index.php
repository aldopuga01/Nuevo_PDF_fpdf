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
$pdf->SetFont('Arial','B',10); // Establecemos estilo de fuente, tipo de fuente y tamaño 10
// Creación de una celda en el documento PDF.
$pdf->Cell(
    0,        // Ancho de la celda. Un valor de '0' extiende la celda hasta el margen derecho.
    10,       // Alto de la celda en milímetros.
    'Nombre de la empresa SA DE CV', // Texto que se mostrará en la celda.
    0,        // Borde de la celda. '0' significa sin borde; '1' dibujaría un borde alrededor de la celda. 1, // Salto de línea tras la celda. '1' para mover el cursor a la siguiente línea; '0' para continuar en la misma línea.
    'L' // Alineación del texto dentro de la celda. 'L' para izquierda, 'C' para centro, 'R' para derecha.
);

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
// Agregar la celda del encabezado "CANTIDAD" con:
// - 40 mm de ancho
// - 7 mm de altura
// - Texto "CANTIDAD"
// - Borde alrededor de la celda (el 4º argumento es 1)
// - Sin salto de línea después de esta celda (el 5º argumento es 0)
// - Texto centrado horizontalmente (el 6º argumento es 'C')
$pdf->Cell(40,7,'CANTIDAD',1,0,'C');
$pdf->Cell(100,7,'CONCEPTO',1,0,'C');
$pdf->Cell(25,7,'U.M.',1,0,'C');
$pdf->Cell(30,7,'IMPORTE',1,0,'C');
$pdf->Ln();

// Asumimos que esta es la estructura de tu array de productos
$productos = [
    ['cantidad' => '2', 'concepto' => 'Producto A', 'unidad' => 'pcs', 'importe' => '100.00'],
    ['cantidad' => '5', 'concepto' => 'Servicio B', 'unidad' => 'hrs', 'importe' => '200.00'],
    ['cantidad' => '3', 'concepto' => 'Producto C', 'unidad' => 'ltr', 'importe' => '150.00']
];

$pdf->SetFont('Arial','',12); // Establece la fuente para las celdas

foreach ($productos as $product) {
    if(!empty($product['cantidad']) && !empty($product['concepto']) && !empty($product['unidad']) && !empty($product['importe'])) {
        $pdf->Cell(40,6,$product['cantidad'],1, 0, 'L');
        $pdf->Cell(100,6,$product['concepto'],1, 0, 'L');
        $pdf->Cell(25,6,$product['unidad'],1, 0, 'L');
        $pdf->Cell(30,6,$product['importe'],1, 1, 'L');
    } else {
// Si algún valor está vacío, imprimirás un error en el documento.
        $pdf->Cell(0,6,'Error: Un producto tiene un valor vacío.',1,1,'L');
    }
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
$pdf->Cell(30, $altura_celda, '1570.25', 1, 1);

// Celda para el espacio vacío debajo de 'AUTORIZO', sin bordes
$pdf->Cell(140, $altura_celda, '', 0, 0);
// Celda para 'IVA' con borde, alineado a la derecha
$pdf->Cell(25, $altura_celda, 'IVA', 1, 0, 'R');
// Celda para el importe del 'IVA', con borde
$pdf->Cell(30, $altura_celda, '131', 1, 1);

// Celda para el espacio vacío debajo de 'AUTORIZO', sin bordes
$pdf->Cell(140, $altura_celda, '', 0, 0);
// Celda para 'TOTAL' con borde, alineado a la derecha
$pdf->Cell(25, $altura_celda, 'TOTAL', 1, 0, 'R');
// Celda para el importe del 'TOTAL', con borde
$pdf->Cell(30, $altura_celda, '2533', 1, 1);


$pdf->Output();
?>
...
