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
</head>

<body>
    <nav role="navigation">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("operador") ?>" href="operador.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("ListarClientes_operador") ?>" href="ListarClientes_operador.php">Clientes</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= echoActiveClassIfRequestMatches("Guia_Operador_operador") ?> <?= echoActiveClassIfRequestMatches("Guia_Rececao") ?> <?= echoActiveClassIfRequestMatches("Guia_Devolucao") ?>" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Guias</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("Guia_Operador_operador") ?>" href="Guia_Operador_operador.php">Operador</a>
                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("Guia_Rececao") ?>" href="Guia_Rececao.php">Receção</a>
                    <a class="dropdown-item <?= echoActiveClassIfRequestMatches("Guia_Devolucao") ?>" href="Guia_Devolucao.php">Devolução</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("inserirPaletes") ?>" href="inserirPaletes.php">Paletes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("listagem_pedidos_armazem_operador") ?>" href="listagem_pedidos_armazem_operador.php">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("mudarpass_operador") ?>" href="mudarpass_operador.php">Mudar Palavra-Passe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= echoActiveClassIfRequestMatches("index") ?>" href="index.php">Sair</a>
            </li>
        </ul>
    </nav>
</body>

</html>