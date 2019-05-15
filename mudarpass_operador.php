<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
session_start();
include "db.php";
include "navbarOperador.php";
$NewPass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $NewPass = $_POST['textNewPass'];
  $emms = $_SESSION['emailSession'];
  $pw = $_POST["textPass"];
  $pw2 = $_POST["textNewPass"];
  $pw3 = $_POST["textNewPass2"];

  $stmt = $conn->prepare("SELECT password FROM utilizador WHERE Email=? LIMIT 1");
        $stmt->bind_param("s", $emms);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($oLdPassword);
        $stmt->fetch();

  if ($oLdPassword == $pw && $pw3 == $pw2) {
    $Fim = true;
  } else {
    $Fim = FALSE;
    $Show = TRUE;
  }


  if ($Fim == TRUE) {
    $stmt = $conn->prepare("UPDATE utilizador SET password=? WHERE Email=?");
    $stmt->bind_param("ss", $NewPass,$emms);
    $stmt->execute();
    ?>

    
    <script type="text/javascript">
      ;
      alert("Password mudada com sucesso");
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
  <link rel="stylesheet" href="css\bootstrap.css">
</head>

<body>
  <div class="container">
    <div class="card card-container">
      <form action="mudarpass_admin.php" method="post">
        <h1 style="text-align:center">Mudar Palavra-Passe</h1>
        <br>
        <input type="password" style="margin-bottom:1rem;" name="textPass" class="form-control" placeholder="Password antiga" required autofocus>
        <input type="password" style="margin-bottom:1rem;" name="textNewPass" class="form-control" placeholder="Nova Password" required>
        <input type="password" name="textNewPass2" class="form-control" placeholder="Confirmar Nova Password" required>
        <button class="btn btn-primary" style="margin-top:2rem; width:100%" type="submit">Confirmar</button>
      </form><!-- /form -->
    </div>
  </div>
</body>

</html>