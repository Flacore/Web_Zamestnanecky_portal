<?php
include "../config_FTP.php";

$target_file = "test.txt";
ftp_delete($ftp_connection, $target_file)
?>