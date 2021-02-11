<?php
include "../config.php";

$id_uziv=$_SESSION['session'];
$id=$_POST['id'];

$sql = mysqli_query($con, "select * from uzivatel where idUzivatel='" . $id_uziv . "' ");
$k = 0;
while ($rows = $sql->fetch_assoc()) {
    $_data[$k] = $rows;
    ++$k;
}
$info = $_data[0];
$ja_id = $info['idUzivatel'];

$dta = mysqli_query($con, "select count(*) as Numbers from precitane_blog  where Blog_idBlog ='".$id."' and Uzivatel_idUzivatel='".$ja_id."'");
$row = mysqli_fetch_array($dta);
$count = $row['Numbers'];
if($count==0){
    $sql = "INSERT into precitane_blog (Uzivatel_idUzivatel,Blog_idBlog) Values ('$ja_id','$id')";
    mysqli_query($con, $sql);
}

$sql = mysqli_query($con, "SELECT * FROM blog join (uzivatel join os_udaje) where idBlog='".$id."' ");
$i = 0;
while ($rows = $sql->fetch_assoc()){
    $data[$i]=$rows;
    ++$i;
}
$row=$data[0];
echo "
        <div class='blog-top'>
            <div class=\"col-md-12 info-blog\">
                <h2>".$row['nadpis']."</h2>
            </div>
            <div class=\"col-md-12 predtext\">
                <h5>".$row['predtext']."</h5>
            </div>
            <div class=\"col-md-12 text\">
                <h5>".$row['text']."</h5>
            </div>
        </div>
        <div class=\"msg-textForm blog-bottom\">
            <div class=\"col-sm-12 info-blog\">
                <div class=\"col-md-6\">
                    <h5>".$row['Meno']." ".$row['Priezvisko']."</h5>
                </div>
                <div class=\"col-md-6\">
                    <h5>".$row['datum']."</h5>
                </div>
            </div>
        </div>

";
?>
