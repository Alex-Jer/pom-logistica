<?php
include '../db.php';
echo '<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Guia de Transporte</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
  </button>
</div>
<div class="modal-body">
<select name="cliente" class="form-control" style="text-align-last:center; margin-top:1rem; color: #6C757D; height:auto;" id="clienteCBID" required>
  <option value="" disabled selected>Cliente</option>';
$busca = mysqli_query($conn, "SELECT id,nome FROM cliente");
foreach ($busca as $eachRow) {
  echo '<option value=' . $eachRow['id'] . '>' . $eachRow['nome'] . '</option>';
}
echo '
</select>
<select class="form-control" name="artigo" style="text-align-last:center; margin-top:1rem; color: #6C757D; height:auto;" id="artigoseID" required>
<option value="" disabled selected>Artigo</option>
</select>
<input class="form-control" type="input" name="matricula" placeholder="Matrícula do transporte" style="text-align:center; margin-top:1rem; height:auto;" id="size" required>
<input class="form-control" placeholder="Hora prevista" style="text-align:center; margin-top:1rem; height:auto;" name=" horadescarga" class="textbox-n" type="text" onfocus="(this.type=\'datetime-local\')" id="size">
<input class="form-control" type="number" id="inputNPaletes" min="0" name="NPaletes" placeholder="Número de paletes" style="text-align:center; margin-top:1rem; height:auto;" required>
<div style="text-align:center;" class="input-group">
      <div class="input-group-prepend">
          <span class="input-group-text" style="height:2.35rem; margin-top:0.7rem; height:auto;" id="size">REQ-</span>
      </div>
      <input type="text" class="form-control" style="width:5rem; margin-top:0.7rem; height:auto;" placeholder="Número de requisição" name="Referencia" id="size" required>
  </div>
  <input class="form-control" type="input" id="inputMorada" name="morada" placeholder="Morada" style="text-align:center; margin-top:1rem; height:auto;" required>
  <input class="form-control" type="input" id="inputLocalidade" name="Localidade" placeholder="Localidade" style="text-align:center; margin-top:1rem; height:auto;" required>
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
      url: 'Ajax/ajaxMaxGuiaT.php',
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
      url: 'Ajax/ajaxaArtigoCliente.php',
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