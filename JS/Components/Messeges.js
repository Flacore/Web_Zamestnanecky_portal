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

$(function() {
    $('#msgText').each(function() {
        $(this).find('input').keypress(function(e) {
            // Enter pressed?
            if(e.which == 10 || e.which == 13) {
                this.form.submit();
            }
        });

        $(this).find('input[type=submit]').hide();
    });
});

$("#openContacts").click(function () {
    $("#componentWindow").load("SystemComponents/Contacts_Component.php");
    active(3);
});

function msgOpen() {
    var x = document.getElementById("_msg-sideMenu");
    var z = document.getElementById("_sideMenu");
    if (x.className === "msg-sideMenu") {
        z.className="respMenu";
        x.className += " resp";
    } else {
        x.className="";
        z.className="";
        x.classList.add('msg-sideMenu');
        z.classList.add('Messenger-Menu');
        z.classList.add('col-md-3');
    }
}

$(document).ready(function(){
    $(".NameList-item .buttons-msg").click(function(){
        $n = $(this).find('value:first-child').text();
        $k = $(this).find('value:nth-child(2)').text();

        var x, i;
        x = document.querySelectorAll(".NameList-item");
        for (i = 0; i < x.length; i++) {
            x[i].classList.remove('NameList-item_Opened');
        }

        $(this).parent().addClass('NameList-item_Opened');

        $.ajax({
            type: 'POST',
            data: {n: $n,k:$k},
            url: '../PHP/System/messeges.php',
            success: function(data) {
                document.getElementById('msgs').innerHTML=data;
                document.getElementById('msg_Window').style.visibility="visible";
                if($(window).width()<=980){
                    msgOpen();
                }
            }
        });
    });
});