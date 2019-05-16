<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarOperador.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") { }
?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css\bootstrap.css">
</head>

<style>
    body {
        overflow: hidden;
    }

    /* width */
    ::-webkit-scrollbar {
        width: 0.3rem;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #007bff;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #0056b3;
    }

    .btn:focus,
    .btn:active {
        outline: none !important;
        box-shadow: none;
    }

    tbody,
    thead tr {
        display: block;
    }

    tbody {
        max-height: 21rem;
        overflow-y: auto;
        overflow-x: hidden;
    }

    tbody td,
    thead th {
        width: 220px;
    }

    thead th:last-child {
        width: 16rem;
        /* 140px + 16px scrollbar width */
    }
</style>

<body>
    <div class="row align-items-center">
        <div class="card card-container" style="text-align:center; max-height:35rem; width:80rem; max-width: 100000px">
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="pdf.php" method="post">
                <div style="text-align:center">
                    <h1 style="margin-bottom:1rem;">Guia de Receção</h1>
                    <div class="container">
                        <table class="table" style="font-size:16px; margin-top:1.5rem;">
                            <thead>
                                <tr>
                                    <th style="width:20%">Cliente</th>
                                    <th style="width:20%">Dia e hora da carga</th>
                                    <th>Nº de Paletes</th>
                                    <th>Artigo</th>
                                    <th style="width:20%">Armazém</th>
                                    <th>PDF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dado = mysqli_query($conn, "SELECT guia.id as idg,guia.artigo_id,guia.cliente_id,guia.numero_paletes, guia.data_prevista, guia.numero_requisicao,guia.armazem_id, guia.confirmar, guia.confirmarTotal, cliente.nome as clientenome ,armazem.nome as armazemnome,artigo.referencia as artigoreef FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id WHERE tipo_guia_id=3 ");
                                foreach ($dado as $eachRow) {
                                    $GuiaID = $eachRow['idg'];
                                    $qtPal = $eachRow['numero_paletes'];
                                    $numeroReq = $eachRow['numero_requisicao'];
                                    $nomeArmazem = $eachRow['armazemnome'];
                                    $nomeCliente = $eachRow['clientenome'];
                                    $refArtigo = $eachRow['artigoreef'];
                                    $timeRN = $eachRow['data_prevista'];
                                    echo '<tr>';
                                    echo '<td style="width:20%"> ' . $nomeCliente . '</td>';
                                    echo '<td style="width:20%"> ' . $timeRN . '</td>';
                                    echo '<td> ' . $qtPal . '</td>';
                                    echo '<td> ' . $refArtigo . '</td>';
                                    echo '<td style="width:20%"> ' . $nomeArmazem . '</td>';
                                    ?>
                                    <td><button type="submit" style="margin-bottom:1rem; height:0px; width:0px" class="btn" name="GuiaID" value="<?php echo $GuiaID ?>"><i class="fa fa-file-pdf-o" style="font-size:24px; color:#dc3545; margin-left:-7px; margin-top:-8px"></i></button></td>
                                    <?php
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>

</html>