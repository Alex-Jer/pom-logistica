<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
session_start();
include 'db.php';
include 'navbarAdmin.php';
if ($_SESSION["user"] == 2) {

  header("Location: login.php");
  ?>
  <script type="text/javascript">
    alert("Voce nao tem permissoes para acessar a isso");
  </script>
<?php
}
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
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="teste.css">
</head>

<body>
  <div class="container">
    <div class="card card-container">
      <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
      <h1 style="text-align:center">Registar utilizador</h1>
      <form class="form-signin" method="post" action="registar_utilizador.php">
        <span id="reauth-email" class="reauth-email"></span>
        <input style="margin-top:1rem; height:auto;" type="input" name="Nome" class="form-control" placeholder="Nome" pattern="[A-Za-z\sâàáêèééìíôòóùúçãõ ]+" title="Apenas deve conter letras." required autofocus>
        <input style="margin-top:1rem; height:auto;" type="email" name="Email" id="inputEmail" class="form-control" placeholder="Endereço de email" required autofocus>
        <input style="margin-top:1rem; height:auto;" type="password" id="inputPassword" name="MainPw" class="form-control" placeholder="Password" required autofocus>
        <input style="margin-top:1rem; height:auto;" type="password" id="input2Password" name="Pw2" class="form-control" placeholder="Confirmar Password" required autofocus>
        <select style="text-align-last:center; margin-top:1rem; color: #6C757D; height:auto; font-size:14px" class="form-control" name="combobox">
          <option value="" disabled selected>Armazém</option>
          <?php
          $busca = mysqli_query($conn, "SELECT * FROM armazem");
          foreach ($busca as $eachRow) {
            ?>
            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
          <?php
        }
        ?>
        </select>
        <select style="text-align-last:center; margin-top:1rem; color: #6C757D; height:auto; font-size:14px" class="form-control" name="combobox2">
          <option value="" disabled selected>Estatuto</option>
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
              alert("New record created successfully");
            </script>
          <?php

        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
        exit;
      } elseif (!$Fim && $Show) {
        ?>
          <script type="text/javascript">
            alert("As passwords não coincidem");
          </script>
        <?php
      }
      ?>
        <button style="margin-top:1rem; margin-left:auto; margin-right:auto; width:auto; height:auto;" type="submit" class="btn btn-primary">Registar</button>
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