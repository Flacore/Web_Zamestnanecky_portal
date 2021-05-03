<?php
    include "../PHP/config_DB.php";
    if(!isset($_SESSION['session'])){
        header('Location: Main_Site.php');
    }
    $id=$_SESSION['session'];
    $sql = mysqli_query($con, "
            SELECT count(*) as counter from os_udaje 
            where rod_cislo ='".$id."'
        ");
    $info = $sql->fetch_assoc();

    if(isset($_POST['but_logout'])|| $info['counter']==0){
        session_destroy();
        header('Location: Main_Site.php');
    }

    $sql = mysqli_query($con, "
        SELECT * from os_udaje ou
        join prirad_funkcia pf on(ou.rod_cislo = pf.os_udaje_rod_cislo)
        join pravomoci po on(po.funkcie_idPozícia = pf.funkcie_idPozícia)
        where pf.do is null and ou.rod_cislo ='".$id."'
    ");
    $info = $sql->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zamestnanecký portál</title>

    <link rel="stylesheet" href="../CSS/System/systemMenu.css">
    <link rel="stylesheet" href="../CSS/System/system.css">

    <link rel="stylesheet" href="../CSS/System/homeComponent.css">
    <link rel="stylesheet" href="../CSS/System/Slideshow.css">
    <link rel="stylesheet" href="../CSS/System/MessengerAndBlog.css">
    <link rel="stylesheet" href="../CSS/HomeSite/tables.css">
    <link rel="stylesheet" href="../CSS/text.css">
    <link rel="stylesheet" href="../CSS/System/contacts.css">
    <link rel="stylesheet" href="../CSS/System/Settings.css">
    <link rel="stylesheet" href="../CSS/System/modal_window.css">
    <link rel="stylesheet" href="../CSS/System/file_list.css">
    <link rel="stylesheet" href="../CSS/System/quiz.css">
    <link rel="stylesheet" href="../CSS/inzercia.css">
    <script src="../JS/MainSite/system_functionality.js"></script>
    <script src="../JS/MainSite/system_onClick.js"></script>
    <script src="../JS/MainSite/modal_window.js"></script>
    <style>
        .full-width{
            width: 100%;
        }

        .overflow-scroll{
            overflow-x: scroll;
        }

        /*Insert MessengerAndBlog*/
        .myBlog{
            float: left;
            margin-left: 20px;
            cursor: pointer;
            width: 70px;
            height: auto;
            background-color: #3cc5aa;
            border-radius: 100%;
        }

        .myBlog span{
            color: white;
            text-align: center;
            margin: 10px;
            font-size: 40px;
        }

        .newBlog{
            float: right;
            margin-right: 20px;
            cursor: pointer;
            width: 70px;
            height: auto;
            background-color: #3cc5aa;
            border-radius: 100%;
        }

        .newBlog span{
            color: white;
            text-align: center;
            margin: 10px;
            font-size: 40px;
        }

        .blog-item-read{
            background-color: #28559A;
            min-height: 100px !important;
            height: auto !important;
        }

        /*Insert into inzercia*/
        #ad_list table{
            width: 100%;
        }

        #ad_list table tr th,
        #ad_list table tr td{
            border: solid 1px black;
        }

        #ad_list table tr th{
            background-color: #28559A;
            color: white;
            text-align: center;
        }

        #ad_list table tr td{
            background-color: #81c43c;
        }
    </style>
    <script>
        //add to modal window
        function  add_link(login_id,zalozka=false) {
            clear_form();
            close_modal();
            let modal = document.getElementById("modal_links");
            modal.style.display = "block";

            var module = document.getElementById("adding_link");
            module.classList.remove("hidden");
            if(zalozka){
                if (login_id != "admin") {
                    var input = document.getElementById("idlogin");
                    input.value = login_id;
                    document.getElementById("poskupina_link").classList.add("hidden");
                    document.getElementById("poskupina_link").value = null;
                    document.getElementById("poskupina_link").value = 0;
                }else{
                    document.getElementById("poskupina_link").classList.remove("hidden");
                }
            }else{
                var link = document.getElementById("Link");
                link.classList.add("hidden");
                var link_t = document.getElementById("Link_Text");
                link_t.classList.add("hidden");
                document.getElementById("poskupina_link").classList.add("hidden");
                document.getElementById("poskupina_link").value = 0;
            }
        }


        function edit_links(login_id,zalozka=false) {
            clear_form();
            close_modal();
            let modal = document.getElementById("modal_links");
            modal.style.display = "block"

            if(zalozka) {
                if (login_id != "admin") {
                    var module = document.getElementById("edit_link_self");
                    module.classList.remove("hidden");
                    document.getElementById("poskupina_link").classList.add("hidden");
                    document.getElementById("poskupina_link").value = 0;
                } else {
                    var module = document.getElementById("edit_link_all");
                    module.classList.remove("hidden");
                    document.getElementById("poskupina_link").classList.remove("hidden");
                }
            }else{
                var module = document.getElementById("edit_files_category");
                module.classList.remove("hidden");
                document.getElementById("poskupina_link").classList.add("hidden");
                document.getElementById("poskupina_link").value = 0;
            }
        }

        //Other

        function hideDropdowns(){
            var dropdownContent1 = document.getElementById("Marks_container");
            var dropdownContent2 = document.getElementById("Links_container");
            var dropdownContent3 = document.getElementById("Personal_container");
            var dropdownContent4 = document.getElementById("System_container");
            var dropdownContent5 = document.getElementById("Admin_container");
            var dropdownContent6 = document.getElementById("Documents_container");
            dropdownContent1.style.display = "none";
            dropdownContent2.style.display = "none";
            dropdownContent3.style.display = "none";
            dropdownContent4.style.display = "none";
            if(dropdownContent5 != null)
                dropdownContent5.style.display = "none";
            dropdownContent6.style.display = "none";
        }

        //modal-window
        function delete_ad(id) {
            $.ajax({
                type: 'POST',
                data: {id: id,typ: 2},
                url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/System/ad_editing.php',
                success: function(data) {
                }
            });
        }

        // modal-Window
        function close_modal_ad() {
            let modal = document.getElementById("modal_ad");
            modal.style.display = "none";
            document.getElementById("ad_form_item").classList.add('hidden');
            document.getElementById("ad_form_cat").classList.add('hidden');
            document.getElementById("ad_list").classList.add('hidden');
            document.getElementById("cat_list").classList.add('hidden');
        }

        function close_modal_career(){
            let modal = document.getElementById("modal_career");
            modal.style.display = "none";
            document.getElementById("ad_career").classList.add('hidden');
            document.getElementById("my_career").classList.add('hidden');
        }

        function close_modal_place(){
            let modal = document.getElementById("modal_place");
            modal.style.display = "none";
        }

        function close_modal_blog(){
            let modal = document.getElementById("modal_blog");
            modal.style.display = "none";
        }

        function open_modal_blog(){
            let modal = document.getElementById("modal_blog");
            modal.style.display = "block";
        }

        function close_modal_curses(){
            let modal = document.getElementById("modal_curses");
            modal.style.display = "none";
            document.getElementById("ad_curse").classList.add('hidden');
            document.getElementById("my_curses").classList.add('hidden');
            document.getElementById("curses_loged").classList.add('hidden');
        }

        function  delete_project(id) {
            $.ajax({
                type: 'POST',
                data: {id: id},
                url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/delete_project.php',
                success: function(data) {
                    location.reload();
                }
            });
        }

        function  list_kurz(id) {
            $.ajax({
                type: 'POST',
                data: {id: id},
                url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/System/logged_list.php',
                success: function(data) {
                    document.getElementById('curses_loged').innerHTML= data;
                    document.getElementById("ad_curse").classList.add('hidden');
                    document.getElementById("my_curses").classList.add('hidden');
                    document.getElementById("curses_loged").classList.remove('hidden');
                }
            });
        }

        function  delete_kurz(id) {
            $.ajax({
                type: 'POST',
                data: {id: id},
                url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/delete_kurz.php',
                success: function(data) {
                    location.reload();
                }
            });
        }

        function  delete_cat(id) {
            $.ajax({
                type: 'POST',
                data: {id: id},
                url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/delete_category.php',
                success: function(data) {
                    location.reload();
                }
            });
        }

        function open_modal_nt() {
            $.ajax({
                type: 'POST',
                url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/update_notific.php',
                success: function(data) {
                    let modal = document.getElementById('modal_notification');
                    modal.style.display = "block"
                    document.getElementById('notification_list').classList.remove('hidden');
                    document.getElementById('notification_form').classList.add('hidden');
                }
            });
        }

        function  delete_blog(id) {
            $.ajax({
                type: 'POST',
                data: {id: id},
                url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/delete_blog.php',
                success: function(data) {
                    location.reload();
                }
            });
        }

    </script>
