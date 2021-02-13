function fLoad() {
    $("#componentWindow").load("SystemComponents/Home_Component.php");
    active(1);
}

function active(k,podskupina) {
    var links = document.getElementsByClassName("active");
    for (i = 0; i < links.length; i++) {
        links[i].classList.add("menuItem");
        links[i].classList.remove("active");
    }
    var menuItems = document.getElementById(k);
    menuItems.classList.add("active");
    menuItems.classList.remove("menuItem");
    if(podskupina=="null") {
        var parent = document.getElementById(podskupina);
        parent.classList.add("active");
        parent.classList.remove("menuItem");
    }
}

function BlogOpen() {
    $("#componentWindow").load("SystemComponents/Blog_Component.php");
    active(6);
}

function ContactsOpen() {
    $("#componentWindow").load("SystemComponents/Contacts_Component.php");
    active(3);
}

function MessegesOpen() {
    $("#componentWindow").load("SystemComponents/Messeges_Component.php");
    active(2);
}

function SettingsOpen() {
    $("#componentWindow").load("SystemComponents/Settings_Component.php");
    active(8);
}

function openNav() {
    hideDropdowns();
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("sidenav-button").style.width = "0px";
}

function closeNav() {
    hideDropdowns();
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("sidenav-button").style.width = "30px";
}


function hideDropdowns(){
    var dropdownContent1 = document.getElementById("Marks_container");
    var dropdownContent2 = document.getElementById("Links_container");
    var dropdownContent3 = document.getElementById("Personal_container");
    var dropdownContent4 = document.getElementById("System_container");
    dropdownContent1.style.display = "none";
    dropdownContent2.style.display = "none";
    dropdownContent3.style.display = "none";
    dropdownContent4.style.display = "none";
}