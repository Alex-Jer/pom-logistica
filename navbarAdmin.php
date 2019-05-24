<!DOCTYPE html>
<?php
include 'db.php';
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION["perfilId"] == 2) {
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
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="/POM-Logistica/styles\style3.css">
    <link rel="stylesheet" href="/POM-Logistica/css\bootstrap.css">
    <html lang="en">
    
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
<style>
  .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                height: 1.5rem;
                border-top: 6px solid #0159b7;
                background-color: white;
                color: black;
                text-align: right;
                font-size: 10px
                

        }
</style>

<body>
    <div class="footer">
                <p style="margin-right:10px; color:black;">Direitos reservados a POM Logistica, LDA 2019</p>
        </div>

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
                <a class="d-block" style="margin-top:5px" href="MenuAdmin.php" rel="home"><img class="d-block" src="images/Logosemsombra.png" alt="logo"></a>
            </li>
            <li class="nav-item" style="margin-left:1rem">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("ListarClientes_admin") ?>" href="ListarClientes_admin.php">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("ListarUtilizadores") ?>" href="ListarUtilizadores.php">Utilizadores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("Listar_todas_as_guiasAdmin") ?>" href="Listar_todas_as_guiasAdmin.php">Lista de Guias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("fatura_cliente") ?>" href="fatura_cliente.php">Fatura</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("Listar_todas_as_guiasDiariasAdmin") ?>" href="Listar_todas_as_guiasDiariasAdmin.php">Pedidos Diários</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("artigo") ?>" href="artigo.php">Artigo</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= echoActiveClassIfRequestMatches("mudarpass_admin") ?> data-toggle=" dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Conta</a>
                <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("mudarpass_admin") ?>" href="mudarpass_admin.php">Alterar Palavra-Passe</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("index") ?>" href="index.php">Sair</a>
            </li>
        </ul>
    </nav>
</body>


</html>