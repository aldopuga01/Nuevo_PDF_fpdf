<?php

require('libs/fpdf181/fpdf.php');
//include '../../connection.php';
//include '../../Models/RequisicionesModel.php';
//include '../../Models/ProveedoresModel.php';
//include '../../Models/CBancosModel.php';
//include '../../Models/SucursalesModel.php';
//include '../../Models/EmpleadosModel.php';
//include '../../Models/CRolesModel.php';

class PDF extends FPDF {

    private $Id_Requisicion =0;
    private $conn = "";
    private $DesBanco = "";
    private $requisicion = "";
    public  $proveedor = "";
    public $conceptosRequisicion = "";


    public $subtotal = 0;
    public $iva = 0;
    public $total = 0;

    public $SucursalSolicito = "";
    public $EmpleadoSolicito = "";
    function __construct() {
        parent::__construct();
        $this->Id_Requisicion = 25;//$_GET['Id_Requisicion'];
        $this->requisicion = 57;//RequisicionesModel::searchById($this->Id_Requisicion);
        $this->proveedor = 46;//ProveedoresModel::searchById($this->requisicion->getIdProveedor());
        $this->DesBanco = 46;//CBancosModel::getOnlyName($this->requisicion->getIdBanco());

        $this->SucursalSolicito = 552;//SucursalesModel::getOnlyName($this->requisicion->getIdSucursalSolicito());
        //$this->EmpleadoSolicito =   EmpleadosModel::getOnlyName($this->requisicion->getIdSucursalSolicito());
       
        $this->conceptosRequisicion = 57;//RequisicionesModel::getConceptosRequisicion($this->Id_Requisicion);
        

        $this->subtotal =  2268;//RequisicionesModel::getSubTotalRequisicion($this->Id_Requisicion);
        $this->iva =  3255;//$this->subtotal * $this->requisicion->getIVA();
        $this->total =  $this->subtotal + $this->iva; 


        //$db=DataBase::getConnect();
        		//$select=$db->prepare('SELECT * FROM empleados WHERE IdEmpleado=:id');
                //$select=$db->prepare('CALL get_empleado_id(:id)');	//PARA PRUEBAS DE QUE ESTE FUNCIONA, INTENTAR ABRIR UN MODAL PARA AGREGAR USUARIOS
   // $select->bindValue('id', $this->requisicion->getIdEmpleadoSolicito());
                //$select->execute();
                //$empleado=$select->fetch();
        //		$empleado = new EmpleadosModel ($empleadosDb['IdEmpleado'],$empleadosDb['NombreEmpleado'], $empleadosDb['ApellidoPat'], $empleadosDb['Apellidomat'],
        //		$empleadosDb['RFC'],$empleadosDb['NSS'],$empleadosDb['Fecha_ingreso'],$empleadosDb['CorreoElectronico'],$empleadosDb['IdSucursal'],$empleadosDb['IdCategoriaEmpleado'],
        //		$empleadosDb['SalarioDiario'],$empleadosDb['PorcentajeCompensacion'],$empleadosDb['IdSituacionEmpleado']);
                //$this->EmpleadoSolicito =  $empleado['NombreEmpleado'].' '.$empleado['ApellidoPat'].' '.$empleado['Apellidomat'];

    }
    function setHeaderContent() {
        //$this->SetFont('Arial','',10);
        $this->SetFont('Arial','B',10);
        $this->Cell(0,10,'ORDEN NUM.' /*. $this->requisicion->getFolioRequisicion()*/ ,0,0,'R');
        $this->Ln(7);
        $this->Cell(
            0,        // Ancho de la celda. Un valor de '0' extiende la celda hasta el margen derecho.
            10,       // Alto de la celda en milímetros.
            'SANITAMEX SA DE CV', // Texto que se mostrará en la celda.
            0,        // Borde de la celda. '0' significa sin borde; '1' dibujaría un borde alrededor de la celda. 1, // Salto de línea tras la celda. '1' para mover el cursor a la siguiente línea; '0' para continuar en la misma línea.
            'L' // Alineación del texto dentro de la celda. 'L' para izquierda, 'C' para centro, 'R' para derecha.
        );
        $this->Ln(7);
        $this->SetFont('Arial','',10);
        $this->Cell(90,5,'CALLE FRANCISCO VAZQUEZ GOMEZ #419',0,0,'L'); // Alineado a la izquierda
        $this->Cell(80,5,'FECHA:'/*. date('d-m-Y', strtotime ($this->requisicion->getFecha()))*/,0,0,'R'); // Alineado a la derecha y luego salto de línea
        $this->Cell(20,5, '18-01-2024',0,1,'R'); // Alineado a la derecha y luego salto de línea

        // Texto con 'FRACC. COLINASccccc' a la izquierda y 'HORA' a la derecha
        $this->Cell(90,5,'FRACC. COLINAS DEL VALLE',0,0,'L'); // Alineado a la izquierda
        $this->Cell(80,5,'HORA: ' /*.$this->requisicion->getHora()*/,0,0,'R'); // Alineado a la derecha y luego salto de línea
        $this->Cell(20,5,'12:00',0,1,'L'); // Alineado a la derecha y luego salto de línea

        $this->Cell(90,5,'CD. VICTORIA, TAMAULIPAS',0,0,'L'); // Alineado a la izquierda
        $this->Cell(80,5,'OFICINA: ',0,0,'R'); // Alineado a la derecha y luego salto de línea
        $this->Cell(20,5,$this->SucursalSolicito,0,1,'L'); // Alineado a la derecha y luego salto de línea

        // Texto vacio a la izquierda y 'SOLICITO' a la derecha
        $this->Cell(90,5,'',0,0,'L'); // Alineado a la izquierda
        $this->Cell(80,5,'SOLICITO: ',0,0,'R');
        $this->Cell(20,5, "Ruben Juarez"/*$this->EmpleadoSolicito*/,0,1,'L');
        $this->Ln(7);
        // Add more header content as needed

    }

