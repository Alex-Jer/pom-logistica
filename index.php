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
                    <div class="card-body">
                        <h5 class="card-title text-center">Log In</h5>
                        <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-label-group">
                                <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" pattern="[A-Za-z0-9\s@-. ]+" required autofocus>
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="form-label-group">
                                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required autofocus>
                                <label for="inputPassword">Password</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Remember password</label>
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