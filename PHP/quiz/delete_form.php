<?php
    include "../config_DB.php";
    $form_id=$_POST['id'];
    $sql = mysqli_query($con, "select * from formular where idformular='" . $form_id . "'");
    $i = 0;
    while ($row = $sql->fetch_assoc()) {
        $id_list[$i] = $row;
        ++$i;
    }
    if ($i == 1) {

        //Subor -> Odpoveď -> Vyplnenie formulára
        $sql = mysqli_query($con, "select * from vyplnenie_formulara where formular_idformular='" . $form_id . "' order by vyplnenie asc");
        $v = 0;
        while ($row = $sql->fetch_assoc()) {
            $data_vyplnenie[$v] = $row;
            ++$v;
        }
        if($v>0) {
            for ($vyplnenie=0;$vyplnenie<$v;$vyplnenie++) {
                $line=$data_vyplnenie[$vyplnenie];
                $sql = mysqli_query($con, "select * from odpoved where vyplnenie_formulara_idVyplnenie_formulara='" . $line['idVyplnenie']. "'");
                $o = 0;
                while ($row = $sql->fetch_assoc()) {
                    $data_odpoved[$o] = $row;
                    ++$o;
                }
                if($o>0){
                    for($odpoved=0;$odpoved<$o;$odpoved++){
                        $subline=$data_odpoved[$odpoved];
                        $sql = "Delete from subor where idSubor='" . $subline['Subor_idSubor']. "'";
                        $con->query($sql);
                    }
                    $sql = "Delete from odpoved where vyplnenie_formulara_idVyplnenie_formulara='" . $data_vyplnenie['idVyplnenie']. "'";
                    $con->query($sql);
                }

            }
            $sql = "Delete from vyplnenie_formulara where idVyplnenie_formulara='" . $form_id . "'";
            $con->query($sql);
        }


        //Subor -> Obsah / Moznost -> prvok
        $sql = mysqli_query($con, "select * from prvok where formular_idformular='" . $form_id . "'");
        $v = 0;
        while ($row = $sql->fetch_assoc()) {
            $data_prvok[$v] = $row;
            ++$v;
        }
        if($v>0) {
            for ($prvok=0;$prvok<$v;$prvok++) {
                $line=$data_prvok[$prvok];

                $sql = mysqli_query($con, "select * from obsah where prvok_idprvok ='" . $line['idprvok']. "'");
                $o = 0;
                while ($row = $sql->fetch_assoc()) {
                    $data_obsah[$o] = $row;
                    ++$o;
                }
                if($o>0){
                    for($obsah=0;$obsah<$o;$obsah++){
                        $subline=$data_obsah[$obsah];
                        $sql = "Delete from subor where idSubor='" . $subline['Subor_idSubor']. "'";
                        $con->query($sql);
                    }
                    $sql = "Delete from obsah where prvok_idprvok ='" . $line['idprvok']. "'";
                    $con->query($sql);
                }

                $sql = mysqli_query($con, "select * from moznost where prvok_idprvok ='" . $line['idprvok']. "'");
                $o = 0;
                while ($row = $sql->fetch_assoc()) {
                    $data_obsah[$o] = $row;
                    ++$o;
                }
                if($o>0){
                    $sql = "Delete from moznost where prvok_idprvok ='" . $line['idprvok']. "'";
                    $con->query($sql);
                }

            }
            $sql = "Delete from prvok where formular_idformular='" . $form_id . "'";
            $con->query($sql);
        }


        $sql = "Delete from formular where idformular='" . $form_id . "'";
        $con->query($sql);
    }
?>