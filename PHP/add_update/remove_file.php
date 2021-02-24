<?php
    include "../ftp/Remove_file.php";
    include "../config_DB.php";

    $idSuboru=$_POST['idSubor'];

    $sql = mysqli_query($con, "select * from subor where idSubor='".$idSuboru."'");
    $i = 0;
    while ($rows = $sql->fetch_assoc()) {
        $data[$i] = $rows;
        ++$i;
    }

    $target=$data[0]['cesta'];
    $target=ltrim($target, $target[0]);

    $sql = mysqli_query($con, "select * from subor where idSubor='" . $idSuboru . "'");
    $i = 0;
    while ($rows = $sql->fetch_assoc()) {
        $data[$i] = $rows;
        ++$i;
    }

    if($i==1) {
        $sql = "Delete from subor where idSubor='" . $idSuboru . "'";
        $con->query($sql);
    }

    remove_file($target);

?>