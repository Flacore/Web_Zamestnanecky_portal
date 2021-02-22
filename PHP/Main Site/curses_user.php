<?php
include "../config_DB.php";

if(isset($_POST["but_add"])) {
    $sql = mysqli_query($con, "SELECT * FROM uzivatel ");
    $i = 0;
    while ($rows = $sql->fetch_assoc()){
        $data[$i]=$rows;
        ++$i;
    }
    $row = $data[$i-1];
    $idUzivatel=($row['idUzivatel'])+1;

    $sql = mysqli_query($con, "SELECT * FROM os_udaje ");
    $i = 0;
    while ($rows = $sql->fetch_assoc()){
        $data[$i]=$rows;
        ++$i;
    }
    $row = $data[$i-1];
    $idOS_udaje=($row['idOS_udaje'])+1;


    $priezvisko=$_POST['txt_sname'];
    $meno=$_POST['txt_name'];
    $email=$_POST['mail'];
    $telefon=$_POST['telephone'];
    $sql_query="INSERT INTO os_udaje (idOS_udaje,Meno,Priezvisko,email,telefon)
    VALUES ('$idOS_udaje','$meno','$priezvisko','$email','$telefon')";

    if(mysqli_query($con,$sql_query)) {
        $sql_query="INSERT INTO uzivatel (idUzivatel, Login_idLogin, OS_udaje_idOS_udaje)
        VALUES ('$idUzivatel',NULL,'$idOS_udaje')";
        if(mysqli_query($con,$sql_query)) {
            header('Location: ../../HTML/Main_Site.php');
        }else{
            echo "Doslo ku chybe";
        }
    }else{
        echo "Doslo ku chybe";
    }
}else{
    echo "Doslo ku chybe";
}
?>