function guestViewClose(){
    document.getElementById('guest_view').style.display='none';
    document.getElementById('registration_guest').style.display='none';
    document.getElementById('textShow_guest').style.display='none';
}

function showTextGuest() {
    document.getElementById('guest_view').style.display='block';
    document.getElementById('textShow_guest').style.display='block';
}

function tableDetail(name) {
    if(document.getElementById(name).classList.contains("detailHide")){
        var x, i;
        x = document.querySelectorAll(".detail");
        for (i = 0; i < x.length; i++) {
            x[i].classList.add('detailHide');
        }
        document.getElementById(name).classList.remove("detailHide");
    }else{
        document.getElementById(name).classList.add("detailHide");
    }
}

function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

function aktualityUp() {
    document.getElementById('aktualityWindow').scrollTop-=20;
}
function aktualityDown() {
    document.getElementById('aktualityWindow').scrollTop+=20;
}

function oznamyUp() {
    document.getElementById('oznamyWindow').scrollTop-=20;
}
function oznamyDown() {
    document.getElementById('oznamyWindow').scrollTop+=20;
}