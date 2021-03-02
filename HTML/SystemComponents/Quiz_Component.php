<?php include "../../PHP/config_DB.php"; ?>
<body>
<div id="overview_quiz" class="container">
    <br>
    <div class='col-sm-12'>
        <div class="center file_item_btn" onclick="add_quiz()"><span class="button_icon glyphicon glyphicon-plus"></span></div>
    </div>
    <br><br><br>
<!--        TODO:Prehlad Quizov-->
    <br><br><br>
</div>

<div id="adding_quiz" class="container hidden">

    <br>
    <span class="close-btn" onclick="close_adding()">&times;</span>
    <br>

    <div id="adding_question">
        <div class="form_settings quiz_compartmant">
            <form id="main_form" method="post" action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_form.php">
                <label>
                    <input class="hidden" type="number" value="1" name="z_value">
                </label>
                <select name="form_type">
                    <option value="1">Dotazník</option>
                    <option value="2">Formulár</option>
                </select>
                <input class="hidden" type="number" value="12" name="type">
                <input type="text" value="Nazov" name="Nazov">
                <input type="text" value="popis" name="popis">
                <input type="date" name="platnost_od">
                <input type="date" name="platnost_do">
            </form>
        </div>

    </div>

    <br>
    <button onclick="submit()">Potvrdiť</button>
    <br><br><br><br><br>
</div>
<div id="Quiz_Menu" class="Quiz_menu hidden">
    <div class="Quiz_menu_item" onclick="add_Section()"><span class="glyphicon glyphicon-bookmark"></div>
    <div class="Quiz_menu_item" onclick="add_text()"><span class="glyphicon glyphicon-font"></div>
    <div class="Quiz_menu_item" onclick="add_picture()"><span class="glyphicon glyphicon-picture"></div>
    <div class="Quiz_menu_item" onclick="add_video()"><span class="glyphicon glyphicon-facetime-video"></div>
    <div id="open_dropdown" class="Quiz_menu_item" onclick="open_dropdown()"><span class="glyphicon glyphicon-chevron-down"></div>
    <div class="hidden" id="question_dropdown">
        <div class="Quiz_menu_item" onclick="add_shortANS()"><span class="glyphicon glyphicon-font"></div>
        <div class="Quiz_menu_item" onclick="add_longANS()"><span class="glyphicon glyphicon-text-width"></div>
        <div class="Quiz_menu_item" onclick="add_oneANS()"><span class="glyphicon glyphicon-ok-circle"></div>
        <div class="Quiz_menu_item" onclick="add_multiANS()"><span class="glyphicon glyphicon-check"></div>
        <div class="Quiz_menu_item" onclick="add_listANS()"><span class="glyphicon glyphicon-list-alt"></div>
        <div class="Quiz_menu_item" onclick="add_File()"><span class="glyphicon glyphicon-download-alt"></div>
        <div class="Quiz_menu_item" onclick="add_Time()"><span class="glyphicon glyphicon-time"></div>
        <div class="Quiz_menu_item" onclick="add_DATE()"><span class="glyphicon glyphicon-calendar"></div>
        <div class="Quiz_menu_item" onclick="add_oneMATRIX()"><span class="glyphicon glyphicon-option-horizontal"></div>
        <div class="Quiz_menu_item" onclick="add_multiMATRIX()"><span class="glyphicon glyphicon-th"></div>
        <div class="Quiz_menu_item" onclick="add_interval()"><span class="glyphicon glyphicon-resize-horizontal"></div>
        <div class="Quiz_menu_item" onclick="close_dropdown()"><span class="glyphicon glyphicon-chevron-up"></div>
    </div>
</div>
<iframe class="hidden" id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;">
    <script language="javascript" type="text/javascript">
        window.top.window.stopUpload(<?php echo $result; ?>);
    </script>
