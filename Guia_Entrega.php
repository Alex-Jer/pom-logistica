<!DOCTYPE html>
<html lang="pt">
<script type="text/javascript" src="jquery.js"></script>
<?php
session_start();
include 'navbarLogin.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeCli = $_POST["comboboxCli"];
    $dataEntrega = $_POST["dataentrega"];
    $getCBtg = $_POST["comboboxTipoGuia"];
    $getCBart = $_POST["comboboxArtigo"];
    $getQT = $_POST["qt"];
    $getCBtp = $_POST["comboboxTipo_Palete"];
    $getCBtz = $_POST["comboboxTipoZona"];
    $getREQ = $_POST["req"];

    $busca = mysqli_query($conn, "SELECT * FROM tipo_palete WHERE id='$getCBtp'");
    $dado = mysqli_fetch_array($busca);
    $nome = $dado['nome'];
    $nome2 = $dado['id'];

    $busca2 = mysqli_query($conn, "SELECT * FROM zona WHERE tipo_zona_id='$nome2'");
    $dado2 = mysqli_fetch_array($busca2);
    $idZona = $dado2['id'];
    $espcZona = $dado2['espaco'];
    $nomeZona = $dado2['nome'];

    $sql = "INSERT INTO guia (cliente_id, tipo_guia_id, tipo_palete_id, tipo_zona_id,data_prevista,numero_paletes, numero_requisicao) VALUES ($nomeCli, $getCBtg,$getCBtp, $getCBtz, '$dataEntrega', $getQT,$getREQ)";
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
/*header("Location: menu.php");*/
exit;
}

?>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <meta http-equiv="refresh" content="1"> -->
    <title>Menu</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="card card-container">
            <form class="form-signin" action="Guia_Entrega.php" method="post">
                <h1 style="text-align:center">Guia de entrega</h1>
                <br>
                <div style="text-align:center">
                    <select class="form-control" name="comboboxCli" style="text-align-last:center">
                        <option value="" disabled selected>Cliente</option>
                        <?php
                        $busca = mysqli_query($conn, "SELECT * FROM cliente");
                        foreach ($busca as $eachRow) {
                            ?>
                            <option value=" <?php echo $eachRow['id'] ?>" <?php echo (isset($_POST['comboboxCli']) && $_POST['comboboxCli'] == $eachRow['id']) ? 'selected="selected"' : ''; ?>><?php echo $eachRow['nome'] ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    <br>
                    <select class="form-control" name="comboboxTipoGuia" style="text-align-last:center; margin-top:-5%">
                        <option value="" disabled selected>Tipo de guia</option>
                        <?php
                        $busca = mysqli_query($conn, "SELECT * FROM tipo_guia");
                        foreach ($busca as $eachRow) {
                            ?>
                            &nbsp;
                            <option value=" <?php echo $eachRow['id'] ?>" <?php echo (isset($_POST['comboboxTipoGuia']) && $_POST['comboboxTipoGuia'] == $eachRow['id']) ? 'selected="selected"' : ''; ?>><?php echo $eachRow['nome'] ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    <br>
                    <!-- <input type="input" id="inputGuia" name="Nguia" class="form-control" placeholder="Nº de guia" required autofocus> -->
                    <input style="text-align-last:center; margin-top:-5%;" class="form-control" type="text" onfocus="(this.type='datetime-local')" class="textbox-n" id="inputdata" name="dataentrega" placeholder="Data" required>
                    <select class="form-control" name="comboboxArtigo" style="text-align-last:center; margin-top:5%">
                        <option value="" disabled selected>Referência</option>
                        <?php
                        $busca = mysqli_query($conn, "SELECT * FROM artigo");
                        foreach ($busca as $eachRow) {
                            ?>
                            &nbsp;
                            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['referencia'] ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    <br>
                    <select class="form-control" name="comboboxTipo_Palete" id="TipoPalete" style="text-align-last:center; margin-top:-5%">
                        <option value="" disabled selected>Tipo de paletes</option>
                        <?php
                        $busca = mysqli_query($conn, "SELECT * FROM tipo_palete");
                        foreach ($busca as $eachRow) {
                            ?>
                            <option value=" <?php echo $eachRow['id'] ?>" <?php echo (isset($_POST['comboboxTipo_Palete']) && $_POST['comboboxTipo_Palete'] == $eachRow['id']) ? 'selected="selected"' : ''; ?>><?php echo $eachRow['nome'] ?></option>

                            <?php
                            echo $eachRow['nome'];
                        }
                        ?>
                    </select>
                    <br>
                    <input style="text-align-last:center; margin-top:-5%" type="number" id="uintTextBox" name="qt" class="form-control" placeholder="Quantidade de paletes neste artigo" value="<?php echo $_POST['qt']; ?>" required>
                    <br>
                    <select class="form-control" name="comboboxTipoZona" id="TipoZona" style="text-align-last:center; margin-top:-5%">
                        <option value="" disabled selected>Tipo de zona</option>
                        <?php
                        $busca = mysqli_query($conn, "SELECT * FROM tipo_zona");
                        foreach ($busca as $eachRow) {
                            ?>
                            <option value=" <?php echo $eachRow['id'] ?>" <?php echo (isset($_POST['comboboxTipo_Palete']) && $_POST['comboboxTipo_Palete'] == $eachRow['id']) ? 'selected="selected"' : ''; ?>><?php echo $eachRow['nome'] ?></option>

                            <?php
                            echo $eachRow['nome'];
                        }
                        ?>
                    </select>
                    <br>
                    <input type="number" id="uintTextBox" name="req" class="form-control" style="text-align-last:center; margin-top:-6%" placeholder="Numero de requisição" value="<?php echo htmlspecialchars($_POST['req']); ?>" required>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        ?>
                        <p><?php echo  "Existe ", $espcZona, " espaços na ", $nomeZona ?></p>
                    <?php
                }
                ?>
                </div>
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Confirmar</button>
            </form><!-- /form -->
        </div>
    </div>

    <script>
        function setInputFilter(textbox, inputFilter) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
                textbox.addEventListener(event, function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    }
                });
            });
        }

        setInputFilter(document.getElementById("uintTextBox"), function(value) {
            return /^\d*$/.test(value);
        });
    </script>

</body>

</html>
<script>
    $("#TipoPalete").on("change", function() {
        $.ajax({
            url: 'ajaxEntrega.php',
            type: 'POST',
            data: {
                id: $("#TipoPalete").val()
            },
            success: function(data) {

                $("#TipoZona").html(data);
            },
        });
    });
</script>