<?php
include "../config_DB.php";
if(!isset($_SESSION['session'])){
    header('Location: Main_Site.php');
}

$sql = mysqli_query($con, "select * from prvok");
$n = 0;
while ($rows = $sql->fetch_assoc()) {
    $info = $rows;
    if($n<$info['idprvok'])
        $n=$info['idprvok'];
}
$id_prvok = $n + 1;

$vyzaduje=0;
$ine=0;

$id_form = $_POST['id_parent'];
$z_value = $_POST['z_value'];
$Nazov = $_POST['Otazka'];

$type=$_POST['type'];
if($type > 11){
    if($type==14 || $type==15){
        if(isset($_POST['url_bt'])){
            $sql = "INSERT into prvok (idprvok, formular_idformular, typ_prvku, z_index, Nazov) Values ('$id_prvok','$id_form','$type','$z_value','$Nazov')";
            mysqli_query($con, $sql);
            $URL=$_POST['url'];

            $sql = mysqli_query($con, "select * from obsah");
            $n = 0;
            while ($rows = $sql->fetch_assoc()) {
                $info = $rows;
                if($n<$info['idObsah'])
                    $n=$info['idObsah'];
            }
            $id_obsah = $n + 1;

            $sql = "INSERT into obsah (idObsah, prvok_idprvok, url) Values ('$id_obsah','$id_prvok','$URL')";
            mysqli_query($con, $sql);
        }else{
            $sql = "INSERT into prvok (idprvok, formular_idformular, typ_prvku, z_index, Nazov) Values ('$id_prvok','$id_form','$type','$z_value','$Nazov')";
            mysqli_query($con, $sql);

            $id_subor=$_POST['file_path'];


            $sql = mysqli_query($con, "select * from obsah");
            $n = 0;
            while ($rows = $sql->fetch_assoc()) {
                $info = $rows;
                if($n<$info['idObsah'])
                    $n=$info['idObsah'];
            }
            $id_obsah = $n + 1;

            $sql = "INSERT into obsah (idObsah, prvok_idprvok, Subor_idSubor) Values ('$id_obsah','$id_prvok','$id_subor')";
            mysqli_query($con, $sql);
        }
        exit();
    }else{
        $popis=$_POST['popis'];
        $sql = "INSERT into prvok (idprvok, formular_idformular, typ_prvku, z_index, Nazov, Popis) Values ('$id_prvok','$id_form','$type','$z_value','$Nazov','$popis')";
    }
}else {
    if(isset($_POST['vyzaduje']))
        $vyzaduje=1;
    if(isset($_POST['ine']))
        $ine=1;
    if (!($type == 11)) {
        $sql = "INSERT into prvok (idprvok, formular_idformular, typ_prvku, z_index, Nazov,Vyzadovanie,Mozn_ine) Values ('$id_prvok','$id_form','$type','$z_value','$Nazov','$vyzaduje','$ine')";
    }else{
        $min =$_POST['min'];
        $max =$_POST['max'];
        $sql = "INSERT into prvok (idprvok, formular_idformular, typ_prvku, z_index, Nazov, min, max,Vyzadovanie,Mozn_ine) Values ('$id_prvok','$id_form','$type','$z_value','$Nazov','$min','$max','$vyzaduje','$ine')";
    }
}
echo $id_prvok;
mysqli_query($con, $sql);