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
    if ($_POST['dataescolhida'] != NULL) {

        $query = mysqli_query($conn, "SELECT cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao,  guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 1 AND DATE(data_prevista)='" . $_POST['dataescolhida'] . "' ORDER BY data_carga ASC");
    } else {

        $query = mysqli_query($conn, "SELECT cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao, guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 1 AND DATE(data_prevista)='$timeRN' ORDER BY data_carga ASC");
    }
} elseif ($_POST['id'] == 2) {
    if ($_POST['dataescolhida'] != NULL) {
        $query = mysqli_query($conn, "SELECT cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao,  guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 2 AND DATE(data_prevista)='" . $_POST['dataescolhida'] . "' ORDER BY data_carga ASC");
    } else {

        $query = mysqli_query($conn, "SELECT cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao, guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 2 AND DATE(data_prevista)='$timeRN' ORDER BY data_carga ASC");
    }
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
    //Inacabado
    echo '<tr>';
    echo '<td style="width:20%"> ' . $nomeCliente . '</t>';
    echo '<td style="width:20%; padding: 0 0"> ' . $numReq . '</td>';
    echo '<td style="width:20%; padding: 0 0"> ' . $nomeArmazem . '</td>';
    echo '<td style="width:20%; padding: 0 0"> ' . date($dataPrevista) . '</td>';
    echo '<td style="width:17%"> ' . $numPaletes . '</td>';
    echo '<td style="width:25%;"> ' . $morada . '</td>';
    echo '</tr>';
}
