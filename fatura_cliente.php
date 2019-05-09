<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
//include 'navbarLogin.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST["cliente"];
}
?>

<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.7.0/d3.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav role="navigation">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="navbarLogin.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Guias</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="Guia_Entrega.php">Entrega</a>
                    <a class="dropdown-item" href="Guia_Operador_admin.php">Operador</a>
                    <a class="dropdown-item" href="Guia_Transporte.php">Transporte</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registar_cliente.php">Registar Cliente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registar_utilizador.php">Registar Utilizador</a></li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mudarpass_admin.php">Mudar Palavra-Passe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listagem_pedidos_armazem_admin.php">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="fatura_cliente.php">Fatura</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Sair</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="card card-container" style="text-align:center; width:100%; max-width: 100000px">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="fatura_cliente.php" method="post">
                <div style="text-align:center">
                    <h1 style="margin-bottom:2rem;">Fatura mensal</h1>
                    <div class="container">
                        <div style="text-align:center; margin-bottom:2rem;">
                            <select class="form-control" name="cliente" style="text-align-last:center; width:18.7rem; margin-left:auto; margin-right:auto; margin-bottom:1rem;" onchange="this.form.submit()">
                                <option value="" disabled selected>Cliente</option>
                                <?php
                                $busca = mysqli_query($conn, "SELECT * FROM cliente");
                                foreach ($busca as $eachRow) {
                                    ?>
                                    <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width:30%">Preço por palete / zona</th>
                                    <th style="width:20%">Preço de carga</th>
                                    <th style="width:20%">Preço de descarga</th>
                                    <th style="width:20%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($cliente)) {
                                    $query = mysqli_query($conn, "SELECT * FROM guia WHERE cliente_id='$cliente'");
                                    //$precoZona = 10;
                                    $taxaCarga = 10;
                                    $taxaDescarga = 10;

                                    foreach ($query as $eachRow) {
                                        $clienteId = $eachRow['cliente_id'];
                                        $sql2 = mysqli_query($conn, "SELECT * FROM cliente WHERE id='$clienteId'");
                                        $sql3 = mysqli_fetch_array($sql2);

                                        $numReq = $eachRow['numero_requisicao'];
                                        $numPaletes = $eachRow['numero_paletes'];
                                        $dataCarga = $eachRow['data_carga'];
                                        $dataPrevistaDescarga = $eachRow['data_prevista'];
                                        $tipozonaId = $eachRow['tipo_zona_id'];
                                        $armazemId = $eachRow['armazem_id'];

                                        $sql4 = mysqli_query($conn, "SELECT * FROM zona WHERE id='$tipozonaId'");
                                        $sql5 = mysqli_fetch_array($sql4);
                                        $precoZona = $sql5['preco_zona'];

                                        $sql6 = mysqli_query($conn, "SELECT * FROM armazem WHERE id='$armazemId'");
                                        $sql7 = mysqli_fetch_array($sql6);
                                        $custoCarga = $sql7['custo_carga'];
                                        $custoDescarga = $sql7['custo_descarga'];

                                        $datetime1 = new DateTime($dataPrevistaDescarga);
                                        $datetime2 = new DateTime($dataCarga);
                                        $intervalo = date_diff($datetime2, $datetime1);
                                        $diasArmazenamento = $intervalo->format('%a');

                                        $result = $conn->query("SELECT count(*) FROM guia WHERE tipo_guia_id=1 AND numero_requisicao='$numReq'");
                                        $row = $result->fetch_row();
                                        $count = $row[0];

                                        $result = $conn->query("SELECT count(*) FROM guia WHERE tipo_guia_id=2 AND numero_requisicao='$numReq'");
                                        $row = $result->fetch_row();
                                        $count2 = $row[0];
                                        ?>
                                        <tr>
                                            <td><?php echo $precoZona * $numPaletes * $diasArmazenamento . " €" ?></td>
                                            <td><?php echo $custoCarga * $count . " €" ?></td>
                                            <td><?php echo $custoDescarga * $count2 . " €" ?></td>
                                            <td><?php echo ($custoCarga * $count) + ($custoDescarga * $count2) . " €" ?></td>
                                        </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <!--<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Confirmar</button>-->
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script type="text/javascript"></script>
    <script type="text/javascript"></script>
</body>

</html>