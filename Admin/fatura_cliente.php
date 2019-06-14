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
    <link rel="stylesheet" href="https://maxcdn.bootcbcstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="\POM-Logistica\styles\table.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<style>
    body {
        overflow: hidden;
        color: #566787;
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

    .table-title .btn {
        margin-left: 0;
    }

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
        height: 1.7rem;
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
        min-width: auto;
        width: 1.9rem;
        text-align-last: center;
        position: absolute;
        z-index: 500;
        border-radius: 1.5px;
        visibility: hidden;
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
            position: relative;
            float: right;
            height: 1.7rem;
        }
    }

    @media only screen and (max-width:1200px) {
        #cbCliente {
            height: 1.7rem;
            margin-top: 1rem;
        }

        #FirstDay {
            margin-top: 1rem;
            font-size: 12px;
            text-indent: 0rem;
            text-align: center;
        }

        #FinalDay {
            margin-top: 1rem;
            font-size: 12px;
            text-indent: 0rem;
            text-align: center;
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
            height: 2rem;
        }
    }

    @media only screen and (max-width:991px) {
        #pdf {
            margin-left: 60%;
        }
    }

    @media only screen and (min-width:991px) and (max-width:1199px) {
        #pdf {
            margin-left: 12rem;
        }
    }
</style>

<body>
    <div class="container">
        <form class="container" action="/POM-Logistica/PDFs/pdfFatura.php" style="font-family: 'Varela Round', sans-serif; font-size:13px; z-index:1;" method="post">
            <div class="table-wrapper" style="margin-top:6rem">
                <div class="table-title" style="background-color:#007bff;">
                    <div class="row">
                        <div class="col">
                            <h2>Fatura <b>Mensal</b></h2>
                        </div>
                        <div class="col" id="divSelect">
                            <select class="form-control" name="cbCliente" id="cbCliente" style="margin-left:auto; margin-right:auto;">
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
                        <div class="col" id="divFirst">
                            <label id="lblFirstDay" style="text-align:center; text-indent:-6px">Data Inicial</label>
                            <input style="margin-left:auto; margin-right:auto; position:relative" class="form-control" id="FirstDay" type="date" value="<?php echo $dataInicial ?>" name="FirstDay">
                        </div>
                        <div class="col" id="divLast">
                            <label id="lblFinalDay" style="text-align:center; text-indent:-12px">Data Final</label>
                            <input style="margin-left:auto; margin-right:auto;" class="form-control" id="FinalDay" type="date" value="<?php echo $dataFinal ?>" name="FinalDay">
                        </div>
                        <button type="submit" class="btn btn-danger btn-sm" id="pdf"><i class="fa fa-file-pdf-o" style="margin-left:3px; font-size:14px; margin-left:auto; margin-right:auto; position:relative; text-align:center"></i> <span></span></button>
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
                    'visibility': 'visible'
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
                    'visibility': 'visible'
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
                    'visibility': 'visible'
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

<script>
    window.onload = function() {
        if ($(window).width() < 991) {
            // alert('Less than 991');
            $('#divSelect').addClass('container');
            $('#divSelect').removeClass('col');
            $('#divFirst').addClass('container');
            $('#divFirst').removeClass('col');
            $('#divLast').addClass('container');
            $('#divLast').removeClass('col');
        } else {
            // alert('More than 991');
            $('#divSelect').addClass('col');
            $('#divSelect').removeClass('container');
            $('#divFirst').addClass('col');
            $('#divFirst').removeClass('container');
            $('#divLast').addClass('col');
            $('#divLast').removeClass('container');
        }
    };
</script>

<script>
    $(window).on('resize', function() {
        if ($(window).width() < 991) {
            // alert('Less than 991');
            $('#divSelect').addClass('container');
            $('#divSelect').removeClass('col');
            $('#divFirst').addClass('container');
            $('#divFirst').removeClass('col');
            $('#divLast').addClass('container');
            $('#divLast').removeClass('col');
        } else {
            // alert('More than 991');
            $('#divSelect').addClass('col');
            $('#divSelect').removeClass('container');
            $('#divFirst').addClass('col');
            $('#divFirst').removeClass('container');
            $('#divLast').addClass('col');
            $('#divLast').removeClass('container');
        }
    })
</script>
