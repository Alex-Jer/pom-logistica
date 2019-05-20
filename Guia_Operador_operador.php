<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarOperador.php';
include 'db.php';
if ($_SESSION["perfilId"] == 1) {
  header("Location: index.php");
  ?>
  <script type="text/javascript">
    alert("Voce nao tem permissoes para acessar a isso");
  </script>
<?php
}
$count = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idGuia = $_POST["Confirm3"];
  $sql = mysqli_query($conn, "SELECT guia.cliente_id as cliente, guia.id, guia.artigo_id as artigo,guia.armazem_id as armazem_id, guia.numero_paletes as npaletes,guia.tipo_palete_id as tp,guia.tipo_zona_id as tzid, guia.numero_requisicao as numero_requisicao ,guia.morada as morada, palete.id as palete_id, zona.id as zona FROM guia INNER JOIN palete on palete.artigo_id=guia.artigo_id INNER JOIN localizacao on localizacao.palete_id=palete.id INNER JOIN zona ON (zona.id=localizacao.zona_id and zona.armazem_id=guia.armazem_id and zona.tipo_zona_id=guia.tipo_palete_id) WHERE guia.id='$idGuia'");

  $dado = mysqli_fetch_array($sql);
  $cliente = $dado["cliente"];

  $morada = $dado["morada"];
  $artigo = $dado["artigo"];
  $npal = $dado["npaletes"];
  $nrequisicao = $dado['numero_requisicao'];

  $tipoPalete = $dado['tp'];
  //echo $paleteeID;
  date_default_timezone_set("Europe/Lisbon");
  $data = date("Y-m-d H:i:s");
  $zonaID = $dado['zona'];

  $armazemID = $dado['armazem_id'];
  $tipoZona = $dado['tzid'];


  //echo "cliente: $cliente , nreq: $nrequisicao , morada: $morada , data: $data , artigo: $artigo , npaletes: $npaletes";
  $sql = "INSERT INTO guia (cliente_id, guia_id, tipo_guia_id, tipo_palete_id, tipo_zona_id, armazem_id, artigo_id, data_prevista, numero_paletes, numero_requisicao, morada, confirmar,confirmarTotal) 
                    VALUES ($cliente, $idGuia, 4, $tipoPalete, $tipoZona, $armazemID, $artigo, '$data', '$npal', '$nrequisicao', '$morada',1,1)";
  if (mysqli_query($conn, $sql)) { }

  $sql10 = mysqli_query($conn, "UPDATE guia SET confirmar = 1, confirmarTotal = 1 WHERE id=$idGuia ");
  if (mysqli_query($conn, $sql10)) { }

  $sql6 = mysqli_query($conn, "SELECT * FROM palete WHERE artigo_id='$artigo' ORDER BY Data ASC");
  //$sql7 = mysqli_query($conn, "DELETE FROM palete WHERE artigo_id='$sql5' ORDER BY Data ASC LIMIT $npaletes");
  foreach ($sql6 as $eachRow2) {
    $count++;
    if ($count <= $npal) {
      //echo $count;
      $paleteId = $eachRow2['id'];
      $sql10 = mysqli_query($conn, "UPDATE localizacao SET hasPalete = 0, palete_id = NULL, zona_id = NULL, data_entrada = NULL WHERE palete_id=$paleteId ORDER BY data_entrada ASC LIMIT $npal");
      if (mysqli_query($conn, $sql10)) {
        ?>
      <?php
    }
    $sql11 = mysqli_query($conn, "UPDATE palete SET Data_Saida = '$data'  where artigo_id= $artigo and Data_Saida IS NULL ORDER BY Data ASC LIMIT $npal");
    if (mysqli_query($conn, $sql11)) {
      ?>
      <?php
    }
  }
}
}
?>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="styles\table.css">
  <link rel="stylesheet" href="node_modules\jquery\dist\jquery.js">
  <link rel="stylesheet" href="styles\style3.css">
  <link rel="stylesheet" href="css\bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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

  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    background-color: #ffffff;
  }

  tbody,
  thead tr {
    display: block;
  }

  tbody {
    max-height: 20rem;
    overflow-y: auto;
    overflow-x: hidden;
  }

  tbody td,
  thead th {
    width: 14rem !important;
    max-width: 30rem !important;
  }

  thead th:last-child {
    width: 230px !important;
    /* 140px + 16px scrollbar width */
  }

  .btn-success {
    background-color: #01d932 !important;
  }
</style>

<body>
  <form class="container" action="Guia_Operador_operador.php" style="font-family: 'Varela Round', sans-serif; font-size:13px; z-index:1" method="post">
    <div class="table-wrapper" style="margin-top:10rem;">
      <ul class="nav nav-pills">
        <li class="nav-item" style="margin-top:-8.5rem; margin-left:-1.5rem;">
          <button style="border-radius:0.2rem; margin-right:1rem; background-color:#f5f5f5" class="nav-link active" value="1" data-toggle="pill" id="notConfirmed">Por Confirmar</button>
        </li>
        <li class="nav-item" style="margin-top:-8.5rem;">
          <button style="border-radius:0.2rem; background-color:#f5f5f5" class="nav-link" value="2" data-toggle="pill" id="Confirmed">Confirmadas</button>
        </li>
      </ul>
      <div class="table-title" style="background-color:#0275d8; margin-top:-5.5rem;">
        <div class="row">
          <div class="col-sm-6">
            <h2>Guias de <b>Transporte</b></h2>
          </div>
        </div>
      </div>
      <table style="margin-top:-0.6rem; margin-left:auto; margin-right:auto;" class="table table-striped table-hover">
        <thead>
          <tr>
            <th style="width:20%">Cliente</th>
            <th style="width:15%">Nº de Guia</th>
            <th style="width:25%">Dia e hora da carga</th>
            <th style="width:13%">Nº de Paletes</th>
            <th style="width:20%">Artigo</th>
            <th style="width:20%">Armazém</th>
            <th style="width:10%"></th>
          </tr>
        </thead>
        <tbody id="Testeeee">
        </tbody>
      </table>
      <div id="DivEntrega"></div>
    </div>
  </form>
</body>

</html>

<script>
  $("#notConfirmed").on("click", function() {
    $.ajax({
      url: 'ajaxDevolucao2.php',
      type: 'POST',
      data: {
        id: $("#notConfirmed").val()
      },
      success: function(data) {
        $("#Testeeee").html(data);
      },
    });
  });
</script>

<script>
  $("#Confirmed").on("click", function() {
    $.ajax({
      url: 'ajaxPedidosTotaisOP.php',
      type: 'POST',
      data: {
        id: $("#Confirmed").val(),
        dataescolhida: $("#DataEntrega2").val()

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
      url: 'ajaxDevolucao2.php',
      type: 'POST',
      data: {
        id: $("#notConfirmed").val()
      },
      success: function(data) {
        $("#notConfirmed").removeClass('btn2')
        $("#notConfirmed").addClass('btn3')
        $("#Testeeee").html(data);
      },
    });
  });
</script>