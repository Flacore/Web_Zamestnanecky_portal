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
</script>
</body>