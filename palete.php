<!DOCTYPE html>
<html lang="pt">
<?php
session_start();
include 'Navbar\navbarAdmin.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $ref = $_POST["ref"];
    $data = $_POST["data"];
    $artigo = $_POST["artigo"];
    $tipopalete = $_POST["tipopalete"];

    $sql = "INSERT INTO palete (artigo_id, tipo_palete_id, referencia, nome, Data) VALUES ('$artigo','$tipopalete','$ref','$nome', '$data')";
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

    <div class="container">
        <div class=" card card-container">
            <form class="form-signin" action="palete.php" method="post">
                <input type="input" id="inputNome" name="nome" class="form-control" placeholder="Nome" required autofocus>
                &nbsp;
                <input type="input" id="inputRef" name="ref" class="form-control" placeholder="Referência" value="PAL-" required>
                <br>
                <div style="text-align:center">
                    <input placeholder="Data e hora" class="form-control" name="data" class="textbox-n" type="text" onfocus="(this.type='datetime-local')" id="date">
                </div>
                <br>
                <div style="text-align:center">
                    <select class="form-control" name="artigo" style="text-align-last:center">
                        <option value="" disabled selected>Artigo</option>
                        <?php
                        $busca = mysqli_query($conn, "SELECT id,nome FROM artigo");
                        foreach ($busca as $eachRow) {
                            ?>
                            &nbsp;
                            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <br>
                <div style="text-align:center">
                    <select class="form-control" style="text-align-last:center" name="tipopalete">
                        <option value="" disabled selected>Tipo de palete</option>
                        <?php
                        $busca = mysqli_query($conn, "SELECT id,nome FROM tipo_palete");
                        foreach ($busca as $eachRow) {
                            ?>
                            &nbsp;
                            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <br>
                <div style="text-align:center">
                    <select class="form-control" style="text-align-last:center" name="localizacao">
                        <option value="" disabled selected>Localização</option>
                        <?php
                        $busca = mysqli_query($conn, "SELECT id,referencia FROM localizacao");
                        foreach ($busca as $eachRow) {
                            ?>
                            &nbsp;
                            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['referencia'] ?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div style="text-align:center">
                    <br>
                    <button type="submit">Registar Palete</button>
                </div>
            </form><!-- /form -->
        </div>

    </div>
</body>

</html>