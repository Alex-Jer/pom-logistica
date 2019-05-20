<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
session_start();
include 'db.php';
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

        //echo "Email textbox: " . $email;
        //echo " Id: " . $id . " Perfil id: " . $perfilId . " Email: " . $email . " Password: " . $password;

        $_SESSION['emailSession'] = $email;
        $_SESSION['user'] = $id;
        $_SESSION['perfilId'] = $perfilId;
        $_SESSION['nome'] = $nome;

        if ($passInput == $password) {
            if ($perfilId == '1') {
                header("Location: MenuAdmin.php");
                exit;
            } elseif ($perfilId == '2') {
                header("Location: MenuOperador.php");
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
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="js\bootstrap.js"></script>
    <link rel="stylesheet" href="css\bootstrap.css">
    <link rel="stylesheet" href="styles\style4.css">
    <link rel="stylesheet" href="node_modules\font-awesome\css\font-awesome.min.css">
</head>

<style>
    body {
        overflow: hidden;
    }
</style>

<body>

    <div class="container" style="margin-top:6rem; margin-bottom:auto">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="text-center">
                        <img src="images\logogrande.png" style="width:19rem; height:3rem; margin-top:2rem;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center" style="margin-top:-1rem;">Log In</h5>
                        <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-label-group">
                                <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" pattern="[A-Za-z0-9\s@-. ]+" required autofocus>
                            </div>
                            <div class="form-label-group" style="margin-bottom:3rem">
                                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required autofocus>
                                <button type="button" style="font-size:24px; width:24px; height:24px; margin-left:350px; margin-top:-50px;" class="btn-eye" onclick="myFunction()"><i class="fa fa-eye" id="ieye" style="margin-left:-11px; margin-top:-15px" data-toggle="tooltip" title="Mostrar Password"></i></button>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Log in</button>
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