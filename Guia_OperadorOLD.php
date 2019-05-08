<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'db.php';
include 'operador.php';
$count = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST["cliente"];
    $nrequisicao = $_POST["nrequisicao"];
    $morada = $_POST["morada"];
    $data = $_POST["data"];
    $artigo = $_POST["artigo"];
    $npaletes = $_POST["npaletes"];
    //echo "cliente: $cliente , nreq: $nrequisicao , morada: $morada , data: $data , artigo: $artigo , npaletes: $npaletes";
    $sql = "INSERT INTO guia (cliente_id, tipo_guia_id, data_prevista, numero_paletes, numero_requisicao, morada) VALUES ('$cliente', 2, '$data', '$npaletes', '$nrequisicao', '$morada')";
    if (mysqli_query($conn, $sql)) {
        ?>
        <script type="text/javascript">
            alert("New record created successfully");
        </script>
    <?php
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql2 = mysqli_query($conn, "SELECT * FROM guia WHERE numero_requisicao='$nrequisicao'");
$sql3 = mysqli_fetch_array($sql2);
$sql4 = $sql3['numero_paletes'];
$sql5 = $sql3['artigo_id'];
$sql6 = mysqli_query($conn, "SELECT * FROM palete WHERE artigo_id='$artigo' ORDER BY Data ASC");
//$sql7 = mysqli_query($conn, "DELETE FROM palete WHERE artigo_id='$sql5' ORDER BY Data ASC LIMIT $npaletes");
foreach ($sql6 as $eachRow2) {
    $count++;
    if ($count <= $npaletes) {
        echo $count;
        $paleteId = $eachRow2['id'];
        $sql10 = mysqli_query($conn, "UPDATE localizacao SET hasPalete = 0, palete_id = NULL, zona_id = NULL, data_entrada = NULL WHERE palete_id=$paleteId ORDER BY data_entrada ASC LIMIT $npaletes"); 
        if (mysqli_query($conn, $sql10)) {
            ?>
                <script type="text/javascript">
                    alert("New record created successfully");
                </script>
            <?php
        }
    }
}
}
?>

<head>
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
</head>

<body>
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="Guia_Operador.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <div style="text-align:center">
                    <h1>Guia do operador</h1>
                    <br>
                    <select class="form-control" name="cliente" style="text-align-last:center">
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
                &nbsp;
                <div style="text-align:center">
                    <input class="form-control" class="form-control" type="input" name="nrequisicao" placeholder="Número de requisição" style="text-align:center; margin-top:-5%" required>
                </div>
                <div style="text-align:center">
                    <br>
                    <form class="form-signin" method="post">
                        <input class="form-control" type="input" id="inputMorada" name="morada" placeholder="Morada de entrega" style="text-align:center; margin-top:-5%" required>
                </div>
                <div style="text-align:center">
                    <br>
                    <input class="form-control" placeholder="Data e hora prevista de recolha" style="text-align:center; margin-top:-5%" name="data" class="textbox-n" type="text" onfocus="(this.type='datetime-local')" id="date">
                </div>
                <br>
                <div style="text-align:center">
                    <select class="form-control" name="artigo" style="text-align-last:center; margin-top:-8.5%">
                        <option value="" disabled selected>Artigo</option>
                        <?php
                        $busca = mysqli_query($conn, "SELECT * FROM artigo");
                        foreach ($busca as $eachRow) {
                            ?>
                            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['referencia'] ?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div style="text-align:center">
                    <br>
                    <input class="form-control" type="number" name="npaletes" placeholder="Número de paletes" min=0 style="text-align:center; margin-top:-5%">
                </div>
                &nbsp;
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Confirmar</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script type="text/javascript"></script>
    <script type="text/javascript"></script>
</body>

</html>