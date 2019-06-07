<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
session_start();
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
$navbar = $_SERVER['DOCUMENT_ROOT'];
$navbar .= "/POM-Logistica/Navbar/navbarAdmin.php";
include_once($navbar);
date_default_timezone_set("Europe/Lisbon");
$timeRN = date("Y-m-d H:i:s");
$timeRN2 = date("Y-m-d");
$FinalDay = date("Y-m-t");
$FirstDay = date("Y-m-01");
if ($_SESSION["perfilId"] == 2) {
    header("Location: /POM-Logistica/index.php");
    ?>
    <script type="text/javascript">
        alert("Você não tem permissões para acessar essa página.");
    </script>
<?php
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST["cbCliente"];
    $query = mysqli_query($conn, "SELECT nome FROM cliente WHERE id='$cliente'");
    $dado = mysqli_fetch_array($query);
    $clienteNome = $dado['nome'];
    $dataInicial = $_POST['FirstDay'];
    $dataFinal = $_POST['FinalDay'];
} else {
    $dataFinal = $FinalDay;
    $dataInicial = $FirstDay;
}
?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="\POM-Logistica\styles\table.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<style>
    body {
        overflow: hidden;
    }

    /* width */
    ::-webkit-scrollbar {
        width: 0.2rem;
        height: 0.2rem;
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
        max-height: 22rem;
        overflow-y: auto;
        overflow-x: hidden;
    }

    thead,
    tbody tr {
        width: 100%;
        table-layout: fixed;
        /* even columns width , fix width of table too*/
    }

    thead {
        width: calc(100% - 0rem);
        /* scrollbar is average 1em/16px width, remove it from thead width */
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 0px solid #dee2e6;
    }

    input[type=date]::-webkit-inner-spin-button,
    input[type=date]::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }

    /* @media only screen and (min-width: 768px) {

        Desktop
        thead,
        tbody tr {
            display: table;
        }

        tbody {
            display: block;
        }

        #cbCliente {
            text-align-last: center;
            width: 13rem;
            height: 2rem;
            font-size: 15px;
            margin-left: 13rem;
            margin-top: -2.1rem;
            position: absolute;
            z-index: 500;
            border-radius: 1.5px;
        }

        #lblFinalDay {
            position: absolute;
            margin-top: -3rem;
            margin-left: 29rem;
            display: inline-block;
            width: 5rem;
            font-size: 11px;
        }

        #lblFirstDay {
            position: absolute;
            margin-top: -3rem;
            margin-left: 45rem;
            display: inline-block;
            width: 5rem;
            font-size: 11px;
        }
    }

    @media only screen and (max-width: 767px) {
         Mobile

        input[type="search"]::-webkit-search-decoration,
        input[type="search"]::-webkit-search-cancel-button,
        input[type="search"]::-webkit-search-results-button,
        input[type="search"]::-webkit-search-results-decoration {
            display: none;
        }

        body {
            overflow-x: hidden;
        }

        .mobileTable {
            overflow-x: auto;
        }

        #cbCliente {
            margin-top: -6rem !important;
            margin-left: -1.8rem !important;
            width: 30% !important;
            padding: 1px 1px !important;
            font-size: 10px !important;
        }

        #FirstDay {
            margin-left: 6.3rem !important;
            width: 50% !important;
            font-size: 10px !important;
            padding: 1px 1px;
            text-indent: 0 !important;
        }

        #FinalDay {
            margin-left: 14.6rem !important;
            width: 50% !important;
            font-size: 10px !important;
            padding: 1px 1px;
            text-indent: 0 !important;
        }

        #pdf {
            position: relative !important;
            float: right;
            margin-left: auto !important;
        }

        #lblFirstDay {
            color: #007bff;
            margin-top: -3rem !important;
            margin-left: 6.3rem !important;
        }

        #lblFinalDay {
            color: #007bff;
            margin-top: -3rem !important;
            margin-left: 14.6rem !important;
        }
    }

    @media only screen and (max-width: 376px) {
        #cbCliente {
            font-size: 10px !important;
        }

        #FirstDay {
            margin-left: 5.2rem !important;
        }

        #FinalDay {
            margin-left: 12.4rem !important;
        }

        #lblFirstDay {
            margin-left: 5.2rem !important;
        }

        #lblFinalDay {
            margin-left: 12.4rem !important;
        }
    }

    @media only screen and (max-width: 1025px) {
        #cbCliente {
            width: 30% !important;
            font-size: 12px !important;
        }

        #FirstDay {
            width: 30% !important;
            font-size: 12px !important;
            text-indent: 0px !important;
        }

        #FinalDay {
            width: 30% !important;
            font-size: 12px !important;
            text-indent: 0px !important;
        }
    }

    @media only screen and (min-width:768px) and (max-width: 992px) {
        #cbCliente {
            position: relative !important;
            margin-top: -6rem !important;
            margin-left: -1.8rem !important;
            width: 50% !important;
        }

        #FirstDay {
            margin-left: 20rem !important;
        }

        #FinalDay {
            margin-left: 33.5rem !important;
        }
    } */

    .mobileTable {
        overflow-x: auto;
    }

    #cbCliente {
        text-align-last: center;
        padding: 1px 1px;
        font-size: 15px;
        z-index: 500;
        border-radius: 1.5px;
    }

    #FirstDay {
        text-align-last: center;
        padding: 1px 1px;
        text-indent: 1.3rem;
        height: 1.7rem;
        font-size: 15px;
        z-index: 500;
        border-radius: 1.5px;
    }

    #FinalDay {
        text-align-last: center;
        padding: 1px 1px;
        text-indent: 1.3rem;
        font-size: 15px;
        z-index: 500;
        border-radius: 1.5px;
    }

    #lblFinalDay {
        position: absolute;
        margin-top: -1rem;
        display: inline-block;
        font-size: 11px;
    }

    #lblFirstDay {
        position: absolute;
        margin-top: -1rem;
        display: inline-block;
        font-size: 11px;
    }

    #pdf {
        text-align-last: center;
        font-size: 15px;
        position: absolute;
        z-index: 500;
        border-radius: 1.5px;
        display: none;
    }

    @media only screen and (min-width:1200px) {
        #cbCliente {
            width: 13rem;
            height: 1.7rem;
        }

        #FirstDay {
            width: 13rem;
        }

        #FinalDay {
            width: 13rem;
            height: 1.7rem;
        }

        #lblFinalDay {
            width: 5rem;
        }

        #lblFirstDay {
            width: 5rem;
        }

        #pdf {
            width: 1rem;
            height: 2em;
            margin-left: 60.5rem;
            margin-top: -2.1rem;
        }
    }

    @media only screen and (max-width:1200px) {
        #cbCliente {
            width: 13rem;
            height: 1.7rem;
            margin-top: 1rem;
        }

        #FirstDay {
            width: 13rem;
            margin-top: 1rem;
        }

        #FinalDay {
            width: 13rem;
            height: 1.7rem;
            margin-top: 1rem;
        }

        #lblFinalDay {
            width: 5rem;
            margin-top: 0;
        }

        #lblFirstDay {
            width: 5rem;
            margin-top: 0;
        }

        #pdf {
            width: 1rem;
            height: 2em;
            margin-left: 60.5rem;
            margin-top: -2.1rem;
        }
    }
