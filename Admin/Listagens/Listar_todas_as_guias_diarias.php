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
  $data = $_POST["data"];
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="\POM-Logistica\styles\table.min.css">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</head>

<style>
  body {
    overflow-x: hidden;
  }

  /* width */
  ::-webkit-scrollbar {
    width: 0.3rem;
    height: 0.3rem;
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

  .table-row {
    cursor: pointer;
  }

  .btn-success {
    background-color: #01d932 !important;
  }

  .table thead th {
    vertical-align: bottom;
    border-bottom: 0px solid #dee2e6;
    border-top: 0px solid #dee2e6;
  }

  @media only screen and (max-width: 992px) {
    #cliente {
      width: 18vw !important;
      padding: 1px 1px;
      font-size: 12px;
    }

    #DataEntrega2 {
      width: 18vw !important;
      padding: 1px 1px;
      font-size: 12px;
      text-indent: 2px !important;
    }

    @media only screen and (max-width: 465px) {
      h2 {
        font-size: 20px !important;
      }
    }

    @media only screen and (max-width: 406px) {
      .table-title {
        height: 6.5rem !important;
      }

      h2 {
        font-size: 22px !important;
        margin-top: 1.5rem !important;
      }

      #cliente {
        width: 40% !important;
        float: right !important;
      }

      #DataEntrega2 {
        width: 40% !important;
        margin-top: 2.5rem;
      }
    }
  }
</style>

<body>
  <?php
  $timeRN = date("Y-m-d");
  ?>
  <form class="container" action="\POM-Logistica\Admin\Listagens\Listar_todas_as_guias_diarias.php" style="font-family: 'Varela Round', sans-serif; font-size:13px; z-index:1" method="post">
    <div class="table-wrapper" style="margin-top:10rem;">
      <ul class="nav nav-pills">
        <li class="nav-item" style="margin-top:-8.5rem; margin-left:-1.5rem;">
          <button style="border-radius:0.2rem; margin-right:1rem; background-color:#fcfcfc" class="nav-link btn2" value="1" data-toggle="pill" id="notConfirmed">Entrega</button>
        </li>
        <li class="nav-item" style="margin-top:-8.5rem;">
          <button style="border-radius:0.2rem; background-color:#fcfcfc" class="nav-link btn3" value="2" data-toggle="pill" id="Confirmed">Transporte</button>
        </li>
      </ul>
      <div class="table-title" style="background-color:#0275d8; margin-top:-5.5rem;">
        <select class="form-control" id="cliente" name="cliente" style="text-align-last:center; width:15rem; height:1.7rem; position:relative; margin-left:auto; margin-right:auto; margin-bottom:-2rem; z-index:500; border-radius:2px; font-size:16px; padding: 1px 1px;">
          <option value="0" selected>Todos os clientes</option>
          <?php
          $busca = mysqli_query($conn, "SELECT * FROM cliente");
          foreach ($busca as $eachRow) {
            ?>
            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
          <?php
        }
        ?>
        </select>
        <input class="form-control" style="text-align:center; text-indent:1.5rem; width:14rem; height:1.7rem; position:relative; float:right; z-index:500; border-radius:2px; margin-top:0.3rem;" id="DataEntrega2" type="date" value="<?php echo $timeRN ?>" name="Dataentrega2">
        <div class="row">
          <div class="col-sm-6">
            <h2><b>Guias </b> diárias</h2>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table style="margin-top:-0.6rem; margin-left:auto; margin-right:auto;" class="table table-striped table-hover">
          <thead>
            <tr>
              <th style="width:20%; text-align:center">Cliente</th>
              <th style="width:20%; text-align:center">Nº de requisição</th>
              <th style="width:20%; text-align:center">Data e hora prevista</th>
              <th style="width:17%; text-align:center">Nº paletes</th>
              <th style="width:20%; text-align:center">Armazém</th>
            </tr>
          </thead>
          <tbody id="Testeeee">
            <?php
            date_default_timezone_set("Europe/Lisbon");
            ?>
          </tbody>
        </table>
      </div>
      <!--MODAL HERE -->
      <input type="hidden" id="getConfirm">
      <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" id="ModalGuia">
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
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
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
      url: '/POM-Logistica/Ajax/ajaxPedidosTotaisOP.php',
      type: 'POST',
      data: {
        id: $("#notConfirmed").val(),
        dataescolhida: $("#DataEntrega2").val(),
        tipo_cliente_id: $("#cliente").val()
      },
      success: function(data) {
        $("#notConfirmed").removeClass('btn2')
        $("#notConfirmed").addClass('btn3')
        $("#Confirmed").removeClass('btn3')
        $("#Confirmed").addClass('btn2')
        $("#getConfirm").val($("#notConfirmed").val());
        $("#Testeeee").html(data);
      },
    });
  });
</script>

<script>
  $("#Confirmed").on("click", function() {
    $.ajax({
      url: '/POM-Logistica/Ajax/ajaxPedidosTotaisOP.php',
      type: 'POST',
      data: {
        id: $("#Confirmed").val(),
        dataescolhida: $("#DataEntrega2").val(),
        tipo_cliente_id: $("#cliente").val()
      },
      success: function(data) {

        $("#Confirmed").removeClass('btn2')
        $("#Confirmed").addClass('btn3')
        $("#notConfirmed").removeClass('btn3')
        $("#notConfirmed").addClass('btn2')
        $("#getConfirm").val($("#Confirmed").val());
        $("#Testeeee").html(data);
      },
    });
  });
</script>

<script>
  $(document).ready(function() {
    $.ajax({
      url: '/POM-Logistica/Ajax/ajaxPedidosTotaisOP.php',
      type: 'POST',
      data: {
        id: $("#notConfirmed").val(),
        dataescolhida: $("#DataEntrega2").val(),
        tipo_cliente_id: $("#cliente").val()
      },
      success: function(data) {
        $("#notConfirmed").removeClass('btn2')
        $("#notConfirmed").addClass('btn3')
        $("#Confirmed").removeClass('btn3')
        $("#Confirmed").addClass('btn2')
        $("#getConfirm").val($("#notConfirmed").val());
        $("#Testeeee").html(data);
      },
    });
  });
</script>



<script>
  $(document).ready(function() {
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
  });
</script>

<script>
  $("#DataEntrega2").on("change", function() {
    $.ajax({
      url: '/POM-Logistica/Ajax/ajaxPedidosTotaisOP .php',
      type: 'POST',
      data: {
        id: $("#getConfirm").val(),
        dataescolhida: $("#DataEntrega2").val(),
        tipo_cliente_id: $("#cliente").val()
      },
      success: function(data) {
        $("#Testeeee").html(data);
      },
    });
  });
</script>

<script>
  $("#cliente").on("change", function() {
    $.ajax({
      url: '/POM-Logistica/Ajax/ajaxPedidosTotaisOP.php',
      type: 'POST',
      data: {
        id: $("#getConfirm").val(),
        dataescolhida: $("#DataEntrega2").val(),
        tipo_cliente_id: $("#cliente").val()
      },
      success: function(data) {
        $("#Testeeee").html(data);
      },
    });
  });
</script>

<script>
  $(".modal").on("hidden.bs.modal", function() {
    $(".modal-body1").html("");
  });
</script>
