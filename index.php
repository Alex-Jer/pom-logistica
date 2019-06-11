<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
session_start();
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
?>

<head>
    <?php
    $em = "";
    $passInput = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $passInput = $_POST['password'];

        $stmt = $conn->prepare("SELECT id, perfil_id, password, nome FROM utilizador WHERE Email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $perfilId, $password, $nome);
        $stmt->fetch();

        $_SESSION['emailSession'] = $email;
        $_SESSION['user'] = $id;
        $_SESSION['perfilId'] = $perfilId;
        $_SESSION['nome'] = $nome;

        if (password_verify($passInput, $password)) {
            if ($perfilId == '1') {
                header("Location: /POM-Logistica/Admin/Menu.php");
                exit;
            } elseif ($perfilId == '2') {
                header("Location: /POM-Logistica/Operador/Menu.php");
                exit;
            }
        } else {
            ?>
            <script type="text/javascript">
                alert("Password incorreta.");
            </script>
        <?php
    }
    $stmt->close();
    ?>
    <?php
}
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <title>POM-Logística</title>
    <link rel="icon" type="image/png" href="\POM-Logistica\images/titlelogo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</head>

<style>
    :root {
        --input-padding-x: 1.5rem;
        --input-padding-y: .75rem;
    }

    body {
        overflow: hidden;
        background: #007bff;
        background: linear-gradient(to right, #0062E6, #33AEFF);
    }

    .card-signin {
        border: 0;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
    }

    .card-signin .card-title {
        margin-bottom: 2rem;
        font-weight: 300;
        font-size: 1.5rem;
    }

    .card-signin .card-body {
        padding: 2rem;
    }

    .form-signin {
        width: 100%;
    }

    .form-signin .btn {
        font-size: 80%;
        border-radius: 5rem;
        letter-spacing: .1rem;
        font-weight: bold;
        padding: 1rem;
        transition: all 0.2s;
    }

    .form-label-group {
        position: relative;
        margin-bottom: 1rem;
    }

    .form-label-group input {
        height: auto;
        border-radius: 2rem;
    }

    .form-label-group>input,
    .form-label-group>label {
        padding: var(--input-padding-y) var(--input-padding-x);
    }

    .form-label-group>label {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        margin-bottom: 0;
        line-height: 1.5;
        color: #495057;
        border: 1px solid transparent;
        border-radius: .25rem;
        transition: all .1s ease-in-out;
    }

    .form-label-group input::-webkit-input-placeholder {
        color: transparent;
    }

    .form-label-group input:-ms-input-placeholder {
        color: transparent;
    }

    .form-label-group input::-ms-input-placeholder {
        color: transparent;
    }

    .form-label-group input::-moz-placeholder {
        color: transparent;
    }

    .form-label-group input::placeholder {
        color: transparent;
    }

    .form-label-group input:not(:placeholder-shown) {
        padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
        padding-bottom: calc(var(--input-padding-y) / 3);
    }

    .form-label-group input:not(:placeholder-shown)~label {
        padding-top: calc(var(--input-padding-y) / 3);
        padding-bottom: calc(var(--input-padding-y) / 3);
        font-size: 12px;
        color: #777;
    }

    .btn:focus,
    .btn:active {
        outline: none !important;
        box-shadow: none;
    }

    #image {
        width: 19rem;
        height: 3rem;
        margin-top: 2rem;
    }

    #btnEye {
        font-size: 20px;
        width: 24px;
        height: 24px;
        /* margin-left: 21.2rem; */
        float: right;
        margin-top: -3.5rem;
        z-index: 500;
        position: relative;
    }

    @media only screen and (max-width: 767px) {

        /* Mobile */
        #image {
            width: 14rem;
            height: 2.5rem;
        }

        #btnEye {
            margin-left: 0;
            position: relative;
            float: right;
        }
    }
</style>

<body>
    <div class="container" style="margin-top:4rem;">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="text-center" style="margin-top:1rem;">
                        <img src="images\logogrande.png" id="image">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Iniciar Sessão</h5>
                        <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-label-group">
                                <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" pattern="[A-Za-z0-9\s@-. ]+" required autofocus>
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="form-label-group">
                                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" style="z-index:1;" required autofocus>
                                <label for="inputPassword">Password</label>
                                <button type="button" id="btnEye" class="btn btn-eye" onclick="myFunction()"><i class="fa fa-eye" id="ieye" style="margin-left:-15px" data-toggle="tooltip" title="Mostrar Password"></i></button>
                            </div>
                            <button style="margin-top:3rem; margin-bottom:1rem;" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Iniciar Sessão</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    function myFunction() {
        var x = document.getElementById("inputPassword");
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
