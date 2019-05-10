<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
                            if ( $_POST['id']==1)
                            {
                                $dado = mysqli_query($conn, "SELECT * FROM guia WHERE tipo_guia_id=1 AND confirmar IS NULL AND confirmarTotal IS NULL ");
                            }
                            elseif($_POST['id']==2)
                            {
                                $dado = mysqli_query($conn, "SELECT * FROM guia WHERE tipo_guia_id=3 AND (confirmar IS not NULL and confirmarTotal IS NULL) ");
                            }
                        
                            foreach ($dado as $eachRow) {
                                $cliID=$eachRow['cliente_id'];
                                $GuiaID=$eachRow['id'];
                                $time=$eachRow['data_prevista'];
                                $getArtigo=$eachRow['artigo_id'];
                                $qtPal=$eachRow['numero_paletes'];
                                $numeroReq=$eachRow['numero_requisicao'];
                                $arID=$eachRow['armazem_id'];
                                $confirm = $eachRow['confirmar'];
                                $confirmTotal= $eachRow['confirmarTotal'];
                                $sql2 = mysqli_query($conn, "SELECT * FROM cliente WHERE id='$cliID'");
                                $sql3 = mysqli_fetch_array($sql2);
                                $nomeCliente = $sql3['nome'];
                                $sql4 = mysqli_query($conn, "SELECT * FROM armazem WHERE id='$arID'");
                                $sql5 = mysqli_fetch_array($sql4);
                                $nomeArmazem = $sql5['nome'];
                                $sql6 = mysqli_query($conn, "SELECT * FROM artigo WHERE id='$getArtigo'");
                                $sql7 = mysqli_fetch_array($sql6);
                                $refArtigo = $sql7['referencia'];
                                //Inacabado
                                echo '<tr>';
                                    echo '<td> '.$nomeCliente.'</td>';
                                        echo '<td> '.$time.'</td>';
                                        echo '<td> '.$qtPal.'</td>';
                                        echo '<td> '.$refArtigo.'</td>';
                                        echo '<td> '.$nomeArmazem.'</td>';
                                        if($confirm==NULL)
                                        {
                                            echo '<td ><button type="submit" class="btn btn-primary"  name="Confirm" id="Confirm"  value="'.$GuiaID.'">Confirmar</button></td>';
                                        }
                                        else
                                        {
                                            echo '<td><button type="submit"  class="btn btn-primary" name="GuiaIDD" data-toggle="modal" data-target="#exampleModal" value="'.$GuiaID.'">Registar Palete</button></td>';
                                            echo $GuiaID;
                                        }
                                        
                                echo '</tr>';

                                }







?>