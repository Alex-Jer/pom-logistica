<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
$busca = mysqli_query($conn,"SELECT id, referencia FROM artigo where cliente_id='".$_POST['id']."'");
foreach ($busca as $eachRow)
{
    echo '<option value = "'.$eachRow['id'].'">'.$eachRow['referencia'].'</option>';
}
