//BLOG
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

$(window).resize(function () {
    var x = document.getElementById("_msg-sideMenu");
    var z = document.getElementById("_sideMenu");
    if($(window).width()>980){
        x.className="";
        z.className="";
        x.classList.add('msg-sideMenu');
        z.classList.add('Messenger-Menu');
        z.classList.add('col-md-3');
    }
});

$("#newBlog").click(function () {
    document.getElementById('messegeWindow').innerHTML="";
    var outer = document.getElementById('messegeWindow');
    var inner = document.getElementById('addBlog');
    outer.innerHTML=inner.innerHTML;
    if($(window).width()<=980){
        msgOpen();
    }
});

function onlyOne(checkbox,druh,tmp,n) {
    x = document.querySelectorAll(druh);
    for (i = 0; i < x.length; i++) {
        if(i+1!=n)
            x[i].checked = false;
        else
            x[i].checked = true;
    }

    if(tmp==1){
        document.getElementById('text_area').style.display='none';
        document.getElementById('platnostAktuality').style.display='none';
    }
    if(tmp==2){
        document.getElementById('text_area').style.display='block';
        document.getElementById('platnostAktuality').style.display='block';
    }
}

function msgOpen() {
    var x = document.getElementById("_msg-sideMenu");
    var z = document.getElementById("_sideMenu");
    if (x.className === "msg-sideMenu") {
        z.className="respMenu";
        x.className = " resp";
    } else {
        x.className="";
        z.className="";
        x.classList.add('msg-sideMenu');
        z.classList.add('Messenger-Menu');
        z.classList.add('col-md-3');
    }

}

$(document).ready(function(){
    $("#_NameList .NameList-item").click(function(){
        document.getElementById('messegeWindow').innerHTML="";
        $id = $(this).find('h1:first-child').text();

        var x, i;
        x = document.querySelectorAll(".NameList-item");
        for (i = 0; i < x.length; i++) {
            x[i].classList.remove('NameList-item_Opened');
        }

        $(this).addClass('NameList-item_Opened');

        $.ajax({
            type: 'POST',
            data: {id: $id},
            url: '../PHP/System/blog.php',
            success: function(data) {
                document.getElementById('messegeWindow').innerHTML=data;
                if($(window).width()<=980){
                    msgOpen();
                }
            }
        });
    });
});

//Cariere
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

//Contacts
var frm = $('#myForm');

frm.submit(function (e) {

    e.preventDefault();
    $.ajax({
        type: frm.attr('method'),
        url: frm.attr('action'),
        data: frm.serialize(),
        success: function (data) {
            document.getElementById('searchResults').innerHTML=data;
        },

    });
});
function sendMSG($Name) {
    $.post("http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/new_konverzation.php",{ user_id: $Name} ,function(data) {
        if(data=="ok") {
            $("#componentWindow").load("SystemComponents/Messeges_Component.php");
            active(2);
        }
    });
}

function remove_person($Name) {
    $.post("http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/remove_person.php",{ user_id: $Name} ,function(data) {
        if(data=="ok") {
            $("#componentWindow").load("SystemComponents/Contacts_Component.php");
        }
    });
}

function edit_person($Name) {
    let prvok = document.getElementById($Name);
    prvok.style.display='block';
}

//Curses
function create_curse() {
    let modal = document.getElementById("modal_curses");
    modal.style.display = "block";
    document.getElementById("ad_curse").classList.remove('hidden');
    document.getElementById("my_curses").classList.add('hidden');
    document.getElementById("curses_loged").classList.add('hidden');
}

function my_curse() {
    let modal = document.getElementById("modal_curses");
    modal.style.display = "block";
    document.getElementById("ad_curse").classList.add('hidden');
    document.getElementById("my_curses").classList.remove('hidden');
    document.getElementById("curses_loged").classList.add('hidden');
}

function Registration($prednaska,$login) {
    $.post("http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/add_userCurses_registration.php",{ prednaska_id: $prednaska, login_id: $login} ,function(data) {
        alert("Prihlásenie prebehlo úspešne!")
        $("#componentWindow").load("SystemComponents/Home_Component.php");
        active(1);
    });
}

function tableDetail($name) {
    if(document.getElementById($name).classList.contains("detailHide")){
        var x, i;
        x = document.querySelectorAll(".detail");
        for (i = 0; i < x.length; i++) {
            x[i].classList.add('detailHide');
        }
        document.getElementById($name).classList.remove("detailHide");
    }else{
        document.getElementById($name).classList.add("detailHide");
    }
}
//Files
function download(cesta) {
    $.ajax({
        type: 'POST',
        data: {cesta: cesta},
        url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/ftp/Download_file.php',
        success: function(data){
        }
    });
}
function remove_item(id_subor) {
    $.ajax({
        type: 'POST',
        data: {idSubor: id_subor},
        url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/remove_file.php',
        success: function(data) {
            location.reload();
        }
    });
};

function edit_file(id_subor,element,value,nazov,popis) {
    let formular=document.getElementById("form_file");
    formular.action="http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/edit_file.php";

    document.getElementById("idFile").value=id_subor;
    document.getElementById("description").value=popis;
    document.getElementById("name").value=nazov;
    let file_input = document.getElementById("file_path");
    file_input.required=false;

    let o_element = document.getElementById(element);
    o_element.value=value;

    let modal = document.getElementById("modal_file");
    modal.style.display = "block";
}

//Home
var time = 2000;

var slideMessegesIndex = 0;
var NotificationslideIndex = 0;
var slideOznamyIndex = 0;
var slideActualityIndex = 0;
showMessegesSlide();
showNotificationSlides();
showOznamySlides();
showActualitySlides();

