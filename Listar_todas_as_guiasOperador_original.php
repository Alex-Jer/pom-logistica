<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarOperador.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = $_POST["data"];
}
?>

<head>
  <meta charset="UTF-8">
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="node_modules\bootstrap-datepicker\dist\css\bootstrap-datepicker.standalone.css">
  <link rel="stylesheet" href="styles\style.css">
  <link rel="stylesheet" href="css\bootstrap.css">
  <link rel="stylesheet" href="node_modules\jquery\dist\jquery.js">
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
    max-height: 18rem;
    overflow-y: auto;
    overflow-x: hidden;
  }

  tbody td,
  thead th {
    width: 210px;
  }

  thead th:last-child {
    width: 220px;
    /* 140px + 16px scrollbar width */
  }
</style>

<body>
  <?php
  $timeRN = date("Y-m-d");
  ?>
  <div class="row align-items-center">
    <div class="card card-container" style="text-align:center; width:85rem; max-height:35rem; margin-bottom:auto; max-width: 10000px;">
      <p id="profile-name" class="profile-name-card"></p>
      <form class="container" action="listagem_pedidos_armazem_operador.php" method="post">
        <div style="text-align:center;">
          <h1 style="margin-bottom:1rem;">Consulta das Guias Diárias</h1>
          <input class="form-control" style="text-align:center; text-indent:1.5rem; margin-left:auto; margin-right:auto; width:15rem;" id="DataEntrega2" type="date" name="DataEntrega2">
          <div>
            <ul class="nav nav-pills">
              <li class="nav-item">
                <button style="border-radius:0.2rem; margin-right:1rem;" class="nav-link active" value="1" data-toggle="pill" id="notConfirmed">Entrega</button>
              </li>
              <li class="nav-item">
                <button style="border-radius:0.2rem;" class="nav-link" value="2" data-toggle="pill" id="Confirmed">Transporte</button>
              </li>
            </ul>
            <table style="margin-top:2rem; margin-left:-25px; width: 1160px; text-align:center" class="table">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Nº de requisição</th>
                  <th>Armazém</th>
                  <th>Nº paletes</th>
                  <th style="width:17%">Data e hora prevista</th>
                  <th>Morada</th>
                </tr>
              </thead>
              <tbody id="Testeeee">
                <?php
                date_default_timezone_set("Europe/Lisbon");
                ?>
              </tbody>
            </table>
          </div>
      </form><!-- /form -->
    </div><!-- /card-container -->
  </div><!-- /container -->
  <script type="text/javascript"></script>
  <script type="text/javascript"></script>
</body>

</html>

<script>
  $("#notConfirmed").on("click", function() {
    $.ajax({
      url: 'ajaxPedidosTotaisOP.php',
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
      url: 'ajaxPedidosTotaisOP.php',
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
</script>

<script>
  $("#DataEntrega2").on("change", function() {
    $.ajax({
      url: 'ajaxPedidosTotaisOP.php',
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
</script>