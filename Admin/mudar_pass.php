<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
session_start();
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
$navbar = $_SERVER['DOCUMENT_ROOT'];
$navbar .= "/POM-Logistica/Navbar/navbarAdmin.php";
include_once($navbar);
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

  // if ($oLdPassword == $pw && $pw3 == $pw2) {
  if ((password_verify($pw, $oLdPassword)) && $pw2 == $pw3) {
    $Fim = true;
  } else {
    $Fim = false;
    $Show = true;
  }

  if ($Fim == true) {
    $hashed_password = password_hash($NewPass, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE utilizador SET password=? WHERE Email=?");
    $stmt->bind_param("ss", $hashed_password, $emms);
    $stmt->execute();
    ?>
    <script type="text/javascript">
      alert("Password alterada com sucesso");
    </script>
  <?php
} elseif ($Fim == false && $Show = true) {
  ?>
    <script type="text/javascript">
      alert("As passwords não coincidem");
    </script>
  <?php
}
}
?>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="\POM-Logistica\css\bootstrap.css">
  <link rel="stylesheet" href="\POM-Logistica\styles\table.css">
</head>

<body>
  <div class="container">
    <div class="card card-container">
      <form action="\POM-Logistica\Admin\mudar_pass.php" method="post">
        <h1 style="text-align:center">Mudar Palavra-Passe</h1>
        <div class="row" style="margin-left:20px; margin-top:2rem;">
          <input type="password" style="margin-bottom:1rem;" name="textPass" id="oldPass" tabindex="1" class="form-control" placeholder="Password antiga" required autofocus>
          <button type="button" style="font-size:20px; width:20px; height:20px; margin-left:-2.5rem;" class="btn-eye" onclick="myFunction()"><i class="fa fa-eye" id="ieye" style="width:20px; height:20px;" data-toggle="tooltip" title="Mostrar Password"></i></button>
        </div>
        <div class="row" style="margin-left:20px">
          <input type="password" style="margin-bottom:1rem;" name="textNewPass" id="newPass" tabindex="2" class="form-control" placeholder="Nova Password" required>
          <button type="button" style="font-size:20px; width:20px; height:20px; margin-left:-2.5rem;" tabindex="-1" class="btn-eye" onclick="myFunction2()"><i class="fa fa-eye" id="ieye2" style="width:20px; height:20px;" data-toggle="tooltip" title="Mostrar Password"></i></button>
        </div>
        <div class="row" style="margin-left:20px">
          <input type="password" name="textNewPass2" class="form-control" id="textNewPass2" tabindex="3" placeholder="Confirmar Nova Password" required>
          <button type="button" style="font-size:20px; width:20px; height:20px; margin-left:-2.5rem;" tabindex="-1" class="btn-eye" onclick="myFunction3()"><i class="fa fa-eye" id="ieye3" style="width:20px; height:20px;" data-toggle="tooltip" title="Mostrar Password"></i></button>
        </div>
        <button class="btn btn-primary" style="margin-top:2rem; margin-left:20px; width:371.7px; margin-bottom:1rem;" type="submit">Confirmar</button>
      </form><!-- /form -->
    </div>
  </div>
</body>

</html>

<script>
  function myFunction() {
    var x = document.getElementById("oldPass");
    if (x.type === "password") {
      x.type = "text";
      $("#ieye").removeClass('fa fa-eye-open');
      $("#ieye").addClass('fa fa-eye-slash');
    } else {
      x.type = "password";
      $("#ieye").removeClass('fa fa-eye-slash');
      $("#ieye").addClass('fa fa-eye-open');
    }
  }
</script>

<script>
  function myFunction2() {
    var x = document.getElementById("newPass");
    if (x.type === "password") {
      x.type = "text";
      $("#ieye2").removeClass('fa fa-eye-open');
      $("#ieye2").addClass('fa fa-eye-slash');
    } else {
      x.type = "password";
      $("#ieye2").removeClass('fa fa-eye-slash');
      $("#ieye2").addClass('fa fa-eye-open');
    }
  }
</script>

<script>
  function myFunction3() {
    var x = document.getElementById("textNewPass2");
    if (x.type === "password") {
      x.type = "text";
      $("#ieye3").removeClass('fa fa-eye-open');
      $("#ieye3").addClass('fa fa-eye-slash');
    } else {
      x.type = "password";
      $("#ieye3").removeClass('fa fa-eye-slash');
      $("#ieye3").addClass('fa fa-eye-open');
    }
  }
</script>