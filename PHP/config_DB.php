<?php
ob_start();
session_start();
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = "admin"; /* Password */
//$dbname = "mydb"; /* Database name */
$dbname = "zamestnanecky_portal"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>