<?php
include "../config_DB.php";

$id=$_SESSION['session'];
$prijemca=$_POST['n'];
$konverzacia=$_POST['k'];

$sql = mysqli_query($con, "select * from os_udaje where rod_cislo ='".$prijemca."' ");
$k = 0;
while ($rows = $sql->fetch_assoc()){
    $_data[$k]=$rows;
    ++$k;
}
$info=$_data[0];
$prijemca_meno=$info['Meno']." ".$info['Priezvisko'];

$sql = mysqli_query($con, "select * from os_udaje where rod_cislo='".$id."' ");
$k = 0;
while ($rows = $sql->fetch_assoc()){
    $_data[$k]=$rows;
    ++$k;
}
$info=$_data[0];
$ja_meno=$info['Meno']." ".$info['Priezvisko'];

$dta = mysqli_query($con, "select * from sprava  where konverzacia_idKonverzacie='".$konverzacia."' ORDER BY datum ASC");
$i=0;
while ($row = $dta->fetch_assoc()) {
    $data_inner[$i] = $row;
    $i++;
}
$row=$data_inner[0];
$odosielatel= $row['Uzivatel_idUzivatel'];
if($prijemca!=$odosielatel){
    $sql = "UPDATE konverzacia SET precitane='1'  WHERE idKonverzacie='".$konverzacia."'";
    $con->query($sql);
}

$sql = mysqli_query($con, "SELECT * FROM sprava where konverzacia_idKonverzacie='".$konverzacia."' ");
$i = 0;
while ($rows = $sql->fetch_assoc()){
    $dataText[$i]=$rows;
    ++$i;
}
for ($j=0;$j<$i;$j++){
    $row=$dataText[$j];
    if($row['Uzivatel_idUzivatel']==$prijemca){
        echo "<div class=\"received-msg col-sm-12\">
                    <h5 class=\"sender\">".$prijemca_meno."</h5>
                    <div class=\"msgText\">
                        <h5 class=\"txt-msg\">".$row['text']."</h5>
                    </div>
                    <h5 class=\"date\">". date('d.m.Y',strtotime($row['datum']))."</h5>
                </div>";
    }else{
       echo "<div class=\"sended-msg col-sm-12\">
                    <h5 class=\"sender\">".$ja_meno."</h5>
                    <div class=\"msgText\">
                        <h5 class=\"txt-msg\">".$row['text']."</h5>
                    </div>
                    <h5 class=\"date\">". date('d.m.Y',strtotime($row['datum']))."</h5>
                </div>";
    }
}
echo "<input name='conv_id' type='text' style='display: none'  value='$konverzacia'>";

?>