</iframe>
</body>
<script type="text/javascript">
    var id_tmp=0;
    var tmp=0;
    var z_index = 1;

    function submit() {
        let form = document.getElementById('main_form');
        let url = form.action;
        $.ajax({
            type: "POST",
            url: url,
            data: $('#main_form').serialize() ,
            success: function(data)
            {
                submit_prvok(data,'prvok');
                // location.reload();
            }
        });

    }

    function submit_prvok(data,clas) {
        let id=data;
        var prvky = document.getElementsByClassName(clas);
        for (var i = 0; i < prvky.length; ++i) {
            var item = prvky[i];
            let html=document.createElement('input');
            html.classList.add("hidden");
            html.type="number";
            html.name="id_parent";
            html.value=parseInt(id,10);
            item.append(html);
            let typ=item.elements.namedItem('type').value;
            url=item.action;
            tmp_name="#"+item.id;
            var formData =$(tmp_name).serialize();
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                enctype: 'multipart/form-data',
                success: function(data)
                {
                    alert(data);
                    if(typ === '9' || typ === '10'){
                        submit_moznost(data,'moznost',true,item.parentElement.id);
                    }
                    if(typ === '3' || typ === '4' || typ ==='5'){
                        submit_moznost(data,'moznost',false,item.parentElement.id);
                    }
                }
            });
        }
    }

    function submit_moznost(data,clas,bool,parent) {
        let id=data;
        var prvky = document.getElementsByClassName(clas);
        for (var i = 0; i < prvky.length; ++i) {
            var item = prvky[i];
            alert(item.parentElement.parentElement.parentElement.parentElement.id);
            if(!bool) {
                if(parent===item.parentElement.id) {
                    let html = document.createElement('input');
                    html.type = "number";
                    html.name = "id_parent";
                    html.value = parseInt(id, 10);
                    item.append(html);
                    url = item.action;
                    tmp_name = "#" + item.id;
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $(tmp_name).serialize(),
                        success: function (data) {

                        }
                    });
                }
            }else{
                let bol=false;
                if(clas==="moznost")
                    bol=parent===item.parentElement.parentElement.parentElement.parentElement.id
                if(clas==="submoznost")
                    bol=parent===item.parentElement.parentElement.parentElement.id
                if(bol) {
                    let html = document.createElement('input');
                    html.type = "number";
                    html.name = "id_parent";
                    html.value = parseInt(id, 10);
                    item.append(html);
                    url = item.action;
                    tmp_name = "#" + item.id;
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $(tmp_name).serialize(),
                        success: function (data) {
                            submit_moznost(data,'submoznost',true,item.parentElement.parentElement.id);
                        }
                    });
                }
            }
        }
    }

    function open_dropdown() {
        document.getElementById("question_dropdown").classList.remove("hidden");
        document.getElementById("open_dropdown").classList.add("hidden");
    }

    function close_dropdown() {
        document.getElementById("question_dropdown").classList.add("hidden");
        document.getElementById("open_dropdown").classList.remove("hidden");
    }

    function add_option(id,clas,action) {
        let elemet=document.createElement('form');
        let html=" <input type=\"text\" name='text'>";
        elemet.id=idtmp();
        elemet.innerHTML=html;
        elemet.classList.add(clas);
        elemet.method="post";
        elemet.action=action;
        insert(elemet,id)
    }

    function add_Category(id) {
        tmp++;
        let elemet=document.createElement('div');
        let html="              <div class=\"col-sm-6\">" +
            "                        <form id='"+idtmp()+"' class=\"moznost\" method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php\">" +
            "                            <input type=\"text\" name='text'>" +
            "                        </form>" +
            "                    </div>" +
            "                    <div class=\"col-sm-6\">" +
            "                        <div id=\"catOption"+tmp+"\">"+
            "                        </div>" +
            "                        <button onclick=\"add_option('catOption"+tmp+"','submoznost','http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_submoznost.php')\">Pridaj možnosť</button>" +
            "                    </div>";
        elemet.innerHTML=html;
        elemet.id="som_id"+idtmp();
        elemet.classList.add("row");
        insert(elemet,id)
    }

    function index() {
        z_index++;
        return z_index;
    }

    function idtmp() {
        id_tmp++;
        return id_tmp;
    }

    function close_adding() {
        document.getElementById("adding_quiz").classList.add("hidden");
        document.getElementById("Quiz_Menu").classList.add("hidden");
        document.getElementById("overview_quiz").classList.remove("hidden");
    }
    function add_quiz() {
        document.getElementById("adding_quiz").classList.remove("hidden");
        document.getElementById("Quiz_Menu").classList.remove("hidden");
        document.getElementById("overview_quiz").classList.add("hidden");
    }

    function insert(html,id) {
        document.getElementById(id).append(html);
    }

    function add_shortANS() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("short_answ");
        elemet.classList.add("quiz_compartmant");
        let html="            <form id='"+idtmp()+"' class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"1\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\" name='Otazka'>" +
            "                <input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>" +
            "            </form>" +
            "        </div>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_longANS() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("long_answ");
        elemet.classList.add("quiz_compartmant");
        let html="            <form id='"+idtmp()+"' class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"2\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\" name='Otazka'>" +
            "                <input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_oneANS() {
        tmp++;
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("one_ans");
        elemet.classList.add("quiz_compartmant");
        let html="            <div id=\"one_ans_box"+tmp+"\">" +
            "                <form id='"+idtmp()+"' class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\"3\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\" name='Otazka'>" +
            "                    <input type=\"checkbox\" name='ine'><label for=\"\">Pridaj možnosť iné</label>" +
            "                    <input type=\"checkbox\" name='vyzaduje'><label for=\"\">Vyžadovať</label>" +
            "                </form>" +
            "                <form id='"+idtmp()+"' class='moznost' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php\">" +
            "                    <input type=\"text\" name='text'>" +
            "                </form>" +
            "            </div>" +
            "            <button onclick=\"add_option('one_ans_box"+tmp+"','moznost','http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php')\">Pridaj možnosť</button>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_multiANS() {
        tmp++;
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("multi_ans");
        elemet.classList.add("quiz_compartmant");
        let html="            <div id=\"multi_ans_box"+tmp+"\">" +
            "                <form id='"+idtmp()+"' class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\"4\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\" name='Otazka'>" +
            "                    <input type=\"checkbox\" name='ine'><label for=\"\">Pridaj možnosť iné</label>" +
            "                    <input type=\"checkbox\" name='vyzaduje'><label for=\"\">Vyžadovať</label>" +
            "                </form>" +
            "                <form id='"+idtmp()+"' class='moznost' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php\">" +
            "                    <input type=\"text\" name='text'>" +
            "                </form>" +
            "            </div>" +
            "            <button onclick=\"add_option('multi_ans_box"+tmp+"','moznost','http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php')\">Pridaj možnosť</button>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_listANS() {
        tmp++;
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("list_ans");
        elemet.classList.add("quiz_compartmant");
        let html="            <div id=\"list_ans_box"+tmp+"\">" +
            "                <form id='"+idtmp()+"' class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\"5\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\" name='Otazka'>" +
            "                    <input type=\"checkbox\" name='ine'><label for=\"\">Pridaj možnosť iné</label>" +
            "                    <input type=\"checkbox\" name='vyzaduje'><label for=\"\">Vyžadovať</label>" +
            "                </form>" +
            "                <form id='"+idtmp()+"' class='moznost' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php\">" +
            "                    <input type=\"text\" name='text'>" +
            "                </form>" +
            "            </div>" +
            "            <button onclick=\"add_option('list_ans_box"+tmp+"','moznost','http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_moznost.php')\">Pridaj možnosť</button>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_DATE() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("date_answ");
        elemet.classList.add("quiz_compartmant");
        let html="      <form id='"+idtmp()+"' class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"2\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\" name='Otazka'>" +
            "                <input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_File() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("file_ans");
        elemet.classList.add("quiz_compartmant");
        let html="            <form id='"+idtmp()+"' class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"6\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\" name='Otazka'>" +
            "                <input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_Time() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("time_answ");
        elemet.classList.add("quiz_compartmant");
        let html="            <form id='"+idtmp()+"' class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"1\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\" name='Otazka'>" +
            "                <input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_multiMATRIX() {
        tmp++;
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("list_ans");
        elemet.classList.add("quiz_compartmant");
        let html="            <div id=\"list_ans_box\">" +
            "                <form id='"+idtmp()+"' class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\"\" name=\"z_value\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\"10\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\" name='Otazka'>" +
            "                    <input type=\"checkbox\" name='ine'><label for=\"\">Pridaj možnosť iné</label>" +
            "                    <input type=\"checkbox\" name='vyzaduje'><label for=\"\">Vyžadovať</label>" +
            "                </form>" +
            "                <div class=\"row\" id=\"option"+tmp+"\"></div>" +
            "            </div>" +
            "            <button onclick=\"add_Category('option"+tmp+"')\">Pridaj možnosť</button>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_oneMATRIX() {
        tmp++;
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("list_ans");
        elemet.classList.add("quiz_compartmant");
        let html="            <div id=\"list_ans_box\">" +
            "                <form id='"+idtmp()+"' class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\"\" name=\"z_value\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\"9\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\" name='Otazka'>" +
            "                    <input type=\"checkbox\" name='ine'><label for=\"\">Pridaj možnosť iné</label>" +
            "                    <input type=\"checkbox\" name='vyzaduje'><label for=\"\">Vyžadovať</label>" +
            "                </form>" +
            "                <div class=\"row\" id=\"option"+tmp+"\"></div>" +
            "            </div>" +
            "            <button onclick=\"add_Category('option"+tmp+"')\">Pridaj možnosť</button>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_interval() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("intrvl_answ");
        elemet.classList.add("quiz_compartmant");
        let html="            <form id='"+idtmp()+"' class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"11\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\" name='Otazka'>" +
            "                <input type=\"number\" name=\"min\">" +
            "                <input type=\"number\" name=\"max\">" +
            "                <input type=\"checkbox\" name='vyzaduje'><label for=\"scales\">Vyžadovať</label>" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_Section() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("section");
        elemet.classList.add("quiz_compartmant");
        let html="            <form id='"+idtmp()+"' class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"16\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\" name='Otazka'>" +
            "                <input type=\"text\" value=\"popis\" name='popis'>" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_picture() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("picture");
        elemet.classList.add("quiz_compartmant");
        let html="            <form id='"+idtmp()+"' enctype=\"multipart/form-data\" class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"14\" name=\"type\">" +
            "                <input type=\"text\" value=\"Nazov\" name='Otazka'>" +
            "                <input type=\"checkbox\" name='url_bt' checked><label for=\"scales\">Použiť URL adresu</label>" +
            "                <input type=\"text\" value=\"url\" name='url'>" +
            "                <input type=\"file\" name='file_path'>" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_video() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("video");
        elemet.classList.add("quiz_compartmant");
        let html="            <form id='"+idtmp()+"' enctype=\"multipart/form-data\" class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"15\" name=\"type\">" +
            "                <input type=\"text\" value=\"Nazov\" name='Otazka'>" +
            "                <input type=\"checkbox\" name='url_bt' checked><label for=\"scales\" >Použiť URL adresu</label>" +
            "                <input type=\"text\" value=\"url\" name='url'>" +
            "                <input class='hidden' type=\"number\" name='file_path'>" +
            "            </form>"+
            "<p style='visibility: hidden' id=\"f1_upload_process\">Loading...<br/><img src=\"https://mir-s3-cdn-cf.behance.net/project_modules/disp/585d0331234507.564a1d239ac5e.gif\" /></p>"+
            "<p id=\"result\"></p>"+
            "        <form action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/quiz_file.php\" method=\"post\" enctype=\"multipart/form-data\" target=\"upload_target\" onsubmit=\"startUpload();\">"+
        "                <input type=\"file\" name='file_path'>" +
        " <input type=\"submit\" name=\"submitBtn\" value=\"Upload\" />"+
        "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_text() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("text");
        elemet.classList.add("quiz_compartmant");
        let html="            <form id='"+idtmp()+"' class='prvok' method=\"post\" action=\"http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/quiz/create_prvok.php\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"13\" name=\"type\">" +
            "                <input type=\"text\" value=\"Nazov\" name='Otazka'>" +
            "                <input type=\"text\" value=\"popis\" name='popis'>" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function startUpload(){
        document.getElementById('f1_upload_process').style.visibility = 'visible';
        return true;
    }

    function stopUpload(success){
        var result = '';
        if (success == 1){
            document.getElementById('result').innerHTML =
                '<span class="msg">The file was uploaded successfully!<\/span><br/><br/>';
        }
        else {
            document.getElementById('result').innerHTML =
                '<span class="emsg">There was an error during file upload!<\/span><br/><br/>';
        }
        document.getElementById('f1_upload_process').style.visibility = 'hidden';
        return true;
    }
</script>