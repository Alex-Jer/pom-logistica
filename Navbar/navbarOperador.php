<!DOCTYPE html>
<?php
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION["perfilId"] == 1) {
    header("Location: /POM-Logistica/index.php");
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

<head>
    <title>POM Logistica</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="\POM-Logistica\styles\style3.min.css">
    <link rel="icon" type="image/png" href="\POM-Logistica\images/titlelogo.png  ">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<style>
    @media (min-width: 992px) {
        .animate {
            animation-duration: 0.3s;
            -webkit-animation-duration: 0.3s;
            animation-fill-mode: both;
            -webkit-animation-fill-mode: both;
        }

        #navbarMobile {
            display: none !important;
        }

        #navbarDesktop {
            display: initial !important;
        }
    }

    @keyframes slideIn {
        0% {
            transform: translateY(1rem);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
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

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        background-color: #fcfcfc !important;
        border-color: #dee2e6 #dee2e6 #fcfcfc !important;
    }

    .nav-tabs {
        width: 100%;
    }

    .dropdown-item:focus,
    .dropdown-item:hover {
        background-color: transparent;
    }

    @media (max-width:320px) {

        #navbarMobile {
            display: initial;
        }

        #navbarDesktop {
            display: none;
        }
    }

    @media (min-width:320px) {

        /* smartphones, iPhone, portrait 480x320 phones */
        #navbarMobile {
            display: initial;
        }

        #navbarDesktop {
            display: none;
        }
    }

    @media (min-width:481px) {

        /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */
        #navbarMobile {
            display: initial;
        }

        #navbarDesktop {
            display: none;
        }
    }

    @media (min-width:641px) {

        /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */
        #navbarMobile {
            display: initial;
        }

        #navbarDesktop {
            display: none;
        }
    }

    @media (min-width:961px) {

        /* tablet, landscape iPad, lo-res laptops ands desktops */
        #navbarMobile {
            display: initial;
        }

        #navbarDesktop {
            display: none;
            font-size: 90%;
        }
    }

    @media (min-width:1025px) {

        /* big landscape tablets, laptops, and desktops */
        #navbarMobile {
            display: none;
        }

        #navbarDesktop {
            display: initial;
        }
    }

    @media (min-width:1281px) {

        /* hi-res laptops and desktops */
        #navbarMobile {
            display: none;
        }

        #navbarDesktop {
            display: initial;
        }
    }
</style>

<body>
    <!-- Navbar Desktop -->
    <nav class="navbar navbar-expand-lg" id="navbarDesktop">
        <ul class="nav nav-tabs" style="margin-top:-1.4rem">
            <li class="nav-item">
                <a class="d-block" style="margin-top:5px" href="\POM-Logistica\Operador\Menu.php" rel="home"><img class="d-block" src="/POM-Logistica/images/logosemsombra.png" alt="logo"></a>
            </li>
            <li class="nav-item" style="margin-left:1rem;">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("Listar_clientes") ?>" href="/POM-Logistica/Operador/Listagens/Listar_clientes.php">Clientes</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= echoActiveClassIfRequestMatches("inserir_paletes") ?> <?= echoActiveClassIfRequestMatches("Guia_Operador") ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Confirmar Guias</a>
                <div class="dropdown-menu dropdown-menu-right animate slideIn">

                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("inserir_paletes") ?>" href="/POM-Logistica/Operador/Listagens/inserir_paletes.php">Guia Entrega</a>
                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("Guia_Operador") ?>" href="/POM-Logistica/Operador/Guia_Operador.php">Guia Transporte</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= echoActiveClassIfRequestMatches("Listar_guia_rececao") ?> <?= echoActiveClassIfRequestMatches("Listar_guia_devolucao") ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Emitir Guias</a>
                <div class="dropdown-menu dropdown-menu-right animate slideIn">

                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("Listar_guia_rececao") ?>" href="/POM-Logistica/Operador/Listagens/Listar_guia_rececao.php">Guia Receção</a>
                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("Listar_guia_devolucao") ?>" href="/POM-Logistica/Operador/Listagens/Listar_guia_devolucao.php">Guia Devolução</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("Listar_todas_as_guias") ?>" href="/POM-Logistica/Operador/Listagens/Listar_todas_as_guias.php">Consultar Pedidos</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= echoActiveClassIfRequestMatches("mudar_pass") ?> data-toggle=" dropdown href="#" role="button" aria-haspopup="true" aria-expanded="false">Conta</a>
                <div class="dropdown-menu dropdown-menu-right animate slideIn">
                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("mudar_pass") ?>" href="/POM-Logistica/Operador/mudar_pass.php">Alterar Palavra-Passe</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("index") ?>" href="/POM-Logistica/index.php">Sair</a>
            </li>
        </ul>
    </nav>

    <!-- Navbar Mobile -->
    <nav class="navbar navbar-expand-lg navbar-light" id="navbarMobile">
        <button class="navbar-toggler" style="margin-top:1rem; margin-bottom:-1rem" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="nav flex-column">
                <li class="nav-item" style="margin-top:1rem;">
                    <a class="nav-link <?= echoActiveClassIfRequestMatches("Menu") ?>" href="/POM-Logistica/Operador/Menu.php">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= echoActiveClassIfRequestMatches("Listar_clientes") ?>" href="/POM-Logistica/Operador/Listagens/Listar_clientes.php">Clientes</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= echoActiveClassIfRequestMatches("inserir_paletes") ?> <?= echoActiveClassIfRequestMatches("Guia_Operador") ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Confirmar Guias</a>
                    <div class="dropdown-menu dropdown-menu-right animate slideIn">
                        <a class="dropdown-item <?= echoActiveClassIfRequestMatches("inserir_paletes") ?>" href="/POM-Logistica/Operador/Listagens/inserir_paletes.php">Guia Entrega</a>
                        <a class="dropdown-item <?= echoActiveClassIfRequestMatches("Guia_Operador") ?>" href="/POM-Logistica/Operador/Guia_Operador.php">Guia Transporte</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= echoActiveClassIfRequestMatches("Listar_guia_rececao") ?> <?= echoActiveClassIfRequestMatches("Listar_guia_devolucao") ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Emitir Guias</a>
                    <div class="dropdown-menu dropdown-menu-right animate slideIn">

                        <a class="dropdown-item <?= echoActiveClassIfRequestMatches("Listar_guia_rececao") ?>" href="/POM-Logistica/Operador/Listagens/Listar_guia_rececao.php">Guia Receção</a>
                        <a class="dropdown-item <?= echoActiveClassIfRequestMatches("Listar_guia_devolucao") ?>" href="/POM-Logistica/Operador/Listagens/Listar_guia_devolucao.php">Guia Devolução</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= echoActiveClassIfRequestMatches("Listar_todas_as_guias") ?>" href="/POM-Logistica/Operador/Listagens/Listar_todas_as_guias.php">Consultar Pedidos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= echoActiveClassIfRequestMatches("mudar_pass") ?> data-toggle=" dropdown href="#" role="button" aria-haspopup="true" aria-expanded="false">Conta</a>
                    <div class="dropdown-menu dropdown-menu-right animate slideIn">
                        <a class="dropdown-item <?= echoActiveClassIfRequestMatches("mudar_pass") ?>" href="/POM-Logistica/Operador/mudar_pass.php">Alterar Palavra-Passe</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= echoActiveClassIfRequestMatches("index") ?>" href="/POM-Logistica/index.php">Sair</a>
                </li>
            </ul>
        </div>
    </nav>
</body>

</html>
