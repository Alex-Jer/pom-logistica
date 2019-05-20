<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

 echo '<input type="text" name="TableClick" value="'.$_POST["id"].'">';