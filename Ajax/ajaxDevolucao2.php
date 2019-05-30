<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

$dado = mysqli_query($conn, "SELECT guia.id as idg,guia.artigo_id,guia.cliente_id,guia.numero_paletes, guia.data_prevista, guia.numero_requisicao,guia.armazem_id, guia.confirmar, guia.confirmarTotal, cliente.nome as clientenome ,armazem.nome as armazemnome,artigo.referencia as artigoreef FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id WHERE tipo_guia_id=2 AND confirmar IS NULL AND confirmarTotal IS NULL ");
echo '
<table style="margin-left:auto; margin-right:auto;" class="table table-striped table-hover" id="myTable">
        <thead>
            <tr>
                <th style="text-align:center">Cliente</th>
                <th style="text-align:center">Nº de Requisição</th>
                <th style="text-align:center">Dia e hora da carga</th>
                <th style="text-align:center">Nº de Paletes</th>
                <th style="text-align:center">Artigo</th>
                <th style="text-align:center">Armazém</th>
                <th style="text-align:center">Confirmar</th>
            </tr>
        </thead>
        <tbody>
';
foreach ($dado as $eachRow) {
    $GuiaID = $eachRow['idg'];
    $qtPal = $eachRow['numero_paletes'];
    $numeroReq = $eachRow['numero_requisicao'];
    $nomeArmazem = $eachRow['armazemnome'];
    $nomeCliente = $eachRow['clientenome'];
    $refArtigo = $eachRow['artigoreef'];
    $time = $eachRow['data_prevista'];
    echo '<tr>';
    echo '<td style="text-align:center; width:25%"> ' . $nomeCliente . '</td>';
    echo '<td style="text-align:center; width:15%"> ' . $numeroReq . '</td>';
    echo '<td style="text-align:center; width:20%"> ' . $time . '</td>';
    echo '<td style="text-align:center; width:13%"> ' . $qtPal . '</td>';
    echo '<td style="text-align:center; width:15%"> ' . $refArtigo . '</td>';
    echo '<td style="text-align:center; width:20%"> ' . $nomeArmazem . '</td>';
    echo '<td style="text-align:center; width:20%"><button type="submit"  class="btn" style="padding: 1px 1px; border-radius:0.3rem;" name="Confirm3" id="Confirm3"  value="' . $GuiaID . '"><i class="material-icons" style="color:#ffc107; margin-top:5px">check_circle</i></button></td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
?>

<!-- DataTable -->
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
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
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