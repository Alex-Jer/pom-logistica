<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
$navbar = $_SERVER['DOCUMENT_ROOT'];
$navbar .= "/POM-Logistica/Navbar/navbarAdmin.php";
include_once($navbar);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["data"])) {
    $data = $_POST["data"];
  } elseif (isset($_POST["saveEntrega"])) {
    $nomeCli = $_POST["comboboxCli"];
    $dataEntrega = $_POST["dataentrega"];
    $getCBart = $_POST["comboboxArtigo"];
    $getQT = $_POST["qt"];
    $getCBtp = $_POST["comboboxTipo_Palete"];
    $getCBtz = $_POST["comboboxTipoZona"];
    $getREQ = $_POST["req"];
    $getArmazem = $_POST["Armazem"];
    $getREQ = "REQ-$getREQ";
    $stmt = $conn->prepare("INSERT INTO guia (cliente_id, tipo_guia_id, tipo_palete_id, tipo_zona_id,armazem_id,artigo_id,data_prevista,numero_paletes, numero_requisicao) VALUES (?,1,?,?,?,?,?,?,?)");
    $stmt->bind_param("iiiiisis", $nomeCli, $getCBtp, $getCBtz, $getArmazem, $getCBart, $dataEntrega, $getQT, $getREQ);
    $stmt->execute();
  } elseif (isset($_POST["saveTransporte"])) {
    $cliente = $_POST['cliente'];
    $matricula = $_POST["matricula"];
    $horadescarga = $_POST["horadescarga"];
    $morada = $_POST["morada"];
    $nreq = $_POST["Referencia"];
    $npal = $_POST["NPaletes"];
    $artigoo = $_POST["artigo"];
    $Localidade = $_POST["Localidade"];
    $nreq = "REQ-$nreq";

    $stmt = $conn->prepare("SELECT palete.tipo_palete_id as tipo_palete_id, palete.id as id, localizacao.zona_id as zona_id, zona.armazem_id as armazem_id, zona.tipo_zona_id as tipo_zona_id FROM palete INNER JOIN localizacao ON localizacao.palete_id=palete.id INNER JOIN zona on zona.id=localizacao.zona_id WHERE artigo_id=?");
    $stmt->bind_param("s", $artigoo);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($tipoPaleteId, $paleteeID, $zonaID, $armazemID, $tipoZona);
    $stmt->fetch();
    //echo $armazemID;

    $stmt = $conn->prepare("INSERT INTO guia (cliente_id, tipo_guia_id, tipo_palete_id, tipo_zona_id, armazem_id, artigo_id, data_prevista, numero_paletes, numero_requisicao, morada, localidade, matricula) VALUES (?,2,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("iiiiisissss", $cliente, $tipoPaleteId, $tipoZona, $armazemID, $artigoo, $horadescarga, $npal, $nreq, $morada, $Localidade, $matricula);
    // var_dump($cliente, $tipoPaleteId, $tipoZona, $armazemID, $artigoo, $horadescarga, $npal, $nreq, $morada, $Localidade, $matricula);
    $stmt->execute();
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.56/pdfmake.min.js.map"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.56/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>

  <!-- DataTable -->
  <script>
    $(document).ready(function() {
      var dataTable = $('#myTable').DataTable({
        "language": {
          url: 'http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json'
        },
        dom: 'Bfrtip',
        buttons: [{
            extend: 'copy',
            text: 'Copiar',
          },
          {
            extend: 'excel',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'pdf',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'print',
            text: 'Imprimir',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
        ],
        "processing": true,
        "paging": true,
        "pageLength": 6,
        "bLengthChange": false,
        "ordering": false,
        "info": false,
        initComplete: function() {
          $('.buttons-copy').removeClass('dt-button');
          $('.buttons-copy').addClass('btn');
          $('.buttons-copy').addClass('btn-outline-warning');

          $('.buttons-excel').removeClass('dt-button');
          $('.buttons-excel').addClass('btn');
          $('.buttons-excel').addClass('btn-outline-warning');

          $('.buttons-pdf').removeClass('dt-button');
          $('.buttons-pdf').addClass('btn');
          $('.buttons-pdf').addClass('btn-outline-warning');

          $('.buttons-print').removeClass('dt-button');
          $('.buttons-print').addClass('btn');
          $('.buttons-print').addClass('btn-outline-warning');
        }
      });
    });
  </script>
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
    margin-left: 50.1rem;
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
  <?php
  $timeRN = date("Y-m-d");
  ?>
  <form class="container" action="\POM-Logistica\Admin\Listagens\Listar_todas_as_guias.php" style="font-family: 'Varela Round', sans-serif; font-size:13px; z-index:1;" method="post">
    <div class="table-wrapper" style="margin-top:10rem;">
      <ul class="nav nav-pills">
        <li class="nav-item" style="margin-top:-8.5rem; margin-left:-1.5rem;">
          <button style="border-radius:0.2rem; margin-right:1rem;" class="nav-link btn3" value="1" data-toggle="pill" id="notConfirmed" name="entrega">Entrega</button>
        </li>
        <li class="nav-item" style="margin-top:-8.5rem;">
          <button style="border-radius:0.2rem;" class="nav-link btn3" value="2" data-toggle="pill" id="Confirmed" name="transporte">Transporte</button>
        </li>
        <li style="margin-top:-8.5rem">
          <input class="form-control" style="text-align:center; text-indent:1.5rem; margin-left:5rem; margin-right:auto; width:15rem; height:2rem; position:absolute; z-index:500; margin-top:4rem; border-radius:2px;" id="DataEntrega2" type="text" name="Dataentrega2" placeholder="Data e hora de entrega" onfocus="(this.type='date')">
        </li>
      </ul>
      <div id="guiaTeste" style="margin-top:-5.5rem; margin-left:auto; margin-right:auto; width:66.3rem;"></div>
      <div id="Testeeee"></div>
      <!--MODAL HERE -->
      <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" id="ModalGuia">
          </div>
        </div>
      </div>
    </div>
    <!--Modal Detalhes-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-left:auto; margin-right:auto; width:90%">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalhes da Guia</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="TableDetails"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <script>
    $("#notConfirmed").on("click", function() {
      $.ajax({
        url: '/POM-Logistica/Ajax/ajaxPedidosTotais.php',
        type: 'POST',
        data: {
          id: $("#notConfirmed").val(),
          dataescolhida: $("#DataEntrega2").val()
        },
        success: function(data) {
          $("#notConfirmed").removeClass('btn2')
          $("#notConfirmed").addClass('btn3')
          $("#Confirmed").removeClass('btn3')
          $("#Confirmed").addClass('btn2')
          $("#Testeeee").html(data);
        },
      });

      $.ajax({
        url: '/POM-Logistica/Ajax/ajaxGuiaTeste.php',
        type: 'POST',
        data: {
          id: $("#notConfirmed").val(),

        },
        success: function(data) {
          $("#guiaTeste").html(data);
        },
      });

      // $.ajax({
      //   url: '/POM-Logistica/Ajax/ajaxArmazemOuMorada.php',
      //   type: 'POST',
      //   data: {
      //     id: $("#notConfirmed").val(),

      //   },
      //   success: function(data) {
      //     $("#armazemOuMorada").html(data);
      //   },
      // });
    });

    $("#Confirmed").on("click", function() {
      $.ajax({
        url: '/POM-Logistica/Ajax/ajaxPedidosTotais.php',
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

      $.ajax({
        url: '/POM-Logistica/Ajax/ajaxGuiaTeste.php',
        type: 'POST',
        data: {
          id: $("#Confirmed").val(),

        },
        success: function(data) {
          $("#guiaTeste").html(data);
        },
      });

      // $.ajax({
      //   url: '/POM-Logistica/Ajax/ajaxArmazemOuMorada.php',
      //   type: 'POST',
      //   data: {
      //     id: $("#Confirmed").val(),

      //   },
      //   success: function(data) {
      //     $("#armazemOuMorada").html(data);
      //   },
      // });
    });

    $(document).ready(function() {
      $.ajax({
        url: '/POM-Logistica/Ajax/ajaxPedidosTotais.php',
        type: 'POST',
        data: {
          id: $("#notConfirmed").val(),
          dataescolhida: $("#DataEntrega2").val()
        },
        success: function(data) {
          $("#notConfirmed").removeClass('btn2')
          $("#notConfirmed").addClass('btn3')
          $("#Confirmed").removeClass('btn3')
          $("#Confirmed").addClass('btn2')
          $("#Testeeee").html(data);
        },
      });

      $.ajax({
        url: '/POM-Logistica/Ajax/ajaxGuiaTeste.php',
        type: 'POST',
        data: {
          id: $("#notConfirmed").val(),

        },
        success: function(data) {
          $("#guiaTeste").html(data);
        },
      });

      // $.ajax({
      //   url: '/POM-Logistica/Ajax/ajaxArmazemOuMorada.php',
      //   type: 'POST',
      //   data: {
      //     id: $("#notConfirmed").val(),

      //   },
      //   success: function(data) {
      //     $("#armazemOuMorada").html(data);
      //   },
      // });
    });

    $("#DataEntrega2").on("change", function() {
      $.ajax({
        url: '/POM-Logistica/Ajax/ajaxPedidosTotais.php',
        type: 'POST',
        data: {
          id: $("#notConfirmed").val(),
          dataescolhida: $("#DataEntrega2").val()
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

    $(".modal").on("hidden.bs.modal", function() {
      $(".modal-body1").html("");
    });
  </script>
</body>

</html>