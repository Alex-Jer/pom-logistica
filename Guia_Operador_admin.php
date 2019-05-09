<?php
session_start();
//include 'operador.php';
include 'db.php';

$count = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cliente = $_POST["cliente"];
  $idGuiaa = $_POST["nrequisicao"];
  $morada = $_POST["morada"];
  $data = $_POST["data"];
  $artigoo = $_POST["artigo"];
  $npal = $_POST["npaletes"];
  $sql6 = mysqli_query($conn, "SELECT * FROM guia WHERE id='$idGuiaa'");
  $dado = mysqli_fetch_array($sql6);
  $nrequisicao = $dado['numero_requisicao'];

  $sqlArtigo = mysqli_query($conn, "SELECT * FROM palete WHERE artigo_id='$artigoo'");
  $sql3 = mysqli_fetch_array($sqlArtigo);
  $tipoPalete = $sql3['tipo_palete_id'];
  $paleteeID = $sql3['id'];
  echo $paleteeID;

  $sqlLocalizacao = mysqli_query($conn, "SELECT * FROM localizacao where palete_id='$paleteeID'");
  $sql4 = mysqli_fetch_array($sqlLocalizacao);
  $zonaID = $sql4['zona_id'];

  $sqlZona = mysqli_query($conn, "SELECT * from zona WHERE id='$zonaID'");
  $sql5 = mysqli_fetch_array($sqlZona);
  $armazemID = $sql5['armazem_id'];
  $tipoZona = $sql5['tipo_zona_id'];

  //echo "cliente: $cliente , nreq: $nrequisicao , morada: $morada , data: $data , artigo: $artigo , npaletes: $npaletes";
  $sql = "INSERT INTO guia (cliente_id, guia_id,tipo_guia_id,  tipo_palete_id, tipo_zona_id,armazem_id,artigo_id, data_prevista, numero_paletes, numero_requisicao, morada) VALUES ($cliente,$idGuiaa,     4,$tipoPalete, $tipoZona ,$armazemID,$artigoo,'$data','$npal','$nrequisicao','$morada')";
  if (mysqli_query($conn, $sql)) {
    ?>
    <script type="text/javascript">
      alert("New record created successfully");
    </script>
  <?php
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql6 = mysqli_query($conn, "SELECT * FROM palete WHERE artigo_id='$artigoo' ORDER BY Data ASC");
//$sql7 = mysqli_query($conn, "DELETE FROM palete WHERE artigo_id='$sql5' ORDER BY Data ASC LIMIT $npaletes");
foreach ($sql6 as $eachRow2) {
  $count++;
  if ($count <= $npal) {
    echo $count;
    $paleteId = $eachRow2['id'];
    $sql10 = mysqli_query($conn, "UPDATE localizacao SET hasPalete = 0, palete_id = NULL, zona_id = NULL, data_entrada = NULL WHERE palete_id=$paleteId ORDER BY data_entrada ASC LIMIT $npal");
    if (mysqli_query($conn, $sql10)) {
      ?>
        <script type="text/javascript">
          alert("New record created successfully");
        </script>
      <?php
    }
  }
}
}
?>
<!DOCTYPE html>
<html lang="en">

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
        <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Guias</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="Guia_Entrega.php">Entrega</a>
          <a class="dropdown-item active" href="Guia_Operador_admin.php">Operador</a>
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
    <div class="row">
      <div class="col card card-container metade w-auto li ">
        <form class="form-signin" action="Guia_Operador_admin.php" method="post">
          <div class="row">
            <select class="form-control" style="text-align-last:center; margin-top:1rem; color: #6C757D;" name="comboboxGuiaEntrega" id="teste">
              <option value="" selected disabled>Número de requisição</option>
              <?php
              $busca = mysqli_query($conn, "SELECT * FROM guia where tipo_guia_id=2");

              foreach ($busca as $eachRow) {
                ?>
                <option value="<?php echo $eachRow['id'] ?>"><?php echo $eachRow['numero_requisicao'] ?></option>
              <?php
            }
            ?>
            </select>
          </div>
          <div class="row ">
            <div class="col-12 text-left w-auto p-3 li" id="Card" style="display:none">
              <div class="text-left w-auto p-3 li " id="Espaco" style="display:none">

              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col dupla card card-container " id="testediv" style="display:none">
        <form class="form-signin" action="Guia_Operador_admin.php" method="post">
          <div style="text-align:center">
            <h1>Guia do Operador</h1>
            <select class="form-control" name="cliente" style="text-align-last:center; margin-top:1rem; color: #6C757D;">
              <option value="" disabled selected>Cliente</option>
              <?php
              $busca = mysqli_query($conn, "SELECT * FROM cliente");
              foreach ($busca as $eachRow) {
                ?>
                <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
              <?php
            }
            ?>
            </select>
          </div>
          <div style="text-align:center">
            <select class="form-control" name="nrequisicao" style="text-align-last:center; margin-top:1rem; color: #6C757D;">
              <option value="" disabled selected>Guia</option>
              <?php
              $busca = mysqli_query($conn, "SELECT * FROM guia where tipo_guia_id=2");
              foreach ($busca as $eachRow) {
                ?>
                <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['numero_requisicao'] ?></option>
              <?php
            }
            ?>
            </select>
          </div>
          <div style="text-align:center">
            <form class="form-signin" method="post">
              <input class="form-control" type="input" id="inputMorada" name="morada" placeholder="Morada de entrega" style="text-align:center; margin-top:1rem;" required>
          </div>
          <div style="text-align:center">
            <input class="form-control" placeholder="Data e hora prevista de recolha" style="text-align:center; margin-top:1rem;" name="data" class="textbox-n" type="text" onfocus="(this.type='datetime-local')" id="date">
          </div>
          <div style="text-align:center">
            <select class="form-control" name="artigo" style="text-align-last:center; margin-top:1rem; color: #6C757D;">
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
          </div>
          <div style="text-align:center">
            <input class="form-control" type="number" name="npaletes" placeholder="Número de paletes" min=0 style="text-align:center; margin-top:1rem;">
          </div>
          <button style="margin-top:1rem;" class="btn btn-primary btn-block btn-signin" type="submit">Confirmar</button>
        </form>
      </div>
    </div>
    </form>
  </div>
  </div>
  </div>

</body>

</html>
<script>
  $("#teste").on("change", function() {
    $.ajax({
      url: 'showGuiaAjax.php',
      type: 'POST',
      data: {
        id: $("#teste").val()
      },
      beforeSend: function() {
        $("#Espaco").css({
          'display': 'block'
        });
        $("#Card").css({
          'display': 'block'
        });
        $("#Espaco").html("Carregando...");
      },
      success: function(data) {
        $("#Espaco").css({
          'display': 'block'
        });
        $("#Card").css({
          'display': 'block'
        });
        $("#testediv").css({
          'display': 'block'
        });
        $("#Espaco").html(data);
      },
      error: function(data) {
        $("#Espaco").css({
          'display': 'block'
        });
        $("#Card").css({
          'display': 'block'
        });
        $("#Espaco").html("Houve um erro ao carregar");
      }
    });
  });
</script>

<script type="text/javascript">
  // document.getElementById('comboboxArtigo').value = "<?php echo $_POST['comboboxArtigo']; ?>";
  document.getElementById('comboBoxGuiaId').value = "<?php echo $_POST['comboBoxGuiaId']; ?>";
  document.getElementById('comboBoxLocalizacao').value = "<?php echo $_POST['comboBoxLocalizacao']; ?>";
  document.getElementById('teste').value = "<?php echo $_POST['comboboxGuiaEntrega']; ?>";
</script>