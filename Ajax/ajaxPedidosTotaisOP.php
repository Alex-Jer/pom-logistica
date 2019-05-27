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
        if ($_POST['tipo_cliente_id'] != 0) {
            $query = mysqli_query($conn, "SELECT guia.id as guiaid, cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao,  guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 1 AND DATE(data_prevista)='" . $_POST['dataescolhida'] . "' AND guia.cliente_id='" . $_POST['tipo_cliente_id'] . "' ORDER BY data_carga ASC");
        } else {
            $query = mysqli_query($conn, "SELECT guia.id as guiaid, cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao, guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 1 AND DATE(data_prevista)='" . $_POST['dataescolhida'] . "' ORDER BY data_carga ASC");
        }
    } else {
        if ($_POST['tipo_cliente_id'] != 0) {
            $query = mysqli_query($conn, "SELECT guia.id as guiaid, cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao,  guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 1  AND guia.cliente_id='" . $_POST['tipo_cliente_id'] . "' ORDER BY data_carga ASC");
        } else {
            $query = mysqli_query($conn, "SELECT guia.id as guiaid, cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao, guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 1 ORDER BY data_carga ASC");
        }
    }
} elseif ($_POST['id'] == 2) {
    if ($_POST['dataescolhida'] != NULL) {
        if ($_POST['tipo_cliente_id'] != 0) {
            $query = mysqli_query($conn, "SELECT guia.id as guiaid, cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao,  guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 2 AND DATE(data_prevista)='" . $_POST['dataescolhida'] . "' AND guia.cliente_id='" . $_POST['tipo_cliente_id'] . "' ORDER BY data_carga ASC");
        } else {
            $query = mysqli_query($conn, "SELECT guia.id as guiaid, cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao, guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 2 AND DATE(data_prevista)='" . $_POST['dataescolhida'] . "' ORDER BY data_carga ASC");
        }
    } else {
        if ($_POST['tipo_cliente_id'] != 0) {
            $query = mysqli_query($conn, "SELECT guia.id as guiaid, cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao,  guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 2  AND guia.cliente_id='" . $_POST['tipo_cliente_id'] . "' ORDER BY data_carga ASC");
        } else {
            $query = mysqli_query($conn, "SELECT guia.id as guiaid, cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao, guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 2 ORDER BY data_carga ASC");
        }
    }
}

foreach ($query as $eachRow) {
    $GuiaID=$eachRow['guiaid'];
    $clienteId = $eachRow['cliente_id'];
    $numReq = $eachRow['numero_requisicao'];
    $numPaletes = $eachRow['numero_paletes'];
    $dataPrevista = $eachRow['data_prevista'];
    $dataCarga = $eachRow['data_carga'];
    $morada = $eachRow['morada'];
    $nomeCliente = $eachRow['clinome'];
    $nomeArmazem = $eachRow['armazemnome'];
    echo '<tr class="table-row" data-value="'.$GuiaID.'" data-toggle="modal" data-target="#exampleModal2">';
    echo '<td style="width:20%;"> ' . $nomeCliente . '</t>';
    echo '<td style="width:20%; text-align:center;"> ' . $numReq . '</td>';
    echo '<td style="width:20%; text-align:center;"> ' . date($dataPrevista) . '</td>';
    echo '<td style="width:17%; text-align:center"> ' . $numPaletes . '</td>';
    echo '<td style="width:20%; text-align:center;"> ' . $nomeArmazem . '</td>';
    echo '</tr>';
}
?>

<script>
    $(".table-row").click(function() {
        $.ajax({
            url: '/POM-Logistica/Ajax/ajaxTesteasd.php',
            type: 'POST',
            data: {
                id: $(this).data('value')
            },
            success: function(data) {
                $("#TableDetails").html(data);
            },
        });
    });

</script>