</head>
<body onload="fLoad()">

<div class="modal" id="modal_blog">
    <div class="modal-content">
        <span class="close-btn" onclick="close_modal_blog()">&times;</span>
            <?php
            $sql = mysqli_query($con, "select * from blog where os_udaje_rod_cislo='".$id."'");
            $i = 0;
            while ($rows = $sql->fetch_assoc()) {
                $data[$i] = $rows;
                ++$i;
            }

            $n=$i;

            if($n>0){
                echo "       
               <div class=\"position tableStyle\">
                    <table>
                        <tr>
                            <th>Dátum</th>
                            <th>Nazov</th>
                            <th></th>
                        </tr>
                        <div>";
                for ($i = 0; $i < $n; $i++) {
                    $row = $data[$i];
                    echo "               
                         <div>
                                <tr>
                                    <td>" .  date('d.m.Y',strtotime($row['datum'])) . "</td>
                                    <td>
                                        " . $row['nadpis'] . "
                                    </td>
                                    <td><button onclick=\"delete_blog('" . $row['idBlog'] . "')\" class=\"carier-btn\">Vymazať</button></td>
                                </tr>
                            </div>
                        ";
                }
                echo "    </table>
                      </div>";
            }else{
                echo "<h3>Neexistuje žiaden vami vytvorení blog.</h3>";
            }

            ?>
    </div>
