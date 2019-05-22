<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarOperador.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['Confirm'])) {
   
    $buscaId = mysqli_query($conn, "SELECT * FROM guia WHERE id='" . $_POST['Confirm'] . "'");
    $dado = mysqli_fetch_array($buscaId);
    $tpID = $dado['tipo_palete_id'];
    $arID = $dado['armazem_id'];
    $cliID = $dado['cliente_id'];
    date_default_timezone_set("Europe/Lisbon");
    $timeRN = date("Y-m-d H:i:s");
    $getCBtz = $dado['tipo_zona_id'];
    $getArtigo = $dado['artigo_id'];
    $qtPal = $dado['numero_paletes'];
    $numeroReq = $dado['numero_requisicao'];
    $sql = "INSERT INTO guia (cliente_id,guia_id, tipo_guia_id, tipo_palete_id, tipo_zona_id,armazem_id,artigo_id,data_prevista,numero_paletes, numero_requisicao,confirmar) VALUES ($cliID,'" . $_POST['Confirm'] . "',3,$tpID, $getCBtz,$arID,$getArtigo, '$timeRN', $qtPal,'$numeroReq',1)";
    if (mysqli_query($conn, $sql)) { } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $sql2 = "UPDATE guia SET confirmar=1 where id='" . $_POST['Confirm'] . "'";
    if (mysqli_query($conn, $sql2)) { } else {
      echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    }
  } elseif (isset($_POST['confirmTotal'])) {
    //echo $_POST['confirmTotal'];

    $updateGuia = mysqli_query($conn, "UPDATE guia SET confirmarTotal=1 WHERE id='" . $_POST['confirmTotal'] . "'");
    if (mysqli_query($conn, $updateGuia)) { }
  } elseif (isset($_POST['save'])) {
    date_default_timezone_set("Europe/Lisbon");
    $timeRN = date("Y-m-d H:i:s");
    $dataehora = $timeRN;
    $referencia = $_POST['refpal'];

    $referencia = "PAL-$referencia";
    // echo $referencia;
    $nomepal = $_POST['nomepal'];
    $eachLocalizacao = $_POST['comboBoxLocalizacao'];

    $buscaId = mysqli_query($conn, "SELECT guia.id,guia.artigo_id, guia.tipo_zona_id, zona.id as zonaid, zona.espaco as zonaespaco, armazem.espaco as armazemespaco,guia.tipo_palete_id,guia.armazem_id FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN tipo_palete on guia.tipo_palete_id=tipo_palete.id INNER JOIN armazem on guia.armazem_id=armazem.id INNER JOIN zona on (zona.armazem_id=armazem.id and zona.tipo_zona_id=tipo_palete.id) where guia.id='" . $_POST['Guia_ID2'] . "'");
    $dado = mysqli_fetch_array($buscaId);
    $tpID = $dado['tipo_palete_id'];
    $arID = $dado['armazem_id'];
    $artigo = $dado['artigo_id'];
    $zonaID = $dado['zonaid'];
    $getEspacoo = $dado['zonaespaco'];
    $espaco = $getEspacoo - 1;
    $getArmaID = $dado['armazemespaco'];
    $getEspaco2 = $dado['armazemespaco'];
    $espacoTotal = $getEspaco2 - 1;

    $result = $conn->prepare("SELECT count(*) FROM palete  WHERE referencia = ?");
    $result->bind_param("s", $referencia);
    $result->execute();
    $result->store_result();
    $result->bind_result($count);
    $result->fetch();
    // echo $count;

    $countEspaco = $conn->query("SELECT count(*) FROM localizacao  WHERE hasPalete = 1 AND zona_id=$zonaID");
    $row12 = $countEspaco->fetch_row();
    //echo '#: ', $row12[0];
    $countRows = $row12[0];

    date_default_timezone_set("Europe/Lisbon");
    $timeRN = date("Y-m-d H:i:s");
    $nomepal = "Palete de $nomepal";
    // echo $referencia;

    if ($count == 0) {
      $stmt = $conn->prepare("INSERT INTO palete (guia_entrada_id, artigo_id, tipo_palete_id, referencia, nome, Data) VALUES ('" . $_POST['Guia_ID2'] . "',?,?,?,?,?)");
      $stmt->bind_param("iisss",  $artigo, $tpID, $referencia, $nomepal, $timeRN);
      $stmt->execute();

      $stmt = $conn->prepare("SELECT id FROM palete WHERE referencia=?");
      $stmt->bind_param("s", $referencia);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($palete_idd);
      $stmt->fetch();

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
        alert("Essa referencia de palete já existe");
      </script>
    <?php
  }
}
}
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="styles\table.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link rel="stylesheet" href="styles\style3.css">
  <link rel="stylesheet" href="css\bootstrap.css">
</head>

