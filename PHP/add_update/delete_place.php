<?php
include "../../PHP/config_DB.php";
$id=$_POST['id'];
if(isset($_SESSION['session'])){
    $sql = "UPDATE os_udaje SET Pracovisko_idPracovisko = '1'   where Pracovisko_idPracovisko='".$id."'";
    $con->query($sql);

    $sql = "Delete from pracovisko where idPracovisko='" . $id . "'";
    $con->query($sql);
}
?>