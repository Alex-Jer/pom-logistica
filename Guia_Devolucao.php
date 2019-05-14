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

    tbody,
    thead tr {
        display: block;
    }

    tbody {
        height: 21rem;
        overflow-y: auto;
        overflow-x: hidden;
    }

    tbody td,
    thead th {
        width: 190px;
    }

    thead th:last-child {
        width: 16rem;
        /* 140px + 16px scrollbar width */
    }
</style>

<body>
    <div class="row align-items-center">
        <div class="card card-container" style="text-align:center; width:85rem; height:35rem; margin-bottom:auto; max-width: 10000px;">
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="pdfDevolucao.php" method="post">
                <div style="text-align:center">
                    <h1 style="margin-bottom:1rem;">Guia de devolução</h1>
                    <div class="container" style="margin-left:6rem;">
                    <table class="table" style="font-size:16px; margin-top:1.5rem; margin-left:-2rem; width:60rem;">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th style="width:25%">Dia e hora da carga</th>
                                    <th style="width:15%">Nº de paletes</th>
                                    <th>Artigo</th>
                                    <th>Armazém</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dado = mysqli_query($conn, "SELECT * FROM guia WHERE tipo_guia_id=4");
                                foreach ($dado as $eachRow) {
                                    $cliID = $eachRow['cliente_id'];
                                    $timeRN = $eachRow['data_prevista'];
                                    $getArtigo = $eachRow['artigo_id'];
                                    $GuiaID = $eachRow['id'];
                                    $qtPal = $eachRow['numero_paletes'];
                                    $numeroReq = $eachRow['numero_requisicao'];
                                    $arID = $eachRow['armazem_id'];
                                    $sql2 = mysqli_query($conn, "SELECT * FROM cliente WHERE id='$cliID'");
                                    $sql3 = mysqli_fetch_array($sql2);
                                    $nomeCliente = $sql3['nome'];
                                    $sql4 = mysqli_query($conn, "SELECT * FROM armazem WHERE id='$arID'");
                                    $sql5 = mysqli_fetch_array($sql4);
                                    $nomeArmazem = $sql5['nome'];
                                    $sql6 = mysqli_query($conn, "SELECT * FROM artigo WHERE id='$getArtigo'");
                                    $sql7 = mysqli_fetch_array($sql6);
                                    $refArtigo = $sql7['referencia'];
                                    echo '<tr>';
                                    echo '<td>' . $nomeCliente . '</td>';
                                    echo '<td style="width:25%">' . $timeRN . '</td>';
                                    echo '<td style="width:15%">' . $qtPal . '</td>';
                                    echo '<td>' . $refArtigo . '</td>';
                                    echo '<td>' . $nomeArmazem . '</td>';
                                    ?>
                                    <!-- <td><input type="submit" name="Ola" ></td> -->
                                    <td><button type="submit" class="btn btn-primary" name="GuiaID" value="<?php echo $GuiaID ?>">PDF</button></td>
                                    <?php
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div>
</body>

</html>
<script>
    $("#guia").on("change", function() {
        $.ajax({
            url: 'ajaxDevolucao.php',
            type: 'POST',
            data: {
                id: $("#guia").val()
            },
            success: function(data) {
                $("#pdf").css({
                    'display': 'block'
                })
                $("#tabela").html(data);
            },
        });
    });
</script>