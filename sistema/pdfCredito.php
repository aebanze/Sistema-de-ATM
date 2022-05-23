<?php
    session_start();
    require_once 'conexao.php';

    $id = $_SESSION['id'];
    $nome = $_SESSION['nome'];
    $recarga = $_SESSION['recarga'];
    $valor = $_SESSION['credito'];
    $operadora = $_SESSION['operadora'];

?>
<?php  
include ('./fpdf/fpdf.php');
class Relatorio extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('./img/Untitled-2.png',60,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    $this->Ln(15);
    // Title
    $this->Cell(125,10,'AEB Bank',0,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0, 15, 'Powered by Angel Stunner @2022', 0, 1, 'L', false);
  
}
}
 $pdf = new Relatorio();
 $pdf->AddPage('P', 'A5',);
 $pdf->SetTitle('Compra de Credito');
 $pdf->SetFont('Arial', 'B', 16);
 $pdf->Cell(80, 15, 'Compra de Credito', 0, 1, 'L', false);
 $pdf->Cell(80, 15, 'data: ' . date("d") . "-" . date("m") . "-" . date("y"));
 $pdf->Ln(20);
 $pdf->Cell(80, 15, $operadora . "        " . $valor . ".00MT", 0, 1, 'L', false);
 $pdf->Cell(40,30, 'Codigo: ' . $recarga, 0, 1, 'L', false);

 $pdf->Output('I', 'Credito');
?>