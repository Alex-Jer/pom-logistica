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

<body>
    <div class="container">
        <div class="card card-container" style="text-align:center; width:100%; max-width: 1000px">
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="pdfDevolucao.php" method="post">
                <div style="text-align:center">
                    <h1 style="margin-bottom:1rem;">Guia de devolução</h1>
                    <div class="container">
                        <table class="table" style="font-size:16px;">
                            <thead>
                                <tr>
                                    <th width="20%">Cliente</th>
                                    <th width="25%">Dia e hora da carga</th>
                                    <th width="17%">Nº de paletes</th>
                                    <th width="20%">Artigo</th>
                                    <th width="30%">Armazém</th>
                                    <th width="20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dado = mysqli_query($conn, "SELECT guia.id as idg,guia.artigo_id,guia.cliente_id,guia.numero_paletes, guia.data_prevista, guia.numero_requisicao,guia.armazem_id, guia.confirmar, guia.confirmarTotal, cliente.nome as clientenome ,armazem.nome as armazemnome,artigo.referencia as artigoreef FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id WHERE tipo_guia_id=4 ");
                                foreach ($dado as $eachRow) {
                                    $GuiaID=$eachRow['idg'];
                                    $qtPal=$eachRow['numero_paletes'];
                                    $numeroReq=$eachRow['numero_requisicao'];
                                    $nomeArmazem= $eachRow['armazemnome'];
                                    $nomeCliente = $eachRow['clientenome'];
                                    $refArtigo = $eachRow['artigoreef'];
                                    $timeRN = $eachRow['data_prevista'];
                                    echo '<tr>';
                                    echo '<td>' . $nomeCliente . '</td>';
                                    echo '<td>' . $timeRN . '</td>';
                                    echo '<td>' . $qtPal . '</td>';
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
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>

</html>
