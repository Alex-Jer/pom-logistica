<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="teste.css">
</head>

<body>
    <?php
    function echoActiveClassIfRequestMatches($requestUri)
    {
        $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

        if ($current_file_name == $requestUri)
            echo 'active"';
    }
    ?>

    <nav role="navigation">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="navbarAdmin.php">Home</a>
            </li>
            <li class="nav-item dropdown"></li>
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Guias</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="Guia_Entrega.php">Entrega</a>
                    <a class="dropdown-item" href="Guia_Operador_admin.php">Operador</a>
                    <a class="dropdown-item" href="Guia_Transporte.php">Transporte</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registar_cliente.php">Registar Cliente</a>
            </li>
            <li class="nav-item <?=echoActiveClassIfRequestMatches("registar_utilizador")?>">
                <a class="nav-link" href="registar_utilizador.php">Registar Utilizador</a></li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mudarpass_admin.php">Mudar Palavra-Passe</a>
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
</body>

</html>