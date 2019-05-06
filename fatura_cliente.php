<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarLogin.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST["cliente"];
}
?>

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="">
    <meta charset="utf-8">
    <link rel="stylesheet" href="node_modules\bootstrap3\dist\css\bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="card card-container" style="text-align:center; width:100%; max-width: 100000px">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="fatura_cliente.php" method="post">
                <div style="text-align:center">
                    <h1>Fatura mensal</h1>
                    <br>
                    <div class="container">
                        <div style="text-align:center">
                            <select name="cliente" style="text-align-last:center; width:40" onchange="this.form.submit()">
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
                        <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Preço por palete / zona</th>
                                    <th>Preço de carga</th>
                                    <th>Preço de descarga</th>
                                    <th>Total</th>
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