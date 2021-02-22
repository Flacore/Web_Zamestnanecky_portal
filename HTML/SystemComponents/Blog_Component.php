<?php include "../../PHP/config_DB.php";  ?>
<body>
<div class="messenger-window">
    <div class="col-md-3 Messenger-Menu" id="_sideMenu">
        <div class="topSpace">
            <a href="javascript:void(0);" class="icon" onclick="msgOpen()">
                <div class="iconContact"><span class="glyphicon glyphicon-th-list userIcon"></span></div>
            </a>
        </div>
        <div id="_msg-sideMenu" class="msg-sideMenu">
            <div id="_NameList" class="NameList row">
                <?php
                $sql = mysqli_query($con, "select * from blog join (uzivatel join os_udaje on uzivatel.OS_udaje_idOS_udaje=os_udaje.idOS_udaje)on blog.Uzivatel_idUzivatel=uzivatel.idUzivatel");
                $num = mysqli_query($con, "select count(*) as NumberData from blog ");
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
                        echo "
                    <div class=\"NameList-item blog-item\">
                    <h1 style='display: none'>".$row['idBlog']."</h1>
                    <div class=\"col-sm-12\">
                        <h4 class=\"Name-Blog\">".$row['nadpis']."</h4>
                    </div>
                    <div class=\"col-sm-12 info-blog\">
                        <div class=\"col-sm-12\">
                            <h5 class='Date-Blog'>".$row['datum']."</h5>
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
                <div id="newBlog" class="newMessege">
                    <span class="glyphicon glyphicon-plus"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9 Messenger-messegeWindow" id="messegeWindow">

    </div>

    <div class="display_No" id="addBlog">
        <div class="add_Blog">
            <form action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/add_blog.php" method="post">
                <legend>Kategória:</legend>
                <input checked class="typ" type="checkbox" name="typ" value='1' onclick="onlyOne(this,'.typ',2,1)">Aktualita<br>
                <input class="typ" type="checkbox" name="typ" value='0' onclick="onlyOne(this,'.typ',1,2)">Oznam<br>

                <legend>Obecenstvo:</legend>
                <input checked class="verejnost" type="checkbox" name="verejnost" value='1' onclick="onlyOne(this,'.verejnost',0,1)">Verejná<br>
                <input class="verejnost" type="checkbox" name="verejnost" value='0' onclick="onlyOne(this,'.verejnost',0,2)">Súkromná<br>

                <legend>Nadpis:</legend>
                <textarea required name="nadpis" rows="1"></textarea>

                <legend>Úvod:</legend>
                <textarea required name="predtext" rows="5"></textarea>

                <div id="text_area">
                    <legend>Text:</legend>
                    <textarea name="text" rows="10"></textarea>
                </div>

                <div class="col-sm-12 send-BT"><input name="but_submit" id="but_submit" type="submit" value="Odoslať"></div>
            </form>
        </div>
    </div>

</div>
<script type="text/javascript">
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    $(window).resize(function () {
        var x = document.getElementById("_msg-sideMenu");
        var z = document.getElementById("_sideMenu");
        if($(window).width()>980){
            x.className="";
            z.className="";
            x.classList.add('msg-sideMenu');
            z.classList.add('Messenger-Menu');
            z.classList.add('col-md-3');
        }
    });

    $("#newBlog").click(function () {
        document.getElementById('messegeWindow').innerHTML="";
        var outer = document.getElementById('messegeWindow');
        var inner = document.getElementById('addBlog');
        outer.innerHTML=inner.innerHTML;
    });

    function onlyOne(checkbox,druh,tmp,n) {
        x = document.querySelectorAll(druh);
        for (i = 0; i < x.length; i++) {
            if(i+1!=n)
                x[i].checked = false;
            else
                x[i].checked = true;
        }

        if(tmp==1){
            document.getElementById('text_area').style.display='none';
        }
        if(tmp==2){
            document.getElementById('text_area').style.display='block';
        }
    }

    function msgOpen() {
        var x = document.getElementById("_msg-sideMenu");
        var z = document.getElementById("_sideMenu");
        if (x.className === "msg-sideMenu") {
            z.className="respMenu";
            x.className = " resp";
        } else {
            x.className="";
            z.className="";
            x.classList.add('msg-sideMenu');
            z.classList.add('Messenger-Menu');
            z.classList.add('col-md-3');
        }

    }

    $(document).ready(function(){
        $("#_NameList .NameList-item").click(function(){
            document.getElementById('messegeWindow').innerHTML="";
            $id = $(this).find('h1:first-child').text();

            var x, i;
            x = document.querySelectorAll(".NameList-item");
            for (i = 0; i < x.length; i++) {
                x[i].classList.remove('NameList-item_Opened');
            }

            $(this).addClass('NameList-item_Opened');

            $.ajax({
                type: 'POST',
                data: {id: $id},
                url: '../PHP/System/blog.php',
                success: function(data) {
                    document.getElementById('messegeWindow').innerHTML=data;
                    if($(window).width()<=980){
                        msgOpen();
                    }
                }
            });
        });
    });
</script>
</body>
