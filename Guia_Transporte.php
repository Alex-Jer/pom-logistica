<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
//include 'navbarLogin.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST['cliente'];
    $matricula = $_POST["matricula"];
    $horadescarga = $_POST["horadescarga"];
    $morada = $_POST["morada"];
    $nreq = $_POST["Referencia"];
    $npal = $_POST["NPaletes"];
    $artigoo = $_POST["artigo"];
    $Localidade = $_POST["Localidade"];


    $sqlArtigo = mysqli_query($conn, "SELECT * FROM palete WHERE artigo_id='$artigoo'");
    $sql3 = mysqli_fetch_array($sqlArtigo);
    $tipoPalete = $sql3['tipo_palete_id'];
    $paleteeID = $sql3['id'];
    echo $paleteeID;


    $sqlLocalizacao = mysqli_query($conn, "SELECT * FROM localizacao where palete_id='$paleteeID'");
    $sql4 = mysqli_fetch_array($sqlLocalizacao);
    $zonaID = $sql4['zona_id'];
    echo $zonaID;

    $sqlZona = mysqli_query($conn, "SELECT * from zona WHERE id='$zonaID'");
    $sql5 = mysqli_fetch_array($sqlZona);
    $armazemID = $sql5['armazem_id'];
    $tipoZona = $sql5['tipo_zona_id'];
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav role="navigation">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="navbarLogin.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Guias</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="Guia_Entrega.php">Entrega</a>
                    <a class="dropdown-item" href="Guia_Operador.php">Operador</a>
                    <a class="dropdown-item active" href="Guia_Transporte.php">Transporte</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registar_cliente.php">Registar Cliente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registar_utilizador.php">Registar Utilizador</a></li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mudarpass.php">Mudar Palavra-Passe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listagem_pedidos_armazem_admin.php">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="fatura_cliente.php">Fatura</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Sair</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="card card-container" style="max-width:250%; width:60%; margin-top:3rem;">
            <form style="text-align:center" action="Guia_Entrega.php" method="post">
                <h1>Guia de transporte</h1>
                <select class="form-control" name="cliente" style="border-color:#ced4da; text-align-last:center; width:80%; height:70%; margin-right:auto; margin-left:auto; margin-top:2rem; font-size:1.5rem; color: #6C757D;">
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
                <select class="form-control" name="artigo" style="border-color:#ced4da; text-align-last:center; width:80%; height:70%; margin-right:auto; margin-left:auto; margin-top:1rem; font-size:1.5rem; color: #6C757D;" id="artigoID">
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
                <input class="form-control" type="input" name="matricula" placeholder="Matrícula do transporte" style="text-align:center; margin-top:2%; max-height:200px; height:3.2rem; width:46.8rem; margin-left:5.8rem; font-size:1.5rem" required>
                <input class="form-control" placeholder="Hora prevista" style="text-align:center; margin-top:2%; max-height:200px; height:3.2rem; width:46.8rem; margin-left:5.8rem; font-size:1.5rem" name=" horadescarga" class="textbox-n" type="text" onfocus="(this.type='datetime-local')" id="date">
                <div style="text-align:center; margin-top:2%; max-height:200px; height:3.2rem; width:46.8rem; margin-left:5.8rem; font-size:1.5rem" class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-lg" style="font-size:1.3rem">REQ-</span>
                    </div>
                    <input style="height:3.2rem; font-size:1.5rem;" type="text" class="form-control" placeholder="Número de requisição" name="Referencia" required>
                </div>
                <input class="form-control" type="number" id="inputNPaletes" name="NPaletes" placeholder="Numero de Paletes" style="text-align:center; margin-top:2%; max-height:200px; height:3.2rem; width:46.8rem; margin-left:5.8rem; font-size:1.5rem" required>
                <input class="form-control" type="input" id="inputMorada" name="morada" placeholder="Morada" style="text-align:center; margin-top:2%; max-height:200px; height:3.2rem; width:46.8rem; margin-left:5.8rem; font-size:1.5rem" required>
                <input class="form-control" type="input" id="inputLocalidade" name="Localidade" placeholder="Localidade" style="text-align:center; margin-top:2%; max-height:200px; height:3.2rem; width:46.8rem; margin-left:5.8rem; font-size:1.5rem" required>
                <input class="form-control" type="number" id="inputqt" name="qt" placeholder="Quantidade de paletes neste artigo" style="text-align:center; margin-top:2%; max-height:200px; height:3.2rem; width:46.8rem; margin-left:5.8rem; font-size:1.5rem" required>
                <button style="margin-top:3%; font-size:1.5rem" type="submit" class="btn btn-warning">Confirmar</button>
            </form><!-- /form -->
        </div>
    </div>
</body>

</html>
<script>
    $("#artigoID").on("change", function() {
        $.ajax({
            url: 'ajaxMaxGuiaT.php',
            type: 'POST',
            data: {
                id: $("#artigoID").val()
            },
            success: function(data) {
                document.getElementById("inputNPaletes").setAttribute("max", data);
            },
        });
    });
</script>