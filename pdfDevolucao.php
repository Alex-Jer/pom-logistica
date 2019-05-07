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
require "fpdf.php";

        class myPDF extends FPDF{
            function header(){
                $this->SetFont('Arial','B',14);
                $this->Cell(276,5,'GUIA DE DEVOLUCAO',0,0,'C');
                $this->Ln();
                $this->SetFont('Times','',12);
                $this->Ln(20);
            }
            function footer(){
                $this->SetY(-15);
                $this->SetFont('Arial','',8);
                $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
            }
            function headerTable(){
                $this->SetFont('Times','B',12);
                $this->Cell(40,10,'Referencia',1,0,'C');
                // $this->Cell(40,10,'Name',1,0,'C');
                $this->Cell(40,10,'Nome',1,0,'C');
                $this->Cell(60,10,'Data e Hora',1,0,'C');
                $this->Cell(25,10,'N Paletes',1,0,'C');
                $this->Cell(30,10,'Artigo',1,0,'C');
                $this->Cell(50,10,'Armazem',1,0,'C');
                $this->Ln();
            }
            function viewTable($conn){
                $this->SetFont('Times','',12);
                $dado = mysqli_query($conn, "SELECT * FROM guia WHERE id='".$_POST['guia']."'");
                $eachRow = mysqli_fetch_array($dado);
                    $cliID=$eachRow['cliente_id'];
                    $timeRN=$eachRow['data_prevista'];
                    $getArtigo=$eachRow['artigo_id'];
                    $qtPal=$eachRow['numero_paletes'];
                    $numeroReq=$eachRow['numero_requisicao'];
                    $arID=$eachRow['armazem_id'];
                    $sql2 = mysqli_query($conn, "SELECT * FROM cliente WHERE id='$cliID'");
                    $sql3 = mysqli_fetch_array($sql2);
                    $nomeCliente = $sql3['nome'];
                    $sql4 = mysqli_query($conn, "SELECT * FROM armazem WHERE id='$arID'");
                    $sql5 = mysqli_fetch_array($sql4);
                    $nomeArmazem = $sql5['nome'];
                    $sql6 = mysqli_query($conn, "SELECT * FROM artigo WHERE id='$getArtigo'");
                    $sql7 = mysqli_fetch_array($sql6);
                    $refArtigo = $sql7['referencia'];
                    $this->Cell(40,10,$numeroReq,1,0,'C');
                    // $this->Cell(40,10,$data->nome,1,0,'L');
                    $this->Cell(40,10,$nomeCliente,1,0,'C');
                    $this->Cell(60,10,$timeRN,1,0,'C');
                    $this->Cell(25,10,$qtPal,1,0,'R');
                    $this->Cell(30,10,$refArtigo,1,0,'C');
                    $this->Cell(50,10,$nomeArmazem,1,0,'C');
                    $this->Ln();
                
            }
        }

    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->SetLeftMargin('25');
    $pdf->headerTable();
    $pdf->viewTable($conn);
    $pdf->Output();