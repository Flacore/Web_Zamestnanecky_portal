<?php
    include "../config_DB.php";
include "../ftp/Upload_file.php";
    if(!isset($_SESSION['session'])){
        header('Location: Main_Site.php');
    }
    $id=$_POST['id_path'];
    $id2=$_POST['prev'];
    $result=0;
    $sql = mysqli_query($con, "select * from subor");
    $n = 0;
    while ($rows = $sql->fetch_assoc()) {
        $info = $rows;
        if($n<$info['idSubor'])
            $n=$info['idSubor'];
    }
    $id_subor = $n + 1;
    $nazov='quiz_file';
    $file=$_FILES;
    $server_dir="/dotaznik/";
    $cesta_subor=upload_file($file,$server_dir);
    $sql = "INSERT into subor (idSubor, nazov, cesta, vytvorenie) Values ('$id_subor','$nazov','$cesta_subor',CURRENT_DATE)";
    mysqli_query($con, $sql);
    if($cesta_subor!=null)
        $result = 1;
    sleep(1);
?>
<script language="javascript" type="text/javascript">
    window.top.window.stopUpload(<?php echo $result; ?>,<?php echo $id_subor; ?>,<?php echo $id; ?>,<?php echo $id2; ?>);
</script>
