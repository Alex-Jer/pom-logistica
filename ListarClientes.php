<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
//include 'operador.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") { }
?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body>
    <nav role="navigation">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="operador.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="armazem.php">Armazém</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Guia_Operador_operador.php">Guia do Operador</a></li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="showGuiaEntrega.php">Registar Palete</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mudarpass_operador.php">Mudar Palavra-Passe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listagem_pedidos_armazem_operador.php">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="Guia_Rececao.php">Imprimir Receção</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Guia_Devolucao.php">Imprimir Devolução</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pdf.php">PDF</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Sair</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="card card-container" style="text-align:center; width:100%; max-width: 100000px">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="registar_clientes.php" method="post">
                <div style="text-align:center">
                    <h1 style="margin-bottom:1rem;">Clientes</h1>
                    <div class="container">
                        <div style="text-align:center">
                            <button type="submit" id="pdf" class="btn btn-primary" style="width:3.5rem; height:2.2rem; display:none; margin-top:-3.3rem; margin-right:17rem; text-align:center; float:right;">PDF</button>
                        </div>
                        <table class="table" style="font-size:16px;">
                            <thead>
                                <tr>
                                    <th style="width:15%">Cliente</th>
                                    <th style="width:30%">NIF</th>
                                    <th style="width:40%">Morada</th>
                                    <th style="width:30%">Localidade</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $dado = mysqli_query($conn, "SELECT * FROM cliente");
                            foreach ($dado as $eachRow) {

                                $nomeID=$eachRow['id'];
                                $Nome=$eachRow['nome'];
                                $nif = $eachRow['nif'];
                                $Morada = $eachRow['morada'];
                                $Localidade = $eachRow['localidade'];
                                //Inacabado
                                echo '<tr>';
                                    echo '<td> '.$Nome.'</td>';
                                        echo '<td> '.$nif.'</td>';
                                        echo '<td> '.$Morada.'</td>';
                                        echo '<td> '.$Localidade.'</td>';
                                echo '</tr>';
                                }
                                ?>
                               
                            </tbody>
                            
                        </table>
                    </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>

</html>
