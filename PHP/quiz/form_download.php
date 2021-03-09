<?php
include "../config_DB.php";

$form_id=$_GET['id'];

//Vytvor subor;
$sql = mysqli_query($con, "select * from vyplnenie_formulara where formular_idformular='".$form_id."'");
$k = 0;
while ($row = $sql->fetch_assoc()){
    $id_list[$k]=$row;
    ++$k;
}

$delimiter=";";
$filename="export.csv";

if($k>0) {
    $f = fopen('php://memory', 'w');

    for($n=-1;$n<$k;$n++){
        $tmp_array=null;
        if($n>=0){
            $tmp=$id_list[0];
            $vyplnenie=$tmp['idVyplnenie_formulara'];
            $tmp_array[0]=$n;
            $sql = mysqli_query($con, "select * from prvok where typ_prvku<'12' and formular_idformular='".$form_id."'");
            $p = 0;
            while ($rows = $sql->fetch_assoc()){
                $array[$p]=$rows;
                ++$p;
            }
            $p=1;
            foreach ($array as $list){
                if($list['typ_prvku']==10 ||$list['typ_prvku']==9){
                    $sql = mysqli_query($con, "select * from moznost where prvok_idprvok='".$list['idprvok']."'");
                    $g = 0;
                    while ($rows = $sql->fetch_assoc()){
                        $tmp[$g]=$rows;
                        $tmp_list=$tmp[$g];
                        ++$g;
                        $tmp_array[$p]=getValue($list['typ_prvku'],$list['idprvok'],$tmp_list['idMoznost'],$vyplnenie,$con);
                        $p++;
                    }
                }else {
                    $tmp_array[$p]=getValue($list['typ_prvku'],$list['idprvok'],0,$vyplnenie,$con);
                    $p++;
                }
            }
            fputcsv($f, $tmp_array,$delimiter);
        }else{
            $sql = mysqli_query($con, "select * from prvok where typ_prvku<'12' and formular_idformular='".$form_id."'");
            $p = 0;
            while ($rows = $sql->fetch_assoc()){
                $array[$p]=$rows;
                ++$p;
            }
            $tmp_array[0]="n";
            $p=1;
            foreach ($array as $list){
                if($list['typ_prvku']==10 ||$list['typ_prvku']==9){
                    $sql = mysqli_query($con, "select * from moznost where prvok_idprvok='".$list['idprvok']."'");
                    $g = 0;
                    while ($rows = $sql->fetch_assoc()){
                        $tmp[$g]=$rows;
                        ++$g;
                    }
                    foreach ($tmp as $tmp_list){
                        $tmp_array[$p] = $tmp_list['text'];
                        $p++;
                    }
                }else {
                    $tmp_array[$p] = $list['Nazov'];
                    $p++;
                }
            }
            fputcsv($f, $tmp_array,$delimiter);
        }
    }

    fseek($f, 0);
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    fpassthru($f);
}
exit();

function getValue($typ,$idPrvok,$idMoznost,$id,$con){
    $sql = mysqli_query($con, "select * from odpoved 
    where vyplnenie_formulara_idVyplnenie_formulara='".$id."' and prvok_idprvok='".$idPrvok."'");
    $k = 0;
    while ($row = $sql->fetch_assoc()){
        $list[$k]=$row;
        ++$k;
    }

    if($k>0){
        $tmp=$list[0];
        if($typ<3)
            return $tmp['text'];
        if($typ==11)
            return $tmp['hodnotenie'];
        if($typ==8)
            return $tmp['datum'];
        if($typ==7)
            return $tmp['cas'];
        if($typ==6){
            $sql = mysqli_query($con, "select * from subor where idSubor='".$tmp['subor_idSubor']."'");
            $i = 0;
            while ($rows = $sql->fetch_assoc()){
                $item[$i]=$rows;
                ++$i;
            }
            $tmp=$item[0];
            return "http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/Server"+$tmp['cesta'];
        }
        if($typ==5 || $typ==3){
            $sql = mysqli_query($con, "select * from moznost where idMoznost='".$tmp['moznost_idMoznost']."'");
            $i = 0;
            while ($rows = $sql->fetch_assoc()){
                $item[$i]=$rows;
                ++$i;
            }
            $tmp=$item[0];
            return $tmp['text'];
        }
        if($typ==4){
            $sql = mysqli_query($con, "select moznost_idMoznost from odpoved 
            where vyplnenie_formulara_idVyplnenie_formulara='".$id."' and prvok_idprvok='".$idPrvok."' and moznost_idMoznost is not null");

            $i = 0;
            while ($rows = $sql->fetch_assoc()){
                $ids[$i]=$rows['moznost_idMoznost'];
                ++$i;
            }
            $sql = mysqli_query($con, "select * from moznost where idMoznost in ('".implode("', '", $ids)."')");
            $i = 0;
            while ($rows = $sql->fetch_assoc()){
                $item[$i]=$rows;
                ++$i;
            }
            $line=null;
            $k=0;
            foreach ($item as $lines){
                $line=$line."".$lines['text']."";
                if($i-1<$k)
                    $line=$line.",";
                $k++;
            }
            return $line;
        }
        if(  $typ==9 || $typ==10) {
            $sql = mysqli_query($con, "select moznost_idMoznost from odpoved 
            where moznost_idMoznost is not null and vyplnenie_formulara_idVyplnenie_formulara='".$id."'");

            $i = 0;
            while ($rows = $sql->fetch_assoc()) {
                $ids[$i] = $rows['moznost_idMoznost'];
                ++$i;
            }
            if ($i > 0){
                $sql = mysqli_query($con, "select * from moznost where moznost_idMoznost='".$idMoznost."' and  idMoznost in('".implode("','", $ids)."')");
                $i = 0;
                $line = null;
                while ($rows = $sql->fetch_assoc()) {
                    $item[$i] = $rows;
                    $lines=$item[$i];
                    ++$i;
                    $line =$line.$lines['text'];
                }
                return $line;
            }
        }
    }else{
        return "null";
    }
}
?>