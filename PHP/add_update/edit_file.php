<?php
include "../ftp/Upload_file.php";
include "../config_DB.php";

if(isset($_POST['button_file']) && isset($_SESSION['session'])) {
    $idSubor = $_POST['idFile'];
    $nazov = $_POST['name'];
    $subor = $_FILES;
    $cesta_subor = null;
    $popis = $_POST['description'];
    $idZalozka = $_POST['idSubor'];
    $idPozicia = $_POST['idPozicia'];
    $idPrednask = $_POST['idPrednaska'];

    if($subor['file_path']['name'] != "") {
        $server_dir = "/";
        if ($idZalozka == null && $idPozicia == null)
            $server_dir = "/prednaska_fotky/";
        if ($idPrednask == null && $idPozicia == null)
            $server_dir = "/dokumenty_tlaciva/";
        if ($idZalozka == null && $idPrednask == null)
            $server_dir = "/pozicia_dokumenty/";

        $cesta_subor=upload_file($subor, $server_dir);
        $sql = "UPDATE subor SET cesta='".$cesta_subor."',vytvorenie=current_date, popis='" . $popis . "' ,nazov='" . $nazov . "' WHERE idSubor='".$idSubor."'";
    }else {
        $sql = "UPDATE subor SET vytvorenie=current_date, popis='" . $popis . "' ,nazov='" . $nazov . "' WHERE idSubor='".$idSubor."'";
    }
    mysqli_query($con, $sql);
}
header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>