    function setHeaderContent2() {
        $this->SetFont('Arial','',10);

        $this->Cell(23,5,'NOMBRE:',0,0,'L');
        $this->Cell(70,5,'Hermenegildo Ruperto Juarez De Luna'/*. $this->proveedor->getNombre_Proveedor()*/,0,0,'L'); // Alineado a la derecha y luego salto de línea
        $this->Cell(65,5,'CUENTA:'/*. $this->requisicion->getCuenta()*/,0,0,'R'); // Alineado a la derecha y luego salto de línea
        $this->Cell(32,5,'0123456789012345',0,1,'L'); // Alineado a la derecha y luego salto de línea

        $this->Cell(23,5,'TELEFONO: '/*. $this->proveedor->getTelefono()*/,0,0,'L'); // Alineado a la izquierda
        $this->Cell(70,5,'834 123 4567',0,0,'L'); // Alineado a la derecha y luego salto de línea
        $this->Cell(65,5,'CLABE:'/*. $this->proveedor->getClabe()*/,0,0,'R'); // Alineado a la derecha y luego salto de línea
        $this->Cell(32,5,'012345678901234567',0,1,'L'); // Alineado a la derecha y luego salto de línea

        $this->Cell(23,5,'CORREO:',0,0,'L'); // Alineado a la izquierda
        $this->Cell(70,5, 'correoprueba@outlook.com'/*. $this->proveedor->getCorreo() */,0,0,'L'); // Alineado a la derecha y luego salto de línea
        $this->Cell(65,5,'BANCO:',0,0,'R'); // Alineado a la derecha y luego salto de línea
        $this->Cell(32,5,'Santander'/*. $this->DesBanco */,0,1,'L'); // Alineado a la izquierda

        $this->Cell(23,5,'DIRECCION: ',0,0,'L'); // Alineado a la izquierda
        $this->Cell(70,5,'Calle 1 #123 Colonia 2' /* $this->proveedor->getDireccion()*/,0,0,'L'); // Alineado a la derecha y luego salto de línea
        $this->Cell(60,5,'',0,1,'R'); // Alineado a la derecha y luego salto de línea

        $this->Cell(23,5,'CONTACTO: ',0,0,'L');
        $this->Cell(70,5,'Hermenegildo Ruperto Juarez De Luna'/* $this->proveedor->getNombre_Proveedor()*/,0,0,'L');
        $credito = "Si";
        /*if ($this->requisicion->getCredito()  == "1"){
            $credito = "Si";
        }
        else
        {
            $credito = "No";
        }*/
        $this->Cell(65,5,'CREDITO:',0,0,'R');
        $this->Cell(32,5,$credito,0,1,'L');

        // Add more header content as needed
    }

