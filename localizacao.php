<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarAdmin.php';
$i = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $referencia = $_POST["referencia"];
    $tipopalete = $_POST["combobox2"];
    $zona = $_POST["combobox3"];
    $dataentrada = $_POST["entrada"];
    $datasaida = $_POST["saida"];
    $sql = "INSERT INTO localizacao (palete_id, zona_id, referencia, data_entrada, data_saida) VALUES ('$tipopalete', '$zona', '$referencia', '$dataentrada', '$datasaida')";
    if (mysqli_query($conn, $sql)) { } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    //header("Location: navbarAdmin.php");
    exit;
}

?>

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="">
    <meta charset="utf-8">
    <link rel="stylesheet" href="node_modules\bootstrap3\dist\css\bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="jquery.js"></script>

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
        <div class="card card-container w-auto p-3">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->

            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="localizacao.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <div style="text-align:center">
                    <h1>Localização</h1>
                    <br>
                    <select class="form-control" name="combobox2" id="TipoPalete">
                        <option value="" disabled selected>Tipo de palete</option>
                        <?php
                        $busca = mysqli_query($conn, "SELECT id,nome FROM tipo_palete");
                        foreach ($busca as $eachRow) {
                            ?>
                            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    <br>
                    <div style="text-align:center">
                        <select class="form-control" name="combobox3" id="Zona">
                            <option value="" disabled selected>Zona</option>
                            <?php
                            $busca = mysqli_query($conn, "SELECT id,nome FROM zona");
                            foreach ($busca as $eachRow) {
                                ?>
                                <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div style="text-align:center">
                    <br>
                    <input class="form-control" placeholder="Referência" type=text name="referencia">
                </div>
                <div style="text-align:center">
                    <input class="form-control" style="text-align:center" type="text" onfocus="(this.type='datetime-local')" placeholder="Data de entrada" name="entrada">
                </div>
                <div style="text-align:center">
                    <input class="form-control" style="text-align:center" type="text" onfocus="(this.type='datetime-local')" placeholder="Data de saída" name="saida">
                </div>
                &nbsp;
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Confirmar</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script type="text/javascript"></script>
    <script type="text/javascript"></script>
</body>

</html>
<script>
    $("#TipoPalete").on("change", function() {
        $.ajax({
            url: 'Ajax/ajaxLocal.php',
            type: 'POST',
            data: {
                id: $("#TipoPalete").val()
            },
            success: function(data) {

                $("#Zona").html(data);
            },
        });
    });
</script>
