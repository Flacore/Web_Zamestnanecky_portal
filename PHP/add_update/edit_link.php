<?php
include "../config_DB.php";
if(isset($_SESSION['session'])) {
    $id_Login = $_SESSION['session'];
    $id = $_POST['idLink'];
    $Name = $_POST['Name'];
    $Link = $_POST['Link'];
    $Glyph = $_POST['icon'];
    $id_sended = $_POST['idLogin'];

    if ($Link == "") {
        $sql = "UPDATE zalozka SET link=null,glyphicon='$Glyph',Nazov='$Name'  WHERE idZalozka='$id'";
    } else {
        $podskupina = $_POST['podskupina'];
        $sql = "UPDATE zalozka SET link='$Link' ,glyphicon='$Glyph',Nazov='$Name',podskupina='$podskupina'  WHERE idZalozka='$id'";
    }
    $con->query($sql);
    $con->close();
}
header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>
