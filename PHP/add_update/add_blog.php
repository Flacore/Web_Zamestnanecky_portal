<?php
include "../config.php";
$id_Login=$_SESSION['session'];

if(isset($_POST["but_submit"])) {
    $id_uzivatel=null;
    $id_blog=null;
    $typ=$_POST['typ'];
    $verejnost=$_POST['verejnost'];
    $nadpis=$_POST['nadpis'];
    $predtext=$_POST['predtext'];
    $text=$_POST['text'];

    $sql = mysqli_query($con, "select * from uzivatel join login on login.idLogin=uzivatel.Login_idLogin where login.idLogin='".$id_Login."'");
    $k = 0;
    while ($rows = $sql->fetch_assoc()){
        $_data[$k]=$rows;
        ++$k;
    }
    $info=$_data[0];
    $id_uzivatel=$info['idUzivatel'];

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

    $sql = "INSERT into blog (idBlog,aktualita,verejne,nadpis,predtext,text,datum,Uzivatel_idUzivatel) Values ('$id_blog','$typ','$verejnost','$nadpis','$predtext','$text',CURRENT_DATE,'$id_uzivatel')";
    mysqli_query($con, $sql);
}
header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
?>