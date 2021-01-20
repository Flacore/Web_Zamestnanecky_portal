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
                    <div class=\"col-md-12\">
                        <h4 class=\"Name-Blog\">".$row['nadpis']."</h4>
                    </div>
                    <div class=\"col-sm-12 info-blog\">
                        <div class=\"col-md-6\">
                            <h5>".$row['datum']."</h5>
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
</div>
<script type="text/javascript">
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }


    $("#newBlog").click(function () {

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
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#_NameList .NameList-item").click(function(){
            $id = $(this).find('h1:first-child').text();
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
