<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
if ($_POST['id'] == 1) {
    if ($_POST['dataescolhida'] != NULL) {
        $query = mysqli_query($conn, "SELECT guia.id as guiaid,cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga, guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao,  guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 1 AND DATE(data_prevista)='" . $_POST['dataescolhida'] . "' ORDER BY data_carga ASC");
    } else {
        $query = mysqli_query($conn, "SELECT guia.id as guiaid,cliente.nome as clinome, armazem.nome as armazemnome,guia.data_carga as data_carga, guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao, guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id INNER JOIN armazem on armazem.id=guia.armazem_id WHERE tipo_guia_id = 1 ORDER BY data_carga ASC");
    }
} elseif ($_POST['id'] == 2) {
    if ($_POST['dataescolhida'] != NULL) {
        $query = mysqli_query($conn, "SELECT guia.id as guiaid,cliente.nome as clinome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao,  guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id WHERE tipo_guia_id = 2 AND DATE(data_prevista)='" . $_POST['dataescolhida'] . "' ORDER BY data_carga ASC");
    } else {
        $query = mysqli_query($conn, "SELECT guia.id as guiaid,cliente.nome as clinome,guia.data_carga as data_carga,guia.data_prevista as data_prevista, guia.numero_paletes as numero_paletes ,guia.cliente_id as cliente_id, guia.numero_requisicao as numero_requisicao, guia.morada as morada FROM guia INNER JOIN cliente on cliente.id = guia.cliente_id WHERE tipo_guia_id = 2 ORDER BY data_carga ASC");
    }
}

foreach ($query as $eachRow) {
    $GuiaID = $eachRow['guiaid'];
    $clienteId = $eachRow['cliente_id'];
    $numReq = $eachRow['numero_requisicao'];
    $numPaletes = $eachRow['numero_paletes'];
    $dataPrevista = $eachRow['data_prevista'];
    $dataCarga = $eachRow['data_carga'];
    $morada = $eachRow['morada'];
    $nomeCliente = $eachRow['clinome'];
    if ($_POST['id'] == 1) {
        $nomeArmazem = $eachRow['armazemnome'];
    }
    echo '<tr class="table-row" data-value="' . $GuiaID . '" data-toggle="modal" data-target="#exampleModal2">';
    echo '<td style="width:20%; text-align:center"> ' . $nomeCliente . '</td>';
    echo '<td style="width:20%; text-align:center"> ' . $numReq . '</td>';
    echo '<td style="width:20%; text-align:center"> ' . date($dataPrevista) . '</td>';
    echo '<td style="width:20%; text-align:center"> ' . $numPaletes . '</td>';
    if ($_POST['id'] == 1) {
        echo '<td style="width:25%; text-align:center"> ' . $nomeArmazem . '</td>';
    } else {
        echo '<td style="width:25%; text-align:center" id="moradaD"> ' . $morada . '</td>';
    }
    echo '</tr>';
}

?>
<script>
    $(".table-row").click(function() {
        $.ajax({
            url: 'Ajax/ajaxTesteasd.php',
            type: 'POST',
            data: {
                id: $(this).data('value')
            },
            success: function(data) {
                $("#TableDetails").html(data);
            },
        });
    });

    $("#Confirmed").on("click", function() {
        // alert("transporte ");
        document.getElementById("moradaH").style.visibility = "visible";
        document.getElementById("moradaD").style.visibility = "visible";
        document.getElementById("armazemH").style.visibility = "collapse";
        document.getElementById("armazemD").style.visibility = "collapse";
    });

    $("#notConfirmed").on("click", function() {
        // alert("entrega ");
        document.getElementById("moradaH").style.visibility = "collapse";
        document.getElementById("moradaD").style.visibility = "collapse";
        document.getElementById("armazemH").style.visibility = "visible";
        document.getElementById("armazemD").style.visibility = "visible";
    });
</script>