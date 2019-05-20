<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

$dado = mysqli_query($conn, "SELECT guia.id as idg,guia.artigo_id,guia.cliente_id,guia.numero_paletes, guia.data_prevista, guia.numero_requisicao,guia.armazem_id, guia.confirmar, guia.confirmarTotal, cliente.nome as clientenome ,armazem.nome as armazemnome,artigo.referencia as artigoreef FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id WHERE tipo_guia_id=2 AND confirmar IS NULL AND confirmarTotal IS NULL ");
foreach ($dado as $eachRow) {
    $GuiaID = $eachRow['idg'];
    $qtPal = $eachRow['numero_paletes'];
    $numeroReq = $eachRow['numero_requisicao'];
    $nomeArmazem = $eachRow['armazemnome'];
    $nomeCliente = $eachRow['clientenome'];
    $refArtigo = $eachRow['artigoreef'];
    $time = $eachRow['data_prevista'];
    //Inacabado
    echo '<tr>';
    echo '<td> ' . $nomeCliente . '</td>';
    echo '<td> ' . $numeroReq . '</td>';
    echo '<td> ' . $time . '</td>';
    echo '<td> ' . $qtPal . '</td>';
    echo '<td> ' . $refArtigo . '</td>';
    echo '<td> ' . $nomeArmazem . '</td>';
    echo '<td><button type="submit"  class="btn" style="margin-top:-0.2rem; height:2rem; padding: 0 0.3rem; border-radius:0.3rem;" name="Confirm3" id="Confirm3"  value="' . $GuiaID . '"><i class="material-icons" style="color:#ffc107; margin-left:-11px; margin-top:-15px; font-size:22px">check_circle</i></button></td>';
    echo '</tr>';
}
