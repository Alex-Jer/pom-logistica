<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
session_start();
include 'db.php';
//include 'navbar.php';
?>

<head>
    <?php
    $em = "";
    $passInput = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $em = $_POST["email"];
        echo $em;
        $_SESSION['emailSession'] = $em;
        $passInput = $_POST["Password"];
        $busca = mysqli_query($conn, "SELECT * FROM utilizador WHERE Email='$em'");
        $dado = mysqli_fetch_array($busca);
        $pass = $dado['password'];
        $id = $dado['perfil_id'];
        $iduser = $dado['id'];
        $_SESSION['user'] = $id;
        $_SESSION['userid'] = $iduser;
        if ($passInput == $pass) {
            if ($id == '1') {
                header("Location: navbarAdmin.php");
                exit;
            } elseif ($id == '2') {
                header("Location: operador.php");
                exit;
            }
        }
        ?>
        <script type="text/javascript">
            alert("Palavra-Passe incorreta.");
        </script>
    <?php
}
?>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles\style4.css">
</head>

<style>
    body {
        overflow: hidden;
    }
</style>

<body>

    <!--<div class="container">
        <div class="card card-container">
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action=index.php method="post">
                <h1 style="text-align:center">Login</h1>
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" name="emaill" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" name="Password" class="form-control" placeholder="Password" required>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" value="remember-me" id="defaultUnchecked">
                    <label class="custom-control-label" for="defaultUnchecked">Remember me</label>
                </div>
                <button style="margin-top:1rem;" class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Log in</button>
            </form>
            <a style="color:#007bff;" href="#" class="forgot-password">
                Esqueceu-se da Palavra-Passe?
            </a>
        </div>
    </div>
    <script type="text/javascript"></script>
    <script type="text/javascript"></script>-->

    <div class="container" style="margin-top:6rem; margin-bottom:auto">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Log In</h5>
                        <form class="form-signin" action="index.php" method="post">
                            <div class="form-label-group">
                                <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="form-label-group">
                                <input name="Password" type="password" id="inputPassword" class="form-control" placeholder="Password" required autofocus>
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