function plusSlides(n,) {
    showSlides(slideIndex += n);
}

function showMessegesSlide() {
    var i;
    var slides = document.getElementsByClassName("MessegesSlide");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideMessegesIndex++;
    if (slideMessegesIndex > slides.length) {slideMessegesIndex = 1}
    slides[slideMessegesIndex-1].style.display = "block";
    setTimeout(showMessegesSlide, time);
}

function showNotificationSlides() {
    var i;
    var slides = document.getElementsByClassName("NotificationSlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    NotificationslideIndex++;
    if (NotificationslideIndex > slides.length) {NotificationslideIndex = 1}
    slides[NotificationslideIndex-1].style.display = "block";
    setTimeout(showNotificationSlides, time);
}

function showOznamySlides() {
    var i;
    var slides = document.getElementsByClassName("OznamySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideOznamyIndex++;
    if (slideOznamyIndex > slides.length) {slideOznamyIndex = 1}
    slides[slideOznamyIndex-1].style.display = "block";
    setTimeout(showOznamySlides, time);
}

function showActualitySlides() {
    var i;
    var slides = document.getElementsByClassName("AktualitySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideActualityIndex++;
    if (slideActualityIndex > slides.length) {slideActualityIndex = 1}
    slides[slideActualityIndex-1].style.display = "block";
    setTimeout(showActualitySlides, time);
}

//Place
function delete_place(id) {
    $.ajax({
        type: 'POST',
        data: {id: id},
        url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/delete_place.php',
        success: function(data) {
            location.reload();
        }
    });
}

function add_place() {
    let modal = document.getElementById("modal_place");
    modal.style.display = "block";
}

//Inzercia
function back_inz() {
    if(!document.getElementById('inzercia_all').classList.contains('hidden')){
        document.getElementById('inzercia_cat').classList.remove('hidden');
        document.getElementById('inzercia_all').classList.add('hidden');
        document.getElementById('inzercia_det').classList.add('hidden');
        document.getElementById('back_btn').classList.add('hidden');
    }
    if(!document.getElementById('inzercia_det').classList.contains('hidden')){
        document.getElementById('inzercia_cat').classList.add('hidden');
        document.getElementById('inzercia_all').classList.remove('hidden');
        document.getElementById('inzercia_det').classList.add('hidden');
        document.getElementById('back_btn').classList.remove('hidden');
    }
}

function inzViewClose(){
    document.getElementById('inzercia_view').style.display='none';
    document.getElementById('inzercia_cat').style.display='none';
    document.getElementById('inzercia_all').style.display='none';
    document.getElementById('inzercia_det').style.display='none';
    document.getElementById('back_btn').classList.add('hidden');
}

function  inzViewOpen() {
    document.getElementById('inzercia_cat').style.display='block';
    document.getElementById('inzercia_view').style.display='block';
    let tmp = document.getElementById('inzercia_all');
    tmp.load("SystemComponents/inzercia.php");
    document.getElementById('inzercia_all').style.display='none';
    document.getElementById('inzercia_det').style.display='none';
    document.getElementById('back_btn').classList.add('hidden');
}

function showDetail_inz(id) {
    document.getElementById('inzercia_det').innerHTML="";
    $.ajax({
        type: 'POST',
        data: {id: id,typ: 2},
        url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/Main%20Site/inzercia.php',
        success: function(data) {
            document.getElementById('inzercia_det').innerHTML=data;
        }
    });
    document.getElementById('inzercia_cat').classList.add('hidden');
    document.getElementById('inzercia_all').classList.add('hidden');
    document.getElementById('inzercia_det').classList.remove('hidden');
    document.getElementById('back_btn').classList.remove('hidden');
}

function openCategory(id){
    document.getElementById('inzercia_all').classList.remove('hidden');
    $.ajax({
        type: 'POST',
        data: {id: id,typ: 1},
        url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/Main%20Site/inzercia.php',
        success: function(data) {
            document.getElementById('inzercia_all').innerHTML=data;
        }
    });
    document.getElementById('inzercia_cat').classList.add('hidden');
    document.getElementById('inzercia_det').classList.add('hidden');
    document.getElementById('back_btn').classList.remove('hidden');
}


function add_ad() {
    document.getElementById("cat_list").classList.add('hidden');
    document.getElementById("ad_form_item").classList.remove('hidden');
    document.getElementById("ad_form_cat").classList.add('hidden');
    document.getElementById("ad_list").classList.add('hidden');
    let modal = document.getElementById("modal_ad");
    modal.style.display = "block";
}

function add_adcat() {
    document.getElementById("cat_list").classList.add('hidden');
    document.getElementById("ad_form_item").classList.add('hidden');
    document.getElementById("ad_form_cat").classList.remove('hidden');
    document.getElementById("ad_list").classList.add('hidden');
    let modal = document.getElementById("modal_ad");
    modal.style.display = "block";
}

function add_catlist() {
    document.getElementById("ad_form_item").classList.add('hidden');
    document.getElementById("ad_form_cat").classList.add('hidden');
    document.getElementById("ad_list").classList.add('hidden');
    document.getElementById("cat_list").classList.remove('hidden');
    let modal = document.getElementById("modal_ad");
    modal.style.display = "block";
}

function add_adlist() {
    document.getElementById("cat_list").classList.add('hidden');
    document.getElementById("ad_form_item").classList.add('hidden');
    document.getElementById("ad_form_cat").classList.add('hidden');
    document.getElementById("ad_list").classList.remove('hidden');
    let modal = document.getElementById("modal_ad");
    modal.style.display = "block";
}