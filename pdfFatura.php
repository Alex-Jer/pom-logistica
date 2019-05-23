<?php
session_start();
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
class myPDF extends FPDF
{
    function header()
    {
        $this->SetFont('Arial', 'B', 14);
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
        $this->Ln(10);
        $query = mysqli_query($conn, "SELECT nome FROM cliente WHERE id='" . $_POST['GetCliente'] . "'");
        $dado = mysqli_fetch_array($query);
        $clienteNome = $dado['nome'];
        $clienteNome = iconv('UTF-8', 'windows-1252', $clienteNome);
        $this->Cell(276, 5, $clienteNome, 0, 0, 'C');
        $this->Ln();
        date_default_timezone_set("Europe/Lisbon");
        $FinalDay = date("Y-m-t");
        $FirstDay = date("Y-m-01");
        $this->SetFont('Times', '', 12);
        $teste = $this->w;
        $teste = $teste / 2;
        $teste = $teste - 20;
        $this->SetX($teste);
        // $this->Cell(1,5,"$FirstDay -",0,0,'C');
        $this->Cell(20, 5, "" . $_POST['GetDataInicial'] . " -", 0, 0, 'C');
        $this->SetX($teste + 30);
        $this->Cell(5, 5, "" . $_POST['GetDataFinal'] . "", 0, 0, 'C');
        $this->Ln(20);
    }
    function footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    function headerTable()
    {
        $referencia = iconv('UTF-8', 'windows-1252', 'Referência');
        $nPaletes = iconv('UTF-8', 'windows-1252', 'Nº Paletes');
        $precoPalete = iconv('UTF-8', 'windows-1252', 'Preço/Palete');
        $precoCargaDescarga = iconv('UTF-8', 'windows-1252', 'Preço Carga/Descarga');
        $this->SetFont('Times', 'B', 12);
        $this->Cell(30, 10, 'Tipo de guia', 'B,T,L', 0, 'C');
        $this->Cell(30, 10, $referencia, 'B,T', 0, 'C');
        $this->Cell(20, 10, $nPaletes, 'B,T', 0, 'C');
        $this->Cell(25, 10, 'Artigo', 'B,T', 0, 'C');
        $this->Cell(15, 10, 'Dias', 'B,T', 0, 'C');
        $this->Cell(40, 10, $precoPalete, 'B,T', 0, 'C');
        $this->Cell(50, 10, $precoCargaDescarga, 'B,T', 0, 'C');
        $this->Cell(30, 10, 'Total', 'B,R,T', 0, 'C');
        $this->Ln();
    }
    function viewTable($conn)
    {
        $this->SetFont('Times', '', 12);
        date_default_timezone_set("Europe/Lisbon");
        $timeRN = date("Y-m-d H:i:s");
        $FinalDay = date("Y-m-t H:i:s");
        $FirstDay = date("Y-m-01 H:i:s");
    
        $query = mysqli_query($conn, "SELECT guia.data_prevista as guiadata,cliente.id as cliente_id, artigo.referencia as artigoreferencia, guia.id as id,artigo.id as artigo_id,guia.numero_paletes as numero_paletes, guia.data_prevista as data_prevista, guia.numero_requisicao as numero_requisicao, tipo_guia.nome as tgn ,guia.tipo_guia_id as tpg, zona.id as zona, zona.preco_zona as precozona, armazem.id as armazemid, armazem.custo_carga as acg, armazem.custo_descarga as asd FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id INNER JOIN tipo_guia on tipo_guia.id=guia.tipo_guia_id INNER JOIN zona ON (zona.armazem_id=guia.armazem_id and zona.tipo_palete_id=guia.tipo_palete_id ) WHERE guia.cliente_id='" . $_POST['GetCliente'] . "' and(tipo_guia_id=4 or tipo_guia_id=3) and date(data_prevista) BETWEEN '" . $_POST['GetDataInicial'] . "' and '" . $_POST['GetDataFinal'] . "'");
        foreach ($query as $eachRow) {
            $CargaFinal = 0;
            $clienteId = $eachRow['cliente_id'];
            $tipoGuia = $eachRow['tpg'];
            $numReq = $eachRow['numero_requisicao'];
            $numPaletes = $eachRow['numero_paletes'];
            $ArtigoIDD = $eachRow['artigo_id'];
            $NomeGuia = $eachRow['tgn'];
            $precoZona = $eachRow['precozona'];
            $custoCarga = $eachRow['acg'];
            $custoDescarga = $eachRow['asd'];
            $dataGuias = $eachRow['guiadata'];
            //OLA;
            $guiaid = $eachRow['id'];
            $ArtigoRef = $eachRow['artigoreferencia'];
            $result = $conn->query("SELECT count(*) FROM guia WHERE tipo_guia_id=3 AND cliente_id='$clienteId'");
            $row = $result->fetch_row();
            $count = $row[0];
            $result = $conn->query("SELECT count(*) FROM guia WHERE tipo_guia_id=4 AND cliente_id='$clienteId'");
            $row = $result->fetch_row();
            $count2 = $row[0];
            if ($tipoGuia == 3) {
                $CargaFinal = $custoCarga * $count;
                $tipoLinha = 1;
            } elseif ($tipoGuia == 4) {
                $CargaFinal = $custoDescarga * $count2;
                $tipoLinha = 2;
            }
            $queryPalete = mysqli_query($conn, "SELECT Data,Data_Saida FROM palete WHERE artigo_id='$ArtigoIDD'");
            foreach ($queryPalete as $eachRowPalete) {
                $dataDescarga = $eachRowPalete['Data_Saida'];
                $dataCarga = $eachRowPalete['Data'];
                if ($dataDescarga == 0) {
                    $datetime1 = new DateTime($timeRN);
                    $datetime3 = $timeRN;
                } else {
                    $datetime1 = new DateTime($dataDescarga);
                    $datetime3 = $dataDescarga;
                }
                $datetime2 = new DateTime($dataCarga);
                $intervalo = date_diff($datetime1, $datetime2);
                $diasArmazenamento = $intervalo->format('%a');
                if ($diasArmazenamento == 0) {
                    $diasArmazenamento = 1;
                }
            }
            $Total = $CargaFinal + ($precoZona * $numPaletes * $diasArmazenamento);
            ?>
                                        
            <?php
            $result = $conn->query("SELECT count(*) FROM linha  WHERE guia_id = '$guiaid'");
            $row = $result->fetch_row();
            $count = $row[0];
            if ($count == 0) {
                $sql = "INSERT INTO linha (cliente_id, tipo_linha_id, guia_id, artigo_id,quantidade,valor,data_guia) VALUES ('" . $_POST['GetCliente'] . "',$tipoLinha,$guiaid, $ArtigoIDD ,$numPaletes,'$Total','$dataGuias')";
                if (mysqli_query($conn, $sql)) { }
            }
            $this->Cell(30, 10, "$NomeGuia", 'B,L', 0, 'C');
            $this->Cell(30, 10, "$numReq", 'B', 0, 'C');
            $this->Cell(20, 10, $numPaletes, 'B', 0, 'C');
            $this->Cell(25, 10, $ArtigoRef, 'B', 0, 'C');
            $this->Cell(15, 10, $diasArmazenamento, 'B', 0, 'C');
            $this->Cell(40, 10, $precoZona * $numPaletes * $diasArmazenamento . chr(128), 'B', 0, 'C');
            $this->Cell(50, 10, $CargaFinal . chr(128), 'B', 0, 'C');
            $this->Cell(30, 10, $Total . chr(128), 'B,R', 0, 'C');
            // $this->Cell(50,10,$tech_total,1,0,'C');
            $this->Ln();
        }
    }
    function headerTableBot()
    {
        $this->SetFont('Times', 'B', 12);
        $this->Cell(25, 10, "", 'T,B,L', 0, 'R');
        $this->Cell(25, 10, 'Total Paletes', 'B,T', 0, 'c');
        $this->Cell(25, 10, 'IVA(23%)', 'B,T', 0, 'C');
        $this->Cell(35, 10, 'Total', 'B,R,T', 0, 'C');
        $this->Ln();
    }
    function viewTableBot($conn)
    {
        $this->SetFont('Times', 'B', 12);
        $res = $conn->query("SELECT sum(valor) as suma FROM linha WHERE cliente_id='" . $_POST['GetCliente'] . "' and data_guia BETWEEN '" . $_POST['GetDataInicial'] . "' and '" . $_POST['GetDataFinal'] . "' ");
        $val = $res->fetch_array();
        $tech_total = $val['suma'];
        $iva = $tech_total * 0.23;
        $iva = number_format($iva, 2, '.', '');
        date_default_timezone_set("Europe/Lisbon");
        $timeRN = date("Y-m-d H:i:s");
        $FinalDay = date("Y-m-t");
        $FirstDay = date("Y-m-01");
        $res2 = $conn->query("SELECT sum(quantidade) as sumpal FROM linha WHERE cliente_id='" . $_POST['GetCliente'] . "' and data_guia BETWEEN '" . $_POST['GetDataInicial'] . "' and '" . $_POST['GetDataFinal'] . "' ");
        $val2 = $res2->fetch_array();
        $totalpal = $val2['sumpal'];
        $this->Cell(25, 10, "TOTAL:", 'B,L', 0, 'C');
        $this->SetFont('Times', '', 12);
        $this->Cell(25, 10, $totalpal, 'B', 0, 'C');
        $this->Cell(25, 10, $iva . chr(128), 'B', 0, 'C');
        $this->Cell(35, 10, $tech_total . chr(128), 'B,R', 0, 'C');
        $this->Ln();
        $result = $conn->query("SELECT count(*) FROM documento  WHERE cliente_id = '" . $_POST['GetCliente'] . "' AND data_inicio='" . $_POST['GetDataInicial'] . "' AND data_fim='" . $_POST['GetDataFinal'] . "'");
        $row = $result->fetch_row();
        $count = $row[0];
        if ($count == 0) {
            $sql2 = "INSERT INTO documento (cliente_id, utilizador_id, data_emissao, data_inicio,data_fim,iva,total) VALUES ('" . $_POST['GetCliente'] . "','" . $_SESSION['perfilId'] . "','$timeRN','$FirstDay','$FinalDay','$iva','$tech_total')";
            if (mysqli_query($conn, $sql2)) {
                $id = mysqli_insert_id($conn);
            }
        }
    }
}
        $pdf = new myPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage('L', 'A4', 0);
        $pdf->SetLeftMargin('34');
        $pdf->headerTable();
        $pdf->viewTable($conn);
        $pdf->SetX(164);
        $pdf->headerTableBot();
        $pdf->SetX(164);
        $pdf->viewTableBot($conn);
        $pdf->Output();
        
