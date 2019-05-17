<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
session_start();
include 'navbarAdmin.php';
include 'db.php';
if ($_SESSION["perfilId"] == 2) {

    header("Location: index.php");
    ?>
    <script type="text/javascript">
        alert("Você não tem permissões para essa página.");
    </script>
<?php
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST["cbCliente"];
    $query = mysqli_query($conn, "SELECT nome FROM cliente WHERE id='$cliente'");
    $dado = mysqli_fetch_array($query);
    $clienteNome = $dado['nome'];
}
date_default_timezone_set("Europe/Lisbon");
$timeRN = date("Y-m-d H:i:s");
?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles\table.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<style>
    body {
        overflow: hidden;
    }

    /* width */
    ::-webkit-scrollbar {
        width: 0.3rem;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #007bff;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #0056b3;
    }

    .btn-success {
        background-color: #01d932;
    }

    .btn-success:hover {
        background-color: #01bc2c;
    }

    body {
        color: #566787;
    }

    tbody {
        display: block;
        max-height: 22rem;
        overflow-y: auto;
        overflow-x: hidden;
    }

    thead,
    tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
        /* even columns width , fix width of table too*/
    }

    thead {
        width: calc(100% - 0rem)
            /* scrollbar is average 1em/16px width, remove it from thead width */
    }
</style>

<body>
    <form class="container" action="pdfFatura.php" method="post" style="margin-top:5.8rem; margin-left:50rem; z-index:10000; position:absolute">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            ?>
            <input type="hidden" name="GetCliente" value=<?php echo $cliente ?>>
            <button type="submit" class="btn btn-danger" id="pdf" style="margin-left:26rem;"><i class="fa fa-file-pdf-o"></i> <span>Consultar PDF</span></button>
        <?php
    }
    ?>
    </form>
    <form style="font-family: 'Varela Round', sans-serif; font-size:13px; margin-left:6.5rem; position:absolute; z-index:1;" action="fatura_cliente.php" method="post" novalidate>
        <div class="container">
            <div class="table-wrapper" style="margin-top:5rem; width:80rem;">
                <div class="table-title" style="background-color:#0275d8;">
                    <div class="row">
                        <div class="col-sm-6" style="height:2rem">
                            <h2>Fatura <b>Mensal</b></h2>
                            <select class="custom-select" name="cbCliente" id="cbCliente" style="text-align-last:center; width:15.5rem; margin-left:31rem; margin-top:-2.3rem; position:absolute; z-index:500;" onchange="this.form.submit()">
                                <option value="" disabled selected>Cliente</option>
                                <?php
                                $busca = mysqli_query($conn, "SELECT id,nome FROM cliente");
                                foreach ($busca as $eachRow) {
                                    ?>
                                    <option value=" <?php echo $eachRow['id'] ?>" <?php echo (isset($_POST['cbCliente']) && $_POST['cbCliente'] == $eachRow['id']) ? 'selected="selected"' : ''; ?>><?php echo $eachRow['nome'] ?></option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-sm-6">

                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover" style="margin-top:-0.6rem;">
                    <thead>
                        <tr>
                            <th style="width:15%">Tipo de Guia</th>
                            <th style="width:15%">Nº de requisição</th>
                            <th style="width:10%">Nº Paletes</th>
                            <th style="width:20%">Preço por palete / zona</th>
                            <th style="width:20%">Preço de Carga/Descarga</th>
                            <th style="width:10%">Dias</th>
                            <th style="width:10%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($cliente)) {
                            $query = mysqli_query($conn, "SELECT cliente.id as cliente_id, artigo.id as artigo_id,guia.numero_paletes as numero_paletes, guia.data_prevista as data_prevista, guia.numero_requisicao as numero_requisicao, tipo_guia.nome as tgn ,guia.tipo_guia_id as tpg, zona.id as zona, zona.preco_zona as precozona, armazem.id as armazemid, armazem.custo_carga as acg, armazem.custo_descarga as asd FROM guia INNER JOIN cliente on guia.cliente_id = cliente.id INNER JOIN artigo on guia.artigo_id=artigo.id INNER JOIN armazem on guia.armazem_id=armazem.id INNER JOIN tipo_guia on tipo_guia.id=guia.tipo_guia_id INNER JOIN zona ON (zona.armazem_id=guia.armazem_id and zona.tipo_palete_id=guia.tipo_palete_id ) WHERE guia.cliente_id=$cliente and(tipo_guia_id=4 or tipo_guia_id=3)");
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


                                ?>
                                <tr>
                                    <td style="width:15%;"><?php echo "$NomeGuia" ?> </td>
                                    <td style="width:15%"><?php echo "$numReq" ?> </td>
                                    <td style="width:10%; text-indent:1.5rem"><?php echo $numPaletes ?> </td>
                                    <td style="width:20%; text-indent:3rem"><?php echo $precoZona * $numPaletes * $diasArmazenamento . " €" ?></td>
                                    <td style="width:20%; text-indent:3rem"><?php echo $CargaFinal . " €" ?></td>
                                    <td style="width:10%; text-indent:0.8rem"><?php echo $diasArmazenamento ?></td>
                                    <td style="width:10%; text-indent:0.2rem"><?php echo $Total . " €" ?></td>
                                </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</body>

</html>
<script>
    function validateForm() {
        var x = document.forms["myForm"]["Nome"]["Email"]["MainPw"]["Pw2"]["combobox"]["combobox2"].value;
        if (x == "") {
            alert("Não preencheu todos os campos.");
            return false;
        }
    }

    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
            });
        });
    }

    setInputFilter(document.getElementById("uintTextBox"), function(value) {
        return /^\d*$/.test(value);
    });
</script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<script>
    $('button[name="teste2"]').on("click", function() {
        $.ajax({
            url: 'teste.php',
            type: 'POST',
            data: {
                id: $(this).val()
            },
            success: function(data) {
                $("#Testeeee").html(data);
            },
        });
    });
</script>

<script>
    $('button[name="teste4"]').on("click", function() {
        $.ajax({
            url: 'ajaxEdit.php',
            type: 'POST',
            data: {
                id: $(this).val()
            },
            success: function(data) {
                $("#OlaEdit").html(data);
            },
        });
    });
</script>



<script type="text/javascript">
    $(document).ready(function() {
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Select/Deselect checkboxes
        var checkbox = $('table tbody input[type="checkbox"]');
        $("#selectAll").click(function() {
            if (this.checked) {
                checkbox.each(function() {
                    this.checked = true;
                });
            } else {
                checkbox.each(function() {
                    this.checked = false;
                });
            }
        });
        checkbox.click(function() {
            if (!this.checked) {
                $("#selectAll").prop("checked", false);
            }
        });
    });
</script>