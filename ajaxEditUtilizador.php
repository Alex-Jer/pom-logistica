<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

$id = $_POST['id'];

$stmt = $conn->prepare("SELECT nome, email, perfil_id, armazem_id FROM utilizador WHERE id=? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($nome, $email, $perfilid, $armazemid);
$stmt->fetch();

echo '<div class="form-group">';
echo    '<label style="margin-left:1.2rem">Nome</label>';
echo     '<input type="text" class="form-control" style="margin:auto" name="eNome" value="' . $nome . '" required>';
echo     '<input type="hidden" style="margin:auto" value="' . $id . '" name="editID">';
echo   '</div>';
echo '</select>';
echo '</div>';
echo '<div class="form-group">';
echo    '<label style="margin-left:1.2rem">Email</label>';
echo    '<input type="text" class="form-control" style="margin:auto" name="eEmail" value="' . $email . '" required>';
echo '</div>';
echo '<div class="form-group">';
echo    '<label style="margin-left:1.2rem;">Estatuto</label>';
echo     '<select class="form-control" name="ePerfil" id="Perfil" style="margin:auto" required>';
$busca = mysqli_query($conn, "SELECT id,nome FROM perfil where id='$perfilid'");
$perfilid2 = mysqli_fetch_array($busca);
echo '<option value=' . $perfilid2['id'] . '>' . $perfilid2['nome'] . '</option>';
$busca = mysqli_query($conn, "SELECT id,nome FROM perfil WHERE NOT id = $perfilid ");
foreach ($busca as $eachRow) {
        echo '<option value=' . $eachRow['id'] . ' >' . $eachRow['nome'] . '</option>';
}
echo '</select>';
echo '<div class="form-group">';
echo    '<label style="margin-left:1.2rem; margin-top:1rem">Armazém</label>';
echo     '<select class="form-control" name="eArmazem" id="Armazem" style="margin:auto" required>';
$busca = mysqli_query($conn, "SELECT id,nome FROM armazem where id='$armazemid'");
$armazemid2 = mysqli_fetch_array($busca);
echo '<option value=' . $armazemid2['id'] . '>' . $armazemid2['nome'] . '</option>';
$busca = mysqli_query($conn, "SELECT id,nome FROM armazem WHERE NOT id = $armazemid ");
foreach ($busca as $eachRow) {
        echo '<option value=' . $eachRow['id'] . ' >' . $eachRow['nome'] . '</option>';
}
echo '</select>';

//  echo    '<label>Nome</label>';
//  echo     '<input type="text" class="form-control" value="'.$nome.'" required>';
//  echo   '</div>';
