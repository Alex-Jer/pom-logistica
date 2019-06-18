<?php
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
echo '
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Adicionar Guia de Entrega</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
  </button>
</div>
<div class="modal-body">
<select class="form-control" style="text-align-last:center; margin-top:1rem; color: #6C757D; margin-left:auto; margin-right:auto;" name="comboboxCli" id="comboboxCli" required>
<option value="" disabled selected>Cliente</option>';
$busca = mysqli_query($conn, "SELECT id,nome FROM cliente");
foreach ($busca as $eachRow) {
  echo '<option value=' . $eachRow['id'] . ' >' . $eachRow['nome'] . ' </option>';
}
echo '
</select>
<input class="form-control" style="text-align:center; margin-top:1rem; margin-left:auto; margin-right:auto;" type="text" id="date" name="dataentrega" placeholder="Data e hora de entrega" onfocus="(this.type=\'datetime-local\')" id="date" required>
<select class="form-control" name="comboboxArtigo" style="text-align-last:center; margin-top:1rem; margin-left:auto; margin-right:auto; color: #6C757D;" id="comboboxArtigo" required>
  <option value="" disabled selected>Artigo</option>
</select>
<select class="form-control" name="comboboxTipo_Palete" id="TipoPalete" style="text-align-last:center; margin-top:1rem; margin-left:auto; margin-right:auto; color: #6C757D;" required>
<option value="" disabled selected>Tipo de paletes</option>';
$busca = mysqli_query($conn, "SELECT id,nome FROM tipo_palete");
foreach ($busca as $eachRow) {
  echo '<option value=' . $eachRow['id'] . ' >' . $eachRow['nome'] . '</option>';
}
echo '
</select>
<select class="form-control" name="comboboxTipoZona" id="TipoZona" style="display:none; text-align-last:center; margin-top:1rem; margin-left:auto; margin-right:auto; color: #6C757D;" required>
<option value="" disabled selected>Tipo de zona</option>
</select>
<input style="text-align:center; margin-top:1rem; margin-left:auto; margin-right:auto;" type="number" min="0"; id="inputqt" name="qt" class="form-control" placeholder="Número de paletes" required>
<div style="text-align:center; margin-left:auto; margin-right:auto;" class="input-group">
<div class="input-group-prepend" style="margin-left:auto; margin-right:auto;">
<span class="input-group-text" style="height:2.37rem; margin-top:1rem; font-size:15px; margin-left:auto; margin-right:auto;" id="inputGroup-sizing-lg">REQ-</span>
<input style="margin-top:1rem; margin-left:-1px; margin-right:auto; width:330px; height:37.5px; border-radius:1px 2px 2px 1px" type="text" id="inputqt" name="req" class="form-control" placeholder="Número de requisição" required>
</div>
</div>
<select class="form-control" name="Armazem" id="Armazem" style="display:none; text-align-last:center; margin-top:1rem; margin-left:auto; margin-right:auto; color: #6C757D;" required></select>
<div id="Espaco"></div>
<div id="Hidden" name="Hidden">
</div>
  </div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
  <button type="submit" class="btn btn-primary" name="saveEntrega">Adicionar</button>
</div>';
?>
<script>
  $("#TipoPalete").on("change", function() {
    $.ajax({
      url: '/POM-Logistica/Ajax/ajaxEntrega.php',
      type: 'POST',
      data: {
        id: $("#TipoPalete").val()
      },
      success: function(data) {
        $("#pZona").css({
          'display': 'block'
        });
        $("#TipoZona").html(data);
      },
    });
  });
</script>
<script>
  $("#TipoPalete").on("change", function() {
    $.ajax({
      url: '/POM-Logistica/Ajax/ajaxArmazem.php',
      type: 'POST',
      data: {
        id: $("#TipoPalete").val()
      },
      success: function(data) {
        $("#pArmazem").css({
          'display': 'block'
        })
        $("#inputqt").css({
          'display': 'block'
        });
        $("#Armazem").css({
          'display': 'block'
        });
        $("#Armazem").html(data);
      },
    });
  });
</script>
<script>
  $("#Armazem").on("change", function() {
    $.ajax({
      url: '/POM-Logistica/Ajax/ajaxEspaco.php',
      type: 'POST',
      data: {
        id: $("#Armazem").val(),
        tipozona: $("#TipoZona").val()
      },
      success: function(data) {
        document.getElementById("inputqt").setAttribute("max", data);
      },
    });
  });
</script>

<script>
  $("#comboboxCli").on("change", function() {
    $.ajax({
      url: '/POM-Logistica/Ajax/ajaxArtigoCliente.php',
      type: 'POST',
      data: {
        id: $("#comboboxCli").val()
      },
      success: function(data) {
        $("#comboboxArtigo").html(data);
      },
    });
  });
</script>
