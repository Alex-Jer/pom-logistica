<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");


$busca = mysqli_query($conn,"SELECT * FROM tipo_palete WHERE id='".$_POST['id']."'");
$dado = mysqli_fetch_array($busca);
        $nome = $dado['nome'];
        $nome2 = $dado['id'];
echo '<option value="" disabled selected>Armazem</option>';
$busca2 = mysqli_query($conn,"SELECT * FROM zona WHERE tipo_zona_id='$nome2'");
foreach ($busca2 as $eachRow)
{

  $EspcZona = $eachRow['espaco'];
  $armaID = $eachRow['armazem_id'];
  $busca3 = mysqli_query($conn,"SELECT * FROM armazem WHERE id='$armaID'");
  foreach ($busca3 as $eachRow2)
  {
    
  
  echo '<option value = "'.$eachRow2['id'].'">'.$eachRow2['nome'].' - '.$EspcZona.'</option>';

  
 
  }

}  

?>