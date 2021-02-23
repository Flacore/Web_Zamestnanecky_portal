<?php
    include "../config_DB.php";
    $id_link = $_POST['id'];

    $sql = mysqli_query($con, "select * from zalozka where idZalozka='" . $id_link . "'");
    $i = 0;
    while ($rows = $sql->fetch_assoc()) {
        $data[$i] = $rows;
        ++$i;
    }

    if($i==1) {
        $sql = "Delete from subor where Zalozka_idZalozka='" . $id_link . "'";
        $con->query($sql);

        $sql = "Delete from zalozka where idZalozka='" . $id_link . "'";
        $con->query($sql);
        $con->close();
    }
    header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>