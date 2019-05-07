<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
include 'navbarLogin.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (mysqli_query($conn, $sql)) {
        ?>
        <script type="text/javascript">
            alert("New record created successfully");
        </script>
    <?php
} else {
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
    <script type="text/javascript" src="jquery.js"></script>
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
        <div class="card card-container" style="text-align:center; width:100%; max-width: 100000px">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="Guia_Rececao.php" method="post">
                <div style="text-align:center">
                    <h1>Guia de Rececao</h1>
                    <br>
                    <div class="container">
                            <select name="guia" id="guia">
                            <option value="" selected disabled >Numero Requesicao</option>
                            <?php
                                        $busca = mysqli_query($conn,"SELECT * FROM guia");
                                        
                                        foreach ($busca as $eachRow)
                                        {
                                            ?>
                                            <option value="<?php echo $eachRow['id'] ?>"><?php echo $eachRow['numero_requisicao'] ?></option>
                                            <?php
                                        }

                                        ?>
                            </select>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Dia e Hora da carga</th>
                                    <th>NºPaletes</th>
                                    <th>Artigo</th>
                                    <th>Armazem</th>
                                </tr>
                            </thead>
                            <tbody id="tabela">
                               
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <!--<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Confirmar</button>-->
                </form><!-- /form -->
            </div><!-- /card-container -->
        </div><!-- /container -->
        <script type="text/javascript"></script>
        <script type="text/javascript"></script>
    </body>

    </html>
    <script>
$("#guia").on("change",function(){
  $.ajax({
			url: 'ajaxRececao.php',
			type: 'POST',
			data:{id:$("#guia").val()},
			success: function(data)
			{ 
				$("#tabela").html(data);
			},
		});
});
</script>