<?php
include "../config_DB.php";

$sql = mysqli_query($con, "select * from funkcie");
$i = 0;
while ($rows = $sql->fetch_assoc()) {
    $data[$i] = $rows;
    ++$i;
}
if(isset($_POST["but_add"]) && isset($_SESSION['session'])) {
    for ($j = 1; $j <= $i; $j++) {

        $id = $_POST['id_' . ($j + 1)];
        $nazov = $_POST['name_' . ($j + 1)];
        $odstran =  checkbox('odst_' . ($j + 1));

        if($id==1 ){
            $nazov="admin";
            $odstran=false;
        }
        if($j==$i){
            $odstran=false;
        }

        $Kontakty =  checkbox('cont_' . ($j + 1));
        $kurzy =  checkbox('curs_' . ($j + 1));
        $Kariera =  checkbox('care_' . ($j + 1));
        $blog =  checkbox('blog_' . ($j + 1));
        $pravomoci = checkbox('powr_' . ($j + 1));
        $zalozky =  checkbox('zal_' . ($j + 1));
        $dokumenty =  checkbox('dok_' . ($j + 1));
        $dotaznik =  checkbox('dot_' . ($j + 1));
        $inzercia = checkbox('inz_' . ($j + 1));
        $miesta = checkbox('mie_' . ($j + 1));
        $detail = checkbox('det_' . ($j + 1));

        if ($j < $i){
            if(!$odstran) {
                $sql="UPDATE funkcie set Nazov='$nazov' where idPozícia='".$id."'";
                $con->query($sql);
                $sql = "UPDATE pravomoci SET Detail_info='$detail', Kontakty='$Kontakty', Kurzy='$kurzy',Kariera='$Kariera',Blog='$blog',Pravomoci='$pravomoci',Zalozky='$zalozky',Miesta='$miesta'
                        , Dokumenty='$dokumenty',Dotazniky='$dotaznik',Inzercia='$inzercia' where  funkcie_idPozícia='" . $id . "'";
                $con->query($sql);
            }else{
                $sql = mysqli_query($con, "select rod_cislo from os_udaje join prirad_funkcia on(os_udaje_rod_cislo=rod_cislo) where funkcie_idPozícia='".$id."' and do is null");
                while ($rows = $sql->fetch_assoc()) {
                    $rod_cislo=$rows['rod_cislo'];
                    $sql="UPDATE prirad_funkcia set do=current_date where do is null and os_udaje_rod_cislo='".$rod_cislo."'";
                    $con->query($sql);

                    $sql = mysqli_query($con, "select * from prirad_funkcia");
                    $k = 0;
                    while ($rows = $sql->fetch_assoc()) {
                        $data = $rows;
                        if($k<$data['zaznam'])
                            $k=$data['zaznam'];
                    }
                    $num=$k+1;

                    $sql = "INSERT into prirad_funkcia (zaznam, funkcie_idPozícia, os_udaje_rod_cislo, od)
                    Values ('$num','2','$rod_cislo',current_date )";
                    mysqli_query($con,$sql);

                    $sql = mysqli_query($con, "select * from notifikacia");
                    $k = 0;
                    while ($rows = $sql->fetch_assoc()) {
                        $data = $rows;
                        if($k<$data['idNotifikacia'])
                            $k=$data['idNotifikacia'];
                    }
                    $idNotif = $k+1;
                    $text='Vaša pozícia bola zmenena.';
                    $sql = "INSERT into notifikacia (idNotifikacia, text, datum, Videne, os_udaje_rod_cislo)Values ('$idNotif','$text',CURRENT_DATE,'0','$rod_cislo' )";
                    mysqli_query($con, $sql);
                }

                $sql ="DELETE FROM funkcie WHERE idPozícia='$id'";
                $con->query($sql);
                $sql ="DELETE FROM pravomoci WHERE funkcie_idPozícia='$id'";
                $con->query($sql);
            }
        }else{
            if($nazov!=null){
                $sql = "INSERT into funkcie (idPozícia, Nazov)
            Values ('$id','$nazov')";
                mysqli_query($con,$sql);
            $sql = "INSERT into pravomoci (funkcie_idPozícia,Kontakty,Kurzy,Kariera,Blog,Pravomoci,Zalozky,Dokumenty,Dotazniky,Inzercia,Miesta,Detail_info)
            Values ('$id','$Kontakty','$kurzy','$Kariera','$pravomoci','$blog','$zalozky','$dokumenty','$dotaznik','$inzercia','$miesta','$detail')";
            mysqli_query($con,$sql);
            }
        }
    }

header('Location: http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php');
}

function checkbox($var){
    if(isset($_POST[$var])){
        return 1;
    }
    return 0;
}

?>
