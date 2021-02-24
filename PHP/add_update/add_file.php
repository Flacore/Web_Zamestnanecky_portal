<?php
    include "../ftp/Upload_file.php";
    include "../config_DB.php";

    if(isset($_POST['button_file'])) {
        $idSubor = null;
        $nazov = $_POST['name'];
        $subor = $_FILES;
        $cesta_subor = null;
        $popis = $_POST['description'];
        $idZalozka = $_POST['idSubor'];
        $idPozicia = $_POST['idPozicia'];
        $idPrednask = $_POST['idPrednaska'];

        $server_dir = "/";
        if($idZalozka==null && $idPozicia==null)
            $server_dir="/prednaska_fotky/";
        if($idPrednask==null && $idPozicia==null)
            $server_dir="/dokumenty_tlaciva/";
        if($idZalozka==null && $idPrednask==null)
            $server_dir="/pozicia_dokumenty/";

        upload_file($subor,$server_dir);

        //Vloz
        $sql = mysqli_query($con, "select * from subor");
        $n = 0;
        while ($rows = $sql->fetch_assoc()) {
            $info = $rows;
            if($n<$info['idSubor'])
                $n=$info['idSubor'];
        }
        $idSubor = $n + 1;

        alert($idSubor);

        $cesta_subor=$server_dir.$subor['file_path']['name'];

        if($idZalozka==null && $idPozicia==null)
            $sql = "INSERT into subor (idSubor, nazov, cesta, vytvorenie, popis, prednasky_idprednasky) Values ('$idSubor','$nazov','$cesta_subor',CURRENT_DATE,'$popis','$idPrednask')";

        if($idPrednask==null && $idPozicia==null)
            $sql = "INSERT into subor (idSubor, nazov, cesta, vytvorenie, popis, Zalozka_idZalozka) Values ('$idSubor','$nazov','$cesta_subor',CURRENT_DATE,'$popis','$idZalozka')";

        if($idZalozka==null && $idPrednask==null)
            $sql = "INSERT into subor (idSubor, nazov, cesta, vytvorenie, popis, Pozícia_idPozícia) Values ('$idSubor','$nazov','$cesta_subor',CURRENT_DATE,'$popis','$idPozicia')";

        mysqli_query($con, $sql);
    }
header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>