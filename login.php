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
        $em = $_POST["emaill"];
        $_SESSION['emailSession'] = $em;
        $passInput = $_POST["Password"];
        $buscapass = mysqli_query($conn, "SELECT password FROM utilizador WHERE Email='$em'");
        $buscaId = mysqli_query($conn, "SELECT perfil_id FROM utilizador WHERE Email='$em'");
        $dado = mysqli_fetch_array($buscapass);
        $dado2 = mysqli_fetch_array($buscaId);
        $pass = $dado['password'];
        $id = $dado2['perfil_id'];
        if ($passInput == $pass) {
            if ($id == '1') {
                header("Location: navbarLogin.php");
                exit;
            } elseif ($id == '2') {
                header("Location: operador.php");
                exit;
            }
        }
        ?>
        <script type="text/javascript">
            alert("As passwords não coincidem");
        </script>
    <?php
}
?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">
</head>

<body>
<nav role="navigation">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="login.php">Login</a>
            </li>
           
        </ul>
    </nav>
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="login.php" method="post">
                <h1 style="text-align:center">Login</h1>
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" name="emaill" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" name="Password" class="form-control" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form><!-- /form -->
            <a href="#" class="forgot-password">
                Forgot your password?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script type="text/javascript"></script>
    <script type="text/javascript"></script>
</body>

</html>