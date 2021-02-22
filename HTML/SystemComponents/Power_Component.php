<?php include "../../PHP/config_DB.php";
$id=$_SESSION['session'] ?>
<body>
    <div class="container" id="powers">
        <br><br><br>
        <h2 class="txtCenter txtBlack">Právomoci</h2>
        <br>
        <form method="post" action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/powersUpdate.php">
            <div class="position tableStyle">
                <table>
                    <tr>
                        <th>Funkcia</th>
                        <th>Kontakty</th>
                        <th>Kurzy</th>
                        <th>Kariéra</th>
                        <th>Blog</th>
                        <th>Právomoci</th>
                        <th>Odstráň</th>
                    </tr>
                    <div id="position_window">
                        <div id="position_item">
                            <?php
                            $sql = mysqli_query($con, "select * from pozícia");
                            $i = 0;
                            while ($rows = $sql->fetch_assoc()){
                                $data[$i]=$rows;
                                ++$i;
                            }
                            $data[($i+1)]=null;
                            for ($j = 0; $j<=$i; $j++) {
                                $row=$data[$j];
                                echo "
                                    <tr>
                                        <td style='display: none'><input name=\"id_".($j+1)."\" type=\"value\" value=".($j+1)."></td>
                                        <td><input name=\"name_".($j+1)."\" type=\"text\" value=".$row['Nazov']."></td>
                                        <td><input ".checkbox($row['Kontakty'])." name=\"cont_".($j+1)."\" type=\"checkbox\"></td>
                                        <td><input ".checkbox($row['Kurzy'])." name=\"curs_".($j+1)."\" type=\"checkbox\"></td>
                                        <td><input ".checkbox($row['Kariera'])." name=\"care_".($j+1)."\" type=\"checkbox\"></td>
                                        <td><input ".checkbox($row['Blog'])." name=\"blog_".($j+1)."\" type=\"checkbox\"></td>
                                        <td><input ".checkbox($row['Pravomoci'])." name=\"powr_".($j+1)."\" type=\"checkbox\"></td>
                                        <td><input  name=\"odst_".($j+1)."\" type=\"checkbox\"></td>
                                    </tr>
                                ";
                            }
                            function checkbox($var){
                                if($var == '1'){
                                    return "checked";
                                }
                                return "";
                            }
                            ?>
                        </div>
                    </div>
                </table>
            </div>
            <input name="but_add" id="but_add" class="btn" type="submit" value="Potvrď">
        </form>
        <br><br><br>
    </div>
</body>