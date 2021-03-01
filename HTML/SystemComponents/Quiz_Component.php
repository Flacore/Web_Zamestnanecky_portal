<?php include "../../PHP/config_DB.php"; ?>
<body>
<div id="overview_quiz" class="container">
    <br>
    <div class='col-sm-12'>
        <div class="center file_item_btn" onclick="add_quiz()"><span class="button_icon glyphicon glyphicon-plus"></span></div>
    </div>
    <br><br><br>
<!--        Prehlad Quizov-->
    <br><br><br>
</div>

<div id="adding_quiz" class="container hidden">

    <br>
    <span class="close-btn" onclick="close_adding()">&times;</span>
    <br>

    <div id="adding_question">
        <div class="form_settings quiz_compartmant">
            <form id="main_form" method="post" action="">
                <input class="hidden" type="number" value="1" name="z_value">
                <input class="hidden" type="number" value="12" name="type">
                <input type="text" value="Nazov">
                <input type="text" value="popis">
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
</body>
<script>
    var tmp=0;
    var z_index = 1;

    function submit() {
        var form = document.getElementById('main_form');
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data)
            {
                f(data,'prvok');
            }
        });

    }

    function submit_prvok(data,clas) {
        let id=data;
        var prvky = document.getElementsByClassName(clas);
        for (var i = 0; i < prvky.length; ++i) {
            var item = prvky[i];
            html="<input class='hidden' type='number' name='id_parent' value='"+id+"'>";
            insert(html,item);
            let typ=item.form.elements.namedItem('type').value;
            url=item.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: item.serialize(),
                success: function(data)
                {
                    if(typ === '9' || typ === '10'){
                        submit_moznost(data,'moznost',true);
                    }
                    if(typ === '3' || typ === '4' || typ ==='5'){
                        submit_moznost(data,'moznost',false);
                    }
                }
            });
        }
    }

    //iba prvky ktore su v elemente
    function submit_moznost(data,clas,bool) {
        let id=data;
        var prvky = document.getElementsByClassName(clas);
        for (var i = 0; i < prvky.length; ++i) {
            var item = prvky[i];
            html="<input class='hidden' type='number' name='id_parent' value='"+id+"'>";
            insert(html,item);
            url=item.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: item.serialize(),
                success: function(data)
                {
                    if(bool){

                    }else{

                    }
                }
            });
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

    function add_option(id,clas) {
        let elemet=document.createElement('form');
        let html=" <input type=\"text\">";
        elemet.innerHTML=html;
        elemet.classList.add(clas);
        elemet.method="post";
        elemet.action="";
        insert(elemet,id)
    }

    function add_Category(id) {
        tmp++;
        let elemet=document.createElement('div');
        let html="              <div class=\"col-sm-6\">" +
            "                        <form class='moznost' method=\"post\" action=\"\">" +
            "                            <input type=\"text\">" +
            "                        </form>" +
            "                    </div>" +
            "                    <div class=\"col-sm-6\">" +
            "                        <div id=\"catOption"+tmp+"\">"+
            "                        </div>" +
            "                        <button onclick=\"add_option('catOption"+tmp+"','submoznost')\">Pridaj možnosť</button>" +
            "                    </div>";
        elemet.innerHTML=html;
        elemet.classList.add("row");
        insert(elemet,id)
    }

    function index() {
        z_index++;
        return z_index;
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
        let html="            <form class='prvok' method=\"post\" action=\"\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"1\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\">" +
            "                <input type=\"checkbox\"><label for=\"scales\">Vyžadovať</label>" +
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
        let html="            <form class='prvok' method=\"post\" action=\"\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"2\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\">" +
            "                <input type=\"checkbox\"><label for=\"scales\">Vyžadovať</label>" +
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
            "                <form class='prvok' method=\"post\" action=\"\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\"3\" name=\"type\">" +
            "                    <input type=\"text\" value=\"Otazka\">" +
            "                    <input type=\"checkbox\"><label for=\"\">Pridaj možnosť iné</label>" +
            "                    <input type=\"checkbox\"><label for=\"\">Vyžadovať</label>" +
            "                </form>" +
            "                <form class='moznost' method=\"post\" action=\"\">" +
            "                    <input type=\"text\">" +
            "                </form>" +
            "            </div>" +
            "            <button onclick=\"add_option('one_ans_box"+tmp+"','moznost')\">Pridaj možnosť</button>";
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
            "                <form class='prvok' method=\"post\" action=\"\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\"4\" name=\"type\">" +
            "                    <input type=\"text\" value=\"Otazka\">" +
            "                    <input type=\"checkbox\"><label for=\"\">Pridaj možnosť iné</label>" +
            "                    <input type=\"checkbox\"><label for=\"\">Vyžadovať</label>" +
            "                </form>" +
            "                <form class='moznost' method=\"post\" action=\"\">" +
            "                    <input type=\"text\">" +
            "                </form>" +
            "            </div>" +
            "            <button onclick=\"add_option('multi_ans_box"+tmp+"','moznost')\">Pridaj možnosť</button>";
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
            "                <form class='prvok' method=\"post\" action=\"\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\"5\" name=\"type\">" +
            "                    <input type=\"text\" value=\"Otazka\">" +
            "                    <input type=\"checkbox\"><label for=\"\">Pridaj možnosť iné</label>" +
            "                    <input type=\"checkbox\"><label for=\"\">Vyžadovať</label>" +
            "                </form>" +
            "                <form class='moznost' method=\"post\" action=\"\">" +
            "                    <input type=\"text\">" +
            "                </form>" +
            "            </div>" +
            "            <button onclick=\"add_option('list_ans_box"+tmp+"','moznost')\">Pridaj možnosť</button>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_DATE() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("date_answ");
        elemet.classList.add("quiz_compartmant");
        let html="            <form class='prvok' method=\"post\" action=\"\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"2\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\">" +
            "                <input type=\"checkbox\"><label for=\"scales\">Vyžadovať</label>" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_File() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("file_ans");
        elemet.classList.add("quiz_compartmant");
        let html="            <form class='prvok' method=\"post\" action=\"\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"6\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\">" +
            "                <input type=\"checkbox\"><label for=\"scales\">Vyžadovať</label>" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_Time() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("time_answ");
        elemet.classList.add("quiz_compartmant");
        let html="            <form class='prvok' method=\"post\" action=\"\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"1\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\">" +
            "                <input type=\"checkbox\"><label for=\"scales\">Vyžadovať</label>" +
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
            "                <form class='prvok' method=\"post\" action=\"\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\"\" name=\"z_value\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\"10\" name=\"type\">" +
            "                    <input type=\"text\" value=\"Otazka\">" +
            "                    <input type=\"checkbox\"><label for=\"\">Pridaj možnosť iné</label>" +
            "                    <input type=\"checkbox\"><label for=\"\">Vyžadovať</label>" +
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
            "                <form class='prvok' method=\"post\" action=\"\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\"\" name=\"z_value\">" +
            "                    <input class=\"hidden\" type=\"number\" value=\"9\" name=\"type\">" +
            "                    <input type=\"text\" value=\"Otazka\">\n" +
            "                    <input type=\"checkbox\"><label for=\"\">Pridaj možnosť iné</label>" +
            "                    <input type=\"checkbox\"><label for=\"\">Vyžadovať</label>" +
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
        let html="            <form class='prvok' method=\"post\" action=\"\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"11\" name=\"type\">" +
            "                <input type=\"text\" value=\"Otazka\">" +
            "                <input type=\"number\" name=\"min\">" +
            "                <input type=\"number\" name=\"max\">" +
            "                <input type=\"checkbox\"><label for=\"scales\">Vyžadovať</label>" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_Section() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("section");
        elemet.classList.add("quiz_compartmant");
        let html="            <form class='prvok' method=\"post\" action=\"\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"16\" name=\"type\">" +
            "                <input type=\"text\" value=\"Nazov\">" +
            "                <input type=\"text\" value=\"popis\">" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_picture() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("picture");
        elemet.classList.add("quiz_compartmant");
        let html="            <form class='prvok' method=\"post\" action=\"\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"14\" name=\"type\">" +
            "                <input type=\"text\" value=\"Nazov\">" +
            "                <input type=\"file\">" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_video() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("video");
        elemet.classList.add("quiz_compartmant");
        let html="            <form class='prvok' method=\"post\" action=\"\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"15\" name=\"type\">" +
            "                <input type=\"text\" value=\"Nazov\">" +
            "                <input type=\"file\" value=\"popis\">" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }

    function add_text() {
        let id="adding_question";
        let elemet=document.createElement('div');
        elemet.classList.add("text");
        elemet.classList.add("quiz_compartmant");
        let html="            <form class='prvok' method=\"post\" action=\"\">" +
            "                <input class=\"hidden\" type=\"number\" value=\""+index()+"\" name=\"z_value\">" +
            "                <input class=\"hidden\" type=\"number\" value=\"13\" name=\"type\">" +
            "                <input type=\"text\" value=\"Nazov\">" +
            "                <input type=\"text\" value=\"popis\">" +
            "            </form>";
        elemet.innerHTML=html;
        insert(elemet,id);
    }
</script>