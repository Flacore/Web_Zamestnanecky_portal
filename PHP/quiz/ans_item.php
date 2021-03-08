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
if($type==3)
    typeAnsOne($con,$_POST,$idOdpoved);
if($type==4)
    typeAnsMulti($con,$_POST,$idOdpoved);
if($type==11)
    typeInterval($con,$_POST,$idOdpoved);
if($type<11 && $type>8)
    typeMatrixAns($con,$_POST,$idOdpoved);

echo $idOdpoved;

function typeTime($con,$POST,$idOdpoved){
    $sql = "INSERT into odpoved (idOdpoveed, vyplnenie_formulara_idVyplnenie_formulara,cas,prvok_idprvok)
    Values ('".$idOdpoved."','".$POST['vyplnenie']."','".$POST['cas']."','".$POST['prvok_id']."')";
    mysqli_query($con, $sql);
}

function typeDate($con,$POST,$idOdpoved){
    $sql = "INSERT into odpoved (idOdpoveed, vyplnenie_formulara_idVyplnenie_formulara,datum,prvok_idprvok)
    Values ('".$idOdpoved."','".$POST['vyplnenie']."','".$POST['datum']."','".$POST['prvok_id']."')";
    mysqli_query($con, $sql);
}

function typeText($con,$POST,$idOdpoved){
    $sql = "INSERT into odpoved (idOdpoveed, vyplnenie_formulara_idVyplnenie_formulara,text,prvok_idprvok)
    Values ('".$idOdpoved."','".$POST['vyplnenie']."','".$POST['odpoved']."','".$POST['prvok_id']."')";
    mysqli_query($con, $sql);
}

function typeFile($con,$POST,$idOdpoved){
    $sql = "INSERT into odpoved (idOdpoveed, vyplnenie_formulara_idVyplnenie_formulara,Subor_idSubor,prvok_idprvok)
    Values ('".$idOdpoved."','".$POST['vyplnenie']."','".$POST['id_subor']."','".$POST['prvok_id']."')";
    mysqli_query($con, $sql);
}

function typeList($con,$POST,$idOdpoved){
    $sql = "INSERT into odpoved (idOdpoveed, vyplnenie_formulara_idVyplnenie_formulara,moznost_idMoznost,prvok_idprvok)
    Values ('".$idOdpoved."','".$POST['vyplnenie']."','".$POST['list_item']."','".$POST['prvok_id']."')";
    mysqli_query($con, $sql);
}

function typeAnsOne($con,$POST,$idOdpoved){
    $sql = "INSERT into odpoved (idOdpoveed, vyplnenie_formulara_idVyplnenie_formulara,moznost_idMoznost,prvok_idprvok)
    Values ('".$idOdpoved."','".$POST['vyplnenie']."','".$POST['group'.$POST['prvok_id']]."','".$POST['prvok_id']."')";
    mysqli_query($con, $sql);
}

//TODO
function typeAnsMulti($con,$POST,$idOdpoved){

}

function typeInterval($con,$POST,$idOdpoved){
    if($POST['max']-$POST['min']<10){
        $hodnotenie=$POST[$POST['prvok_id']];
    }else{
        $hodnotenie=$POST['value'];
    }

    $sql = "INSERT into odpoved (idOdpoveed, vyplnenie_formulara_idVyplnenie_formulara,hodnotenie,prvok_idprvok)
    Values ('".$idOdpoved."','".$POST['vyplnenie']."','".$hodnotenie."','".$POST['prvok_id']."')";
    mysqli_query($con, $sql);
}

//TODO
function typeMatrixAns($con,$POST,$idOdpoved){

}

?>

