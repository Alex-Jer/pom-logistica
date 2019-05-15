<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarAdmin.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guia = $_POST["combobox"];
    $carga = $_POST["carga"];
    $descarga = $_POST["descarga"];
    $espaco = $_POST["espaco"];
    $nome = $_POST["nome"];
    $stmt = $conn->prepare("INSERT INTO armazem (nome,espaco, custo_carga, custo_descarga) VALUES(?,?,?,?)");
    $stmt->bind_param("sidd", $nome,$espaco,$carga,$descarga);
    $stmt->execute();

    
    //header("Location: navbarAdmin.php");
}
?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
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
                </div>
                <div style="text-align:center">
                    <input style="text-align:center; margin-top:1rem;" class="form-control" type="text" name="nome" step="any" placeholder="Nome">
                </div>
                <div style="text-align:center">
                    <input style="text-align:center; margin-top:1rem;" class="form-control" type="number" name="carga" step="any" placeholder="Custo de carga">
                </div>
                
                <div style="text-align:center">
                    <input style="text-align:center; margin-top:1rem;" class="form-control" type="number" name="descarga" step="any" placeholder="Custo de descarga">
                </div>
                <div style="text-align:center">
                    <input style="text-align:center; margin-top:1rem;" class="form-control" type="number" name="espaco" placeholder="Espaço disponível no armazém">
                </div>
                <button class="btn btn-primary btn-block btn-signin" style="margin-top:1rem;" type="submit">Confirmar</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script type="text/javascript"></script>
    <script type="text/javascript"></script>
</body>

</html>