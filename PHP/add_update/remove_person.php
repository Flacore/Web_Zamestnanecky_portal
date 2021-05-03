<?php
    include "../config_DB.php";
    $id=$_SESSION['session'];
    $id_person=$_POST['user_id'];
    if($id != $id_person && isset($_SESSION['session'])){
        $sql = "Delete from prirad_funkcia where os_udaje_rod_cislo='" . $id_person . "'";
        $con->query($sql);
        $sql = "Delete from login where os_udaje_rod_cislo='" . $id_person . "'";
        $con->query($sql);
        $sql = "Delete from os_udaje where rod_cislo='" . $id_person . "'";
        $con->query($sql);
        $sql = "Delete from sprava where Odosielatel='" . $id_person . "'";
        $con->query($sql);
        $sql = "Delete from konverzacia where Uzivatel1='" . $id_person . "' or Uzivatel2='" . $id_person . "'";
        $con->query($sql);
        //Dokonc vsade
        echo "ok";
    }
?>