<!DOCTYPE html>
<html lang="pt">
<?php
session_start();
include 'navbarLogin.php';
include 'db.php';

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
            ;
            alert("New record created successfully");
        </script>
    <?php

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
header("Location: menu.php");
exit;
} ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>

</head>

<body>

    <div class="container">
        <div class=" card card-container">
            <h1 style="text-align:center">Registar cliente</h1>
            <form class="form-signin" action="registar_cliente.php" method="post">
                <input type="input" id="inputNome" name="Nome" class="form-control" placeholder="Nome" required autofocus>
                <input type="number" id="inputNif" name="nif" class="form-control" placeholder="NIF" onKeyDown="if(this.value.length==9) return false;" required>
                <input type="input" id="inputMorada" name="morada" class="form-control" placeholder="Morada" required>
                <input type="input" id="inputLocalidade" name="local" class="form-control" placeholder="Localidade" required>

                <button type="submit">Confirmar</button>
            </form><!-- /form -->
        </div>

    </div>
</body>

</html>