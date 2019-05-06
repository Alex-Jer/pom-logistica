<?php
session_start();
include 'operador.php';
include 'db.php';

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

  $buscaZoID = mysqli_query($conn, "SELECT * FROM zona WHERE armazem_id='$arID'");
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
  $getArmaID = $dado['armazem_id'];
  $espaco = $getEspacoo - 1;
  echo $espaco;



  if ($count == 0) {
    $sql = "INSERT INTO palete (guia_entrada_id, artigo_id, tipo_palete_id, referencia, nome) VALUES ('$guiaentrada', '$artigo','$tpID', '$referencia','$nomepal')";
    if (mysqli_query($conn, $sql)) {
      ?>
    <?php

  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  $buscaPaleteID = mysqli_query($conn, "SELECT * FROM palete WHERE referencia='$referencia'");
  $dado2 = mysqli_fetch_array($buscaPaleteID);
  $palete_idd = $dado2['id'];


  $sqlLocal = "UPDATE localizacao SET palete_id='$palete_idd', zona_id='$zonaID',data_entrada='$dataehora',hasPalete=1 WHERE id='$eachLocalizacao'";
  if (mysqli_query($conn, $sqlLocal)) { } else {
    echo "Error: " . $sqlLocal . "<br>" . mysqli_error($conn);
  }

  $sqlEspaco = "UPDATE armazem SET espaco='$espaco' WHERE id='$getArmaID'";
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="node_modules\bootstrap3\dist\css\bootstrap.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script type="text/javascript" src="jquery.js"></script>

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

  <link rel="stylesheet" href="css.css">

</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col card card-container metade w-auto li ">
        <form class="form-signin" action="showGuiaEntrega.php" method="post">
          <div class="row">
            <select name="comboboxGuiaEntrega" id="teste">
              <option value="" selected disabled>Numero Requisicao</option>
              <?php
              $busca = mysqli_query($conn, "SELECT * FROM guia");

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
      <div class="col dupla card card-container ">
        <form class="form-signin" action="showGuiaEntrega.php" method="post">
          <p>Data e Hora da Entrega</p>
          <input type="datetime-local" id="inputdata" name="dataentrega" placeholder="Data" value="<?php echo $_POST['dataentrega']; ?>" required>
          &nbsp;
          <p>Artigo</p>
          <select name="comboboxArtigo" id="comboboxArtigo">
            <?php
            $busca = mysqli_query($conn, "SELECT * FROM artigo");
            foreach ($busca as $eachRow) {
              ?>
              &nbsp;
              <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['referencia'] ?></option>
            <?php
          }

          ?>
          </select>
          <p>Guia</p>
          <select name="comboBoxGuiaId" id="comboBoxGuiaId">
            <?php
            $busca = mysqli_query($conn, "SELECT * FROM guia");
            foreach ($busca as $eachRow) {
              ?>
              &nbsp;
              <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['numero_requisicao'] ?></option>
            <?php
          }

          ?>
          </select>
          <p>Localizacao</p>
          <select name="comboBoxLocalizacao" id="comboBoxLocalizacao">
            <?php
            $busca = mysqli_query($conn, "SELECT * FROM localizacao WHERE hasPalete=0");
            foreach ($busca as $eachRow) {
              ?>
              &nbsp;
              <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['referencia'] ?></option>
            <?php
          }

          ?>
          </select>
          <p>Refrencia Palete</p>
          <input type="text" id="inputdata" name="refpal" value="PAL-" placeholder="Data" value="<?php echo $_POST['refpal']; ?>" required>
          <p>Nome</p>
          <input type="text" id="inputdata" name="nomepal" value="Palete de " placeholder="Data" value="<?php echo $_POST['nomepal']; ?>" required>

          <button type="submit">Registar Palete</button>
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
  document.getElementById('comboboxArtigo').value = "<?php echo $_POST['comboboxArtigo']; ?>";
  document.getElementById('comboBoxGuiaId').value = "<?php echo $_POST['comboBoxGuiaId']; ?>";
  document.getElementById('comboBoxLocalizacao').value = "<?php echo $_POST['comboBoxLocalizacao']; ?>";
</script>