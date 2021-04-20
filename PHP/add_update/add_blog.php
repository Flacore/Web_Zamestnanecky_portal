<?php
include "../config_DB.php";
$id_uzivatel=$_SESSION['session'];

if(isset($_POST["but_submit"])) {
    $id_blog=null;
    $typ=$_POST['typ'];
    $verejnost=$_POST['verejnost'];
    $nadpis=$_POST['nadpis'];
    $predtext=$_POST['predtext'];
    $text=$_POST['text'];

    $sql=mysqli_query($con,"select * from blog");
    $n = 0;
    while ($rows = $sql->fetch_assoc()){
        $_data[$k]=$rows;
        ++$n;
    }
    $id_blog=$n+1;

    if($typ==0){
        $text="";
    }

    $sql = "INSERT into blog (idBlog,aktualita,verejne,nadpis,predtext,text,datum,os_udaje_rod_cislo) Values ('$id_blog','$typ','$verejnost','$nadpis','$predtext','$text',CURRENT_DATE,'$id_uzivatel')";
    mysqli_query($con, $sql);
}
header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
?>