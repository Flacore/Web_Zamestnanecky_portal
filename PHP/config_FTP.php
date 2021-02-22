<?php
$ftp_host='localhost';
$ftp_user='root';
$ftp_pass='admin';

$ftp_connection=ftp_connect($ftp_host) or die ("Nastal problém, nemôžem sa pripojiť k Servéru.");
ftp_login($ftp_connection,$ftp_user,$ftp_pass) or die ("Nastal problém, nemôžem sa pripojiť k Servéru.");
ftp_pasv($ftp_connection,true);
?>