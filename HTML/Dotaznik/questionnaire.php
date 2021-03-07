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
        <div class="section">
        <?php
        $questions=0;
        $sql = mysqli_query($con, "select * from prvok where formular_idformular='".$form_id."' order by z_index asc");
        $num = mysqli_query($con, "select count(*) as NumberData from prvok where formular_idformular='".$form_id."' ");
        $num_row=mysqli_fetch_array($num);
        $n=$num_row['NumberData'];
        $i = 0;
        while ($rows = $sql->fetch_assoc()){
            $data[$i]=$rows;
            ++$i;
        }

        echo "
            <form id='form_quiz_ans' name='form_quiz_ans' class='hidden' action='http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_ans.php' method='post'>
                <input class='hidden' type='number' value='".$form_id."' name='formID'>
            </form>
        ";

        for($i=0;$i<$n;$i++){
            $row = $data[$i];

            $typ=$row['typ_prvku'];

            if($typ<12)
                $questions++;
            if($typ!=16)
                echo "<div class='form_container'><br>";
            if($typ==1)
                comp_1($row);
            if($typ==2)
                comp_2($row);
            if($typ==3)
                comp_3($row,$con);
            if($typ==4)
                comp_4($row,$con);
            if($typ==5)
                comp_5($row,$con);
            if($typ==6)
                comp_6($row,$form_id);
            if($typ==7)
                comp_7($row);
            if($typ==8)
                comp_8($row);
            if($typ==9)
                comp_9($row,$con);
            if($typ==10)
                comp_10($row,$con);
            if($typ==11)
                comp_11($row,$con);
            if($typ==12)
                comp_12($row);
            if($typ==13)
                comp_13($row);
            if($typ==14)
                comp_14($row,$con);
            if($typ==15)
                comp_15($row,$con);
            if($typ==16)
                comp_16($row);
            if($typ!=16)
                echo "<br></div>";
        }
        if($questions>0)
            echo "<br><button onclick='submit_form()' class='center'>Odoslať</button>";

        ?>
        </div>
    </div>
    <iframe class="hidden" id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;">
    </iframe>
</body>
</html>
<script type="text/javascript">
    $('input[type="checkbox"]').on('change', function() {
        $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    });

    function startUpload(){
        document.getElementById('f1_upload_process').style.display = 'block';
        return true;
    }

    function stopUpload(success,idPrvok,idvalue,value){
        if (success == 1){
            document.getElementById('result').innerHTML =
                '<span class="cente msg">Súbor sa nahral!<\/span><br/><br/>';
            document.getElementById(idPrvok).classList.add('hidden');
            alert(value);
            alert(idPrvok+"_"+idvalue);
            let tmp=document.getElementById(idPrvok+"_"+idvalue);
            tmp.value=value;
        }
        else {
            document.getElementById('result').innerHTML =
                '<span class="center emsg">Došlo ku chybe!<\/span><br/><br/>';
        }
        document.getElementById('f1_upload_process').style.display = 'none';
        return true;
    }

    function submit_form() {
        let url=document.form_quiz_ans.action;
        let formData = $("#form_quiz_ans").serialize();
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            success: function(data)
            {
                submit_item(data);
                // location.href="questionnaire_succes.php";
            }
        });
    }

    //TODO
    function submit_item(data) {
        var prvky = document.getElementsByClassName('form_quiz');
        for (let i = 0; i < prvky.length; ++i) {
            let item = prvky[i];
            let formData = $(item).serialize();
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                enctype: 'multipart/form-data',
                success: function(data)
                {
                    location.href="questionnaire_succes.php";
                }
            });
        }
    }
</script>
<?php
$num=0;

function comp_1($element){
    if($element['Vyzadovanie']==null){
        $requered='';
    }else{
        $requered='required';
    }
    echo "<h3 class='center'>".$element['Nazov']."</h3>";
    echo "<form class='form_quiz' method='post' action=''>
            <input class='hidden' type='number' value='tmp' name='vyplnenie'>
            <input class='hidden' type='number' value='".$element['idprvok']."' name='prvok_id'>
            <input class='hidden' type='number' value='1' name='type'>
            <input class='center' type='text' name='odpoved' ".$requered." maxlength=\"256\">
          </form>";
}

