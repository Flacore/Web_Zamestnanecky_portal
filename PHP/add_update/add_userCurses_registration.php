<?php
include "../config.php";

$id_login=$_POST['login_id'];
$id_prednaska=$_POST['prednaska_id'];

$sql = mysqli_query($con, "select * from uzivatel join login on login.idLogin=uzivatel.Login_idLogin where login.idLogin='".$id_login."'");
$k = 0;
while ($rows = $sql->fetch_assoc()){
    $_data[$k]=$rows;
    ++$k;
}
$info=$_data[0];
$id_uzivatel=$info['idUzivatel'];

$sql = mysqli_query($con, "select * from prihlaseny where prednasky_idprednasky='".$id_prednaska."' and Uzivatel_idUzivatel='".$id_uzivatel."' ");
$k = 0;
while ($rows = $sql->fetch_assoc()){
    $_data[$k]=$rows;
    ++$k;
}

if($k==0){
    $sql = "INSERT into prihlaseny (Uzivatel_idUzivatel,prednasky_idprednasky)Values ('$id_uzivatel','$id_prednaska')";
    mysqli_query($con, $sql);
}

?>