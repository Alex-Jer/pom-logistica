<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
//include 'operador.php';
include 'db.php';
	$pw2 = "";
	$Fim = false;
	$pw1 = "";
	$Show = false;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $pw = $_POST["MainPw"];
	  $pw2 = $_POST["Pw2"];
	  $nome = $_POST["Nome"];
	  $arID = $_POST["combobox"];
	  $pfID = $_POST["combobox2"];
	  $email = $_POST["Email"];

	  if ($pw == $pw2) {
          $sql = "INSERT INTO utilizador (perfil_id,armazem_id,nome, email, password ) VALUES ('$pfID','$arID','$nome', '$email', '$pw')";
          if (mysqli_query($conn, $sql)) {
		  }
	  } else {
          ?>
		<script type="text/javascript">
            alert("As passwords não coincidem");
          </script>
          <?php
	  }
 }
?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body>
    <nav role="navigation">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="operador.php">Home</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="ListarClientes.php">Registar Cliente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  active" href="ListarUtilizadores.php">Registar Utilizador</a></li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mudarpass_admin.php">Mudar Palavra-Passe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listagem_pedidos_armazem_admin.php">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="fatura_cliente.php">Fatura</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Sair</a>
            </li>
        </ul>
    </nav>
    <div class="container">
    
        <div class="card card-container" style="text-align:center; width:100%; max-width: 100000px">
        
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="ListarUtilizadores.php" method="post">
                <div style="text-align:center">
                    <h1 style="margin-bottom:1rem;">Clientes</h1>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Registar Utilizador
</button>
                    <div class="container">
                        <div style="text-align:center">
                            <button type="submit" id="pdf" class="btn btn-primary" style="width:3.5rem; height:2.2rem; display:none; margin-top:-3.3rem; margin-right:17rem; text-align:center; float:right;">PDF</button>
                        </div>
                        <table class="table" style="font-size:16px;">
                            <thead>
                                <tr>
                                    <th style="width:15%">Nome</th>
                                    <th style="width:40%">Email</th>
                                    <th style="width:30%">Estatuto</th>
                                    <th style="width:30%">Armazem</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $dado = mysqli_query($conn, "SELECT * FROM utilizador");
                            foreach ($dado as $eachRow) {

                                $nomeID=$eachRow['id'];
                                $Nome=$eachRow['nome'];
                                $email = $eachRow['email'];
                                $EstatutoID = $eachRow['perfil_id'];
                                $ArmazemID = $eachRow['armazem_id'];
								
								$query = mysqli_query($conn, "SELECT * FROM armazem WHERE id=$ArmazemID");
								$getQuery = mysqli_fetch_array($query);
								$ArmazemNome  = $getQuery['nome'];
								
								$query2 = mysqli_query($conn, "SELECT * FROM perfil WHERE id=$EstatutoID");
								$getQuery2 = mysqli_fetch_array($query2);
								$PerfilNome  = $getQuery2['nome'];
								
								
                                //Inacabado
                                echo '<tr>';
                                    echo '<td> '.$Nome.'</td>';
                                        echo '<td> '.$email.'</td>';
                                        echo '<td> '.$PerfilNome.'</td>';
                                        echo '<td> '.$ArmazemNome.'</td>';
                                echo '</tr>';
                                }
                                ?>
                               
                            </tbody>
                            
                        </table>
                        
      
                        </div>
                      </div>
                    </div>
                <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registar um cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                <div class="modal-body">
                            <input style="margin-top:1rem; height:auto;" type="input" name="Nome" class="form-control" placeholder="Nome" pattern="[A-Za-z\sâàáêèééìíôòóùúçãõ ]+" title="Apenas deve conter letras." required autofocus>
        <input style="margin-top:1rem; height:auto;" type="email" name="Email" id="inputEmail" class="form-control" placeholder="Endereço de email" required autofocus>
        <input style="margin-top:1rem; height:auto;" type="password" id="inputPassword" name="MainPw" class="form-control" placeholder="Password" required autofocus>
        <input style="margin-top:1rem; height:auto;" type="password" id="input2Password" name="Pw2" class="form-control" placeholder="Confirmar Password" required autofocus>
        <select style="text-align-last:center; margin-top:1rem; color: #6C757D; height:auto; font-size:14px" class="form-control" name="combobox">
          <option value="" disabled selected>Armazém</option>
          <?php
          $busca = mysqli_query($conn, "SELECT * FROM armazem");
          foreach ($busca as $eachRow) {
            ?>
            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
          <?php
        }
        ?>
        </select>
        <select style="text-align-last:center; margin-top:1rem; color: #6C757D; height:auto; font-size:14px" class="form-control" name="combobox2">
          <option value="" disabled selected>Estatuto</option>
          <?php
          $busca = mysqli_query($conn, "SELECT * FROM perfil");
          foreach ($busca as $eachRow) {
            ?>
            <option value=" <?php echo $eachRow['id'] ?>"><?php echo $eachRow['nome'] ?></option>
          <?php
        }
        ?>
        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
       </div>
      </div>
</div>
            </form><!-- /form -->
        </div><!-- /card-container -->
        
    </div><!-- /container -->
    
</body>

</html>
<script>
        function setInputFilter(textbox, inputFilter) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
                textbox.addEventListener(event, function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    }
                });
            });
        }
        setInputFilter(document.getElementById("uintTextBox"), function(value) {
            return /^\d*$/.test(value);
        });
    </script>