<?php
include "../config_DB.php";
$id=$_SESSION['session'];
if(isset($_POST["but_add"]) && isset($_SESSION['session'])) {
    $telefon=$_POST['telephone'];
    $mail=$_POST['mail'];

    $sql=mysqli_query($con,"select * from kontakt where os_udaje_rod_cislo='".$id."'");
    $n = 0;
    while ($rows = $sql->fetch_assoc()){
        $_data[$k]=$rows;
        ++$n;
    }

    if($n>0) {
        $sql = "UPDATE kontakt SET telefon='" . $telefon . "',email='" . $mail . "'  WHERE os_udaje_rod_cislo='" . $id . "'";
        $con->query($sql);
        $con->close();
    }else{
        $sql=mysqli_query($con,"select * from kontakt");
        $n = 0;
        while ($rows = $sql->fetch_assoc()){
            $_data[$k]=$rows;
            ++$n;
        }
        $id_contact=$n+1;

        $sql = "INSERT into kontakt(idkontakt, telefon, email, os_udaje_rod_cislo)Values ('$id_contact','$telefon','$mail','$id')";
        mysqli_query($con, $sql);
    }
    header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
}
?>