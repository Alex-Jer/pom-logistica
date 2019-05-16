<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
session_start();
include 'navbarAdmin.php';
include 'db.php';
if ($_SESSION["perfilId"] == 2) {

    header("Location: index.php");
    ?>
    <script type="text/javascript">
        alert("Você não tem permissões para essa página.");
    </script>
<?php
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST["cbCliente"];
    $query = mysqli_query($conn, "SELECT nome FROM cliente WHERE id='$cliente'");
    $dado = mysqli_fetch_array($query);
    $clienteNome = $dado['nome'];
}
date_default_timezone_set("Europe/Lisbon");
$timeRN = date("Y-m-d H:i:s");
?>

<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.7.0/d3.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
        max-height: 19rem;
        overflow-y: auto;
        overflow-x: hidden;
    }

    tbody td,
    thead th {
        width: 180px;
    }

    thead th:last-child {
        width: 17rem;
        /* 140px + 16px scrollbar width */
    }
</style>

<body>
    <form class="container" action="pdfFatura.php" method="post">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            ?>
            <input type="hidden" name="GetCliente" value=<?php echo $cliente ?>>
            <button type="submit" style="position:absolute; z-index:1; margin-left:42.5rem; margin-top:10.2rem;" id="pdf" class="btn"><i class="fa fa-file-pdf-o" style="font-size:34px; color:#dc3545; margin-left:-7px; margin-top:-8px"></i></button>
        <?php
    }
    ?>
    </form>
    <div class="container">
        <div class="card card-container" style="text-align:center; width:85rem; max-height:35rem; margin-bottom:auto; margin-left:-8rem; max-width: 10000px;">
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="fatura_cliente.php" method="post">
                <h1 style="margin-bottom:1rem;">Fatura mensal</h1>
                <div style="text-align:center">
                    <select class="custom-select" name="cbCliente" id="cbCliente" style="text-align-last:center; width:15.5rem; margin-bottom:1rem;" onchange="this.form.submit()">
                        <option value="" disabled selected>Cliente</option>
                        <?php
                        $busca = mysqli_query($conn, "SELECT id,nome FROM cliente");
                        foreach ($busca as $eachRow) {
                            ?>
                            <option value=" <?php echo $eachRow['id'] ?>" <?php echo (isset($_POST['cbCliente']) && $_POST['cbCliente'] == $eachRow['id']) ? 'selected="selected"' : ''; ?>><?php echo $eachRow['nome'] ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    <table class="table" style="width: 75rem; margin-left:-3rem">
                        <thead>
                            <tr>
                                <th style="width:15%">Tipo de Guia</th>
                                <th style="width:15%">Nº de requisição</th>
                                <th style="width:10%">Nº Paletes</th>
                                <th style="width:20%">Preço por palete / zona</th>
                                <th style="width:20%">Preço de Carga/Descarga</th>
                                <th>Dias</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($cliente)) {
                                $query = mysqli_query($conn, "SELECT cliente.id as cliente_id, artigo.id as artigo_id,guia.numero_paletes as numero_paletes, guia.data_prevista as data_prevista, guia.numero_requisicao as numero_requisicao, tipo_guia.nome as tgn ,guia.tipo_guia_id as tpg, zona.id as zona, zona.preco_zona as precozona, armazem.id as armazemid, armazem.custo_carga as acg, armazem.custo_descarga as asd FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id INNER JOIN tipo_guia on tipo_guia.id=guia.tipo_guia_id INNER JOIN zona ON (zona.armazem_id=guia.armazem_id and zona.tipo_palete_id=guia.tipo_palete_id ) WHERE guia.cliente_id=$cliente and(tipo_guia_id=4 or tipo_guia_id=3)");
                                foreach ($query as $eachRow) {
                                    $CargaFinal = 0;
                                    $clienteId = $eachRow['cliente_id'];
                                    $tipoGuia = $eachRow['tpg'];
                                    $numReq = $eachRow['numero_requisicao'];
                                    $numPaletes = $eachRow['numero_paletes'];
                                    $ArtigoIDD = $eachRow['artigo_id'];
                                    $NomeGuia = $eachRow['tgn'];
                                    $precoZona = $eachRow['precozona'];
                                    $custoCarga = $eachRow['acg'];
                                    $custoDescarga = $eachRow['asd'];

                                    $result = $conn->query("SELECT count(*) FROM guia WHERE tipo_guia_id=1 AND numero_requisicao='$numReq'");
                                    $row = $result->fetch_row();
                                    $count = $row[0];

                                    $result = $conn->query("SELECT count(*) FROM guia WHERE tipo_guia_id=4 AND cliente_id='$clienteId'");
                                    $row = $result->fetch_row();
                                    $count2 = $row[0];

                                    if ($tipoGuia == 3) {
                                        $CargaFinal = $custoCarga * $count;
                                        $tipoLinha = 1;
                                    } elseif ($tipoGuia == 4) {
                                        $CargaFinal = $custoDescarga * $count2;
                                        $tipoLinha = 2;
                                    }
                                    $queryPalete = mysqli_query($conn, "SELECT Data_Saida,Data FROM palete WHERE artigo_id='$ArtigoIDD'");
                                    foreach ($queryPalete as $eachRowPalete) {
                                        $dataDescarga = $eachRowPalete['Data_Saida'];
                                        $dataCarga = $eachRowPalete['Data'];

                                        if ($dataDescarga == 0) {
                                            $datetime1 = new DateTime($timeRN);
                                            $datetime3 = $timeRN;
                                        } else {
                                            $datetime1 = new DateTime($dataDescarga);
                                            $datetime3 = $dataDescarga;
                                        }
                                        $datetime2 = new DateTime($dataCarga);
                                        $intervalo = date_diff($datetime1, $datetime2);
                                        $diasArmazenamento = $intervalo->format('%a');
                                        if ($diasArmazenamento == 0) {
                                            $diasArmazenamento = 1;
                                        }
                                    }
                                    $Total = $CargaFinal + ($precoZona * $numPaletes * $diasArmazenamento);


                                    ?>
                                    <tr>
                                        <td style="width:15%;"><?php echo "$NomeGuia" ?> </td>
                                        <td style="width:15%"><?php echo "$numReq" ?> </td>
                                        <td style="width:10%"><?php echo $numPaletes ?> </td>
                                        <td style="width:20%"><?php echo $precoZona * $numPaletes * $diasArmazenamento . " €" ?></td>
                                        <td style="width:20%"><?php echo $CargaFinal . " €" ?></td>
                                        <td><?php echo $diasArmazenamento ?></td>
                                        <td><?php echo $Total . " €" ?></td>
                                    </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->

</body>

</html>

<script>
    $("#cbCliente").on("change", function() {
        $.ajax({
            url: 'ajaxFatura.php',
            type: 'POST',
            data: {
                id: $("#cbCliente").val()
            },
            success: function(data) {
                $("#pdf").css({
                    'display': 'block'
                });
            },
        });
    });
</script>