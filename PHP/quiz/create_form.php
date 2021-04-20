<?php
include "../config_DB.php";
if(!isset($_SESSION['session'])){
    header('Location: Main_Site.php');
}
$id_uzivatel=$_SESSION['session'];

$z_value=$_POST["z_value"];
$type=$_POST['type'];
$Nazov=$_POST['Nazov'];
$popis=$_POST['popis'];
$platnost_od=$_POST['platnost_od'];
$platnost_do=$_POST['platnost_do'];
$form_type=$_POST['form_type'];

$sql = mysqli_query($con, "select * from formular");
$n = 0;
while ($rows = $sql->fetch_assoc()) {
    $info = $rows;
    if($n<$info['idformular'])
        $n=$info['idformular'];
}
$id_form = $n + 1;

$sql = mysqli_query($con, "select * from prvok");
$n = 0;
while ($rows = $sql->fetch_assoc()) {
    $info = $rows;
    if($n<$info['idprvok'])
        $n=$info['idprvok'];
}
$id_prvok = $n + 1;

$sql = "INSERT into formular (idformular,os_udaje_rod_cislol, typ, vytvorenie, platnost_od, platnost_do) Values ('$id_form','$id_uzivatel','$form_type',CURRENT_DATE,'$platnost_od','$platnost_do')";
mysqli_query($con, $sql);
$sql = "INSERT into prvok (idprvok, formular_idformular, typ_prvku, z_index, Nazov, Popis) Values ('$id_prvok','$id_form','$type','$z_value','$Nazov','$popis')";
mysqli_query($con, $sql);

echo $id_form;