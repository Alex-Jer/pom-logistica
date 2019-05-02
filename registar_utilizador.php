<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'db.php';
include 'navbarLogin.php';
use \System\Linq;

$pw2 = "";
$Fim = false;
$pw1 = "";
$action = "registar_utilizador.php";
$Show = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $pw = $_POST["MainPw"];
  $pw2 = $_POST["Pw2"];
  $nome = $_POST["Nome"];
  $arID = $_POST["combobox"];
  $pfID = $_POST["combobox2"];
  $email = $_POST["Email"];

  if ($pw == $pw2) {
    $Fim = true;
  } else {
    $Fim = false;
    $Show = true;
  }
}
?>

<head>

  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="">
  <meta charset="utf-8">
  <link rel="stylesheet" href="node_modules\bootstrap3\dist\css\bootstrap.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- FontAwesome CSS -->
  <link rel="stylesheet" href="css/font-awesome.min.css">

  <!-- ElegantFonts CSS -->
  <link rel="stylesheet" href="css/elegant-fonts.css">

  <!-- themify-icons CSS -->
  <link rel="stylesheet" href="css/themify-icons.css">

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="css/swiper.min.css">

  <!-- Styles -->
  <link rel="stylesheet" href="style.css">
  <title></title>
</head>

<body>

  <div class="container">
    <div class="card card-container">
      <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
      <p id="profile-name" class="profile-name-card"></p>
      <h1 style="text-align:center">Registar utilizador</h1>
      <form class="form-signin" method="post" action="registar_utilizador.php">
        <span id="reauth-email" class="reauth-email"></span>
        <input type="input" id="inputNome" name="Nome" class="form-control" placeholder="Nome" required autofocus>
        <br>
        <input type="input" name="Email" id="inputEmail" class="form-control" placeholder="Email address" required>
        <br>
        <input type="password" id="inputPassword" name="MainPw" class="form-control" placeholder="Password" required>
        <input type="password" id="input2Password" name="Pw2" class="form-control" placeholder="Confirmar Password" required>
        <select name="combobox">
          <?php
          $busca = mysqli_query($conn, "SELECT * FROM armazem");
          foreach ($busca as $eachRow) {
            ?>
            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
          <?php
        }
        ?>
        </select>
        <select name="combobox2">
          <?php
          $busca = mysqli_query($conn, "SELECT * FROM perfil");
          foreach ($busca as $eachRow) {
            ?>
            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
          <?php
        }
        ?>
        </select>
        <?php
        if ($Fim) {
          $sql = "INSERT INTO utilizador (perfil_id,armazem_id,nome, email, password ) VALUES ('$pfID','$arID','$nome', '$email', '$pw')";
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
        /*header("Location: registar_utilizador.php");*/
        exit;
      } elseif (!$Fim && $Show) {
        ?>
          <script type="text/javascript">
            alert("As passwords não coincidem");
          </script>
        <?php
      }
      ?>
        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Registar</button>
      </form><!-- /form -->
    </div><!-- /card-container -->
  </div><!-- /container -->
  <script type='text/javascript' src='js/jquery.js'></script>
  <script type='text/javascript' src='js/jquery.collapsible.min.js'></script>
  <script type='text/javascript' src='js/swiper.min.js'></script>
  <script type='text/javascript' src='js/jquery.countdown.min.js'></script>
  <script type='text/javascript' src='js/circle-progress.min.js'></script>
  <script type='text/javascript' src='js/jquery.countTo.min.js'></script>
  <script type='text/javascript' src='js/jquery.barfiller.js'></script>
  <script type='text/javascript' src='js/custom.js'></script>

</body>

</html>