<!DOCTYPE html>
<?php
include 'db.php';
if(!isset($_SESSION)) 
{ 
    session_start(); 
}  
if ($_SESSION["user"]==2)
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
<<<<<<< HEAD
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

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
    <link rel="stylesheet" href="node_modules\bootstrap3\dist\css\bootstrap.min.css">
</head>

<body>
    <header class="site-header">

        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                        <div class="site-branding d-flex align-items-center">


                            <nav class="site-navigation d-flex justify-content-end align-items-center">
                                <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-content-center   ">
                                    <li><a href="navbarLogin.php">Home</a></li>
                                    <li><a href="artigo.php">Artigo</a></li>
                                    <li><a href="Guia_Entrega.php">Guia Entrega</a></li>
                                    <li><a href="Guia_Transporte.php">Guia Transporte</a></li>
                                    <li><a href="fatura_cliente.php">Fatura</a></li>
                                    <li> <a href="registar_cliente.php">Registar Cliente</a></li>
                                    <li> <a href="registar_utilizador.php">Registar Utilizador</a></li>
                                    <li>  <a href="mudarpass.php">Mudar Palavra-Pass</a></li>
                                    <li><a href="Index.php">Sair</a></li>
                                    
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
    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/jquery.collapsible.min.js'></script>
    <script type='text/javascript' src='js/swiper.min.js'></script>
    <script type='text/javascript' src='js/jquery.countdown.min.js'></script>
    <script type='text/javascript' src='js/circle-progress.min.js'></script>
    <script type='text/javascript' src='js/jquery.countTo.min.js'></script>
    <script type='text/javascript' src='js/jquery.barfiller.js'></script>
    <script type='text/javascript' src='js/custom.js'></script>
=======
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav role="navigation">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="navbarLogin.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Guias</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="Guia_Entrega.php">Entrega</a>
                    <a class="dropdown-item" href="Guia_Operador.php">Operador</a>
                    <a class="dropdown-item" href="Guia_Transporte.php">Transporte</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registar_cliente.php">Registar Cliente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registar_utilizador.php">Registar Utilizador</a></li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mudarpass.php">Mudar Palavra-Passe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listagem_pedidos_armazem_admin.php">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="fatura_cliente.php">Fatura</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Sair</a>
            </li>
        </ul>
    </nav>
>>>>>>> 61999857b0b61dfd2b17cdec280e99798503bf38
</body>


</html>