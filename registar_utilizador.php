<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'db.php';
<<<<<<< HEAD
include 'navbarLogin.php';
if ($_SESSION["user"]==2)
{
    
    header("Location: login.php");
    ?>
    <script type="text/javascript">
            alert("Voce nao tem permissoes para acessar a isso");
        </script>
        <?php
}
=======
//include 'navbarLogin.php';
>>>>>>> 61999857b0b61dfd2b17cdec280e99798503bf38
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
</head>

<body>
  <nav role="navigation">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link" href="navbarLogin.php">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Guias</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="Guia_Entrega.php">Entrega</a>
          <a class="dropdown-item" href="Guia_Operador.php">Operador</a>
          <a class="dropdown-item" href="Guia_Transporte.php">Transporte</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="registar_cliente.php">Registar Cliente</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="registar_utilizador.php">Registar Utilizador</a></li>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mudarpass.php">Mudar Palavra-Passe</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="listagem_pedidos_armazem_admin.php">Pedidos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="fatura_cliente.php">Fatura</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Sair</a>
      </li>
    </ul>
  </nav>
  <div class="container">
    <div class="card card-container">
      <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
      <h1 style="text-align:center">Registar utilizador</h1>
      <form class="form-signin" method="post" action="registar_utilizador.php">
        <span id="reauth-email" class="reauth-email"></span>
        <input style="margin-top:2rem; height:3.2rem; font-size:1.5rem;" type="input" id="inputNome" name="Nome" class="form-control" placeholder="Nome" pattern="[A-Za-z]+" required autofocus>
        <br>
        <input style="height:3.2rem; font-size:1.5rem; margin-bottom:0rem;" type="email" name="Email" id="inputEmail" class="form-control" placeholder="Endereço de email" required autofocus>
        <br>
        <input style="height:3.2rem; font-size:1.5rem;" type="password" id="inputPassword" name="MainPw" class="form-control" placeholder="Password" required autofocus>
        <input style="height:3.2rem; font-size:1.5rem;" type="password" id="input2Password" name="Pw2" class="form-control" placeholder="Confirmar Password" required autofocus>
        <select style="text-align-last:center; height:70%; margin-top:4%; font-size:1.5rem; color: #6C757D;" class="form-control" name="combobox">
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
        <br>
        <select style="text-align-last:center; height:70%; font-size:1.5rem; color: #6C757D;" class="form-control" name="combobox2">
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
        <br>
        <button style="font-size:1.5rem; margin-left:auto; margin-right:auto; margin-top:0.4rem; width:10rem;" type="submit" class="btn btn-warning">Registar</button>
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