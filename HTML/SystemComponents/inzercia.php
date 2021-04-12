<?php include "../../PHP/config_DB.php"; ?>
<body>
<style>
    .inzercia_menu{
        margin-top: 10px;
        margin-bottom: -20px;
        width: 200px;
        height: 50px;
    }

    .inzercia_add{
        height: 50px;
        width: 50px;
        background-color: #28559A;
        border-radius: 25px;
        cursor: pointer;
    }

    .inzercia_add > span{
        color: white;
        width: 30px;
        height: 30px;
        font-size: 30px;
        top: 10px;
    }

    .inzercia_add.iz_category{
        float: left;
    }

    .inzercia_add.iz_item{
        float: right;
    }

    .inzercia_add.list{
        float: right;
        margin-left: 25px;
        margin-right: 25px;
    }
</style>

<div class="inzercia_menu center">
    <div class="inzercia_add iz_item" onclick="add_ad()">
        <span class="glyphicon glyphicon-plus"</span>
    </div>
    <div class="inzercia_add list" onclick="add_adlist()">
        <span class="glyphicon glyphicon-th-list"</span>
    </div>
    <div class="inzercia_add iz_category" onclick="add_adcat()">
        <span class="glyphicon glyphicon-folder-open"</span>
    </div>
</div>

<div class="inzercia inzercia_inside">

    <div id="inzercia_all" class="inzercia_inside hidden">
        <H3>Neexistuje žiadny inzerát.</H3>
    </div>
    <div id="inzercia_det" class="inzercia_inside hidden">

    </div>

    <div id="inzercia_cat" class="inzercia_inside" >

        <?php

        echo "<div onclick=\"openCategory(-1)\" class=\" category\">
                    <img alt=\"\" class=\"img\" src=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/Server/inzercia/categoria/uncat.webp\">
                    <h3>Nezaradene</h3>
                </div>";

        $sql = mysqli_query($con, "SELECT * FROM kategoria");
        $k = 0;
        while ($rows = $sql->fetch_assoc()) {
            $_data[$k] = $rows;
            ++$k;
        }
        if ($k <= 0) {
//                    neexistuje ziadna konkretna kategoria
        } else {
            for ($n = 0; $n < $k; $n++) {
                $row = $_data[$n];
                if ($row['Subor_idSubor'] == null) {
                    echo "<div class=\" category\">
                                  <img onclick=\"openCategory(1)\" alt=\"\" class=\"img\" src=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/Server/inzercia/categoria/def.jpg\">
                                  <h3>".$row['Názov']."</h3>
                                  </div>";
                } else {
                    echo "<div class=\" category\">
                                  <img onclick=\"openCategory(1)\" alt=\"\" class=\"img\" src=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/Server/inzercia/categoria/def.jpg\">
                                  <h3>".$row['Názov']."</h3>
                                  </div>";
                }
            }
        }


        ?>
    </div>
</div>

<script>
    function inzViewClose(){
        document.getElementById('inzercia_view').style.display='none';
        document.getElementById('inzercia_cat').style.display='none';
        document.getElementById('inzercia_all').style.display='none';
        document.getElementById('inzercia_det').style.display='none';
    }

    function  inzViewOpen() {
        document.getElementById('inzercia_cat').style.display='block';
        document.getElementById('inzercia_view').style.display='block';
        let tmp = document.getElementById('inzercia_all');
        tmp.load("SystemComponents/inzercia.php");
        document.getElementById('inzercia_all').style.display='none';
        document.getElementById('inzercia_det').style.display='none';
    }

    function showDetail_inz(id) {
        document.getElementById('inzercia_det').innerHTML="";
        $.ajax({
            type: 'POST',
            data: {id: id,typ: 2},
            url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/Main%20Site/inzercia.php',
            success: function(data) {
                document.getElementById('inzercia_det').innerHTML=data;
            }
        });
        document.getElementById('inzercia_cat').classList.add('hidden');
        document.getElementById('inzercia_all').classList.add('hidden');
        document.getElementById('inzercia_det').classList.remove('hidden');
    }

    function openCategory(id){
        document.getElementById('inzercia_all').classList.remove('hidden');
        $.ajax({
            type: 'POST',
            data: {id: id,typ: 1},
            url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/Main%20Site/inzercia.php',
            success: function(data) {
                document.getElementById('inzercia_all').innerHTML=data;
            }
        });
        document.getElementById('inzercia_cat').classList.add('hidden');
        document.getElementById('inzercia_det').classList.add('hidden');
    }


    function add_ad() {
        document.getElementById("ad_form_item").classList.remove('hidden');
        document.getElementById("ad_form_cat").classList.add('hidden');
        document.getElementById("ad_list").classList.add('hidden');
        let modal = document.getElementById("modal_ad");
        modal.style.display = "block";
    }

    function add_adcat() {
        document.getElementById("ad_form_item").classList.add('hidden');
        document.getElementById("ad_form_cat").classList.remove('hidden');
        document.getElementById("ad_list").classList.add('hidden');
        let modal = document.getElementById("modal_ad");
        modal.style.display = "block";

    }

    function add_adlist() {
        document.getElementById("ad_form_item").classList.add('hidden');
        document.getElementById("ad_form_cat").classList.add('hidden');
        document.getElementById("ad_list").classList.remove('hidden');
        let modal = document.getElementById("modal_ad");
        modal.style.display = "block";
    }
</script>

</body>