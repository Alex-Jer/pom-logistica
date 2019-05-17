<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarAdmin.php';
include 'db.php';
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

    table,
    tr td {
        /* border: 1px solid red */
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
    <form style="font-family: 'Varela Round', sans-serif; font-size:13px;" action="ListarClientes_admin.php" method="post" novalidate>
        <div class="container">
            <div class="table-wrapper" style="margin-top:5rem;">
                <div class="table-title" style="background-color:#0275d8;">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Gerir <b>Clientes</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar Cliente</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover" style="margin-top:-0.6rem;">
                    <thead>
                        <tr>
                            <th style="width:20%">Nome</th>
                            <th style="width:20%; padding: 0rem 1.1rem">NIF</th>
                            <th style="width:20rem; padding: 0rem 1.1rem">Morada</th>
                            <th style="width:21%">Localidade</th>
                            <th style="width:14%">Ações</th>
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
                            echo '<td style="width:20%"> ' . $nome . '</td>';
                            echo '<td style="width:20%"> ' . $nif . '</td>';
                            echo '<td style="width:20rem;"> ' . $morada . '</td>';
                            echo '<td style="width:20%"> ' . $localidade . '</td>';
                            echo '<td style="width:15%">';
                            ?>
                            <button type="button" style="width:1px; height:1.5rem; color:#ffc107;" value="<?php echo $buscaId ?>" name="teste4" id="teste4" href="#editEmployeeModal" class="btn" data-toggle="modal"><i class="material-icons" style="margin-left:-11px; margin-top:-15px" data-toggle="tooltip" title="Editar">&#xE254;</i></button>
                            <button type="button" style="width:1px; height:1.5rem;" class="btn" value="<?php echo $buscaId ?>" name="teste2" id="teste2" data-toggle="modal" data-target="#deleteEmployeeModal"><i class="material-icons" style="color:#dc3545; margin-left:-11px; margin-top:-15px" data-toggle="tooltip" title="Apagar">&#xE872;</i></button>
                            <input type="hidden" value="<?php echo $buscaId ?>" name="teste">
                            <?php '</td>';
                            echo '</tr>';
                        }
                        ?><div id="Testeeee"></div>
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