<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
require(dirname(__FILE__).'\..\fpdf.php');
class myPDF extends FPDF
{
    function header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(276, 5, iconv('UTF-8', 'windows-1252', 'GUIA DE DEVOLUÇÃO'), 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times', '', 12);
        $this->Ln(20);
    }
    function footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'PÁGINA ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    function headerTable()
    {
        $this->SetFont('Times', 'B', 12);
        $this->Cell(40, 10, iconv('UTF-8', 'windows-1252', 'Referência'), 1, 0, 'C');
        // $this->Cell(40,10,'Name',1,0,'C');
        $this->Cell(40, 10, 'Nome', 1, 0, 'C');
        $this->Cell(60, 10, 'Data e Hora', 1, 0, 'C');
        $this->Cell(25, 10, iconv('UTF-8', 'windows-1252', 'Nº Paletes'), 1, 0, 'C');
        $this->Cell(30, 10, 'Artigo', 1, 0, 'C');
        $this->Cell(50, 10, iconv('UTF-8', 'windows-1252', 'Armazém'), 1, 0, 'C');
        $this->Ln();
    }
    function viewTable($conn)
    {
        $this->SetFont('Times', '', 12);
        $dado = mysqli_query($conn, "SELECT guia.id as idg,guia.artigo_id,guia.cliente_id,guia.numero_paletes, guia.data_prevista, guia.numero_requisicao,guia.armazem_id, guia.confirmar, guia.confirmarTotal, cliente.nome as clientenome ,armazem.nome as armazemnome,artigo.referencia as artigoreef FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id WHERE guia.id='" . $_POST['GuiaID'] . "'");
        $eachRow = mysqli_fetch_array($dado);
        $GuiaID = $eachRow['idg'];
        $qtPal = $eachRow['numero_paletes'];
        $numeroReq = $eachRow['numero_requisicao'];
        $nomeArmazem = $eachRow['armazemnome'];
        $nomeCliente = $eachRow['clientenome'];
        $refArtigo = $eachRow['artigoreef'];
        $timeRN = $eachRow['data_prevista'];
        $this->Cell(40, 10, $numeroReq, 1, 0, 'C');
        // $this->Cell(40,10,$data->nome,1,0,'L');
        $this->Cell(40, 10, $nomeCliente, 1, 0, 'C');
        $this->Cell(60, 10, $timeRN, 1, 0, 'C');
        $this->Cell(25, 10, $qtPal, 1, 0, 'C');
        $this->Cell(30, 10, $refArtigo, 1, 0, 'C');
        $this->Cell(50, 10, $nomeArmazem, 1, 0, 'C');
        $this->Ln();
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->SetLeftMargin('25');
$pdf->headerTable();
$pdf->viewTable($conn);
$pdf->Output();
