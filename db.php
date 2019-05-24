<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<<<<<<< HEAD
<html lang="en">

<head>

    <title>POM Logistica</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->

    <!-- FontAwesome CSS -->
    <!-- <link rel="stylesheet" href="css/font-awesome.min.css"> -->

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" crossorigin="anonymous"> -->
    <!-- <link href="https://rawgit.com/tempusdominus/bootstrap-4/master/build/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" /> -->
    <link rel="icon" type="image/png" href="images/titlelogo.png  ">
    <link rel="stylesheet" type="text/css" href="styles\style.css">
    <link rel="stylesheet" type="text/css" href="styles\style3.css">
    <link rel="stylesheet" type="text/css" href="css\bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.0/moment-with-locales.js"></script>
    <script src="js\bootstrap.js"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://rawgit.com/tempusdominus/bootstrap-4/master/build/js/tempusdominus-bootstrap-4.min.js"></script> -->
</head>
<style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 1.5rem;
        border-top: 6px solid #0159b7;
        background-color: white;
        color: black;
        text-align: right;
        font-size: 10px
    }
</style>

<body>
    <div class="footer">
        <p style="margin-right:10px; color:black;">Direitos reservados a POM Logistica, LDA 2019</p>
    </div>

    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/jquery.collapsible.min.js'></script>
    <script type='text/javascript' src='js/swiper.min.js'></script>
    <script type='text/javascript' src='js/jquery.countdown.min.js'></script>
    <script type='text/javascript' src='js/circle-progress.min.js'></script>
    <script type='text/javascript' src='js/jquery.countTo.min.js'></script>
    <script type='text/javascript' src='js/jquery.barfiller.js'></script>
    <script type='text/javascript' src='js/custom.js'></script>
</body>


</html>
=======
>>>>>>> 286827c6d49ebce2f719aef8e346553eed8c76f0