    function generateConceptos() {
        $productos = [
            ['cantidad' => '2', 'concepto' => 'Producto A', 'unidad' => 'pcs', 'importe' => '100.00'],
            ['cantidad' => '5', 'concepto' => 'Servicio B', 'unidad' => 'hrs', 'importe' => '200.00'],
            ['cantidad' => '3', 'concepto' => 'Producto C', 'unidad' => 'ltr', 'importe' => '150.00']
        ];
        foreach ($productos as $product) {
            if(!empty($product['cantidad']) && !empty($product['concepto']) && !empty($product['unidad']) && !empty($product['importe'])) {
                $this->Cell(40,6,$product['cantidad'],1, 0, 'L');
                $this->Cell(100,6,$product['concepto'],1, 0, 'L');
                $this->Cell(25,6,$product['unidad'],1, 0, 'L');
                $this->Cell(30,6,$product['importe'],1, 1, 'L');
            } else {
            // Si algún valor está vacío, imprimirás un error en el documento.
                $this->Cell(0,6,'Error: Un producto tiene un valor vacío.',1,1,'L');
            }
        }
        /*$this->SetFont('Arial','',12);
        foreach ($this->conceptosRequisicion as $product) {
            // your existing code for handling $product
            $this->Cell(40,6,$product['Cantidad'],1, 0, 'L');
            $this->Cell(100,6,$product['Concepto'],1, 0, 'L');
            $this->Cell(25,6,$product['DesUM'],1, 0, 'L');
            $this->Cell(30,6, '$'.number_format($product['Cantidad'] * $product['PrecioUnitario'], 2 , "." , ","),1, 1, 'L');

        }*/
        // Asumiendo que la altura de una celda es 6
$altura_celda = 6;

$this->SetFont('Arial','B',12);

// Celda para 'AUTORIZO' que abarca dos filas de altura
$this->Cell(40, $altura_celda * 2, 'AUTORIZO', 1, 0, 'L');

// Celda para el espacio vacío junto a 'AUTORIZO', sin bordes
$this->Cell(100, $altura_celda, '', 0, 0);
// Celda para 'SUBTOTAL' con borde, alineado a la derecha
$this->Cell(25, $altura_celda, 'SUBTOTAL', 1, 0, 'R');
// Celda para el importe del 'SUBTOTAL', con borde
$this->Cell(30, $altura_celda, '$'.number_format($this->subtotal, 2 , "." , ","), 1, 1);

// Celda para el espacio vacío debajo de 'AUTORIZO', sin bordes
$this->Cell(140, $altura_celda, '', 0, 0);
// Celda para 'IVA' con borde, alineado a la derecha
$this->Cell(25, $altura_celda, 'IVA', 1, 0, 'R');
// Celda para el importe del 'IVA', con borde
$this->Cell(30, $altura_celda, '$'.number_format($this->iva, 2 , "." , ","), 1, 1);

// Celda para el espacio vacío debajo de 'AUTORIZO', sin bordes
$this->Cell(140, $altura_celda, '', 0, 0);
// Celda para 'TOTAL' con borde, alineado a la derecha
$this->Cell(25, $altura_celda, 'TOTAL', 1, 0, 'R');
// Celda para el importe del 'TOTAL', con borde
$this->Cell(30, $altura_celda, '$'.number_format($this->total, 2 , "." , ","), 1, 1);
    }

    // Cabecera de página
    function Header() {       
        // Logo
        //$this->Image('logo.png',10,6,20); // Asumiendo que tienes un logo.png para la imagen del logotipo de empresa
        //$this->Image('../../themes/lte/assets/dist/img/logo.png',10,6,20); // Asumiendo que tienes un logo.png para la imagen del logotipo de empresa
        
        // Arial bold 15
        $this->SetFont('Arial','B',10);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30,10,'ORDEN DE COMPRA',0,0,'C');
        // Salto de línea
        $this->Ln(7);
        // Número de orden de compra
        //$this->Cell(0,10,'ORDEN NUM.' . $this->requisicion->getFolioRequisicion() ,0,0,'R');
        // Salto de línea
        //$this->Ln(10);
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

// Set header content
$pdf->setHeaderContent();

$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,10,'DATOS DEL PROVEDOR',0,0,'L'); // Nombre de la empresa en negrita y alineado a la izquierda
$pdf->Ln(7);
$pdf->setHeaderContent2();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,7,'CANTIDAD',1,0,'C');
$pdf->Cell(100,7,'CONCEPTO',1,0,'C');
$pdf->Cell(25,7,'U.M.',1,0,'C');
$pdf->Cell(30,7,'IMPORTE',1,0,'C');
$pdf->Ln();

$pdf->generateConceptos();
$pdf->Output();

?>
...