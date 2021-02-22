<?php
    include "../config_FTP.php";

    $target_dir = "/";
    $files = ftp_nlist($ftp_connection, $target_dir);
    foreach($files as $file) {
        echo "<a href=\"download.php?file=".urlencode($file)."\">".htmlspecialchars($file)."</a>";
        echo "<br>";
    }

?>