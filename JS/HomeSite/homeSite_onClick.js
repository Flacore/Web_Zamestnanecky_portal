function guestViewClose(){
    document.getElementById('guest_view').style.display='none';
    document.getElementById('registration_guest').style.display='none';
    document.getElementById('textShow_guest').style.display='none';
}

function showTextGuest() {
    document.getElementById('guest_view').style.display='block';
    document.getElementById('textShow_guest').style.display='block';
}

function showRegistrationGuest() {
    document.getElementById('guest_view').style.display='block';
    document.getElementById('registration_guest').style.display='block';
    document.getElementById('idPrednasky').value = $id;
}

function tableDetail($name) {
    if(document.getElementById($name).classList.contains("detailHide")){
        document.getElementById($name).classList.remove("detailHide");
    }else{
        document.getElementById($name).classList.add("detailHide");
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