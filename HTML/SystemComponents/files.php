<?php include "../../PHP/config_DB.php"; ?>
<body>
<div class="container files">
    <div id="downloadable"></div>
</div>
<script>
    function download(cesta) {
        $.ajax({
            type: 'POST',
            data: {cesta: cesta},
            url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/ftp/Download_file.php',
            success: function(data){
            }
        });
    }
  function remove_item(id_subor) {
        $.ajax({
            type: 'POST',
            data: {idSubor: id_subor},
            url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/remove_file.php',
            success: function(data) {
                location.reload();
            }
        });
    };

    function edit_file(id_subor,element,value,nazov,popis) {
        let formular=document.getElementById("form_file");
        formular.action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/edit_file.php";

        document.getElementById("idFile").value=id_subor;
        document.getElementById("description").value=popis;
        document.getElementById("name").value=nazov;
        let file_input = document.getElementById("file_path");
        file_input.required=false;

        let o_element = document.getElementById(element);
        o_element.value=value;

        let modal = document.getElementById("modal_file");
        modal.style.display = "block";
    }
</script>
</body>