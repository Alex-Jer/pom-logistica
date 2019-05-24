<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include '../Navbar\navbarAdmin.php';
include '../db.php';
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

    $stmt = $conn->prepare("SELECT palete.tipo_palete_id as tipo_palete_id, palete.id as id, localizacao.zona_id as zona_id, zona.armazem_id as armazem_id, zona.tipo_zona_id as tipo_zona_id FROM palete INNER JOIN localizacao on localizacao.palete_id=palete.id INNER JOIN zona on zona.id=localizacao.zona_id WHERE artigo_id=?");
    $stmt->bind_param("s", $artigoo);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($tipoPalete, $paleteeID, $zonaID, $armazemID, $tipoZona);
    $stmt->fetch();
    //echo $armazemID;

    $stmt = $conn->prepare("INSERT INTO guia (cliente_id, tipo_guia_id, tipo_palete_id, tipo_zona_id, armazem_id, artigo_id, data_prevista, numero_paletes, numero_requisicao, morada, localidade, matricula) VALUES (?,2,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("iiiiisissss", $cliente, $tipoPalete, $tipoZona, $armazemID, $artigoo, $horadescarga, $npal, $nreq, $morada, $Localidade, $matricula);
    $stmt->execute();
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
  <link rel="stylesheet" href="/POM-Logistica/styles\table.css">
  <link rel="stylesheet" href="/POM-Logistica/node_modules\jquery\dist\jquery.js">
  <link rel="stylesheet" href="/POM-Logistica/styles\style3.css">
  <link rel="stylesheet" href="/POM-Logistica/css\bootstrap.css">
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

  .table-row {
    cursor: pointer;
  }

  .modal-backdrop {
    opacity: 0.3 !important;
  }
</style>

<body>
  <?php
  $timeRN = date("Y-m-d");
  ?>
  <form class="container" action="Admin\Listar_todas_as_guias.php" style="font-family: 'Varela Round', sans-serif; font-size:13px; z-index:1;" method="post">
    <!-- <div class="row align-items-center" style="font-family: 'Varela Round', sans-serif; font-size:13px; position:absolute;; margin-left:12rem;"> -->
    <div class="table-wrapper" style="margin-top:10rem;">
      <!-- <p id="profile-name" class="profile-name-card"></p> -->
      <!-- <form class="container" action="Admin\Listar_todas_as_guias.php" method="post"> -->
      <ul class="nav nav-pills">
        <li class="nav-item" style="margin-top:-8.5rem; margin-left:-1.5rem;">
          <button style="border-radius:0.2rem; margin-right:1rem;" class="nav-link btn3" value="1" data-toggle="pill" id="notConfirmed" name="entrega">Entrega</button>
        </li>
        <li class="nav-item" style="margin-top:-8.5rem;">
          <button style="border-radius:0.2rem;" class="nav-link btn3" value="2" data-toggle="pill" id="Confirmed" name="transporte">Transporte</button>
        </li>
        <li style="margin-top:-8.5rem;">
          <input class="form-control" style="text-align:center; text-indent:1.5rem; margin-left:13rem; margin-right:auto; width:17rem; position:absolute; z-index:500; margin-top:3.8rem; border-radius:1.5px;" id="DataEntrega2" type="text" name="Dataentrega2" placeholder="Data e hora de entrega" onfocus="(this.type='date')">
        </li>
      </ul>
      <div id="guiaTeste" style="margin-top:-5.5rem; margin-left:auto; margin-right:auto; width:66.3rem"></div>
      <table style="margin-top:-0.6rem; margin-left:auto; margin-right:auto;" class="table table-striped table-hover">
        <thead>
          <tr>
            <th style="width:20%">Cliente</th>
            <th style="width:20%">Nº de requisição</th>
            <th style="width:25%">Armazém</th>
            <th style="width:20%">Data e hora prevista</th>
            <th style="width:17%">Nº paletes</th>
            <th style="width:25%; visibility:collapse;" id="moradaH">Morada</th>
          </tr>
        </thead>
        <tbody id="Testeeee">
          <?php
          date_default_timezone_set("Europe/Lisbon");
          ?>
        </tbody>
      </table>
      <!--MODAL HERE -->
      <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" id="ModalGuia">
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-left:auto; margin-right:auto; width:90%">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalhes da Guia</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="TableDetails">
          </diV>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
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
      url: 'Ajax/ajaxPedidosTotais.php',
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
      url: 'Ajax/ajaxGuiaTeste.php',
      type: 'POST',
      data: {
        id: $("#notConfirmed").val(),

      },
      success: function(data) {
        $("#guiaTeste").html(data);
      },
    });
  });

  $("#Confirmed").on("click", function() {
    $.ajax({
      url: 'Ajax/ajaxPedidosTotais.php',
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
      url: 'Ajax/ajaxGuiaTeste.php',
      type: 'POST',
      data: {
        id: $("#Confirmed").val(),

      },
      success: function(data) {
        $("#guiaTeste").html(data);
      },
    });
  });

  $(document).ready(function() {
    $.ajax({
      url: 'Ajax/ajaxPedidosTotais.php',
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
      url: 'Ajax/ajaxGuiaTeste.php',
      type: 'POST',
      data: {
        id: $("#notConfirmed").val(),

      },
      success: function(data) {
        $("#guiaTeste").html(data);
      },
    });
  });

  $("#DataEntrega2").on("change", function() {
    $.ajax({
      url: 'Ajax/ajaxPedidosTotais.php',
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


  var visible = false;
  $("#Confirmed").on("click", function() {
    visible = true;
    // alert("transporte " + visible);
    document.getElementById("moradaH").style.visibility = "visible";
    document.getElementById("moradaD").style.display = "visible";
  });

  $("#notConfirmed").on("click", function() {
    visible = false;
    // alert("entrega " + visible);
    document.getElementById("moradaH").style.visibility = "collapse";
    document.getElementById("moradaD").style.visibility = "collapse";
  });




  // var visible = false;
  // var transporte = document.getElementsByName("transporte");
  // var entrega = document.getElementsByName("entrega");
  // function transporteClick() {
  //   visible = true;
  //   return visible;
  // }
  // function entregaClick() {
  //   visible = false;
  //   return visible;
  // }
  // transporte.onclick = function() {
  //   alert("Bbb");
  //   visible = true;
  //   if (visible) {
  //     document.getElementsByName("moradaH").style.display = "block";
  //     document.getElementsByName("moradaD").style.display = "block";
  //   } else {
  //     document.getElementsByName("moradaH").style.display = "none";
  //     document.getElementsByName("moradaD").style.display = "none";
  //   }
  // }
  // entrega.onclick = function() {
  //   alert("aaa");
  //   visible = false;
  //   if (visible) {
  //     document.getElementsByName("moradaH").style.display = "block";
  //     document.getElementsByName("moradaD").style.display = "block";
  //   } else {
  //     document.getElementsByName("moradaH").style.display = "none";
  //     document.getElementsByName("moradaD").style.display = "none";
  //   }
  // }
</script>