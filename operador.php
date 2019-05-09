<!DOCTYPE html>
<?php
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 }  
include 'db.php';
if ($_SESSION["user"]==1)
{
    
    header("Location: login.php");
    ?>
    <script type="text/javascript">
            alert("Voce nao tem permissoes para acessar a isso");
        </script>
        <?php
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<<<<<<< HEAD
    <header class="site-header">

        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                        <div class="site-branding d-flex align-items-center">


                            <nav class="site-navigation d-flex justify-content-end align-items-center">
                                <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                                    <li><a href="operador.php">Home</a></li>
                                    <li><a href="showGuiaEntrega.php">Registar Palete</a></li>
                                    <li><a href="Guia_Operador.php">Guia de devolução</a></li>
                                    <li><a href="Guia_Rececao.php">Imprimir Rececao</a></li>
                                    <li><a href="Guia_Devolucao.php">Imprimir Devolucao</a></li>
                                    <li><a href="listagem_pedidos_armazem.php">Pedidos</a></li>
                                    <li><a href="mudarpass.php">Mudar Palavra-Pass</a></li>
                                    <li><a href="index.php">Sair</a></li>
                                </ul>
                            </nav><!-- .site-navigation -->

                            <div class="hamburger-menu d-lg-none">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div><!-- .hamburger-menu -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .container -->
            </div><!-- .nav-bar -->
    </header><!-- .site-header -->
=======
    <nav role="navigation">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="operador.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="armazem.php">Armazém</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Guia_Operador.php">Guia do Operador</a></li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="showGuiaEntrega.php">Registar Palete</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mudarpass.php">Mudar Palavra-Passe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listagem_pedidos_armazem_operador.php">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Guia_Rececao.php">Imprimir Receção</a>
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
>>>>>>> 61999857b0b61dfd2b17cdec280e99798503bf38
    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/jquery.collapsible.min.js'></script>
    <script type='text/javascript' src='js/swiper.min.js'></script>
    <script type='text/javascript' src='js/jquery.countdown.min.js'></script>
    <script type='text/javascript' src='js/circle-progress.min.js'></script>
    <script type='text/javascript' src='js/jquery.countTo.min.js'></script>
    <script type='text/javascript' src='js/jquery.barfiller.js'></script>
    <script type='text/javascript' src='js/custom.js'></script>
</body>

</html>