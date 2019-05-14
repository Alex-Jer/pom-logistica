<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
echo $_POST['id'];

$dado = mysqli_query($conn, "SELECT * FROM guia WHERE tipo_guia_id=1");
foreach ($dado as $eachRow) {
    $cliID=$eachRow['cliente_id'];
    $timeRN=$eachRow['data_prevista'];
    $getArtigo=$eachRow['artigo_id'];
    $qtPal=$eachRow['numero_paletes'];
    $numeroReq=$eachRow['numero_requisicao'];
    $arID=$eachRow['armazem_id'];
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
            echo '<td> '.$timeRN.'</td>';
            echo '<td> '.$qtPal.'</td>';
            echo '<td> '.$refArtigo.'</td>';
             echo '<td> '.$nomeArmazem.'</td>';
    echo '</tr>';
    }