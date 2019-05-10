<?php ?>

<tbody>
                            <?php
                            $dado = mysqli_query($conn, "SELECT * FROM guia WHERE tipo_guia_id=1 AND (confirmar IS NULL OR confirmarTotal IS NULL) ");
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
                                        ?>
                                        <!-- <td><input type="submit" name="Ola" ></td> -->
                                        <?php if($confirm==NULL)
                                        {
                                            ?>
                                            <td ><button type="button" class="btn btn-primary teste" name="Confirm" id="Confirm"  value="<?php echo $GuiaID ?>">Confirmar</button></td>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <td><button type="submit"  class="btn btn-primary poprawa3"name="GuiaID" id="GuiaID" value="<?php echo $GuiaID ?>">Registar Palete</button></td>
                                            <?php
                                        }
                                        
                                echo '</tr>';

                                }
                                ?>
                               
                            </tbody>
                            <?php
                            






?>