<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
$navbar = $_SERVER['DOCUMENT_ROOT'];
$navbar .= "/POM-Logistica/Navbar/navbarOperador.php";
include_once($navbar);
if ($_SERVER["REQUEST_METHOD"] == "POST") { }
?>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="\POM-Logistica\styles\table.min.css">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css">

  <!-- DataTables JavaScript -->
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.56/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.56/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>

  <script>
    $(".table-row").click(function() {
      $.ajax({
        url: '/POM-Logistica/Ajax/ajaxTesteasd.php',
        type: 'POST',
        data: {
          id: $(this).data('value')
        },
        success: function(data) {
          $("#TableDetails").html(data);
        },
      });
    });

    $(document).ready(function() {
      var dataTable = $('#myTable').DataTable({
        "language": {
          url: 'http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json'
        },
        dom: 'Bfrtip',
        buttons: [{
            extend: 'copy',
            text: 'Copiar',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
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
      $("#searchbox").on("keyup search input paste cut", function() {
        dataTable.search(this.value).draw();
      });
    });
  </script>
</head>

<style>
  body {
    background-color: #fcfcfc !important;
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
</style>

<body>
  <form class="container" action="/POM-Logistica/PDFs/pdf.php" style="font-family: 'Varela Round', sans-serif; font-size:14px; z-index:1;" method="post">
    <div class="table-wrapper" style="margin-top:5rem;">
      <div class="table-title" style="background-color:#0275d8; margin-top:-5.5rem;">
        <div class="row">
          <div class="col-sm-6">
            <h2>Guia de <b>Receção</b></h2>
            <input type="search" class="form-control" placeholder="Procurar" style="text-align:left; width:15rem; height:2rem; position:absolute; margin-left:50.5rem; margin-top:-2.1rem; border-radius:2px" id="searchbox">
          </div>
        </div>
      </div>
      <table style="margin-left:auto; margin-right:auto;" class="table table-striped table-hover" id="myTable">
        <thead style="margin-top:-5rem">
          <tr>
            <th style="width:20%; text-align:center">Cliente</th>
            <th style="width:20%; text-align:center">Dia e hora da carga</th>
            <th style="width:15%; text-align:center">Nº de Paletes</th>
            <th style="width:20%; text-align:center;">Artigo</th>
            <th style="width:20%; text-align:center">Armazém</th>
            <th style="width:20%; text-align:center">PDF</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $dado = mysqli_query($conn, "SELECT guia.id as idg,guia.artigo_id,guia.cliente_id,guia.numero_paletes, guia.data_prevista, guia.numero_requisicao,guia.armazem_id, guia.confirmar, guia.confirmarTotal, cliente.nome as clientenome ,armazem.nome as armazemnome,artigo.referencia as artigoreef FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id WHERE tipo_guia_id=3 ");
          foreach ($dado as $eachRow) {
            $GuiaID = $eachRow['idg'];
            $qtPal = $eachRow['numero_paletes'];
            $numeroReq = $eachRow['numero_requisicao'];
            $nomeArmazem = $eachRow['armazemnome'];
            $nomeCliente = $eachRow['clientenome'];
            $refArtigo = $eachRow['artigoreef'];
            $timeRN = $eachRow['data_prevista'];
            echo '<tr class="table-row" data-value="' . $GuiaID . '">';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $nomeCliente . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $timeRN . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:15%; text-align:center"> ' . $qtPal . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $refArtigo . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $nomeArmazem . '</td>';
            ?>
            <td style="width:20%; cursor:context-menu; text-align:center;"><button type="submit" style="font-size:8px; height:1.5rem; width:1px;" class="btn" name="GuiaID" value="<?php echo $GuiaID ?>"><i class="fa fa-file-pdf-o" style="font-size:24px; color:#dc3545; margin-left:-7px; margin-top:-8px"></i></button></td>
            <?php
            echo '</tr>';
          }
          ?>
        </tbody>
      </table>
    </div><!-- /card-container -->
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
  </form>
</body>

</html>


<script>
  $(".table-row").click(function() {
    $.ajax({
      url: '/POM-Logistica/Ajax/ajaxTesteasd.php',
      type: 'POST',
      data: {
        id: $(this).data('value')
      },
      success: function(data) {
        $("#TableDetails").html(data);
      },
    });
  });
</script>