function comp_2($element){
    if($element['Vyzadovanie']==null){
        $requered='';
    }else{
        $requered='required';
    }
    echo "<h3 class='center'>".$element['Nazov']."</h3>";
    echo "<form class='form_quiz' method='post' action=''>
            <input class='hidden' type='number' value='tmp' name='vyplnenie'>
            <input class='hidden' type='number' value='".$element['idprvok']."'>
            <input class='hidden' type='number' value='2' name='type'>
            <input class='center' type='text' name='odpoved' ".$requered." maxlength=\"2048\">
          </form>";
}

function comp_3($element,$con){
    if($element['Vyzadovanie']==null){
        $requered='';
    }else{
        $requered='required';
    }
    echo "<h3 class='center'>".$element['Nazov']."</h3> <div class='center'><form class='form_quiz' method='post' action=''>";
    $sql = mysqli_query($con, "select * from moznost where prvok_idprvok='".$element['idprvok']."'");
    $i=0;
    while ($rows = $sql->fetch_assoc()){
        $data[$i]=$rows;
        ++$i;
    }
    for($n=0;$n<$i;$n++){
        $row=$data[$n];
        echo "
             <input type=\"checkbox\" name='group".$element['idprvok']."' />
            <label>".$row['text']."</label>";
    }
    echo "</form></div>";
}

function comp_4($element,$con){
    if($element['Vyzadovanie']==null){
        $requered='';
    }else{
        $requered='required';
    }
    echo "<h3 class='center'>".$element['Nazov']."</h3> <div class='center'><form class='form_quiz' method='post' action=''>";
    $sql = mysqli_query($con, "select * from moznost where prvok_idprvok='".$element['idprvok']."'");
    $i=0;
    while ($rows = $sql->fetch_assoc()){
        $data[$i]=$rows;
        ++$i;
    }
    for($n=0;$n<$i;$n++){
        $row=$data[$n];
        echo "
             <input type=\"checkbox\" name='group".$element['idprvok']."_".$row['idMoznost']."' />
            <label>".$row['text']."</label>";
    }
    echo "</form></div>";
}

function comp_5($element,$con){
    if($element['Vyzadovanie']==null){
        $requered='';
    }else{
        $requered='required';
    }
    echo "<h3 class='center'>".$element['Nazov']."</h3>";
    $sql = mysqli_query($con, "select * from moznost where prvok_idprvok='".$element['idprvok']."'");
    $i=0;
    while ($rows = $sql->fetch_assoc()){
        $data[$i]=$rows;
        ++$i;
    }
    echo "
    <div class='center'>
        <form class='form_quiz' method='post' action=''>
        <input list=\"list".$element['idprvok']."\"  ".$requered." name='list_item'>
        <datalist id=\"list".$element['idprvok']."\">";
    for($n=0;$n<$i;$n++){
        $row=$data[$n];
        echo "<option value='".$row['text']."' >";
    }
    echo" </datalist>
    </form>
    </div>  
    ";
}

function comp_6($element,$formID){
    echo "<h3 class='center'>".$element['Nazov']."</h3>";
    echo       "<p class='center' style='display: none' id=\"f1_upload_process\">Nahrávam...<br/><img src=\"https://mir-s3-cdn-cf.behance.net/project_modules/disp/585d0331234507.564a1d239ac5e.gif\" /></p>
                <p class='center' id=\"result\"></p>
                <form class='form_quiz' class='hidden'>
                    <input class='hidden' id='".$element['idprvok']."_".$formID."' type='number' name='id_subor'>
                </form>
                <form id='".$element['idprvok']."' class='center' action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/file_ans.php\" method=\"post\" enctype=\"multipart/form-data\" target=\"upload_target\" onsubmit=\"startUpload();\">
                    <input class='center' type=\"file\" name='file_path'>
                    <input value='".$formID."' class='hidden' type=\"number\" name='FormID'>
                    <input value='".$element['idprvok']."' class='hidden' type='number' name='idPrvok'> 
                    <input type=\"submit\" name=\"submitBtn\" value=\"Upload\" />
                </form>";
}

