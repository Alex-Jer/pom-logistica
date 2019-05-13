<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
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
  $cliID = $dado['cliente_id'];

  $buscaZoID = mysqli_query($conn, "SELECT * FROM zona WHERE armazem_id='$arID' AND tipo_zona_id=' $tpID'");
  $dado3 = mysqli_fetch_array($buscaZoID);
  $zonaID = $dado3['id'];

  // $sqlCount = mysqli_query("SELECT count(*) FROM palete  WHERE referencia = '$referencia'");
  $result = $conn->query("SELECT count(*) FROM palete  WHERE referencia = '$referencia'");
  $row = $result->fetch_row();
  //echo '#: ', $row[0];
  $count = $row[0];

  $countEspaco = $conn->query("SELECT count(*) FROM localizacao  WHERE hasPalete = 1 AND zona_id=$zonaID");
  $row12 = $countEspaco->fetch_row();
  //echo '#: ', $row12[0];
  $countRows = $row12[0];

  $getEspaco = mysqli_query($conn, "SELECT * FROM zona WHERE id='$zonaID'");
  $dado = mysqli_fetch_array($getEspaco);
  $getEspacoo = $dado['espaco'];
  $espaco = $getEspacoo - 1;
  //echo $espaco;
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

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body>
  <div class="container">
    <div class="card card-container" style="text-align:center; width:100%; max-width: 100000px">
      <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
      <p id="profile-name" class="profile-name-card"></p>
      <form class="container" action="pdf.php" method="post">
        <div style="text-align:center">
          <h1 style="margin-bottom:1rem;">Registar Paletes</h1>
          <div class="container">
            <nav role="navigation">
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link" href="operador.php">Por Confirmar</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="Guia_Operador_operador.php">Guia do Operador</a></li>
                </li>
              </ul>
            </nav>
            <!-- <div style="text-align:center">
                            <button type="submit" id="pdf" class="btn btn-primary" style="width:3.5rem; height:2.2rem; display:none; margin-top:-3.3rem; margin-right:17rem; text-align:center; float:right;">PDF</button>
                        </div> -->
            <table class="table" style="font-size:16px; margin-top:1.5rem;">
              <thead>
                <tr>
                  <th style="width:15%">Cliente</th>
                  <th style="width:30%">Dia e hora da carga</th>
                  <th style="width:15%">Nº de Paletes</th>
                  <th style="width:20%">Artigo</th>
                  <th style="width:20%">Armazém</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $dado = mysqli_query($conn, "SELECT * FROM guia WHERE tipo_guia_id=1 AND (confirmar IS NULL OR confirmarTotal IS NULL) ");
                foreach ($dado as $eachRow) {
                  $cliID = $eachRow['cliente_id'];
                  $GuiaID = $eachRow['id'];
                  $time = $eachRow['data_prevista'];
                  $getArtigo = $eachRow['artigo_id'];
                  $qtPal = $eachRow['numero_paletes'];
                  $numeroReq = $eachRow['numero_requisicao'];
                  $arID = $eachRow['armazem_id'];
                  $confirm = $eachRow['confirmar'];
                  $confirmTotal = $eachRow['confirmarTotal'];
                  $sql2 = mysqli_query($conn, "SELECT * FROM cliente WHERE id='$cliID'");
                  $sql3 = mysqli_fetch_array($sql2);
                  $nomeCliente = $sql3['nome'];
                  $sql4 = mysqli_query($conn, "SELECT * FROM armazem WHERE id='$arID'");
                  $sql5 = mysqli_fetch_array($sql4);
                  $nomeArmazem = $sql5['nome'];
                  $sql6 = mysqli_query($conn, "SELECT * FROM artigo WHERE id='$getArtigo'");
                  $sql7 = mysqli_fetch_array($sql6);
                  $refArtigo = $sql7['referencia'];
                  //Inacabado
                  echo '<tr>';
                  echo '<td> ' . $nomeCliente . '</td>';
                  echo '<td> ' . $time . '</td>';
                  echo '<td> ' . $qtPal . '</td>';
                  echo '<td> ' . $refArtigo . '</td>';
                  echo '<td> ' . $nomeArmazem . '</td>';
                  ?>
                  <!-- <td><input type="submit" name="Ola" ></td> -->
                  <?php if ($confirm == NULL) {
                    ?>
                    <td><button type="button" class="btn btn-primary teste" name="Confirm" id="Confirm" value="<?php echo $GuiaID ?>">Confirmar</button></td>
                  <?php
                } else {
                  ?>
                    <td><button type="submit" class="btn btn-primary poprawa3" name="GuiaID" id="GuiaID" value="<?php echo $GuiaID ?>">Registar Palete</button></td>
                  <?php
                }

                echo '</tr>';
              }
              ?>

              </tbody>

            </table>
            <div id="DivEntrega"></div>
          </div>
      </form><!-- /form -->
    </div><!-- /card-container -->
  </div><!-- /container -->
</body>

</html>

<script>
  $(".teste").on("click", function() {
    $.ajax({
      url: 'AjaxGuiaRececao.php',
      type: 'POST',
      data: {
        id: $(this).val()
      },
      success: function(data) {
        $("#DivEntrega").html(data);
        $("button[name=GuiaID]").css({
          'visibility': 'visible'
        });
        $(this).css({
          'visibility': 'hidden'
        });
      },
    });
  });
</script>