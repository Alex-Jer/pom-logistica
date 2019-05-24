<!DOCTYPE html>
<html lang="pt">
<?php
include '..\Navbar\navbarAdmin.php';
include '..\db.php';
if ($_SESSION["perfilId"] == 2) {

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

    $stmt = $conn->prepare("INSERT INTO artigo (cliente_id ,referencia,nome,peso) VALUES(?,?,?,?)");
    $stmt->bind_param("issd", $cli_id, $ref, $nome, $peso);
    $stmt->execute();
} ?>


<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css\bootstrap.css">
</head>

<body>
    <div class="container">
        <div class="card card-container">
            <form action="artigo.php" method="post">
                <h1 style="text-align:center; margin-bottom:2rem;">Registar Artigo</h1>
                <input type="input" style="margin-bottom:1rem;" id="inputNome" name="Nome" class="form-control" placeholder="Nome do artigo" required autofocus>
                <input type="input" style="margin-bottom:1rem;" id="inputRef" name="ref" class="form-control" placeholder="Referência do artigo" required autofocus>
                <input type="number" style="margin-bottom:1rem;" id="inputPeso" name="peso" class="form-control" placeholder="Peso do artigo" step="any" required>
                <select class="form-control" style="text-align-last:center; color:#6c757d" name="combobox" required autofocus>
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
                <button class="btn btn-primary" style="margin-top:2rem; width:100%" type="submit">Confirmar</button>
            </form><!-- /form -->
        </div>
    </div>
</body>

</html>