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
    <link rel="stylesheet" href="styles\style3.css">
    <link rel="stylesheet" href="css\bootstrap.css">
</head>

<body>
    <nav role="navigation">
        <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="d-block" style="margin-top:5px"href="MenuAdmin.php" rel="home"><img class="d-block" src="images/Logo.png" alt="logo"></a>
        
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("ListarUtilizadores") ?>" href="ListarUtilizadores.php">Utilizadores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("ListarClientes_admin") ?>" href="ListarClientes_admin.php">Clientes</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= echoActiveClassIfRequestMatches("Guia_Entrega") ?> <?= echoActiveClassIfRequestMatches("Guia_Operador_admin") ?> <?= echoActiveClassIfRequestMatches("Guia_Transporte") ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Guias</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("Guia_Entrega") ?>" href="Guia_Entrega.php">Entrega</a>
                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("Guia_Operador_admin") ?>" href="Guia_Operador_admin.php">Operador</a>
                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("Guia_Transporte") ?>" href="Guia_Transporte.php">Transporte</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("Listar_todas_as_guiasAdmin") ?>" href="Listar_todas_as_guiasAdmin.php">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("fatura_cliente") ?>" href="fatura_cliente.php">Fatura</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= echoActiveClassIfRequestMatches("mudarpass_admin")?> data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Conta</a>
                <div class="dropdown-menu">
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