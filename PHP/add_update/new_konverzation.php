<?php
include "../config_DB.php";
$id_Login=$_SESSION['session'];

$id_uzivatel=null;
$id_konverzacie=null;
$id_prijmatel=$_POST['user_id'];

$sql = mysqli_query($con, "select * from uzivatel join login on login.idLogin=uzivatel.Login_idLogin where login.idLogin='".$id_Login."'");
$k = 0;
while ($rows = $sql->fetch_assoc()){
    $_data[$k]=$rows;
    ++$k;
}
$info=$_data[0];
$id_uzivatel=$info['idUzivatel'];

$sql = mysqli_query($con, "select * from konverzacia where (Uzivatel_idUzivatel1='".$id_prijmatel."' and Uzivatel_idUzivatel2='".$id_uzivatel."') or (Uzivatel_idUzivatel2='".$id_prijmatel."' and Uzivatel_idUzivatel1='".$id_uzivatel."') ");
$i = 0;
while ($rows = $sql->fetch_assoc()) {
    $data[$i] = $rows;
    ++$i;
}

if($i==0 && $id_uzivatel!=$id_prijmatel){
    $sql = mysqli_query($con, "select * from konverzacia");
    $n = 0;
    while ($rows = $sql->fetch_assoc()) {
        $data[$n] = $rows;
        ++$n;
    }
    $id_konverzacie=$n+1;

    $sql = "INSERT into konverzacia (idKonverzacie,Uzivatel_idUzivatel1,Uzivatel_idUzivatel2)Values ('$id_konverzacie','$id_uzivatel','$id_prijmatel')";
    mysqli_query($con, $sql);
    echo "ok";

}else{
    echo "false";
}
?>