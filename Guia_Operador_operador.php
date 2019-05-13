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
$sql = mysqli_query($conn,"SELECT guia.cliente_id as cliente, guia.id, guia.artigo_id as artigo,guia.armazem_id as armazem_id, guia.numero_paletes as npaletes,guia.tipo_palete_id as tp,guia.tipo_zona_id as tzid, guia.numero_requisicao as numero_requisicao ,guia.morada as morada, palete.id as palete_id, zona.id as zona FROM guia INNER JOIN palete on palete.artigo_id=guia.artigo_id INNER JOIN localizacao on localizacao.palete_id=palete.id INNER JOIN zona ON (zona.id=localizacao.zona_id and zona.armazem_id=guia.armazem_id and zona.tipo_zona_id=guia.tipo_palete_id) WHERE guia.id='$idGuia'");

$dado = mysqli_fetch_array($sql);
$cliente = $dado["cliente"];

$morada = $dado["morada"];
$artigo = $dado["artigo"];
$npal = $dado["npaletes"];
$nrequisicao = $dado['numero_requisicao'];

$tipoPalete = $dado['tp'];
//echo $paleteeID;
date_default_timezone_set("Europe/Lisbon");
$data=date("Y-m-d H:i:s");
$zonaID = $dado['zona'];

$armazemID = $dado['armazem_id'];
$tipoZona = $dado['tzid'];


  //echo "cliente: $cliente , nreq: $nrequisicao , morada: $morada , data: $data , artigo: $artigo , npaletes: $npaletes";
  $sql = "INSERT INTO guia (cliente_id, guia_id, tipo_guia_id, tipo_palete_id, tipo_zona_id, armazem_id, artigo_id, data_prevista, numero_paletes, numero_requisicao, morada, confirmar,confirmarTotal) 
                    VALUES ($cliente, $idGuia, 4, $tipoPalete, $tipoZona, $armazemID, $artigo, '$data', '$npal', '$nrequisicao', '$morada',1,1)";
  if (mysqli_query($conn, $sql)) {
  }

$sql10 = mysqli_query($conn, "UPDATE guia SET confirmar = 1, confirmarTotal = 1 WHERE id=$idGuia ");
    if (mysqli_query($conn, $sql10)) {
    }

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
        <script type="text/javascript">
          alert("New record created successfully");
        </script>
      <?php
    }
  }
}
}
?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="jquery.js"></script>
    <link rel="stylesheet" href="styles\style2.css">
</head>

<body >
    <form class="container" action="Guia_Operador_operador.php" method="post" id="mainForm" novalidate>
    
    <div class="container" id="onLoad" >
        <div class="card card-container" style="text-align:center; width:120%; margin-right:auto; margin-left:auto; max-width: 100000px">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <p id="profile-name" class="profile-name-card"></p>
           
                <div style="text-align:center">
                    <h1 style="margin-bottom:1rem;">Confirmar Guias Transporte</h1>
                    <div class="container">
                    <nav role="navigation">
                      <ul class="nav">
                          <li class="nav-item">
                          <button class="btn2" type="button"  value ="1" id ="notConfirmed">Por Confirmar</button>
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
                                    <th style="width:15%">N Guia</th>
                                    <th style="width:30%">Dia e hora da carga</th>
                                    <th style="width:15%">Nº de Paletes</th>
                                    <th style="width:20%">Artigo</th>
                                    <th style="width:20%">Armazém</th>
                                </tr>
                            </thead>
                            <tbody id="Testeeee">

                            </tbody>
                        </table>
                        <div id="DivEntrega"></div>
                        
                    </div>
            <!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->

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
        $("#notConfirmed").removeClass('btn2')
        $("#notConfirmed").addClass('btn3')
        $("#Testeeee").html(data);
      },
    });
  });
</script>
<script>
  $(document).ready(function(){
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