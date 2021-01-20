<?php include "../../PHP/config.php"; ?>
<body>
    <div class="container" id="prac_pozicie">
        <br><br><br>
        <h2 class="txtCenter txtBlack">Hladáme</h2>
        <br>
        <?php
        $sql = mysqli_query($con, "select * from kariera join pracovisko on kariera.Pracovisko_idPracovisko=pracovisko.idPracovisko ");
        $num = mysqli_query($con, "select count(*) as NumberData from kariera");
        $num_row=mysqli_fetch_array($num);
        $n=$num_row['NumberData'];
        $i = 0;
        while ($rows = $sql->fetch_assoc()){
            $data[$i]=$rows;
            ++$i;
        }

        if($n>0) {
            echo "       
               <div class=\"position tableStyle\">
                    <table>
                        <tr>
                            <th>Dátum</th>
                            <th>Popis</th>
                            <th>Pracovisko</th>
                            <th>Na stiahnutie</th>
                        </tr>
                        <div>";
            for ($i = 0; $i < $n; $i++) {
                $row = $data[$i];
                if($row['verejne']==0 || $row['verejne']==1) {
                    echo "               
                         <div>
                                <tr>
                                    <td>" . $row['datum'] . "</td>
                                    <td>
                                        " . $row['popis'] . "
                                    </td>
                                    <td>" . $row['Názov'] . "</td>
                                    <td><button onclick=\"window.location.href='".$row['pdf']."'\" class=\"carier-btn\">Dokument (PDF)</button></td>
                                </tr>
                            </div>
                        ";
                }
            }
            echo "
                        </div>
                    </table>
                </div>";
        }else{
            echo " 
                    <h2 class=\"txtCenter txtBlack\">Ľutujeme, momentálne niesu dostupné žiadne pracovné pozície.</h2>
                ";
        }
        ?>
        <br><br><br>
    </div>
</body>