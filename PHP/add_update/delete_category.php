<?php
include "../../PHP/config_DB.php";
$id=$_POST['id'];
if(isset($_SESSION['session'])){

    $sql = mysqli_query($con, "select * from inzerat left join kategoria on(kategoria.id_kategoria=inzerat.kategoria_id_kategoria) where kategoria_id_kategoria='".$id."'");
    $n = 0;
    while ($rows = $sql->fetch_assoc()) {
        $data[$n]=$rows;
        $n++;
    }
    for ($i=0;$i<$n;$i++) {
        $row=$data[$i];

        $sql = mysqli_query($con, "select * from notifikacia");
        $n = 0;
        while ($rows = $sql->fetch_assoc()) {
            $info = $rows;
            if($n<$info['idNotifikacia'])
                $n=$info['idNotifikacia'];
        }
        $idNotif = $n+1;

        $rod_cislo = $row['os_udaje_rod_cislo'];
        $nazovinz = $row['Titulok'];
        $nazovinz = "Váš inzerát [" . $nazovinz . "] bol presunutý do nezaradených inzerátov z dôvodu vymazania
        kategórie ktorá daný inzerát obsahovala.";
        $sql = "INSERT into notifikacia (idNotifikacia, text, datum, Videne, os_udaje_rod_cislo) 
        Values ('$idNotif','$nazovinz',CURRENT_DATE,'0','$rod_cislo')";
        mysqli_query($con, $sql);
        $sql = "Delete from subor where idSubor='" . $row['Subor_idSubor']. "'";
        $con->query($sql);
    }

    $sql = "UPDATE inzerat SET kategoria_id_kategoria = '-1'  WHERE kategoria_id_kategoria='".$id."'";
    $con->query($sql);

    $sql = "Delete from kategoria where id_kategoria='" . $id . "'";
    $con->query($sql);
}
?>