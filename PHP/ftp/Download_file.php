<?php
    include "../config_FTP.php";

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($_GET["cesta"]));
    echo file_get_contents('http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/Server'.str_replace(' ', '%20', $_GET["cesta"]));
?>