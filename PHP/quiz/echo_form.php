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
                    $sql = mysqli_query($con, "select count(*) as sucet from vyplnenie_formulara 
                    where formular_idformular='".$form_item['formular_idformular']."'
                    AND idVyplnenie_formulara not in( SELECT vyplnenie_formulara_idVyplnenie_formulara FROM odpoved WHERE prvok_idprvok='".$form_item['idprvok']."')
                    ");
                    $row = $sql->fetch_assoc();
                    echo "<h4>Neodpovedalo: ".$row['sucet']." [".(($row['sucet']/$celkovo)*100)."%]</h4>";

                    echo "</div></div>
                <button class='showParent_btn' onclick=\"showParent('".$form_item['idprvok']."')\">Zobraz</button>";
                }

                if($item_type>2 && $item_type<6){
                    //TODO: moznosti
                }

                if($item_type==='6'){
//                    echo "<div class='hidden_content'>
//                          <div class='hidden' id='".$form_item['idprvok']."'>";
//                    //TODO: subory
//
//                    echo "</div></div>
//                <button class='showParent_btn' onclick=\"showParent('".$form_item['idprvok']."')\">Zobraz</button>";
                }

                if($item_type==7){
                    echo "<div class='hidden_content'>
                    <h3>".$form_item['Nazov']."</h3>
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
                    $sql = mysqli_query($con, "select count(*) as sucet from vyplnenie_formulara 
                    where formular_idformular='".$form_item['formular_idformular']."'
                    AND idVyplnenie_formulara not in( SELECT vyplnenie_formulara_idVyplnenie_formulara FROM odpoved WHERE prvok_idprvok='".$form_item['idprvok']."')
                    ");
                    $row = $sql->fetch_assoc();
                    echo "<h4>Neodpovedalo: ".$row['sucet']." [".(($row['sucet']/$celkovo)*100)."%]</h4>";

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
                    $sql = mysqli_query($con, "select count(*) as sucet from vyplnenie_formulara 
                    where formular_idformular='".$form_item['formular_idformular']."'
                    AND idVyplnenie_formulara not in( SELECT vyplnenie_formulara_idVyplnenie_formulara FROM odpoved WHERE prvok_idprvok='".$form_item['idprvok']."')
                    ");
                    $row = $sql->fetch_assoc();
                    echo "<h4>Neodpovedalo: ".$row['sucet']." [".(($row['sucet']/$celkovo)*100)."%]</h4>";

                    echo "</div></div>
                <button class='showParent_btn' onclick=\"showParent('".$form_item['idprvok']."')\">Zobraz</button>";
                }

                if($item_type>8 && $item_type<11){
                    //TODO: Matrix
                }
                if($item_type==11){
                    //TODO:hodnota
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
    //TODO: for formular

    echo "</div></div>";
}
?>