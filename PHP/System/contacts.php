<?php
include "../config.php";
$id=$_SESSION;
$meno=$_POST['Meno'];
$pracovisko=$_POST['pracovisko'];
if($pracovisko != null || $meno!=null) {
    if ($pracovisko != null && $meno==null)
        $sql = mysqli_query($con, "select * from pozícia join(pracovisko join (login join (uzivatel join os_udaje on uzivatel.OS_udaje_idOS_udaje =os_udaje.idOS_udaje) on Login.idLogin =uzivatel.Login_idLogin)ON Login.Pracovisko_idPracovisko = pracovisko.idPracovisko)where  LOWER(Názov) like LOWER(\"%" . $pracovisko . "%\")");
    if ($meno != null && $pracovisko==null)
        $sql = mysqli_query($con, "select * from pozícia join(pracovisko join (login join (uzivatel join os_udaje on uzivatel.OS_udaje_idOS_udaje =os_udaje.idOS_udaje) on Login.idLogin =uzivatel.Login_idLogin)ON Login.Pracovisko_idPracovisko = pracovisko.idPracovisko) where CONCAT(LOWER(os_udaje.Priezvisko),\" \",LOWER(os_udaje.Meno)) LIKE LOWER(\"%" . $meno . "%\") or CONCAT(LOWER(os_udaje.Meno),\" \",LOWER(os_udaje.Priezvisko)) LIKE LOWER(\"%" . $meno . "%\")");
    if ($meno != null && $pracovisko!=null)
        $sql = mysqli_query($con, "select * from pozícia join(pracovisko join (login join (uzivatel join os_udaje on uzivatel.OS_udaje_idOS_udaje =os_udaje.idOS_udaje) on Login.idLogin =uzivatel.Login_idLogin)ON Login.Pracovisko_idPracovisko = pracovisko.idPracovisko) where (CONCAT(LOWER(os_udaje.Priezvisko),\" \",LOWER(os_udaje.Meno)) LIKE LOWER(\"%" . $meno . "%\") or CONCAT(LOWER(os_udaje.Meno),\" \",LOWER(os_udaje.Priezvisko)) LIKE LOWER(\"%" . $meno . "%\")) and  LOWER(Názov) like LOWER(\"%" . $pracovisko . "%\")");
}
else{
    $sql = mysqli_query($con, "select * from pozícia join(pracovisko join (login join (uzivatel join os_udaje on uzivatel.OS_udaje_idOS_udaje =os_udaje.idOS_udaje) on Login.idLogin =uzivatel.Login_idLogin)ON Login.Pracovisko_idPracovisko = pracovisko.idPracovisko)");
}
$i = 0;
if($sql!=null) {
    while ($rows = $sql->fetch_assoc()) {
        $data[$i] = $rows;
        ++$i;
    }
}

for ($j = 0; $j<$i; $j++) {
    $row = $data[$j];
    echo "
    <div class=\"resultsItem row\">
                    <div class=\"col-sm-3 full-height\">
                        <div class=\"user-img shadow\"></div>
                    </div>
                    <div class=\"col-sm-6 full-height\">
                        <div class=\"detail-info\">
                            <div class=\"col-sm-12 resultName\"><h2>" . $row['Meno'] . " " . $row['Priezvisko'] . "</h2></div>
                            <div class=\"col-sm-12 info\"><h4>Pracovisko: </h4><h4>" . $row['Názov'] . "</h4></div>
                            <div class=\"col-sm-12 info\"><h4>Miestnosť: </h4><h4>" . $row['miestnost'] . "</h4></div>
                            <div class=\"col-sm-12 info\"><h4>Telefón: </h4><h4>" . $row['telefon'] . "</h4></div>
                            <div class=\"col-sm-12 info\"><h4>Funkcia: </h4><h4>" . $row['Nazov'] . "</h4></div>
                        </div>
                    </div>
                    <div class=\"col-sm-3 full-height\">
                        <div class=\"messege-send\" onclick=\"sendMSG('Text')\">
                            <span class=\"glyphicon glyphicon-envelope msg-icon\"></span>
                        </div>
                    </div>
                </div>
    ";
}
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>