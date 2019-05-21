<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

$sql =  mysqli_query($conn,"SELECT guia.numero_requisicao as guiareq, tipo_palete.nome as tipopalete,artigo.nome as nomeartigo, artigo.referencia as artigo_referencia, guia.numero_paletes as numeropaletes FROM guia INNER JOIN artigo on artigo.id=guia.artigo_id INNER JOIN tipo_palete on tipo_palete.id=guia.tipo_palete_id WHERE guia.id='".$_POST['id']."'");
$dados = mysqli_fetch_array($sql); 
echo '<label style="margin-left:1.2rem;">Referencia da Guia</label>';
echo '<input type="text" name="TableClick" value="'.$dados['guiareq'].'" readonly>';
echo '<br>';

echo '<label style="margin-left:1.2rem;">Nome do Artigo</label>';
echo '<input type="text" name="TableClick" value="'.$dados['nomeartigo'].'" readonly>';
echo '<br>';

echo '<label style="margin-left:1.2rem;">Artigo Referencia</label>';
echo '<input type="text" name="TableClick" value="'.$dados['artigo_referencia'].'" readonly>';
echo '<br>';

echo '<label style="margin-left:1.2rem;">Tipo Palete</label>';
echo '<input type="text" name="TableClick" value="'.$dados['tipopalete'].'" readonly>';
echo '<br>';

echo '<label style="margin-left:1.2rem;">Numero de Paletes</label>';
echo '<input type="text" name="TableClick" value="'.$dados['numeropaletes'].'" readonly>';