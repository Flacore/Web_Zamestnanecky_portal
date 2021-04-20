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

    $("#addButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/adding.php");
        active("addButton","null");
        closeNav();
    });

    $("#importButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/import.php");
        active("importButton","null");
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

    $("#sellButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/inzercia.php");
        active("sellButton","null");
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

    $("#databaseButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/db_Component.php");
        active("databaseButton","null");
        closeNav();
    });

    $("#quizButton").on("click", function() {
        $("#componentWindow").load("SystemComponents/Quiz_Component.php");
        active("quizButton","null");
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

    $("#Admin").on("click",function () {
        var dropdownContent1 = document.getElementById("Admin_container");
        if (dropdownContent1.style.display === "block") {
            dropdownContent1.style.display = "none";
        } else {
            hideDropdowns();
            dropdownContent1.style.display = "block";
        }
    });

    $("#Documents").on("click",function () {
        var dropdownContent1 = document.getElementById("Documents_container");
        if (dropdownContent1.style.display === "block") {
            dropdownContent1.style.display = "none";
        } else {
            hideDropdowns();
            dropdownContent1.style.display = "block";
        }
    });

    $(".delete_link").click(function () {
        let $id = $(this).find('value:first-child').text();
        $.ajax({
            type: 'POST',
            data: {id: $id},
            url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/add_update/remove_link.php',
            success: function(data) {
                location.reload();
            }
        });
    });

    $(".down_button").click(function () {
        $("#componentWindow").load("SystemComponents/files.php");
        closeNav();
        let $id = $(this).find('value:first-child').text();
        $.ajax({
            type: 'POST',
            data: {id: $id},
            url: 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/PHP/System/files_list.php',
            success: function(data) {
                document.getElementById('downloadable').innerHTML=data;
            }
        });
    });


});
