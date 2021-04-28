<?php
include "../../PHP/config_DB.php";
$id=$_POST['id'];

$sql = mysqli_query($con, "select * from prihlaseny join os_udaje on(os_udaje_rod_cislo = rod_cislo) where  prednasky_idprednasky='".$id."'");
$i = 0;
while ($rows = $sql->fetch_assoc()){
    $data[$i]=$rows;
    ++$i;
}

if($i>0) {
    echo "       
               <div class=\"position tableStyle\">
                    <table>
                        <tr>
                            <th>Meno Priezvisko</th>
                            <th>Rodné číslo</th>
                        </tr>
                        <div>";
    $n=$i;
    for ($i = 0; $i < $n; $i++) {
        $row = $data[$i];
            echo "               
                         <div>
                                <tr>
                                    <td>".$row['titul_pred'].". ".$row['Meno']." ".$row['Priezvisko'].", ".$row['titul_za']."</td>
                                    <td>
                                        ".substr($row['rod_cislo'],0,6)."/".substr($row['rod_cislo'],6,4)."
                                    </td>
                                </tr>
                            </div>
                        ";
    }
    echo "
                        </div>
                    </table>
                </div>";
}else{
    echo " 
                    <h2 class=\"txtCenter txtBlack\">Zatiaľ žiadny prihlásený.</h2>
                ";
}
?>