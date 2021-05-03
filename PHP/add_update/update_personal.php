<?php
include "../config_DB.php";
if(isset($_POST['button_file'])&& isset($_SESSION['session'])) {
    $id = $_SESSION['session'];
    $IBAN = $_POST['IBAN'];
    $MESTO = $_POST['Mesto'];
    $ADRESA = $_POST['Adresa'];
    $PSC = $_POST['PSC'];

    $sql = "UPDATE os_udaje SET IBAN='".$IBAN."', Mesto='".$MESTO."', Adresa='".$ADRESA."', PSC='".$PSC."'  WHERE rod_cislo ='".$id."'";
    $con->query($sql);
}
header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
?>