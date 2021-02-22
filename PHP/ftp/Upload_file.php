<?php
include "../config_FTP.php";

$local_dir ="C:\Users\miciz.DESKTOP-F2HGHHU\Pictures\Wallpaper\Cars";
$remote_server_dir="/";

$files=clean_scandir($local_dir);

for($i=0;$i<count($files);$i++){
    $files_on_server=clean_ftp_nlist($ftp_connection,$remote_server_dir);
    if(!in_array("$files[$i]",$files_on_server)){
        if(ftp_put($ftp_connection,"$remote_server_dir/$files[$i]","$local_dir/$files[$i]",FTP_BINARY)){}
    }
}
ftp_close($ftp_connection);

function clean_ftp_nlist($ftp,$server){
    $file_on_server=ftp_nlist($ftp,$server);
    return array_values(array_diff($file_on_server,array('.','..')));
}
?>