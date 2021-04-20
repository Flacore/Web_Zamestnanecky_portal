<?php
include "../config_DB.php";
$id_uzivatel=$_SESSION['session'];

if(true) {
    $konverzacia=$_POST['conv_id'];
    $text=$_POST['msg_text'];
    $id_sprava=null;

    $sql=mysqli_query($con,"select * from sprava");
    $n = 0;
    while ($rows = $sql->fetch_assoc()){
        $_data[$k]=$rows;
        ++$n;
    }
    $id_sprava=$n+1;

    $sql = "INSERT into sprava (idSprva,text,datum,konverzacia_idKonverzacie,Odosielatel)Values ('$id_sprava','$text',CURRENT_DATE,'$konverzacia','$id_uzivatel')";
    mysqli_query($con, $sql);

    $sql = "UPDATE konverzacia SET precitane='0'  WHERE idKonverzacie='".$konverzacia."'";
    $con->query($sql);
    $con->close();
}
header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>