<?php include "../../PHP/config_DB.php";
    $id=$_SESSION['session'] ?>
<body>
    <div class="settings-window row">
        <div class="settings-border col-md-4">
            <div class="settings-label"><h3 class="txt-label">Profilová fotka</h3></div>
            <div class="personal-settings ">
                <form id="form_file" enctype="multipart/form-data" method="post" action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/upload_photo.php">
                <?php
                    $sql = mysqli_query($con, "select subor_fotka as povodny,cesta as fotocesta from os_udaje left join subor on(subor_fotka=idSubor)
                    where rod_cislo='".$id."'");
                    $i = 0;
                    while ($rows = $sql->fetch_assoc()) {
                        $data[$i] = $rows;
                        ++$i;
                    }
                    if($i>0) {
                        $row = $data[0];
                        if ($row['fotocesta']!=null) {
                            echo "                <div class=\"col-sm-12 center\"><div class=\"center shadow\"
                                                        style=\"border-radius: 100%;
                                                               width: 200px;
                                                               height: 200px;
                                                               overflow: hidden;
                                                               background-size: cover;
                                                               background-position: center;
                                                               background-image: url('http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/Server" . $row['fotocesta'] . "');\"
                                                  ></div></div>";
                            echo "
                                <input class='hidden' type='text' name='povodny' value='".$row['povodny']."'>
                            ";
                        } else
                            echo "                <div class=\"col-sm-12 center\"><div class=\"imgAvatar center shadow\"></div></div>";
                    }else{
                        echo "                <div class=\"col-sm-12 center\"><div class=\"imgAvatar center shadow\"></div></div>";
                    }
                ?>
                    <div class="center">
                        <label>Nahraj súbor:</label>
                    </div>
                    <input class="center" type="file" required id="file_path" name="file_path" accept="image/*">
                    <br>
                    <input class="col-sm-12 btn-submit center-icon" type="submit" value="Odoslať" name="button_file">
                </form>
            </div>
        </div>

        <div class="settings-border col-md-4">
            <div class="settings-label"><h3 class="txt-label">Osobné nastavenia</h3></div>
            <div class="password-settings row">
                <?php
                    $sql = mysqli_query($con, "select * from os_udaje where rod_cislo='".$id."'");
                    $row=$sql->fetch_assoc();

                    $IBAN=$row['IBAN'];
                    $Mesto=$row['Mesto'];
                    $PSC=$row['PSC'];
                    $Adresa=$row['Adresa'];
                    echo "
                        <form method='post' action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/update_personal.php\">
                            <label>IBAN:</label>
                            <input type='text' name='IBAN' value='".$IBAN."' pattern='[a-zA-Z]{2}[0-9]{22}'>   
                            <label>Mesto:</label>
                            <input type='text' name='Mesto' value='".$Mesto."' >
                            <label>Adresa:</label>
                            <input type='text' name='Adresa' value='".$Adresa."' >
                            <label>PSC:</label>
                            <input type='text' name='PSC' value='".$PSC."' pattern='[0-9]{5}'  >
                            <input class=\"col-sm-12 btn-submit center-icon\" type=\"submit\" value=\"Odoslať\" name=\"button_file\">
                        </form>
                        ";
                ?>
            </div>
        </div>

        <div class="settings-border col-md-4">
            <div class="settings-label"><h3 class="txt-label">Životopis</h3></div>
            <div class="info-overview row">
                <div class="settings_view row">
                    <br><br><br>
                    <form id="form_file" enctype="multipart/form-data" method="post" action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/upload_cv.php">
                    <?php
                    $sql = mysqli_query($con, "select subor_CV as povodny ,cesta as cvcesta from os_udaje left join subor on(subor_CV=idSubor)
                    where rod_cislo='".$id."'");
                    $i = 0;
                    while ($rows = $sql->fetch_assoc()) {
                        $data[$i] = $rows;
                        ++$i;
                    }

                    if($i>0) {
                        $row = $data[0];
                        if ($row['cvcesta'] != null) {
                            echo "<div class=\"col-sm-12 center\">
                                    <button class=\"col-sm-12 btn-submit center-icon\"
                                    onclick=\"location.href='http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/ftp/Download_file.php?cesta=".$row['cvcesta']."'\"
                                    >Stiahnuť Životopis</button>
                                  </div>";
                            echo "
                                  <input class='hidden' type='text' name='povodny' value='".$row['povodny']."'>
                            ";
                        } else
                            echo "                <div class=\"col-sm-12 center\"><h3>Doposiaľ nebol nahraný žiadny životpis.</h3></div>";
                    }else{
                        echo "                <div class=\"col-sm-12 center\"><h3>Doposiaľ nebol nahraný žiadny životpis.</h3></div>";
                    }

                    ?>
                    <br>
                        <div class="center">
                            <label>Nahraj súbor:</label>
                        </div>
                        <input class="center" type="file" required id="file_path" name="file_path" accept="application/pdf,application/msword,
                        application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                        <br>
                        <input class="col-sm-12 btn-submit center-icon" type="submit" value="Odoslať" name="button_file">
                    </form>
                </div>
            </div>
        </div>
</body>