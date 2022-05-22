<?php
    session_start();
    require_once 'conexao.php';

    $id = $_SESSION['id'];
    $nome = $_SESSION['nome'] . " " . $_SESSION['apelido'];

    $query = ("select saldo from conta where id_cliente = '$id'");
    $resgisto = $con->query($query, PDO::FETCH_ASSOC);
    $res = $resgisto->fetch();

    $saldo = $res['saldo'];
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
    $this->Cell(0, 15, 'Powered by Angel Banze', 0, 1, 'L', false);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  
}
}
 $pdf = new Relatorio();
 $pdf->AddPage('P', 'A5',);
 $pdf->SetTitle('Consulta Saldo');
 $pdf->SetFont('Arial', 'B', 16);
 $pdf->Cell(80, 15, 'data: ' . date());
 $pdf->Cell(40,30, 'cliente: ' . $nome, 0, 1, 'L', false);
 $pdf->Cell(40, 30, 'Saldo Disponivel: ' . $saldo, 0, 1, 'L', false);

 $pdf->Output('I', 'Saldo');
?>