<?php
session_start(); 

include 'operador.php';
include 'db.php';
$getIdGuia = $_POST['comboboxGuiaEntrega'];
echo($getIdGuia);


echo $getIdGuia;
    $busca = mysqli_query($conn, "SELECT * FROM guia WHERE id='$getIdGuia'");
    $dado = mysqli_fetch_array($busca);
        $numReq = $dado['numero_requisicao'];
        $idPal = $dado['tipo_palete_id'];
        $nome2 = $dado['numero_paletes'];
        $Artigo_id = $dado['artigo_id'];
        $Armazem_id = $dado['armazem_id'];
    
    $busca = mysqli_query($conn, "SELECT nome FROM tipo_palete WHERE id='$idPal'");
    $dado = mysqli_fetch_array($busca);
        $tipoPalete=$dado['nome'];


    $busca = mysqli_query($conn, "SELECT nome FROM artigo WHERE id='$Artigo_id'");
    $dado = mysqli_fetch_array($busca);
        $artigo=$dado['nome'];


    $busca = mysqli_query($conn, "SELECT nome FROM armazem WHERE id='$Armazem_id'");
    $dado = mysqli_fetch_array($busca);
        $armazem=$dado['nome'];

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class= "containder ">
        <div class= "card card-container w-auto p-3 ">
            <form class="form-signin" action="MostrarGuia.php" method="post">
            <h1><?php echo $numReq?></h1>
            <div>
                <?php
                echo "Numero de paletes = $nome2";
                ?>
             </div>
             <div>
                <?php
                echo "Tipo de Paletes = $tipoPalete";
                ?>
            </div>
            <div>
                <?php
                echo "Artigo = $artigo";
                ?>
            </div>
            <div>
                <?php
                echo "Encontra-se no armazem = $armazem";
                ?>
            </div>
            </form>
        </div>
    </div>
</body>
</html>