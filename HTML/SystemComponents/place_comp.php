<?php include "../../PHP/config_DB.php";
$id=$_SESSION['session'];
$sql = mysqli_query($con, "
            SELECT * from os_udaje ou
            join prirad_funkcia pf on(ou.rod_cislo = pf.os_udaje_rod_cislo)
            join pravomoci po on(po.funkcie_idPozícia = pf.funkcie_idPozícia)
            where pf.do is null and ou.rod_cislo ='".$id."'
        ");
$info = $sql->fetch_assoc();
?>
<body>
<div class="container" id="kurzy">
    <br>
    <?php

    echo "
        <div class=\"inzercia_menu center\">";
    if($info['Miesta']==1){
        echo"
            <div class=\"newMessege iz_category\" onclick=\"add_place()\">
                <span class=\"glyphicon glyphicon-plus\"</span>
            </div>";
    }
    echo"
        </div>
        ";

    ?>
    <div class="position tableStyle">
        <br><br><br>
        <?php
        $sql = mysqli_query($con, "select idPracovisko,Názov,count(rod_cislo) as pocet from pracovisko left join os_udaje on(idPracovisko=Pracovisko_idPracovisko) group by idPracovisko order by idPracovisko asc");
        $i = 0;
        while ($rows = $sql->fetch_assoc()){
            $data[$i]=$rows;
            ++$i;
        }
        $n=$i;

        if($n>0 && $info['Miesta']==1) {
            echo "       
                      <table>
                        <tr>
                            <th>Názov</th>
                            <th>Počet zamestnancov</th>
                            <th></th>
                        </tr>";
            for ($i = 0; $i < $n; $i++) {
                $row = $data[$i];
                if(true) {
                    echo "               
                             <tr onclick=\"tableDetail('kurzDetail".$i."')\">
                                    <td>".$row['Názov']."</td>
                                    <td>".$row['pocet']."</td>";
                    if($row['Názov']!="Ostatné" && $row['idPracovisko']!='1')
                        echo "              <td><button onclick=\"delete_place('".$row['idPracovisko']."')\" class=\"carier-btn\">Vymazať</button></td>";
                    else
                        echo "              <td></td>";
                    echo"            </tr>";
                }
            }
            echo "
                    </table>";
        }else{
            echo " 
                    <h2 class=\"txtCenter txtBlack\">Ľutujeme, nieje vytvorené žiadne miesto.</h2>
                ";
        }
        ?>
    </div>
    <br><br><br>
</div>
<script>
    function delete_place(id) {
        $.ajax({
            type: 'POST',
            data: {id: id},
            url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/delete_place.php',
            success: function(data) {
                location.reload();
            }
        });
    }

    function add_place() {
        let modal = document.getElementById("modal_place");
        modal.style.display = "block";
    }

</script>
</body>