<?php include "../../PHP/config.php";
$id=$_SESSION['session'] ?>
<body>
<div class="messenger-window">
    <div class="col-md-3 Messenger-Menu" id="_sideMenu">
        <div class="topSpace">
            <a href="javascript:void(0);" class="icon" onclick="msgOpen()">
                <div class="iconContact"><span class="glyphicon glyphicon-user userIcon"></span></div>
            </a>
        </div>
        <div id="_msg-sideMenu" class="msg-sideMenu">
            <div id="_NameList" class="NameList row">

                <?php
                $sql = mysqli_query($con, "select * from uzivatel  where Login_idLogin='".$id."'");
                $i = 0;
                while ($rows = $sql->fetch_assoc()) {
                    $data[$i] = $rows;
                    ++$i;
                }
                $row=$data[0];
                $uzivatel= $row['idUzivatel'];

                $sql = mysqli_query($con, "select * from konverzacia where Uzivatel_idUzivatel2='".$uzivatel."'
                                or Uzivatel_idUzivatel1='".$uzivatel."'");
                $i = 0;
                while ($rows = $sql->fetch_assoc()) {
                    $data[$i] = $rows;
                    ++$i;
                }

                if($i>0) {
                    for ($j = 0; $j < $i; $j++) {
                        $row=$data[$j];
                        $konv=$row['idKonverzacie'];
                        if($row['Uzivatel_idUzivatel2']==$uzivatel)
                            $prijemca=$row['Uzivatel_idUzivatel1'];
                        else
                            $prijemca=$row['Uzivatel_idUzivatel2'];

                        $sql = mysqli_query($con, "select * from os_udaje join uzivatel on OS_udaje_idOS_udaje=idOS_udaje where idUzivatel='".$prijemca."' ");
                        $k = 0;
                        while ($rows = $sql->fetch_assoc()){
                            $_data[$k]=$rows;
                            ++$k;
                        }
                        $info=$_data[0];

                        echo "
                                    <div id='list-item".($j+1)."' class=\"NameList-item\")'>
                                        <div class='buttons-msg'>
                                            <value style='display: none'>".($prijemca)."</value>  
                                            <value style='display: none'>".($konv)."</value>         
                                            <div class=\"col-md-2\">
                                                <div class=\"Messenger-img\"></div>
                                            </div>
                                            <div class=\"col-md-10\">
                                                <h4 class=\"Name\">".$info['Meno']." ".$info['Priezvisko']."</h4>
                                            </div>
                                        </div>
                                    </div>
                                     ";
                    }
                }
                ?>
                <br>
            </div>
            <div class="bottomSpace">
                <div id="openContacts" class="newMessege">
                    <span class="glyphicon glyphicon-plus"></span>
                </div>
            </div>
        </div>
    </div>

    <div id="msg_Window" class="col-md-9 Messenger-messegeWindow">
        <form id="msgText" action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/add_messege.php" method="post">
            <div id="msgs" class="msg-Window">

            </div>

            <div class="msg-textForm">
                <br>
                <input name="msg_text" type="text" class="messege-txt col-sm-12">
                <label class=" col-sm-12 formDisclaimer">Odoslať stlačním ENTER</label>
                <div class="col-sm-12 send-BT"><input type="submit" value="Odoslať"></div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $(function() {
        $('#msgText').each(function() {
            $(this).find('input').keypress(function(e) {
                // Enter pressed?
                if(e.which == 10 || e.which == 13) {
                    this.form.submit();
                }
            });

            $(this).find('input[type=submit]').hide();
        });
    });

    $("#openContacts").click(function () {
        $("#componentWindow").load("SystemComponents/Contacts_Component.php");
        active(3);
    });

    function msgOpen() {
        var x = document.getElementById("_msg-sideMenu");
        var z = document.getElementById("_sideMenu");
        if (x.className === "msg-sideMenu") {
            z.className="respMenu";
            x.className += " resp";
        } else {
            x.className = "msg-sideMenu";
            z.className="Messenger-Menu";
        }
    }

    $(document).ready(function(){
        $(".NameList-item .buttons-msg").click(function(){
            $n = $(this).find('value:first-child').text();
            $k = $(this).find('value:nth-child(2)').text();

            var x, i;
            x = document.querySelectorAll(".NameList-item");
            for (i = 0; i < x.length; i++) {
                x[i].classList.remove('NameList-item_Opened');
            }

            $(this).parent().addClass('NameList-item_Opened');

            $.ajax({
                type: 'POST',
                data: {n: $n,k:$k},
                url: '../PHP/System/messeges.php',
                success: function(data) {
                    document.getElementById('msgs').innerHTML=data;
                    document.getElementById('msg_Window').style.visibility="visible";
                }
            });
        });
    });
</script>
</body>