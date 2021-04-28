<?php
include "../../PHP/config_DB.php";
$id=$_POST['id'];
$sql = mysqli_query($con, "select * from celoziv_vzdel where idprednasky = '$id'");
$n = 0;
while ($rows = $sql->fetch_assoc()) {
    $info = $rows;
    $n++;
}

if($n>0){
    $sql = "Delete from subor where idSubor='" . $info['Subor_idSubor'] . "'";
    $con->query($sql);

    $sql = "Delete from prihlaseny where prednasky_idprednasky='" . $id . "'";
    $con->query($sql);

    $sql = "Delete from celoziv_vzdel where idprednasky='" . $id . "'";
    $con->query($sql);
}
?>