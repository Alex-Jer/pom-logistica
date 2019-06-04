<?php
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
echo '<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Guia de Transporte</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
  </button>
</div>
<div class="modal-body">
  <select name="cliente" class="form-control" style="text-align-last:center; margin-top:1rem; margin-left:auto; margin-right:auto; color: #6C757D; height:auto;" id="clienteCBID" required>
    <option value="" disabled selected>Cliente</option>';
  $busca = mysqli_query($conn, "SELECT id,nome FROM cliente");
  foreach ($busca as $eachRow) {
    echo '<option value=' . $eachRow['id'] . '>' . $eachRow['nome'] . '</option>';
  }
  echo '
  </select>
  <select class="form-control" name="artigo" style="text-align-last:center; margin-top:1rem;  margin-left:auto; margin-right:auto; color: #6C757D; height:auto;" id="artigoseID" required>
  <option value="" disabled selected>Artigo</option>
  </select>
  <input class="form-control" type="input" name="matricula" placeholder="Matrícula do transporte" style="text-align:center; margin-top:1rem;  margin-left:auto; margin-right:auto; height:auto;" id="size" required>
  <input class="form-control" placeholder="Hora prevista" style="text-align:center; margin-top:1rem;  margin-left:auto; margin-right:auto; height:auto;" name=" horadescarga" class="textbox-n" type="text" onfocus="(this.type=\'datetime-local\')" id="size">
  <input class="form-control" type="number" id="inputNPaletes" min="0" name="NPaletes" placeholder="Número de paletes" style="text-align:center; margin-top:1rem;  margin-left:auto; margin-right:auto; height:auto;" required>
  <div style="text-align:center; margin-left:auto; margin-right:auto;" class="input-group">
    <div class="input-group-prepend" style="margin-left:auto; margin-right:auto;">
      <span class="input-group-text" style="height:2.37rem; margin-top:1rem; font-size:15px; margin-left:auto; margin-right:auto;" id="inputGroup-sizing-lg">REQ-</span>
      <input style="margin-top:1rem; margin-left:-1px; margin-right:auto; width:330px; height:38px; border-radius:1px 2px 2px 1px" type="text" id="size" name="Referencia" class="form-control" placeholder="Número de requisição" required>
    </div>
  </div>
  <input class="form-control" type="input" id="inputMorada" name="morada" placeholder="Morada" style="text-align:center; margin-top:1rem;  margin-left:auto; margin-right:auto; height:auto;" required>
  <input class="form-control" type="input" id="inputLocalidade" name="Localidade" placeholder="Localidade" style="text-align:center; margin-top:1rem;  margin-left:auto; margin-right:auto; height:auto;" required>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
  <button type="submit" class="btn btn-primary" name="saveTransporte">Adicionar</button>
</div>
</div>';
?>
<script>
  $("#artigoID").on("change", function() {
    $.ajax({
      url: '/POM-Logistica/Ajax/ajaxMaxGuiaT.php',
      type: 'POST',
      data: {
        id: $("#artigoID").val()
      },
      success: function(data) {
        document.getElementById("inputNPaletes").setAttribute("max", data);
      },
    });
  });
</script>

<script>
  $("#clienteCBID").on("change", function() {
    $.ajax({
      url: '/POM-Logistica/Ajax/ajaxaArtigoCliente.php',
      type: 'POST',
      data: {
        id: $("#clienteCBID").val()
      },
      success: function(data) {
        $("#artigoseID").html(data);
      },
    });
  });
</script>