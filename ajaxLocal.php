<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
echo $_POST['id'];
$busca = mysqli_query($conn,"SELECT id,nome FROM zona where tipo_palete_id='".$_POST['id']."'");

foreach ($busca as $eachRow){
    echo '<option value = "'.$eachRow['id'].'">'.$eachRow['nome'].'</option>';
   
}
?>