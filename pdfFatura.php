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

        class myPDF extends FPDF{
            function header(){
                $this->SetFont('Arial','B',14);
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
                $query = mysqli_query($conn, "SELECT * FROM cliente WHERE id='".$_POST['GetCliente']."'");
                $dado = mysqli_fetch_array($query);
                $clienteNome=$dado['nome'];
                $this->Cell(276,5,$clienteNome,0,0,'C');
                $this->Ln();
                date_default_timezone_set("Europe/Lisbon");
                $FinalDay=date("Y-m-t");
                $FirstDay=date("Y-m-01");
                
                $this->SetFont('Times','',12);
                $teste = $this -> w;
                $teste=$teste/2;
                $teste=$teste-20;
                $this->SetX($teste);
                // $this->Cell(1,5,"$FirstDay -",0,0,'C');
                $this->Cell(20,5,"$FirstDay -",0,0,'C');
                $this->SetX($teste+30);
                $this->Cell(5,5,$FinalDay,0,0,'C');
                $this->Ln(20);
            }
            function footer(){
                $this->SetY(-15);
                $this->SetFont('Arial','',8);
                $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
            }
            function headerTable(){
                $this->SetFont('Times','B',12);
                $this->Cell(50,10,'Referencia','B,L,T',0,'C');
                
                $this->Cell(20,10,'N Paletes','B,T',0,'C');
                $this->Cell(25,10,'Artigo','B,T',0,'C');
                $this->Cell(15,10,'Dias','B,T',0,'C');
                $this->Cell(40,10,'Preco/Palete','B,T',0,'R');
                $this->Cell(50,10,'Preco Carga/Descarga','B,T',0,'R');
                $this->Cell(30,10,'Total','B,R,T',0,'R');
                $this->Ln();
            }
            function viewTable($conn)
            {
                                    $this->SetFont('Times','',12);
                                    date_default_timezone_set("Europe/Lisbon");
                                    $timeRN=date("Y-m-d H:i:s");
                                    $FinalDay=date("Y-m-t H:i:s");
                                    $FirstDay=date("Y-m-01 H:i:s");
                
                                    $query = mysqli_query($conn, "SELECT * FROM guia WHERE cliente_id='".$_POST['GetCliente']."' and (tipo_guia_id=4 or tipo_guia_id=3)");
                                    
                                    foreach ($query as $eachRow)
                                    {
                                        $CargaFinal=0;
                                        $guiaid=$eachRow['id'];
                                        $clienteId = $eachRow['cliente_id'];
                                        $sql2 = mysqli_query($conn, "SELECT * FROM cliente WHERE id='$clienteId'");
                                        $sql3 = mysqli_fetch_array($sql2);
                                        $tipoGuia=$eachRow['tipo_guia_id'];
                                        $numReq = $eachRow['numero_requisicao'];
                                        $numPaletes = $eachRow['numero_paletes'];
                                        $dataCarga = $eachRow['data_carga'];
                                        $ArtigoIDD = $eachRow['artigo_id'];
                                        $dataPrevistaDescarga = $eachRow['data_prevista'];
                                        $tipozonaId = $eachRow['tipo_zona_id'];
                                        $armazemId = $eachRow['armazem_id'];

                                        $queryPalete= mysqli_query($conn, "SELECT * FROM palete WHERE artigo_id='$ArtigoIDD'");
                                    
                                        
                                        foreach ($queryPalete as $eachRowPalete) {
                                            $dataDescarga=$eachRowPalete['Data_Saida'];
                                            $dataCarga=$eachRowPalete['Data'];
                                            
                                            if ($dataDescarga==0)
                                            {
                                                $datetime1 = new DateTime($timeRN);
                                                $datetime3=$timeRN;
                                            }
                                            else
                                            {
                                                $datetime1 = new DateTime($dataDescarga);
                                                $datetime3=$dataDescarga;
                                            }
                                            $datetime2 = new DateTime($dataCarga);
                                            $intervalo = date_diff($datetime1, $datetime2);
                                            $diasArmazenamento = $intervalo->format('%a');
                                            if ($diasArmazenamento==0){
                                                $diasArmazenamento=1;
                                            }
                                        }
                                        
                                        $sqlTGuia = mysqli_query($conn, "SELECT * FROM tipo_guia WHERE id='$tipoGuia'");
                                        $sqlTipoG = mysqli_fetch_array($sqlTGuia);
                                        $NomeGuia = $sqlTipoG['nome'];

                                        $sql4 = mysqli_query($conn, "SELECT * FROM zona WHERE id='$tipozonaId'");
                                        $sql5 = mysqli_fetch_array($sql4);
                                        $precoZona = $sql5['preco_zona'];

                                        $sql6 = mysqli_query($conn, "SELECT * FROM armazem WHERE id='$armazemId'");
                                        $sql7 = mysqli_fetch_array($sql6);
                                        $custoCarga = $sql7['custo_carga'];
                                        $custoDescarga = $sql7['custo_descarga'];

                                        $sqlArtigo = mysqli_query($conn, "SELECT * FROM artigo WHERE id='$ArtigoIDD'");
                                        $sqlNomeArtigo = mysqli_fetch_array($sqlArtigo);
                                        $ArtigoRef = $sqlNomeArtigo['referencia'];

                                        $result = $conn->query("SELECT count(*) FROM guia WHERE tipo_guia_id=3 AND cliente_id='$clienteId'");
                                        $row = $result->fetch_row();
                                        $count = $row[0];

                                        $result = $conn->query("SELECT count(*) FROM guia WHERE tipo_guia_id=4 AND cliente_id='$clienteId'");
                                        $row = $result->fetch_row();
                                        $count2 = $row[0];

                                        if ($tipoGuia==3)
                                        {
                                            $CargaFinal = $custoCarga * $count;
                                            $tipoLinha=1;
                                         

                                        }
                                        elseif($tipoGuia==4)
                                        {
                                            $CargaFinal = $custoDescarga * $count2;
                                            $tipoLinha=2;
                                        }
                                        $Total= $CargaFinal + ($precoZona * $numPaletes * $diasArmazenamento );
                                        ?>
                                        
                                        <?php
                                        $result = $conn->query("SELECT count(*) FROM linha  WHERE guia_id = '$guiaid'");
                                        $row = $result->fetch_row();
                                        $count =$row[0];
                                        if ($count==0)
                                        {
                                            $sql = "INSERT INTO linha (cliente_id, tipo_linha_id, guia_id, artigo_id,quantidade,valor) VALUES ('".$_POST['GetCliente']."',$tipoLinha,$guiaid, $ArtigoIDD ,$numPaletes,'$Total')";
                
                                            if (mysqli_query($conn, $sql)) {
                                                            
                                            } 
                                         }
                                            $this->Cell(50,10,"$NomeGuia - $numReq",'B,L',0,'C');
                                            $this->Cell(20,10,$numPaletes,'B',0,'C');
                                            $this->Cell(25,10,$ArtigoRef,'B',0,'C');
                                            $this->Cell(15,10,$diasArmazenamento,'B',0,'C');
                                            $this->Cell(40,10, $precoZona * $numPaletes * $diasArmazenamento . chr(128),'B',0,'R');
                                            $this->Cell(50,10, $CargaFinal . chr(128),'B',0,'R');
                                            $this->Cell(30,10, $Total . chr(128),'B,R',0,'R');
                                            // $this->Cell(50,10,$tech_total,1,0,'C');
                                            $this->Ln();
            
                                    }

                                
             } 
             function headerTableBot(){
                $this->SetFont('Times','B',12);
                $this->Cell(25,10,"",'T,B,L',0,'R');
                $this->Cell(25,10,'Total Paletes','B,T',0,'R');
                $this->Cell(25,10,'IVA(23%)','B,T',0,'R');
                $this->Cell(25,10,'Total','B,R,T',0,'R');
                $this->Ln();
            }
            function viewTableBot($conn){
                $this->SetFont('Times','B',12);

                $res = $conn->query("SELECT sum(valor) as suma FROM linha WHERE cliente_id='".$_POST['GetCliente']."'");
                $val = $res -> fetch_array();
                $tech_total = $val['suma'];
                $iva = $tech_total*0.23;
                $iva = number_format($iva, 2, '.', '');

                date_default_timezone_set("Europe/Lisbon");
                $timeRN=date("Y-m-d H:i:s");
                $FinalDay=date("Y-m-t");
                $FirstDay=date("Y-m-01");

                $res2 = $conn->query("SELECT sum(quantidade) as sumpal FROM linha WHERE cliente_id='".$_POST['GetCliente']."'");
                $val2 = $res2 -> fetch_array();
                $totalpal = $val2['sumpal'];
                    $this->Cell(25,10,"TOTAL:",'B,L',0,'C');
                    $this->SetFont('Times','',12);
                    $this->Cell(25,10,$totalpal,'B',0,'C');
                    $this->Cell(25,10,$iva. chr(128),'B',0,'R');
                    $this->Cell(25,10,$tech_total. chr(128),'B,R',0,'R');
                    $this->Ln();

                    $result = $conn->query("SELECT count(*) FROM documento  WHERE cliente_id = '".$_POST['GetCliente']."' AND data_inicio='$FirstDay' AND data_fim='$FinalDay'");
                    $row = $result->fetch_row();
                    $count =$row[0];
                    if ($count==0)
                    {
                        $sql2 = "INSERT INTO documento (cliente_id, utilizador_id, data_emissao, data_inicio,data_fim,iva,total) VALUES ('".$_POST['GetCliente']."','".$_SESSION['userid']."','$timeRN','$FirstDay','$FinalDay','$iva','$tech_total')";
                    
                                                if (mysqli_query($conn, $sql2)) {
                                                    $id = mysqli_insert_id($conn);      
                                                }
                                                
                      $sqllinha = "UPDATE linha SET documento_id=$id WHERE documento_id IS NULL";
                    
                     if (mysqli_query($conn, $sqllinha)) {
                                                                
                       }
                    }
                
            }
         }

                                            

    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->SetLeftMargin('34');
    $pdf->headerTable();
    $pdf->viewTable($conn);
    $pdf->SetX(164);
    $pdf->headerTableBot();
    $pdf->SetX(164);
    $pdf->viewTableBot($conn);
    $pdf->Output();