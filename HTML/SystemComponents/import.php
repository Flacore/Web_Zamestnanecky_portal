<?php include "../../PHP/config_DB.php";
$id=$_SESSION['session'];
?>
<div class="container center" id="import_persons">
    <div>
        <h3>Vloženie osôb.</h3>
        <div class="center">
            <label>Nahraj súbor:</label>
        </div>
        <input class="center" type="file" name="input_file"
               id="input_file" accept="text">
        <br>
    </div>

    <div id="select_spacer" class="hidden">
        <div class="center">
            <h3>Zadaj oddelovač.</h3>
            <input type="text" id="oddelovac">
            <br>
            <button class="col-sm-12 btn-submit center-icon" onclick="oddelovacka()" name="submit">Zvoliť</button>
        </div>
        <br>
        <br>
    </div>

    <div id="list" class="hidden">
        <br>
        <div>
            <?php

            echo"<div class='center'>
                            <label>Pracovisko:</label>
                            <select id=\"pracovisko_line\">";
            $sql = mysqli_query($con, "select * from pracovisko");
            $x = 0;
            while ($rows = $sql->fetch_assoc()) {
                $datas[$x] = $rows;
                ++$x;
            }
            for ($k = 0; $k < $x; $k++) {
                $rowi = $datas[$k];
                echo "
                        <option value=\"" . $rowi['idPracovisko'] . "\">" . $rowi['Názov'] . "</option>
                        ";
            }
            echo"</select></div>";

            echo"<div class='center'>
                            <label>Funkcia:</label>
                            <select id=\"funkcia_line\">";
            $sql = mysqli_query($con, "select * from funkcie");
            $x = 0;
            while ($rows = $sql->fetch_assoc()) {
                $datas[$x] = $rows;
                ++$x;
            }
            for ($k = 0; $k < $x; $k++) {
                $rowi = $datas[$k];
                echo "
                        <option value=\"" . $rowi['idPozícia'] . "\">" . $rowi['Nazov'] . "</option>
                        ";
            }
            echo"</select></div>";

            ?>
            <div class="center">
                <label>Rodné číslo: <input type="number" id="rodcislo_line" min="1" value="1"></label>
                <label>Meno: <input type="number" id="meno_line" min="1" value="1"></label>
                <label>Priezvisko: <input type="number" id="priezvisko_line" min="1" value="1"></label>
            </div>
        </div>
        <button class="col-sm-12 btn-submit center-icon" onclick="nahraj()" name="submit">Nahraj</button>
        <div id="users_list" class="overflow-x">

        </div>
    </div>
