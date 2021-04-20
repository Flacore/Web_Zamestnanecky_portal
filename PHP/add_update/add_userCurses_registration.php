<?php
include "../config_DB.php";

$id_uzivatel=$_POST['login_id'];
$id_prednaska=$_POST['prednaska_id'];

$sql = mysqli_query($con, "select * from prihlaseny where prednasky_idprednasky='".$id_prednaska."' and os_udaje_rod_cislo='".$id_uzivatel."' ");
$k = 0;
while ($rows = $sql->fetch_assoc()){
    $_data[$k]=$rows;
    ++$k;
}

if($k==0){
    $sql = "INSERT into prihlaseny (os_udaje_rod_cislo,prednasky_idprednasky)Values ('$id_uzivatel','$id_prednaska')";
    mysqli_query($con, $sql);
}

?>