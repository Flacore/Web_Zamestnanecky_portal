<?php
include "../config_DB.php";

$type=$_POST['type'];

$sql = mysqli_query($con, "select * from odpoved");
$n = 0;
while ($rows = $sql->fetch_assoc()) {
    $info = $rows;
    if($n<$info['idOdpoveed'])
        $n=$info['idOdpoveed'];
}
$idOdpoved = $n + 1;


if($type<3) {
    typeText($con, $_POST,$idOdpoved);
}
if($type==7) {
    typeDate($con, $_POST,$idOdpoved);
}
if($type==8)
    typeTime($con,$_POST,$idOdpoved);
if($type==6)
    typeFile($con,$_POST,$idOdpoved);
if($type==5)
    typeList($con,$_POST,$idOdpoved);
if($type==3 || $type==4 ||$type==10 || $type==9)
    typeAns($con,$_POST,$idOdpoved);
if($type==11)
   typeInterval($con,$_POST,$idOdpoved);

function typeTime($con,$POST,$idOdpoved){
    if($POST['cas']!=null) {
        $sql = "INSERT into odpoved (idOdpoveed, vyplnenie_formulara_idVyplnenie_formulara,cas,prvok_idprvok)
        Values ('" . $idOdpoved . "','" . $POST['vyplnenie'] . "','" . $POST['cas'] . "','" . $POST['prvok_id'] . "')";
        mysqli_query($con, $sql);
    }
}

function typeDate($con,$POST,$idOdpoved){
    if($POST['datum']!=null) {
        $sql = "INSERT into odpoved (idOdpoveed, vyplnenie_formulara_idVyplnenie_formulara,datum,prvok_idprvok)
        Values ('" . $idOdpoved . "','" . $POST['vyplnenie'] . "','" . $POST['datum'] . "','" . $POST['prvok_id'] . "')";
        mysqli_query($con, $sql);
    }
}

function typeText($con,$POST,$idOdpoved){
    if($POST['odpoved']!=null) {
        $sql = "INSERT into odpoved (idOdpoveed, vyplnenie_formulara_idVyplnenie_formulara,text,prvok_idprvok)
        Values ('" . $idOdpoved . "','" . $POST['vyplnenie'] . "','" . $POST['odpoved'] . "','" . $POST['prvok_id'] . "')";
        mysqli_query($con, $sql);
    }
}

function typeFile($con,$POST,$idOdpoved){
    if($POST['id_subor']!=null) {
        $sql = "INSERT into odpoved (idOdpoveed, vyplnenie_formulara_idVyplnenie_formulara,Subor_idSubor,prvok_idprvok)
        Values ('" . $idOdpoved . "','" . $POST['vyplnenie'] . "','" . $POST['id_subor'] . "','" . $POST['prvok_id'] . "')";
        mysqli_query($con, $sql);
    }
}

function typeList($con,$POST,$idOdpoved){
    if($POST['list_item']!=null) {
        $sql = "INSERT into odpoved (idOdpoveed, vyplnenie_formulara_idVyplnenie_formulara,moznost_idMoznost,prvok_idprvok)
        Values ('".$idOdpoved."','".$POST['vyplnenie']."','".$POST['list_item']."','".$POST['prvok_id']."')";
        mysqli_query($con, $sql);
    }
}

function typeAns($con,$POST,$idOdpoved){
    if($POST['type']==3)
        $value=$POST['prvok'.$POST['prvok_id']];
    if($POST['type']==9 || $POST['type']==10 || $POST['type']==4)
        $value=$POST['group'.$POST['submoznost']];
    if($value!=null) {
        $sql = "INSERT into odpoved (idOdpoveed, vyplnenie_formulara_idVyplnenie_formulara,moznost_idMoznost,prvok_idprvok)
        Values ('" . $idOdpoved . "','" . $POST['vyplnenie'] . "','" . $value . "','" . $POST['prvok_id'] . "')";
        mysqli_query($con, $sql);
    }
}


function typeInterval($con,$POST,$idOdpoved){
    if($POST['max']-$POST['min']<10){
        $hodnotenie=$POST[$POST['prvok_id']];
    }else{
        $hodnotenie=$POST['value'];
    }
    if($hodnotenie!=null) {
        $sql = "INSERT into odpoved (idOdpoveed, vyplnenie_formulara_idVyplnenie_formulara,hodnotenie,prvok_idprvok)
        Values ('" . $idOdpoved . "','" . $POST['vyplnenie'] . "','" . $hodnotenie . "','" . $POST['prvok_id'] . "')";
        mysqli_query($con, $sql);
    }
}



?>

