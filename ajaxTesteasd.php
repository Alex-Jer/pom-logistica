<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
                            if ( 1==1)
                            {
                                $dado = mysqli_query($conn, "SELECT guia.id,guia.artigo_id,guia.cliente_id,guia.numero_paletes, guia.data_prevista, guia.numero_requisicao,guia.armazem_id, guia.confirmar, guia.confirmarTotal, cliente.nome as clientenome ,armazem.nome as armazemnome,artigo.referencia as artigoreef FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id WHERE tipo_guia_id=1 AND confirmar IS NULL AND confirmarTotal IS NULL ");
                                }
                            elseif(2==2)
                            {
                                $dado = mysqli_query($conn, "SELECT guia.id,guia.artigo_id,guia.cliente_id,guia.numero_paletes, guia.data_prevista, guia.numero_requisicao,guia.armazem_id, guia.confirmar, guia.confirmarTotal, cliente.nome as clientenome ,armazem.nome as armazemnome,artigo.referencia as artigoreef FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id WHERE tipo_guia_id=3 AND (confirmar IS not NULL and confirmarTotal IS NULL)");
                            }
                        
                            foreach ($dado as $eachRow) {
                                $cliID=$eachRow['cliente_id'];
                                $GuiaID=$eachRow['id'];
                                $getArtigo=$eachRow['artigo_id'];
                                $qtPal=$eachRow['numero_paletes'];
                                $numeroReq=$eachRow['numero_requisicao'];
                                $arID=$eachRow['armazem_id'];
                                $confirm = $eachRow['confirmar'];
                                $confirmTotal= $eachRow['confirmarTotal'];
                                $nomeArmazem= $eachRow['armazemnome'];
                                $nomeCliente = $eachRow['clientenome'];
                                $refArtigo = $eachRow['artigoreef'];
                                $time = $eachRow['data_prevista'];
                                //Inacabado
                                echo '<tr>';
                                    echo '<td> '.$nomeCliente.'</td>';
                                    echo '<td> '.$numeroReq.'</td>';

                                        echo '<td> '.$time.'</td>';
                                        echo '<td> '.$qtPal.'</td>';
                                        echo '<td> '.$refArtigo.'</td>';
                                        echo '<td> '.$nomeArmazem.'</td>';
                                        if($confirm==NULL)
                                        {
                                            echo '<td ><button type="submit"  class="btn btn-primary"  name="Confirm" id="Confirm"  value="'.$GuiaID.'">Confirmar</button></td>';
                                        }
                                        else
                                        {
                                            echo '<td><button type="button"  class="btn btn-primary" name="Guia_ID" id="Guia_ID" data-toggle="modal" data-target="#exampleModal" value="'.$GuiaID.'">Registar Palete</button></td>';

                                            echo '<input type="hidden" value="'.$GuiaID.'" name="Guia_ID2">';
                                            echo '<td><button type="submit"  class="btn btn-primary" name="confirmTotal" id="confirmTotal" value="'.$GuiaID.'">Confirmar Guia</button></td>';
                                        }
                                        
                                echo '</tr>';

                                }







?>