<!DOCTYPE html>
<html lang="pt">
<?php
session_start();
include 'db.php';
include 'navbarAdmin.php';

/*
function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["Nome"];
    $nifNumber = $_POST["nif"];
    $nifNumberr = (int)$nifNumber;
    $Morada = $_POST["morada"];
    $localidade = $_POST["local"];

    $sql = "INSERT INTO cliente (nome,nif,morada, localidade) VALUES ('$nome',$nifNumberr,'$Morada', '$localidade')";
    if (mysqli_query($conn, $sql)) {
        ?>
        <script type="text/javascript">
            alert("New record created successfully");
        </script>
    <?php

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
} ?>


<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles\style3.css">
</head>

<body>
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
    <div class="container">
        <div class="card card-container">
            <h1 style="text-align:center; margin-left:auto; margin-right:auto; margin-bottom:2rem">Registar cliente</h1>
            <form class="form-signin" action="registar_cliente.php" method="post">
                <input style="margin-top:1rem; height:auto;" type="input" name="Nome" class="form-control" placeholder="Nome" pattern="[A-Za-z\sâàáêèééìíôòóùúçãõ ]+" title="Apenas deve conter letras." required autofocus>
                <input style="margin-top:1rem; height:auto;" type="number" id="uintTextBox" name="nif" class="form-control" placeholder="NIF" max="999999999" pattern=".{9,}" minlength=9 title="O NIF tem de ter 9 dígitos." required>
                <input style="margin-top:1rem; height:auto;" type="input" name="morada" class="form-control" placeholder="Morada" pattern="[A-Za-z0-9\sâàáêèééìíôòóùúçãõªº-;,. ]+" required>
                <input style="margin-top:1rem; height:auto;" type="input" name="local" class="form-control" placeholder="Localidade" pattern="[A-Za-z0-9\sâàáêèééìíôòóùúçãõªº-;,. ]+" pattern="[A-Za-z]+" required>
                <button style="margin-top:1rem; margin-left:auto; margin-right:auto; width:auto; height:auto;" type="submit" class="btn btn-primary">Confirmar</button>
            </form><!-- /form -->
        </div>

    </div>
</body>

<script>
    $(".nav .nav-link").on("click", function() {
        $(".nav").find(".active").removeClass("active");
        $(this).addClass("active");
    });
</script>

</html>