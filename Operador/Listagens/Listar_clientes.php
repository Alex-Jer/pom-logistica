<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
$navbar = $_SERVER['DOCUMENT_ROOT'];
$navbar .= "/POM-Logistica/Navbar/navbarOperador.php";
include_once($navbar);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ((isset($_POST['registar']))) {
        $nome = $_POST["Nome"];
        $nifNumber = $_POST["nif"];
        $nifNumberr = (int)$nifNumber;
        $Morada = $_POST["morada"];
        $localidade = $_POST["local"];

        $sql = "INSERT INTO cliente (nome, nif, morada, localidade) VALUES ('$nome', $nifNumberr, '$Morada', '$localidade')";
        if (mysqli_query($conn, $sql)) { }
    } elseif (isset($_POST['apagar'])) {
        $sql = "DELETE FROM cliente WHERE id = '" . $_POST['ola'] . "' ";
        if (mysqli_query($conn, $sql)) { }
    } elseif (isset($_POST['save'])) {
        $eNome = $_POST['eNome'];
        $eNif = $_POST['eNif'];
        $eMorada = $_POST['eMorada'];
        $eLocalidade = $_POST['eLocaliadade'];

        $stmt = $conn->prepare("UPDATE cliente SET nome=?, nif=?,morada=?,localidade=? WHERE id = '" . $_POST['editID'] . "'");
        $stmt->bind_param("ssss", $eNome, $eNif, $eMorada, $eLocalidade);
        $stmt->execute();
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="\POM-Logistica\styles\table.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css">

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.56/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.56/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>

    <!-- DataTable -->
    <script>
        $(document).ready(function() {
            var dataTable = $('#myTable').DataTable({
                "language": {
                    url: 'http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json'
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        text: 'Copiar'
                    },
                    'excel', 'pdf',
                    {
                        extend: 'print',
                        text: 'Imprimir'
                    },
                ],
                "paging": true,
                "pageLength": 6,
                "bLengthChange": false,
                "ordering": false,
                "info": false,
                initComplete: function() {
                    $('.buttons-copy').removeClass('dt-button');
                    $('.buttons-copy').addClass('btn');
                    $('.buttons-copy').addClass('btn-outline-warning');

                    $('.buttons-excel').removeClass('dt-button');
                    $('.buttons-excel').addClass('btn');
                    $('.buttons-excel').addClass('btn-outline-warning');

                    $('.buttons-pdf').removeClass('dt-button');
                    $('.buttons-pdf').addClass('btn');
                    $('.buttons-pdf').addClass('btn-outline-warning');

                    $('.buttons-print').removeClass('dt-button');
                    $('.buttons-print').addClass('btn');
                    $('.buttons-print').addClass('btn-outline-warning');
                }
            });
            $("#searchbox").on("keyup search input paste cut", function() {
                dataTable.search(this.value).draw();
            });
        });
    </script>
</head>

<style>
    body {
        background-color: #fcfcfc !important;
    }

    .btn-success {
        background-color: #01d932;
    }

    .btn-success:hover {
        background-color: #01bc2c;
    }

    .table-row {
        cursor: pointer;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 0px solid #dee2e6;
        border-top: 0px solid #dee2e6;
    }

    .table-title {
        margin: -20px -25px 0px !important;
        padding: 32px;
    }

    .dataTables_filter {
        display: none;
    }

    .pagination>li>a,
    .pagination>li>span {
        /* margin-top: 2rem; */
        text-align: center;
        border-style: solid !important;
        border-width: 1px !important;
        border-color: #dfe3e7 !important;
        background-color: #fff !important;
        border-radius: 1px !important;
        margin: 2rem -1px !important;
        font-size: 14.4px !important;
        font-family: "Helvetica Neue", HelveticaNeue, Helvetica, Arial, sans-serif !important;
    }

    .pagination>li.active>a,
    .pagination>li.active>span {
        /* margin-top: 2rem; */
        font-size: 14.4px !important;
        background-color: #007bff !important;
        border-radius: 1px !important;
        margin: 2rem 0 !important;
        font-family: "Helvetica Neue", HelveticaNeue, Helvetica, Arial, sans-serif !important;
    }

    #myTable_previous a {
        /* background-color: black !important; */
        border-style: solid !important;
        border-width: 1px !important;
        border-color: #dfe3e7 !important;
        border-radius: 3px 1px 1px 3px !important;
        color: #007bff !important;
    }

    #myTable_next a {
        /* background-color: black !important; */
        border-style: solid !important;
        border-width: 1px !important;
        border-color: #dfe3e7 !important;
        border-radius: 1px 3px 3px 1px !important;
        color: #007bff !important;
    }

    .dataTables_wrapper .dt-buttons {
        position: absolute;
        margin-top: -7.3rem;
        margin-left: -1.6rem;
        float: none;
        text-align: left;
    }

    .btn-outline-warning {
        border-radius: 1px;
    }

    .buttons-copy {
        border-radius: 3px 1px 1px 3px;
        border-right: none;
    }

    .buttons-excel {
        margin-left: -4px;
        border-left: none;
        border-right: none;
    }

    .buttons-pdf {
        margin-left: -4px;
        border-left: none;
        border-right: none;
    }

    .buttons-print {
        margin-left: -4px;
        border-radius: 1px 3px 3px 1px;
        border-left: none;
    }

    .btn:focus,
    .btn:active {
        outline: none !important;
        box-shadow: none;
    }

    #searchbox {
        height: 1.7rem;
        margin-top: -0.9rem;
    }

    @media only screen and (min-width: 768px) {

        /* Desktop */
        .desktopSearch {
            text-align: left;
            width: 15rem;
            height: 2rem;
            position: relative;
            margin-top: -1rem;
            border-radius: 2px;
            margin-left: auto;
            margin-right: auto;
        }

        .desktopAdd {
            position: relative;
            margin-top: -2rem;
            width: 10rem;
            float: right;
        }

        .desktopAdd:before {
            content: 'Adicionar Cliente';
        }

        .table-title {
            max-height: 2rem !important;
        }
    }

    @media only screen and (max-width: 767px) {
        /* Mobile */

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

        .mobileSearch {
            padding: 2px;
            width: 20%;
            margin-top: -4.9rem;
            position: relative;
            z-index: 900;
            float: right;
        }

        .mobileAdd {
            width: 10%;
            margin-top: -1rem;
            position: relative;
            float: right;
        }

        .mobileAdd:before {
            content: none;
        }
    }

    @media only screen and (max-width: 410px) {
        .mobileSearch {
            padding: 2px;
            width: 75%;
            margin-top: -8.8rem;
            position: relative;
            z-index: 900;
            float: right;
        }
    }
