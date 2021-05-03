<?php
include "../config_DB.php";
include "../ftp/Upload_file.php";
$rod_cislo=$_SESSION['session'];

if(!(isset($_SESSION['session']) && isset($_SESSION['session']))){
    header('Location: Main_Site.php');
}

$typ=$_POST['typ'];

if($typ == 1){
    //Mazanie inzeratu
    $sql = mysqli_query($con, "select * from subor where inzerat_id_inzerat='".$id."'");
    $i = 0;
    while ($rows = $sql->fetch_assoc()) {
        $data[$i] = $rows;
        ++$i;
    }

    if($i>0) {
        $target = $data[0]['cesta'];
        $target = ltrim($target, $target[0]);
        remove_file($target);
    }
    $sql = "Delete from subor where idSubor='" . $_POST['id'] . "'";
    $con->query($sql);

}
if($typ == 2){
    //Vytvaranie inzeratu
    $sql = mysqli_query($con, "select * from inzerat");
    $n = 0;
    while ($rows = $sql->fetch_assoc()) {
        $info = $rows;
        if($n<$info['id_inzerat'])
            $n=$info['id_inzerat'];
    }
    $id_inz = $n+1;

    //Insert inzerat
    $name=$_POST['Nazov'];
    $describe=$_POST['Popis'];
    if(isset($_POST['tel']))
        $tel=1;
    else
        $tel=null;
    $price =$_POST['cena'];
    $category=$_POST['cat'];

    $sql = "INSERT into inzerat (id_inzerat, Titulok, Popis, vytvorenie, zobraz_telefon, cenovka, kategoria_id_kategoria, os_udaje_rod_cislo)
            Values ('$id_inz','$name','$describe',CURRENT_DATE,'$tel','$price','$category','$rod_cislo')";
    mysqli_query($con, $sql);

    $subor = $_FILES;
    $server_dir="/inzercia/".$rod_cislo."_".$id_inz."/";
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
    $sql = "INSERT into subor (idSubor, nazov, cesta, vytvorenie,inzerat_id_inzerat) Values ('$idSubor','$name','$cesta_subor',CURRENT_DATE,'$id_inz')";
    mysqli_query($con, $sql);
}
if($typ == 3){
    //Vytvaranie kategorie
    $subor = $_FILES;
    $server_dir="/inzercia/categoria/";
    $sql = mysqli_query($con, "select * from subor");
    $n = 0;
    while ($rows = $sql->fetch_assoc()) {
        $info = $rows;
        if($n<$info['idSubor'])
            $n=$info['idSubor'];
    }
    $idSubor = $n + 1;
    $subor['file_path']['name']=date("Ymd_hhmmss_").''.$subor['file_path']['name'];
    $meno=  $subor['file_path']['name'];
    $cesta_subor=upload_file($subor,$server_dir);
    $sql = "INSERT into subor (idSubor, nazov, cesta, vytvorenie) Values ('$idSubor','$meno','$cesta_subor',CURRENT_DATE)";
    mysqli_query($con, $sql);

    $name=$_POST['Nazov'];
    $sql = mysqli_query($con, "select * from kategoria");
    $n = 0;
    while ($rows = $sql->fetch_assoc()) {
        $info = $rows;
        if($n<$info['id_kategoria'])
            $n=$info['id_kategoria'];
    }
    $idcat=$n+1;
    $sql = "INSERT into kategoria (id_kategoria, Názov, Subor_idSubor) 
            Values ('$idcat','$name','$idSubor')";
    mysqli_query($con, $sql);
}
if($typ == 4){
    //Mazanie kategorie
    $id=$_POST['cat_id'];
    $sql = mysqli_query($con, "select * from subor where idSubor in 
    (select Subor_idSubor from kategoria where id_kategori='".$id."')");
    $i = 0;
    while ($rows = $sql->fetch_assoc()) {
        $data[$i] = $rows;
        ++$i;
    }

    if($i>0) {
        $target = $data[0]['cesta'];
        $target = ltrim($target, $target[0]);
        remove_file($target);
    }
    $sql = "Delete from kategoria where id_kategoria='" .$id . "'";
    $con->query($sql);
}

header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
?>