<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
$navbar = $_SERVER['DOCUMENT_ROOT'];
$navbar .= "/POM-Logistica/Navbar/navbarAdmin.php";
include_once($navbar);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["registar"])) {
        $pw = $_POST["MainPw"];
        $pw2 = $_POST["Pw2"];
        $nome = $_POST["Nome"];
        $nome = htmlspecialchars($nome);
        $arID = $_POST["combobox"];
        $pfID = $_POST["combobox2"];
        $email = $_POST["Email"];
        $email = htmlspecialchars($email);
        $hashed_password = password_hash($pw, PASSWORD_DEFAULT);

        if (($pw && $pw2 == "")) {
            if ((($nome && $pfID && $email && $arID) != "")) {
                $stmt = $conn->prepare("INSERT INTO utilizador (perfil_id, armazem_id, nome, email) VALUES(?,?,?,?)");
                $stmt->bind_param("iisss", $pfID, $arID, $nome, $email);
                $stmt->execute();
            } else {
                echo '<script type="text/javascript">alert("Preencha todos os campos!");</script>';
                echo '<script type="text/javascript">location.replace("\POM-Logistica\Admin\Listagens\Listar_utilizadores.php");</script>';
            }
        } else {
            if ($pw == $pw2) {
                if ((($nome && $pw && $pw2 && $pfID && $email && $arID) != "")) {
                    $stmt = $conn->prepare("INSERT INTO utilizador (perfil_id, armazem_id, nome, email, password) VALUES(?,?,?,?,?)");
                    $stmt->bind_param("iisss", $pfID, $arID, $nome, $email, $hashed_password);
                    $stmt->execute();
                } else {
                    echo '<script type="text/javascript">alert("Preencha todos os campos!");</script>';
                    echo '<script type="text/javascript">location.replace("\POM-Logistica\Admin\Listagens\Listar_utilizadores.php");</script>';
                }
            } else {
                ?>
                <script type="text/javascript">
                    alert("As passwords não coincidem");
                </script>
            <?php
        }
    }
} elseif (isset($_POST['apagar'])) {
    $id = $_POST["ola"];
    $stmt = $conn->prepare("DELETE FROM utilizador WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
} elseif (isset($_POST['save'])) {
    $eNome = $_POST['eNome'];
    $eMail = $_POST['eEmail'];
    $ePerfil = $_POST['ePerfil'];
    $eArmazem = $_POST["eArmazem"];

    if ((($eNome && $eArmazem && $eMail && $ePerfil) != "")) {
        $stmt = $conn->prepare("UPDATE utilizador SET nome=?, email=?, perfil_id=?, armazem_id=? WHERE id = '" . $_POST['editID'] . "'");
        $stmt->bind_param("ssii", $eNome, $eMail, $ePerfil, $eArmazem);
        $stmt->execute();
    } else {
        echo '<script type="text/javascript">alert("Preencha todos os campos! ola");</script>';
        echo '<script type="text/javascript">location.replace("\POM-Logistica\Admin\Listagens\Listar_utilizadores.php");</script>';
    }
}
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="\POM-Logistica\styles\table.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<style>
    body {
        color: #566787;
    }

    .btn-success {
        background-color: #01d932;
    }

    .btn-success:hover {
        background-color: #01bc2c;
    }

    .table thead>tr>th {
        border-top: none;
    }

    @media only screen and (min-width: 768px) {

        /* Desktop */

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

        .table thead th {
            vertical-align: bottom;
            border-bottom: 0px solid #dee2e6;
        }

        thead {
            width: calc(100% - 0rem)
                /* scrollbar is average 1em/16px width, remove it from thead width */
        }

        .desktopAdd {
            position: relative;
            margin-top: -2rem;
            float: right;
        }

        .desktopAdd:before {
            content: 'Adicionar Utilizador';
        }

        .desktopBtn {
            position: absolute;
            margin-left: 26.3rem;
        }

        .table-title {
            max-height: 5rem !important;
        }

        .desktopPassword {
            width: 437px;
            margin-top: 1rem;
            margin-left: 0.2rem;
            margin-right: auto;
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

        .mobileAdd {
            width: 10%;
            margin-top: -2rem;
        }

        .mobileAdd:before {
            content: none;
        }

        .mobilePassword {
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        .mobileBtn {
            position: relative;
            float: right
        }

        h2 {
            font-size: 24px !important;
        }

        .table-wrapper {
            margin-top: 1rem !important;
        }
    }
</style>

<body>
    <form style="font-family: 'Varela Round', sans-serif; font-size:13px" action="\POM-Logistica\Admin\Listagens\Listar_utilizadores.php" method="post" novalidate>
        <div class="container">
            <div class="table-wrapper" style="margin-top:5rem">
                <div class="table-title" style="background-color:#007bff; z-index:0">
                    <h2>Gerir <b>Utilizadores</b></h2>
                    <a href="#addEmployeeModal" class="btn btn-success mobileAdd desktopAdd" data-toggle="modal"><i class="material-icons">&#xE147;</i></a>
                </div>
                <div class="mobileTable">
                    <table style="margin-left:auto; margin-right:auto; margin-top:-0.5rem" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width:20%">Nome</th>
                                <th style="width:30%; text-align:center">Email</th>
                                <th style="width:25%; text-align:center">Estatuto</th>
                                <th style="width:25%; text-align:center">Armazém</th>
                                <th style="width:20%; text-align:center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dado = mysqli_query($conn, "SELECT utilizador.id as id, utilizador.nome as nome, utilizador.email as email,utilizador.perfil_id as perfil_id,armazem_id, armazem.nome as armazem_nome, perfil.nome as pnome FROM utilizador INNER JOIN armazem on armazem.id=utilizador.armazem_id INNER JOIN perfil on perfil.id=utilizador.perfil_id ORDER BY id ASC");
                            foreach ($dado as $eachRow) {
                                $buscaId = $eachRow['id'];
                                $nomeID = $eachRow['id'];
                                $Nome = $eachRow['nome'];
                                $email = $eachRow['email'];
                                $ArmazemNome  = $eachRow['armazem_nome'];
                                $PerfilNome  = $eachRow['pnome'];
                                echo '<tr>';
                                echo '<td style="width:20%"> ' . $Nome . '</td>';
                                echo '<td style="width:30%; text-align:center"> ' . $email . '</td>';
                                echo '<td style="width:25%; text-align:center"> ' . $PerfilNome . '</td>';
                                echo '<td style="width:25%; text-align:center"> ' . $ArmazemNome . '</td>';
                                echo '<td style="width:20%; text-align:center">';
                                ?>
                                <button type="button" style="width:1px; height:1.5rem; color:#ffc107;" value="<?php echo $buscaId ?>" name="edit" id="edit" href="#editEmployeeModal" class="btn" data-toggle="modal"><i class="material-icons" style="margin-left:-11px; margin-top:-15px" data-toggle="tooltip" title="Editar">&#xE254;</i></button>
                                <button type="button" style="width:1px; height:1.5rem;" class="btn" value="<?php echo $buscaId ?>" name="delete" id="delete" data-toggle="modal" data-target="#deleteEmployeeModal"><i class="material-icons" style="color:#dc3545; margin-left:-11px; margin-top:-15px" data-toggle="tooltip" title="Apagar">&#xE872;</i></button>
                                <input type="hidden" value="<?php echo $buscaId ?>">
                                <?php '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registar Utilizador</h5>
                        <button type="button" tabindex="-1" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input style="margin-top:1rem; margin-left:auto; margin-right:auto;" tabindex="1" type="input" name="Nome" class="form-control" placeholder="Nome" pattern="[A-Za-z\sâàáêèééìíôòóùúçãõ ]+" title="Apenas deve conter letras." required autofocus>
                        <input style="margin-top:1rem; margin-left:auto; margin-right:auto;" tabindex="2" type="email" name="Email" id="inputEmail" class="form-control" placeholder="Endereço de email" required autofocus>
                        <input style="margin-top:1rem; margin-left:auto; margin-right:auto;" type="password" id="PasswordInput" name="MainPw" tabindex="3" class="form-control" placeholder="Password" required autofocus>
                        <button type="button" style="margin-top:-2rem; font-size:20px; width:15px; height:15px;" class="btn-eye mobileBtn desktopBtn" tabindex="-1" onclick="myFunction2()"><i class="fa fa-eye" id="ieye" style="width:15px; height:15px;" data-toggle="tooltip" title="Mostrar Password"></i></button>
                        <input style="margin-top:1rem; margin-left:auto; margin-right:auto;" type="password" id="input2Password" name="Pw2" tabindex="4" class="form-control" placeholder="Confirmar Password" required autofocus>
                        <button type="button" style="margin-top:-2rem; font-size:20px; width:15px; height:15px;" class="btn-eye mobileBtn desktopBtn" tabindex="-1" onclick="myFunction()"><i class="fa fa-eye" id="ieye2" style="width:15px; height:15px;" data-toggle="tooltip" title="Mostrar Password"></i></button>
                        <select style="text-align-last:center; margin-top:1rem; margin-left:auto; margin-right:auto; color: #6C757D;" tabindex="5" class="form-control" name="combobox" required autofocus>
                            <option value="" disabled selected>Armazém</option>
                            <?php
                            $busca = mysqli_query($conn, "SELECT id,nome FROM armazem");
                            foreach ($busca as $eachRow) {
                                ?>
                                <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                            <?php
                        }
                        ?>
                        </select>
                        <select style="text-align-last:center; margin-top:1rem; margin-left:auto; margin-right:auto; color: #6C757D;" tabindex="6" class="form-control" name="combobox2" required autofocus>
                            <option value="" disabled selected>Estatuto</option>
                            <?php
                            $busca = mysqli_query($conn, "SELECT id,nome FROM perfil");
                            foreach ($busca as $eachRow) {
                                ?>
                                <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                            <?php
                        }
                        ?>
                        </select>
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
                        <h4 class="modal-title">Editar Utilizador</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" id="OlaEdit">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-primary" name="save" value="Guardar">
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Modal HTML -->
        <div id="deleteEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Apagar Utilizador</h4>
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
    function myFunction2() {
        var x = document.getElementById("PasswordInput");
        if (x.type === "password") {
            x.type = "text";
            $("#ieye").removeClass('fa fa-eye-open');
            $("#ieye").addClass('fa fa-eye-slash');
        } else {
            x.type = "password";
            $("#ieye").removeClass('fa fa-eye-slash');
            $("#ieye").addClass('fa fa-eye-open');
        }
    }
</script>
<script>
    function myFunction() {
        var x = document.getElementById("input2Password");
        if (x.type === "password") {
            x.type = "text";
            $("#ieye2").removeClass('fa fa-eye-open');
            $("#ieye2").addClass('fa fa-eye-slash');
        } else {
            x.type = "password";
            $("#ieye2").removeClass('fa fa-eye-slash');
            $("#ieye2").addClass('fa fa-eye-open');
        }
    }
</script>

<script>
    $('button[name="edit"]').on("click", function() {
        $.ajax({
            url: '/POM-Logistica/Ajax/ajaxEditUtilizador.php',
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
