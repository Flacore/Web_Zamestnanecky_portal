<?php
include "../config_DB.php";
$id_uzivatel=$_SESSION['session'];

if(true) {
    $rod_cislo=$_POST['rod_cislo'];
    $name=$_POST['name'];
    $sur_name=$_POST['sur_name'];
    $pracovisko=$_POST['pracovisko'];
    $funkcia=$_POST['funkcia'];

    $sql = "INSERT into os_udaje (rod_cislo,Meno,Priezvisko,Pracovisko_idPracovisko)Values ('$rod_cislo','$name','$sur_name','$pracovisko')";
    mysqli_query($con, $sql);

    $sql=mysqli_query($con,"select * from login");
    $n = 0;
    while ($rows = $sql->fetch_assoc()){
        $_data[$k]=$rows;
        ++$n;
    }
    $id_log=$n+1;
    $sql=mysqli_query($con,"select * from os_udaje where lower(Priezvisko) like'".$sur_name."'");
    $n = 0;
    while ($rows = $sql->fetch_assoc()){
        $_data[$k]=$rows;
        ++$n;
    }
    $login=$sur_name.($n);
    $pass=$name[0].$sur_name[0].substr($rod_cislo,0,6).substr($rod_cislo,7,4);
    $pass=crypt(mysqli_real_escape_string($con, $pass),"test");
    $sql = "INSERT into login (idLogin, login, password, OS_udaje_rod_cislo)Values ('$id_log','$login','$pass','$rod_cislo' )";
    mysqli_query($con, $sql);

    $sql=mysqli_query($con,"select * from prirad_funkcia");
    $n = 0;
    while ($rows = $sql->fetch_assoc()){
        $_data[$k]=$rows;
        ++$n;
    }
    $id_or=$n+1;
    $sql = "INSERT into prirad_funkcia (zaznam, funkcie_idPozícia, os_udaje_rod_cislo, od)Values ('$id_or','$funkcia','$rod_cislo',CURRENT_DATE )";
    mysqli_query($con, $sql);
}
if(isset($_POST['button'])) {
    alert("Login je: ".$login);
    header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
}else{
    echo $login;
}
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>