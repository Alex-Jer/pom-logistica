<!DOCTYPE html>
<html lang="pt">
<script type="text/javascript" src="jquery.js"></script>
<?php 
session_start();
include 'navbarLogin.php';
include 'db.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $nomeCli = $_POST["comboboxCli"];
        $dataEntrega = $_POST["dataentrega"];
        $getCBart= $_POST["comboboxArtigo"];
        $getQT= $_POST["qt"];
        $getCBtp= $_POST["comboboxTipo_Palete"];
        $getCBtz= $_POST["comboboxTipoZona"];
        $getREQ= $_POST["req"];
        $getArmazem = $_POST["Armazem"];
        // $TESTE2=$_POST["ola"];
        // echo $TESTE2;
        
        $sql = "INSERT INTO guia (cliente_id, tipo_guia_id, tipo_palete_id, tipo_zona_id,armazem_id,artigo_id,data_prevista,numero_paletes, numero_requisicao) VALUES ($nomeCli, 1,$getCBtp, $getCBtz,$getArmazem,'$getCBart', '$dataEntrega', $getQT,'$getREQ')";
        
        if (mysqli_query($conn, $sql)) {
                        
        } else 
        {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
      /*header("Location: menu.php");*/
      }
      
      
?>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <meta http-equiv="refresh" content="1"> -->
    <title>Menu</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   
</head>
<body>
    
    <div class="container">
        <div class=" card card-container">
            <form class="form-signin" action="Guia_Entrega.php" method="post">
            <h1>Guia de entrega</h1>
            <p>Cliente</p>
            <select name="comboboxCli" id="comboboxCli">
                            <?php
                              $busca = mysqli_query($conn,"SELECT * FROM cliente");
                              foreach ($busca as $eachRow)
                              {
                                ?>
                                &nbsp;
                                <option value=" <?php echo $eachRow['id'] ?>" <?php echo (isset($_POST['comboboxCli']) && $_POST['comboboxCli'] == $eachRow['id']) ? 'selected="selected"' : ''; ?>><?php echo $eachRow['nome'] ?></option>
                                <?php
                              }
                            ?>
            </select>
            &nbsp;
            &nbsp;
                <!-- <input type="input" id="inputGuia" name="Nguia" class="form-control" placeholder="Nº de guia" required autofocus> -->
                <p>Data e Hora da Entrega</p>
                <input type="datetime-local" id="inputdata" name="dataentrega"  placeholder="Data"  value="<?php echo $_POST['dataentrega'];?>"required >
                &nbsp;
                <p>Artigo</p>
                <select name="comboboxArtigo" id="comboboxArtigo">
                            <?php
                              $busca = mysqli_query($conn,"SELECT * FROM artigo");
                              foreach ($busca as $eachRow)
                              {
                                ?>
                                &nbsp;
                                <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['referencia'] ?></option>
                                <?php
                              }
                            ?>
            </select>
            &nbsp;      
            
                <p>Tipo de paletes</p>
                <select name="comboboxTipo_Palete" id="TipoPalete">
                            <?php
                              $busca = mysqli_query($conn,"SELECT * FROM tipo_palete");
                              foreach ($busca as $eachRow)
                              {
                                ?>
                                <option value=" <?php echo $eachRow['id'] ?>" <?php echo (isset($_POST['comboboxTipo_Palete']) && $_POST['comboboxTipo_Palete'] == $eachRow['id']) ? 'selected="selected"' : ''; ?>><?php echo $eachRow['nome'] ?></option>
                                
                                <?php
                                echo $eachRow['nome'];
                              }
                                
                            ?>
                              
                   </select>
                 
                        
                &nbsp;  

                <p style="display:none" ID=pZona>TipoZona</p>
                <select name="comboboxTipoZona" id="TipoZona" style="display:none"></select>
                &nbsp;  
                <p>Numero de requesição</p>
                <input type="text" id="inputreq" name="req" class="form-control" placeholder="Numero de requesição" value="REQ-" required >
                    
                
                <p style="display:none" id="pArmazem">Armazem</p>
                <select name="Armazem" id="Armazem" style="display:none"></select>

                <div id="Espaco"> </div>
                
        
              <div id="HiddenTeste" name="HiddenTeste">
              </div>
                          <p>Quantidade de paletes</p>
                <input type="number" id="inputqt" name="qt" class="form-control" placeholder="Quantidade de paletes neste artigo" value="<?php echo $_POST['qt'];?>"required >
                
                <button type="submit">Registar Cliente</button>   
           </form><!-- /form -->
        </div>

    </div>
   
</body>

</html>
<script>
$("#TipoPalete").on("change",function(){
  $.ajax({
			url: 'ajaxEntrega.php',
			type: 'POST',
			data:{id:$("#TipoPalete").val()},
			success: function(data)
			{ 
        $("#pZona").css({'display':'block'});
        $("#TipoZona").css({'display':'block'});
				$("#TipoZona").html(data);
			},
		});
});
</script>

<script>
$("#Armazem").on("change",function(){
  $.ajax({
			url: 'ajaxEspaco.php',
			type: 'POST',
			data:{id:$("#Armazem").val()},
			success: function(data)
			{
        document.getElementById("inputqt").setAttribute("max", data);
			},
		});
});
</script>
<script>
$("#TipoPalete").on("change",function(){
  $.ajax({
			url: 'ajaxArmazem.php',
			type: 'POST',
			data:{id:$("#TipoPalete").val()},
			success: function(data)
			{   
                $("#pArmazem").css({'display':'block'})
                $("#inputqt").css({'display':'block'});
                $("#Armazem").css({'display':'block'});
				$("#Armazem").html(data);
			},
		});
});
</script>
<script type="text/javascript">
  document.getElementById('comboboxCli').value = "<?php echo $_POST['comboboxCli'];?>";
  document.getElementById('TipoPalete').value = "<?php echo $_POST['TipoPalete'];?>";
  document.getElementById('comboboxArtigo').value = "<?php echo $_POST['comboboxArtigo'];?>";
  document.getElementById('TipoZona').value = "<?php echo $_POST['TipoZona'];?>";
  document.getElementById('Armazem').value = "<?php echo $_POST['Armazem'];?>";
  
</script>
