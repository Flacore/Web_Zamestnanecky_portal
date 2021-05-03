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
        <?php
        if($info['Kurzy']==1){
            echo "
        <br>
        <div style=\"width: 200px;\" class=\"center\">
            <div style=\"float: left;\" id=\"newCurse\" class=\"newMessege\" onclick=\"create_curse()\">
                <span class=\"glyphicon glyphicon-plus\"></span>
            </div>
            <div style=\"float: right;\" id=\"My_Curses\" class=\"newMessege\" onclick=\"my_curse()\">
                <span class=\"glyphicon glyphicon-list\"></span>
            </div>
        </div>
        ";
        }
        ?>
        <br>
        <div class="position tableStyle">
            <br><br><br>
            <?php
            $sql = mysqli_query($con, "select *,celoziv_vzdel.popis as descr from celoziv_vzdel left join subor on(Subor_idSubor=idSubor) where os_udaje_rod_cislo<>'".$id."' and datum > CURRENT_DATE order by datum asc");
            $num = mysqli_query($con, "select count(*) as NumberData from celoziv_vzdel where os_udaje_rod_cislo<>'".$id."' and datum > CURRENT_DATE");
            $num_row=mysqli_fetch_array($num);
            $n=$num_row['NumberData'];
            $i = 0;
            while ($rows = $sql->fetch_assoc()){
                $data[$i]=$rows;
                ++$i;
            }

            if($n>0) {
                echo "       
                      <table>
                        <tr>
                            <th>Datum</th>
                            <th>Nazov</th>
                            <th>Miesto</th>
                            <th>Cena</th>
                        </tr>";
                for ($i = 0; $i < $n; $i++) {
                    $row = $data[$i];
                    if(true) {
                        if($row['cena']==null || $row['cena']==0)
                            $cena="n/a";
                        else
                            $cena=$row['cena'];
                        echo "               
                             <tr onclick=\"tableDetail('kurzDetail".$i."')\">
                                    <td>". date('d.m.Y',strtotime($row['datum']))."</td>
                                    <td>".$row['nazov']."</td>
                                    <td>".$row['miesto']."</td>
                                    <td>".$cena." €</td>
                                </tr>
                                <tr class=\"detailHide detail\" id=\"kurzDetail".$i."\">
                                    <td colspan=\"4\">
                                        <div  class=\"divWhite\">
                                           <div class=\"col-sm-6\">
                                               <br>
                                               ";
                        if($row['cesta']!=null) {
                            echo "<img alt=\"\" class=\"imgWidth imgStyle\" src=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/Server" . $row['cesta'] . "\">";
                        } else {
                        echo "<img alt=\"\" class=\"imgWidth imgStyle\" src=\"\">";
                        }
                        echo"
                                               <br><br>
                                           </div>
                                            <div class=\"col-sm-6 \">
                                                <br>
                                                <h3>".$row['nazov']."</h3>
                                                <p class=\"txtJustify\">
                                                    ".$row['descr']."
                                                </p>
                                                <button class=\"btn\" onclick=\"Registration('".$row['idprednasky']."','".$id."')\">Prihlásiť sa</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                        ";
                    }
                }
                echo "
                    </table>";
            }else{
                echo " 
                    <h2 class=\"txtCenter txtBlack\">Ľutujeme, momentálne niesu dostupné žiadne kurzy alebo prednášky.</h2>
                ";
            }
            ?>
            <h5 class="txtCenter txtBlack txtFullWidth txtInfo">
                *Prihlasovanie na kurzy nie je závezné a však by sme vás chceli
                poprosiť aby ste tak ku nemu pristupovaly.
            </h5>
        </div>
        <br><br><br>
    </div>
    <script>

        function create_curse() {
            let modal = document.getElementById("modal_curses");
            modal.style.display = "block";
            document.getElementById("ad_curse").classList.remove('hidden');
            document.getElementById("my_curses").classList.add('hidden');
            document.getElementById("curses_loged").classList.add('hidden');
        }

        function my_curse() {
            let modal = document.getElementById("modal_curses");
            modal.style.display = "block";
            document.getElementById("ad_curse").classList.add('hidden');
            document.getElementById("my_curses").classList.remove('hidden');
            document.getElementById("curses_loged").classList.add('hidden');
        }

        function Registration($prednaska,$login) {
            $.post("http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/add_userCurses_registration.php",{ prednaska_id: $prednaska, login_id: $login} ,function(data) {
                alert("Prihlásenie prebehlo úspešne!")
                $("#componentWindow").load("SystemComponents/Home_Component.php");
                active(1);
            });
        }

        function tableDetail($name) {
            if(document.getElementById($name).classList.contains("detailHide")){
                var x, i;
                x = document.querySelectorAll(".detail");
                for (i = 0; i < x.length; i++) {
                    x[i].classList.add('detailHide');
                }
                document.getElementById($name).classList.remove("detailHide");
            }else{
                document.getElementById($name).classList.add("detailHide");
            }
        }
    </script>
</body>