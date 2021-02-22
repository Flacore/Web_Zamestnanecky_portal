<?php include "../../PHP/config_DB.php" ?>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
</head>
<body>
<div class="contactWindow col-sm-12">
    <div class="col-sm-12 searchWindow">
        <form id="myForm" action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/System/contacts.php" method="post">
            <label>Meno/Priezvisko</label>
            <input id="Meno" name="Meno" class="input" type="text">
            <label>Pracovisko</label>
            <input id="pracovisko" name="pracovisko" class="input" type="text">
            <div class="col-xs-6"><input class="buttons" type="submit" value="Vyhľadať zamestnanca"></div>
            <div class="col-xs-6"><input class="buttons" type="reset" value="Resetovať vyhľadávanie"></div>
        </form>
    </div>
    <div class="col-sm-12 resultWindow">
        <div id="searchResults" class="resultsBar">

        </div>
    </div>
</div>
<script type="text/javascript">
    var frm = $('#myForm');

    frm.submit(function (e) {

        e.preventDefault();
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                document.getElementById('searchResults').innerHTML=data;
            },

        });
    });
    function sendMSG($Name) {
        $.post("http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/new_konverzation.php",{ user_id: $Name} ,function(data) {
            if(data=="ok") {
                $("#componentWindow").load("SystemComponents/Messeges_Component.php");
                active(2);
            }
        });
    }
</script>
</body>