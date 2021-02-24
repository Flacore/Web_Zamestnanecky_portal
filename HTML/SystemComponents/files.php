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
</script>
</body>