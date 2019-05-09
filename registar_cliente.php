<!DOCTYPE html>
<html lang="pt">
<?php
include 'navbarLogin.php';
include 'db.php';
if ($_SESSION["user"]==2)
{
    
    header("Location: login.php");
    ?>
    <script type="text/javascript">
            alert("Voce nao tem permissoes para acessar a isso");
        </script>
        <?php
}

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
mysqli_close($conn);
exit;
} ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>

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
        <div class=" card card-container">
            <h1 style="text-align:center">Registar cliente</h1>
            <br>
            <form class="form-signin" action="registar_cliente.php" method="post">
                <input type="input" name="Nome" class="form-control" placeholder="Nome" pattern="[A-Za-z]+" title="Apenas deve conter letras." required autofocus>
                <input type="number" id="uintTextBox" name="nif" class="form-control" placeholder="NIF" max="999999999" pattern=".{9,}" minlength=9 title="O NIF tem de ter 9 dígitos." required>
                <input type="input" name="morada" class="form-control" placeholder="Morada" pattern="[a-zA-Z0-9-,-.]+" required>
                <input type="input" name="local" class="form-control" placeholder="Localidade" pattern="[A-Za-z]+" required>
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Confirmar</button>
            </form><!-- /form -->
        </div>

    </div>
</body>

</html>