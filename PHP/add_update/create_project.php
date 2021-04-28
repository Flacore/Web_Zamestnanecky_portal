<?php
include "../../PHP/config_DB.php";
include "../ftp/Upload_file.php";

$rod_cislo=$_SESSION['session'];
$miesto = $_POST['place'];
$popis = $_POST['desc'];
$subor = $_FILES;
if(isset($_POST['verejne']))
    $verejne = 1;
else
    $verejne = 0;


$server_dir="/pozicia_dokumenty/";
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

$sql = mysqli_query($con, "select * from projekty");
$n = 0;
while ($rows = $sql->fetch_assoc()) {
    $n++;
}
$idProjektu = $n + 1;

$sql = "INSERT into projekty (idProjekt, datum, popis, verejne, Subor_idSubor, os_udaje_rod_cislo) 
Values ('$idProjektu',CURRENT_DATE ,'$popis','$verejne','$idSubor','$rod_cislo')";
mysqli_query($con, $sql);
header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
?>