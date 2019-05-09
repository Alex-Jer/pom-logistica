<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guia = $_POST["combobox"];
    $carga = $_POST["carga"];
    $descarga = $_POST["descarga"];
    $espaco = $_POST["espaco"];
    $sql = "INSERT INTO armazem (nome,espaco, custo_carga, custo_descarga) VALUES ('$guia', '$espaco', '$carga', '$descarga')";
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
    //header("Location: navbarLogin.php");
}
?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav role="navigation">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="operador.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="armazem.php">Armazém</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Guia_Operador.php">Guia do Operador</a></li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="showGuiaEntrega.php">Registar Palete</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mudarpass.php">Mudar Palavra-Passe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listagem_pedidos_armazem_operador.php">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Guia_Rececao.php">Imprimir Receção</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Guia_Devolucao.php">Imprimir Devolução</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pdf.php">PDF</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Sair</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <p id="profile-name" class="profile-name-card"></p>
            <h1 style="text-align:center">Armazém</h1>
            <form class="form-signin" action="armazem.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <div style="text-align:center">
                    <select style="text-align-last:center" class="form-control" name="combobox">
                        <option value="" disabled selected>Tipo de armazém</option>
                        <option value="Armazem de Paletes Altas">Armazém de Paletes altas</option>
                        <option value="Armazem de Paletes Baixas">Armazém de Paletes baixas</option>
                        <option value="Armazem de paletes para o Frio"> Armazém de paletes para o Frio</option>
                    </select>
                    &nbsp;
                </div>
                <div style="text-align:center">
                    <input style="text-align:center" class="form-control" type="number" name="carga" step="any" placeholder="Custo de carga">
                </div>
                <div style="text-align:center">
                    &nbsp;
                    <input style="text-align:center" class="form-control" type="number" name="descarga" step="any" placeholder="Custo de descarga">
                </div>
                <div style="text-align:center">
                    &nbsp;
                    <input style="text-align:center" class="form-control" type="number" name="espaco" placeholder="Espaço disponível no armazém">
                </div>
                &nbsp;
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Confirmar</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script type="text/javascript"></script>
    <script type="text/javascript"></script>
</body>

</html>