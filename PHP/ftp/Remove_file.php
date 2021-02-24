<?php
include "../config_FTP.php";
function remove_file($target_file)
{
    $ftp_connection = config_FTP();
    ftp_delete($ftp_connection, $target_file);
}
?>