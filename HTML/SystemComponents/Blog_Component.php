<?php include"../../PHP/config.php";  ?>
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
                <input checked type="checkbox" name="typ" value='1' onclick="onlyOne(this,'Typ',2)">Aktualita<br>
                <input type="checkbox" name="typ" value='0' onclick="onlyOne(this,'Typ',1)">Oznam<br>

                <legend>Obecenstvo:</legend>
                <input checked type="checkbox" name="verejnost" value='1' onclick="onlyOne(this,'Verejnost',0)">Verejná<br>
                <input type="checkbox" name="verejnost" value='0' onclick="onlyOne(this,'Verejnost',0)">Súkromná<br>

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


    $("#newBlog").click(function () {
        document.getElementById('messegeWindow').innerHTML="";
        var outer = document.getElementById('messegeWindow');
        var inner = document.getElementById('addBlog');
        outer.innerHTML=inner.innerHTML;
    });

    function onlyOne(checkbox,druh,tmp) {
        var checkboxes = document.getElementsByName(druh)
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
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
            x.className += " resp";
        } else {
            x.className = "msg-sideMenu";
            z.className="Messenger-Menu";
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
                }
            });
        });
    });
</script>
</body>
