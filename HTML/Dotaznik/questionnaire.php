<!--inputgroup-->
<?php
    include "../../PHP/config_DB.php";
    $form_id=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zamestnanecký portál</title>

    <link rel="stylesheet" href="../../CSS/Dotaznik/form.css">
</head>
<body>
    <div class="form_div">
        <?php
        $sql = mysqli_query($con, "select * from prvok where formular_idformular='".$form_id."' order by z_index asc");
        $num = mysqli_query($con, "select count(*) as NumberData from prvok where formular_idformular='".$form_id."' ");
        $num_row=mysqli_fetch_array($num);
        $n=$num_row['NumberData'];
        $i = 0;
        while ($rows = $sql->fetch_assoc()){
            $data[$i]=$rows;
            ++$i;
        }

        for($i=0;$i<$n;$i++){
            $row = $data[$i];

            $typ=$row['typ_prvku'];


            if($typ==1)
                comp_1($row);
            if($typ==2)
                comp_2($row);
            if($typ==3)
                comp_3($row);
            if($typ==4)
                comp_4($row);
            if($typ==5)
                comp_5($row);
            if($typ==6)
                comp_6($row);
            if($typ==7)
                comp_7($row);
            if($typ==8)
                comp_8($row);
            if($typ==9)
                comp_9($row);
            if($typ==10)
                comp_10($row);
            if($typ==11)
                comp_11($row);
            if($typ==12)
                comp_12($row);
            if($typ==13)
                comp_13($row);
            if($typ==14)
                comp_14($row);
            if($typ==15)
                comp_15($row);
            if($typ==16)
                comp_16($row);
        }

        ?>
    </div>
</body>
</html>
<?php

function comp_1($element){
    if($element['Vyzadovanie']==null){
        $requered='';
    }else{
        $requered='required';
    }
    echo "<h3 class='center'>".$element['Nazov']."</h3>";
    echo "<form method='post' action=''>
            <input class='hidden' type='number' value='".$element['idprvok']."' name='prvok_id'>
            <input class='hidden' type='number' value='1' name='type'>
            <input class='center' type='text' name='odpoved' ".$requered.">
          </form>";
}

function comp_2($element){
    if($element['Vyzadovanie']==null){
        $requered='';
    }else{
        $requered='required';
    }
    echo "<h3 class='center'>".$element['Nazov']."</h3>";
    echo "<form method='post' action=''>
            <input class='hidden' type='number' value='".$element['idprvok']."'>
            <input class='hidden' type='number' value='2' name='type'>
            <input class='center' type='text' name='odpoved' ".$requered.">
          </form>";
}

function comp_3($element){

}

function comp_4($element){

}

function comp_5($element){

}

function comp_6($element){

}

function comp_7($element){
    if($element['Vyzadovanie']==null){
        $requered='';
    }else{
        $requered='required';
    }
    echo "<h3 class='center'>".$element['Nazov']."</h3>";
    echo "<form method='post' action=''>
            <input class='hidden' type='number' value='".$element['idprvok']."'>
            <input class='hidden' type='number' value='2' name='type'>
            <input class='center' type='date' name='datum' ".$requered.">
          </form>";
}

function comp_8($element){
    if($element['Vyzadovanie']==null){
        $requered='';
    }else{
        $requered='required';
    }
    echo "<h3 class='center'>".$element['Nazov']."</h3>";
    echo "<form method='post' action=''>
            <input class='hidden' type='number' value='".$element['idprvok']."'>
            <input class='hidden' type='number' value='2' name='type'>
            <input class='center' type='time' name='cas' ".$requered.">
          </form>";
}

function comp_9($element){

}

function comp_10($element){

}

function comp_11($element){

}

function comp_12($element){

}

function comp_13($element){

}

function comp_14($element){

}

function comp_15($element){

}

function comp_16($element){

}

?>