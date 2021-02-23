<?php
    include "../PHP/login.php";
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zamestnanecký portál</title>
    <script src="../JS/HomeSite/homeSite_functionality.js"></script>
    <link rel="stylesheet" href="../CSS/HomeSite/homeSite.css">
    <link rel="stylesheet" href="../CSS/HomeSite/loginForm.css">
    <link rel="stylesheet" href="../CSS/HomeSite/tables.css">
    <link rel="stylesheet" href="../CSS/text.css">
    <link rel="stylesheet" href="../CSS/HomeSite/guestView.css">
</head>
<body>
    <div class="topnav" id="myTopnav">
        <a class="col-sm" id="prihlasovanieButton" href="#prihlasovanie">Prihlasovanie</a>
        <a class="col-sm" id="oznamyButton" href="#oznamy">Oznamy a Aktuality</a>
        <a class="col-sm" id="o_nasButton" href="#o_nas">O nás</a>
        <a class="col-sm" id="prac_pozicieButton" href="#prac_pozicie">Volné pracovné pozície</a>
        <a class="col-sm" id="kurzyButton" href="#kurzy">Kurzy</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>

    <div class="container login" id="prihlasovanie">
        <div class="logo">
            <a href="https://uniza.sk/"><img alt="" src="../PNG/logo_uniza.png"></a>
        </div>
        <div class="login_Form border cutOff">
            <div class="form">
                <form method="post">
                    <input type="text" id="user" name="txt_uname" autocomplete="off" required>
                    <label>Prihlasovacie meno</label>
                    <span class="spanName"></span>

                    <input type="password" id="password" name="txt_pwd" autocomplete="off" required>
                    <label>Heslo</label>
                    <span class="spanPass"></span>

                    <button class="btn" type="submit" value="Submit" name="but_submit" id="but_submit">Prihlásiť</button>
