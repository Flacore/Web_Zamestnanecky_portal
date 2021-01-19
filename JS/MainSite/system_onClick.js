function fLoad() {
    $("#componentWindow").load("SystemComponents/Home_Component.php");
    active(1);
}

function active(k) {
    var links = document.getElementsByClassName("active");
    for (i = 0; i < links.length; i++) {
        links[i].classList.add("menuItem");
        links[i].classList.remove("active");
    }
    var menuItems = document.getElementsByClassName("menuItem");
    menuItems[k-1].classList.add("active");
    menuItems[k-1].classList.remove("menuItem");
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

function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("sidenav-button").style.width = "0px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("sidenav-button").style.width = "30px";
}