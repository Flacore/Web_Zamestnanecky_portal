<?php
include "../config_FTP.php";

function upload_file($subor,$server_dir)
{
    $cesta_server=$server_dir.basename($subor['file_path']['name']);

    $ftp_connection=config_FTP();

    if (ftp_nlist($ftp_connection, $server_dir) === false) {
        ftp_mkdir($ftp_connection,$server_dir);
    }
    ftp_chdir($ftp_connection, $server_dir);
    ftp_put($ftp_connection, $cesta_server, $subor['file_path']['tmp_name'], FTP_BINARY);
    ftp_close($ftp_connection);

}
function clean_ftp_nlist($ftp,$server){
    $file_on_server=ftp_nlist($ftp,$server);
    return array_values(array_diff($file_on_server,array('.','..')));
}
?>