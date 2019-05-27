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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="/POM-Logistica/styles/table.css">
  <link rel="stylesheet" href="/POM-Logistica/styles/style3.css">
  <link rel="stylesheet" href="/POM-Logistica/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="/POM-Logistica/css/datatables.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css">
  
  <!-- DataTables JavaScript -->
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script> -->
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
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
      $('#myTable').DataTable({
        "lengthMenu": [
          [5, -1],
          [5, "All"]
        ]
      });
    });
  </script>
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

  .btn:focus,
  .btn:active {
    outline: none !important;
    box-shadow: none;
  }

  /* tbody {
    display: block;
    max-height: 22rem;
    overflow-y: auto;
    overflow-x: hidden;
  } */

  .table-row {
    cursor: pointer;
  }

  thead,
  tbody tr {
    display: table;
    /* width: 100%; */
    /* table-layout: fixed; */
    /* even columns width , fix width of table too*/
  }
</style>

<body>
  <form class="container" action="/POM-Logistica/PDFs/pdf.php" style="font-family: 'Varela Round', sans-serif; font-size:14px; z-index:1;" method="post">
    <div class="table-wrapper" style="margin-top:10rem;">
      <div class="table-title" style="background-color:#0275d8; margin-top:-5.5rem;">
        <div class="row">
          <div class="col-sm-6">
            <h2>Guia de <b>Receção</b></h2>
          </div>
        </div>
      </div>
      <table style="margin-top:-0.6rem; margin-left:auto; margin-right:auto;" class="table table-striped table-hover" id="myTable">
        <thead>
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
            <td style="width:20%; cursor:context-menu; text-align:center;"><button type="submit" style="font-size:8px; height:1.5rem; width:1px; margin-left:1rem;" class="btn" name="GuiaID" value="<?php echo $GuiaID ?>"><i class="fa fa-file-pdf-o" style="font-size:24px; color:#dc3545; margin-left:-7px; margin-top:-8px"></i></button></td>
            <?php
            echo '</tr>';
            echo '<tr class="table-row" data-value="' . $GuiaID . '">';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $nomeCliente . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $timeRN . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:15%; text-align:center"> ' . $qtPal . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $refArtigo . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $nomeArmazem . '</td>';
            ?>
            <td style="width:20%; cursor:context-menu; text-align:center;"><button type="submit" style="font-size:8px; height:1.5rem; width:1px; margin-left:1rem;" class="btn" name="GuiaID" value="<?php echo $GuiaID ?>"><i class="fa fa-file-pdf-o" style="font-size:24px; color:#dc3545; margin-left:-7px; margin-top:-8px"></i></button></td>
            <?php
            echo '</tr>';
            echo '<tr class="table-row" data-value="' . $GuiaID . '">';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $nomeCliente . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $timeRN . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:15%; text-align:center"> ' . $qtPal . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $refArtigo . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $nomeArmazem . '</td>';
            ?>
            <td style="width:20%; cursor:context-menu; text-align:center;"><button type="submit" style="font-size:8px; height:1.5rem; width:1px; margin-left:1rem;" class="btn" name="GuiaID" value="<?php echo $GuiaID ?>"><i class="fa fa-file-pdf-o" style="font-size:24px; color:#dc3545; margin-left:-7px; margin-top:-8px"></i></button></td>
            <?php
            echo '</tr>';
            echo '<tr class="table-row" data-value="' . $GuiaID . '">';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $nomeCliente . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $timeRN . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:15%; text-align:center"> ' . $qtPal . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $refArtigo . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $nomeArmazem . '</td>';
            ?>
            <td style="width:20%; cursor:context-menu; text-align:center;"><button type="submit" style="font-size:8px; height:1.5rem; width:1px; margin-left:1rem;" class="btn" name="GuiaID" value="<?php echo $GuiaID ?>"><i class="fa fa-file-pdf-o" style="font-size:24px; color:#dc3545; margin-left:-7px; margin-top:-8px"></i></button></td>
            <?php
            echo '</tr>';
            echo '<tr class="table-row" data-value="' . $GuiaID . '">';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $nomeCliente . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $timeRN . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:15%; text-align:center"> ' . $qtPal . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $refArtigo . '</td>';
            echo '<td data-toggle="modal" data-target="#exampleModal2" style="width:20%; text-align:center"> ' . $nomeArmazem . '</td>';
            ?>
            <td style="width:20%; cursor:context-menu; text-align:center;"><button type="submit" style="font-size:8px; height:1.5rem; width:1px; margin-left:1rem;" class="btn" name="GuiaID" value="<?php echo $GuiaID ?>"><i class="fa fa-file-pdf-o" style="font-size:24px; color:#dc3545; margin-left:-7px; margin-top:-8px"></i></button></td>
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