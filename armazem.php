<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarLogin.php';
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $guia = $_POST["combobox"];
    $carga = $_POST["carga"];
    $descarga = $_POST["descarga"];
    $sql = "INSERT INTO armazem (nome, custo_carga, custo_descarga) VALUES ('$guia', '$carga', '$descarga')";
    if (mysqli_query($conn, $sql)) {
?>
    <script type="text/javascript">;
    alert("New record created successfully"); </script>
    <?php
    } else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    //header("Location: navbarLogin.php");
    exit;
} 
    ?>
  <head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="">
    <meta charset="utf-8">
    <link rel="stylesheet" href="node_modules\bootstrap3\dist\css\bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="style.css">

  </head>
  <body>

    <div class="container">
       <div class="card card-container">
           <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->

           <p id="profile-name" class="profile-name-card"></p>
           <form class="form-signin" action="armazem.php" method="post">
               <span id="reauth-email" class="reauth-email"></span>
                    <div style="text-align:center">
                        <p>Tipo de armazém</p>
                        <select name="combobox">
                            <option value="altas">Paletes altas</option>
                            <option value="baixas">Paletes baixas</option>
                            <option value="frio">Frio</option>
                        </select>
                        &nbsp;
                    </div>
                    <div style="text-align:center">
                        &nbsp;
                        <p>Custo de carga</p>
                        <input style="height:25px; width:137px" type="number" name="carga" min="0">
                    </div>
                    <div style="text-align:center">
                        &nbsp;
                        <p>Custo de descarga</p>
                        <input style="height:25px; width:137px" type="number" name="descarga" min="0">
                    </div>
                    &nbsp;
               <button type="submit">Confirmar</button>
           </form><!-- /form -->
       </div><!-- /card-container -->
   </div><!-- /container -->
   <script type="text/javascript"></script>
   <script type="text/javascript"></script>
  </body>
</html>
