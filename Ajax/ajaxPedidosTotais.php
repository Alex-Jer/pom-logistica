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
echo '<table style="margin-left:auto; margin-right:auto;" class="table table-striped table-hover" id="myTable">
    <thead>
    <input type="search" class="form-control mobileSearch" placeholder="Procurar" style="text-align:left; width:15rem; height:1.7rem; position:absolute; margin-left:34rem; margin-top:-3.35rem; border-radius:2px" id="searchbox">
      <tr>
        <th style="width:20%; text-align:center">Cliente</th>
        <th style="width:20%; text-align:center">Nº de requisição</th>
        <th style="width:20%; text-align:center">Data e hora prevista</th>
        <th style="width:20%; text-align:center">Nº paletes</th>';
if ($_POST['id'] == 1) {
    echo '<th style="width:23%; text-align:center">Armazém</th>';
} else {
    echo '<th style="width:23%; text-align:center">Morada</th>';
}
echo '
      </tr>
    </thead>
    <tbody>';
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
    date_default_timezone_set("Europe/Lisbon");
}
echo '</tbody> </table>';

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

<script>
    $(document).ready(function() {
        var dataTable = $('#myTable').DataTable({
            "language": {
                url: 'http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json'
            },
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    text: 'Copiar',
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
            ],
            "paging": true,
            "pageLength": 6,
            "bLengthChange": false,
            "ordering": false,
            "info": false,
            initComplete: function() {
                $('.buttons-copy').removeClass('dt-button');
                $('.buttons-copy').addClass('btn');
                $('.buttons-copy').addClass('btn-outline-warning');

                $('.buttons-excel').removeClass('dt-button');
                $('.buttons-excel').addClass('btn');
                $('.buttons-excel').addClass('btn-outline-warning');

                $('.buttons-pdf').removeClass('dt-button');
                $('.buttons-pdf').addClass('btn');
                $('.buttons-pdf').addClass('btn-outline-warning');

                $('.buttons-print').removeClass('dt-button');
                $('.buttons-print').addClass('btn');
                $('.buttons-print').addClass('btn-outline-warning');
            }
        });
        $("#searchbox").on("keyup search input paste cut", function() {
            dataTable.search(this.value).draw();
        });
    });
</script>
