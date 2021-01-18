$(document).ready( function() {
    $("#homeButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Home_Component.html");
        active(1);
        closeNav();
    });
    $("#cursesButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Curses_Component.html");
        active(4);
        closeNav();
    });
    $("#messegesButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Messeges_Component.html");
        active(2);
        closeNav();
    });
    $("#settingsButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Settings_Component.html");
        active(8);
        closeNav();
    });
    $("#contactsButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Contacts_Component.html");
        active(3);
        closeNav();
    });
    $("#carierButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Cariere_Component.html");
        active(5);
        closeNav();
    });
    $("#blogButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Blog_Component.html");
        active(6);
        closeNav();
    });
    $("#powerButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Power_Component.html");
        active(7);
        closeNav();
    });
});