function comp_7($element){
    if($element['Vyzadovanie']==null){
        $requered='';
    }else{
        $requered='required';
    }
    echo "<h3 class='center'>".$element['Nazov']."</h3>";
    echo "<form class='form_quiz' method='post' action=''>
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
    echo "<form class='form_quiz' method='post' action=''>
            <input class='hidden' type='number' value='".$element['idprvok']."'>
            <input class='hidden' type='number' value='2' name='type'>
            <input class='center' type='time' name='cas' ".$requered.">
          </form>";
}

function comp_9($element,$con){
    if($element['Vyzadovanie']==null){
        $requered='';
    }else{
        $requered='required';
    }
    echo "<h3 class='center'>".$element['Nazov']."</h3> 
    <div class='center'><table class='center'><form class='form_quiz' method='post' action=''>";
    $sql = mysqli_query($con, "select * from moznost where prvok_idprvok='".$element['idprvok']."'");
    $i=0;
    while ($rows = $sql->fetch_assoc()){
        $data[$i]=$rows;
        ++$i;
    }
    for($n=0;$n<$i;$n++){
        $row=$data[$n];
        $sql = mysqli_query($con, "select * from moznost where moznost_idMoznost='".$row['idMoznost']."'");
        $j=0;
        while ($rows = $sql->fetch_assoc()){
            $data_submoznost[$j]=$rows;
            ++$j;
        }
        echo "<tr><th>".$row['text']."</th>";
        for($k=0;$k<$j;$k++){
            $submoznost=$data_submoznost[$k];
            echo "
                    <td>
                        <h5>".$submoznost['text']."</h5>
                        <input type=\"checkbox\" name='group".$element['idprvok']."_".$row['idMoznost']."' />
                    </td>
            ";
        }
        echo "</tr>";
    }
    echo "</form></table></div>";
}

function comp_10($element,$con){
    if($element['Vyzadovanie']==null){
        $requered='';
    }else{
        $requered='required';
    }
    echo "<h3 class='center'>".$element['Nazov']."</h3> 
    <div class='center'><table class='center'><form class='form_quiz' method='post' action=''>";
    $sql = mysqli_query($con, "select * from moznost where prvok_idprvok='".$element['idprvok']."'");
    $i=0;
    while ($rows = $sql->fetch_assoc()){
        $data[$i]=$rows;
        ++$i;
    }
    for($n=0;$n<$i;$n++){
        $row=$data[$n];
        $sql = mysqli_query($con, "select * from moznost where moznost_idMoznost='".$row['idMoznost']."'");
        $j=0;
        while ($rows = $sql->fetch_assoc()){
            $data_submoznost[$j]=$rows;
            ++$j;
        }
        echo "<tr><th>".$row['text']."</th>";
        for($k=0;$k<$j;$k++){
            $submoznost=$data_submoznost[$k];
            echo "
                    <td>
                        <h5>".$submoznost['text']."</h5>
                        <input type=\"checkbox\" name='group".$element['idprvok']."_".$row['idMoznost']."_".$submoznost['idMoznost']."' />
                    </td>
            ";
        }
        echo "</tr>";
    }
    echo "</form></table></div>";
}

function comp_11($element,$con){
    $min=$element['min'];
    $max=$element['max'];
    if($element['Vyzadovanie']==null){
        $requered='';
    }else{
        $requered='required';
    }
    echo "<h3 class='center'>".$element['Nazov']."</h3> 
    <div class='center'><form class='form_quiz' method='post' action=''><table class='center'>";
    echo "<input value='".$element['idprvok']."' class='hidden' type='number' name='idprvok'>
          <input class='hidden' type='number' value='".$min."' name='min'>
          <input class='hidden' type='number' value='".$max."' name='max'>";
    if($max-$min<10){
        echo "<tr>";
        for($n=$min;$n<=$max;$n++){
            echo "<td><h5>$n</h5></td>";
        }
        echo "</tr>";
        echo "<tr>";
        for($n=$min;$n<=$max;$n++){
            echo "<td><input type=\"checkbox\" name='".$element['idprvok']."_".$n."' value='true'/></td>";
        }
        echo "</tr>";
    }else{
        echo "<input  type='number' min='".$min."' max='".$max."' name='value'>";
    }
    echo "</table></form></div>";
}