</div>
<script>
    var finished=0;
    var num_lines=0;
    var num_item=0;
    var file_lines=[];
    var item=[];
    var login=[];
    var c=0;

    function load_file(){
        var fileName= document.getElementById('input_file').files[0].name;
        var end = fileName.substring(fileName.lastIndexOf('.') + 1);
        if(end === 'csv' || end === 'txt') {
            var fr = new FileReader();
            fr.onload = function () {
                var n = 0;
                var lines = fr.result.split('\n');
                for (var line = 0; line < lines.length; line++) {
                    file_lines[n] = lines[line];
                    n++;
                }
                num_lines = n;
            }

            fr.readAsText(this.files[0]);

            document.getElementById('select_spacer').classList.remove('hidden');
        }else{
            alert('Nieje možné načítať súbor.')
            document.getElementById('select_spacer').classList.add('hidden');
            document.getElementById('list').classList.add('hidden');
        }
    }

    document.getElementById('input_file')
        .addEventListener('change', function() {
            var fileName= this.files[0].name;
            var end = fileName.substring(fileName.lastIndexOf('.') + 1);
            if(end === 'csv' || end === 'txt') {
                var fr = new FileReader();
                fr.onload = function () {
                    var n = 0;
                    var lines = fr.result.split('\n');
                    for (var line = 0; line < lines.length; line++) {
                        file_lines[n] = lines[line];
                        n++;
                    }
                    num_lines = n;
                };

                fr.readAsText(this.files[0]);

                document.getElementById('select_spacer').classList.remove('hidden');
            }else{
                alert('Nieje možné načítať súbor.');
                document.getElementById('select_spacer').classList.add('hidden');
                document.getElementById('list').classList.add('hidden');
            }
        });

    function oddelovacka() {
        let oddelovac = document.getElementById('oddelovac').value;

        for(let n = 0; n < num_lines; n++){
            item[n]=[];
            if(file_lines[n]!=='') {
                if (file_lines[n].charAt(file_lines[n].length - 2) === oddelovac)
                    file_lines[n] = file_lines[n].slice(0, -2);
                var items = file_lines[n].split(oddelovac);
                for (var k = 0; k < items.length; k++) {
                    item[n][k] = items[k];
                }
                num_item = items.length;
            }
        }

        if(num_item>=3 && oddelovac!==''){
            let users_space = document.getElementById('users_list');
            var html='<div class=\"position tableStyle\"><table><tr>';
            for(let n = 0; n < num_item; n++) {
                html=html+'<th>'+(n+1)+'</th>';
            }
            html=html+'</tr>';
            for(var j = 0; j < num_lines; j++) {
                html=html+'<tr>';
                for(var n = 0; n < num_item; n++) {
                    html=html+'<td>'+item[j][n]+'</td>';
                }
                html=html+'</tr>';
            }
            html=html+'</table></div>';
            users_space.innerHTML=html;

            var rod_cislo_i=document.getElementById('rodcislo_line').max=num_item;
            var name_i=document.getElementById('meno_line').max=num_item;
            var sur_name_i=document.getElementById('priezvisko_line').max=num_item;
            document.getElementById('list').classList.remove('hidden');
        }else{
            alert('Nemožno importovať dáta.')
            document.getElementById('list').classList.add('hidden');
        }
    }

    function nahraj() {
        var y=num_lines;

        var rod_cislo_i=document.getElementById('rodcislo_line').value;
        var name_i=document.getElementById('meno_line').value;
        var sur_name_i=document.getElementById('priezvisko_line').value;
        var pracovisko_id=document.getElementById('pracovisko_line').value;
        var funkcia_id=document.getElementById('funkcia_line').value;

        if(rod_cislo_i!==name_i && rod_cislo_i!==sur_name_i && sur_name_i!==name_i) {
            for (var k = 0; k < y; k++) {
                var rod_cislo = item[k][rod_cislo_i - 1];
                if (test_rod(rod_cislo)) {
                    var name = item[k][name_i - 1];
                    var sur_name = item[k][sur_name_i - 1];
                    if (name !== '' && sur_name !== '') {
                        $.ajax({
                            type: 'POST',
                            data: {
                                rod_cislo: rod_cislo,
                                name: name,
                                sur_name: sur_name,
                                pracovisko: pracovisko_id,
                                funkcia: funkcia_id
                            },
                            url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/add_person.php',
                            success: function (data) {
                                alert(data);
                                login[c] = data;
                                c++;
                                finished++;
                                if(finished===num_lines){
                                    var text = 'rodne cislo;meno;priezvisko;login;Heslo\n';
                                    for (var j = 0; j < num_lines; j++) {
                                        text = text + item[j][rod_cislo_i - 1] + ';' + item[j][name_i - 1] + ';' + item[j][sur_name_i - 1] + ';' + login[j] + ';Heslo pozostava z velkych incialok a rodneho cisla bez lomitka.\n';
                                    }
                                    download('list.csv', text);
                                    location.reload();
                                }
                            }
                        });
                    } else {
                        alert('Nemožno vlozit zaznam.');
                        login[c] = 'Nevlozene';
                        c++;
                    }
                }
            }
        }else{
            alert('Nemožno importovať dáta.')
        }
    }

    function download(filename, text) {
        var element = document.createElement('a');
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
        element.setAttribute('download', filename);

        element.style.display = 'none';
        document.body.appendChild(element);

        element.click();

        document.body.removeChild(element);
    }

    function test_rod(rod) {
        if(rod.length===11) {
            var min = '000000/0000';
            var max = '999999/9999';
            if (rod[6] !== max[6]) {
                return false;
            }
            for (var i = 0; i < 11; i++) {
                if (!(rod[i] >= min[i] && rod[i] <= max[i]))
                    return false;
                if (i === 5)
                    i++;
            }
            return true;
        }else{
            return  false;
        }
    }
</script>