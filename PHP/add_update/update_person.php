<?php
include "../config_DB.php";
if(isset($_POST['button'])&& isset($_SESSION['session'])) {
    $id = $_POST['id'];
    $pracovisko = $_POST['pracovisko'];
    $funkcia = $_POST['funkcia'];

    $sql = "UPDATE os_udaje SET Pracovisko_idPracovisko='".$pracovisko."'  WHERE rod_cislo ='".$id."'";
    $con->query($sql);

    $sql = "UPDATE prirad_funkcia SET do = CURRENT_DATE  WHERE do is null and OS_udaje_rod_cislo='".$id."'";
    $con->query($sql);

    $sql=mysqli_query($con,"select * from prirad_funkcia");
    $n = 0;
    while ($rows = $sql->fetch_assoc()){
        $_data[$k]=$rows;
        ++$n;
    }
    $id_or=$n+1;
    $sql = "INSERT into prirad_funkcia (zaznam, funkcie_idPozícia, os_udaje_rod_cislo, od)Values ('$id_or','$funkcia','$id',CURRENT_DATE )";
    mysqli_query($con, $sql);

    $sql = mysqli_query($con, "select * from notifikacia");
    $k = 0;
    while ($rows = $sql->fetch_assoc()) {
        $data = $rows;
        if($k<$data['idNotifikacia'])
            $k=$data['idNotifikacia'];
    }
    $idNotif = $k+1;
    $text='Vaša pozícia a pracovisko boli zmenené.';
    $sql = "INSERT into notifikacia (idNotifikacia, text, datum, Videne, os_udaje_rod_cislo)Values ('$idNotif','$text',CURRENT_DATE,'0','$id' )";
    mysqli_query($con, $sql);

    header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
}
?>