<?php 

$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);

$buscaId = mysqli_query($conn, "SELECT * FROM guia WHERE id='".$_POST['id']."'");
        $dado = mysqli_fetch_array($buscaId);
        $tpID=$dado[ 'tipo_palete_id'];
        $arID=$dado['armazem_id'];
        $cliID=$dado['cliente_id'];
        date_default_timezone_set("Europe/Lisbon");
        $timeRN=date("Y-m-d H:i:s");
        $getCBtz=$dado['tipo_zona_id'];
        $getArtigo=$dado['artigo_id'];
        $qtPal=$dado['numero_paletes'];
        $numeroReq=$dado['numero_requisicao'];
   $sql = "INSERT INTO guia (cliente_id,guia_id, tipo_guia_id, tipo_palete_id, tipo_zona_id,armazem_id,artigo_id,data_prevista,numero_paletes, numero_requisicao) VALUES ($cliID,'".$_POST['id']."',3,$tpID, $getCBtz,$arID,$getArtigo, '$timeRN', $qtPal,'$numeroReq')";
if (mysqli_query($conn, $sql)) {
        
} 

?>