<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
<<<<<<< HEAD
include 'operador.php';
if ($_SESSION["user"]==1)
{
    
    header("Location: Login.php");
    ?>
    <script type="text/javascript">
            alert("Voce nao tem permissoes para acessar a isso");
        </script>
        <?php
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
}
=======
//include 'operador.php';
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") { }
>>>>>>> 61999857b0b61dfd2b17cdec280e99798503bf38
?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav role="navigation">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="operador.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="armazem.php">Armazém</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Guia_Operador.php">Guia do Operador</a></li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="showGuiaEntrega.php">Registar Palete</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mudarpass.php">Mudar Palavra-Passe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listagem_pedidos_armazem_operador.php">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Guia_Rececao.php">Imprimir Receção</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="Guia_Devolucao.php">Imprimir Devolução</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pdf.php">PDF</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Sair</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="card card-container" style="text-align:center; width:100%; max-width: 1000px">
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="pdfDevolucao.php" method="post">
                <div style="text-align:center">
                    <h1 style="margin-bottom:2rem;">Guia de devolução</h1>
                    <div class="container">
                        <select style="text-align-last:center; width:21.5rem; margin-bottom:2rem; font-size:15px" class="form-control-lg" name="guia" id="guia">
                            <option value="" selected disabled>Numero de requisição</option>
                            <?php
                            $busca = mysqli_query($conn, "SELECT * FROM guia where tipo_guia_id=2");
                            foreach ($busca as $eachRow) {
                                ?>
                                <option value="<?php echo $eachRow['id'] ?>"><?php echo $eachRow['numero_requisicao'] ?></option>
                            <?php
                        }
                        ?>
                        </select>
                        <div style="text-align:center">
                            <button type="submit" id="pdf" class="btn btn-primary" style="font-size:12px; height:3.15rem; width:4rem; display:none; margin-top:-5.15rem; margin-right:11rem; float:right;">PDF</button>
                        </div>
                        <table class="table" style="font-size:16px;">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Dia e hora da carga</th>
                                    <th>Nº de paletes</th>
                                    <th>Artigo</th>
                                    <th>Armazém</th>
                                </tr>
                            </thead>
                            <tbody id="tabela">
                            </tbody>
                        </table>
                    </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>

</html>
<script>
    $("#guia").on("change", function() {
        $.ajax({
            url: 'ajaxDevolucao.php',
            type: 'POST',
            data: {
                id: $("#guia").val()
            },
            success: function(data) {
                $("#pdf").css({
                    'display': 'block'
                })
                $("#tabela").html(data);
            },
        });
    });
</script>