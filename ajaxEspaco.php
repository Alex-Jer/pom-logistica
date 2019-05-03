<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");


$busca3 = mysqli_query($conn,"SELECT * FROM tipo_palete WHERE id='".$_POST['id']."'");
        $dado = mysqli_fetch_array($busca3);
        $nome = $dado['nome'];
        $nome2 = $dado['id'];
  
$busca2 = mysqli_query($conn,"SELECT * FROM zona WHERE tipo_zona_id='$nome2'");

foreach ($busca2 as $eachRow){
  $idZona = $eachRow['id'];
  $espcZona = $eachRow['espaco'];
  $nomeZona = $eachRow['nome'];
  
  echo '<div>';
  echo "Existe  "$espcZona" espaços na "$nomeZona;
  echo '</div>'
  

 
}
       

?>