<?php
include "../config_DB.php";

if(isset($_POST["but_add"])) {
    $rod_cislo=$_POST['rod_cislo'];
    $id=$_POST['idPrednasky'];

    $sql = mysqli_query($con, "SELECT * FROM kontakt ");
    $i = 0;
    while ($rows = $sql->fetch_assoc()){
        $data[$i]=$rows;
        ++$i;
    }
    $row = $data[$i-1];
    $idUzivatel=($row['idUzivatel'])+1;

    $sql = mysqli_query($con, "SELECT * FROM os_udaje ");
    $i = 0;
    while ($rows = $sql->fetch_assoc()){
        $data[$i]=$rows;
        ++$i;
    }
    $row = $data[$i-1];
    $idOS_udaje=($row['idOS_udaje'])+1;

    $sql = mysqli_query($con, "SELECT * FROM os_udaje where rod_cislo='".$rod_cislo."'");
    $o = 0;
    while ($rows = $sql->fetch_assoc()){
        $data[$i]=$rows;
        ++$o;
    }

    $titul_pred=$_POST['titul_pred'];
    $titul_za=$_POST['titul_za'];
    $priezvisko=$_POST['txt_sname'];
    $meno=$_POST['txt_name'];
    $email=$_POST['mail'];
    $telefon=$_POST['telephone'];

    if($o==0) {
        $sql_query = "INSERT INTO os_udaje (rod_cislo,Meno, titul_pred, Priezvisko, titul_za)
         VALUES ('$idOS_udaje','$meno','$priezvisko','$email','$telefon')";

        if (mysqli_query($con, $sql_query)) {
            $sql_query = "INSERT INTO kontakt (idkontakt,priorita,email,telefon,os_udaje_rod_cislo)
             VALUES ('$idUzivatel','1','$email','$telefon','$idOS_udaje')";
            if (mysqli_query($con, $sql_query)) {
            } else {
                echo "Doslo ku chybe";
            }
        } else {
            echo "Doslo ku chybe";
        }
    }

    $sql_query = "INSERT INTO prihlaseny (os_udaje_rod_cislo, prednasky_idprednasky)
        VALUES ('$rod_cislo','$id')";
    if (mysqli_query($con, $sql_query)) {
        header('Location: ../../HTML/Main_Site.php');
    } else {
        echo "Doslo ku chybe";
    }


}else{
    echo "Doslo ku chybe";
}
?>