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

<html lang="en">

<head>
<meta charset="utf-8">
    <html lang="en">
    <title>POM Logistica</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="\POM-Logistica\styles\style3.min.css">
    <link rel="icon" type="image/png" href="\POM-Logistica\images/titlelogo.png">
    
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

    body {
        background-color: #f5f5f5 !important;
    }
</style>

<body>
    <nav role="navigation">
        <ul class="nav nav-tabs">
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
</body>

</html>