<?php include "../../PHP/config_DB.php";
$id=$_SESSION['session'];
$sql = mysqli_query($con, "
            SELECT * from os_udaje ou
            join prirad_funkcia pf on(ou.rod_cislo = pf.os_udaje_rod_cislo)
            join pravomoci po on(po.funkcie_idPozícia = pf.funkcie_idPozícia)
            where pf.do is null and ou.rod_cislo ='".$id."'
        ");
$info = $sql->fetch_assoc();
?>
<body>
<?php
    if($info['Kariera']==1){
        echo "
        <br>
        <div style=\"width: 200px;\" class=\"center\">
            <div style=\"float: left;\" id=\"newCariere\" class=\"newMessege\" onclick=\"create_cariere()\">
                <span class=\"glyphicon glyphicon-plus\"></span>
            </div>
            <div style=\"float: right;\" id=\"My_Carieres\" class=\"newMessege\" onclick=\"my_cariere()\">
                <span class=\"glyphicon glyphicon-list\"></span>
            </div>
        </div>
        ";
    }
    ?>
    <br>
    <div class="container" id="prac_pozicie">
        <br><br><br>
        <?php
        $sql = mysqli_query($con, "select * from projekty left join subor on(idSubor=Subor_idSubor) where os_udaje_rod_cislo<>'".$id."' and datum > CURRENT_DATE order by datum asc");
        $num = mysqli_query($con, "select count(*) as NumberData from projekty where os_udaje_rod_cislo<>'".$id."' and datum > CURRENT_DATE");
        $num_row=mysqli_fetch_array($num);
        $n=$num_row['NumberData'];
        $i = 0;
        while ($rows = $sql->fetch_assoc()){
            $data[$i]=$rows;
            ++$i;
        }

        if($n>0) {
            echo "       
               <div class=\"position tableStyle\">
                    <table>
                        <tr>
                            <th>Dátum</th>
                            <th>Popis</th>
                            <th>Na stiahnutie</th>
                        </tr>
                        <div>";
            for ($i = 0; $i < $n; $i++) {
                $row = $data[$i];
                if($row['verejne']==0 || $row['verejne']==1) {
                    echo "               
                         <div>
                                <tr>
                                    <td>" .  date('d.m.Y',strtotime($row['datum'])) . "</td>
                                    <td>
                                        " . $row['popis'] . "
                                    </td>
                                    <td><button onclick=\"download('".$row['cesta']."')\" class=\"carier-btn\">Dokument (PDF)</button></td>
                                </tr>
                            </div>
                        ";
                }
            }
            echo "
                        </div>
                    </table>
                </div>";
        }else{
            echo " 
                    <h2 class=\"txtCenter txtBlack\">Ľutujeme, momentálne niesu dostupné žiadne pracovné pozície.</h2>
                ";
        }
        ?>
        <br>
    </div>
    <script>
        function  create_cariere() {
            let modal = document.getElementById("modal_career");
            modal.style.display = "block";
            document.getElementById("ad_career").classList.remove('hidden');
            document.getElementById("my_career").classList.add('hidden');
        }

        function  my_cariere() {
            let modal = document.getElementById("modal_career");
            modal.style.display = "block";
            document.getElementById("ad_career").classList.add('hidden');
            document.getElementById("my_career").classList.remove('hidden');
        }
    </script>
</body>