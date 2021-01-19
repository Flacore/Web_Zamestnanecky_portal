<?php include "../../PHP/config.php"; ?>
<body>
    <div class="container" id="kurzy">
        <div class="position tableStyle">
            <br><br><br>
            <h2 class="txtCenter txtBlack txtFullWidth">
                Zoznam kurzov a prednášok
            </h2>
            <h4 class="txtCenter txtBlack txtFullWidth">
                Každoročne organizujeme kopu prednášok a vzdelávacích kurzov, ktorých sa môže zúčastniť úplne každý...
            </h4>
            <br>
            <?php
            $sql = mysqli_query($con, "select * from prednasky ");
            $num = mysqli_query($con, "select count(*) as NumberData from prednasky");
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
                    if($row['verejne']!=0) {
                        if($row['cena']==null)
                            $cena="n/a";
                        else
                            $cena=row['cena'];
                        echo "               
                             <tr onclick=\"tableDetail('kurzDetail".$i."')\">
                                    <td>".$row['datum']."</td>
                                    <td>".$row['nazov']."</td>
                                    <td>".$row['miesto']."</td>
                                    <td>".$cena."</td>
                                </tr>
                                <tr class=\"detailHide detail\" id=\"kurzDetail".$i."\">
                                    <td colspan=\"4\">
                                        <div  class=\"divWhite\">
                                           <div class=\"col-sm-6\">
                                               <br>
                                               <img alt=\"\" class=\"imgWidth imgStyle\" src=\"".$row['picture_url']."\">
                                               <br>
                                           </div>
                                            <div class=\"col-sm-6 \">
                                                <br>
                                                <h3>".$row['nazov']."</h3>
                                                <p class=\"txtJustify\">
                                                    ".$row['popis']."
                                                </p>
                                                <button class=\"btn\" onclick=\"showRegistrationGuest(".$row['idprednasky'].")\">Prihlásiť sa</button>
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
            <h5 class="txtCenter txtWhite txtFullWidth txtInfo">
                *Prihlasovanie na kurzy nie je závezné a však by sme vás chceli
                poprosiť aby ste tak ku nemu pristupovaly.
            </h5>
        </div>
        <br><br><br>
    </div>
    <script>

        function tableDetail($name) {
            if(document.getElementById($name).classList.contains("detailHide")){
                document.getElementById($name).classList.remove("detailHide");
            }else{
                document.getElementById($name).classList.add("detailHide");
            }
        }
    </script>
</body>