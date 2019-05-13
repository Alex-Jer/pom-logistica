<!DOCTYPE html>
<html lang="pt">
<?php
include 'navbarAdmin.php';
include 'db.php';
if ($_SESSION["perfilId"]==2)
{
    
    header("Location: index.php");
    ?>
    <script type="text/javascript">
            alert("Voce nao tem permissoes para acessar a isso");
        </script>
        <?php
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["Nome"];
    $ref = $_POST["ref"];
    $peso = $_POST["peso"];
    $peso = (float)$peso;
    $cli_id = $_POST["combobox"];

    $sql = "INSERT INTO artigo (cliente_id ,referencia,nome,peso) VALUES ('$cli_id','$ref','$nome','$peso')";
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
            <form class="form-signin" action="artigo.php" method="post">
                <input type="input" id="inputNome" name="Nome" class="form-control" placeholder="Nome" required autofocus>
                &nbsp;
                <input type="input" id="inputRef" name="ref" class="form-control" placeholder="Referencia" required>
                &nbsp;
                <input type="number" id="inputPeso" name="peso" class="form-control" placeholder="Peso" step="any" required>
                &nbsp;
                <select class="form-control" name="combobox">
                    <?php
                    $busca = mysqli_query($conn, "SELECT * FROM cliente");
                    foreach ($busca as $eachRow) {
                        ?>
                        &nbsp;
                        <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                    <?php
                }
                ?>
                </select>
                &nbsp;
                <button type="submit">Registar Artigo</button>
            </form><!-- /form -->
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>

</html>