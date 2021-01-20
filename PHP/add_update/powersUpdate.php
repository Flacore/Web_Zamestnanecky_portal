<?php
include "../config.php";

$sql = mysqli_query($con, "select * from pozícia");
$i = 0;
while ($rows = $sql->fetch_assoc()) {
    $data[$i] = $rows;
    ++$i;
}
if(isset($_POST["but_add"])) {
    for ($j = 0; $j <= $i; $j++) {
        $id = $_POST['id_' . ($j + 1)];
        $nazov = $_POST['name_' . ($j + 1)];
        $odstran =  checkbox($_POST['odst_' . ($j + 1)]);
        if($id==1 ){
            $nazov="admin";
            $odstran=false;
        }
        if($j==$i){
            $odstran=false;
        }
        $Kontakty =  checkbox($_POST['cont_' . ($j + 1)]);
        $kurzy =  checkbox($_POST['curs_' . ($j + 1)]);
        $Kariera =  checkbox($_POST['care_' . ($j + 1)]);
        $blog =  checkbox($_POST['blog_' . ($j + 1)]);
        $pravomoci = checkbox($_POST['powr_' . ($j + 1)]);
        if ($j < $i){
            if(!$odstran) {
                $sql = "UPDATE pozícia SET Kontakty='$Kontakty', Kurzy='$kurzy',Kariera='$Kariera',Blog='$blog',Pravomoci='$pravomoci',Nazov='$nazov' where  idPozícia='" . $id . "'";
            }else{
                $sql ="DELETE FROM pozícia WHERE idPozícia='$id'";
            }
            $con->query($sql);
        }else{
            if($nazov!=null){
            $sql = "INSERT into pozícia (idPozícia,Kontakty,Kurzy,Kariera,Blog,Pravomoci,Nazov)Values ('$id','$Kontakty','$kurzy','$Kariera','$pravomoci','$blog','$nazov')";
            mysqli_query($con,$sql);
            }
        }
    }
header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
}

function checkbox($var){
    if($var == 'on'){
        return 1;
    }
    return 0;
}

?>
