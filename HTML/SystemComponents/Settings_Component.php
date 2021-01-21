<?php include "../../PHP/config.php";
    $id=$_SESSION['session'] ?>
<body>
    <div class="settings-window row">
        <div class="settings-border col-md-4">
            <div class="settings-label"><h3 class="txt-label">Zmena profilových údajov</h3></div>
            <div class="personal-settings ">
                <form method="post" action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/personalSetting.php">
                    <div class="settings_view row">
                        <?php
                        $sql = mysqli_query($con, "select * from os_udaje join uzivatel where Login_idLogin='".$id."' ");
                        $i = 0;
                        while ($rows = $sql->fetch_assoc()){
                            $data[$i]=$rows;
                            ++$i;
                        }
                        $row=$data[0];

                        echo "
                        <label>Súkromný e-mail</label>
                        <input  name=\"mail\" type=\"email\" pattern=\"[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$\" value='".$row['email']."'>
                        <label>Telefónne číslo</label>
                        <input name=\"telephone\" type=\"text\" pattern=\"[-0]{1}[-9]{1}[0-9]{8}|[-+]{1}[0-9]{12}\" value='".$row['telefon']."'>
                        <input name=\"but_add\" id=\"but_add\" class=\"btn-submit\" type=\"submit\" value=\"Zmeniť\">
                    ";

                        ?>
                    </div>
                </form>
            </div>
        </div>

        <div class="settings-border col-md-4">
            <div class="settings-label"><h3 class="txt-label">Zmena Heslo</h3></div>
            <div class="password-settings row">
                <form method="post" action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/updatePassword.php">
                    <label>Pôvodné heslo</label>
                    <input type="text" name="old_pass">
                    <label>Nové heslo</label>
                    <input type="text" name="new_Pass">
                    <label>Zopakuj nové heslo</label>
                    <input type="text" name="pass_repeat">
                    <input class="btn-submit" type="submit"  name="but_add" id="but_add" value="Zmeniť">
                </form>
            </div>
        </div>

        <div class="settings-border col-md-4">
            <div class="settings-label"><h3 class="txt-label">Prehlad osobných údajov</h3></div>
            <div class="info-overview row">
                <div class="settings_view row">
                    <?php
                    $sql = mysqli_query($con, "select * from pracovisko join (login join pozícia) where idLogin='".$id."' ");
                    $i = 0;
                    while ($rows = $sql->fetch_assoc()){
                        $data[$i]=$rows;
                        ++$i;
                    }
                    $row=$data[0];

                    echo "
                        <label>Univerzitný e-mail</label>
                        <h5>".$row['Login']."@uniza.sk</h5>
                        <label>Pracovisko</label>
                        <h5>".$row['Názov']."</h5>
                        <label>miestnost</label>
                        <h5>".$row['miestnost']."</h5>
                        <label>Telefón</label>
                        <h5>".$row['telefon']."</h5>
                        <label>Funkcia</label>
                        <h5>".$row['Nazov']."</h5>
                    ";

                    ?>
            </div>
        </div>
    </div>
</body>