</style>

<body>
    <form style="font-family: 'Varela Round', sans-serif; font-size:13px" action="/POM-Logistica/Admin/Listagens/Listar_clientes.php" method="post" novalidate>
        <div class="container">
            <div class="table-wrapper" style="margin-top:5rem">
                <div class="table-title" style="background-color:#007bff; z-index:0">
                    <h2 style="position:absolute; margin-top:-0.7rem">Gerir <b>Clientes</b></h2>
                    <input type="search" z-index="500" class="form-control mobileSearch desktopSearch" placeholder="Procurar" id="searchbox">
                    <a href="#addEmployeeModal" class="btn btn-success mobileAdd desktopAdd" data-toggle="modal"><i class="material-icons">&#xE147;</i></a>
                </div>
                <div class="mobileTable">
                    <table style="margin-left:auto; margin-right:auto;" class="table table-striped table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th style="text-align:center; width:30%">Nome</th>
                                <th style="text-align:center; width:15%">NIF</th>
                                <th style="text-align:center; width:30%;">Morada</th>
                                <th style="text-align:center;">Localidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dados = mysqli_query($conn, "SELECT * FROM cliente");
                            foreach ($dados as $eachRow) {
                                $buscaId = $eachRow['id'];
                                $nome = $eachRow['nome'];
                                $nif = $eachRow['nif'];
                                $morada = $eachRow['morada'];
                                $localidade = $eachRow['localidade'];
                                echo '<tr>';
                                echo '<td style="text-align:center; width:30%"> ' . $nome . '</td>';
                                echo '<td style="text-align:center; width:15%"> ' . $nif . '</td>';
                                echo '<td style="text-align:center; width:30%"> ' . $morada . '</td>';
                                echo '<td style="text-align:center;"> ' . $localidade . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Registar Cliente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input style="margin-top:1rem; height:auto;" type="input" name="Nome" class="form-control" placeholder="Nome" pattern="[A-Za-z\sâàáêèééìíôòóùúçãõ ]+" title="Apenas deve conter letras." required autofocus>
                            <input style="margin-top:1rem; height:auto;" type="number" id="uintTextBox" name="nif" class="form-control" placeholder="NIF" max="999999999" pattern=".{9,}" minlength=9 maxlength=9 title="O NIF tem de ter 9 dígitos." required autofocus>
                            <input style="margin-top:1rem; height:auto;" type="input" name="morada" class="form-control" placeholder="Morada" pattern="[A-Za-z0-9\sâàáêèééìíôòóùúçãõªº-;,. ]+" required autofocus>
                            <input style="margin-top:1rem; height:auto;" type="input" name="local" class="form-control" placeholder="Localidade" pattern="[A-Za-z0-9\sâàáêèééìíôòóùúçãõªº-;,. ]+" pattern="[A-Za-z]+" required autofocus>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="registar" class="btn btn-primary">Registar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Modal HTML -->
            <div id="editEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Cliente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body" id="OlaEdit">

                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-info" name="save" value="Guardar">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Delete Modal HTML -->
            <div id="deleteEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Apagar Cliente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Tem a certeza que quer apagar estes registos?</p>
                            <p class="text-warning"><small>Esta ação não pode ser desfeita.</small></p>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-danger" name="apagar" value="Apagar">
                        </div>
                    </div>
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
