<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");


$result = $conn->query("SELECT count(*) FROM palete  WHERE artigo_id = '".$_POST['id']."'");
    $row = $result->fetch_row();
    $count =$row[0];
        echo $count;

?>