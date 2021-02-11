$(document).ready( function() {
    $("#homeButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Home_Component.php");
        active(1);
        closeNav();
    });
    $("#cursesButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Curses_Component.php");
        active(4);
        closeNav();
    });
    $("#messegesButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Messeges_Component.php");
        active(2);
        closeNav();
    });
    $("#settingsButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Settings_Component.php");
        active(8);
        closeNav();
    });
    $("#contactsButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Contacts_Component.php");
        active(3);
        closeNav();
    });
    $("#carierButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Cariere_Component.php");
        active(5);
        closeNav();
    });
    $("#blogButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Blog_Component.php");
        active(6);
        closeNav();
    });
    $("#powerButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Power_Component.php");
        active(7);
        closeNav();
    });

});
