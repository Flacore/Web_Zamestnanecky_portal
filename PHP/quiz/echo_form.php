<?php
include "../config_DB.php";
$form_id=$_POST['id'];
$vypln=$_POST['vpln'];
$detail=$_POST['detail'];
if(1 == $detail && $vypln!=-1){
    get_detail($form_id,$vypln,$con);
}else {
    $sql = mysqli_query($con, "select * from vyplnenie_formulara where formular_idformular='" . $form_id . "' order by vyplnenie asc");
    $k = 0;
    while ($row = $sql->fetch_assoc()) {
        $id_list[$k] = $row;
        ++$k;
    }
    $celkovo=$k;
    echo "<h2>Dotazník bol vyplnený: ".$celkovo." krát.</h2>";
    if ($k > 0) {
        $sql = mysqli_query($con, "select * from formular where idformular='" . $form_id . "'");
        $q = 0;
        while ($row = $sql->fetch_assoc()) {
            $form_info[$q] = $row;
            ++$q;
        }
        $tmp = $form_info[0];
        $type_form = $tmp['typ'];

        if ($type_form == 1) {
            $sql = mysqli_query($con, "select * from prvok where typ_prvku<'12' and formular_idformular='" . $form_id . "' order by z_index asc ");
            $q = 0;
            while ($row = $sql->fetch_assoc()) {
                $form_info[$q] = $row;
                ++$q;
            }
            for($i=0;$i<$q;$i++){
                $form_item=$form_info[$i];
                $item_type=$form_item['typ_prvku'];
                if($item_type<3){
                    echo "<div class='hidden_content'>
                    <h3>".$form_item['Nazov']."</h3>
                    <div class='hidden' id='".$form_item['idprvok']."'>";
                    $sql = mysqli_query($con, "select * from odpoved join vyplnenie_formulara 
                    on(vyplnenie_formulara_idVyplnenie_formulara=idVyplnenie_formulara)
                    where formular_idformular='".$form_item['formular_idformular']."'
                    AND prvok_idprvok='".$form_item['idprvok']."' and text is not null order by text asc ");
                    $z = 0;
                    while ($row = $sql->fetch_assoc()) {
                        $times[$z] = $row;
                        ++$z;
                    }
                    for($x=0;$x<$z;$x++){
                        $time=$times[$x];
                        echo "<h4>".($x+1).". ".$time['text']."</h4>";
                    }

                    echo "</div></div>
                <button class='showParent_btn' onclick=\"showParent('".$form_item['idprvok']."')\">Zobraz</button>";
                }

                if($item_type>2 && $item_type<6){
                    echo "<h3>".$form_item['Nazov']."</h3>";
                    $sql=mysqli_query($con,"SELECT * FROM moznost WHERE prvok_idprvok='".$form_item['idprvok']."' ORDER by idMoznost asc");
                    $z = 0;
                    while ($row = $sql->fetch_assoc()) {
                        $data[$z] = $row;
                        ++$z;
                    }
                    if($z>0){
                        for($n=0;$n<$z;$n++) {
                            $item =$data[$n];
                            $sql=mysqli_query($con,"SELECT count(*) as sucet FROM odpoved join vyplnenie_formulara on(vyplnenie_formulara_idVyplnenie_formulara=idVyplnenie_formulara)
                                                           WHERE prvok_idprvok='".$item['prvok_idprvok']."' AND formular_idformular='".$form_item['formular_idformular']."'");
                            $row = $sql->fetch_assoc();
                            echo "<h4>".($n+1).". ".$item['text']." - ".$row['sucet']."x (".(($row['sucet']/$celkovo)*100)."%)</h4>";
                        }
                    }
                }

                if($item_type==='6'){
                    echo "<div class='hidden_content'>
                            <h3>".$form_item['Nazov']."</h3>
                          <div class='hidden' id='".$form_item['idprvok']."'>";
                    $sql = mysqli_query($con, "select * from subor where idSubor in ( SELECT Subor_idSubor FROM obsah WHERE prvok_idprvok='".$form_item['idprvok']."') order by vytvorenie desc");
                    $z = 0;
                    while ($row = $sql->fetch_assoc()) {
                        $data[$z] = $row;
                        ++$z;
                    }
                    if($i>0){
                        for($n=0;$n<$z;$n++){
                            $data_na_rozdelenie=$data[$n];
                            $Cesta=$data_na_rozdelenie['cesta'];
                            $Datum=date("d-m-Y", strtotime($data_na_rozdelenie['vytvorenie']));
                            echo "
                            <div class='item_DownloadList'>
                                  <div class='row'>
                                    <div class='col-sm-4'>
                                        <button onclick=\" location.href='http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/ftp/Download_file.php?cesta=".$Cesta."'\">Stiahnuť</button>
                                    </div>
                                  </div>
                                  <div class='row'>
                                    <div class='col-sm-12'><h6>".$Datum."</h6></div>
                                  </div>
                                <br>
                             </div>";
                        }
                    }

                    echo "</div></div><button class='showParent_btn' onclick=\"showParent('".$form_item['idprvok']."')\">Zobraz</button>";
                }

                if($item_type==7){
                    echo "<div class='hidden_content'>
                    <h3>".$form_item['Nazov']."</h3>
                    <div class='hidden' id='".$form_item['idprvok']."'>";
                    $sql = mysqli_query($con, "select * from odpoved join vyplnenie_formulara 
                    on(vyplnenie_formulara_idVyplnenie_formulara=idVyplnenie_formulara)
                    where formular_idformular='".$form_item['formular_idformular']."'
                    AND prvok_idprvok='".$form_item['idprvok']."' and datum is not null order by datum asc ");
                    $z = 0;
                    while ($row = $sql->fetch_assoc()) {
                        $times[$z] = $row;
                        ++$z;
                    }
                    for($x=0;$x<$z;$x++){
                        $time=$times[$x];
                        echo "<h4>".($x+1).". ".date("d-m-Y", strtotime($time['datum']))."</h4>";
                    }

                    echo "</div></div>
                <button class='showParent_btn' onclick=\"showParent('".$form_item['idprvok']."')\">Zobraz</button>";
                }

                if($item_type==8){
                    echo "<div class='hidden_content'>
                    <h3>".$form_item['Nazov']."</h3>
                    <div class='hidden' id='".$form_item['idprvok']."'>";
                    $sql = mysqli_query($con, "select * from odpoved join vyplnenie_formulara 
                    on(vyplnenie_formulara_idVyplnenie_formulara=idVyplnenie_formulara)
                    where formular_idformular='".$form_item['formular_idformular']."'
                    AND prvok_idprvok='".$form_item['idprvok']."' and cas is not null order by cas asc ");
                    $z = 0;
                    while ($row = $sql->fetch_assoc()) {
                        $times[$z] = $row;
                        ++$z;
                    }
                    for($x=0;$x<$z;$x++){
                        $time=$times[$x];
                        echo "<h4>".($x+1).". ".$time['cas']."</h4>";
                    }

                    echo "</div></div>
                    <button class='showParent_btn' onclick=\"showParent('".$form_item['idprvok']."')\">Zobraz</button>";
                }

                if($item_type>8 && $item_type<11){
                    echo "<h3>".$form_item['Nazov']."</h3>";
                    $sql=mysqli_query($con,"SELECT * FROM moznost WHERE prvok_idprvok='".$form_item['idprvok']."' ORDER by idMoznost asc");
                    $z = 0;
                    while ($row = $sql->fetch_assoc()) {
                        $datas[$z] = $row;
                        ++$z;
                    }
                    if($z>0){
                        for($n=0;$n<$z;$n++) {
                            $items=$datas[$n];
                            $sql=mysqli_query($con,"SELECT * FROM moznost WHERE moznost_idMoznost='".$items['idMoznost']."' ORDER by idMoznost asc");
                            $y = 0;
                            while ($row = $sql->fetch_assoc()) {
                                $data[$y] = $row;
                                ++$y;
                            }
                            echo "<h3>".($n+1).". ".$items['text']."</h3>";
                            if($y>0){
                                for($a=0;$a<$y;$a++) {
                                    $item=$data[$a];
                                    $sql=mysqli_query($con,"SELECT count(*) as sucet FROM odpoved join vyplnenie_formulara on(vyplnenie_formulara_idVyplnenie_formulara=idVyplnenie_formulara)
                                    WHERE moznost_idMoznost='".$item['idMoznost']."' and prvok_idprvok='".$items['prvok_idprvok']."' AND formular_idformular='".$form_item['formular_idformular']."'");
                                    $row = $sql->fetch_assoc();
                                    echo "<h4>".($n+1).".".($a+1).". ".$item['text']." - ".$row['sucet']."x (".(($row['sucet']/$celkovo)*100)."%)</h4>";
                                }
                            }
                        }
                    }
                }
                if($item_type==11){
                    echo "<h3>".$form_item['Nazov']."</h3>";
                    $min=$form_item['min'];
                    $max=$form_item['max'];
                    if($min>$max){
                        $tmp=$min;
                        $min=$max;
                        $max=$tmp;
                    }
                    if(($max-$min)>10){
                        echo "<div class='hidden_content'>
                        <div class='hidden' id='".$form_item['idprvok']."'>";
                    }

                    for($n=$min;$n<=$max;$n++){
                        $sql = mysqli_query($con,"select count(*) as sucet from odpoved 
                                                        where prvok_idprvok='".$form_item['idprvok']."' and hodnotenie='".$n."'");
                        $row = $sql->fetch_assoc();
                        echo "<h4>".($n).". ".$row['sucet']."x (".(($row['sucet']/$celkovo)*100)."%)</h4>";
                    }

                    if(($max-$min)>10){
                        echo "</div></div>
                        <button class='showParent_btn' onclick=\"showParent('".$form_item['idprvok']."')\">Zobraz</button>";
                    }
                }
                if($form_item['Vyzadovanie']==0) {
                    $sql = mysqli_query($con, "select count(*) as sucet from vyplnenie_formulara
                        where formular_idformular='" . $form_item['formular_idformular'] . "'
                        AND idVyplnenie_formulara not in( SELECT vyplnenie_formulara_idVyplnenie_formulara FROM odpoved WHERE prvok_idprvok='" . $form_item['idprvok'] . "')
                        ");
                    $row = $sql->fetch_assoc();
                    echo "<h4>Neodpovedalo: " . $row['sucet'] . " [" . (($row['sucet'] / $celkovo) * 100) . "%]</h4>";
                }else{
                    echo "<h4>Táto otázka bola povinná.</h4>";
                }
            }

        } else {
            for ($i = 0; $i < $k; $i++) {
                $form_data = $id_list[$i];
                echo "
                    <div class='quiz_compartmant'>
                        <h3>Poradové číslo:</h3>
                        <h4>" . ($i + 1) . ". </h4>
                        <h3>Dátum vyplnenie:</h3>
                        <h4>" . date("d-m-Y", strtotime($form_data['vyplnenie'])) . "</h4>";
                        get_detail($form_id, $form_data['idVyplnenie_formulara'] ,$con);
                echo"        <button class='showParent_btn' onclick=\"showParent('" . $form_data['idVyplnenie_formulara'] . "')\">Zobraz</button>
                    </div>
                   ";
            }
        }
    }
}

function get_detail($form_id,$vypln,$con){
    echo "<div class='hidden_content'>
            <div class='hidden' id='".$vypln."'>";

    $sql = mysqli_query($con, "select * from formular where idformular='" . $form_id . "'");
    $q = 0;
    while ($row = $sql->fetch_assoc()) {
        $form_info[$q] = $row;
        ++$q;
    }
    $tmp = $form_info[0];
    $type_form = $tmp['typ'];

    if ($type_form == 1) {
        $sql = mysqli_query($con, "select * from prvok where typ_prvku<'12' and formular_idformular='" . $form_id . "' order by z_index asc ");
        $q = 0;
        while ($row = $sql->fetch_assoc()) {
            $form_info[$q] = $row;
            ++$q;
        }
        for($i=0;$i<$q;$i++){
            $form_item=$form_info[$i];
            $item_type=$form_item['typ_prvku'];

            //TODO: uprav tento prvok
            if($item_type<3){
                echo "<div class='hidden_content'>
                    <h3>".$form_item['Nazov']."</h3>
                    <div class='hidden' id='".$form_item['idprvok']."'>";
                $sql = mysqli_query($con, "select * from odpoved join vyplnenie_formulara 
                    on(vyplnenie_formulara_idVyplnenie_formulara=idVyplnenie_formulara)
                    where formular_idformular='".$form_item['formular_idformular']."'
                    AND prvok_idprvok='".$form_item['idprvok']."' and text is not null order by text asc ");
                $z = 0;
                while ($row = $sql->fetch_assoc()) {
                    $times[$z] = $row;
                    ++$z;
                }
                for($x=0;$x<$z;$x++){
                    $time=$times[$x];
                    echo "<h4>".($x+1).". ".$time['text']."</h4>";
                }

                echo "</div></div>
                <button class='showParent_btn' onclick=\"showParent('".$form_item['idprvok']."')\">Zobraz</button>";
            }

            //TODO: uprav tento prvok
            if($item_type>2 && $item_type<6){
                echo "<h3>".$form_item['Nazov']."</h3>";
                $sql=mysqli_query($con,"SELECT * FROM moznost WHERE prvok_idprvok='".$form_item['idprvok']."' ORDER by idMoznost asc");
                $z = 0;
                while ($row = $sql->fetch_assoc()) {
                    $data[$z] = $row;
                    ++$z;
                }
                if($z>0){
                    for($n=0;$n<$z;$n++) {
                        $item =$data[$n];
                        $sql=mysqli_query($con,"SELECT count(*) as sucet FROM odpoved join vyplnenie_formulara on(vyplnenie_formulara_idVyplnenie_formulara=idVyplnenie_formulara)
                                                           WHERE prvok_idprvok='".$item['prvok_idprvok']."' AND formular_idformular='".$form_item['formular_idformular']."'");
                        $row = $sql->fetch_assoc();
                    }
                }
            }

            //TODO: uprav tento prvok
            if($item_type==='6'){
                echo "<div class='hidden_content'>
                            <h3>".$form_item['Nazov']."</h3>
                          <div class='hidden' id='".$form_item['idprvok']."'>";
                $sql = mysqli_query($con, "select * from subor where idSubor in ( SELECT Subor_idSubor FROM obsah WHERE prvok_idprvok='".$form_item['idprvok']."') order by vytvorenie desc");
                $z = 0;
                while ($row = $sql->fetch_assoc()) {
                    $data[$z] = $row;
                    ++$z;
                }
                if($i>0){
                    for($n=0;$n<$z;$n++){
                        $data_na_rozdelenie=$data[$n];
                        $Cesta=$data_na_rozdelenie['cesta'];
                        $Datum=date("d-m-Y", strtotime($data_na_rozdelenie['vytvorenie']));
                        echo "
                            <div class='item_DownloadList'>
                                  <div class='row'>
                                    <div class='col-sm-4'>
                                        <button onclick=\" location.href='http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/ftp/Download_file.php?cesta=".$Cesta."'\">Stiahnuť</button>
                                    </div>
                                  </div>
                                  <div class='row'>
                                    <div class='col-sm-12'><h6>".$Datum."</h6></div>
                                  </div>
                                <br>
                             </div>";
                    }
                }

                echo "</div></div><button class='showParent_btn' onclick=\"showParent('".$form_item['idprvok']."')\">Zobraz</button>";
            }

            //TODO: uprav tento prvok
            if($item_type==7){
                echo "<div class='hidden_content'>
                    <h3>".$form_item['Nazov']."</h3>
                    <div class='hidden' id='".$form_item['idprvok']."'>";
                $sql = mysqli_query($con, "select * from odpoved join vyplnenie_formulara 
                    on(vyplnenie_formulara_idVyplnenie_formulara=idVyplnenie_formulara)
                    where formular_idformular='".$form_item['formular_idformular']."'
                    AND prvok_idprvok='".$form_item['idprvok']."' and datum is not null order by datum asc ");
                $z = 0;
                while ($row = $sql->fetch_assoc()) {
                    $times[$z] = $row;
                    ++$z;
                }
                for($x=0;$x<$z;$x++){
                    $time=$times[$x];
                    echo "<h4>".($x+1).". ".date("d-m-Y", strtotime($time['datum']))."</h4>";
                }

                echo "</div></div>
                <button class='showParent_btn' onclick=\"showParent('".$form_item['idprvok']."')\">Zobraz</button>";
            }

            //TODO: uprav tento prvok
            if($item_type==8){
                echo "<div class='hidden_content'>
                    <h3>".$form_item['Nazov']."</h3>
                    <div class='hidden' id='".$form_item['idprvok']."'>";
                $sql = mysqli_query($con, "select * from odpoved join vyplnenie_formulara 
                    on(vyplnenie_formulara_idVyplnenie_formulara=idVyplnenie_formulara)
                    where formular_idformular='".$form_item['formular_idformular']."'
                    AND prvok_idprvok='".$form_item['idprvok']."' and cas is not null order by cas asc ");
                $z = 0;
                while ($row = $sql->fetch_assoc()) {
                    $times[$z] = $row;
                    ++$z;
                }
                for($x=0;$x<$z;$x++){
                    $time=$times[$x];
                    echo "<h4>".($x+1).". ".$time['cas']."</h4>";
                }

                echo "</div></div>
                    <button class='showParent_btn' onclick=\"showParent('".$form_item['idprvok']."')\">Zobraz</button>";
            }

            //TODO: uprav tento prvok
            if($item_type>8 && $item_type<11){
                echo "<h3>".$form_item['Nazov']."</h3>";
                $sql=mysqli_query($con,"SELECT * FROM moznost WHERE prvok_idprvok='".$form_item['idprvok']."' ORDER by idMoznost asc");
                $z = 0;
                while ($row = $sql->fetch_assoc()) {
                    $datas[$z] = $row;
                    ++$z;
                }
                if($z>0){
                    for($n=0;$n<$z;$n++) {
                        $items=$datas[$n];
                        $sql=mysqli_query($con,"SELECT * FROM moznost WHERE moznost_idMoznost='".$items['idMoznost']."' ORDER by idMoznost asc");
                        $y = 0;
                        while ($row = $sql->fetch_assoc()) {
                            $data[$y] = $row;
                            ++$y;
                        }
                        echo "<h3>".($n+1).". ".$items['text']."</h3>";
                        if($y>0){
                            for($a=0;$a<$y;$a++) {
                                $item=$data[$a];
                                $sql=mysqli_query($con,"SELECT count(*) as sucet FROM odpoved join vyplnenie_formulara on(vyplnenie_formulara_idVyplnenie_formulara=idVyplnenie_formulara)
                                    WHERE moznost_idMoznost='".$item['idMoznost']."' and prvok_idprvok='".$items['prvok_idprvok']."' AND formular_idformular='".$form_item['formular_idformular']."'");
                                $row = $sql->fetch_assoc();
                                echo "<h4>".($n+1).".".($a+1).". ".$item['text']." - ".$row['sucet']."x (".(($row['sucet']/$celkovo)*100)."%)</h4>";
                            }
                        }
                    }
                }
            }

            //TODO: uprav tento prvok
            if($item_type==11){
                echo "<h3>".$form_item['Nazov']."</h3>";
                $min=$form_item['min'];
                $max=$form_item['max'];
                if($min>$max){
                    $tmp=$min;
                    $min=$max;
                    $max=$tmp;
                }
                if(($max-$min)>10){
                    echo "<div class='hidden_content'>
                        <div class='hidden' id='".$form_item['idprvok']."'>";
                }

                for($n=$min;$n<=$max;$n++){
                    $sql = mysqli_query($con,"select count(*) as sucet from odpoved 
                                                        where prvok_idprvok='".$form_item['idprvok']."' and hodnotenie='".$n."'");
                    $row = $sql->fetch_assoc();
                    echo "<h4>".($n).". ".$row['sucet']."x (".(($row['sucet']/$celkovo)*100)."%)</h4>";
                }

                if(($max-$min)>10){
                    echo "</div></div>
                        <button class='showParent_btn' onclick=\"showParent('".$form_item['idprvok']."')\">Zobraz</button>";
                }
            }

        }
    }

    echo "</div></div>";
}
?>