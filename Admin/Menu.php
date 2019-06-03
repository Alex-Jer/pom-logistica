<?php
//include 'Navbar\navbarAdmin.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>POM Logística</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.10/css/AdminLTE.min.css">
        <link rel="stylesheet" href="\POM-Logistica\styles\style3.min.css">
        <link rel="icon" type="image/png" href="\POM-Logistica\images/titlelogo.png">
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
                background-color: white;
        }

        .Imagem {
                background-image: url("/POM-Logistica/images/Carrinho6.jpg");

                /* Full height */
                margin-left: 50px;
                width: 100%;
                height: 100%;
                border-left: solid 4px #0159b7;
                /* border:solid;
  border-color: #33ccff; */

                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;


        }

        .ImagemPequena {
                background-image: url("/POM-Logistica/images/paletes.png");
                /* Full height */
                width: 28.5rem;
                height: 20rem;
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

                width: 46%;
                height: 100%;
                float: left;
                padding: 5px;
        }

        .colunaMaisEsquerda {

                width: 2%;
                height: 100%;
                float: left;
                margin: 5px;
                padding: 5px;
        }

        .colunaDireita {
                width: 50%;
                height: 100%;
                float: left;
                margin: 5px;
                margin-left: 0px;
                padding: 5px;
        }

        .bg-aqua {
                background-color: #007bff !important;
        }

        .footer {
                color: #0159b7;
        }

        .colop {
                width: 160px;
                max-width: 160px;
        }

        .rowi {
                margin-left: 10em;
                width: 500px;
        }

        .rowGrande {
                height: 100%;
        }

        .small-box>.small-box-footer {
                background-color: #0063cc;
                color: #fff;
                transition: 0.3s;
        }

        .small-box>.small-box-footer:hover {
                background-color: #0056b3;
        }
</style>

<body onload="startTime()">
        <div class="row rowGrande">
                <div class="colunaMaisEsquerda">
                </div>
                <div class="colunaEsquerda" style="display:block; margin:auto">
                        <div class="text-center; display:block; margin:auto">
                                <img src="\POM-Logistica\images\logogrande.png" style="display:block; margin:auto">
                                <?php
                                date_default_timezone_set("Europe/Lisbon");
                                $timeRN = date("Y-m-d");
                                ?>
                                <h5 style="text-align:center; margin-top:0.5rem"><?php echo $timeRN ?></h5>
                                <h5 style="text-align:center; margin-bottom:0.5rem" id="txt"></h5>
                        </div>
                        <div class="row rowi" style="height:150px; margin-top:1rem; margin:auto">
                                <div class="col sm-1 colop">
                                        <div class="small-box bg-aqua" style="width:150px;">
                                                <div class="inner">
                                                        <h5><b>Gerir</b></h5>
                                                        <p>Clientes</p>
                                                </div>
                                                <div class="icon">
                                                </div>
                                                <a href="/POM-Logistica/Admin/Listagens/Listar_clientes.php" class="small-box-footer">
                                                        Ir <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                        </div>
                                </div>
                                <div class="col sm-1 colop">
                                        <div class="small-box bg-aqua" style="width:150px">
                                                <div class="inner">
                                                        <h5><b>Gerir</b></h5>
                                                        <p>Utilizadores</p>
                                                </div>
                                                <div class="icon">
                                                </div>
                                                <a href="\POM-Logistica\Admin\Listagens\Listar_utilizadores.php" class="small-box-footer">
                                                        Ir <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                        </div>
                                </div>
                                <div class="col sm-1 colop">
                                        <div class="small-box bg-aqua" style="width:150px">
                                                <div class="inner">
                                                        <h5><b>Gerir</b></h5>
                                                        <p>Todas as guias</p>
                                                </div>
                                                <div class="icon">
                                                </div>
                                                <a href="\POM-Logistica\Admin\Listagens\Listar_todas_as_guias.php" class="small-box-footer">
                                                        Ir <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                        </div>
                                </div>
                        </div>
                        <div class="row rowi" style="height:150px; margin:auto">
                                <div class="col sm-1 colop">
                                        <div class="small-box bg-aqua" style="width:150px">
                                                <div class="inner">
                                                        <h5><b>Criar</b></h5>
                                                        <p>Faturas</p>
                                                </div>
                                                <div class="icon">
                                                </div>
                                                <a href="\POM-Logistica\Admin\fatura_cliente.php" class="small-box-footer">
                                                        Ir <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                        </div>
                                </div>
                                <div class="col sm-1 colop">
                                        <div class="small-box bg-aqua" style="width:150px">
                                                <div class="inner">
                                                        <h5><b>Criar</b></h5>
                                                        <p>Artigo</p>
                                                </div>
                                                <div class="icon">
                                                </div>
                                                <a href="\POM-Logistica\Admin\artigo.php" class="small-box-footer">
                                                        Ir <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                        </div>
                                </div>
                                <div class="col sm-1 colop">
                                        <div class="small-box bg-aqua" style="width:150px">
                                                <div class="inner">
                                                        <h5><b>Sair</b></h5>
                                                        <p>Terminar sessão</p>
                                                </div>
                                                <div class="icon">
                                                </div>
                                                <a href="\POM-Logistica\index.php" class="small-box-footer">
                                                        Ir <i class="fa fa-arrow-circle-right"></i>
                                                </a>
                                        </div>
                                </div>
                                <!-- <div class="row" style="height:100px;">
                </div>  -->
                        </div>
                        <img src="/POM-Logistica/images/paletes.png" style="display:block; margin:auto; margin-top:-4rem; width:26rem">
                </div>
                <div class="colunaDireita" style="margin-top:-1rem">
                        <div class="Imagem" style="margin-left:1rem">
                        </div>
                </div>
        </div>
        <div class="footer">
                <p style="margin-right:10px; color:black;">Direitos reservados a POM Logistica, LDA 2019</p>
        </div>
</body>

</html>