function comp_12($element){
    echo"<div class='form_tittle'>
            <h3 class='center'>".$element['Nazov']."</h3>
            <h5 class='center'>".$element['Popis']."</h5>
        </div>";
}


function comp_13($element){
    echo"<div class='text'>
            <h3 class='center'>".$element['Nazov']."</h3>
            <h5 class='center'>".$element['Popis']."</h5>
        </div>";
}

function comp_14($element,$con){
    $sql = mysqli_query($con, "select * from obsah where prvok_idprvok='".$element['idprvok']."'");
    $i=0;
    while ($rows = $sql->fetch_assoc()){
        $data[$i]=$rows;
        ++$i;
    }
    $local_element=$data[0];
    if($local_element['url']==null || $local_element['url']==""){
        $sql = mysqli_query($con, "select * from subor where idSubor='".$local_element['Subor_idSubor']."'");
        $i=0;
        while ($rows = $sql->fetch_assoc()){
            $data[$i]=$rows;
            ++$i;
        }
        $file=$data[0];
        $url="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/Server".$file['cesta'];
    }else{
        $url=$local_element['url'];
    }
    echo "
        <div>
            <h3 class='center'>".$element['Nazov']."</h3>
            <img class='center' src=\"".$url."\" width=\"500\" height=\"333\">
        </div>
    ";
}

function comp_15($element,$con){
    $sql = mysqli_query($con, "select * from obsah where prvok_idprvok='".$element['idprvok']."'");
    $i=0;
    while ($rows = $sql->fetch_assoc()){
        $data[$i]=$rows;
        ++$i;
    }
    $local_element=$data[0];
    if($local_element['url']==null || $local_element['url']==""){
        $sql = mysqli_query($con, "select * from subor where idSubor='".$local_element['Subor_idSubor']."'");
        $i=0;
        while ($rows = $sql->fetch_assoc()){
            $data[$i]=$rows;
            ++$i;
        }
        $file=$data[0];
        $url="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/Server".$file['cesta'];
    }else{
        $url=$local_element['url'];
    }
    if(!(strpos($url, 'youtube') > 0 || strpos($url, 'vimeo') > 0 ||strpos($url, 'youtu.be') > 0)){
        echo "
            <div>
                <h3 class='center'>".$element['Nazov']."</h3>
                <video class='center' src=\"".$url."\" controls>
                    V tomto prehliadači nieje možné prehrať toto video.
                    <a href='".$url."' target=\"_blank\">link na video</alink>
                </video>
            </div>
        ";
    }
    else {
        if(strpos($url, 'youtube') > 0){
            $url=str_replace("watch?v=","embed/", $url);
        }
        if(strpos($url, 'youtu.be') > 0){
            $url=str_replace("https://youtu.be/","https://www.youtube.com/embed/", $url);
        }
        if(strpos($url, 'vimeo') > 0){
            $url=str_replace("https://vimeo.com/","https://player.vimeo.com/video/", $url);
        }

        echo "
            <div>
                <h3 class='center'>" . $element['Nazov'] . "</h3>
                <iframe class='center' width=\"420\" height=\"315\" src=\"".$url."\" frameborder=\"0\" allowfullscreen>
                    V tomto prehliadači nieje možné prehrať toto video.
                    <a href='".$url."' target=\"_blank\">link na video</alink>
                </iframe>
            </div>
        ";
    }
}


function comp_16($element){
    echo "   </div>
        <div class=\"section\">
        <div class='form_tittle'>
            <div class='form_container'><br>
            <h3 class='center'>".$element['Nazov']."</h3>
            <h5 class='center'>".$element['Popis']."</h5>
            <br></div>
        </div>";
}

?>