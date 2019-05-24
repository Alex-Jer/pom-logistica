<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarAdmin.php';
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
    $nreq="REQ-$nreq";


    
        $stmt = $conn->prepare("SELECT palete.tipo_palete_id as tipo_palete_id, palete.id as id, localizacao.zona_id as zona_id, zona.armazem_id as armazem_id, zona.tipo_zona_id as tipo_zona_id FROM palete INNER JOIN localizacao on localizacao.palete_id=palete.id INNER JOIN zona on zona.id=localizacao.zona_id WHERE artigo_id=?");
        $stmt->bind_param("s", $artigoo);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($tipoPalete, $paleteeID, $zonaID,$armazemID,$tipoZona);
        $stmt->fetch();
    //echo $armazemID;

    $stmt = $conn->prepare("INSERT INTO guia (cliente_id, tipo_guia_id, tipo_palete_id, tipo_zona_id, armazem_id, artigo_id, data_prevista, numero_paletes, numero_requisicao, morada, localidade, matricula) VALUES (?,2,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("iiiiisissss", $cliente, $tipoPalete, $tipoZona, $armazemID, $artigoo, $horadescarga, $npal,$nreq, $morada, $Localidade, $matricula);
    $stmt->execute();
}


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles\style3.css">
    <link rel="stylesheet" href="css\bootstrap.css">
</head>

<style>
    #size {
        font-size: 16px;
    }
</style>

<body>
    <div class="container">
        <div class="card card-container" style="max-width:250%; width:60%; margin-top:3rem;">
            <form style="text-align:center" action="Guia_Transporte.php" method="post">
                <h1>Guia de transporte</h1>
                <select name="cliente" class="form-control" style="text-align-last:center; margin-top:1rem; color: #6C757D; height:auto; font-size:14px" id="clienteCBID">
                    <option value="" disabled selected>Cliente</option>
                    <?php
                    $busca = mysqli_query($conn, "SELECT id,nome FROM cliente");
                    foreach ($busca as $eachRow) {
                        ?>
                        <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                    <?php
                }
                ?>
                </select>
                <select class="form-control" name="artigo" style="text-align-last:center; margin-top:1rem; color: #6C757D; height:auto;" id="artigoseID">
                    <option value="" disabled selected>Artigo</option>
                </select>
                <input class="form-control" type="input" name="matricula" placeholder="Matrícula do transporte" style="text-align:center; margin-top:1rem; height:auto;" id="size" required>
                <input class="form-control" placeholder="Hora prevista" style="text-align:center; margin-top:1rem; height:auto;" name=" horadescarga" class="textbox-n" type="text" onfocus="(this.type='datetime-local')" id="size">
                <div style="text-align:center;" class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="height:2.35rem; margin-top:0.7rem; height:auto;" id="size">REQ-</span>
                    </div>
                    <input type="text" class="form-control" style="width:5rem; margin-top:0.7rem; height:auto;" placeholder="Número de requisição" name="Referencia" id="size" required>
                </div>
                <input class="form-control" type="number" id="inputNPaletes" name="NPaletes" placeholder="Numero de Paletes" style="text-align:center; margin-top:1rem; height:auto; font-size:14px" required>
                <input class="form-control" type="input" id="inputMorada" name="morada" placeholder="Morada" style="text-align:center; margin-top:1rem; height:auto; font-size:14px" required>
                <input class="form-control" type="input" id="inputLocalidade" name="Localidade" placeholder="Localidade" style="text-align:center; margin-top:1rem; height:auto; font-size:14px" required>
                <button style="margin-top:1rem; margin-left:auto; margin-right:auto; width:36.7rem; height:auto; font-size:14px" type="submit" class="btn btn-primary">Confirmar</button>
            </form><!-- /form -->
        </div>
    </div>
</body>

</html>
<script>
    $("#artigoID").on("change", function() {
        $.ajax({
            url: 'Ajax/ajaxMaxGuiaT.php',
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

<script>
  $("#clienteCBID").on("change", function() {
    $.ajax({
      url: 'Ajax/ajaxaArtigoCliente.php',
      type: 'POST',
      data: {
        id: $("#clienteCBID").val()
      },
      success: function(data) {
        $("#artigoseID").html(data);

      },
    });
  });
</script> 