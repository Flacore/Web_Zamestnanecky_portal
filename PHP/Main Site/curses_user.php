<?php
include "../config_DB.php";

if(isset($_POST["but_add"])) {
    $rod_cislo=$_POST['rod_cislo'];
    $id=$_POST['idPrednasky'];

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

    if($o==0) {
        $sql_query = "INSERT INTO os_udaje (rod_cislo,titul_pred,titul_za,Meno, Priezvisko,miestnost)
         VALUES ('$rod_cislo','$titul_pred','$titul_za','$meno','$priezvisko','-1')";

        if (mysqli_query($con, $sql_query)) {

            $sql_query = "INSERT INTO prihlaseny (os_udaje_rod_cislo, prednasky_idprednasky)
            VALUES ('$rod_cislo','$id')";
            if (mysqli_query($con, $sql_query)) {
                header('Location: ../../HTML/Main_Site.php');
            } else {
                echo "Doslo ku chybe";
            }
        } else {
            echo "Doslo ku chybe";
        }
    }
    header('Location: ../../HTML/Main_Site.php');
}else{
    echo "Doslo ku chybe";

    header('Location: ../../HTML/Main_Site.php');
}
?>