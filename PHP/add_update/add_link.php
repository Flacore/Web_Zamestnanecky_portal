<?php
include "../config_DB.php";
$id_Login = $_SESSION['session'];

$Name = $_POST['Name'];
$Link = $_POST['Link'];
$Glyph = $_POST['icon'];
$id_sended = $_POST['idLogin'];
if (true) {
    if($id_sended!=null) {
        $id_uzivatel = $id_Login;
    }else
        $id_uzivatel=null;

    $sql = mysqli_query($con, "select * from zalozka");
    $n = 0;
    while ($rows = $sql->fetch_assoc()) {
        $_data[$k] = $rows;
        $info = $_data[$k];
        if($n<$info['idZalozka'])
            $n=$info['idZalozka'];
    }
    $id_zalozka = $n + 1;

    if($id_uzivatel!=null)
        $sql = "INSERT into zalozka (idZalozka, Nazov, link, glyphicon, os_udaje_rod_cislo)Values ('$id_zalozka','$Name','$Link','$Glyph','$id_uzivatel')";
    else {
        if ($Link == "") {
            $sql = "INSERT into zalozka (idZalozka, Nazov, glyphicon)Values ('$id_zalozka','$Name','$Glyph')";
        } else {
            $sql = "INSERT into zalozka (idZalozka, Nazov, link, glyphicon)Values ('$id_zalozka','$Name','$Link','$Glyph')";
        }
    }
    mysqli_query($con, $sql);
}
header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

?>
