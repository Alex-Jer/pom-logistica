<?php 
include 'operador.php';
date_default_timezone_set("Europe/Lisbon");
        $timeRN=date("Y-m-d H:i:s");
        $FinalDay=date("Y-m-t H:i:s");
        $FirstDay=date("Y-m-01 H:i:s");
                                    $query = mysqli_query($conn, "SELECT * FROM guia WHERE cliente_id=5 and (tipo_guia_id=4 or tipo_guia_id=3)");
                                    
                                    foreach ($query as $eachRow) {
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
                                            echo $diasArmazenamento;
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
                                        echo '<br>';
                                        echo $precoZona;


                                        $sql6 = mysqli_query($conn, "SELECT * FROM armazem WHERE id='$armazemId'");
                                        $sql7 = mysqli_fetch_array($sql6);
                                        $custoCarga = $sql7['custo_carga'];
                                        $custoDescarga = $sql7['custo_descarga'];

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

                                     $sql = "INSERT INTO linha (cliente_id, tipo_linha_id, guia_id, artigo_id,quantidade,valor) VALUES (5,$tipoLinha,$guiaid, $ArtigoIDD ,$numPaletes,'$Total')";
        
                                     if (mysqli_query($conn, $sql)) {
                                                     
                                     } else 
                                     {
                                             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                     }
                                    }

                                    $res = $conn->query("SELECT sum(valor) as suma FROM linha WHERE cliente_id=5");
                                    $val = $res -> fetch_array();
                                    $tech_total = $val['suma'];
                                    echo $tech_total;
                                    $iva = $tech_total*0.23;
                                        



                                    $sql2 = "INSERT INTO documento (cliente_id, utilizador_id, data_emissao, data_inicio,data_fim,iva,total) VALUES (5,2,'$timeRN','$FirstDay','$FinalDay','$iva','$tech_total')";
        
                                     if (mysqli_query($conn, $sql2)) {
                                                     
                                     } else 
                                     {
                                             echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
                                     }
                            

?>