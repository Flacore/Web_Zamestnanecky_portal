<?php
include "../config_DB.php";
include "../ftp/Upload_file.php";
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
$server_dir="/dotaznik/".$_POST['FormID']."/";
$cesta_subor=upload_file($file,$server_dir);
$sql = "INSERT into subor (idSubor, nazov, cesta, vytvorenie) Values ('$id_subor','$nazov','$cesta_subor',CURRENT_DATE)";
mysqli_query($con, $sql);
if($cesta_subor!=null)
    $result = 1;
sleep(1);
?>
<script language="javascript" type="text/javascript">
    window.top.window.stopUpload(<?php echo $result; ?>,<?php echo $_POST['idPrvok'];?>,<?php echo $_POST['FormID'];?>,<?php echo $id_subor;?>);
</script>
