<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
if ($_POST['id'] == 1) {
    $dado = mysqli_query($conn, "SELECT guia.id,guia.artigo_id,guia.cliente_id,guia.numero_paletes, guia.data_prevista, guia.numero_requisicao,guia.armazem_id, guia.confirmar, guia.confirmarTotal, cliente.nome as clientenome ,armazem.nome as armazemnome,artigo.referencia as artigoreef FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id WHERE tipo_guia_id=1 AND confirmar IS NULL AND confirmarTotal IS NULL ");
} elseif ($_POST['id'] == 2) {
    $dado = mysqli_query($conn, "SELECT guia.id,guia.artigo_id,guia.cliente_id,guia.numero_paletes, guia.data_prevista, guia.numero_requisicao,guia.armazem_id, guia.confirmar, guia.confirmarTotal, cliente.nome as clientenome ,armazem.nome as armazemnome,artigo.referencia as artigoreef FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id WHERE tipo_guia_id=3 AND (confirmar IS not NULL and confirmarTotal IS NULL)");
}

foreach ($dado as $eachRow) {
    $cliID = $eachRow['cliente_id'];
    $GuiaID = $eachRow['id'];
    $getArtigo = $eachRow['artigo_id'];
    $qtPal = $eachRow['numero_paletes'];
    $numeroReq = $eachRow['numero_requisicao'];
    $arID = $eachRow['armazem_id'];
    $confirm = $eachRow['confirmar'];
    $confirmTotal = $eachRow['confirmarTotal'];
    $nomeArmazem = $eachRow['armazemnome'];
    $nomeCliente = $eachRow['clientenome'];
    $refArtigo = $eachRow['artigoreef'];
    $time = $eachRow['data_prevista'];

    echo '<tr class="table-row" data-value="' . $GuiaID . '">';
    echo '<td style="width:20%" data-toggle="modal" data-target="#exampleModal2"> ' . $nomeCliente . '</td>';
    echo '<td style="width:20%" data-toggle="modal" data-target="#exampleModal2"> ' . $numeroReq . '</td>';
    echo '<td style="width:20%" data-toggle="modal" data-target="#exampleModal2"> ' . $time . '</td>';
    echo '<td style="width:15%" data-toggle="modal" data-target="#exampleModal2"> ' . $qtPal . '</td>';
    echo '<td style="width:20%" data-toggle="modal" data-target="#exampleModal2"> ' . $refArtigo . '</td>';
    echo '<td style="width:20%" data-toggle="modal" data-target="#exampleModal2"> ' . $nomeArmazem . '</td>';

    if ($confirm == NULL) {
        echo '<td style="width:15%"><button type="submit" style="width:1px; height:1.5rem;" class="btn" name="Confirm" id="Confirm"  value="' . $GuiaID . '"><i class="material-icons" style="color:#ffc107; margin-left:-11px; margin-top:-15px; font-size:22px">check_circle</i></button></td>';
        echo '<td style="width:15%"></td>';
    } else {
        echo '<td style="width:15%"><button type="submit" style="width:1px; height:1.5rem;" class="btn" name="confirmTotal" id="confirmTotal" value="' . $GuiaID . '"><i class="material-icons" style="color:#ffc107; margin-left:-11px; margin-top:-15px; font-size:22px">check_circle</i></button></td>';
        echo '<td style="width:15%;" id="registarD"><button type="button" style="width:1px; height:1.5rem;" class="btn" name="Guia_ID4" id="Guia_ID4" data-toggle="modal" data-target="#exampleModal" value="' . $GuiaID . '"><i class="material-icons" style="color:#01d932; margin-left:-11px; margin-top:-15px; font-size:22px">add_circle</i></button></td>';
    }
    echo '</tr>';
}
?>

<script>
    $('button[name="Guia_ID4"]').on("click", function() {
        $.ajax({
            url: '/POM-Logistica/Ajax/ajaxPaletes.php',
            type: 'POST',
            data: {
                id: $(this).val()
            },
            success: function(data) {
                $("#DivEntrega2").html(data);
            },
        });
    });

    $(".table-row").click(function() {
        $.ajax({
            url: '/POM-Logistica/Ajax/ajaxTesteasd2.php',
            type: 'POST',
            data: {
                id: $(this).data('value')
            },
            success: function(data) {
                $("#TableDetails").html(data);
            },
        });
    });

    $("#Confirmed").on("click", function() {
        // alert("transporte ");
        document.getElementById("registarH").style.visibility = "visible";
        document.getElementById("registarD").style.visibility = "visible";
    });

    $("#notConfirmed").on("click", function() {
        // alert("entrega ");
        document.getElementById("registarH").style.visibility = "collapse";
        document.getElementById("registarD").style.visibility = "collapse";
    });
</script>