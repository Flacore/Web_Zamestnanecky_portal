<?php
include "../../PHP/config_DB.php";
$id=$_POST['id'];
$sql = mysqli_query($con, "select * from celoziv_vzdel where idprednasky = '$id'");
$n = 0;
while ($rows = $sql->fetch_assoc()) {
    $info = $rows;
    $n++;
}

if($n>0 && isset($_SESSION['session'])){
    $sql = "Delete from subor where idSubor='" . $info['Subor_idSubor'] . "'";
    $con->query($sql);

    $sql = mysqli_query($con, "select * from prihlaseny");
    $n = 0;
    while ($rows = $sql->fetch_assoc()) {
        $info[$n] = $rows;
        $n++;
    }
    for($i=0;$i<$n;$i++){
        $row=$info[$i];
        $sql = mysqli_query($con, "select * from notifikacia");
        $k = 0;
        while ($rows = $sql->fetch_assoc()) {
            $data = $rows;
            if($k<$data['idNotifikacia'])
                $k=$data['idNotifikacia'];
        }
        $idNotif = $k+1;
        $os=$row['os_udaje_rod_cislo'];
        $sql = "INSERT into notifikacia (idNotifikacia, text, datum, Videne, os_udaje_rod_cislo)Values ('$idNotif','Inzerát na ktorý ste boli prihlásený bol práve zmazaný.',CURRENT_DATE,'0','$os' )";
        mysqli_query($con, $sql);
    }

    $sql = "Delete from prihlaseny where prednasky_idprednasky='" . $id . "'";
    $con->query($sql);

    $sql = "Delete from celoziv_vzdel where idprednasky='" . $id . "'";
    $con->query($sql);
}
?>