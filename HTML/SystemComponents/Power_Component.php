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
    <div class="container" id="powers">
        <br><br><br>
        <h2 class="txtCenter txtBlack">Právomoci</h2>
        <br>
        <?php
        if($info['Pravomoci']==1){
            echo "
                    <form method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/powersUpdate.php\">
        ";
        }
        ?>
            <div class="position tableStyle">
                <table>
                    <tr>
                        <th>Funkcia</th>
                        <th>Kontakty</th>
                        <th>Kurzy</th>
                        <th>Kariéra</th>
                        <th>Blog</th>
                        <th>Právomoci</th>
                        <th>Záložky</th>
                        <th>Dokumenty</th>
                        <th>Dotazníky</th>
                        <th>Inzercia</th>
                        <th>Miesta</th>
                        <th>Odstráň</th>
                    </tr>
                            <?php
                            $sql = mysqli_query($con, "select * from funkcie join pravomoci on (funkcie_idPozícia=idPozícia)");
                            $i = 0;
                            while ($rows = $sql->fetch_assoc()){
                                $data[$i]=$rows;
                                ++$i;
                            }
                            $data[($i)]=null;
                            for ($j = 0; $j<=$i; $j++) {
                                $row=$data[$j];
                                if($row['Nazov']=='admin'){
                                    echo "
                                    <tr>
                                        <td style='display: none'><input name=\"id_" . ($j + 1) . "\" type=\"value\" value=" . ($j + 1) . "></td>
                                        <td>".$row['Nazov']."</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td></td>
                                    </tr>
                                ";
                                }else {
                                    echo "
                                    <tr>
                                        <td style='display: none'><input name=\"id_" . ($j + 1) . "\" type=\"value\" value=" . ($j + 1) . "></td>
                                        <td><input name=\"name_" . ($j + 1) . "\" type=\"text\" value=" . $row['Nazov'] . "></td>
                                        <td><input " . checkbox($row['Kontakty']) . " name='cont_" . ($j + 1) . "' type=\"checkbox\"></td>
                                        <td><input " . checkbox($row['Kurzy']) . " name='curs_" . ($j + 1) . "' type=\"checkbox\"></td>
                                        <td><input " . checkbox($row['Kariera']) . " name='care_" . ($j + 1) . "' type=\"checkbox\"></td>
                                        <td><input " . checkbox($row['Blog']) . " name='blog_" . ($j + 1) . "' type=\"checkbox\"></td>
                                        <td><input " . checkbox($row['Pravomoci']) . " name='powr_" . ($j + 1) . "' type=\"checkbox\"></td>
                                              <td><input " . checkbox($row['Zalozky']) . " name='zal_" . ($j + 1) . "' type=\"checkbox\"></td>
                                        <td><input " . checkbox($row['Dokumenty']) . " name='dok_" . ($j + 1) . "' type=\"checkbox\"></td>
                                        <td><input " . checkbox($row['Dotazniky']) . " name='dot_" . ($j + 1) . "'' type=\"checkbox\"></td>
                                        <td><input " . checkbox($row['Inzercia']) . " name='inz_" . ($j + 1) . "' type=\"checkbox\"></td>
                                        <td><input " . checkbox($row['Miesta']) . " name='mie_" . ($j + 1) . "' type=\"checkbox\"></td>
                                        <td><input  name='odst_" . ($j + 1) . "' type=\"checkbox\"></td>
                                    </tr>
                                ";
                                }
                            }
                            function checkbox($var){
                                if($var == '1'){
                                    return "checked";
                                }
                                return "";
                            }
                            ?>
                </table>
            </div>
        <?php
                if($info['Pravomoci']==1){
                echo "
            <input name=\"but_add\" id=\"but_add\" class=\"btn\" type=\"submit\" value=\"Potvrď\">
        </form>
        ";
        }
        ?>
        <br><br><br>
    </div>
</body>