<?php
include "../../PHP/config_DB.php";
include "../ftp/Upload_file.php";

$rod_cislo=$_SESSION['session'];
$tmp_date =$_POST['date'];
$tmp_time =$_POST['time'];
$date = date('Y-m-d H:i:s', strtotime("$tmp_date $tmp_time"));
$miesto = $_POST['place'];
$cena = $_POST['cena'];

$popis = $_POST['desc'];
$meno = $_POST['name'];
$subor = $_FILES;
if(isset($_POST['verejne']))
    $verejne = 1;
else
    $verejne = 0;

$server_dir="/prednaska_fotky/";
$sql = mysqli_query($con, "select * from subor");
$n = 0;
while ($rows = $sql->fetch_assoc()) {
    $info = $rows;
    if($n<$info['idSubor'])
        $n=$info['idSubor'];
}
$idSubor = $n + 1;
$subor['file_path']['name']=date("Ymd_hhmmss_").''.$subor['file_path']['name'];
$cesta_subor=upload_file($subor,$server_dir);
$sql = "INSERT into subor (idSubor, nazov, cesta, vytvorenie) Values ('$idSubor','$meno','$cesta_subor',CURRENT_DATE)";
mysqli_query($con, $sql);


$sql = mysqli_query($con, "select * from celoziv_vzdel");
$n = 0;
while ($rows = $sql->fetch_assoc()) {
    $n++;
}
$idPrednaska = $n + 1;

$sql = "INSERT into celoziv_vzdel (idprednasky, datum, nazov, verejne, miesto, popis, cena, Subor_idSubor, os_udaje_rod_cislo) 
Values ('$idPrednaska','$date','$meno','$verejne','$miesto','$popis','$cena','$idSubor','$rod_cislo')";
mysqli_query($con, $sql);
//header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
?>