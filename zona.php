<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarLogin.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guia = $_POST["combobox"];
    $armazem = $_POST["combobox2"];
    $tipozona = $_POST["combobox3"];
    $precozona = $_POST["precozona"];
    $sql  = "INSERT INTO zona (armazem_id, tipo_zona_id, nome, preco_zona) VALUES ('$armazem', '$tipozona', '$guia', '$precozona')";
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
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->

            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="zona.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <div style="text-align:center">
                    <h1>Zona</h1>
                    <br>
                    <select style="text-align-last:center" class="form-control" name="combobox">
                        <option value="" disabled selected>Tipo de palete</option>
                        <option value="altas">Paletes altas</option>
                        <option value="baias">Paletes baixas</option>
                        <option value="frio">Frio</option>
                    </select>
                    <br>
                    <select style="text-align-last:center" class="form-control" name="combobox2">
                        <option value="" disabled selected>Tipo de armazém</option>
                        <?php
                        $busca = mysqli_query($conn, "SELECT * FROM armazem");
                        foreach ($busca as $eachRow) {
                            ?>
                            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    <br>
                    <select style="text-align-last:center" class="form-control" name="combobox3">
                        <?php
                        $busca = mysqli_query($conn, "SELECT * FROM tipo_zona");
                        foreach ($busca as $eachRow) {
                            ?>
                            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div style="text-align-last:center">
                    &nbsp;
                    <input style="text-align:center" placeholder="Preço de zona" class="form-control" type="number" name="precozona" min="0">
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