<!--                    <a href="#">Zabudnute heslo</a>-->
                </form>
            </div>
        </div>

        <div id="scroll_down"></div>
        <div id="scroll_icon"><img id="img_scroll" alt="" src="../PNG/Scroll_Icon.png"></div>
    </div>

    <div class="container customTableTitle" id="oznamy">
        <br><br>
        <div class="col-md-6">
            <div class="Container">
                <div>
                    <h2 class="txtCenter txtWhite">
                        <span>Aktuality</span>
                    </h2>
                    <div class="txtCenter glyphiconUp" id="slideUpAktuality" onclick="aktualityUp()">
                       <span class="txtWhite glyphicon glyphicon glyphicon-chevron-up"></span>
                    </div>
                    <br>
                    <?php
                    $podmienka=" aktualita='1'";

                    $sql = mysqli_query($con, "select * from blog where aktualita='1' ");
                    $num = mysqli_query($con, "select count(*) as NumberData from blog where aktualita='1'");
                    $num_row=mysqli_fetch_array($num);
                    $n=$num_row['NumberData'];
                    $i = 0;
                    while ($rows = $sql->fetch_assoc()){
                        $data[$i]=$rows;
                        ++$i;
                    }

                    if($n>0) {
                        for ($i = 0; $i < $n; $i++) {
                            $row = $data[$i];
                            if($row['verejne']!=0) {
                                    echo "  <div class=\"contentWindow\">
                                <div>
                                    <h1 style='display: none'>".$row['idBlog']."</h1>
                                    <h4 class=\"txtCenter txtBlack\">".$row['nadpis']."</h4>
                                    <h5 class=\"txtJustify txtBlack\">
                                        ".$row['predtext']."
                                    </h5>
                                    <h6 class=\"txtRight txtBlack\">Datum: ".$row['datum']."</h6>
                                </div>
                            </div>
                            ";}
                        }
                    }else{
                        echo " <div class=\"contentWindow\" id=\"aktualityWindow\">
                        <div>
                            <h4 class=\"txtCenter txtBlack\">Nič sa tu nenachádza.</h4>
                            <h5 class=\"txtJustify txtBlack\">
                            </h5>
                            <h6 class=\"txtRight txtBlack\"></h6>
                        </div>
                    </div>";
                    }
                    ?>
                    <br>
                </div>
                <div>
                    <div class="txtCenter glyphiconDown" id="slideDownAktuality" onclick="aktualityDown()">
                        <span class="txtWhite glyphicon glyphicon glyphicon-chevron-down"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="Container">
                <div>
                    <h2 class="txtCenter txtWhite">
                        <span>Oznamy</span>
                    </h2>
                    <div class="txtCenter glyphiconUp" id="slideUpOznamy" onclick="oznamyUp()">
                        <span class="txtWhite glyphicon glyphicon glyphicon-chevron-up"></span>
                    </div>
                    <br>
                    <?php
                    $sql = mysqli_query($con, "select * from blog where aktualita='0' ");
                    $num = mysqli_query($con, "select count(*) as NumberData from blog where aktualita='0' ");
                    $num_row=mysqli_fetch_array($num);
                    $n=$num_row['NumberData'];
                    $i = 0;
                    while ($rows = $sql->fetch_assoc()){
                        $data[$i]=$rows;
                        ++$i;
                    }
                    if($n>0) {
                        for ($i = 0; $i < $n; $i++) {
                            $row = $data[$i];
                            if($row['verejne']!=0) {
                                echo "  <div class=\"contentWindow\">
                                <div>
                                    <h1 style='display: none'>".$row['idBlog']."</h1>
                                    <h4 class=\"txtCenter txtBlack\">".$row['nadpis']."</h4>
                                    <h5 class=\"txtJustify txtBlack\">
                                        ".$row['predtext']."
                                    </h5>
                                    <h6 class=\"txtRight txtBlack\">Datum: ".$row['datum']."</h6>
                                </div>
                            </div>
                            ";}
                        }
                    }else{
                        echo " <div class=\"contentWindow\" id=\"aktualityWindow\">
                        <div>
                            <h4 class=\"txtCenter txtBlack\">Nič sa tu nenachádza.</h4>
                            <h5 class=\"txtJustify txtBlack\">
                            </h5>
                            <h6 class=\"txtRight txtBlack\"></h6>
                        </div>
                    </div>";
                    }
                    ?>
                    <br>
                </div>
                <div>
                    <div class="txtCenter glyphiconDown" id="slideDownOznamy" onclick="oznamyDown()">
                        <span class="txtWhite glyphicon glyphicon glyphicon-chevron-down"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container customTableTitle" id="o_nas">
        <div>
            <br><br>
            <h2 class="txtCenter">O nás..</h2>
            <h4 class="txtJustify txtBlack">
                Žilinská univerzita v Žiline sme slovenská verejná vysoká škola univerzitného typu so sídlom v Žiline.
                Poskytujeme vzdelanie v bakalárskych, inžinierskych/magisterských a doktorandských študijných programoch.
                Naše začiatky sa dátuju do roku 1953 kedy sme sa odlúčili od Českého vysokého učenia technického v Prahe
                a nášho následného presťahovania do mesta Žilina.
            </h4>
            <br>
            <div style="width: 40%; margin-left: 30%;border: royalblue 4px solid; border-radius: 10%; overflow: hidden">
                <div>
                    <h2 class="txtCenter txtWhite">
                        <span>Kontakt</span>
                    </h2>
                </div>
                <div class="txtJustify">
                    <h4>ŽILINSKÁ UNIVERZITA V ŽILINE</h4>
                    <h4>Univerzitná 8215/1 010 26 Žilina</h4>
                    <h4>tel.: +421 41 513 5001</h4>
                    <h4>IČO: 00397 563</h4>
                    <h4>DIČ: 20 20 67 78 24</h4>
                    <h4>IČ DPH: SK 20 20 67 78 24</h4>
                    <h4>Bankové spojenie: Štátna pokladnica</h4>
                </div>
            </div>
        </div>
        <br>
        <div>
            <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=18.754311203956608%2C49.20402084615569%2C18.75627994537354%2C49.20559103268037&amp;layer=mapnik">
            </iframe><br><small><a href="https://www.openstreetmap.org/#map=19/49.20481/18.75530">View Larger Map</a></small>
        </div>
    </div>

    <div class="oddelovac pocty container-fluid" id="oddelovacPozicie">
        <div class="row">
            <div class="col-sm-12"><h2 class="txtCenter txtWhite">Je nás už viac ako...</h2></div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <span class="col-xs-12 glyphicon glyphicon-user text-center txtWhite txtGlyphiconMDM"></span>
                <h3 class="col-sm-12 stat-count txtCenter txtWhite">1234</h3>
                <h4 class="col-sm-12 txtCenter txtWhite">Zamestnancov</h4>
            </div>
            <div class="col-sm-4">
                <span class="col-xs-12 glyphicon glyphicon-education text-center txtWhite txtGlyphiconMDM"></span>
                <h3 class="col-sm-12 stat-count txtCenter txtWhite">7924</h3>
                <h4 class="col-sm-12 txtCenter txtWhite">Študentov</h4>
            </div>
            <div class="col-sm-4">
                <span class="col-xs-12 glyphicon glyphicon-briefcase text-center txtWhite txtGlyphiconMDM"></span>
                <h3 class="col-sm-12 stat-count txtCenter txtWhite">175</h3>
                <h4 class="col-sm-12 txtCenter txtWhite" >Pracovísk</h4>
            </div>
        </div>
    </div>

    <div class="container" id="prac_pozicie">
        <br><br><br>
        <h2 class="txtCenter txtBlack">Hladáme</h2>
        <h4 class="txtCenter txtBlack txtFullWidth">
            Stante sa súčasťou nášho profesionálneho týmu...
        </h4>
        <br>
        <?php
        $sql = mysqli_query($con, "select * from kariera join pracovisko on kariera.Pracovisko_idPracovisko=pracovisko.idPracovisko where verejne='1'");
        $num = mysqli_query($con, "select count(*) as NumberData from kariera where verejne='1'");
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
                if($row['verejne']!=0) {
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

    <div class="oddelovac kurzy container-fluid" id="oddelovacKurzy">
    </div>

    <div class="container" id="kurzy">
        <div class="position tableStyle">
            <br><br><br>
            <h2 class="txtCenter txtWhite txtFullWidth">
                Zoznam kurzov a prednášok
            </h2>
            <h4 class="txtCenter txtWhite txtFullWidth">
                Každoročne organizujeme kopu prednášok a vzdelávacích kurzov, ktorých sa môže zúčastniť úplne každý...
            </h4>
            <br>
            <?php
            $sql = mysqli_query($con, "select * from prednasky  where verejne='1' ");
            $num = mysqli_query($con, "select count(*) as NumberData from prednasky where verejne='1'");
            $num_row=mysqli_fetch_array($num);
            $n=$num_row['NumberData'];
            $i = 0;
            while ($rows = $sql->fetch_assoc()){
                $data[$i]=$rows;
                ++$i;
            }

            if($n>0) {
                echo "       
                  <table>
                    <tr>
                        <th>Datum</th>
                        <th>Nazov</th>
                        <th>Miesto</th>
                        <th>Cena</th>
                    </tr>";
                for ($i = 0; $i < $n; $i++) {
                    $row = $data[$i];
                    if($row['verejne']!=0) {
                        if($row['cena']==null || $row['cena']==0.0)
                            $cena="n/a";
                        else
                            $cena=$row['cena'];
                        echo "               
                         <tr onclick=\"tableDetail('kurzDetail".$i."')\">
                                <td>".$row['datum']."</td>
                                <td>".$row['nazov']."</td>
                                <td>".$row['miesto']."</td>
                                <td>".$cena."</td>
                            </tr>
                            <tr class=\"detailHide detail\" id=\"kurzDetail".$i."\">
                                <td colspan=\"4\">
                                    <div  class=\"divWhite\">
                                       <div class=\"col-sm-6\">
                                           <br>
                                           <img alt=\"\" class=\"imgWidth imgStyle\" src=\"".$row['picture_url']."\">
                                           <br><br>
                                       </div>
                                        <div class=\"col-sm-6 \">
                                            <br>
                                            <h3>".$row['nazov']."</h3>
                                            <p class=\"txtJustify\">
                                                ".$row['popis']."
                                            </p>
                                            <button class=\"btn\" onclick=\"showRegistrationGuest(".$row['idprednasky'].")\">Prihlásiť sa</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    ";
                    }
                }
                echo "
                </table>";
            }else{
                echo " 
                <h2 class=\"txtCenter txtWhite\">Ľutujeme, momentálne niesu dostupné žiadne kurzy alebo prednášky.</h2>
            ";
            }
            ?>
            <h5 class="txtCenter txtWhite txtFullWidth txtInfo">
                *Prihlasovanie na kurzy nie je závezné a však by sme vás chceli
                poprosiť aby ste tak ku nemu pristupovaly.
            </h5>
        </div>
        <br><br><br>
    </div>

    <div id="guest_view" class="guest-view">
        <div class="guest-window" >
            <div class="col-sm-12">
                <div class="closebtn">
                    <span class="glyphicon glyphicon-remove" onclick="guestViewClose()"></span>
                </div>
            </div>

            <div id="registration_guest" class="registration-guest">
                <h2 class="title col-sm-12">Registrácia</h2>
                <form method="post" action="../PHP/Main%20Site/curses_user.php">
                    <input class="hiden" type="text" id="idPrednasky">
                    <div class="col-sm-12">
                        <div class="center">
                            <label>Meno</label>
                            <input name="txt_name" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="center">
                            <label>Priezvisko</label>
                            <input name="txt_sname" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="center">
                            <label>E-mail</label>
                            <input name="mail" type="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="center">
                            <label>Telefónne číslo</label>
                            <input name="telephone" type="text" pattern="[-0]{1}[-9]{1}[0-9]{8}|[-+]{1}[0-9]{12}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="center">
                            <input class="btn" value="Pridaj" type="submit" name="but_add" id="but_add">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="center">
                            <input class="btn" value="Resetuj" type="reset">
                        </div>
                    </div>
                </form>
            </div>

            <div id="textShow_guest" class="textShow-guest">
            </div>

        </div>
    </div>

    <div class="footer" id="footer">
        <h5>© 2020 Žilinská univerzita v Žiline. Všetky práva vyhradené.</h5>
    </div>
    <script src="../JS/HomeSite/homeSite_onClick.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".contentWindow div").click(function(){
                $id = $(this).find('h1:first-child').text();
                $.ajax({
                    type: 'POST',
                    data: {id: $id},
                    url: '../PHP/Main%20Site/text.php',
                    success: function(data) {
                        document.getElementById('textShow_guest').innerHTML=data;
                        showTextGuest();
                    }
                });
            });
        });
    </script>
</body>
</html>

