   <?php
include "../config_DB.php";
include "../ftp/Upload_file.php";
$rod_cislo=$_SESSION['session'];
$povodny=$_POST['povodny'];
if(isset($_SESSION['session'])){
    $sql = "Delete from subor where idSubor='" . $povodny . "'";
    $con->query($sql);

    $sql = mysqli_query($con, "select * from subor");
    $n = 0;
    while ($rows = $sql->fetch_assoc()) {
        $info = $rows;
        if($n<$info['idSubor'])
            $n=$info['idSubor'];
    }
    $idSubor = $n + 1;

    $subor = $_FILES;
    $server_dir="/user_cv/".$rod_cislo."/";
    $subor['file_path']['name']=$idSubor.''.$subor['file_path']['name'];
    $cesta_subor=upload_file($subor,$server_dir);
    $sql = "INSERT into subor (idSubor, nazov, cesta, vytvorenie) Values ('$idSubor','$rod_cislo','$cesta_subor',CURRENT_DATE)";
    mysqli_query($con, $sql);

    $sql = "UPDATE os_udaje SET subor_CV='".$idSubor."' WHERE rod_cislo='".$rod_cislo."'";
    mysqli_query($con, $sql);
}
header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
?>