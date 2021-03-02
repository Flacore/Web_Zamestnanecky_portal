<?php
include "../config_DB.php";
if(!isset($_SESSION['session'])){
    header('Location: Main_Site.php');
}
$id=$_SESSION['session'];

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

$sql = mysqli_query($con, "select * from uzivatel join login on login.idLogin=uzivatel.Login_idLogin where login.idLogin='".$id."'");
$k = 0;
while ($rows = $sql->fetch_assoc()){
    $_data[$k]=$rows;
    ++$k;
}
$info=$_data[0];
$id_uzivatel=$info['idUzivatel'];

$sql = "INSERT into formular (idformular, Uzivatel_idUzivatel, typ, vytvorenie, platnost_od, platnost_do) Values ('$id_form','$id_uzivatel','$form_type',CURRENT_DATE,'$platnost_od','$platnost_do')";
mysqli_query($con, $sql);
$sql = "INSERT into prvok (idprvok, formular_idformular, typ_prvku, z_index, Nazov, Popis) Values ('$id_prvok','$id_form','$type','$z_value','$Nazov','$popis')";
mysqli_query($con, $sql);

echo $id_form;