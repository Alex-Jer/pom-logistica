<!DOCTYPE html>
<html lang="pt">
<?php
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
$navbar = $_SERVER['DOCUMENT_ROOT'];
$navbar .= "/POM-Logistica/Navbar/navbarAdmin.php";
include_once($navbar);
if ($_SESSION["perfilId"] == 2) {

    header("Location: \POM-Logistica\index.php");
    ?>
    <script type="text/javascript">
        alert("Voce não tem permissões para aceder a essa página.");
    </script>
<?php
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["Nome"];
    $ref = $_POST["ref"];
    $peso = $_POST["peso"];
    $peso = (float)$peso;
    $cli_id = $_POST["combobox"];

    $stmt = $conn->prepare("INSERT INTO artigo (cliente_id, referencia, nome, peso) VALUES(?,?,?,?)");
    $stmt->bind_param("issd", $cli_id, $ref, $nome, $peso);
    $stmt->execute();
} ?>


<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/POM-Logistica/styles/style.min.css">
</head>

<body>
    <div class="container">
        <div class="card card-container">
            <form action="/POM-Logistica/Admin/artigo.php" method="post">
                <h1 style="text-align:center; margin-bottom:2rem;">Registar Artigo</h1>
                <input type="input" style="margin-bottom:1rem;" id="inputNome" name="Nome" class="form-control" placeholder="Nome do artigo" required autofocus>
                <input type="input" style="margin-bottom:1rem;" id="inputRef" name="ref" class="form-control" placeholder="Referência do artigo" required autofocus>
                <input type="number" style="margin-bottom:1rem;" id="inputPeso" name="peso" class="form-control" placeholder="Peso do artigo (Kg)" step="any" required>
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