<?php include "../../PHP/config.php";
    $id=$_SESSION['session'];
?>
<body>
    <div class="homeContainer">
        <div class="row">
            <br>
            <div class="col-sm-12">
                <div class="col-sm-12 center"><div class="imgAvatar center shadow"></div></div>
                <div class="col-sm-12 center"><h2 class="welcomSign ">Dobrý deň,
                    <?php
                    $sql = mysqli_query($con, "select * from login join (uzivatel join os_udaje on uzivatel.OS_udaje_idOS_udaje = os_udaje.idOS_udaje) on Login.idLogin= uzivatel.Login_idLogin where idLogin='".$id."'");
                    $i = 0;
                    while ($rows = $sql->fetch_assoc()) {
                        $data[$i] = $rows;
                        ++$i;
                    }
                    $row = $data[0];
                    echo "".$row['Meno']." ".$row['Priezvisko'].""

                    ?>
                    </h2></div>
            </div>

            <div class="col-sm-12">
                <div class="col-sm-4">
                    <div class="infoBox center color1 shadow">
                        <h3 class="title"><span class="glyphicon glyphicon-bell"> Notifikacie</span></h3>

                        <div class="infoBox-textContainer">
                            <?php
                            $sql = mysqli_query($con, "select * from notifikacia join uzivatel  where Login_idLogin='".$id."'");
                            $i = 0;
                            while ($rows = $sql->fetch_assoc()) {
                                $data[$i] = $rows;
                                ++$i;
                            }
                            $row = $data[0];

                            $uzivatel=$row['idUzivatel'];

                            if($i>0) {
                                for ($j = 0; $j < 1; $j++) {
                                    echo "<div class=\"NotificationSlides textSlide\">
                                <h4>".$i.". notifikácií</h4>
                                 </div>";
                                }
                            }else{
                                echo "<div class=\"NotificationSlides textSlide\">
                                <h4>Neexistuje dostatok záznamov.</h4>
                                 </div>";
                            }
                            ?>

                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="infoBox center color2 shadow" onclick="BlogOpen()">
                        <h3 class="title"><span class="glyphicon glyphicon-info-sign"> Aktuality</span></h3>

                        <div class="infoBox-textContainer">

                            <?php
                            $sql = mysqli_query($con, "select * from blog where aktualita='1'");
                            $i = 0;
                            while ($rows = $sql->fetch_assoc()) {
                                $data[$i] = $rows;
                                ++$i;
                            }
                            $row = $data[0];

                            if($i>0) {
                                for ($j = 0; $j < 1; $j++) {
                                    echo "<div class=\"AktualitySlides textSlide\">
                                <h4>".$i.". aktualít</h4>
                                 </div>";
                                }
                            }else{
                                echo "<div class=\"AktualitySlides textSlide\">
                                <h4>Neexistuje dostatok záznamov.</h4>
                                 </div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="infoBox center color3 shadow" onclick="BlogOpen()">
                        <h3 class="title"><span class="glyphicon glyphicon-bullhorn"> Oznamy</span></h3>

                        <div class="infoBox-textContainer">

                            <?php
                            $sql = mysqli_query($con, "select * from blog where aktualita='0'");
                            $i = 0;
                            while ($rows = $sql->fetch_assoc()) {
                                $data[$i] = $rows;
                                ++$i;
                            }
                            $row = $data[0];

                            if($i>0) {
                                for ($j = 0; $j < 1; $j++) {
                                    echo "<div class=\"OznamySlides textSlide\">
                                <h4>".$i.". oznamov</h4>
                                 </div>";
                                }
                            }else{
                                echo "<div class=\"OznamySlides textSlide\">
                                <h4>Neexistuje dostatok záznamov.</h4>
                                 </div>";
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="col-sm-4" onclick="SettingsOpen()">
                    <div class="infoBox center color4 shadow">
                        <h3 class="title"><span class="glyphicon glyphicon-wrench"> Nastavenia</span></h3>

                        <div class="infoBox-textContainer">
                            <div class="textSlide">
                                <h4>Nastavenia účtu, osobné informácie, zmena hesla.</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4" onclick="MessegesOpen()">
                    <div class="infoBox center color5 shadow">
                        <h3 class="title"><span class="glyphicon glyphicon-envelope"> Správy</span></h3>

                        <div class="infoBox-textContainer">
                            <?php
                            $sql = mysqli_query($con, "select * from uzivatel  where Login_idLogin='".$id."'");
                            $i = 0;
                            while ($rows = $sql->fetch_assoc()) {
                                $data[$i] = $rows;
                                ++$i;
                            }
                            $row=$data[0];
                            $uzivatel= $row['idUzivatel'];

                            $uzivatel=$row['idUzivatel'];
                            $sql = mysqli_query($con, "select * from sprava join konverzacia where Uzivatel_idUzivatel2='".$uzivatel."'
                            or Uzivatel_idUzivatel1='".$uzivatel."'");
                            $i = 0;
                            while ($rows = $sql->fetch_assoc()) {
                                $data[$i] = $rows;
                                ++$i;
                            }
                            $row = $data[0];

                            if($i>0) {
                                for ($j = 0; $j < 1; $j++) {
                                    echo "<div class=\"MessegesSlides textSlide\">
                                <h4>".$i.". správ</h4>
                                 </div>";
                                }
                            }else{
                                echo "<div class=\"MessegesSlides textSlide\">
                                <h4>Neexistuje dostatok záznamov.</h4>
                                 </div>";
                            }
                            ?>
                        </div>

                    </div>
                </div>

                <div class="col-sm-4" onclick="ContactsOpen()">
                    <div class="infoBox center color6 shadow">
                        <h3 class="title"><span class="glyphicon glyphicon-phone-alt"> Kontakty</span></h3>
                        <div class="infoBox-textContainer">
                            <div class="textSlide">
                                <h4>Adresár kontaktov našich zamestnancov.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12"><div class="last-box"></div></div>
        </div>
    </div>
    <script>
        var time = 2000;

        var slideMessegesIndex = 0;
        var NotificationslideIndex = 0;
        var slideOznamyIndex = 0;
        var slideActualityIndex = 0;
        showMessegesSlide();
        showNotificationSlides();
        showOznamySlides();
        showActualitySlides();

        function plusSlides(n,) {
            showSlides(slideIndex += n);
        }

        function showMessegesSlide() {
            var i;
            var slides = document.getElementsByClassName("MessegesSlide");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideMessegesIndex++;
            if (slideMessegesIndex > slides.length) {slideMessegesIndex = 1}
            slides[slideMessegesIndex-1].style.display = "block";
                setTimeout(showMessegesSlide, time);
        }

        function showNotificationSlides() {
            var i;
            var slides = document.getElementsByClassName("NotificationSlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            NotificationslideIndex++;
            if (NotificationslideIndex > slides.length) {NotificationslideIndex = 1}
            slides[NotificationslideIndex-1].style.display = "block";
                setTimeout(showNotificationSlides, time);
        }

        function showOznamySlides() {
            var i;
            var slides = document.getElementsByClassName("OznamySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideOznamyIndex++;
            if (slideOznamyIndex > slides.length) {slideOznamyIndex = 1}
            slides[slideOznamyIndex-1].style.display = "block";
                setTimeout(showOznamySlides, time);
        }

        function showActualitySlides() {
            var i;
            var slides = document.getElementsByClassName("AktualitySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideActualityIndex++;
            if (slideActualityIndex > slides.length) {slideActualityIndex = 1}
            slides[slideActualityIndex-1].style.display = "block";
                setTimeout(showActualitySlides, time);
        }
    </script>
</body>