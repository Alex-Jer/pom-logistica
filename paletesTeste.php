<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
//include 'operador.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['Confirm'])) {
    $buscaId = mysqli_query($conn, "SELECT * FROM guia WHERE id='".$_POST['Confirm']."'");
        $dado = mysqli_fetch_array($buscaId);
        $tpID=$dado[ 'tipo_palete_id'];
        $arID=$dado['armazem_id'];
        $cliID=$dado['cliente_id'];
        date_default_timezone_set("Europe/Lisbon");
        $timeRN=date("Y-m-d H:i:s");
        $getCBtz=$dado['tipo_zona_id'];
        $getArtigo=$dado['artigo_id'];
        $qtPal=$dado['numero_paletes'];
        $numeroReq=$dado['numero_requisicao'];
   $sql = "INSERT INTO guia (cliente_id,guia_id, tipo_guia_id, tipo_palete_id, tipo_zona_id,armazem_id,artigo_id,data_prevista,numero_paletes, numero_requisicao,confirmar) VALUES ($cliID,'".$_POST['Confirm']."',3,$tpID, $getCBtz,$arID,$getArtigo, '$timeRN', $qtPal,'$numeroReq',1)";
if (mysqli_query($conn, $sql)) {
        
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
$sql2 = "UPDATE guia SET confirmar=1 where id='".$_POST['Confirm']."'";
if (mysqli_query($conn, $sql2)) {
        
} else {
  echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
}


}
elseif (isset($_POST['save'])) {
  $dataehora = $_POST['dataentrega'];
  $artigo = $_POST['comboboxArtigo'];
  $guiaentrada = $_POST['comboBoxGuiaId'];
  $referencia = $_POST['refpal'];
  $nomepal = $_POST['nomepal'];
  $eachLocalizacao = $_POST['comboBoxLocalizacao'];

  $buscaId = mysqli_query($conn, "SELECT * FROM guia WHERE id='$guiaentrada'");
  $dado = mysqli_fetch_array($buscaId);
  $tpID = $dado['tipo_palete_id'];
  $arID = $dado['armazem_id'];
  $cliID = $dado['cliente_id'];

  $buscaZoID = mysqli_query($conn, "SELECT * FROM zona WHERE armazem_id='$arID' AND tipo_zona_id=' $tpID'");
  $dado3 = mysqli_fetch_array($buscaZoID);
  $zonaID = $dado3['id'];

  // $sqlCount = mysqli_query("SELECT count(*) FROM palete  WHERE referencia = '$referencia'");
  $result = $conn->query("SELECT count(*) FROM palete  WHERE referencia = '$referencia'");
  $row = $result->fetch_row();
  //echo '#: ', $row[0];
  $count = $row[0];

  $countEspaco = $conn->query("SELECT count(*) FROM localizacao  WHERE hasPalete = 1 AND zona_id=$zonaID");
  $row12 = $countEspaco->fetch_row();
  //echo '#: ', $row12[0];
  $countRows = $row12[0];

  $getEspaco = mysqli_query($conn, "SELECT * FROM zona WHERE id='$zonaID'");
  $dado = mysqli_fetch_array($getEspaco);
  $getEspacoo = $dado['espaco'];
  $espaco = $getEspacoo - 1;
  //echo $espaco;
  $getArmaID = $dado['armazem_id'];

  $getEspaco = mysqli_query($conn, "SELECT * FROM armazem WHERE id='$getArmaID'");
  $dado2 = mysqli_fetch_array($getEspaco);
  $getEspaco2 = $dado2['espaco'];
  $espacoTotal = $getEspaco2 - 1;

  date_default_timezone_set("Europe/Lisbon");
  $timeRN = date("Y-m-d H:i:s");


  if ($count == 0) {
    $sql = "INSERT INTO palete (guia_entrada_id, artigo_id, tipo_palete_id, referencia, nome, Data) VALUES ('$guiaentrada', '$artigo','$tpID', 'PAL- + $referencia','Palete de + $nomepal', '$timeRN')";
    if (mysqli_query($conn, $sql)) {
      ?>
    <?php

  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }


  $buscaPaleteID = mysqli_query($conn, "SELECT id FROM palete WHERE referencia='$referencia'");
  $dado2 = mysqli_fetch_array($buscaPaleteID);
  $palete_idd = $dado2['id'];


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
      ;
      alert("Essa referencia de palete já existe");
    </script>
  <?php
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
    <nav role="navigation">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="operador.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Guia_Operador_operador.php">Guia do Operador</a></li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="showGuiaEntrega.php">Registar Palete</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mudarpass_operador.php">Mudar Palavra-Passe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listagem_pedidos_armazem_operador.php">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="Guia_Rececao.php">Imprimir Receção</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Guia_Devolucao.php">Imprimir Devolução</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Sair</a>
            </li>
        </ul>
    </nav>
    <div class="container" id="onLoad" >
        <div class="card card-container" style="text-align:center; width:100%; max-width: 100000px">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="paletesTeste.php" method="post">
                <div style="text-align:center">
                    <h1 style="margin-bottom:1rem;">Registar Paletes</h1>
                    <div class="container">
                    <nav role="navigation">
                      <ul class="nav">
                          <li class="nav-item">
                          <button class="btn2" type="button"  value ="1" id ="notConfirmed">Por Confirmar</button>
                          <button class="btn2" type="button" value ="2" id ="Confirmed">Confirmadas</button>
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
                    <!-- Nao faz o post se tiver o modal no codigo sem modal funciona -->
                    <!-- Nao faz o post se tiver o modal no codigo sem modal funciona -->
                    <!-- Nao faz o post se tiver o modal no codigo sem modal funciona -->
                    <!-- Nao faz o post se tiver o modal no codigo sem modal funciona -->
                    
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Registar um cliente</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                                      <div class="modal-body">
                                                  <input style="margin-top:1rem; height:auto;" type="input" name="Nome" class="form-control" placeholder="Nome" pattern="[A-Za-z\sâàáêèééìíôòóùúçãõ ]+" title="Apenas deve conter letras." required autofocus>
                                                  <input style="margin-top:1rem; height:auto;" type="number" id="uintTextBox" name="nif" class="form-control" placeholder="NIF" max="999999999" pattern=".{9,}" minlength=9 maxlength=9 title="O NIF tem de ter 9 dígitos." required>
                                                  <input style="margin-top:1rem; height:auto;" type="input" name="morada" class="form-control" placeholder="Morada" pattern="[A-Za-z0-9\sâàáêèééìíôòóùúçãõªº-;,. ]+" required>
                                                  <input style="margin-top:1rem; height:auto;" type="input" name="local" class="form-control" placeholder="Localidade" pattern="[A-Za-z0-9\sâàáêèééìíôòóùúçãõªº-;,. ]+" pattern="[A-Za-z]+" required>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                      </div>
                            </div>
                            </div>
                      </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>

</html>

<script>
  $("#notConfirmed").on("click", function() {
    $.ajax({
      url: 'ajaxTeste.php',
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
      url: 'ajaxTeste.php',
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
  $(document).ready(function(){
    $.ajax({
      url: 'ajaxTeste.php',
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