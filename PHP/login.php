<?php
include "config_DB.php";

if(isset($_POST['but_submit'])) {

    //Nacitanie parametrov
    $uname = mysqli_real_escape_string($con, $_POST['txt_uname']);
    $test =mysqli_real_escape_string($con, $_POST['txt_pwd']);
    $password = crypt(mysqli_real_escape_string($con, $_POST['txt_pwd']),"test");

    if ($uname != "" && $password != "") {

        //Zisti kolko je rovnakych parametrov
        $result = mysqli_query($con, "select count(*) as UserData from login where Login='".$uname."' and password='".$password."'");
        $row = mysqli_fetch_array($result);
        $count = $row['UserData'];

        if ($count > 0 && $count<2) {
            //Prihlasi uzivatela
            $result = mysqli_query($con, "select idLogin  as UserData from login where Login='".$uname."' and password='".$password."'");
            $row = mysqli_fetch_array($result);
            $id = $row['UserData'];
            $_SESSION['session'] = $id;
            header('Location: ../HTML/System.php');

        } else {
            $message = "Zle meno alebo heslo.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }

    }
}

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>