<?php
// include 'navbarOperador.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="styles\style3.css">
        <link rel="stylesheet" href="node_modules\admin-lte\dist\css\AdminLTE.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="styles\table.css">
        <link rel="stylesheet" href="node_modules\jquery\dist\jquery.js">
        <link rel="stylesheet" href="styles\style3.css">
        <link rel="stylesheet" href="css\bootstrap.css">
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
                if (i < 10) {
                        i = "0" + i
                }; // add zero in front of numbers < 10
                return i;
        }
</script>


<style>
        body {
                overflow: hidden;
        }

        .Imagem {
                background-image: url("images/Carrinho.png");
                /* Full height */
                margin-top: 0px;
                margin-left: 50px;
                width: 34.35rem;
                height: 37.35rem;
                /* border:solid;
  border-color: #33ccff; */

                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;


        }

        .ImagemPequena {
                background-image: url("images/paletes.png");
                /* Full height */
                width: 28.5rem;
                height: 18.85rem;
                /* border:solid;
                border-color: #33ccff; */
                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                margin-left: 3.5rem;


        }

        .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                height: 1.5rem;
                border-top: 6px solid;
                background-color: white;
                color: black;
                text-align: right;
                font-size: 10px
        }

        .colunaEsquerda {

                width: 48%;
                heigth: 100%;
                float: left;
                margin: 5px;
                padding: 5px;
        }

        .colunaDireita {
                width: 50%;
                heigth: 100%;
                float: left;
                margin: 5px;
                padding: 5px;
        }

        .bg-aqua {
                background-color: #007bff !important;
        }

        .footer {
                color: #0159b7;
        }
</style>

<body onload="startTime()">
        <div class="container">
                <div class="text-center">
                        <img src="images\logogrande.png" style="width:19rem; height:3rem;">
                        <?php
                        date_default_timezone_set("Europe/Lisbon");
                        $timeRN = date("Y-m-d");
                        ?>
                </div>
                <div class="row" style="height:640px;">
                        <div class="colunaEsquerda">
                                <h5 style="margin-left:26.5rem;"><?php echo $timeRN ?></h5>
                                <div class="row" style="height:150px">
                                        <div class="col sm-1">
                                                <div class="small-box bg-aqua" style="width:150px">
                                                        <div class="inner">
                                                                <h5><b>Imprimir</b></h5>
                                                                <p>Guia Rececao</p>
                                                        </div>
                                                        <div class="icon">
                                                        </div>
                                                        <a href="ListarGuia_Rececao.php" class="small-box-footer">
                                                                Ir <i class="fa fa-arrow-circle-right"></i>
                                                        </a>
                                                </div>
                                        </div>

                                        <div class="col sm-1">
                                                <div class="small-box bg-aqua" style="width:150px">
                                                        <div class="inner">
                                                                <h5><b>Confirmar</b></h5>


                                                                <p>Guias Transporte</p>
                                                        </div>
                                                        <div class="icon">
                                                        </div>
                                                        <a href="Guia_Operador_operador.php" class="small-box-footer">
                                                                Ir <i class="fa fa-arrow-circle-right"></i>
                                                        </a>
                                                </div>
                                        </div>

                                        <div class="col sm-1">
                                                <div class="small-box bg-aqua" style="width:150px">
                                                        <div class="inner">
                                                                <h5><b>Imprimir</b></h5>


                                                                <p>Guia Devolução</p>
                                                        </div>
                                                        <div class="icon">
                                                        </div>
                                                        <a href="ListarGuia_Devolucao.php" class="small-box-footer">
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
                                                                <h5><b>Confirmar</b></h5>
                                                                <p>Guias Entrega</p>
                                                        </div>
                                                        <div class="icon">
                                                        </div>
                                                        <a href="inserirPaletes.php" class="small-box-footer">
                                                                Ir <i class="fa fa-arrow-circle-right"></i>
                                                        </a>
                                                </div>
                                        </div>

                                        <div class="col sm-1">
                                                <div class="small-box bg-aqua" style="width:150px">
                                                        <div class="inner">
                                                                <h5><b>Listar</b></h5>


                                                                <p>Guias Diarias</p>
                                                        </div>
                                                        <div class="icon">
                                                        </div>
                                                        <a href="Listar_todas_as_guiasOperador.php" class="small-box-footer">
                                                                Ir <i class="fa fa-arrow-circle-right"></i>
                                                        </a>
                                                </div>
                                        </div>

                                        <div class="col sm-1">
                                                <div class="small-box bg-aqua" style="width:150px">
                                                        <div class="inner">
                                                                <h5><b>Sair</b></h5>
                                                                <p>Terminar sessão</p>
                                                        </div>
                                                        <div class="icon">
                                                        </div>
                                                        <a href="index.php" class="small-box-footer">
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
                                <h5 id="txt" style="font-size: 1.3rem; margin-left:0.8rem;"></h5>
                                <div class="Imagem" style="margin-left:1rem">
                                </div>
                        </div>
                </div>
        </div>
        <div class="footer">
                <p style="margin-right:10px; color:black;">Direitos reservados a POM Logistica, LDA 2019</p>
        </div>

</body>

</html>