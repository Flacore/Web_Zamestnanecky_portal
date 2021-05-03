<?php
include "../config_DB.php";
$form_id=$_POST['id'];
$type=$_POST['typ'];

$sql = mysqli_query($con, "select * from formular where idformular='" . $form_id . "'");
$k = 0;
while ($row = $sql->fetch_assoc()) {
    $id_form[$k] = $row;
    ++$k;
}
if ($k != 0) {
    $data=$id_form[0];
    $sql = mysqli_query($con, "select * from prvok where formular_idformular='" . $form_id . "' order by z_index asc ");
    $q = 0;
    while ($row = $sql->fetch_assoc()) {
        $form_item[$q] = $row;
        ++$q;
    }
    $data_item=$form_item[0];
    if ($type == 1) {
        echo "   <div class=\"form_settings quiz_compartmant\">
            <form id=\"main_form\" method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_form.php\">
                <input id=\"form_id\" class=\"hidden\" type=\"number\" value=\"" . $form_id . "\" name=\"id\">
            <label>
                    Druh:
                    <input class=\"hidden\" type=\"number\" value='".$data_item['z_index']."' name=\"z_value\">
                </label>
                <select name=\"form_type\">";
                    if($data['typ']==1){
                        echo "<option value=\"1\" selected>Dotazník</option>
                              <option value=\"2\">Formulár</option>";
                    }else{
                        echo "<option value=\"1\">Dotazník</option>
                              <option value=\"2\" selected>Formulár</option>";
                    }
        echo"   </select>
                <input class=\"hidden\" type=\"number\"  value='12' name=\"type\">
                <label>Nazov:</label>
                <input type=\"text\" value='".$data_item['Nazov']."' name=\"Nazov\" required>
                <label>Popis:</label>
                <input type=\"text\" value='".$data_item['Popis']."' name=\"popis\">
                <label>Platnosť od:</label>
                <input type=\"date\" value='".date("d.m.Y", strtotime($data['platnost_od']))."' name=\"platnost_od\">
                <label>Platnosť do:</label>
                <input type=\"date\" value='".date("d.m.Y", strtotime($data['platnost_do']))."' name=\"platnost_do\">
            </form>
        </div>";
    } else {
        echo "   <div class=\"form_settings quiz_compartmant\">
            <form id=\"main_form\" method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_form.php\">
                <input id=\"form_id\" class=\"hidden\" type=\"number\" value=\"-1\" name=\"id\">
                <label>
                    Druh:
                    <input class=\"hidden\" type=\"number\" value='".$data_item['z_index']."' name=\"z_value\">
                </label>
                <select name=\"form_type\">";
                    if($data['typ']==1){
                        echo "<option value=\"1\" selected>Dotazník</option>
                              <option value=\"2\">Formulár</option>";
                    }else{
                        echo "<option value=\"1\">Dotazník</option>
                              <option value=\"2\" selected>Formulár</option>";
                    }
                echo"   </select>
                <input class=\"hidden\" type=\"number\"  value='12' name=\"type\">
                <label>Nazov:</label>
                <input type=\"text\" value='".$data_item['Nazov']."' name=\"Nazov\" required>
                <label>Popis:</label>
                <input type=\"text\" value='".$data_item['Popis']."' name=\"popis\">
                <label>Platnosť od:</label>
                <input type=\"date\" value='".date("d.m.Y", strtotime($data['platnost_od']))."' name=\"platnost_od\">
                <label>Platnosť do:</label>
                <input type=\"date\" value='".date("d.m.Y", strtotime($data['platnost_do']))."' name=\"platnost_do\">
            </form>
        </div>";
    }
    for($index=1;$index<$q;$index++){
        $data_item=$form_item[$index];

        if($data_item['typ_prvku']==1){
            //Kratky text
            echo "<div id='".$index."' class='quiz_compartmant'>
                        <span class=\"close - btn - form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                        <form class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">
                            <input class=\"hidden\" type = \"number\" value = \"".$data_item['z_index']."\" name = \"z_value\" >
                            <input class=\"hidden\" type = \"number\" value = \"1\" name = \"type\" >
                             <label > Nazov: </label >
                            <input type = \"text\" value = \"".$data_item['Nazov']."\" name = 'Otazka' required >";
            if($data_item['Vyzadovanie']==1)
                echo"<input type=\"checkbox\" name='vyzaduje'checked><label for=\"scales\">Vyžadovať</label>";
            else
                echo"<input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>";
                      echo" </form >
                        </div>";
        }

        if($data_item['typ_prvku']==2){
            //Dlhy text
            echo "<div id='".$index."' class='quiz_compartmant'>
                        <span class=\"close - btn - form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                        <form class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">
                            <input class=\"hidden\" type = \"number\" value = \"".$data_item['z_index']."\" name = \"z_value\" >
                            <input class=\"hidden\" type = \"number\" value = \"2\" name = \"type\" >
                             <label > Nazov: </label >
                            <input type = \"text\" value = \"".$data_item['Nazov']."\" name = 'Otazka' required >";
            if($data_item['Vyzadovanie']==1)
                echo"<input type=\"checkbox\" name='vyzaduje'checked><label for=\"scales\">Vyžadovať</label>";
            else
                echo"<input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>";
                      echo"  </form >
                        </div>";
        }

        if($data_item['typ_prvku']==3){
            //Jedna Moznost
            echo     "<div  id='".$index."' class='quiz_compartmant'> 
                        <span class=\"close-btn-form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                        <div id=\"one_ans_box".$index."\">
                            <form class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\"> 
                                <input class=\"hidden\" type=\"number\" value=\"".$data_item['z_index']."\" name=\"z_value\">
                                <input class=\"hidden\" type=\"number\" value=\"3\" name=\"type\"> 
                            <label>Otazka: </label>
                            <input type=\"text\" value=\"".$data_item['Nazov']."\" name='Otazka' required> ";
            if($data_item['Vyzadovanie']==1)
                echo"<input type=\"checkbox\" name='vyzaduje'checked><label for=\"scales\">Vyžadovať</label>";
            else
                echo"<input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>";
            echo"           </form>";

            $sql = mysqli_query($con, "select * from moznost where prvok_idprvok='" .$data_item['idprvok']. "'");
            $m = 0;
            while ($row = $sql->fetch_assoc()) {
                $m_item[$m] = $row;
                ++$m;
            }
            for($moznost=0;$moznost<$m;$moznost++) {
                $moznost_item=$m_item[$moznost];
                echo "           <form id='" . $moznost . "' class='moznost' method=\"post\" action='http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php'>
                                <input type=\"text\" value='".$moznost_item['text']."' name='text' required>
                            </form>";
            }

             echo"      </div>
                        <button onclick=\"add_option('one_ans_box".$index."','moznost','http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php')\">Pridaj možnosť</button>
                        </div>";
        }

        if($data_item['typ_prvku']==4){
            //Multi moznost
            echo     "<div  id='".$index."' class='quiz_compartmant'> 
                        <span class=\"close-btn-form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                        <div id=\"one_ans_box".$index."\">
                            <form class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\"> 
                                <input class=\"hidden\" type=\"number\" value=\"".$data_item['z_index']."\" name=\"z_value\">
                                <input class=\"hidden\" type=\"number\" value=\"4\" name=\"type\"> 
                            <label>Otazka: </label>
                            <input type=\"text\" value=\"".$data_item['Nazov']."\" name='Otazka' required> ";
            if($data_item['Vyzadovanie']==1)
                echo"<input type=\"checkbox\" name='vyzaduje'checked><label for=\"scales\">Vyžadovať</label>";
            else
                echo"<input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>";
            echo"           </form>";

            $sql = mysqli_query($con, "select * from moznost where prvok_idprvok='" .$data_item['idprvok']. "'");
            $m = 0;
            while ($row = $sql->fetch_assoc()) {
                $m_item[$m] = $row;
                ++$m;
            }
            for($moznost=0;$moznost<$m;$moznost++) {
                $moznost_item=$m_item[$moznost];
                echo "           <form id='" . $moznost . "' class='moznost' method=\"post\" action='http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php'>
                                <input type=\"text\" value='".$moznost_item['text']."' name='text' required>
                            </form>";
            }

            echo"      </div>
                        <button onclick=\"add_option('one_ans_box".$index."','moznost','http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php')\">Pridaj možnosť</button>
                        </div>";
        }

        if($data_item['typ_prvku']==5){
            //List
            echo     "<div  id='".$index."' class='quiz_compartmant'> 
                        <span class=\"close-btn-form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                        <div id=\"one_ans_box".$index."\">
                            <form class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\"> 
                                <input class=\"hidden\" type=\"number\" value=\"".$data_item['z_index']."\" name=\"z_value\">
                                <input class=\"hidden\" type=\"number\" value=\"5\" name=\"type\"> 
                            <label>Otazka: </label>
                            <input type=\"text\" value=\"".$data_item['Nazov']."\" name='Otazka' required> ";
            if($data_item['Vyzadovanie']==1)
                echo"<input type=\"checkbox\" name='vyzaduje'checked><label for=\"scales\">Vyžadovať</label>";
            else
                echo"<input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>";
            echo"           </form>";

            $sql = mysqli_query($con, "select * from moznost where prvok_idprvok='" .$data_item['idprvok']. "'");
            $m = 0;
            while ($row = $sql->fetch_assoc()) {
                $m_item[$m] = $row;
                ++$m;
            }
            for($moznost=0;$moznost<$m;$moznost++) {
                $moznost_item=$m_item[$moznost];
                echo "           <form id='" . $moznost . "' class='moznost' method=\"post\" action='http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php'>
                                <input type=\"text\" value='".$moznost_item['text']."' name='text' required>
                            </form>";
            }

            echo"      </div>
                        <button onclick=\"add_option('one_ans_box".$index."','moznost','http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php')\">Pridaj možnosť</button>
                        </div>";
        }

        if($data_item['typ_prvku']==6){
            //Subor
            echo "<div id='".$index."' class='quiz_compartmant'>
                        <span class=\"close - btn - form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                        <form class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">
                            <input class=\"hidden\" type = \"number\" value = \"".$data_item['z_index']."\" name = \"z_value\" >
                            <input class=\"hidden\" type = \"number\" value = \"6\" name = \"type\" >
                             <label > Nazov: </label >
                            <input type = \"text\" value = \"".$data_item['Nazov']."\" name = 'Otazka' required >";
            if($data_item['Vyzadovanie']==1)
                echo"<input type=\"checkbox\" name='vyzaduje'checked><label for=\"scales\">Vyžadovať</label>";
            else
                echo"<input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>";
                      echo"  </form >
                        </div>";
        }

        if($data_item['typ_prvku']==7){
            //Cas
            echo "<div id='".$index."' class='quiz_compartmant'>
                        <span class=\"close - btn - form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                        <form class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">
                            <input class=\"hidden\" type = \"number\" value = \"".$data_item['z_index']."\" name = \"z_value\" >
                            <input class=\"hidden\" type = \"number\" value = \"7\" name = \"type\" >
                             <label > Nazov: </label >
                            <input type = \"text\" value = \"".$data_item['Nazov']."\" name = 'Otazka' required >";
            if($data_item['Vyzadovanie']==1)
                echo"<input type=\"checkbox\" name='vyzaduje'checked><label for=\"scales\">Vyžadovať</label>";
            else
                echo"<input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>";
            echo"  </form >
                        </div>";
        }

        if($data_item['typ_prvku']==8){
            //Datum
            echo "<div id='".$index."' class='quiz_compartmant'>
                        <span class=\"close - btn - form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                        <form class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">
                            <input class=\"hidden\" type = \"number\" value = \"".$data_item['z_index']."\" name = \"z_value\" >
                            <input class=\"hidden\" type = \"number\" value = \"8\" name = \"type\" >
                             <label > Nazov: </label >
                            <input type = \"text\" value = \"".$data_item['Nazov']."\" name = 'Otazka' required >";
            if($data_item['Vyzadovanie']==1)
                echo"<input type=\"checkbox\" name='vyzaduje'checked><label for=\"scales\">Vyžadovať</label>";
            else
                echo"<input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>";
            echo"  </form >
                        </div>";
        }

        if($data_item['typ_prvku']==9){
            //Matica jedna
            echo"           <div id='".$index."' class='quiz_compartmant'>      
                             <span class=\"close-btn-form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                                   <div id=\"list_ans_box".$index."\">
                                       <form class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">
                                            <input class=\"hidden\" type=\"number\" value=\"".$data_item['z_index']."\" name=\"z_value\">
                                            <input class=\"hidden\" type=\"number\" value=\"9\" name=\"type\">
                                        <label>Otazka: </label>
                                        <input type=\"text\" value=\"\" name='Otazka' required>";
            if($data_item['Vyzadovanie']==1)
                echo"<input type=\"checkbox\" name='vyzaduje'checked><label for=\"scales\">Vyžadovať</label>";
            else
                echo"<input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>";
            echo"                    </form>";
            echo"                   <div class='row' id='option".$index."'>";

            $sql = mysqli_query($con, "select * from moznost where prvok_idprvok='" .$data_item['idprvok']. "'");
            $m = 0;
            while ($row = $sql->fetch_assoc()) {
                $m_item[$m] = $row;
                ++$m;
            }
            for($moznost=0;$moznost<$m;$moznost++) {
                $moznost_item=$m_item[$moznost];
                echo"<div class=\"col-sm-6\">
                            <form id='".$moznost."' class=\"moznost\" method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php\">
                                <input type=\"text\" value='".$moznost_item['text']."' name='text' required>
                            </form>
                        </div>
                        <div class=\"col-sm-6\">
                            <div id=\"catOption".$moznost."\">";
                $sql = mysqli_query($con, "select * from moznost where moznost_idMoznost='" .$moznost_item['idMoznost']. "'");
                $s = 0;
                while ($row = $sql->fetch_assoc()) {
                    $s_item[$s] = $row;
                    ++$s;
                }
                for ($submoznost=0;$submoznost<$s;$submoznost++){
                    $submoznost_item=$s_item[$submoznost];
                    echo "<form class=\"submoznost\" method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_submoznost.php\"> 
                             <input type=\"text\" value='".$submoznost_item['text']."' name='text' required>
                        </form>";
                }
                echo "</div>
                            <button onclick=\"add_option('catOption".$moznost."','submoznost','http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_submoznost.php')\">Pridaj možnosť</button>
                        </div>";
            }

            echo"                   </div>";
            echo"                   </div>
                                    <button onclick=\"add_Category('option".$index."')\">Pridaj možnosť</button>
            </div>";
        }

        if($data_item['typ_prvku']==10){
            //Matica multi
            echo"           <div id='".$index."' class='quiz_compartmant'>      
                             <span class=\"close-btn-form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                                   <div id=\"list_ans_box".$index."\">
                                       <form class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">
                                            <input class=\"hidden\" type=\"number\" value=\"".$data_item['z_index']."\" name=\"z_value\">
                                            <input class=\"hidden\" type=\"number\" value=\"10\" name=\"type\">
                                        <label>Otazka: </label>
                                        <input type=\"text\" value=\"\" name='Otazka' required>";
            if($data_item['Vyzadovanie']==1)
                echo"<input type=\"checkbox\" name='vyzaduje'checked><label for=\"scales\">Vyžadovať</label>";
            else
                echo"<input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>";
            echo"                    </form>";
            echo"                   <div class='row' id='option".$index."'>";

            $sql = mysqli_query($con, "select * from moznost where prvok_idprvok='" .$data_item['idprvok']. "'");
            $m = 0;
            while ($row = $sql->fetch_assoc()) {
                $m_item[$m] = $row;
                ++$m;
            }
            for($moznost=0;$moznost<$m;$moznost++) {
                $moznost_item=$m_item[$moznost];
                echo"<div class=\"col-sm-6\">
                            <form id='".$moznost."' class=\"moznost\" method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php\">
                                <input type=\"text\" value='".$moznost_item['text']."' name='text' required>
                            </form>
                        </div>
                        <div class=\"col-sm-6\">
                            <div id=\"catOption".$moznost."\">";
                $sql = mysqli_query($con, "select * from moznost where moznost_idMoznost='" .$moznost_item['idMoznost']. "'");
                $s = 0;
                while ($row = $sql->fetch_assoc()) {
                    $s_item[$s] = $row;
                    ++$s;
                }
                for ($submoznost=0;$submoznost<$s;$submoznost++){
                    $submoznost_item=$s_item[$submoznost];
                    echo "<form class=\"submoznost\" method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_submoznost.php\"> 
                             <input type=\"text\" value='".$submoznost_item['text']."' name='text' required>
                        </form>";
                }
                echo "</div>
                            <button onclick=\"add_option('catOption".$moznost."','submoznost','http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_submoznost.php')\">Pridaj možnosť</button>
                        </div>";
            }

            echo"                   </div>";
            echo"                   </div>
                                    <button onclick=\"add_Category('option".$index."')\">Pridaj možnosť</button>
            </div>";
        }

        if($data_item['typ_prvku']==11){
            //Interval
            echo  "<div id='".$index."' class='quiz_compartmant'>
            <span class=\"close-btn-form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                       <form  class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">
                            <input class=\"hidden\" type=\"number\" value=\"".$data_item['z_index']."\" name=\"z_value\">
                           <input class=\"hidden\" type=\"number\" value=\"11\" name=\"type\">
            <label>Otazka: </label>
                            <input type=\"text\" value=\"".$data_item['Nazov']."\" name='Otazka' required>
            <label>Min: </label>
                            <input type=\"number\" value='".$data_item['min']."' name=\"min\" required>
           <label>Max: </label>
                            <input type=\"number\" value='".$data_item['max']."' name=\"max\" required>";
            if($data_item['Vyzadovanie']==1)
                echo"<input type=\"checkbox\" name='vyzaduje'checked><label for=\"scales\">Vyžadovať</label>";
            else
                echo"<input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>";
                      echo"  </form>
                        </div>";
        }

        if($data_item['typ_prvku']==12){
            //sekcia
            echo "<div id='".$index."' class='quiz_compartmant'>
                        <span class=\"close - btn - form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                        <form class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">
                            <input class=\"hidden\" type = \"number\" value = \"".$data_item['z_index']."\" name = \"z_value\" >
                            <input class=\"hidden\" type = \"number\" value = \"12\" name = \"type\" >
                             <label > Nazov: </label >
                            <input type = \"text\" value = \"".$data_item['Nazov']."\" name = 'Otazka' required >
                             <label > Popis: </label >
                            <input type = \"text\" value = \"".$data_item['Popis']."\" name = 'popis' >
                        </form >
                        </div>";
        }

        if($data_item['typ_prvku']==13){
            //text
            echo "<div id='".$index."' class='quiz_compartmant'>
                        <span class=\"close - btn - form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                        <form class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">
                            <input class=\"hidden\" type = \"number\" value = \"".$data_item['z_index']."\" name = \"z_value\" >
                            <input class=\"hidden\" type = \"number\" value = \"13\" name = \"type\" >
                             <label > Nazov: </label >
                            <input type = \"text\" value = \"".$data_item['Nazov']."\" name = 'Otazka' required >
                             <label > Popis: </label >
                            <input type = \"text\" value = \"".$data_item['Popis']."\" name = 'popis' >
                        </form >
                        </div>";
        }

        if($data_item['typ_prvku']==14){
            //Foto
            $obsah_item= $sql = mysqli_query($con, "select * from obsah where prvok_idprvok='" .$data_item['idprvok']. "'")->fetch_assoc();
            $id_element2="element2".$index;
            $id_element="element1".$index;
            echo "<div id='".$index."' class='quiz_compartmant video'>
            <span class=\"close-btn-form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                        <form enctype=\"multipart/form-data\" class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">
                            <input class=\"hidden\" type=\"number\" value=\"".$data_item['z_index']."\" name=\"z_value\">
                            <input class=\"hidden\" type=\"number\" value=\"14\" name=\"type\">
                            <label>Nazov: </label>
                            <input type=\"text\" value=\"".$data_item['Nazov']."\" name='Otazka' required>";
             if($obsah_item['Subor_idSubor']!=null)
                 echo "<input id='".$id_element2."' type=\"checkbox\" name='url_bt'><label for=\"scales\" >Použiť URL adresu</label>";
             else
                 echo "<input id='".$id_element2."' type=\"checkbox\" name='url_bt' checked><label for=\"scales\" >Použiť URL adresu</label>";
            echo"           <label>URL: </label>
                            <input type=\"text\" value=\"".$obsah_item['url']."\" name='url'>
                           <input id='".$id_element."' class='hidden' value=\"".$obsah_item['Subor_idSubor']."\" type=\"number\" name='file_path'>
                        </form>
            <p style='display: none' id=\"f1_upload_process\">Nahrávam...<br/><img src=\"https://mir-s3-cdn-cf.behance.net/project_modules/disp/585d0331234507.564a1d239ac5e.gif\" /></p>
            <p id=\"result\"></p>
                <form action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/quiz_file.php\" method=\"post\" enctype=\"multipart/form-data\" target=\"upload_target\" onsubmit=\"startUpload();\">
                                <input type=\"file\" name='file_path'>
                                <input value='".$id_element."' class='hidden' type=\"number\" name='id_path'>
                                <input value='".$id_element2."' class='hidden' type=\"number\" name='prev'>
                                <input type=\"submit\" name=\"submitBtn\" value=\"Upload\" />
                </form>
            </div>";
        }

        if($data_item['typ_prvku']==15){
            //Video
            $obsah_item= $sql = mysqli_query($con, "select * from obsah where prvok_idprvok='" .$data_item['idprvok']. "'")->fetch_assoc();
            $id_element2="element2".$index;
            $id_element="element1".$index;
            echo "<div id='".$index."' class='quiz_compartmant video'>
            <span class=\"close-btn-form\" onclick=\"delete_item('".$index."')\" >&times;</span>
                        <form enctype=\"multipart/form-data\" class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">
                            <input class=\"hidden\" type=\"number\" value=\"".$data_item['z_index']."\" name=\"z_value\">
                            <input class=\"hidden\" type=\"number\" value=\"15\" name=\"type\">
                            <label>Nazov: </label>
                            <input type=\"text\" value=\"".$data_item['Nazov']."\" name='Otazka' required>";
            if($obsah_item['Subor_idSubor']!=null)
                echo "<input id='".$id_element2."' type=\"checkbox\" name='url_bt'><label for=\"scales\" >Použiť URL adresu</label>";
            else
                echo "<input id='".$id_element2."' type=\"checkbox\" name='url_bt' checked><label for=\"scales\" >Použiť URL adresu</label>";
            echo"           <label>URL: </label>
                            <input type=\"text\" value=\"".$obsah_item['url']."\" name='url'>
                           <input id='".$id_element."' class='hidden' value=\"".$obsah_item['Subor_idSubor']."\" type=\"number\" name='file_path'>
                        </form>
            <p style='display: none' id=\"f1_upload_process\">Nahrávam...<br/><img src=\"https://mir-s3-cdn-cf.behance.net/project_modules/disp/585d0331234507.564a1d239ac5e.gif\" /></p>
            <p id=\"result\"></p>
                <form action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/quiz_file.php\" method=\"post\" enctype=\"multipart/form-data\" target=\"upload_target\" onsubmit=\"startUpload();\">
                                <input type=\"file\" name='file_path'>
                                <input value='".$id_element."' class='hidden' type=\"number\" name='id_path'>
                                <input value='".$id_element2."' class='hidden' type=\"number\" name='prev'>
                                <input type=\"submit\" name=\"submitBtn\" value=\"Upload\" />
                </form>
            </div>";
        }
    }
}

?>