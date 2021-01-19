<?php
include "../config.php";

$sql = mysqli_query($con, "select * from pozícia");
$i = 0;
if(isset($_POST["but_add"])) {
while ($rows = $sql->fetch_assoc()){
    $data[$i]=$rows;
    ++$i;
}

for ($j = 0; $j<=$i; $j++) {
    $id=$_POST['id_'.($j+1)];
    $nazov = $_POST['name_'.($j+1)];
    $Kontakty=$_POST['name_'.($j+1)];
    $kurzy=$_POST['name_'.($j+1)];
    $Kariera=$_POST['name_'.($j+1)];
    $blog=$_POST['name_'.($j+1)];
    $pravomoci=$_POST['name_'.($j+1)];

    if($j<$i)
        $sql = "UPDATE pozícia SET Kontakty=$Kontakty, Kurzy=$kurzy,Kariera=$Kariera,Blog=$blog,Pravomoci=$pravomoci,Nazov=$nazov where  idPozícia=$id";
   else
       $sql = "INSERT into pozícia SET (idPozícia,Kontakty,Kurzy,Kariera,Blog,Pravomoci,Nazov)
        Values ($id,$Kontakty,$kurzy,$Kariera,$nazov,$pravomoci,$blog)";
    $con->query($sql);

}
    $con->close();
}else{
    e
}
    ?>
