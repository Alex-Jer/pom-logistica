<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
//include 'navbarLogin.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (mysqli_query($conn, $sql)) {
        ?>
        <script type="text/javascript">
            alert("New record created successfully");
        </script>
    <?php
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
//header("Location: navbarLogin.php");
exit;
}
?>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<nav role="navigation">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="operador.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Guia_Operador_operador.php">Guia do Operador</a></li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="showGuiaEntrega.php">Registar Palete</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mudarpass_operador.php">Mudar Palavra-Passe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="listagem_pedidos_armazem_operador.php">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Guia_Rececao.php">Imprimir Receção</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Guia_Devolucao.php">Imprimir Devolução</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Sair</a>
            </li>
        </ul>
    </nav>
    <div class="container" style="margin-left: auto; margin-right:auto;">
        <div class="card card-container" style="max-width:none">
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="listagem_pedidos_armazem_operador.php" method="post">
                <div style="text-align:center">
                    <h1>Pedidos do dia</h1>
                    <div class="container" style="margin-left:auto; margin-right:auto;">
                        <table class="table" style="margin-left:auto; margin-right:auto;">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Número de requisição</th>
                                    <th>Armazém</th>
                                    <th>Número de paletes</th>
                                    <th>Data e hora prevista</th>
                                    <th>Data e hora de carga</th>
                                    <th>Morada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                date_default_timezone_set("Europe/Lisbon");
                                $timeRN = date("Y-m-d");
                                $query = mysqli_query($conn, "SELECT * FROM guia WHERE tipo_guia_id = 2 AND DATE(data_prevista)='$timeRN' ORDER BY data_carga ASC");
                                foreach ($query as $eachRow) {
                                    $clienteId = $eachRow['cliente_id'];
                                    $numReq = $eachRow['numero_requisicao'];
                                    $armazem = $eachRow['armazem_id'];
                                    $numPaletes = $eachRow['numero_paletes'];
                                    $dataPrevista = $eachRow['data_prevista'];
                                    $dataCarga = $eachRow['data_carga'];
                                    $morada = $eachRow['morada'];
                                    $sql2 = mysqli_query($conn, "SELECT * FROM cliente WHERE id='$clienteId'");
                                    $sql3 = mysqli_fetch_array($sql2);
                                    $nomeCliente = $sql3['nome'];
                                    $sql4 = mysqli_query($conn, "SELECT * FROM armazem WHERE id='$armazem'");
                                    $sql5 = mysqli_fetch_array($sql4);
                                    $nomeArmazem = $sql5['nome'];
                                    ?>
                                    <tr>
                                        <td><?php echo $nomeCliente ?></td>
                                        <td><?php echo $numReq ?></td>
                                        <td><?php echo $nomeArmazem ?></td>
                                        <td><?php echo $numPaletes ?></td>
                                        <td><?php echo $dataPrevista ?></td>
                                        <td><?php echo $dataCarga ?></td>
                                        <td><?php echo $morada ?></td>
                                    </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script type="text/javascript"></script>
    <script type="text/javascript"></script>
</body>

</html>