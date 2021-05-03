<?php include "../../PHP/config_DB.php";
$id=$_SESSION['session'];
?>
<body>

<div class="container center" id="add_person">
    <h3>Vloženie osoby.</h3>
    <form action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/add_person.php" method="post">
        <div class="center">
            <label>Rodné číslo</label>
            <input type="text" pattern="[0-9]{6}/[0-9]{4}" name="rod_cislo" required>
        </div>
        <div class="center">
            <label>Meno</label>
            <input type="text" name="name" required>
        </div>
        <div class="center">
            <label>Priezvisko</label>
            <input type="text" name="sur_name" required>
        </div>
        <div class="center">
            <label>Pracovisko:</label>
            <select name="pracovisko">
                <?php
                    $sql = mysqli_query($con, "select * from pracovisko");
                    $i = 0;
                    while ($rows = $sql->fetch_assoc()){
                        $data[$i]=$rows;
                        ++$i;
                    }
                    for($n=0;$n<$i;$n++){
                        $row=$data[$n];
                        echo "
                        <option value=\"".$row['idPracovisko']."\">".$row['Názov']."</option>
                        ";
                    }
                ?>
            </select>
        </div>
        <div class="center">
            <label>Funkcia:</label>
            <select name="funkcia">
                <?php
                $sql = mysqli_query($con, "select * from funkcie");
                $i = 0;
                while ($rows = $sql->fetch_assoc()){
                    $data[$i]=$rows;
                    ++$i;
                }
                for($n=0;$n<$i;$n++){
                    $row=$data[$n];
                    echo "
                        <option value=\"".$row['idPozícia']."\">".$row['Nazov']."</option>
                        ";
                }
                ?>
            </select>
        </div>
        <input type="submit" name="button" value="Odoslať">
    </form>
</div>

</body>