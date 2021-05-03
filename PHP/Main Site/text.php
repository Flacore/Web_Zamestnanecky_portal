<?php
    include "../config_DB.php";

    $id=$_POST['id'];

    $sql = mysqli_query($con, "SELECT * FROM blog join os_udaje on(os_udaje_rod_cislo=rod_cislo) where idBlog='".$id."' ");
    $i = 0;
    while ($rows = $sql->fetch_assoc()){
        $data[$i]=$rows;
        ++$i;
    }
    $row=$data[0];
echo "
                <h2 class=\"title col-sm-12\">".$row['nadpis']."</h2>
                    <h5 class=\"text col-sm-12\">
                        ".$row['predtext']."
                    </h5>
                    <h5 class=\"text col-sm-12\">
                        ".$row['text']."
                    </h5>
                <h5 class=\"text-detail col-sm-12\">Dátum: ". date('d.m.Y',strtotime($row['datum']))."</h5>
                <h5 class=\"text-detail col-sm-12\">Autor: ".$row['Meno']." ".$row['Priezvisko']."</h5>
";

?>