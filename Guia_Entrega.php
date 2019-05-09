<!DOCTYPE html>
<html lang="pt">
<script type="text/javascript" src="jquery.js"></script>
<?php
<<<<<<< HEAD

include 'navbarLogin.php';
=======
session_start();
//include 'navbarLogin.php';
>>>>>>> 61999857b0b61dfd2b17cdec280e99798503bf38
include 'db.php';
if ($_SESSION["user"]==2)
{
    
    header("Location: login.php");
    ?>
    <script type="text/javascript">
            alert("Voce nao tem permissoes para acessar a isso");
        </script>
        <?php
}
$olateste = "a";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nomeCli = $_POST["comboboxCli"];
  $dataEntrega = $_POST["dataentrega"];
  $getCBart = $_POST["comboboxArtigo"];
  $getQT = $_POST["qt"];
  $getCBtp = $_POST["comboboxTipo_Palete"];
  $getCBtz = $_POST["comboboxTipoZona"];
  $getREQ = $_POST["req"];
  $getArmazem = $_POST["Armazem"];
  $sql = "INSERT INTO guia (cliente_id, tipo_guia_id, tipo_palete_id, tipo_zona_id,armazem_id,artigo_id,data_prevista,numero_paletes, numero_requisicao) VALUES ($nomeCli, 1, $getCBtp, $getCBtz, $getArmazem, '$getCBart', '$dataEntrega', $getQT, 'REQ-' + '$getREQ')";

  if (mysqli_query($conn, $sql)) { } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
?>

<head>
  <meta charset="UTF-8">
  <script type="text/javascript" src="jquery.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Menu</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <nav role="navigation">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link" href="navbarLogin.php">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Guias</a>
        <div class="dropdown-menu">
          <a class="dropdown-item active" href="Guia_Entrega.php">Entrega</a>
          <a class="dropdown-item" href="Guia_Operador_admin.php">Operador</a>
          <a class="dropdown-item" href="Guia_Transporte.php">Transporte</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="registar_cliente.php">Registar Cliente</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="registar_utilizador.php">Registar Utilizador</a></li>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mudarpass_admin.php">Mudar Palavra-Passe</a>
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
    <div class="card card-container" style="max-width:250%; width:60%">
      <form style="text-align:center" action="Guia_Entrega.php" method="post">
        <h1>Guia de entrega</h1>
        <select class="form-control" style="text-align-last:center; margin-top:1rem; color: #6C757D;" name="comboboxCli" id="comboboxCli">
          <option value="" disabled selected>Cliente</option>
          <?php
          $busca = mysqli_query($conn, "SELECT * FROM cliente");
          foreach ($busca as $eachRow) {
            ?>
            <option value=" <?php echo $eachRow['id'] ?>" <?php echo (isset($_POST['comboboxCli']) && $_POST['comboboxCli'] == $eachRow['id']) ? 'selected="selected"' : ''; ?>><?php echo $eachRow['nome'] ?></option>
          <?php
        }
        ?>
        </select>
        <input class="form-control" style="text-align:center; margin-top:1rem;" type="text" id="date" name="dataentrega" placeholder="Data e hora de entrega" onfocus="(this.type='datetime-local')" id="date" required>
        <select class="form-control" name="comboboxArtigo" style="text-align-last:center; margin-top:1rem; color: #6C757D;" id="comboboxArtigo">
          <option value="" disabled selected>Artigo</option>
          <?php
          $busca = mysqli_query($conn, "SELECT * FROM artigo");
          foreach ($busca as $eachRow) {
            ?>
            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['referencia'] ?></option>
          <?php
        }
        ?>
        </select>
        <select class="form-control" name="comboboxTipo_Palete" id="TipoPalete" style="text-align-last:center; margin-top:1rem; color: #6C757D;">
          <option value="" disabled selected>Tipo de paletes</option>
          <?php
          $busca = mysqli_query($conn, "SELECT * FROM tipo_palete");
          foreach ($busca as $eachRow) {
            ?>
            <option value=" <?php echo $eachRow['id'] ?>" <?php echo (isset($_POST['comboboxTipo_Palete']) && $_POST['comboboxTipo_Palete'] == $eachRow['id']) ? 'selected="selected"' : ''; ?>><?php echo $eachRow['nome'] ?></option>

            <?php
            echo $eachRow['nome'];
          }
          ?>
        </select>
        <select class="form-control" name="comboboxTipoZona" id="TipoZona" style="display:none; text-align-last:center; margin-top:1rem; color: #6C757D;">
          <option value="" disabled selected>Tipo de zona</option>
        </select>
        <div style="text-align:center" class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="height:2.37rem; margin-top:0.6rem" id="inputGroup-sizing-lg">REQ-</span>
            </div>
            <input type="text" class="form-control" style="width:5rem; margin-top:0.6rem;" placeholder="Número de requisição" name="req" required>
        </div>
        <select class="form-control" name="Armazem" id="Armazem" style="display:none; text-align-last:center; margin-top:1rem; color: #6C757D;">
        </select>
        <div id="Espaco"></div>
        <div id="HiddenTeste" name="HiddenTeste">
        </div>
        <input style="text-align:center; margin-top:1rem;" type="number" id="inputqt" name="qt" class="form-control" placeholder="Quantidade de paletes neste artigo" required>
        <button type="submit" class="btn btn-primary" style="margin-top:1rem; margin-left:auto; margin-right:auto; width:36.7rem;">Confirmar</button>
      </form><!-- /form -->
    </div>
  </div>
</body>

</html>
<script>
  $("#TipoPalete").on("change", function() {
    $.ajax({
      url: 'ajaxEntrega.php',
      type: 'POST',
      data: {
        id: $("#TipoPalete").val()
      },
      success: function(data) {
        $("#pZona").css({
          'display': 'block'
        });
        $("#TipoZona").css({
          'display': 'block'
        });
        $("#TipoZona").html(data);

      },
    });
  });
</script>
<script>
  $("#TipoPalete").on("change", function() {
    $.ajax({
      url: 'ajaxArmazem.php',
      type: 'POST',
      data: {
        id: $("#TipoPalete").val()
      },
      success: function(data) {
        $("#pArmazem").css({
          'display': 'block'
        })
        $("#inputqt").css({
          'display': 'block'
        });
        $("#Armazem").css({
          'display': 'block'
        });
        $("#Armazem").html(data);
      },
    });
  });
</script>
<script>
  $("#Armazem").on("change", function() {
    $.ajax({
      url: 'ajaxEspaco.php',
      type: 'POST',
      data: {
        id: $("#Armazem").val(),
        teste: $("#TipoZona").val()
      },
      success: function(data) {
        document.getElementById("inputqt").setAttribute("max", data);
      },
    });
  });
</script>
<script type="text/javascript">
  document.getElementById('comboboxCli').value = "<?php echo $_POST['comboboxCli']; ?>";
  document.getElementById('TipoPalete').value = "<?php echo $_POST['TipoPalete']; ?>";
  document.getElementById('comboboxArtigo').value = "<?php echo $_POST['comboboxArtigo']; ?>";
  document.getElementById('TipoZona').value = "<?php echo $_POST['TipoZona']; ?>";
  document.getElementById('Armazem').value = "<?php echo $_POST['Armazem']; ?>";
</script>