$(document).ready( function() {
    $("#homeButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Home_Component.php");
        active("homeButton","null");
        closeNav();
    });
    $("#cursesButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Curses_Component.php");
        active("cursesButton","null");
        closeNav();
    });
    $("#messegesButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Messeges_Component.php");
        active("messegesButton","null");
        closeNav();
    });
    $("#settingsButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Settings_Component.php");
        active("settingsButton","null");
        closeNav();
    });
    $("#contactsButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Contacts_Component.php");
        active("contactsButton","null");
        closeNav();
    });
    $("#carierButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Cariere_Component.php");
        active("carierButton","null");
        closeNav();
    });
    $("#blogButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Blog_Component.php");
        active("blogButton","null");
        closeNav();
    });
    $("#powerButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Power_Component.php");
        active("powerButton","null");
        closeNav();
    });

    $("#Links").on("click",function () {
        var dropdownContent1 = document.getElementById("Links_container");
        if (dropdownContent1.style.display === "block") {
            dropdownContent1.style.display = "none";
        } else {
            hideDropdowns();
            dropdownContent1.style.display = "block";
        }
    });
    $("#Marks").on("click",function () {
        var dropdownContent1 = document.getElementById("Marks_container");
        if (dropdownContent1.style.display === "block") {
            dropdownContent1.style.display = "none";
        } else {
            hideDropdowns();
            dropdownContent1.style.display = "block";
        }
    });
    $("#Personal").on("click",function () {
        var dropdownContent1 = document.getElementById("Personal_container");
        if (dropdownContent1.style.display === "block") {
            dropdownContent1.style.display = "none";
        } else {
            hideDropdowns();
            dropdownContent1.style.display = "block";
        }
    });
    $("#System").on("click",function () {
        var dropdownContent1 = document.getElementById("System_container");
        if (dropdownContent1.style.display === "block") {
            dropdownContent1.style.display = "none";
        } else {
            hideDropdowns();
            dropdownContent1.style.display = "block";
        }
    });

});
