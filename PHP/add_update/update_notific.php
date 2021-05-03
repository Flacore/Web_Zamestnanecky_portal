<?php
include "../config_DB.php";
if(isset($_SESSION['session'])){
    $id=$_SESSION['session'];
    $sql = "UPDATE notifikacia SET Videne = '1'  WHERE os_udaje_rod_cislo='".$id."'";
    $con->query($sql);
}
?>