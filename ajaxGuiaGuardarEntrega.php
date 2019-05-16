<?php
include 'db.php';


echo '<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Guia Entrega</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  </button>
</div>
<div class="modal-body">
<select class="form-control" style="text-align-last:center; margin-top:1rem; color: #6C757D;" name="comboboxCli" id="comboboxCli">
<option value="" disabled selected>Cliente</option>';
$busca = mysqli_query($conn, "SELECT id,nome FROM cliente");
foreach ($busca as $eachRow) {
echo '<option value='.$eachRow['id'].' >'. $eachRow['nome'].' </option>';
}
echo '
</select>
<input class="form-control" style="text-align:center; margin-top:1rem;" type="datetime-local" id="date" name="dataentrega" placeholder="Data e hora de entrega" onfocus="(this.type="datetime-local")" id="date" required>
        <select class="form-control" name="comboboxArtigo" style="text-align-last:center; margin-top:1rem; color: #6C757D;" id="comboboxArtigo">
        <option value="" disabled selected>Artigo</option> 
        </select>
<select class="form-control" name="comboboxTipo_Palete" id="TipoPalete" style="text-align-last:center; margin-top:1rem; color: #6C757D;">
<option value="" disabled selected>Tipo de paletes</option>';
$busca = mysqli_query($conn, "SELECT id,nome FROM tipo_palete");
foreach ($busca as $eachRow) {
    echo '<option value='.$eachRow['id'] .' >'. $eachRow['nome'].'</option>';
}
echo '
</select>
<select class="form-control" name="comboboxTipoZona" id="TipoZona" style="display:none; text-align-last:center; margin-top:1rem; color: #6C757D;">
<option value="" disabled selected>Tipo de zona</option>
</select>
<div style="text-align:center" class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" style="height:2.37rem; margin-top:1rem" id="inputGroup-sizing-lg">REQ-</span>
  </div>
  <input type="text" class="form-control" style="width:5rem; margin-top:1rem;" placeholder="Número de requisição" name="req" required>
</div>
<select class="form-control" name="Armazem" id="Armazem" style="display:none; text-align-last:center; margin-top:1rem; color: #6C757D;">
</select>
<div id="Espaco"></div>
<div id="HiddenTeste" name="HiddenTeste">
</div>
<input style="text-align:center; margin-top:1rem;" type="number" id="inputqt" name="qt" class="form-control" placeholder="Quantidade de paletes neste artigo" required>
    
  </div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary" name="saveEntrega">Save changes</button>
</div>
</div>';
?>
<script>
  $("#TipoPalete").on("change", function() {
    $.ajax({
      url: 'ajaxEntrega.php',
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
      url: 'ajaxArmazem.php',
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
      url: 'ajaxEspaco.php',
      type: 'POST',
      data: {
        id: $("#Armazem").val(),
        teste: $("#TipoZona").val()
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
      url: 'ajaxaArtigoCliente.php',
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
