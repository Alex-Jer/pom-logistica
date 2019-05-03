<?php
session_start(); 
include 'operador.php';
include 'db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class= "containder">
        <div class= "card card-container">
            <form class="form-signin" action="MostrarGuia.php" method="post">
                <select name="comboboxGuiaEntrega" onchange="this.form.submit();">
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
            </form>
        </div>
    </div>
</body>
</html>