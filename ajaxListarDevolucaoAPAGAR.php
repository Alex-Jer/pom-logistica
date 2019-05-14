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

$dado = mysqli_query($conn, "SELECT guia.numero_paletes as numero_paletes, guia.data_prevista as data_prevista, guia.numero_requisicao as numero_requisicao, cliente.nome as clientenome ,armazem.nome as armazemnome,artigo.referencia as artigoreef FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id WHERE guia.id='".$_POST['id']."'");
foreach ($dado as $eachRow) {
    $timeRN=$eachRow['data_prevista'];
    $qtPal=$eachRow['numero_paletes'];
    $numeroReq=$eachRow['numero_requisicao'];
    $arID=$eachRow['armazem_id'];
    $nomeCliente = $sql3['clientenome'];
    $nomeArmazem = $sql5['armazemnome'];
    $refArtigo = $sql7['artigoreef'];

    echo '<tr>';
        echo '<td>'.$nomeCliente.'</td>';
            echo '<td>'.$timeRN.'</td>';
            echo '<td>'.$numeroReq.'</td>';
            echo '<td>'.$qtPal.'</td>';
            echo '<td>'.$refArtigo.'</td>';
             echo '<td>'.$nomeArmazem.'</td>';
    echo '</tr>';
    }