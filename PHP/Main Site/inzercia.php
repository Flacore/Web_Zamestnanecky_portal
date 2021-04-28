<?php
include "../../PHP/config_DB.php";
$id=0;
$id=$_POST['id'];
if($_POST['typ']==1){
    //prvky v kategorii
    if($id>=0)
        $sql = mysqli_query($con, "SELECT * FROM inzerat left join subor on(inzerat.id_inzerat = subor.inzerat_id_inzerat) where kategoria_id_kategoria='".$id."' order by inzerat.vytvorenie desc");
    else
        $sql = mysqli_query($con, "SELECT * FROM inzerat left join subor on(inzerat.id_inzerat = subor.inzerat_id_inzerat) where kategoria_id_kategoria is null order by inzerat.vytvorenie desc");
    $k = 0;
    while ($rows = $sql->fetch_assoc()) {
        $_data[$k] = $rows;
        ++$k;
    }
    if($k>=1) {
        for($n=0;$n<$k;$n++) {
            $row = $_data[$n];
            if ($row['cesta'] == null) {
                echo "<div onclick='showDetail_inz(" . $row['id_inzerat'] . ")'>
                <img  class='img' src=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/Server/inzercia/unz.png\" alt=\"img\">
                <h3 class='center'>" . $row['Titulok'] . "</h3>
                <p class='center'>" . $row['Popis'] . "</p>
                </div>";
            } else {
                echo "<div onclick='showDetail_inz(" . $row['id_inzerat'] . ")'>
                <img   class='img' src=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/Server".$row['cesta']."\" alt=\"img\">
                <h3 class='center'>" . $row['Titulok'] . "</h3>
                <p class='center'>" . $row['Popis'] . "</p>
                </div>";
            }
            echo "<hr>";
        }
    }else{
        echo "<h3>V kategórii sa nenachádzajú žiadne inzeráty.</h3>";
    }
}else{
    //detail prvku
    $sql = mysqli_query($con, "SELECT * FROM inzerat left join subor on(inzerat.id_inzerat = subor.inzerat_id_inzerat) where id_inzerat='".$id."'");
    $k = 0;
    while ($rows = $sql->fetch_assoc()) {
        $iz_data[$k] = $rows;
        ++$k;
    }
    if($k!=0) {
        $row_iz = $iz_data[0];
        $sql = mysqli_query($con, "SELECT ou.Meno, ou.Priezvisko,k1.telefon,k1.email,lo.login
        from os_udaje ou
        left join kontakt k1 on(ou.rod_cislo=k1.os_udaje_rod_cislo)
        join login lo on(lo.OS_udaje_rod_cislo=ou.rod_cislo)
        where rod_cislo='".$row_iz['os_udaje_rod_cislo']."'");
        $k = 0;
        while ($rows = $sql->fetch_assoc()) {
            $os_data[$k] = $rows;
            ++$k;
        }
        $row_os=$os_data[0];
        if ($row_iz['cesta'] == null) {
            echo "<img   class='img' src=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/Server/inzercia/unz.png\" alt=\"img\">";
        } else {
            echo "<img   class='img' src=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/Server".$row_iz['cesta']."\" alt=\"img\"
                     onClick=\"window.open(this.src)\" role=\"button\" tabIndex=\"0\">";
        }
        echo"   <h3 class='center'>" . $row_iz['Titulok'] . "</h3>
                <p class='center'>" . $row_iz['Popis'] . "</p>
                <p class='center'>".$row_os['Meno']." ".$row_os['Priezvisko']."</p>";

        if($row_os['email'] == null){
            echo "<p class='center'>".$row_os['Login']."@uniza.sk</p>";
        }else{
            echo "<p class='center'>".$row_os['email']."</p>";
            //Zobraz skolsky mail
        }

        if($row_os['email'] != null && $row_iz['zobraz_telefon']!=null){
            echo "<p class='center'>".$row_os['telefon']."</p>";
        }

        if($row_iz['cenovka'] != null){
            echo "<p class='center'>".$row_iz['cenovka']." €</p>";
        }else{
            echo "<p class='center'>Nedefinovaná cena</p>";
        }

    }else{
        echo "<h3>Došlo ku chybe!</h3>";
    }
}

