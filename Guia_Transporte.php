<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarLogin.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST['cliente'];
    $matricula = $_POST["matricula"];
    $horadescarga = $_POST["horadescarga"];
    $morada = $_POST["morada"];
    $nreq = $_POST["Refrencia"];
    $npal=$_POST["NPaletes"];
    $artigoo=$_POST["artigo"];
    $Localidade=$_POST["Localidade"];

    
    $sqlArtigo = mysqli_query($conn, "SELECT * FROM palete WHERE artigo_id='$artigoo'");
    $sql3 = mysqli_fetch_array($sqlArtigo);
    $tipoPalete=$sql3['tipo_palete_id'];
    $paleteeID=$sql3['id'];
    echo $paleteeID;


    $sqlLocalizacao=mysqli_query($conn,"SELECT * FROM localizacao where palete_id='$paleteeID'");
    $sql4= mysqli_fetch_array($sqlLocalizacao);
    $zonaID=$sql4['zona_id'];
    echo $zonaID;

    $sqlZona=mysqli_query($conn,"SELECT * from zona WHERE id='$zonaID'");
    $sql5=mysqli_fetch_array($sqlZona);
    $armazemID=$sql5['armazem_id'];
    $tipoZona =$sql5['tipo_zona_id'];
    echo $armazemID;


    $sql = "INSERT INTO guia (cliente_id, tipo_guia_id, tipo_palete_id, tipo_zona_id,armazem_id,artigo_id, data_prevista, numero_paletes, numero_requisicao, morada,localidade, matricula) VALUES ($cliente, 2,$tipoPalete, $tipoZona ,$armazemID,$artigoo,'$horadescarga','$npal','$nreq','$morada','$Localidade', '$matricula')";
    if (mysqli_query($conn, $sql)) {
        ?>
        <script type="text/javascript">
            alert("New record created successfully");
        </script>
    <?php
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
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
        <div class="card card-container">
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="Guia_Transporte.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <div style="text-align:center">
                    <h1>Guia de transporte</h1>
                    <br>
                    <div style="text-align:center">
                        <select class="form-control" name="cliente" style="text-align-last:center; margin-top:-5%">
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
                    
                    <div style="text-align:center">
                        <select class="form-control" name="artigo" style="text-align-last:center; margin-top:-5%" id="artigoID">
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
                     <br>
                    <div style="text-align:center">
                        <input class="form-control" type="input" name="matricula" placeholder="Matrícula do transporte" style="text-align:center; margin-top:-5%" required>
                        <br>
                    </div>
                    
                    <div style="text-align:center">
                        <br>
                        <input class="form-control" placeholder="Hora prevista" style="text-align:center; margin-top:-8.5%" name="horadescarga" class="textbox-n" type="text" onfocus="(this.type='datetime-local')" id="date">
                    </div>
                    <div style="text-align:center">
                        <br>
                        <input class="form-control" type="input" id="inputReferencia" name="Refrencia" placeholder="Referencia" value="REQ-" style="text-align:center; margin-top:-%" required>
                    </div>
                    <div style="text-align:center">
                        <br>
                        <input class="form-control" type="number" id="inputNPaletes" name="NPaletes" placeholder="Numero de Paletes" style="text-align:center; margin-top:-%" required>
                    </div>
                    <div style="text-align:center">
                        <br>
                        <form class="form-signin" method="post">
                            <input class="form-control" type="input" id="inputMorada" name="morada" placeholder="Morada" style="text-align:center; margin-top:-%" required>
                    </div>
                    <div style="text-align:center">
                        <br>
                        <form class="form-signin" method="post">
                            <input class="form-control" type="input" id="inputLocalidade" name="Localidade" placeholder="Localidade" style="text-align:center; margin-top:-%" required>
                    </div>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Confirmar</button>
                </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script type="text/javascript"></script>
    <script type="text/javascript"></script>
</body>

</html>
<script>
$("#artigoID").on("change",function(){
  $.ajax({
			url: 'ajaxMaxGuiaT.php',
			type: 'POST',
			data:{id:$("#artigoID").val()},
			success: function(data)
			{
        document.getElementById("inputNPaletes").setAttribute("max", data);
			},
		});
});
</script>