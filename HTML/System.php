<?php
    include "../PHP/config.php";
    if(!isset($_SESSION['session'])){
        header('Location: Main_Site.php');
    }
    $id=$_SESSION['session'];

    if(isset($_POST['but_logout'])){
        session_destroy();
        header('Location: Main_Site.php');
    }
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
    <script src="../JS/MainSite/system_functionality.js"></script>
    <script src="../JS/MainSite/system_onClick.js"></script>
    <script src="../JS/MainSite/modal_window.js"></script>
</head>
<body onload="fLoad()">
    <div class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="close_modal()">&times;</span>
            <form>
                <div class="hidden" id="adding_link">
                    <input class="hidden" value="" id="idlogin" name="idLogin">
                    <input value="" id="Name" name="Name">
                    <input value="" id="Link" name="Link">
                </div>
                <div class="hidden" id="edit_link">
                    <div id="displayed"> </div>
                </div>
                <br>
                <input type="submit" class="btn-submit" name="Sub" value="submit">
            </form>
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
            <a class="menuItem" href="#" id="cursesButton"><span class="glyphicon glyphicon-edit"></span> Kurzy</a>
            <a class="menuItem" href="#" id="carierButton"><span class="glyphicon glyphicon-briefcase"></span> Kariéra</a>
            <a class="menuItem" href="#" id="blogButton"><span class="glyphicon glyphicon-pencil"></span> Blog</a>
        </div>

        <a class="menuItem" id="Links">Odkazy
            <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-container" id="Links_container">
            <?php
            $sql = mysqli_query($con, "select * from uzivatel  where Login_idLogin='".$id."'");
            $i = 0;
            while ($rows = $sql->fetch_assoc()) {
                $data[$i] = $rows;
                ++$i;
            }
            $row=$data[0];
            $uzivatel= $row['idUzivatel'];

            $sql = mysqli_query($con, "select * from zalozka where Uzivatel_idUzivatel is null order by Nazov asc");
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
                     <a class=\"menuItem\" href=\"".$link."\"><span class=\"glyphicon ".$glyphicon."\"></span> ".$nazov."</a>
                    ";
                }
            }
            ?>
            <a class="menuItem link_adder">
                <div class="link_button" onclick="edit_links('admin')"><span class="glyphicon glyphicon-pencil"></span></div>
                <div class="link_button" onclick="add_link('admin')"><span class="glyphicon glyphicon-plus"></span></div>
            </a>
        </div>

        <a class="menuItem" id="Marks">Zalozky
            <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-container" id="Marks_container">
            <?php
            $sql = mysqli_query($con, "select * from uzivatel  where Login_idLogin='".$id."'");
            $i = 0;
            while ($rows = $sql->fetch_assoc()) {
                $data[$i] = $rows;
                ++$i;
            }
            $row=$data[0];
            $uzivatel= $row['idUzivatel'];

            $sql = mysqli_query($con, "select * from zalozka where Uzivatel_idUzivatel='".$uzivatel."' order by Nazov asc");
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
                     <a class=\"menuItem\" href=\"".$link."\"><span class=\"glyphicon ".$glyphicon."\"></span> ".$nazov."</a>
                    ";
                }
            }
            ?>
            <a class="menuItem link_adder">
                <div class="link_button" onclick="edit_links('<?php echo $id; ?>')"><span class="glyphicon glyphicon-pencil"></span></div>
                <div class="link_button" onclick="add_link('<?php echo $id; ?>')"><span class="glyphicon glyphicon-plus"></span></div>
            </a>
        </div>

        <a class="menuItem" id="Personal">Osobne
            <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-container" id="Personal_container">
            <a class="menuItem" href="#" id="powerButton"><span class="glyphicon glyphicon-ok"></span> Právomoci</a>
        </div>
        <a class="menuItem" id="Admin">Administratorska sekcia
            <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-container" id="Admin_container">
            <a class="menuItem" href="#" id="powerButton"><span class="glyphicon glyphicon-ok"></span> Právomoci</a>
        </div>
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

    <div id="guest_view" class="guest-view">
        <div class="guest-window" >
            <div class="col-sm-12">
                <div class="closebtn">
                    <span class="glyphicon glyphicon-remove" onclick="guestViewClose()"></span>
                </div>
            </div>

            <div id="registration_guest" class="registration-guest">
                <h2 class="title col-sm-12">Registrácia</h2>
                <form>
                    <div class="col-sm-12">
                        <div class="center">
                            <label>Meno</label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="center">
                            <label>Priezvisko</label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="center">
                            <label>E-mail</label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="center">
                            <label>Telefónne číslo</label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="center">
                            <input class="btn" type="submit">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="center">
                            <input class="btn" type="reset">
                        </div>
                    </div>
                </form>
            </div>

            <div id="textShow_guest" class="textShow-guest">
                <h2 class="title col-sm-12">Nazov clanku</h2>
                <div class="text-area">
                    <h5 class="text col-sm-12">

                    </h5>
                </div>
                <h5 class="text-detail col-sm-12">Dátum: xx.xx.xxxx</h5>
                <h5 class="text-detail col-sm-12">Autor: meno meno</h5>
            </div>

        </div>
    </div>
</body>
</html>
