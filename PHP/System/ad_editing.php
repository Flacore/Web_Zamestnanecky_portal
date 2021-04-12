<?php
include "../config_DB.php";

if(!isset($_SESSION['session'])){
    header('Location: Main_Site.php');
}

$typ=$_POST['typ'];

if($typ == 1){
    //Mazanie inzeratu
    $sql = mysqli_query($con, "select * from subor where inzerat_id_inzerat='".$id."'");
    $i = 0;
    while ($rows = $sql->fetch_assoc()) {
        $data[$i] = $rows;
        ++$i;
    }

    if($i>0) {
        $target = $data[0]['cesta'];
        $target = ltrim($target, $target[0]);
        remove_file($target);
    }
    $sql = "Delete from subor where idSubor='" . $_POST['id'] . "'";
    $con->query($sql);

}
if($typ == 2){
    //Vytvaranie inzeratu

}
if($typ == 3){
    //Vytvaranie kategorie

}
?>