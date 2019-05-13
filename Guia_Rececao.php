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
</head>

<body>
    <div class="container">
        <div class="card card-container" style="text-align:center; width:100%; max-width: 100000px">
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="pdf.php" method="post">
                <div style="text-align:center">
                    <h1 style="margin-bottom:1rem;">Guia de Receção</h1>
                    <div class="container">
                        <table class="table" style="font-size:16px; margin-top:1.5rem;">
                            <thead>
                                <tr>
                                    <th style="width:15%">Cliente</th>
                                    <th style="width:30%">Dia e hora da carga</th>
                                    <th style="width:15%">Nº de Paletes</th>
                                    <th style="width:20%">Artigo</th>
                                    <th style="width:20%">Armazém</th>
                                    <th style="width:15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $dado = mysqli_query($conn, "SELECT * FROM guia WHERE tipo_guia_id=1");
                            foreach ($dado as $eachRow) {
                                $cliID=$eachRow['cliente_id'];
                                $GuiaID=$eachRow['id'];
                                $timeRN=$eachRow['data_prevista'];
                                $getArtigo=$eachRow['artigo_id'];
                                $qtPal=$eachRow['numero_paletes'];
                                $numeroReq=$eachRow['numero_requisicao'];
                                $arID=$eachRow['armazem_id'];
                                $sql2 = mysqli_query($conn, "SELECT * FROM cliente WHERE id='$cliID'");
                                $sql3 = mysqli_fetch_array($sql2);
                                $nomeCliente = $sql3['nome'];
                                $sql4 = mysqli_query($conn, "SELECT * FROM armazem WHERE id='$arID'");
                                $sql5 = mysqli_fetch_array($sql4);
                                $nomeArmazem = $sql5['nome'];
                                $sql6 = mysqli_query($conn, "SELECT * FROM artigo WHERE id='$getArtigo'");
                                $sql7 = mysqli_fetch_array($sql6);
                                $refArtigo = $sql7['referencia'];
                                //Inacabado
                                echo '<tr>';
                                    echo '<td> '.$nomeCliente.'</td>';
                                        echo '<td> '.$timeRN.'</td>';
                                        echo '<td> '.$qtPal.'</td>';
                                        echo '<td> '.$refArtigo.'</td>';
                                        echo '<td> '.$nomeArmazem.'</td>';
                                        ?>
                                        <!-- <td><input type="submit" name="Ola" ></td> -->
                                       -
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
<script>
    $("#guia").on("change", function() {
        $.ajax({
            url: 'ajaxRececao.php',
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