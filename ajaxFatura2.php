<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

date_default_timezone_set("Europe/Lisbon");
$timeRN = date("Y-m-d H:i:s");
$timeRN2 = date("Y-m-d");
$FinalDay = date("Y-m-t");
$FirstDay = date("Y-m-01");
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
$dataInicial = $_POST['datai'];
$dataFinal = $_POST['dataf'];
$cliente = $_POST['id'];

echo '<input type="hidden" value="' . $_POST['id'] . '" name="GetCliente">';
echo '<input type="hidden" value="' . $_POST['dataf'] . '" name="GetDataFinal">';
echo '<input type="hidden" value="' . $_POST['datai'] . '" name="GetDataInicial">';
$query = mysqli_query($conn, "SELECT nome FROM cliente WHERE id='$cliente'");
$dado = mysqli_fetch_array($query);
$clienteNome = $dado['nome'];

if ($cliente != NULL) {
    $query = mysqli_query($conn, "SELECT cliente.id as cliente_id, artigo.id as artigo_id,guia.numero_paletes as numero_paletes, guia.data_prevista as data_prevista, guia.numero_requisicao as numero_requisicao, tipo_guia.nome as tgn ,guia.tipo_guia_id as tpg, zona.id as zona, zona.preco_zona as precozona, armazem.id as armazemid, armazem.custo_carga as acg, armazem.custo_descarga as asd FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id INNER JOIN tipo_guia on tipo_guia.id=guia.tipo_guia_id INNER JOIN zona ON (zona.armazem_id=guia.armazem_id and zona.tipo_palete_id=guia.tipo_palete_id ) WHERE guia.cliente_id=$cliente and(tipo_guia_id=4 or tipo_guia_id=3) and date(data_prevista) BETWEEN '$dataInicial' and '$dataFinal'");
    foreach ($query as $eachRow) {
        $CargaFinal = 0;
        $clienteId = $eachRow['cliente_id'];
        $tipoGuia = $eachRow['tpg'];
        $numReq = $eachRow['numero_requisicao'];
        $numPaletes = $eachRow['numero_paletes'];
        $ArtigoIDD = $eachRow['artigo_id'];
        $NomeGuia = $eachRow['tgn'];
        $precoZona = $eachRow['precozona'];
        $custoCarga = $eachRow['acg'];
        $custoDescarga = $eachRow['asd'];

        $result = $conn->query("SELECT count(*) FROM guia WHERE tipo_guia_id=1 AND numero_requisicao='$numReq'");
        $row = $result->fetch_row();
        $count = $row[0];

        $result = $conn->query("SELECT count(*) FROM guia WHERE tipo_guia_id=4 AND cliente_id='$clienteId'");
        $row = $result->fetch_row();
        $count2 = $row[0];

        if ($tipoGuia == 3) {
            $CargaFinal = $custoCarga * $count;
            $tipoLinha = 1;
        } elseif ($tipoGuia == 4) {
            $CargaFinal = $custoDescarga * $count2;
            $tipoLinha = 2;
        }
        $queryPalete = mysqli_query($conn, "SELECT Data_Saida,Data FROM palete WHERE artigo_id='$ArtigoIDD'");
        foreach ($queryPalete as $eachRowPalete) {
            $dataDescarga = $eachRowPalete['Data_Saida'];
            $dataCarga = $eachRowPalete['Data'];

            if ($dataDescarga == 0) {
                $datetime1 = new DateTime($timeRN);
                $datetime3 = $timeRN;
            } else {
                $datetime1 = new DateTime($dataDescarga);
                $datetime3 = $dataDescarga;
            }
            $datetime2 = new DateTime($dataCarga);
            $intervalo = date_diff($datetime1, $datetime2);
            $diasArmazenamento = $intervalo->format('%a');
            if ($diasArmazenamento == 0) {
                $diasArmazenamento = 1;
            }
        }
        $Total = $CargaFinal + ($precoZona * $numPaletes * $diasArmazenamento);

        echo '
        <tr>
        <td style="width:15%; text-align:center">' . $NomeGuia . '</td>
        <td style="width:15%; text-align:center">' . $numReq . '</td>
        <td style="width:10%; text-align:center">' . $numPaletes . '</td>
        <td style="width:20%; text-align:center">' . $precoZona * $numPaletes * $diasArmazenamento . " €" . '</td>
        <td style="width:20%; text-align:center">' . $CargaFinal . "€" . '</td>
        <td style="width:10%; text-align:center">' . $diasArmazenamento . '</td>
        <td style="width:10%; text-align:center">' . $Total . " €" . '</td>
        </tr>';
    }
}