<style>
  body {
    overflow: hidden;
  }

  /* width */
  ::-webkit-scrollbar {
    width: 0.3rem;
  }

  /* Track */
  ::-webkit-scrollbar-track {
    background: #f1f1f1;
  }

  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #007bff;
  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #0056b3;
  }

  .btn-success {
    background-color: #01d932;
  }

  .btn-success:hover {
    background-color: #01bc2c;
  }

  tbody {
    display: block;
    max-height: 22rem;
    overflow-y: auto;
    overflow-x: hidden;
  }

  thead,
  tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;
    /* even columns width , fix width of table too*/
  }

  thead {
    width: calc(100% - 1rem)
      /* scrollbar is average 1em/16px width, remove it from thead width */
  }
  .table-row{
  cursor:pointer;
  }

  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    background-color: #ffffff;
  }
</style>

<body>
  <form class="container" style="font-family: 'Varela Round', sans-serif; font-size:13px;" action="InserirPaletes.php" method="post" id="mainForm" novalidate>
    <div class="container" style="margin-left:-6rem">
      <ul class="nav nav-pills" style="margin-top:4rem;">
        <li class="nav-item">
          <button style="border-radius:0.2rem; background-color:#f5f5f5; margin-right:1rem;" class="nav-link active btn2" value="1" data-toggle="pill" id="notConfirmed">Por Confirmar</button>
        </li>
        <li class="nav-item">
          <button style="border-radius:0.2rem; background-color:#f5f5f5" class="nav-link btn2" value="2" data-toggle="pill" id="Confirmed">Confirmadas</button>
        </li>
      </ul>
      <div class="table-wrapper" style="margin-top:0.3rem; width:80rem">
        <div class="table-title" style="background-color:#0275d8; width:80rem">
          <div class="row">
            <div class="col-sm-6">
              <h2>Gerir <b>Paletes</b></h2>
            </div>
          </div>
        </div>
        <div style="text-align:center; width:80rem">
          <div class="container">
            <table class="table table-striped table-hover" style="margin-top:-0.6rem; margin-left:-5.5rem; width:77rem">
              <thead style="width:77rem">
                <tr>
                  <th style="width:20%">Cliente</th>
                  <th style="width:20%">Nº requisição</th>
                  <th style="width:20%">Dia e hora da carga</th>
                  <th style="width:15%">Nº de paletes</th>
                  <th style="width:20%">Artigo</th>
                  <th style="width:20%">Armazém</th>
                  <th style="width:15%">Confirmar</th>
                  <th style="width:15%;">Registar Palete</th>
                </tr>
              </thead>
              <tbody id="Testeeee">
              </tbody>
            </table>
          </div>
          <div id="DivEntrega2"></div>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Registar palete</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  </button>
                </div>
                <div class="modal-body">
                  <select style="text-align-last:center; margin-top:1rem; color: #6C757D;" class="form-control" name="comboBoxLocalizacao" id="comboBoxLocalizacao" required>
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
                  <div style="text-align:center;" class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="height:2.35rem; margin-top:1rem; width:5.65rem; text-indent:1.15rem;" id="inputGroup-sizing">PAL-</span>
                    </div>
                    <input type="text" class="form-control" style="width:5rem; margin-top:1rem;" placeholder="Referência da palete" name="refpal" required>
                  </div>
                  <div style="text-align:center; margin-top:-1.5rem;" class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="height:2.35rem; margin-top:1rem;" id="inputGroup-sizing">Palete de</span>
                    </div>
                    <input placeholder="Nome da palete" class="form-control" style="width:5rem; margin-top:1rem;" type="text" id="inputdata" name="nomepal" placeholder="Data" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary" name="save">Confirmar</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Detalhes da Guia</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  </button>
                </div>
                <div class="modal-body" id="TableDetails">
                </diV>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</body>

</html>

<script>
  $("#notConfirmed").on("click", function() {
    $.ajax({
      url: 'ajaxTeste2.php',
      type: 'POST',
      data: {
        id: $("#notConfirmed").val()
      },
      success: function(data) {
        $("#notConfirmed").removeClass('btn2')
        $("#notConfirmed").addClass('btn3')
        $("#Confirmed").removeClass('btn3')
        $("#Confirmed").addClass('btn2')
        $("#Testeeee").html(data);
      },
    });
  });
</script>

<script>
  $("#Confirmed").on("click", function() {
    $.ajax({
      url: 'ajaxTeste2.php',
      type: 'POST',
      data: {
        id: $("#Confirmed").val()
      },
      success: function(data) {

        $("#Confirmed").removeClass('btn2')
        $("#Confirmed").addClass('btn3')
        $("#notConfirmed").removeClass('btn3')
        $("#notConfirmed").addClass('btn2')
        $("#Testeeee").html(data);
      },
    });
  });
</script>

<script>
  $(document).ready(function() {
    $.ajax({
      url: 'ajaxTeste2.php',
      type: 'POST',
      data: {
        id: $("#notConfirmed").val()
      },
      success: function(data) {
        $("#notConfirmed").removeClass('btn2')
        $("#notConfirmed").addClass('btn3')
        $("#Confirmed").removeClass('btn3')
        $("#Confirmed").addClass('btn2')
        $("#Testeeee").html(data);
      },
    });
  });
</script>

<script type="text/javascript">
  $('mainForm').submit(function() {
    singleAmount = $("#confirmTotal").val();
    if (confirm("Are you sure you want to submit the value of " + singleAmount + " ?"))
      return true;
    else
      return false;
  });
</script>