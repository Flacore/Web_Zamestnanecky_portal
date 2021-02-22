<?php
include "../config_DB.php";
$id=$_SESSION['session'];
if(isset($_POST["but_add"])) {
    $telefon=$_POST['telephone'];
    $mail=$_POST['mail'];
    $sql = "UPDATE os_udaje SET telefon='".$telefon."',email='".$mail."'  WHERE idOS_udaje='".$id."'";
    $con->query($sql);
    $con->close();
    header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
}
?>