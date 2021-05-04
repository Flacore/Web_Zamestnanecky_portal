<?php
    include "../config_DB.php";
    $id=$_SESSION['session'];
    $id_person=$_POST['user_id'];
    if($id != $id_person && isset($_SESSION['session'])){
        $sql = "Delete from prirad_funkcia where os_udaje_rod_cislo='" . $id_person . "'";
        $con->query($sql);
        $sql = "Delete from login where os_udaje_rod_cislo='" . $id_person . "'";
        $con->query($sql);
        $sql = "Delete from os_udaje where rod_cislo='" . $id_person . "'";
        $con->query($sql);
        $sql = "Delete from sprava where Odosielatel='" . $id_person . "'";
        $con->query($sql);
        $sql = "Delete from konverzacia where Uzivatel1='" . $id_person . "' or Uzivatel2='" . $id_person . "'";
        $con->query($sql);
        $sql = "Delete from prihlaseny where os_udaje_rod_cislo='" . $id_person . "'";
        $con->query($sql);
        $sql = "Delete from notifikacia where os_udaje_rod_cislo='" . $id_person . "'";
        $con->query($sql);
        $sql = "Delete from precitane_blog where os_udaje_rod_cislo='" . $id_person . "'";
        $con->query($sql);
        $sql = "Delete from zalozka where os_udaje_rod_cislo='" . $id_person . "'";
        $con->query($sql);

        //Projekty + subor
        $sql = mysqli_query($con, "select idProjekt,Subor_idSubor from projekty where os_udaje_rod_cislo = '$id' ");
        $n = 0;
        while ($rows = $sql->fetch_assoc()) {
            $info[$n] = $rows;
            $n++;
        }
        for ($i=0;$i<$n;$i++){
            $data=$info[$i];
            $subor=$data['Subor_idSubor'];
            $sql = "Delete from subor where idSubor='" . $subor . "'";
            $con->query($sql);
        }
        $sql = "Delete from projekty where os_udaje_rod_cislo='" . $id_person . "'";
        $con->query($sql);

        //Inzerat + subor
        $sql = mysqli_query($con, "select id_inzerat from inzerat where os_udaje_rod_cislo = '$id'");
        $n = 0;
        while ($rows = $sql->fetch_assoc()) {
            $info[$n] = $rows;
            $n++;
        }
        for ($i=0;$i<$n;$i++){
            $data=$info[$i];
            $subor=$data['id_inzerat'];
            $sql = "Delete from subor where inzerat_id_inzerat='" . $subor . "'";
            $con->query($sql);
        }
        $sql = "Delete from inzerat where os_udaje_rod_cislo='" . $id_person . "'";
        $con->query($sql);

        //Blog + precitane
        $sql = mysqli_query($con, "select idBlog from blog where os_udaje_rod_cislo = '$id'");
        $n = 0;
        while ($rows = $sql->fetch_assoc()) {
            $info[$n] = $rows;
            $n++;
        }
        for ($i=0;$i<$n;$i++){
            $data=$info[$i];
            $subor=$data['idBlog'];
            $sql = "Delete from precitane_blog where Blog_idBlog='" . $subor . "'";
            $con->query($sql);
        }
        $sql = "Delete from blog where os_udaje_rod_cislo='" . $id_person . "'";
        $con->query($sql);

        //celoziv_vzdelavanie + subor + prihal
        $sql = mysqli_query($con, "select idprednasky,Subor_idSubor from celoziv_vzdel where os_udaje_rod_cislo = '$id' ");
        $n = 0;
        while ($rows = $sql->fetch_assoc()) {
            $info[$n] = $rows;
            $n++;
        }
        for ($i=0;$i<$n;$i++){
            $data=$info[$i];
            $subor=$data['Subor_idSubor'];
            $sql = "Delete from subor where idSubor='" . $subor . "'";
            $con->query($sql);

            $prednaska=$data['idprednasky'];
            $sql = "Delete from prihlaseny where prednasky_idprednasky='" . $prednaska . "'";
            $con->query($sql);
        }
        $sql = "Delete from celoziv_vzdel where os_udaje_rod_cislo='" . $id_person . "'";
        $con->query($sql);

        //formulare + vsetko spojene s nimi
        $sql = mysqli_query($con, "select idformular from formular where os_udaje_rod_cislo = '$id'");
        $n = 0;
        while ($rows = $sql->fetch_assoc()) {
            $formular_id[$n] = $rows;
            $n++;
        }
        for ($m=0;$m<$n;$m++){
            $formular_id_row=$formular_id[$m];
            $form_id=$formular_id_row['idformular'];


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

    }
    echo 'ok';
?>