<?php
include "../../PHP/config_DB.php";
$id=$_POST['id'];
if(isset($_SESSION['session'])){

    $sql = "Delete from precitane_blog where Blog_idBlog='" . $id . "'";
    $con->query($sql);

    $sql = "Delete from blog where idBlog='" . $id . "'";
    $con->query($sql);
}
?>