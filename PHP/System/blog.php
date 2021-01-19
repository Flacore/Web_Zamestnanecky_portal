<?php
include "../config.php";

$id=$_POST['id'];

$sql = mysqli_query($con, "SELECT * FROM blog join (uzivatel join os_udaje) where idBlog='".$id."' ");
$i = 0;
while ($rows = $sql->fetch_assoc()){
    $data[$i]=$rows;
    ++$i;
}
$row=$data[0];
echo "
        <div class=\"msg-textForm blog-top\">
            <div class=\"col-sm-12 info-blog\">
                <h2>".$row['nadpis']."</h2>
            </div>
        </div>

        <div id=\"article_view\" class=\"msg-Window blog-article\">
            <div class=\"col-sm-12 predtext\">
                <h5>".$row['predtext']."</h5>
            </div>
            <div class=\"col-sm-12 text\">
                <h5>".$row['text']."</h5>
            </div>
        </div>

        <div class=\"msg-textForm blog-bottom\">
            <div class=\"col-sm-12 info-blog\">
                <div class=\"col-md-6\">
                    <h5>".$row['Meno']." ".$row['Priezvisko']."</h5>
                </div>
                <div class=\"col-md-6\">
                    <h5>".$row['datum']."</h5>
                </div>
            </div>
        </div>

";

?>
