<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarOperador.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["Nome"];
    $nifNumber = $_POST["nif"];
    $nifNumberr = (int)$nifNumber;
    $Morada = $_POST["morada"];
    $localidade = $_POST["local"];

    $stmt = $conn->prepare("INSERT INTO cliente (nome,nif,morada, localidade) VALUES(?,?,?,?)");
    $stmt->bind_param("ssss", $nome,$nifNumberr,$Morada, $localidade);
    $stmt->execute();
}
?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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

    tbody,
    thead tr {
        display: block;
    }

    tbody {
        height: 18rem;
        overflow-y: auto;
        overflow-x: hidden;
    }

    tbody td,
    thead th {
        width: 230px;
    }

    thead th:last-child {
        width: 196px;
        /* 140px + 16px scrollbar width */
    }
</style>

<body>
    <div class="container">
        <div class="card card-container" style="text-align:center; width:100%; max-width: 100000px">
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="ListarClientes_operador.php" method="post">
                <div style="text-align:center">
                    <h1 style="margin-bottom:1rem;">Clientes</h1>
                    <button type="button" class="btn btn-primary" style="margin-bottom:1rem;" data-toggle="modal" data-target="#exampleModal">
                        Registar cliente
                    </button>
                    <form name="myForm" onsubmit="return validateForm()">
                        <div class="container" style="margin-left:auto; margin-right:auto">
                            <div style="text-align:center">
                                <button type="submit" id="pdf" class="btn btn-primary" style="width:3.5rem; height:2.2rem; display:none; margin-top:-3.3rem; margin-right:17rem; text-align:center; float:right;">PDF</button>
                            </div>
                            <div style="margin-left:5rem; margin-right:auto">
                                <table style="margin-top:1rem; margin-left:-25px; text-align:center" class="table">
                                    <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>NIF</th>
                                            <th style="width:25rem;">Morada</th>
                                            <th>Localidade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dado = mysqli_query($conn, "SELECT * FROM cliente");
                                        foreach ($dado as $eachRow) {
                                            $nomeID = $eachRow['id'];
                                            $Nome = $eachRow['nome'];
                                            $nif = $eachRow['nif'];
                                            $Morada = $eachRow['morada'];
                                            $Localidade = $eachRow['localidade'];
                                            echo '<tr>';
                                            echo '<td> ' . $Nome . '</td>';
                                            echo '<td> ' . $nif . '</td>';
                                            echo '<td style="width:25rem;"> ' . $Morada . '</td>';
                                            echo '<td> ' . $Localidade . '</td>';
                                            echo '</tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </form>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registar um cliente</h5>
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
                        <button type="submit" class="btn btn-primary">Registar</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /card-container -->
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