<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'db.php';
$pw2 = "";
$Fim = FALSE;
$pw1 = "";
$action ="registar.php";
$Show = FALSE;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $pw = $_POST["MainPw"];
    $pw2 = $_POST["Pw2"];
    $nome= $_POST["Nome"];
    $pfID= '1';/* $_POST["perfilID"];*/
    $arID= '2';/*$_POST["armazID"]*/
    $email= $_POST["Email"];

    if ($pw == $pw2)
    {
      $Fim = true;
    }
    else {
      $Fim = FALSE;
      $Show = TRUE;
    }
    
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
    <title></title>
  </head>
  <body>

    <div class="container">
       <div class="card card-container">
           <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
           <p id="profile-name" class="profile-name-card"></p>

           <form class="form-signin" method="post" action="registar.php">
               <span id="reauth-email" class="reauth-email"></span>
               <input type="input" id="inputNome" name="Nome" class="form-control" placeholder="Nome" required autofocus>
               <br>
               <input type="input" name="Email" id="inputEmail" class="form-control"  pattern="[a-zA-Z0-9]+" placeholder="Email address" required >
               <br>
               <input type="password" id="inputPassword" name="MainPw" class="form-control"    placeholder="Password" required>
               <input type="password" id="input2Password" name="Pw2" class="form-control" placeholder="Confirmar Password" required> 
          <?php

             if($Fim){
               $sql = "INSERT INTO utilizador (perfil_id,armazem_id,nome, email, password ) VALUES ('$pfID','$arID','$nome', '$email', '$pw')";
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
                 header("Location: index.php");
                 exit;

            }
            elseif (!$Fim && $Show) {
              ?>
              <script type="text/javascript">;
              alert("As passwords nao coicidem");
            </script>
            <?php
            }
            ?>
               <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Registar</button>
           </form><!-- /form -->
       </div><!-- /card-container -->
   </div><!-- /container -->
   <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/jquery.collapsible.min.js'></script>
    <script type='text/javascript' src='js/swiper.min.js'></script>
    <script type='text/javascript' src='js/jquery.countdown.min.js'></script>
    <script type='text/javascript' src='js/circle-progress.min.js'></script>
    <script type='text/javascript' src='js/jquery.countTo.min.js'></script>
    <script type='text/javascript' src='js/jquery.barfiller.js'></script>
    <script type='text/javascript' src='js/custom.js'></script>

    <script>
    function filtro(){
      var e=event.keyCode;
	
	if (event.shiftKey == false){
		if (e==8 || e==32 || e==35 || e==36 || e==46 || (e>=48 && e<=57) || (e>=65 && e<=90) || (e>=96 && e<=105)){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}
</script>


  </body>
</html>
