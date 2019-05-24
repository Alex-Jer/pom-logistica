<!DOCTYPE html>
<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'db.php';
include 'Navbar\navbarAdmin.php';
if ($_SESSION["perfilId"] == 2) {

    header("Location: index.php");
    ?>
    <script type="text/javascript">
        alert("Voce nao tem permissoes para acessar a isso");
    </script>
<?php
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="css\bootstrap.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="js\bootstrap.js"></script>
    <link rel="stylesheet" href="css\bootstrap.css">
</head>

<body>
</body>

</html>