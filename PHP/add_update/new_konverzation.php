<?php
include "../config_DB.php";
$id_uzivatel=$_SESSION['session'];

$id_konverzacie=null;
$id_prijmatel=$_POST['user_id'];

$sql = mysqli_query($con, "select * from konverzacia where (Uzivatel1='".$id_prijmatel."' and Uzivatel2='".$id_uzivatel."') or (Uzivatel2='".$id_prijmatel."' and Uzivatel1='".$id_uzivatel."') ");
$i = 0;
while ($rows = $sql->fetch_assoc()) {
    $data[$i] = $rows;
    ++$i;
}

if($i==0 && $id_uzivatel!=$id_prijmatel && isset($_SESSION['session'])){
    $sql = mysqli_query($con, "select * from konverzacia");
    $n = 0;
    while ($rows = $sql->fetch_assoc()) {
        $data[$n] = $rows;
        ++$n;
    }
    $id_konverzacie=$n+1;

    $sql = "INSERT into konverzacia (idKonverzacie,Uzivatel1,Uzivatel2)Values ('$id_konverzacie','$id_uzivatel','$id_prijmatel')";
    mysqli_query($con, $sql);
    echo "ok";

}else{
    echo "false";
}
?>