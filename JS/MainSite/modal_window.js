

function  close_modal() {
    clear_form();
    var module=document.getElementById("adding_link");
    module.classList.add("hidden");
    module=document.getElementById("edit_link_all");
    module.classList.add("hidden");
    module=document.getElementById("edit_link_self");
    module.classList.add("hidden");
    module=document.getElementById("edit_files_category");
    module.classList.add("hidden");
    let modal = document.getElementById("modal_links");
    modal.style.display = "none";
}

function clear_form() {
    var form=document.getElementById("link_form");
    form.method="post";
    form.action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/add_link.php";
    var input = document.getElementById("idlogin");
    input.value="";
    var Name = document.getElementById("Name");
    Name.value="";
    var Link = document.getElementById("Link");
    Link.value="";
    Link.classList.remove("hidden");
    var link_t = document.getElementById("Link_Text");
    link_t.classList.remove("hidden");
    var id=document.getElementById("id_Link");
    id.value="";
    setGlyph(glyphiconList(glyphiconList("",0),null));
}

function edit_link(id_link,name,link,glyph){
    close_modal();

    var form=document.getElementById("link_form");
    form.method="post";
    form.action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/edit_link.php";

    var id=document.getElementById("id_Link");
    id.value=id_link;
    var Name = document.getElementById("Name");
    Name.value=name;
    var Link = document.getElementById("Link");
    if(link===''){
        Link.classList.add("hidden");
    }else {
        Link.classList.remove("hidden");
        Link.value = link;
    }
    setGlyph(glyphiconList(glyph,null));

    let modal = document.getElementById("modal_links");
    modal.style.display = "block";
    var module=document.getElementById("adding_link");
    module.classList.remove("hidden");
}

function open_modal_file(element,value) {
    reset_modal_file();
    let o_element = document.getElementById(element);
    o_element.value=value;

    let modal = document.getElementById("modal_file");
    modal.style.display = "block";
}

function close_modal_file() {
    let modal = document.getElementById("modal_file");
    modal.style.display = "none";
}

function close_modal_nt() {
    let modal = document.getElementById('modal_notification');
    modal.style.display="none"
    document.getElementById('notification_list').classList.add('hidden');
    document.getElementById('notification_form').classList.add('hidden');
}

function close_ntForm() {
    document.getElementById('notification_list').classList.remove('hidden');
    document.getElementById('notification_form').classList.add('hidden');
}

function open_ntForm() {
    document.getElementById('notification_list').classList.add('hidden');
    document.getElementById('notification_form').classList.remove('hidden');
}


function reset_modal_file(){
    let file_input = document.getElementById("file_path");
    file_input.required=true;
    document.getElementById("idFile").value=null;
    let formular=document.getElementById("form_file");
    let prednaska = document.getElementById("idPrednaska_file");
    let pozicia = document.getElementById("idPozicia_file");
    let zalozka = document.getElementById("idSubor_file");
    prednaska.value="null";
    pozicia.value="null";
    zalozka.value="null";
    formular.action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/add_file.php";

    document.getElementById("file_path").value=null;
    document.getElementById("description").value=null;
    document.getElementById("name").value=null;
}