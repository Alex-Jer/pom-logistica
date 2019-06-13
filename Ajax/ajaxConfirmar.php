<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
$timeRN = date("Y-m-d");
date_default_timezone_set("Europe/Lisbon");
if ($_POST['id'] == 1) {
    $query = mysqli_query($conn, "SELECT cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao, guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 1 AND DATE(data_prevista)='$timeRN' ORDER BY data_carga ASC");
} elseif ($_POST['id'] == 2) {
    $query = mysqli_query($conn, "SELECT cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao, guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 2 AND DATE(data_prevista)='$timeRN' ORDER BY data_carga ASC");
}

foreach ($query as $eachRow) {
    $clienteId = $eachRow['cliente_id'];
    $numReq = $eachRow['numero_requisicao'];
    $numPaletes = $eachRow['numero_paletes'];
    $dataPrevista = $eachRow['data_prevista'];
    $dataCarga = $eachRow['data_carga'];
    $morada = $eachRow['morada'];
    $nomeCliente = $eachRow['clinome'];
    $nomeArmazem = $eachRow['armazemnome'];
    echo '<tr>';
    echo '<td style="width:190px;"> ' . $nomeCliente . '</t>';
    echo '<td style="width:190px;"> ' . $numReq . '</td>';
    echo '<td style="width:190px;"> ' . $morada . '</td>';
    echo '<td style="width:190px;"> ' . date($dataPrevista) . '</td>';
    echo '<td style="width:190px; text-align:center"> ' . $numPaletes . '</td>';
    echo '<td style="width:190px;"> ' . $nomeArmazem . '</td>';
    echo '</tr>';
}
