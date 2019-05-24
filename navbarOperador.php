<!DOCTYPE html>
<?php
include 'db.php';
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION["perfilId"] == 1) {
    header("Location: index.php");
    ?>
    <script type="text/javascript">
        alert("Voce nao tem permissoes para acessar a isso");
    </script>
<?php
}
?>

<?php
function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'active';
}
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles\style3.css">
    <link rel="stylesheet" href="css\bootstrap.css">
     
    <title>POM Logistica</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" crossorigin="anonymous"> -->
    <!-- <link href="https://rawgit.com/tempusdominus/bootstrap-4/master/build/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" /> -->
    <link rel = "icon" type = "image/png" href = "images/titlelogo.png  ">
    <link rel="stylesheet" type="text/css" href="styles\style.css">
    <link rel="stylesheet" type="text/css" href="styles\style3.css">
    <link rel="stylesheet" type="text/css" href="css\bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.0/moment-with-locales.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <script src="https://rawgit.com/tempusdominus/bootstrap-4/master/build/js/tempusdominus-bootstrap-4.min.js"></script>
</head>
</head>

<style>
    @media (min-width: 992px) {
        .animate {
            animation-duration: 0.3s;
            -webkit-animation-duration: 0.3s;
            animation-fill-mode: both;
            -webkit-animation-fill-mode: both;
        }
    }

    @keyframes slideIn {
        0% {
            transform: translateY(1rem);
            opacity: 0;
        }

        100% {
            transform: translateY(0rem);
            opacity: 1;
        }

        0% {
            transform: translateY(1rem);
            opacity: 0;
        }
    }

    @-webkit-keyframes slideIn {
        0% {
            -webkit-transform: transform;
            -webkit-opacity: 0;
        }

        100% {
            -webkit-transform: translateY(0);
            -webkit-opacity: 1;
        }

        0% {
            -webkit-transform: translateY(1rem);
            -webkit-opacity: 0;
        }
    }

    .slideIn {
        -webkit-animation-name: slideIn;
        animation-name: slideIn;
    }

    .dropdown-menu {
        margin-top: -0.3rem !important;
        border-radius: 3px !important;
    }
</style>

<body>
    <nav role="navigation">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="d-block" style="margin-top:5px" href="MenuOperador.php" rel="home"><img class="d-block" src="images/Logosemsombra.png" alt="logo"></a>
            </li>
            <li class="nav-item dropdown" style="margin-left:1rem;">
                <a class="nav-link dropdown-toggle <?= echoActiveClassIfRequestMatches("ListarGuia_Rececao") ?> <?= echoActiveClassIfRequestMatches("ListarGuia_Devolucao") ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Imprimir Guias</a>
                <div class="dropdown-menu dropdown-menu-right animate slideIn">

                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("ListarGuia_Rececao") ?>" href="ListarGuia_Rececao.php">Guia Receção</a>
                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("ListarGuia_Devolucao") ?>" href="ListarGuia_Devolucao.php">Guia Devolução</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= echoActiveClassIfRequestMatches("inserirPaletes") ?> <?= echoActiveClassIfRequestMatches("Guia_Operador_operador") ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Confirmar Guias</a>
                <div class="dropdown-menu dropdown-menu-right animate slideIn">

                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("inserirPaletes") ?>" href="inserirPaletes.php">Guia Entrega</a>
                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("Guia_Operador_operador") ?>" href="Guia_Operador_operador.php">Guia Transporte</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("Listar_todas_as_guiasOperador") ?>" href="Listar_todas_as_guiasOperador.php">Consultar Pedidos</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= echoActiveClassIfRequestMatches("mudarpass_operador") ?> data-toggle=" dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Conta</a>
                <div class="dropdown-menu dropdown-menu-right animate slideIn">
                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("mudarpass_operador") ?>" href="mudarpass_operador.php">Alterar Palavra-Passe</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("index") ?>" href="index.php">Sair</a>
            </li>
        </ul>
    </nav>



</body>

</html>