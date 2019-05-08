<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

$busca = mysqli_query($conn,"SELECT * FROM cliente where id='".$_POST['id']."'");
$Clienteid=mysqli_fetch_array($busca);
    $getID=$Clienteid['id'];
    echo '<input  type="text" id="kreistinafreits" value = "'.$getID.'"></input>';
   
?>