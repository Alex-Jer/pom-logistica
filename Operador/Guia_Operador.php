<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
$navbar = $_SERVER['DOCUMENT_ROOT'];
$navbar .= "/POM-Logistica/Navbar/navbarOperador.php";
include_once($navbar);
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
  <link rel="stylesheet" href="\POM-Logistica\styles\table.css">
  <link rel="stylesheet" href="\POM-Logistica\css\bootstrap.css">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css">
  <!-- <link rel="stylesheet" href="/POM-Logistica/css/datatables.css"> -->

  <!-- DataTables JavaScript -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
</head>

<style>
  body {
    background-color: #f5f5f5 !important;
  }

  .table-row {
    cursor: pointer;
  }

  .table thead th {
    vertical-align: bottom;
    border-bottom: 0px solid #dee2e6;
    border-top: 0px solid #dee2e6;
  }

  .table-title {
    margin: -20px -25px 0px !important;
  }

  .dataTables_filter {
    display: none;
  }

  .pagination>li>a,
  .pagination>li>span {
    /* margin-top: 2rem; */
    text-align: center;
    border-style: solid !important;
    border-width: 1px !important;
    border-color: #dfe3e7 !important;
    background-color: #fff !important;
    border-radius: 1px !important;
    margin: 2rem -1px !important;
    font-size: 14.4px !important;
    font-family: "Helvetica Neue", HelveticaNeue, Helvetica, Arial, sans-serif !important;
  }

  .pagination>li.active>a,
  .pagination>li.active>span {
    /* margin-top: 2rem; */
    font-size: 14.4px !important;
    background-color: #007bff !important;
    border-radius: 1px !important;
    margin: 2rem 0 !important;
    font-family: "Helvetica Neue", HelveticaNeue, Helvetica, Arial, sans-serif !important;
  }

  #myTable_previous a {
    /* background-color: black !important; */
    border-style: solid !important;
    border-width: 1px !important;
    border-color: #dfe3e7 !important;
    border-radius: 3px 1px 1px 3px !important;
    color: #007bff !important;
  }

  #myTable_next a {
    /* background-color: black !important; */
    border-style: solid !important;
    border-width: 1px !important;
    border-color: #dfe3e7 !important;
    border-radius: 1px 3px 3px 1px !important;
    color: #007bff !important;
  }

  .dataTables_wrapper .dt-buttons {
    position: absolute;
    margin-top: -7.3rem;
    margin-left: -1.6rem;
    float: none;
    text-align: left;
  }

  .btn-outline-warning {
    border-radius: 1px;
  }

  .buttons-copy {
    border-radius: 3px 1px 1px 3px;
    border-right: none;
  }

  .buttons-excel {
    margin-left: -4px;
    border-left: none;
    border-right: none;
  }

  .buttons-pdf {
    margin-left: -4px;
    border-left: none;
    border-right: none;
  }

  .buttons-print {
    margin-left: -4px;
    border-radius: 1px 3px 3px 1px;
    border-left: none;
  }

  .modal-backdrop {
    opacity: 0.3 !important;
  }
</style>

<body>
  <form class="container" action="/POM-Logistica/Operador/Guia_Operador.php" style="font-family: 'Varela Round', sans-serif; font-size:13px; z-index:1" method="post">
    <div class="table-wrapper" style="margin-top:5rem;">
      <div class="table-title" style="background-color:#0275d8; margin-top:-5.5rem;">
        <div class="row">
          <div class="col-sm-6">
            <h2>Guias de <b>Transporte</b> por confirmar</h2>
            <input type="search" z-index="500" class="form-control" placeholder="Procurar" style="text-align:left; width:15rem; height:2rem; position:absolute; margin-left:51rem; margin-top:-2.1rem; border-radius:2px" id="searchbox">
          </div>
        </div>
      </div>
      <div id="Testeeee"></div>
      <div id="DivEntrega"></div>
    </div>
  </form>
</body>

</html>

<script>
  $("#notConfirmed").on("click", function() {
    $.ajax({
      url: '/POM-Logistica/Ajax/ajaxDevolucao2.php',
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
      url: '/POM-Logistica/Ajax/ajaxConfirmar.php',
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
      url: '/POM-Logistica/Ajax/ajaxDevolucao2.php',
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