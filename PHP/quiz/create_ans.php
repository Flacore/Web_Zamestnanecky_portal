<?php
include "../config_DB.php";
$formId=$_POST['formID'];
$sql = mysqli_query($con, "select * from vyplnenie_formulara");
$n = 0;
while ($rows = $sql->fetch_assoc()) {
    $info = $rows;
    if($n<$info['idVyplnenie_formulara'])
        $n=$info['idVyplnenie_formulara'];
}
$id_vyplnenie = $n + 1;
$sql = "INSERT into vyplnenie_formulara (idVyplnenie_formulara, formular_idformular,vyplnenie) Values ('$id_vyplnenie','$formId',CURRENT_DATE)";
mysqli_query($con, $sql);
echo $id_vyplnenie;
?>