</style>

<body>
    <div class="container">
        <form class="container" action="/POM-Logistica/PDFs/pdfFatura.php" style="font-family: 'Varela Round', sans-serif; font-size:13px; z-index:1;" method="post">
            <!-- <div class="table-wrapper" style="margin-top:5rem; width:80rem;"> -->
            <div class="table-wrapper" style="margin-top:6rem">
                <div class="table-title" style="background-color:#007bff;">
                    <div class="row" style="">
                        <div class="col">
                            <h2>Fatura <b>Mensal</b></h2>
                        </div>
                        <div class="col">
                            <select class="form-control" name="cbCliente" id="cbCliente">
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
                        <div class="col">
                            <label id="lblFirstDay">Data Inicial</label>
                            <input class="form-control" id="FirstDay" type="date" value="<?php echo $dataInicial ?>" name="FirstDay">
                        </div>
                        <div class="col">
                            <label id="lblFinalDay">Data Final</label>
                            <input class="form-control" id="FinalDay" type="date" value="<?php echo $dataFinal ?>" name="FinalDay">
                        </div>
                        <button type="submit" class="btn btn-danger" id="pdf"><i class="fa fa-file-pdf-o" style="margin-left:3px"></i> <span></span></button>
                    </div>
                </div>
                <div class="mobileTable">
                    <table class="table table-striped table-hover" style="margin-top:-0.6rem;">
                        <thead>
                            <tr>
                                <th style="width:15%; text-align:center">Tipo de Guia</th>
                                <th style="width:15%; text-align:center">Nº de requisição</th>
                                <th style="width:10%; text-align:center">Nº Paletes</th>
                                <th style="width:20%; text-align:center">Preço por palete / zona</th>
                                <th style="width:20%; text-align:center">Preço de Carga/Descarga</th>
                                <th style="width:10%; text-align:center">Dias</th>
                                <th style="width:10%; text-align:center">Total</th>
                            </tr>
                        </thead>
                        <tbody id="Fatura"></tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
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
            url: '/POM-Logistica/Ajax/teste.php',
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
            url: '/POM-Logistica/Ajax/ajaxEdit.php',
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

<script>
    $("#cbCliente").on("change", function() {
        $.ajax({
            url: '/POM-Logistica/Ajax/ajaxFatura2.php',
            type: 'POST',
            data: {
                id: $(this).val(),
                datai: $("#FirstDay").val(),
                dataf: $("#FinalDay").val()
            },
            success: function(data) {
                $("#Fatura").html(data);
                $("#pdf").css({
                    'display': 'block'
                });
            },
        });
    });
</script>

<script>
    $("#FirstDay").on("change", function() {
        $.ajax({
            url: '/POM-Logistica/Ajax/ajaxFatura2.php',
            type: 'POST',
            data: {
                id: $("#cbCliente").val(),
                datai: $("#FirstDay").val(),
                dataf: $("#FinalDay").val()
            },
            success: function(data) {
                $("#Fatura").html(data);
                $("#pdf").css({
                    'display': 'block'
                });
            },
        });
    });
</script>

<script>
    $("#FinalDay").on("change", function() {
        $.ajax({
            url: '/POM-Logistica/Ajax/ajaxFatura2.php',
            type: 'POST',
            data: {
                id: $("#cbCliente").val(),
                datai: $("#FirstDay").val(),
                dataf: $("#FinalDay").val()
            },
            success: function(data) {
                $("#Fatura").html(data);
                $("#pdf").css({
                    'display': 'block'
                });
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
