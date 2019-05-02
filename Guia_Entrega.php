
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

        $getCBtg= $_POST["comboboxTipoGuia"];

        $getCBart= $_POST["comboboxArtigo"];

        $getQT= $_POST["qt"];

        $getCBtp= $_POST["comboboxTipo_Palete"];

        $getCBtz= $_POST["comboboxTipoZona"];

        $getREQ= $_POST["req"];

        $busca = mysqli_query($conn,"SELECT * FROM tipo_palete WHERE id='$getCBtp'");
        $dado = mysqli_fetch_array($busca);
        $nome = $dado['nome'];
        $nome2 = $dado['id'];
  
      $busca2 = mysqli_query($conn,"SELECT * FROM zona WHERE tipo_zona_id='$nome2'");
      $dado2 = mysqli_fetch_array($busca2);
        $idZona = $dado2['id'];
        $espcZona = $dado2['espaco'];
        $nomeZona = $dado2['nome'];

        $sql = "INSERT INTO guia (cliente_id, tipo_guia_id, tipo_palete_id, tipo_zona_id,data_prevista,numero_paletes, numero_requisicao) VALUES ($nomeCli, $getCBtg,$getCBtp, $getCBtz, '$dataEntrega', $getQT,$getREQ)";
        if (mysqli_query($conn, $sql)) {
            ?>
            <script type="text/javascript">;
            alert("New record created successfully"); </script>
            <?php
                
        } else 
        {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
      /*header("Location: menu.php");*/
       exit;
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
            <p>Cliente</p>
            <select name="comboboxCli">
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
            <p>Tipo de Guia</p>
            <select name="comboboxTipoGuia">
                            <?php
                              $busca = mysqli_query($conn,"SELECT * FROM tipo_guia");
                              foreach ($busca as $eachRow)
                              {
                                ?>
                                &nbsp;
                                <option value=" <?php echo $eachRow['id'] ?>" <?php echo (isset($_POST['comboboxTipoGuia']) && $_POST['comboboxTipoGuia'] == $eachRow['id']) ? 'selected="selected"' : ''; ?>><?php echo $eachRow['nome'] ?></option>
                                <?php
                              }

                            ?>
            </select>
            &nbsp;
                <!-- <input type="input" id="inputGuia" name="Nguia" class="form-control" placeholder="Nº de guia" required autofocus> -->
                <p>Data e Hora da Entrega</p>
                <input type="datetime-local" id="inputdata" name="dataentrega"  placeholder="Data"  value="<?php echo $_POST['dataentrega'];?>"required >
                &nbsp;
                <p>Artigo</p>
                <select name="comboboxArtigo">
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
                   <p>Quantidade de paletes</p>
                <input type="number" id="inputqt" name="qt" class="form-control" placeholder="Quantidade de paletes neste artigo" value="<?php echo $_POST['qt'];?>"required >
                        
                &nbsp;  

                <p>TipoZona</p>
                <select name="comboboxTipoZona" id="TipoZona"></select>
                &nbsp;  
                <p>Numero de requesição</p>
                <input type="number" id="inputreq" name="req" class="form-control" placeholder="Numero de requesição" value="<?php echo htmlspecialchars($_POST['req']);?>" required >

               <?php
               if ($_SERVER["REQUEST_METHOD"] == "POST")
               {
               ?>
                    <p><?php echo  "Existe ", $espcZona, " espaços na ", $nomeZona?></p>
              <?php
               }
               ?>
                
                <button type="submit">Registar Cliente</button>   
           </form><!-- /form -->
        </div>

    </div>
   
</body>

</html>
<script>
$("#TipoPalete").on("change",function(){
  $.ajax({
			url: 'Ajax.php',
			type: 'POST',
			data:{id:$("#TipoPalete").val()},
			success: function(data)
			{

				$("#TipoZona").html(data);
			},
		});
});
</script>
