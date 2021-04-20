<?php
include "../config_DB.php";

$ja_id=$_SESSION['session'];
$id=$_POST['id'];

$dta = mysqli_query($con, "select count(*) as Numbers from precitane_blog  where Blog_idBlog ='".$id."' and os_udaje_rod_cislo ='".$ja_id."'");
$row = mysqli_fetch_array($dta);
$count = $row['Numbers'];
if($count==0){
    $sql = "INSERT into precitane_blog (os_udaje_rod_cislo,Blog_idBlog) Values ('$ja_id','$id')";
    mysqli_query($con, $sql);
}

$sql = mysqli_query($con, "SELECT * FROM blog join os_udaje on(os_udaje_rod_cislo=rod_cislo) where idBlog='".$id."' ");
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
