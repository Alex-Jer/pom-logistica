<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");


$busca = mysqli_query($conn, "SELECT * FROM guia WHERE id='".$_POST['id']."'");
$dado = mysqli_fetch_array($busca);
    $numReq = $dado['numero_requisicao'];
    $idPal = $dado['tipo_palete_id'];
    $nome2 = $dado['numero_paletes'];
    $Artigo_id = $dado['artigo_id'];
    $Armazem_id = $dado['armazem_id'];

$busca = mysqli_query($conn, "SELECT nome FROM tipo_palete WHERE id='$idPal'");
$dado = mysqli_fetch_array($busca);
    $tipoPalete=$dado['nome'];


$busca = mysqli_query($conn, "SELECT * FROM artigo WHERE id='$Artigo_id'");
$dado = mysqli_fetch_array($busca);
    $artigo=$dado['nome'];
    $artigoref=$dado['referencia'];


$busca = mysqli_query($conn, "SELECT nome FROM armazem WHERE id='$Armazem_id'");
$dado = mysqli_fetch_array($busca);
    $armazem=$dado['nome'];

        // echo 'Existe  '.$espcZona.' espaços na '.$nomeZona.'';
        // echo '<p>  = "'.$eachRow['id'].'">'.$eachRow['nome'].'</p>';

                echo'<h1>'.$numReq.'</h1>';
                echo '<div>';
                echo "<b> Numero de paletes = </b> $nome2";
                echo '</div>';

                echo '<div>';
                echo "<b> Tipo de Paletes = </b> $tipoPalete";
                echo '</div>';

                echo '<div>';
                echo "<b> Artigo = </b> $artigo ($artigoref)";
                echo '</div>';

                echo '<div>';
                echo "<b> Encontra-se no armazem = </b> $armazem";
                echo '</div>';


?>