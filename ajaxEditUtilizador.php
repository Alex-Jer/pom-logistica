<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

$id = $_POST['id'];
                            
                $stmt = $conn->prepare("SELECT nome,armazem_id,email FROM utilizador WHERE id=? LIMIT 1");
                $stmt->bind_param("i",$id);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nome,$armazemid,$email);
                $stmt->fetch();
              
                        echo '<div class="form-group">';
                         echo    '<label>Nome</label>';
                         echo     '<input type="text" class="form-control" name="eNome" value="'.$nome.'" required>';
                         echo     '<input type="hidden" value="'.$id.'" name="editID">';
                         echo   '</div>';
                         echo '<div class="form-group">';
                         echo    '<label>Armazem</label>';
                         echo     '<select class="form-control" name="eArmazem" id="Armazem" style="text-align-last:center; margin-top:1rem; color: #6C757D;" required>';
                                         $busca = mysqli_query($conn, "SELECT id,nome FROM armazem where id='$armazemid'");
                                         $armazemid2 = mysqli_fetch_array($busca);
                                        echo '<option value=' . $armazemid2['id'] . '>' . $armazemid2['nome'] . '</option>';
                                        $busca = mysqli_query($conn, "SELECT id,nome FROM armazem WHERE NOT id = $armazemid ");
                                        foreach ($busca as $eachRow) {
                                        echo '<option value=' . $eachRow['id'] . ' >' . $eachRow['nome'] . '</option>';
                                        }
                         echo '
                         </select>';
                         echo   '</div>';
                         echo '<div class="form-group">';
                         echo    '<label>Email</label>';
                         echo     '<input type="text" class="form-control" name="eEmail" value="'.$email.'" required>';
                         echo   '</div>';
                        //  echo    '<label>Nome</label>';
                        //  echo     '<input type="text" class="form-control" value="'.$nome.'" required>';
                        //  echo   '</div>';
?>