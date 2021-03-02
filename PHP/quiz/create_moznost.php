<?php
include "../config_DB.php";
if(!isset($_SESSION['session'])){
    header('Location: Main_Site.php');
}
$sql = mysqli_query($con, "select * from moznost");
$n = 0;
while ($rows = $sql->fetch_assoc()) {
    $info = $rows;
    if($n<$info['idMoznost'])
        $n=$info['idMoznost'];
}
$id_moznost = $n + 1;
$text=$_POST['text'];
$id_prvok=$_POST['id_parent'];
$sql = "INSERT into moznost (idMoznost, text, prvok_idprvok) Values ('$id_moznost','$text','$id_prvok')";
mysqli_query($con, $sql);

echo $id_moznost;