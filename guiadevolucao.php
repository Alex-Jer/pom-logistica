<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
    include 'navbarLogin.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST["cliente"];
    $tipopalete = $_POST["tipopalete"];
    $tipozona = $_POST["tipozona"];
    $data = $_POST["data"];
    $npaletes = $_POST["npaletes"];
    $nrequisicao = $_POST["nrequisicao"];
    $morada = $_POST["morada"];
    $localidade = $_POST["localidade"];
    $matricula = $_POST["matricula"];
    $sql  = "INSERT INTO guia (cliente_id, tipo_palete_id, tipo_zona_id, data_prevista, numero_paletes, numero_requisicao, morada, localidade, matricula) VALUES ('$cliente', '$tipopalete', '$tipozona', '$data', '$npaletes', '$nrequisicao', '$morada', '$localidade', '$matricula')";
    if (mysqli_query($conn, $sql)) {
?>
<script type="text/javascript">;
    alert("New record created successfully"); 
</script>
<?php
    } 
    else {
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
        <form class="form-signin" action="guiadevolucao.php" method="post">
            <span id="reauth-email" class="reauth-email"></span>
            <div style="text-align:center">
                <h1>Devolução</h1>
                <br>
                <select name="cliente" style="text-align-last:center">
                    <option value="" disabled selected>Cliente</option>
                    <?php
                        $busca = mysqli_query($conn,"SELECT * FROM cliente");
                        foreach ($busca as $eachRow)
                        {
                    ?>
                        <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <br>
            <div style="text-align:center">
                <select name="tipopalete" style="text-align-last:center">
                    <option value="" disabled selected>Tipo de paletes</option>
                    <?php
                        $busca = mysqli_query($conn,"SELECT * FROM tipo_palete");
                        foreach ($busca as $eachRow)
                        {  
                    ?>
                            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <br>
            <div style="text-align:center">
                <select name="tipozona" style="text-align-last:center">
                    <option value="" disabled selected>Tipo de zona</option>
                    <?php
                        $busca = mysqli_query($conn,"SELECT * FROM tipo_zona");
                        foreach ($busca as $eachRow)
                        {
                    ?>
                            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div style="text-align:center">
                <br>
                <input placeholder="Data" style="text-align:center" name="data" class="textbox-n" type="text" onfocus="(this.type='datetime-local')"  id="date">
            </div>
            <div style="text-align:center">
                <br>
                <input type="number" name="npaletes" placeholder="Número de paletes" min=0 style="text-align:center">
            </div>
            &nbsp;
            <div style="text-align:center">
                    <input type="input" name="nrequisicao" placeholder="Número de requisição" style="text-align:center"  required>
                    <br>
            </div>
            <div style="text-align:center">
                <br>
                <form class="form-signin" action="cliente.php" method="post">
                <input type="input" id="inputMorada" name="morada" placeholder="Morada" style="text-align:center"  required>
            </div>
            &nbsp;
            <div style="text-align:center">
                    <input type="input" name="localidade" placeholder="Localidade" style="text-align:center"  required>
                    <br>
            </div>
            &nbsp;
            <div style="text-align:center">
                    <input type="input" name="matricula" placeholder="Matrícula" style="text-align:center"  required>
                    <br>
            </div>
            &nbsp;
            <div style="text-align:center">
                <select name="artigo" style="text-align-last:center">
                    <option value="" disabled selected>Artigo</option>
                    <?php
                        $busca = mysqli_query($conn,"SELECT * FROM artigo");
                        foreach ($busca as $eachRow)
                        {
                    ?>
                        <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <br>
            <button type="submit">Confirmar</button>
        </form><!-- /form -->
    </div><!-- /card-container -->
</div><!-- /container -->
<script type="text/javascript"></script>
<script type="text/javascript"></script>
</body>
</html>
    