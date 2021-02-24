

function  add_link(login_id,zalozka=false) {
    clear_form();
    close_modal();
    let modal = document.getElementById("modal_links");
    modal.style.display = "block";

    var module = document.getElementById("adding_link");
    module.classList.remove("hidden");
    if(zalozka){
        if (login_id != "admin") {
            var input = document.getElementById("idlogin");
            input.value = login_id;
        }
    }else{
        var link = document.getElementById("Link");
        link.classList.add("hidden");
        var link_t = document.getElementById("Link_Text");
        link_t.classList.add("hidden");
    }
}


function edit_links(login_id,zalozka=false) {
    clear_form();
    close_modal();
    let modal = document.getElementById("modal_links");
    modal.style.display = "block"

    if(zalozka) {
        if (login_id != "admin") {
            var module = document.getElementById("edit_link_self");
            module.classList.remove("hidden");
        } else {
            var module = document.getElementById("edit_link_all");
            module.classList.remove("hidden");
        }
    }else{
        var module = document.getElementById("edit_files_category");
        module.classList.remove("hidden");
    }
}

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
    Link.value=link;
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

function reset_modal_file(){
    let prednaska = document.getElementById("idPrednaska_file");
    let pozicia = document.getElementById("idPozicia_file");
    let zalozka = document.getElementById("idSubor_file");
    prednaska.value="null";
    pozicia.value="null";
    zalozka.value="null";

    document.getElementById("file_path").value=null;
    document.getElementById("description").value=null;
    document.getElementById("name").value=null;
}