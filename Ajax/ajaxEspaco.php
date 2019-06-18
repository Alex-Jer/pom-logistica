<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");


$busca3 = mysqli_query($conn,"SELECT espaco FROM zona WHERE armazem_id='".$_POST['id']."' AND tipo_zona_id='".$_POST['tipozona']."'");
        $dado = mysqli_fetch_array($busca3);
        $ArmazemEspaco = $dado['espaco'];
        echo $ArmazemEspaco;
