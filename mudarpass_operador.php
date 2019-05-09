<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
session_start();
//include "operador.php";
include "db.php";
$NewPass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $NewPass = $_POST['textNewPass'];
  $emms = $_SESSION['emailSession'];
  $busca = mysqli_query($conn, "SELECT password FROM utilizador WHERE Email='$emms'");
  $dado = mysqli_fetch_array($busca);
  $oLdPassword = $dado['password'];
  $pw = $_POST["textPass"];
  $pw2 = $_POST["textNewPass"];
  $pw3 = $_POST["textNewPass2"];

  if ($oLdPassword == $pw && $pw3 == $pw2) {
    $Fim = true;
  } else {
    $Fim = FALSE;
    $Show = TRUE;
  }


  if ($Fim == TRUE) {
    $sql = "UPDATE utilizador SET password='$NewPass' WHERE Email='$emms'";
    if (mysqli_query($conn, $sql)) { } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    ?>
    <script type="text/javascript">
      ;
      alert("Pssword mudada com sucesso");
    </script>
    <?php
    header("Location: showGuiaEntrega.php");
  } elseif ($Fim == FALSE && $Show = TRUE) {
    ?>
    <script type="text/javascript">
      ;
      alert("As passwords não coincidem");
    </script>
  <?php
}
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
        <a class="nav-link" href="armazem.php">Armazém</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Guia_Operador_operador.php">Guia do Operador</a></li>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="showGuiaEntrega.php">Registar Palete</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="mudarpass_operador.php">Mudar Palavra-Passe</a>
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
      <form class="form-signin" action="mudarpass_operador.php" method="post">
        <h1 style="text-align:center">Mudar Palavra-Passe</h1>
        <br>
        <input type="password" name="textPass" class="form-control" placeholder="Password antiga" required autofocus>
        <input type="password" name="textNewPass" class="form-control" placeholder="Nova Password" required>
        <input type="password" name="textNewPass2" class="form-control" placeholder="Confirmar Nova Password" required>
        <button class="btn btn-lg btn-primary btn-block btn-signin" style="margin-top:7%" type="submit">Confirmar</button>
      </form><!-- /form -->
    </div>
  </div>
</body>

</html>