</div>

<div class="modal" id="modal_place">
    <div class="modal-content">
        <span class="close-btn" onclick="close_modal_place()">&times;</span>
        <form action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/add_place.php" method="post">
            <div class="center">
                <h3>Pridávanie mesta</h3>
            </div>
            <div class="center">
                <label>Názov miesta</label>
                <input type="text" name="Nazov" required>
            </div>
            <input type="submit" value="Odoslať">
        </form>

    </div>
</div>

<div class="modal" id="modal_career">
    <div class="modal-content">
        <span class="close-btn" onclick="close_modal_career()">&times;</span>

        <div id="ad_career" class="hidden">
            <form id="form_file" enctype="multipart/form-data" method="post" action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/create_project.php">
                <div class="center">
                    <h3>Vytvaranie projektu.</h3>
                </div>
                <div class="center">
                    <label>Popis</label>
                    <input type="text" name="desc" required>
                </div>
                <div class="center">
                    <label>Verejné zobrazenie</label>
                    <input type="checkbox" name="verejne">
                </div>
                <div class="center">
                    <label>Nahraj súbor:</label>
                </div>
                <input class="center" type="file" required id="file_path" name="file_path"
                       accept=".doc, .docx,.pdf">
                <input type="submit" value="Odoslať">
            </form>
        </div>

        <div id="my_career" class="hidden">
            <h3 class="center">Zoznam mojich, vytvoreních zadaní.</h3>
            <?php
            $sql = mysqli_query($con, "select * from projekty where  os_udaje_rod_cislo='".$id."' order by datum asc");
            $num = mysqli_query($con, "select count(*) as NumberData from projekty where os_udaje_rod_cislo='".$id."'");
            $num_row=mysqli_fetch_array($num);
            $n=$num_row['NumberData'];
            $i = 0;
            while ($rows = $sql->fetch_assoc()){
                $data[$i]=$rows;
                ++$i;
            }

            if($n>0 && $i>0) {
                echo "       
               <div class=\"position tableStyle\">
                    <table>
                        <tr>
                            <th>Dátum</th>
                            <th>Popis</th>
                            <th>Na stiahnutie</th>
                        </tr>
                        <div>";
                for ($i = 0; $i < $n; $i++) {
                    $row = $data[$i];
                    if($row['verejne']==0 || $row['verejne']==1) {
                        echo "               
                         <div>
                                <tr>
                                    <td>" .  date('d.m.Y',strtotime($row['datum'])) . "</td>
                                    <td>
                                        " . $row['popis'] . "
                                    </td>
                                    <td><button onclick=\"delete_project('".$row['idProjekt']."')\" class=\"carier-btn\">Vymazať</button></td>
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
        </div>

    </div>
</div>


<div class="modal" id="modal_curses">
    <div class="modal-content">
        <span class="close-btn" onclick="close_modal_curses()">&times;</span>

        <div id="ad_curse" class="hidden">
            <form id="form_file" enctype="multipart/form-data" method="post" action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/create_curse.php">
                <div class="center">
                    <h3>Vytvaranie kurzu.</h3>
                </div>
                <div class="center">
                    <label>Nazov</label>
                    <input type="text" name="name" required>
                </div>
                <div class="center">
                    <label>Popis</label>
                    <input type="text" name="desc">
                </div>
                <div class="center">
                    <label>Cena</label>
                    <input type="number" step="0.01"  name="price" value="0">
                </div>
                <div class="center">
                    <label>Miesto</label>
                    <input type="text" name="place" required>
                </div>
                <div class="center">
                    <label>Dátum</label>
                    <input type="date" name="date" required>
                </div>
                <div class="center">
                    <label>Čas</label>
                    <input type="time" name="time" required>
                </div>
                <div class="center">
                    <label>Verejné zobrazenie</label>
                    <input type="checkbox" name="verejne">
                </div>
                <div class="center">
                    <label>Nahraj súbor:</label>
                </div>
                <input class="center" type="file" required id="file_path" name="file_path"
                accept="image/*">
                <input type="submit" value="Odoslať">
            </form>
        </div>

        <div id="my_curses" class="hidden">
            <h3 class="center">Zoznam mňou vytvoreních kurzou kurzov.</h3>
            <div class="position tableStyle">
            <?php
            $sql = mysqli_query($con, "select *, COUNT(pr.os_udaje_rod_cislo) as pocet
                                                from celoziv_vzdel cv left join prihlaseny pr on(cv.idprednasky=pr.prednasky_idprednasky)
                                                where cv.os_udaje_rod_cislo='".$id."'
                                                group BY idprednasky");
            $i = 0;
            while ($rows = $sql->fetch_assoc()){
                $data[$i]=$rows;
                ++$i;
            }
            $n=$i;

            if($n>0) {
                echo "       
                      <table>
                        <tr>
                            <th>Datum</th>
                            <th>Nazov</th>
                            <th>Počet prihlásených</th>
                            <th></th>
                            <th></th>
                        </tr>";
                for ($i = 0; $i < $n; $i++) {
                    $row = $data[$i];
                    if(true) {
                        if($row['cena']==null || $row['cena']==0)
                            $cena="n/a";
                        else
                            $cena=$row['cena'];
                        echo "               
                             <tr>
                                    <td>". date('d.m.Y',strtotime($row['datum']))."</td>
                                    <td>".$row['nazov']."</td>
                                    <td>".$row['pocet']."</td>
                                    <td><button onclick=\"list_kurz('".$row['idprednasky']."')\" class=\"carier-btn\">List prihlásených</button></td>
                                    <td><button onclick=\"delete_kurz('".$row['idprednasky']."')\" class=\"carier-btn\">Vymazať</button></td>
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
            </div>
        </div>

        <div id="curses_loged" class="hidden">
            <h3 class="center">Prehlad prihlas ludi</h3>
        </div>

    </div>
</div>

    <div class="modal" id="modal_ad">
        <div class="modal-content">
            <span class="close-btn" onclick="close_modal_ad()">&times;</span>

            <div id="ad_list" class="hidden">
                <div class="center">
                    <h3>Zoznam mojich inzerátov.</h3>
                </div>
                <?php

                $sql = mysqli_query($con, "SELECT * FROM inzerat left join kategoria on(inzerat.kategoria_id_kategoria = kategoria.id_kategoria) 
                                                where os_udaje_rod_cislo='".$id."' order by vytvorenie desc");
                $k = 0;
                while ($rows = $sql->fetch_assoc()) {
                    $_data[$k] = $rows;
                    ++$k;
                }
                if($k > 0){

                    echo "       
                    <table>
                    <tr>
                        <th>Datum</th>
                        <th>Nazov</th>
                        <th>Kategória</th>
                        <th></th>
                    </tr>";

                    for($i = 0; $i < $k; $i++){
                        $row=$_data[$i];
                        echo "               
                             <tr >
                                <td>".$row['vytvorenie']."</td>
                                <td>".$row['Titulok']."</td>";

                        if($row['kategoria_id_kategoria']==null){
                            echo"<td>Nezaradené</td>";
                        }else{
                            echo"<td>".$row['Názov']."</td>";
                        }

                        echo" <td><button onclick=\"delete_ad('".$row['id_inzerat']."')\" class=\"carier-btn\">Vymazať</button></td>
                            </tr>";
                    }

                    echo "
                    </table>";
                }else{
                    echo "<h3>Nevytvorili ste žiadny inzerát.</h3>";
                }

                ?>
            </div>
            <div id="cat_list" class="hidden">
                <div class="center">
                    <h3>Zoznam kategórií.</h3>
                </div>
                <div class="tableStyle">
                <?php

                $sql = mysqli_query($con, "SELECT id_kategoria,Názov,count(id_inzerat) as pocet FROM kategoria left join inzerat ON(id_kategoria=kategoria_id_kategoria)");
                $k = 0;
                while ($rows = $sql->fetch_assoc()) {
                    $_data[$k] = $rows;
                    ++$k;
                }
                if($k > 0){

                    echo "       
                    <table>
                    <tr>
                        <th>Nazov</th>
                        <th>Počet inzerátov</th>
                        <th></th>
                    </tr>";

                    for($i = 0; $i < $k; $i++){
                        $row=$_data[$i];
                        echo "               
                             <tr >
                                <td>".$row['Názov']."</td>
                                <td>".$row['pocet']."</td>";

                        echo" <td><button onclick=\"delete_cat('".$row['id_kategoria']."')\" class=\"carier-btn\">Vymazať</button></td>
                            </tr>";
                    }

                    echo "
                    </table>";
                }else{
                    echo "<h3>Neexistuje žiadna vytvorená kategória.</h3>";
                }

                ?>
                </div>
            </div>
            <div id="ad_form_cat" class="hidden">
                <div class="center">
                    <h3>Pridávanie kategórie.</h3>
                </div>
                <form id="form_file" enctype="multipart/form-data" method="post" action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/System/ad_editing.php">
                    <input class="hidden" type="number" value="3" name="typ">
                    <div class="center">
                        <label>Názov</label>
                        <input type="text" name="Nazov" required>
                    </div>
                    <div class="center">
                        <label>Nahraj súbor:</label>
                    </div>
                    <input class="center" type="file" required id="file_path" name="file_path"
                           accept="image/*">
                    <input type="submit" value="Odoslať">
                </form>
            </div>

            <div id="ad_form_item" class="hidden">
                <div class="center">
                    <h3>Pridávanie inzerátu.</h3>
                </div>
                <form id="form_file" enctype="multipart/form-data" method="post" action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/System/ad_editing.php">
                    <input class="hidden" type="number" value="2" name="typ">
                    <div class="center">
                        <label>Názov</label>
                        <input type="text" name="Nazov" required>
                    </div>
                    <div class="center">
                        <label>Popis</label>
                        <input type="text" name="Popis" required>
                    </div>
                    <div class="center">
                        <label>Zobraziť telefón.</label>
                        <input type="checkbox" name="tel">
                    </div>
                    <div class="center">
                        <label>Cena.</label>
                        <input type="number" step=".01" name="cena" value="0" min="0">
                    </div>
                    <div class="center">
                        <label for="cat">Kategória.</label>
                        <select id="cat" name="cat">
                            <option value="-1">Nezaradené</option>
                            <?php
                            $sql = mysqli_query($con, "SELECT * FROM kategoria");
                            $k = 0;
                            while ($rows = $sql->fetch_assoc()) {
                                $_data[$k] = $rows;
                                ++$k;
                            }
                            for($i=0; $i<$k; $i++){
                                $row=$_data[$i];
                                echo "<option value=\"".$row['id_kategoria']."\">".$row['Názov']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="center">
                        <label>Nahraj súbor:</label>
                    </div>
                    <input class="center" type="file" required id="file_path" name="file_path"
                           accept="image/*">
                    <input type="submit" value="Odoslať">
                </form>
            </div>

        </div>
    </div>

    <div class="modal" id="modal_notification">
        <div class="modal-content">
            <span class="close-btn" onclick="close_modal_nt()">&times;</span>
            <div class="hidden" id="notification_list">
                <?php
                $sql = mysqli_query($con, "select * from notifikacia where Videne='0' and os_udaje_rod_cislo='".$id."' order by datum asc");
                $i = 0;
                while ($rows = $sql->fetch_assoc()) {
                    $data[$i] = $rows;
                    ++$i;
                }

                if($i>0){
                    for($index=0;$index<$i;$index++){
                        $line=$data[$index];
                        if($line['text']!=null)
                            echo "<div class='nt_seen'>";
                        else
                            echo "<div class='nt_unseen'>";
                        echo "      <h3 class='col-sm-12'>".$line['text']."</h3>
                                    <h5 class=' col-sm-12'>". date('d.m.Y',strtotime($line['datum']))."</h5>
                              </div>";
                    }
                }else{
                    echo "<h3>Neexistuje žiadna notifikácia.</h3>";
                }

                ?>
            </div>
            <div class="hidden" id="notification_form">
                <span class="close-btn" onclick="close_ntForm()">&times;</span>
                <form method="post" action="">
                    <label>Zadaj text notifikácie:</label>
                    <input type="text" name="text" required>
                    <input type="submit">
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="modal_file">
        <div class="modal-content">
            <span class="close-btn" onclick="close_modal_file()">&times;</span>

            <form id="form_file" enctype="multipart/form-data" method="post" action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/add_file.php">
                <input type="number" class="hidden" value="null" id="idFile" name="idFile">
                <input type="number" class="hidden" value="null" id="idPrednaska_file" name="idPrednaska">
                <input type="number" class="hidden" value="null" id="idPozicia_file" name="idPozicia">
                <input type="number" class="hidden" value="null" id="idSubor_file" name="idSubor">
                <div class="center">
                    <label>Názov</label>
                    <input type="text" required id="name" name="name">
                </div>
                <div class="center">
                    <label>Popis</label>
                    <input type="text" id="description" name="description">
                </div>
                <br>
                <div class="center">
                    <label>Nahraj súbor:</label>
                </div>
                <input class="center" type="file" required id="file_path" name="file_path">
                <br>
                <input class="col-sm-12 btn-submit center-icon" type="submit" value="Odoslať" name="button_file">
            </form>

        </div>
    </div>

    <div class="modal" id="modal_links">
        <div class="modal-content">
            <span class="close-btn" onclick="close_modal()">&times;</span>
                <div class="hidden" id="adding_link">
                    <form id="link_form" action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/add_link.php" method="post">
                        <input class="hidden" value="" id="idlogin" name="idLogin">
                        <input class="hidden" value="" id="id_Link" name="idLink">
                        <div class="center">
                            <label>Zadaj nazov:</label>
                            <input value="" id="Name" name="Name" required>
                        </div>
                        <div class="center">
                            <label id="Link_Text">Zadaj link na stranku:</label>
                            <input value="" id="Link" name="Link" required>
                        </div>
                        <div>
                            <input class="hidden" value="glyphicon-heart" id="icon_value" name="icon">
                            <div class="glyphicon_change left" onclick="prevGlyph()">
                                    <span class="glyphicon glyphicon-arrow-left">
                            </div>
                            <div class="glyphicon_change right" onclick="nextGlyph()">
                                <span class="glyphicon glyphicon-arrow-right">
                            </div>
                            <div class="center_item">
                                        <span id="showing_icon" class="glyphicon glyphicon-heart">
                            </div>
                        </div>
                        <div class="center">
                            <select name="podskupina" id="poskupina_link" >
                                <option value="1">Dôležité</option>
                                <option value="2">Základné</option>
                                <option value="3">Ostatné</option>
                            </select>
                        </div>
                        <br>
                        <input type="submit" class="col-sm-12 btn-submit center-icon" name="Sub" value="Potvrdiť">
                    </form>
                </div>

                <div class="hidden" id="edit_link_all">
                        <?php
                        $sql = mysqli_query($con, "select * from zalozka where os_udaje_rod_cislo is null and link is not null order by Nazov asc");
                        $i = 0;
                        while ($rows = $sql->fetch_assoc()) {
                            $data[$i] = $rows;
                            ++$i;
                        }

                        echo "<br><hr>";
                        if($i>0) {
                            for ($j = 0; $j < $i; $j++) {
                                $row = $data[$j];
                                $id_link=$row['idZalozka'];
                                $link=$row['link'];
                                $glyphicon=$row['glyphicon'];
                                $nazov=$row['Nazov'];
                                echo "
                                 <div>
                                    <h3><span class='glyphicon ".$glyphicon."'> ".$nazov."</h3>
                                        <div class='edit_link_bt glyphicon_change' onclick=\"edit_link('".$id_link."','".$nazov."','".$link."','".$glyphicon."')\">
                                            <span class=\"glyphicon glyphicon-edit\">
                                        </div>
                                        <div class=\"remove_link_bt glyphicon_change delete_link\" >
                                            <value style='display: none'>".($id_link)."</value>   
                                            <span class=\"glyphicon glyphicon-remove\">
                                        </div>
                                 </div>
                                 <hr>
                                ";
                            }
                        }
                        ?>
                </div>

                <div class="hidden" id="edit_link_self">
                        <?php
                        $sql = mysqli_query($con, "select * from zalozka where os_udaje_rod_cislo='".$id."' and link is not null order by Nazov asc");
                        $i = 0;
                        while ($rows = $sql->fetch_assoc()) {
                            $data[$i] = $rows;
                            ++$i;
                        }

                        echo "<br><hr>";
                        if($i>0) {
                            for ($j = 0; $j < $i; $j++) {
                                $row = $data[$j];
                                $id_link=$row['idZalozka'];
                                $link=$row['link'];
                                $glyphicon=$row['glyphicon'];
                                $nazov=$row['Nazov'];
                                echo "
                                 <div>
                                    <h3><span class='glyphicon ".$glyphicon."'> ".$nazov."</h3>
                                        <div class='edit_link_bt glyphicon_change' onclick=\"edit_link('".$id_link."','".$nazov."','".$link."','".$glyphicon."')\">
                                            <span class=\"glyphicon glyphicon-edit\">
                                        </div>
                                        <div class=\"remove_link_bt glyphicon_change delete_link\" >
                                            <value style='display: none'>".($id_link)."</value>   
                                            <span class=\"glyphicon glyphicon-remove\">
                                        </div>
                                 </div>
                                 <hr>
                                ";
                            }
                        }
                        ?>
                </div>

            <div class="hidden" id="edit_files_category">
                <?php
                $sql = mysqli_query($con, "select * from zalozka where os_udaje_rod_cislo is null and link is null order by Nazov asc");
                $i = 0;
                while ($rows = $sql->fetch_assoc()) {
                    $data[$i] = $rows;
                    ++$i;
                }

                echo "<br><hr>";
                if($i>0) {
                    for ($j = 0; $j < $i; $j++) {
                        $row = $data[$j];
                        $id_link=$row['idZalozka'];
                        $link=$row['link'];
                        $glyphicon=$row['glyphicon'];
                        $nazov=$row['Nazov'];
                        echo "
                                 <div>
                                    <h3><span class='glyphicon ".$glyphicon."'> ".$nazov."</h3>
                                        <div class='edit_link_bt glyphicon_change' onclick=\"edit_link('".$id_link."','".$nazov."','".$link."','".$glyphicon."')\">
                                            <span class=\"glyphicon glyphicon-edit\">
                                        </div>
                                        <div class=\"remove_link_bt glyphicon_change delete_link\" >
                                            <value style='display: none'>".($id_link)."</value>   
                                            <span class=\"glyphicon glyphicon-remove\">
                                        </div>
                                 </div>
                                 <hr>
                                ";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="topnav" id="myTopnav">
        <form method='post' action="">
            <input class="btn-submit" type="submit" value="Logout" name="but_logout"></input>
        </form>
    </div>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <a class="menuItem" href="#" id="homeButton"><span class="glyphicon glyphicon-home"></span> Domov</a>

        <a class="menuItem" id="System">System
            <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-container" id="System_container">
            <a class="menuItem" href="#" id="messegesButton"><span class="glyphicon glyphicon-comment"></span> Správy</a>
            <a class="menuItem" href="#" id="contactsButton"><span class="glyphicon glyphicon-book"></span> Kontakty</a>
            <a class="menuItem" href="#" id="cursesButton"><span class="glyphicon glyphicon-edit"></span>Celoživotné vzdelávanie</a>
            <a class="menuItem" href="#" id="carierButton"><span class="glyphicon glyphicon-briefcase"></span> Projekty</a>
            <a class="menuItem" href="#" id="blogButton"><span class="glyphicon glyphicon-pencil"></span> Blog</a>
            <a class="menuItem" href="#" id="sellButton"><span class="glyphicon glyphicon-usd"></span> Inzercia</a>
            <?php
            if($info['Dotazniky']==1){
                echo "
             <a class=\"menuItem\" href=\"#\" id=\"quizButton\"><span class=\"glyphicon glyphicon-copy\"></span> Dotazníky a Formuláre</a>
                ";
            }
            ?>
        </div>

        <a class="menuItem" id="Documents">Tlačivá a dokumenty
            <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-container" id="Documents_container">
            <?php
            $sql = mysqli_query($con, "select * from zalozka where os_udaje_rod_cislo is null and link is null order by Nazov asc");
            $i = 0;
            while ($rows = $sql->fetch_assoc()) {
                $data[$i] = $rows;
                ++$i;
            }

            if($i>0) {
                for ($j = 0; $j < $i; $j++) {
                    $row = $data[$j];
                    $link=$row['link'];
                    $glyphicon=$row['glyphicon'];
                    $nazov=$row['Nazov'];
                    echo "
                     <a class=\"menuItem down_button\"><value class='hidden'>".$row['idZalozka']."</value><span class=\"glyphicon ".$glyphicon."\"></span> ".$nazov."</a>
                    ";
                }
            }
            ?>
            <?php
            if($info['Dokumenty']==1){
                echo "
            <a class=\"menuItem link_adder\">
                <div class=\"link_button\" onclick=\"edit_links('<?php echo $id; ?>',false)\"><span class=\"glyphicon glyphicon-pencil\"></span></div>
                <div class=\"link_button\" onclick=\"add_link('<?php echo $id; ?>',false)\"><span class=\"glyphicon glyphicon-plus\"></span></div>
            </a>
                ";
            }
            ?>
        </div>

        <a class="menuItem" id="Links">Dôležité odkazy
                <i class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-container" id="Links_container">
                <?php
                $sql = mysqli_query($con, "select * from zalozka where podskupina='1' and os_udaje_rod_cislo is null and link is not null order by Nazov asc");
                $i = 0;
                while ($rows = $sql->fetch_assoc()) {
                    $data[$i] = $rows;
                    ++$i;
                }

                if($i>0) {
                    for ($j = 0; $j < $i; $j++) {
                        $row = $data[$j];
                        $link=$row['link'];
                        $glyphicon=$row['glyphicon'];
                        $nazov=$row['Nazov'];
                        echo "
                     <a class=\"menuItem\" target=\"_blank\" href=\"".$link."\"><span class=\"glyphicon ".$glyphicon."\"></span> ".$nazov."</a>
                    ";
                    }
                }
                ?>
                    <?php
                    $sql = mysqli_query($con, "select * from zalozka where podskupina='2' and os_udaje_rod_cislo is null and link is not null order by Nazov asc");
                    $i = 0;
                    while ($rows = $sql->fetch_assoc()) {
                        $data[$i] = $rows;
                        ++$i;
                    }

                    if($i>0) {
                        echo "
                                        <a class=\"menuItem\" id=\"Major\">Základné odkazy
                                            <i class=\"fa fa-caret-down\"></i>
                                        </a>
                                        <div class=\"dropdown-container\" id=\"Major_container\">
                        ";
                        for ($j = 0; $j < $i; $j++) {
                            $row = $data[$j];
                            $link=$row['link'];
                            $glyphicon=$row['glyphicon'];
                            $nazov=$row['Nazov'];
                            echo "
                     <a class=\"menuItem\" target=\"_blank\" href=\"".$link."\"><span class=\"glyphicon ".$glyphicon."\"></span> ".$nazov."</a>
                    ";
                        }
                        echo "</div>";
                    }
                    ?>

                    <?php
                    $sql = mysqli_query($con, "select * from zalozka where podskupina='3' and os_udaje_rod_cislo is null and link is not null order by Nazov asc");
                    $i = 0;
                    while ($rows = $sql->fetch_assoc()) {
                        $data[$i] = $rows;
                        ++$i;
                    }

                    if($i>0) {
                        echo"
                                            <a class=\"menuItem\" id=\"Others\">Ostatne odkazy
                                                <i class=\"fa fa-caret-down\"></i>
                                            </a>
                                            <div class=\"dropdown-container\" id=\"Others_container\">
                        ";

                        for ($j = 0; $j < $i; $j++) {
                            $row = $data[$j];
                            $link=$row['link'];
                            $glyphicon=$row['glyphicon'];
                            $nazov=$row['Nazov'];
                            echo "
                     <a class=\"menuItem\" target=\"_blank\" href=\"".$link."\"><span class=\"glyphicon ".$glyphicon."\"></span> ".$nazov."</a>
                    ";
                        }
                        echo "</div>";
                    }
                    ?>
            <?php
            if($info['Zalozky']==1){
                echo "
            <a class=\"menuItem link_adder\">
                <div class=\"link_button\" onclick=\"edit_links('admin',true)\"><span class=\"glyphicon glyphicon-pencil\"></span></div>
                <div class=\"link_button\" onclick=\"add_link('admin',true)\"><span class=\"glyphicon glyphicon-plus\"></span></div>
            </a>  
                ";
            }
            ?>
        </div>

        <a class="menuItem" id="Marks">Obľúbené odkazy
            <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-container" id="Marks_container">
            <?php
            $sql = mysqli_query($con, "select * from zalozka where os_udaje_rod_cislo='".$id."' and link is not null order by Nazov asc");
            $i = 0;
            while ($rows = $sql->fetch_assoc()) {
                $data[$i] = $rows;
                ++$i;
            }

            if($i>0) {
                for ($j = 0; $j < $i; $j++) {
                    $row = $data[$j];
                    $link=$row['link'];
                    $glyphicon=$row['glyphicon'];
                    $nazov=$row['Nazov'];
                    echo "
                     <a class=\"menuItem\" target=\"_blank\" href=\"".$link."\"><span class=\"glyphicon ".$glyphicon."\"></span> ".$nazov."</a>
                    ";
                }
            }
            ?>
            <a class="menuItem link_adder">
                <div class="link_button" onclick="edit_links('<?php echo $id; ?>',true)"><span class="glyphicon glyphicon-pencil"></span></div>
                <div class="link_button" onclick="add_link('<?php echo $id; ?>',true)"><span class="glyphicon glyphicon-plus"></span></div>
            </a>
        </div>

        <a class="menuItem" id="Personal">Osobne
            <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-container" id="Personal_container">
            <a class="menuItem" href="#" id="settingsButton"><span class="glyphicon glyphicon-cog"></span> Nastavenia</a>
            <a class="menuItem" href="#" id="otherSettingsButton"><span class="glyphicon glyphicon-wrench"></span> Ostatné Nastavenia</a>
        </div>
        <?php
        if($info['Pravomoci']==1 || $info['Kontakty']==1){
            echo "
            <a class=\"menuItem\" id=\"Admin\">Administratorska sekcia
                <i class=\"fa fa-caret-down\"></i>
            </a>
            <div class=\"dropdown-container\" id=\"Admin_container\">
            ";
            if($info['Pravomoci']==1 ){
                echo "
                <a class=\"menuItem\" href=\"#\" id=\"powerButton\"><span class=\"glyphicon glyphicon-ok\"></span> Právomoci</a>
            ";
            }
            if($info['Kontakty']==1){
                echo "
                <a class=\"menuItem\" href=\"#\" id=\"addButton\"><span class=\"glyphicon glyphicon-user\"></span> Pridať uživateľa</a>
                <a class=\"menuItem\" href=\"#\" id=\"importButton\"><span class=\"glyphicon glyphicon-hdd\"></span> Pridať uživateľov</a>
            ";
            }

            if($info['Miesta']==1){
                echo "
                <a class=\"menuItem\" href=\"#\" id=\"placeButton\"><span class=\"glyphicon glyphicon-map-marker\"></span> Miesta</a>";
            }

            echo "
            </div>
            ";
        }
        ?>
    </div>

    <div class="siteMiddle innerContainer">
        <br>
        <div id="sidenav-button" class="sidenav-opener">
            <span class="glyphicon glyphicon-chevron-right sidenav-glyphicon" onclick="openNav()"></span>
        </div>

        <div id="componentWindow" class="component-window"></div>
    </div>

    <div class="footer" id="footer">
        <h5>© 2020 Žilinská univerzita v Žiline. Všetky práva vyhradené.</h5>
    </div>

</body>
</html>
