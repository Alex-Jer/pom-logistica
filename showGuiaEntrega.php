<?php
<<<<<<< HEAD
<<<<<<< HEAD
include 'operador.php';
=======
session_start();
//include 'operador.php';
>>>>>>> 61999857b0b61dfd2b17cdec280e99798503bf38
=======
session_start();
//include 'operador.php';
>>>>>>> 61999857b0b61dfd2b17cdec280e99798503bf38
include 'db.php';
if ($_SESSION["user"]==1)
{
    
    header("Location: Login.php");
    ?>
    <script type="text/javascript">
            alert("Voce nao tem permissoes para acessar a isso");
        </script>
        <?php
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $dataehora = $_POST['dataentrega'];
  $artigo = $_POST['comboboxArtigo'];
  $guiaentrada = $_POST['comboBoxGuiaId'];
  $referencia = $_POST['refpal'];
  $nomepal = $_POST['nomepal'];
  $eachLocalizacao = $_POST['comboBoxLocalizacao'];

  $buscaId = mysqli_query($conn, "SELECT * FROM guia WHERE id='$guiaentrada'");
  $dado = mysqli_fetch_array($buscaId);
  $tpID = $dado['tipo_palete_id'];
  $arID = $dado['armazem_id'];
  $cliID = $dado['cliente_id'];

  $buscaZoID = mysqli_query($conn, "SELECT * FROM zona WHERE armazem_id='$arID' AND tipo_zona_id=' $tpID'");
  $dado3 = mysqli_fetch_array($buscaZoID);
  $zonaID = $dado3['id'];

  // $sqlCount = mysqli_query("SELECT count(*) FROM palete  WHERE referencia = '$referencia'");
  $result = $conn->query("SELECT count(*) FROM palete  WHERE referencia = '$referencia'");
  $row = $result->fetch_row();
  echo '#: ', $row[0];
  $count = $row[0];

  $countEspaco = $conn->query("SELECT count(*) FROM localizacao  WHERE hasPalete = 1 AND zona_id=$zonaID");
  $row12 = $countEspaco->fetch_row();
  echo '#: ', $row12[0];
  $countRows = $row12[0];

  $getEspaco = mysqli_query($conn, "SELECT * FROM zona WHERE id='$zonaID'");
  $dado = mysqli_fetch_array($getEspaco);
  $getEspacoo = $dado['espaco'];
  $espaco = $getEspacoo - 1;
  echo $espaco;
  $getArmaID = $dado['armazem_id'];

  $getEspaco = mysqli_query($conn, "SELECT * FROM armazem WHERE id='$getArmaID'");
  $dado2 = mysqli_fetch_array($getEspaco);
  $getEspaco2 = $dado2['espaco'];
  $espacoTotal = $getEspaco2 - 1;

  date_default_timezone_set("Europe/Lisbon");
  $timeRN = date("Y-m-d H:i:s");

  if ($count == 0) {
    $sql = "INSERT INTO palete (guia_entrada_id, artigo_id, tipo_palete_id, referencia, nome, Data) VALUES ('$guiaentrada', '$artigo','$tpID', 'PAL- + $referencia','Palete de + $nomepal', '$timeRN')";
    if (mysqli_query($conn, $sql)) {
      ?>
    <?php
<<<<<<< HEAD

  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }


  $buscaPaleteID = mysqli_query($conn, "SELECT * FROM palete WHERE referencia='$referencia'");
  $dado2 = mysqli_fetch_array($buscaPaleteID);
  $palete_idd = $dado2['id'];

=======

  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }


  $buscaPaleteID = mysqli_query($conn, "SELECT * FROM palete WHERE referencia='$referencia'");
  $dado2 = mysqli_fetch_array($buscaPaleteID);
  $palete_idd = $dado2['id'];

>>>>>>> 61999857b0b61dfd2b17cdec280e99798503bf38

  $sqlLocal = "UPDATE localizacao SET palete_id='$palete_idd', zona_id='$zonaID', data_entrada='$dataehora', hasPalete=1 WHERE id='$eachLocalizacao'";
  if (mysqli_query($conn, $sqlLocal)) { } else {
    echo "Error: " . $sqlLocal . "<br>" . mysqli_error($conn);
  }

  $sqlEspaco = "UPDATE armazem SET espaco='$espacoTotal' WHERE id='$getArmaID'";
  if (mysqli_query($conn, $sqlEspaco)) { } else {
    echo "Error: " . $sqlEspaco . "<br>" . mysqli_error($conn);
  }
  $sqlEspacoZona = "UPDATE zona SET espaco='$espaco' WHERE id='$zonaID'";
  if (mysqli_query($conn, $sqlEspacoZona)) { } else {
    echo "Error: " . $sqlEspacoZona . "<br>" . mysqli_error($conn);
  }
} else {
  ?>
    <script type="text/javascript">
      ;
      alert("Essa referencia de palete já existe");
    </script>
  <?php
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
        <a class="nav-link" href="operador.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="armazem.php">Armazém</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Guia_Operador.php">Guia do Operador</a></li>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="showGuiaEntrega.php">Registar Palete</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mudarpass.php">Mudar Palavra-Passe</a>
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
    <div class="row">
      <div class="col card card-container metade w-auto li ">
        <form class="form-signin" action="showGuiaEntrega.php" method="post">
          <div class="row">
            <select style="text-align-last:center; width:21.5rem; margin-top:1rem; margin-bottom:1rem; margin-left:2rem; font-size:15px; color: #6C757D;" class="form-control-lg" name="comboboxGuiaEntrega" id="teste">
              <option value="" selected disabled>Número de requisição</option>
              <?php
              $busca = mysqli_query($conn, "SELECT * FROM guia where tipo_guia_id=1");
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
            <div id="DivEntrega">
              <button style="margin-top:3%; font-size:1.5rem; margin-left:2rem;" type="submit" class="btn btn-primary" id="Entrega">Confirmar entrega</button>
<<<<<<< HEAD
=======
            </div>
          </div>
        </form>
      </div>
      <div class="col dupla card card-container">
        <form class="form-signin" action="showGuiaEntrega.php" method="post">
          <input class="form-control" style="text-align:center; height:3.2rem; width:41.7rem; font-size:1.5rem; margin-top:1rem; type=" text" id="date" name="dataentrega" placeholder="Data e hora de entrega" onfocus="(this.type='datetime-local')" id="date" required>
          <select class="form-control" style="text-align-last:center; margin-top:2%; max-height:200px; height:3.2rem; width:41.7rem; font-size:1.5rem; color: #6C757D;" name="comboboxArtigo" id="comboboxArtigo">
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
          <select class="form-control" style="text-align-last:center; margin-top:2%; max-height:200px; height:3.2rem; width:41.7rem; font-size:1.5rem; color: #6C757D;" name="comboBoxGuiaId" id="comboBoxGuiaId">
            <option value="" disabled selected>Guia</option>
            <?php
            $busca = mysqli_query($conn, "SELECT * FROM guia where tipo_guia_id=1");
            foreach ($busca as $eachRow) {
              ?>
              <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['numero_requisicao'] ?></option>
            <?php
          }
          ?>
          </select>
          <select class="form-control" style="text-align-last:center; margin-top:2%; max-height:200px; height:3.2rem; width:41.7rem; font-size:1.5rem; color: #6C757D;" name="comboBoxLocalizacao" id="comboBoxLocalizacao">
            <option value="" disabled selected>Localização</option>
            <?php
            $busca = mysqli_query($conn, "SELECT * FROM localizacao WHERE hasPalete=0");
            foreach ($busca as $eachRow) {
              ?>
              <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['referencia'] ?></option>
            <?php
          }
          ?>
          </select>
          <div style="text-align:center; max-height:200px; margin-top:2%; height:3.2rem; width:41.7rem; font-size:1.5rem" class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-lg" style="font-size:1.3rem; height:3.2rem;">PAL-</span>
>>>>>>> 61999857b0b61dfd2b17cdec280e99798503bf38
            </div>
            <input style="height:3.2rem; font-size:1.5rem; margin-left:4.2rem; margin-top:-3.15rem;" type="text" class="form-control" placeholder="Referência da palete" name="refpal" required>
          </div>
          <input placeholder="Nome da palete" class="form-control" style="text-align:center; margin-top:2%; max-height:200px; height:3.2rem; width:41.7rem; font-size:1.5rem" type="text" id="inputdata" name="nomepal" placeholder="Data" required>
          <button style="margin-top:3rem; font-size:1.5rem" type="submit" class="btn btn-warning" type="submit">Registar palete</button>
        </form>
      </div>
      <div class="col dupla card card-container">
        <form class="form-signin" action="showGuiaEntrega.php" method="post">
          <input class="form-control" style="text-align:center; height:3.2rem; width:41.7rem; font-size:1.5rem; margin-top:1rem; type=" text" id="date" name="dataentrega" placeholder="Data e hora de entrega" onfocus="(this.type='datetime-local')" id="date" required>
          <select class="form-control" style="text-align-last:center; margin-top:2%; max-height:200px; height:3.2rem; width:41.7rem; font-size:1.5rem; color: #6C757D;" name="comboboxArtigo" id="comboboxArtigo">
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
          <select class="form-control" style="text-align-last:center; margin-top:2%; max-height:200px; height:3.2rem; width:41.7rem; font-size:1.5rem; color: #6C757D;" name="comboBoxGuiaId" id="comboBoxGuiaId">
            <option value="" disabled selected>Guia</option>
            <?php
            $busca = mysqli_query($conn, "SELECT * FROM guia where tipo_guia_id=1");
            foreach ($busca as $eachRow) {
              ?>
              <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['numero_requisicao'] ?></option>
            <?php
          }
          ?>
          </select>
          <select class="form-control" style="text-align-last:center; margin-top:2%; max-height:200px; height:3.2rem; width:41.7rem; font-size:1.5rem; color: #6C757D;" name="comboBoxLocalizacao" id="comboBoxLocalizacao">
            <option value="" disabled selected>Localização</option>
            <?php
            $busca = mysqli_query($conn, "SELECT * FROM localizacao WHERE hasPalete=0");
            foreach ($busca as $eachRow) {
              ?>
              <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['referencia'] ?></option>
            <?php
          }
          ?>
          </select>
          <div style="text-align:center; max-height:200px; margin-top:2%; height:3.2rem; width:41.7rem; font-size:1.5rem" class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-lg" style="font-size:1.3rem; height:3.2rem;">PAL-</span>
            </div>
            <input style="height:3.2rem; font-size:1.5rem; margin-left:4.2rem; margin-top:-3.15rem;" type="text" class="form-control" placeholder="Referência da palete" name="refpal" required>
          </div>
          <input placeholder="Nome da palete" class="form-control" style="text-align:center; margin-top:2%; max-height:200px; height:3.2rem; width:41.7rem; font-size:1.5rem" type="text" id="inputdata" name="nomepal" placeholder="Data" required>
          <button style="margin-top:3rem; font-size:1.5rem" type="submit" class="btn btn-warning" type="submit">Registar palete</button>
        </form>
      </div>
    </div>
    </form>
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

<script>
  $("#Entrega").on("click", function() {
    $.ajax({
      url: 'AjaxGuiaRececao.php',
      type: 'POST',
      data: {
        id: $("#teste").val()
      },
      success: function(data) {
        $("#DivEntrega").html(data);
      },
    });
  });
</script>
<script type="text/javascript">
  // document.getElementById('comboboxArtigo').value = "<?php echo $_POST['comboboxArtigo']; ?>";
  document.getElementById('comboBoxGuiaId').value = "<?php echo $_POST['comboBoxGuiaId']; ?>";
  document.getElementById('comboBoxLocalizacao').value = "<?php echo $_POST['comboBoxLocalizacao']; ?>";
  document.getElementById('teste').value = "<?php echo $_POST['comboboxGuiaEntrega']; ?>";
</script>