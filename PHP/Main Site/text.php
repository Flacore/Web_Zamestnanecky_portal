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
                <h2 class=\"title col-sm-12\">".$row['nadpis']."</h2>
                <div class=\"text-area\">
                    <h5 class=\"text col-sm-12\">
                        ".$row['predtext']."
                    </h5>
                    <h5 class=\"text col-sm-12\">
                        ".$row['text']."
                    </h5>
                </div>
                <h5 class=\"text-detail col-sm-12\">Dátum: ".$row['datum']."</h5>
                <h5 class=\"text-detail col-sm-12\">Autor: ".$row['Meno']." ".$row['Priezvisko']."</h5>
";

?>