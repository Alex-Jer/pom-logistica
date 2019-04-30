
<!DOCTYPE html>
<html lang="pt">
<?php 
session_start();
include 'navbarLogin.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nome = $_POST["Nome"];
    $ref = $_POST["ref"];

    $cli_id= $_POST["combobox"];
    $cli_id2= $_POST["combobox2"];

        $sql = "INSERT INTO palete (artigo_id ,tipo_palete_id,referencia,nome) VALUES ('$cli_id','$cli_id2','$ref','$nome')";
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
       
        exit;
}?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>

</head>
<body>
    
    <div class="container">
        <div class=" card card-container">
            <form class="form-signin" action="palete.php" method="post">
                <input type="input" id="inputNome" name="Nome" class="form-control" placeholder="Nome" required autofocus>
                &nbsp;
                <input type="input" id="inputRef" name="ref" class="form-control" placeholder="Referencia" value="PAL-" required >
                &nbsp;
                <select name="combobox">
                            <?php
                              $busca = mysqli_query($conn,"SELECT * FROM artigo");
                              foreach ($busca as $eachRow)
                              {
                                ?>
                                &nbsp;
                                <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                                <?php
                              }

                            ?>
                        </select>
                &nbsp;  
                <select name="combobox2">
                            <?php
                              $busca = mysqli_query($conn,"SELECT * FROM tipo_palete");
                              foreach ($busca as $eachRow)
                              {
                                ?>
                                &nbsp;
                                <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
                                <?php
                              }

                            ?>
                        </select>
                <button type="submit">Registar Palete</button>
           </form><!-- /form -->
        </div>

    </div>
</body>

</html>