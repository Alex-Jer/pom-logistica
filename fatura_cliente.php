<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarLogin.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST["cbCliente"];
}
date_default_timezone_set("Europe/Lisbon");
        $timeRN=date("Y-m-d H:i:s");
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.7.0/d3.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="">
    <meta charset="utf-8">
    <script type="text/javascript" src="jquery.js"></script>
    <link rel="stylesheet" href="node_modules\bootstrap3\dist\css\bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="css.css">

</head>

<body>
    <div class="container">
        <div class="card card-container" style="text-align:center; width:100%; max-width: 100000px">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="fatura_cliente.php" method="post">
                <div style="text-align:center">
                    <h1>Fatura mensal</h1>
                    <br>
                    <div class="container">
<<<<<<< HEAD
                        <div class="text-align:center">
                            <select class="custom-select" name="cbCliente" id="cbCliente" style="text-align-last:center; width:200px;" onchange="this.form.submit()"  >
=======
                        <div style="text-align:center">
                            <select class="custom-select custom-select-lg" name="cliente" style="text-align-last:center; width:200px;" onchange="this.form.submit()">
>>>>>>> f1027e8dba6615cf8b313cc67aaf9e20565d59f4
                                <option value="" disabled selected>Cliente</option>
                                <?php
                                $busca = mysqli_query($conn, "SELECT * FROM cliente");
                                foreach ($busca as $eachRow) {
                                    ?>
                                    <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>

                        <div id ="clienteteste">
                        </div>
                        <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tipo de Guia</th>
                                    <th>Nº Paletes</th>
                                    <th>Preço por palete / zona</th>
                                    <th>Preço de Carga/Descarga</th>
                                    <th>Dias</th>

                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($cliente)) {
                                    $query = mysqli_query($conn, "SELECT * FROM guia WHERE cliente_id='$cliente' and (tipo_guia_id=4 or tipo_guia_id=3)");
                                    
                                    foreach ($query as $eachRow) {
                                        $CargaFinal=0;
                                        $guiaid=$eachRow['id'];
                                        $clienteId = $eachRow['cliente_id'];
                                        $sql2 = mysqli_query($conn, "SELECT * FROM cliente WHERE id='$clienteId'");
                                        $sql3 = mysqli_fetch_array($sql2);
                                        $tipoGuia=$eachRow['tipo_guia_id'];
                                        $numReq = $eachRow['numero_requisicao'];
                                        $numPaletes = $eachRow['numero_paletes'];
                                        $dataCarga = $eachRow['data_carga'];
                                        $ArtigoIDD = $eachRow['artigo_id'];
                                        $dataPrevistaDescarga = $eachRow['data_prevista'];
                                        $tipozonaId = $eachRow['tipo_zona_id'];
                                        $armazemId = $eachRow['armazem_id'];

                                        $queryPalete= mysqli_query($conn, "SELECT * FROM palete WHERE artigo_id='$ArtigoIDD'");
                                    
                                        foreach ($queryPalete as $eachRowPalete) {
                                            $dataDescarga=$eachRowPalete['Data_Saida'];
                                            $dataCarga=$eachRowPalete['Data'];
                                            
                                            if ($dataDescarga==0)
                                            {
                                                $datetime1 = new DateTime($timeRN);
                                                $datetime3=$timeRN;
                                            }
                                            else
                                            {
                                                $datetime1 = new DateTime($dataDescarga);
                                                $datetime3=$dataDescarga;
                                            }
                                            $datetime2 = new DateTime($dataCarga);
                                            $intervalo = date_diff($datetime1, $datetime2);
                                            $diasArmazenamento = $intervalo->format('%a');
                                            if ($diasArmazenamento==0){
                                                $diasArmazenamento=1;
                                            }
                                        }
                                        
                                        $sqlTGuia = mysqli_query($conn, "SELECT * FROM tipo_guia WHERE id='$tipoGuia'");
                                        $sqlTipoG = mysqli_fetch_array($sqlTGuia);
                                        $NomeGuia = $sqlTipoG['nome'];

                                        $sql4 = mysqli_query($conn, "SELECT * FROM zona WHERE id='$tipozonaId'");
                                        $sql5 = mysqli_fetch_array($sql4);
                                        $precoZona = $sql5['preco_zona'];

                                        $sql6 = mysqli_query($conn, "SELECT * FROM armazem WHERE id='$armazemId'");
                                        $sql7 = mysqli_fetch_array($sql6);
                                        $custoCarga = $sql7['custo_carga'];
                                        $custoDescarga = $sql7['custo_descarga'];

                                        $result = $conn->query("SELECT count(*) FROM guia WHERE tipo_guia_id=3 AND cliente_id='$clienteId'");
                                        $row = $result->fetch_row();
                                        $count = $row[0];

                                        $result = $conn->query("SELECT count(*) FROM guia WHERE tipo_guia_id=4 AND cliente_id='$clienteId'");
                                        $row = $result->fetch_row();
                                        $count2 = $row[0];

                                        if ($tipoGuia==3)
                                        {
                                            $CargaFinal = $custoCarga * $count;
                                            $tipoLinha=1;
                                         

                                        }
                                        elseif($tipoGuia==4)
                                        {
                                            $CargaFinal = $custoDescarga * $count2;
                                            $tipoLinha=2;
                                        }
                                        $Total= $CargaFinal + ($precoZona * $numPaletes * $diasArmazenamento );
                                        ?>
                                        <tr>    
                                            <td><?php  echo "$NomeGuia - $numReq" ?>  </td>
                                            <td><?php  echo $numPaletes ?>  </td>
                                            <td><?php echo $precoZona * $numPaletes * $diasArmazenamento . " €" ?></td>
                                            <td><?php echo $CargaFinal. " €" ?></td>
                                            <td><?php echo $diasArmazenamento ?></td>
                                            <td><?php echo $Total . " €" ?></td>
                                        </tr>
                                        
                                    <?php

                                    //  $sql = "INSERT INTO linha (tipo_linha_id, guia_id, artigo_id,quantidade,valor) VALUES ($tipoLinha,$guiaid, $ArtigoIDD ,$numPaletes,'$Total')";
        
                                    //  if (mysqli_query($conn, $sql)) {
                                                     
                                    //  } else 
                                    //  {
                                    //          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                    //  }
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <!--<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Confirmar</button>-->
            </form><!-- /form -->
            <form  class="container" action="pdfFatura.php" method="post">
            <button type="submit">PDF</button>   

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                ?>

                <input type="hidden" name="GetCliente" value=<?php echo $cliente?>>
                <?php
                }
                ?>
            
            </form>
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script type="text/javascript"></script>
    <script type="text/javascript"></script>
</body>

</html>
