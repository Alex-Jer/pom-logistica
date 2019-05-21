<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
echo '<h5> Artigos </h5>';

$sql =  mysqli_query($conn,"SELECT artigo.referencia as artigoref,artigo.id as artigoid FROM cliente INNER JOIN artigo on artigo.cliente_id=cliente.id WHERE cliente.id='".$_POST['id']."'");
foreach($sql as $eachRow)
{
    
    echo '<details>
<summary>'.$eachRow['artigoref'].'</summary>';
echo' <table  class="table table-striped table-hover">';

echo '<tr>
  <th style="width:20%"><b>REFERENCIA DA PALETE</th>
  <th style="width:20%"><b>LOCALIZACAO DA PALETE</th> 
  <th style="width:30%"><b>DATA DE ENTRADA</th>
</tr>';

    $sql2= mysqli_query($conn,"SELECT palete.id as paleteid,palete.referencia as palref, localizacao.referencia as locref,palete.Data as dataEntrada from palete INNER JOIN localizacao on localizacao.palete_id=palete.id where palete.artigo_id='".$eachRow['artigoid']."'");   
    foreach($sql2 as $eachRow2)
    {
        echo'<tr>';
    echo'<td style="width:20%">'.$eachRow2['palref'].'</td>
    <td style="width:20%">'.$eachRow2['locref'].' </td>
    <td style="width:30%"> '.$eachRow2['dataEntrada'].'</td>';
    echo '</tr>';
    }

    

echo '</table>';
echo'</details>';
//Por cada palete referencia - Localizacao referencia dentro deste foreach e por no P isso! 
}


