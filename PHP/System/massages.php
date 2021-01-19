<?php
include "../config.php";
$id=$_SESSION['session'];
$prijemca=$_POST['n'];
$konverzacia=$_POST['k'];

$sql = mysqli_query($con, "select * from os_udaje join uzivatel where idUzivatel='".$prijemca."' ");
$k = 0;
while ($rows = $sql->fetch_assoc()){
    $_data[$k]=$rows;
    ++$k;
}
$info=$_data[0];
$prijemca_meno=$info['Meno']." ".$info['Priezvisko'];;
$sql = mysqli_query($con, "select * from os_udaje join uzivatel where idUzivatel='".$id."' ");
$k = 0;
while ($rows = $sql->fetch_assoc()){
    $_data[$k]=$rows;
    ++$k;
}
$info=$_data[0];
$ja_meno=$info['Meno']." ".$info['Priezvisko'];

$sql = mysqli_query($con, "SELECT * FROM sprava where konverzacia_idKonverzacie='".$konverzacia."' ");
$i = 0;
while ($rows = $sql->fetch_assoc()){
    $dataText[$i]=$rows;
    ++$i;
}
for ($j=0;$j<$i;$j++){
    $row=$dataText[$j];
    if($row['Uzivatel_idUzivatel']=$prijemca){
        echo "<div class=\"received-msg col-sm-12\">
                    <h5 class=\"sender\">".$prijemca_meno."</h5>
                    <div class=\"msgText\">
                        <h5 class=\"txt-msg\">".$row['text']."</h5>
                    </div>
                    <h5 class=\"date\">".$row['datum']."</h5>
                </div>";
    }else{
       echo "<div class=\"sended-msg col-sm-12\">
                    <h5 class=\"sender\">".$ja_meno."</h5>
                    <div class=\"msgText\">
                        <h5 class=\"txt-msg\">".$row['text']."</h5>
                    </div>
                    <h5 class=\"date\">".$row['datum']."</h5>
                </div>";
    }
}

?>