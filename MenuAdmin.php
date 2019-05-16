<?php include 'navbarAdmin.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="styles\style3.css">
    
    <link rel="stylesheet" href="node_modules\admin-lte\dist\css\AdminLTE.min.css">
</head>
 

<script>
function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('txt').innerHTML =
  h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>


<style>
.Imagem
 {
  background-image: url("images/Carrinho.png");
  

  /* Full height */
  margin-top:0px;
  margin.left:50px
  width:500px;
  height:640px;
  /* border:solid;
  border-color: #33ccff; */
  
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
 

 }

 .ImagemPequena
 {
  background-image: url("images/paletes.png");
  

  /* Full height */
  width:500px;
  height:340px;
  /* border:solid;
  border-color: #33ccff; */
  
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
 

 }

 .footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 2.4%;
  border-top: 6px solid;
  background-color:white;
  color: black;
  text-align: right;
  font-size:10px
  

}

.colunaEsquerda{

    width: 48%;
    heigth:100%;
    float:left;
    margin:5px;
    padding:5px;
}
.colunaDireita{
width: 50%;
heigth:100%;
float:left;
margin:5px;
padding:5px;
}
</style>
<body onload="startTime()">
<div class="container">
 <div class="text-center">
 <h1 >POM LOGISTICA</h1>
 <?php
 date_default_timezone_set("Europe/Lisbon");
        $timeRN=date("Y-m-d");
         ?>

 </div>
  
  <div class="row" style="height:640px;">
     <div class="colunaEsquerda">
     <p style="margin-left:80%"><?php echo $timeRN?></p>
        <div class="row" style="height:150px">
        <div class="col sm-1">
           <div class="small-box bg-aqua" style="width:150px">
                            <div class="inner">
                            <h5><b>Listar</b></h5>


                            <p>Clientes</p>
                            </div>
                            <div class="icon">
                            </div>
                            <a href="ListarUtilizadores.php" class="small-box-footer">
                            Ir <i class="fa fa-arrow-circle-right"></i>
                            </a>
                </div>
        </div>
                
        <div class="col sm-1">
           <div class="small-box bg-aqua" style="width:150px">
                            <div class="inner">
                            <h5><b>Listar</b></h5>


                            <p>Utilizadores</p>
                            </div>
                            <div class="icon">
                            </div>
                            <a href="ListarClientes_admin.php" class="small-box-footer">
                            Ir <i class="fa fa-arrow-circle-right"></i>
                            </a>
                </div>
        </div>
                
                <div class="col sm-1">
           <div class="small-box bg-aqua" style="width:150px">
                            <div class="inner">
                            <h5><b>Lista</b></h5>


                            <p>De todas as Guias</p>
                            </div>
                            <div class="icon">
                            </div>
                            <a href="Listar_todas_as_guiasAdmin.php" class="small-box-footer">
                            Ir <i class="fa fa-arrow-circle-right"></i>
                            </a>
                </div>
        </div>
                <!-- <div class="row" style="height:100px;">
                
                </div>  -->
         </div>
         <div class="row" style="height:150px;">
        <div class="col sm-1">
           <div class="small-box bg-aqua" style="width:150px">
                            <div class="inner">
                            <h5><b>Criar</b></h5>


                            <p>Fatura</p>
                            </div>
                            <div class="icon">
                            </div>
                            <a href="fatura_cliente.php" class="small-box-footer">
                            Ir <i class="fa fa-arrow-circle-right"></i>
                            </a>
                </div>
        </div>
                
        <div class="col sm-1">
           <div class="small-box bg-aqua" style="width:150px">
                            <div class="inner">
                            <h5><b>Criar</b></h5>


                            <p>Artigo</p>
                            </div>
                            <div class="icon">
                            </div>
                            <a href="#.php" class="small-box-footer">
                            Ir <i class="fa fa-arrow-circle-right"></i>
                            </a>
                </div>
        </div>
                
                <div class="col sm-1">
           <div class="small-box bg-aqua" style="width:150px">
                            <div class="inner">
                            <h5><b>Mudar</b></h5>

                            <p>Palavra-Passe</p>
                            </div>
                            <div class="icon">
                            </div>
                            <a href="mudarpass_admin.php" class="small-box-footer">
                            Ir <i class="fa fa-arrow-circle-right"></i>
                            </a>
                </div>
        </div>
                <!-- <div class="row" style="height:100px;">
                
                </div>  -->
         </div>
         <div class="row" style="height:350px;">
         <div class="ImagemPequena">
            </div>
         </div>
         
    </div>
        
        <div class="colunaDireita">
        <p id="txt"></p>
            <div class="Imagem">
            </div>
        </div>
    
    

         </div>
</div>
    <div class="footer"><p style="margin-right:10px;">Direitos reservados a POM Logistica, LDA 2019</p></div>
    
</body>
</html>