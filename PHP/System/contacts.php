<?php
include "../config_DB.php";
$id=$_SESSION['session'];
$sql = mysqli_query($con, "
            SELECT * from os_udaje ou
            join prirad_funkcia pf on(ou.rod_cislo = pf.os_udaje_rod_cislo)
            join pravomoci po on(po.funkcie_idPozícia = pf.funkcie_idPozícia)
            where pf.do is null and ou.rod_cislo ='".$id."'
        ");
$info = $sql->fetch_assoc();
$meno=$_POST['Meno'];
$pracovisko=$_POST['pracovisko'];

if($pracovisko != null || $meno!=null) {
    if ($pracovisko != null && $meno==null)
        $sql = mysqli_query($con, "
        SELECT ou.rod_cislo, ou.Meno,ou.Priezvisko,ou.miestnost, pr.Názov, fu.Nazov, ko.telefon
        FROM os_udaje ou join pracovisko pr on(ou.Pracovisko_idPracovisko=pr.idPracovisko)
        join prirad_funkcia pf on(pf.os_udaje_rod_cislo=ou.rod_cislo)
        join funkcie fu on(fu.idPozícia=pf.funkcie_idPozícia)
        left join kontakt ko on(ko.os_udaje_rod_cislo=ou.rod_cislo)
        WHERE pf.do is null and ko.priorita='1' or ko.priorita is null and LOWER(Názov) like LOWER(\"%" . $pracovisko . "%\")");
    if ($meno != null && $pracovisko==null)
        $sql = mysqli_query($con, "
        SELECT ou.rod_cislo, ou.Meno,ou.Priezvisko,ou.miestnost, pr.Názov, fu.Nazov, ko.telefon
        FROM os_udaje ou join pracovisko pr on(ou.Pracovisko_idPracovisko=pr.idPracovisko)
        join prirad_funkcia pf on(pf.os_udaje_rod_cislo=ou.rod_cislo)
        join funkcie fu on(fu.idPozícia=pf.funkcie_idPozícia)
        left join kontakt ko on(ko.os_udaje_rod_cislo=ou.rod_cislo)
        WHERE pf.do is null and ko.priorita='1' or ko.priorita is null and
        CONCAT(LOWER(ou.Priezvisko),\" \",LOWER(ou.Meno)) LIKE LOWER(\"%" . $meno . "%\") or CONCAT(LOWER(ou.Meno),\" \",LOWER(ou.Priezvisko)) LIKE LOWER(\"%" . $meno . "%\")");
    if ($meno != null && $pracovisko!=null)
        $sql = mysqli_query($con, "
        SELECT ou.rod_cislo, ou.Meno,ou.Priezvisko,ou.miestnost, pr.Názov, fu.Nazov, ko.telefon
        FROM os_udaje ou join pracovisko pr on(ou.Pracovisko_idPracovisko=pr.idPracovisko)
        join prirad_funkcia pf on(pf.os_udaje_rod_cislo=ou.rod_cislo)
        join funkcie fu on(fu.idPozícia=pf.funkcie_idPozícia)
        left join kontakt ko on(ko.os_udaje_rod_cislo=ou.rod_cislo)
        WHERE pf.do is null and ko.priorita='1' or ko.priorita is null and
        (CONCAT(LOWER(ou.Priezvisko),\" \",LOWER(ou.Meno)) LIKE LOWER(\"%" . $meno . "%\") or CONCAT(LOWER(ou.Meno),\" \",LOWER(ou.Priezvisko)) LIKE LOWER(\"%" . $meno . "%\")) and  LOWER(Názov) like LOWER(\"%" . $pracovisko . "%\")");
}
else{
    $sql = mysqli_query($con, "
    SELECT ou.rod_cislo, ou.Meno,ou.Priezvisko,ou.miestnost, pr.Názov, fu.Nazov, ko.telefon
    FROM os_udaje ou join pracovisko pr on(ou.Pracovisko_idPracovisko=pr.idPracovisko)
    join prirad_funkcia pf on(pf.os_udaje_rod_cislo=ou.rod_cislo)
    join funkcie fu on(fu.idPozícia=pf.funkcie_idPozícia)
    left join kontakt ko on(ko.os_udaje_rod_cislo=ou.rod_cislo)
    WHERE pf.do is null and ko.priorita='0' or ko.priorita is null");
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

    if($row['miestnost']==null)
        $row['miestnost']='-';

    if($row['telefon']==null)
        $row['telefon']='-';

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
                    <div class=\"col-sm-1 full-height\">
                        <div class=\"messege-send\" onclick=\"sendMSG('".$row['rod_cislo']."')\">
                        <span class=\"glyphicon glyphicon-envelope msg-icon\">
                            </span>                   
                        </div>
                    </div>";
    if($info['Kontakty']==1) {
        echo " <div class=\"col-sm-1 full-height\">
                        <div class=\"messege-send\" onclick=\"edit_person('" . $row['rod_cislo'] . "')\">
                        <span class=\"glyphicon glyphicon-pencil msg-icon\">
                            </span>                   
                        </div>
                    </div>
                    <div class=\"col-sm-1 full-height\">
                        <div class=\"messege-send\" onclick=\"remove_person('" . $row['rod_cislo'] . "')\">
                        <span class=\"glyphicon glyphicon-remove msg-icon\">
                            </span>                   
                        </div>
                    </div>";

        echo " <div style=\"display=none !important;\" class=\"col-sm-12 full-height\" id='name".$row['rod_cislo']."'>
                        <form>
                            <label>Popis</label>
                        </form>
                    </div>";

    }
               echo" </div>
    ";

}
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>