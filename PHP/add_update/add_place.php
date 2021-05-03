<?php
include "../../PHP/config_DB.php";
if(isset($_SESSION['session']) && isset($_SESSION['session'])){

    $sql = mysqli_query($con, "select idPracovisko from pracovisko");
    $n = 0;
    while ($rows = $sql->fetch_assoc()) {
        $info = $rows;
        if($n<$info['idPracovisko'])
            $n=$info['idPracovisko'];
    }
    $id = $n+1;
    $nazov=$_POST['Nazov'];
    $sql = "INSERT into pracovisko (idPracovisko, Názov)Values ('$id','$nazov')";
    mysqli_query($con, $sql);
}
header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
?>