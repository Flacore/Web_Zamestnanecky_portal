<?php
include "../config_DB.php";

$idSkupina=$_POST['id'];

$sql = mysqli_query($con, "select * from subor where Zalozka_idZalozka = '".$idSkupina."' order by vytvorenie desc");
$i = 0;
while ($rows = $sql->fetch_assoc()) {
    $data[$i] = $rows;
    ++$i;
}

echo "<div class=\"link_button\" onclick=\"open_modal_file('idSubor_file','".$idSkupina."')\"><span class=\"button_icon glyphicon glyphicon-plus\"></span></div><br>";
if($i>0){
    for($n=0;$n<$i;$n++){
        $data_na_rozdelenie=$data[$n];
        $idSubor=$data_na_rozdelenie['idSubor'];
        $Nazov=$data_na_rozdelenie['nazov'];
        $Cesta=$data_na_rozdelenie['cesta'];
        $Datum=$data_na_rozdelenie['vytvorenie'];
        $popis=$data_na_rozdelenie['popis'];
        echo "
        <div class='item_DownloadList'>
              <div class='row'>
                <div class='col-sm-12'><h3>".$Nazov."</h3></div>
              </div>
              <div class='row'>
                <div class='col-sm-8'><h5>".$popis."</h5></div>
                <div class='col-sm-4'>
                    <button onclick=\" location.href='http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/ftp/Download_file.php?cesta=".$Cesta."'\">Stiahnuť</button>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12'><h6>".$Datum."</h6></div>
              </div>
         </div>";
    }
}else{
    echo "<h3 class='txtCenter'>Ľutujeme nenašla sa žiaden súbor na sťiahnuťie.</h3>";
}
echo "";
?>