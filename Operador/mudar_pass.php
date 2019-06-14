<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
session_start();
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
$navbar = $_SERVER['DOCUMENT_ROOT'];
$navbar .= "/POM-Logistica/Navbar/navbarOperador.php";
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
  <link rel="stylesheet" href="/POM-Logistica/styles/style.min.css">
  <link rel="stylesheet" href="/POM-Logistica/styles/table.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
  #oldPass {
    margin-top: 1rem;
    position: relative;
    margin-right: auto;
    margin-left: auto;
  }

  #newPass {
    margin-top: 1rem;
    position: relative;
    margin-right: auto;
    margin-left: auto;
  }

  #newPass2 {
    margin-top: 1rem;
    position: relative;
    margin-right: auto;
    margin-left: auto;
  }

  #confirm {
    margin-top: 2rem;
    position: relative;
    margin-left: auto;
    margin-right: auto;
    width: 90%;
  }

  .btn-eye {
    vertical-align: middle;
    position: absolute;
    margin-left: 72%;
    margin-top: 3px;
    font-size: 18px;
    z-index: 500;
  }
</style>

<body>
  <div class="container card card-container">
    <form action="Operador/mudar_pass.php" method="post">
      <div>
        <h1 style="text-align:center">Mudar Palavra-Passe</h1>
      </div>
      <div>
        <button type="button" class="btn-eye" onclick="myFunction()"><i class="fa fa-eye" id="ieye" style="width:20px; height:20px;" data-toggle="tooltip" title="Mostrar Password"></i></button>
        <input type="password" name="textPass" id="oldPass" tabindex="1" class="form-control" placeholder="Password antiga" required autofocus>
      </div>
      <div>
        <button type="button" tabindex="-1" class="btn-eye" onclick="myFunction2()"><i class="fa fa-eye" id="ieye2" style="width:20px; height:20px;" data-toggle="tooltip" title="Mostrar Password"></i></button>
        <input type="password" name="textNewPass" id="newPass" tabindex="2" class="form-control" placeholder="Nova Password" required>
      </div>
      <div>
        <button type="button" tabindex="-1" class="btn-eye" onclick="myFunction3()"><i class="fa fa-eye" id="ieye3" style="width:20px; height:20px;" data-toggle="tooltip" title="Mostrar Password"></i></button>
        <input type="password" name="textNewPass2" id="newPass2" class="form-control" tabindex="3" placeholder="Confirmar Nova Password" required>
      </div>
      <div class="text-center">
        <button class="btn btn-primary" id="confirm" type="submit">Confirmar</button>
      </div>
    </form>
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
    var x = document.getElementById("newPass2");
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
