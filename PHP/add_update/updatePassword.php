<?php
include "../config_DB.php";
$id=$_SESSION['session'];
if(isset($_POST["but_add"])) {
    $oldpass=$_POST['old_pass'];
    $newPass=$_POST['new_Pass'];
    $repPass=$_POST['pass_repeat'];
    $pss=crypt(mysqli_real_escape_string($con, $newPass),"test");

    if ($newPass==$repPass){
        $result = mysqli_query($con, "select count(*) as UserData from login where OS_udaje_rod_cislo='".$id."' and password='".$password."'");
        $row = mysqli_fetch_array($result);
        $count = $row['UserData'];

        if ($count > 0) {
            $pss=crypt(mysqli_real_escape_string($con, $newPass),"test");
            $sql = "UPDATE login SET password='".$pss."'  WHERE OS_udaje_rod_cislo='".$id."'";
            $con->query($sql);
            $con->close();
            header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
        }
    }
}
?>